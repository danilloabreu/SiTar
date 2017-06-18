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
        <meta charset="utf-8">
        <title>Sitar - <?php echo usuario::recupera_usuario_cookie() ?> </title>
    </head>
    <body>
        <?php require($path.'/sitar/view/header.php'); ?>
        <form>Novo formulário de inserir usuário</form>
        <?php require($path.'/sitar/view/footer.php'); ?>     
        
    </body>
</html>