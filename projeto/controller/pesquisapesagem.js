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
      '<button class="btn waves-effect waves-light"  id="pesagemsaida"  ui-sref="layoutMeiaPag_saida"   >Reimprimir Ticket SAIDA</button>');

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
$scope.pesquisarpesagem = function() {
  console.log($scope.pesquisa)
  $scope.teste = 0;
        console.log("pesquisaPesagemController :pesquisarpesagem");
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

                   $scope.myText = "";
                   var filhoScope = $scope.$new();
                   $scope.consulta = response.data;
                   //console.log($scope.consulta);
                   //console.log($scope.consulta[0]);
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