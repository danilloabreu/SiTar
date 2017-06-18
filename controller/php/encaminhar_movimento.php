<?php

require '../../model/br.com.sitar.Movimento/br.com.sitar.Movimento.php';
require '../../model/br.com.sitar.Tarefa/br.com.sitar.Tarefa.php';
require '../../model/usuario.php';

$idtarefa=$_POST["idtarefa"];
//$idatarefa=24;
$destinatario=$_POST["destinatario"];
//$destinatario="Carlitos";
$descricao=$_POST["descricao"];

//$descricao="Teste de segundo movimento de uma tarefa";
$data_limite=new DateTime($_POST["data_limite_movimento"]);
$data_limite=$data_limite->format('Y-m-d H:i:s');

//data atual
$agora= new DateTime();
$agora=$agora->format('Y-m-d H:i:s');

//recuperando o movimento anterior
$movimento = new movimento ();
$movimento=$movimento->recuperar_movimento(movimento::recuperar_id_ultimo_movimento($idtarefa));
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
$novomovimento->setDatalimite($data_limite);
$novomovimento->setDataefetivaresposta(null);
$novomovimento->inserir_movimento($novomovimento);

echo ("Movimento Inserido com Sucesso!");
?>

