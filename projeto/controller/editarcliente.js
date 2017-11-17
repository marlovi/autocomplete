function editarClienteController($scope, $http, $cookieStore, focus, $timeout, $mdDialog, meuServico) {

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

    $scope.editar = function() {

        // cria um vetor vazio para armazenar o cliente e veiculos.
        var listaClienteVeiculo = [];
        listaClienteVeiculo.push($scope.cliente);
        listaClienteVeiculo.push($scope.lines);
        console.log(listaClienteVeiculo);
         
        var request = $http({
            method: "post",
            url: "php/cliente/editarcliente.php",
            data: listaClienteVeiculo,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });

        request.then(function(response) {
            var $resposta = response.data;
            console.log($resposta);
            $scope.cliente = null;
            $scope.lines = [];
            if ($resposta.status === true) {
               // alert('Cliente  Atualizado com sucesso!');

               //alertNovo();
            //   miniDialog('Alteração','Realizada com Sucesso !!','ok');
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
        url: "php/cliente/pesquisarclienteid.php",
        data: $cookieStore.get('editarcliente'),
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
        console.log($cookieStore.get('editarcliente'));
    }

   
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
 



    $scope.buscarVeiculos = function() {
        var request = $http({
            method: "post",
            url: "php/veiculo/pesquisarveiculoporidcliente.php",
            data: $cookieStore.get('editarcliente'),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });

        /* Successful HTTP post request or not */
        request.then(function(response) {
            // resolver o erro quando nao tem placa no registro cliente

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
    .controller('editarClienteController', editarClienteController);