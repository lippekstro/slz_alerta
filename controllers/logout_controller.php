<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/auth/auth.php';

// Verificar se o usuário está autenticado antes de fazer logout
if (Auth::estaAutenticado()) {
    Auth::logout();
} else {
    // Redirecionar para alguma página de erro ou página inicial
    header('Location: /slz_alerta/index.php');
    exit();
}