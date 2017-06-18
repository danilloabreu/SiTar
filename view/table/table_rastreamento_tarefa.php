<?php
/*
 * Tabela que rastrea as tarefas que o usuário é o solicitantante
 * 
 * 
 */


require_once '../../controller/php/conexao.php';
require_once '../../model/br.com.sitar.Tarefa/br.com.sitar.Tarefa.php';
require_once '../../model/usuario.php';

echo "<html>";
echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js\"></script>";
echo "<script type=text/javascript src=\"../controller/js/table_rastreamento_tarefa.js\"></script>";



$emissor=Usuario::recupera_usuario_cookie();

echo "<h1 style=\"color:blue;text-align:center;\"> Rastreamento de Tarefas Solicitadas - Emissor ".$emissor."</h1>";

$query =$conexao->stmt_init();    
        //testa se o query está correto
        if($query=$conexao->prepare("SELECT * FROM tarefa WHERE emissor = ? AND datarealfinalizacao IS NULL AND deleted IS NULL ORDER BY dataabertura DESC ")){
            //passando variaveis para a query
            try{            
            $query->bind_param('s',$emissor);           
            $resultado=$query->execute();
            
            $tabela= "<table class=\"tabela_rastreamento_tarefa\" border=1 style=\"border-collapse: collapse\"><tr><td>Nº da Tarefa</td><td>Resumo</td><td>Responsável</td><td>Data de Abertura</td><td>Data de Finalização</td><td>Prioridade</td><td>Emissor</td><td>Parada com </td><td>Desde</td><td>Aprovar</td></tr>";
            $query->bind_result($col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9,$col10,$col11);
            
                $agora=new DateTime();
                $agora=$agora->format('d-m-Y H:i:s');
            
            while ($query->fetch()) {    
                
                $dataabertura=new DateTime($col4);
                $dataabertura=$dataabertura->format('d-m-Y H:i:s');
                
                $datafinalizacao=new DateTime($col5);
                $datafinalizacao=$datafinalizacao->format('d-m-Y H:i:s');
                
                    if($col8==null){
                        $disabled="disabled";
                    }else{
                        $disabled="null";
                    }
                
                
                
                     if(strtotime($agora)-strtotime($datafinalizacao)>=0){
                       $tabela.="<tr class=\"atrasada\">";   
                        }else{
                            $tabela.="<tr>";   
                            }          

                    $tabela.="<td> <a href=\"#\" onclick=\"window.open('table/table_movimento.php?idtarefa=".$col1."', 'Movimentos', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=NO, TOP=50, LEFT=50, WIDTH=770, HEIGHT=400');\">".$col1."</a></td>"
                    . "<td>".$col2."</td><td>".$col3."</td><td>".$dataabertura."</td><td>".$datafinalizacao."</td><td>".$col6."</td><td>".$col7."</td><td>".Tarefa::parada_com($col1)."</td><td>".Tarefa::parada_desde($col1)."</td>"
                    . "<td><button class =\"aprovar\"".$disabled." id=\"".$col1."\">Aprovar</button></td>"
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
echo "</html>";