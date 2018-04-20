<?php  
	require_once 'pesagem.class.php';
	require_once '../banco/banco.class.php';
  require_once 'resposta_pesagem.class.php';

	class DaoPesagem{
//////////////////////////////////////// pesquisa pesagem por tipo de entrada
public function consultaPesagemIf($operacao){
  // testando existencia de cada parametro e se está vazio
  $resultado = 0;
// fim teste existencia parametros onde  vazio é considerado como nao existente.
  // se existe entrada E true                           recebe 1 FAMILIA 
  // se existe saida   E true                           recebe 2 FAMILIA
  // se existe entrada e saida E os 2 true              recebe 3 FAMILIA
 
//OK se existe entrada E true                                     recebe 1 
//OK se existe entrada e fornecedor                               recebe 12   
//OK se existe entrada e fornecedor e cliente                     recebe 13 
//OK se existe entrada e fornecedor e cliente e produto           recebe 14 
//OK se existe entrada e fornecedor e cliente e produto e placa   recebe 15 
//OK se existe entrada e fornecedor e cliente e placa             recebe 16 

//OK se existe entrada e fornecedor e produto                     recebe 17 
//OK se existe entrada e fornecedor e produto e placa             recebe 18 
//OK se existe entrada e fornecedor e placa                       recebe 19 

//OK se existe entrada e cliente                                  recebe 110  
//OK se existe entrada e cliente e produto                        recebe 111  
//OK se existe entrada e cliente e produto e placa                recebe 112  
//OK se existe entrada e cliente e placa                          recebe 113  

//OK se existe entrada e produto                                  recebe 114  
//OK se existe entrada e produto e placa                          recebe 115  
//OK se existe entrada e placa                                    recebe 116 

//OK se existe saida E true                                     recebe 2
//OK se existe saida e fornecedor                               recebe 22   
//OK se existe saida e fornecedor e cliente                     recebe 23 
//OK se existe saida e fornecedor e cliente e produto           recebe 24 
//OK se existe saida e fornecedor e cliente e produto e placa   recebe 25
//OK se existe saida e fornecedor e cliente e placa             recebe 26 

//OK se existe saida e fornecedor e produto                     recebe 27 
//OK se existe saida e fornecedor e produto e placa             recebe 28 
//OK se existe saida e fornecedor e placa                       recebe 29 

//OK se existe saida e cliente                                  recebe 210  
//OK se existe saida e cliente e produto                        recebe 211  
//OK se existe saida e cliente e produto e placa                recebe 212  
//OK se existe saida e cliente e placa                          recebe 213  

//OK se existe saida e produto                                  recebe 214  
//OK se existe saida e produto e placa                          recebe 215  
//OK se existe saida e placa                                    recebe 216

//OK se existe entrada e saida E true                                     recebe 3
//OK se existe entrada e saida e fornecedor                               recebe 32   
//OK se existe entrada e saida e fornecedor e cliente                     recebe 33 
//OK se existe entrada e saida e fornecedor e cliente e produto           recebe 34 
//OK se existe entrada e saida e fornecedor e cliente e produto e placa   recebe 35
//OK se existe entrada e saida e fornecedor e cliente e placa             recebe 36 

//OK se existe entrada e saida e fornecedor e produto                     recebe 37 
//OK se existe entrada e saida e fornecedor e produto e placa             recebe 38 
//OK se existe entrada e saida e fornecedor e placa                       recebe 39 

//OK se existe entrada e saida e cliente                                  recebe 310  
//OK se existe entrada e saida e cliente e produto                        recebe 311  
//OK se existe entrada e saida e cliente e produto e placa                recebe 312  
//OK se existe entrada e saida e cliente e placa                          recebe 313  

//OK se existe entrada e saida e produto                                  recebe 314  
//OK se existe entrada e saida e produto e placa                          recebe 315  
//OK se existe entrada e saida e placa                                    recebe 316

//OK se existe entrada e ticket                           recebe   considerando que ser  estiver fazio nao vale 
//OK se existe saida e ticket                             recebe   considerando que ser  estiver fazio nao vale 
//OK se existe entrada e saida e ticket                   recebe   considerando que ser  estiver fazio nao vale 

// se existe entrada E true
if(isset($operacao->entrada) === true && $operacao->entrada === true){ 
  $resultado =1;
  // se existe entrada e fornecedor
  if(isset($operacao->fornecedor) === true && $operacao->fornecedor!=""){
    $resultado =12;
    // se existe entrada e fornecedor e cliente
    if(isset($operacao->cliente) === true && $operacao->cliente!=""){
      $resultado =13;
      // se existe entrada e fornecedor e cliente e produto 
      if(isset($operacao->produto) === true && $operacao->produto!=""){
        $resultado =14;
        // se existe entrada e fornecedor e cliente e produto e placa
        if(isset($operacao->placa) === true && $operacao->placa!=""){
          $resultado =15;
        }
      } else {
              // se existe entrada e fornecedor e cliente e placa 
              if(isset($operacao->placa) === true && $operacao->placa!=""){
                $resultado =16;
              }
            }
    } else {
      // se existe entrada e fornecedor e produto
      if(isset($operacao->produto) === true && $operacao->produto!=""){
        $resultado =17;
        // se existe entrada e fornecedor e produto e placa
        if(isset($operacao->placa) === true && $operacao->placa!=""){
          $resultado =18;
        }
      } else {
              // se existe entrada e fornecedor e placa
              if(isset($operacao->placa) === true && $operacao->placa!=""){
                $resultado =19;
              }
            }
          }  
  }
  // se existe entrada e cliente e nao existe consulta a fornecedor
  if(isset($operacao->cliente) === true && $operacao->cliente!="" ){
    if(isset($operacao->fornecedor) == false || $operacao->fornecedor==""){
      $resultado =110;
        // se existe entrada e cliente e produto
        if(isset($operacao->produto) === true && $operacao->produto!=""){
          $resultado =111;
          // se existe entrada e cliente e produto e placa
          if(isset($operacao->placa) === true && $operacao->placa!=""){
            $resultado =112;
          } 
        } else {
                // se existe entrada e cliente e placa  
                if(isset($operacao->placa) === true && $operacao->placa!=""){
                  $resultado =113;
                }
              }
    }
  }
      // se existe entrada e produto  e nao existe consulta a fornecedor e nao existe consulta cliente
      if(isset($operacao->fornecedor) == false || $operacao->fornecedor==""){
      if(isset($operacao->cliente) == false || $operacao->cliente==""){
        if(isset($operacao->produto) === true && $operacao->produto!="" ){
            $resultado =114;
              // se existe entrada e produto e placa
              if(isset($operacao->placa) === true && $operacao->placa!=""){
                $resultado =115;
              } 
        } else {
                // se existe entrada e placa
                if(isset($operacao->placa) === true && $operacao->placa!=""){
                  $resultado =116;
                } 
              }
        }
      }
} // final saida
//////////////////////////////////////////////////
// inicio saida
// se existe saida E true
if(isset($operacao->saida) === true && $operacao->saida === true){ 
  $resultado =2;
  // se existe saida e fornecedor
  if(isset($operacao->fornecedor) === true && $operacao->fornecedor!=""){
    $resultado =22;
    // se existe saida e fornecedor e cliente
    if(isset($operacao->cliente) === true && $operacao->cliente!=""){
      $resultado =23;
      // se existe saida e fornecedor e cliente e produto 
      if(isset($operacao->produto) === true && $operacao->produto!=""){
        $resultado =24;
        // se existe saida e fornecedor e cliente e produto e placa
        if(isset($operacao->placa) === true && $operacao->placa!=""){
          $resultado =25;
        }
      } else {
              // se existe saida e fornecedor e cliente e placa 
              if(isset($operacao->placa) === true && $operacao->placa!=""){
                $resultado =26;
              }
            }
    } else {
      // se existe saida e fornecedor e produto
      if(isset($operacao->produto) === true && $operacao->produto!=""){
        $resultado =27;
        // se existe saida e fornecedor e produto e placa
        if(isset($operacao->placa) === true && $operacao->placa!=""){
          $resultado =28;
        }
      } else {
              // se existe saida e fornecedor e placa
              if(isset($operacao->placa) === true && $operacao->placa!=""){
                $resultado =29;
              }
            }
          }  
  }
  // se existe saida e cliente e nao existe consulta a fornecedor
  if(isset($operacao->cliente) === true && $operacao->cliente!="" ){
    if(isset($operacao->fornecedor) == false || $operacao->fornecedor==""){
      $resultado =210;
        // se existe saida e cliente e produto
        if(isset($operacao->produto) === true && $operacao->produto!=""){
          $resultado =211;
          // se existe saida e cliente e produto e placa
          if(isset($operacao->placa) === true && $operacao->placa!=""){
            $resultado =212;
          } 
        } else {
                // se existe saida e cliente e placa  
                if(isset($operacao->placa) === true && $operacao->placa!=""){
                  $resultado =213;
                }
              }
    }
  }
      // se existe saida e produto  e nao existe consulta a fornecedor e nao existe consulta cliente
      if(isset($operacao->fornecedor) == false || $operacao->fornecedor==""){
      if(isset($operacao->cliente) == false || $operacao->cliente==""){
        if(isset($operacao->produto) === true && $operacao->produto!="" ){
            $resultado =214;
              // se existe saida e produto e placa
              if(isset($operacao->placa) === true && $operacao->placa!=""){
                $resultado =215;
              } 
        } else {
                 // se existe saida e placa
                if(isset($operacao->placa) === true && $operacao->placa!=""){
                  $resultado =216;
                } 
              }
        }
      }
}

// final saida
// inicio teste entrada e saida
if(isset($operacao->saida) === true && $operacao->saida === true && isset($operacao->entrada) === true && $operacao->entrada === true){ 
  $resultado =3;
  // se existe entrada e said e fornecedor
  if(isset($operacao->fornecedor) === true && $operacao->fornecedor!=""){
    $resultado =32;
    // se existe entrada e said e fornecedor e cliente
    if(isset($operacao->cliente) === true && $operacao->cliente!=""){
      $resultado =33;
      // se existe entrada e said e fornecedor e cliente e produto 
      if(isset($operacao->produto) === true && $operacao->produto!=""){
        $resultado =34;
        // se existe entrada e said e fornecedor e cliente e produto e placa
        if(isset($operacao->placa) === true && $operacao->placa!=""){
          $resultado =35;
        }
      } else {
              // se existe entrada e said e fornecedor e cliente e placa 
              if(isset($operacao->placa) === true && $operacao->placa!=""){
                $resultado =36;
              }
            }
    } else {
      // se existe entrada e said e fornecedor e produto
      if(isset($operacao->produto) === true && $operacao->produto!=""){
        $resultado =37;
        // se existe saida e fornecedor e produto e placa
        if(isset($operacao->placa) === true && $operacao->placa!=""){
          $resultado =38;
        }
      } else {
              // se existe entrada e said e fornecedor e placa
              if(isset($operacao->placa) === true && $operacao->placa!=""){
                $resultado =39;
              }
            }
          }  
  }
  // se existe entrada e said e cliente e nao existe consulta a fornecedor
  if(isset($operacao->cliente) === true && $operacao->cliente!="" ){
    if(isset($operacao->fornecedor) == false || $operacao->fornecedor==""){
      $resultado =310;
        // se existe entrada e said e cliente e produto
        if(isset($operacao->produto) === true && $operacao->produto!=""){
          $resultado =311;
          // se existe entrada e said e cliente e produto e placa
          if(isset($operacao->placa) === true && $operacao->placa!=""){
            $resultado =312;
          } 
        } else {
                // se existe entrada e said e cliente e placa  
                if(isset($operacao->placa) === true && $operacao->placa!=""){
                  $resultado =313;
                }
              }
    }
  }
      // se existe entrada e said e produto  e nao existe consulta a fornecedor e nao existe consulta cliente
      if(isset($operacao->fornecedor) == false || $operacao->fornecedor==""){
      if(isset($operacao->cliente) == false || $operacao->cliente==""){
        if(isset($operacao->produto) === true && $operacao->produto!="" ){
            $resultado =314;
              // se existe entrada e said e produto e placa
              if(isset($operacao->placa) === true && $operacao->placa!=""){
                $resultado =315;
              } 
        } else {
           // se existe entrada e saida e placa
                if(isset($operacao->placa) === true && $operacao->placa!=""){
                  $resultado =316;
                } 
              }
        }
      }
}
/// final entrada e saida
return $resultado;
}
///// será???

public function consultaPesagemOperacao($operacao){

  // OBJETIVO 
  //BUSCAR POR STATUS DE ENTRADA --E -- SAIDA SOLICITADOS JUNTOS
  //BUSCAR POR STATUS DE ENTRADA --OU-- SAIDA SOLICITADOS INDIVIDUALMENTE
  // PARA CONSULTAR TIPO DE ENTRADA AO MESMO TEMPO O CAMPO NOME FORNECEDOR

  // OBJETIVO 
  // PESQUISAR ENTRADA E NOME FORNECEDOR
  // PESQUISAR SAIDA E NOME FORNECEDOR
  // PESQUISAR ENTRADA SE O NOME FORNECEDOR NAO EXISTIR 

          $banco = new Banco();
          $teste = $banco->serverName;
          $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
           if($conn->connect_error){
              $verificador = false;
              die("Problema na conexão ".$conn->connect_error);
           }
         $teste = $operacao;
         // aqui passo o objeto da pagina para o teste em if
         // de acordo com a resposta  entra o if para uso do sql
         $solicitadoPagina = DaoPesagem::consultaPesagemIf($teste);

if(isset($operacao->entrada) === true && $operacao->entrada === true){
  $tipo_operacao = 0; 
}
if(isset($operacao->saida) === true && $operacao->saida === true){
  $tipo_operacao = 1; 
}

//OK se existe entrada E true                                     recebe 1 
//OK se existe saida E true                                     recebe 2
if($solicitadoPagina === 1 || $solicitadoPagina === 2){
  $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro` WHERE p.`status` = ".$tipo_operacao."  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto` ";
    $result = $conn->query($sql);
}
//OK se existe entrada e fornecedor                               recebe 12 
//OK se existe saida e fornecedor                               recebe 22  
if($solicitadoPagina === 12 || $solicitadoPagina === 22){
$nomeFornecedor = strtoupper($operacao->fornecedor ); // DEIXA A STRING MAIUSCULA
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e fornecedor e cliente                     recebe 13
//OK se existe saida e fornecedor e cliente                     recebe 23 
if($solicitadoPagina === 13 || $solicitadoPagina === 23){
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$nomeCliente = strtoupper($operacao->cliente);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND c.`nome` LIKE '".$nomeCliente."%'  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e fornecedor e cliente e produto           recebe 14 
//OK se existe saida e fornecedor e cliente e produto           recebe 24 
if($solicitadoPagina === 14 || $solicitadoPagina === 24){
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$nomeCliente = strtoupper($operacao->cliente);
$nomeProduto = strtoupper($operacao->produto);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND c.`nome` LIKE '".$nomeCliente."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e fornecedor e cliente e produto e placa   recebe 15 
//OK se existe saida e fornecedor e cliente e produto e placa   recebe 25
if($solicitadoPagina === 15 || $solicitadoPagina === 25){
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$nomeCliente = strtoupper($operacao->cliente);
$nomeProduto = strtoupper($operacao->produto);
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND c.`nome` LIKE '".$nomeCliente."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e fornecedor e cliente e placa             recebe 16
//OK se existe saida e fornecedor e cliente e placa             recebe 26  
if($solicitadoPagina === 16 || $solicitadoPagina === 26){
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$nomeCliente = strtoupper($operacao->cliente);
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND c.`nome` LIKE '".$nomeCliente."%'  AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e fornecedor e produto                     recebe 17
//OK se existe saida e fornecedor e produto                     recebe 27 
if($solicitadoPagina === 17 || $solicitadoPagina === 27){
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$nomeProduto = strtoupper($operacao->produto);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'   AND pro.`nome` LIKE '".$nomeProduto."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e fornecedor e produto e placa             recebe 18
//OK se existe saida e fornecedor e produto e placa             recebe 28  
if($solicitadoPagina === 18 || $solicitadoPagina === 28){
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$nomeProduto = strtoupper($operacao->produto);
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e fornecedor e placa                       recebe 19
//OK se existe saida e fornecedor e placa                       recebe 29
if($solicitadoPagina === 19 || $solicitadoPagina === 29){
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e cliente                                  recebe 110
//OK se existe saida e cliente                                  recebe 210
if($solicitadoPagina === 110 || $solicitadoPagina === 210){
$nomeCliente = strtoupper($operacao->cliente);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND c.`nome` LIKE '".$nomeCliente."%' AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e cliente e produto                        recebe 111
//OK se existe saida e cliente e produto                        recebe 211  
if($solicitadoPagina === 111 || $solicitadoPagina === 211){
$nomeCliente = strtoupper($operacao->cliente);
$nomeProduto = strtoupper($operacao->produto);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND c.`nome` LIKE '".$nomeCliente."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e cliente e produto e placa                recebe 112
//OK se existe saida e cliente e produto e placa                recebe 212 
if($solicitadoPagina === 112 || $solicitadoPagina === 212){
$nomeCliente = strtoupper($operacao->cliente);
$nomeProduto = strtoupper($operacao->produto);
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND c.`nome` LIKE '".$nomeCliente."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e cliente e placa                          recebe 113 
//OK se existe saida e cliente e placa                          recebe 213 
if($solicitadoPagina === 113 || $solicitadoPagina === 213){
$nomeCliente = strtoupper($operacao->cliente);
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND c.`nome` LIKE '".$nomeCliente."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e produto                                  recebe 114
//OK se existe saida e produto                                  recebe 214  
if($solicitadoPagina === 114 || $solicitadoPagina === 214){
$nomeProduto = strtoupper($operacao->produto);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND pro.`nome` LIKE '".$nomeProduto."%' AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e produto e placa                          recebe 115
//OK se existe saida e produto e placa                          recebe 215 
if($solicitadoPagina === 115 || $solicitadoPagina === 215){
$nomeProduto = strtoupper($operacao->produto);
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao."  AND pro.`nome` LIKE '".$nomeProduto."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}
//OK se existe entrada e placa                                    recebe 116 
//OK se existe saida e placa                                    recebe 216
if($solicitadoPagina === 116 || $solicitadoPagina === 216){
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sql = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $result = $conn->query($sql);
}

////////////////// CASO SOLICITADO BUSCA POR ENTRADA E SAIDA AO MESMO TEMPO /////////////////

if(isset($operacao->saida) && isset($operacao->entrada)){
  // se as duas solicitaçoes forem positivas entao
  if($operacao->entrada === true && $operacao->saida === true){
//OK se existe entrada e saida E true                                     recebe 3
if($solicitadoPagina === 3){
  $tipo_operacao = 0;
  $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro` WHERE p.`status` = ".$tipo_operacao."  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto` ";
    $resultEntrada = $conn->query($sqlEntrada);
   $tipo_operacao = 1;
  $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro` WHERE p.`status` = ".$tipo_operacao."  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto` ";
    $resultSaida = $conn->query($sqlSaida);
}
 
//OK se existe entrada e saida e fornecedor                               recebe 32 
if($solicitadoPagina === 32){
   $tipo_operacao = 0;
$nomeFornecedor = strtoupper($operacao->fornecedor ); // DEIXA A STRING MAIUSCULA
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1; 
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}

//OK se existe entrada e saida e fornecedor e cliente                     recebe 33 
if($solicitadoPagina === 33){
$tipo_operacao = 0; 
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$nomeCliente = strtoupper($operacao->cliente);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND c.`nome` LIKE '".$nomeCliente."%'  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1; 
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND c.`nome` LIKE '".$nomeCliente."%'  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e fornecedor e cliente e produto           recebe 34 
if($solicitadoPagina === 34){
$tipo_operacao = 0;
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$nomeCliente = strtoupper($operacao->cliente);
$nomeProduto = strtoupper($operacao->produto);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND c.`nome` LIKE '".$nomeCliente."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1;
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND c.`nome` LIKE '".$nomeCliente."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e fornecedor e cliente e produto e placa   recebe 35
if($solicitadoPagina === 35){
$tipo_operacao = 0;
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$nomeCliente = strtoupper($operacao->cliente);
$nomeProduto = strtoupper($operacao->produto);
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND c.`nome` LIKE '".$nomeCliente."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1; 
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND c.`nome` LIKE '".$nomeCliente."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e fornecedor e cliente e placa             recebe 36 
if($solicitadoPagina === 36){
$tipo_operacao = 0; 
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$nomeCliente = strtoupper($operacao->cliente);
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND c.`nome` LIKE '".$nomeCliente."%'  AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1;
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'  AND c.`nome` LIKE '".$nomeCliente."%'  AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e fornecedor e produto                     recebe 37 
if($solicitadoPagina === 37){
$tipo_operacao = 0; 
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$nomeProduto = strtoupper($operacao->produto);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'   AND pro.`nome` LIKE '".$nomeProduto."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1; 
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%'   AND pro.`nome` LIKE '".$nomeProduto."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e fornecedor e produto e placa             recebe 38  
if($solicitadoPagina === 38){
$tipo_operacao = 0; 
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$nomeProduto = strtoupper($operacao->produto);
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1; 
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e fornecedor e placa                       recebe 39 
if($solicitadoPagina === 39){
$tipo_operacao = 0; 
$nomeFornecedor = strtoupper($operacao->fornecedor); // DEIXA A STRING MAIUSCULA
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1;
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND f.`nome` LIKE '".$nomeFornecedor."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida  = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e cliente                                  recebe 310 
if($solicitadoPagina === 310){
$tipo_operacao = 0; 
$nomeCliente = strtoupper($operacao->cliente);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND c.`nome` LIKE '".$nomeCliente."%' AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1; 
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND c.`nome` LIKE '".$nomeCliente."%' AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e cliente e produto                        recebe 311  
if($solicitadoPagina === 311){
$tipo_operacao = 0; 
$nomeCliente = strtoupper($operacao->cliente);
$nomeProduto = strtoupper($operacao->produto);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND c.`nome` LIKE '".$nomeCliente."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1;
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND c.`nome` LIKE '".$nomeCliente."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e cliente e produto e placa                recebe 312 
if($solicitadoPagina === 312){
$tipo_operacao = 0; 
$nomeCliente = strtoupper($operacao->cliente);
$nomeProduto = strtoupper($operacao->produto);
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND c.`nome` LIKE '".$nomeCliente."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1;
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND c.`nome` LIKE '".$nomeCliente."%' AND pro.`nome` LIKE '".$nomeProduto."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e cliente e placa                          recebe 313  
if($solicitadoPagina === 313){
  $tipo_operacao = 0; 
$nomeCliente = strtoupper($operacao->cliente);
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND c.`nome` LIKE '".$nomeCliente."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1; 
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND c.`nome` LIKE '".$nomeCliente."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e produto                                  recebe 314  
if($solicitadoPagina === 314){
$tipo_operacao = 0; 
$nomeProduto = strtoupper($operacao->produto);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND pro.`nome` LIKE '".$nomeProduto."%' AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1; 
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND pro.`nome` LIKE '".$nomeProduto."%' AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e produto e placa                          recebe 315 
if($solicitadoPagina === 315){
$tipo_operacao = 0;
$nomeProduto = strtoupper($operacao->produto);
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao."  AND pro.`nome` LIKE '".$nomeProduto."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1; 
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao."  AND pro.`nome` LIKE '".$nomeProduto."%' AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}
//OK se existe entrada e saida e placa                                    recebe 316
if($solicitadoPagina === 316){
$tipo_operacao = 0; 
$placa = strtoupper($operacao->placa);
    //$nomefornecedor = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
    // sql para busca por nome de cliente  e entrada ou saida
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultEntrada = $conn->query($sqlEntrada);
$tipo_operacao = 1; 
    $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$tipo_operacao." AND v.`placa` LIKE '".$placa."%'  AND  p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";
    $resultSaida = $conn->query($sqlSaida);
}


    }
  }

///////////////////// FIM SQL ENTRADA E SAIDA

// AQUI EMBALA O RESULTADO PARA ENVIAR PARA A PAGINA

// cria array fazio para colocar os resultados 
// foi a forma que encontrei para juntar tantos selects 
   $resultado = array();
   // se existe resultado de consulta por entrada e for maior de 0 entao
   if (isset($result) === true && $result->num_rows > 0 ) {
      while($row = $result->fetch_assoc()) {
         $consultaPesagem = new ConsultaPesagem();  // tem que criar essa class ainda.
         // AQUI COMPARO SE A OPERAÇÃO E O NOME DO FORNECEDOR SÃO OS PROCURADOS
         if($row['status'] == 3){
          $consultaPesagem->status = "MANUAL";
         }
         if($row['status'] == 0){
          $consultaPesagem->status = "ENTRADA";
         }
         if($row['status'] == 1){
          $consultaPesagem->status = "SAIDA";
         }
         if($row['status'] == 2){
          $consultaPesagem->status = "AVULSA";
         }
         $consultaPesagem->id_pesagem = $row['id_pesagem'];
         $consultaPesagem->id_fornecedor = $row['fornecedor_id_fornecedor'];
         $consultaPesagem->fornecedor = $row['fornecedor'];
         $consultaPesagem->cliente_id_cliente = $row['cliente_id_cliente'];
         $consultaPesagem->cliente = $row['cliente'];
         $consultaPesagem->produto_id_produto = $row['produto_id_produto'];
         $consultaPesagem->cod_prod = $row['cod_prod'];
         $consultaPesagem->produto = $row['produto'];
         $consultaPesagem->peso_1 = $row['peso_1'];
         $consultaPesagem->peso_2 = $row['peso_2'];
         $consultaPesagem->peso_descontos = $row['peso_descontos'];
         $consultaPesagem->peso_liquido = $row['peso_liquido'];
         $consultaPesagem->placa = $row['placa'];
         $consultaPesagem->motorista = $row['motorista'];
         $consultaPesagem->observacao = $row['observacao'];
         $consultaPesagem->data = $row['data'];

         if($row['cpf_cliente'] != null){
          $consultaPesagem->cpf_cnpj_cliente = $row['cpf_cliente'];
         }
         if($row['cnpj_cliente'] != null){
          $consultaPesagem->cpf_cnpj_cliente = $row['cnpj_cliente'];
         }
         if($row['cpf_fornecedor'] != null){
          $consultaPesagem->cpf_cnpj_fornecedor = $row['cpf_fornecedor'];
         }
         if($row['cnpj_fornecedor'] != null){
          $consultaPesagem->cpf_cnpj_fornecedor = $row['cnpj_fornecedor'];
         }
         array_push($resultado,$consultaPesagem);
      }
    } else {

      if (isset($resultEntrada) === true && $resultEntrada->num_rows > 0 ) {
// fazer o pacote do resultado de entra e saida solicitados array com o resultado
        while($row = $resultEntrada->fetch_assoc()) {
         $consultaPesagem = new ConsultaPesagem();  // tem que criar essa class ainda.
         // AQUI COMPARO SE A OPERAÇÃO E O NOME DO FORNECEDOR SÃO OS PROCURADOS
         if($row['status'] == 3){
          $consultaPesagem->status = "PESAGEM MANUAL";
         }
         if($row['status'] == 0){
          $consultaPesagem->status = "PESAGEM ENTRADA";
         }
         if($row['status'] == 1){
          $consultaPesagem->status = "PESAGEM SAIDA";
         }
         if($row['status'] == 2){
          $consultaPesagem->status = "PESAGEM AVULSA";
         }
         $consultaPesagem->id_pesagem = $row['id_pesagem'];
         $consultaPesagem->id_fornecedor = $row['fornecedor_id_fornecedor'];
         $consultaPesagem->fornecedor = $row['fornecedor'];
         $consultaPesagem->cliente_id_cliente = $row['cliente_id_cliente'];
         $consultaPesagem->cliente = $row['cliente'];
         $consultaPesagem->produto_id_produto = $row['produto_id_produto'];
         $consultaPesagem->cod_prod = $row['cod_prod'];
         $consultaPesagem->produto = $row['produto'];
         $consultaPesagem->peso_1 = $row['peso_1'];
         $consultaPesagem->peso_2 = $row['peso_2'];
         $consultaPesagem->peso_descontos = $row['peso_descontos'];
         $consultaPesagem->peso_liquido = $row['peso_liquido'];
         $consultaPesagem->placa = $row['placa'];
         $consultaPesagem->motorista = $row['motorista'];
         $consultaPesagem->observacao = $row['observacao'];
         $consultaPesagem->data = $row['data'];

         if($row['cpf_cliente'] != null){
          $consultaPesagem->cpf_cnpj_cliente = $row['cpf_cliente'];
         }
         if($row['cnpj_cliente'] != null){
          $consultaPesagem->cpf_cnpj_cliente = $row['cnpj_cliente'];
         }
         if($row['cpf_fornecedor'] != null){
          $consultaPesagem->cpf_cnpj_fornecedor = $row['cpf_fornecedor'];
         }
         if($row['cnpj_fornecedor'] != null){
          $consultaPesagem->cpf_cnpj_fornecedor = $row['cnpj_fornecedor'];
         }
         array_push($resultado,$consultaPesagem);
      }

      }
      if (isset($resultSaida) === true && $resultSaida->num_rows > 0 ) {
// fazer o pacote do resultado de entra e saida solicitados array com o resultado
 while($row = $resultSaida->fetch_assoc()) {
         $consultaPesagem = new ConsultaPesagem();  // tem que criar essa class ainda.
         // AQUI COMPARO SE A OPERAÇÃO E O NOME DO FORNECEDOR SÃO OS PROCURADOS
         if($row['status'] == 3){
          $consultaPesagem->status = "PESAGEM MANUAL";
         }
         if($row['status'] == 0){
          $consultaPesagem->status = "PESAGEM ENTRADA";
         }
         if($row['status'] == 1){
          $consultaPesagem->status = "PESAGEM SAIDA";
         }
         if($row['status'] == 2){
          $consultaPesagem->status = "PESAGEM AVULSA";
         }
         $consultaPesagem->id_pesagem = $row['id_pesagem'];
         $consultaPesagem->id_fornecedor = $row['fornecedor_id_fornecedor'];
         $consultaPesagem->fornecedor = $row['fornecedor'];
         $consultaPesagem->cliente_id_cliente = $row['cliente_id_cliente'];
         $consultaPesagem->cliente = $row['cliente'];
         $consultaPesagem->produto_id_produto = $row['produto_id_produto'];
         $consultaPesagem->cod_prod = $row['cod_prod'];
         $consultaPesagem->produto = $row['produto'];
         $consultaPesagem->peso_1 = $row['peso_1'];
         $consultaPesagem->peso_2 = $row['peso_2'];
         $consultaPesagem->peso_descontos = $row['peso_descontos'];
         $consultaPesagem->peso_liquido = $row['peso_liquido'];
         $consultaPesagem->placa = $row['placa'];
         $consultaPesagem->motorista = $row['motorista'];
         $consultaPesagem->observacao = $row['observacao'];
         $consultaPesagem->data = $row['data'];

         if($row['cpf_cliente'] != null){
          $consultaPesagem->cpf_cnpj_cliente = $row['cpf_cliente'];
         }
         if($row['cnpj_cliente'] != null){
          $consultaPesagem->cpf_cnpj_cliente = $row['cnpj_cliente'];
         }
         if($row['cpf_fornecedor'] != null){
          $consultaPesagem->cpf_cnpj_fornecedor = $row['cpf_fornecedor'];
         }
         if($row['cnpj_fornecedor'] != null){
          $consultaPesagem->cpf_cnpj_fornecedor = $row['cnpj_fornecedor'];
         }
         array_push($resultado,$consultaPesagem);
      }

      }

if(isset($result) === true && $result->num_rows === 0 || isset($resultEntrada) === true && $resultEntrada->num_rows === 0 || isset($resultSaida) === true && $resultSaida->num_rows === 0 ){ // existe resultado das pesquisas  se nao
  $r = new Resposta_pesagem();
     $r->status=0;  // se o cliente nao tiver pesagem
      $resultado = $r;
}
      
    } // SE EXISTE CAMPO ENTRA TRUE OU FALSE E A CONSULTA A ENTRADA TEVE RESULTADOS
// caso o banco esteja vazio de operaçoes de entra e saida

   $conn->close();
   return $resultado;
}

////////////////////////////////////// fim testes pesquisa de pesagem por tipo de entrada

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
		    // SE PESAGEM FOR DE SAIDA ROTINA DIFERENTE TEMPORARIA
if($pesagem->status == 1){

if($con->connect_error){
        $verificador = false;
        die("Problema na conexão ".$con->connect_error);
      }
      try{

      $sql = "INSERT INTO `Pesagem` (`status`,`data`,`motorista`,`fornecedor_id_fornecedor`,`empresa_id_empresa`,`produto_id_produto`,`cliente_id_cliente`,`veiculo_id_veiculo`,`tipo_veiculo`,`peso_1`,`peso_2`,`peso_descontos`,`peso_liquido`,`observacao` ) VALUES (?,now(),?,?,?,?,?,?,?,?,?,?,?,?)";

        $stament = $con->prepare($sql);

        $stament->bind_param('isiiiiisiiiis' ,$status, $motorista ,$fornecedor_id_fornecedor, $empresa_id_empresa ,$produto_id_produto, $cliente_id_cliente ,$veiculo_id_veiculo, $tipo_veiculo ,$peso_1, $peso_2 ,$peso_descontos, $peso_liquido, $observacao);
         

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

   

}else{



      /// FIM DO TESTE

	 
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
} // fim do else do teste de pesagem de saida
    }


public function getPesagem($id_pesagem){
// pesquisa pesagem por numero do ticket
$banco = new Banco();
   $teste = $banco->serverName;
         
         
         $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);

         if($conn->connect_error){
            $verificador = false;
            die("Problema na conexão ".$conn->connect_error);
         }
// preciso de buscar as informações da propria tabela pesagem
   $sql = "SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro` WHERE p.`id_pesagem` = ".$id_pesagem." AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor` AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`";
 
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      // output data of each row
      $resultado = array();
      while($row = $result->fetch_assoc()) {
         $consultaPesagem = new ConsultaPesagem();  // tem que criar essa class ainda.


         $consultaPesagem->data = $row['data'];
         //$consultaPesagem->data = date_format(p.`data`, 'd/m/Y H:i:s'); 
          
         
         if($row['status'] == 0){
          $consultaPesagem->status = "PESAGEM ENTRADA";
         }
         if($row['status'] == 1){
          $consultaPesagem->status = "PESAGEM SAIDA";
         }
         if($row['status'] == 2){
          $consultaPesagem->status = "PESAGEM AVULSA";
         }
         if($row['status'] == 3){
          $consultaPesagem->status = "PESAGEM MANUAL";
         }

         $consultaPesagem->id_pesagem = $row['id_pesagem'];
         $consultaPesagem->cliente_id_cliente = $row['cliente_id_cliente'];
         $consultaPesagem->fornecedor_id_fornecedor = $row['fornecedor_id_fornecedor'];
         $consultaPesagem->produto_id_produto = $row['produto_id_produto'];

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
         
         if($row['status'] == 0){
          $consultaPesagem->status = "PESAGEM ENTRADA";
         }
         if($row['status'] == 1){
          $consultaPesagem->status = "PESAGEM SAIDA";
         }
         if($row['status'] == 2){
          $consultaPesagem->status = "PESAGEM AVULSA";
         }
         if($row['status'] == 3){
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
         if($row['status'] == 3){
          $consultaPesagem->status = "PESAGEM MANUAL";
         }
         if($row['status'] == 0){
          $consultaPesagem->status = "PESAGEM ENTRADA";
         }
         if($row['status'] == 2){
          $consultaPesagem->status = "PESAGEM AVULSA";
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
         if($row['status'] == 3){
          $consultaPesagem->status = "PESAGEM MANUAL";
         }
         if($row['status'] == 0){
          $consultaPesagem->status = "PESAGEM ENTRADA";
         }
         if($row['status'] == 2){
          $consultaPesagem->status = "PESAGEM AVULSA";
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
         if($row['status'] == 3){
          $consultaPesagem->status = "PESAGEM MANUAL";
         }
         if($row['status'] == 0){
          $consultaPesagem->status = "PESAGEM ENTRADA";
         }
         if($row['status'] == 2){
          $consultaPesagem->status = "PESAGEM AVULSA";
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