<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/configs/utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lógica para registro de usuário
    $nome = htmlspecialchars($_POST['nome']);
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    }
    $telefone = htmlspecialchars($_POST['telefone']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);



    // Criar uma instância de Usuario
    $novoUsuario = new Usuario();
    $novoUsuario->setNome($nome);
    $novoUsuario->setEmail($email);
    $novoUsuario->setTelefone($telefone);
    $novoUsuario->setCpf($cpf);
    $novoUsuario->setSenha($senha);

    $novoUsuario->setFotoUsuario(Utils::salvarImagemUsuario());


    // Chamar o método para criar o usuário
    $novoUsuario->criar();

    // Redirecionar para login
    $_SESSION['aviso'] = "Usuário Cadastrado";
    header('Location: /slz_alerta/views/login.php');
    exit();
}