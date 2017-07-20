<?php 
    require_once "cliente.class.php";
	require_once "resposta.class.php";
	require_once 'daocliente.class.php';
	require_once '../veiculo/daoveiculo.class.php'; 
    require_once '../veiculo/veiculo.class.php'; 
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
$resposta = new Resposta();
$cliente = new Cliente();
$cliente->preencher($request[0]);
$listaVeiculos = $request[1];



 $dao->update($cliente);

$daoVeiculo = new DaoVeiculo();
// não lembro o que esse foreach faz. mas acho a ideia era associar 
// a lista de veiculos que estava na pagina cadastrando esses veiculos com 
// a mesma id do cliente que esta serndo cadastrado nesse momento. 

if (is_array($listaVeiculos) || is_object($listaVeiculos))
foreach ($listaVeiculos as $key => $value) {
	# code...

	$veiculo = new Veiculo();

	$veiculo->preencher($value);



if(!isset($veiculo->id_veiculo)){
   
	$veiculo->cliente_id_cliente =$cliente->id_cliente;
	

	$daoVeiculo->save($veiculo);
  
}else{
	$daoVeiculo->update($veiculo);
}
}
	$resposta->status = true;

echo json_encode($resposta,true);

?>