<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["funcionario"]) || $_SESSION["funcionario"]->funcao !== "Administrador") {
    header("Location: index_produto.php");
    exit();
}

include_once "objetos/Cliente.php";
include_once "configs/database.php";

$db = (new Database())->conectar();
$clienteModel = new Cliente($db);
$clientes = $clienteModel->listarTodos();

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Clientes - Admin</title>
    <style>
        table, tr, td, th { border: 1px solid black; border-collapse: collapse; padding: 5px; }
    </style>
</head>
<body>

<h1>Gerenciamento de Clientes</h1>
<p><a href="index_produto.php">Voltar</a></p>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CPF</th>
        <th>Email</th>
        <th>Telefone</th>
    </tr>
    <?php foreach($clientes as $c): ?>
        <tr>
            <td><?= $c->id ?></td>
            <td><?= $c->nome ?></td>
            <td><?= $c->cpf ?></td>
            <td><?= $c->email ?></td>
            <td><?= $c->telefone ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
