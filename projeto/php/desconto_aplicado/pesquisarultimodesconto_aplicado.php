<?php 
	require_once "desconto_aplicado.class.php";
	require_once "daodesconto_aplicado.class.php";
 
		$dao = new DaoDesconto_aplicado();		
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

		$pesquisa = $dao->buscarultimo_aplicado();			
 		
		echo json_encode($pesquisa,true);


?>