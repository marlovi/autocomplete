 <?php 
  
	class Cliente
	{
		public $id_cliente; // add nas outras class
		public $nome;
		public $cpf;
		public $cnpj;
		public $endereco;
		public $cidade;
		public $estado;
		public $telefone;
		public $email;
		/*
Foi necessario fazer esse teste com if para que corrigisse esse erro
no retorno dos dados armazenados no banco de dados
Undefined property: stdClass::$cpf esse erro acontecia quando nao colocava todos os
dados no cadastro. 
Essa mudança faz parte da implementação para cadastro de veiculos associados a
clientes. associação de tabelas.

*/

		function __construct(){}

		public function  preencher($request){

			$this->nome = $request->nome;//$request->nome;
		if(isset($request->id_cliente)){
			$this->id_cliente = $request->id_cliente;
		}
		
		if(isset($request->cpf)){
			$this->cpf = $request->cpf;
		}
		if(isset($request->cnpj)){
			$this->cnpj = $request->cnpj;
		}
		if(isset($request->endereco)){
			$this->endereco = $request->endereco;
		}
		if(isset($request->cidade)){
			$this->cidade = $request->cidade;
		}
		if(isset($request->estado)){
			$this->estado = $request->estado;
		}
		if(isset($request->telefone)){
			$this->telefone = $request->telefone;
		}
		if(isset($request->email)){
			$this->email = $request->email;
		}
		}
		public function getId_cliente(){
			return $this->id_cliente;
		}
		public function setId_cliente($id_cliente){
			$this->id_cliente = $id_cliente;
		}
		public function getNome(){
			return $this->nome;
		}
		public function setNome($nome){
			$this->nome = $nome;
		}
		public function getCpf(){
			return $this->cpf;
		}
		public function setCpf($cpf){
			$this->cpf = $cpf;
		}		
		public function getCnpj(){
			return $this->cnpj;
		}
		public function setCnpj($cnpj){
			$this->cnpj = $cnpj;
		}
		public function getEndereco(){
			return $this->endereco;
		}
		public function setEndereco($endereco){
			$this->endereco = $endereco;
		}
		public function getCidade(){
			return $this->cidade;
		}
		public function setCidade($cidade){
			$this->cidade = $cidade;
		}
		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($estado){
			$this->estado = $estado;
		}
		public function getTelefone(){
			return $this->telefone;
		}
		public function setTelefone($telefone){
			$this->telefone = $telefone;
		}
		public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email = $email;
		}

	}
?>