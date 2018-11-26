  function pesagemSaidaController($scope, $http, $log, $cookieStore, $mdDialog, $q, $timeout, meuServico, $cookies) {
     
/// ADICIONANDO DESCONTO NA PESAGEM SAIDA
        $scope.lines = [];
        $scope.cont = 1;

        /////////////////////////////////////////
    $scope.calculo_peso_descontado = function() {
        console.log("pesagemSaidaController :calculo_peso_descontado");
       

        if (!$scope.desconto.percentual) {
            console.log("$scope.desconto.absoluto");
            $scope.desconto.peso_descontado = $scope.desconto.absoluto;
        }  

        if (!$scope.desconto.absoluto) {
            console.log("$scope.desconto.percentual");
            $scope.desconto.peso_descontado = $scope.pesagem.peso_liquido * ($scope.desconto.percentual/100);
        }  

    }

     /////////////////////////////////////////////

      $scope.salvarListaDesconto = function() {
        console.log("cadastroClienteController :salvarListaDesconto");
          // CRIAR CONDIÇÃO QUE VERIFICA SE OS CAMPOS PLACAS SÃO DIFERENTES
          var i = 0;
          var listaRepetida = 0;
          if (!$scope.lines) {
              //SE É A PRIMEIRA DA LISTA
              $scope.cont = $scope.desconto;
              $scope.lines.push($scope.cont);
              console.log("PRIMEIRA DA LISTA");
              $scope.desconto = null;
          } else {
              //TRANSFIRO A INFO E LIMPO  VARIAVEL
              $scope.cont = $scope.desconto;
              $scope.lines.push($scope.cont);
              $scope.desconto = null;

              do {
                  var n = $scope.lines[i].nomedesconto.localeCompare($scope.cont.nomedesconto);
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
 //console.log($scope.lines);
        //parseInt($scope.pesagem.peso_descontos)
 $scope.pesagem.peso_descontos +=  parseInt( $scope.lines[$scope.lines.length - 1].peso_descontado);
//console.log("$scope.pesagem.peso_descontos");
//console.log($scope.pesagem.peso_descontos);
 
$scope.pesagem.peso_liquido_final = ($scope.pesagem.peso_liquido - $scope.pesagem.peso_descontos);
                


      }

 $scope.apagarListaDesconto = function() {
        console.log("cadastroClienteController :apagarListaDesconto");
          // CRIAR CONDIÇÃO QUE VERIFICA SE OS CAMPOS PLACAS SÃO DIFERENTES
$scope.pesagem.peso_descontos -=  parseInt( $scope.lines[$scope.lines.length - 1].peso_descontado);
 console.log($scope.lines.pop()); // remove o ultimo desconto
 $scope.pesagem.peso_liquido_final = ($scope.pesagem.peso_liquido - $scope.pesagem.peso_descontos);
   

      }

       $scope.consulta_nome_desconto = function() {
        console.log("cadastroFornecedorController :consulta_nome_desconto");
         var teste_tamanho_string = "";
         teste_tamanho_string = $scope.desconto.nomedesconto; // RETIREI A STRING DA PLACA
         var teste_tamanho_digitado = teste_tamanho_string.length; // DESCOBRI O TAMANHO
         //console.log($scope.veiculo);
       //  console.log(teste_tamanho_digitado); // FAÇO O TESTE DE APROVAÇÃO DE ENVIO
        // console.log($scope.desconto.nomedesconto);
         if (teste_tamanho_digitado >= 1) {
             var request = $http({
                 method: "post",
                 url: "php/desconto/pesquisardescontonome_saida.php",
                 data: $scope.desconto,
                 // data: $scope.veiculo.placa,
                 headers: {
                     'Content-Type': 'application/x-www-form-urlencoded'
                 }
             });
             request.then(function(response) {
                 console.log(response.data);
                 // SE RETORNAR ALGUM REGISTRO DO BANCO O ELSE RODA
                 // SE NAO RETORNAR NENHUM REGISTRO DO BANCO O IF RODA
                 ///
                 // colocar status 1 se existir 
                 // colcoar status 0 se nao tiver cadastro
                 if (!angular.isUndefined(response.data.status)) {
                     Materialize.toast('DESCONTO NAO   CADASTRADO', 3000, 'rounded', 'center');
                     $scope.desconto.nomedesconto = null;
                     Materialize.toast();
                     
                 } else {
                    if (response.data.status!== 0) {
                         
                        if($scope.desconto.nomedesconto == response.data[0].nome){
                         $scope.desconto.nomedesconto = response.data[0].nome;
                        $scope.desconto.id_desconto = response.data[0].id_desconto;

                        }else{
                            Materialize.toast('DESCONTO DIGITADO INCOMPLETO', 3000, 'rounded', 'center');
                     $scope.desconto.nomedesconto = null;
                     Materialize.toast();

                        }

                        

                    }else{
                        Materialize.toast('DESCONTO NAO   CADASTRADO', 3000, 'rounded', 'center');
                        $scope.desconto.nomedesconto = null;
                        Materialize.toast();


                    }
                   
                     
                 }
             }, function(response) {
                 console.log("ERROR" + response);
             });
         }

     }

     $scope.capturar_peso = function() {
        console.log("pesagemAvulsaController :capturar_peso");
        // console.log("Coleta de peso");
         var ipx = window.location.hostname;
         var xhr = $.ajax({
             url: 'http://' + ipx + '/autocomplete/projeto/php/comandos/LER_PESO.php',
             async: true,
             timeout: 5000,
         }).done(function(data) {
           // console.log(data);
             if ($.isNumeric(data) == true) {
                 // console.log("teste funfou reconheceu digito"); 

                 $scope.pesagem.peso_2 = data;
                 document.querySelector("[name='segunda']").value = data;
                 $scope.$apply(function() {
                   // console.log([data]);
                     $scope.pesagem.peso_2 = parseInt(data);
                   //  console.log([$scope.pesagem.peso_2]);

                 });
                 // se chegou até aqui é pq todos os campos foram atendidos e o peso foi coletado 
                 // então pode liberar o envio da pesagem
                // $scope.autorizar_envio_pesagem_saida();
                // $scope.modulo( );
                
                 // criado esse if porque as vezes na primeira pesagem a tranferencia de
                 // data para peso_1 o ultimo digito nao ia. Não sabendo o motivo 
                 // Coloquei o if para refazer a coleta e ter redundancia na transferencia 
                 /*
                 if($scope.pesagem.peso_2 == data ){
                  //  console.log("é igual data e peso_1");
                 }else{

                     $scope.pesagem.peso_2 = data;
                 document.querySelector("[name='segunda']").value = data;
                 $scope.$apply(function() {
                     $scope.pesagem.peso_2 = data;
                 });

                 }
                 */

                 $scope.autorizar_envio_pesagem_saida();
          
             


             } else {
                 // console.log("colocar alert e solicitar captura novamente");
                 Materialize.toast('PESO INSTÁVEL.', 3000, 'rounded', 'center');
                 Materialize.toast();
             }
         });
         

     }

     $scope.autorizar_envio_pesagem_saida = function() {
        console.log("pesagemSaidaController :autorizar_envio_pesagem_saida");
         // fazer o teste de liberação do botao.
         // teste para pesagem de saida
         // status  = 0 pesagem entrada
         // status  = 1 pesagem saida
         // status  = 2 pesagem avulsa
         // status  = 3 pesagem manual
         var permite_pesagem_saida = $scope.pesagem.peso_2;
         if ($.isNumeric(permite_pesagem_saida) == true) {
             $scope.pesagem.status = 1;
         }
         $scope.modulo();
     }


     $scope.openFromLeft = function() {
        console.log("pesagemSaidaController :openFromLeft");
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
        console.log("pesagemSaidaController :openOffscreen");
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
        console.log("pesagemSaidaController :abrirPDFManual");
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
        console.log("pesagemSaidaController :salvar");
        // console.log($scope.pesagem);
         var data_entrada = null;
         //console.log("aqui vai para o banco");
         // percebi ser interessante converter em int os dados antes de salvar no 
         // banco. por exemplo as chaves estrangeiras devem ser inteiro
         // e a leitura de peso tambem.
         //PARSEiNT = CONVERTE STRING EM INTEIRO
         // status  = 0 pesagem entrada
         // status  = 1 pesagem saida
         // status  = 2 pesagem avulsa
         // status  = 3 pesagem manual

         $scope.pesagem.cliente_id_cliente = parseInt($scope.pesagem.cliente_id_cliente);
         $scope.pesagem.fornecedor_id_fornecedor = parseInt($scope.pesagem.fornecedor_id_fornecedor);
         $scope.pesagem.peso_1 = parseInt($scope.pesagem.peso_1);
         if ($scope.pesagem.status == 3) {
             $scope.pesagem.peso_1 = parseInt($scope.pesagem.peso_1);
             $scope.pesagem.peso_2 = parseInt($scope.pesagem.peso_2);
             $scope.pesagem.peso_descontos = parseInt($scope.pesagem.peso_descontos);
             $scope.pesagem.peso_liquido = parseInt($scope.pesagem.peso_liquido);

         }
         if ($scope.pesagem.status == 2) {
             $scope.pesagem.peso_1 = parseInt($scope.pesagem.peso_1);
             $scope.pesagem.peso_2 = parseInt($scope.pesagem.peso_2);
             $scope.pesagem.peso_descontos = parseInt($scope.pesagem.peso_descontos);
             $scope.pesagem.peso_liquido = parseInt($scope.pesagem.peso_liquido);

         }
         if ($scope.pesagem.status == 1) {
             $scope.pesagem.peso_1 = parseInt($scope.pesagem.peso_1);
             $scope.pesagem.peso_2 = parseInt($scope.pesagem.peso_2);
             $scope.pesagem.peso_descontos = parseInt($scope.pesagem.peso_descontos);
             $scope.pesagem.peso_liquido = parseInt($scope.pesagem.peso_liquido);
             $scope.pesagem.peso_liquido_final = parseInt($scope.pesagem.peso_liquido_final);
             data_entrada = $scope.pesagem.data_entrada;
             //console.log(data_entrada);

         }
         if ($scope.pesagem.status == 0) {
             $scope.pesagem.peso_1 = parseInt($scope.pesagem.peso_1);


         }

         //console.log($scope.pesagem);
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
         //$scope.pesagem.data_entrada = data_entrada;
         //console.log($scope.pesagem.data_entrada);
         request.then(function(response) {
             
            // console.log(response.data);
           //  console.log("Retorno banco de dados salvar pesagem");
             
             // $scope.Cliente = response.data;
             // foi necessario atualizar o objeto cliente com os dados de id retornado do banco
             // isso faz a atualização do objeto que está na pagina.
             response.data[0].data_entrada = data_entrada;
            $scope.pesagem = response.data;

            //USAR O RETORNO DA PESAGEM PARA PEGAR O ID PESAGEM
 /*
NOTA: DEPOIS DE SALVAR A PESAGEM INICIA O PROCESSO DE SALVAR OS DESCONTOS
salvar_desconto_aplicado
1 SALVA A LISTA DE DESCONTOS APLICADOS; NESSA ETAPA SALVA OS VALORES ADICIONADOS
PELO USUARIO COMO CLASSIFICAÇÃO, PERCENTUAL DESCONTADO ENTRE OUTROS


 */
            $scope.salvar_desconto_aplicado();

        console.log($scope.lines);
             $cookies.putObject('impressao', response.data[0]);
             $cookies.putObject('impressaoDescontos', $scope.lines);// passando lista de descontos
         
             // $cookies.impressao = response.data[0];
         }, function(response) {
             console.log("ERROR" + response);
         });

         //////////////////////////////////// 
         // CHAMAR FUNÇÃO DE SALVAR INTENS DESCONTO

//$scope.salvar_desconto_aplicado( );
//$scope.organizar();

         // FIM CHAMADA FUNÇÃO SALVAR ITENS DESCONTO.
     }


$scope.organizar = function() {
    // mostra os objetos da pagina pesagem saida.
        console.log("pesagemSaidaController :organizar");
        console.log("Objeto pesagem");
         console.log($scope.pesagem)
         console.log("----------");
         console.log("Objeto lista dos descontos APLICADOS");
         console.log($scope.lines)
         console.log("----------");
         //testando salvar lista de descontos aplicados
         //$scope.salvar_desconto_aplicado();

         // ROTINA PARA SALVAR DESCONTOS
         // OK SALVA A PESAGEM DE SAIDA 
         // OK RETORNA O ID PESAGEM SAIDA.
         // OK SALVA A LISTA DE DESCONTO APLICADOS
         // OK RETORNA A LISTA DOS ID  DESCONTOS APLICADOS
         // SALVA PARA CADA ID DESCONTO APLICADO UM REGISTRO NO ITENS DESCONTO.

         
     };
 
$scope.salvar_desconto_aplicado = function() {

        console.log("cadastroDescontoController :salvar_desconto_aplicado");
         var request = $http({
             method: "post",
             url: "php/desconto_aplicado/salvardesconto_aplicado.php",
             data: $scope.lines,
             headers: {
                 'Content-Type': 'application/x-www-form-urlencoded'
             }
         });
         request.then(function(response) {
           // console.log("FUNÇÃO salvar_desconto_aplicado");
            // console.log(response.data);
             // $scope.Cliente = response.data;
             // foi necessario atualizar o objeto cliente com os dados de id retornado do banco
             // isso faz a atualização do objeto que está na pagina.
             //$scope.openOffscreen();
            
             $scope.lines = response.data;
             //console.log($scope.lines);
            // console.log($scope.pesagem);
             $scope.lines[0].pesagem_id_pesagem = $scope.pesagem[0].id_pesagem

/*
NOTA: DEPOIS DE SALVAR A PESAGEM INICIA O PROCESSO DE SALVAR OS DESCONTOS
salvar_desconto_aplicado
1 SALVA A LISTA DE DESCONTOS APLICADOS; NESSA ETAPA SALVA OS VALORES ADICIONADOS
PELO USUARIO COMO CLASSIFICAÇÃO, PERCENTUAL DESCONTADO ENTRE OUTROS
salvar_itens_desconto
2 SALVA OS ITENS DE DESCONTO ASSOCIADO A PESAGEM 

 */
             $scope.salvar_itens_desconto(); // DEPOIS DE SALVAR OS DESCONTOS APLICADOS
                                            // SALVA OS ITENS DESCONTO

         }, function(response) {
             console.log("ERROR" + response);
         });
        // $scope.salvar_itens_desconto(); PODE SER QUE NÃO TEM SINCRONISMO OU UM ATRAZO NA HORA DE SALVAR

     }
// FIM FUNÇÃO ITENS DESCONTOS APLICADOS NA PESAGEM SAIDA.
// FUNÇAO ITENS DESCONTO
 $scope.salvar_itens_desconto = function() {
        console.log("cadastroDescontoController :salvar_itens_desconto");
         var request = $http({
             method: "post",
             url: "php/itens_desconto/salvaritens_desconto.php",
             data: $scope.lines,
             headers: {
                 'Content-Type': 'application/x-www-form-urlencoded'
             }
         });
         request.then(function(response) {
            //console.log("FUNÇÃO salvar_itens_desconto");
            // console.log(response.data);
 
         }, function(response) {
             console.log("ERROR" + response);
         });
     }
 
// FIM FUNÇAO ITENS DESCONTO


     var exibir = false;
     //para mostrar a mensagem que não houve resultados
     $scope.exibe = function(nome) {
        console.log("pesagemSaidaController :exibe");
         //console.log(nome.length);
         //console.log("".localeCompare(nome));
         return (("".localeCompare(nome) != 0) && exibir);
     };


     $scope.autorizar_envio = function() {
        console.log("pesagemAntradaController :autorizar_envio");
         //OBJETIVO
         // aqui defini que a pesagem foi manual   
         // contar quantas string tem no objeto campo pesagem.placa
         // se igual a 8 E se existe ALGUM PESO DIGITADO.
         // então ative botão enviar.
         // coloque 3 no pesagem.status
         // fazer o teste de liberação do botao.
         // teste para pesagem de entrada
         var permite_pesagem_saida = $scope.pesagem.peso_1;
         if ($.isNumeric(permite_pesagem_saida) == true) {
             $scope.pesagem.status = 2;
         }

         // fim  teste para pesagem de entrada

         var teste = $scope.pesagem.placa; // RETIREI A STRING DA PLACA
         var teste_tamanho = teste.length; // DESCOBRI O TAMANHO
         //console.log($scope.veiculo);
         //console.log(teste_tamanho);  // FAÇO O TESTE DE APROVAÇÃO DE ENVIO
         if ($scope.pesagem.peso_liquido != null && teste_tamanho == 8) {
             $scope.pesagem.status = 2;
         } else {
             $scope.pesagem.status = null;
         }
     }

     // aqui faz com que o resultado das pesagem
     // aponte peso liquido positivo se o desconto não for
     // maior que o peso liquido
     $scope.modulo = function() {
        console.log("pesagemSaidaController :modulo");
       // console.log("pesagem.peso_2",[$scope.pesagem.peso_2]);
       // console.log("pesagem.peso_2", $scope.pesagem.peso_2);
        // por problemas com sincronismos deve se testar antes

        if ($.isNumeric($scope.pesagem.peso_2) == true && $scope.pesagem.status == 1) {

          //  document.querySelector("[name='liquido']").value = data;
                 $scope.$apply(function() {
                     $scope.pesagem.peso_liquido = ($scope.pesagem.peso_1 - $scope.pesagem.peso_2);

                     if ($scope.pesagem.peso_liquido < 0) {
                         $scope.pesagem.peso_liquido = ($scope.pesagem.peso_liquido * -1);
                     }
                     if ($scope.pesagem.peso_descontos > 0) {
                         $scope.pesagem.peso_liquido_final = ($scope.pesagem.peso_liquido - $scope.pesagem.peso_descontos);
                     }
                      $scope.pesagem.peso_liquido_final = ($scope.pesagem.peso_liquido - $scope.pesagem.peso_descontos);
 
                 });



          //  $scope.pesagem.peso_liquido = ($scope.pesagem.peso_1 - $scope.pesagem.peso_2);
        } else{
            console.log("deu ruim na coleta tentar de novo");
            $scope.capturar_peso();


        }

         
         return $scope.pesagem.peso_liquido;
     }

     $scope.isEmpty = function(obj) {
        console.log("pesagemSaidaController :isEmpty");
         for (var prop in obj) {
             if (obj.hasOwnProperty(prop))
                 return false;
         }
         return true;
     }

     $scope.data = [" "];
     // variável que é responsável pelo gerenciamento do compoenent auto complete
 }

 ///////
 angular
     .module('home')
     .controller('pesagemSaidaController', pesagemSaidaController);
 /////
///// teste auto complete nome desconto pagina principal

// AUTO COMPLETE DESCONTO
 
 function pesagemSaidaDescontoController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {
     //VERSÃO NOVA
     var self = this;
     self.simulateQuery = false;
     self.isDisabled = false;
     self.repos = loadAll('');
     self.querySearch = querySearch;
     self.selectedItemChange = selectedItemChange;
     self.searchTextChange = searchTextChange;

     function querySearch(query) {
        console.log("pesagemSaidaDescontoController :querySearch");
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
        console.log("pesagemSaidaDescontoController :searchTextChange");
         $log.info('pesquisando por: ' + text);
        
             
         loadAll(text);

     }

     function selectedItemChange(item) {
        console.log("pesagemSaidaDescontoController :selectedItemChange");
          // aqui tenho que colocar na logica do linha
           if (!item) {
            console.log(item);
                     console.log("SELECIONADO e depois apagado");
                     Materialize.toast('ITEM SELECIONADO APAGADO', 1000, 'rounded', 'center');
                     Materialize.toast();
                     $scope.desconto.id_desconto = null;
                     $scope.selected = null;
                     
                 }else{

                    $scope.desconto.id_desconto = item.id_desconto;
                    $scope.desconto.nomedesconto = item.nome;
                    $scope.selected = item;
                 
                 }
                  
     }


     function loadAll(text) {
        console.log("pesagemSaidaDescontoController :loadAll");
         var repos = [{
             'nome': 'AngularJS',
             'url': 'https://github.com/angular/angular.js',
             'watchers': '3,623',
             'forks': '16,175'
         }];
         console.log(text);
         // TRATAMENTO SE SELECIONAR E DEPOIS APAGAR A SELEÇÃO DEVE APAGAR DO
         // OBJETO O QUE FOI SELECIONADO
        

         var request = $http({
             method: "post",
             url: "php/desconto/manualpesquisanomedesconto.php",
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
          console.log("pesagemSaidaDescontoController :createFilterFor");
         var lowercaseQuery = angular.lowercase(query);
         return function filterFn(item) {

             return (item.value.indexOf(lowercaseQuery) === 0);
         };
     }

 }
 angular
     .module('home')
     .controller('pesagemSaidaDescontoController', pesagemSaidaDescontoController);

/// FIMM DESCONTO NA PESAGEM SAIDA




//// fim desconto pagina principal







 //////////////////////////////////////////////////////////////////////////////////

 // inicio controller pesagemManualClienteController
 function pesagemSaidaClienteController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {
     var self = this;
     self.simulateQuery = false;
     self.isDisabled = false;
     self.repos = loadAll('');
     self.querySearch = querySearch;
     self.selectedItemChange = selectedItemChange;
     self.searchTextChange = searchTextChange;

     function querySearch(query) {
        console.log("pesagemSaidaClienteController :querySearch");

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
         console.log("pesagemSaidaClienteController :searchTextChange");

         $log.info('pesquisando por: ' + text);
         loadAll(text);
     }

     function selectedItemChange(item) {
        console.log("pesagemSaidaClienteController :selectedItemChange");
         // $log.info('Item changed to stenio' + JSON.stringify(item));
         $scope.pesagem.cliente_id_cliente = item.id_cliente;
         $scope.selected = item;
         console.log($scope.selected);
     }

     function loadAll(text) {
         console.log("pesagemSaidaClienteController :loadAll");
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
        console.log("pesagemSaidaClienteController :createFilterFor");
         var lowercaseQuery = angular.lowercase(query);
         return function filterFn(item) {
             return (item.value.indexOf(lowercaseQuery) === 0);
         };
     }
 }
 angular
     .module('home')
     .controller('pesagemSaidaClienteController', pesagemSaidaClienteController);
 // fim controller pesagemManualClienteController
 // inicio controler 
 // falta criar as rotinas para pesquisa de fornecedor
 function pesagemSaidaFornecedorController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {
     // NOVA VERSÃO DA ROTINA DE PESQUISA
     var self = this;
     self.simulateQuery = false;
     self.isDisabled = false;
     self.repos = loadAll('');
     self.querySearch = querySearch;
     self.selectedItemChange = selectedItemChange;
     self.searchTextChange = searchTextChange;

     function querySearch(query) {
         console.log("pesagemSaidaFornecedorController :querySearch");
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
        console.log("pesagemSaidaFornecedorController :searchTextChange");
         $log.info('pesquisando por: ' + text);
         loadAll(text);
     }

     function selectedItemChange(item) {
         console.log("pesagemSaidaFornecedorController :selectedItemChange");
         // $log.info('Item changed to stenio' + JSON.stringify(item));
         $scope.pesagem.fornecedor_id_fornecedor = item.id_fornecedor;
         $scope.selected = item;
         console.log($scope.selected);
     }

     function loadAll(text) {
        console.log("pesagemSaidaFornecedorController :loadAll");
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
        console.log("pesagemSaidaFornecedorController :createFilterFor");
         var lowercaseQuery = angular.lowercase(query);
         return function filterFn(item) {
             return (item.value.indexOf(lowercaseQuery) === 0);
         };
     }
     //FIM NOVA VERSÃO DA ROTINA DE PESQUISA
 }
 angular
     .module('home')
     .controller('pesagemSaidaFornecedorController', pesagemSaidaFornecedorController);

 function pesagemSaidaProdutoController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {
     //VERSÃO NOVA
     var self = this;
     self.simulateQuery = false;
     self.isDisabled = false;
     self.repos = loadAll('');
     self.querySearch = querySearch;
     self.selectedItemChange = selectedItemChange;
     self.searchTextChange = searchTextChange;

     function querySearch(query) {
        console.log("pesagemSaidaProdutoController :querySearch");
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
        console.log("pesagemSaidaProdutoController :searchTextChange");
         $log.info('pesquisando por: ' + text);
         loadAll(text);
     }

     function selectedItemChange(item) {
        console.log("pesagemSaidaProdutoController :selectedItemChange");
         // $log.info('Item changed to stenio' + JSON.stringify(item));
         $scope.pesagem.produto_id_produto = item.id_produto;
         $scope.selected = item;
         console.log($scope.selected);
     }

     function loadAll(text) {
        console.log("pesagemSaidaProdutoController :loadAll");
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
          console.log("pesagemSaidaProdutoController :createFilterFor");
         var lowercaseQuery = angular.lowercase(query);
         return function filterFn(item) {
             return (item.value.indexOf(lowercaseQuery) === 0);
         };
     }

 }
 angular
     .module('home')
     .controller('pesagemSaidaProdutoController', pesagemSaidaProdutoController);

 //inicio desenvolvimento controler veiculos na pesagem manual
 function pesagemSaidaVeiculoController($scope, $http, $cookieStore, $mdDialog, $q, $timeout, meuServico, $log) {

     var self = this;
     self.simulateQuery = false;
     self.isDisabled = false;
     self.repos = loadAll('');
     self.querySearch = querySearch;
     self.selectedItemChange = selectedItemChange;
     self.searchTextChange = searchTextChange;

     function querySearch(query) {
        console.log("pesagemSaidaVeiculoController :querySearch");
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
        console.log("pesagemSaidaVeiculoController :searchTextChange");
         $log.info('pesquisando por: ' + text);
         loadAll(text);
     }

function regraPesagemSaida(item) {
    
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
        var id_pesagem_entrada = [];
        var cont_pesagem_entrada = 0;
        var id_pesagem_saida = [];
        var cont_pesagem_saida = 0;
        var cont_pesagem_manual = 0;
        var cont_pesagem_avulsa = 0;
        console.log(response.data);
        for (var i in response.data) {
            //arr.push(response.data[i].status);  
            if (response.data[i].status === "PESAGEM ENTRADA") {
                cont_pesagem_entrada = cont_pesagem_entrada + 1;
                id_pesagem_entrada = response.data[i].id_pesagem; // separando as pesagens de entrada
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
        console.log("id Pesagem");
        console.log(id_pesagem_entrada);
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
            console.log("NÃO EXISTE Pesagem em aberto");
            Materialize.toast('VEÍCULO INFORMADO NÃO ENCONTRA-SE DENTRO DO PÁTIO!', 2000, 'rounded', 'center');
            Materialize.toast();
            $scope.pesagem.veiculo_id_veiculo = null;
            $scope.pesagem.placa = null;
            $scope.pesagem.tipo_veiculo = null;
            $scope.selected = null;
        } else {
            if (cont_pesagem_entrada >= cont_pesagem_saida) {
            console.log("permitido pesagem de SAIDA");
            console.log("Pesagem de entrada em aberto");
            console.log("entrada");
            console.log(cont_pesagem_entrada);
            console.log("ultimo id pesagem entrada");
            console.log(id_pesagem_entrada);
            $scope.pesagem.id_pesagem_entrada= id_pesagem_entrada;
            // aqui depois de saber qual foi a ultima pesagem de entrada
            // envio esse id para saber os dados da pesagem de entrada
            

            var request = $http({
        method: "post",
        url: "php/pesagem/consultaplacapesagemsaida.php",
        data: $scope.pesagem,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    });
    console.log($scope.pesagem);
    request.then(function(response) {
        console.log("resposta da consulta da ultima pesagem de entrada");
          console.log(response.data);
        // aqui transfiro esses dados da ultima pesagem de entrada para
        // o objeto pesagem na pagina pesagem de saida
         $scope.pesagem.cliente = response.data[0].cliente;
         $scope.pesagem.cliente_id_cliente = response.data[0].cliente_id_cliente;
         $scope.pesagem.produto = response.data[0].produto;
          $scope.pesagem.produto_id_produto = response.data[0].produto_id_produto;
         $scope.pesagem.cpf_cnpj_cliente = response.data[0].cpf_cnpj_cliente;
         $scope.pesagem.cpf_cnpj_fornecedor = response.data[0].cpf_cnpj_fornecedor;
         $scope.pesagem.data_entrada = response.data[0].data;
         $scope.pesagem.fornecedor = response.data[0].fornecedor;
         $scope.pesagem.fornecedor_id_fornecedor = response.data[0].fornecedor_id_fornecedor;
         $scope.pesagem.id_pesagem_entrada = response.data[0].id_pesagem;
         $scope.pesagem.peso_1 = response.data[0].peso_1;
         // ENQUANTO NAO APLICA FUNÇÃO DESCONTOS
         $scope.pesagem.peso_descontos = 0;
          


         
    }, function(response) {
        console.log("ERROR" + response);
    });
        } 
            




        }
        //$scope.pesagem.tipo_pesagem = response.data[0].status;
        //console.log($scope.pesagem.tipo_pesagem);
    }, function(response) {
        console.log("ERROR" + response);
    });
    // fim teste 
}



     function selectedItemChange(item) {
        console.log("pesagemSaidaVeiculoController :selectedItemChange");

        if(item!=null){
         console.log(item.id_veiculo);
         //console.log($scope.pesagem);
         // $log.info('Item changed to stenio' + JSON.stringify(item));
         $scope.pesagem.veiculo_id_veiculo = item.id_veiculo;
         $scope.pesagem.placa = item.placa;
         $scope.pesagem.tipo_veiculo = item.tipo;
         $scope.selected = item;
         // regra de pesagem de saida
         // deve pegar a pesagem de entrada mais recente

         regraPesagemSaida(item);




         console.log($scope.selected);
     }
     }

     function loadAll(text) {
          console.log("pesagemSaidaVeiculoController :loadAll");
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
                 console.log("era pra rodar aqui");
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
        console.log("pesagemSaidaVeiculoController :createFilterFor");
         var lowercaseQuery = angular.lowercase(query);
         return function filterFn(item) {
             return (item.value.indexOf(lowercaseQuery) === 0);
         };
     }

 }
 angular
     .module('home')
     .controller('pesagemSaidaVeiculoController', pesagemSaidaVeiculoController);