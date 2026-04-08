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

<!--Link da pÃ¡gina Cadastro de Produto-->
<!-- Ferramentas Administrativas -->
<div style="background: #f1f5f9; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
    <p>Bem-vindo, <strong><?= $_SESSION["funcionario"]->nome ?></strong> (<?= $_SESSION["funcionario"]->funcao ?>)</p>
    <div style="display: flex; gap: 1rem; align-items: center;">
        <a href="cadastro_produto.php">Cadastrar Produto</a>
        <a href="arquivados_produto.php">Ver Arquivados</a>
        
        <?php if ($_SESSION["funcionario"]->funcao === "Administrador") : ?>
            <a href="index_funcionario.php">Gerenciar Funcionários</a>
        <?php endif; ?>
        
        <a href="logout.php" style="color: #ef4444; margin-left: auto; font-weight: bold;">Sair</a>
    </div>
</div>

<h3>Pesquisar Produto</h3>

<form method="POST" action="index_produto.php">
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
                <td><a href="alterar_produto.php?id_produto=<?= $produto->id_produto ?>">Alterar</a> </td>
                <td><a href="index_produto.php?excluir=<?= $produto->id_produto ?>" 
                       onclick="return confirm('Este produto será arquivado. Deseja continuar?')">Arquivar</a> </td>
                <td><a href="ver_produto.php?id_produto=<?= $produto->id_produto ?>">Visualizar</a> </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

</body>
</html>