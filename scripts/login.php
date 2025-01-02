<?php
    $erro = $_SESSION['error'] ?? null;
    unset($_SESSION['error']);

?>
<div class="conteiner mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card bg-light p-5 shadow-mt-5">
                <h3 class="text-center">LOGIN</h3>
                <hr>

                <form action="?rota=login_submit" method="POST">
                    <div class="mb-3">
                        <label for="text_usuario" class="form-label">Usuário</label>
                        <input type="text" name="text_usuario" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="text_senha" class="form-label">Senha</label>
                        <input type="text" name="text_senha" class="form-control" required>
                    </div>
                    <div>
                        <input type="submit" value="Entrar" class="btn btn-secondary w-100">
                    </div>
                </form>
                <?php if (!empty($erro)):?>
                    <div class="alert alert-danger mt-3 p-2 text-center">
                        <?= $erro ?>
                    </div>
                <?php endif?>
            </div>
        </div>
    </div>
</div>
