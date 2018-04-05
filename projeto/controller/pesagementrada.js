  function pesagemEntradaController($scope, $http, $log, $cookieStore, $mdDialog, $q, $timeout, meuServico, $cookies) {
    $scope.capturar_peso = function() {
        console.log("pesagemAvulsaController :capturar_peso");
         console.log("Coleta de peso");
         var ipx = window.location.hostname;
         var xhr = $.ajax({
             url: 'http://' + ipx + '/autocomplete/projeto/php/comandos/LER_PESO.php',
             async: true,
             timeout: 5000,
         }).done(function(data) {
            console.log(data);
             if ($.isNumeric(data) == true) {
                 // console.log("teste funfou reconheceu digito"); 

                 $scope.pesagem.peso_1 = data;
                 document.querySelector("[name='primeira']").value = data;
                 $scope.$apply(function() {
                     $scope.pesagem.peso_1 = data;
                 });
                 // se chegou até aqui é pq todos os campos foram atendidos e o peso foi coletado 
                 // então pode liberar o envio da pesagem
                 $scope.autorizar_envio_pesagem_entrada();
                 $scope.modulo( );
                
                 // criado esse if porque as vezes na primeira pesagem a tranferencia de
                 // data para peso_1 o ultimo digito nao ia. Não sabendo o motivo 
                 // Coloquei o if para refazer a coleta e ter redundancia na transferencia 

                 if($scope.pesagem.peso_1 == data ){
                  //  console.log("é igual data e peso_1");
                 }else{

                     $scope.pesagem.peso_1 = data;
                 document.querySelector("[name='primeira']").value = data;
                 $scope.$apply(function() {
                     $scope.pesagem.peso_1 = data;
                 });

                 }
          
             } else {
                 // console.log("colocar alert e solicitar captura novamente");
                 Materialize.toast('PESO INSTÁVEL.', 3000, 'rounded', 'center');
                 Materialize.toast();
             }
         });
         

     }

     $scope.autorizar_envio_pesagem_entrada = function() {
        console.log("pesagemEntradaController :autorizar_envio_pesagem_entrada");
         // fazer o teste de liberação do botao.
         // teste para pesagem de entrada

         var permite_pesagem_entrada = $scope.pesagem.peso_1;
          console.log(permite_pesagem_entrada);
         if ($.isNumeric(permite_pesagem_entrada) == true) {
             $scope.pesagem.status = 0;
         }
     }


     $scope.openFromLeft = function() {
        console.log("pesagemEntradaController :openFromLeft");
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
        console.log("pesagemEntradaController :openOffscreen");
         $mdDialog.show(
             $mdDialog.alert()
             .clickOutsideToClose(true)
             .title('Pesagem concluída')
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

     /////// função em teste
     $scope.abrirPDFManual = function(pesagem) {
        console.log("pesagemEntradaController :abrirPDFManual");
         var request = $http({
             method: "post",
             url: "php/pesagem/impressaopesagemmanual.php",
             data: pesagem,
             headers: {
                 'Content-Type': 'application/x-www-form-urlencoded'
             }
         });
         console.log(pesagem);
         request.then(function(response) {
             console.log(response.data);
         }, function(response) {
             console.log("ERROR" + response);
         });
     }

     $scope.salvar = function() {
        console.log("pesagemEntradaController :salvar");
         //console.log($scope.pesagem);
         //console.log("aqui vai para o banco");
         // percebi ser interessante converter em int os dados antes de salvar no 
         // banco. por exemplo as chaves estrangeiras devem ser inteiro
         // e a leitura de peso tambem.
         //PARSEiNT = CONVERTE STRING EM INTEIRO
         $scope.pesagem.cliente_id_cliente = parseInt($scope.pesagem.cliente_id_cliente);
         $scope.pesagem.fornecedor_id_fornecedor = parseInt($scope.pesagem.fornecedor_id_fornecedor);
         $scope.pesagem.peso_1 = parseInt($scope.pesagem.peso_1);
         if ($scope.pesagem.status == 3) {
             $scope.pesagem.peso_1 = parseInt($scope.pesagem.peso_1);
             $scope.pesagem.peso_2 = parseInt($scope.pesagem.peso_2);
             $scope.pesagem.peso_descontos = parseInt($scope.pesagem.peso_descontos);
             $scope.pesagem.peso_liquido = parseInt($scope.pesagem.peso_liquido);

         }
         if ($scope.pesagem.status == 0) {
             $scope.pesagem.peso_1 = parseInt($scope.pesagem.peso_1);


         }

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
         //    console.log($scope.pesagem );
         request.then(function(response) {
             console.log(response.data);
             console.log("aqui volta do banco");
             // $scope.Cliente = response.data;
             // foi necessario atualizar o objeto cliente com os dados de id retornado do banco
             // isso faz a atualização do objeto que está na pagina.
             $scope.pesagem = response.data;
             //console.log( response.data[0].cliente);
             $cookies.putObject('impressao', response.data[0]);
             // $cookies.impressao = response.data[0];
         }, function(response) {
             console.log("ERROR" + response);
         });
     }

     var exibir = false;
     //para mostrar a mensagem que não houve resultados
     $scope.exibe = function(nome) {
        console.log("pesagemEntradaController :exibe");
         //console.log(nome.length);
         //console.log("".localeCompare(nome));
         return (("".localeCompare(nome) != 0) && exibir);
     };


     $scope.autorizar_envio = function() {
        console.log("pesagemEntradaController :autorizar_envio");
         //OBJETIVO
         // aqui defini que a pesagem foi manual   
         // contar quantas string tem no objeto campo pesagem.placa
         // se igual a 8 E se existe ALGUM PESO DIGITADO.
         // então ative botão enviar.
         // coloque 3 no pesagem.status
         // fazer o teste de liberação do botao.
         // teste para pesagem de entrada
         var permite_pesagem_entrada = $scope.pesagem.peso_1;
         if ($.isNumeric(permite_pesagem_entrada) == true) {
             $scope.pesagem.status = 0;
         }

         // fim  teste para pesagem de entrada

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
        console.log("pesagemEntradaController :modulo");
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
        console.log("pesagemEntradaController :isEmpty");
         for (var prop in obj) {
             if (obj.hasOwnProperty(prop))
                 return false;
         }
         return true;
     }
     $scope.data = [" "];
     // variável que é responsável pelo gerenciamento do compoenent auto complete
 }

 



 angular
     .module('home')
     .controller('pesagemEntradaController', pesagemEntradaController);
 /////

 //////////////////////////////////////////////////////////////////////////////////

 // inicio controller pesagemManualClienteController
 function pesagemEntradaClienteController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {
     var self = this;
     self.simulateQuery = false;
     self.isDisabled = false;
     self.repos = loadAll('');
     self.querySearch = querySearch;
     self.selectedItemChange = selectedItemChange;
     self.searchTextChange = searchTextChange;

     function querySearch(query) {
        console.log("pesagemEntradaClienteController :querySearch");

         var results = query ? self.repos.filter(createFilterFor(query)) : self.repos,
             deferred;
         if (self.simulateQuery) {
             deferred = $q.defer();
             $timeout(function() {
                 deferred.resolve(results);
             }, Math.random() * 1000, false);
             return deferred.promise;
         } else {
             return results;
         }
     }

     function searchTextChange(text) {
         console.log("pesagemEntradaClienteController :searchTextChange");

         $log.info('pesquisando por: ' + text);
         loadAll(text);
     }

     function selectedItemChange(item) {
        console.log("pesagemEntradaClienteController :selectedItemChange");
         // $log.info('Item changed to stenio' + JSON.stringify(item));
         $scope.pesagem.cliente_id_cliente = item.id_cliente;
         $scope.selected = item;
         console.log($scope.selected);
     }

     function loadAll(text) {
         console.log("pesagemEntradaClienteController :loadAll");
         var repos = [{
             'nome': 'AngularJS',
             'url': 'https://github.com/angular/angular.js',
             'watchers': '3,623',
             'forks': '16,175'
         }];
         console.log(text);
         // TRATAMENTO SE SELECIONAR E DEPOIS APAGAR A SELEÇÃO DEVE APAGAR DO
         // OBJETO O QUE FOI SELECIONADO
         if ($scope.pesagem === undefined) {} else {
             if ($scope.pesagem.placa === undefined) {
                 console.log("primeira consulta sem seleção");
             } else {
                 if (text.length === 0) {
                     console.log("SELECIONADO e depois apagado");
                     Materialize.toast('ITEM SELECIONADO APAGADO', 1000, 'rounded', 'center');
                     Materialize.toast();
                     $scope.pesagem.cliente_id_cliente = null;
                     $scope.selected = null;
                     console.log($scope.pesagem);
                 }
             }
         }

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
             console.log("retorno " + response.data.length);
             console.log(response.data.status);
             if (angular.isUndefined(response.data.status)) {
                 exibir = false;
                 //$scope.dicas = response.data;
                 $scope.teste_de_resultado_de_busca = response.data;
             } else {
                 // COLOCAR AQUI ALERT INFORMANDO QUE NAO TEM O REGISTRO
                 Materialize.toast('REGISTRO NAO ENCONTRADO', 1000, 'rounded', 'center');
                 Materialize.toast();
                 //  console.log("Nenhum cliente retornado");
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
        console.log("pesagemEntradaClienteController :createFilterFor");
         var lowercaseQuery = angular.lowercase(query);
         return function filterFn(item) {
             return (item.value.indexOf(lowercaseQuery) === 0);
         };
     }
 }
 angular
     .module('home')
     .controller('pesagemEntradaClienteController', pesagemEntradaClienteController);
 // fim controller pesagemManualClienteController
 // inicio controler 
 // falta criar as rotinas para pesquisa de fornecedor
 function pesagemEntradaFornecedorController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {
     // NOVA VERSÃO DA ROTINA DE PESQUISA
     var self = this;
     self.simulateQuery = false;
     self.isDisabled = false;
     self.repos = loadAll('');
     self.querySearch = querySearch;
     self.selectedItemChange = selectedItemChange;
     self.searchTextChange = searchTextChange;

     function querySearch(query) {
         console.log("pesagemEntradaFornecedorController :querySearch");
         var results = query ? self.repos.filter(createFilterFor(query)) : self.repos,
             deferred;
         if (self.simulateQuery) {
             deferred = $q.defer();
             $timeout(function() {
                 deferred.resolve(results);
             }, Math.random() * 1000, false);
             return deferred.promise;
         } else {
             return results;
         }
     }

     function searchTextChange(text) {
        console.log("pesagemEntradaFornecedorController :searchTextChange");
         $log.info('pesquisando por: ' + text);
         loadAll(text);
     }

     function selectedItemChange(item) {
         console.log("pesagemEntradaFornecedorController :selectedItemChange");
         // $log.info('Item changed to stenio' + JSON.stringify(item));
         $scope.pesagem.fornecedor_id_fornecedor = item.id_fornecedor;
         $scope.selected = item;
         console.log($scope.selected);
     }

     function loadAll(text) {
        console.log("pesagemEntradaFornecedorController :loadAll");
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
         // TRATAMENTO SE SELECIONAR E DEPOIS APAGAR A SELEÇÃO DEVE APAGAR DO
         // OBJETO O QUE FOI SELECIONADO
         if ($scope.pesagem === undefined) {} else {
             if ($scope.pesagem.placa === undefined) {
                 console.log("primeira consulta sem seleção");
             } else {
                 if (text.length === 0) {
                     console.log("SELECIONADO e depois apagado");
                     Materialize.toast('ITEM SELECIONADO APAGADO', 1000, 'rounded', 'center');
                     Materialize.toast();
                     $scope.pesagem.fornecedor_id_fornecedor = null;
                     $scope.selected = null;
                     console.log($scope.pesagem);
                 }
             }
         }
         // FIM DO TRATAMENTO
         request.then(function(response) {
             repos = response.data;
             console.log("retorno " + response.data.length);
             console.log(response.data.status);
             if (angular.isUndefined(response.data.status)) {
                 exibir = false;
                 //$scope.dicas = response.data;
                 $scope.teste_de_resultado_de_busca = response.data;
             } else {
                 Materialize.toast('REGISTRO NAO ENCONTRADO', 1000, 'rounded', 'center');
                 Materialize.toast();
                 //  console.log("Nenhum fornecedor retornado");
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
        console.log("pesagemEntradaFornecedorController :createFilterFor");
         var lowercaseQuery = angular.lowercase(query);
         return function filterFn(item) {
             return (item.value.indexOf(lowercaseQuery) === 0);
         };
     }
     //FIM NOVA VERSÃO DA ROTINA DE PESQUISA
 }
 angular
     .module('home')
     .controller('pesagemEntradaFornecedorController', pesagemEntradaFornecedorController);

 function pesagemEntradaProdutoController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {
     //VERSÃO NOVA
     var self = this;
     self.simulateQuery = false;
     self.isDisabled = false;
     self.repos = loadAll('');
     self.querySearch = querySearch;
     self.selectedItemChange = selectedItemChange;
     self.searchTextChange = searchTextChange;

     function querySearch(query) {
        console.log("pesagemEntradaProdutoController :querySearch");
         var results = query ? self.repos.filter(createFilterFor(query)) : self.repos,
             deferred;
         if (self.simulateQuery) {
             deferred = $q.defer();
             $timeout(function() {
                 deferred.resolve(results);
             }, Math.random() * 1000, false);
             return deferred.promise;
         } else {
             return results;
         }
     }

     function searchTextChange(text) {
        console.log("pesagemEntradaProdutoController :searchTextChange");
         $log.info('pesquisando por: ' + text);
         loadAll(text);
     }

     function selectedItemChange(item) {
        console.log("pesagemEntradaProdutoController :selectedItemChange");
         // $log.info('Item changed to stenio' + JSON.stringify(item));
         $scope.pesagem.produto_id_produto = item.id_produto;
         $scope.selected = item;
         console.log($scope.selected);
     }

     function loadAll(text) {
        console.log("pesagemEntradaProdutoController :loadAll");
         var repos = [{
             'nome': 'AngularJS',
             'url': 'https://github.com/angular/angular.js',
             'watchers': '3,623',
             'forks': '16,175'
         }];
         console.log(text);
         // TRATAMENTO SE SELECIONAR E DEPOIS APAGAR A SELEÇÃO DEVE APAGAR DO
         // OBJETO O QUE FOI SELECIONADO
         if ($scope.pesagem === undefined) {} else {
             if ($scope.pesagem.placa === undefined) {
                 console.log("primeira consulta sem seleção");
             } else {
                 if (text.length === 0) {
                     console.log("SELECIONADO e depois apagado");
                     Materialize.toast('ITEM SELECIONADO APAGADO', 1000, 'rounded', 'center');
                     Materialize.toast();
                     $scope.pesagem.produto_id_produto = null;
                     $scope.selected = null;
                     console.log($scope.pesagem);
                 }
             }
         }

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
             console.log("retorno " + response.data.length);
             console.log(response.data.status);
             if (angular.isUndefined(response.data.status)) {
                 exibir = false;
                 //$scope.dicas = response.data;
                 $scope.teste_de_resultado_de_busca = response.data;
             } else {
                 Materialize.toast('REGISTRO NAO ENCONTRADO', 1000, 'rounded', 'center');
                 Materialize.toast();
                 // console.log("Nenhum produto retornado");
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
          console.log("pesagemEntradaProdutoController :createFilterFor");
         var lowercaseQuery = angular.lowercase(query);
         return function filterFn(item) {
             return (item.value.indexOf(lowercaseQuery) === 0);
         };
     }

 }
 angular
     .module('home')
     .controller('pesagemEntradaProdutoController', pesagemEntradaProdutoController);

 //inicio desenvolvimento controler veiculos na pesagem manual
 function pesagemEntradaVeiculoController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {

     var self = this;
     self.simulateQuery = false;
     self.isDisabled = false;
     self.repos = loadAll('');
     self.querySearch = querySearch;
     self.selectedItemChange = selectedItemChange;
     self.searchTextChange = searchTextChange;

     function querySearch(query) {
        console.log("pesagemEntradaVeiculoController :querySearch");
         var results = query ? self.repos.filter(createFilterFor(query)) : self.repos,
             deferred;
         if (self.simulateQuery) {
             deferred = $q.defer();
             $timeout(function() {
                 deferred.resolve(results);
             }, Math.random() * 1000, false);
             return deferred.promise;
         } else {
             return results;
         }
     }

     function searchTextChange(text) {
        console.log("pesagemEntradaVeiculoController :searchTextChange");
         $log.info('pesquisando por: ' + text);
         loadAll(text);
     }
// função que testa se existe mais registro de pesagem de entrada do que de saida

 function regraPesagemEntrada(item) {
    
    // FUNÇÃO QUE CONSULTA AS PESAGENS RELACIONADAS POR ID VEICULO PLACA
    // OBJETIVO RETORNAR 
    // ok  consultar se a placa tem pesagem 
    // contar quantas pesagem de entrada
    // contar quantas pesagem de saida
    var request = $http({
        method: "post",
        url: "php/pesagem/consultaplacapesagementrada.php",
        data: $scope.pesagem,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    });
    console.log($scope.pesagem);
    request.then(function(response) {
        //  console.log(response.data);
        var arr = [];
        var cont_pesagem_entrada = 0;
        var cont_pesagem_saida = 0;
        var cont_pesagem_manual = 0;
        var cont_pesagem_avulsa = 0;
        for (var i in response.data) {
            //arr.push(response.data[i].status);  
            if (response.data[i].status === "PESAGEM ENTRADA") {
                cont_pesagem_entrada = cont_pesagem_entrada + 1;
            } else if (response.data[i].status === "PESAGEM MANUAL") {
                cont_pesagem_manual = cont_pesagem_manual + 1;
            } else if (response.data[i].status === "PESAGEM SAIDA") {
                cont_pesagem_saida = cont_pesagem_saida + 1;
            } else if (response.data[i].status === "PESAGEM AVULSA") {
                cont_pesagem_avulsa = cont_pesagem_avulsa + 1;
            }
        }
        console.log("contador de eventos");
        console.log("entrada");
        console.log(cont_pesagem_entrada);
        console.log("manual");
        console.log(cont_pesagem_manual);
        console.log("saida");
        console.log(cont_pesagem_saida);
        console.log("avulsa");
        console.log(cont_pesagem_avulsa);
        // se pesagem de entrada for maior que pesagem de saida
        // isso quer dizer que esse veiculo está no patio
        // com pesagem de entrada em aberto. então o sistema limpa a placa
        // se pesagem de saida  ==  a pesagem de entra 
        // então o sistema pode registrar nova pesagem
        // as pesagem avulsa e manual nao entraram no processo de
        // de controle de entrada e saida
        if (cont_pesagem_entrada === cont_pesagem_saida) {
            console.log("permitido pesagem de entrada");
        } else {
            console.log("Pesagem de entrada em aberto");
            Materialize.toast('VEÍCULO INFORMADO JÁ ENCONTRA-SE DENTRO DO PÁTIO!', 2000, 'rounded', 'center');
            Materialize.toast();
            $scope.pesagem.veiculo_id_veiculo = null;
            $scope.pesagem.placa = null;
            $scope.pesagem.tipo_veiculo = null;
            $scope.selected = null;
        }
        //$scope.pesagem.tipo_pesagem = response.data[0].status;
        //console.log($scope.pesagem.tipo_pesagem);
    }, function(response) {
        console.log("ERROR" + response);
    });
    // fim teste 
}

     function selectedItemChange(item) {
        console.log("pesagemEntradaVeiculoController :selectedItemChange");
       //  console.log(item.id_veiculo);
         if(item!=null){ // tratamento do if quando apaga


         //console.log($scope.pesagem);
         // $log.info('Item changed to stenio' + JSON.stringify(item));
         $scope.pesagem.veiculo_id_veiculo = item.id_veiculo;
         $scope.pesagem.placa = item.placa;
         $scope.pesagem.tipo_veiculo = item.tipo;
         $scope.selected = item;
    regraPesagemEntrada(item);

        // console.log("o id da placa é:");
        // console.log("    ");
         //console.log($scope.pesagem.veiculo_id_veiculo);
        // console.log($scope.selected);

  }// tratamento do if quando apaga

/////////////////////////////temporario sera criada uma função








     }

     function loadAll(text) {
          console.log("pesagemEntradaVeiculoController :loadAll");
         var repos = [{
             'nome': 'AngularJS',
             'url': 'https://github.com/angular/angular.js',
             'watchers': '3,623',
             'forks': '16,175'
         }];
         // TRATAMENTO SE SELECIONAR E DEPOIS APAGAR A SELEÇÃO DEVE APAGAR DO
         // OBJETO O QUE FOI SELECIONADO
         if ($scope.pesagem === undefined) {} else {
             if ($scope.pesagem.placa === undefined) {
                 console.log("primeira consulta sem seleção");
             } else {
                 if (text.length === 0) {
                     console.log("SELECIONADO e depois apagado");
                     Materialize.toast('ITEM SELECIONADO APAGADO', 1000, 'rounded', 'center');
                     Materialize.toast();
                     $scope.pesagem.veiculo_id_veiculo = null;
                     $scope.pesagem.placa = null;
                     $scope.pesagem.tipo_veiculo = null;
                     $scope.selected = null;
                     console.log($scope.pesagem);
                 }
             }
         }

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
             console.log("retorno " + response.data.length);
             console.log(response.data.status_veiculo);
             if (angular.isUndefined(response.data.status_veiculo)) {
                 exibir = false;
                 //$scope.dicas = response.data;
                 $scope.teste_de_resultado_de_busca = response.data;
             } else {
                 //console.log("era pra rodar aqui");
                 // colocar placa nao cadastrada.
                 Materialize.toast('PLACA NÃO CADASTRADA', 3000, 'rounded', 'center');

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
        console.log("pesagemEntradaVeiculoController :createFilterFor");
         var lowercaseQuery = angular.lowercase(query);
         return function filterFn(item) {
             return (item.value.indexOf(lowercaseQuery) === 0);
         };
     }

 }
 angular
     .module('home')
     .controller('pesagemEntradaVeiculoController', pesagemEntradaVeiculoController);