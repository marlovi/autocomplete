<?php 
	require_once "consultapesagem.class.php";
	require_once "daopesagem.class.php";
 
		$dao = new DaoPesagem();		
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		//$request = 12; // tenho que passar o ultimo id.
		$objetoPesagem = new Pesagem();

		$objetoPesagem = $dao->getPesagem($request->id_pesagem);	

 		//var_dump($objetoPesagem);

		echo json_encode($objetoPesagem,true);

?>