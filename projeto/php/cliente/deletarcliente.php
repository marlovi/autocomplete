<?php 
 require_once "cliente.class.php";
	require_once "resposta.class.php";
	require_once 'daocliente.class.php';
	require_once '../veiculo/daoveiculo.class.php'; 
    require_once '../veiculo/veiculo.class.php'; 
		$dao = new DaoCliente();
		$cliente = new Cliente();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata); 


        $resposta = new Resposta();
        $cliente = new Cliente();
        $cliente->preencher($request[0]);
        $listaVeiculos = $request[1];



        $daoVeiculo = new DaoVeiculo();
        foreach ($listaVeiculos as $key => $value) {
	# code...

	        $veiculo = new Veiculo();

        	$veiculo->preencher($value);

            $daoVeiculo->delete($veiculo);

        }

        $dao->delete($cliente);
	    $resposta->status = true;
        echo json_encode($resposta,true);


?>