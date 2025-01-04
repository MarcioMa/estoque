<?php
include_once __DIR__ . '/../inc/config.php';
include_once __DIR__ . '/../inc/database.php';

$db = new database();
$registrosPorPagina = 10;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$offset = ($page - 1) * $registrosPorPagina;

$sql = "SELECT * FROM produto LIMIT :limit OFFSET :offset";
$params = [
    'limit' => $registrosPorPagina,
    'offset' => $offset,
];
$sql = "SELECT * FROM produto LIMIT $registrosPorPagina OFFSET $offset";
$resultados = $db->executarConsulta($sql, []);

$sqlTotal = "SELECT COUNT(*) AS total FROM produto";
$totalRegistros = $db->executarConsulta($sqlTotal, [])[0]['total'];
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);
?>

<div class="container mt-2 text-center text-uppercase">
    <div class="row">
        <div class="col">
            <h4>Equipamentos Cadastrados</h4>
        </div>
    </div>
</div>

<?php if (!empty($resultados)): ?>
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
                    <td>
                        <a href="?rota=editar&id=<?php echo htmlspecialchars($produto['id']); ?>" class="btn btn-warning fs-6" title="editar">
                            <i class="fas fa-edit fa-sm mx-2 mt-1 mb-2"></i> Editar
                        </a>
                    </td>
                    <td>
                        <a onclick="return confirm('Confirma deleta este registro?')" href="?rota=delete&id=<?php echo htmlspecialchars($produto['id']); ?>" class="btn btn-danger" title="deleta">
                            <i class="fas fa-trash fa-sm mx-2 mt-1 mb-2"></i> Deleta
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhum produto encontrado.</p>
<?php endif; ?>

<?php if ($totalPaginas > 1): ?>
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?rota=produto&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>
