<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lógica para registro de usuário
    $nome = htmlspecialchars($_POST['nome']);
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    }
    $telefone = htmlspecialchars($_POST['telefone']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $caminhoImagem = null;
    if (!empty($_FILES['imagem']['tmp_name'])) {
        // Define o diretório onde as imagens serão armazenadas
        $diretorio = $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/uploads/usuarios/';

        // Cria o diretório se não existir
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755, true);
        }

        // Gera um nome único para o arquivo
        $nomeArquivo = uniqid('img_') . '.' . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

        // Caminho completo no servidor
        $caminhoCompleto = $diretorio . $nomeArquivo;

        // Caminho que será salvo no banco
        $caminhoImagem = 'uploads/usuarios/' . $nomeArquivo;

        // Move o arquivo enviado para o diretório
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto);
    }

    // Criar uma instância de Usuario
    $novoUsuario = new Usuario();
    $novoUsuario->setNome($nome);
    $novoUsuario->setEmail($email);
    $novoUsuario->setTelefone($telefone);
    $novoUsuario->setCpf($cpf);
    $novoUsuario->setSenha($senha);

    if(isset($caminhoImagem)){
        $novoUsuario->setFotoUsuario($caminhoImagem);
    } else {
        $novoUsuario->setFotoUsuario(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/imgs/dummy_usuario.png'));
    }

    // Chamar o método para criar o usuário
    $novoUsuario->criar();

    // Redirecionar para login
    $_SESSION['aviso'] = "Usuário Cadastrado";
    header('Location: /slz_alerta/views/login.php');
    exit();
}