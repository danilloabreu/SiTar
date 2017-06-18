<?php
header("Content-type: text/html;charset=utf-8");
require 'tarefa.php';
$tarefa = new Tarefa("1","resumo 1","responsavel 1","data1","data2","qms","oo","data final");
echo "O id da tarefa �".$tarefa->getId_tarefa()."<br>";
echo "O  resumo da tarefa � ".$tarefa->getResumo()."<br>";
echo "O  resposavel da tarefa � ".$tarefa->getResponsavel()."<br>";
echo "A data de abertura da tarefa � ".$tarefa->getData_abertura()."<br>";


$query =$conexao->stmt_init();    
        //testa se o query est� correto
        if($query=$conexao->prepare("SELECT * FROM tarefa WHERE idtarefa = ? ")){
            //passando variaveis para a query
            try{              
            $query->bind_param('s',
            $idtarefa);           
            $resultado=$query->execute();
            $query->bind_result($col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8);
            while ($query->fetch()) {
            printf("%s %s %s %s %s %s %s %s\n", $col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8);
 
            }
        
        
               //testa o resultado
               if (!$resultado) {
               $message  = 'Invalid query: ' . $conexao->error . "\n";
               //$message .= 'Whole query: ' . $resultado;
               die($message);
                }
            }
                catch(Exception $e){
                echo "fudeu";
                }
        
        //while($row = $resultado->fetch_assoc()){
        //echo $row['resumo'] . '<br />';
        }else{
            echo "H� um problema com a sintaxe inicial da query SQL";
             }

