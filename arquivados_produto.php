<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["funcionario"])) {
    header("Location: login_funcionario.php");
    exit();
}

include_once "objetos/ProdutoController.php";

$controller = new ProdutoController();

if (isset($_GET["restaurar"])) {
    $controller->restaurarProduto($_GET["restaurar"]);
}

$produtos_arquivados = $controller->indexArquivados();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Arquivados - Balrio Loja</title>
    <style>
        table, tr, td, th {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Produtos Arquivados</h1>
    <p><a href="index_produto.php">Voltar para a Loja</a></p>

    <?php if ($produtos_arquivados) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Cor</th>
                    <th>Tamanho</th>
                    <th>Marca</th>
                    <th>Preço</th>
                    <th>Data/Hora Arquivamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos_arquivados as $p) : ?>
                    <tr>
                        <td><?= $p->id_produto ?></td>
                        <td><?= $p->nome_produto ?></td>
                        <td><?= $p->tipo_produto ?></td>
                        <td><?= $p->cor_produto ?></td>
                        <td><?= $p->tamanho_produto ?></td>
                        <td><?= $p->marca_produto ?></td>
                        <td>R$ <?= number_format($p->preco_produto, 2, ',', '.') ?></td>
                        <td><?= date("d/m/Y H:i:s", strtotime($p->data_arquivamento)) ?></td>
                        <td>
                            <a href="arquivados_produto.php?restaurar=<?= $p->id_produto ?>" 
                               onclick="return confirm('Deseja realmente restaurar este produto?')">Restaurar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Não há produtos arquivados no momento.</p>
    <?php endif; ?>
</body>
</html>

