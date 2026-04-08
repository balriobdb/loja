<?php

include_once "configs/database.php";
include_once "Produto.php";

Class ProdutoController {
    private $bd;
    private $produto;
    private $img_name;

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

    public function cadastrarProduto($dados, $arquivo){
        $temArquivo = isset($arquivo['name']['fileToUpload'])
            && $arquivo['name']['fileToUpload'] !== ""
            && isset($arquivo['error']['fileToUpload'])
            && $arquivo['error']['fileToUpload'] === UPLOAD_ERR_OK;

        if($temArquivo && !$this->upload($arquivo)){
            return false;
        }

        if(!$temArquivo){
            $this->img_name = null;
        }

        $this->produto->nome_produto = $dados["nome_produto"];
        $this->produto->tipo_produto = $dados["tipo_produto"];
        $this->produto->cor_produto = $dados["cor_produto"];
        $this->produto->tamanho_produto = $dados["tamanho_produto"];
        $this->produto->marca_produto = $dados["marca_produto"];
        $this->produto->quantidade_produto = $dados["quantidade_produto"];
        $this->produto->preco_produto = $dados["preco_produto"];
        $this->produto->imagem_produto = $this->img_name;

        if($this->produto->Cadastrar()){
            header("location: index_produto.php");
            exit();
        }
    }

    public function excluirProduto($id_produto){
        $this->produto->id_produto = $id_produto;

        if($this->produto->Excluir()){
            header("location: index_produto.php");
        }
    }

    public function indexArquivados(){
        return $this->produto->LerArquivados();
    }

    public function restaurarProduto($id_produto){
        $this->produto->id_produto = $id_produto;
        if($this->produto->restaurar()){
            header("location: arquivados_produto.php");
            exit();
        }
    }

    public function atualizarProduto($dados, $arquivo){
        $temArquivo = isset($arquivo['name']['fileToUpload'])
            && $arquivo['name']['fileToUpload'] !== ""
            && isset($arquivo['error']['fileToUpload'])
            && $arquivo['error']['fileToUpload'] === UPLOAD_ERR_OK;

        if($temArquivo && !$this->upload($arquivo)){
            return false;
        }

        if(!$temArquivo){
            $produto_atual = $this->localizarProduto($dados["id_produto"]);
            $this->img_name = $produto_atual->imagem_produto;
        }

        $this->produto->id_produto = $dados["id_produto"];
        $this->produto->nome_produto = $dados["nome_produto"];
        $this->produto->tipo_produto = $dados["tipo_produto"];
        $this->produto->cor_produto = $dados["cor_produto"];
        $this->produto->tamanho_produto = $dados["tamanho_produto"];
        $this->produto->marca_produto = $dados["marca_produto"];
        $this->produto->quantidade_produto = $dados["quantidade_produto"];
        $this->produto->preco_produto = $dados["preco_produto"];
        $this->produto->imagem_produto = $this->img_name;

        if($this->produto->Atualizar()){
            header("location: index_produto.php");
        }
    }

    public function localizarProduto($id_produto){
        return $this->produto->buscaProduto($id_produto);

    }

    public function upload($arquivo)
    {

        $target_dir = "uploads/";
        $uploadOk = 1;
        $target_file = $target_dir . $arquivo["name"]['fileToUpload'];
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $random_name = uniqid('img_', true) . '.' . pathinfo($arquivo['name']['fileToUpload'], PATHINFO_EXTENSION);
        $this->img_name = $random_name;
        $upload_file = $target_dir . $random_name;

        $check = getimagesize($arquivo['tmp_name']['fileToUpload']);

        if ($check !== false) {
            //echo "Imagem selecionada - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
            // echo "O arquivo selecionado não é uma imagem.<br>";
            $uploadOk = 0;
        }

        // Verifica se o arquivo já existe na pasta
        if (file_exists($upload_file)) {
            // echo "O arquivo já existe no servidor.<br>";
            $uploadOk = 0;
        }

        // Verifica o tamanho do arquivo - Limite de 500Kb
        if ($arquivo['size']['fileToUpload'] > 5000000) {
            // echo "Arquivo muito grande!<br>";
            $uploadOk = 0;
            echo "imagem é muito grande";
            die();
        }
        // Permite apenas determinados tipos de arquivo - jpg, png, jpeg e gif
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "webp"
        ) {
            //  echo "São aceitas somente imagens JPG, JPEG, PNG, GIF e WEBP.";
            $uploadOk = 0;
        }

        // Verificação de erros. Se $uploadOk=0 ocorreu algum erro
        if ($uploadOk == 0) {
            //  echo "Erro: não foi possível fazer upload.";
            return false;
            // Se não ocorreu problemas, tenta fazer upload
        } else {
            if (move_uploaded_file($arquivo['tmp_name']['fileToUpload'], $upload_file)) {
                //     echo "Arquivo ". basename( $arquivo['full_path']['fileToUpload']) . " enviado.";
                return true;
            } else {
                //     echo "Erro ao enviar a imagem.";
                return false;
            }
        }

        return false;
    }
}

