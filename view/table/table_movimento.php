<html>
    <head>
        <title>
            Tabela de Movimentos
        </title>
        <link rel="stylesheet" type="text/css" href="../css/table_movimento.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>    
    <body>
        <div>
<?php

require '../../controller/php/conexao.php';
require '../../model/br.com.sitar.Tarefa/br.com.sitar.Tarefa.php';


$idtarefa=$_GET['idtarefa'];

$tarefa = New Tarefa(null,null,null,null,null,null,null,null);
$tarefa=$tarefa->recuperar_tarefa($idtarefa);

$table="<table  border=1 style=\"border-collapse: collapse\"><tr><td>Id da tarefa ".$tarefa->getId_tarefa();
$table.="</td><td>Responsavel: ".$tarefa->getResponsavel();
$table.="</td><td>Resumo da tarefa ".$tarefa->getResumo();
$table.="</td></tr></table>";
echo $table;

echo "<h1> Movimentos da Tarefa</h1>";

$query =$conexao->stmt_init();    
        //testa se o query está correto
        if($query=$conexao->prepare("SELECT idmovimento,idtarefa,emissor,destinatario,finished,descricao,datainicio,datalimite,dataefetivaresposta FROM movimento WHERE idtarefa = ? ")){
            //passando variaveis para a query
            try{           
            $idtarefa=$tarefa->getId_tarefa();    
            $query->bind_param('s',$idtarefa);           
            $resultado=$query->execute();
            
            $tabela= "<table border=1 class=\"tabela_movimento\" style=\"border-collapse: collapse\"><tr><th>Movimento</th><th>Tarefa</th><th>Emissor</th><th>Destinatario</th><th>Finalizado</th><th>Descricao</th><th>Data do Movimento</th><th>Data Limite da Resposta </th><th>Data efetiva Resposta</th></th>";
            $query->bind_result($col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9);
            
            
            
            
            
            while ($query->fetch()) {    
            //printf("%s %s %s %s %s %s %s %s %s\n", $col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9);
            $tabela.="<tr><td>".$col1."</td><td>".$col2."</td><td>".$col3."</td><td>".$col4."</td><td>".$col5."</td><td>".$col6."</td><td>".$col7."</td><td>".$col8."</td><td>".$col9."</td></tr>";
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
             $tabela.="</table>";
             echo $tabela;
       
             
 ?>            
             
     </div><br>
     
     
</body>
</html>