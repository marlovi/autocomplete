    function pesquisaPesagemController($scope, $http, $log, $mdDialog,  $compile, $injector, $cookieStore, $cookies) {
// TENTANDO GERAR TABELA DINAMICA COM OS RESULTADOS DA PESQUISA
 $scope.gerarTituloTabela = function() {
        console.log("pesquisaPesagemController :gerarTituloTabela");
           // SE TEM REGISTRO NA BUSCA

           var $newDiv = $(' <h6 class="center-align">{{consulta.resultado}}  Resultados encontrados: </h6>');

           $injector.invoke(function($compile) {
               var div = $compile($newDiv);
               var content = div($scope);
               $("#divdinamica").append(content);
           });
       }
  $scope.gerarCorpoTabela = function(consulta) {
        console.log("pesquisaPesagemController :gerarCorpoTabela");
           // SE TEM REGISTRO NA BUSCA
          
           // se BUSCA POR TICKET saida
           if ($scope.pesquisa.hasOwnProperty('ticket') && $scope.pesquisa.ticket !== "" ) {
            console.log("Pesquisa por ticket");
             $scope.pesagem = consulta;

             $cookies.putObject('impressao', consulta);
             // passando busca para cookies para impressao e colocando dados no objeto de impressao

            if(consulta.status === "SAIDA"){

              var $newDiv = $('<table class="highlight-table center-align responsive-table ">'+
            '<thead>'+
          '<tr>'+
              '<th>Ticket</th>'+
              '<th>Tipo de pesagem</th>'+
              '<th>Data saida </th>'+
              '<th>Placa</th>'+
              '<th>Cliente</th>'+
              '<th>Fornecedor</th>'+
              '<th>Produto</th>'+
          '</tr>'+
        '</thead>'+
        '<tbody>'+
          '<tr>'+
            '<td>'+ consulta.id_pesagem + '</td>'+
            '<td>'+ consulta.status + '</td>'+
            '<td>'+ consulta.data_saida + '</td>'+
            '<td >'+ consulta.placa + '</td>'+
            '<td>'+ consulta.cliente + ' </td>'+
            '<td>'+ consulta.fornecedor + '</td>'+
            '<td>'+ consulta.produto + '</td>'+
          '</tr>'+
        '</tbody>'+
      '</table>' +
      '<button class="btn waves-effect waves-light"  id="reimpressaopesagemsaida"  ui-sref="layoutMeiaPag_saidaReimpressao"   >Reimprimir Ticket SAIDA</button>');

            }

             if(consulta.status === "ENTRADA"){

              var $newDiv = $('<table class="highlight-table center-align responsive-table ">'+
            '<thead>'+
          '<tr>'+
              '<th>Ticket</th>'+
              '<th>Tipo de pesagem</th>'+
              '<th>Data </th>'+
              '<th>Placa</th>'+
              '<th>Cliente</th>'+
              '<th>Fornecedor</th>'+
              '<th>Produto</th>'+
          '</tr>'+
        '</thead>'+
        '<tbody>'+
          '<tr>'+
            '<td>'+ consulta.id_pesagem + '</td>'+
            '<td>'+ consulta.status + '</td>'+
            '<td>'+ consulta.data + '</td>'+
            '<td >'+ consulta.placa + '</td>'+
            '<td>'+ consulta.cliente + ' </td>'+
            '<td>'+ consulta.fornecedor + '</td>'+
            '<td>'+ consulta.produto + '</td>'+
          '</tr>'+
        '</tbody>'+
      '</table>' +
      '<button class="btn waves-effect waves-light"  id="pesagememtrada"  ui-sref="layoutMeiaPag_entrada"   >Reimprimir Ticket ENTRADA</button>');

            }

             if(consulta.status === "MANUAL"){

              var $newDiv = $('<table class="highlight-table center-align responsive-table ">'+
            '<thead>'+
          '<tr>'+
              '<th>Ticket</th>'+
              '<th>Tipo de pesagem</th>'+
              '<th>Data </th>'+
              '<th>Placa</th>'+
              '<th>Cliente</th>'+
              '<th>Fornecedor</th>'+
              '<th>Produto</th>'+
          '</tr>'+
        '</thead>'+
        '<tbody>'+
          '<tr>'+
            '<td>'+ consulta.id_pesagem + '</td>'+
            '<td>'+ consulta.status + '</td>'+
            '<td>'+ consulta.data + '</td>'+
            '<td >'+ consulta.placa + '</td>'+
            '<td>'+ consulta.cliente + ' </td>'+
            '<td>'+ consulta.fornecedor + '</td>'+
            '<td>'+ consulta.produto + '</td>'+
          '</tr>'+
        '</tbody>'+
      '</table>' +
      '<button class="btn waves-effect waves-light"  id="pesagememtrada"  ui-sref="layoutMeiaPag"   >Reimprimir Ticket MANUAL</button>');

            }
            if(consulta.status === "AVULSA"){

              var $newDiv = $('<table class="highlight-table center-align responsive-table ">'+
            '<thead>'+
          '<tr>'+
              '<th>Ticket</th>'+
              '<th>Tipo de pesagem</th>'+
              '<th>Data </th>'+
              '<th>Placa</th>'+
              '<th>Cliente</th>'+
              '<th>Fornecedor</th>'+
              '<th>Produto</th>'+
          '</tr>'+
        '</thead>'+
        '<tbody>'+
          '<tr>'+
            '<td>'+ consulta.id_pesagem + '</td>'+
            '<td>'+ consulta.status + '</td>'+
            '<td>'+ consulta.data + '</td>'+
            '<td >'+ consulta.placa + '</td>'+
            '<td>'+ consulta.cliente + ' </td>'+
            '<td>'+ consulta.fornecedor + '</td>'+
            '<td>'+ consulta.produto + '</td>'+
          '</tr>'+
        '</tbody>'+
      '</table>' +
      '<button class="btn waves-effect waves-light"  id="pesagemavulsa"  ui-sref="layoutMeiaPag_avulsa"   >Reimprimir Ticket AVULSA</button>');

            }

           } else{

             var $newDiv = $('<table class="highlight-table center-align responsive-table ">'+
            '<thead>'+
          '<tr>'+
              '<th>Ticket</th>'+
              '<th>Tipo de pesagem</th>'+
              '<th>Data </th>'+
              '<th>Placa</th>'+
              '<th>Cliente</th>'+
              '<th>Fornecedor</th>'+
              '<th>Produto</th>'+
          '</tr>'+
        '</thead>'+
        '<tbody>'+
          '<tr>'+
            '<td>'+ consulta.id_pesagem + '</td>'+
            '<td>'+ consulta.status + '</td>'+
            '<td>'+ consulta.data + '</td>'+
            '<td >'+ consulta.placa + '</td>'+
            '<td>'+ consulta.cliente + ' </td>'+
            '<td>'+ consulta.fornecedor + '</td>'+
            '<td>'+ consulta.produto + '</td>'+
          '</tr>'+
          
        '</tbody>'+
      '</table>');

           }

           $injector.invoke(function($compile) {
               var div = $compile($newDiv);
               var content = div($scope);
               $("#divdinamica").append(content);
           });
       }

$scope.consultarIdItensDescontos = function() {
            // ORDEM DE CONSULTA
            // 1 CONSULTA OS ITENS_DESCONTO consultarIdItensDescontos
            //2 CONSULTA O NOME DO DESCONTO E ADD NO OBJETO consultarNomeDescontos
            //3 CONSULTA OS DESCONTOS APLICADOS E ADD NO OBJETO consultarDescontosAplicados
           console.log("pesquisaPesagemController :consultarIdItensDescontos"); 
            var listaDesconto = [];
             var request = $http({
                 method: "post",
                 url: "php/itens_desconto/pesquisarid_pesagem_itens_desconto.php",
                 data: $scope.pesquisa.ticket,
                 headers: {
                     'Content-Type': 'application/x-www-form-urlencoded'
                 }
             });
                 request.then(function(response) {
                    if(!angular.isUndefined(response.data.status)){
                        console.log("SEM DESCONTOS");
                    }else{
                         $scope.Lista_descontos =response.data; // colocando os resultados da  
                        $scope.consultarNomeDescontos();    
                         } // FIM ELSE
                 }, function(response) {
                     console.log("ERROR" + response);
                 });
    }

    $scope.consultarNomeDescontos = function() {
           console.log("pesquisaPesagemController :consultarIdItensDescontos"); 
           var i = 0; /// variavel usada no do while
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
            console.log("pesquisaPesagemController :consultarDescontosAplicados");
              var request = $http({
                 method: "post",
                 url: "php/desconto_aplicado/pesquisardescontoaplicado_saida.php",
                 data: $scope.Lista_descontos,
                 headers: {
                     'Content-Type': 'application/x-www-form-urlencoded'
                 }
             });
             request.then(function(response) {
                $scope.Lista_descontos =response.data; // colocando os resultados da 
                console.log("consultar DescontosAplicados",$scope.Lista_descontos);
                $cookies.putObject('impressaoDescontos_TESTE', $scope.Lista_descontos);
             }, function(response) {
                 console.log("ERROR" + response);
             });
    }

$scope.pesquisarpesagem = function() {

        console.log("pesquisaPesagemController :pesquisarpesagem");
if ($scope.pesquisa.hasOwnProperty('ticket') && $scope.pesquisa.ticket !== "" ) {
  console.log("Pesquisa por ticket: consultar descontos");
  $scope.consultarIdItensDescontos();
}
            


          console.log($scope.pesquisa);
          $scope.teste = 0;
               $('#divdinamica').empty();
           var request = $http({
               method: "post",
               url: "php/pesagem/pesquisarpesagem.php",
               data: $scope.pesquisa,
               headers: {
                   'Content-Type': 'application/x-www-form-urlencoded'
               }
           });
               request.then(function(response) {
                console.log(response.data);

                   $scope.myText = "";
                   var filhoScope = $scope.$new();
                   $scope.consulta = response.data;
 
                    $scope.consulta.resultado =   Object.getOwnPropertyNames(response.data).length - 1;
                   if ($scope.consulta.resultado == 0) {
                       console.log(" if sem resposta");
                       var $newDiv = $("<div class='row'>" +
                           "<div class='col s9 '>" +
                           "<div class='card blue-grey darken-1'>" +
                           "<div class='card-content white-text'>" +
                           "<span class='card-title'> " + 'SEM REGISTRO' + " </span>" +
                           "<div class='card-content' id='teste' ng-show='mostrar'>" +
                           "<p> </p>" +
                           "</div>" +
                           "<div class='card-action'>" +
                           "</div>" +
                           " </div>" +
                           " </div>" +
                           "</div>" +
                           "</div>");
                       $('#divdinamica').empty();
                       $injector.invoke(function($compile) {
                           var div = $compile($newDiv);
                           var content = div($scope);
                           $("#divdinamica").append(content);
                       });
                   } else {
                       $('#divdinamica').empty();
                       angular.forEach(response.data, function(value, key) {
                        if($scope.teste === 0){
 
                           $scope.myText = $scope.gerarTituloTabela();// gera titulo tabela uma
                           $scope.teste = 1;
                        }
                           $scope.myText = $scope.myText + $scope.gerarCorpoTabela(value);
                       });
                   }
               }, function(response) {
                   console.log("ERROR" + response);
               });
       }
/// FIM DO TESTE TABELA DINAMICA
}
   angular
       .module('home')
       .controller('pesquisaPesagemController', pesquisaPesagemController);