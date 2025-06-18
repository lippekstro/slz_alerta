<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/configs/conexao.php';

class ImagensDenuncia
{
    private $id_img;
    private $descricao;
    private $imagem;
    private $denuncia;
    
    // SQL Queries
    private const SELECT_BY_ID = 'SELECT * FROM imgs_denuncia WHERE id_img = :id';
    private const INSERT_IMAGEM_DENUNCIA = 'INSERT INTO imgs_denuncia (descricao, imagem, denuncia) VALUES (:descricao, :imagem, :denuncia)';
    private const SELECT_ALL = 'SELECT * FROM imgs_denuncia';
    //private const UPDATE_TIPO_DENUNCIA = 'UPDATE tipo_denuncia SET nome = :nome, descricao = :descricao WHERE id_tipo_denuncia = :id';
    private const DELETE_IMAGEM_DENUNCIA = 'DELETE FROM imgs_denuncia WHERE id_img = :id';

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_img = $id;
            $this->carregar();
        }
    }

    public function getId()
    {
        return $this->id_img;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getImagem()
    {
        return $this->imagem;
    }

    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }

    public function getDenuncia()
    {
        return $this->denuncia;
    }

    public function setDenuncia($denuncia)
    {
        $this->denuncia = $denuncia;
    }

    private function carregar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::SELECT_BY_ID);
            $stmt->bindValue(':id', $this->id_img);
            $stmt->execute();
            $resultado = $stmt->fetch();

            if ($resultado) {
                $this->descricao = $resultado['descricao'];
                $this->imagem = $resultado['imagem'];
                $this->denuncia = $resultado['denuncia'];
            }
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao carregar imagem de denúncia: ' . $e->getMessage();
        }
    }

    public function criar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::INSERT_IMAGEM_DENUNCIA);
            $stmt->bindValue(':descricao', $this->descricao);
            $stmt->bindValue(':imagem', $this->imagem);
            $stmt->bindValue(':denuncia', $this->denuncia);
            $stmt->execute();
            $this->id_img = $conexao->lastInsertId();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao criar imagem de denúncia: ' . $e->getMessage();
        }
    }

    public static function listar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::SELECT_ALL);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao listar imagens de denúncias: ' . $e->getMessage();
        }
    }

    // public function atualizar()
    // {
    //     try {
    //         $conexao = Conexao::criaConexao();
    //         $stmt = $conexao->prepare(self::UPDATE_TIPO_DENUNCIA);
    //         $stmt->bindValue(':nome', $this->nome);
    //         $stmt->bindValue(':descricao', $this->descricao);
    //         $stmt->bindValue(':id', $this->id_tipo_denuncia);
    //         $stmt->execute();
    //     } catch (PDOException $e) {
    //         // Tratamento de exceções
    //         echo 'Erro ao atualizar tipo de denúncia: ' . $e->getMessage();
    //     }
    // }

    public function deletar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::DELETE_IMAGEM_DENUNCIA);
            $stmt->bindValue(':id', $this->id_img);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao deletar imagem de denúncia: ' . $e->getMessage();
        }
    }
}
