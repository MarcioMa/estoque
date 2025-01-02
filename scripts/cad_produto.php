<?php
//verifica se aconteceu um POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?rota=produto');
    exit;
}

// Verifica se o checkbox 'status' foi marcado
if ($_POST['status'] === 'ativo') {
    $status = "Ativo";
} else {
    $status = "Inativo";
}
//Busca dados method POST
$categoria = $_POST['categoria']?? null;
$marca = $_POST['marca']?? null;
$situacao = $_POST['situacao']?? null;
$modelo = $_POST['modelo']?? null;
$patrimonio = $_POST['patrimonio']?? null;
$data_entrada = $_POST['data_entrada']?? null;
$data_garantia = $_POST['data_garantia']?? null;
$espec_tecnicas = $_POST['espec_tecnicas']?? null;

//verifica foi preenchido dados correto
if (empty($status) || empty($categoria) || empty($marca) || empty($situacao) || empty($modelo) 
|| empty($patrimonio) || empty($data_entrada) || empty($data_garantia) || empty($espec_tecnicas)) {
    header('Location: index.php?rota=produto');
    exit;  
}

// Instanciar a classe Database
$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

// Executar um INSERT
$response = $db->execute("INSERT INTO produto (status, categoria, marca, situacao, modelo, patrimonio, data_entrada, data_garantia, espec_tecnicas) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", [$status, $categoria, $marca, $situacao, $modelo, $patrimonio, $data_entrada, $data_garantia, $espec_tecnicas]);

if ($response['status'] === 'Success') {
    echo "<script>alert('[ ".$response['affected_rows']." ] Registro cadastrado com sucesso!')</script>";
    //echo "<h1 style='text-align:center; color:green;'>[".$response['affected_rows']."] Registro cadastrado com sucesso!</h1>";
    header('Refresh:2; index.php?rota=produto');
} else {
    echo "Erro: " . $response['data'];
}
