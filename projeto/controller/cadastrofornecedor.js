  function cadastroFornecedorController($scope, $http, $mdDialog) {
     $scope.verificarCnpjFornecedor = function(cnpj) {
        console.log("cadastroFornecedorController :verificarCnpjFornecedor");
         if (!$scope.fornecedor) {} else {
             if ($scope.fornecedor.cnpj.length === 0) {
                 // console.log("considerou cnpj length 0");
             } else {
                 var request = $http({
                     method: "post",
                     url: "php/fornecedor/pesquisarfornecedorcnpj.php",
                     data: $scope.fornecedor,
                     headers: {
                         'Content-Type': 'application/x-www-form-urlencoded'
                     }
                 });
                 request.then(function(response) {
                     if (response.data.status == 0) {
                         // console.log( response.data);
                         $scope.fornecedor.status = response.data.status;

                     } else {
                         //cpf = nome.toUpperCase(); // colocando em maiusculo pq do banco so vem maiusculo.
                         // console.log(cnpj);
                         // console.log( response.data[0].cnpj);
                         // console.log( response.data);
                         if (response.data[0].cnpj == cnpj) {
                             Materialize.toast('CNPJ JÁ CADASTRADO', 3000, 'rounded', 'center');
                             Materialize.toast();
                             $scope.fornecedor.status = 1;
                             $scope.fornecedor.cnpj = null;
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

     $scope.verificarCpfFornecedor = function(cpf) {
        console.log("cadastroFornecedorController :verificarCpfFornecedor");
         if (!$scope.fornecedor) {} else {
             if ($scope.fornecedor.cpf.length === 0) {} else {
                 var request = $http({
                     method: "post",
                     url: "php/fornecedor/pesquisarfornecedorcpf.php",
                     data: $scope.fornecedor,
                     headers: {
                         'Content-Type': 'application/x-www-form-urlencoded'
                     }
                 });
                 request.then(function(response) {
                     if (response.data.status == 0) {
                         $scope.fornecedor.status = response.data.status;
                     } else {
                         if (response.data[0].cpf == cpf) {
                             Materialize.toast('CPF JÁ CADASTRADO', 3000, 'rounded', 'center');
                             Materialize.toast();
                             $scope.fornecedor.status = 1;
                             $scope.fornecedor.cpf = null;
                         } else {
                             $scope.fornecedor.status = 0;
                         }
                     }
                 }, function(response) {
                     console.log("ERROR" + response);
                 });
             } // fim do else
         } // IF DE TRATAMENTO QUANDO NAO TEM NADA NULL
     }

     $scope.verificarNomeFornecedor = function(nome) {
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
        console.log("cadastroFornecedorController :salvar");
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


     $scope.salvarVeiculo = function() {
         console.log("cadastroFornecedorController :salvarVeiculo");
         // CRIAR CONDIÇÃO QUE VERIFICA SE OS CAMPOS PLACAS SÃO DIFERENTES
         var i = 0;
         var listaRepetida = 0;
         if (!$scope.lines) {
             //SE É A PRIMEIRA DA LISTA
             $scope.cont = $scope.veiculo;
             $scope.lines.push($scope.cont);
             console.log("PRIMEIRA DA LISTA");
             $scope.veiculo = null;
         } else {
             //TRANSFIRO A INFO E LIMPO  VARIAVEL
             $scope.cont = $scope.veiculo;
             $scope.lines.push($scope.cont);
             $scope.veiculo = null;
             do {
                 var n = $scope.lines[i].placa.localeCompare($scope.cont.placa);
                 // TESTO TODAS AS POSIÇOES DA LISTA
                 // SE DER MAIOR QUE 1 VEZ NA LISTA ENTÃO PAGADA
                 // E TIRA DA LISTA.
                 if (n == 0) {
                     listaRepetida += 1;
                     //console.log(" é igual " + listaRepetida);
                     if (n == 0 && listaRepetida > 1) {
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

     $scope.consulta_placa = function() {
        console.log("cadastroFornecedorController :consulta_placa");
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
        console.log("cadastroFornecedorController :voltar");
         //  console.log("até aqui foi");
         //$cookieStore.put ('teste',$t);
         //window.location.href='http://localhost/projeto/EMPRESA.html';
     }
 }
 angular
     .module('home')
     .controller('cadastroFornecedorController', cadastroFornecedorController);