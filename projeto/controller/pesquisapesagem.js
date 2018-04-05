    function pesquisaPesagemController($scope, $http, $compile, $injector, $cookieStore) {


       $scope.delete = function(id) {
        console.log("pesquisaPesagemController :delete");
           console.log(id);
           $cookieStore.put('deletecliente', id);
       }

       $scope.editar = function(id) {
        console.log("pesquisaPesagemController :editar");
           console.log(id);
           $cookieStore.put('editarcliente', id);
       }
       $scope.gerarcartaocpf = function(cliente) {
        console.log("pesquisaPesagemController :gerarcartaocpf");
           // SE TEM REGISTRO NA BUSCA

           var $newDiv = $("<div class='row'>" +
               "<div class='col s6 '>" +
               "<div class='card blue-grey darken-1'>" +
               "<div class='card-content white-text'>" +
               "<p> Nome: </p>" +
               "<span class='card-title'> " + cliente.nome + " </span>" +
               "<p> CPF </p>" +
               "<span class='card-title'> " + cliente.cpf + " </span>" +
               "<p> ... </p>" +
               "<div class='card-content' id='teste' ng-show='mostrar'>" +
               "<div class='row'>" +
               "<div class='col s12'> Endereço:  " + cliente.endereco + "</div>" +

               "<div class='col s6'> Cidade:  " + cliente.cidade + "</div>" +
               "<div class='col s6'> Estado:  " + cliente.estado + "</div>" +
               "<div class='col s12' mask='(99) 9?9999-9999'> Telefone:  " + cliente.telefone + "</div>" +
               "<div class='col s12' > Email:  " + cliente.email + "</div>" +
               "</div>" +


               //é aqui que vai rodar os detalhes
               "</div>" +
               "<div class='card-action'>" +
               "<a class='btn  waves-effect waves-light red' ng-click='delete(" + cliente.id_cliente + ")' ui-sref='deletecliente'>Deletar</a>" +
               "<a class='btn  waves-effect waves-light red' ng-click='editar(" + cliente.id_cliente + ")' ui-sref='editarcliente'>Editar Cadastro</a>" +
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
       $scope.gerarcartaocnpj = function(cliente) {
        console.log("pesquisaPesagemController :gerarcartaocnpj");
           // SE TEM REGISTRO NA BUSCA
           var $newDiv = $("<div class='row'>" +
               "<div class='col s6 '>" +
               "<div class='card blue-grey darken-1'>" +
               "<div class='card-content white-text'>" +
               "<p> Nome: </p>" +
               "<span class='card-title'> " + cliente.nome + " </span>" +
               "<p> CNPJ </p>" +
               "<span class='card-title'> " + cliente.cnpj + " </span>" +
               "<p> ... </p>" +
               "<div class='card-content' id='teste' ng-show='mostrar'>" +
               "<div class='row'>" +
               "<div class='col s12'> Endereço:  " + cliente.endereco + "</div>" +

               "<div class='col s6'> Cidade:  " + cliente.cidade + "</div>" +
               "<div class='col s6'> Estado:  " + cliente.estado + "</div>" +
               "<div class='col s12' mask='(99) 9?9999-9999'> Telefone:  " + cliente.telefone + "</div>" +
               "<div class='col s12' > Email:  " + cliente.email + "</div>" +
               "</div>" +
               //é aqui que vai rodar os detalhes
               "</div>" +
               "<div class='card-action'>" +
               "<a class='btn  waves-effect waves-light red' ng-click='delete(" + cliente.id_cliente + ")' ui-sref='deletecliente'>Deletar</a>" +
               "<a class='btn  waves-effect waves-light red' ng-click='editar(" + cliente.id_cliente + ")' ui-sref='editarcliente'>Editar Cadastro</a>" +
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
       $scope.gerarcartaonome = function(cliente) {
        console.log("pesquisaPesagemController :gerarcartaonome");
           // SE TEM REGISTRO NA BUSCA
           var $newDiv = $("<div class='row'>" +
               "<div class='col s6 '>" +
               "<div class='card blue-grey darken-1'>" +
               "<div class='card-content white-text'>" +
               "<p> Nome: </p>" +
               "<span class='card-title'> " + cliente.nome + " </span>" +
               "<p> CPF </p>" +
               "<span class='card-title'> " + cliente.cpf + " </span>" +
               "<p> CNPJ </p>" +
               "<span class='card-title'> " + cliente.cnpj + " </span>" +
               "<p> ... </p>" +
               "<div class='card-content' id='teste' ng-show='mostrar'>" +
               "<div class='row'>" +
               "<div class='col s12'> Endereço:  " + cliente.endereco + "</div>" +

               "<div class='col s6'> Cidade:  " + cliente.cidade + "</div>" +
               "<div class='col s6'> Estado:  " + cliente.estado + "</div>" +
               "<div class='col s12' mask='(99) 9?9999-9999'> Telefone:  " + cliente.telefone + "</div>" +
               "<div class='col s12' > Email:  " + cliente.email + "</div>" +
               "</div>" +


               //é aqui que vai rodar os detalhes
               "</div>" +
               "<div class='card-action'>" +
               "<a class='btn  waves-effect waves-light red' ng-click='delete(" + cliente.id_cliente + ")' ui-sref='deletecliente'>Deletar</a>" +
               "<a class='btn  waves-effect waves-light red' ng-click='editar(" + cliente.id_cliente + ")' ui-sref='editarcliente'>Editar Cadastro</a>" +
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
          console.log("pesquisaPesagemController :pesquisar");
           var request = $http({
               method: "post",
               url: "php/cliente/pesquisarclientenome.php",
               data: $scope.cliente,
               headers: {
                   'Content-Type': 'application/x-www-form-urlencoded'
               }
           });
           /* Successful HTTP post request or not */
           request.then(function(response) {
               console.log(response.data);
               $scope.Cliente = response.data;
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
        console.log("pesquisaPesagemController :pesquisarcpf");
           if ($scope.pesquisa.cpf.length === 0) {
               $('#divdinamica').empty();
               console.log("considerou pesquisa cpf length 0");
           } else {
               var request = $http({
                   method: "post",
                   url: "php/cliente/pesquisarclientecpf.php",
                   data: $scope.pesquisa,
                   headers: {
                       'Content-Type': 'application/x-www-form-urlencoded'
                   }
               });
               request.then(function(response) {
                   $scope.myText = "";
                   var filhoScope = $scope.$new();
                   $scope.Cliente = response.data;
                   console.log($scope.Cliente[0]);
                   if ($scope.Cliente[0] == 0) {
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
                           // "<a class='btn  waves-effect waves-light red'  ui-sref='deletecliente'>Deletar</a>" +
                           // "<a class='btn  waves-effect waves-light red'  ui-sref='editarcliente'>Editar Cadastro</a>" +
                           // "<a href='' ng-click='mostrar=true'  ng-show='!mostrar'>Detalhes</a>" +
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
        console.log("pesquisaPesagemController :pesquisarnome");
           if ($scope.pesquisa.nome.length === 0) {
               $('#divdinamica').empty();
               console.log("considerou pesquisa nome length 0");
           } else {
               var request = $http({
                   method: "post",
                   url: "php/cliente/pesquisarclientenome.php",
                   data: $scope.pesquisa,
                   headers: {
                       'Content-Type': 'application/x-www-form-urlencoded'
                   }
               });
               request.then(function(response) {
                   $scope.myText = "";
                   var filhoScope = $scope.$new();
                   $scope.Cliente = response.data;
                   console.log($scope.Cliente.status);
                   // depois da mudança do tipo de resposta
                   // que será retornado no banco quando 
                   // solicitar uma busca e nao tiver resposta
                   // retorna status = 0 caso contrario retorna o
                   // objeto pesquisado.
                   // sendo assim foi necessario alterar
                   // o teste para renderizar o cartão
                   // de resposta da pesquisa. 
                   if ($scope.Cliente.status == 0) {

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
                           // "<a class='btn  waves-effect waves-light red'  ui-sref='deletecliente'>Deletar</a>" +
                           // "<a class='btn  waves-effect waves-light red'  ui-sref='editarcliente'>Editar Cadastro</a>" +
                           // "<a href='' ng-click='mostrar=true'  ng-show='!mostrar'>Detalhes</a>" +
                           // "<a href='' ng-click='mostrar=false'  ng-show='mostrar'>Ocultar Detalhes</a>" +
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
        console.log("pesquisaPesagemController :pesquisarcnpj");
           if ($scope.pesquisa.cnpj.length === 0) {
               $('#divdinamica').empty();
               console.log("considerou pesquisa cnpj length 0");
           } else {
               var request = $http({
                   method: "post",
                   url: "php/cliente/pesquisarclientecnpj.php",
                   data: $scope.pesquisa,
                   headers: {
                       'Content-Type': 'application/x-www-form-urlencoded'
                   }
               });
               request.then(function(response) {
                   $scope.myText = "";
                   var filhoScope = $scope.$new();
                   $scope.Cliente = response.data;
                   console.log($scope.Cliente[0]);
                   if ($scope.Cliente[0] == 0) {

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
                           //    "<a class='btn  waves-effect waves-light red'  ui-sref='deletecliente'>Deletar</a>" +
                           //    "<a class='btn  waves-effect waves-light red'  ui-sref='editarcliente'>Editar Cadastro</a>" +
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
       .controller('pesquisaPesagemController', pesquisaPesagemController);