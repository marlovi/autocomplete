 <?php  
  
require_once "itens_desconto.class.php";
require_once 'daoitens_desconto.class.php';
  
		$dao = new DaoItens_desconto();
		$itens_desconto = new Itens_desconto();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);  
// lança o primeiro elemento da lista de descontos aplicados
// crirar foreach para rodar a lista toda
//$itens_desconto = new DaoItens_desconto();
//$itens_desconto->pesagem_id_pesagem = "466";
//$itens_desconto->desconto_id_desconto =  $request[0]->id_desconto; // ID DO NOME DO DESCONTO
//$itens_desconto->desconto_aplicado_id_desconto_aplicado = (string)$request[0]->id_desconto_aplicado; // tratamento para converter em string

//$last_id = $dao->save_itens($itens_desconto);
//$itens_desconto->id_itens_desconto = $last_id;

 

$listaItensDescontos = $request;
$resultado = array();

foreach ($listaItensDescontos as $key => $value) {
$itens_desconto = new DaoItens_desconto();
$itens_desconto->pesagem_id_pesagem = $listaItensDescontos[0]->pesagem_id_pesagem;
$itens_desconto->desconto_id_desconto =  $value->id_desconto;
$itens_desconto->desconto_aplicado_id_desconto_aplicado = (string)$value->id_desconto_aplicado;
$last_id = $dao->save_itens($itens_desconto);
 
$itens_desconto->id_itens_desconto = (string)$last_id; // colocando em uma lista os id itens salvos 
 
array_push($resultado,$itens_desconto);
}

echo json_encode($resultado,true);

?>