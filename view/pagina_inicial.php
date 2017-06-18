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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="/sitar/controller/js/base.js"></script> 
        <meta charset="utf-8">
        <title>Sitar - <?php echo usuario::recupera_usuario_cookie() ?> </title>
    </head>
    <body>
        <?php require_once($path.'/sitar/view/header.php'); ?>
        <main class="content" id="conteudo"></main>
        <?php require_once($path.'/sitar/view/footer.php'); ?>     
        
    </body>
</html>