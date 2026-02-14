<?php

include_once "configs/database.php";
include_once "Produto.php";

Class ProdutoController {
    private $bd;
    private $produto;

    public function __construct(){
        // Cria a conexão com o banco de dados
        $banco = new Database();
        $this->bd = $banco->conectar();

        // Instancia o objeto Produto passando a conexão
        $this->produto = new Produto($this->bd);
    }

    // Método principal que retorna todos os produtos
    public function index(){
        return $this->produto->LerTodos();
    }
}

