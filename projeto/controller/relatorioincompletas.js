    function relatorioincompletasController($scope, $http, $log, $mdDialog,  $compile, $injector, $cookieStore, $cookies) {

 $scope.gerarTituloTabela = function() {
        console.log("relatorioincompletasController :gerarTituloTabela");
           var $newDiv = $(' <h6 class="center-align">{{consulta.resultado}}  Resultados encontrados: </h6>');
           $injector.invoke(function($compile) {
               var div = $compile($newDiv);
               var content = div($scope);
               $("#divdinamica").append(content);
           });
       }

$scope.gerarCorpoTabelaIncompletas = function(consulta) {
 // console.log(consulta);
              if(consulta.hasOwnProperty('id_pesagem')){
                console.log("relatorioincompletasController :gerarCorpoTabela");
                $cookies.putObject('impressao', consulta);
              var $newDiv = $('<table class="highlight-table center-align responsive-table ">'+
            '<thead>'+
          '<tr>'+
              '<th>Ticket</th>'+
              '<th>Tipo de pesagem</th>'+
              '<th>Data </th>'+
              '<th>Placa</th>'+
          '</tr>'+
        '</thead>'+
        '<tbody>'+
          '<tr>'+
            '<td>'+ consulta.id_pesagem + '</td>'+
            '<td>'+ consulta.status + '</td>'+
            '<td>'+ consulta.data + '</td>'+
            '<td >'+consulta.placa + '</td>'+
          '</tr>'+
        '</tbody>'+
      '</table>');
           $injector.invoke(function($compile) {
               var div = $compile($newDiv);
               var content = div($scope);
               $("#divdinamica").append(content);
           });
              }     
       }

 $scope.relatorioincompletas = function() {
  $scope.incompletas=[]; // AQUI ENTRA AS PESAGENS INCOMPLETAS
listaVeiculos();
        //consultaPesagemIncompletasManual
        // FUNÇÃO QUE FAZ LISTA DE VEICULOS CADASTRADOS
        function listaVeiculos() {
                    var request = $http({
                        method: "post",
                        url: "php/veiculo/pesquisarveiculo.php",
                        data: 0,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    });
                        request.then(function(response) {
                           // console.log("lista de veiculos");
                           // console.log(response.data);
                          for(var i in response.data){
                  consultaPesagem(response.data[i].id_veiculo);

                            //consultaPesagem(response.data[i].id_veiculo);
                          }
                        
                        }, function(response) {
                              console.log("ERROR" + response);
                            });
        }// fim lista veiculos

        // FUNÇÃO QUE FAZ TESTE COM A LISTA DE VEICULOS CADASTRADOS
         function consultaPesagem(item) {
                      // item = 129; // VEICULO COM PESAGEM DE ENTRADA EM ABERTO
                      //item = 131; // VEICULO COM PESAGEM DE ENTRADA OK
                      // FUNÇÃO QUE CONSULTA AS PESAGENS RELACIONADAS POR ID VEICULO PLACA
                      // OBJETIVO RETORNAR 
                      // consultar se a placa tem pesagem 
                      // contar quantas pesagem de entrada
                      // contar quantas pesagem de saida
                      // informar qual numero do ticket em aberto
                      // informar qual é a placa do ticket 
                        var request = $http({
                          method: "post",
                          url: "php/pesagem/consultaplacaincompletasentrada.php",
                          data: item,
                          headers: {
                              'Content-Type': 'application/x-www-form-urlencoded'
                          }
                      });
                      request.then(function(response) {
                          var id_pesagem_entrada = [];
                          var cont_pesagem_entrada = 0;
                          var id_pesagem_saida = [];
                          var cont_pesagem_saida = 0;
                          var cont_pesagem_manual = 0;
                          var cont_pesagem_avulsa = 0;
                          for (var i in response.data) {
                              //arr.push(response.data[i].status);  
                              if (response.data[i].status === "PESAGEM ENTRADA") {
                                  cont_pesagem_entrada = cont_pesagem_entrada + 1;
                                  id_pesagem_entrada = response.data[i].id_pesagem; // separando as pesagens de entrada
                              } else if (response.data[i].status === "PESAGEM MANUAL") {
                                  cont_pesagem_manual = cont_pesagem_manual + 1;
                              } else if (response.data[i].status === "PESAGEM SAIDA") {
                                  cont_pesagem_saida = cont_pesagem_saida + 1;
                              } else if (response.data[i].status === "PESAGEM AVULSA") {
                                  cont_pesagem_avulsa = cont_pesagem_avulsa + 1;
                              }
                          }
                         // console.log(item);
                         // console.log("contador de eventos");
                         // console.log("entrada");
                          //console.log(cont_pesagem_entrada);
                        //  console.log("saida");
                        //  console.log(cont_pesagem_saida);
                          // se pesagem de entrada for maior que pesagem de saida
                          // isso quer dizer que esse veiculo está no patio
                          // com pesagem de entrada em aberto. então o sistema limpa a placa
                          // se pesagem de saida  ==  a pesagem de entra 
                          // então o sistema pode registrar nova pesagem
                          // as pesagem avulsa e manual nao entraram no processo de
                          // de controle de entrada e saida
                          if (cont_pesagem_entrada === cont_pesagem_saida) {
                
                          } else {
                                    if (cont_pesagem_entrada >= cont_pesagem_saida) {
                                                //  console.log("permitido pesagem de SAIDA");
                                                //  console.log("ultimo id");
                                                //  console.log(id_pesagem_entrada);
                                                  // aqui depois de saber qual foi a ultima pesagem de entrada
                                                  // envio esse id para saber os dados da pesagem de entrada
                                                  var request = $http({
                                                      method: "post",
                                                      url: "php/pesagem/consultaplacaincompletassaida.php",
                                                      data: id_pesagem_entrada,
                                                      headers: {
                                                          'Content-Type': 'application/x-www-form-urlencoded'
                                                      }
                                                  });
                                                        request.then(function(response) {
                                                          //  console.log("resposta da consulta da ultima pesagem de entrada");
                                                             angular.forEach(response.data, function(value, key) {
                                                              $scope.incompletas.push( response.data[key]);
                                                             },  $scope.incompletas); 
                                                            $('#divdinamica').empty();
                                                             $scope.myText = $scope.gerarTituloTabela();// gera titulo tabela uma
                                                               for(var i in $scope.incompletas){
                                                                         if($scope.incompletas[i].hasOwnProperty('id_pesagem')){
                                                                          $scope.myText =$scope.myText + $scope.gerarCorpoTabelaIncompletas($scope.incompletas[i]);
                                                                         }
                                                                }
                                                          
                                                        }, function(response) {
                                                                console.log("ERROR" + response);
                                                            });
                                  } 
                              }
                      }, function(response) {
                          console.log("ERROR" + response);
                      });
         }// fim consulta pesagem

 }// fim relatorio incompletas

}
   angular
       .module('home')
       .controller('relatorioincompletasController', relatorioincompletasController);