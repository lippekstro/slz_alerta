<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';

$id = $_GET['id'];

$denuncia = new Denuncia($id);

$denuncia->deletar();

header('Location: /slz_alerta/views/admin/analises.php');
exit();