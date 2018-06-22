  function editarDescontoController($scope, $http, $cookieStore, focus, $timeout, meuServico) {

     $scope.openOffscreen = function() {
        console.log("editarFornecedorController :openOffscreen");
         $mdDialog.show(
             $mdDialog.alert()
             .clickOutsideToClose(true)
             .title('Cadastro salvo')
             .ok('OK')
             .openFrom({
                 top: -50,
                 width: 30,
                 height: 80
             })
             .closeTo({
                 left: 1500
             })
         );
     };

     $scope.editar = function() {
        console.log("editarFornecedorController :editar");
         // cria um vetor vazio para armazenar o cliente e veiculos.
         var listaFornecedorVeiculo = [];
         listaFornecedorVeiculo.push($scope.fornecedor);
         listaFornecedorVeiculo.push($scope.lines);
         console.log(listaFornecedorVeiculo);

         var request = $http({
             method: "post",
             url: "php/fornecedor/editarfornecedor.php",
             data: listaFornecedorVeiculo,
             headers: {
                 'Content-Type': 'application/x-www-form-urlencoded'
             }
         });

         request.then(function(response) {
             var $resposta = response.data;
             console.log($resposta);
             $scope.fornecedor = null;
             $scope.lines = [];
             if ($resposta.status === true) {
                 //alert('Fornecedor  Atualizado com sucesso!');
                 meuServico.mostrar('Alteração', 'Registro alterado com Sucesso!!!');
                 //Mandar para outra página.
                 clickOnUpload();

             }
         }, function(response) {
             console.log("ERROR" + response);
         });
     }

     $scope.doSomething = function() {
        console.log("editarFornecedorController :doSomething");
         // do something awesome
         focus('nome');
         focus("cpf");
         focus("cnpj");
         focus("endereco");
         focus("cidade");
         focus("estado");
         focus("telefone");
         focus("email");

     };

     var request = $http({
         method: "post",
         url: "php/fornecedor/pesquisarfornecedorid.php",
         data: $cookieStore.get('editarfornecedor'),
         headers: {
             'Content-Type': 'application/x-www-form-urlencoded'
         }
     });

     /* Successful HTTP post request or not */
     request.then(function(response) {
         //console.log(response.data[0]);
         $timeout(function() {
             $scope.$apply(function() {
                 $scope.buscarVeiculos();
                 $scope.lines = [];
                 $scope.fornecedor = response.data[0];
                 $scope.doSomething();
             });
         }, 0);
         // console.log(response.data[0].nome);
     }, function(response) {
         console.log("ERROR" + response);
     });

     $scope.teste = function() {
        console.log("editarFornecedorController :teste");
         console.log($cookieStore.get('editarfornecedor'));
     }
 
     function clickOnUpload() {
        console.log("editarFornecedorController :clickOnUpload");
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
     .controller('editarDescontoController', editarDescontoController);