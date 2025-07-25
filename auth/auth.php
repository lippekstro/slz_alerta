<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/configs/conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/usuario.php';

session_start();

class Auth
{
    public static function logar($email, $senha)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['telefone'] = $usuario['telefone'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
            $_SESSION['foto_usuario'] = $usuario['foto'];

            header('Location: /slz_alerta/index.php');
            exit();
        } else {
            $_SESSION['aviso'] = "Email ou Senha incorretos";
            header('Location: /slz_alerta/views/login.php');
            exit();
        }
    }

    public static function estaAutenticado()
    {
        return isset($_SESSION['id_usuario']);
    }

    public static function ehAdmin(){
        return $_SESSION['tipo_usuario'] === 2;
    }

    public static function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /slz_alerta/views/login.php');
        exit();
    }
}