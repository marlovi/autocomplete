 <?php  
  
	require_once "cliente.class.php";
	require_once 'daocliente.class.php';
	require_once '../veiculo/daoveiculo.class.php';
	require_once '../veiculo/resposta.class.php';  
	 
		$dao = new DaoCliente();
		$cliente = new Cliente();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata); // separa o cliente do array que vem com a lista de veiculos
		
/*
Foi necessario fazer esse teste com if para que corrigisse esse erro
no retorno dos dados armazenados no banco de dados
Undefined property: stdClass::$cpf esse erro acontecia quando nao colocava todos os
dados no cadastro. 
Essa mudança faz parte da implementação para cadastro de veiculos associados a
clientes. associação de tabelas.
   
*/

$cliente = new Cliente();
$cliente->preencher($request[0]);
$listaVeiculos = $request[1];


$last_id = $dao->save($cliente);
$cliente->id_cliente = $last_id;
$daoVeiculo = new DaoVeiculo();
// não lembro o que esse foreach faz. mas acho a ideia era associar 
// a lista de veiculos que estava na pagina cadastrando esses veiculos com 
// a mesma id do cliente que esta serndo cadastrado nesse momento. 
foreach ($listaVeiculos as $key => $value) {
	# code...

	$veiculo = new Veiculo();
	$veiculo->cliente_id_cliente = $last_id;
	$veiculo->preencher($value);

	$daoVeiculo->save($veiculo);

}


echo json_encode($cliente,true);


?>