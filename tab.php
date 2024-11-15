<?php
require 'conexao.php';

$sql = "SELECT * FROM pacientes";
$stmt = $pdo->query($sql);
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Lista de Pacientes</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pacientes as $paciente): ?>
                <tr>
                    <td><?= $paciente['id'] ?></td>
                    <td><?= $paciente['nome'] ?></td>
                    <td><?= $paciente['email'] ?></td>
                    <td><?= $paciente['telefone'] ?></td>
                    <td>
                        <a href="editar.php?id=<?= $paciente['id'] ?>" class="btn btn-warning">Editar</a>
                        <a href="excluir.php?id=<?= $paciente['id'] ?>" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
