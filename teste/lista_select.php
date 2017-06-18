<?php
//faz a conexão com o banco de dados
require ("../conexao.php");

echo ("<label >Responsável: </label>");
echo ("<select name=\"responsavel\" id=\"responsavel\">?");

$query =$conexao->stmt_init();    
    //testa se o query está correto
    if($query=$conexao->prepare("SELECT * FROM usuario ORDER BY nome ASC")){
            //passando variaveis para a query
            try{           
            //$idtarefa=$tarefa->getId_tarefa();    
            //$query->bind_param('s',$idtarefa);           
            $resultado=$query->execute();
            
            $tabela= "<table border=1 style=\"border-collapse: collapse\"><tr><td>Movimento</td><td>Tarefa</td><td>Emissor</td><td>Destinatario</td><td>Finalizado</td><td>Descricao</td><td>Data do Movimento</td><td>Data Limite da Resposta </td><td>Data efetiva Resposta</td></tr>";
            $query->bind_result($col1, $col2,$col3,$col4);
            
           
            while ($query->fetch()) {    
            //printf("%s %s %s %s %s %s %s %s %s\n", $col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9);
            echo ("<option value=\"".$col2."\">".$col2."</option>");
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
       
        }else{
            echo "Há um problema com a sintaxe inicial da query SQL";
             }
echo ("</select>");

?>



