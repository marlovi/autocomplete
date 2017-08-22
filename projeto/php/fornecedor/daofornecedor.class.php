<?php  
	require_once 'fornecedor.class.php';
	require_once '../banco/banco.class.php';
  require_once 'resposta.class.php';
	class DaoFornecedor 
	{

		
		//private $serverName="localhost";
		//private $user="root";			// padrao do win tratar isso depois
		//private $password="";
		//private $dataBase="stenio";		// mudar esse nome depois
		
		public function save($fornecedor){
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
			$sql = "INSERT INTO `Fornecedor` (`nome`,`cpf`,`cnpj`,`endereco`,`cidade`,`estado`,`telefone`,`email`) VALUES (?,?,?,?,?,?,?,?)";

				$stament = $con->prepare($sql);

				$stament->bind_param('ssssssss' ,$nome, $cpf, $cnpj, $endereco, $cidade, $estado, $telefone, $email);
				$nome = $fornecedor->nome;
				$cpf = $fornecedor->cpf;
				$cnpj = $fornecedor->cnpj;
				$endereco = $fornecedor->endereco;
				$cidade = $fornecedor->cidade;
				$estado = $fornecedor->estado;
				$telefone = $fornecedor->telefone;
				$email = $fornecedor->email;

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


////////////////////////////////////////////////////////////////////////////////////////
public function buscar(){
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
				die("Problema na conexão ".$con->connect_error);
			}

$sql = "SELECT `id_fornecedor`, `nome`,`cpf`,`cnpj`,`endereco`,`cidade`,`estado`,`telefone`,`email` FROM `fornecedor` ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $resultado = array();
    while($row = $result->fetch_assoc()) {
    	$fornecedor = new Fornecedor();
       $fornecedor->id_fornecedor = $row['id_fornecedor'];
       $fornecedor->nome = $row['nome'];
       $fornecedor->cpf = $row['cpf'];
       $fornecedor->cnpj = $row['cnpj'];
       $fornecedor->endereco = $row['endereco'];
       // quando coloca endereco da treta
       $fornecedor->cidade = $row['cidade'];
       $fornecedor->estado = $row['estado'];
       $fornecedor->telefone = $row['telefone'];
       $fornecedor->email = $row['email'];
        

       array_push($resultado,$fornecedor);

    }
} else {
    echo "0 results";
}
$conn->close();


return $resultado;

	}



  	public function delete($fornecedor){
   		$verificador = false;
   			$banco = new Banco();
   		$teste = $banco->serverName;
   		
   		$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   		if ($con->connect_error) {
   			echo false;
    			  die("Connection failed: " . $conn->connect_error);
   		} 
   
   // sql to delete a record
   		$sql = "DELETE FROM `fornecedor` WHERE `id_fornecedor`= ".$fornecedor->id_fornecedor;
   
   		if ($con->query($sql) === TRUE) {
      			$verificador = true;
   		} else {
     			 echo "Error deleting record: " . $con->error;
   		}
   
   	$con->close();
   	return $verificador;
   	}

public function update($fornecedor){
   		$verificador = false;
   		//UPDATE `cliente` SET `id_cliente`=[value-1],`nome`=[value-2],`cpf`=[value-3],`cnpj`=[value-4],`endereco`=[value-5],`cidade`=[value-6],`estado`=[value-7],`telefone`=[value-8],`email`=[value-9] WHERE 1
   		$banco = new Banco();
   		$teste = $banco->serverName;
   		
   		$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   
   
   		if($con->connect_error){
   			$verificador = false;
   			die("Problema na conexão ".$con->connect_error);
   		}
   		$sql = "UPDATE `fornecedor` SET `nome`='".$fornecedor->nome."',`cpf`='".$fornecedor->cpf."',`cnpj`='".$fornecedor->cnpj."',`endereco`='".$fornecedor->endereco."',`cidade`='".$fornecedor->cidade."',`estado`='".$fornecedor->estado."',`telefone`='".$fornecedor->telefone."',`email`='".$fornecedor->email."' WHERE `id_fornecedor` = ".$fornecedor->id_fornecedor;
   		if ($con->query($sql) === TRUE) {
    				  //echo "Record updated successfully";
   				$verificador = true;
   		} else {
    				  echo "Error updating record: " . $con->error;
   		}
   
   			$con->close();
   		return $verificador;
   	}

    // função busca nome ajustada para a tela pesagem manual
    // existia um bug na busca se estivesse com a busca em minusculo
    // e no banco estiver salvo em maiusculo.
    // resolvido com a função strtoupper ela converte para maiusculo
    // o que foi buscado.
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

   $sql = "SELECT `nome`,`id_fornecedor`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `fornecedor` WHERE `nome` LIKE '".$nome."%' LIMIT 30";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$fornecedor = new Fornecedor();
         $fornecedor->id_fornecedor = $row['id_fornecedor'];
         $fornecedor->nome = $row['nome'];
         $fornecedor->cpf = $row['cpf'];
         $fornecedor->cnpj = $row['cnpj'];
         $fornecedor->endereco = $row['endereco'];
         $fornecedor->cidade = $row['cidade'];
         $fornecedor->estado = $row['estado'];
         $fornecedor->telefone = $row['telefone'];
         $fornecedor->email = $row['email'];

         array_push($resultado,$fornecedor);
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


public function buscarcpf($cpf){

   $resultado = null;
   		$verificador = true;
   		$banco = new Banco();
   $teste = $banco->serverName;
   
   		$conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   
   
   		if($conn->connect_error){
   			$verificador = false;
   			die("Problema na conexão ".$conn->connect_error);
   		}
   
   $sql = "SELECT `nome`,`id_fornecedor`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `fornecedor` WHERE `cpf` LIKE '".$cpf."%' LIMIT 30";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$fornecedor = new Fornecedor();
         $fornecedor->id_fornecedor = $row['id_fornecedor'];
         $fornecedor->nome = $row['nome'];
         $fornecedor->cpf = $row['cpf'];
         $fornecedor->cnpj = $row['cnpj'];
         $fornecedor->endereco = $row['endereco'];
         // quando coloca endereco da treta
         $fornecedor->cidade = $row['cidade'];
         $fornecedor->estado = $row['estado'];
         $fornecedor->telefone = $row['telefone'];
         $fornecedor->email = $row['email'];
          
          
   
         array_push($resultado,$fornecedor);
   
      }
   } else {
      echo "0 results";
   }
   $conn->close();
   
    
   return $resultado;
   
   }



   public function buscarcnpj($cnpj){
   $resultado = null;
   		$verificador = true;
   		$banco = new Banco();
   $teste = $banco->serverName;
   
   		$conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   
   
   		if($conn->connect_error){
   			$verificador = false;
   			die("Problema na conexão ".$conn->connect_error);
   		}
   
   $sql = "SELECT `nome`,`id_fornecedor`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `fornecedor` WHERE `cnpj` LIKE '".$cnpj."%' LIMIT 30";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$fornecedor = new Fornecedor();
         $fornecedor->id_fornecedor = $row['id_fornecedor'];
         $fornecedor->nome = $row['nome'];
         $fornecedor->cpf = $row['cpf'];
         $fornecedor->cnpj = $row['cnpj'];
         $fornecedor->endereco = $row['endereco'];
         // quando coloca endereco da treta
         $fornecedor->cidade = $row['cidade'];
         $fornecedor->estado = $row['estado'];
         $fornecedor->telefone = $row['telefone'];
         $fornecedor->email = $row['email'];
          
          
   
         array_push($resultado,$fornecedor);
   
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
   
   $sql = "SELECT `nome`,`id_fornecedor`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `fornecedor` WHERE `id_fornecedor` = ".$id;
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$fornecedor = new Fornecedor();
         $fornecedor->id_fornecedor = $row['id_fornecedor'];
         $fornecedor->nome = $row['nome'];
         $fornecedor->cpf = $row['cpf'];
         $fornecedor->cnpj = $row['cnpj'];
         $fornecedor->endereco = $row['endereco'];
         // quando coloca endereco da treta
         $fornecedor->cidade = $row['cidade'];
         $fornecedor->estado = $row['estado'];
         $fornecedor->telefone = $row['telefone'];
         $fornecedor->email = $row['email'];
          
         array_push($resultado,$fornecedor); 
   
       
   
      }
   } else {
      echo "0 results";
   }
   $conn->close();
   
   return $resultado;
   }

}

 
?>