<?php  
	require_once 'pesagem.class.php';
	require_once '../banco/banco.class.php';
    require_once 'resposta.class.php';
 
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
			//date_default_timezone_set('America/Sao_Paulo');
			//$pesagem->data = date('d/m/Y H:i:s', time());
			if($con->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}
			try{

			$sql = "INSERT INTO `Pesagem` (`status`,`data`,`motorista`,`fornecedor_id_fornecedor`,`empresa_id_empresa`,`produto_id_produto`,`cliente_id_cliente`,`veiculo_id_veiculo`,`tipo_veiculo`,`peso_1`,`peso_2`,`peso_descontos`,`peso_liquido` ) VALUES (?,now(),?,?,?,?,?,?,?,?,?,?,?)";

				$stament = $con->prepare($sql);

				$stament->bind_param('isiiiissiiii' ,$status, $motorista ,$fornecedor_id_fornecedor, $empresa_id_empresa ,$produto_id_produto, $cliente_id_cliente ,$veiculo_id_veiculo, $tipo_veiculo ,$peso_1, $peso_2 ,$peso_descontos, $peso_liquido);
				 

				$status = $pesagem->status;
				 
				//$data = $pesagem->data;
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


public function getPesagem($id_pesagem){

$banco = new Banco();
   $teste = $banco->serverName;
         
         
         $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);

         if($conn->connect_error){
            $verificador = false;
            die("Problema na conexão ".$conn->connect_error);
         }
// preciso de buscar as informações da propria tabela pesagem
   $sql = "SELECT p.`data`, p.`status`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro` WHERE p.`id_pesagem` = ".$id_pesagem." AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor` AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`";
 
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
         $consultaPesagem = new ConsultaPesagem();  // tem que criar essa class ainda.

         $consultaPesagem->data = $row['data'];
         if($row['status'] = 3){
         	$consultaPesagem->status = "PESAGEM MANUAL";
         }

         $consultaPesagem->id_pesagem = $row['id_pesagem'];
         $consultaPesagem->peso_1 = $row['peso_1'];
         $consultaPesagem->peso_2 = $row['peso_2'];
         $consultaPesagem->peso_descontos = $row['peso_descontos'];
         $consultaPesagem->peso_liquido = $row['peso_liquido'];
         $consultaPesagem->cliente = $row['cliente'];
         if($row['cpf_cliente'] != null){
         	$consultaPesagem->cpf_cnpj_cliente = $row['cpf_cliente'];
         }
         if($row['cnpj_cliente'] != null){
         	$consultaPesagem->cpf_cnpj_cliente = $row['cnpj_cliente'];
         }
         $consultaPesagem->fornecedor = $row['fornecedor'];

         if($row['cpf_fornecedor'] != null){
         	$consultaPesagem->cpf_cnpj_fornecedor = $row['cpf_fornecedor'];
         }
         if($row['cnpj_fornecedor'] != null){
         	$consultaPesagem->cpf_cnpj_fornecedor = $row['cnpj_fornecedor'];
         }
 
         $consultaPesagem->placa = $row['placa'];
         $consultaPesagem->produto = $row['produto'];
         $consultaPesagem->cod_prod = $row['cod_prod'];
  
         array_push($resultado,$consultaPesagem);
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