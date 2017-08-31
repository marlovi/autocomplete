<?php 

	require_once 'veiculo.class.php';
	require_once '../banco/banco.class.php';
	//RETIREI ESSA SOLICITAÇÃO PORQUE QUANDO 
	//SOLICITAVA CADASTRO DE NOVOS CLIENTES / FORNECCEDORES OU
	// PRODUTOS RETORNAVA O ERRO
	/*  
	
	<br />
<b>Fatal error</b>:  Cannot redeclare class Resposta in <b>C:\xampp\htdocs\autocomplete\projeto\php\veiculo\resposta.class.php</b> on line <b>3</b><br />



	 */
	//require_once 'resposta.class.php';
	class DaoVeiculo
	{
		//private $serverName="localhost";
		//private $user="root";			// padrao do win tratar isso depois
		//private $password="";
		//private $dataBase="stenio";		// mudar esse nome depois
		
		public function delete($veiculo){
			$banco = new Banco();
			$teste = $banco->serverName;
			
			$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
			if($con->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}
			$sql = "DELETE FROM `veiculo` WHERE `id_veiculo` =  ".$veiculo->id_veiculo;;
			if ($con->query($sql) === TRUE) {
  				  //echo "Record updated successfully";
					$verificador = true;
			} else {
  				  echo "Error updating record: " . $conn->error;
			}

				$con->close();
			return $verificador;

		}

		public function update($veiculo){
			$verificador = false;
			//UPDATE `cliente` SET `id_cliente`=[value-1],`nome`=[value-2],`cpf`=[value-3],`cnpj`=[value-4],`endereco`=[value-5],`cidade`=[value-6],`estado`=[value-7],`telefone`=[value-8],`email`=[value-9] WHERE 1
			$banco = new Banco();
			$teste = $banco->serverName;
			
			$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);


			if($con->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}
			$sql = "UPDATE `veiculo` SET `placa`='".$veiculo->placa."',`descricao`='".$veiculo->descricao."',`tipo`='".$veiculo->tipo."' WHERE `id_veiculo` =  ".$veiculo->id_veiculo;
			if ($con->query($sql) === TRUE) {
  				  //echo "Record updated successfully";
					$verificador = true;
			} else {
  				  echo "Error updating record: " . $conn->error;
			}

				$con->close();
			return $verificador;
		}


		public function save($veiculo){
			$verificador = true;
// tentando organizar
$banco = new Banco();
$teste = $banco->serverName;

			//$con = new mysqli($banco->serverName,$this->user,$this->password,$this->dataBase);
			$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);

			if($con->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}
			try{
			$sql = "INSERT INTO `Veiculo` (`placa`,`descricao`,`tipo`,`fornecedor_id_fornecedor`,`cliente_id_cliente`,`empresa_id_empresa` ) VALUES (?,?,?,?,?,?)";

				$stament = $con->prepare($sql);

				$stament->bind_param('ssssss' ,$placa,$descricao,$tipo,$fornecedor_id_fornecedor, $cliente_id_cliente, $empresa_id_empresa );
				 
 
		$placa 				= $veiculo->placa;
		$descricao 			= $veiculo->descricao;
 		$tipo 				= $veiculo->tipo;
	
		$fornecedor_id_fornecedor = $veiculo->fornecedor_id_fornecedor;
		$cliente_id_cliente = $veiculo->cliente_id_cliente;
		$empresa_id_empresa = $veiculo->empresa_id_empresa;

				 

				$stament->execute();
			}catch(Exception $e){
				$verificador = false;
				die("".$e->getMessage());
			}	
			$stament->close();
			$con->close();
			return $verificador;
		}


////////////////////////////////////////////////////////////////////////////////////////
public function buscar(){
	$resultado = null;
			$verificador = true;
			$banco = new Banco();
			$teste = $banco->serverName;
			$con = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
			if($conn->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}

$sql = "SELECT `id_veiculo`, `placa`,`descricao`,`tipo`,`fornecedor`,`cliente` FROM `veiculo` ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $resultado = array();
    while($row = $result->fetch_assoc()) {
    	$veiculo = new Veiculo();
       $veiculo->id_veiculo = $row['id_veiculo'];
       $veiculo->placa = $row['placa'];
       $veiculo->descricao = $row['descricao'];
       $veiculo->tipo = $row['tipo'];
      
       // quando coloca endereco da treta
       $veiculo->fornecedor = $row['fornecedor'];
       $veiculo->cliente = $row['cliente'];
       $veiculo->empresa = $row['empresa'];

       array_push($resultado,$veiculo);

    }
} else {
    echo "0 results";
}
$conn->close();
return $resultado;
	}

// tentativa 1

public function buscarporidcliente($id_cliente){
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

$sql = "SELECT `id_veiculo`, `placa`, `descricao`, `tipo`,  `fornecedor_id_fornecedor`, `cliente_id_cliente`, `empresa_id_empresa` FROM `veiculo` WHERE `cliente_id_cliente` =  ".$id_cliente;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $resultado = array();
    while($row = $result->fetch_assoc()) {
    	$veiculo = new Veiculo();
       $veiculo->id_veiculo = $row['id_veiculo'];
       $veiculo->placa = $row['placa'];
       $veiculo->descricao = $row['descricao'];
       $veiculo->tipo = $row['tipo'];
       
       // quando coloca endereco da treta
       $veiculo->fornecedor_id_fornecedor = $row['fornecedor_id_fornecedor'];
       $veiculo->cliente_id_cliente = $row['cliente_id_cliente'];
	    $veiculo->empresa_id_empresa = $row['empresa_id_empresa'];

       array_push($resultado,$veiculo);

    }
} else {
    echo null;
}
$conn->close();


return $resultado;

	}

public function buscarporidempresa($id_empresa){
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

$sql = "SELECT `id_veiculo`, `placa`, `descricao`, `tipo`,  `fornecedor_id_fornecedor`, `cliente_id_cliente`, `empresa_id_empresa` FROM `veiculo` WHERE `empresa_id_empresa` =  ".$id_empresa;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $resultado = array();
    while($row = $result->fetch_assoc()) {
    	$veiculo = new Veiculo();
       $veiculo->id_veiculo = $row['id_veiculo'];
       $veiculo->placa = $row['placa'];
       $veiculo->descricao = $row['descricao'];
       $veiculo->tipo = $row['tipo'];
       
       // quando coloca endereco da treta
       $veiculo->fornecedor_id_fornecedor = $row['fornecedor_id_fornecedor'];
       $veiculo->cliente_id_cliente = $row['cliente_id_cliente'];
	    $veiculo->empresa_id_empresa = $row['empresa_id_empresa'];

       array_push($resultado,$veiculo);

    }
} else {
    echo null;
}
$conn->close();


return $resultado;

	}

public function buscarporidfornecedor($id_fornecedor){
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

$sql = "SELECT `id_veiculo`, `placa`, `descricao`, `tipo`,  `fornecedor_id_fornecedor`, `cliente_id_cliente`, `empresa_id_empresa` FROM `veiculo` WHERE `fornecedor_id_fornecedor` =  ".$id_fornecedor;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $resultado = array();
    while($row = $result->fetch_assoc()) {
    	$veiculo = new Veiculo();
       $veiculo->id_veiculo = $row['id_veiculo'];
       $veiculo->placa = $row['placa'];
       $veiculo->descricao = $row['descricao'];
       $veiculo->tipo = $row['tipo'];
     
       // quando coloca endereco da treta
       $veiculo->fornecedor_id_fornecedor = $row['fornecedor_id_fornecedor'];
       $veiculo->cliente_id_cliente = $row['cliente_id_cliente'];
	    $veiculo->empresa_id_empresa = $row['empresa_id_empresa'];

       array_push($resultado,$veiculo);

    }
} else {
    echo null;
}
$conn->close();


return $resultado;

	}


 
 public function buscarplaca($placa){
   $resultado = null;
         $verificador = true;
         $banco = new Banco();
   $teste = $banco->serverName;
         /*
         https://www.w3schools.com/php/php_mysql_insert.asp
         */
        // $placa = strtoupper($placa);
         $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);

         if($conn->connect_error){
            $verificador = false;
            die("Problema na conexão ".$conn->connect_error);
         }
$sql = "SELECT `id_veiculo`, `placa`, `descricao`, `tipo`,  `fornecedor_id_fornecedor`, `cliente_id_cliente`, `empresa_id_empresa` FROM `veiculo` WHERE `placa` LIKE '".$placa."%' LIMIT 30";
//WHERE `nome` LIKE '".$nome."%' LIMIT 30";
$result = $conn->query($sql);
 

if ($result->num_rows > 0) {
    // output data of each row
    $resultado = array();
    while($row = $result->fetch_assoc()) {
    	$veiculo = new Veiculo();
       $veiculo->id_veiculo = $row['id_veiculo'];
       $veiculo->placa = $row['placa'];
       $veiculo->descricao = $row['descricao'];
       $veiculo->tipo = $row['tipo'];
     
       // quando coloca endereco da treta
       $veiculo->fornecedor_id_fornecedor = $row['fornecedor_id_fornecedor'];
       $veiculo->cliente_id_cliente = $row['cliente_id_cliente'];
	    $veiculo->empresa_id_empresa = $row['empresa_id_empresa'];

       array_push($resultado,$veiculo);

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