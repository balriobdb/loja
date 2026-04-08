<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "objetos/ProdutoController.php";
$produtoController = new ProdutoController();
$produtos = $produtoController->index();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balrio Loja - Moda e Estilo</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f8f9fa; }
        header { background-color: #003366; color: white; padding: 1rem; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; text-decoration: none; margin-left: 1rem; }
        .container { padding: 2rem; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem; }
        .product-card { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; padding-bottom: 1rem; transition: transform 0.2s; }
        .product-card:hover { transform: translateY(-5px); }
        .product-card img { width: 100%; height: 200px; object-fit: cover; }
        .product-card h3 { margin: 0.5rem 0; font-size: 1.1rem; }
        .product-card p { color: #555; margin: 0.5rem 0; }
        .product-card .price { font-weight: bold; color: #003366; font-size: 1.2rem; }
        .btn { display: inline-block; padding: 0.5rem 1rem; border-radius: 4px; text-decoration: none; font-weight: bold; }
        .btn-view { background-color: #003366; color: white; }
    </style>
</head>
<body>

<header>
    <h1>Balrio Loja</h1>
    <nav>
        <a href="index.php">Início</a>
        <?php if (isset($_SESSION['cliente'])): ?>
            <span>Olá, <?= $_SESSION['cliente']->nome ?></span>
            <a href="carrinho.php">🛒 Carrinho</a>
            <a href="favoritos.php">⭐ Favoritos</a>
            <a href="cliente_logout.php">Sair</a>
        <?php else: ?>
            <a href="cliente_login.php">Entrar</a>
            <a href="cliente_cadastro.php">Cadastrar</a>
        <?php endif; ?>
        <a href="login_funcionario.php" style="font-size: 0.8rem; opacity: 0.7;">Painel Equipe</a>
    </nav>
</header>

<div class="container">
    <h2>Nossos Produtos</h2>
    <div class="product-grid">
        <?php foreach ($produtos as $p): ?>
            <div class="product-card">
                <?php if ($p->imagem_produto): ?>
                    <img src="uploads/<?= $p->imagem_produto ?>" alt="<?= $p->nome_produto ?>">
                <?php else: ?>
                    <img src="imagens/image-fail.jpg" alt="Sem imagem">
                <?php endif; ?>
                <h3><?= $p->nome_produto ?></h3>
                <p><?= $p->marca_produto ?> - <?= $p->tamanho_produto ?></p>
                <p class="price">R$ <?= number_format($p->preco_produto, 2, ',', '.') ?></p>
                <a href="loja_ver_produto.php?id=<?= $p->id_produto ?>" class="btn btn-view">Ver Detalhes</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>