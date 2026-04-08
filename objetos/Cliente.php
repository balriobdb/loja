<?php

Class Cliente {
    public $id;
    public $cpf;
    public $nome;
    public $email;
    public $endereco;
    public $telefone;
    public $senha;
    private $bd;

    public function __construct($bd) {
        $this->bd = $bd;
    }

    public function cadastrar() {
        $sql = "INSERT INTO clientes (cpf, nome, email, endereco, telefone, senha) 
                VALUES (:cpf, :nome, :email, :endereco, :telefone, :senha)";
        $stmt = $this->bd->prepare($sql);
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":senha", $senha_hash);
        return $stmt->execute();
    }

    public function login() {
        $sql = "SELECT * FROM clientes WHERE email = :email";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_OBJ);

        if ($resultado && password_verify($this->senha, $resultado->senha)) {
            return $resultado;
        }
        return false;
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM clientes WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function atualizar() {
        $sql = "UPDATE clientes SET cpf = :cpf, nome = :nome, email = :email, endereco = :endereco, telefone = :telefone 
                WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    public function listarTodos() {
        $sql = "SELECT * FROM clientes";
        $resultado = $this->bd->query($sql);
        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
