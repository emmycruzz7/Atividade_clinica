<?php
require 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM pacientes WHERE id = ?");
    $stmt->execute([$id]);
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$paciente) {
        die("Paciente não encontrado.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $sexo = $_POST['sexo'];

    $stmt = $pdo->prepare("UPDATE pacientes SET nome = ?, email = ?, telefone = ?, endereco = ?, sexo = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $telefone, $endereco, $sexo, $id]);

    echo "<div class='alert alert-success'>Cadastro atualizado com sucesso!</div>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Editar Paciente</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= $paciente['nome'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" value="<?= $paciente['email'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="<?= $paciente['telefone'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" name="endereco" class="form-control" value="<?= $paciente['endereco'] ?>">
        </div>
        <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select name="sexo" class="form-control" required>
                <option value="masculino" <?= $paciente['sexo'] === 'masculino' ? 'selected' : '' ?>>Masculino</option>
                <option value="feminino" <?= $paciente['sexo'] === 'feminino' ? 'selected' : '' ?>>Feminino</option>
                <option value="outro" <?= $paciente['sexo'] === 'outro' ? 'selected' : '' ?>>Outro</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
