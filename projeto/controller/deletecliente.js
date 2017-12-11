function deleteClienteController($scope, $http, $cookieStore, focus, $timeout, meuServico) {

    $scope.deletar = function() {
        var listaClienteVeiculo = [];
        listaClienteVeiculo.push($scope.cliente);
        listaClienteVeiculo.push($scope.lines);
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
            $scope.cliente = null;
            $scope.lines = [];
            if ($resposta.status === true) {
                $scope.cliente = null;
                $scope.lines = [];
                    meuServico.mostrar('Alteração','Registro alterado com Sucesso!!!');
                clickOnUpload();
            }

            if ($resposta.status === false) {
                 for (var i = 0; i < $resposta.status_pesagem.length; i++) {
                       $lista_pesagem.push( $resposta.status_pesagem[i]);
                 }
                $scope.cliente = null;
                $scope.lines = [];
  meuServico.mostrar('Alteração ','REGISTRO ASSOCIADO A PESAGEM: \n  \'' + $lista_pesagem.join(" \'") +' \' \n , IMPOSSIVEL APAGAR!!!');
                clickOnUpload();
            }
        }, function(response) {
            console.log("ERROR" + response);
        });
    }

    $scope.doSomething = function() {
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
    request.then(function(response) {
        $timeout(function() {
            $scope.$apply(function() {
                $scope.buscarVeiculos();
                $scope.lines = [];
                $scope.cliente = response.data[0];
                $scope.doSomething();
            });
        }, 0);
    }, function(response) {
        console.log("ERROR" + response);
    });

    $scope.teste = function() {
        console.log($cookieStore.get('deletecliente'));
    }

    $scope.salvarVeiculo = function() {
        $scope.cont = $scope.veiculo;
        $scope.lines.push($scope.cont);
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
        request.then(function(response) {
      //   console.log("retornou do banco " + response.data.status_veiculo);
            if (response.data.status_veiculo === 0) {
                $scope.lines = [];
            } else $scope.lines = response.data;
            console.log(Object.keys($scope.lines).length);
            var log = [];
            angular.forEach(response.data, function(value, key) {
                this.push(value);
            }, log);
        }, function(response) {
            console.log("ERROR" + response);
        });
    }
    
    function clickOnUpload() {
        $timeout(function() {
            angular.element('#voltar').triggerHandler('click');
        });
    };
    angular.extend($scope, {
        clickOnUpload: clickOnUpload
    });
    $scope.clickOnUpload = clickOnUpload;
}
angular
    .module('home')
    .factory('focus', function($timeout, $window) {
        return function(id) {
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

            scope.$on('$destroy', function() {
                element.off(attr.eventFocus);
            });
        };
    })
    .controller('deleteClienteController', deleteClienteController);