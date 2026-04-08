<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["funcionario"])) {
    header("Location: login_funcionario.php");
    exit();
}

include_once ("objetos/ProdutoController.php");

if($_SERVER["REQUEST_METHOD"] === 'POST'){
    $controller = new ProdutoController();

    if (isset($_POST["cadastrar"])){
        $a = $controller->cadastrarProduto($_POST["produto"], $_FILES["produto"]);
    }
}

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Produto</title>
</head>
<body>

<h1>Cadastro de Produto</h1>

<a href="index_produto.php">Voltar</a>

<form action="cadastro_produto.php" method="post" enctype="multipart/form-data">
    <label>Nome do Produto</label>
    <input type="text" name="produto[nome_produto]"><br><br>

    <label>Tipo</label>
    <input type="text" name="produto[tipo_produto]"><br><br>

    <label>Cor</label>
    <input type="text" name="produto[cor_produto]"><br><br>

    <label>Tamanho</label>
    <input type="text" name="produto[tamanho_produto]"><br><br>

    <label>Marca</label>
    <input type="text" name="produto[marca_produto]"><br><br>

    <label>Quantidade</label>
    <input type="number" name="produto[quantidade_produto]"><br><br>

    <label>PreÃ§o</label>
    <input type="text" name="produto[preco_produto]"><br><br>

    <label for="fileTopUpload">Selecionar Foto</label>
    <input type="file" name="produto[fileToUpload]" id="fileTopUpload"><br><br>

    <button name="cadastrar">Cadastrar Produto</button>
</form>
</body>
</html>

