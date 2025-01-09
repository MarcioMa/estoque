<?php
include_once __DIR__.'/../inc/config.php'; 
include_once __DIR__.'/../inc/database.php';

try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro de conexão: ' . $e->getMessage()]);
    exit;
}

if (isset($_GET['patrimonio']) && preg_match('/^\d+$/', $_GET['patrimonio'])) {
    $patrimonio = $_GET['patrimonio'];

    try {
        $stmt = $pdo->prepare("SELECT marca, modelo FROM produto WHERE patrimonio = :patrimonio");
        $stmt->bindParam(':patrimonio', $patrimonio, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $produto = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'marca' => $produto['marca'], 'modelo' => $produto['modelo']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Produto não encontrado']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erro ao consultar o banco: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Patrimônio inválido']);
}
?>
