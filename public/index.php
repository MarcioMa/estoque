<?php
//inicio da sessão
session_start();

//carregamento da rotas permitidas
$rotas_permitidas = require_once __DIR__."/../inc/rotas.php";

//definição da rota
$rota = $_GET['rota'] ?? 'home';

// Verifica se usuario esta logado
if(!isset($_SESSION['usuario']) && $rota !== 'login_submit'){
    $rota = "login";
}
// se usuario esta logado e entrar no login
if(isset($_SESSION['usuario']) && $rota === 'login'){
    $rota = "home";
}
// se não existe a rota
if (!in_array($rota, $rotas_permitidas)) {
    $rota = '404';
}

// Limpar rota de parâmetros extras, como "page"
$rotaLimpa = strtok($rota, '&');

//preparação da pagina
$script = null;
switch ($rota) {
    case '404':
        $script = '404.php';
        break;
    case 'login':
        $script = 'login.php';
        break;
    case 'login_submit':
        $script = 'login_submit.php';
        break;
    case 'logout':
            $script = 'logout.php';
            break;
    case 'home':
        $script = 'home.php';
        break;
    case 'usuario':
        $script = 'usuario.php';
        break;
    case 'cad_usuario':
        $script = 'cad_usuario.php';
        break;
    case 'produto':
        $script = 'produto.php';
        break;
    case 'cad_produto':
        $script = 'cad_produto.php';
        break;
    case 'relatorio':
        $script = 'relatorio.php';
        break;
    case 'delete':
        $script = 'delete.php';
        break;
    case 'editar':
        $script = 'editar.php';
        break;
    case 'page':
        $script = 'page.php';
        break;
    case 'exportar_rel':
        require_once __DIR__ . '/../tcpdf/tcpdf.php';
        $script = 'exportar_rel.php';
        break;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"><title>Sistema de Estoque</title>
<?php
//carregamento de scripts permanentes
require_once __DIR__."/../inc/config.php";
require_once __DIR__."/../inc/database.php";

//apresentação da pagina
//require_once __DIR__."/../inc/header.php";
require_once __DIR__."/../scripts/$script";
//require_once __DIR__."/../inc/footer.php";

