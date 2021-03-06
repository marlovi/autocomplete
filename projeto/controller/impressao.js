  function impressaoController($scope, $http, $log, $cookieStore, $mdDialog, $q, $timeout, meuServico, $cookies) {

$scope.consultarIdItensDescontos = function() {
        // ORDEM DE CONSULTA
        // 1 CONSULTA OS ITENS_DESCONTO consultarIdItensDescontos
        //2 CONSULTA O NOME DO DESCONTO E ADD NO OBJETO consultarNomeDescontos
        //3 CONSULTA OS DESCONTOS APLICADOS E ADD NO OBJETO consultarDescontosAplicados
       console.log("impressaoController :consultarIdItensDescontos"); 
     //  console.log("Obj.pesagem",$scope.pesagem.id_pesagem);
        var listaDesconto = [];
         // console.log($scope.produto); 
         var request = $http({
             method: "post",
             url: "php/itens_desconto/pesquisarid_pesagem_itens_desconto.php",
             data: $scope.pesagem.id_pesagem,
             headers: {
                 'Content-Type': 'application/x-www-form-urlencoded'
             }
         });
         request.then(function(response) {
            if(!angular.isUndefined(response.data.status)){
                console.log("SEM DESCONTOS");
            }else{
         $scope.Lista_descontos =response.data; // colocando os resultados da 
          //console.log("LISTA DE DESCONTOS",$scope.Lista_descontos);
          // console.log("Obj.:Lista_descontos", $scope.Lista_descontos); 
          // console.log("consultar IdItensDescontos: ",$scope.Lista_descontos); 
        $scope.consultarNomeDescontos();    
         } // FIM ELSE
         }, function(response) {
             console.log("ERROR" + response);
         });
     }


$scope.consultarNomeDescontos = function() {
       console.log("impressaoController :consultarIdItensDescontos"); 
       var i = 0; /// variavel usada no do while
      // var listaDesconto = []; // variavel temporaria com a lista de id desconto
       var listaNomeDesconto = []; // variavel que armazena lista de id desconto
       var listaRepetida = 0; // varialve que conta as vezes que o id desconto tem no objeto
       // IF CRIADO POR SEGURANÇA
       // VAI QUE ESSA MERDA SOLICITA A CONSULTA DO NOME ANTES DO
       // SERVIDOR RESPONDER A CONSULTA DOS ITENS DE DESCONTO.
         if ($scope.Lista_descontos == "") {
              //SE É A PRIMEIRA DA LISTA
              console.log("Lista_descontos vazio");
          }else{
                // PASSANDO A LISTA DE DESCONTOS APLICADOS 
                // PARA BUSCAR O NOME DE CADA DESCONTO NO BANCO
                // DEVE COLOCAR O NOME DO DESCONTO NA MESMA POSIÇÃO DO ID DESCONTO
                var request = $http({
                             method: "post",
                             url: "php/desconto/pesquisardescontonome_saida_impressao.php",
                             data: $scope.Lista_descontos,
                             headers: {
                                 'Content-Type': 'application/x-www-form-urlencoded'
                             }
                         });
                         request.then(function(response) {
                         //$scope.Lista_descontos =response.data; // colocando os resultados da 
                            //console.log("Obj.:Lista_descontos", listaNomeDesconto);  
                            $scope.Lista_descontos =  response.data;
                            // console.log("consultar NomeDescontos", $scope.Lista_descontos); 
                          $scope.consultarDescontosAplicados();
                         }, function(response) {
                             console.log("ERROR" + response);
                         });
                } // fim else
}

$scope.consultarDescontosAplicados = function() {
        console.log("impressaoController :consultarDescontosAplicados");
          var request = $http({
             method: "post",
             url: "php/desconto_aplicado/pesquisardescontoaplicado_saida.php",
             data: $scope.Lista_descontos,
             headers: {
                 'Content-Type': 'application/x-www-form-urlencoded'
             }
         });
         request.then(function(response) {
            console.log("consultar DescontosAplicados",response.data);
            $scope.Lista_descontos =response.data; // colocando os resultados da 
            console.log("consultar DescontosAplicados",$scope.Lista_descontos);
            $cookies.putObject('impressaoDescontos_TESTE', $scope.Lista_descontos);
         }, function(response) {
             console.log("ERROR" + response);
         });
}

$scope.printDiv_saida_TESTE = function() {
        console.log("impressaoController :printDiv_saida_TESTE");
         var divName = "printable_saida_TESTE";
         var printContents = document.getElementById(divName).innerHTML;
         var popupWin = window.open('', '_blank', "width=" + screen.availWidth + ",height=" + screen.availHeight);
         popupWin.document.open();
         popupWin.document.write('<html><head><title>SPA  - Versão 2018 1.12</title>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
         popupWin.document.close();
         $cookies.remove('printable_saida_TESTE');
}


$scope.init_SAIDA_TESTE = function() {
        console.log("impressaoController :init_SAIDA_TESTE");
         var obj_impressao = $cookies.getObject('impressao');
         var obj_impressaoDescontos = $cookies.getObject('impressaoDescontos_TESTE');
            $scope.Lista_descontos = obj_impressaoDescontos;
            //console.log($scope.lines);
         $scope.pesagem = obj_impressao;
     }


// FIM FUNÇÃO QUE BUSCA DESCONTOS APLICADOS

$scope.init = function() {
        console.log("impressaoController :init");
         var obj_impressao = $cookies.getObject('impressao');
         var obj_impressaoDescontos = $cookies.getObject('impressaoDescontos');
        $scope.lines = obj_impressaoDescontos;
        console.log($scope.lines);
         $scope.pesagem.data = obj_impressao.data;
         $scope.pesagem.placa = obj_impressao.placa;
         $scope.pesagem.data_entrada = obj_impressao.data_entrada;
         $scope.pesagem.cliente = obj_impressao.cliente;
         $scope.pesagem.cpf_cnpj_cliente = obj_impressao.cpf_cnpj_cliente;
         $scope.pesagem.id_pesagem = obj_impressao.id_pesagem;
         $scope.pesagem.motorista = obj_impressao.motorista;
         $scope.pesagem.fornecedor = obj_impressao.fornecedor;
         $scope.pesagem.cpf_cnpj_fornecedor = obj_impressao.cpf_cnpj_fornecedor;
         $scope.pesagem.produto = obj_impressao.produto;
         $scope.pesagem.cod_prod = obj_impressao.cod_prod;
         $scope.pesagem.status = obj_impressao.status;
         $scope.pesagem.peso_1 = obj_impressao.peso_1;
         $scope.pesagem.peso_descontos = obj_impressao.peso_descontos;
         $scope.pesagem.peso_2 = obj_impressao.peso_2;
         $scope.pesagem.peso_liquido = obj_impressao.peso_liquido;
         $scope.pesagem.observacao = obj_impressao.observacao;
         $scope.pesagem.peso_liquido_final = obj_impressao.peso_liquido - obj_impressao.peso_descontos;
     }


$scope.init_SAIDA = function() {
        console.log("impressaoController :init_SAIDA");
         var obj_impressao = $cookies.getObject('impressao');
         var obj_impressaoDescontos = $cookies.getObject('impressaoDescontos');
            $scope.lines = obj_impressaoDescontos;
            //console.log($scope.lines);
            if(!angular.isUndefined(obj_impressao.data)){
                console.log("erro data  obj_impressao: ",obj_impressao);
                $scope.pesagem.data_saida = obj_impressao.data_saida;
                console.log("solicitar aqui captura pesagem entrada" );
                    var request = $http({
                method: "post",
                url: "php/pesagem/consultaplacapesagemsaida.php",
                data: obj_impressao,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
                    });
                request.then(function(response) {
                     // console.log("resposta consulta data entrada",response.data);
                    // aqui transfiro esses dados da ultima pesagem de entrada para
                    // o objeto pesagem na pagina pesagem de saida
                     $scope.pesagem.data_entrada = response.data[0].data;
                }, function(response) {
                    console.log("ERROR" + response);
                });
             console.log("objeto pesagem com data entrada",$scope.pesagem);
            } // fim do !angular.isUndefined(obj_impressao.data)
            if(angular.isUndefined(obj_impressao.data)){
                console.log("reconhece como data obj_impressao");
                $scope.pesagem.data = obj_impressao.data;
            }
         $scope.pesagem.placa = obj_impressao.placa;
         $scope.pesagem.data_entrada = obj_impressao.data_entrada;
         $scope.pesagem.cliente = obj_impressao.cliente;
         $scope.pesagem.cpf_cnpj_cliente = obj_impressao.cpf_cnpj_cliente;
         $scope.pesagem.id_pesagem = obj_impressao.id_pesagem;
         $scope.pesagem.motorista = obj_impressao.motorista;
         $scope.pesagem.fornecedor = obj_impressao.fornecedor;
         $scope.pesagem.cpf_cnpj_fornecedor = obj_impressao.cpf_cnpj_fornecedor;
         $scope.pesagem.produto = obj_impressao.produto;
         $scope.pesagem.cod_prod = obj_impressao.cod_prod;
         $scope.pesagem.status = obj_impressao.status;
         $scope.pesagem.peso_1 = obj_impressao.peso_1;
         $scope.pesagem.peso_descontos = obj_impressao.peso_descontos;
         $scope.pesagem.peso_2 = obj_impressao.peso_2;
         $scope.pesagem.peso_liquido = obj_impressao.peso_liquido;
         $scope.pesagem.observacao = obj_impressao.observacao;
         $scope.pesagem.peso_liquido_final = obj_impressao.peso_liquido - obj_impressao.peso_descontos;
}

$scope.printDiv = function() {

        console.log("impressaoController :printDiv");

         //console.log($scope.pesagem);
         // função que abre pop up para impressão.
         var divName = "printable";
         var printContents = document.getElementById(divName).innerHTML;
         var popupWin = window.open('', '_blank', "width=" + screen.availWidth + ",height=" + screen.availHeight);
         popupWin.document.open();
         popupWin.document.write('<html><head> <title>SPA  - Versão 2018 1.12</title>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
         popupWin.document.close();
         $cookies.remove('impressao');
}

$scope.printDiv_entrada = function() {
        console.log("impressaoController :printDiv_entrada");
         //console.log($scope.pesagem);
         // função que abre pop up para impressão.
         var divName = "printable_entrada";
         var printContents = document.getElementById(divName).innerHTML;
         var popupWin = window.open('', '_blank', "width=" + screen.availWidth + ",height=" + screen.availHeight);
         popupWin.document.open();
         popupWin.document.write('<html><head><title>SPA  - Versão 2018 1.12</title>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
         popupWin.document.close();
         $cookies.remove('impressao')
}

$scope.printDiv_avulsa = function() {
        console.log("impressaoController :printDiv_avulsa");
         //console.log($scope.pesagem);
         // função que abre pop up para impressão.
         var divName = "printable_avulsa";
         var printContents = document.getElementById(divName).innerHTML;
         var popupWin = window.open('', '_blank', "width=" + screen.availWidth + ",height=" + screen.availHeight);
         popupWin.document.open();
         popupWin.document.write('<html><head><title>SPA  - Versão 2018 1.12</title>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
         popupWin.document.close();
         $cookies.remove('impressao')
}

$scope.printDiv_saida = function() {
        console.log("impressaoController :printDiv_saida");
 
         var divName = "printable_saida";
         var printContents = document.getElementById(divName).innerHTML;
         var popupWin = window.open('', '_blank', "width=" + screen.availWidth + ",height=" + screen.availHeight);
         popupWin.document.open();
         popupWin.document.write('<html><head><title>SPA  - Versão 2018 1.12</title>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
         popupWin.document.close();
         $cookies.remove('impressao')
}

$scope.printDiv_relatorio = function() {
        console.log("impressaoController :printDiv_relatorio");
        // na pesagem de saida tem esse item a mais '' data de entrada' 
         
          
         console.log($scope.pesagem);
         // função que abre pop up para impressão.
         var divName = "printable_saida";
         var printContents = document.getElementById(divName).innerHTML;
         var popupWin = window.open('', '_blank', "width=" + screen.availWidth + ",height=" + screen.availHeight);
         popupWin.document.open();
         popupWin.document.write('<html><head><title>SPA  - Versão 2018 1.12</title>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
         popupWin.document.close();
         $cookies.remove('impressao')
}

 }

    angular
     .module('home')
     .controller('impressaoController', impressaoController);