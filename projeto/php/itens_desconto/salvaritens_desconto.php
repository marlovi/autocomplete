 <?php  
  
require_once "itens_desconto.class.php";
require_once 'daoitens_desconto.class.php';
  
		$dao = new DaoItens_desconto();
		$itens_desconto = new Itens_desconto();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);  

$itens_desconto = new DaoItens_desconto();
//$itens_desconto->preencher($request[0]);

$itens_desconto->pesagem_id_pesagem = "466";
$itens_desconto->desconto_id_desconto =  $request[0]->id_desconto; // ID DO NOME DO DESCONTO
$itens_desconto->desconto_aplicado_id_desconto_aplicado = (string)$request[0]->id_desconto_aplicado;// ID DO DESCONTO APLICADO clas,% ...


$last_id = $dao->save_itens($itens_desconto);
$itens_desconto->id_itens_desconto = $last_id;

echo json_encode($last_id,true);

?>