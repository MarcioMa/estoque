<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<nav class="container mt-2 pt-4 border rounded-3 shadow-sm bg-light">
    <div class="row mb-3 align-items-center">
        <div class="col">
            <div class="d-inline">
                <a href="?rota=home"><button type="submit" class="btn btn-info"><i class="fa fa-home"></i> Home</button></a>
            </div>
            <div class="d-inline">
                <a href="?rota=usuario"><button type="submit" class="btn btn-info"><i class="fa fa-users"></i> Usúario</button></a>
            </div>
            <div class="d-inline">
                <a href="?rota=produto"><button type="submit" class="btn btn-info"><i class="fa fa-laptop"></i> Produto</button></a>
            </div>
            <div class="d-inline">
                <a href="?rota=relatorio"><button type="submit" class="btn btn-info"><i class="fa fa-file-text"></i> Relatório</button></a>
            </div>
        </div>
        <div class="col text-end">
            <div class="d-inline text-end text-dark"><strong>Login: [<?= $_SESSION['usuario']->usuario ?>]</strong></div>
            <div class="d-inline">
                <a href="?rota=logout"><button type="submit" class="btn btn-danger">Sair <i class="fa fa-sign-out"></i> </button></a>
            </div>
        </div>
    </div>
</nav>


