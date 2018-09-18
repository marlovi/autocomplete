<?php 
	require_once "itens_desconto.class.php";
	require_once "resposta.class.php";
	require_once 'daoitens_desconto.class.php';

		$dao = new DaoItens_desconto();
		$itens_desconto = new Itens_desconto();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata); 

		$pesquisa = $itens_desconto->buscarultimo_itens();			
 		
		echo json_encode($pesquisa,true);


?>