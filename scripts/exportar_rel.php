<?php
// Carrega o navbar, configurações e a classe de banco de dados
include_once __DIR__. '/../inc/config.php'; 
include_once __DIR__.'/../inc/database.php';

// Conectar ao banco de dados
$db = new database();

// Consulta para obter todos os produtos
$sql = "SELECT * FROM produto";
$params = [];
$resultados = $db->executarConsulta($sql, $params);

// Verifica se existem produtos
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
    <style>
        /* Estilo para a página */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        #toplogo{
            display: none;
        }
        h1 {
            text-align: center;
            font-size: 24px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        /* Estilo para a impressão */
        @media print {
            body {
                margin: 0;
                font-size: 12px;
            }
            table {
                border: 1px solid black;
            }
            th, td {
                border: 1px solid black;
            }
            h1{
                margin:2px;
                margin-top: 3px;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <h1>Relatório de Produtos</h1>
    

    <table>
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Marca</th>
                <th>Status</th>
                <th>Situação</th>
                <th>Modelo</th>
                <th>Patrimônio</th>
                <th>Data Entrada</th>
                <th>Data Garantia</th>
                <th>Especificações Técnicas</th>
            </tr>
        </thead>
        <tbody>
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

    <div class="no-print text-end mt-3">
        <button class="mx-2" onclick="window.location.href='index.php?rota=relatorio'">Voltar</button>
        <button onclick="window.print();">Imprimir...</button>
    </div>
</body>
</html>
