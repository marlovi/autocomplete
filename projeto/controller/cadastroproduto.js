 function cadastroProdutoController($scope, $http) {

$scope.verificarNomeProduto = function(nome) {
   
//// estou passando o nome só pra 
// evitar o erro quando apaga totalmente
// o campo de cadastro. 
          if ($scope.produto.nome.length === 0){
              
            console.log("considerou nome length 0");
          }
          else {
              
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
                   // console.log( response.data[0].nome);
                     

                      if (response.data[0].nome == nome) {
                        Materialize.toast('PRODUTO JÁ CADASTRADO', 3000,'rounded', 'center');
                        Materialize.toast();
                        $scope.produto.status = 1;
                      } else{
                        $scope.produto.status = 0;
                      }

                  }


              }, function(response) {
                  console.log("ERROR" + response);
              });

} // fim do else
          }

  
///// teste da funçaõ perder o foco do input
$scope.focus = function() {
    console.log("dsadsa");
}


     $scope.salvar = function() {
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

        }, function(response) {
            console.log("ERROR" + response);
        });
    }


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
}
angular
    .module('home')
    .controller('cadastroProdutoController', cadastroProdutoController);