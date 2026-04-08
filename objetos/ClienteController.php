<?php
include_once "configs/database.php";
include_once "Cliente.php";

Class ClienteController {
    private $bd;
    private $cliente;

    public function __construct() {
        $database = new Database();
        $this->bd = $database->conectar();
        $this->cliente = new Cliente($this->bd);
    }

    public function cadastrar($dados) {
        $this->cliente->cpf = $dados['cpf'];
        $this->cliente->nome = $dados['nome'];
        $this->cliente->email = $dados['email'];
        $this->cliente->endereco = $dados['endereco'];
        $this->cliente->telefone = $dados['telefone'];
        $this->cliente->senha = $dados['senha'];

        if ($this->cliente->cadastrar()) {
            return true;
        }
        return false;
    }

    public function login($email, $senha) {
        $this->cliente->email = $email;
        $this->cliente->senha = $senha;
        $usuario = $this->cliente->login();
        if ($usuario) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['cliente'] = $usuario;
            return true;
        }
        return false;
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['cliente']);
        session_destroy();
    }

    public function adicionarCarrinho($id_cliente, $id_produto, $quantidade = 1) {
        $sql = "INSERT INTO carrinho (id_cliente, id_produto, quantidade) VALUES (:idc, :idp, :q)";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":idc", $id_cliente);
        $stmt->bindParam(":idp", $id_produto);
        $stmt->bindParam(":q", $quantidade);
        return $stmt->execute();
    }

    public function listarCarrinho($id_cliente) {
        $sql = "SELECT c.*, p.nome_produto, p.preco_produto, p.imagem_produto 
                FROM carrinho c 
                JOIN produtos p ON c.id_produto = p.id_produto 
                WHERE c.id_cliente = :idc";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":idc", $id_cliente);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function removerCarrinho($id_item) {
        $sql = "DELETE FROM carrinho WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $id_item);
        return $stmt->execute();
    }

    public function adicionarFavorito($id_cliente, $id_produto) {
        $sql = "INSERT INTO favoritos (id_cliente, id_produto) VALUES (:idc, :idp)";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":idc", $id_cliente);
        $stmt->bindParam(":idp", $id_produto);
        return $stmt->execute();
    }

    public function listarFavoritos($id_cliente) {
        $sql = "SELECT f.*, p.nome_produto, p.preco_produto, p.imagem_produto 
                FROM favoritos f 
                JOIN produtos p ON f.id_produto = p.id_produto 
                WHERE f.id_cliente = :idc";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":idc", $id_cliente);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function removerFavorito($id_cliente, $id_produto) {
        $sql = "DELETE FROM favoritos WHERE id_cliente = :idc AND id_produto = :idp";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":idc", $id_cliente);
        $stmt->bindParam(":idp", $id_produto);
        return $stmt->execute();
    }
}
?>