<?php

require '../controller/usuario.php';

$usuario = new Usuario("Danilo1",NULL,"dandan@danete.com.br");
$usuario->inserir_usuario($usuario);







