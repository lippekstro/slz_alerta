<?php if(isset($_SESSION['aviso'])): ?>
    <section class="p-5">
        <div class="alert alert-info text-center" role="alert">
            <?= $_SESSION['aviso'] ?>
        </div>
    </section>
    <?php unset($_SESSION['aviso']); ?>
<?php endif; ?>