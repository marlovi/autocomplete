 function cadastroProdutoController($scope, $http) {


     $scope.salvar = function() {

   
// duvidas nessa função com a informação do data

        var request = $http({
            method: "post",
            url: "php/produto/salvarproduto.php",
            data: $scope.produto,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });

        request.then(function(response) {
            console.log(response.data);
            // $scope.Cliente = response.data;
            // foi necessario atualizar o objeto cliente com os dados de id retornado do banco
            // isso faz a atualização do objeto que está na pagina.

            $scope.produto = response.data;
                 $scope.produto = null;
                  

            //angular.forEach()
        }, function(response) {
            console.log("ERROR" + response);
        });
//TENTANDO LIMPAR A TELA DEPOIS DE SALVO OS DADOS

    }

    




    /////////////////////////////////////////////////////////////
    $scope.enviar = function() {
        var req = {
            method: 'post',
            url: "php/produto/salvarproduto.php",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            data: $scope.produto
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
    .controller('cadastroProdutoController', cadastroProdutoController);