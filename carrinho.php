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
    $controller->removerCarrinho($_GET['remover']);
    header("Location: carrinho.php");
    exit();
}

$itens = $controller->listarCarrinho($_SESSION['cliente']->id);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho - Balrio Loja</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f8f9fa; }
        header { background-color: #003366; color: white; padding: 1rem; text-align: center; }
        .container { padding: 2rem; max-width: 800px; margin: auto; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        th, td { padding: 1rem; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #003366; color: white; }
        .btn-remove { color: red; text-decoration: none; font-weight: bold; }
        .total { text-align: right; font-size: 1.5rem; margin-top: 1rem; font-weight: bold; }
        .back-link { display: block; margin-top: 1rem; color: #003366; text-decoration: none; }
    </style>
</head>
<body>

<header>
    <h1>🛒 Meu Carrinho</h1>
</header>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Qtd</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total = 0;
            foreach ($itens as $item): 
                $total += $item->preco_produto * $item->quantidade;
            ?>
                <tr>
                    <td><?= $item->nome_produto ?></td>
                    <td>R$ <?= number_format($item->preco_produto, 2, ',', '.') ?></td>
                    <td><?= $item->quantidade ?></td>
                    <td><a href="carrinho.php?remover=<?= $item->id ?>" class="btn-remove">Remover</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="total">Total: R$ <?= number_format($total, 2, ',', '.') ?></div>
    
    <a href="index.php" class="back-link">← Continuar comprando</a>
</div>

</body>
</html>
