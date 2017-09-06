<?php  
	require_once 'empresa.class.php';
	require_once '../banco/banco.class.php';
  require_once 'resposta.class.php';

	class DaoEmpresa 
	{
		
		//private $serverName="localhost";
		//private $user="root";			// padrao do win tratar isso depois
		//private $password="";
		//private $dataBase="stenio";		// mudar esse nome depois
		
		public function save($empresa){
			$verificador = true;
			$banco = new Banco();
			$teste = $banco->serverName;
      // TESTANDO SE ENTRA MAISCULO NO NOME
      $empresa->nome = strtoupper($empresa->nome );
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
			$sql = "INSERT INTO `Empresa` (`nome`,`cpf`,`cnpj`,`endereco`,`cidade`,`estado`,`telefone`,`email`) VALUES (?,?,?,?,?,?,?,?)";

				$stament = $con->prepare($sql);

				$stament->bind_param('ssssssss' ,$nome, $cpf, $cnpj, $endereco, $cidade, $estado, $telefone, $email);
				$nome = $empresa->nome;
				$cpf = $empresa->cpf;
				$cnpj = $empresa->cnpj;
				$endereco = $empresa->endereco;
				$cidade = $empresa->cidade;
				$estado = $empresa->estado;
				$telefone = $empresa->telefone;
				$email = $empresa->email;

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
			$conn = new mysqli($this->serverName,$this->user,$this->password,$this->dataBase);


			if($conn->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}

$sql = "SELECT `id_empresa`, `nome`,`cpf`,`cnpj`,`endereco`,`cidade`,`estado`,`telefone`,`email` FROM `empresa` ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $resultado = array();
    while($row = $result->fetch_assoc()) {
    	$empresa = new Empresa();
       $empresa->id_empresa = $row['id_empresa'];
       $empresa->nome = $row['nome'];
       $empresa->cpf = $row['cpf'];
       $empresa->cnpj = $row['cnpj'];
       $empresa->endereco = $row['endereco'];
       // quando coloca endereco da treta
       $empresa->cidade = $row['cidade'];
       $empresa->estado = $row['estado'];
       $empresa->telefone = $row['telefone'];
       $empresa->email = $row['email'];
        

       array_push($resultado,$empresa);

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

	public function delete($empresa){
   		$verificador = false;
   			$banco = new Banco();
   		$teste = $banco->serverName;
   		
   		$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   		if ($con->connect_error) {
   			echo false;
    			  die("Connection failed: " . $conn->connect_error);
   		} 
   
   // sql to delete a record
   		$sql = "DELETE FROM `empresa` WHERE `id_empresa`= ".$empresa->id_empresa;
   
   		if ($con->query($sql) === TRUE) {
      			$verificador = true;
   		} else {
     			 echo "Error deleting record: " . $con->error;
   		}
   
   	$con->close();
   	return $verificador;
   	}


	public function update($empresa){
   		$verificador = false;
   		//UPDATE `cliente` SET `id_cliente`=[value-1],`nome`=[value-2],`cpf`=[value-3],`cnpj`=[value-4],`endereco`=[value-5],`cidade`=[value-6],`estado`=[value-7],`telefone`=[value-8],`email`=[value-9] WHERE 1
   		$banco = new Banco();
   		$teste = $banco->serverName;
   		
   		$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   
   
   		if($con->connect_error){
   			$verificador = false;
   			die("Problema na conexão ".$con->connect_error);
   		}
   		$sql = "UPDATE `empresa` SET `nome`='".$empresa->nome."',`cpf`='".$empresa->cpf."',`cnpj`='".$empresa->cnpj."',`endereco`='".$empresa->endereco."',`cidade`='".$empresa->cidade."',`estado`='".$empresa->estado."',`telefone`='".$empresa->telefone."',`email`='".$empresa->email."' WHERE `id_empresa` = ".$empresa->id_empresa;
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
      $nome = strtoupper($nome);
   		$conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   
   
   		if($conn->connect_error){
   			$verificador = false;
   			die("Problema na conexão ".$conn->connect_error);
   		}
 
   
   $sql = "SELECT `nome`,`id_empresa`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `empresa` WHERE `nome` LIKE '".$nome."%' LIMIT 30";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$empresa = new Empresa();
         $empresa->id_empresa = $row['id_empresa'];
         $empresa->nome = $row['nome'];
         $empresa->cpf = $row['cpf'];
         $empresa->cnpj = $row['cnpj'];
         $empresa->endereco = $row['endereco'];
         $empresa->cidade = $row['cidade'];
         $empresa->estado = $row['estado'];
         $empresa->telefone = $row['telefone'];
         $empresa->email = $row['email'];
          
          
   
         array_push($resultado,$empresa);
   
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
    
   $sql = "SELECT `nome`,`id_empresa`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `empresa` WHERE `cpf` LIKE '".$cpf."%' LIMIT 30";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$empresa = new Empresa();
         $empresa->id_empresa = $row['id_empresa'];
         $empresa->nome = $row['nome'];
         $empresa->cpf = $row['cpf'];
         $empresa->cnpj = $row['cnpj'];
         $empresa->endereco = $row['endereco'];
         // quando coloca endereco da treta
         $empresa->cidade = $row['cidade'];
         $empresa->estado = $row['estado'];
         $empresa->telefone = $row['telefone'];
         $empresa->email = $row['email'];
          
          
           
         array_push($resultado,$empresa);
   
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
   
   $sql = "SELECT `nome`,`id_empresa`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `empresa` WHERE `cnpj` LIKE '".$cnpj."%' LIMIT 30";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$empresa = new Empresa();
         $empresa->id_empresa = $row['id_empresa'];
         $empresa->nome = $row['nome'];
         $empresa->cpf = $row['cpf'];
         $empresa->cnpj = $row['cnpj'];
         $empresa->endereco = $row['endereco'];
         // quando coloca endereco da treta
         $empresa->cidade = $row['cidade'];
         $empresa->estado = $row['estado'];
         $empresa->telefone = $row['telefone'];
         $empresa->email = $row['email'];
          
          
   
         array_push($resultado,$empresa);
   
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
   
   $sql = "SELECT `nome`,`id_empresa`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `empresa` WHERE `id_empresa` = ".$id;
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$empresa = new Empresa();
         $empresa->id_empresa = $row['id_empresa'];
         $empresa->nome = $row['nome'];
         $empresa->cpf = $row['cpf'];
         $empresa->cnpj = $row['cnpj'];
         $empresa->endereco = $row['endereco'];
         // quando coloca endereco da treta
         $empresa->cidade = $row['cidade'];
         $empresa->estado = $row['estado'];
         $empresa->telefone = $row['telefone'];
         $empresa->email = $row['email'];
          
         array_push($resultado,$empresa); 
   
       
   
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

}

 
?>