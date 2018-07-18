    function pesquisaDescontoController($scope, $http, $compile, $injector, $cookieStore) {
       
       $scope.delete = function(id) {
        console.log("pesquisaDescontoController :delete");
           console.log(id);
           $cookieStore.put('deletedesconto', id);
       }

       $scope.editar = function(id) {
        console.log("pesquisaDescontoController :editar");
           console.log(id);
           $cookieStore.put('editardesconto', id);
       }

       $scope.gerarcartaonome = function(desconto) {
         console.log("pesquisaDescontoController :gerarcartaonome");

           var $newDiv = $("<div class='row'>" +
               "<div class='col s6 '>" +
               "<div class='card blue-grey darken-1'>" +
               "<div class='card-content white-text'>" +
               "<p> Nome: </p>" +
               "<span class='card-title'> " + desconto.nome + " </span>" +
               "<p> Código </p>" +
               "<span class='card-title'> " + desconto.id_desconto + " </span>" +

               "<div class='card-action'>" +
               "<a class='btn  waves-effect waves-light red' ng-click='delete(" + desconto.id_desconto + ")' ui-sref='deletedesconto'>Deletar</a>" +
               "<a class='btn  waves-effect waves-light red' ng-click='editar(" + desconto.id_desconto + ")' ui-sref='editardesconto'>Editar Cadastro</a>" +
               // "<a href='' ng-click='mostrar=true'  ng-show='!mostrar'>Detalhes</a>" +
               //  "<a href='' ng-click='mostrar=false'  ng-show='mostrar'>Ocultar Detalhes</a>" +
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
        console.log("pesquisaDescontoController :pesquisar");
           var request = $http({
               method: "post",
               url: "php/desconto/pesquisardesconto.php",
               data: $scope.desconto,
               headers: {
                   'Content-Type': 'application/x-www-form-urlencoded'
               }
           });
           /* Successful HTTP post request or not */
           request.then(function(response) {
               console.log(response.data);
               $scope.Desconto = response.data;
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
       $scope.pesquisarnome = function() {
        console.log("pesquisaDescontoController :pesquisarnome");
           if ($scope.pesquisa.nome.length === 0) {
               $('#divdinamica').empty();
               console.log("considerou pesquisa nome length 0");
           } else {
               var request = $http({
                   method: "post",
                   url: "php/desconto/pesquisardescontonome.php",
                   data: $scope.pesquisa,
                   headers: {
                       'Content-Type': 'application/x-www-form-urlencoded'
                   }
               });
               request.then(function(response) {
                   // console.log($scope.desconto);
                   $scope.myText = "";
                   var filhoScope = $scope.$new();
                   $scope.Desconto = response.data;
                   console.log($scope.Desconto[0]);
                   if ($scope.Desconto.status == 0) {

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
                           //   "<a class='btn  waves-effect waves-light red'  ui-sref='deleteproduto'>Deletar</a>" +
                           //  "<a class='btn  waves-effect waves-light red'  ui-sref='editarproduto'>Editar Cadastro</a>" +
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
   }
   angular
       .module('home')
       .controller('pesquisaDescontoController', pesquisaDescontoController);