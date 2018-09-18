 <?php  
  
require_once "itens_desconto.class.php";
require_once 'daoitens_desconto.class.php';
  
		$dao = new DaoItens_desconto();
		$itens_desconto = new Itens_desconto();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);  

//$desconto_aplicado = new Desconto_aplicado();
$itens_desconto->preencher($request);
$last_id = $dao->save_itens($itens_desconto);
$itens_desconto->id_itens_desconto = $last_id;

echo json_encode($itens_desconto,true);

?>