<?php
    require_once __DIR__."/../inc/header.php";
    require_once __DIR__.'/../inc/navbar.php';
    include_once __DIR__.'/../inc/config.php'; 
    include_once __DIR__.'/../inc/database.php';
?>

    <div class="container mt-4 text-center text-uppercase">
        <div class="row">
            <div class="col">
                <h4>Relatório de Equipamentos</h4>
            </div>
        </div>
    </div>

    <div id="divFiltro" class="content text-end mx-2">
        <form method="POST" action="">
            <label for="filtro" style="font-weight:bold;">Filtra por:</label>
            <select name="filtro" id="filtro" style="width:250px; height: 37px; text-align:center; background:#ffffdc;">
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
                <optgroup label="Situação">
                <option value="Novo">Novo</option>
                <option value="Usado">Usado</option>
                <option value="Reparo">Em Reparos</option>
                <option value="Outro">Outro</option>
                </optgroup>
            </select>
            <button type="submit" class="btn btn-secondary mb-1"> <i class="fa fa-filter"></i> OK</button>
        </form>
    </div>

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
                $sql .= " AND situacao = :filtro";
            }

            // Adiciona o filtro aos parâmetros
            $params[':filtro'] = $filtro;
        }

        // Chama o método para executar a consulta
        $resultados = $db->executarConsulta($sql, $params);
    ?>

    <!-- Exibir tabela de resultados -->
    <?php if (!empty($resultados)) : ?>

    <!-- Tabela com os dados dos produtos -->
    <table class="table table-light table-striped table-bordered mt-2">
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
                <th>Registro Editado</th>
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
                    <td><?php echo htmlspecialchars(date('d/m/Y',strtotime($produto['data_entrada']))); ?></td>
                    <td><?php echo htmlspecialchars(date('d/m/Y',strtotime($produto['data_garantia']))); ?></td>
                    <td><?php echo htmlspecialchars($produto['espec_tecnicas']); ?></td>
                    <td><?php echo htmlspecialchars(date('d/m/Y H:i:s', strtotime($produto['updated_at']))); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
            <p>Nenhum Equipamento encontrado.</p>
        <?php endif; ?>

    <!-- Botão para Imprimir -->
    <div class="btn-container text-end mx-2 mb-4">
        <a href="?rota=exportar_rel" class="btn btn-warning" title="Exportar Relatório">
            <i class="fas fa-print mr-2"></i>
            Pagina de impressão...
        </a>
    </div>