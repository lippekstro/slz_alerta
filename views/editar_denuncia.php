<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/denuncia.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/models/tipo_denuncia.php';

if (!Auth::estaAutenticado()) {
    $_SESSION['aviso'] = "Faça Login";
    header('Location: /slz_alerta/index.php');
    exit();
}

$categorias = TipoDenuncia::listar();
$lista = Denuncia::listarPorId($_GET['id']);

$categoriasSelecionadas = [];
if (!empty($lista['categorias_ids'])) {
    $categoriasSelecionadas = explode(',', $lista['categorias_ids']);
}

$local = $lista['local_denuncia'];
if (preg_match('/^(.*?)\s*\((.*?)\),\s*(.*)$/', $local, $matches)) {
    $endereco = trim($matches[1]);     
    $referencia = trim($matches[2]);   
    $bairro = trim($matches[3]);       
}

?>

<section class="p-5">
    <div class="text-black p-3 rounded bg-white mb-3">
        <h1>Editar Denúncia</h1>
        <p>Altere o formulário abaixo para editar uma denúncia sobre problemas urbanos em São Luís</p>
        <p>Ao atualizar a denúncia ela voltará para o estado de análise e só sera exibida na página principal após algum administrador avaliá-la</p>
    </div>

    <div class="text-white mb-3">
        <h2>Informações Básicas</h2>
        <form method="POST" action="/slz_alerta/controllers/denuncia_edit_controller.php" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="id_denuncia" value="<?= $lista['id_denuncia'] ?>">
            <div class="row">
                <div class="mb-1">
                    <label for="titulo" class="form-label">Título<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="titulo" placeholder="Ex: Buraco em Via Pública" name="titulo" value="<?= $lista['titulo'] ?>" required>
                </div>
                <div class="mb-1">
                    <label for="descricao" class="form-label">Descrição Detalhada<span class="text-danger">*</span></label>
                    <textarea class="form-control" id="descricao" rows="3" name="descricao" required><?= $lista['descricao'] ?></textarea>
                </div>
                <div class="mb-1">
                    <fieldset>
                        <legend>Categorias<span class="text-danger">*</span></legend>
                        <div class="row">
                            <?php foreach ($categorias as $c) : ?>
                                <div class="col-md-4 mb-2">
                                    <input type="checkbox" class="form-check-input " id="chk_<?= $c['id_categoria'] ?>" name="categoria[]" value="<?= $c['id_categoria'] ?>" <?= in_array($c['id_categoria'], $categoriasSelecionadas) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="chk_<?= $c['id_categoria'] ?>"><?= $c['nome'] ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </fieldset>
                </div>
                <div class="mb-1 col-lg-8">
                    <label for="endereco" class="form-label">Endereço<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="endereco" placeholder="Ex: Rua das Flores, 123" name="endereco" value="<?= $endereco ?>" required>
                </div>
                <div class="mb-1 col-lg-4">
                    <label for="bairro" class="form-label">Bairro<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="bairro" placeholder="Ex: Centro" name="bairro" value="<?= $bairro ?>" required>
                </div>
                <div class="mb-1">
                    <label for="referencia" class="form-label">Ponto de Referência<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="referencia" placeholder="Ex: Próximo ao supermercado X" name="referencia" value="<?= $referencia ?>" required>
                </div>
                <!-- <div class="mb-1">
                    <label for="imagens" class="form-label">Imagens</label>
                    <input class="form-control" type="file" id="imagens" name="imagens[]" accept="image/*" multiple>
                    <span class="fs-6 fst-italic">Adicione até 3 imagens que mostrem claramente o problema. Tamanho máximo 5MB por imagem.</span>
                </div> -->
                <div class="mb-5">
                    <input type="checkbox" class="form-check-input" id="same-address" name="anonima" value="1">
                    <label class="form-check-label" for="same-address">Denuncia Anonima<span class="text-danger">*</span></label>
                </div>
                <div class="row justify-content-end">
                    <div class="mb-3 col-lg-2">
                        <button class="w-100 btn btn-secondary btn-lg" type="reset">Cancelar</button>
                    </div>
                    <div class="mb-3 col-lg-2">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Atualizar Denúncia</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <div>

    </div>
</section>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>