<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["funcionario"]) || $_SESSION["funcionario"]->funcao !== "Administrador") {
    header("Location: index_produto.php");
    exit();
}

include_once ("objetos/FuncionarioController.php");

$controller = new FuncionarioController();

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['alterar'])){
    $a = $controller->localizarFuncionario($_GET['alterar']);
}elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['funcionario'])){
    $a = $controller->atualizarFuncionario($_POST['funcionario']);
}else{
    header("location: index_funcionario.php");
}

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alterar Funcionário</title>
</head>
<body>

<h1>Atualização de Funcionário</h1>

<a href="index_funcionario.php">Voltar</a>

<form action="alterar_funcionario.php" method="POST">
    <input type="hidden" name="funcionario[id]" value="<?= $f->id ?>">
    
    <div>
        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" name="funcionario[nome]" value="<?= $f->nome ?>" required>
    </div>
    <br>
    <div>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="funcionario[cpf]" value="<?= $f->cpf ?>" required>
    </div>
    <br>
    <div>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="funcionario[telefone]" value="<?= $f->telefone ?>">
    </div>
    <br>
    <div>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="funcionario[email]" value="<?= $f->email ?>" required>
    </div>
    <br>
    <div>
        <label for="endereco">EndereÃ§o:</label>
        <input type="text" id="endereco" name="funcionario[endereco]" value="<?= $f->endereco ?>">
    </div>
    <br>
    <div>
        <label for="login">Login:</label>
        <input type="text" id="login" name="funcionario[login]" value="<?= $f->login ?>" required>
    </div>
    <br>
    <div>
        <label for="funcao">Função:</label>
        <select id="funcao" name="funcionario[funcao]">
            <option value="Administrador" <?= $f->funcao == 'Administrador' ? 'selected' : '' ?>>Administrador</option>
            <option value="Funcionario" <?= $f->funcao == 'Funcionario' ? 'selected' : '' ?>>Funcionário comum</option>
        </select>
    </div>
    <br>
    <div>
        <label for="senha">Nova Senha:</label>
        <input type="password" id="senha" name="funcionario[senha]" required>
    </div>
    <br>
    <button type="submit" name="atualizar">Atualizar</button>
</form>

</body>
</html>
