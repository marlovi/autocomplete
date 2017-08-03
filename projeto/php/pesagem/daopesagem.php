<?php  
	require_once 'pesagem.class.php';
	require_once '../banco/banco.class.php';
	class DaoPesagem{

	public function save($pesagem){
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
			$sql = "INSERT INTO `Pesagem` (`status`,`placa`,`data`,`motorista`,`fornecedor_id_fornecedor`,`empresa_id_empresa`,`produto_id_produto`,`cliente_id_cliente`,`veiculo_id_veiculo`,`tipo_veiculo`,`peso_1`,`peso_2`,`peso_descontos`,`peso_liquido` ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

				$stament = $con->prepare($sql);

				$stament->bind_param('iss' ,$status, $placa ,$data, $motorista ,$fornecedor_id_fornecedor, $empresa_id_empresa ,$produto_id_produto, $cliente_id_cliente ,$veiculo_id_veiculo, $tipo_veiculo ,$peso_1, $peso_2 ,$peso_descontos, $peso_liquido);
				 

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










}

 
?>