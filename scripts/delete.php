<?php
    require_once __DIR__.'/../inc/navbar.php';
    include_once __DIR__.'/../inc/config.php'; 
    include_once __DIR__.'/../inc/database.php';

    //verifica se aconteceu um POST
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Location: index.php?rota=produto');
    exit;
}

$id = $_GET['id']?? null;

if (empty($id)) {
    header('Location: index.php?rota=produto');
    exit;  
}

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$params = [
    ':id' => $id
];

$sql = "SELECT id FROM produto WHERE id = :id";
$result = $db->query($sql, $params);

if ($result['status'] === 'error') {
    header('Location: index.php?rota=404');
    exit;   
}

if (count($result['data']) > 0) {
    $response = $db->execute("DELETE FROM produto WHERE id = '$id';");
    if ($response['status'] === 'Success') {
        echo "<script>alert('Registro deletado com sucesso!')</script>";
        header('Refresh:1; index.php?rota=produto'); 
    } else {
        echo "<script>alert('Error: registro não localizado')</script>";
        header('Refresh:2; index.php?rota=produto');
    }
}else{
    echo "<script>alert('Error: registro não localizado')</script>";
    header('Refresh:2; index.php?rota=produto');

}
?>