  function cadastroClienteController($scope, $http, $mdDialog) {


$scope.verificarCnpjCliente = function(cnpj) {
  if (!$scope.cliente ){
            }else{
 
          if ($scope.cliente.cnpj.length === 0){
              
            console.log("considerou cnpj length 0");
          }
          else {
              
             var request = $http({
                  method: "post",
                  url: "php/cliente/pesquisarclientecnpj.php",
                  data: $scope.cliente,
                  headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                  }
              });

              request.then(function(response) {
                 
                  if (response.data.status == 0) {
                    console.log( response.data);
                    $scope.cliente.status = response.data.status;
                    console.log( "não existe no bancos"); 
                   console.log("dentro do status   " + $scope.cliente.status);
                    console.log("dentro do  cliente.cnpj " + $scope.cliente.cnpj);

                  } else {
                    //cpf = nome.toUpperCase(); // colocando em maiusculo pq do banco so vem maiusculo.
                    console.log(cnpj);
                    console.log( response.data[0].cnpj);
                    console.log( response.data);
                     

                      if (response.data[0].cnpj == cnpj) {
                        Materialize.toast('CNPJ JÁ CADASTRADO', 3000,'rounded', 'center');
                        Materialize.toast();
                        $scope.cliente.status = 1;
                        $scope.cliente.cnpj =null;
                      } else{
                        $scope.cliente.status = 0;
                      }

                  }


              }, function(response) {
                  console.log("ERROR" + response);
              });

} // fim do else

}
          }
/////

$scope.verificarCpfCliente = function(cpf) {

            if (!$scope.cliente ){
            }else{


 
          if ($scope.cliente.cpf.length === 0){
              
           // console.log("considerou cpf length 0");
          }
          else {
              
             var request = $http({
                  method: "post",
                  url: "php/cliente/pesquisarclientecpf.php",
                  data: $scope.cliente,
                  headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                  }
              });

              request.then(function(response) {
                 
                  if (response.data.status == 0) {
                   // console.log( response.data);
                    $scope.cliente.status = response.data.status;
                  //  console.log( "não existe no bancos"); 
                  // console.log("dentro do status   " + $scope.cliente.status);
                  //  console.log("dentro do  cliente.cpf " + $scope.cliente.cpf);

                  } else {
                    //cpf = nome.toUpperCase(); // colocando em maiusculo pq do banco so vem maiusculo.
                  //  console.log(cpf);
                   // console.log( response.data[0].cpf);
                   // console.log( response.data);
                     

                      if (response.data[0].cpf == cpf) {
                        Materialize.toast('CPF JÁ CADASTRADO', 3000,'rounded', 'center');
                        Materialize.toast();
                        $scope.cliente.status = 1;
                        $scope.cliente.cpf =null;
                      } else{
                        $scope.cliente.status = 0;
                      }

                  }


              }, function(response) {
                  console.log("ERROR" + response);
              });

} // fim do else

} // IF DE TRATAMENTO QUANDO NAO TEM NADA NULL
          }
/////


$scope.verificarNomeCliente = function(nome) {
   
//// estou passando o nome só pra 
// evitar o erro quando apaga totalmente
// o campo de cadastro. 
if (!$scope.cliente ){
            }else{
          if ($scope.cliente.nome.length === 0){
              
            console.log("considerou nome length 0");
          }
          else {
              
             var request = $http({
                  method: "post",
                  url: "php/cliente/pesquisarclientenome.php",
                  data: $scope.cliente,
                  headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                  }
              });

              request.then(function(response) {
                 
                  if (response.data.status == 0) {
                    //console.log( response.data);
                    $scope.cliente.status = response.data.status;
                   // console.log( "não existe no bancos"); 
                  // console.log("dentro do status   " + $scope.cliente.status);
                  //  console.log("dentro do  cliente.nome " + $scope.cliente.nome);

                  } else {
                    nome = nome.toUpperCase(); // colocando em maiusculo pq do banco so vem maiusculo.
                    //console.log(nome);
                    //console.log( response.data[0].nome);
                    //console.log( response.data);
                     

                      if (response.data[0].nome == nome) {
                        Materialize.toast('CLIENTE JÁ CADASTRADO', 3000,'rounded', 'center');
                        Materialize.toast();
                        $scope.cliente.status = 1;
                        $scope.cliente.nome =null;
                      } else{
                        $scope.cliente.status = 0;
                      }

                  }


              }, function(response) {
                  console.log("ERROR" + response);
              });

} // fim do else
}
          }



     $scope.openOffscreen = function() { 
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
        // CRIAR CONDIÇÃO QUE VERIFICA SE OS CAMPOS PLACAS SÃO DIFERENTES
 
          
  
       var   i=0;
var listaRepetida = 0;         
  if(!$scope.lines){
    //SE É A PRIMEIRA DA LISTA
          $scope.cont = $scope.veiculo;
          $scope.lines.push($scope.cont);
          console.log("PRIMEIRA DA LISTA");
          $scope.veiculo = null;

  }else{
    //TRANSFIRO A INFO E LIMPO  VARIAVEL
          $scope.cont = $scope.veiculo;
          $scope.lines.push($scope.cont);
          $scope.veiculo = null;
do { 
var n = $scope.lines[i].placa.localeCompare($scope.cont.placa);
// TESTO TODAS AS POSIÇOES DA LISTA
// SE DER MAIOR QUE 1 VEZ NA LISTA ENTÃO PAGADA
// E TIRA DA LISTA.
if(n == 0){
  listaRepetida += 1;
//console.log(" é igual " + listaRepetida);
if(n == 0 && listaRepetida > 1 ){
    // SE A STRING FOR IGUAL  E TIVER MAIS DE UMA VEZ 
  // NA LISTA ENTÃO PARA O TESTE E SAI DO WHILE
  // E TIRA PLACA DA LISTA.
i = $scope.lines.length
var meuPeixePop = $scope.lines.pop();
}
}
i += 1;  
} while (i < $scope.lines.length);
}
 
    }
//////


$scope.consulta_placa = function() {
 
var teste_tamanho_string = "";
teste_tamanho_string = $scope.veiculo.placa; // RETIREI A STRING DA PLACA
            var teste_tamanho_digitado = teste_tamanho_string.length; // DESCOBRI O TAMANHO
            //console.log($scope.veiculo);
           // console.log(teste_tamanho_digitado);  // FAÇO O TESTE DE APROVAÇÃO DE ENVIO
           // console.log($scope.veiculo.placa); 
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
   if(!angular.isUndefined(response.data.status_veiculo)){
//console.log("CADASTRO PERMITIDO");
 }else{
  Materialize.toast('PLACA JÁ CADASTRADA', 3000,'rounded', 'center');
 $scope.veiculo.placa = null;
Materialize.toast();

  }     
        }, function(response) {
            console.log("ERROR" + response);
        });
 
      
        
} 
// O QUE EU QUERO FAZER?
/* 
COLOCAR A PLACA PARA SER PESQUISADA



*/
 

    }
 


//////
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