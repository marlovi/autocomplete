  function pesquisaFornecedorController($scope, $http, $compile, $injector, $cookieStore){
 
      $scope.delete = function(id) {
          console.log(id);
          $cookieStore.put('deletefornecedor', id);
      }

      $scope.editar = function(id) {
          console.log(id);
          $cookieStore.put('editarfornecedor', id);
      }

      $scope.gerarcartaocpf = function(fornecedor) {

          var $newDiv = $("<div class='row'>" +
              "<div class='col s6 '>" +
              "<div class='card blue-grey darken-1'>" +
              "<div class='card-content white-text'>" +
              "<p> Nome: </p>" +
              "<span class='card-title'> " + fornecedor.nome + " </span>" +
              "<p> CPF </p>" +
              "<span class='card-title'> " + fornecedor.cpf + " </span>" +
              "<p> ... </p>" +
              "<div class='card-content' id='teste' ng-show='mostrar'>" +
              "<div class='row'>"+
              "<div class='col s12'> Endereço:  "  + fornecedor.endereco + "</div>"+
               
              "<div class='col s6'> Cidade:  "  + fornecedor.cidade + "</div>"+
              "<div class='col s6'> Estado:  "  + fornecedor.estado + "</div>"+
              "<div class='col s12' mask='(99) 9?9999-9999'> Telefone:  "  + fornecedor.telefone + "</div>"+
              "<div class='col s12' > Email:  "  + fornecedor.email + "</div>"+
              "</div>"+
               
  
              //é aqui que vai rodar os detalhes
              "</div>" +
              "<div class='card-action'>" +
              "<a class='btn  waves-effect waves-light red' ng-click='delete(" + fornecedor.id_fornecedor + ")' ui-sref='deletefornecedor'>Deletar</a>" +
              "<a class='btn  waves-effect waves-light red' ng-click='editar(" + fornecedor.id_fornecedor + ")' ui-sref='editarfornecedor'>Editar Cadastro</a>" +
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


      $scope.gerarcartaocnpj = function(fornecedor) {
        // SE TEM REGISTRO NA BUSCA
    
          var $newDiv = $("<div class='row'>" +
              "<div class='col s6 '>" +
              "<div class='card blue-grey darken-1'>" +
              "<div class='card-content white-text'>" +
              "<p> Nome: </p>" +
              "<span class='card-title'> " + fornecedor.nome + " </span>" +
              "<p> CNPJ </p>" +
              "<span class='card-title'> " + fornecedor.cnpj + " </span>" +
              "<p> ... </p>" +
              "<div class='card-content' id='teste' ng-show='mostrar'>" +
              "<div class='row'>"+
              "<div class='col s12'> Endereço:  "  + fornecedor.endereco + "</div>"+
               
              "<div class='col s6'> Cidade:  "  + fornecedor.cidade + "</div>"+
              "<div class='col s6'> Estado:  "  + fornecedor.estado + "</div>"+
              "<div class='col s12' mask='(99) 9?9999-9999'> Telefone:  "  + fornecedor.telefone + "</div>"+
              "<div class='col s12' > Email:  "  + fornecedor.email + "</div>"+
              "</div>"+
              //é aqui que vai rodar os detalhes
              "</div>" +
              "<div class='card-action'>" +
              "<a class='btn  waves-effect waves-light red' ng-click='delete(" + fornecedor.id_fornecedor + ")' ui-sref='deletefornecedor'>Deletar</a>" +
              "<a class='btn  waves-effect waves-light red' ng-click='editar(" + fornecedor.id_fornecedor + ")' ui-sref='editarfornecedor'>Editar Cadastro</a>" +
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

      $scope.gerarcartaonome = function(fornecedor) {

          var $newDiv = $("<div class='row'>" +
              "<div class='col s6 '>" +
              "<div class='card blue-grey darken-1'>" +
              "<div class='card-content white-text'>" +
              "<p> Nome: </p>" +
              "<span class='card-title'> " + fornecedor.nome + " </span>" +
              "<p> CPF </p>" +
              "<span class='card-title'> " + fornecedor.cpf + " </span>" +
              "<p> CNPJ </p>" +
              "<span class='card-title'> " + fornecedor.cnpj + " </span>" +
              "<p> ... </p>" +
              "<div class='card-content' id='teste' ng-show='mostrar'>" +
              "<div class='row'>"+
              "<div class='col s12'> Endereço:  "  + fornecedor.endereco + "</div>"+
               
              "<div class='col s6'> Cidade:  "  + fornecedor.cidade + "</div>"+
              "<div class='col s6'> Estado:  "  + fornecedor.estado + "</div>"+
              "<div class='col s12' mask='(99) 9?9999-9999'> Telefone:  "  + fornecedor.telefone + "</div>"+
              "<div class='col s12' > Email:  "  + fornecedor.email + "</div>"+
              "</div>"+

              //é aqui que vai rodar os detalhes
              "</div>" +
              "<div class='card-action'>" +
              "<a class='btn  waves-effect waves-light red' ng-click='delete(" + fornecedor.id_fornecedor + ")' ui-sref='deletefornecedor'>Deletar</a>" +
              "<a class='btn  waves-effect waves-light red' ng-click='editar(" + fornecedor.id_fornecedor + ")' ui-sref='editarfornecedor'>Editar Cadastro</a>" +
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

      // teste 
      // fim teste
      // versao inicial dos teste de pesquisa nome. 
      // provavelmente criei um botao chamando essa função para testar 
      // conexao com o banco e o retorno.
      $scope.pesquisar = function() {
          var request = $http({
              method: "post",
              url: "php/fornecedor/pesquisarfornecedor.php",
              data: $scope.fornecedor,
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
              }
          });
          /* Successful HTTP post request or not */
          request.then(function(response) {
              console.log(response.data);
              $scope.Fornecedor = response.data;
              angular.forEach(response.data, function(value, key) {
                  //   $scope.myText = $scope.myText + $scope.gerarcartao(value);
                  console.log($scope.myText);
              });
          }, function(response) {
              console.log("ERROR" + response);
          });
      }
      // função que busca por nome e retorna so os nomes 
      // quando começa a digitar no formulario na pagina.
      // tem que tratar pra quando retornar do banco que 
      // nao existe o cadastro só uma vez o resultado nulo.
     

//função que o Marlus mandou por face.
// o problema era limpar a pagina quando fizesse uma nova consulta.
$scope.pesquisarcpf = function() {
          if ($scope.pesquisa.cpf.length === 0){
             $('#divdinamica').empty();
            console.log("considerou pesquisa cpf length 0");
          }
             
          else {

              var request = $http({
                  method: "post",
                  url: "php/fornecedor/pesquisarfornecedorcpf.php",
                  data: $scope.pesquisa,
                  headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                  }
              });

              request.then(function(response) {

                  $scope.myText = "";
                  var filhoScope = $scope.$new();
                  $scope.Fornecedor = response.data;
                  console.log($scope.Fornecedor[0]);
                  if ($scope.Fornecedor[0] == 0) {
                    
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
          //    "<a class='btn  waves-effect waves-light red'  ui-sref='deletefornecedor'>Deletar</a>" +
          //    "<a class='btn  waves-effect waves-light red'  ui-sref='editarfornecedor'>Editar Cadastro</a>" +
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
                          $scope.myText = $scope.myText + $scope.gerarcartaocpf(value);
                      });

                  }

              }, function(response) {
                  console.log("ERROR" + response);
              });

          }

      }

      $scope.pesquisarnome = function() {
          if ($scope.pesquisa.nome.length == 0){
             $('#divdinamica').empty();
            console.log("considerou pesquisa nome length 0");
          }
             
          else {

              var request = $http({
                  method: "post",
                  url: "php/fornecedor/pesquisarfornecedornome.php",
                  data: $scope.pesquisa,
                  headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                  }
              });

              request.then(function(response) {

                  $scope.myText = "";
                  var filhoScope = $scope.$new();
                  $scope.Fornecedor = response.data;
                  console.log($scope.Fornecedor[0]);
                  if ($scope.Fornecedor[0] == 0) {
                    
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
            //  "<a class='btn  waves-effect waves-light red'  ui-sref='deletefornecedor'>Deletar</a>" +
            //  "<a class='btn  waves-effect waves-light red'  ui-sref='editarfornecedor'>Editar Cadastro</a>" +
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
                  url: "php/fornecedor/pesquisarfornecedorcnpj.php",
                  data: $scope.pesquisa,
                  headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                  }
              });

              request.then(function(response) {

                  $scope.myText = "";
                  var filhoScope = $scope.$new();
                  $scope.Fornecedor = response.data;
                  console.log($scope.Fornecedor[0]);
                  if ($scope.Fornecedor[0] == 0) {
                    
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
          //    "<a class='btn  waves-effect waves-light red'  ui-sref='deletefornecedor'>Deletar</a>" +
          //    "<a class='btn  waves-effect waves-light red'  ui-sref='editarfornecedor'>Editar Cadastro</a>" +
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
      .controller('pesquisaFornecedorController', pesquisaFornecedorController);