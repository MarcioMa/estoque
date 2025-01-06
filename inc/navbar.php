<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-light bg-light w-100 mt-2 pt-4 border rounded-3 shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="?rota=home">
            <button type="button" class="btn btn-info"><i class="fa fa-home"></i> Home</button>
        </a>

        <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']->nivel == 0): ?>
            <a class="navbar-brand" href="?rota=usuario">
                <button type="button" class="btn btn-info"><i class="fa fa-users"></i> Usuário</button>
            </a>

        <a class="navbar-brand" href="?rota=produto">
            <button type="button" class="btn btn-info"><i class="fa fa-laptop"></i> Equipamento</button>
        </a>
        <?php endif; ?>

        <a class="navbar-brand" href="?rota=requisicao">
            <button type="button" class="btn btn-info"><i class="fa-solid fa-right-left"></i> Requisição</button>
        </a>

        <a class="navbar-brand" href="?rota=relatorio">
            <button type="button" class="btn btn-info"><i class="fa fa-file-text"></i> Relatório</button>
        </a>

        <div class="ml-auto">
        <a href="?rota=logout">
                <button type="button" class="btn btn-danger"> Sair <i class="fa fa-sign-out"></i></button></a>
            <span class="me-2"><strong> Login: [<?= $_SESSION['usuario']->usuario ?>]</strong></span>
        </div>
    </div>
</nav>

