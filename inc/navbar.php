<nav class="container mt-5 pt-4 border rounded-3 shadow-sm bg-light">
    <div class="row align-items-center">
        <div class="col">
        <h4 class="text-uppercase">Estoque-Web</h4>
        </div>
        <div class="col text-center">
            <a href="?rota=home">Home</a>
            <span class="mx-2">|</span>
            <a href="?rota=cad_usuario">Usuário</a>
            <span class="mx-2">|</span>
            <a href="?rota=cad_produto">Produto</a>
            <span class="mx-2">|</span>
            <a href="?rota=relatorio">Relatório</a>
        </div>
        <div class="col text-end">
            <span><strong><?= $_SESSION['usuario']->usuario ?></strong></span>
            <span class="mx-2">|</span>
            <a href="?rota=logout">Sair</a>
        </div>
    </div>
</nav>