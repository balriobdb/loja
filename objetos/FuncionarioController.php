<?php

include_once "configs/database.php";
include_once "funcionario.php";

Class FuncionarioController{
    private $bd;
    private $funcionario;

    public function __construct(){
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->funcionario = new Funcionario($this->bd);
    }

    public function index(){
        return $this->funcionario->LerTodos();
    }

    public function pesquisaFuncionario($id){
        return $this->funcionario->pesquisaFuncionario($id);
    }

    public function cadastrarFuncionario($dados){
        $this->funcionario->cpf = $dados["cpf"];
        $this->funcionario->nome = $dados["nome"];
        $this->funcionario->email = $dados["email"];
        $this->funcionario->endereco = $dados["endereco"];
        $this->funcionario->telefone = $dados["telefone"];
        $this->funcionario->funcao = $dados["funcao"];
        $this->funcionario->login = $dados["login"];
        $this->funcionario->senha = $dados["senha"];

        if($this->funcionario->cadastrar()){
            header("location: index_funcionario.php");
            exit();
        }
    }

    public function excluirFuncionario($id){
        $this->funcionario->id = $id;

        if($this->funcionario->excluir()){
            header("location: index_funcionario.php");
        }
    }

    public function atualizarFuncionario($dados){
        $this->funcionario->id = $dados["id"];
        $this->funcionario->cpf = $dados["cpf"];
        $this->funcionario->nome = $dados["nome"];
        $this->funcionario->email = $dados["email"];
        $this->funcionario->endereco = $dados["endereco"];
        $this->funcionario->telefone = $dados["telefone"];
        $this->funcionario->funcao = $dados["funcao"];
        $this->funcionario->login = $dados["login"];
        $this->funcionario->senha = $dados["senha"];

        if($this->funcionario->atualizar()){
            header("location: index_funcionario.php");
        }
    }

    public function localizarFuncionario($id){
        return $this->funcionario->buscaFuncionario($id);
    }

    public function login($login, $senha){
        $this->funcionario->login = $login;
        $this->funcionario->senha = $senha;
        $this->funcionario->login();
    }
}

