<?php
require_once __DIR__."/../inc/navbar.php";
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
            <h4>Cadastro Equipamento</h4>
        </div>
    </div>
</div>

<div class="form-container shadow-lg p-3 mb-5 bg-light rounded mt-2" >
    <form method="POST" action="?rota=cad_produto" autocomplete="off">        
        <!-- Campo de Status (Ativo/Inativo) -->
        <div class="form-group d-flex justify-content-end mb-2">
            <input type="checkbox" class="form-check-input" id="status" name="status" value="Ativo" checked>
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
        <select class="form-select" id="categoria" name="categoria" required>
            <option value="">Selecione a Categoria</option>
            <option value="Computador">Computador</option>
            <option value="Notebook">Notebook</option>
            <option value="Periférico">Periférico</option>
            <option value="Acessório">Acessório</option>
            <!-- Adicione mais opções conforme necessário -->
        </select>
    </div>

<!-- Campo de Marca -->
    <div class="form-group">
        <label for="marca">Marca</label>
        <select class="form-select" id="marca" name="marca" required>
            <option value="">Selecione a Marca</option>
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
        </select>
    </div>

<!-- Campo de Situação -->
    <div class="form-group">
        <label for="status">Situação dispositivo</label>
        <select class="form-select" id="situacao" name="situacao" required>
            <option value="Novo">Novo</option>
            <option value="Usado">Usado</option>
            <option value="Reparo">Em Reparos</option>
            <option value="Outro">Outro</option>
        </select>
    </div>

            <!-- Campo de Modelo -->
            <div class="form-group">
                <label for="modelo">Nome / Modelo / Numero Série</label>
                <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Digite o nome ou modelo ou numero série" required>
            </div>

            <!-- Campo de Patrimônio -->
            <div class="form-group">
                <label for="patrimonio">Patrimônio</label>
                <input type="text" class="form-control" id="patrimonio" name="patrimonio" placeholder="Digite o número de patrimônio" required>
            </div>

            <!-- Campo de Data de Entrada -->
            <div class="form-group">
                <label for="data_entrada">Data de Entrada</label>
                <input type="date" class="form-control" id="data_entrada" name="data_entrada" required>
            </div>

            <script>
                // Definir o atributo max para o campo data_entrada como a data atual
                document.getElementById('data_entrada').setAttribute('max', new Date().toISOString().split('T')[0]);

                // Função para ajustar a data mínima de garantia quando a data de entrada mudar
                document.getElementById('data_entrada').addEventListener('change', function () {
                    var dataEntrada = this.value; // Pega a data de entrada
                    document.getElementById('data_garantia').setAttribute('min', dataEntrada); // Define a data mínima de garantia
                });
            </script>

            <!-- Campo de Data de Garantia -->
            <div class="form-group">
                <label for="garantia">Data final de Garantia</label>
                <input type="date" class="form-control" id="data_garantia" name="data_garantia">
            </div>

            <!-- Campo de Especificações técnicas -->
            <div class="form-group">
                <label for="espec_tecnicas">Especificações técnicas</label>
                <textarea class="form-control" id="espec_tecnicas" name="espec_tecnicas" rows="3" placeholder="Digite especificações do produto"></textarea>
            </div>
            <!-- Botões -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="reset" class="btn btn-warning btn-lg me-md-2"><i class="fa fa-eraser"></i> Limpar </button>
                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-square"></i> Cadastrar</button>
            </div>
        </form>
    </div>
<?php
    require_once __DIR__."/../inc/lista.php";
?>


