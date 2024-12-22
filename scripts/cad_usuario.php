<?php
//verifica se aconteceu um POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?rota=usuario');
    exit;
}

//Busca dados method POST
$usuario = $_POST['usuario']?? null;
$email = $_POST['email']?? null;
$senha = password_hash($_POST['senha'])?? null;
$nivel = $_POST['nivel']?? null;

//verifica foi preenchido dados correto
if (empty($usuario) || empty($email) || empty($senha) || empty($nivel)) {
    header('Location: index.php?rota=usuario');
    exit;  
}

// Instanciar a classe Database
$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

// Executar uma consulta INSERT
$response = $db->execute("INSERT INTO usuarios (usuario, email, senha, nivel) VALUES (?, ?, ?, ?)", [$usuario, $email, $senha, $nivel]);

if ($response['status'] === 'Success') {
    echo $response['affected_rows'] . " linha(s) afetada(s) cadastrado com sucesso!";
    header('Refresh:2; index.php?rota=usuario');
} else {
    echo "Erro: " . $response['data'];
}
