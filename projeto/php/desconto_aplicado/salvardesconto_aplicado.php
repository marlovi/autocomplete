 <?php  
  
require_once "desconto_aplicado.class.php";
require_once 'daodesconto_aplicado.class.php';
  
		$dao = new DaoDesconto_aplicado();
		$desconto_aplicado = new Desconto_aplicado();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);  

//$desconto_aplicado = new Desconto_aplicado();
$desconto_aplicado->preencher($request);
$last_id = $dao->save_aplicado($desconto_aplicado);
$desconto_aplicado->id_desconto_aplicado = $last_id;

echo json_encode($desconto_aplicado,true);

?>