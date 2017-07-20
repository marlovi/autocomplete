 <?php 
  
	class Produto
	{
		public $id_produto; // add nas outras class
		public $nome;
		public $codigo;
		
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
			if(isset($request->id_produto)){

			$this->id_produto = $request->id_produto;
			
		}

		if(isset($request->codigo)){
			$this->codigo = $request->codigo;
		}
		
		}
		public function getId_Produto(){
			return $this->id_produto;
		}
		public function setId_Produto($id_produto){
			$this->id_produto = $id_produto;
		}
		public function getNome(){
			return $this->nome; 
		}
		public function setNome($nome){
			$this->nome = $nome;
		}
		public function getCodigo(){
			return $this->codigo;
		}
		public function setCodigo($codigo){
			$this->codigo = $codigo;
		}		
		

	}
?>