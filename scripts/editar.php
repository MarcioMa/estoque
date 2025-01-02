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
    .custom-select {
    background-color: #f0f0f0; /* Cor de fundo */
    border: 1px solid #ccc; /* Cor da borda */
    color: #333; /* Cor do texto */
    }

    .custom-select:disabled {
        background-color: #e0e0e0; /* Cor de fundo quando desabilitado */
        color: #888; /* Cor do texto quando desabilitado */
    }
</style>
<div class="container mt-4 text-center text-uppercase">
    <div class="row">
        <div class="col">
            <h4>Editar Equipamento</h4>
        </div>
    </div>
</div>
<?php 
    $id = $_GET['id']?? null;

    if (empty($id)) {
        header('Location: index.php?rota=produto');
        exit;  
    }

    $db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
    $params = [':id' => $id];
    $sql = "SELECT * FROM produto WHERE id = :id";
    $result = $db->query($sql, $params);

        // Certifique-se de que $result é um array que contém os dados
        if (is_array($result) && count($result) > 0) {
            $produto = $result[0]; // A primeira linha (única)
        } else {
            // Caso não haja resultado, redireciona ou exibe uma mensagem
            echo "Produto não encontrado.";
            exit;
        }

?>
<div class="form-container shadow-lg p-3 mb-5 bg-light rounded mt-2" >
    <form method="POST" autocomplete="off">
        <!-- Campo de ID -->
        <label id="id" name="id" class="form-control"><?php echo htmlspecialchars($id); ?></label>
        
        <!-- Campo de Status (Ativo/Inativo) -->
        <div class="form-group d-flex justify-content-end mb-2">
            <input type="checkbox" class="form-check-input" id="status" name="status" value="Ativo" <?php echo $produto['status'] == 'Ativo' ? 'checked' : ''; ?>>
            <label id="status-label" class="form-check-label" for="status">Ativo</label>
        </div>
                <!-- Script para alternar o texto da label -->
    <script>
        // Função para alterar o texto da label quando o checkbox for clicado
        document.getElementById('status').addEventListener('change', function() {
            var statusLabel = document.getElementById('status-label');
            if (this.checked) {
                statusLabel.textContent = 'Ativo';
                document.getElementById('status').value = 'Ativo';
            } else {
                statusLabel.textContent = 'Inativo';
                document.getElementById('status').value = 'Inativo';
            }
        });
    </script>

<!-- Campo de Categoria -->
    <div class="form-group">
        <label for="categoria">Categoria</label>
        <select class="form-select inactive-select custom-select" id="categoria" name="categoria">
        <option value="Computador" <?php echo $produto['categoria'] == 'Computador' ? 'selected' : ''; ?>>Computador</option>
                <option value="Notebook" <?php echo $produto['categoria'] == 'Notebook' ? 'selected' : ''; ?>>Notebook</option>
                <option value="Periférico" <?php echo $produto['categoria'] == 'Periférico' ? 'selected' : ''; ?>>Periférico</option>
                <option value="Acessório" <?php echo $produto['categoria'] == 'Acessório' ? 'selected' : ''; ?>>Acessório</option>
        </select>
    </div>

<!-- Campo de Marca -->
    <div class="form-group">
        <label for="marca">Marca</label>
        <select class="form-select inactive-select custom-select" id="marca" name="marca">
        <option value="Apple" <?php echo $produto['marca'] == 'Apple' ? 'selected' : ''; ?>>Apple</option>
                <option value="Acer" <?php echo $produto['marca'] == 'Acer' ? 'selected' : ''; ?>>Acer</option>
                <option value="Asus" <?php echo $produto['marca'] == 'Asus' ? 'selected' : ''; ?>>Asus</option>
                <option value="Dell" <?php echo $produto['marca'] == 'Dell' ? 'selected' : ''; ?>>Dell</option>
                <option value="HP" <?php echo $produto['marca'] == 'HP' ? 'selected' : ''; ?>>HP</option>
                <option value="Lenovo" <?php echo $produto['marca'] == 'Lenovo' ? 'selected' : ''; ?>>Lenovo</option>
                <option value="Samsung" <?php echo $produto['marca'] == 'Samsung' ? 'selected' : ''; ?>>Samsung</option>
                <option value="Positivo" <?php echo $produto['marca'] == 'Positivo' ? 'selected' : ''; ?>>Positivo</option>
                <option value="Compaq" <?php echo $produto['marca'] == 'Compaq' ? 'selected' : ''; ?>>Compaq</option>
                <option value="Multilaser" <?php echo $produto['marca'] == 'Multilaser' ? 'selected' : ''; ?>>Multilaser</option>
                <option value="Outro" <?php echo $produto['marca'] == 'Outro' ? 'selected' : ''; ?>>Outro</option>
        </select>
    </div>

<!-- Campo de Situação -->
    <div class="form-group">
        <label for="status">Situação dispositivo</label>
        <select class="form-select" id="situacao" name="situacao">
        <option value="novo" <?php echo $produto['situacao'] == 'novo' ? 'selected' : ''; ?>>Novo</option>
                <option value="usado" <?php echo $produto['situacao'] == 'usado' ? 'selected' : ''; ?>>Usado</option>
                <option value="reparo" <?php echo $produto['situacao'] == 'reparo' ? 'selected' : ''; ?>>Em Reparos</option>
                <option value="outro" <?php echo $produto['situacao'] == 'outro' ? 'selected' : ''; ?>>Outro</option>
        </select>
    </div>

            <!-- Campo de Modelo -->
            <div class="form-group">
                <label for="modelo">Nome / Modelo / Numero Série</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo htmlspecialchars($produto['modelo']); ?>" placeholder="Digite o nome ou modelo ou numero série">
            </div>

            <!-- Campo de Patrimônio -->
            <div class="form-group">
                <label for="patrimonio">Patrimônio</label>
                <input type="text" class="form-control" id="patrimonio" name="patrimonio" value="<?php echo htmlspecialchars($produto['patrimonio']); ?>" placeholder="Digite o número de patrimônio" disabled>
            </div>

            <!-- Campo de Data de Entrada -->
            <div class="form-group">
                <label for="data_entrada">Data de Entrada</label>
                <input type="date" class="form-control" id="data_entrada" name="data_entrada" value="<?php echo $produto['data_entrada']; ?>" disabled>
            </div>

            <script>
                // Definir o atributo max para o campo data_entrada como a data atual
                document.getElementById('data_entrada').setAttribute('max', new Date().toISOString().split('T')[0]);
            </script>
            
            <!-- Campo de Data de Garantia -->
            <div class="form-group">
                <label for="garantia">Data final de Garantia</label>
                <input type="date" class="form-control" id="data_garantia" name="data_garantia" value="<?php echo $produto['data_garantia']; ?>">
            </div>
            <!-- Campo de Especificações técnicas -->
            <div class="form-group">
                <label for="espec_tecnicas">Especificações técnicas</label>
                <textarea class="form-control" id="espec_tecnicas" name="espec_tecnicas" rows="3" placeholder="Digite especificações do produto"><?php echo htmlspecialchars($produto['espec_tecnicas']); ?></textarea>
            </div>
            <!-- Botões -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a onclick="return confirm('Sair sem salvar o registro?')" href="?rota=produto" class="btn btn-warning btn-lg me-md-2" title="voltar">
                    <i class="fa fa-eraser"></i>Voltar</a>
                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-square"></i> Salvar</button>
            </div>
        </form>
    </div>

