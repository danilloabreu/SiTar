<?php

//faz a conexão com o banco de dados
require ("conectar.php");

// 1990-02-01T01:02

$data_limite = $_POST["data_limite"];

//echo gettype($data_limite);
echo $data_limite."<br>" ;

$data_limite=str_replace('T',' ',$data_limite);
$data_limite.=":00";
//$string= "Danilo é bonito";
//$string=str_replace('Danilo','dandan',$string);
//echo $string."<br";
echo $data_limite."<br>" ;

$resumo="Tarefa teste do novo Sitar";
$responsavel=$_POST["responsavel"];
$data_limite= new DateTime($data_limite);
//$data_limite =$_POST["data_limite"];
$data_finalizacao="28/06/2016";
$prioridade=$_POST["prioridade"];
$emissor="Carlos";
$datasolicitacaofinalizacao=null;

//echo $responsavel;
//echo $data_limite;



//convertendo o formato de data para inserir no banco
$data_limite=$data_limite->format('Y-m-d H:i:s');

//query sql
$qry = "INSERT INTO tarefa VALUES";
$qry.="('','$resumo','$responsavel','$data_limite','$data_finalizacao','$prioridade','$emissor','$datasolicitacaofinalizacao')";

try{

$resultado= mysql_query($qry);
if (!$resultado) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $qry;
    die($message);
}
}

//echo $resultado;
//echo("passou try");


catch(Exception $e){



	echo ($e->getMessage());



}



?>
