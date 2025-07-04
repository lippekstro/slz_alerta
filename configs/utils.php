<?php

class Utils
{
    public static function salvarImagemUsuario($inputName = 'imagem')
    {
        $caminhoImagem = 'imgs/dummy_usuario.png'; // Placeholder padrão

        if (!empty($_FILES[$inputName]['tmp_name'])) {
            // Verificar tamanho máximo (5MB = 5 * 1024 * 1024 bytes)
            $tamanhoMaximo = 5 * 1024 * 1024; // 5MB
            if ($_FILES[$inputName]['size'] > $tamanhoMaximo) {
                $_SESSION['aviso'] = "Imagem maior que 5mb";
                header('Location: /slz_alerta/views/cadastro_usuario.php');
                exit();
            }

            // Verificar tipo de imagem
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
            $tipoMime = mime_content_type($_FILES[$inputName]['tmp_name']);

            if (!in_array($tipoMime, $tiposPermitidos)) {
                $_SESSION['aviso'] = "Tipo de imagem inválido. Permitidos: JPEG, PNG e WebP";
                header('Location: /slz_alerta/views/cadastro_usuario.php');
                exit();
            }


            // Define o diretório onde as imagens serão armazenadas
            $diretorio = $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/uploads/usuarios/';

            // Cria o diretório se não existir
            if (!is_dir($diretorio)) {
                mkdir($diretorio, 0755, true);
            }

            // Gera um nome único para o arquivo
            $nomeArquivo = uniqid('img_') . '.' . pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION);

            // Caminho completo no servidor
            $caminhoCompleto = $diretorio . $nomeArquivo;

            // Caminho que será salvo no banco
            $caminhoImagem = 'uploads/usuarios/' . $nomeArquivo;

            // Move o arquivo enviado para o diretório
            move_uploaded_file($_FILES[$inputName]['tmp_name'], $caminhoCompleto);
        }

        return $caminhoImagem;
    }

    public static function salvarImagemDenuncia($inputName = 'imagem')
    {
        $caminhoImagem = 'imgs/dummy_usuario.png'; // Placeholder padrão

        if (!empty($_FILES[$inputName]['tmp_name'])) {
            // Verificar tamanho máximo (5MB = 5 * 1024 * 1024 bytes)
            $tamanhoMaximo = 5 * 1024 * 1024; // 5MB
            if ($_FILES[$inputName]['size'] > $tamanhoMaximo) {
                $_SESSION['aviso'] = "Imagem maior que 5mb";
                header('Location: /slz_alerta/views/cadastro_denuncia.php');
                exit();
            }

            // Define o diretório onde as imagens serão armazenadas
            $diretorio = $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/uploads/denuncias/';

            // Cria o diretório se não existir
            if (!is_dir($diretorio)) {
                mkdir($diretorio, 0755, true);
            }

            // Gera um nome único para o arquivo
            $nomeArquivo = uniqid('img_') . '.' . pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION);

            // Caminho completo no servidor
            $caminhoCompleto = $diretorio . $nomeArquivo;

            // Caminho que será salvo no banco
            $caminhoImagem = 'uploads/denuncias/' . $nomeArquivo;

            // Move o arquivo enviado para o diretório
            move_uploaded_file($_FILES[$inputName]['tmp_name'], $caminhoCompleto);
        }

        return $caminhoImagem;
    }
}
