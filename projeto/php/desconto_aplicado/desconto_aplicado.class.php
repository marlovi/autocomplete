 <?php 
 
	class Desconto_aplicado
	{
		public $id_desconto_aplicado; 
		public $classificado;
		public $percentual;
		public $absoluto;
		public $peso_descontado;

		function __construct(){}

		public function  preencher($request){ 

				if(isset($request->id_desconto_aplicado)){
					$this->id_desconto_aplicado = $request->id_desconto_aplicado;
				}
				if(isset($request->classificado)){
					$this->classificado = $request->classificado; 
				}
				if(isset($request->percentual)){
					$this->percentual = $request->percentual; 
				}
				if(isset($request->absoluto)){
					$this->absoluto = $request->absoluto; 
				}
				if(isset($request->peso_descontado)){
					$this->peso_descontado = $request->peso_descontado; 
				}

		}

		public function getId_desconto_aplicado(){
			return $this->id_desconto_aplicado;
		}
		public function setId_desconto_aplicado($id_desconto_aplicado){
			$this->id_desconto_aplicado = $id_desconto_aplicado;
		}
		public function getClassificado(){
			return $this->classificado; 
		}
		public function setClassificado($classificado){
			$this->classificado = $classificado;
		}
		public function getPercentual(){
			return $this->percentual; 
		}
		public function setPercentual($percentual){
			$this->percentual = $percentual;
		}
		public function getAbsoluto(){
			return $this->absoluto; 
		}
		public function setAbsoluto($absoluto){
			$this->absoluto = $absoluto;
		}
		public function getPeso_descontado(){
			return $this->peso_descontado; 
		}
		public function setPeso_descontado($peso_descontado){
			$this->peso_descontado = $peso_descontado;
		}

	}
?>