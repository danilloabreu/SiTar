<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
    
    Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,19);
    });
    
   
    $('#data').val(new Date().toDateInputValue());

    
    
    //$("#data_limite").val("2016-03-18T13:00");
    //$('#data').val(new Date().toJSON().slice(0,19));
    //$('#data_limite_movimento').val(new Date().toJSON().slice(0,19));
    //var data = $("#data").val();
    
	$("#enviar").click(function(){
            alert($("#data").val());
            //alert(data);
            var year    = '2017';
            var month   = '01';
            var day     = '15';
            var hour    = '22';
            var min     = '32';
            var sec     = '32';
            
            var year    = $("#data").val().slice(0,4);
            var month   = $("#data").val().slice(5,7);
            var day     = $("#data").val().slice(8,10);
            var hour    = $("#data").val().slice(11,13);
            var min     = $("#data").val().slice(14,16);
            var sec     = $("#data").val().slice(17,19);
            

            
            var data1 = new Date(year+'-'+month+'-'+day+' '+hour+':'+min+':'+sec);
            alert (data1);
            
            var agora = new Date();
            var s_agora = agora.getTime();
            
            var s_data1= data1.getTime();
            
            
            
            if(s_data1<s_agora){
                alert("Nao pode inserir com tempo anterior");
            }else{
                alert("A data eh valida");
            }
            //var x = true;
            //var prioridade = $('#prioridade').val();
            //var resumo = $('#resumo').val();
           
 
        
       
    });//fim da função clique
});//fim da função ready
        </script>
        
        <body>
        <div><input type = "datetime-local" id="data"></div>
        <button id ="enviar">Aperte</button>
        </body>
    </head>
</html>






<?php
$teste1="lindo";
echo ("Danilo Abreu $teste1");

/*
 * 
 * 
             $data = new DateTime();
             $data=$data->format('d-m-Y H:i:s');
             echo $data; 
             echo ("<br>");
             $data1 = new DateTime('+29 minute');
             $data1=$data1->format('d-m-Y H:i:s');
             echo $data1 ;
            // $intervalo = $data1->diff($data);
             echo ("<br>");
             //echo $intervalo->format('%i');
             //$hora=$intervalo->format('%H');
             //$minuto=$hora*60;
             //echo $minuto;
             $tempo= strtotime($data);
             $tempo2=strtotime($data1);
             //$dif=$tempo2-$tempo;
             $diferença = $tempo2-$tempo;
             $diferença=$diferença/60;
             
             if($diferença>=30){
                 echo "Tarefa confirmada - não é possível alterar";
             }else {
                 echo "Liberada para alteração";
             }
             
             echo $diferença;
             
             
  */           

