<?php

//requisições
require ("conexao.php");
require '../../model/br.com.sitar.Tarefa/br.com.sitar.Tarefa.php';
require ("../../model/br.com.sitar.Movimento/br.com.sitar.Movimento.php");
require ("../../model/usuario.php");

//dado recebido do formulário
$idtarefa=$_POST["idtarefa"];

//recuperando tarefa para utilizar variáveis
$tarefa = new Tarefa();
$tarefa=$tarefa->recuperar_tarefa($idtarefa);

//variáveis
$emissor= Usuario::recupera_usuario_cookie();
$destinatario=$tarefa->getResponsavel();
$descricao="Solicitação de Finalização de Tarefa";
$data_inicio = new DateTime();
$data_limite_movimento = new DateTime('+2 day');

//formatando variáveis para inserir no banco
$data_inicio=$data_inicio->format('Y-m-d H:i:s');
$data_limite_movimento=$data_limite_movimento->format('Y-m-d H:i:s');

//atualizando status da tarefa no banco de dados
$tarefa->setDatasolicitacaofinalizacao($data_inicio);
$tarefa->setDatarealfinalizacao(null);
$tarefa->atualizar_tarefa($tarefa);

//recuperando o movimento anterior
$movimento = new movimento ();
$movimento=$movimento->recuperar_movimento(movimento::recuperar_id_ultimo_movimento($idtarefa));

//atualizando o movimento anterior
$movimento->setFinalizado(1);
$movimento->setDataefetivaresposta($data_inicio);
$movimento->atualizar_movimento($movimento);

//inserindo novo movimento
$movimento= new Movimento('',$idtarefa,$emissor,$destinatario,null,$descricao,$data_inicio,$data_limite_movimento,null);
$movimento=$movimento->inserir_movimento($movimento);
echo ("Solicitação efetuada com sucesso!");
?>

