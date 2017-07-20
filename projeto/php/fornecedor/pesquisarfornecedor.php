<?php 
	require_once "fornecedor.class.php";
	require_once "daofornecedor.class.php";
 
		$dao = new DaoFornecedor();		
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

		$pesquisa = $dao->buscar();			
 		
		echo json_encode($pesquisa,true);

?>