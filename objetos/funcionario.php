<?php

Class Funcionario{
    public $id;
    public $cpf;
    public $nome;
    public $email;
    public $endereco;
    public $telefone;
    public $funcao;
    public $login;
    public $senha;
    public $bd;

    public function __construct($bd){
        $this->bd = $bd;
    }

    public function LerTodos(){
        $sql = "SELECT * FROM funcionarios";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

    public function pesquisaFuncionario($id){
        $sql = "SELECT * FROM funcionarios WHERE id = :id";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(":id", $id);
        $resultado->execute();

        return $resultado->fetch(PDO::FETCH_OBJ);
    }

    public function cadastrar(){
        $sql = "INSERT INTO funcionarios(cpf, nome, email, endereco, telefone, funcao, login, senha) 
                VALUES(:cpf, :nome, :email, :endereco, :telefone, :funcao, :login, :senha)";

        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
        $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
        $stmt->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(":funcao", $this->funcao, PDO::PARAM_STR);
        $stmt->bindParam(":login", $this->login, PDO::PARAM_STR);
        $stmt->bindParam(":senha", $senha_hash, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function excluir(){
        $sql = "DELETE FROM funcionarios WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }else {
            return false;
        }
    }

    public function atualizar(){
        $sql = "UPDATE funcionarios SET 
                cpf = :cpf, 
                nome = :nome, 
                email = :email, 
                endereco = :endereco, 
                telefone = :telefone, 
                funcao = :funcao, 
                login = :login, 
                senha = :senha 
                WHERE id = :id";
        
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
        $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
        $stmt->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(":funcao", $this->funcao, PDO::PARAM_STR);
        $stmt->bindParam(":login", $this->login, PDO::PARAM_STR);
        $stmt->bindParam(":senha", $senha_hash, PDO::PARAM_STR);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function buscaFuncionario($id){
        $sql = "SELECT * FROM funcionarios WHERE id = :id";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(":id", $id);
        $resultado->execute();

        return $resultado->fetch(PDO::FETCH_OBJ);
    }

    public function login()
    {
        $sql = "SELECT * FROM funcionarios WHERE login = :login";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":login", $this->login, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_OBJ);

        if($resultado){
            if(password_verify($this->senha, $resultado->senha)){
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION["funcionario"] = $resultado;
                
                // Redirect all to index_produto.php (unified dashboard)
                header("Location: index_produto.php");
                exit();
            } else{
                header("Location: login_funcionario.php?error=senha");
                exit();
            }
        } else {
            header("Location: login_funcionario.php?error=usuario");
            exit();
        }
    }
}

