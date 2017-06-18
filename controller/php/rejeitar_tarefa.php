<?php

//requisições
require ("conexao.php");
require ("tarefa.php");
require ("movimento.php");
require ("../controller/usuario.php");

//dado recebido do formulário
$idtarefa=24;

//recuperando tarefa para utilizar variáveis
$tarefa = new Tarefa();
$tarefa=$tarefa->recuperar_tarefa($idtarefa);

//variáveis
$emissor= Usuario::recupera_usuario_cookie(); //emissor é o usuário ativo no sistema
$destinatario=$tarefa->getResponsavel(); // destinatario é o responsável por entregar a tarefa
$descricao="Solicitação rejeitada - Tarefa continua aberta";
$data_inicio = new DateTime();
$data_limite_movimento = new DateTime('+2 day'); // 2 dias de limite para apresentar o novo movimento

//formatando variáveis para inserir no banco
$data_inicio=$data_inicio->format('Y-m-d H:i:s');
$data_limite_movimento=$data_limite_movimento->format('Y-m-d H:i:s');

//atualizando status da tarefa no banco de dados
$tarefa->setDatasolicitacaofinalizacao(null);
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
echo ("Dados inseridos com sucesso");



/*


//variáveis
$data_abertura= new DateTime();
$data_limite_tarefa = $_POST["data_limite_tarefa"];
$data_limite_movimento = $_POST["data_limite_movimento"];
$responsavel = $_POST["responsavel"];
$prioridade = $_POST["prioridade"];
$resumo = $_POST["resumo"];
$emissor= Usuario::recupera_usuario_cookie();
$datasolicitacaofinalizacao=null;
$descricao=$_POST["descricao"];

//convertendo o formato de data para inserir no banco
$data_abertura=$data_abertura->format('Y-m-d H:i:s');

//preparando a data para inserir no banco
$data_limite_tarefa=str_replace('T',' ',$data_limite_tarefa);
//$data_limite_tarefa.=":00";
$data_limite_tarefa= new DateTime($data_limite_tarefa);
$data_limite_tarefa=$data_limite_tarefa->format('Y-m-d H:i:s');

//preparando a data para inserir no banco
$data_limite_movimento=str_replace('T',' ',$data_limite_movimento);
//$data_limite_tarefa.=":00";
$data_limite_movimento= new DateTime($data_limite_movimento);
$data_limite_movimento=$data_limite_movimento->format('Y-m-d H:i:s');

//inserindo os dados no banco de dados

$tarefa = new Tarefa("",$resumo,$responsavel,$data_abertura,$data_limite_tarefa,$prioridade,$emissor,null);
$tarefa->inserir_tarefa($tarefa);
$idultimatarefa=Tarefa::recuperar_id_ultima_tarefa();
$movimento= new Movimento('',$idultimatarefa,$emissor,$responsavel,null,$descricao,$data_abertura,$data_limite_movimento,null);
$movimento=$movimento->inserir_movimento($movimento);
echo ("Dados inseridos com sucesso");

*/

?>

