<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
?>

<section class="align-items-center d-flex justify-content-center">
    <div class="bg-prim opacity-75 d-flex p-5">
        <form method="POST" action="/slz_alerta/controllers/usuario_edt_foto.php" autocomplete="off" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input class="form-control" type="file" id="imagem" name="imagem" accept="image/*">
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Atualizar</button>
        </form>
    </div>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>