<?php

//faz a conexão com o banco de dados
require ("../controller/php/conexao.php");

$query =$conexao->stmt_init();    
        //testa se o query está correto
        if($query=$conexao->prepare("SELECT dataabertura FROM tarefa WHERE idtarefa = 1 "))
            //passando variaveis para a query
                     
            //$idtarefa=$tarefa->getId_tarefa();    
            //$query->bind_param('s',$idtarefa);           
            $resultado=$query->execute();
            
            //$tabela= "<table border=1 class=\"tabela_movimento\" style=\"border-collapse: collapse\"><tr><td>Movimento</td><td>Tarefa</td><td>Emissor</td><td>Destinatario</td><td>Finalizado</td><td>Descricao</td><td>Data do Movimento</td><td>Data Limite da Resposta </td><td>Data efetiva Resposta</td></tr>";
            $query->bind_result($col1);
            while ($query->fetch()) {
            //printf("%s \n", $col1);
            $datasql = new DateTime($col1);
            //$datasql = new DateTime();
            $datasql=$datasql->format('d-m-Y H:i:s');
            //echo date('d/m/Y'.strtotime($datasql));
            echo $datasql;
            //$datasql1="2018-05-22 T 22:33";
            echo"<br>";
            $tempo= strtotime($datasql)*1000;
            //echo $tempo;
    }
    ?>        
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
    
    Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,19);
    });
    
   
    $('#data').val(new Date(<?php echo $tempo?>).toDateInputValue());
    alert("<?php echo $datasql?>");
   
    });//fim da função ready
        
    </script>
</head>     


<div class="linha"><input type = "datetime-local" id="data"></div>
     
            
            
            <?php
            /*
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
            ?>
             
             

