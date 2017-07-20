<?php 
 
	class Veiculo
	{
		public $id_veiculo;
		public $placa;
		public $descricao;
 		public $tipo;
		
		public $fornecedor_id_fornecedor;
		public $cliente_id_cliente;
		public $empresa_id_empresa;
////////////////////////////////////////
		function __construct(){}

		public function  preencher($request){

		$this->placa = $request->placa;
		if(isset($request->id_veiculo)){
			$this->id_veiculo = $request->id_veiculo;
		}	
		if(isset($request->descricao)){
			$this->descricao = $request->descricao;
		}
		if(isset($request->tipo)){
			$this->tipo = $request->tipo;
		}
		
		
		}

		}

?>