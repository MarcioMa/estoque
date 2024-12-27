<?php
    include_once __DIR__.'/../inc/config.php'; 
    include_once __DIR__.'/../inc/database.php';
?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .btn-edit {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        background: #C0C0C0;
        }
    </style>
    <div class="container mt-2 text-center text-uppercase">
        <div class="row">
            <div class="col">
                <h4>Produtos Cadastrados</h4>
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
        
        //Exibir tabela de resultados
        if (!empty($resultados)) : ?>

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
                <th>Editar</th>
                <th>Excluir</th>
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
                    <td>
                    <a href="?rota=edit" class="btn btn-warning" title="editar">
                        <i class="fas fa-edit mr-2"></i>
                        editar
                    </a>
                    </td>
                    <td>
                    <a href="?rota=deleta" class="btn btn-danger" title="deleta">
                        <i class="fas fa-delete mr-2"></i>
                        Deleta
                    </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
            <p>Nenhum produto encontrado.</p>
        <?php endif; ?>
</body>
</html>