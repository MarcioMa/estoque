<?php
require_once __DIR__."/../inc/navbar.php";
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h4>Cadastro Usuário</h4>
        </div>
    </div>
</div>

<!-- Estilos personalizados -->
<style>
    .form-container {
        max-width: 600px;
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

<div class="form-container">
        <form method="POST" action="?rota=cad_usuario" autocomplete="off">
            <!-- Campo para o usuario -->
            <div class="mb-3">
                <label for="usuario" class="form-label">Nome / Login</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>

            <!-- Campo para o E-mail -->
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

         <!-- Campo para a Senha com ícone de mostrar/ocultar -->
         <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="senha" name="senha" required>
                    <span class="input-group-text" id="eye-icon">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <!-- Campo para Confirmar Senha -->
            <div class="mb-3">
                <label for="confirma_senha" class="form-label">Confirmar Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirma_senha" name="confirma_senha" required>
                    <span class="input-group-text" id="eye-icon-confirm">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <!-- Escolha do Tipo de Usuário -->
            <div class="mb-3">
                <label class="form-label">Tipo de Usuário</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="admin" name="nivel" value="0" required>
                    <label class="form-check-label" for="admin">Administrador</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="usuario" name="nivel" value="1" required>
                    <label class="form-check-label" for="usuario">Usuário</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="suporte" name="nivel" value="2" required>
                    <label class="form-check-label" for="suporte">Suporte</label>
                </div>
            </div>

            <!-- Botões -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="reset" class="btn btn-warning btn-lg me-md-2"> Limpar </button>
                <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
            </div>
        </form>
    </div>

        <!-- Script para alternar visibilidade da senha -->
    <script>
        document.getElementById('eye-icon').addEventListener('click', function() {
            const senhaField = document.getElementById('senha');
            const icon = this.querySelector('i');
            
            if (senhaField.type === "password") {
                senhaField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                senhaField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });

        document.getElementById('eye-icon-confirm').addEventListener('click', function() {
            const confirmaSenhaField = document.getElementById('confirma_senha');
            const icon = this.querySelector('i');
            
            if (confirmaSenhaField.type === "password") {
                confirmaSenhaField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                confirmaSenhaField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    </script>