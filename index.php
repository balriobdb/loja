<?php
include_once "objetos/ProdutoController.php";

$controller = new ProdutoController();
$produtos = $controller->index();
global $produtos;

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Senac Rio Claro</title>
</head>
<body>

<h1>Loja de Roupas</h1>
<h2>Produtos Cadastrados</h2>

<table>

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
