<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
?>

<section class="d-flex flex-column p-5">
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-outline-primary d-flex align-center text-white" href="/slz_alerta/views/cadastro_denuncia.php">
            <span class="material-symbols-outlined">warning</span>
            Nova Denúncia
        </a>
    </div>

    <div class="text-white mb-3">
        <h1>Denúncias</h1>
        <p>Explore todas as denúncias registradas em São Luís. Use os filtros para encontrar problemas específicos.</p>
    </div>

    <div class="mb-5">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Buscar Denúncias" aria-label="Search">
            <button class="btn btn-outline-success d-flex align-center text-white" type="submit">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>
    </div>

    <div class="card-container">
        <?php for($i = 0; $i < 4; $i++): ?>
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://picsum.photos/200/100?random=1">
                <a href="/slz_alerta/views/detalhe_denuncia.php" class="text-decoration-none text-black">
                    <div class="card-body">
                        <h5 class="card-title">Titulo</h5>
                        <p class="card-text justify-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, eius. Quis soluta deserunt similique ipsa atque, labore eius ullam quisquam eos alias tempore eveniet expedita! Harum saepe eligendi animi recusandae?</p>
                    </div>
                </a>
            </div>
        <?php endfor; ?>
    </div>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>