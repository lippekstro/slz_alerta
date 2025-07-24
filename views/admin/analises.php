<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';

if (!Auth::estaAutenticado() || !Auth::ehAdmin()) {
    $_SESSION['aviso'] = "Acesso Restrito";
    header('Location: /slz_alerta/index.php');
    exit();
}

$lista = Denuncia::listarParaAnalise();
?>

<section class="d-flex flex-column p-5">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                    <th scope="col">Anonima</th>
                    <th scope="col">Local</th>
                    <th scope="col" colspan="3">Análise</th>
                </tr>
            </thead>
            <?php if (count($lista) > 0): ?>
                <tbody>
                    <?php foreach ($lista as $d): ?>
                        <tr>
                            <td><?= $d['titulo']; ?></td>
                            <td><?= $d['descricao']; ?></td>
                            <td><?= $d['data_denuncia']; ?></td>
                            <td><?= $d['anonima'] == 1 ? 'Sim' : 'Não'; ?></td>
                            <td><?= $d['local_denuncia']; ?></td>
                            <?php if ($d['status_denuncia'] == 'Em Analise'): ?>
                                <td>
                                    <a href="/slz_alerta/controllers/denuncia_aprovar_controller.php?id=<?= $d['id_denuncia']; ?>" class="text-decoration-none text-black d-flex align-center"><span class="material-symbols-outlined">check</span>Aprovar</a>
                                </td>
                            <?php elseif ($d['status_denuncia'] == 'Aceita'): ?>
                                <td>
                                    <a href="/slz_alerta/controllers/denuncia_resolver_controller.php?id=<?= $d['id_denuncia']; ?>" class="text-decoration-none text-black d-flex align-center"><span class="material-symbols-outlined">celebration</span>Resolvida</a>
                                </td>
                            <?php endif; ?>
                            <td><a href="/slz_alerta/controllers/denuncia_reprovar_controller.php?id=<?= $d['id_denuncia']; ?>" class="text-decoration-none text-black d-flex align-center"><span class="material-symbols-outlined">block</span>Reprovar</a></td>
                            <td><a href="/slz_alerta/views/detalhe_denuncia.php?id=<?= $d['id_denuncia']; ?>" class="text-decoration-none text-black d-flex align-center"><span class="material-symbols-outlined">info</span>Detalhes</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table>
    </div>

</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>