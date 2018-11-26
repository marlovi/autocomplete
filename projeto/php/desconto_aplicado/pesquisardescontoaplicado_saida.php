<?php 

// nesse arquivo define qual função do arquivo dao será executada quando 
// no arquivo cadastrocliente.js a função pesquisa por nome for chamada
// a ideia é fragmentar as rotinas em arquivos distintos para facilitar 
// a manutenção.
	require_once "desconto_aplicado.class.php";
	require_once "daodesconto_aplicado.class.php";
 
	$dao = new DaoDesconto_aplicado();	// cria a variavel dao com as caracteristicas do daocliente	
	$postdata = file_get_contents("php://input");  // recupera os dados presentes na pagina 
	$request = json_decode($postdata);  // decodifica os dados de json para php
	//var_dump($request);
		//$pesquisa = $dao->buscarid_aplicado($request);	  
		foreach ($request as $key => $value) {
			//var_dump($value->desconto_aplicado_id_desconto_aplicado);

		 
$pesquisa= $dao->buscarid_aplicado_saida($value->desconto_aplicado_id_desconto_aplicado);
				$value->desconto_aplicado_classificado = $pesquisa[0]->classificado;
				$value->desconto_aplicado_percentual = $pesquisa[0]->percentual;
				$value->desconto_aplicado_absoluto = $pesquisa[0]->absoluto;
				$value->desconto_aplicado_peso_descontado = $pesquisa[0]->peso_descontado;
		//var_dump($pesquisa);
		}														 

 		
		echo json_encode($request,true);  

?>