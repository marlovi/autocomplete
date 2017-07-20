<?php  
	require_once 'produto.class.php';
	require_once '../banco/banco.class.php';
	class DaoProduto
	{
		
		//private $serverName="localhost";
		//private $user="root";			// padrao do win tratar isso depois
		//private $password="";
		//private $dataBase="stenio";		// mudar esse nome depois
		
		public function save($produto){
			$verificador = true;
			$banco = new Banco();
			$teste = $banco->serverName;
			/*
			https://www.w3schools.com/php/php_mysql_insert.asp
			*/
			//$con = new mysqli($this->serverName,$this->user,$this->password,$this->dataBase);
			$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);



			if($con->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}
			try{
			$sql = "INSERT INTO `Produto` (`nome`,`codigo`) VALUES (?,?)";

				$stament = $con->prepare($sql);

				$stament->bind_param('si' ,$nome, $codigo);
				 

				$nome = $produto->nome;
				$codigo = $produto->codigo;

				 

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
			/*
			https://www.w3schools.com/php/php_mysql_insert.asp
			*/
			//$con = new mysqli($this->serverName,$this->user,$this->password,$this->dataBase);
			$conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
			/*
			https://www.w3schools.com/php/php_mysql_insert.asp
			*/
			//$conn = new mysqli($this->serverName,$this->user,$this->password,$this->dataBase);


			if($conn->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}

$sql = "SELECT `id_produto`, `nome`,`codigo` FROM `produto` ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {


    // output data of each row
    $resultado = array();
    while($row = $result->fetch_assoc()) {
    	 $produto = new Produto();
       $produto->id_produto = $row['id_produto'];
       $produto->nome = $row['nome'];
       $produto->codigo = $row['codigo'];
       
        

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
			/*
			https://www.w3schools.com/php/php_mysql_insert.asp
			*/
			//$con = new mysqli($this->serverName,$this->user,$this->password,$this->dataBase);
			$conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
			/*
			https://www.w3schools.com/php/php_mysql_insert.asp
			*/
			//$conn = new mysqli($this->serverName,$this->user,$this->password,$this->dataBase);


			if($conn->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}

$sql = "SELECT `id_produto`, `nome`,`codigo` FROM `produto` ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $resultado = array();
    while($row = $result->fetch_assoc()) {
    	$produto = new Produto();
       $produto->id_produto = $row['id_produto'];
       $produto->nome = $row['nome'];
       $produto->codigo = $row['codigo'];
       
        

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
   		//UPDATE `cliente` SET `id_cliente`=[value-1],`nome`=[value-2],`cpf`=[value-3],`cnpj`=[value-4],`endereco`=[value-5],`cidade`=[value-6],`estado`=[value-7],`telefone`=[value-8],`email`=[value-9] WHERE 1
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
   		/*
   		https://www.w3schools.com/php/php_mysql_insert.asp
   		*/
   		$conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   
   
   		if($conn->connect_error){
   			$verificador = false;
   			die("Problema na conexão ".$conn->connect_error);
   		}
   
   
   
   
   
   $sql = "SELECT `nome`,`id_produto`,`codigo`  FROM `produto` WHERE `nome` LIKE '".$nome."%' LIMIT 30";
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