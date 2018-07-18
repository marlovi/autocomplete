<?php 
 	require_once "desconto.class.php";
	require_once "resposta.class.php";
	require_once 'daodesconto.class.php';
	require_once "../pesagem/consultapesagem.class.php";
 	require_once "../pesagem/daopesagem.class.php";
	 
		$dao = new DaoDesconto();
		$desconto = new Desconto();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata); 


        $resposta = new Resposta();
        $desconto = new Desconto();
        $desconto->preencher($request[0]);

        $objetoPesagem = new Pesagem();
        $daopesagem = new DaoPesagem();      

        $resposta->status_pesagem = array();
 		$teste_status_pesagem = null; 
 		//
 		// devo consultar itens_desconto e nao consulta_pesagem
 		//
 		//$lista_consulta_pesagem_desconto = $daopesagem->consultaPesagemProduto($request[0]->id_produto);

 		//if(isset($lista_consulta_pesagem_produto->status)){// SE O CLIENTE NAO TIVER  PESAGEM
         // var_dump("NAO TEM PESAGEM PRODUTO");
         	$teste_cliente = 0;  
         	$dao->delete($desconto);
	    	$resposta->status = true;
        	echo json_encode($resposta,true);  
     	//}else{                                         // SE O CLIENTE TIVER PESAGEM
	       //   foreach($lista_consulta_pesagem_produto as $key => $value) {
	         //   array_push($resposta->status_pesagem, $lista_consulta_pesagem_produto[$key]->id_pesagem);
          	 //  }
        
	      //  $teste_cliente = 1;
	      //  var_dump("TEM PESAGEM PRODUTO");
	      //  $resposta->status = false;
	       // echo json_encode($resposta,true);
         // }

?>