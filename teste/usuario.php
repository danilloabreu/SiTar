<?php
class Usuario{
	private		$id_usuario;
	private     $nome;
	private 	$senha;
	private     $email;
	
//construtor da classe
	function Usuario($Nome,$Senha,$email){
		$this->setNome($Nome);
	}

		
	public function setid_usuario ($Id_usuario){
		$this->$id_usuario=$Id_usuario;
	}
	public function getid_usuario (){
		return $this->$id_usuario;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	function getEndereco(){
		return $this->endereco;
	}

} ?>