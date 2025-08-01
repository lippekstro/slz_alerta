<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia_tipo.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/imagens_denuncia.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/configs/utils.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lógica para registro de usuário
    $titulo = htmlspecialchars($_POST['titulo']);
    $descricao = htmlspecialchars($_POST['descricao']);
    $categoria = $_POST['categoria'];
    $endereco = htmlspecialchars($_POST['endereco']);
    $bairro = htmlspecialchars($_POST['bairro']);
    $referencia = htmlspecialchars($_POST['referencia']);
    $anonima = $_POST['anonima'];

    // Criar uma instância de Usuario
    $novaDenuncia = new Denuncia();
    $novaDenuncia->setTitulo($titulo);
    $novaDenuncia->setDescricao($descricao);
    $novaDenuncia->setLocalDenuncia("$endereco ($referencia), $bairro");
    $novaDenuncia->setAnonima($anonima);
    $novaDenuncia->setIdUsuario($_SESSION['id_usuario']);

    // Chamar o método para criar o usuário
    $novaDenuncia->criar();


    // Associar o tipo com a denuncia
    foreach ($categoria as $c) {
        $novaAssociacao = new DenunciaTipo();
        $novaAssociacao->setDenuncia($novaDenuncia->getId());
        $novaAssociacao->setCategoria($c);

        $novaAssociacao->criar();
    }



    if (!empty($_FILES['imagens']['name'][0])) {
        // Verificar se o número de imagens excede 3
        if (count($_FILES['imagens']['name']) > 3) {
            $_SESSION['aviso'] = "Excedeu o máximo de 3 imagens";
            header('Location: /slz_alerta/views/cadastro_denuncia.php');
            exit();
        }

        // Itera sobre cada imagem enviada
        foreach ($_FILES['imagens']['tmp_name'] as $index => $tmpName) {
            // Ignora arquivos com erro
            if ($_FILES['imagens']['error'][$index] !== UPLOAD_ERR_OK) {
                continue;
            }

            // Validação de tipo de imagem
            $infoImagem = getimagesize($tmpName);
            $mimeType = $infoImagem['mime'] ?? '';

            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];

            if (!in_array($mimeType, $tiposPermitidos)) {
                $_SESSION['aviso'] = "Tipo de arquivo inválido. Só é permitido PNG, JPG ou WEBP.";
                header('Location: /slz_alerta/views/cadastro_denuncia.php');
                exit();
            }

            // Temporariamente reorganiza os dados para passar para o método
            $_FILES['imagem'] = [
                'name'     => $_FILES['imagens']['name'][$index],
                'type'     => $_FILES['imagens']['type'][$index],
                'tmp_name' => $_FILES['imagens']['tmp_name'][$index],
                'error'    => $_FILES['imagens']['error'][$index],
                'size'     => $_FILES['imagens']['size'][$index],
            ];

            // Salva a imagem
            $caminhoImagem = Utils::salvarImagemDenuncia('imagem');

            // Cria e associa a imagem à denúncia
            $novaImagem = new ImagensDenuncia();
            $novaImagem->setDenuncia($novaDenuncia->getId());
            $novaImagem->setImagem($caminhoImagem);

            // Aqui você pode salvar no banco se necessário, ex:
            $novaImagem->criar();
        }

        // Opcional: remover o arquivo temporário reatribuído para evitar confusão
        unset($_FILES['imagem']);
    }



    // Redirecionar para login
    $_SESSION['aviso'] = "Denúncia enviada para Análise";
    header('Location: /slz_alerta/index.php');
    exit();
}
