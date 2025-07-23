<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';

if(isset($_GET['busca'])){
    $lista = Denuncia::listarPorTermo($_GET['busca']);
} else {
    $lista = Denuncia::listarAceitas();
}

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
        <form class="d-flex" role="search" method="GET" action="<?= $_SERVER["PHP_SELF"]; ?>" autocomplete="off">
            <input class="form-control me-2" type="search" placeholder="Buscar Denúncias" aria-label="Search" name="busca">
            <button class="btn btn-outline-success d-flex align-center text-white" type="submit">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>
    </div>

    <?php if(count($lista) > 0): ?>
        <div class="card-container">
            <?php foreach($lista as $d): ?>
            <?php 
                $imagens = explode(',', $d['imagens']);
                $primeiraImagem = $imagens[0];    
            ?>
                <div class="card" style="width: 18rem;">
                    <div class="">
                        <img class="card-img-top preencher-imagem" src="/slz_alerta/<?= $primeiraImagem; ?>" width="200px" height="200px">
                    </div>
                    
                    <a href="/slz_alerta/views/detalhe_denuncia.php?id=<?= $d['id_denuncia']; ?>" class="text-decoration-none text-black">
                        <div class="card-body position-relative">
                            <h5 class="card-title text-center"><?= $d['titulo']; ?></h5>
                            <p class="card-text justify-text"><?= $d['descricao']; ?></p>
                            <?php if($d['status_denuncia'] == 'Resolvido'): ?>
                                <span class="material-symbols-outlined position-absolute top-0 end-0 text-success fs-1" title="resolvido">check_circle</span>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <section class="text-white">
            <p>Nenhuma Denúncia Encontrada</p>
        </section>
    <?php endif; ?>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>