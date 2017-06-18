<?php
//arquivos necessarios para o funcionamento
require ("conexao.php");
require ("../../");
require ("../../model/br.com.sitar.Movimento/br.com.sitar.Movimento.php");
require ("../../model/usuario.php");

//criação de objeto tarefa
$tarefa = new Tarefa(null,null,"Carlos",null,null,null,null,null);
//set de $tarefa
$tarefa->setId_tarefa("1");
$tarefa->setPrioridade(1);
$tarefa->setEmissor("Danilo");
//$tarefa->setResponsavel("Carlos");
$tarefa->setResumo("Esse é o resumo da tarefa 1");

//data abertura
$data_abertura= new DateTime();
//convertendo o formato de data para inserir no banco
$data_abertura=$data_abertura->format('Y-m-d H:i:s');
$tarefa->setData_abertura($data_abertura);
$tarefa->setData_finalizacao($data_abertura);

//visualização para facilitar entrada
echo $tarefa->getEmissor();
echo '<br>';
echo $tarefa->getResponsavel();
echo '<br>';
echo $tarefa->getResumo();
echo '<br>';
echo $tarefa->getData_abertura();

//$tarefa->inserir_tarefa($tarefa);


//abre a conexao com o banco de dados
        require '../../controller/php/conexao.php';
        //iniciando a conexao
        $query = $conexao->stmt_init();
        $query1 = $conexao->stmt_init();
        //desliga o autocommit para transação
        $conexao->autocommit(FALSE);
        //testa se o query esta correto
        $query = $conexao->prepare("INSERT INTO tarefa (idtarefa,resumo,responsavel,dataabertura,datafinalizacao,prioridade,emissor,datasolicitacaofinalizacao)"
                . "VALUES (?,?,?,?,?,?,?,?)");
            if (false===$query){
            //echo $mysqli->error;
            die("Err1o no primeiro query".htmlspecialchars($conexao->error));
            }
            
            if (!$query1 = $conexao->prepare("INSERT INTO usuario (idusuario, nome, senha, email) VALUES ('','Dandan','101112','bolovo')")){
            die("Erro no segundo query");
            }

//passando variaveis para a query
            
                $idtarefa = "";
                $resumo = $tarefa->getResumo();
                $responsavel = $tarefa->getResponsavel();
                $data_abertura = $tarefa->getData_abertura();
                $data_finalizacao = $tarefa->getData_finalizacao();
                $prioridade = $tarefa->getPrioridade();
                $emissor = $tarefa->getEmissor();
                $datasolicitacaofinalizacao = $tarefa->getDatasolicitacaofinalizacao();
            
                
              
            try {
                $query->bind_param('ssssssss', $idtarefa, $resumo, $responsavel, $data_abertura, $data_finalizacao, $prioridade, $emissor, $datasolicitacaofinalizacao
                );
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
            } catch (Exception $e) {
                echo "Houve um errro. Verifique o log";
                $conexao->rollback();
                
            }
           
    $conexao->close();







