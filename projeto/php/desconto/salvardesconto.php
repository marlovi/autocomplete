 <?php  
  
	require_once "desconto.class.php";
	require_once 'daodesconto.class.php';
  
		$dao = new DaoDesconto();
		$desconto = new Desconto();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata); // separa o empresa do array que vem com a lista de veiculos


$desconto = new Desconto();
$desconto->preencher($request);
$last_id = $dao->save($desconto);
$desconto->id_desconto = $last_id;


echo json_encode($desconto,true);


?>