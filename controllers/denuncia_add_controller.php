<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia_tipo.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lógica para registro de usuário
    $titulo = htmlspecialchars($_POST['titulo']);
    $descricao = htmlspecialchars($_POST['descricao']);
    $categoria = $_POST['categoria'];
    $endereco = htmlspecialchars($_POST['endereco']);
    $bairro = htmlspecialchars($_POST['bairro']);
    $referencia = htmlspecialchars($_POST['referencia']);

    $caminhoImagem = null;


    if (!empty($_FILES['imagens']['tmp_name'])) {
        // Define o diretório onde as imagens serão armazenadas
        $diretorio = $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/uploads/';

        // Cria o diretório se não existir
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755, true);
        }

        // Gera um nome único para o arquivo
        $nomeArquivo = uniqid('img_') . '.' . pathinfo($_FILES['imagens']['name'], PATHINFO_EXTENSION);

        // Caminho completo no servidor
        $caminhoCompleto = $diretorio . $nomeArquivo;

        // Caminho que será salvo no banco
        $caminhoImagem = 'uploads/' . $nomeArquivo;

        // Move o arquivo enviado para o diretório
        move_uploaded_file($_FILES['imagens']['tmp_name'], $caminhoCompleto);
    }


    // Criar uma instância de Usuario
    $novaDenuncia = new Denuncia();
    $novaDenuncia->setTitulo($titulo);
    $novaDenuncia->setDescricao($descricao);
    $novaDenuncia->setLocalDenuncia("$endereco ($referencia), $bairro");
    $novaDenuncia->setArquivo($caminhoImagem); // salva só a string
    $novaDenuncia->setIdUsuario($_SESSION['id_usuario']);
    
    // Chamar o método para criar o usuário
    $novaDenuncia->criar();


    // Associar o tipo com a denuncia
    $novaAssociacao = new DenunciaTipo();
    $novaAssociacao->setIdDenuncia($novaDenuncia->getId());
    $novaAssociacao->setTipoDenuncia($categoria);

    $novaAssociacao->criar();
    
    // Redirecionar para login
    header('Location: /slz_alerta/index.php');
    exit();
}