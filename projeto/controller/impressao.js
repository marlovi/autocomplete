function impressaoController($scope, $http, $log, $cookieStore, $mdDialog, $q, $timeout, meuServico,$cookies) {
    


    $scope.init = function(){
      //  console.log("aqui funcao")
      // console.log( $cookies.impressao);

       var obj_impressao = $cookies.getObject('impressao')
      // console.log(obj_impressao);
       $scope.pesagem.data = obj_impressao.data;
      $scope.pesagem.placa = obj_impressao.placa;
      $scope.pesagem.cliente = obj_impressao.cliente;
      $scope.pesagem.cpf_cnpj_cliente = obj_impressao.cpf_cnpj_cliente;

      $scope.pesagem.id_pesagem = obj_impressao.id_pesagem;
      $scope.pesagem.motorista = obj_impressao.motorista;
      $scope.pesagem.fornecedor = obj_impressao.fornecedor;
      $scope.pesagem.cpf_cnpj_fornecedor = obj_impressao.cpf_cnpj_fornecedor;

      $scope.pesagem.produto = obj_impressao.produto;
      $scope.pesagem.cod_prod = obj_impressao.cod_prod;

      $scope.pesagem.status = obj_impressao.status;
      $scope.pesagem.peso_1 = obj_impressao.peso_1;
      $scope.pesagem.peso_descontos = obj_impressao.peso_descontos;
      $scope.pesagem.peso_2 = obj_impressao.peso_2;
      $scope.pesagem.peso_liquido = obj_impressao.peso_liquido;


        

       
    }

$scope.printDiv = function() {


     var divName = "printable";
  var printContents = document.getElementById(divName).innerHTML;
  var popupWin = window.open('', '_blank', "width="+screen.availWidth+",height="+screen.availHeight);
  popupWin.document.open();

  // popupWin.document.write('<html><head>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">' + printContents + '</body></html>');
  popupWin.document.write('<html><head>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
  popupWin.document.close();

  // remover o 
  //remove($cookies.impressao);
  $cookies.remove('impressao')
} 
/// fim





}
angular
    .module('home')
    .controller('impressaoController', impressaoController);



    // fim do controler veiculos