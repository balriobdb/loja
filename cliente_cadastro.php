<?php
include_once "objetos/ClienteController.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ClienteController();
    if ($controller->cadastrar($_POST['cliente'])) {
        header("Location: cliente_login.php?success=1");
        exit();
    } else {
        $erro = "Erro ao cadastrar. Verifique os dados.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Cliente - Balrio Loja</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .form-container { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #003366; }
        input { width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 0.8rem; background-color: #003366; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; margin-top: 1rem; }
        .error { color: red; text-align: center; }
        .link { text-align: center; margin-top: 1rem; display: block; color: #003366; text-decoration: none; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Criar Conta</h2>
    <?php if (isset($erro)) echo "<p class='error'>$erro</p>"; ?>
    <form method="POST">
        <input type="text" name="cliente[nome]" placeholder="Nome Completo" required>
        <input type="text" name="cliente[cpf]" placeholder="CPF" required>
        <input type="email" name="cliente[email]" placeholder="E-mail" required>
        <input type="text" name="cliente[telefone]" placeholder="Telefone">
        <input type="text" name="cliente[endereco]" placeholder="Endereço">
        <input type="password" name="cliente[senha]" placeholder="Senha" required>
        <button type="submit">Cadastrar</button>
    </form>
    <a href="cliente_login.php" class="link">Já tem uma conta? Entre aqui</a>
    <a href="index.php" class="link">Voltar para a loja</a>
</div>

</body>
</html>
