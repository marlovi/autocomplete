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


public function consultaPesagemOperacao($operacao){
  // OBJETIVO 
  //BUSCAR POR STATUS DE ENTRADA --E -- SAIDA SOLICITADOS JUNTOS
  //BUSCAR POR STATUS DE ENTRADA --OU-- SAIDA SOLICITADOS INDIVIDUALMENTE
  // PARA CONSULTAR TIPO DE ENTRADA AO MESMO TEMPO O CAMPO NOME FORNECEDOR

  // OBJETIVO 
  // PESQUISAR ENTRADA E NOME FORNECEDOR
  // PESQUISAR SAIDA E NOME FORNECEDOR
  // PESQUISAR ENTRADA SE O NOME FORNECEDOR NAO EXISTIR
  //AND f.`nome` LIKE '".$teste."%' 

          $banco = new Banco();
          $teste = $banco->serverName;
          $conn = new mysqli($banco->serverName,$banco->user,$banco->password,$banco->dataBase);
           if($conn->connect_error){
              $verificador = false;
              die("Problema na conexão ".$conn->connect_error);
           }
// verifica se existe as duas solicitações ao mesmo tempo
if(isset($operacao->saida) && isset($operacao->entrada)){
  // se as duas solicitaçoes forem positivas entao
  if($operacao->entrada === true && $operacao->saida === true){
    $operacao = 0;
    $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro` WHERE p.`status` = ".$operacao."  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto` ";
   $resultEntrada = $conn->query($sqlEntrada);

   
   $operacao = 1;
   $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro` WHERE p.`status` = ".$operacao."  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto` ";

$resultSaida = $conn->query($sqlSaida);

  }
}  // FIM CONDIÇÃO ENTRADA E SAIDA AO MESMO TEMPO 
// condição que verifica se solicitação de entrada foi selecionada sozinha 
  if(isset($operacao->entrada)){
  
    
 
              if($operacao->entrada === true){
                $operacao = 0;
                $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$operacao." AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";

            
               $resultEntrada = $conn->query($sqlEntrada);

            } // SE SOLICITAÇÃO TIVER PARAMENTRO FORNECEDOR VALIDO -- E -- SOLICITAÇÃO DE OPERAÇÃO ENTRADA
          

  }
  //// condição que verifica se solicitação de saida foi selecionada sozinha 
if(isset($operacao->saida)){
        if($operacao->saida === true){
           $operacao = 1;
           $sqlSaida = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro` WHERE p.`status` = ".$operacao."  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto` ";

        $resultSaida = $conn->query($sqlSaida);

          }
}

// ATÉ AQUI FOI FEITO UMA BUSCA GERAL ONDE SO TEVE RELEVANCIA ENTRADA E SAIDA
// QUAL SERIA A MELHOR SAIDA?
    // TRABALHAR EM CIMA DESSE ARRAY DE ENTRADA E SAIDA FAZENDO TRATAMENTO BUSCANDO NO ARRAY OU
    //  EXECUTANDO ESSA IDEIAI  FAZER NOVAS CONSULTAS SQL COM OS PARAMENTROS MULTIPLOS DEPENDEOD DE IF
    // IF PARA ENTRADA E NOME FORNECEDOR
    // IF PARA SAIDA E NOME FORNECEDOR
    // IF PARA ENTRADA E SAIDA E NOME FORNE3CEDOR
    // TRATAMENTO PARA QUANDO EXISTIR O NOME FORNECEDOR MAS FOR VAZIO. O USUARIO ESCREVER U E APAGOU.



/*  

 if(isset($operacao->entrada)){
  
    strtoupper($operacao->fornecedor ); // DEIXA A STRING MAIUSCULA
    $teste = trim($operacao->fornecedor); // RETIRA ESPAÇOS DE INICIO E FIM
 
              if($operacao->entrada === true){
                $operacao = 0;
                $sqlEntrada = " SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro`  WHERE p.`status` = ".$operacao." AND f.`nome` LIKE '".$teste."%'  AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor`  AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`  ";

            
               $resultEntrada = $conn->query($sqlEntrada);

            } // SE SOLICITAÇÃO TIVER PARAMENTRO FORNECEDOR VALIDO -- E -- SOLICITAÇÃO DE OPERAÇÃO ENTRADA
          

  }




 */



// AQUI EMBALA O RESULTADO PARA ENVIAR PARA A PAGINA

// cria array fazio para colocar os resultados 
// foi a forma que encontrei para juntar tantos selects 
   $resultado = array();
   // se existe resultado de consulta por entrada e for maior de 0 entao
   if (isset($resultEntrada) && $resultEntrada->num_rows > 0) {
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
    } // SE EXISTE CAMPO ENTRA TRUE OU FALSE E A CONSULTA A ENTRADA TEVE RESULTADOS

// se existe resultado de consulta por saida e for maior de 0 entao
if (isset($resultSaida) && $resultSaida->num_rows > 0) {
 // $resultado = array();
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

      } // fim while

   } // SE EXISTE CAMPO SAI TRUE OU FALSE E A CONSULTA A SAIDA TEVE RESULTADOS
// caso o banco esteja vazio de operaçoes de entra e saida
 if (isset($resultEntrada) && isset($resultSaida)) {
   if($resultSaida->num_rows <= 0 && $resultEntrada->num_rows <= 0) {
     $r = new Resposta_pesagem();
     $r->status=0;  // se o cliente nao tiver pesagem
      $resultado = $r;
   }
 } 

  

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