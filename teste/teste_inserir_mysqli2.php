<?php
error_reporting(-1);
$con=mysqli_connect("localhost","root","","sitar");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Perform queries 
$stmt =   $con->stmt_init();

 if($stmt = $con->prepare("INSERT INTO usuario (idusuario,nome,senha,email) VALUES (?,?, ?, ?)")){

//adiciona os parametros 
$idusuario=null;
$nome="danilo1";
$senha="123burro";
$email="dandanmail";
$stmt->bind_param('isss',$idusuario,$nome,$senha,$email); 


 if (!$stmt->execute()) {
        trigger_error('Error executing MySQL query: ' . $stmt->error);
    }
//executa a query
//$stmt->execute();
//fecha a conecão
$stmt->close();
     
 }
 

?>
