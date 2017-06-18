<?php
/*
// Transformando arquivo XML em Objeto
$xml = simplexml_load_file('../../ini/conexao.xml');

//recuperando os campos
$host= $xml->host;
$usuario = $xml->usuario;
$senha = $xml->senha;
$bd = $xml->bd;
*/
//conectando ao servidor
$conexao = mysqli_connect('127.0.0.1', "root", "","sitar");     
     
//$conexao = mysqli_connect($host,$usuario,$senha,$bd);

// Caso a conexão seja reprovada, exibe na tela uma mensagem de erro
if (!$conexao) die ("<h1>Falha na conexão com o Banco de Dados!</h1>");

//set correct charset
$conexao->set_charset("utf8");

//reporta todos os erros
$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_ERROR;




