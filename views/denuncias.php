<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';

if (isset($_GET['busca'])) {
    $lista = Denuncia::listarPorTermo($_GET['busca']);
} elseif(isset($_GET['filtro'])) {
    $lista = Denuncia::listarPorFiltro($_GET['filtro']);
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

    <div class="historico-container">
        <div>
            <form action="" method="get" class="text-white">
                <div class="mb-2">
                    <input type="radio" class="form-check-input " id="rad_resolvidas" name="filtro" value="Resolvido">
                    <label class="form-check-label" for="rad_resolvidas">Resolvidas</label>
                </div>
                <div class="mb-2">
                    <input type="radio" class="form-check-input " id="rad_aceitas" name="filtro" value="Aceita">
                    <label class="form-check-label" for="rad_aceitas">Aceitas</label>
                </div>

                <div class="mb-3">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Filtrar</button>
                </div>
            </form>
        </div>

        <div class="alert">
            <?php if (count($lista) > 0): ?>
                <div class="container-cartoes">
                    <?php foreach ($lista as $d): ?>
                        <?php
                        $imagens = explode(',', $d['imagens']);
                        $primeiraImagem = $imagens[0];
                        ?>
                        <div class="card" style="width: 18rem; height: 24rem;">
                            <div class="w-100">
                                <img class="card-img-top preencher-imagem" src="/slz_alerta/<?= $primeiraImagem; ?>" width="200px" height="200px">
                            </div>

                            <a href="/slz_alerta/views/detalhe_denuncia.php?id=<?= $d['id_denuncia']; ?>" class="text-decoration-none text-black">
                                <div class="card-body position-relative w-100">
                                    <h5 class="card-title text-center"><?= $d['titulo']; ?></h5>
                                    <p class="card-text justify-text texto-card"><?= $d['descricao']; ?></p>
                                    <?php if ($d['status_denuncia'] == 'Resolvido'): ?>
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
        </div>
    </div>

</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>