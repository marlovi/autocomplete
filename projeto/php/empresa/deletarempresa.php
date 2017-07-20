<?php 
 require_once "empresa.class.php";
	require_once "resposta.class.php";
	require_once 'daoempresa.class.php';
	require_once '../veiculo/daoveiculo.class.php'; 
    require_once '../veiculo/veiculo.class.php'; 
		$dao = new DaoEmpresa();
		$empresa = new Empresa();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata); 


        $resposta = new Resposta();
        $empresa = new Empresa();
        $empresa->preencher($request[0]);
        $listaVeiculos = $request[1];



        $daoVeiculo = new DaoVeiculo();
        foreach ($listaVeiculos as $key => $value) {
	# code...

	        $veiculo = new Veiculo();

        	$veiculo->preencher($value);

            $daoVeiculo->delete($veiculo);

        }

        $dao->delete($empresa);
	    $resposta->status = true;
        echo json_encode($resposta,true);


?>