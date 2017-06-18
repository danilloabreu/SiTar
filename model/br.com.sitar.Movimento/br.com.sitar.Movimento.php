<?php

/**
 * Description of Movimento
 *
 * @author Danilo Abreu
 */
class Movimento {
   
        private $idMovimento;
        private $idTarefa;
        private $emissor;
        private $destinatario;
        private $finished;
        private $descricao;
        private $dataInicio;
        private $dataLimite;
        private $dataResposta;


//construtor da classe
	function movimento($idMovimento="",$idTarefa="",$emissor="",$destinatario="",$finalizado=null,$descricao="",$dataInicio="",$dataLimite="",$dataResposta=""){
		$this->setIdmovimento($idMovimento);
                $this->setIdtarefa($idTarefa);		
                $this->setEmissor($emissor);
                $this->setDestinatario($destinatario);
                $this->setFinished($finalizado);
                $this->setDescricao($descricao);
                $this->setDataInicio($dataInicio);
                $this->setDataLimite($dataLimite);
                $this->setDataResposta($dataResposta);               
	}
        
//set e get	
    function getIdMovimento() {
        return $this->idMovimento;
    }

    function getIdTarefa() {
        return $this->idTarefa;
    }

    function getEmissor() {
        return $this->emissor;
    }

    function getDestinatario() {
        return $this->destinatario;
    }

    function getFinished() {
        return $this->finished;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getDataInicio() {
        return $this->dataInicio;
    }

    function getDataLimite() {
        return $this->dataLimite;
    }

    function getDataResposta() {
        return $this->dataResposta;
    }

    function setIdMovimento($idMovimento) {
        $this->idMovimento = $idMovimento;
    }

    function setIdTarefa($idTarefa) {
        $this->idTarefa = $idTarefa;
    }

    function setEmissor($emissor) {
        $this->emissor = $emissor;
    }

    function setDestinatario($destinatario) {
        $this->destinatario = $destinatario;
    }

    function setFinished($finished) {
        $this->finished = $finished;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    function setDataLimite($dataLimite) {
        $this->dataLimite = $dataLimite;
    }

    function setDataResposta($dataResposta) {
        $this->dataResposta = $dataResposta;
    }

    
    
                
        public function inserir_movimento($movimento){
          
        require 'confConectionAddress.php';
            
        $idmovimento    = $movimento->getidmovimento();
        $idtarefa       = $movimento->getIdtarefa();
        $emissor        = $movimento->getEmissor();
        $destinatario   = $movimento->getDestinatario();
        $finished       = $movimento->getFinished();
        $descricao      = $movimento->getDescricao();
        $datainicio     = $movimento->getDatainicio();
        $datalimite     = $movimento->getDatalimite();
        $dataresposta   = $movimento->getDataResposta();
            
        
        //iniciando a conexão
        $query =$conexao->stmt_init();    
        //testa se o query estã correto
        if($query=$conexao->prepare("INSERT INTO movimento (idmovimento,idtarefa,emissor,destinatario,finished,descricao,datainicio,datalimite,dataefetivaresposta)"
                . "VALUES (?,?,?,?,?,?,?,?,?)")){
        //passando variaveis para a query
            try{              
                $query->bind_param('sssssssss',
                $idmovimento,
                $idtarefa,
                $emissor,
                $destinatario,
                $finished,
                $descricao,
                $datainicio,
                $datalimite,
                $dataresposta
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
		//throw new Exception('Erro no movimento');
        die($message);
        }
        } else {
        echo "H� um problema com a sintaxe inicial da query SQL";
        }
            
            
        
        }
        /**
         * 
         * @param type $movimento
         * @todo Necessário atualizar o movimento todo
         */
        public function atualizar_movimento($movimento){
          
            
        $idmovimento            = $movimento->getidmovimento();
        $idtarefa               = $movimento->getIdtarefa();
	$emissor                = $movimento->getEmissor();
	$destinatario           = $movimento->getDestinatario();
        $finished               = $movimento->getFinished();
        $descricao              = $movimento->getDescricao();
        $datainicio             = $movimento->getDatainicio();
        $datalimite             = $movimento->getDatalimite();
        $dataefetivaresposta    = $movimento->getDataResposta();
            
        require 'confConectionAddress.php';
        //iniciando a conex�o
        $query =$conexao->stmt_init();    
        //testa se o query est� correto
        if($query=$conexao->prepare("UPDATE movimento SET"
                . " finished =?,"
                . "dataefetivaresposta=?"
                . " WHERE idmovimento=?")){
        //passando variaveis para a query
            try{              
            $query->bind_param('sss',
                $finished,
                $dataefetivaresposta,    
                $idmovimento
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
		//throw new Exception('Erro no movimento');
        die($message);
        }
        } else {
        echo "H� um problema com a sintaxe inicial da query SQL";
        }
        
        }
        public function recuperar_movimento($idMovimento) {
        //requer a conex�o com o servidor
        require 'confConectionAddress.php';

        //inicia a conex�o
        $query = $conexao->stmt_init();
        //testa se o query est� correto
        if ($query = $conexao->prepare("SELECT idmovimento,idtarefa,emissor,destinatario,finished,descricao,datainicio,datalimite,dataefetivaresposta FROM movimento WHERE idmovimento = ? ")) {
            //passando variaveis para a query
            try {
                $query->bind_param('s', $idMovimento);
                $resultado = $query->execute();
                $query->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);
                $query->fetch();
                //printf("%s %s %s %s %s %s %s %s ", $col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8);
                /*
                $idmovimento = $col1;
                $idtarefa = $col2;
                $emissor = $col3;
                $destinatario = $col4;
                $finished = $col5;
                $descricao = $col6;
                $datainicio = $col7;
                $datalimite = $col8;
                $dataefetivaresposta = $col8;
                */

                $movimento = new movimento($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8,$col9);

                //testa o resultado
                if (!$resultado) {
                    $message = 'Invalid query: ' . $conexao->error . "\n";
                    //$message .= 'Whole query: ' . $resultado;
                    die($message);
                }
            } catch (Exception $e) {
                echo "erro de exce��o";
            }
        } else {
            echo "H� um problema com a sintaxe inicial da query SQL";
        }

        $conexao->close();
        return $movimento;
    }
        
        public static function recuperar_id_ultimo_movimento($Idtarefa, mysqli $conexao) {
        

        //requer a conexão com o servidor
        require 'confConectionAddress.php';

        //inicia a conex�o
        $query = $conexao->stmt_init();
        //testa se o query est� correto
        if ($query = $conexao->prepare("SELECT idmovimento FROM movimento WHERE idtarefa=? order by idmovimento DESC limit 1")) {
            //passando variaveis para a query
            try {
                $query->bind_param('s',
                $Idtarefa);    
                $resultado = $query->execute();
                $query->bind_result($col1);
                $query->fetch();
                $idmovimento = $col1;

                //testa o resultado
                if (!$resultado) {
                    $message = 'Invalid query: ' . $conexao->error . "\n";
                    //$message .= 'Whole query: ' . $resultado;
                    die($message);
                }
            } catch (Exception $e) {
                echo "erro de exce��o";
            }
        } else {
            echo "H� um problema com a sintaxe inicial da query SQL";
        }

        //$conexao->close();

        return $idmovimento;
    }
        public static function recuperar_id_primeiro_movimento($idTarefa) {
        

        //requer a conexão com o servidor
        require 'confConectionAddress.php';

        //inicia a conex�o
        $query = $conexao->stmt_init();
        //testa se o query est� correto
        if ($query = $conexao->prepare("SELECT idmovimento FROM movimento WHERE idtarefa=? order by idmovimento ASC limit 1")) {
            //passando variaveis para a query
            try {
                $query->bind_param('s',
                $idTarefa);    
                $resultado = $query->execute();
                $query->bind_result($col1);
                $query->fetch();
                $idMovimento = $col1;

                //testa o resultado
                if (!$resultado) {
                    $message = 'Invalid query: ' . $conexao->error . "\n";
                    //$message .= 'Whole query: ' . $resultado;
                    die($message);
                }
            } catch (Exception $e) {
                echo "erro de exce��o";
            }
        } else {
            echo "H� um problema com a sintaxe inicial da query SQL";
        }

        $conexao->close();

        return $idMovimento;
    }
        public static function contar_movimento_aberto($usuario)
        {
        //requer a conex�o com o servidor
        require 'confConectionAddress.php';

        //inicia a conex�o
        $query = $conexao->stmt_init();
        //testa se o query est� correto
        $sql="SELECT count(destinatario) FROM sitar.movimento WHERE destinatario=? AND finished IS NULL AND deleted IS NULL;";
        if ($query = $conexao->prepare($sql)) {
            //passando variaveis para a query
            try {
                $query->bind_param('s', $Usuario);
                $resultado = $query->execute();
                $query->bind_result($col1);
                $query->fetch();
                //printf("%s %s %s %s %s %s %s %s ", $col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8);

                 //testa o resultado
                if (!$resultado) {
                    $message = 'Invalid query: ' . $conexao->error . "\n";
                    //$message .= 'Whole query: ' . $resultado;
                    die($message);
                }
            } catch (Exception $e) {
                echo "erro de exce��o";
            }
        } else {
            echo "H� um problema com a sintaxe inicial da query SQL";
        }

        //$conexao->close();
        return $col1;
    
        }
}