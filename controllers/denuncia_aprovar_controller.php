<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';

$id = $_GET['id'];

Denuncia::aprovarDenucia($id);

$_SESSION['aviso'] = "Denúncia Aprovada";
header('Location: /slz_alerta/views/admin/analises.php');
exit();