$(document).ready(function(){
    var x = false;
    
    $(window).focusin(function() {
        
        if (x){
        $("#conteudo").load("table/table_rastreamento_tarefa.php");
        //alert("fudeu");
        x=false;
        }
    });

    $(".encaminhar").click(function(){
        //var id=$($this).attr('id');
        //window.open("formulario_encaminhar_movimento.php?idtarefa="+id);
        x = true;
        //alert (x+"deu");
    });//fim encaminhar

    $(".aprovar").click(function(){
        var id=$(this).attr('id');
        var r = confirm("Aprovar tarefa?");
            if (r == true){
                
                $.post("../controller/php/aprovar_tarefa.php",{
                idtarefa: id
                },
                function(data, status){
                    alert(data);
                    x = true;
            });//fim da função post         
            }else {
                return;
            }
        //window.open("formulario_encaminhar_movimento.php?idtarefa="+id);
    });//fim inserir nova_tarefa
});//fim ready function


	

