  function cadastroClienteController($scope, $http) {

      $scope.salvar = function() {
          // cria um vetor vazio para armazenar o cliente e veiculos.
          var listaClienteVeiculo = [];
          listaClienteVeiculo.push($scope.cliente);
          listaClienteVeiculo.push($scope.lines);

          console.log(listaClienteVeiculo);

          var request = $http({
              method: "post",
              url: "php/cliente/salvarcliente.php",
              data: listaClienteVeiculo,
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
              }
          });

          request.then(function(response) {
              console.log(response.data);
              // $scope.Cliente = response.data;
              // foi necessario atualizar o objeto cliente com os dados de id retornado do banco
              // isso faz a atualização do objeto que está na pagina.

              $scope.cliente = response.data;
              $scope.cliente = null; // isso faz com que quando salva o dado o objeto é limpo 
              // deixando o formulario na pagina limpo para um novo cadastro
              $scope.lines = [];


              //angular.forEach()
          }, function(response) {
              console.log("ERROR" + response);
          });


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


      }

      /////////////////////////////////////////////////////////////

      // nao sei onde isso está sendo usado.
      $scope.enviar = function() {
          var req = {
              method: 'post',
              url: "php/cliente/salvarcliente.php",
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
              },
              data: $scope.cliente
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

      $scope.gerarcartao = function(cliente) {
          // $scope.pesquisar();

          $scope.myText = "<div class='row'>" +
              "<div class='col s12 m6'>" +
              "<div class='card blue-grey darken-1'>" +
              "<div class='card-content white-text'>" +
              "<span class='card-title'>" + cliente.nome + "</span>" +
              "<p> </p>" +
              " </div>" +
              "<div class='card-action'>" +
              "<a href='#>This is a link</a>" +
              "<a href='#'>This is a link</a>" +
              "</div>" +
              "</div>" +
              "</div>" +
              "</div>";


          return $scope.myText;

      }

      // versao inicial dos teste de pesquisa nome. 
      // provavelmente criei um botao chamando essa função para testar 
      // conexao com o banco e o retorno.
      $scope.pesquisar = function() {
          var request = $http({
              method: "post",
              url: "php/cliente/pesquisarcliente.php",
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
                  $scope.myText = $scope.myText + $scope.gerarcartao(value);
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
      $scope.pesquisarnome = function() {

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
              $scope.Cliente = response.data;

              if ($scope.Cliente[0] == 0) {
                  $scope.Cliente[0].nome = "SEM REGISTRO";
                  //$scope.myText = "SEM REGISTRO";
                  //NA MARRA
                  $scope.myText = "<div class='row'>" +
                      "<div class='col s12 m6'>" +
                      "<div class='card blue-grey darken-1'>" +
                      "<div class='card-content white-text'>" +
                      "<span class='card-title'>" + 'SEM REGISTRO' + "</span>" +
                      "<p> </p>" +
                      " </div>" +
                      "<div class='card-action'>" +
                      "<a href='#>This is a link</a>" +
                      "<a href='#'>This is a link</a>" +
                      "</div>" +
                      "</div>" +
                      "</div>" +
                      "</div>";
                 // console.log($scope.myText);
              } else {

                  angular.forEach(response.data, function(value, key) {
                      $scope.myText = $scope.myText + $scope.gerarcartao(value);

                  });

              }

          }, function(response) {
              console.log("ERROR" + response);
          });




      }



      /*
        $scope.pesquisar = function () {
      var request = $http({
      method: "post",
      url: "php/cliente/pesquisarcliente.php",
      data: $scope.cliente,
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      });

       
      request.then(function(response){
        console.log(response.data);
       $scope.Cliente = response.data;

        //angular.forEach()
      },function(response){
       console.log("ERROR"+response);
      });



        }
      */




      $scope.voltar = function($t) {
          console.log("até aqui foi");
          //$cookieStore.put ('teste',$t);

          //window.location.href='http://localhost/projeto/EMPRESA.html';

      }

  }
  angular
      .module('home')
      .controller('cadastroClienteController', cadastroClienteController);