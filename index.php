<?php
include_once "objetos/ProdutoController.php";

$controller = new ProdutoController();
$produtos = $controller->index();
global $produtos;
$p = null;

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["pesquisar"])){
        $p = $controller->pesquisaProduto($_POST["pesquisar"]);
    }
}

?>

<!doctype html>
<html lang="pt-br" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loja de Roupas</title>
    <style>
        table, tr, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

<h1>Loja de Roupas</h1>

<!--Link da página Cadastro de Produto-->
<a href="cadastro.php">Cadastrar Produto</a>

<h3>Pesquisar Produto</h3>

<form method="POST" action="index.php">
    <label>ID_PRODUTO</label>
    <input typep="number" name="pesquisar">
    <button>Pesquisar</button>
</form>

<table>
    <tr>
        <td>ID_PRODUTO</td>
        <td>Nome_produto</td>
    </tr>

    <?php if($p) : ?>
        <!--        <?php //foreach($p as $produto) : ?> -->
        <tr>
            <td><?= $p->id_produto; ?></td>
            <td><?= $p->nome_produto; ?></td>
        </tr>
        <!--        --><?php //endforeach; ?>
    <?php endif; ?>

</table>

<table>

    <h2>Produtos Cadastrados</h2>

    <tr>
        <td>ID</td>
        <td>Nome</td>
        <td>Tipo</td>
        <td>Cor</td>
        <td>Tamanho</td>
        <td>Marca</td>
        <td>Quantidade</td>
        <td>Preço</td>
    </tr>
    <?php if($produtos) : ?>
        <?php foreach($produtos as $produto) : ?>
            <tr>
                <td><?php echo $produto->id_produto; ?></td>
                <td><?php echo $produto->nome_produto; ?></td>
                <td><?php echo $produto->tipo_produto; ?></td>
                <td><?php echo $produto->cor_produto; ?></td>
                <td><?php echo $produto->tamanho_produto; ?></td>
                <td><?php echo $produto->marca_produto; ?></td>
                <td><?php echo $produto->quantidade_produto; ?></td>
                <td><?php echo "R$ " . number_format($produto->preco_produto, 2, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

</body>
</html>
