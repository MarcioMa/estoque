<?php
//gerar classe senha com uso password_hash()

echo password_hash('user123', PASSWORD_DEFAULT);
echo "<h1 style='text-align:center; color:green;'>[1] - cadastrado com sucesso!</h1>";