<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once($path.'/sitar/model/usuario.php');
?>




<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/sitar/view/css/reset.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/sitar/view/css/base.css">
        <link rel="stylesheet" type="text/css" href="/sitar/view/css/page_alterar_excluir_tarefa.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
        <script type="text/javascript" src="/sitar/controller/js/base.js"></script>
        <script type=text/javascript src="/sitar/controller/js/table_alterar_excluir.js"></script>
        <meta charset="utf-8">
        <title>Sitar - <?php print usuario::recupera_usuario_cookie() ?> </title>
    </head>
    <body>
        <?php require_once($path.'/sitar/view/header.php'); ?>
        <main class="main">
        <h1> Alteração/Exclusão de Tarefa - Emissor <?php echo usuario::recupera_usuario_cookie() ?></h1>
        <?php require_once($path.'/sitar/view/table/table_alterar_excluir.php'); ?>
        </main>
        <?php require_once($path.'/sitar/view/footer.php'); ?>     
        
    </body>
</html>