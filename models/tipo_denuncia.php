<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/configs/conexao.php';

class TipoDenuncia
{
    private $id_tipo_denuncia;
    private $nome;
    private $descricao;
    
    // SQL Queries
    private const SELECT_BY_ID = 'SELECT * FROM tipo_denuncia WHERE id_tipo_denuncia = :id';
    private const INSERT_TIPO_DENUNCIA = 'INSERT INTO tipo_denuncia (nome, descricao) VALUES (:nome, :descricao)';
    private const SELECT_ALL = 'SELECT * FROM tipo_denuncia';
    private const UPDATE_TIPO_DENUNCIA = 'UPDATE tipo_denuncia SET nome = :nome, descricao = :descricao WHERE id_tipo_denuncia = :id';
    private const DELETE_TIPO_DENUNCIA = 'DELETE FROM tipo_denuncia WHERE id_tipo_denuncia = :id';

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_tipo_denuncia = $id;
            $this->carregar();
        }
    }

    public function getId()
    {
        return $this->id_tipo_denuncia;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    private function carregar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::SELECT_BY_ID);
            $stmt->bindValue(':id', $this->id_tipo_denuncia);
            $stmt->execute();
            $resultado = $stmt->fetch();

            if ($resultado) {
                $this->nome = $resultado['nome'];
                $this->descricao = $resultado['descricao'];
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
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':descricao', $this->descricao);
            $stmt->execute();
            $this->id_tipo_denuncia = $conexao->lastInsertId();
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
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':descricao', $this->descricao);
            $stmt->bindValue(':id', $this->id_tipo_denuncia);
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
            $stmt->bindValue(':id', $this->id_tipo_denuncia);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao deletar tipo de denúncia: ' . $e->getMessage();
        }
    }
}
