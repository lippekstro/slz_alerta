<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/configs/utils.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = htmlspecialchars($_POST['nome']);
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $id = $_SESSION['id_usuario'];

    $novoUsuario = new Usuario($id);
    $novoUsuario->setNome($nome);
    $novoUsuario->setEmail($email);
    $novoUsuario->setTelefone($telefone);
    $novoUsuario->setCpf($cpf);

    $novoUsuario->atualizar();

    $_SESSION['nome'] = $novoUsuario->getNome();
    $_SESSION['email'] = $novoUsuario->getEmail();
    $_SESSION['telefone'] = $novoUsuario->getTelefone();

    $_SESSION['aviso'] = "Usuário Atualizado";
    header('Location: /slz_alerta/index.php');
    exit();
}
