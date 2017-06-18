$(document).ready(function(){
    
    /*Funções*/
    function nomeFundo(){
        var x = "fundo";
        var y = Math.floor((Math.random() * 4) + 1);
        y=y.toString();
        x = x.concat(y);
        x=x.concat(".png");
        return x;
    }
    function trocarFundo (){
        $("#container").css("background-image","url(../img/"+nomeFundo()+")");
    }
 
    /*Variáveis*/
    var fundo = setInterval(nomeFundo, 1000);
    var myVar = setInterval(trocarFundo, 20000);
    
    
 /*Eventos*/
    $(document).keypress(function(e) {
        if(e.which == 13) $('#entrar').click();
    });//fim da função keypress
    $("#senha").focusin(function(){
	$(this).css("border", "1px solid #0077B5");
	$(this).css("color", "black");
    });//fim da função focus in
    $("#senha").focusout(function(){
        $(this).css("border", "1px solid #BFBFBF");	
    });//fim da função focus out
    $("#entrar").click(function(){
        $nome=$("#nome").val();
	$senha=$("#senha").val();
        
        $.post("../../controller/php/validar_login.php",{
            usuario: $('#nome').val(),
            senha: $('#senha').val(),
            entrar: 'true'
            },
                function(data, status){
                    if(data==true){
                        window.location.href="../pagina_inicial.php";}
                    else{
                        alert("Nome de usuário ou senha incorretos ");
                       alert (data);
                        $("#senha").css("background", "red");
                        $("#nome").css("background", "red");
                    }
        });//fim da função post
        
        /*
        if($nome!="Danilo"){
            $("#nome").css("background", "red");}
        else{
            $("#nome").css("background", "white");}
	if($senha!="1234"){
            $("#senha").css("background", "red");}
        else{
            $("#senha").css("background", "white");}
            */
    });//fim da função click	

});//fim da função ready



