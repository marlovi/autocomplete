  function cadastroDescontoController($scope, $http, $mdDialog) {
 
     $scope.verificarNomeDesconto = function(nome) {
        console.log("cadastroFornecedorController :verificarNomeFornecedor");
         //// estou passando o nome só pra 
         // evitar o erro quando apaga totalmente
         // o campo de cadastro. 
         if (!$scope.fornecedor) {} else {
             if ($scope.fornecedor.nome.length === 0) {
                 //  console.log("considerou nome length 0");
             } else {
                 var request = $http({
                     method: "post",
                     url: "php/fornecedor/pesquisarfornecedornome.php",
                     data: $scope.fornecedor,
                     headers: {
                         'Content-Type': 'application/x-www-form-urlencoded'
                     }
                 });
                 request.then(function(response) {
                     if (response.data.status == 0) {
                         $scope.fornecedor.status = response.data.status;
                     } else {
                         nome = nome.toUpperCase(); // colocando em maiusculo pq do banco so vem maiusculo.
                         if (response.data[0].nome == nome) {
                             Materialize.toast('FORNECEDOR JÁ CADASTRADO', 3000, 'rounded', 'center');
                             Materialize.toast();
                             $scope.fornecedor.status = 1;
                             $scope.fornecedor.nome = null;
                         } else {
                             $scope.fornecedor.status = 0;
                         }
                     }
                 }, function(response) {
                     console.log("ERROR" + response);
                 });
             } // fim do else
         }
     }

     $scope.openOffscreen = function() {
        console.log("cadastroFornecedorController :openOffscreen");
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

     $scope.salvar = function() {
        console.log("cadastroDescontoController :salvar");
         // cria um vetor vazio para armazenar o cliente e veiculos.
         var listaFornecedorVeiculo = [];
         listaFornecedorVeiculo.push($scope.fornecedor);
         listaFornecedorVeiculo.push($scope.lines);
         console.log(listaFornecedorVeiculo);
         var request = $http({
             method: "post",
             url: "php/fornecedor/salvarfornecedor.php",
             data: listaFornecedorVeiculo,
             headers: {
                 'Content-Type': 'application/x-www-form-urlencoded'
             }
         });
         request.then(function(response) {
             console.log(response.data);

             $scope.fornecedor = response.data;
             $scope.fornecedor = null;
             $scope.lines = [];
             $scope.openOffscreen();
             //angular.forEach()
         }, function(response) {
             console.log("ERROR" + response);
         });
         //TENTANDO LIMPAR A TELA DEPOIS DE SALVO OS DADOS
     }
     $scope.lines = [];
     $scope.cont = 1;
 
     /////////////////////////////////////////////////////////////
     $scope.enviar = function() {
        console.log("cadastroFornecedorController :enviar");
         var req = {
             method: 'post',
             url: "php/fornecedor/salvarfornecedor.php",
             headers: {
                 'Content-Type': 'application/x-www-form-urlencoded'
             },
             data: $scope.fornecedor
         }
         $http(req).then(function successCallback(response) {
             // this callback will be called asynchronously
             // when the response is available
             console.log(response);
             console.log("sucess");
         }, function errorCallback(response) {
             // called asynchronously if an error occurs
             // or server returns response with an error status.
             console.log(response);
             console.log("fail");
         });
     }

     $scope.voltar = function($t) {
        console.log("cadastroDescontoController :voltar");
         //  console.log("até aqui foi");
         //$cookieStore.put ('teste',$t);
         //window.location.href='http://localhost/projeto/EMPRESA.html';
     }
 }
 angular
     .module('home')
     .controller('cadastroDescontoController', cadastroDescontoController);