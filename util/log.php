<?php
/**
 * Description of movimento
 *
 * @author Danilo Abreu
 */
class Log{
    
    private $id;
    private $hora;
    private $ip;
    private $mensagem;        
    
    function __construct($hora, $ip, $mensagem) {
        $this->hora = $hora;
        $this->ip = $ip;
        $this->mensagem = $mensagem;
    }

    function getId() {
        return $this->id;
    }

    function getHora() {
        return $this->hora;
    }

    function getIp() {
        return $this->ip;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }


    function insertLog($mensagem,$conexao){
        $query=$conexao->prepare("INSERT INTO `logs` VALUES (NULL, '".$hora."', '".$ip."', '".$mensagem."')");
        $resultado=$query->execute();



if ($resultado) {
return true;
} else {
return false;
}
       
        
        
        
    }
    
    
    
    
    
    
    
}





function salvaLog($mensagem) {
$ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
$hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
// Usamos o mysql_escape_string() para poder inserir a mensagem no banco
//   sem ter problemas com aspas e outros caracteres


$conexao = mysqli_connect('127.0.0.1', "root", "","sitar");

// Caso a conexão seja reprovada, exibe na tela uma mensagem de erro
if (!$conexao) die ("<h1>Falha na conexão com o Banco de Dados!</h1>");

//set correct charset
$conexao->set_charset("utf8");

//reporta todos os erros
$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_ERROR;

$query=$conexao->prepare("INSERT INTO `logs` VALUES (NULL, '".$hora."', '".$ip."', '".$mensagem."')");
$resultado=$query->execute();


// Monta a query para inserir o log no sistema

if ($resultado) {
return true;
} else {
return false;
}
}