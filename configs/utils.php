<?php

class Utils
{
    public static function salvarImagemUsuario($inputName = 'imagem')
    {
        $caminhoImagem = 'imgs/dummy_usuario.png'; // Placeholder padrão

        if (!empty($_FILES[$inputName]['tmp_name'])) {
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
