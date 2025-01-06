<?php
// Carrega o navbar, configurações e a classe de banco de dados
include_once __DIR__. '/../inc/config.php'; 
include_once __DIR__.'/../inc/database.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
    
<?php
    // Valor padrão
    $filtro = '*';
            
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Capturar e validar o filtro
        $filtro = isset($_POST['filtro']) ? $_POST['filtro'] : '*';

        // Validar e sanitizar $filtro conforme necessário
    }

    $db = new database();

    // Exemplo de consulta com parâmetros
    $sql = "SELECT * FROM produto WHERE 1=1";

    //Parametros da consulta
    $params = [];

    // Condicionais para aplicar o filtro
    if ($filtro !== '*') {
        // Verificando se é uma categoria, marca ou status
        if (in_array($filtro, ['Computador', 'Notebook', 'Periférico', 'Acessório'])) {
            $sql .= " AND categoria = :filtro";
        } elseif (in_array($filtro, ['Apple', 'Acer', 'Asus', 'Dell', 'HP', 'Lenovo', 'Samsung', 'Positivo', 'Compaq', 'Multilaser', 'Outro'])) {
            $sql .= " AND marca = :filtro";
        } else {
            $sql .= " AND status = :filtro";
        }

        // Adiciona o filtro aos parâmetros
        $params[':filtro'] = $filtro;
    }

    // Chama o método para executar a consulta
    $resultados = $db->executarConsulta($sql, $params);
?>

<!-- Exibir tabela de resultados -->
<?php if (!empty($resultados)) : ?>
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
                    <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($produto['data_entrada']))); ?></td>
                    <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($produto['data_garantia']))); ?></td>
                    <td><?php echo htmlspecialchars($produto['espec_tecnicas']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php else : ?>
            <p>Nenhum produto encontrado.</p>
    <?php endif; ?>

    <div class="no-print text-end mt-3">
        <div class="row">
            <div class="col">
                <button class="btn btn-info" onclick="window.location.href='index.php?rota=relatorio'"><i class="fa fa-arrow-left"></i> Voltar</button>
                <button class="btn btn-warning" onclick="window.print()"> <i class="fas fa-print mr-2"></i> Imprimir</button>
            </div>
            <div class="col">
                <form method="POST" action="">
                    <label for="filtro" style="font-weight:bold;">Filtra por:</label>
                    <select name="filtro" id="filtro" style="width:200px; height: 40px; text-align:center;">
                            <option value="*">Todos registros</option>
                        <optgroup label="Categoria">
                            <option value="Computador">Computador</option>
                            <option value="Notebook">Notebook</option>
                            <option value="Periférico">Periférico</option>
                            <option value="Acessório">Acessório</option>
                        </optgroup>
                        <optgroup label="Marca">
                            <option value="Apple">Apple</option>
                            <option value="Acer">Acer</option>
                            <option value="Asus">Asus</option>
                            <option value="Dell">Dell</option>
                            <option value="HP">HP</option>
                            <option value="Lenovo">Lenovo</option>
                            <option value="Samsung">Samsung</option>
                            <option value="Positivo">Positivo</option>
                            <option value="Lenovo">Lenovo</option>
                            <option value="Compaq">Compaq</option>
                            <option value="Multilaser">Multilaser</option>
                            <option value="Outro">Outro</option> 
                        </optgroup>
                        <optgroup label="Marca">
                            <option value="Novo">Novo</option>
                            <option value="Funciona">Funcionando</option>
                            <option value="Manutenção">Manutenção</option>
                            <option value="Recolhido">Recolhido</option>
                            <option value="Descarte">Descarte/Baixa</option>
                        </optgroup>
                    </select>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> OK</button>
                </form>
            </div>
        </div>    
    </div>
</body>
</html>
