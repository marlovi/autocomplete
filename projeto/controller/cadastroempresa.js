  function cadastroEmpresaController($scope, $http, $mdDialog) {
     // inicio teste alerta de confirmação de cadastro
     $scope.openOffscreen = function() {
        console.log("cadastroEmpresaController :openOffscreen");
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
     // fim de alerta confirmação cadastro

     $scope.salvar = function() {
        console.log("cadastroEmpresaController :salvar");
         // cria um vetor vazio para armazenar o cliente e veiculos.
         var listaEmpresaVeiculo = [];
         listaEmpresaVeiculo.push($scope.empresa);
         listaEmpresaVeiculo.push($scope.lines);
         console.log(listaEmpresaVeiculo);
         var request = $http({
             method: "post",
             url: "php/empresa/salvarempresa.php",
             data: listaEmpresaVeiculo,
             headers: {
                 'Content-Type': 'application/x-www-form-urlencoded'
             }
         });
         request.then(function(response) {
             console.log(response.data);
             // $scope.Cliente = response.data;
             // foi necessario atualizar o objeto cliente com os dados de id retornado do banco
             // isso faz a atualização do objeto que está na pagina.
             $scope.empresa = response.data;
             $scope.empresa = null;
             $scope.lines = [];
             $scope.openOffscreen();
             //angular.forEach()
         }, function(response) {
             console.log("ERROR" + response);
         });
     }
     $scope.lines = [];
     $scope.cont = 1;
     // DEVE SER EDITADA!!!
     $scope.salvarVeiculo = function() {
        console.log("cadastroEmpresaController :salvarVeiculo");
         // $scope.cont =  $scope.cont+1;
         $scope.cont = $scope.veiculo;
         $scope.lines.push($scope.cont);
         console.log($scope.lines);
         $scope.veiculo = null;
         //$scope.cont =  $scope.cliente.id_cliente;
         //$scope.lines.push( $scope.cont);
         //console.log($scope.lines);
     }

     $scope.consulta_placa = function() {
        console.log("cadastroEmpresaController :consulta_placa");
         var teste_tamanho_string = "";
         teste_tamanho_string = $scope.veiculo.placa; // RETIREI A STRING DA PLACA
         var teste_tamanho_digitado = teste_tamanho_string.length; // DESCOBRI O TAMANHO
         //console.log($scope.veiculo);
         console.log(teste_tamanho_digitado); // FAÇO O TESTE DE APROVAÇÃO DE ENVIO
         console.log($scope.veiculo.placa);
         if (teste_tamanho_digitado == 8) {

             var request = $http({
                 method: "post",
                 url: "php/veiculo/pesquisarveiculoplaca_cadastro.php",
                 data: $scope.veiculo,
                 // data: $scope.veiculo.placa,
                 headers: {
                     'Content-Type': 'application/x-www-form-urlencoded'
                 }
             });
             request.then(function(response) {
                 console.log(response.data);
                 // SE RETORNAR ALGUM REGISTRO DO BANCO O ELSE RODA
                 // SE NAO RETORNAR NENHUM REGISTRO DO BANCO O IF RODA
                 if (!angular.isUndefined(response.data.status_veiculo)) {
                     console.log("CADASTRO PERMITIDO");
                 } else {
                     Materialize.toast('PLACA JÁ CADASTRADA', 3000, 'rounded', 'center');
                     $scope.veiculo.placa = null;
                     Materialize.toast();
                 }
             }, function(response) {
                 console.log("ERROR" + response);
             });
         }
 


     }

     /////////////////////////////////////////////////////////////
     $scope.enviar = function() {
        console.log("cadastroEmpresaController :enviar");
         var req = {
             method: 'post',
             url: "php/empresa/salvarempresa.php",
             headers: {
                 'Content-Type': 'application/x-www-form-urlencoded'
             },
             data: $scope.empresa
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
      console.log("cadastroEmpresaController :voltar");

     }
 }
 angular
     .module('home')
     .controller('cadastroEmpresaController', cadastroEmpresaController);