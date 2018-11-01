  function editarProdutoController($scope, $http, $cookieStore, focus, $timeout, meuServico) {

 $scope.verificarNomeProduto = function(nome) {
         console.log("cadastroProdutoController :verificarNomeProduto");
         //// estou passando o nome só pra 
         // evitar o erro quando apaga totalmente
         // o campo de cadastro. 
         if ($scope.produto.nome.length === 0) {
             console.log("considerou nome length 0");
         } else {
             var request = $http({
                 method: "post",
                 url: "php/produto/pesquisarprodutonome.php",
                 data: $scope.produto,
                 headers: {
                     'Content-Type': 'application/x-www-form-urlencoded'
                 }
             });
             request.then(function(response) {
                 if (response.data.status == 0) {
                     $scope.produto.status = response.data.status;
                     //console.log( "não existe no bancos"); 
                     // console.log("dentro do status   " + $scope.produto.status);
                     // console.log("dentro do  produto.nome " + $scope.produto.nome);
                 } else {
                     nome = nome.toUpperCase(); // colocando em maiusculo pq do banco so vem maiusculo.
                     // console.log(nome);
                     // console.log( response.data[0].nome)
                     if (response.data[0].nome == nome) {
                         Materialize.toast('PRODUTO JÁ CADASTRADO', 3000, 'rounded', 'center');
                         Materialize.toast();
                         $scope.produto.status = 1;
                         $scope.produto.nome = null;
                     } else {
                         $scope.produto.status = 0;
                     }

                 }
             }, function(response) {
                 console.log("ERROR" + response);
             });

         } // fim do else
     }
    

     $scope.editar = function() {
        console.log("editarProdutoController :editar");
         // cria um vetor vazio para armazenar o cliente e veiculos.
         var listaProduto = [];
         listaProduto.push($scope.produto);

         console.log($scope.produto);

         var request = $http({
             method: "post",
             url: "php/produto/editarproduto.php",
             data: listaProduto,
             headers: {
                 'Content-Type': 'application/x-www-form-urlencoded'
             }
         });

         request.then(function(response) {
             var $resposta = response.data;
             console.log($resposta);
             $scope.produto = null;
             if ($resposta.status === true) {
                 // alert('Produto  Atualizado com sucesso!');
                 meuServico.mostrar('Alteração', 'Registro alterado com Sucesso!!!');
                 //Mandar para outra página.
                 clickOnUpload();
             }
         }, function(response) {
             console.log("ERROR" + response);
         });
     }

     $scope.doSomething = function() {
        console.log("editarProdutoController :doSomething");
         // do something awesome
         focus('nome');
     };

     var request = $http({
         method: "post",
         url: "php/produto/pesquisarprodutoid.php",
         data: $cookieStore.get('editarproduto'),
         headers: {
             'Content-Type': 'application/x-www-form-urlencoded'
         }
     });

     /* Successful HTTP post request or not */
     request.then(function(response) {
         //console.log(response.data[0]);
         $timeout(function() {
             $scope.$apply(function() {

                 $scope.produto = response.data[0];
                 $scope.doSomething();
             });
         }, 0);
         // console.log(response.data[0].nome);

     }, function(response) {
         console.log("ERROR" + response);
     });

     $scope.teste = function() {
        console.log("editarProdutoController :teste");
         console.log($cookieStore.get('editarproduto'));
     }

     function clickOnUpload() {
        console.log("editarProdutoController :clickOnUpload");
         $timeout(function() {
             angular.element('#voltar').triggerHandler('click');
         });
     };
     // Using Angular Extend
     angular.extend($scope, {
         clickOnUpload: clickOnUpload
     });
     // OR Using scope directly
     $scope.clickOnUpload = clickOnUpload;

 }

 angular
     .module('home')
     .factory('focus', function($timeout, $window) {
         return function(id) {
             // timeout makes sure that is invoked after any other event has been triggered.
             // e.g. click events that need to run before the focus or
             // inputs elements that are in a disabled state but are enabled when those events
             // are triggered.
             $timeout(function() {
                 var element = $window.document.getElementById(id);
                 if (element)
                     element.focus();
             });
         };
     })

     .directive('eventFocus', function(focus) {
         return function(scope, elem, attr) {
             elem.on(attr.eventFocus, function() {
                 focus(attr.eventFocusId);
             });

             // Removes bound events in the element itself
             // when the scope is destroyed
             scope.$on('$destroy', function() {
                 element.off(attr.eventFocus);
             });
         };
     })
     .controller('editarProdutoController', editarProdutoController);