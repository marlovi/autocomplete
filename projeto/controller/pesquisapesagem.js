    function pesquisaPesagemController($scope, $http, $compile, $injector, $cookieStore) {

// TENTANDO GERAR TABELA DINAMICA COM OS RESULTADOS DA PESQUISA
 $scope.gerarTituloTabela = function() {
        console.log("pesquisaPesagemController :gerarTituloTabela");
           // SE TEM REGISTRO NA BUSCA

           var $newDiv = $('<table class="highlight-table center-align ">'+
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
      '</table>');

           $injector.invoke(function($compile) {
               var div = $compile($newDiv);
               var content = div($scope);
               $("#divdinamica").append(content);
           });
       }

  $scope.gerarCorpoTabela = function(consulta) {
        console.log("pesquisaPesagemController :gerarCorpoTabela");
           // SE TEM REGISTRO NA BUSCA

           var $newDiv = $('<table class="highlight-table center-align ">'+
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

           $injector.invoke(function($compile) {
               var div = $compile($newDiv);
               var content = div($scope);
               $("#divdinamica").append(content);
           });
       }



$scope.pesquisarpesagem = function() {
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
                   console.log($scope.consulta[0]);
                   if ($scope.consulta[0] == 0) {
                       console.log(" if sem resposta");
                       var $newDiv = $("<div class='row'>" +
                           "<div class='col s6 '>" +
                           "<div class='card blue-grey darken-1'>" +
                           "<div class='card-content white-text'>" +

                           "<span class='card-title'> " + 'SEM REGISTRO' + " </span>" +

                           "<div class='card-content' id='teste' ng-show='mostrar'>" +

                           //é aqui que vai rodar os detalhes

                           //
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