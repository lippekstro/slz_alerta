<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';

if (!Auth::estaAutenticado()) {
    $_SESSION['aviso'] = "Faça Login";
    header('Location: /slz_alerta/index.php');
    exit();
}

$lista = Denuncia::listarProprias($_SESSION['id_usuario']);

?>

<section class="d-flex flex-column p-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Título</th>
                <th scope="col">Descrição</th>
                <th scope="col">Data</th>
                <th scope="col">Anonima</th>
                <th scope="col">Local</th>
                <th scope="col">Status</th>
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
                        <td><?= $d['status_denuncia']; ?></td>
                        <td><a href="/slz_alerta/views/editar_denuncia.php?id=<?= $d['id_denuncia']; ?>" class="text-decoration-none text-black d-flex align-center"><span class="material-symbols-outlined">edit</span>Editar</a></td>
                        <td><a href="/slz_alerta/controllers/denuncia_reprovar_controller.php?id=<?= $d['id_denuncia']; ?>" class="text-decoration-none text-black d-flex align-center"><span class="material-symbols-outlined">block</span>Deletar</a></td>
                        <td><a href="/slz_alerta/views/detalhe_denuncia.php?id=<?= $d['id_denuncia']; ?>" class="text-decoration-none text-black d-flex align-center"><span class="material-symbols-outlined">info</span>Detalhes</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        <?php endif; ?>
    </table>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>