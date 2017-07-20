<?php 
 require_once "produto.class.php";
	require_once "resposta.class.php";
	require_once 'daoproduto.class.php';
	 
		$dao = new DaoProduto();
		$produto = new Produto();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata); 


        $resposta = new Resposta();
        $produto = new Produto();
        $produto->preencher($request[0]);
        

 

        $dao->delete($produto);
	    $resposta->status = true;
        echo json_encode($resposta,true);


?>