<?php  
	require_once "desconto.class.php";
	require_once "daodesconto.class.php";
		$dao = new DaoDesconto();	// cria a variavel dao com as caracteristicas do daocliente	
	    $postdata = file_get_contents("php://input");  // recupera os dados presentes na pagina 
		$request = json_decode($postdata);  // decodifica os dados de json para php
		//$request->nome;
		
		foreach ($request as $key => $value) {
		 
$pesquisa= $dao->buscarnomedesconto_saida_impressao($value->desconto_id_desconto);
$value->desconto_nome = $pesquisa[0]->nome;
// coloquei o resultado da pesquisa do nome do desconto na variavel pesquisa
// agora coloco a resposta na posição 

}
	echo json_encode($request,true);

?>