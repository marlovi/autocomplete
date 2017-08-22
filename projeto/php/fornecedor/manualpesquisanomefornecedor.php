<?php 
	require_once "fornecedor.class.php";
	require_once "daofornecedor.class.php";
 
		$dao = new DaoFornecedor();		
	    $postdata = file_get_contents("php://input");
	

			$pesquisa = $dao->buscarnome($postdata);	
 		
		echo json_encode($pesquisa,true);

?>