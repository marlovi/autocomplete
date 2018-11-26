<?php 
	require_once "itens_desconto.class.php";
	require_once "daoitens_desconto.class.php";
	require_once "resposta.class.php";

		$dao = new DaoItens_desconto();
		
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);  
 
		$objetoPesquisa = new itens_desconto();
		$objetoPesquisa = $dao->buscarid_pesagem_itens_desconto($request);
		
  
echo json_encode($objetoPesquisa,true);

?>