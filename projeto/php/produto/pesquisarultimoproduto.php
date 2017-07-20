<?php 
	require_once "produto.class.php";
	require_once "daoproduto.class.php";
 
		$dao = new DaoProduto();		
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

		$pesquisa = $dao->buscarultimo();			
 		
		//echo json_encode($pesquisa,true);


?>