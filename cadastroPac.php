<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $sexo = $_POST['sexo'];

    $data_maioridade = date('Y-m-d', strtotime('-18 years'));
    if ($data_nascimento > $data_maioridade) {
        echo "<div class='alert alert-danger'>Erro: O paciente deve ser maior de idade.</div>";
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO pacientes (nome, data_nascimento, email, telefone, endereco, sexo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $data_nascimento, $email, $telefone, $endereco, $sexo]);
        echo "<div class='alert alert-success'>Cadastro realizado com sucesso!</div>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "<div class='alert alert-danger'>Erro: E-mail já cadastrado!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao cadastrar paciente: " . $e->getMessage() . "</div>";
        }
    }
}
?>
<style>
        body {
            background: url('https://png.pngtree.com/background/20230827/original/pngtree-3d-rendering-of-a-hospital-s-indoor-corridor-picture-image_4842146.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff; /* Texto branco para contraste */
        }
        .container {
            background-color: rgba(46, 139, 87, 0.9); /* Fundo verde secundário para container com transparência */
            padding: 20px;
            border-radius: 10px;
        }
        .form-group img {
            max-width: 10%; /* Reduzir bastante o tamanho da imagem */
            height: auto;
        }
    </style>
</head>
<body>
<div class="form-group">
    <!-- Exemplo de imagem decorativa -->
    <img src="https://w7.pngwing.com/pngs/571/526/png-transparent-physician-medicine-health-care-logo-physical-therapy-symbol-miscellaneous-text-logo-thumbnail.png"
         alt="Imagem clinica"> 
</div>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Cadastro de Paciente</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" name="endereco" class="form-control">
        </div>
        <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select name="sexo" class="form-control" required>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
                <option value="outro">Outro</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
