<?php

$idtarefa="184";
require_once 'conexao.php';
require_once 'tarefa.php';

        $query =$conexao->stmt_init();    
        //testa se o query está correto
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
            echo "Há um problema com a sintaxe inicial da query SQL";
             }
             
    $tarefa = new Tarefa(null,null,null,null,null,null,null,null,null);
    $tarefa=$tarefa->recuperar_tarefa(153);
    echo $tarefa->getResumo()."<br>";
    
    echo $tarefa->getResponsavel();

