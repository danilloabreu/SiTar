<?php

class Usuario{
	public      $id_usuario;
	public      $nome;
	private     $senha;
	private     $email;
        	
//construtor da classe
	function Usuario($Idusuario="",$Nome="",$Senha="",$Email=""){
		$this->setNome($Nome);
                $this->setSenha($Senha);		
                $this->setEmail($Email);
	}
//set e get	
	public function setNome ($Nome){
		$this->nome = $Nome;
        }
        public function getNome(){
		return $this->nome;
	}
	public function set_id_usuario ($Id_usuario){
		$this->id_usuario=$Id_usuario;
	}
	public function getid_usuario (){
		return $this->id_usuario;
	}
	public function setSenha ($Senha){
		$this->senha = $Senha;
        }
        public function getSenha(){
		return $this->senha;
	}
	public function getEmail(){
		return $this->email;
	}
        public function setEmail($Email) {
        $this->email=$Email;
    }

    
    
        public function inserir_usuario(Usuario $usuario){
            $nome=$usuario->getNome();
            $senha=$usuario->getSenha();
            $email=$usuario->getEmail();
            
        require_once 'conexao.php';
        //iniciando a conex�o
        $query =$conexao->stmt_init();    
        //testa se o query est� correto
        if($query=$conexao->prepare("INSERT INTO usuario (nome,senha,email)"
                . "VALUES (?,?,?)")){
        //passando variaveis para a query
            try{              
            $query->bind_param('sss',
                $nome,
                $senha,
                $email                
                );
        $resultado=$query->execute();
        }
            catch(Exception $e){
            echo "fudeu";
        }
       //testa o resultado
        if (!$resultado) {
        $message  = 'Invalid query: ' . $conexao->error . "\n";
        //$message .= 'Whole query: ' . $resultado;
        die($message);
        }
        } else {
        echo "H� um problema com a sintaxe inicial da query SQL";
        }    
        }
        
        public static function recupera_usuario_cookie(){
            //echo ("danilo1");
            if (isset($_COOKIE['usuario'])){
                return $_COOKIE['usuario'];
                
            }
        }
        
        public function recupera_usuario($Usuario){
        
        //requer a conexão com o servidor
        require '../../controller/php/conexao.php';

        //inicia a conex�o
        $query = $conexao->stmt_init();
        //testa se o query est� correto
        if ($query = $conexao->prepare("SELECT idusuario,nome,senha,email FROM usuario WHERE nome = ? ")) {
            //passando variaveis para a query
            try {
                $query->bind_param('s', $Usuario);
                $resultado = $query->execute();
                $query->bind_result($idusuario, $nome, $senha, $email);
                $query->fetch();
                //printf("%s %s %s %s %s %s %s %s ", $col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8);
                /*
                $idtarefa = $col1;
                $resumo = $col2;
                $responsavel = $col3;
                $data_abertura = $col4;
                $data_finalizacao = $col5;
                $prioridade = $col6;
                $emissor = $col7;
                $datasolicitacaofinalizacao = $col8;
                $datarealsolicitacaofinalizacao=$col9
                */

                $usuario = new Usuario ($idusuario,$nome,$senha,$email);

                //testa o resultado
                if (!$resultado) {
                    $message = 'Invalid query: ' . $conexao->error . "\n";
                    //$message .= 'Whole query: ' . $resultado;
                    die($message);
                }
            } catch (Exception $e) {
                echo "erro de exceção";
            }
        } else {
            echo "Há um problema com a sintaxe inicial da query SQL";
        }

        $conexao->close();
        return $usuario;    
        }
        
        public static function lista_select(){
            //faz a conexão com o banco de dados
require ("../../controller/php/conexao.php");

echo ("<select name=\"responsavel\" id=\"responsavel\">?");

$query =$conexao->stmt_init();    
    //testa se o query está correto
    if($query=$conexao->prepare("SELECT idusuario,nome,senha,email FROM usuario ORDER BY nome ASC")){
            //passando variaveis para a query
            try{           
            //$idtarefa=$tarefa->getId_tarefa();    
            //$query->bind_param('s',$idtarefa);           
            $resultado=$query->execute();
            $query->bind_result($col1, $col2,$col3,$col4);
            
            while ($query->fetch()) {    
            //printf("%s %s %s %s %s %s %s %s %s\n", $col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9);
            echo ("<option value=\"".$col2."\">".$col2."</option>");
                }
               //testa o resultado
               if (!$resultado) {
               $message  = 'Invalid query: ' . $conexao->error . "\n";
               //$message .= 'Whole query: ' . $resultado;
               die($message);
                }
            }
                catch(Exception $e){
                echo "fudeu";
                }
        }else{
            echo "Há um problema com a sintaxe inicial da query SQL";
             }
echo ("</select>");
        }
}
