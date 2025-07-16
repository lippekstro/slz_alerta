<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/configs/conexao.php';

class DenunciaTipo
{
    private $id_denuncia_tipo;
    private $denuncia;
    private $categoria;
    
    // SQL Queries
    private const SELECT_BY_ID = 'SELECT * FROM denuncia_tipo WHERE id_denuncia_tipo = :id';
    private const INSERT_TIPO_DENUNCIA = 'INSERT INTO denuncia_tipo (denuncia, categoria) VALUES (:denuncia, :categoria)';
    private const SELECT_ALL = 'SELECT * FROM denuncia_tipo';
    private const UPDATE_TIPO_DENUNCIA = 'UPDATE denuncia_tipo SET denuncia = :denuncia, categoria = :categoria WHERE id_denuncia_tipo = :id';
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

    public function getDenuncia()
    {
        return $this->denuncia;
    }

    public function setDenuncia($id_denuncia)
    {
        $this->denuncia = $id_denuncia;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($id_categoria)
    {
        $this->categoria = $id_categoria;
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
                $this->denuncia = $resultado['denuncia'];
                $this->categoria = $resultado['categoria'];
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
            $stmt->bindValue(':denuncia', $this->denuncia);
            $stmt->bindValue(':categoria', $this->categoria);
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
            $stmt->bindValue(':denuncia', $this->denuncia);
            $stmt->bindValue(':categoria', $this->categoria);
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
