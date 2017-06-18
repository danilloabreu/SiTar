<?php

require '..\movimento.php';
require '..\tarefa.php';
require '..\../controller/usuario.php';

$idtarefa=_POST["idtarefa"];
//$idatarefa=24;
$destinatario=_POST["destinatario"];
//$destinatario="Carlitos";
$descricao=_POST["descrição"];

//$descricao="Teste de segundo movimento de uma tarefa";
$datalimite=new DateTime(_POST["data_limite_movimento"]);
$data_limite=$data_limite->format('Y-m-d H:i:s');

//data atual
$agora= new DateTime();
$agora=$agora->format('Y-m-d H:i:s');
$datalimite=$agora;

//recuperando o movimento anterior
$movimento = new movimento ();
$movimento=$movimento->recuperar_movimento(movimento::recuperar_id_ultimo_movimento($idatarefa));
//atualizando o movimento anterior
$movimento->setFinalizado(1);
$movimento->setDataefetivaresposta($agora);
$movimento->atualizar_movimento($movimento);

//salvando novo movimento 
$novomovimento = new movimento();
$novomovimento->setIdTarefa($movimento->getIdtarefa());
$novomovimento->setEmissor(usuario::recupera_usuario_cookie());
$novomovimento->setDestinatario($destinatario);
$novomovimento->setDescricao($descricao);
$novomovimento->setDatainicio($agora);
$novomovimento->setDatalimite($datalimite);
$novomovimento->setDataefetivaresposta(null);
$novomovimento->inserir_movimento($novomovimento);


?>

