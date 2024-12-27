<?php
include_once __DIR__."/../inc/database.php";
require_once __DIR__.'/../inc/navbar.php';

$db = new database();

// Consulta para obter as categorias e a quantidade de produtos em cada uma
$sql = "SELECT categoria, COUNT(*) AS total FROM produto GROUP BY categoria";
$resultados = $db->executarConsulta($sql);

// Preparar os dados para o gráfico
$categorias = [];
$quantidades = [];

foreach ($resultados as $produto) {
    $categorias[] = $produto['categoria'];
    $quantidades[] = $produto['total'];
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid mt-4">

    <!-- Título do Dashboard -->
    <div class="row">
        <div class="col text-center">
            <h2 class="text-uppercase">Dashboard de Produtos</h2>
            <p>Visão geral do estoque de produtos</p>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row">
        <!-- Gráfico de Barras -->
        <div class="col-md-6 mb-4">
            <h4>Gráfico de Barras - Quantidade por Categoria</h4>
            <canvas id="barChart"></canvas>
        </div>
        
        <!-- Gráfico de Pizza -->
        <div class="col-md-6 mb-4">
            <h4>Gráfico de Pizza - Distribuição por Categoria</h4>
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <div class="row">
        <!-- Gráfico de Linhas -->
        <div class="col-md-6 mb-4">
            <h4>Gráfico de Linhas - Evolução por Categoria</h4>
            <canvas id="lineChart"></canvas>
        </div>
    </div>

</div>

<script>
    // Dados de PHP para JavaScript
    const categorias = <?php echo json_encode($categorias); ?>;
    const quantidades = <?php echo json_encode($quantidades); ?>;

    // Função para criar o gráfico de Barras
    function createBarChart() {
        const ctx = document.getElementById('barChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categorias,
                datasets: [{
                    label: 'Quantidade de Produtos',
                    data: quantidades,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Função para criar o gráfico de Pizza
    function createPieChart() {
        const ctx = document.getElementById('pieChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: categorias,
                datasets: [{
                    label: 'Distribuição por Categoria',
                    data: quantidades,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    }

    // Função para criar o gráfico de Linhas
    function createLineChart() {
        const ctx = document.getElementById('lineChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: categorias,
                datasets: [{
                    label: 'Evolução de Produtos por Categoria',
                    data: quantidades,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Inicializa todos os gráficos
    createBarChart();
    createPieChart();
    createLineChart();
</script>