<?php 
   
	require_once "veiculo.class.php";
	require_once 'daoveiculo.class.php';

		$dao = new DaoVeiculo();
		$veiculo = new Veiculo();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

		$veiculo->placa = $request->placa;
		$veiculo->descricao = $request->descricao;
 		$veiculo->tipo = $request->tipo;
	
		$veiculo->fornecedor = $request->fornecedor;
		$veiculo->cliente = $request->cliente;
		$veiculo->empresa = $request->empresa;

		$verificador = $dao->save($veiculo);

	

?>