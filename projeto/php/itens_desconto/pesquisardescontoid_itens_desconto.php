<?php 

// nesse arquivo define qual função do arquivo dao será executada quando 
// no arquivo cadastrocliente.js a função pesquisa por nome for chamada
// a ideia é fragmentar as rotinas em arquivos distintos para facilitar 
// a manutenção.
	require_once "itens_desconto.class.php";
	require_once "resposta.class.php";
	require_once 'daoitens_desconto.class.php';


		$dao = new DaoItens_desconto();
		$itens_desconto = new Itens_desconto();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);  
 
	
		$pesquisa = $itens_desconto->buscarid_itens_desconto($request);

			 	$resposta->status = true;
echo json_encode($resposta,true);

?>