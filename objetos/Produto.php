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
    public $imagem_produto;
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

    public function pesquisaProduto($valor, $tipo){
        if($tipo === "nome"){
            $sql = "SELECT * FROM produtos WHERE nome_produto LIKE :valor";
            $valor = "%".$valor."%";
        } elseif($tipo === "tipo"){
            $sql = "SELECT * FROM produtos WHERE tipo_produto LIKE :valor";
            $valor = "%".$valor."%";
        } elseif($tipo === "marca"){
            $sql = "SELECT * FROM produtos WHERE marca_produto LIKE :valor";
            $valor = "%".$valor."%";
        }

        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(":valor", $valor);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_OBJ); // pode retornar vários produtos
    }


    public function cadastrar(){
        $sql = "INSERT INTO produtos(nome_produto, tipo_produto, cor_produto, tamanho_produto,
                marca_produto, quantidade_produto, preco_produto, imagem_produto) VALUES(:nome_produto, :tipo_produto, :cor_produto,
                :tamanho_produto, :marca_produto, :quantidade_produto, :preco_produto, :imagem_produto)";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":nome_produto", $this->nome_produto, PDO::PARAM_STR);
        $stmt->bindParam(":tipo_produto", $this->tipo_produto, PDO::PARAM_STR);
        $stmt->bindParam(":cor_produto", $this->cor_produto, PDO::PARAM_STR);
        $stmt->bindParam(":tamanho_produto", $this->tamanho_produto, PDO::PARAM_STR);
        $stmt->bindParam(":marca_produto", $this->marca_produto, PDO::PARAM_STR);
        $stmt->bindParam(":quantidade_produto", $this->quantidade_produto, PDO::PARAM_STR);
        $stmt->bindParam(":preco_produto", $this->preco_produto, PDO::PARAM_STR);
        $stmt->bindParam(":imagem_produto", $this->imagem_produto, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function excluir(){
        $sql = "DELETE FROM produtos WHERE id_produto = :id_produto";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id_produto", $this->id_produto, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function atualizar(){
        $sql = "UPDATE produtos 
            SET nome_produto = :nome_produto, 
                tipo_produto = :tipo_produto, 
                cor_produto = :cor_produto, 
                tamanho_produto = :tamanho_produto, 
                marca_produto = :marca_produto, 
                quantidade_produto = :quantidade_produto, 
                preco_produto = :preco_produto,
                imagem_produto = :imagem_produto
            WHERE id_produto = :id_produto";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":nome_produto", $this->nome_produto, PDO::PARAM_STR);
        $stmt->bindParam(":tipo_produto", $this->tipo_produto, PDO::PARAM_STR);
        $stmt->bindParam(":cor_produto", $this->cor_produto, PDO::PARAM_STR);
        $stmt->bindParam(":tamanho_produto", $this->tamanho_produto, PDO::PARAM_STR);
        $stmt->bindParam(":marca_produto", $this->marca_produto, PDO::PARAM_STR);
        $stmt->bindParam(":quantidade_produto", $this->quantidade_produto, PDO::PARAM_INT);
        $stmt->bindParam(":preco_produto", $this->preco_produto, PDO::PARAM_STR);
        $stmt->bindParam(":id_produto", $this->id_produto, PDO::PARAM_INT);
        $stmt->bindParam(":imagem_produto", $this->imagem_produto, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function buscaProduto($id_produto){
        $sql = "SELECT * FROM produtos WHERE id_produto = :id_produto";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(":id_produto", $id_produto, PDO::PARAM_INT);
        $resultado->execute();

        return $resultado->fetch(PDO::FETCH_OBJ);
    }

}