<?php

//faz a conexão com o banco de dados
require ("../controller/php/conexao.php");



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
             
             
             

