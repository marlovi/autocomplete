 <?php  
  
require_once "desconto_aplicado.class.php";
require_once 'daodesconto_aplicado.class.php';
  
		$dao = new DaoDesconto_aplicado();
		$desconto_aplicado = new Desconto_aplicado();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);  

//$desconto_aplicado = new Desconto_aplicado();
//$desconto_aplicado->preencher($request);
//$last_id = $dao->save_aplicado($desconto_aplicado);
//$desconto_aplicado->id_desconto_aplicado = $last_id;
// AQUI RODA UM UNICO SIMULADO NA PAGINA

$listaDescontosAplicados = $request;
$resultado = array();

foreach ($listaDescontosAplicados as $key => $value) {
$desconto_aplicado = new Desconto_aplicado();
$desconto_aplicado->preencher($value);
$last_id = $dao->save_aplicado($desconto_aplicado);
$desconto_aplicado->id_desconto_aplicado = $last_id;
$desconto_aplicado->id_desconto = $value->id_desconto;
array_push($resultado,$desconto_aplicado);
}
// FIM TENTATIVA SALVAR DESCOTNOS APLICADOS

/*  


 */

echo json_encode($resultado,true);

?>