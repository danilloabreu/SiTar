<?php
$path = $_SERVER['DOCUMENT_ROOT'];

require_once ($path.'/sitar/controller/php/conexao.php');
require_once ($path.'/sitar/model/usuario.php');
require_once ($path.'/sitar/model/br.com.sitar.Tarefa/br.com.sitar.Tarefa.php');

$destinatario=Usuario::recupera_usuario_cookie();

$query =$conexao->stmt_init();  
$sql='SELECT movimento.idmovimento,movimento.idtarefa,movimento.emissor,movimento.descricao,movimento.datainicio,movimento.datalimite FROM sitar.movimento JOIN sitar.tarefa ON tarefa.idtarefa=movimento.idtarefa WHERE movimento.destinatario = ? AND movimento.finished IS NULL AND tarefa.datasolicitacaofinalizacao IS NULL AND tarefa.deleted IS NULL';
//$sql="SELECT idmovimento,idtarefa,emissor,descricao,datainicio,datalimite FROM movimento WHERE destinatario = ? AND finished IS NULL";
//$sql="SELECT * FROM movimento WHERE destinatario = ? AND finished IS NULL";
//testa se o query está correto
        
    if($query=$conexao->prepare($sql)){
        //passando variaveis para a query
        try{           
            $query->bind_param('s',$destinatario);           
            $resultado=$query->execute();
            $tabela= "<table class=\"table_movimento_pendente\">"
                    . "<tr><td>Movimento</td>"
                    . "<td>Tarefa</td>"
                    . "<td>Emissor</td>"
                    . "<td>Descrição</td>"
                    . "<td>Data do Movimento</td>"
                    . "<td>Data Limite da Resposta</td>"
                    . "<td>Prazo</td>"
                    . "<td>Ação</td></tr>";
            $query->bind_result($idmovimento,$idtarefa,$emissor,$descricao,$datainicio,$datalimite);
            
            $disabled="";
            while ($query->fetch()) {    
                
                $tarefa = new Tarefa();
                $tarefa =$tarefa->recuperar_tarefa($idtarefa);
                
                if($tarefa->getResponsavel()!= Usuario::recupera_usuario_cookie()){
                $disabled=" disabled";                      
                }
                //frmatando data de início
                $datainicio= new DateTime($datainicio);
                $datainicio=$datainicio->format('d-m-Y H:i:s');
                
                //formatando data limite
                $datalimite= new DateTime($datalimite);
                $datalimite=$datalimite->format('d-m-Y H:i:s');
                
                //desenha a barra de prazo
                $agora = new Datetime();
                $prazo= (strtotime($datalimite)-strtotime($agora->format('d-m-Y H:i:s')))/((strtotime($datalimite)-strtotime($datainicio)));
                $prazo=1-$prazo;
                $prazo=$prazo*100;
                $cor="green";
                if($prazo>70&&$prazo<100){
                 $cor="yellow";   
                }
                
                if($prazo>=100){
                   $prazo=100;
                   $cor="red";
                }
                
                $prazo=$prazo."%";
                //echo ("<hidden id=\"porcentagen_prazo\">".$prazo."</hidden>");
                
                $tabela.="<tr><td>".$idmovimento."</td>"
                        . "<td> <a href=\"#\" onclick=\"window.open('table/table_movimento.php?idtarefa=".$idtarefa."', 'Movimentos', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=NO, TOP=50, LEFT=50, WIDTH=770, HEIGHT=400');\">".$idtarefa."</a></td>"
                        . "<td>".$emissor."</td>"
                        . "<td>".$descricao."</td>"
                        . "<td>".$datainicio."</td>"
                        . "<td>".$datalimite."</td>"
                        //. "<td>".$prazo"</td>"
                        ."<td><div id=\"myProgress\"><div class=\"myBar\" style= \"width:".$prazo."; background-color: ".$cor."\";\" id=\"".$prazo."\"></div></div></td>"
                        . "<td><i class=\"fa fa-forward\" aria-hidden=\"true\" title=\"Encaminhar\"></i>   <i class=\"fa fa-check-square\" aria-hidden=\"true\" title=\"Finalizar\"> </i></td></tr>";
            } 
           //testa o resultado
            if (!$resultado) {
                $message  = 'Invalid query: ' . $conexao->error . "\n";
                //$message .= 'Whole query: ' . $resultado;
                die($message);
            }//end of if
        }//end of try
        catch(Exception $e){
            echo "fudeu";
        }
    //while($row = $resultado->fetch_assoc()){
    //echo $row['resumo'] . '<br />';
    }else{
        echo "Há um problema com a sintaxe inicial da query SQL";
    }
             
echo $tabela;
//echo "</div>";
//echo "</html>";
?>