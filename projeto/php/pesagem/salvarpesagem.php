 <?php  
  
	require_once "pesagem.class.php";
	require_once 'daopesagem.class.php';
	require_once "consultapesagem.class.php";
 

	
		$dao = new DaoPesagem();
		$pesagem = new Pesagem();
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata); // separa o empresa do array que vem com a lista de veiculos


$objetoPesagem = new Pesagem();
$pesagem->preencher($request);
$last_id = $dao->save($pesagem);
$pesagem->id_pesagem = $last_id;

$objetoPesagem = new Pesagem();

$objetoPesagem = $dao->getPesagem($pesagem->id_pesagem);	
 


echo json_encode($objetoPesagem,true);


?>