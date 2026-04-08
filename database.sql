-- Script de modelagem do banco de dados para o sistema Balrio Loja

CREATE DATABASE IF NOT EXISTS db_loja;
USE db_loja;

-- Tabela de Funcionários
CREATE TABLE IF NOT EXISTS funcionarios (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(30) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    funcao VARCHAR(20) NOT NULL,
    login VARCHAR(20) NOT NULL,
    senha VARCHAR(255)
);

-- Tabela de Produtos
CREATE TABLE IF NOT EXISTS produtos (
    id_produto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(100) NOT NULL,
    tipo_produto VARCHAR(50) NOT NULL,
    cor_produto VARCHAR(30) NOT NULL,
    tamanho_produto VARCHAR(10) NOT NULL,
    marca_produto VARCHAR(50) NOT NULL,
    quantidade_produto INT NOT NULL,
    preco_produto DECIMAL(10,2) NOT NULL,
    imagem_produto VARCHAR(255),
    arquivado TINYINT(1) DEFAULT 0,
    data_arquivamento DATETIME DEFAULT NULL
);

-- Tabela de Clientes
CREATE TABLE IF NOT EXISTS clientes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    endereco VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de Carrinho
CREATE TABLE IF NOT EXISTS carrinho (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_produto INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id) ON DELETE CASCADE,
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto) ON DELETE CASCADE
);

-- Tabela de Favoritos
CREATE TABLE IF NOT EXISTS favoritos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_produto INT NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id) ON DELETE CASCADE,
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto) ON DELETE CASCADE
);

-- Inserindo Administrador Master
-- Login: admin
-- Senha: 123456
INSERT INTO funcionarios (cpf, nome, email, endereço, telefone, funcao, login, senha) 
VALUES ('000.000.000-00', 'Administrador Master', 'admin@loja.com', 'Sede Balrio', '00-0000-0000', 'Administrador', 'admin', '$2y$10$RU1r7xCHx//WNJeNYxq51e2onBJCZ4mBKT0IAAzR/eLCjeXelPth2');
