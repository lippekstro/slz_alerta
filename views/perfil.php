<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['aviso'] = "Você deve estar logado para ver o perfil";
    header('Location: /slz_alerta/views/login.php');
}

?>

<section class="align-items-center d-flex justify-content-center">
    <div class="p-2 p-lg-5 bg-white rounded">
        <div class="d-flex">
            <div class="position-relative d-inline-block mx-3" style="width: 200px; height: 200px;">
                <img class="imagem-redonda w-100 h-100" src="/slz_alerta/<?= $_SESSION['foto_usuario']; ?>" style="object-fit: cover; border-radius: 50%;">

                <!-- Botão edit no canto inferior direito da imagem -->
                <a href="/slz_alerta/views/editar_foto_perfil.php?id=<?= $_SESSION['id_usuario']; ?>"
                    class="position-absolute bottom-0 end-0 m-1 btn btn-sm btn-primary rounded-circle">
                    <span class="material-symbols-outlined">edit</span>
                </a>
            </div>

            <div>
                <div>
                    <p class="fs-1"><?= $_SESSION['nome'] ?></p>
                </div>

                <div class="d-flex">
                    <span class="material-symbols-outlined">email</span>
                    <p class="fs-6"><?= $_SESSION['email'] ?></p>
                </div>

                <div class="d-flex">
                    <span class="material-symbols-outlined">call</span>
                    <p class="fs-6"><?= $_SESSION['telefone'] ?></p>
                </div>
            </div>
        </div>

        <hr>

        <div class="d-flex justify-content-center">
            <div class="mb-3">
                <a href="/slz_alerta/views/editar_perfil.php?id=<?= $_SESSION['id_usuario']; ?>" class="btn btn-primary btn-lg">Editar</a>
            </div>
        </div>
    </div>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>