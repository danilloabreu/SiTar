<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/formulario_login.css">         
        <title> Login de Usuário </title>
    </head>
    <body>
        <div class="envelope">
            <div class="header">Sistema de Tarefas - SITAR - Dandan Systems™ 2016-2016</div>
            <div class="logo"><img class="img" src="sitar.png" width="250" height="300"></div>
                <div class="conteudo">
                    <form method="POST" action="validar_login.php">    
                        <div class="linha"><label>Login </label><input type="text" name="usuario" id="usuario"></div><br>
                        <div class="linha"><label>Senha </label><input type="password" name="senha" id="senha"></div><br>
                        <input type="submit" value="Entrar" id="entrar" name="entrar"><br>
                        <div class="linha"><a href="cadastro.html">Cadastre-se</a></div>
                    </form>
                </div>
            
            <div class="footer">Sistema de Tarefas - SITAR - Dandan Systems™ 2016-2016</div>
        </div>
    </body>
</html>