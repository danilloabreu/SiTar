<?php

//conectando ao servidor
$conect = mysql_connect("localhost", "root", "");

// Caso a conexão seja reprovada, exibe na tela uma mensagem de erro
if (!$conect) die ("<h1>Falha na conexão com o Banco de Dados!</h1>");

// Caso a conexão seja aprovada, entaoo conecta o Banco de Dados.	
$db = mysql_select_db("Sitar");

?>	