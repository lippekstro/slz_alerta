<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';

if (!Auth::estaAutenticado()) {
    $_SESSION['aviso'] = "Faça Login";
    header('Location: /slz_alerta/index.php');
    exit();
}

$usuario = new Usuario($_SESSION['id_usuario']);

?>

<section class="align-items-center d-flex hero justify-content-center">
    <div class="bg-prim opacity-75 d-flex p-5">
        <form method="POST" action="/slz_alerta/controllers/usuario_edt_controller.php" autocomplete="off" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingNome" placeholder="name@exemplo.com" name="nome" value="<?= $usuario->getNome() ?>" required>
                <label for="floatingNome">Nome</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmail" placeholder="name@exemplo.com" name="email" value="<?= $usuario->getEmail() ?>" required>
                <label for="floatingEmail">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="tel" class="form-control" id="floatingTel" placeholder="name@exemplo.com" name="telefone" value="<?= $usuario->getTelefone() ?>" required>
                <label for="floatingTel">Telefone</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingCpf" placeholder="name@exemplo.com" name="cpf" value="<?= $usuario->getCpf() ?>" required>
                <label for="floatingCpf">CPF</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Atualizar</button>
        </form>
    </div>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>