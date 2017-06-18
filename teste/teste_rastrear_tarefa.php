<?php
require_once '../conexao.php';
require_once '../tarefa.php';
require_once '../../controller/usuario.php';
//$tarefa = New Tarefa(null,null,null,null,null,null,null,null);
//$tarefa=$tarefa->recuperar_tarefa(118);

$emissor=Usuario::recupera_usuario_cookie();

echo "<h1 style=\"color:blue;text-align:center;\"> Rastreamento de Tarefas Solicitadas - Responsável ".$emissor."</h1>";

$query =$conexao->stmt_init();    
        //testa se o query está correto
        if($query=$conexao->prepare("SELECT * FROM tarefa WHERE emissor = ? AND datarealfinalizacao IS NULL ORDER BY dataabertura DESC ")){
            //passando variaveis para a query
            try{            
            $query->bind_param('s',$emissor);           
            $resultado=$query->execute();
            
            $tabela= "<table border=1 style=\"border-collapse: collapse\"><tr><td>Nº da Tarefa</td><td>Resumo</td><td>Responsável</td><td>Data de Abertura</td><td>Data de Finalização</td><td>Prioridade</td><td>Emissor</td><td>Parada com </td><td>Desde</td></tr>";
            $query->bind_result($col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9);
            
                $agora=new DateTime();
                $agora=$agora->format('d-m-Y H:i:s');
            
            while ($query->fetch()) {    
                
                $dataabertura=new DateTime($col4);
                $dataabertura=$dataabertura->format('d-m-Y H:i:s');
                
                $datafinalizacao=new DateTime($col5);
                $datafinalizacao=$datafinalizacao->format('d-m-Y H:i:s');
                
                     if(strtotime($agora)-strtotime($datafinalizacao)>=0){
                       $tabela.="<tr class=\"atrasada\">";   
                        }else{
                            $tabela.="<tr>";   
                            }          

                    $tabela.="<td> <a href=\"#\" onclick=\"window.open('tabela_movimento.php?idtarefa=".$col1."', 'Movimentos', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=NO, TOP=50, LEFT=50, WIDTH=770, HEIGHT=400');\">".$col1."</a></td>"
                    . "<td>".$col2."</td><td>".$col3."</td><td>".$dataabertura."</td><td>".$datafinalizacao."</td><td>".$col6."</td><td>".$col7."</td><td>".Tarefa::parada_com($col1)."</td><td>".Tarefa::parada_desde($col1)."</td>"
                    . "</tr>";
                    }//fim do laço while
            
        
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
             
             echo $tabela;