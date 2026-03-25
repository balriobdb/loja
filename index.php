<?php
include_once "objetos/ProdutoController.php";

$controller = new ProdutoController();
$produtos = $controller->index();
global $produtos;
$p = null;

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["pesquisar"]) && isset($_POST["tipo_pesquisa"])){
        $p = $controller->pesquisaProduto($_POST["pesquisar"], $_POST["tipo_pesquisa"]);
    }
}

if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(isset($_GET["excluir"])){
        $p = $controller->excluirProduto($_GET["excluir"]);
    }

    if(isset($_GET["alterar"])){
        $p = $controller->atualizarProduto($_GET["alterar"]);
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
    <label>Pesquisar produto: </label>
    <select name="tipo_pesquisa">
        <option value="nome">Nome</option>
        <option value="tipo">Tipo</option>
        <option value="marca">Marca</option>
    </select>
    <input type="text" name="pesquisar">
    <button>Pesquisar</button>
</form>


<?php if($p) : ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Marca</th>
            <th>Cor</th>
            <th>Tamanho</th>
            <th>Quantidade</th>
            <th>Preço</th>
        </tr>
        <?php foreach($p as $produto) : ?>
            <tr>
                <td><?= $produto->id_produto; ?></td>
                <td><?= $produto->nome_produto; ?></td>
                <td><?= $produto->tipo_produto; ?></td>
                <td><?= $produto->marca_produto; ?></td>
                <td><?= $produto->cor_produto; ?></td>
                <td><?= $produto->tamanho_produto; ?></td>
                <td><?= $produto->quantidade_produto; ?></td>
                <td><?= $produto->preco_produto; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>


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
                <td><a href="atualizar.php?alterar=<?= $produto->id_produto ?>">Alterar</a> </td>
                <td><a href="index.php?excluir=<?= $produto->id_produto ?>">Excluir</a> </td>
                <td><a href="ver-produto.php?id_produto=<?= $produto->id_produto ?>">Visualizar</a> </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

</body>
</html>
