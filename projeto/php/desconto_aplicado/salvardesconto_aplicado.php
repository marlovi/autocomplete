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

// TENTATIVA DE SALVAR A LISTA DE DESCONTOS APLICADO
		//   objetivo
		/* pegar a informação da posição zero da listaDescontosAplicado
e enviar para a função save_aplicado e  retornar com o id em que foi salvo

		  */
$listaDescontosAplicados = $request;
foreach ($listaDescontosAplicados as $key => $value) {
	# code...
$desconto_aplicado->preencher($listaDescontosAplicados);
$last_id = $dao->save_aplicado($desconto_aplicado);
$desconto_aplicado->id_desconto_aplicado = $last_id;

}
// FIM TENTATIVA SALVAR DESCOTNOS APLICADOS

/*  


 */

echo json_encode($desconto_aplicado,true);

?>