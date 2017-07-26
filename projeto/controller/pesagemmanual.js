function pesagemManualController($scope, $http, $log ,$cookieStore, $mdDialog, $q, $timeout, meuServico) {

      $scope.openFromLeft = function() {
    $mdDialog.show(
      $mdDialog.alert()
        .clickOutsideToClose(true)
        .title('Opening from the left')
        .textContent('Closing to the right!')
        .ariaLabel('Left to right demo')
        .ok('Nice!')
        // You can specify either sting with query selector
        .openFrom('#left')
        // or an element
        .closeTo(angular.element(document.querySelector('#right')))
    );
  };


   $scope.openOffscreen = function() {
    $mdDialog.show(
      $mdDialog.alert()
        .clickOutsideToClose(true)
        .title('Opening from offscreen')
        .textContent('Closing to offscreen')
        .ariaLabel('Offscreen Demo')
        .ok('Amazing!')
        // Or you can specify the rect to do the transition from
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

    var exibir = false;
    //para mostrar a mensagem que não houve resultados
    $scope.exibe = function(nome) {
        //console.log(nome.length);
        //console.log("".localeCompare(nome));

        return (("".localeCompare(nome) != 0) && exibir);
    };


    $scope.isEmpty = function(obj) {
        for (var prop in obj) {
            if (obj.hasOwnProperty(prop))
                return false;
        }

        return true;
    }

    $scope.data = [
        " "
    ]; // variável que é responsável pelo gerenciamento do compoenent auto complete

 
/*
    $scope.pesquisar = function(pesquisa) {

        // Se a pesquisa for vazia
        if (pesquisa == "") {

            // Retira o autocomplete
            $scope.completing = false;

        } else {

            var request = $http({
                method: "post",
                url: "php/cliente/pesquisarclientenome.php",
                data: $scope.cliente,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            });
           
            request.then(function(response) {



                if (angular.isUndefined(response.data.status)) {
                    // JSON retornado do banco
                    exibir = false;
                    $scope.dicas = response.data;
                    $scope.data = response.data;
                    var nomes = []; // cria-se uma variável local para atribuir os nomes vindo do banco de dados.
                    var id_cliente = []; 
                    angular.forEach(response.data, function(value, key) {
                        nomes.push( value.nome, value.id_cliente); // estou add o id só pra comparar posição
                        id_cliente.push(value.id_cliente)
                    });
                  
                  //  console.log( nomes );
                  // console.log( id_cliente );
                    $scope.data = nomes  ; //sobreescre o vetor e adiciona o novo resultado vindo do banco de dados;
                   // $scope.dicas = id_cliente;
                     
                } else {
                    console.log("Nenhum cliente retornado");
                   
                   
                    exibir = true;
                }
            }, function(response) {
                console.log("ERROR" + response);
            });


            //////////////


        }
    };
*/



}


////////
angular
      .module('home')
      .controller('pesagemManualController', pesagemManualController);
/////

//////////////////////////////////////////////////////////////////////////////////

// inicio controller pesagemManualClienteController
function pesagemManualClienteController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log){

   
        // onde era DemoCtrl vira pesagemManualCliente
        var self = this;
 
        self.simulateQuery = false;
        self.isDisabled = false;

        self.repos = loadAll();
        self.querySearch = querySearch;
        self.selectedItemChange = selectedItemChange;
        self.searchTextChange = searchTextChange;

        // ******************************
        // Internal methods
        // ******************************

        /**
         * Search for repos... use $timeout to simulate
         * remote dataservice call.
         */
        function querySearch(query) {
            var results = query ? self.repos.filter(createFilterFor(query)) : self.repos,
                deferred;
            if (self.simulateQuery) {
                deferred = $q.defer();
                $timeout(function() { deferred.resolve(results); }, Math.random() * 1000, false);
                return deferred.promise;
            } else {
                return results;
            }
        }

        function searchTextChange(text) {

            $log.info('Text changed to ' + text);
             loadAll();
        }

        function selectedItemChange(item) {
           // $log.info('Item changed to stenio' + JSON.stringify(item));
            $scope.pesagem.id_cliente = item.id_cliente;
        }
        /**
         * Build `components` list of key/value pairs
         */

        function loadAll() {

  var repos = [{
                    'nome': 'AngularJS',
                    'url': 'https://github.com/angular/angular.js',
                    'watchers': '3,623',
                    'forks': '16,175'
                }];

   
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

                repos = response.data;
               
                if (angular.isUndefined(response.data.status)) {
                    // JSON retornado do banco
                    exibir = false;
                    $scope.dicas = response.data;
                   $scope.teste = response.data;
                  // console.log(response.data);
                     
                } else {
                    console.log("Nenhum cliente retornado");
                   
                   
                    exibir = true;
                }
            }, function(response) {
                console.log("ERROR" + response);
            });

           // console.log($scope.teste);

            if(!angular.isUndefined($scope.teste)){
                repos = $scope.teste;
                 self.repos = repos;
                return repos.map(function(repo) {
                repo.value = repo.nome.toLowerCase();
                return repo;
            });            
            }else{
               repos = [{
                    'nome': 'AngularJS',
                    'url': 'https://github.com/angular/angular.js',
                    'watchers': '3,623',
                    'forks': '16,175'
                }];



                return repos.map(function(repo) {
                repo.value = repo.nome.toLowerCase();
                return repo;
            }); 
            }    
        }

        /**
         * Create filter function for a query string
         */
        function createFilterFor(query) {
            var lowercaseQuery = angular.lowercase(query);

            return function filterFn(item) {
                return (item.value.indexOf(lowercaseQuery) === 0);
            };

        }
    }
    angular
      .module('home')
      .controller('pesagemManualClienteController', pesagemManualClienteController);

    // fim controller pesagemManualClienteController

// inicio controler 
// falta criar as rotinas para pesquisa de fornecedor
 function pesagemManualFornecedorController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log){

   
        // onde era DemoCtrl vira pesagemManualCliente
        var self = this;
 
        self.simulateQuery = false;
        self.isDisabled = false;

        self.repos = loadAll();
        self.querySearch = querySearch;
        self.selectedItemChange = selectedItemChange;
        self.searchTextChange = searchTextChange;

        // ******************************
        // Internal methods
        // ******************************

        /**
         * Search for repos... use $timeout to simulate
         * remote dataservice call.
         */
        function querySearch(query) {
            var results = query ? self.repos.filter(createFilterFor(query)) : self.repos,
                deferred;
            if (self.simulateQuery) {
                deferred = $q.defer();
                $timeout(function() { deferred.resolve(results); }, Math.random() * 1000, false);
                return deferred.promise;
            } else {
                return results;
            }
        }

        function searchTextChange(text) {

            $log.info('Text changed to ' + text);
             loadAll();
        }

        function selectedItemChange(item) {
            // AQUI MOSTRA O OBJETO SELECIONADO
           // $log.info('Item changed to stenio' + JSON.stringify(item));
            $scope.pesagem.id_fornecedor = item.id_fornecedor;
        }
        /**
         * Build `components` list of key/value pairs
         */

        function loadAll() {

  var repos = [{
                    'nome': 'AngularJS',
                    'url': 'https://github.com/angular/angular.js',
                    'watchers': '3,623',
                    'forks': '16,175'
                }];

   
var request = $http({
                method: "post",
                url: "php/fornecedor/pesquisarfornecedor.php",
                data: $scope.fornecedor,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            });
console.log($scope.fornecedor);
            /* Successful HTTP post request or not */
            request.then(function(response) {

                repos = response.data;
               
                if (angular.isUndefined(response.data.status)) {
                    // JSON retornado do banco
                    exibir = false;
                    $scope.dicas = response.data;
                   $scope.teste = response.data;
                  // console.log(response.data);
                     
                } else {
                    console.log("Nenhum fornecedor retornado");
                   
                   
                    exibir = true;
                }
            }, function(response) {
                console.log("ERROR" + response);
            });

           // console.log($scope.teste);

            if(!angular.isUndefined($scope.teste)){
                repos = $scope.teste;
                 self.repos = repos;
                return repos.map(function(repo) {
                repo.value = repo.nome.toLowerCase();
                return repo;
            });            
            }else{
               repos = [{
                    'nome': 'AngularJS',
                    'url': 'https://github.com/angular/angular.js',
                    'watchers': '3,623',
                    'forks': '16,175'
                }];



                return repos.map(function(repo) {
                repo.value = repo.nome.toLowerCase();
                return repo;
            }); 
            }    
        }

        /**
         * Create filter function for a query string
         */
        function createFilterFor(query) {
            var lowercaseQuery = angular.lowercase(query);

            return function filterFn(item) {
                return (item.value.indexOf(lowercaseQuery) === 0);
            };

        }
    }
    angular
      .module('home')
      .controller('pesagemManualFornecedorController', pesagemManualFornecedorController);

// fim controler

 // inicio controler produto



// inicio controler 
// falta criar as rotinas para pesquisa de fornecedor
function pesagemManualProdutoController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log){

   
        // onde era DemoCtrl vira pesagemManualCliente
        var self = this;
 
        self.simulateQuery = false;
        self.isDisabled = false;

        self.repos = loadAll();
        self.querySearch = querySearch;
        self.selectedItemChange = selectedItemChange;
        self.searchTextChange = searchTextChange;

        // ******************************
        // Internal methods
        // ******************************

        /**
         * Search for repos... use $timeout to simulate
         * remote dataservice call.
         */
        function querySearch(query) {
            var results = query ? self.repos.filter(createFilterFor(query)) : self.repos,
                deferred;
            if (self.simulateQuery) {
                deferred = $q.defer();
                $timeout(function() { deferred.resolve(results); }, Math.random() * 1000, false);
                return deferred.promise;
            } else {
                return results;
            }
        }

        function searchTextChange(text) {
            $log.info('Text changed to ' + text);
             loadAll();
        }

        function selectedItemChange(item) {
            $log.info('Item changed to ' + JSON.stringify(item));
            $scope.pesagem.id_produto = item.id_produto;
        }

        /**
         * Build `components` list of key/value pairs
         */
       
        function loadAll() {

  var repos = [{
                    'nome': 'AngularJS',
                    'url': 'https://github.com/angular/angular.js',
                    'watchers': '3,623',
                    'forks': '16,175'
                }];

   
var request = $http({
                method: "post",
                url: "php/produto/pesquisarproduto.php",
                data: $scope.produto,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            });
            /* Successful HTTP post request or not */
            request.then(function(response) {

                repos = response.data;
               
                if (angular.isUndefined(response.data.status)) {
                    // JSON retornado do banco
                    exibir = false;
                    $scope.dicas = response.data;
                   $scope.teste = response.data;
                  // console.log(response.data);
                     
                } else {
                    console.log("Nenhum cliente retornado");
                   
                   
                    exibir = true;
                }
            }, function(response) {
                console.log("ERROR" + response);
            });

            console.log($scope.teste);

            if(!angular.isUndefined($scope.teste)){
                repos = $scope.teste;
                 self.repos = repos;
                return repos.map(function(repo) {
                repo.value = repo.nome.toLowerCase();
                return repo;
            });            
            }else{
               repos = [{
                    'nome': 'AngularJS',
                    'url': 'https://github.com/angular/angular.js',
                    'watchers': '3,623',
                    'forks': '16,175'
                }];



                return repos.map(function(repo) {
                repo.value = repo.nome.toLowerCase();
                return repo;
            }); 
            }    
        }

        /**
         * Create filter function for a query string
         */
        function createFilterFor(query) {
            var lowercaseQuery = angular.lowercase(query);

            return function filterFn(item) {
                return (item.value.indexOf(lowercaseQuery) === 0);
            };

        }
    }
    angular
      .module('home')
      .controller('pesagemManualProdutoController', pesagemManualProdutoController);



