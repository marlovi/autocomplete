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

// SERÁ QUE ESSE DADO SENDO COMO STRING DA RUIM NA BUSCA POR DATA?
				// ESSA FUNÇÃO SETA O BANCO DE DADOS PARA SAO PAULO
			date_default_timezone_set('America/Sao_Paulo');
			$pesagem->data = date('d/m/Y H:i:s', time());
			if($con->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}
			try{

			$sql = "INSERT INTO `Pesagem` (`status`,`placa`,`data`,`motorista`,`fornecedor_id_fornecedor`,`empresa_id_empresa`,`produto_id_produto`,`cliente_id_cliente`,`veiculo_id_veiculo`,`tipo_veiculo`,`peso_1`,`peso_2`,`peso_descontos`,`peso_liquido` ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

				$stament = $con->prepare($sql);

				$stament->bind_param('isssiiiissiiii' ,$status, $placa ,$data, $motorista ,$fornecedor_id_fornecedor, $empresa_id_empresa ,$produto_id_produto, $cliente_id_cliente ,$veiculo_id_veiculo, $tipo_veiculo ,$peso_1, $peso_2 ,$peso_descontos, $peso_liquido);
				 

				$status = $pesagem->status;
				$placa = $pesagem->placa;
				$data = $pesagem->data;
				$motorista = $pesagem->motorista;
				$fornecedor_id_fornecedor = $pesagem->fornecedor_id_fornecedor;
				$empresa_id_empresa = $pesagem->empresa_id_empresa;
				$produto_id_produto = $pesagem->produto_id_produto;
				$cliente_id_cliente = $pesagem->cliente_id_cliente;
				$veiculo_id_veiculo = $pesagem->veiculo_id_veiculo;
				$tipo_veiculo = $pesagem->tipo_veiculo;
				$peso_1 = $pesagem->peso_1;
				$peso_2 = $pesagem->peso_2;
				$peso_descontos = $pesagem->peso_descontos;
				$peso_liquido = $pesagem->peso_liquido;

				 

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