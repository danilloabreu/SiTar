<?php

class Tarefa1 {
    
    private $id_tarefa;
    private $resumo;
    private $responsavel;
    private $data_abertura;
    private $data_finalizacao;
    private $prioridade;
    private $emissor;
    private $datasolicitacaofinalizacao;
    
    //construtor
    public function Tarefa ($Id_tarefa, $Resumo, $Responsavel , $Dataabertura, $Datafinalizacao, $Prioridade, $Emissor, $Datasolicitacaofinalizacao){
    $this->setId_tarefa($Id_tarefa);
    $this->setResumo($Resumo);
    $this->setResponsavel($Responsavel);
    $this->setData_abertura($Dataabertura);
    $this->setData_finalizacao($Datafinalizacao);
    $this->setPrioridade($Prioridade);
    $this->setEmissor($Emissor);
    $this->setDatasolicitacaofinalizacao($Datasolicitacaofinalizacao);
}//fim do construtor


    
    //set e get
    public function setId_tarefa ($Id_tarefa){
		$this->id_tarefa = $Id_tarefa;
        }
    public function getId_tarefa(){
		return $this->id_tarefa;
    
}
    public function setResumo ($Resumo){
		$this->resumo = $Resumo;
        }
    public function getResumo(){
		return $this->resumo;
    
}
    public function setResponsavel ($Responsavel){
		$this->responsavel = $Responsavel;
        }
    public function getResponsavel(){
		return $this->responsavel;
    
}
    public function setData_abertura ($Data_abertura){
		$this->data_abertura = $Data_abertura;
        }
    public function getData_abertura(){
		return $this->data_abertura;
    
}
    public function setData_finalizacao ($Data_finalizacao){
		$this->data_finalizacao = $Data_finalizacao;
        }
    public function getData_finalizacao(){
		return $this->data_finalizacao;
    
}
    public function setPrioridade ($Prioridade){
		$this->prioridade = $Prioridade;
        }
    public function getPrioridade(){
		return $this->prioridade;
    
}
    public function setEmissor ($Emissor){
		$this->emissor = $Emissor;
        }
    public function getEmissor(){
		return $this->emissor;
    
}
    public function setDatasolicitacaofinalizacao ($Datasolicitacaofinalizacao){
		$this->datasolicitacaofinalizacao = $Datasolicitacaofinalizacao;
        }
    public function getDatasolicitacaofinalizacao(){
		return $this->datasolicitacaofinalizacao;
    
}

//metodos
public function inserir_tarefa (Tarefa $tarefa){
        //abre a conex�o com o banco de dados
        require_once 'conexao.php';
        //iniciando a conex�o
        $query =$conexao->stmt_init();    
        //testa se o query est� correto
        if($query=$conexao->prepare("INSERT INTO tarefa (idtarefa,resumo,responsavel,data_abertura,data_finalizacao,prioridade,emissor,datasolicitacaofinalizacao)"
                . "VALUES (?,?,?,?,?,?,?,?)")){
        //passando variaveis para a query
            try{
            $idtarefa=null;
            $resumo=$tarefa->getResumo();
            $responsavel=$tarefa->getResponsavel();
            $data_abertura=$tarefa->getData_abertura();
            $data_finalizacao=$tarefa->getData_finalizacao();
            $prioridade = $tarefa->getPrioridade();
            $emissor = $tarefa->getEmissor();        
            $datasolicitacaofinalizacao = $tarefa->getDatasolicitacaofinalizacao();        
        
            $query->bind_param('ssssssss',
                $idtarefa,
                $resumo,
                $responsavel,
                $data_abertura,
                $data_finalizacao,
                $prioridade,
                $emissor,
                $datasolicitacaofinalizacao
                );
        $resultado=$query->execute();
        }
            catch(Exception $e){
            echo "fudeu";
        }
       //testa o resultado
        if (!$resultado) {
        $message  = 'Invalid query: ' . $conexao->error(). "\n";
        die($message);
        }
    } else {
        echo "H� um problema com a sintaxe inicial da query SQL";
    }

  }
public function recuperar_tarefa ($Idtarefa){
    //requer a conex�o com o servidor
    require 'conexao.php';
        
        //inicia a conex�o
        $query =$conexao->stmt_init();    
        //testa se o query est� correto
        if($query=$conexao->prepare("SELECT * FROM tarefa WHERE idtarefa = ? ")){
            //passando variaveis para a query
            try{              
            $query->bind_param('s',
            $Idtarefa);           
            $resultado=$query->execute();
            $query->bind_result($col1,$col2,$col3,$col4,$col5,$col6,$col7,$col8);
            $query->fetch() ;
            //printf("%s %s %s %s %s %s %s %s ", $col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8);
            
            $idtarefa=$col1;
            $resumo=$col2;
            $responsavel=$col3;
            $data_abertura=$col4;
            $data_finalizacao=$col5;
            $prioridade=$col6;
            $emissor=$col7;        
            $datasolicitacaofinalizacao=$col8;     
                       
                       
            $tarefa = new Tarefa($col1,$col2,$col3,$col4,$col5,$col6,$col7,$col8);         
                        
               //testa o resultado
               if (!$resultado) {
               $message  = 'Invalid query: ' . $conexao->error . "\n";
               //$message .= 'Whole query: ' . $resultado;
               die($message);
                }
            }
                catch(Exception $e){
                echo "erro de exce��o";
                }
        }else{
            echo "H� um problema com a sintaxe inicial da query SQL";
             }
            
             $conexao->close();
             return $tarefa;
    
    
    
    
    
}
}