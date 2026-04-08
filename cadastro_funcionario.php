<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["funcionario"]) || $_SESSION["funcionario"]->funcao !== "Administrador") {
    header("Location: login_funcionario.php");
    exit();
}

include_once ("objetos/FuncionarioController.php");

if($_SERVER["REQUEST_METHOD"] === 'POST'){
    $controller = new FuncionarioController();
    if (isset($_POST["cadastrar"])){
        $controller->cadastrarFuncionario($_POST["funcionario"]);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário - Balrio</title>
</head>
<body>
    <p><a href="index_funcionario.php">Voltar para a Página Inicial</a></p>
    
    <h1>Novo Funcionário</h1>

    <form action="cadastro_funcionario.php" method="POST">
        <div>
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="funcionario[nome]" required>
        </div>
        <br>
        <div>
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="funcionario[cpf]" required>
        </div>
        <br>
        <div>
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="funcionario[telefone]">
        </div>
        <br>
        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="funcionario[email]" required>
        </div>
        <br>
        <div>
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="funcionario[endereco]">
        </div>
        <br>
        <div>
            <label for="login">Login:</label>
            <input type="text" id="login" name="funcionario[login]" required>
        </div>
        <br>
        <div>
            <label for="funcao">Função:</label>
            <select id="funcao" name="funcionario[funcao]">
                <option value="Administrador">Administrador</option>
                <option value="Funcionario" selected>Funcionário comum</option>
            </select>
        </div>
        <br>
        <div>
            <label for="senha">Senha Temporária:</label>
            <input type="password" id="senha" name="funcionario[senha]" required>
        </div>
        <br>
        <button type="submit" name="cadastrar">Cadastrar</button>
    </form>
</body>
</html>

