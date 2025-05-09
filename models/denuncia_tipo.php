<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/configs/conexao.php';

class DenunciaTipo
{
    private $id_denuncia_tipo;
    private $id_denuncia;
    private $id_tipo_denuncia;
    
    // SQL Queries
    private const SELECT_BY_ID = 'SELECT * FROM denuncia_tipo WHERE id_denuncia_tipo = :id';
    private const INSERT_TIPO_DENUNCIA = 'INSERT INTO denuncia_tipo (id_denuncia, id_tipo_denuncia) VALUES (:id_denuncia, :id_tipo_denuncia)';
    private const SELECT_ALL = 'SELECT * FROM denuncia_tipo';
    private const UPDATE_TIPO_DENUNCIA = 'UPDATE denuncia_tipo SET id_denuncia = :id_denuncia, id_tipo_denuncia = :id_tipo_denuncia WHERE id_denuncia_tipo = :id';
    private const DELETE_TIPO_DENUNCIA = 'DELETE FROM denuncia_tipo WHERE id_denuncia_tipo = :id';

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_denuncia_tipo = $id;
            $this->carregar();
        }
    }

    public function getId()
    {
        return $this->id_denuncia_tipo;
    }

    public function getIdDenuncia()
    {
        return $this->id_denuncia;
    }

    public function setIdDenuncia($id_denuncia)
    {
        $this->id_denuncia = $id_denuncia;
    }

    public function getTipoDenuncia()
    {
        return $this->id_tipo_denuncia;
    }

    public function setTipoDenuncia($id_tipo_denuncia)
    {
        $this->id_tipo_denuncia = $id_tipo_denuncia;
    }

    private function carregar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::SELECT_BY_ID);
            $stmt->bindValue(':id', $this->id_denuncia_tipo);
            $stmt->execute();
            $resultado = $stmt->fetch();

            if ($resultado) {
                $this->id_denuncia = $resultado['id_denuncia'];
                $this->id_tipo_denuncia = $resultado['id_tipo_denuncia'];
            }
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao carregar tipo de denúncia: ' . $e->getMessage();
        }
    }

    public function criar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::INSERT_TIPO_DENUNCIA);
            $stmt->bindValue(':id_denuncia', $this->id_denuncia);
            $stmt->bindValue(':id_tipo_denuncia', $this->id_tipo_denuncia);
            $stmt->execute();
            $this->id_denuncia_tipo = $conexao->lastInsertId();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao criar tipo de denúncia: ' . $e->getMessage();
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
            echo 'Erro ao listar tipos de denúncias: ' . $e->getMessage();
        }
    }

    public function atualizar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::UPDATE_TIPO_DENUNCIA);
            $stmt->bindValue(':id_denuncia', $this->id_denuncia);
            $stmt->bindValue(':id_tipo_denuncia', $this->id_tipo_denuncia);
            $stmt->bindValue(':id', $this->id_denuncia_tipo);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao atualizar tipo de denúncia: ' . $e->getMessage();
        }
    }

    public function deletar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::DELETE_TIPO_DENUNCIA);
            $stmt->bindValue(':id', $this->id_denuncia_tipo);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao deletar tipo de denúncia: ' . $e->getMessage();
        }
    }
}
