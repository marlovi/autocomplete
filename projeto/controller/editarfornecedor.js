function editarFornecedorController($scope, $http, $cookieStore, focus, $timeout, meuServico) {

    $scope.editar = function() {

        // cria um vetor vazio para armazenar o cliente e veiculos.
        var listaFornecedorVeiculo = [];
        listaFornecedorVeiculo.push($scope.fornecedor);
        listaFornecedorVeiculo.push($scope.lines);
        console.log(listaFornecedorVeiculo);

        var request = $http({
            method: "post",
            url: "php/fornecedor/editarfornecedor.php",
            data: listaFornecedorVeiculo,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });

        request.then(function(response) {
            var $resposta = response.data;
            console.log($resposta);
            $scope.fornecedor = null;
            $scope.lines = [];
            if ($resposta.status === true) {
                //alert('Fornecedor  Atualizado com sucesso!');

                meuServico.mostrar('Alteração','Registro alterado com Sucesso!!!');
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
        url: "php/fornecedor/pesquisarfornecedorid.php",
        data: $cookieStore.get('editarfornecedor'),
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
                $scope.fornecedor = response.data[0];
                $scope.doSomething();


            });
        }, 0);
        // console.log(response.data[0].nome);

    }, function(response) {
        console.log("ERROR" + response);
    });
    $scope.teste = function() {
        console.log($cookieStore.get('editarfornecedor'));
    }













    // DEVE SER EDITADA!!!
    $scope.salvarVeiculo = function() {

        // $scope.cont =  $scope.cont+1;
        $scope.cont = $scope.veiculo;

        // console.log(Object.keys($scope.lines).length);
        $scope.lines.push($scope.cont)

        // $scope.lines.push($scope.cont);
        //  console.log($scope.lines);
        $scope.veiculo = null;


    }



    $scope.buscarVeiculos = function() {
        var request = $http({
            method: "post",
            url: "php/veiculo/pesquisarveiculoporidfornecedor.php",
            data: $cookieStore.get('editarfornecedor'),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });

        /* Successful HTTP post request or not */
        request.then(function(response) {
            if (response.data === 'null') {
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
    .controller('editarFornecedorController', editarFornecedorController);