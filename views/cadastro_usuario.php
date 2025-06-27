<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
?>

<section class="align-items-center d-flex hero justify-content-center">
    <div class="bg-prim opacity-75 d-flex p-5">
        <form method="POST" action="/slz_alerta/controllers/usuario_add_controller.php" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3 text-center">
                <a class="h3 mb-3 fw-normal text-decoration-none" href="/slz_alerta/views/login.php">Login</a>
                <span class="h3 mb-3 fw-normal">/</span>
                <a class="h3 mb-3 fw-normal text-decoration-none" href="/slz_alerta/views/cadastro_usuario.php">Cadastrar</a>
            </div>
            
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingNome" placeholder="name@exemplo.com" name="nome" required>
                <label for="floatingNome">Nome</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmail" placeholder="name@exemplo.com" name="email" required>
                <label for="floatingEmail">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="tel" class="form-control" id="floatingTel" placeholder="name@exemplo.com" name="telefone" required>
                <label for="floatingTel">Telefone</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingCpf" placeholder="name@exemplo.com" name="cpf" required>
                <label for="floatingCpf">CPF</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingSenha" placeholder="Senha" name="senha" required>
                <label for="floatingSenha">Senha</label>
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input class="form-control" type="file" id="imagem" name="imagem" accept="image/*">
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Cadastrar</button>
        </form>
    </div>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>