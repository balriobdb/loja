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
}
