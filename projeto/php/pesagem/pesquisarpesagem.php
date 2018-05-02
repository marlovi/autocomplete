<?php 
	require_once "consultapesagem.class.php";
	require_once "daopesagem.class.php";
		$dao = new DaoPesagem();		
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$objetoPesagem = new Pesagem();
		$objetoPesagem = $dao->consultaPesagemOperacao($request);	
	echo json_encode($objetoPesagem,true);
?>