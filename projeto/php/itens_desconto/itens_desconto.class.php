 <?php 
	class Itens_desconto
	{
		public $id_itens_desconto; 
		public $pesagem_id_pesagem;
		public $desconto_id_desconto;
		public $desconto_aplicado_id_desconto_aplicado;
 
		function __construct(){}

		public function  preencher($request){ 

				if(isset($request->id_itens_desconto)){
					$this->id_itens_desconto = $request->id_itens_desconto;
				}
				if(isset($request->pesagem_id_pesagem)){
					$this->pesagem_id_pesagem = $request->pesagem_id_pesagem; 
				}
				if(isset($request->desconto_id_desconto)){
					$this->desconto_id_desconto = $request->desconto_id_desconto; 
				}
				if(isset($request->desconto_aplicado_id_desconto_aplicado)){
					$this->desconto_aplicado_id_desconto_aplicado = $request->desconto_aplicado_id_desconto_aplicado; 
				}
				 
		}
 //id_itens_desconto`, `pesagem_id_pesagem`, `desconto_id_desconto`, `desconto_aplicado_id_desconto_aplicado
		public function getId_itens_desconto(){
			return $this->id_itens_desconto;
		}
		public function setId_itens_desconto($id_itens_desconto){
			$this->id_itens_desconto = $id_itens_desconto;
		}
		public function getPesagem_id_pesagem(){
			return $this->pesagem_id_pesagem; 
		}
		public function setPesagem_id_pesagem($pesagem_id_pesagem){
			$this->pesagem_id_pesagem = $pesagem_id_pesagem;
		}
		public function getDesconto_id_desconto(){
			return $this->desconto_id_desconto; 
		}
		public function setDesconto_id_desconto($desconto_id_desconto){
			$this->desconto_id_desconto = $desconto_id_desconto;
		}
		public function getDesconto_aplicado_id_desconto_aplicado(){
			return $this->desconto_aplicado_id_desconto_aplicado; 
		}
		public function setDesconto_aplicado_id_desconto_aplicado($desconto_aplicado_id_desconto_aplicado){
			$this->desconto_aplicado_id_desconto_aplicado = $desconto_aplicado_id_desconto_aplicado;
		}
		 
	}
?>