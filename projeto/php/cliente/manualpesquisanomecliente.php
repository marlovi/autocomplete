<?php 
	require_once "cliente.class.php";
	require_once "daocliente.class.php";
 
		$dao = new DaoCliente();		
	    $postdata = file_get_contents("php://input");
	

			$pesquisa = $dao->buscarnome($postdata);	
 		
		echo json_encode($pesquisa,true);

?>