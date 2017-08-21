<?php 
	require_once "cliente.class.php";
	require_once "daocliente.class.php";
 
		$dao = new DaoCliente();		
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

		$pesquisa = $dao->buscar($request->nome);			
 		
		echo json_encode($pesquisa,true);


/*
ORIGINAL
<?php 
	require_once "cliente.class.php";
	require_once "daocliente.class.php";
 
		$dao = new DaoCliente();		
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

		$pesquisa = $dao->buscar();			
 		
		echo json_encode($pesquisa,true);

?>

*/
?>


