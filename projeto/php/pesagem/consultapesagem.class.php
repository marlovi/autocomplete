 <?php 
	class ConsultaPesagem {
		public $data;  
		public $status;
		public $id_pesagem;
		public $motorista;
		public $peso_1;
		public $peso_2;
		public $peso_descontos;
		public $peso_liquido;
		public $cliente;
		public $fornecedor;
		public $placa;  
		public $produto;
		public $observacao;

		function __construct(){}
		public function  preencher($request){
		if(isset($request->data)){
			$this->data = $request->data;
		}
		if(isset($request->status)){
			$this->status = $request->status;
		}
		if(isset($request->motorista )){
			$this->motorista = $request->motorista;
		}
		if(isset($request->id_pesagem)){
			$this->id_pesagem = $request->id_pesagem;
		}
		if(isset($request->peso_1)){
			$this->peso_1 = $request->peso_1;
		}
		if(isset($request->peso_2)){
			$this->peso_2 = $request->peso_2;
		}
		if(isset($request->peso_descontos)){
			$this->peso_descontos = $request->peso_descontos;
		}
		if(isset($request->peso_liquido)){
			$this->peso_liquido = $request->peso_liquido;
		}
		if(isset($request->cliente)){
			$this->cliente = $request->cliente;
		}
		if(isset($request->fornecedor)){
			$this->fornecedor = $request->fornecedor;
		}
		
		if(isset($request->placa)){
			$this->placa = $request->placa;
		}
		if(isset($request->produto)){
			$this->produto = $request->produto;
		}
		
		if(isset($request->observacao )){
			$this->observacao = $request->observacao;
		}

		}
 
		public function getData(){
			return $this->data;
		}
		public function setData($data){
			$this->data = $data;
		}
		public function getStatus(){
			return $this->status;
		}
		public function setStatus($status){
			$this->status = $status;
		}
		public function getMotorista(){
			return $this->motorista;
		}
		public function setMotorista($motorista){
			$this->motorista = $motorista;
		}
		public function getId_pesagem(){
			return $this->id_pesagem;
		}
		public function setId_pesagem($id_pesagem){
			$this->id_pesagem = $id_pesagem;
		}
		public function getPeso_1(){
			return $this->peso_1;
		}
		public function setPeso_1($peso_1){
			$this->peso_1 = $peso_1;
		}
		public function getPeso_2(){
			return $this->peso_2;
		}
		public function setPeso_2($peso_2){
			$this->peso_2 = $peso_2;
		}
		public function getPeso_descontos(){
			return $this->peso_descontos;
		}
		public function setPeso_descontos($peso_descontos){
			$this->peso_descontos = $peso_descontos;
		}
		public function getPeso_liquido(){
			return $this->peso_liquido;
		}
		public function setPeso_liquido($peso_liquido){
			$this->peso_liquido = $peso_liquido;
		}
		public function getCliente(){
			return $this->cliente;
		}
		public function setCliente($cliente){
			$this->cliente = $cliente;
		}
		public function getFornecedor(){
			return $this->fornecedor;
		}
		public function setFornecedor($fornecedor){
			$this->fornecedor = $fornecedor;
		}
		public function getPlaca(){
			return $this->placa;
		}
		public function setPlaca($placa){
			$this->placa = $placa;
		}
		public function getProduto(){
			return $this->produto;
		}
		public function setProduto($produto){
			$this->produto = $produto;
		}

	
		public function getObservacao(){
			return $this->observacao;
		}
		public function setObservacao($observacao){
			$this->observacao = $observacao;
		}

	}
?>