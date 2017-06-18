<?php
//faz a conexão com o banco de dados
require ("conectar.php");

//faz a consulta sql
//$qry = mysql_query("select nome,senha from usuario");
$qry = mysql_query("SELECT * FROM sitar.tarefa WHERE tarefa.responsavel = 'Danilo' order BY emissor");
//Pegando os nomes dos campos
$num_fields = mysql_num_fields($qry);//obtem o numero de campos
//echo ($num_fields);
for($i = 0;$i<$num_fields; $i++){//Pega o nome dos campos
	$fields[] = mysql_field_name($qry,$i);//joga num array
}

//Montando o cabecalho da tabela
$table = '<table border="0"><tr>';

for($i = 0;$i < $num_fields; $i++){
	$table .= '<th>'.$fields[$i].'</th>';
}
    //adicionando numero da linha
	//$table .='<th>Número da Linha</th>';
    
	//adicionando comando excluir
	//$table .='<th>Excluir</th>';


//Montando o corpo da tabela
$table .= '<tbody>';
$aux=1;//auxiliar para contar o numero da linha
while($r = mysql_fetch_array($qry)){
	$table .= '<tr>';
	for($i = 0;$i < $num_fields; $i++){
		$table .= '<td>'.$r[$fields[$i]].'</td>';
	}
	//$table .= '<td>'.$aux.'</td>';//adicionando comando excluir
	//$table .= '<td>'.'<button id="'.$r[$fields[0]].'"onclick="getId(this.id)"></button>'.'</td>';//adicionando comando excluir linkado ao id do campo
	$table .= '</tr>';
	//$aux=$aux+1;//somando 1 ao numero da linha
}//fim do while

//Finalizando a tabela
$table .= '</tbody></table>';

//Imprimindo a tabela
echo $table;
?>