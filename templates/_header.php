<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/auth/auth.php';
// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLZ ALERTA</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    
    <link rel="stylesheet" href="/slz_alerta/css/bootstrap.css">
    <script src="/slz_alerta/js/bootstrap.bundle.js" defer></script>

    <link rel="stylesheet" href="/slz_alerta/css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-prim">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler bg-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-between w-100 align-items-center">
                        <div class="d-flex flex-column flex-lg-row mb-1 mb-lg-0 align-items-center">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-center" href="/slz_alerta/index.php">
                                    <span class="material-symbols-outlined">home</span>
                                    Inicio
                                </a>
                            </li>
                            <?php if(!Auth::estaAutenticado()): ?>
                                <li class="nav-item mb-1">
                                    <a class="nav-link d-flex align-center" href="/slz_alerta/views/cadastro_usuario.php">
                                        <span class="material-symbols-outlined">id_card</span>
                                        Cadastre-se
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex align-center" href="/slz_alerta/views/cadastro_denuncia.php">
                                    <span class="material-symbols-outlined">report</span>    
                                    Denunciar
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex align-center" href="/slz_alerta/views/denuncias.php">
                                    <span class="material-symbols-outlined">history</span>
                                    Historico
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex align-center" href="/slz_alerta/views/sobre.php">
                                    <span class="material-symbols-outlined">info</span>
                                    Sobre
                                </a>
                            </li>

                            <?php if(Auth::estaAutenticado() && Auth::ehAdmin()): ?>
                                <li class="nav-item mb-1">
                                    <a class="nav-link d-flex align-center" href="/slz_alerta/views/admin/analises.php">
                                        <span class="material-symbols-outlined">Admin_Panel_Settings</span>
                                        Análises
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth::estaAutenticado()): ?>
                                <li class="nav-item mb-1">
                                    <a class="nav-link d-flex align-center" href="/slz_alerta/views/minhas_denuncias.php">
                                        <span class="material-symbols-outlined">feedback</span>
                                        Minhas Denúncias
                                    </a>
                                </li>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex">
                            <?php if(!Auth::estaAutenticado()): ?>
                                <li class="nav-item">
                                    <a class="btn btn-outline-primary d-flex align-center" href="/slz_alerta/views/login.php">
                                        <span class="material-symbols-outlined">person</span>
                                        Entrar
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item mx-2">
                                    <a class="btn btn-outline-primary d-flex align-center" href="/slz_alerta/views/perfil.php">
                                        <span class="material-symbols-outlined">account_circle</span>
                                        Olá, <?= $_SESSION['nome'] ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-outline-primary d-flex align-center" href="/slz_alerta/controllers/logout_controller.php">
                                        <span class="material-symbols-outlined">logout</span>
                                        Sair
                                    </a>
                                </li>
                            <?php endif; ?>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <?php
            require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_alertas.php';
        ?>