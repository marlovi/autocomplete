<?php  
	require_once 'desconto.class.php';
	require_once '../banco/banco.class.php';
  require_once 'resposta.class.php';
	class DaoDesconto{


    
public function buscarnomedesconto_saida_impressao($id_desc_pesquisa){
  //var_dump($id_desc_pesquisa);
   $resultado = null;
      $verificador = true;
      $banco = new Banco();
   $teste = $banco->serverName;
     //$id_int = intval($id_desc_pesquisa); // converte string em int
   $id_int = $id_desc_pesquisa;

      $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
 
      if($conn->connect_error){
        $verificador = false;
        die("Problema na conexão ".$conn->connect_error);
      }
   
   $sql = "SELECT `nome` FROM `desconto` WHERE `id_desconto` = $id_int ";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
        $desconto = new Desconto();
         $desconto->nome = $row['nome'];
        // $desconto->id_desconto = $row['id_desconto'];

         array_push($resultado,$desconto);
   
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

public function buscarnomedesconto_saida($nome){
   $resultado = null;
      $verificador = true;
      $banco = new Banco();
   $teste = $banco->serverName;

      $nome = strtoupper($nome);
      $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
 
      if($conn->connect_error){
        $verificador = false;
        die("Problema na conexão ".$conn->connect_error);
      }
   
 


   $sql = "SELECT `nome`,`id_desconto`  FROM `desconto` WHERE `nome` LIKE '".$nome."%' LIMIT 30";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
        $desconto = new Desconto();
         $desconto->id_desconto = $row['id_desconto'];
         $desconto->nome = $row['nome'];

         array_push($resultado,$desconto);
   
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



 
		public function save($desconto){
			$verificador = true;
			$banco = new Banco();
			$teste = $banco->serverName;
      $desconto->nome = strtoupper($desconto->nome );
	 
			$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);



			if($con->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}
			try{
			$sql = "INSERT INTO `Desconto` (`nome`) VALUES (?)";

				$stament = $con->prepare($sql);

				$stament->bind_param('s' ,$nome);
 
				$nome = $desconto->nome;
 
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
 
    // output data of each row
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

public function buscarultimo(){
	$resultado = null;
			$verificador = true;
			$banco = new Banco();
			$teste = $banco->serverName;

			$conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);

			if($conn->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}

$sql = "SELECT `id_desconto`, `nome` FROM `desconto` ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $resultado = array();
    while($row = $result->fetch_assoc()) {
    	 $desconto = new desconto();
       $desconto->id_desconto = $row['id_desconto'];
       $desconto->nome = $row['nome'];

       array_push($resultado,$desconto);

    }

    $last_id = $desconto->id_desconto + 1;
} else {
    echo "0 results";
}
$conn->close();

return $last_id;

	}

	public function delete($desconto){
   		$verificador = false;
   			$banco = new Banco();
   		$teste = $banco->serverName;
   		$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   		if ($con->connect_error) {
   			echo false;
    			  die("Connection failed: " . $conn->connect_error);
   		} 
   
   // sql to delete a record
   		$sql = "DELETE FROM `desconto` WHERE `id_desconto`= ".$desconto->id_desconto;
   
   		if ($con->query($sql) === TRUE) {
      			$verificador = true;
   		} else {
     			 echo "Error deleting record: " . $con->error;
   		}
   
   	$con->close();
   	return $verificador;
   	}


public function update($desconto){
   		$verificador = false;

   		$banco = new Banco();
   		$teste = $banco->serverName;
   		
   		$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);

   		if($con->connect_error){
   			$verificador = false;
   			die("Problema na conexão ".$con->connect_error);
   		}
   		$sql = "UPDATE `desconto` SET `nome`='".$desconto->nome."' WHERE `id_desconto` = ".$desconto->id_desconto;
   		if ($con->query($sql) === TRUE) {
    				  //echo "Record updated successfully";
   				$verificador = true;
   		} else {
    				  echo "Error updating record: " . $con->error;
   		}
   
   			$con->close();
   		return $verificador;
   	}
   
  
   public function buscarnome($nome){
   $resultado = null;
   		$verificador = true;
   		$banco = new Banco();
   $teste = $banco->serverName;

      $nome = strtoupper($nome);
   		$conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
 
   		if($conn->connect_error){
   			$verificador = false;
   			die("Problema na conexão ".$conn->connect_error);
   		}
   
   $sql = "SELECT `nome`,`id_desconto`  FROM `desconto` WHERE `nome` LIKE '".$nome."%' LIMIT 30";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$desconto = new Desconto();
         $desconto->id_desconto = $row['id_desconto'];
         $desconto->nome = $row['nome'];

         array_push($resultado,$desconto);
   
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
   
    
   public function buscarid($id){
   $resultado = null;
   		$verificador = true;
   		$banco = new Banco();
      $teste = $banco->serverName;
   		$conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);

   		if($conn->connect_error){
   			$verificador = false;
   			die("Problema na conexão ".$conn->connect_error);
   		}
   
   $sql = "SELECT `nome`,`id_desconto`   FROM `desconto` WHERE `id_desconto` = ".$id;
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      // output data of each row
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

	}

?>