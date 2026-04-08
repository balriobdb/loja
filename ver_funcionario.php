<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["funcionario"]) || $_SESSION["funcionario"]->funcao !== "Administrador") {
    header("Location: index_produto.php");
    exit();
}

include_once("objetos/FuncionarioController.php");

$controller = new FuncionarioController();

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $f = $controller->localizarFuncionario($_GET['id']);
    if(!$f) {
        header("Location: index_funcionario.php");
        exit();
    }
} else {
    header("Location: index_funcionario.php");
    exit();
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FuncionÃ¡rio: <?= $f->nome ?></title>
</head>
<body>

<a href="index_funcionario.php">Voltar</a>

<h1>#<?=$f->id?> - <?=$f->nome?></h1>
<p><strong>CPF: </strong><?= $f->cpf ?></p>
<p><strong>Telefone: </strong><?= $f->telefone ?></p>
<p><strong>Email: </strong><?= $f->email ?></p>
<p><strong>Endereço: </strong><?= $f->endereco ?></p>
<p><strong>Função: </strong><?= $f->funcao ?></p>
<p><strong>Login: </strong><?= $f->login ?></p>

</body>
</html>
