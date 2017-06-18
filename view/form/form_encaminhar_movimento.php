<?php require("../../model/usuario.php");?>﻿

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<link href="../css/estilo.css" rel="stylesheet" type="text/css" />

<script>
$(document).ready(function(){
    
    //$("#data_limite").val("2016-03-18T13:00");
    //$('#data_limite_tarefa').val(new Date().toJSON().slice(0,19));
    $('#data_limite_movimento').val(new Date().toJSON().slice(0,19));
    
	$("#enviar").click(function(){
         //alert($('#idtarefa').val());
         //var x = true;
         //var prioridade = $('#prioridade').val();
         var resumo = $('#resumo').val();
         
	$.post("../../controller/php/encaminhar_movimento.php",
    {
        idtarefa: $('#idtarefa').val(),
        data_limite_movimento: $('#data_limite_movimento').val(),
        destinatario: $('#responsavel').val(),
        descricao: $('#descricao').val()
    },
    function(data, status){
        alert("O servidor respondeu : " + data);
        window.close();
        
    });//fim da função post



});//fim da função clique




});//fim da função ready
</script>



<body>

<div class="envelope">

<div class="esquerda">
<div class="linha"><p>Destinatario</p></div>
<div class="linha"><p>Data limite</p></div>
<div class="linha"><p>Descrição</p></div>
</div>

<div class="direita">
<div class="linha" id ><?php usuario::lista_select();?></div>
<div class="linha"><input type = "datetime-local" id="data_limite_movimento"></div>
<div class="linha"><textarea id = "descricao" maxlength="300" rows="5" cols="50" ></textarea></div>
</div>

<div class="clear"></div>

<div> <button id="enviar">Encaminhar</button></div>
<input type="hidden" id="idtarefa" value= <?php echo "\"". $_GET["idtarefa"]."\"";?>>
</div>
</body>
