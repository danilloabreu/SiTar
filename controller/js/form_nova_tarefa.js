$(document).ready(function(){
      
    // preenchendo os campos de data
    //$("#data_limite").val("2016-03-18T13:00");
    $('#data_limite_tarefa').val(new Date().toJSON().slice(0,19));
    $('#data_limite_movimento').val(new Date().toJSON().slice(0,19));
    
	
        $(document).on('click','#enviar',function(){
        
            var data_limite_tarefa= $('#data_limite_tarefa').val();
            var data_limite_movimento= $('#data_limite_movimento').val();
            var prioridade = $('#prioridade').val();
            var resumo = $('#resumo').val();
           
            /*$("#enviar").prop("disabled",true);*/
            $("#button_send").html("<img id=\"loader\" src=\"/sitar/view/img/loader.gif\">");
            
        /**************Validação**************/

            //teste prioridade
            if(prioridade>1000||prioridade<=0||!$.isNumeric(prioridade)){
                alert("Preencha a prioridade com um valor entre 1 e 1000");
                $("#prioridade").focus();
                $("#enviar").prop("disabled",false);
                //var x = false;
                $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                return;
            }
            //teste resumo
            if(resumo.length>45||resumo.length<10){
                alert("Preencha o resumo com mais de 10 caracteres");
                $("#resumo").focus();
                $("#enviar").prop("disabled",false);
                //var x = false;
                $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                return;
            }
            
            //teste data limite tarefa
            if(data_limite_tarefa==""){
                alert("Preencha a data limite da tarefa");
                $("#data_limite_tarefa").focus();
                $("#enviar").prop("disabled",false);
                //var x = false;
                $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                return;
            }
            
            //teste data limite movimento
            if(data_limite_movimento==""){
                alert("Preencha a data limite do movimento");
                $("#data_limite_movimento").focus();
                $("#enviar").prop("disabled",false);
                //var x = false;
                $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                return;
            } 
            
            //testa se a data limite da tarefa é menor que a data atual
            
            var year    = $("#data_limite_tarefa").val().slice(0,4);
            var month   = $("#data_limite_tarefa").val().slice(5,7);
            var day     = $("#data_limite_tarefa").val().slice(8,10);
            var hour    = $("#data_limite_tarefa").val().slice(11,13);
            var min     = $("#data_limite_tarefa").val().slice(14,16);
            var sec     = $("#data_limite_tarefa").val().slice(17,19);
            
            
            var data1 = new Date(year+'-'+month+'-'+day+' '+hour+':'+min+':'+sec);
            
            
            var agora = new Date();
            var s_agora = agora.getTime();
            
            var s_data1= data1.getTime();
            
                      
            if(s_data1<s_agora){
                alert("Nao pode inserir uma tarefa no passado");
                $("#data_limite_tarefa").focus();
                $("#enviar").prop("disabled",false);
                $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                return;
            }
            
            //testa se a data limite do movimento é menor que a data atual
            
            var year    = $("#data_limite_movimento").val().slice(0,4);
            var month   = $("#data_limite_movimento").val().slice(5,7);
            var day     = $("#data_limite_movimento").val().slice(8,10);
            var hour    = $("#data_limite_movimento").val().slice(11,13);
            var min     = $("#data_limite_movimento").val().slice(14,16);
            var sec     = $("#data_limite_movimento").val().slice(17,19);
            
            
            var data2 = new Date(year+'-'+month+'-'+day+' '+hour+':'+min+':'+sec);
            
            
            var agora = new Date();
            var s_agora = agora.getTime();
            
            var s_data2= data2.getTime();
            
                      
            if(s_data2<s_agora){
                alert("Nao pode inserir um movimento passado");
                $("#data_limite_movimento").focus();
                $("#enviar").prop("disabled",false);
                $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                return;
            }
            
            //testa se o movimento está antes da tarefa
            if(s_data2>s_data1){
               alert("O movimento não pode finalizar depois da tarefa");
               $("#data_limite_movimento").focus();
               $("#enviar").prop("disabled",false);
               $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
               return;
            }
            
            
     /*************Fim da Validação************/       
            
        
            $.post("/sitar/controller/php/inserir_nova_tarefa.php",{
                responsavel: $('#responsavel').val(),
                data_limite_tarefa: $('#data_limite_tarefa').val(),
                data_limite_movimento: $('#data_limite_movimento').val(),
                prioridade: $('#prioridade').val(),
                descricao: $('#descricao').val(),
                resumo: $('#resumo').val()
                },
                function(data, status){
                    
                    if(data==true){
                        alert("Dados inseridos com sucesso");                             
                        $("#prioridade").val("");
                        $("#resumo").val("");
                        $("#descricao").val("");
                        $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                        /*$("#enviar").prop("disabled",false);*/
                    }else{
                        alert(data);  
                        $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                        return;
                    }
            });//fim da função post
    });//fim da função clique
    
    //$("#enviar").click(function(){
        $(document).on('click','#alterar',function(){
        
            //alert("Passou");
            //var x = true;
            var data_limite_tarefa= $('#data_limite_tarefa').val();
            var data_limite_movimento= $('#data_limite_movimento').val();
            var prioridade = $('#prioridade').val();
            var resumo = $('#resumo').val();
           
            /*$("#enviar").prop("disabled",true);*/
            $("#button_send").html("<img id=\"loader\" src=\"../view/img/loader.gif\">");
            
        /**************Validação**************/

            //teste prioridade
            if(prioridade>1000||prioridade<=0||!$.isNumeric(prioridade)){
                alert("Preencha a prioridade com um valor entre 1 e 1000");
                $("#prioridade").focus();
                $("#enviar").prop("disabled",false);
                //var x = false;
                $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                return;
            }
            //teste resumo
            if(resumo.length>45||resumo.length<10){
                alert("Preencha o resumo com mais de 10 caracteres");
                $("#resumo").focus();
                $("#enviar").prop("disabled",false);
                //var x = false;
                $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                return;
            }
            
            //teste data limite tarefa
            if(data_limite_tarefa==""){
                alert("Preencha a data limite da tarefa");
                $("#data_limite_tarefa").focus();
                $("#enviar").prop("disabled",false);
                //var x = false;
                $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                return;
            }
            
            //teste data limite movimento
            if(data_limite_movimento==""){
                alert("Preencha a data limite do movimento");
                $("#data_limite_movimento").focus();
                $("#enviar").prop("disabled",false);
                //var x = false;
                $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                return;
            } 
            
            //testa se a data limite da tarefa é menor que a data atual
            
            var year    = $("#data_limite_tarefa").val().slice(0,4);
            var month   = $("#data_limite_tarefa").val().slice(5,7);
            var day     = $("#data_limite_tarefa").val().slice(8,10);
            var hour    = $("#data_limite_tarefa").val().slice(11,13);
            var min     = $("#data_limite_tarefa").val().slice(14,16);
            var sec     = $("#data_limite_tarefa").val().slice(17,19);
            
            
            var data1 = new Date(year+'-'+month+'-'+day+' '+hour+':'+min+':'+sec);
            
            
            var agora = new Date();
            var s_agora = agora.getTime();
            
            var s_data1= data1.getTime();
            
                      
            if(s_data1<s_agora){
                alert("Nao pode inserir uma tarefa no passado");
                $("#data_limite_tarefa").focus();
                $("#enviar").prop("disabled",false);
                $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                return;
            }
            
            //testa se a data limite do movimento é menor que a data atual
            
            var year    = $("#data_limite_movimento").val().slice(0,4);
            var month   = $("#data_limite_movimento").val().slice(5,7);
            var day     = $("#data_limite_movimento").val().slice(8,10);
            var hour    = $("#data_limite_movimento").val().slice(11,13);
            var min     = $("#data_limite_movimento").val().slice(14,16);
            var sec     = $("#data_limite_movimento").val().slice(17,19);
            
            
            var data2 = new Date(year+'-'+month+'-'+day+' '+hour+':'+min+':'+sec);
            
            
            var agora = new Date();
            var s_agora = agora.getTime();
            
            var s_data2= data2.getTime();
            
                      
            if(s_data2<s_agora){
                alert("Nao pode inserir um movimento passado");
                $("#data_limite_movimento").focus();
                $("#enviar").prop("disabled",false);
                $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                return;
            }
            
            //testa se o movimento está antes da tarefa
            if(s_data2>s_data1){
               alert("O movimento não pode finalizar depois da tarefa");
               $("#data_limite_movimento").focus();
               $("#enviar").prop("disabled",false);
               $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
               return;
            }
            
            
     /*************Fim da Validação************/       
            
        
            $.post("../controller/php/alterar_tarefa_1.php",{
                responsavel: $('#responsavel').val(),
                data_limite_tarefa: $('#data_limite_tarefa').val(),
                data_limite_movimento: $('#data_limite_movimento').val(),
                prioridade: $('#prioridade').val(),
                descricao: $('#descricao').val(),
                resumo: $('#resumo').val()
                },
                function(data, status){
                    
                    if(data==true){
                        alert("Dados alterados com sucesso");                             
                        $("#prioridade").val("");
                        $("#resumo").val("");
                        $("#descricao").val("");
                        $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                        /*$("#enviar").prop("disabled",false);*/
                    }else{
                        alert(data);  
                        $("#button_send").html("<button id=\"enviar\">Enviar</button></div>");
                        return;
                    }
            });//fim da função post
    });//fim da função clique alterar tarefa
    
});//fim da função ready



