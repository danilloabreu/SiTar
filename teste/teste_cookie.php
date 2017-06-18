<?php

if (!isset($_COOKIE['usuario']))
{
echo ("Você não está logado");
//header("Location:login.php");
die();
}
else
{
echo "Seja Bem Vindo ".$_COOKIE["usuario"];
}



?>