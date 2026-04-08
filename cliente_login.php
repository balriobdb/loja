<?php
include_once "objetos/ClienteController.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ClienteController();
    if ($controller->login($_POST['email'], $_POST['senha'])) {
        header("Location: index.php");
        exit();
    } else {
        $erro = "E-mail ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login de Cliente - Balrio Loja</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .form-container { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #003366; }
        input { width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 0.8rem; background-color: #003366; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; margin-top: 1rem; }
        .error { color: red; text-align: center; }
        .success { color: green; text-align: center; }
        .link { text-align: center; margin-top: 1rem; display: block; color: #003366; text-decoration: none; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Login Cliente</h2>
    <?php if (isset($erro)) echo "<p class='error'>$erro</p>"; ?>
    <?php if (isset($_GET['success'])) echo "<p class='success'>Cadastro realizado! Faça login.</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
    <a href="cliente_cadastro.php" class="link">Não tem uma conta? Cadastre-se</a>
    <a href="index.php" class="link">Voltar para a loja</a>
</div>

</body>
</html>
