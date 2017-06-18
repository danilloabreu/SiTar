$(document).ready(function(){
    
    //variavel auxiliar para atualização da janela após mudanças (excluir)
    var x = false;
    
    //quando a janela principal ganha o foco
    $(window).focusin(function() {
        //o valor de x =true para quando a janela é atualizada
        if (x){
           $("#conteudo").load("table/table_alterar_excluir.php");//atualiza a janela para remover a linha excluida
            x=false; //variável auxiliar falsa para evitar o loop contínuo
        }
    });//fim da função focusin()

    //clique do botão alterar
    $(".alterar").click(function(){
        var idTarefa=$(this).attr('id');//pega o id da tarefa a ser alterada
       
        
        //transmite os dados via post para o controlador de alteração da tarefa
        $.post("../controller/php/alterar_tarefa.php",{
                idTarefa: idTarefa
                },
                function(data, status){
                   // alert(data); //mensagem de confirmação da solicitação post
                    x = false; // para não atualizar a janela, pois o usuário será redirecionada para alterar a tarefa
                    $("#conteudo").load("form/form_nova_tarefa.php");// redireciona usuário para alterar a tarefa
        });//fim da função post    
    });//fim da função click encaminhar

    //clique do botão excluir
    $(".excluir").click(function(){
        var id=$(this).attr('id');//pega o id da tarefa a ser excluida
        var r = confirm("Excluir tarefa?");//solicitação a confirmação da exclusão da tarefa
            if (r == true){
                //transmite os dados via post para o controlador de exclusão da tarefa
                $.post("/sitar/controller/php/excluir_tarefa.php",{
                idtarefa: id
                },
                function(data, status){
                    alert(data); //mensagem de confirmação da solicitação post
                    x = true; //para atualizar a janela, pois a tarefa sairá do campo de visão do usuário
            });//fim da função post excluir tarefa         
            }else {
                return;//caso o usuário não confirme a solicitação a solicitaçaõ para
            }//fim do if-else
    });//fim da função excluir tarefa
});//fim da função ready()


	

