   	<?php 
	require_once 'pesagem.class.php';
	require_once 'consultapesagem.class.php';
	require_once '../banco/banco.class.php';
  	require_once 'resposta_pesagem.class.php';
  	
	$banco = new Banco();
   	$teste = $banco->serverName;
         $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
         if($conn->connect_error){
            $verificador = false;
            die("Problema na conexão ".$conn->connect_error);
         }
        // buscar todos registros de entrada
        // fazer uma lista com todos id de entrada
         // com essa lista de id testar nos registros de saida.
        // testar se o numero de vezes que o id  registrado na entrada tem a mesma quantidade na saida.

// buscar todos registros de entrada
$tipo_operacao = 0;
// resumido em id pesagem id veiculo e placa ordenando por id crescente
$sqlEntrada = "SELECT  p.`status` , p.`id_pesagem`,p.`veiculo_id_veiculo`, v.`placa`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v` WHERE p.`status` = 0  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` ORDER BY `p`.`id_pesagem` ASC";
// fazer uma lista com todos id de entrada
    $resultEntrada = $conn->query($sqlEntrada);
   if ($resultEntrada->num_rows > 0) {
      // output data of each row
      $resultado = array();
      // criei o objeto  com o resultado da busca por entrada
      while($row = $resultEntrada->fetch_assoc()) {
         $consultaPesagem = new ConsultaPesagem();  
      
         if($row['status'] == 0){
          $consultaPesagem->status = "ENTRADA";
         }
         if($row['status'] == 1){
          $consultaPesagem->status = "SAIDA";
         }
       
         $consultaPesagem->id_pesagem = $row['id_pesagem'];
         $consultaPesagem->placa = $row['placa'];
         $consultaPesagem->id_veiculo = $row['veiculo_id_veiculo'];

         array_push($resultado,$consultaPesagem);
      }

var_dump($resultado );
      

   }









  	?>