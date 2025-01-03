<?php
include_once __DIR__ . '/../inc/config.php';
include_once __DIR__ . '/../inc/database.php';

// Obter ID do produto
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido!";
    exit;
}

$db = new database();
$sql = "SELECT * FROM produto WHERE id = :id";
$params = ['id' => $id];
$produto = $db->executarConsulta($sql, $params);

if (!$produto) {
    echo "Produto não encontrado!";
    exit;
}

$produto = $produto[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar dados do formulário
    $categoria = $_POST['categoria'] ?? $produto['categoria'];
    $marca = $_POST['marca'] ?? $produto['marca'];
    $status = $_POST['status'] ?? $produto['status'];
    $situacao = $_POST['situacao'] ?? $produto['situacao'];
    $modelo = $_POST['modelo'] ?? $produto['modelo'];
    $patrimonio = $_POST['patrimonio'] ?? $produto['patrimonio'];
    $data_entrada = $_POST['data_entrada'] ?? $produto['data_entrada'];
    $data_garantia = $_POST['data_garantia'] ?? $produto['data_garantia'];
    $espec_tecnicas = $_POST['espec_tecnicas'] ?? $produto['espec_tecnicas'];

    // Atualizar no banco
    $sqlUpdate = "UPDATE produto 
                  SET categoria = :categoria, marca = :marca, status = :status, situacao = :situacao, 
                      modelo = :modelo, patrimonio = :patrimonio, data_entrada = :data_entrada, 
                      data_garantia = :data_garantia, espec_tecnicas = :espec_tecnicas, updated_at = NOW()
                  WHERE id = :id";
    $paramsUpdate = [
        'categoria' => $categoria,
        'marca' => $marca,
        'status' => $status,
        'situacao' => $situacao,
        'modelo' => $modelo,
        'patrimonio' => $patrimonio,
        'data_entrada' => $data_entrada,
        'data_garantia' => $data_garantia,
        'espec_tecnicas' => $espec_tecnicas,
        'id' => $id,
    ];

    $db->executarConsulta($sqlUpdate, $paramsUpdate);

    echo "<script>alert('Registro Atualizado com sucesso!')</script>";
    header('Refresh:1; index.php?rota=produto');
    exit;
}
?>

<!-- Estilos personalizados -->
<style>
    .form-container {
        max-width: 800px;
        margin: 50px auto;
    }
    .input-group {
            position: relative;
    }
        .input-group .input-group-text {
        position: absolute;
        right: 2px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    .form-group {
        margin-top: 1.5rem;  /* Aumentando a margem superior */
        margin-bottom: 1rem;
    }

    .form-check-label{
        font-size: 16pt;
    }

    .form-check-input {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 25px;  /* Aumentando o tamanho do checkbox */
        height: 25px;
        border: 2px solid #007bff;  /* Cor da borda */
        border-radius: 5px;  /* Arredondar os cantos */
        margin-right: 10px;
        transition: all 0.3s ease;
        position: relative;
        cursor: pointer;
    }

    /* Estilo quando o checkbox está marcado */
    .form-check-input:checked {
        background-color: #007bff;  
        border-color: #0056b3;  
    }

    /* Alterando o tamanho quando o checkbox está sendo focado */
    .form-check-input:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(38, 143, 255, 0.5);
    }
</style>

<div class="container mt-4 text-center text-uppercase">
    <div class="row">
        <div class="col">
            <h4>Editar registro do Equipamento</h4>
        </div>
    </div>
</div>

<div class="form-container shadow-lg p-3 mb-5 bg-light rounded mt-2" >
    <!-- Formulário para edição -->
    <form method="post">
    <div class="form-group">
        <label>Categoria:</label>
        <input disabled type="text" class="form-control" name="categoria" value="<?php echo htmlspecialchars($produto['categoria']); ?>" required>
    </div>
    <div class="form-group">
        <label>Marca:</label>
        <input disabled type="text" class="form-control" name="marca" value="<?php echo htmlspecialchars($produto['marca']); ?>" required>
    </div>
    <div class="form-group">
        <label>Status:</label>
        <input type="text" class="form-control" name="status" value="<?php echo htmlspecialchars($produto['status']); ?>" required>
    </div>
    <div class="form-group">    
        <label>Situação:</label>
        <input type="text" class="form-control" name="situacao" value="<?php echo htmlspecialchars($produto['situacao']); ?>" required>
    </div>
    <div class="form-group">   
        <label>Modelo:</label>
        <input type="text" class="form-control" name="modelo" value="<?php echo htmlspecialchars($produto['modelo']); ?>" required>
    </div>
    <div class="form-group">    
        <label>Patrimônio:</label>
        <input type="text" class="form-control" name="patrimonio" value="<?php echo htmlspecialchars($produto['patrimonio']); ?>" required>
    </div>
    <div class="form-group">    
        <label>Data de Entrada:</label>
        <input disabled type="date" class="form-control" name="data_entrada" value="<?php echo htmlspecialchars($produto['data_entrada']); ?>" required>
    </div>
    <div class="form-group">    
        <label>Data de Garantia:</label>
        <input type="date" class="form-control" name="data_garantia" value="<?php echo htmlspecialchars($produto['data_garantia']); ?>" required>
    </div>
    <div class="form-group">    
        <label>Especificações Técnicas:</label>
        <textarea class="form-control" name="espec_tecnicas" required><?php echo htmlspecialchars($produto['espec_tecnicas']); ?></textarea>
    </div>    
        <!-- Botões -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a onclick="return confirm('Sair sem salvar o registro?')" href="?rota=produto" class="btn btn-warning btn-lg me-md-2" title="voltar">
                    <i class="fa fa-eraser"></i>Voltar</a>
                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-square"></i> Salvar</button>
            </div>
        </form>
</div>

