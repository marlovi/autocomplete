<?php 
    require_once "desconto_aplicado.class.php";
	require_once "resposta.class.php";
	require_once 'daodesconto_aplicado.class.php';
		$dao = new DaoDesconto_aplicado();
		$desconto_aplicado = new Desconto_aplicado();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata); // separa o cliente do array que vem com a lista de veiculos
/*
Foi necessario fazer esse teste com if para que corrigisse esse erro
no retorno dos dados armazenados no banco de dados
Undefined property: stdClass::$cpf esse erro acontecia quando nao colocava todos os
dados no cadastro. 
Essa mudança faz parte da implementação para cadastro de veiculos associados a
clientes. associação de tabelas.
*/
$resposta = new Resposta();
$desconto_aplicado = new Desconto_aplicado();
$desconto_aplicado->preencher($request[0]);
$dao->update_aplicado($desconto_aplicado);
// não lembro o que esse foreach faz. mas acho a ideia era associar 
// a lista de veiculos que estava na pagina cadastrando esses veiculos com 
// a mesma id do cliente que esta serndo cadastrado nesse momento. 
	$resposta->status = true;
echo json_encode($resposta,true);
?>