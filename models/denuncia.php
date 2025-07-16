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
    private const SELECT_BY_ID = "SELECT d.*, GROUP_CONCAT(DISTINCT i.imagem SEPARATOR ',') AS imagens, GROUP_CONCAT(DISTINCT c.nome SEPARATOR ',') AS categorias FROM denuncias d LEFT JOIN imgs_denuncia i ON d.id_denuncia = i.denuncia LEFT JOIN denuncia_tipo dt ON d.id_denuncia = dt.denuncia LEFT JOIN categorias c ON dt.categoria = c.id_categoria WHERE d.id_denuncia = :id GROUP BY d.id_denuncia ORDER BY d.data_denuncia DESC";
    
    private const SELECT_USER_E_DENUNCIA_BY_ID = "SELECT u.nome, u.foto, d.*, GROUP_CONCAT(DISTINCT i.imagem SEPARATOR ',') AS imagens, GROUP_CONCAT(DISTINCT c.nome SEPARATOR ',') AS categorias  FROM usuarios u LEFT JOIN denuncias d ON d.id_usuario = u.id_usuario LEFT JOIN imgs_denuncia i ON d.id_denuncia = i.denuncia LEFT JOIN denuncia_tipo dt ON d.id_denuncia = dt.denuncia LEFT JOIN categorias c ON dt.categoria = c.id_categoria WHERE d.id_denuncia = :id GROUP BY d.id_denuncia ORDER BY d.data_denuncia DESC";
    
    private const INSERT_DENUNCIA = 'INSERT INTO denuncias (titulo, descricao, local_denuncia, anonima, id_usuario) VALUES (:titulo, :descricao, :local_denuncia, :anonima, :id_usuario)';
    
    private const SELECT_ALL = "SELECT d.*, GROUP_CONCAT(DISTINCT i.imagem SEPARATOR ',') AS imagens, GROUP_CONCAT(DISTINCT c.nome SEPARATOR ',') AS categorias FROM denuncias d LEFT JOIN imgs_denuncia i ON d.id_denuncia = i.denuncia LEFT JOIN denuncia_tipo dt ON d.id_denuncia = dt.denuncia LEFT JOIN categorias c ON dt.categoria = c.id_categoria GROUP BY d.id_denuncia ORDER BY d.data_denuncia DESC";
    
    private const SELECT_ALL_ACEITAS = "SELECT d.*, GROUP_CONCAT(DISTINCT i.imagem SEPARATOR ',') AS imagens, GROUP_CONCAT(DISTINCT c.nome SEPARATOR ',') AS categorias FROM denuncias d LEFT JOIN imgs_denuncia i ON d.id_denuncia = i.denuncia LEFT JOIN denuncia_tipo dt ON d.id_denuncia = dt.denuncia LEFT JOIN categorias c ON dt.categoria = c.id_categoria WHERE status_denuncia IN ('Aceita', 'Resolvido') GROUP BY d.id_denuncia ORDER BY d.data_denuncia DESC";
    
    private const SELECT_ALL_ANALISE = "SELECT d.*, GROUP_CONCAT(DISTINCT i.imagem SEPARATOR ',') AS imagens, GROUP_CONCAT(DISTINCT c.nome SEPARATOR ',') AS categorias FROM denuncias d LEFT JOIN imgs_denuncia i ON d.id_denuncia = i.denuncia LEFT JOIN denuncia_tipo dt ON d.id_denuncia = dt.denuncia LEFT JOIN categorias c ON dt.categoria = c.id_categoria WHERE status_denuncia IN ('Em Analise') GROUP BY d.id_denuncia ORDER BY d.data_denuncia DESC";
    
    private const SELECT_IMGS_DENUNCIA = "SELECT GROUP_CONCAT(DISTINCT i.imagem SEPARATOR ',') AS imagens FROM denuncias d LEFT JOIN imgs_denuncia i ON d.id_denuncia = i.denuncia WHERE d.id_denuncia = :id GROUP BY d.id_denuncia";
    
    private const UPDATE_DENUNCIA = 'UPDATE denuncias SET titulo = :titulo, descricao = :descricao, local_denuncia = :local_denuncia, anonima = :anonima WHERE id_denuncia = :id';
    
    private const APROVE_DENUNCIA = 'UPDATE denuncias SET status_denuncia = :status_denuncia WHERE id_denuncia = :id';
    
    private const DELETE_DENUNCIA = 'DELETE FROM denuncias WHERE id_denuncia = :id';

    private const SELECT_BY_TITULO = "SELECT d.*, GROUP_CONCAT(DISTINCT i.imagem SEPARATOR ',') AS imagens, GROUP_CONCAT(DISTINCT c.nome SEPARATOR ',') AS categorias FROM denuncias d LEFT JOIN imgs_denuncia i ON d.id_denuncia = i.denuncia LEFT JOIN denuncia_tipo dt ON d.id_denuncia = dt.denuncia LEFT JOIN categorias c ON dt.categoria = c.id_categoria WHERE titulo LIKE :termo AND status_denuncia IN ('Aceita', 'Resolvido') GROUP BY d.id_denuncia ORDER BY d.data_denuncia DESC";

    private const SELECT_BY_USER = "SELECT d.*, GROUP_CONCAT(DISTINCT i.imagem SEPARATOR ',') AS imagens, GROUP_CONCAT(DISTINCT c.nome SEPARATOR ',') AS categorias FROM denuncias d LEFT JOIN imgs_denuncia i ON d.id_denuncia = i.denuncia LEFT JOIN denuncia_tipo dt ON d.id_denuncia = dt.denuncia LEFT JOIN categorias c ON dt.categoria = c.id_categoria WHERE d.id_usuario = :id_usuario GROUP BY d.id_denuncia;";

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

    public static function listarAceitas()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::SELECT_ALL_ACEITAS);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao listar denúncias: ' . $e->getMessage();
            exit();
        }
    }

    public static function listarParaAnalise()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::SELECT_ALL_ANALISE);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao listar denúncias: ' . $e->getMessage();
            exit();
        }
    }

    public static function listarImagensPorDenuncia($id)
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::SELECT_IMGS_DENUNCIA);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
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

    public static function listarProprias($id_usuario){
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::SELECT_BY_USER);
            $stmt->bindValue(':id_usuario', $id_usuario);
            $stmt->execute();
            return $stmt->fetchAll();
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

    public static function aprovarDenucia($id){
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::APROVE_DENUNCIA);
            $stmt->bindValue(':status_denuncia', 'Aceita');
            $stmt->bindValue(':id', $id);
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
