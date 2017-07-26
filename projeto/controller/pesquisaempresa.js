/*
Aqui tem: atualizado o comentario em. 08 06 17 por Stenio.
$scope.pesquisarcnpj = function() 
faz a pesquisa no banco de dados por cnpj e retorna os resultados
$scope.pesquisarnome = function() 
faz a pesquisa no banco de dados por nome e retorna os resultados
$scope.pesquisarcpf = function() 
faz a pesquisa no banco de dados por cpf e retorna os resultados
$scope.pesquisar = function() 
Conecta no banco de dados e retorna todos os dados por meio da função
buscar do arquivo daocliente.class.php
$scope.gerarcartaocpf = function(empresa) 
aqui é onde será gerado o cartão com o resultado da pesquisa.
essa função cria um layout dinamico para o usario, faz parte do
processo de single page. foi dificil fazer isso rodar liso.
se der problema aqui vc provavelmente se FUDEU.
$scope.editar = function(id) 
chama a pagina editacliente e todo protocolo de edição do dado e controle da pagina 
estão dos arquivos deletecliente.js. logica embaçada de explicar. mas seguindo as funçoes 
os links entre os arquivos vc relembra se precisar. Boa sorte.
$scope.delete = function(id) 
mesmo caso da função acima se precisar alterar se FUDEU.

*/

function pesquisaEmpresaController($scope, $http, $compile, $injector, $cookieStore) {
 
$scope.delete = function(id) {
          console.log(id);
          $cookieStore.put('deleteempresa', id);
      }
 
      $scope.editar = function(id) {
          console.log(id);
          $cookieStore.put('editarempresa', id);
      }

  
$scope.gerarcartaocpf = function(empresa) {
        // SE TEM REGISTRO NA BUSCA
    
          var $newDiv = $("<div class='row'>" +
              "<div class='col s6 '>" +
              "<div class='card blue-grey darken-1'>" +
              "<div class='card-content white-text'>" +
              "<p> Nome: </p>" +
              "<span class='card-title'> " + empresa.nome + " </span>" +
              "<p> CPF </p>" +
              "<span class='card-title'> " + empresa.cpf + " </span>" +
              "<p> ... </p>" +
              "<div class='card-content' id='teste' ng-show='mostrar'>" +
              "<div class='row'>"+
              "<div class='col s12'> Endereço:  "  + empresa.endereco + "</div>"+
               
              "<div class='col s6'> Cidade:  "  + empresa.cidade + "</div>"+
              "<div class='col s6'> Estado:  "  + empresa.estado + "</div>"+
              "<div class='col s12' mask='(99) 9?9999-9999'> Telefone:  "  + empresa.telefone + "</div>"+
              "<div class='col s12' > Email:  "  + empresa.email + "</div>"+
              "</div>"+
               
  
              //é aqui que vai rodar os detalhes
              "</div>" +
              "<div class='card-action'>" +
              "<a class='btn  waves-effect waves-light red' ng-click='delete(" + empresa.id_empresa + ")' ui-sref='deleteempresa'>Deletar</a>" +
              "<a class='btn  waves-effect waves-light red' ng-click='editar(" + empresa.id_empresa + ")' ui-sref='editarempresa'>Editar Cadastro</a>" +
              "<a href='' ng-click='mostrar=true'  ng-show='!mostrar'>Detalhes</a>" +
              "<a href='' ng-click='mostrar=false'  ng-show='mostrar'>Ocultar Detalhes</a>" +
              "</div>" +
              " </div>" +
              " </div>" +
              "</div>" +
              "</div>");

          $injector.invoke(function($compile) {
              var div = $compile($newDiv);
              var content = div($scope);
              $("#divdinamica").append(content);
          });
           
      }

$scope.gerarcartaocnpj = function(empresa) {
        // SE TEM REGISTRO NA BUSCA
    
          var $newDiv = $("<div class='row'>" +
              "<div class='col s6 '>" +
              "<div class='card blue-grey darken-1'>" +
              "<div class='card-content white-text'>" +
              "<p> Nome: </p>" +
              "<span class='card-title'> " + empresa.nome + " </span>" +
              "<p> CNPJ </p>" +
              "<span class='card-title'> " + empresa.cnpj + " </span>" +
              "<p> ... </p>" +
              "<div class='card-content' id='teste' ng-show='mostrar'>" +
              "<div class='row'>"+
              "<div class='col s12'> Endereço:  "  + empresa.endereco + "</div>"+
               
              "<div class='col s6'> Cidade:  "  + empresa.cidade + "</div>"+
              "<div class='col s6'> Estado:  "  + empresa.estado + "</div>"+
              "<div class='col s12' mask='(99) 9?9999-9999'> Telefone:  "  + empresa.telefone + "</div>"+
              "<div class='col s12' > Email:  "  + empresa.email + "</div>"+
              "</div>"+
               
  
              //é aqui que vai rodar os detalhes
              "</div>" +
              "<div class='card-action'>" +
              "<a class='btn  waves-effect waves-light red' ng-click='delete(" + empresa.id_empresa + ")' ui-sref='deleteempresa'>Deletar</a>" +
              "<a class='btn  waves-effect waves-light red' ng-click='editar(" + empresa.id_empresa + ")' ui-sref='editarempresa'>Editar Cadastro</a>" +
              "<a href='' ng-click='mostrar=true'  ng-show='!mostrar'>Detalhes</a>" +
              "<a href='' ng-click='mostrar=false'  ng-show='mostrar'>Ocultar Detalhes</a>" +
              "</div>" +
              " </div>" +
              " </div>" +
              "</div>" +
              "</div>");

          $injector.invoke(function($compile) {
              var div = $compile($newDiv);
              var content = div($scope);
              $("#divdinamica").append(content);
          });
           
      }





$scope.gerarcartaonome = function(empresa) {
        // SE TEM REGISTRO NA BUSCA
    
          var $newDiv = $("<div class='row'>" +
              "<div class='col s6 '>" +
              "<div class='card blue-grey darken-1'>" +
              "<div class='card-content white-text'>" +
              "<p> Nome: </p>" +
              "<span class='card-title'> " + empresa.nome + " </span>" +
              "<p> CPF </p>" +
              "<span class='card-title'> " + empresa.cpf + " </span>" +
              "<p> CNPJ </p>" +
              "<span class='card-title'> " + empresa.cnpj + " </span>" +
              "<p> ... </p>" +
              "<div class='card-content' id='teste' ng-show='mostrar'>" +
              "<div class='row'>"+
              "<div class='col s12'> Endereço:  "  + empresa.endereco + "</div>"+
               
              "<div class='col s6'> Cidade:  "  + empresa.cidade + "</div>"+
              "<div class='col s6'> Estado:  "  + empresa.estado + "</div>"+
              "<div class='col s12' mask='(99) 9?9999-9999'> Telefone:  "  + empresa.telefone + "</div>"+
              "<div class='col s12' > Email:  "  + empresa.email + "</div>"+
              "</div>"+
               
  
              //é aqui que vai rodar os detalhes
              "</div>" +
              "{{empresa.id_empresa}}"+
              "<div class='card-action'>" +
              "<a class='btn  waves-effect waves-light red' ng-click='delete(" + empresa.id_empresa + ")' ui-sref='deleteempresa'>Deletar</a>" +
              "<a class='btn  waves-effect waves-light red' ng-click='editar(" + empresa.id_empresa + ")' ui-sref='editarempresa'>Editar Cadastro</a>" +
              "<a href='' ng-click='mostrar=true'  ng-show='!mostrar'>Detalhes</a>" +
              "<a href='' ng-click='mostrar=false'  ng-show='mostrar'>Ocultar Detalhes</a>" +
              "</div>" +
              " </div>" +
              " </div>" +
              "</div>" +
              "</div>");

          $injector.invoke(function($compile) {
              var div = $compile($newDiv);
              var content = div($scope);
              $("#divdinamica").append(content);
          });
           
      }

 
$scope.pesquisar = function() {
          var request = $http({
              method: "post",
              url: "php/empresa/pesquisarempresa.php",
              data: $scope.empresa,
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
              }
          });
          /* Successful HTTP post request or not */
          request.then(function(response) {

              console.log(response.data);
              $scope.Empresa = response.data;
              angular.forEach(response.data, function(value, key) {
                  //   $scope.myText = $scope.myText + $scope.gerarcartao(value);
                  console.log($scope.myText);
              });
          }, function(response) {
              console.log("ERROR" + response);
          });
      }
 
$scope.pesquisarcpf = function() {
 // console.log("entrou aqui função pesquisa dentro de pesquisaempresa");
 //console.log($scope.pesquisa);
          if ($scope.pesquisa.cpf.length === 0){
             $('#divdinamica').empty();
            console.log("considerou pesquisa cpf length 0");
          }
             
          else {
 
              var request = $http({
                  method: "post",
                  url: "php/empresa/pesquisarempresacpf.php",
                  data: $scope.pesquisa,
                  headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                  }

              });
 
 

              request.then(function(response) {
 

                  $scope.myText = "";
                  var filhoScope = $scope.$new();
                  
                  $scope.Empresa = response.data;
                  console.log("depois de receber a resposta do php");
                   
                  console.log($scope.Empresa[0]);
                  if ($scope.Empresa[0] == 0) {
                    
                    console.log( " if sem resposta");
                    var $newDiv = $("<div class='row'>" +
              "<div class='col s6 '>" +
              "<div class='card blue-grey darken-1'>" +
              "<div class='card-content white-text'>" +
                
              "<span class='card-title'> " +'SEM REGISTRO'+ " </span>" +
              
              "<div class='card-content' id='teste' ng-show='mostrar'>" +

              //é aqui que vai rodar os detalhes

              //
              "<p> </p>" +
              "</div>" +
              "<div class='card-action'>" +
            //  "<a class='btn  waves-effect waves-light red'  ui-sref='deleteempresa'>Deletar</a>" +
            //  "<a class='btn  waves-effect waves-light red'  ui-sref='editarempresa'>Editar Cadastro</a>" +
            //  "<a href='' ng-click='mostrar=true'  ng-show='!mostrar'>Detalhes</a>" +
            //  "<a href='' ng-click='mostrar=false'  ng-show='mostrar'>Ocultar Detalhes</a>" +
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
                          $scope.myText = $scope.myText + $scope.gerarcartaocpf(value);
                      });



                  }


              }, function(response) {
                  console.log("ERROR" + response);
              });


          }

      }
 
$scope.pesquisarnome = function() {
          if ($scope.pesquisa.nome.length === 0){
             $('#divdinamica').empty();
            console.log("considerou pesquisa nome length 0");
          }
             
          else {

              var request = $http({
                  method: "post",
                  url: "php/empresa/pesquisarempresanome.php",
                  data: $scope.pesquisa,
                  headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                  }
              });

              request.then(function(response) {

                  $scope.myText = "";
                  var filhoScope = $scope.$new();
                  $scope.Empresa = response.data;
                  console.log($scope.Empresa[0]);
                  if ($scope.Empresa[0] == 0) {
                    
                    console.log( " if sem resposta");
                    var $newDiv = $("<div class='row'>" +
              "<div class='col s6 '>" +
              "<div class='card blue-grey darken-1'>" +
              "<div class='card-content white-text'>" +
                
              "<span class='card-title'> " +'SEM REGISTRO'+ " </span>" +
              
              "<div class='card-content' id='teste' ng-show='mostrar'>" +

              //é aqui que vai rodar os detalhes

              //
              "<p> </p>" +
              "</div>" +
              "<div class='card-action'>" +
          //    "<a class='btn  waves-effect waves-light red'  ui-sref='deleteempresa'>Deletar</a>" +
          //    "<a class='btn  waves-effect waves-light red'  ui-sref='editarempresa'>Editar Cadastro</a>" +
          //    "<a href='' ng-click='mostrar=true'  ng-show='!mostrar'>Detalhes</a>" +
          //    "<a href='' ng-click='mostrar=false'  ng-show='mostrar'>Ocultar Detalhes</a>" +
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
                        // aqui tenho que chamar o cartão nome mas adaptei pra ser 
                        // a mesma função que gera o cartão cpf.
                          $scope.myText = $scope.myText + $scope.gerarcartaonome(value);
                      });



                  }


              }, function(response) {
                  console.log("ERROR" + response);
              });


          }

      }


$scope.pesquisarcnpj = function() {
          if ($scope.pesquisa.cnpj.length === 0){
             $('#divdinamica').empty();
            console.log("considerou pesquisa cnpj length 0");
          }
             
          else {

              var request = $http({
                  method: "post",
                  url: "php/empresa/pesquisarempresacnpj.php",
                  data: $scope.pesquisa,
                  headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                  }
              });

              request.then(function(response) {

                  $scope.myText = "";
                  var filhoScope = $scope.$new();
                  $scope.Empresa = response.data;
                  console.log($scope.Empresa[0]);
                  if ($scope.Empresa[0] == 0) {
                    
                    console.log( " if sem resposta");
                    var $newDiv = $("<div class='row'>" +
              "<div class='col s6 '>" +
              "<div class='card blue-grey darken-1'>" +
              "<div class='card-content white-text'>" +
                
              "<span class='card-title'> " +'SEM REGISTRO'+ " </span>" +
              
              "<div class='card-content' id='teste' ng-show='mostrar'>" +

              //é aqui que vai rodar os detalhes

              //
              "<p> </p>" +
              "</div>" +
              "<div class='card-action'>" +
          //    "<a class='btn  waves-effect waves-light red'  ui-sref='deleteempresa'>Deletar</a>" +
          //    "<a class='btn  waves-effect waves-light red'  ui-sref='editarempresa'>Editar Cadastro</a>" +
          //    "<a href='' ng-click='mostrar=true'  ng-show='!mostrar'>Detalhes</a>" +
         //     "<a href='' ng-click='mostrar=false'  ng-show='mostrar'>Ocultar Detalhes</a>" +
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
                          $scope.myText = $scope.myText + $scope.gerarcartaocnpj(value);
                      });



                  }


              }, function(response) {
                  console.log("ERROR" + response);
              });


          }

      }
















	}
  
  angular
      .module('home')
      .controller('pesquisaEmpresaController', pesquisaEmpresaController);