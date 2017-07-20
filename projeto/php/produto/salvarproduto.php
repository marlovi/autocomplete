 <?php  
  
	require_once "produto.class.php";
	require_once 'daoproduto.class.php';
	require_once '../veiculo/daoveiculo.class.php';  
		$dao = new DaoProduto();
		$produto = new Produto();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata); // separa o empresa do array que vem com a lista de veiculos


$produto = new Produto();
$produto->preencher($request);
$last_id = $dao->save($produto);
$produto->id_produto = $last_id;


echo json_encode($produto,true);


?>