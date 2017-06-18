<?php
$path = $_SERVER['DOCUMENT_ROOT'];
//requisições
require($path.'/sitar/model/usuario.php');
require($path.'/sitar/model/br.com.sitar.Tarefa/br.com.sitar.Tarefa.php');
require($path.'/sitar/model/br.com.sitar.Movimento/br.com.sitar.Movimento.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/sitar/view/css/reset.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/sitar/view/css/base.css">
        <link rel="stylesheet" type="text/css" href="/sitar/view/css/form_nova_tarefa.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="/sitar/controller/js/base.js"></script>
        <script type="text/javascript" src="/sitar/controller/js/form_nova_tarefa.js"></script>
        <meta charset="utf-8">
        <title>Sitar - <?php echo usuario::recupera_usuario_cookie() ?> </title>
    </head>
    <body>
        <?php require($path.'/sitar/view/header.php'); ?>
        <main>
        
      <div class="formNewTask">
<h1 style="color:blue;text-align:center;"> Inserir Nova Tarefa </h1>
    <div class="esquerda">
        <div class="linha"><p>Responsável pela entrega da tarefa</p></div>
        <div class="linha"><p>Data limite de finalização da tarefa </p></div>
        <div class="linha"><p>Prioridade</p></div>
        <div class="linha"><p>Resumo</p></div>
        <div class="linha"><p>Data limite do primeiro movimento</p></div>
        <div class="linha_grande"><p>Descrição</p></div>
    </div>

    <div class="direita">
        <div class="linha" ><?php usuario::lista_select();?></div>
        <div class="linha"><input type = "datetime-local" id="data_limite_tarefa"></div>
        <div class="linha"><input type = "text" id = "prioridade"></div>
        <div class="linha"><input type="text" id = "resumo"  maxlength="45"></div>
        <div class="linha"><input type = "datetime-local" id="data_limite_movimento"></div>
        <div class="linha_grande"><textarea id = "descricao" maxlength="300"></textarea></div>
    </div>
    
    <div class="clear"></div>
    <div id="button_send"> <button id="enviar">Enviar</button><button id="alterar">Alterar</button></div>
<div class="clear"></div>
    </div>   
        </main>
        <?php require($path.'/sitar/view/footer.php'); ?>     
    </body>
</html>




<div> 
