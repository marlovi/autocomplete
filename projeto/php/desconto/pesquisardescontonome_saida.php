<?php  
	require_once "desconto.class.php";
	require_once "daodesconto.class.php";
		$dao = new DaoDesconto();	// cria a variavel dao com as caracteristicas do daocliente	
	    $postdata = file_get_contents("php://input");  // recupera os dados presentes na pagina 
		$request = json_decode($postdata);  // decodifica os dados de json para php
		//$request->nome;

		$pesquisa = $dao->buscarnomedesconto_saida($request->nomedesconto);			
 		
		echo json_encode($pesquisa,true);

?>