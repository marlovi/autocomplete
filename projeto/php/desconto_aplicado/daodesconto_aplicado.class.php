<?php  
	require_once 'desconto_aplicado.class.php';
	require_once '../banco/banco.class.php';
  require_once 'resposta.class.php';
	class DaoDesconto_aplicado{

  public function buscarid_aplicado_saida($id){
    //var_dump("caralho: ",$id);
          $resultado = null;
          $id2 = $id;
         // var_dump($id2);
          $verificador = true;
          $banco = new Banco();
          $teste = $banco->serverName;
          $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
          if($conn->connect_error){
            $verificador = false;
            die("Problema na conexão ".$conn->connect_error);
          }

  $sql = "SELECT `classificado`, `percentual`, `absoluto`, `peso_descontado`   FROM `desconto_aplicado` WHERE `id_desconto_aplicado` = 194";

       $result = $conn->query($sql);
         if ($result->num_rows > 0) {
            $resultado = array();
            while($row = $result->fetch_assoc()) {
                   $desconto_aplicado = new Desconto_aplicado();
                   $desconto_aplicado->classificado = $row['classificado'];
                   $desconto_aplicado->percentual = $row['percentual'];
                   $desconto_aplicado->absoluto = $row['absoluto'];
                   $desconto_aplicado->peso_descontado = $row['peso_descontado'];
                   array_push($resultado,$desconto_aplicado);
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

  public function buscarid_aplicado($id){
          $resultado = null;
          $id2 = $id->id_desconto_aplicado;
          $verificador = true;
          $banco = new Banco();
          $teste = $banco->serverName;
          $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
          if($conn->connect_error){
            $verificador = false;
            die("Problema na conexão ".$conn->connect_error);
          }

  $sql = "SELECT `id_desconto_aplicado`, `classificado`, `percentual`, `absoluto`, `peso_descontado`   FROM `desconto_aplicado` WHERE `id_desconto_aplicado` = ".$id2;
       $result = $conn->query($sql);
         if ($result->num_rows > 0) {
            $resultado = array();
            while($row = $result->fetch_assoc()) {
                   $desconto_aplicado = new Desconto_aplicado();
                   $desconto_aplicado->id_desconto_aplicado = $row['id_desconto_aplicado'];
                   $desconto_aplicado->classificado = $row['classificado'];
                   $desconto_aplicado->percentual = $row['percentual'];
                   $desconto_aplicado->absoluto = $row['absoluto'];
                   $desconto_aplicado->peso_descontado = $row['peso_descontado'];
                   array_push($resultado,$desconto_aplicado);
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


  public function update_aplicado($desconto_aplicado){
      $verificador = false;
      $banco = new Banco();
      $teste = $banco->serverName;
      $con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
          if($con->connect_error){
            $verificador = false;
            die("Problema na conexão ".$con->connect_error);
          }
  $sql = "UPDATE `desconto_aplicado` SET `classificado`='".$desconto_aplicado->classificado."', `percentual`='".$desconto_aplicado->percentual."', `absoluto`='".$desconto_aplicado->absoluto."', `peso_descontado`='".$desconto_aplicado->peso_descontado."' WHERE `id_desconto` = ".$desconto_aplicado->id_desconto_aplicado;
          if ($con->query($sql) === TRUE) {
              $verificador = true;
          } else {
                  echo "Error updating record: " . $con->error;
          }
          $con->close();
          return $verificador;
  }
   

  public function buscarultimo_aplicado(){
                $resultado = null;
                $verificador = true;
                $banco = new Banco();
                $teste = $banco->serverName;
                $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
                if($conn->connect_error){
                  $verificador = false;
                  die("Problema na conexão ".$con->connect_error);
                }
    $sql = "SELECT `id_desconto_aplicado`, `classificado`, `percentual`, `absoluto`, `peso_descontado` FROM `desconto_aplicado` ";
    $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              $resultado = array();
              while($row = $result->fetch_assoc()) {
                 $desconto_aplicado = new desconto_aplicado();
                 $desconto_aplicado->id_desconto_aplicado = $row['id_desconto_aplicado'];
                 $desconto_aplicado->classificado = $row['classificado'];
                 $desconto_aplicado->percentual = $row['percentual'];
                 $desconto_aplicado->absoluto = $row['absoluto'];
                 $desconto_aplicado->peso_descontado = $row['peso_descontado'];
                 array_push($resultado,$desconto_aplicado);
              }
          $last_id = $desconto_aplicado->id_desconto_aplicado;// mostra o ultimo id cadastrado
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

  public function delete_aplicado($desconto_aplicado){
              $verificador = false;
              $banco = new Banco();
              $teste = $banco->serverName;
              $con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
              if ($con->connect_error) {
                echo false;
                    die("Connection failed: " . $conn->connect_error);
              } 
              $sql = "DELETE FROM `desconto_aplicado` WHERE `id_desconto_aplicado`= ".$desconto_aplicado->id_desconto_aplicado;
           
              if ($con->query($sql) === TRUE) {
                    $verificador = true;
              } else {
                   echo "Error deleting record: " . $con->error;
              }
            $con->close();
            return $verificador;
  }

		public function save_aplicado($desconto_aplicado){
			$verificador = true;
			$banco = new Banco();
			$teste = $banco->serverName;

			$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);



			if($con->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}
			try{
       
			$sql = "INSERT INTO `Desconto_aplicado` (`classificado`, `percentual`, `absoluto`, `peso_descontado`) VALUES (?,?,?,?)";

				$stament = $con->prepare($sql);

				$stament->bind_param('ssss' ,$classificado ,$percentual ,$absoluto ,$peso_descontado);
 
				$classificado = $desconto_aplicado->classificado;
        $percentual = $desconto_aplicado->percentual;
        $absoluto = $desconto_aplicado->absoluto;
        $peso_descontado = $desconto_aplicado->peso_descontado;
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

    /*
  public function buscar(){
          $resultado = null;
          $verificador = true;
          $banco = new Banco();
          $teste = $banco->serverName;
          $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
      if($conn->connect_error){
      $verificador = false;
      die("Problema na conexão ".$conn->connect_error);
      }
$sql = "SELECT `id_desconto`, `nome` FROM `desconto` ";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          $resultado = array();
          while($row = $result->fetch_assoc()) {
          	 $desconto = new Desconto();
             $desconto->id_desconto = $row['id_desconto'];
             $desconto->nome = $row['nome'];
             array_push($resultado,$desconto);
          }
      } else {
          echo "0 results";
      }
      $conn->close();
      return $resultado;
	}
   */
	}

?>