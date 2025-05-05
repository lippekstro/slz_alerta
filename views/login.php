<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_header.php';
?>

<section class="align-items-center d-flex hero justify-content-center">
    <div class="bg-prim opacity-75 d-flex p-5">
        <form class="">
            <div class="mb-3 text-center">
                <a class="h3 mb-3 fw-normal text-decoration-none" href="/slz_alerta/views/login.php">Login</a>
                <span class="h3 mb-3 fw-normal">/</span>
                <a class="h3 mb-3 fw-normal text-decoration-none" href="/slz_alerta/views/cadastro_usuario.php">Cadastrar</a>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmail" placeholder="nome@exemplo.com">
                <label for="floatingEmail">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingSenha" placeholder="Senha">
                <label for="floatingSenha">Senha</label>
            </div>
            
            <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>
        </form>
    </div>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/slz_alerta/templates/_footer.php';
?>