<?php
//verifica se aconteceu um POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?rota=login');
    exit;
}

//Busca dados method POST
$usuario = $_POST['text_usuario']?? null;
$senha = $_POST['text_senha']?? null;

//verifica foi preenchido dados correto
if (empty($usuario) || empty($senha)) {
    header('Location: index.php?rota=login');
    exit;  
}

//Validar acesso no db
$db = new database();
$params = [
    ':usuario' => $usuario
];

$sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
$result = $db->query($sql, $params);

//verificar error
if ($result['status'] === 'error') {
    header('Location: index.php?rota=404');
    exit;   
}

//verificar se existe registro no db
if (count($result['data']) === 0) {

    //erro na sessão
    $_SESSION['error'] = 'Usuário ou senha inválidos';
    header('Location: index.php?rota=login');
    exit;   
}

//verificar se existe registro no db
if (!password_verify($senha, $result['data'][0]->senha)) {

    //erro na sessão
    $_SESSION['error'] = 'Usuário ou senha inválidos';
    header('Location: index.php?rota=login');
    exit;   
}

//define a sessão estive tudo ok
$_SESSION['usuario'] = $result['data'][0];

//Redirecionar para pagina home
header('Location: index.php?rota=home');