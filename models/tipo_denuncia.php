<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/configs/conexao.php';

class TipoDenuncia
{
    private $id_categoria;
    private $nome;
    private $descricao;
    
    // SQL Queries
    private const SELECT_BY_ID = 'SELECT * FROM categorias WHERE id_categoria = :id';
    private const INSERT_TIPO_DENUNCIA = 'INSERT INTO categorias (nome, descricao) VALUES (:nome, :descricao)';
    private const SELECT_ALL = 'SELECT * FROM categorias';
    private const UPDATE_TIPO_DENUNCIA = 'UPDATE categorias SET nome = :nome, descricao = :descricao WHERE id_categoria = :id';
    private const DELETE_TIPO_DENUNCIA = 'DELETE FROM categorias WHERE id_categoria = :id';

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_categoria = $id;
            $this->carregar();
        }
    }

    public function getId()
    {
        return $this->id_categoria;
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
            $stmt->bindValue(':id', $this->id_categoria);
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
            $this->id_categoria = $conexao->lastInsertId();
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
            $stmt->bindValue(':id', $this->id_categoria);
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
            $stmt->bindValue(':id', $this->id_cat);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao deletar tipo de denúncia: ' . $e->getMessage();
        }
    }
}
