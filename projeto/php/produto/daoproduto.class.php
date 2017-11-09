<?php  
	require_once 'produto.class.php';
	require_once '../banco/banco.class.php';
  require_once 'resposta.class.php';
	class DaoProduto{
 
		public function save($produto){
			$verificador = true;
			$banco = new Banco();
			$teste = $banco->serverName;
      $produto->nome = strtoupper($produto->nome );
	 
			$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);



			if($con->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}
			try{
			$sql = "INSERT INTO `Produto` (`nome`) VALUES (?)";

				$stament = $con->prepare($sql);

				$stament->bind_param('s' ,$nome);
 
				$nome = $produto->nome;
 
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

$sql = "SELECT `id_produto`, `nome` FROM `produto` ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 
    // output data of each row
    $resultado = array();
    while($row = $result->fetch_assoc()) {
    	 $produto = new Produto();
       $produto->id_produto = $row['id_produto'];
       $produto->nome = $row['nome'];
 
       array_push($resultado,$produto);
 
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

$sql = "SELECT `id_produto`, `nome` FROM `produto` ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $resultado = array();
    while($row = $result->fetch_assoc()) {
    	$produto = new Produto();
       $produto->id_produto = $row['id_produto'];
       $produto->nome = $row['nome'];

       array_push($resultado,$produto);

    }

    $last_id = $produto->id_produto + 1;
} else {
    echo "0 results";
}
$conn->close();

return $last_id;

	}

	public function delete($produto){
   		$verificador = false;
   			$banco = new Banco();
   		$teste = $banco->serverName;
   		$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   		if ($con->connect_error) {
   			echo false;
    			  die("Connection failed: " . $conn->connect_error);
   		} 
   
   // sql to delete a record
   		$sql = "DELETE FROM `produto` WHERE `id_produto`= ".$produto->id_produto;
   
   		if ($con->query($sql) === TRUE) {
      			$verificador = true;
   		} else {
     			 echo "Error deleting record: " . $con->error;
   		}
   
   	$con->close();
   	return $verificador;
   	}


public function update($produto){
   		$verificador = false;

   		$banco = new Banco();
   		$teste = $banco->serverName;
   		
   		$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);

   		if($con->connect_error){
   			$verificador = false;
   			die("Problema na conexão ".$con->connect_error);
   		}
   		$sql = "UPDATE `produto` SET `nome`='".$produto->nome."' WHERE `id_produto` = ".$produto->id_produto;
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
   
   $sql = "SELECT `nome`,`id_produto`  FROM `produto` WHERE `nome` LIKE '".$nome."%' LIMIT 30";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$produto = new Produto();
         $produto->id_produto = $row['id_produto'];
         $produto->nome = $row['nome'];

         array_push($resultado,$produto);
   
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
   
   $sql = "SELECT `nome`,`id_produto`   FROM `produto` WHERE `id_produto` = ".$id;
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$produto = new Produto();
         $produto->id_produto = $row['id_produto'];
         $produto->nome = $row['nome'];
 
         array_push($resultado,$produto); 
      }
   } else {
      echo "0 results";
   }
   $conn->close();
   return $resultado;
   }

	}

?>