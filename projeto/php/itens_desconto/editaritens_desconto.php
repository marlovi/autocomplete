<?php 
	require_once "itens_desconto.class.php";
	require_once "resposta.class.php";
	require_once 'daoitens_desconto.class.php';

		$dao = new DaoItens_desconto();
		$itens_desconto = new Itens_desconto();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);  

 
$resposta = new Resposta();
$itens_desconto = new Itens_desconto();
$itens_desconto->preencher($request[0]);
$dao->update_itens($itens_desconto);
 
	$resposta->status = true;
echo json_encode($resposta,true);
?>