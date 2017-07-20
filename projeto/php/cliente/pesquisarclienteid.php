<?php 

// nesse arquivo define qual função do arquivo dao será executada quando 
// no arquivo cadastrocliente.js a função pesquisa por nome for chamada
// a ideia é fragmentar as rotinas em arquivos distintos para facilitar 
// a manutenção.
	require_once "cliente.class.php";
	require_once "daocliente.class.php";
 
		$dao = new DaoCliente();	// cria a variavel dao com as caracteristicas do daocliente	
	    $postdata = file_get_contents("php://input");  // recupera os dados presentes na pagina 
		$request = json_decode($postdata);  // decodifica os dados de json para php
	
		$pesquisa = $dao->buscarid($request);	 // cria uma variavel pesquisa 
														// chama a função buscarnome passando 
														// a informação na posição nome como parametro
														// para a função.  e o retorno dessa função
														// ficara armazenado na variavel pesquisa

 		
		echo json_encode($pesquisa,true); // codifica a informação que retornou da função em json para ser
										// representada na pagina.

?>