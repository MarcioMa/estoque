<?php
    require_once __DIR__."/../inc/header.php";
    require_once __DIR__.'/../inc/navbar.php';
    include_once __DIR__.'/../inc/config.php'; 
    include_once __DIR__.'/../inc/database.php';
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
</style>

<div class="container mt-4 text-center text-uppercase">
    <div class="row">
        <div class="col">
            <h4>Requisição de Dispositivo</h4>
        </div>
    </div>
</div>

<div class="form-container shadow-lg p-3 mb-5 bg-white rounded mt-2">
    <div class="container mt-3">
        <form id="requisicaoForm">
            <!-- Tipo de Ação -->
            <div class="form-group">
                <label for="tipoAcao">Tipo de Ação</label>
                <select class="form-control" id="tipoAcao">
                    <option value="Solicitar">Solicitação</option>
                    <option value="Emprestimo">Empréstimo</option>
                    <option value="Manutencao">Manutenção</option>
                </select>
            </div>

            <!-- Situação do Produto -->
            <div class="form-group" id="campoSituacao" style="display:block;" disabled>
                <label for="situacao">Situação do Produto</label>
                <select class="form-control" id="situacao">
                    <option value="novo">Novo</option>
                    <option value="usado">Usado</option>
                    <option disabled value="reparo">Em Reparos</option>
                    <option disabled value="outro">Outro</option>
                </select>
            </div>

            <!-- Campos do Produto -->
            <div class="form-group" id="campoRegistro" style="display:block;">
                <label for="Registro">Número Registro</label>
                <input type="text" class="form-control" id="chamado" placeholder="Informe o número da solicitação">
            </div>
            
            <div class="form-group" id="campoPatrimonio" style="display:block;">
                <label for="patrimonio">Patrimônio</label>
                <input type="text" class="form-control" id="patrimonio" placeholder="Informe o número de patrimônio">
            </div>
            <script>

                document.getElementById('patrimonio').addEventListener('blur', function() {
                    var patrimonio = document.getElementById('patrimonio').value;

                    if (patrimonio) {

                        var url = 'index.php?rota=consultar_p&patrimonio=' + encodeURIComponent(patrimonio);

                        fetch(url)
                            .then(response => response.text())
                            .then(data => {
                                console.log(data);
                                if (data.success) {
                                    document.getElementById('marca').value = data.marca;
                                    document.getElementById('modelo').value = data.modelo;
                                } else {
                                    alert('Patrimônio não encontrado!');
                                }
                            })
                            .catch(error => {
                                console.error('Erro ao buscar os dados:', error);
                                alert('Erro ao buscar os dados do patrimônio.');
                            });
                    }
                });
            </script>

            <div class="form-group" id="campoMarcaModelo" style="display:block;">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" id="marca" placeholder="Informe a marca do produto">

                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" id="modelo" placeholder="Informe o modelo do produto">
            </div>

            <div class="form-group" id="campoDataSaida" style="display:block;">
                <label for="dataSaida">Data de Saída</label>
                <input type="date" class="form-control" id="dataSaida">
            </div>

            <div class="form-group" id="campoDataRetorno" style="display:block;">
                <label for="dataretorno">Data de Retorno</label>
                <input type="date" class="form-control" id="dataretorno">
            </div>

            <div class="form-group mt-2 mb-2" id="campoBakup" style="display:block;">
                <label id="status-label" class="form-check-label" for="bkp">Realizado Backup</label><br>
                <input type="radio" class="form-check-input pe-3" id="bkp" name="bkp" value="Sim"> SIM
                <input type="radio" class="form-check-input pe-3" id="bkp" name="bkp" value="Não" checked> NÃO
            </div>

            <div class="form-group mt-2 mb-2" id="campoPeriferico" style="display:block;">
            <label id="status-label" class="form-check-label" for="bkp">Problema no Periférico</label>
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="Fonte" id="fonte">
                        <label class="form-check-label" for="fonte">Fonte</label>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="Plca_m" id="placa_mae">
                        <label class="form-check-label" for="placa_mae">Placa Mãe</label>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="Ram" id="memoria">
                        <label class="form-check-label" for="memoria">Memória</label>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="Plca_vd" id="placa_video">
                        <label class="form-check-label" for="placa_video">Placa Video</label>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6 col-md-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="USB" id="usb">
                        <label class="form-check-label" for="usb">USB</label>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="Audio" id="audio">
                        <label class="form-check-label" for="audio">Áudio</label>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="Plca_rd" id="placa_rede">
                        <label class="form-check-label" for="placa_rede">Placa Rede</label>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="HD" id="hd">
                        <label class="form-check-label" for="hd">HD</label>
                    </div>
                </div>
            </div>
        </div>


            <div class="form-group">
                <label for="observacoes">Observações</label>
                <textarea class="form-control" id="observacoes" rows="3" placeholder="Adicione observações adicionais"></textarea>
            </div>

            <!-- Aprovação e Autorização -->
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
                <label for="gestor">Gestor/Coordenador</label>
                <input type="text" class="form-control" id="gestor" placeholder="Nome do gestor ou coordenador da divisão">
            </div>

            <div class="form-group mb-5">
                <label for="responsavelAprovacao">Responsável Técnico</label>
                <input type="text" class="form-control" id="responsavelAprovacao" placeholder="Nome do responsável técnico" value="<?php 
                 echo ''.$_SESSION['usuario']->usuario ?>">
            </div>

            <!-- Botões -->
            <div class="d-grid mb-3 gap-2 d-md-flex justify-content-md-end">
                <button type="reset" class="btn btn-warning btn-lg me-md-2"><i class="fa fa-eraser"></i> Limpar </button>
                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-square"></i> Cadastrar</button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script>
    // Função para alterar os campos do formulário conforme o tipo de ação
    document.getElementById('tipoAcao').addEventListener('change', function() {
        const tipoAcao = this.value;

        // Ocultar todos os campos inicialmente
        document.getElementById('campoPatrimonio').style.display = 'block';
        document.getElementById('campoMarcaModelo').style.display = 'block';
        document.getElementById('campoDataSaida').style.display = 'block';
        document.getElementById('campoDataRetorno').style.display = 'block';
        document.getElementById('campoBakup').style.display = 'none';
        document.getElementById('campoPeriferico').style.display = 'block';

        if (tipoAcao === 'Emprestimo') {
            // Mostrar ou ocultar campos dependendo do tipo de ação
            document.getElementById('campoDataRetorno').style.display = 'block';
            document.getElementById('campoBakup').style.display = 'none';
            document.getElementById('campoPeriferico').style.display = 'none';
            document.getElementById('campoSituacao').style.display = 'block';
        } else if (tipoAcao === 'Manutencao') {
            document.getElementById('campoBakup').style.display = 'block';
            document.getElementById('campoDataSaida').style.display = 'none'; 
            document.getElementById('campoDataRetorno').style.display = 'none';
            document.getElementById('campoSituacao').style.display = 'none';
            document.getElementById('campoPeriferico').style.display = 'block'; 
        } else {
            // Caso de "Novo Dispositivo" ou outra lógica
            document.getElementById('campoDataRetorno').style.display = 'block';
            document.getElementById('campoDataSaida').style.display = 'block';
            document.getElementById('campoBakup').style.display = 'none';
            document.getElementById('campoPeriferico').style.display = 'none';
            document.getElementById('campoSituacao').style.display = 'block';
        }
    });

    // Executar a função na primeira carga da página
    document.getElementById('tipoAcao').dispatchEvent(new Event('change'));
</script>

<!-- Scripts do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

