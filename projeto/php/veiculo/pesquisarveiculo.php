<?php  
	require_once "veiculo.class.php";
	require_once "daoveiculo.class.php";
 
		$dao = new DaoVeiculo();		
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

		$pesquisa = $dao->buscar();			
 		
		echo json_encode($pesquisa,true);

?>