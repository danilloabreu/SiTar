<?php
$path = $_SERVER['DOCUMENT_ROOT'];


require_once ($path.'/sitar/controller/php/conexao.php');
require_once ($path.'/sitar/model/br.com.sitar.Tarefa/br.com.sitar.Tarefa.php');
require_once ($path.'/sitar/model/usuario.php');


$responsavel=Usuario::recupera_usuario_cookie();

//echo "<h1 style=\"color:blue;text-align:center;\"> Monitoramento de Tarefas Abertas - Responsável ".$responsavel."</h1>";

$query =$conexao->stmt_init();
//$sql="SELECT * FROM tarefa WHERE responsavel = ? AND finalizada IS NULL ORDER BY dataabertura DESC ";
$sql="SELECT idtarefa,resumo,dataabertura,datafinalizacao,prioridade,emissor FROM tarefa WHERE responsavel = ? AND datarealfinalizacao IS NULL AND tarefa.deleted IS NULL AND finished IS NULL ORDER BY dataabertura DESC ";

    //testa se o query está correto
        if($query=$conexao->prepare($sql)){
            //passando variaveis para a query
            try{            
            $query->bind_param('s',$responsavel);//passando o parâmetro $responsavel como string           
            $resultado=$query->execute();           
            $query->bind_result($col1, $col2,$col3,$col4,$col5,$col6);
            //desenho da tabela
            $tabela= "<table border=1 class=\"tabela_monitoramento_tarefa\" style=\"border-collapse: collapse\"><tr><td>Nº da Tarefa</td><td>Resumo</td><td>Data de Abertura</td><td>Data Limite</td><td>Prioridade</td><td>Emissor</td><td>Parada com</td><td>Desde</td></tr>";
            //pegando a data atual    
            $agora=new DateTime();
            $agora=$agora->format('d-m-Y H:i:s');
            
            while ($query->fetch()) {    
                
                $dataabertura=new DateTime($col3);
                $dataabertura=$dataabertura->format('d-m-Y H:i:s');
                
                $datafinalizacao=new DateTime($col4);
                $datafinalizacao=$datafinalizacao->format('d-m-Y H:i:s');
                
                     if(strtotime($agora)-strtotime($datafinalizacao)>=0){
                       $tabela.="<tr class=\"atrasada\">";   
                        }else{
                            $tabela.="<tr>";   
                            }          
                //$tempo1= strtotime($agora);
                //$tempo2=strtotime($datafinalizacao);
                
                            
                    $tabela.="<td> <a href=\"#\" onclick=\"window.open('/sitar/view/table/table_movimento.php?idtarefa=".$col1."', 'Movimentos', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=NO, TOP=50, LEFT=50, WIDTH=770, HEIGHT=400');\">".$col1."</a></td>"
                            . "<td>".$col2."</td>"
                            . "<td>".$dataabertura."</td>"
                            . "<td>".$datafinalizacao."</td>"
                            . "<td>".$col5."</td>"
                            . "<td>".$col6."</td>"
                            . "<td>".Tarefa::parada_com($col1)."</td>"
                            . "<td>".Tarefa::parada_desde($col1)."</td>"
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
?>