<?php
    require_once __DIR__."/../inc/navbar.php";
    include_once __DIR__. '/../inc/config.php'; 
    include_once __DIR__.'/../inc/database.php';
?>

<div class="container mt-4 text-center">
    <div class="row">
        <div class="col">
            <h4>Relatório de Produtos</h4>
        </div>
    </div>
</div>

<?php

    $db = new database();

    // Exemplo de consulta com parâmetros
    $sql = "SELECT * FROM produto";

    //Parametros da consulta
    $params = [];

    // Chama o método para executar a consulta
    $resultados = $db->executarConsulta($sql, $params);

    // Se não houver produtos, mostrar uma mensagem
    if (empty($resultados)) {
        echo "<p>Nenhum produto encontrado.</p>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <!-- Tabela com os dados dos produtos -->
    <table class="table table-light table-striped table-bordered">
        <thead class="table-dark">
            <tr class="text-center">
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
        <tbody class="table-group-divider">
            <?php foreach ($resultados as $produto): ?>
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

    <!-- Botão para exportar para PDF ou Excel -->
    <div class="btn-container text-end mx-2">
        <a href="?rota=exportar_rel" class="btn btn-warning" title="Exportar Relatório">
            <i class="fas fa-print mr-2"></i>
            Exportar Relatório
        </a>
    </div>
</body>
</html>