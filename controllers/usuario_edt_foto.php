<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/configs/utils.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = $_SESSION['id_usuario'];

    // Criar uma instância de Usuario
    $novoUsuario = new Usuario($id);
    $novoUsuario->setFotoUsuario(Utils::salvarImagemUsuario());
    
    $novoUsuario->atualizarFoto();

    $_SESSION['foto_usuario'] = $novoUsuario->getFotoUsuario();

    // Redirecionar para login
    $_SESSION['aviso'] = "Foto Atualizada";
    header('Location: /slz_alerta/index.php');
    exit();
}