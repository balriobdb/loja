<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cliente'])) {
    header("Location: cliente_login.php");
    exit();
}

include_once "objetos/ClienteController.php";
$controller = new ClienteController();

if (isset($_GET['remover'])) {
    $controller->removerFavorito($_SESSION['cliente']->id, $_GET['remover']);
    header("Location: favoritos.php");
    exit();
}

$favoritos = $controller->listarFavoritos($_SESSION['cliente']->id);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meus Favoritos - Balrio Loja</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f8f9fa; }
        header { background-color: #003366; color: white; padding: 1rem; text-align: center; }
        .container { padding: 2rem; max-width: 800px; margin: auto; }
        .fav-list { display: flex; flex-direction: column; gap: 1rem; }
        .fav-item { background: white; padding: 1rem; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
        .fav-info h3 { margin: 0; }
        .btn-view { color: #003366; text-decoration: none; font-weight: bold; }
        .btn-remove { color: red; text-decoration: none; font-size: 0.9rem; margin-left: 1rem; }
        .back-link { display: block; margin-top: 1rem; color: #003366; text-decoration: none; }
    </style>
</head>
<body>

<header>
    <h1>⭐ Meus Favoritos</h1>
</header>

<div class="container">
    <div class="fav-list">
        <?php foreach ($favoritos as $fav): ?>
            <div class="fav-item">
                <div class="fav-info">
                    <h3><?= $fav->nome_produto ?></h3>
                    <p>R$ <?= number_format($fav->preco_produto, 2, ',', '.') ?></p>
                </div>
                <div>
                    <a href="loja_ver_produto.php?id=<?= $fav->id_produto ?>" class="btn-view">Ver Produto</a>
                    <a href="favoritos.php?remover=<?= $fav->id_produto ?>" class="btn-remove">Remover</a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (empty($favoritos)) echo "<p>Nenhum produto favoritado ainda.</p>"; ?>
    </div>
    
    <a href="index.php" class="back-link">← Voltar para a loja</a>
</div>

</body>
</html>
