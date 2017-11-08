 <?php 
  
	class Pesagem
	{
		public $id_pesagem; // add nas outras class
		public $status;
		public $placa;
		public $data;
		public $motorista;
		public $fornecedor_id_fornecedor;
		public $empresa_id_empresa;
		public $produto_id_produto;
		public $cliente_id_cliente;
		public $veiculo_id_veiculo;
		public $tipo_veiculo;
		public $peso_1;
		public $peso_2;
		public $peso_descontos;
		public $peso_liquido;
		public $observacao;



		function __construct(){}

		public function  preencher($request){

			 
		if(isset($request->id_pesagem )){
			$this->id_pesagem = $request->id_pesagem;
		}
		if(isset($request->status )){
			$this->status = $request->status;
		}
		if(isset($request->placa )){
			$this->placa = $request->placa;
		}
		if(isset($request->data )){
			$this->data = $request->data;
		}
		if(isset($request->motorista )){
			$this->motorista = $request->motorista;
		}
		if(isset($request->fornecedor_id_fornecedor )){
			$this->fornecedor_id_fornecedor = $request->fornecedor_id_fornecedor;
		}
		if(isset($request->empresa_id_empresa )){
			$this->empresa_id_empresa = $request->empresa_id_empresa;
		}
		if(isset($request->produto_id_produto )){
			$this->produto_id_produto = $request->produto_id_produto;
		}
		if(isset($request->cliente_id_cliente )){
			$this->cliente_id_cliente = $request->cliente_id_cliente;
		}
		if(isset($request->veiculo_id_veiculo )){
			$this->veiculo_id_veiculo = $request->veiculo_id_veiculo;
		}
		if(isset($request->tipo_veiculo )){
			$this->tipo_veiculo = $request->tipo_veiculo;
		}
		if(isset($request->peso_1 )){
			$this->peso_1 = $request->peso_1;
		}
		if(isset($request->peso_2 )){
			$this->peso_2 = $request->peso_2;
		}
		if(isset($request->peso_descontos )){
			$this->peso_descontos = $request->peso_descontos;
		}
		if(isset($request->peso_liquido )){
			$this->peso_liquido = $request->peso_liquido;
		}
		if(isset($request->observacao )){
			$this->observacao = $request->observacao;
		}

		}

		public function getId_pesagem(){
			return $this->id_pesagem;
		}
		public function setId_pesagem($id_pesagem){
			$this->id_pesagem = $id_pesagem;
		}

		public function getStatus(){
			return $this->status;
		}
		public function setStatus($status){
			$this->status = $status;
		}

		public function getPlaca(){
			return $this->placa;
		}
		public function setPlaca($placa){
			$this->placa = $placa;
		}

		public function getData(){
			return $this->data;
		}
		public function setData($data){
			$this->data = $data;
		}

		public function getMotorista(){
			return $this->motorista;
		}
		public function setMotorista($motorista){
			$this->motorista = $motorista;
		}

		public function getFornecedor_id_fornecedor(){
			return $this->fornecedor_id_fornecedor;
		}
		public function setFornecedor_id_fornecedor($fornecedor_id_fornecedor){
			$this->fornecedor_id_fornecedor = $fornecedor_id_fornecedor;
		}

		public function getEmpresa_id_empresa(){
			return $this->empresa_id_empresa;
		}
		public function setEmpresa_id_empresa($empresa_id_empresa){
			$this->empresa_id_empresa = $empresa_id_empresa;
		}

		public function getProduto_id_produto(){
			return $this->produto_id_produto;
		}
		public function setProduto_id_produto($produto_id_produto){
			$this->produto_id_produto = $produto_id_produto;
		}

		public function getCliente_id_cliente(){
			return $this->cliente_id_cliente;
		}
		public function setCliente_id_cliente($cliente_id_cliente){
			$this->cliente_id_cliente = $cliente_id_cliente;
		}

		public function getVeiculo_id_veiculo(){
			return $this->veiculo_id_veiculo;
		}
		public function setVeiculo_id_veiculo($veiculo_id_veiculo){
			$this->veiculo_id_veiculo = $veiculo_id_veiculo;
		}

		public function getTipo_veiculo(){
			return $this->tipo_veiculo;
		}
		public function setTipo_veiculo($tipo_veiculo){
			$this->tipo_veiculo = $tipo_veiculo;
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
		public function getObservacao(){
			return $this->observacao;
		}
		public function setObservacao($observacao){
			$this->observacao = $observacao;
		}

	}
?>