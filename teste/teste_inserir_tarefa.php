<?php

require_once '../';
$tarefa = new Tarefa(null,null,"Carlos",null,null,null,null,null);
$tarefa->setId_tarefa("1");
$tarefa->setEmissor("Danilo");
//$tarefa->setResponsavel("Carlos");
$tarefa->setResumo("Esse é o resumo da tarefa 1");
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


//$tarefa->inserir_tarefa($tarefa);




