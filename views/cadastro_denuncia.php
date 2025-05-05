<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
?>

<section class="p-5">
    <div class="text-black p-3 rounded bg-white mb-3">
        <h1>Nova Denúncia</h1>
        <p>Preencha o formulário abaixo para registrar uma denúncia sobre problemas urbanos em São Luís</p>
    </div>

    <div class="text-white mb-3">
        <h2>Informações Básicas</h2>
        <form action="">
            <div class="row">
                <div class="mb-1">
                    <label for="titulo" class="form-label">Título<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="titulo" placeholder="Ex: Buraco em Via Pública" required>
                </div>
                <div class="mb-1">
                    <label for="descricao" class="form-label">Descrição Detalhada<span class="text-danger">*</span></label>
                    <textarea class="form-control" id="descricao" rows="3" required></textarea>
                </div>
                <div class="mb-1">
                    <label for="categoria" class="form-label">Categoria<span class="text-danger">*</span></label>
                    <select class="form-select" id="categoria" required>
                        <option value="">Selecione...</option>
                        <option>Teste</option>
                    </select>
                </div>
                <div class="mb-1 col-lg-8">
                    <label for="endereco" class="form-label">Endereço<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="endereco" placeholder="Ex: Rua das Flores, 123" required>
                </div>
                <div class="mb-1 col-lg-4">
                    <label for="bairro" class="form-label">Bairro<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="bairro" placeholder="Ex: Centro" required>
                </div>
                <div class="mb-1">
                    <label for="referencia" class="form-label">Ponto de Referência<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="referencia" placeholder="Ex: Próximo ao supermercado X" required>
                </div>
                <div class="mb-1">
                    <label for="imagens" class="form-label">Imagens</label>
                    <input class="form-control" type="file" id="imagens" multiple>
                    <span class="fs-6 fst-italic">Adicione até 3 imagens que mostrem claramente o problema. Tamanho máximo 5MB por imagem.</span>
                </div>
                <div class="mb-5">
                    <input type="checkbox" class="form-check-input" id="same-address">
                    <label class="form-check-label" for="same-address">Concordo com os termos e condições<span class="text-danger">*</span></label>
                </div>
                <div class="row justify-content-end">
                    <div class="mb-3 col-lg-2">
                        <button class="w-100 btn btn-secondary btn-lg" type="reset">Cancelar</button>
                    </div>
                    <div class="mb-3 col-lg-2">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Enviar Denúncia</button>
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