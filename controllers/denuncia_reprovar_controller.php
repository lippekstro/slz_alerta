<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';

session_start();

if (!Auth::estaAutenticado() || !Auth::ehAdmin()) {
    $_SESSION['aviso'] = "Acesso Restrito";
    header('Location: /slz_alerta/index.php');
    exit();
}

$id = $_GET['id'];

$lista = Denuncia::listarImagensPorDenuncia($id);
$imagens = explode(',', $lista["imagens"]);

foreach ($imagens as $caminho) {
    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/' . $caminho;
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

$denuncia = new Denuncia($id);

$denuncia->deletar();

$_SESSION['aviso'] = "Denúncia Reprovada";
header('Location: /slz_alerta/views/admin/analises.php');
exit();