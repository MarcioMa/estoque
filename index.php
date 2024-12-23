<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CDN do Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ+7PpHg9f42XmuE/Cv1Xx05I4gXt0mb1oA0A+3I02IebebsI3C1qFtb0zfp" crossorigin="anonymous">

    <style>
        /* Estilo básico para a tela de carregamento */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
            text-align: center;
        }

        .message {
            font-size: 28px;
            color: #333;
            margin-top: 20px;
        }

        .container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message mt-1">
            <img src="/../estoque/public/img/image.gif" alt="Carregando">
        </div>
    </div>

    <script>
        // Simula a conclusão do processo após 5 segundos
        setTimeout(function() {
            window.location.href = "/../estoque/public/index.php"; // Redireciona após o "carregamento"
        }, 5000); // Ajuste o tempo conforme necessário
    </script>
</body>
</html>
