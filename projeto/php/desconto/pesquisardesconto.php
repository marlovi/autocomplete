<?php 
	require_once "desconto.class.php";
	require_once "daodesconto.class.php";
 
		$dao = new DaoDesconto();		
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

		$pesquisa = $dao->buscar();			
 		
		echo json_encode($pesquisa,true);

?>