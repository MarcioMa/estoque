<nav class="container mt-2 pt-4 border rounded-3 shadow-sm bg-light">
    <div class="row mb-3 align-items-center">
        <div class="col">
            <div class="d-inline">
                <a href="?rota=home"><button type="submit" class="btn btn-info">Home</button></a>
            </div>
            <div class="d-inline">
                <a href="?rota=usuario"><button type="submit" class="btn btn-info">Usúario</button></a>
            </div>
            <div class="d-inline">
                <a href="?rota=produto"><button type="submit" class="btn btn-info">Produto</button></a>
            </div>
            <div class="d-inline">
                <a href="?rota=relatorio"><button type="submit" class="btn btn-info">Relatório</button></a>
            </div>
        </div>
        <div class="col text-end">
            <div class="d-inline text-end text-dark"><strong>Login: [<?= $_SESSION['usuario']->usuario ?>]</strong></div>
            <div class="d-inline">
                <a href="?rota=logout"><button type="submit" class="btn btn-danger">Sair</button></a>
            </div>
        </div>
    </div>
</nav>


