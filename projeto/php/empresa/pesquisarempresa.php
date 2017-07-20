<?php 
	require_once "empresa.class.php";
	require_once "daoempresa.class.php";
 
		$dao = new DaoEmpresa();		
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

		$pesquisa = $dao->buscar();			
 		
		echo json_encode($pesquisa,true);

?>