<?php
include_once("objetos/ProdutoController.php");

$controller = new ProdutoController();

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_produto'])){
    $p = $controller->localizarProduto($_GET['id_produto']);
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produto: <?= $p->nome_produto ?></title>
</head>
<body>

<a href="index.php">Voltar</a>

<h1>#<?=$p->id_produto?> - <?=$p->nome_produto?></h1>
<p><strong>Tipo: </strong><?= $p->tipo_produto ?></p>
<p><strong>Cor: </strong><?= $p->cor_produto ?></p>
<p><strong>Tamanho: </strong><?= $p->tamanho_produto ?></p>
<p><strong>Marca: </strong><?= $p->marca_produto ?></p>
<p><strong>Quantidade em estoque: </strong><?= $p->quantidade_produto ?></p>
<p><strong>Preço: </strong>R$ <?= number_format($p->preco_produto, 2, ',', '.') ?></p>

<?php if($p->imagem_produto == ""): ?>
    <img style="width: 20%;" src="imagens/image-fail.jpg" alt="Imagem não disponível">
<?php else: ?>
    <img style="width: 40%;" src="uploads/<?= $p->imagem_produto; ?>">
<?php endif; ?>

</body>
</html>
