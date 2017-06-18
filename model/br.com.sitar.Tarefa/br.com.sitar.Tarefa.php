<?php
/***
 * 
 */
class Tarefa {
    

    private $id_tarefa;
    private $resumo;
    private $responsavel;
    private $data_abertura;
    private $data_finalizacao;
    private $prioridade;
    private $emissor;
    private $datasolicitacaofinalizacao;
    
    

    //construtor
    
    /**
     * Description of Tarefa
     * @author Danilo Abreu <danillo_abreu@hotmail.com>
     * @param int $idTarefa - Id da tarefa
     * @param string $resumo - Resumo da tarefa 
     * @param string $responsavel - responsavel pela entrega da tarefa
     * 
     * 
     */
        function __construct($idTarefa="", $resumo="", $responsavel="", $dataAbertura="", $dataFinalizacao="", $prioridade="", $emissor="",$dataSolicitacaoFinalizacao="",$dataRealFinalizacao="") {
        $this->setId_tarefa($idTarefa);
        $this->setResumo($resumo);
        $this->setResponsavel($responsavel);
        $this->setData_abertura($dataAbertura);
        $this->setData_finalizacao($dataFinalizacao);
        $this->setPrioridade($prioridade);
        $this->setEmissor($emissor);
        $this->setDatasolicitacaofinalizacao($dataSolicitacaoFinalizacao);
        $this->setDatarealfinalizacao($dataRealFinalizacao);
    }

    //fim do construtor

//set e get
    public function setId_tarefa($Id_tarefa) {
        $this->id_tarefa = $Id_tarefa;
    }

    public function getId_tarefa() {
        return $this->id_tarefa;
    }

    public function setResumo($Resumo) {
        $this->resumo = $Resumo;
    }

    public function getResumo() {
        return $this->resumo;
    }

    public function setResponsavel($Responsavel) {
        $this->responsavel = $Responsavel;
    }

    public function getResponsavel() {
        return $this->responsavel;
    }

    public function setData_abertura($Data_abertura) {
        $this->data_abertura = $Data_abertura;
    }

    public function getData_abertura() {
        return $this->data_abertura;
    }

    public function setData_finalizacao($Data_finalizacao) {
        $this->data_finalizacao = $Data_finalizacao;
    }

    public function getData_finalizacao() {
        return $this->data_finalizacao;
    }

    public function setPrioridade($Prioridade) {
        $this->prioridade = $Prioridade;
    }

    public function getPrioridade() {
        return $this->prioridade;
    }

    public function setEmissor($Emissor) {
        $this->emissor = $Emissor;
    }

    public function getEmissor() {
        return $this->emissor;
    }

    public function setDatasolicitacaofinalizacao($Datasolicitacaofinalizacao) {
        $this->datasolicitacaofinalizacao = $Datasolicitacaofinalizacao;
    }

    public function getDatasolicitacaofinalizacao() {
        return $this->datasolicitacaofinalizacao;
    }
    
    
    public function setDatarealfinalizacao($Datarealsolicitacaofinalizacao) {
        $this->datarealsolicitacaofinalizacao = $Datarealsolicitacaofinalizacao;
    }

    public function getDatarealfinalizacao() {
        return $this->datarealsolicitacaofinalizacao;
    }
    
    
    

################METODOS#####################

 /**
 * Insere a tarefa no banco de dados
 * e envia email para o responsavel
 * @param Tarefa $tarefa tarefa que será incluída no banco
 * @return void
 */    
    public function inserir_tarefa(Tarefa $tarefa) {
        //abre a conexao com o banco de dados
        require 'confConectionAddress.php';
        //iniciando a conexao
        $query = $conexao->stmt_init();
        //testa se o query esta correto
        if ($query = $conexao->prepare("INSERT INTO tarefa (idtarefa,resumo,responsavel,dataabertura,datafinalizacao,prioridade,emissor,datasolicitacaofinalizacao)"
                . "VALUES (?,?,?,?,?,?,?,?)")) {
            //passando variaveis para a query
                     
                $idtarefa = "";
                $resumo = $tarefa->getResumo();
                $responsavel = $tarefa->getResponsavel();
                $data_abertura = $tarefa->getData_abertura();
                $data_finalizacao = $tarefa->getData_finalizacao();
                $prioridade = $tarefa->getPrioridade();
                $emissor = $tarefa->getEmissor();
                $datasolicitacaofinalizacao = $tarefa->getDatasolicitacaofinalizacao();

                $query->bind_param('ssssssss', $idtarefa, $resumo, $responsavel, $data_abertura, $data_finalizacao, $prioridade, $emissor, $datasolicitacaofinalizacao
                );
                $resultado = $query->execute();
           
            //testa o resultado
            if (!$resultado) {
                $message = 'Invalid query: ' . $conexao->error . "\n";
                die($message);
            }
        } else {
            echo "Há um problema com a sintaxe inicial da query SQL";
        }
    
    //enviar a tarefa     
    //$tarefa->enviar_email_tarefa($tarefa);    
    $conexao->close();    
    }

    public function recuperar_tarefa($idTarefa) {
        //requer a conexao com o servidor
        require '../../controller/php/conexao.php';

        //inicia a conexao
        $query = $conexao->stmt_init();
        //testa se o query esta correto
        if ($query = $conexao->prepare("SELECT * FROM tarefa WHERE idtarefa = ? ")) {
            //passando variaveis para a query
            try {
                $query->bind_param('s', $idTarefa);
                $resultado = $query->execute();
                $query->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9,$col10,$col11);
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

                $tarefa = new Tarefa($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8,$col9);

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
        return $tarefa;
    }
    
    public function atualizar_tarefa(Tarefa $tarefa) {
    
        $idtarefa                       = $tarefa->getId_tarefa();
        $resumo                         = $tarefa->getResumo();
	$responsavel                    = $tarefa->getResponsavel();
	$dataabertura                   = $tarefa->getData_abertura();
        $datafinalizacao                = $tarefa->getData_finalizacao();
        $prioridade                     = $tarefa->getPrioridade();
        $emissor                        = $tarefa->getEmissor();
        $datasolicitacaofinalizacao     = $tarefa->getDatasolicitacaofinalizacao();
        $datarealfinalizacao            = $tarefa->getDatarealfinalizacao();
            
        require '../../controller/php/conexao.php';
        //iniciando a conex�o
        $query =$conexao->stmt_init();    
        //testa se o query est� correto
        if($query=$conexao->prepare("UPDATE tarefa SET "
                . "idtarefa =?,"
                . "resumo=?,"
                . "responsavel=?,"
                . "dataabertura=?,"
                . "datafinalizacao=?,"
                . "prioridade=?,"
                . "emissor=?,"
                . "datasolicitacaofinalizacao=?,"
                . "datarealfinalizacao=?"
                . " WHERE idtarefa=?")){
        //passando variaveis para a query
            try{              
            $query->bind_param('ssssssssss',
                $idtarefa,
                $resumo,    
                $responsavel,
                $dataabertura,
                $datafinalizacao,
                $prioridade,
                $emissor,
                $datasolicitacaofinalizacao,
                $datarealfinalizacao,
                $idtarefa    
                );
        $resultado=$query->execute();
        echo ("Passou na função - Prioridade ".$tarefa->getPrioridade());
        echo ("Passou na função - Id tarefa ".$tarefa->getId_tarefa());
        
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
        echo "Ha um problema com a sintaxe inicial da query SQL";
        }
        
        
      $conexao->close();  
    }
    
    private function enviar_email_tarefa(Tarefa $tarefa){
        require_once 'phpmailer/PHPMailerAutoload.php';
        //require_once 'usuario.php';
        
        $usuario = new Usuario();
        $usuario=$usuario->recupera_usuario($tarefa->getResponsavel());
        
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        
        //Set charset
        $mail->CharSet = 'UTF-8';

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "backupquilombo@gmail.com";

        //Password to use for SMTP authentication
        $mail->Password = "Quilombo2016";

        //Set who the message is to be sent from
        $mail->setFrom('backupquilombo@gmail.com', 'Sitar - Sistema de Tarefas');

        //Set an alternative reply-to address
        //$mail->addReplyTo('backupquilombo@gmail.com', 'First Last');

        //Set who the message is to be sent to
        $mail->addAddress($usuario->getEmail(),$usuario->getNome());
        //$mail->addAddress('danillo_abreu@hotmail.com','Danilo');
        
        //Set the subject line
        $mail->Subject = 'Nova Tarefa';

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
       // $mail->msgHTML(file_get_contents('../../controller/html/email_nova_tarefa.html'), dirname(__FILE__));

        $message=
          "<html>"
        . "<head>"
        . "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\">"
        . "</head>"
        . "<body>"
        . "<h1>Você tem uma tarefa cadastrada</h1><br>"
        . "<p>Emissor: ".$tarefa->getEmissor()."<p><br>"
        . "<p>Resumo do Tarefa: ".$tarefa->getResumo()."<p><br>"
        . "<p>Data limite: ".$tarefa->getData_finalizacao()."<p><br>"        
        . "<p>Esta é uma mensagem automática. Não responda</p>"
        . "</body>"
        . "</html>";
        $mail->msgHTML($message);
        
        //Replace the plain text body with one created manually
        //$mail->AltBody = '<h1>Você possui uma nova tarefa!</h1>';

        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
            }
    
    
    
    
    
//métodos estáticos 
    
            
    
            
    public static function excluir_tarefa($idTarefa){
        //requer a conexao com o servidor
        require '../../controller/php/conexao.php';

        //inicia a conexao
        $query = $conexao->stmt_init();
        $query1= $conexao->stmt_init();
        
        //desliga o autocommit para transação
        $conexao->autocommit(FALSE);
        
        
        $query = $conexao->prepare("UPDATE tarefa SET deleted = 1 WHERE idtarefa = ? ");
        $query1 = $conexao->prepare("UPDATE movimento SET deleted = 1 WHERE idtarefa = ? ");        
            
            if(false===$query){
                //die("Erro no query".$query);
            }
            
            if(false===$query1){
                //die("Erro no query".$query1);
            }
                 
            //passando variaveis para a query
        try {
            $query->bind_param('s', $idTarefa);
            $query1->bind_param('s', $IdTarefa);

            $resultado = $query->execute();
            $resultado1 = $query1->execute();
            
            if (!$resultado) {
                      $message = 'Invalid query: ' . $conexao->error . "\n";
                      throw new Exception();
            }

            if (!$resultado1) {
            $message = 'Invalid query: ' . $conexao->error . "\n";
            //die($message);
            //$conexao->rollback();
            throw new Exception();
            }
            $conexao->commit();     
                
                //$query->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9,$col10,$col11);
                //$query->fetch();
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

               // $tarefa = new Tarefa($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8,$col9);

                //testa o resultado
              
            } catch (Exception $e) {
                echo "Houve um erro. Checar o log";
                $conexao->rollback();
            }
       

        $conexao->close();
        return $tarefa;
        
    }        
    
    public static function solicitar_finalizacao_tarefa($idTarefa) {
                         
        $datasolicitacaotarefa= new DateTime();
        $datasolicitacaotarefa->format('Y-m-d H:i:s');
        
        require '../../controller/php/conexao.php';
        //iniciando a conexao
        $query =$conexao->stmt_init();    
        //testa se o query esta correto
        if($query=$conexao->prepare("UPDATE tarefa SET"
                . " datasolicitacaofinalizacao =?"
                . " WHERE idtarefa=?")){
        //passando variaveis para a query
            try{              
            $query->bind_param('ss',
                $datasolicitacaofinalizacao,
                $idTarefa
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
     $conexao->close();       
    }

    public static function aprovar_tarefa($Idtarefa) {
            /*
             * setar a data real de finalização como agora 
             * finalizar o penultimo e o ultimo movimento
             * 
             *              
             */
        $idtarefa=$Idtarefa;
        
        $agora= new DateTime();
        $agora->format('Y-m-d H:i:s');
        
        //recuperando a tarefa e setando a data limite
        $tarefa = new Tarefa();
        $tarefa=$tarefa->recuperar_tarefa($idtarefa);
        $tarefa->setData_real_finalizacao($agora);
        
        
        require '../../controller/php/conexao.php';
        //iniciando a conexao
        $query =$conexao->stmt_init();    
        //testa se o query esta correto
        if($query=$conexao->prepare("UPDATE tarefa SET"
                . " datasolicitacaofinalizacao =?"
                . " WHERE idtarefa=?")){
        //passando variaveis para a query
            try{              
            $query->bind_param('ss',
                $datasolicitacaofinalizacao,
                $idtarefa
                );
        $resultado=$query->execute();
        }
            catch(Exception $e){
            //echo "fudeu";
        }
       //testa o resultado
        if (!$resultado) {
        $message  = 'Invalid query: ' . $conexao->error . "\n";
        //$message .= 'Whole query: ' . $resultado;
		//throw new Exception('Erro no movimento');
        die($message);
        }
        } else {
        echo "Há um problema com a sintaxe inicial da query SQL";
        }
         $conexao->close();
         
    }
    
    public static function rejeitar_tarefa($idtarefa) {
                         
        $datasolicitacaotarefa= new DateTime();
        $datasolicitacaotarefa->format('Y-m-d H:i:s');
        
        require '../../controller/php/conexao.php';
        //iniciando a conexao
        $query =$conexao->stmt_init();    
        //testa se o query esta correto
        if($query=$conexao->prepare("UPDATE tarefa SET"
                . " datasolicitacaofinalizacao =?"
                . " WHERE idtarefa=?")){
        //passando variaveis para a query
            try{              
            $query->bind_param('ss',
                $datasolicitacaofinalizacao,
                $idtarefa
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
    $conexao->close();        
    }
    
    public static function recuperar_id_ultima_tarefa($usuario) {
        //$idtarefa = null;

    //requer a conexão com o servidor
        require 'ConfConectionAddress.php';

        //inicia a conex�o
        $query = $conexao->stmt_init();
        //testa se o query est� correto
        if ($query = $conexao->prepare("SELECT idtarefa FROM tarefa where emissor=? order by idtarefa DESC limit 1")) {
            //passando variaveis para a query
            try {
                $query->bind_param('s',$usuario);
                $resultado = $query->execute();
                $query->bind_result($col1);
                $query->fetch();
                $idTarefa = $col1;

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

        return $idTarefa;
    }

    public static function parada_com($idtarefa) {
//requer a conexão com o servidor
        require '../../controller/php/conexao.php';

        //inicia a conex�o
        $query = $conexao->stmt_init();
        //testa se o query est� correto
        if ($query = $conexao->prepare("SELECT destinatario FROM movimento where idtarefa = ? order by datainicio DESC limit 1")) {
            //passando variaveis para a query
            try {
                $query->bind_param('s', $idtarefa);
                $resultado = $query->execute();
                $query->bind_result($col1);
                $query->fetch();
                $destinatario = $col1;

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

        return $destinatario;
    }
  
    public static function parada_desde($idtarefa) {

        /*
         * @author Danilo Abreu
         * 
         */



//requer a conexão com o servidor
        require '../../controller/php/conexao.php';

        //inicia a conex�o
        $query = $conexao->stmt_init();
        //testa se o query est� correto
        if ($query = $conexao->prepare("SELECT datainicio FROM movimento where idtarefa = ? order by datainicio DESC limit 1")) {
            //passando variaveis para a query
            try {
                $query->bind_param('s', $idtarefa);
                $resultado = $query->execute();
                $query->bind_result($col1);
                $query->fetch();
                $datainicio = $col1;
                $datainicio = New DateTime($datainicio);
                $datainicio = $datainicio->format('d-m-Y H:i:s');

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

        return $datainicio;
    }

    public static function contar_tarefa_aberta($usuarioBanco){
        //inicia a conexao
        //require '../../controller/php/conexao.php';
        require 'confConectionAddress.php';
        
        $query = $conexao->stmt_init();
        
        //lança exceção caso ocorra problema com a query
        if(!$query){
            
            throw new Exception ('Problema com a conexão');
            
        }
        //testa se o query está correto
        $sql="SELECT count(responsavel) FROM sitar.tarefa where responsavel=? AND datarealfinalizacao IS NULL AND deleted IS NULL";
        if ($query = $conexao->prepare($sql)) {
            //passando variaveis para a query
            try {
                $query->bind_param('s', $usuarioBanco);
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
            echo "Há um problema com a sintaxe inicial da query SQL";
        }
        $conexao->close();
        return $col1;
        
        
    }
    
    public static function contar_tarefa_solicitada($usuarioBanco){
        //requer a conexão com o servidor
        require '../../controller/php/conexao.php';

        //inicia a conexao
        $query = $conexao->stmt_init();
        //testa se o query esta correto
        $sql="SELECT count(emissor) FROM sitar.tarefa where emissor=? AND datarealfinalizacao IS NULL AND deleted IS NULL;";
        if ($query = $conexao->prepare($sql)) {
            //passando variaveis para a query
            try {
                $query->bind_param('s', $usuarioBanco);
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

        $conexao->close();
        return $col1;
        
    }

        }

