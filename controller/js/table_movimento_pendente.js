$(document).ready(function(){
    
    //$(".myBar").css("width","60%");
    
    var x = false;
    
    $(window).focusin(function() {
        
        if (x){
        x=false;
        $("#conteudo").load("table/table_movimento_pendente.php");
        }
    });

    $(".encaminhar").click(function(){
        
        x = true;
        
    });//fim encaminhar

    $(".finalizar").click(function(){
        var id=$(this).attr('id');
        var r = confirm("Solicitar finalização da tarefa?");
            if (r == true){
                x = true;
               //alert("deu true" + x); 
                $.post("../controller/php/solicitar_finalizar_tarefa.php",{
                idtarefa: id
                },
                function(data, status){
                    alert(data);
                    x=true;
            });//fim da função post
            }else {
                return;
            }
        //window.open("formulario_encaminhar_movimento.php?idtarefa="+id);
    });//fim inserir nova_tarefa
});//fim ready function


	

