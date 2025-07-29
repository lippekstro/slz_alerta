<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/configs/conexao.php';

class Usuario
{
    private $id_usuario;
    private $nome;
    private $email;
    private $telefone;
    private $senha;
    private $tipo_usuario;
    private $cpf;
    private $foto_usuario;

    // SQL Queries
    private const SELECT_BY_ID = 'SELECT * FROM usuarios WHERE id_usuario = :id';
    private const INSERT_USER = 'INSERT INTO usuarios (nome, email, telefone, senha, cpf, foto) VALUES (:nome, :email, :telefone, :senha, :cpf, :foto)';
    private const SELECT_ALL = 'SELECT * FROM usuarios';
    private const UPDATE_USER = 'UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone, cpf = :cpf WHERE id_usuario = :id';
    private const UPDATE_PASSWORD = 'UPDATE usuarios SET senha = :senha WHERE id_usuario = :id';
    private const DELETE_USER = 'DELETE FROM usuarios WHERE id_usuario = :id';
    private const UPDATE_IMAGE = 'UPDATE usuarios SET foto = :foto WHERE id_usuario = :id';

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_usuario = $id;
            $this->carregar();
        }
    }

    public function getId()
    {
        return $this->id_usuario;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getTipoUsuario()
    {
        return $this->tipo_usuario;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getFotoUsuario()
    {
        return $this->foto_usuario;
    }

    public function setFotoUsuario($foto_usuario)
    {
        $this->foto_usuario = $foto_usuario;
    }

    private function carregar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::SELECT_BY_ID);
            $stmt->bindValue(':id', $this->id_usuario);
            $stmt->execute();
            $resultado = $stmt->fetch();

            if ($resultado) {
                $this->nome = $resultado['nome'];
                $this->senha = $resultado['senha'];
                $this->telefone = $resultado['telefone'];
                $this->tipo_usuario = $resultado['tipo_usuario'];
                $this->cpf = $resultado['cpf'];
                $this->email = $resultado['email'];
                $this->foto_usuario = $resultado['foto'];
            }
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao carregar usuário: ' . $e->getMessage();
            exit();
        }
    }

    public function criar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::INSERT_USER);
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':telefone', $this->telefone);
            $stmt->bindValue(':cpf', $this->cpf);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->bindValue(':foto', $this->foto_usuario);
            $stmt->execute();
            $this->id_usuario = $conexao->lastInsertId();
        } catch (PDOException $e) {
            // Verifica se é erro de duplicidade (ex: email já cadastrado)
            if ($e->getCode() == '23000') {
                session_start();
                $_SESSION['aviso'] = "Email já cadastrado utilize outro";
                header("Location: /slz_alerta/views/cadastro_usuario.php");
                exit();
            } else {
                // Tratamento de exceções
                echo 'Erro ao criar usuário: ' . $e->getMessage();
                exit();
            }
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
            echo 'Erro ao listar usuários: ' . $e->getMessage();
            exit();
        }
    }

    public function atualizar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::UPDATE_USER);
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':telefone', $this->telefone);
            $stmt->bindValue(':cpf', $this->cpf);
            $stmt->bindValue(':id', $this->id_usuario);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao atualizar usuário: ' . $e->getMessage();
            exit();
        }
    }

    public function atualizarSenha()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::UPDATE_PASSWORD);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->bindValue(':id', $this->id_usuario);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao atualizar senha: ' . $e->getMessage();
            exit();
        }
    }

    public function atualizarFoto()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::UPDATE_IMAGE);
            $stmt->bindValue(':foto', $this->foto_usuario);
            $stmt->bindValue(':id', $this->id_usuario);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao atualizar senha: ' . $e->getMessage();
            exit();
        }
    }

    public function deletar()
    {
        try {
            $conexao = Conexao::criaConexao();
            $stmt = $conexao->prepare(self::DELETE_USER);
            $stmt->bindValue(':id', $this->id_usuario);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratamento de exceções
            echo 'Erro ao deletar usuário: ' . $e->getMessage();
            exit();
        }
    }
}
