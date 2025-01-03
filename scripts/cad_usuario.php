<?php
//verifica se aconteceu um POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?rota=usuario');
    exit;
}

//Busca dados method POST
$usuario = $_POST['usuario']?? null;
$email = $_POST['email']?? null;
$senha = $_POST['senha']?? null;
$nivel = $_POST['nivel']?? null;

//verifica foi preenchido dados correto
if (empty($usuario) || empty($email) || empty($senha) || empty($nivel)) {
    header('Location: index.php?rota=usuario');
    exit;  
}

//Gerar a senha com hash
$senha = password_hash($senha, PASSWORD_DEFAULT);

// Instanciar a classe Database
$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

// Executar uma consulta INSERT
$response = $db->execute("INSERT INTO usuarios (usuario, email, senha, nivel) VALUES (?, ?, ?, ?)", [$usuario, $email, $senha, $nivel]);

if ($response['status'] === 'Success') {
    echo "<script>alert('[ ".$response['affected_rows']." ] Registro cadastrado com sucesso!')</script>";
    header('Refresh:2; index.php?rota=usuario');
} else {
    echo "Erro: " . $response['data'];
}
