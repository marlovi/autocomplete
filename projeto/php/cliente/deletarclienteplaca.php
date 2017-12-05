 <?php   
 require_once "cliente.class.php";
 require_once "resposta.class.php";
 require_once 'daocliente.class.php';
 require_once '../veiculo/daoveiculo.class.php';
 require_once '../veiculo/veiculo.class.php';
 require_once "../pesagem/consultapesagem.class.php";
 require_once "../pesagem/daopesagem.class.php";
 $dao = new DaoCliente();
 $cliente = new Cliente();
 $resposta = new Resposta();
 $daopesagem = new DaoPesagem();
 $objetoPesagem = new Pesagem();
 $daoVeiculo = new DaoVeiculo();
 $postdata = file_get_contents("php://input");
 $request = json_decode($postdata);
 $listaVeiculos = $request[1];
 $lista_id_veiculo = array();
 $lista_consulta_pesagem_cliente = array();
 $lista_consulta_pesagem_placa = array();
 $lista_id_pesagem_cliente = array();
 $lista_id_pesagem_placa = array();
 $resposta->status_pesagem = array();
 $teste_status_pesagem = null;   
 $teste_placa   = null;
 $teste_cliente = null;
 // POSSUI REGISTROS DE VEICULOS NESSE CLIENTE?
      // SIM ENTAO 
              // POSSUI REGISTROS DE PESAGEM NOS VEICULOS DESSE CLIENTE?
                    //SIM ENTAO POSSUI PESAGEM NESSES VEICULOS
                          //SIM ENTAO RETORNE AS PESAGENS
                          //NAO ENTAO APAGA O REGISTRO
                    //NAO ENTAO POSSUI PESAGEM NO REGISTRO CLIENTE?
                           //SIM ENTAO RETORNE AS PESAGENS
                           //NAO ENTAO APAGA O REGISTRO
      //NAO ENTAO 
             //POSSUI PESAGEM NO REGISTRO CLIENTE?
                   //SIM ENTAO RETORNE AS PESAGENS
                   //NAO ENTAO APAGA O REGISTRO
 // SOLUÇÃO
 // OK CRIAR AS CONSULTAS
 // OK CRIAR OS IF E TESTAR AS CONSULTAS
 // OK CRIAR VAR_DUMP MOSTRANDO AS CONDIÇOES
 // OK CRIAR FUNCAO APAGAR
 // TRANFERIR PARA JS OS RESULTADOS DAS CONSULTAS
 // CRIAR FUNÇÃO INFORMAR REGISTROS
 // COMEMORAR.
////////////////////CONSULTA PESAGEM PLACA/////////////////////////////////
  if (isset($listaVeiculos[0]->id_veiculo)) { // TESTA SE TEM LISTA DE VEICULOS
     foreach($listaVeiculos as $key => $value) {
         $veiculo = new Veiculo();
         $veiculo->preencher($value);
         array_push($lista_id_veiculo, $veiculo->id_veiculo);
     }
     foreach($lista_id_veiculo as $key => $value) { // CONSULTA LISTA DE VEICULOS
      array_push($lista_consulta_pesagem_placa, $daopesagem->consultaPesagemPlaca($value));
     }
     foreach($lista_id_veiculo as $key => $value) { // TRATA A CONSULTA RETIRANDO OS ID PESAGEM
          if(isset($lista_consulta_pesagem_placa[$key]->status)){
           // var_dump("SEM PESAGEM NA POSICAO " );
          }else{
                  foreach($lista_consulta_pesagem_placa[$key] as $key2 => $value) {
                    array_push($lista_id_pesagem_placa, $lista_consulta_pesagem_placa[$key][$key2]->id_pesagem);
                  }
              } 
     }
if($lista_id_pesagem_placa == null){ // SE NAO TIVER ID PESAGEM NAS PLACAS 
  //var_dump(" SEM PESAGEM NAS PLACAS " );
  $teste_placa = 0;
}else{                                // SE TIVER ID PESAGEM NAS PLACAS
  //var_dump(" PESAGEM NAS PLACAS " );
 // var_dump($lista_id_pesagem_placa);
  $teste_placa = 1;
    }
  }else{                             // SE NAO TIVER LISTA DE VEICULOS NO CLIENTE
       // var_dump("CLIENTE SEM  VEICULOS");
        $teste_placa = 0; 
        }
////////////////////FIM   CONSULTA PESAGEM PLACA/////////////////////////////////
///////////////////CONSULTA PESAGEM CLIENTE/////////////////////////////////          
$lista_consulta_pesagem_cliente = $daopesagem->consultaPesagemCliente($request[0]->id_cliente);
      if(isset($lista_consulta_pesagem_cliente->status)){// SE O CLIENTE NAO TIVER  PESAGEM
         // var_dump("NAO TEM PESAGEM CLIENTE");
          $teste_cliente = 0;     
     }else{                                         // SE O CLIENTE TIVER PESAGEM
          foreach($lista_consulta_pesagem_cliente as $key => $value) {
            array_push($lista_id_pesagem_cliente, $lista_consulta_pesagem_cliente[$key]->id_pesagem);
          }
        //var_dump("TEM PESAGEM CLIENTE");
        //var_dump($lista_id_pesagem_cliente);
        $teste_cliente = 1;
          }
///////////////////FIM   CONSULTA PESAGEM CLIENTE/////////////////////////////////
///////////TESTE DAS CONSULTAS PESAGEM CLIENTE E PLACAS///////////////////////////
   // $teste_placa          // SE 0 LIVRE 
                            // SE 1 TEM PESAGEM PLACAS
   // $teste_cliente        // SE 0 LIVRE
                            // SE 1 TEM PESAGEM CLIENTE 
 if($teste_cliente == 1 && $teste_placa == 1){
          foreach($lista_id_pesagem_cliente as $key => $value) {
            array_push($resposta->status_pesagem, $value);
          }
          foreach($lista_id_pesagem_placa as $key => $value) {
            array_push($resposta->status_pesagem, $value);
          }
 // var_dump("veiculo ");
 // var_dump($lista_id_pesagem_placa);
 // var_dump("cliente ");
 // var_dump($lista_id_pesagem_cliente);
//  var_dump("veiculo e cliente ");
          $teste_status_pesagem = 1;
          $resposta->status = false; // aqui retorna que apagou
          echo json_encode($resposta, true);
  }else{
    if($teste_cliente == 1){
          foreach($lista_id_pesagem_cliente as $key => $value) {
            array_push($resposta->status_pesagem, $value);
          }
     // var_dump("cliente ");
      //var_dump($lista_id_pesagem_cliente);
      //var_dump(" cliente ");
          $teste_status_pesagem = 1;
      $resposta->status = false; // aqui retorna que apagou
      echo json_encode($resposta, true);
    }
    if($teste_placa == 1){

          foreach($lista_id_pesagem_placa as $key => $value) {
            array_push($resposta->status_pesagem, $value);
          }
     // var_dump("veiculo ");
     // var_dump($lista_id_pesagem_placa);
     // var_dump("veiculo ");
      $teste_status_pesagem = 1;
      $resposta->status = false; // aqui retorna que apagou
      echo json_encode($resposta, true);
    }
    if($teste_cliente == 0 && $teste_placa == 0){
      $teste_status_pesagem = 0;
     // var_dump("veiculo ");
      //var_dump($lista_id_pesagem_placa);
      //var_dump("cliente ");
     // var_dump($lista_id_pesagem_cliente);
     // var_dump("veiculo e cliente ");
      //$resposta->status = false; // aqui retorna que apagou
      //echo json_encode($resposta, true);
    }
  }
 /////////FIM   TESTE DAS CONSULTAS PESAGEM CLIENTE E PLACAS///////////////////////////
 if ($teste_status_pesagem == 0) { // SE O CLIENTE E AS PLACAS NAO TIVEREM PESAGEM 
     $cliente->preencher($request[0]);
     $listaVeiculos = $request[1];
     $daoVeiculo = new DaoVeiculo();
     foreach($listaVeiculos as $key => $value) {
         $veiculo = new Veiculo();
         $veiculo->preencher($value);
         $daoVeiculo->delete($veiculo);
     }
    $dao->delete($cliente);
    $resposta->status = true; // aqui retorna que apagou
    echo json_encode($resposta, true);
 }
?>