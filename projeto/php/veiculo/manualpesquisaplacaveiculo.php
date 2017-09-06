<?php 
	require_once "veiculo.class.php";
	require_once "daoveiculo.class.php";
 
		$dao = new DaoVeiculo();		
	    $postdata = file_get_contents("php://input");
 		 

		$pesquisa = $dao->buscar_placa_pesagem_manual($postdata);

		echo json_encode($pesquisa,true);

?>