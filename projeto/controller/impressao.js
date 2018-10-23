  function impressaoController($scope, $http, $log, $cookieStore, $mdDialog, $q, $timeout, meuServico, $cookies) {
/// ADICIONANDO DESCONTO NA PESAGEM SAIDA
        // $scope.lines = [];
        //  $scope.cont = 1;

     $scope.init = function() {
      
        console.log("impressaoController :init");
         var obj_impressao = $cookies.getObject('impressao');
         var obj_impressaoDescontos = $cookies.getObject('impressaoDescontos');

          console.log($cookies);
         // console.log($scope.pesagem);
            $scope.lines = obj_impressaoDescontos;
            console.log($scope.lines);
         $scope.pesagem.data = obj_impressao.data;
         $scope.pesagem.placa = obj_impressao.placa;
         $scope.pesagem.data_entrada = obj_impressao.data_entrada;
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
         $scope.pesagem.observacao = obj_impressao.observacao;
     }

     $scope.printDiv = function() {

        console.log("impressaoController :printDiv");

         //console.log($scope.pesagem);
         // função que abre pop up para impressão.
         var divName = "printable";
         var printContents = document.getElementById(divName).innerHTML;
         var popupWin = window.open('', '_blank', "width=" + screen.availWidth + ",height=" + screen.availHeight);
         popupWin.document.open();
         popupWin.document.write('<html><head> <title>SPA  - Versão 2018 1.12</title>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
         popupWin.document.close();
         $cookies.remove('impressao');
     }

     $scope.printDiv_entrada = function() {
        console.log("impressaoController :printDiv_entrada");
         //console.log($scope.pesagem);
         // função que abre pop up para impressão.
         var divName = "printable_entrada";
         var printContents = document.getElementById(divName).innerHTML;
         var popupWin = window.open('', '_blank', "width=" + screen.availWidth + ",height=" + screen.availHeight);
         popupWin.document.open();
         popupWin.document.write('<html><head><title>SPA  - Versão 2018 1.12</title>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
         popupWin.document.close();
         $cookies.remove('impressao')
     }
     $scope.printDiv_avulsa = function() {
        console.log("impressaoController :printDiv_avulsa");
         //console.log($scope.pesagem);
         // função que abre pop up para impressão.
         var divName = "printable_avulsa";
         var printContents = document.getElementById(divName).innerHTML;
         var popupWin = window.open('', '_blank', "width=" + screen.availWidth + ",height=" + screen.availHeight);
         popupWin.document.open();
         popupWin.document.write('<html><head><title>SPA  - Versão 2018 1.12</title>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
         popupWin.document.close();
         $cookies.remove('impressao')
     }

     $scope.printDiv_saida = function() {
        console.log("impressaoController :printDiv_saida");
        // na pesagem de saida tem esse item a mais '' data de entrada' 

         console.log($scope.pesagem);
         console.log($scope.lines);
         console.log($scope.linha);

         // função que abre pop up para impressão.
         var divName = "printable_saida";
         var printContents = document.getElementById(divName).innerHTML;
         var popupWin = window.open('', '_blank', "width=" + screen.availWidth + ",height=" + screen.availHeight);
         popupWin.document.open();
         popupWin.document.write('<html><head><title>SPA  - Versão 2018 1.12</title>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
         popupWin.document.close();
         $cookies.remove('impressao')
     }

      $scope.printDiv_relatorio = function() {
        console.log("impressaoController :printDiv_relatorio");
        // na pesagem de saida tem esse item a mais '' data de entrada' 
         
          
         console.log($scope.pesagem);
         // função que abre pop up para impressão.
         var divName = "printable_saida";
         var printContents = document.getElementById(divName).innerHTML;
         var popupWin = window.open('', '_blank', "width=" + screen.availWidth + ",height=" + screen.availHeight);
         popupWin.document.open();
         popupWin.document.write('<html><head><title>SPA  - Versão 2018 1.12</title>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
         popupWin.document.close();
         $cookies.remove('impressao')
     }






 }

 angular
     .module('home')
     .controller('impressaoController', impressaoController);