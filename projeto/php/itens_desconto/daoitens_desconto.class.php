<?php  
	require_once 'itens_desconto.class.php';
	require_once '../banco/banco.class.php';
  require_once 'resposta.class.php';
	class DaoItens_desconto{

  public function buscarid_itens_desconto($id){
          $resultado = null;
          $id2 = $id->id_itens_desconto;
          $verificador = true;
          $banco = new Banco();
          $teste = $banco->serverName;
          $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
          if($conn->connect_error){
            $verificador = false;
            die("Problema na conexão ".$conn->connect_error);
          }
// editar
  $sql = "SELECT `id_itens_desconto`, `pesagem_id_pesagem`, `desconto_id_desconto`, `desconto_aplicado_id_desconto_aplicado` FROM `itens_desconto ` WHERE `id_itens_desconto` = ".$id2;
       $result = $conn->query($sql);
         if ($result->num_rows > 0) {
            $resultado = array();
            while($row = $result->fetch_assoc()) {
                   $itens_desconto = new Itens_desconto();
                   $itens_desconto->id_itens_desconto = $row['id_itens_desconto'];
                   $itens_desconto->pesagem_id_pesagem = $row['pesagem_id_pesagem'];
                   $itens_desconto->desconto_id_desconto = $row['desconto_id_desconto'];
                   $itens_desconto->desconto_aplicado_id_desconto_aplicado = $row['desconto_aplicado_id_desconto_aplicado'];
                   array_push($resultado,$itens_desconto);
                }
         } else {
          $r = new Resposta();
           // padronizado retorno vazio
           // se 0 não encontrado o registro
           $r->status=0;
            $resultado = $r;
         }
       $conn->close();
       return $resultado;
  }


  public function update_itens($itens_desconto){
      $verificador = false;
      $banco = new Banco();
      $teste = $banco->serverName;
      $con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
          if($con->connect_error){
            $verificador = false;
            die("Problema na conexão ".$con->connect_error);
          }


  $sql = "UPDATE `itens_desconto` SET `pesagem_id_pesagem`='".$itens_desconto->pesagem_id_pesagem."', `desconto_id_desconto`='".$itens_desconto->desconto_id_desconto."', `desconto_aplicado_id_desconto_aplicado`='".$itens_desconto->desconto_aplicado_id_desconto_aplicado."', WHERE `itens_desconto` = ".$itens_desconto->id_itens_desconto;
          if ($con->query($sql) === TRUE) {
              $verificador = true;
          } else {
                  echo "Error updating record: " . $con->error;
          }
          $con->close();
          return $verificador;
  }
   

  public function buscarultimo_itens(){
                $resultado = null;
                $verificador = true;
                $banco = new Banco();
                $teste = $banco->serverName;
                $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
                if($conn->connect_error){
                  $verificador = false;
                  die("Problema na conexão ".$con->connect_error);
                }


    $sql = "SELECT `id_itens_desconto`, `pesagem_id_pesagem`, `desconto_id_desconto`, `desconto_aplicado_id_desconto_aplicado` FROM `itens_desconto` ";

    $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              $resultado = array();
              while($row = $result->fetch_assoc()) {
                 $itens_desconto = new Itens_desconto();
                 $itens_desconto->id_itens_desconto = $row['id_itens_desconto'];
                 $itens_desconto->pesagem_id_pesagem = $row['pesagem_id_pesagem'];
                 $itens_desconto->desconto_id_desconto = $row['desconto_id_desconto'];
                 $itens_desconto->desconto_aplicado_id_desconto_aplicado = $row['desconto_aplicado_id_desconto_aplicado'];
                 
                 array_push($resultado,$itens_desconto);
              }
          $last_id = $itens_desconto->id_itens_desconto;// mostra o ultimo id cadastrado
          } else {
               $r = new Resposta();
           // padronizado retorno vazio
           // se 0 não encontrado o registro
           $r->status=0;
            $resultado = $r;
          }
          $conn->close();
          return $last_id;
  }


  public function delete_itens($itens_desconto){
              $verificador = false;
              $banco = new Banco();
              $teste = $banco->serverName;
              $con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
              if ($con->connect_error) {
                echo false;
                    die("Connection failed: " . $conn->connect_error);
              } 
              $sql = "DELETE FROM `itens_desconto` WHERE `id_itens_desconto`= ".$itens_desconto->id_itens_desconto;
           
              if ($con->query($sql) === TRUE) {
                    $verificador = true;
              } else {
                   echo "Error deleting record: " . $con->error;
              }
            $con->close();
            return $verificador;
  }



		public function save_itens($itens_desconto){
			$verificador = true;
			$banco = new Banco();
			$teste = $banco->serverName;
			$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);

			if($con->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}
			try{
       
			$sql = "INSERT INTO `itens_desconto` (`pesagem_id_pesagem`, `desconto_id_desconto`, `desconto_aplicado_id_desconto_aplicado`) VALUES (?,?,?)";

				$stament = $con->prepare($sql);

				$stament->bind_param('sss' ,$pesagem_id_pesagem ,$desconto_id_desconto ,$desconto_aplicado_id_desconto_aplicado );
 
				$pesagem_id_pesagem = $itens_desconto->pesagem_id_pesagem;
        $desconto_id_desconto = $itens_desconto->desconto_id_desconto;
        $desconto_aplicado_id_desconto_aplicado = $itens_desconto->desconto_aplicado_id_desconto_aplicado;
 
				$stament->execute();

			}catch(Exception $e){
        $verificador = false;
        die("".$e->getMessage());
      } 
      // aqui estou buscando o ultimo id cadastrado para add 
      // o veiculo nesse cadastro.
        $last_id = 0;
      $last_id = $con->insert_id;
      $stament->close();
      $con->close();
      //return $verificador;
      return $last_id;
    }

	}

?>