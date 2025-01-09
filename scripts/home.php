<?php
    require_once __DIR__."/../inc/header.php";
    require_once __DIR__.'/../inc/navbar.php';
    include_once __DIR__. '/../inc/config.php'; 
    include_once __DIR__.'/../inc/database.php';

    // O filtro selecionado
    $filtro = '*';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Captura e valida o filtro
        $filtro = isset($_POST['filtro']) ? $_POST['filtro'] : '*';
    }

    $db = new database();

    // Exemplo de consulta para contar os produtos conforme o filtro
    $sql = "SELECT categoria, COUNT(*) as total FROM produto WHERE 1=1";
    $params = [];

    // Condicional para aplicar o filtro
    if ($filtro !== '*') {
        if (in_array($filtro, ['Computador', 'Notebook', 'Periférico', 'Acessório'])) {
            $sql .= " AND categoria = :filtro";
        } elseif (in_array($filtro, ['Apple', 'Acer', 'Asus', 'Dell', 'HP', 'Lenovo', 'Samsung', 'Positivo', 'Compaq', 'Multilaser', 'Outro'])) {
            $sql .= " AND marca = :filtro";
        } else {
            $sql .= " AND situacao = :filtro";
        }
        $params[':filtro'] = $filtro;
    }

    $sql .= " GROUP BY categoria"; // Agrupar por categoria, por exemplo
    $resultados = $db->executarConsulta($sql, $params);
    
    // Prepare os dados para o gráfico
    $categorias = [];
    $totais = [];
    foreach ($resultados as $produto) {
        $categorias[] = $produto['categoria']; // Categoria ou Marca ou Status
        $totais[] = $produto['total']; // Contagem de produtos
    }
    
    // Converter os dados para JSON para uso no JavaScript
    $categorias_json = json_encode($categorias);
    $totais_json = json_encode($totais);
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="content text-center mx-2 ml-auto mt-4">
    <h4 class="text-center">Quantidade de Equipamentos por Categoria</h4>
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
                        <optgroup label="Situacao">
                        <option value="Novo">Novo</option>
                        <option value="Usado">Usado</option>
                        <option value="Reparo">Em Reparos</option>
                        <option value="Outro">Outro</option>
                        </optgroup>
                    </select>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> OK</button>
                </form>
            </div>
     <!-- Gerar Grafico -->       
    <canvas id="myChart"></canvas>
</div>
<script>
    // Dados passados do PHP
    var categorias = <?php echo $categorias_json; ?>;
    var totais = <?php echo $totais_json; ?>;

    // Configuração do gráfico
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie', // Alterado para 'pie' para gráfico de pizza
        data: {
            labels: categorias, // As categorias ou marcas
            datasets: [{
                label: 'Número de Equipamentos',
                data: totais, 
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', 
                    'rgba(54, 162, 235, 0.2)', 
                    'rgba(255, 206, 86, 0.2)', 
                    'rgba(75, 192, 192, 0.2)', 
                    'rgba(153, 102, 255, 0.2)', 
                    'rgba(255, 159, 64, 0.2)'  
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', 
                    'rgba(54, 162, 235, 1)', 
                    'rgba(255, 206, 86, 1)', 
                    'rgba(75, 192, 192, 1)', 
                    'rgba(153, 102, 255, 1)', 
                    'rgba(255, 159, 64, 1)'  
                ],
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top', 
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return categorias[tooltipItem.dataIndex] + ': ' + tooltipItem.raw + ' unidade'; 
                        }
                    }
                }
            }
        }
    });
</script>


