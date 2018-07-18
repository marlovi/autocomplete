<?php 
	require_once "desconto.class.php";
	require_once "daodesconto.class.php";
 
		$dao = new DaoDesconto();		
	    $postdata = file_get_contents("php://input");
	

			$pesquisa = $dao->buscarnome($postdata);	
 		
		echo json_encode($pesquisa,true);

?>