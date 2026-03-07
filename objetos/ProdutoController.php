<?php

include_once "configs/database.php";
include_once "Produto.php";

Class ProdutoController {
    private $bd;
    private $produto;

    public function __construct(){
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->produto = new Produto($this->bd);
    }

    public function index(){
        return $this->produto->LerTodos();
    }

    public function pesquisaProduto($valor, $tipo){
        return $this->produto->pesquisaProduto($valor, $tipo);
    }

    public function cadastrarProduto($dados){

        $this->produto->nome_produto = $dados["nome_produto"];
        $this->produto->tipo_produto = $dados["tipo_produto"];
        $this->produto->cor_produto = $dados["cor_produto"];
        $this->produto->tamanho_produto = $dados["tamanho_produto"];
        $this->produto->marca_produto = $dados["marca_produto"];
        $this->produto->quantidade_produto = $dados["quantidade_produto"];
        $this->produto->preco_produto = $dados["preco_produto"];

        if($this->produto->Cadastrar()){
            header("location: index.php");
            exit();
        }
    }

    public function atualizarProduto($dados){
        $this->produto->id_produto = $dados["id_produto"];
        $this->produto->nome_produto = $dados["nome_produto"];
        $this->produto->tipo_produto = $dados["tipo_produto"];
        $this->produto->cor_produto = $dados["cor_produto"];
        $this->produto->tamanho_produto = $dados["tamanho_produto"];
        $this->produto->marca_produto = $dados["marca_produto"];
        $this->produto->quantidade_produto = $dados["quantidade_produto"];
        $this->produto->preco_produto = $dados["preco_produto"];

        if($this->produto->Atualizar()){
            header("location: index.php");
        }
    }

    public function excluirProduto($id_produto){
        $this->produto->id_produto = $id_produto;

        if($this->produto->Excluir()){
            header("location: index.php");
        }
    }

    public function localizarProduto($id_produto){
        return $this->produto->buscaProduto($id_produto);

    }
}

