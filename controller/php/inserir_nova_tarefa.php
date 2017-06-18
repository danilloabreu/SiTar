<?php
$path = $_SERVER['DOCUMENT_ROOT'];

/*Requisições*/

require ($path.'/sitar/controller/php/conexao.php');
require ($path.'/sitar/model/br.com.sitar.Tarefa/br.com.sitar.Tarefa.php');
require ($path.'/sitar/model/br.com.sitar.Movimento/br.com.sitar.Movimento.php');
require ($path.'/sitar/model/usuario.php');

/*Variáveis*/

$data_abertura= new DateTime();
$data_limite_tarefa = $_POST["data_limite_tarefa"];
$data_limite_movimento = $_POST["data_limite_movimento"];
$responsavel = $_POST["responsavel"];
$prioridade = intval($_POST["prioridade"]); //intval() converte o valor para inteiro
$resumo = $_POST["resumo"];
//$emissor= Usuario::recupera_usuario_cookie();
$emissor="Danilo";
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


### Validação dos dados ###

/*data limite da finalização não pode ser anterior a data atual*/

if((strtotime($data_abertura))>(strtotime($data_limite_tarefa))){
    die('A data limite da tarefa deve ser maior que a data atual');
}
    
if((strtotime($data_limite_tarefa))<(strtotime($data_limite_movimento))){
    die('A data limite do movimento não pode ser menor que a data limite da tarefa');
}


//echo "O valor de prioridade é $prioridade e seu tipo é". gettype($prioridade);
/* $prioridade - prioridade da tarefa, deve ser um número inteiro entre 0 e 1000*/

switch ($prioridade) {
    case ($prioridade==" "):
        die("A prioridade deve ser preenchida");
        break;  
    case (is_numeric($prioridade)==FALSE):
        die("A prioridade deve ser um número");
        break;
    case ($prioridade<0 || $prioridade>1000):
        die("A prioridade deve ser entre 0 e 1000");
        break;
    default:
        true;
}
/* $resumo - resumo da tarefa, deve ser uma string com no mínimo 10 e no máximo 45 caracteres*/
switch ($resumo) {
    case ($resumo==" "):
        die("O resumo deve ser preenchida");
        break;  
    case (strlen($resumo)<10):
        die("O resumo deve conter mais de 10 caracteres");
        break;
    default:
        true;
}

/* $descricao - descricao da tarefa, deve ser uma string com no máximo 300 caracteres*/
switch ($descricao) {
    case ($descricao==" "):
        die("A descrição deve ser preenchida");
        break;  
    case (strlen($descricao)>300):
        die("A descrição deve conter menos de 300 caracteres");
        break;
    default:
        true;
}

//inserindo os dados no banco de dados
$tarefa = new Tarefa("",$resumo,$responsavel,$data_abertura,$data_limite_tarefa,$prioridade,$emissor,null);
$tarefa->inserir_tarefa($tarefa,$conexao);
$idultimatarefa=Tarefa::recuperar_id_ultima_tarefa($emissor);
//echo "O id da ultima tarefa eh: ".$idultimatarefa;
$movimento= new Movimento('',$idultimatarefa,$emissor,$responsavel,null,$descricao,$data_abertura,$data_limite_movimento,null);
$movimento=$movimento->inserir_movimento($movimento);


echo true;
//return true;
//echo ("Dados inseridos com sucesso");
?>
