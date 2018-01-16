<?php  
	require_once 'pesagem.class.php';
	require_once '../banco/banco.class.php';
  require_once 'resposta_pesagem.class.php';
 
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
			 
			if($con->connect_error){
				$verificador = false;
				die("Problema na conexão ".$con->connect_error);
			}
			try{

			$sql = "INSERT INTO `Pesagem` (`status`,`data`,`motorista`,`fornecedor_id_fornecedor`,`empresa_id_empresa`,`produto_id_produto`,`cliente_id_cliente`,`veiculo_id_veiculo`,`tipo_veiculo`,`peso_1`,`peso_2`,`peso_descontos`,`peso_liquido`,`observacao` ) VALUES (?,now(),?,?,?,?,?,?,?,?,?,?,?,?)";

				$stament = $con->prepare($sql);

				$stament->bind_param('isiiiissiiiis' ,$status, $motorista ,$fornecedor_id_fornecedor, $empresa_id_empresa ,$produto_id_produto, $cliente_id_cliente ,$veiculo_id_veiculo, $tipo_veiculo ,$peso_1, $peso_2 ,$peso_descontos, $peso_liquido, $observacao);
				 

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
				$observacao = $pesagem->observacao;

				 

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
   $sql = "SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro` WHERE p.`id_pesagem` = ".$id_pesagem." AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor` AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`";
 
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
         $consultaPesagem = new ConsultaPesagem();  // tem que criar essa class ainda.


         $consultaPesagem->data = $row['data'];
         //$consultaPesagem->data = date_format(p.`data`, 'd/m/Y H:i:s'); 
          
         if($row['status'] == 3){
         	$consultaPesagem->status = "PESAGEM MANUAL";
         }
         if($row['status'] == 1){
          $consultaPesagem->status = "PESAGEM ENTRADA";
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
         $consultaPesagem->motorista = $row['motorista'];
         $consultaPesagem->observacao = $row['observacao'];
  
         array_push($resultado,$consultaPesagem);
      }

   } else {
     $r = new Resposta_pesagem();
     // padronizado retorno vazio
     // se 0 não encontrado o registro
     $r->status=0;
      $resultado = $r;
   }
   $conn->close();
   
   
   return $resultado;

}
   

// INICIO CONSULTA PESAGEM POR PLACA


public function consultaPesagemPlaca($id_placa){
// pretendo consultar  se existe pesagem com essa placa
// se sim retornar qual id da pesagem
// qual o tipo de pesagem "manual"
// qual a placa 
// se nao retornar status = 0;
	$banco = new Banco();
   	$teste = $banco->serverName;
	$conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
	         if($conn->connect_error){
	            $verificador = false;
	            die("Problema na conexão ".$conn->connect_error);
	         }
   $sql = "SELECT v.`placa`, p.`status` ,  p.`id_pesagem` ,  p.`veiculo_id_veiculo`  FROM `pesagem` as `p`, `veiculo` as `v` WHERE p.`veiculo_id_veiculo` = ".$id_placa." AND v.`id_veiculo` = p.`veiculo_id_veiculo`";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      $resultado = array();
      while($row = $result->fetch_assoc()) {
         $consultaPesagem = new ConsultaPesagem();  // tem que criar essa class ainda.
         if($row['status'] = 3){
         	$consultaPesagem->status = "PESAGEM MANUAL";
         }
         $consultaPesagem->id_pesagem = $row['id_pesagem'];
         $consultaPesagem->placa = $row['placa'];
            $consultaPesagem->id_veiculo = $row['veiculo_id_veiculo'];
         array_push($resultado,$consultaPesagem);
      }
   } else {
     $r = new Resposta_pesagem();
     $r->status=0; // se a placa tiver pesagem
      $resultado = $r;
   }
   $conn->close();
   return $resultado;
}

// FIM CONSULTA PESAGEM POR PLACA

// CONSULTA SE O ID CLIENTE TEM ALGUMA PESAGEM

public function consultaPesagemCliente($id_placa){
// pretendo consultar  se existe pesagem com essa placa
// se sim retornar qual id da pesagem
// qual o tipo de pesagem "manual"
// qual a placa 
// se nao retornar status = 0;
  $banco = new Banco();
    $teste = $banco->serverName;
  $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
           if($conn->connect_error){
              $verificador = false;
              die("Problema na conexão ".$conn->connect_error);
           }
   $sql = "SELECT p.`status` ,  p.`id_pesagem` , p.`cliente_id_cliente`   FROM `pesagem` as `p`, `cliente` as `c` WHERE p.`cliente_id_cliente` = ".$id_placa." AND c.`id_cliente` = p.`cliente_id_cliente`";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      $resultado = array();
      while($row = $result->fetch_assoc()) {
         $consultaPesagem = new ConsultaPesagem();  // tem que criar essa class ainda.
         if($row['status'] = 3){
          $consultaPesagem->status = "PESAGEM MANUAL";
         }
         $consultaPesagem->id_pesagem = $row['id_pesagem'];
        $consultaPesagem->id_cliente = $row['cliente_id_cliente'];
         array_push($resultado,$consultaPesagem);
      }
   } else {
     $r = new Resposta_pesagem();
     $r->status=0;  // se o cliente nao tiver pesagem
      $resultado = $r;
   }
   $conn->close();
   return $resultado;
}

// FIM CONSULTA ID CLIENTE
////////////////


public function consultaPesagemFornecedor($id_placa){
    $banco = new Banco();
    $teste = $banco->serverName;
    $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
           if($conn->connect_error){
              $verificador = false;
              die("Problema na conexão ".$conn->connect_error);
           }
   $sql = "SELECT p.`status` ,  p.`id_pesagem` , p.`fornecedor_id_fornecedor`   FROM `pesagem` as `p`, `fornecedor` as `c` WHERE p.`fornecedor_id_fornecedor` = ".$id_placa." AND c.`id_fornecedor` = p.`fornecedor_id_fornecedor`";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      $resultado = array();
      while($row = $result->fetch_assoc()) {
         $consultaPesagem = new ConsultaPesagem();  // tem que criar essa class ainda.
         if($row['status'] = 3){
          $consultaPesagem->status = "PESAGEM MANUAL";
         }
         $consultaPesagem->id_pesagem = $row['id_pesagem'];
        $consultaPesagem->id_fornecedor = $row['fornecedor_id_fornecedor'];
         array_push($resultado,$consultaPesagem);
      }
   } else {
     $r = new Resposta_pesagem();
     $r->status=0;  // se o cliente nao tiver pesagem
      $resultado = $r;
   }
   $conn->close();
   return $resultado;
}


//////////////

///////////// CONSULTA PESAGEM PRODUTO /////////////////////////////

public function consultaPesagemProduto($id_pro){

// se nao retornar status = 0;
  $banco = new Banco();
    $teste = $banco->serverName;
  $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
           if($conn->connect_error){
              $verificador = false;
              die("Problema na conexão ".$conn->connect_error);
           }
   $sql = "SELECT p.`status` ,  p.`id_pesagem` , p.`produto_id_produto`   FROM `pesagem` as `p`, `produto` as `pro` WHERE p.`produto_id_produto` = ".$id_pro." AND pro.`id_produto` = p.`produto_id_produto`";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      $resultado = array();
      while($row = $result->fetch_assoc()) {
         $consultaPesagem = new ConsultaPesagem();  // tem que criar essa class ainda.
         if($row['status'] = 3){
          $consultaPesagem->status = "PESAGEM MANUAL";
         }
         $consultaPesagem->id_pesagem = $row['id_pesagem'];
       // $consultaPesagem->id_produto = $row['produto_id_produto'];
         array_push($resultado,$consultaPesagem);
      }
   } else {
     $r = new Resposta_pesagem();
     $r->status=0;  // se o cliente nao tiver pesagem
      $resultado = $r;
   }
   $conn->close();
   return $resultado;
}







/////////////FIM CONSULTA PESAGEM PRODUTO /////////////////////////////

 
}

 
?>