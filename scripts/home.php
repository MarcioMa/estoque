<?php
    require_once __DIR__.'/../inc/navbar.php';
    include_once __DIR__.'/../inc/config.php'; 
    include_once __DIR__.'/../inc/database.php';
?>

    <div class="container mt-4 text-center text-uppercase">
        <div class="row">
            <div class="col">
                <h4>Requisição de Dispositivo</h4>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <form>
        <!-- Dados do Produto -->
        <div class="form-group">
            <label for="patrimonio">Patrimônio</label>
            <input type="text" class="form-control" id="patrimonio" placeholder="Informe o número de patrimônio">
        </div>
        
        <div class="form-group">
            <label for="situacao">Situação do Produto</label>
            <select class="form-control" id="situacao">
            <option value="novo">Novo</option>
            <option value="usado">Usado</option>
            <option value="reparo">Em Reparos</option>
            <option value="outro">Outro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" placeholder="Informe a marca do produto">
        </div>

        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" id="modelo" placeholder="Informe o modelo do produto">
        </div>

        <div class="form-group">
            <label for="numSerie">Número de Série</label>
            <input type="text" class="form-control" id="numSerie" placeholder="Informe o número de série">
        </div>

        <!-- Informações da Requisição -->
        <div class="form-group">
            <label for="dataSaida">Data de Saída</label>
            <input type="date" class="form-control" id="dataSaida">
        </div>

        <div class="form-group">
            <label for="dataretorno">Data de Retorno</label>
            <input type="date" class="form-control" id="dataretorno">
        </div>

        <div class="form-group">
            <label for="tipoAcao">Tipo de Ação</label>
            <select class="form-control" id="tipoAcao">
            <option value="emprestimo">Empréstimo</option>
            <option value="saida">Saída Definitiva</option>
            <option value="devolucao">Devolução</option>
            </select>
        </div>

        <!-- Observações -->
        <div class="form-group">
            <label for="observacoes">Observações</label>
            <textarea class="form-control" id="observacoes" rows="3" placeholder="Adicione observações adicionais"></textarea>
        </div>

        <!-- Autorização e Aprovação -->
        <h5 class="text-center mt-3">Aprovação e Autorização</h5>

        <div class="form-group">
            <label for="responsavelRequisicao">Responsável pela Requisição</label>
            <input type="text" class="form-control" id="responsavelRequisicao" placeholder="Nome do responsável pela requisição">
        </div>

        <div class="form-group">
            <label for="cargoRequisicao">Cargo/Divisão</label>
            <input type="text" class="form-control" id="cargoRequisicao" placeholder="Cargo/Divisão do responsável pela requisição">
        </div>

        <div class="form-group">
            <label for="gestor">Gestor do Responsável</label>
            <input type="text" class="form-control" id="gestor" placeholder="Gestor do responsável pela requisição">
        </div>

        <div class="form-group mb-5">
            <label for="responsavelAprovacao">Responsável pela Liberação</label>
            <input type="text" class="form-control" id="responsavelAprovacao" placeholder="Nome do responsável pela aprovação">
        </div>

        <!-- Botões -->
        <div class="d-grid mb-3 gap-2 d-md-flex justify-content-md-end">
            <button type="reset" class="btn btn-warning btn-lg me-md-2"><i class="fa fa-eraser"></i> Limpar </button>
            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-square"></i> Cadastrar</button>
        </div>
        </form>
  </div>

  <!-- Scripts do Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
    require_once __DIR__."/../inc/footer.php";
?>