<?php
Class Produto {
    public $id_produto;
    public $nome_produto;
    public $tipo_produto;
    public $cor_produto;
    public $tamanho_produto;
    public $marca_produto;
    public $quantidade_produto;
    public $preco_produto;
    public $bd;
    public function __construct($bd){
        $this->bd = $bd;
    }

    public function LerTodos(){
        $sql = "SELECT * FROM produtos";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

    public function pesquisaProduto($id_produto){
        $sql = "SELECT * FROM produtos WHERE ID_PRODUTO = :id_produto";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(":id_produto", $id_produto);
        $resultado->execute();

        return $resultado->fetch(PDO::FETCH_OBJ);
    }

    public function cadastrar(){
        $sql = "INSERT INTO produtos(nome_produto, tipo_produto, cor_produto, tamanho_produto,
                marca_produto, quantidade_produto, preco_produto) VALUES(:nome_produto, :tipo_produto, :cor_produto,
                :tamanho_produto, :marca_produto, :quantidade_produto, :preco_produto)";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":nome_produto", $this->nome_produto, PDO::PARAM_STR);
        $stmt->bindParam(":tipo_produto", $this->tipo_produto, PDO::PARAM_STR);
        $stmt->bindParam(":cor_produto", $this->cor_produto, PDO::PARAM_STR);
        $stmt->bindParam(":tamanho_produto", $this->tamanho_produto, PDO::PARAM_STR);
        $stmt->bindParam(":marca_produto", $this->marca_produto, PDO::PARAM_STR);
        $stmt->bindParam(":quantidade_produto", $this->quantidade_produto, PDO::PARAM_STR);
        $stmt->bindParam(":preco_produto", $this->preco_produto, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
}
