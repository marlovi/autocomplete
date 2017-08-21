 <?php  
   require_once 'cliente.class.php';
   require_once '../banco/banco.class.php';
   require_once 'resposta.class.php';
   
   class DaoCliente 
   {
   	
   	//private $serverName="localhost";
   	//private $user="root";			// padrao do win tratar isso depois
   	//private $password="";
   	//private $dataBase="stenio";		// mudar esse nome depois

 
   	public function save($cliente){
   		$verificador = true;
   		$banco = new Banco();
   		$teste = $banco->serverName;
   		/*
   		https://www.w3schools.com/php/php_mysql_insert.asp
   		*/
   		$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   
   
   		if($con->connect_error){
   			$verificador = false;
   			die("Problema na conexão ".$con->connect_error);
   		}
   		try{
   		$sql = "INSERT INTO `Cliente` (`nome`,`cpf`,`cnpj`,`endereco`,`cidade`,`estado`,`telefone`,`email`) VALUES (?,?,?,?,?,?,?,?)";
   
   			$stament = $con->prepare($sql);
   
   			$stament->bind_param('ssssssss' ,$nome, $cpf, $cnpj, $endereco, $cidade, $estado, $telefone, $email);
   			$nome = $cliente->nome;
   			$cpf = $cliente->cpf;
   			$cnpj = $cliente->cnpj;
   			$endereco = $cliente->endereco;
   			$cidade = $cliente->cidade;
   			$estado = $cliente->estado;
   			$telefone = $cliente->telefone;
   			$email = $cliente->email;
   
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

   $sql = "SELECT `nome`,`id_cliente`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `cliente` WHERE `nome` LIKE '".$nome."%' LIMIT 30";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
         $cliente = new Cliente();
         $cliente->id_cliente = $row['id_cliente'];
         $cliente->nome = $row['nome'];
         $cliente->cpf = $row['cpf'];
         $cliente->cnpj = $row['cnpj'];
         $cliente->endereco = $row['endereco'];
         $cliente->cidade = $row['cidade'];
         $cliente->estado = $row['estado'];
         $cliente->telefone = $row['telefone'];
         $cliente->email = $row['email'];
  
         array_push($resultado,$cliente);
   
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
   			die("Problema na conexão ".$conn->connect_error);
   		}
   
   $sql = "SELECT `id_cliente`, `nome`,`cpf`,`cnpj`,`endereco`,`cidade`,`estado`,`telefone`,`email` FROM `cliente` ";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$cliente = new Cliente();
         $cliente->id_cliente = $row['id_cliente'];
         $cliente->nome = $row['nome'];
         $cliente->cpf = $row['cpf'];
         $cliente->cnpj = $row['cnpj'];
         $cliente->endereco = $row['endereco'];
         // quando coloca endereco da treta
         $cliente->cidade = $row['cidade'];
         $cliente->estado = $row['estado'];
         $cliente->telefone = $row['telefone'];
         $cliente->email = $row['email'];
          
   
         array_push($resultado,$cliente);
   
      }
   }else {
     $r = new Resposta();
     $r->status="vazio";
      $resultado = $r;
   } 

   $conn->close();

   return $resultado;
   
   }
   
  	public function delete($cliente){
   		$verificador = false;
   			$banco = new Banco();
   		$teste = $banco->serverName;
   		
   		$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   		if ($con->connect_error) {
   			echo false;
    			  die("Connection failed: " . $conn->connect_error);
   		} 
   
   // sql to delete a record
   		$sql = "DELETE FROM `cliente` WHERE `id_cliente`= ".$cliente->id_cliente;
   
   		if ($con->query($sql) === TRUE) {
      			$verificador = true;
   		} else {
     			 echo "Error deleting record: " . $con->error;
   		}
   
   	$con->close();
   	return $verificador;
   	}


















   
   
   
   
   
   	/*
   	*Método que recebe um cliente como parâmetro, e atualiza todos os campos ao mesmo tempo. 
   	*
   	**/
   	public function update($cliente){
   		$verificador = false;
   		//UPDATE `cliente` SET `id_cliente`=[value-1],`nome`=[value-2],`cpf`=[value-3],`cnpj`=[value-4],`endereco`=[value-5],`cidade`=[value-6],`estado`=[value-7],`telefone`=[value-8],`email`=[value-9] WHERE 1
   		$banco = new Banco();
   		$teste = $banco->serverName;
   		
   		$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
   
   
   		if($con->connect_error){
   			$verificador = false;
   			die("Problema na conexão ".$con->connect_error);
   		}
   		$sql = "UPDATE `cliente` SET `nome`='".$cliente->nome."',`cpf`='".$cliente->cpf."',`cnpj`='".$cliente->cnpj."',`endereco`='".$cliente->endereco."',`cidade`='".$cliente->cidade."',`estado`='".$cliente->estado."',`telefone`='".$cliente->telefone."',`email`='".$cliente->email."' WHERE `id_cliente` = ".$cliente->id_cliente;
   		if ($con->query($sql) === TRUE) {
    				  //echo "Record updated successfully";
   				$verificador = true;
   		} else {
    				  echo "Error updating record: " . $con->error;
   		}
   
   			$con->close();
   		return $verificador;
   	}
   
  
   
   ////////////////////////////////////////////////////////////////////////////////////////
  
   
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
   
   $sql = "SELECT `nome`,`id_cliente`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `cliente` WHERE `cpf` LIKE '".$cpf."%' LIMIT 30";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$cliente = new Cliente();
         $cliente->id_cliente = $row['id_cliente'];
         $cliente->nome = $row['nome'];
         $cliente->cpf = $row['cpf'];
         $cliente->cnpj = $row['cnpj'];
         $cliente->endereco = $row['endereco'];
         // quando coloca endereco da treta
         $cliente->cidade = $row['cidade'];
         $cliente->estado = $row['estado'];
         $cliente->telefone = $row['telefone'];
         $cliente->email = $row['email'];
          
          
   
         array_push($resultado,$cliente);
   
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
   
   $sql = "SELECT `nome`,`id_cliente`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `cliente` WHERE `cnpj` LIKE '".$cnpj."%' LIMIT 30";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$cliente = new Cliente();
         $cliente->id_cliente = $row['id_cliente'];
         $cliente->nome = $row['nome'];
         $cliente->cpf = $row['cpf'];
         $cliente->cnpj = $row['cnpj'];
         $cliente->endereco = $row['endereco'];
         // quando coloca endereco da treta
         $cliente->cidade = $row['cidade'];
         $cliente->estado = $row['estado'];
         $cliente->telefone = $row['telefone'];
         $cliente->email = $row['email'];
          
          
   
         array_push($resultado,$cliente);
   
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
   
   $sql = "SELECT `nome`,`id_cliente`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `cliente` WHERE `id_cliente` = ".$id;
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
      	$cliente = new Cliente();
         $cliente->id_cliente = $row['id_cliente'];
         $cliente->nome = $row['nome'];
         $cliente->cpf = $row['cpf'];
         $cliente->cnpj = $row['cnpj'];
         $cliente->endereco = $row['endereco'];
         // quando coloca endereco da treta
         $cliente->cidade = $row['cidade'];
         $cliente->estado = $row['estado'];
         $cliente->telefone = $row['telefone'];
         $cliente->email = $row['email'];
          
         array_push($resultado,$cliente); 
   
       
   
      }
   } else {
      echo "0 results";
   }
   $conn->close();
   
   return $resultado;
   }

   }
   


    
   ?>