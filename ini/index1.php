<?php

// Transformando arquivo XML em Objeto
$xml = simplexml_load_file('conexao.xml');
 
// Exibe as informações do XML
echo 'Endereço da Conexão : ' . $xml->host . '<br>';
echo 'Usuario : ' . $xml->usuario . '<br>';
echo 'Senha : ' . $xml->senha . '<br>';
echo 'Banco de dados : ' . $xml->bd . '<br>';
 

?>
