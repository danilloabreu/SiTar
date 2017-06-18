<?php

try{
require_once '../tarefa.php';
require_once '../movimento.php';
$tarefa = new Tarefa(null,null,"Carlos",null,null,null,null,null);
$tarefa->setId_tarefa("1");
$tarefa->setEmissor("Danilo");
//$tarefa->setResponsavel("Carlos");
$tarefa->setResumo("Tarefa de Teste de inserir tarefa com movimento");
//data abertura
$data_abertura= new DateTime();
//convertendo o formato de data para inserir no banco
$data_abertura=$data_abertura->format('Y-m-d H:i:s');
$tarefa->setData_abertura($data_abertura);
echo $tarefa->getEmissor();
echo '<br>';
echo $tarefa->getResponsavel();
echo '<br>';
echo $tarefa->getResumo();
echo '<br>';
echo $tarefa->getData_abertura();

$tarefa->inserir_tarefa($tarefa);
//$idtarefa=Tarefa::recuperar_id_ultima_tarefa();
$movimento = new movimento (null,$idtarefa,"Danilo","Carloncio",0,"Esse é o primeiro movimento dessa tarefa",null,null,null);
$movimento->inserir_movimento($movimento);
} catch (Exception $e){
	echo $e->getMessage();

}

?>