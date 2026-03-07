<?php
include_once ("objetos/ProdutoController.php");

$controller = new ProdutoController();

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['alterar'])){
    $p = $controller->localizarProduto($_GET['alterar']);
}elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto'])){
    $p = $controller->atualizarProduto($_POST['produto']);
}else{
    header("location: index.php");
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

<h1>Atualização de produtos</h1>

<a href="index.php">Voltar</a>

<form action="atualizar.php" method="post">
    <input type="text" name="produto[id_produto]" value="<?= $p->id_produto ?>" hidden>

    <label>Nome do Produto</label>
    <input type="text" name="produto[nome_produto]" value="<?= $p->nome_produto ?>"><br><br>

    <label>Tipo</label>
    <input type="text" name="produto[tipo_produto]" value="<?= $p->tipo_produto ?>"><br><br>

    <label>Cor</label>
    <input type="text" name="produto[cor_produto]" value="<?= $p->cor_produto ?>"><br><br>

    <label>Tamanho</label>
    <input type="text" name="produto[tamanho_produto]" value="<?= $p->tamanho_produto ?>"><br><br>

    <label>Marca</label>
    <input type="text" name="produto[marca_produto]" value="<?= $p->marca_produto ?>"><br><br>

    <label>Quantidade</label>
    <input type="number" name="produto[quantidade_produto]" value="<?= $p->quantidade_produto ?>"><br><br>

    <label>Preço</label>
    <input type="text" name="produto[preco_produto]" value="<?= $p->preco_produto ?>"><br><br>

    <button name="atualizar">Atualizar Produto</button>
</form>

</body>
</html>