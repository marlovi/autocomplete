function deleteClienteController($scope, $http, $cookieStore, focus, $timeout, meuServico) {

    $scope.deletar = function() {

        // cria um vetor vazio para armazenar o cliente e veiculos.
        var listaClienteVeiculo = [];
        listaClienteVeiculo.push($scope.cliente);
        listaClienteVeiculo.push($scope.lines);
       // console.log("o cliente ");
       // console.log($scope.cliente);
       // console.log("os veiculos ");
      //  console.log($scope.lines);
        // ALTERADO url: "php/cliente/deletarcliente.php",
        // PARA TESTAR COMO PEGA OS DADOS 
        var request = $http({
            method: "post",
            url: "php/cliente/deletarclienteplaca.php",
            data: listaClienteVeiculo,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });

        request.then(function(response) {
            var $resposta = response.data;
            var $lista_pesagem = [];
           //console.log( response.data);
 
            $scope.cliente = null;
            $scope.lines = [];
            if ($resposta.status === true) {
                //alert('Cliente Deletado com Sucesso!');
                $scope.cliente = null;
                $scope.lines = [];
                    meuServico.mostrar('Alteração','Registro alterado com Sucesso!!!');
                //Mandar para outra página.
                clickOnUpload();

            }

            if ($resposta.status === false) {
               // console.log($resposta);
               // console.log($resposta.status_pesagem);
               // console.log($resposta.status_pesagem.length);
                 
                

                

                 for (var i = 0; i < $resposta.status_pesagem.length; i++) {
                      //  console.log ("id pesagem posição " + i);
                       $lista_pesagem.push( $resposta.status_pesagem[i]);
                 }
                 //console.log($lista_pesagem);



                //console.log($resposta);
                //alert('Cliente Deletado com Sucesso!');
                $scope.cliente = null;
                $scope.lines = [];
  meuServico.mostrar('Alteração ','REGISTRO ASSOCIADO A PESAGEM: \n  \'' + $lista_pesagem.join(" \'") +' \' \n , IMPOSSIVEL APAGAR!!!');
//  meuServico.mostrar('Alteração ','REGISTRO ASSOCIADO A PESAGEM: , IMPOSSIVEL APAGAR!!!');
                //Mandar para outra página.
                clickOnUpload();

            }

        }, function(response) {
            console.log("ERROR" + response);
        });


    }


    $scope.doSomething = function() {
        // do something awesome
        focus('nome');
        focus("cpf");
        focus("cnpj");
        focus("endereco");
        focus("cidade");
        focus("estado");
        focus("telefone");
        focus("email");

    };

    var request = $http({
        method: "post",
        url: "php/cliente/pesquisarclienteid.php",
        data: $cookieStore.get('deletecliente'),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    });

    /* Successful HTTP post request or not */
    request.then(function(response) {
        //console.log(response.data[0]);

        $timeout(function() {
            $scope.$apply(function() {
                $scope.buscarVeiculos();
                $scope.lines = [];
                $scope.cliente = response.data[0];
                $scope.doSomething();


            });
        }, 0);
        // console.log(response.data[0].nome);

    }, function(response) {
        console.log("ERROR" + response);
    });
    $scope.teste = function() {
        console.log($cookieStore.get('deletecliente'));
    }


    // DEVE SER EDITADA!!!
    $scope.salvarVeiculo = function() {

        // $scope.cont =  $scope.cont+1;
        $scope.cont = $scope.veiculo;
        $scope.lines.push($scope.cont);
       // console.log($scope.lines);
        $scope.veiculo = null;


    }

   




    $scope.buscarVeiculos = function() {
        var request = $http({
            method: "post",
            url: "php/veiculo/pesquisarveiculoporidcliente.php",
            data: $cookieStore.get('deletecliente'),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });

        /* Successful HTTP post request or not */
        request.then(function(response) {
         console.log("retornou do banco " + response.data.status_veiculo);
            if (response.data.status_veiculo === 0) {
                $scope.lines = [];
            } else $scope.lines = response.data;
            //console.log()
            console.log(Object.keys($scope.lines).length);
            var log = [];
            angular.forEach(response.data, function(value, key) {
                this.push(value);
            }, log);
            //  console.log(log);


        }, function(response) {
            console.log("ERROR" + response);
        });
    }






    function clickOnUpload() {
        $timeout(function() {
            angular.element('#voltar').triggerHandler('click');
        });
    };

    // Using Angular Extend
    angular.extend($scope, {
        clickOnUpload: clickOnUpload
    });

    // OR Using scope directly
    $scope.clickOnUpload = clickOnUpload;


}






angular
    .module('home')
    .factory('focus', function($timeout, $window) {
        return function(id) {
            // timeout makes sure that is invoked after any other event has been triggered.
            // e.g. click events that need to run before the focus or
            // inputs elements that are in a disabled state but are enabled when those events
            // are triggered.
            $timeout(function() {
                var element = $window.document.getElementById(id);
                if (element)
                    element.focus();
            });
        };
    })

.directive('eventFocus', function(focus) {
        return function(scope, elem, attr) {
            elem.on(attr.eventFocus, function() {
                focus(attr.eventFocusId);
            });

            // Removes bound events in the element itself
            // when the scope is destroyed
            scope.$on('$destroy', function() {
                element.off(attr.eventFocus);
            });
        };
    })
    .controller('deleteClienteController', deleteClienteController);