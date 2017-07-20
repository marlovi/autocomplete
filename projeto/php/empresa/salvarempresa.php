 <?php  
  
	require_once "empresa.class.php";
	require_once 'daoempresa.class.php';
	require_once '../veiculo/daoveiculo.class.php';  
		$dao = new DaoEmpresa();
		$empresa = new Empresa();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata); // separa o empresa do array que vem com a lista de veiculos
		
/*

Foi necessario fazer esse teste com if para que corrigisse esse erro
no retorno dos dados armazenados no banco de dados
Undefined property: stdClass::$cpf esse erro acontecia quando nao colocava todos os
dados no cadastro. 
Essa mudança faz parte da implementação para cadastro de veiculos associados a
clientes. associação de tabelas.
   
*/

$empresa = new Empresa();
$empresa->preencher($request[0]);
$listaVeiculos = $request[1];


$last_id = $dao->save($empresa);
$empresa->id_empresa = $last_id;
$daoVeiculo = new DaoVeiculo();
foreach ($listaVeiculos as $key => $value) {


	$veiculo = new Veiculo();
	$veiculo->empresa_id_empresa = $last_id;
	$veiculo->preencher($value);

	$daoVeiculo->save($veiculo);

}


echo json_encode($empresa,true);


?>