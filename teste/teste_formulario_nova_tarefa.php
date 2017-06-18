<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<link href="estilo.css" rel="stylesheet" type="text/css" />

<script>
$(document).ready(function(){
    
	$("button").click(function(){
    alert("Entrou");
	$.post("teste_post.php",
    {
        name: "Donald Duck",
        city: "Duckburg"
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });//fim da função alert
});//fim da função clique
});//fim da função ready
</script>



<body>

<div class="envelope">

<div class="esquerda">
<div class="linha" ><p>Responsável</p></div>
<div class="linha"><p>Data limite do primeiro movimento</p></div>
<div class="linha"><p>Prioridade</p></div>
<div class="linha"><p>Resumo</p></div>

</div>

<div class="direita">
<div class="linha" ><input type = "text" id="responsavel"></div>
<div class="linha"><input type = "text" name = "data_limite"></div>
<div class="linha"><input type = "text" name = "prioridade"></div>
<div class="linha"><textarea name = "resumo"></textarea></div>
</div>

<div class="clear"></div>

<div> <button>Enviar</button></div>
</div>
</body>
