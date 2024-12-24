<?php
require_once __DIR__."/../inc/navbar.php";
include_once __DIR__. '/../inc/config.php'; 
include_once __DIR__.'/../inc/database.php';
?>

<div class="container mt-5 text-center">
    <div class="row">
        <div class="col">
            <h4>Relatório</h4>
        </div>
    </div>
</div>

<?php
// Instanciar a classe Database
$db = new database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

// Consultar todos os produtos
$sql = "SELECT * FROM produto"; 
$response = $db->query($sql);

// Verifique o status da resposta
if ($response['status'] !== 'Success') {
    die("Erro: " . $response['data']);
}

// Acessar os dados retornados
$produtos = $response['data'];

// Se não houver produtos, mostrar uma mensagem
if (empty($produtos)) {
    echo "<p>Nenhum produto encontrado.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Arquivo CSS para estilo -->
</head>
<body>

    <h3>Relatório de Produtos</h3>

    <!-- Tabela com os dados dos produtos -->
    <table border="1">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Marca</th>
                <th>Status</th>
                <th>Situação</th>
                <th>Modelo</th>
                <th>Patrimônio</th>
                <th>Data de Entrada</th>
                <th>Data de Garantia</th>
                <th>Especificações Técnicas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($produto['categoria']); ?></td>
                    <td><?php echo htmlspecialchars($produto['marca']); ?></td>
                    <td><?php echo htmlspecialchars($produto['status']); ?></td>
                    <td><?php echo htmlspecialchars($produto['situacao']); ?></td>
                    <td><?php echo htmlspecialchars($produto['modelo']); ?></td>
                    <td><?php echo htmlspecialchars($produto['patrimonio']); ?></td>
                    <td><?php echo htmlspecialchars($produto['data_entrada']); ?></td>
                    <td><?php echo htmlspecialchars($produto['data_garantia']); ?></td>
                    <td><?php echo htmlspecialchars($produto['espec_tecnicas']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Botão para exportar para PDF ou Excel, por exemplo -->
    <div>
        <a href="exportar_relatorio.php" class="btn-export">Exportar Relatório</a>
    </div>

</body>
</html>
