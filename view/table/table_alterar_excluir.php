<?php
/*
 * Tabela que permite alterar ou excluir uma tarefa que foi aberta a menos de 30 minutos
 * 
 * 
 */

$path = $_SERVER['DOCUMENT_ROOT'];

require_once ($path.'/sitar/controller/php/conexao.php');
require_once ($path.'/sitar/model/br.com.sitar.Tarefa/br.com.sitar.Tarefa.php');
require_once ($path.'/sitar/model/usuario.php');
//$tarefa = New Tarefa(null,null,null,null,null,null,null,null);
//$tarefa=$tarefa->recuperar_tarefa(118);

//inclusão de arquivo table_alterar_excluir

$emissor=Usuario::recupera_usuario_cookie();


$query =$conexao->stmt_init();    
        //testa se o query está correto
        if($query=$conexao->prepare("SELECT idtarefa,resumo,responsavel,dataabertura,datafinalizacao,prioridade,emissor FROM tarefa WHERE emissor = ? AND datarealfinalizacao IS NULL AND deleted IS NULL ORDER BY dataabertura DESC ")){
            //passando variaveis para a query
            try{            
            $query->bind_param('s',$emissor);           
            $resultado=$query->execute();
            
            $tabela= "<table><tr><th>Nº da Tarefa</th><th>Resumo</th><th>Responsável</th><th>Data de Abertura</th><th>Data de Finalização</th><th>Prioridade</th><th>Emissor</th><th>Parada com </th><th>Desde</th><th>Ação</th></tr>";
            $query->bind_result($col1, $col2,$col3,$col4,$col5,$col6,$col7);
            
                $agora=new DateTime();
                $agora=$agora->format('d-m-Y H:i:s');
            
                $aux=1;
            while ($query->fetch()) {    
                
                $dataabertura=new DateTime($col4);
                $dataabertura=$dataabertura->format('d-m-Y H:i:s');
                
                $datafinalizacao=new DateTime($col5);
                $datafinalizacao=$datafinalizacao->format('d-m-Y H:i:s');
                
                     if(strtotime($agora)-strtotime($datafinalizacao)>=0){
                       $tabela.="<tr class=\"atrasada\" linha=".$aux.">";   
                        }else{
                            $tabela.="<tr linha=".$aux." >";   
                            }          
                    
                    $disabled="";
                    
                    if(strtotime($agora)-strtotime($dataabertura)>=30*60){
                    $disabled=" disabled";    
                    }
                            
                    $tabela.="<td class=\"idTarefa\" linha=".$aux." >".$col1."</td>"
                    . "<td>".$col2."</td><td>".$col3."</td><td>".$dataabertura."</td><td>".$datafinalizacao."</td><td>".$col6."</td><td>".$col7."</td><td>".Tarefa::parada_com($col1)."</td><td>".Tarefa::parada_desde($col1)."</td>"
                            . "<td><i linha=".$aux." class=\"fa fa-pencil alterar\" aria-hidden=\"true\"id=\"".$col1."\" ".$disabled."></i><i linha=".$aux." class=\"fa fa-trash-o excluir1\" aria-hidden=\"true\"id=\"".$col1."\" ".$disabled."></i></td>"
                    . "</tr>";
                    $aux++;
                    }//fim do laço while
            
        
               //testa o resultado
               if (!$resultado) {
               $message  = 'Invalid query: ' . $conexao->error . "\n";
               //$message .= 'Whole query: ' . $resultado;
               die($message);
                }
            }
                catch(Exception $e){
                echo "problema";
                }
        
        //while($row = $resultado->fetch_assoc()){
        //echo $row['resumo'] . '<br />';
        }else{
            echo "Há um problema com a sintaxe inicial da query SQL";
             }
             
             echo $tabela;