<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
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
        <h1 class="mb-3">Titulo</h1>
        
        <p class="btn btn-primary mb-3">Status</p>
        
        <p class="d-flex align-center mb-3">
            <span class="material-symbols-outlined me-3">location_on</span> 
            Local
        </p>
        
        <p class="d-flex align-center mb-3">
            <span class="material-symbols-outlined me-3">calendar_month</span>
            Data Registro
        </p>
        
        <div class="d-flex align-items-center mb-3">
            <img class="imagem-redonda me-3" src="https://picsum.photos/100/100?random=1">
            <p>Usuario</p>
        </div>
        
        <h4>Descrição do Problema</h2>
        <p class="justify-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda cumque, enim modi deleniti eveniet itaque facilis! Nulla fugit vero voluptatem neque, molestiae quo quasi blanditiis id nisi? Sit, ipsum impedit?</p>
        
        <h4>Imagens</h3>
        <div class="card-container">
            <img class="card-img-top" src="https://picsum.photos/500/500?random=1">
            <img class="card-img-top" src="https://picsum.photos/500/500?random=1">
            <img class="card-img-top" src="https://picsum.photos/500/500?random=1">
        </div>
    </div>

    <div>

    </div>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>