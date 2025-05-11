<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';

$denuncia = Denuncia::listarPorId($_GET['id']);
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
        
        <p class="d-flex align-center mb-3">
            <span class="material-symbols-outlined me-3">location_on</span> 
            <?= $denuncia['local_denuncia']; ?>
        </p>
        
        <p class="d-flex align-center mb-3">
            <span class="material-symbols-outlined me-3">calendar_month</span>
            <?= $denuncia['data_denuncia']; ?>
        </p>
        
        <div class="d-flex align-items-center mb-3">
            <img class="imagem-redonda me-3" src="/slz_alerta/imgs/dummy_usuario.png" width="100px" height="100px">
            <p><?= $denuncia['nome']; ?></p>
        </div>
        
        <h4>Descrição do Problema</h2>
        <p class="justify-text"><?= $denuncia['descricao']; ?></p>
        
        <h4>Imagens</h3>
        <div class="card-container">
            <img class="card-img-top preencher-imagem" src="/slz_alerta/<?= $denuncia['arquivo']; ?>" width="500px" height="500px">
        </div>
    </div>

    <div>

    </div>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>