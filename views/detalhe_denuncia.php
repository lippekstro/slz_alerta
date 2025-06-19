<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';

$denuncia = Denuncia::listarPorId($_GET['id']);
$imagens = explode(',', $denuncia['imagens']);
$categorias = explode(',', $denuncia['categorias']);

// echo '<pre>';
// var_dump($denuncia);
// echo '</pre>';
// exit();

?>

<section class="d-flex flex-column p-5">
    <div class="d-flex justify-content-between align-items-center flex-column flex-lg-row mb-3">
        <a href="javascript:history.back()" class="d-flex align-center text-decoration-none">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar para a lista
        </a>
        <div class="d-flex flex-column flex-lg-row">
            <button class="w-100 btn btn-primary d-flex align-center m-3 justify-content-center" type="button">
                <span class="material-symbols-outlined">thumb_up</span>
            </button>
            <button class="w-100 btn btn-primary d-flex align-center m-3 justify-content-center" type="button">
                <span class="material-symbols-outlined">share</span>
                Compartilhar
            </button>
            <button class="w-100 btn btn-primary d-flex align-center m-3 justify-content-center" type="button">
                <span class="material-symbols-outlined">flag</span>
                Denunciar
            </button>
        </div>
    </div>

    <div class="text-white">
        <h1 class="mb-3"><?= $denuncia['titulo']; ?></h1>

        <p class="btn btn-primary mb-3"><?= $denuncia['status_denuncia']; ?></p>

        <h2 class="mb-3">Categorias:</h2>
        <?php foreach($categorias as $c): ?>
            <span class="badge text-bg-secondary"><?= $c; ?></span>
        <?php endforeach; ?>
        
        <p class="d-flex align-center my-3">
            <span class="material-symbols-outlined me-3">location_on</span>
            <?= $denuncia['local_denuncia']; ?>
        </p>

        <p class="d-flex align-center mb-3">
            <span class="material-symbols-outlined me-3">calendar_month</span>
            <?= $denuncia['data_denuncia']; ?>
        </p>

        <div class="d-flex align-items-center mb-3">
            <?php if ($denuncia['anonima'] == 1): ?>
                <img class="imagem-redonda me-3" src="/slz_alerta/imgs/dummy_usuario.png" width="100px" height="100px">
                <p>Denuncia Anonima</p>
            <?php else: ?>
                <img class="imagem-redonda me-3" src="/slz_alerta/<?= $denuncia['foto']; ?>" width="100px" height="100px">
                <p><?= $denuncia['nome']; ?></p>
            <?php endif; ?>
        </div>

        <h4>Descrição do Problema</h2>
            <p class="justify-text"><?= $denuncia['descricao']; ?></p>

            <h4>Imagens</h4>
            <div class="card-container">
                <?php foreach ($imagens as $imagem): ?>
                    <img class="card-img-top preencher-imagem" src="/slz_alerta/<?= $imagem; ?>" width="500px" height="500px">
                <?php endforeach; ?>
            </div>
    </div>

    <div>

    </div>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>