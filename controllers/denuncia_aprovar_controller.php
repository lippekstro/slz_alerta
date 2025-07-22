<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/auth/auth.php';

session_start();

if (!Auth::estaAutenticado() || !Auth::ehAdmin()) {
    $_SESSION['aviso'] = "Acesso Restrito";
    header('Location: /slz_alerta/index.php');
    exit();
}

$id = $_GET['id'];

Denuncia::aprovarDenucia($id);

$_SESSION['aviso'] = "Denúncia Aprovada";
header('Location: /slz_alerta/views/admin/analises.php');
exit();