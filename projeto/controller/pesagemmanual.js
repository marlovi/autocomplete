function pesagemManualController($scope, $http, $log, $cookieStore, $mdDialog, $q, $timeout, meuServico) {
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

    /////// função em teste

    $scope.salvar = function() {
        // percebi ser interessante converter em int os dados antes de salvar no 
        // banco. por exemplo as chaves estrangeiras devem ser inteiro
        // e a leitura de peso tambem.
        $scope.pesagem.cliente_id_cliente = parseInt($scope.pesagem.cliente_id_cliente);
        $scope.pesagem.fornecedor_id_fornecedor = parseInt($scope.pesagem.fornecedor_id_fornecedor);
        $scope.pesagem.peso_1 = parseInt($scope.pesagem.peso_1);
        $scope.pesagem.peso_2 = parseInt($scope.pesagem.peso_2);
        $scope.pesagem.peso_descontos = parseInt($scope.pesagem.peso_descontos);
        $scope.pesagem.peso_liquido = parseInt($scope.pesagem.peso_liquido);



        console.log($scope.pesagem);
        // duvidas nessa função com a informação do data

        var request = $http({
            method: "post",
            url: "php/pesagem/salvarpesagem.php",
            data: $scope.pesagem,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });

        request.then(function(response) {
            console.log(response.data);
            // $scope.Cliente = response.data;
            // foi necessario atualizar o objeto cliente com os dados de id retornado do banco
            // isso faz a atualização do objeto que está na pagina.

            //$scope.pesagem = response.data;
            $scope.pesagem = null;


            //angular.forEach()
        }, function(response) {
            console.log("ERROR" + response);
        });
        //TENTANDO LIMPAR A TELA DEPOIS DE SALVO OS DADOS

    }




    ///////////// fim teste



    var exibir = false;
    //para mostrar a mensagem que não houve resultados
    $scope.exibe = function(nome) {
        //console.log(nome.length);
        //console.log("".localeCompare(nome));

        return (("".localeCompare(nome) != 0) && exibir);
    };


    $scope.autorizar_envio = function() {
            //OBJETIVO
            // aqui defini que a pesagem foi manual   
            // contar quantas string tem no objeto campo pesagem.placa
            // se igual a 8 E se existe ALGUM PESO DIGITADO.
            // então ative botão enviar.
            // coloque 3 no pesagem.status
            // fazer o teste de liberação do botao.

            var teste = $scope.pesagem.placa; // RETIREI A STRING DA PLACA
            var teste_tamanho = teste.length; // DESCOBRI O TAMANHO
            //console.log($scope.veiculo);
            //console.log(teste_tamanho);  // FAÇO O TESTE DE APROVAÇÃO DE ENVIO

            if ($scope.pesagem.peso_liquido != null && teste_tamanho == 8) {

                $scope.pesagem.status = 3;
            } else {
                $scope.pesagem.status = null;
            }

        }
        // aqui faz com que o resultado das pesagem
        // aponte peso liquido positivo se o desconto não for
        // maior que o peso liquido
    $scope.modulo = function() {

        $scope.pesagem.peso_liquido = ($scope.pesagem.peso_1 - $scope.pesagem.peso_2);

        if ($scope.pesagem.peso_liquido < 0) {
            $scope.pesagem.peso_liquido = ($scope.pesagem.peso_liquido * -1);
        }

        if ($scope.pesagem.peso_descontos > 0) {
            $scope.pesagem.peso_liquido = ($scope.pesagem.peso_liquido - $scope.pesagem.peso_descontos);
        }
        return $scope.pesagem.peso_liquido;
    }

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
function pesagemManualClienteController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {
    var self = this;
    self.simulateQuery = false;
    self.isDisabled = false;
    self.repos = loadAll('');
    self.querySearch = querySearch;
    self.selectedItemChange = selectedItemChange;
    self.searchTextChange = searchTextChange;
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
        $log.info('pesquisando por: ' + text);
        loadAll(text);
    }
    function selectedItemChange(item) {
        // $log.info('Item changed to stenio' + JSON.stringify(item));
        $scope.pesagem.cliente_id_cliente = item.id_cliente;
        $scope.selected = item;
        console.log($scope.selected);
    }
    function loadAll(text) {
        var repos = [{
            'nome': 'AngularJS',
            'url': 'https://github.com/angular/angular.js',
            'watchers': '3,623',
            'forks': '16,175'
        }];
        console.log(text);
        var request = $http({
            method: "post",
            url: "php/cliente/manualpesquisanomecliente.php",
            data: text,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });
        request.then(function(response) {
            repos = response.data;
            console.log("retorno "+response.data.length);
            console.log(response.data.status);
            if (angular.isUndefined(response.data.status)) {
                exibir = false;
                //$scope.dicas = response.data;
                $scope.teste_de_resultado_de_busca = response.data;
            } else {
                console.log("Nenhum cliente retornado");
                exibir = true;
            }
        }, function(response) {
            console.log("ERROR" + response);
        });
        if (!angular.isUndefined($scope.teste_de_resultado_de_busca)) {
            repos = $scope.teste_de_resultado_de_busca;
            self.repos = repos;
            return repos.map(function(repo) {
                repo.value = repo.nome.toLowerCase();
                return repo;
            });
        } else {
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
function pesagemManualFornecedorController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {
// NOVA VERSÃO DA ROTINA DE PESQUISA
var self = this;
    self.simulateQuery = false;
    self.isDisabled = false;
    self.repos = loadAll('');
    self.querySearch = querySearch;
    self.selectedItemChange = selectedItemChange;
    self.searchTextChange = searchTextChange;
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
        $log.info('pesquisando por: ' + text);
        loadAll(text);
    }
    function selectedItemChange(item) {
        // $log.info('Item changed to stenio' + JSON.stringify(item));
        $scope.pesagem.fornecedor_id_fornecedor = item.id_fornecedor;
        $scope.selected = item;
        console.log($scope.selected);
    }
    function loadAll(text) {
        var repos = [{
            'nome': 'AngularJS',
            'url': 'https://github.com/angular/angular.js',
            'watchers': '3,623',
            'forks': '16,175'
        }];
        

        var request = $http({
            method: "post",
            url: "php/fornecedor/manualpesquisanomefornecedor.php", // criar esse arquivo
            data: text,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });

        console.log(text);
 
        request.then(function(response) {
            repos = response.data;
            console.log("retorno " + response.data.length);
            console.log(response.data.status);
            if (angular.isUndefined(response.data.status)) {
                exibir = false;
                //$scope.dicas = response.data;
                $scope.teste_de_resultado_de_busca = response.data;
            } else {
                console.log("Nenhum fornecedor retornado");
                exibir = true;
            }
        }, function(response) {
            console.log("ERROR" + response);
        });
        if (!angular.isUndefined($scope.teste_de_resultado_de_busca)) {
            repos = $scope.teste_de_resultado_de_busca;
            self.repos = repos;
            return repos.map(function(repo) {
                repo.value = repo.nome.toLowerCase();
                return repo;
            });
        } else {
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
    function createFilterFor(query) {
        var lowercaseQuery = angular.lowercase(query);
        return function filterFn(item) {
            return (item.value.indexOf(lowercaseQuery) === 0);
        };
    }

//FIM NOVA VERSÃO DA ROTINA DE PESQUISA
/*
// não apagar pode ser que outras paginas do programa utilize essa versão
// apos testes apagar se possivel
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
        $scope.pesagem.fornecedor_id_fornecedor = item.id_fornecedor;
    }
    
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
        if (!angular.isUndefined($scope.teste)) {
            repos = $scope.teste;
            self.repos = repos;
            return repos.map(function(repo) {
                repo.value = repo.nome.toLowerCase();
                return repo;
            });
        } else {
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
     
    function createFilterFor(query) {
        var lowercaseQuery = angular.lowercase(query);
        return function filterFn(item) {
            return (item.value.indexOf(lowercaseQuery) === 0);
        };
    }
    */
}
angular
    .module('home')
    .controller('pesagemManualFornecedorController', pesagemManualFornecedorController);

// fim controler

// inicio controler produto



// inicio controler 
// falta criar as rotinas para pesquisa de fornecedor
function pesagemManualProdutoController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {
//VERSÃO NOVA
 var self = this;
    self.simulateQuery = false;
    self.isDisabled = false;
    self.repos = loadAll('');
    self.querySearch = querySearch;
    self.selectedItemChange = selectedItemChange;
    self.searchTextChange = searchTextChange;
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
        $log.info('pesquisando por: ' + text);
        loadAll(text);
    }
    function selectedItemChange(item) {
        // $log.info('Item changed to stenio' + JSON.stringify(item));
        $scope.pesagem.produto_id_produto = item.id_produto;
        $scope.selected = item;
        console.log($scope.selected);
    }
    function loadAll(text) {
        var repos = [{
            'nome': 'AngularJS',
            'url': 'https://github.com/angular/angular.js',
            'watchers': '3,623',
            'forks': '16,175'
        }];
        console.log(text);
        var request = $http({
            method: "post",
            url: "php/produto/manualpesquisanomeproduto.php",
            data: text,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });
        request.then(function(response) {
            repos = response.data;
            console.log("retorno "+response.data.length);
            console.log(response.data.status);
            if (angular.isUndefined(response.data.status)) {
                exibir = false;
                //$scope.dicas = response.data;
                $scope.teste_de_resultado_de_busca = response.data;
            } else {
                console.log("Nenhum produto retornado");
                exibir = true;
            }
        }, function(response) {
            console.log("ERROR" + response);
        });
        if (!angular.isUndefined($scope.teste_de_resultado_de_busca)) {
            repos = $scope.teste_de_resultado_de_busca;
            self.repos = repos;
            return repos.map(function(repo) {
                repo.value = repo.nome.toLowerCase();
                return repo;
            });
        } else {
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
    function createFilterFor(query) {
        var lowercaseQuery = angular.lowercase(query);
        return function filterFn(item) {
            return (item.value.indexOf(lowercaseQuery) === 0);
        };
    }

// FIM VERSÃO NOVA
/*
    // onde era DemoCtrl vira pesagemManualCliente
    var self = this;
    self.simulateQuery = false;
    self.isDisabled = false;
    self.repos = loadAll();
    self.querySearch = querySearch;
    self.selectedItemChange = selectedItemChange;
    self.searchTextChange = searchTextChange;
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
        $scope.pesagem.produto_id_produto = item.id_produto;
    }
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
        if (!angular.isUndefined($scope.teste)) {
            repos = $scope.teste;
            self.repos = repos;
            return repos.map(function(repo) {
                repo.value = repo.nome.toLowerCase();
                return repo;
            });
        } else {
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
    function createFilterFor(query) {
        var lowercaseQuery = angular.lowercase(query);
        return function filterFn(item) {
            return (item.value.indexOf(lowercaseQuery) === 0);
        };
    }
    */
}
angular
    .module('home')
    .controller('pesagemManualProdutoController', pesagemManualProdutoController);

    //inicio desenvolvimento controler veiculos na pesagem manual
function pesagemManualVeiculoController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {
 
var self = this;
    self.simulateQuery = false;
    self.isDisabled = false;
    self.repos = loadAll('');
    self.querySearch = querySearch;
    self.selectedItemChange = selectedItemChange;
    self.searchTextChange = searchTextChange;

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

        $log.info('pesquisando por: ' + text);

        loadAll(text);
    }
    function selectedItemChange(item) {

        console.log(item.id_veiculo);
        console.log($scope.pesagem);
        // $log.info('Item changed to stenio' + JSON.stringify(item));
        $scope.pesagem.veiculo_id_veiculo = item.id_veiculo;
        $scope.pesagem.placa = item.placa;
        $scope.pesagem.tipo_veiculo = item.tipo;
        $scope.selected = item;
        console.log($scope.selected);
    }
    function loadAll(text) {
        var repos = [{
            'nome': 'AngularJS',
            'url': 'https://github.com/angular/angular.js',
            'watchers': '3,623',
            'forks': '16,175'
        }];
        console.log(text);
        var request = $http({
            method: "post",
            url: "php/veiculo/manualpesquisaplacaveiculo.php",
            data: text,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });
        request.then(function(response) {
            repos = response.data;
            console.log("retorno "+response.data.length);
            console.log(response.data.status_veiculo);
            if (angular.isUndefined(response.data.status_veiculo)) {
                exibir = false;
                //$scope.dicas = response.data;
                $scope.teste_de_resultado_de_busca = response.data;
            } else {
                console.log("era pra rodar aqui");
                // colocar placa nao cadastrada.
Materialize.toast('PLACA NÃO CADASTRADA', 3000,'rounded', 'center');
  
Materialize.toast();
            }
        }, function(response) {
            console.log("ERROR" + response);
        });
        if (!angular.isUndefined($scope.teste_de_resultado_de_busca)) {
            repos = $scope.teste_de_resultado_de_busca;
            self.repos = repos;
            return repos.map(function(repo) {
                repo.value = repo.placa.toLowerCase();
                return repo;
            });
        } else {
            repos = [{
                'placa': 'AngularJS',
                'url': 'https://github.com/angular/angular.js',
                'watchers': '3,623',
                'forks': '16,175'
            }];
            return repos.map(function(repo) {
                repo.value = repo.placa.toLowerCase();
                return repo;
            });
        }
    }
    function createFilterFor(query) {
        var lowercaseQuery = angular.lowercase(query);
        return function filterFn(item) {
            return (item.value.indexOf(lowercaseQuery) === 0);
        };
    }

  

        

////////////////////////

  

}
angular
    .module('home')
    .controller('pesagemManualVeiculoController', pesagemManualVeiculoController);



    // fim do controler veiculos