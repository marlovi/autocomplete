 <?php 
  
	class Desconto
	{
		public $id_desconto; // add nas outras class
		public $nome;
	
		
		/*
		
Foi necessario fazer esse teste com if para que corrigisse esse erro
no retorno dos dados armazenados no banco de dados
Undefined property: stdClass::$cpf esse erro acontecia quando nao colocava todos os
dados no cadastro. 
Essa mudança faz parte da implementação para cadastro de veiculos associados a
produto. associação de tabelas.

*/

		function __construct(){}

		public function  preencher($request){


			$this->nome = $request->nome; 
			if(isset($request->id_desconto)){

			$this->id_desconto = $request->id_desconto;
			
		}

		 
		
		}
		public function getId_Desconto(){
			return $this->id_desconto;
		}
		public function setId_Desconto($id_desconto){
			$this->id_desconto = $id_desconto;
		}
		public function getNome(){
			return $this->nome; 
		}
		public function setNome($nome){
			$this->nome = $nome;
		}
		 
		 
		

	}
?>