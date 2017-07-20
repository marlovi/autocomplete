<?php 
 require_once "fornecedor.class.php";
	require_once "resposta.class.php";
	require_once 'daofornecedor.class.php';
	require_once '../veiculo/daoveiculo.class.php'; 
    require_once '../veiculo/veiculo.class.php'; 
		$dao = new DaoFornecedor();
		$fornecedor = new Fornecedor();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata); 


        $resposta = new Resposta();
        $fornecedor = new Fornecedor();
        $fornecedor->preencher($request[0]);
        $listaVeiculos = $request[1];



        $daoVeiculo = new DaoVeiculo();
        foreach ($listaVeiculos as $key => $value) {
	# code...

	        $veiculo = new Veiculo();

        	$veiculo->preencher($value);

            $daoVeiculo->delete($veiculo);

        }

        $dao->delete($fornecedor);
	    $resposta->status = true;
        echo json_encode($resposta,true);


?>