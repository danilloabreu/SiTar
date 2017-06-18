<?php 
//require_once ("conexao.php");
require_once ("../../util/log.php");

 $usuario =    $_POST['usuario'];
 $entrar =     $_POST['entrar'];
 $senha = 	$_POST['senha'];
 
  
//echo $usuario;
//echo $senha;

$connect = mysql_connect('127.0.0.1','root','');
$db = mysql_select_db('sitar');
    if (isset($entrar)) {
        $mensagem= "Tentativa de login: ".$usuario." senha: ".$senha;
        salvaLog($mensagem);
        
      $verifica = mysql_query("SELECT * FROM usuario WHERE nome = '$usuario' AND senha = '$senha'") or die("erro ao selecionar");
        if (mysql_num_rows($verifica)<=0){
          //echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='formulario_login.html';</script>";
          echo false;
            die();
        }else{
          setcookie("usuario",$usuario,0,"/");
          //header("Location:pagina_inicial.php");
          $mensagem= "Sucesso no login: ".$usuario." senha: ".$senha;
          salvaLog($mensagem);
          echo true;
          
        }
    }
?>