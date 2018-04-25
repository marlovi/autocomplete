<?php 
	require_once "consultapesagem.class.php";
	require_once "daopesagem.class.php";
		$dao = new DaoPesagem();		
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		//$request = 12; // tenho que passar o ultimo id.
		$objetoPesagem = new Pesagem();
		// aplicando pesquisa por tipo de pesagem entrada saida
		//$objetoPesagem = $dao->consultaPesagemOperacao($request);	
		$objetoPesagem = $dao->consultaPesagemOperacao($request);	
 		//var_dump($objetoPesagem);
		echo json_encode($objetoPesagem,true);
?>