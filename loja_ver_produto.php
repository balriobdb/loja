<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "objetos/ProdutoController.php";
include_once "objetos/ClienteController.php";

$produtoController = new ProdutoController();
$clienteController = new ClienteController();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$p = $produtoController->localizarProduto($_GET['id']);

if (!$p) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['cliente'])) {
        header("Location: cliente_login.php");
        exit();
    }

    if (isset($_POST['add_carrinho'])) {
        $clienteController->adicionarCarrinho($_SESSION['cliente']->id, $p->id_produto);
        header("Location: carrinho.php");
        exit();
    }

    if (isset($_POST['add_favorito'])) {
        $clienteController->adicionarFavorito($_SESSION['cliente']->id, $p->id_produto);
        header("Location: favoritos.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $p->nome_produto ?> - Balrio Loja</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f8f9fa; }
        header { background-color: #003366; color: white; padding: 1rem; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; text-decoration: none; margin-left: 1rem; }
        .container { padding: 2rem; max-width: 900px; margin: auto; display: flex; gap: 2rem; background: white; margin-top: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .product-image { flex: 1; }
        .product-image img { width: 100%; border-radius: 8px; }
        .product-info { flex: 1; display: flex; flex-direction: column; justify-content: center; }
        .price { font-size: 2rem; color: #003366; font-weight: bold; margin: 1rem 0; }
        .btn { padding: 1rem; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; margin-bottom: 1rem; text-align: center; text-decoration: none; }
        .btn-cart { background-color: #28a745; color: white; }
        .btn-fav { background-color: #ffc107; color: black; }
        .back-link { display: block; margin-top: 1rem; color: #003366; text-decoration: none; }
    </style>
</head>
<body>

<header>
    <h1>Balrio Loja</h1>
    <nav>
        <a href="index.php">Início</a>
        <?php if (isset($_SESSION['cliente'])): ?>
            <a href="carrinho.php">🛒 Carrinho</a>
            <a href="favoritos.php">⭐ Favoritos</a>
        <?php endif; ?>
    </nav>
</header>

<div class="container">
    <div class="product-image">
        <?php if ($p->imagem_produto): ?>
            <img src="uploads/<?= $p->imagem_produto ?>" alt="<?= $p->nome_produto ?>">
        <?php else: ?>
            <img src="imagens/image-fail.jpg" alt="Sem imagem">
        <?php endif; ?>
    </div>
    <div class="product-info">
        <h1><?= $p->nome_produto ?></h1>
        <p><strong>Marca:</strong> <?= $p->marca_produto ?></p>
        <p><strong>Tipo:</strong> <?= $p->tipo_produto ?></p>
        <p><strong>Cor:</strong> <?= $p->cor_produto ?></p>
        <p><strong>Tamanho:</strong> <?= $p->tamanho_produto ?></p>
        <p class="price">R$ <?= number_format($p->preco_produto, 2, ',', '.') ?></p>
        
        <form method="POST">
            <button type="submit" name="add_carrinho" class="btn btn-cart">Adicionar ao Carrinho</button>
            <button type="submit" name="add_favorito" class="btn btn-fav">Favoritar</button>
        </form>
        
        <a href="index.php" class="back-link">← Voltar para a loja</a>
    </div>
</div>

</body>
</html>
