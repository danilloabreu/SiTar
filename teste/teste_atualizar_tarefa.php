<?php
require ('../tarefa.php');


$tarefa = new Tarefa();
$tarefa=$tarefa->recuperar_tarefa(24);
$tarefa->setPrioridade(550);
$tarefa->atualizar_tarefa($tarefa);

