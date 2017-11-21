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
        $lista_id_veiculo  = array(); 
        $lista_consulta_pesagem = array(); 
        $teste_status_pesagem = 0;
   
   foreach ($listaVeiculos as $key => $value) {
       $veiculo = new Veiculo();
       $veiculo->preencher($value);
        array_push($lista_id_veiculo, $veiculo->id_veiculo);
   }
   // quero testar a lista de id dos veiculos na tabela pesagem
   
   
       for ($i = 0; $i < sizeof($lista_id_veiculo); $i++) {
            $lista_consulta_pesagem[$i] = $daopesagem->consultaPesagemPlaca($lista_id_veiculo[$i]);
          
       }
   
   // até aqui consultei se tinha alguma placa com pesagem
   // então testa o id cliente pra saber se tambem nao tem pesagem.
   // o resultado vai para o fim da fila.
   
   $lista_consulta_pesagem[sizeof($lista_id_veiculo)] = $daopesagem->consultaPesagemCliente($request[0]->id_cliente);
   
   
       for ( $i = 0; $i < sizeof($lista_consulta_pesagem); $i++) {
        // se existe o status
   if(isset($lista_consulta_pesagem[$i]->status) ){
    // se o status for = 0 entao
   if($lista_consulta_pesagem[$i]->status == 0){
        $teste_status_pesagem = 0;
   }
   }else{
        $teste_status_pesagem = 1;
        $resposta->status = false;
        echo json_encode($resposta,true);
   }
   
           } 

   if($teste_status_pesagem == 0){
        //se o teste deu certo então apague a placa
        $cliente->preencher($request[0]);
        $listaVeiculos = $request[1];
        $daoVeiculo = new DaoVeiculo();
   foreach ($listaVeiculos as $key => $value) {
       $veiculo = new Veiculo();
       $veiculo->preencher($value);
       $daoVeiculo->delete($veiculo);
   }
   
   
        $dao->delete($cliente);
        $resposta->status = true;// aqui retorna que apagou
        echo json_encode($resposta,true);
   }
   
   ?>