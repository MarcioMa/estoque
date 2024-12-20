<?php
//destroi toda a sessão
session_destroy();

//redireciona usuario para login.php
header('Location: index.php?rota=home');