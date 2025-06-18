<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/configs/conexao.php';

class Denuncia
{
    private $id_denuncia;
    private $titulo;
    private $descricao;
    private $data_denuncia;
    private $status_denuncia;
    private $local_denuncia;
    private $anonima;
    private $id_usuario;

    // SQL Queries
    private const SELECT_BY_ID = 'SELECT * FROM denuncias WHERE id_denuncia = :id';
    private const SELECT_USER_E_DENUNCIA_BY_ID = 'SELECT u.nome, u.foto, d.* FROM usuarios u JOIN denuncias d ON d.id_usuario = u.id_usuario WHERE id_denuncia = :id';
    private const INSERT_DENUNCIA = 'INSERT INTO denuncias (titulo, descricao, local_denuncia, anonima, id_usuario) VALUES (:titulo, :descricao, :local_denuncia, :anonima, :id_usuario)';
    private const SELECT_ALL = 'SELECT * FROM denuncias';
    private const UPDATE_DENUNCIA = 'UPDATE denuncias SET titulo = :titulo, descricao = :descricao, local_denuncia = :local_denuncia, anonima = :anonima WHERE id_denuncia = :id';
    private const DELETE_DENUNCIA = 'DELETE FROM denuncias WHERE id_denuncia = :id';

    private const SELECT_BY_TITULO = 'SELECT * FROM denuncias WHERE titulo LIKE :termo';

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_denuncia = $id;
            $this->carregar();
        }
    }

    public function getId()
    {
        return $this->id_denuncia;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDataDenuncia()
    {
        return $this->data_denuncia;
    }

    public function getStatusDenuncia()
    {
        return $this->status_denuncia;
    }

    public function setStatusDenuncia($status_denuncia)
    {
        $this->status_denuncia = $status_denuncia;
    }

    public function getLocalDenuncia()
    {
        return $this->local_denuncia;
    }

    public function setLocalDenuncia($local_denuncia)
    {
        $this->local_denuncia = $local_denuncia;
    }

    public function getAnonima()
    {
        return $this->anonima;
    }

    public function setAnonima($anonima)
    {
        $this->anonima = $anonima;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    private function carregar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::SELECT_BY_ID);
            $stmt->bindValue(':id', $this->id_denuncia);
            $stmt->execute();
            $resultado = $stmt->fetch();

            if ($resultado) {
                $this->titulo = $resultado['titulo'];
                $this->descricao = $resultado['descricao'];
                $this->data_denuncia = $resultado['data_denuncia'];
                $this->status_denuncia = $resultado['status_denuncia'];
                $this->local_denuncia = $resultado['local_denuncia'];
                $this->anonima = $resultado['anonima'];
                $this->id_usuario = $resultado['id_usuario'];
            }
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao carregar denúncia: ' . $e->getMessage();
            exit();
        }
    }

    public function criar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::INSERT_DENUNCIA);
            $stmt->bindValue(':titulo', $this->titulo);
            $stmt->bindValue(':descricao', $this->descricao);
            $stmt->bindValue(':local_denuncia', $this->local_denuncia);
            $stmt->bindValue(':anonima', $this->anonima);
            $stmt->bindValue(':id_usuario', $this->id_usuario);
            $stmt->execute();
            $this->id_denuncia = $conexao->lastInsertId();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao criar denúncia: ' . $e->getMessage();
            exit();
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
            echo 'Erro ao listar denúncias: ' . $e->getMessage();
            exit();
        }
    }

    public static function listarPorId($id){
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::SELECT_USER_E_DENUNCIA_BY_ID);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao listar denúncias: ' . $e->getMessage();
            exit();
        }
    }

    public static function listarPorTermo($termo){
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::SELECT_BY_TITULO);
            $stmt->bindValue(':termo', '%' . $termo . '%');
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao listar denúncias: ' . $e->getMessage();
            exit();
        }
    }

    public function atualizar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::UPDATE_DENUNCIA);
            $stmt->bindValue(':titulo', $this->titulo);
            $stmt->bindValue(':descricao', $this->descricao);
            $stmt->bindValue(':local_denuncia', $this->local_denuncia);
            $stmt->bindValue(':anonima', $this->anonima);
            $stmt->bindValue(':id', $this->id_denuncia);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao atualizar denúncia: ' . $e->getMessage();
            exit();
        }
    }

    public function deletar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::DELETE_DENUNCIA);
            $stmt->bindValue(':id', $this->id_denuncia);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao deletar denúncia: ' . $e->getMessage();
            exit();
        }
    }
}
