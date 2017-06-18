<?php
//requisições
require '../../model/br.com.sitar.Tarefa/br.com.sitar.Tarefa.php';
require '../../model/br.com.sitar.Movimento/br.com.sitar.Movimento.php';
require '../../model/usuario.php';
//require 'conexao.php';
//recupera o nome do usuário
$usuario=usuario::recupera_usuario_cookie()
?>
    <h1> Bem vindo ao Sitar <?php echo $usuario ?></h1>
    <h1>Resumo</h1>

<?php

$tarefas_abertas=Tarefa::contar_tarefa_aberta($usuario);
$tarefas_solicitadas=Tarefa::contar_tarefa_solicitada($usuario);
$movimentos_pendentes= movimento::contar_movimento_aberto($usuario);


if($tarefas_abertas!=0){
    echo ("Você possui ".$tarefas_abertas." tarefas não finalizadas"."<br>");
}else{
    echo("Você possui não possui tarefas abertas"."<br>");
}

if($tarefas_solicitadas!=0){
 echo ("Você possui ".$tarefas_solicitadas." tarefas solicitadas não finalizadas"."<br>");   
}else{
 echo ("Você não possui tarefas solicitadas em aberto"."<br>");   
}
if($movimentos_pendentes!=0){
echo ("Você possui ".$movimentos_pendentes." movimentos pendentes"."<br>");}
else{
echo ("Você não possui movimentos pendentes");    
}
?>

<div class="icons">
                <i class="fa fa-plus-square add" aria-hidden="true"></i>
                <i class="fa fa-search search" aria-hidden="true"></i>
                    <i class="fa fa-tasks tarefa" aria-hidden="true"></i>
</div>
