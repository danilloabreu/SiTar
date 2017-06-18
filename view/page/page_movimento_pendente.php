<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/sitar/model/usuario.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/sitar/view/css/reset.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/sitar/view/css/base.css">
        <link rel="stylesheet" type="text/css" href="/sitar/view/css/page_movimento_pendente.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="/sitar/controller/js/base.js"></script>
        <script type=text/javascript src=/sitar/controller/js/table_movimento_pendente.js\></script>
        <meta charset="utf-8">
        <title>Sitar - <?php echo usuario::recupera_usuario_cookie(); ?> </title>
    </head>
    <body>
        <?php require($path.'/sitar/view/header.php'); ?>
            <main class="main">
                <h1> Movimentos Pendentes - <?php echo usuario::recupera_usuario_cookie(); ?></h1>
                <div class="div_movimento_pendente">
                    <?php require_once($path.'/sitar/view/table/table_movimento_pendente.php'); ?>   
                </div>
            </main>
        <?php require_once($path.'/sitar/view/footer.php'); ?>        
    </body>
</html>