 function cadastroEmpresaController($scope, $http) {


    $scope.salvar = function() {

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


            //angular.forEach()
        }, function(response) {
            console.log("ERROR" + response);
        });
//TENTANDO LIMPAR A TELA DEPOIS DE SALVO OS DADOS

    }

    $scope.lines = [];

    $scope.cont = 1;


    // DEVE SER EDITADA!!!
    $scope.salvarVeiculo = function() {

        // $scope.cont =  $scope.cont+1;
        $scope.cont = $scope.veiculo;
        $scope.lines.push($scope.cont);
        console.log($scope.lines);
        $scope.veiculo = null;

        //$scope.cont =  $scope.cliente.id_cliente;
        //$scope.lines.push( $scope.cont);
        //console.log($scope.lines);

    }




    /////////////////////////////////////////////////////////////
    $scope.enviar = function() {
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
      //  console.log("até aqui foi");
        //$cookieStore.put ('teste',$t);

        //window.location.href='http://localhost/projeto/EMPRESA.html';

    }

}
angular
    .module('home')
    .controller('cadastroEmpresaController', cadastroEmpresaController);