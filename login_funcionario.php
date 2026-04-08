<?php
include_once "objetos/FuncionarioController.php";

$error_msg = "";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST["login"]) && isset($_POST["senha"])){
        $controller = new FuncionarioController();
        $controller->login($_POST["login"], $_POST["senha"]);
    }
}

if(isset($_GET['error'])){
    if($_GET['error'] == 'senha') $error_msg = "Senha incorreta!";
    if($_GET['error'] == 'usuario') $error_msg = "UsuÃ¡rio nÃ£o encontrado!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Balrio Loja</title>
</head>
<body>
    <h1>Login do Sistema</h1>

    <?php if ($error_msg): ?>
        <p style="color: red;"><?php echo $error_msg; ?></p>
    <?php endif; ?>

    <form action="login_funcionario.php" method="POST">
        <div>
            <label for="login">Login:</label>
            <input type="text" name="login" id="login" required>
        </div>
        <br>
        <div>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>
        </div>
        <br>
        <button type="submit">Entrar</button>
    </form>

    <p><a href="index_produto.php">Voltar para a Loja</a></p>
</body>
</html>

