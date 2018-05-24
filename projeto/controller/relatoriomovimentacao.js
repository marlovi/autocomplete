    function relatoriomovimentacaoController($scope, $http, $log, $mdDialog,  $compile, $injector, $cookieStore, $cookies) {
    // ESSA FUNCAO IMPRESSAO DEVERIA ESTAR NO CONTROLE DE IMPRESSAO
    $scope.printDiv_relatorio = function() {
        console.log("impressaoController :printDiv_relatorio");
        // na pesagem de saida tem esse item a mais '' data de entrada' 
        // função que abre pop up para impressão.
        var divName = "divdinamica";
        var printContents = document.getElementById(divName).innerHTML;
        var popupWin = window.open('', '_blank', "width=" + screen.availWidth + ",height=" + screen.availHeight);
        popupWin.document.open();
        popupWin.document.write('<html><head><title>SPA  - Versão 2018 1.19</title>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> </head> <style type="text/css" media="print"> body { **zoom:75%;}  </style><body onload="window.print()">  ' + printContents + ' </body></html>');
        popupWin.document.close();
        $cookies.remove('impressao')
    }
    // RETIRAR ESSA FUNCAO DESSE ARQUIVO PASSAR PARA IMPRESASO
    $scope.gerarTituloTabela = function() {
         console.log("relatorioincompletasController :gerarTituloTabela");
         var $newDiv = $(' <h6 class="center-align"> Relatórios Totais no Período: INICIO: {{movimentacao.data_1}} ATÉ {{movimentacao.data_2}} </h6>' +
             ' <h6 class="center-align">------------------------------------------------------------------------------------------------------------------------------------------------------------------</h6>');
         $injector.invoke(function($compile) {
             var div = $compile($newDiv);
             var content = div($scope);
             $("#divdinamica").append(content);
         });
    }
     $scope.gerarCorpoTabelamovimentacao = function(consulta) {
        // gera o corpo tabela dependendo do tipo de pesagem
        if (consulta.status === "SAIDA" || consulta.status === "ENTRADA") {
            var $newDiv = $('<table style="font-family:Times New Roman; font-size: 95%" class="highlight-table flow-text">' +
                '<thead>' +
                '<tr>' +
                '<th style="font-style: italic;">Produto:</th>' +
                '<th>' + consulta.produto + '</th>' +
                '</tr>' +
                '</thead>' +
                '<thead>' +
                '<tr>' +
                '<th style="font-style: italic;">Total de Entrada em kg: </th>' +
                '<th>' + $scope.resultado_peso_1 + '</th>' +
                '</tr>' +
                '</thead>' +
                '<thead>' +
                '<tr>' +
                '<th style="font-style: italic;">Total de Saída em kg: </th>' +
                '<th>' + $scope.resultado_peso_2 + '</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '<tr>' +
                '<td>Total Liquido kg: </td>' +
                '<td>' + $scope.resultado_liquido + '</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>' +
                ' <h6 class="center-align">------------------------------------------------------------------------------------------------------------------------------------------------------------------</h6>');
            $injector.invoke(function($compile) {
                var div = $compile($newDiv);
                var content = div($scope);
                $("#divdinamica").append(content);
            });
        }
    }
    // VARIAVEIS GLOBAIS
    $scope.resultado_peso_1 = 0; // soma dos pesos de entrada do produto
    $scope.resultado_peso_2 = 0; // soma dos pesos de saida do produto
    $scope.resultado_liquido = 0;
    $scope.id_produto_anterior = 0; // id do produto
    $scope.id_produto_anterior_entrada = 0; // id do produto
    $scope.nome_produto_anterior = [];
    $scope.corpo_tabela_saida = [];
    $scope.corpo_tabela_entrada = [];

    $scope.relatoriomovimentacao = function() {
        $scope.teste = 0; // VARIAIVEL USADA PARA INFORMAR SE ERA A PRIMEIRA ITERACAO
        console.log($scope.movimentacao);
        console.log("relatoriomovimentacaoController :relatoriomovimentacao");
        $('#divdinamica').empty();
        var request = $http({
            method: "post",
            url: "php/pesagem/pesquisarpesagem.php",
            data: $scope.movimentacao,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });
        request.then(function(response) {
            console.log(response.data);
            $scope.myText = "";
            var filhoScope = $scope.$new();
            $scope.consulta = response.data;
            //console.log($scope.consulta);
            //console.log($scope.consulta[0]);
            $scope.consulta.resultado = Object.getOwnPropertyNames(response.data).length - 1;
            if ($scope.consulta.resultado == 0) {
                console.log(" if sem resposta");
                var $newDiv = $("<div class='row'>" +
                    "<div class='col s9 '>" +
                    "<div class='card blue-grey darken-1'>" +
                    "<div class='card-content white-text'>" +
                    "<span class='card-title'> " + 'SEM REGISTRO' + " </span>" +
                    "<div class='card-content' id='teste' ng-show='mostrar'>" +
                    "<p> </p>" +
                    "</div>" +
                    "<div class='card-action'>" +
                    "</div>" +
                    " </div>" +
                    " </div>" +
                    "</div>" +
                    "</div>");
                $('#divdinamica').empty();
                $injector.invoke(function($compile) {
                    var div = $compile($newDiv);
                    var content = div($scope);
                    $("#divdinamica").append(content);
                });
            } else {
                $('#divdinamica').empty(); // ISSO LIMPA A DIV DINAMICA
                if ($scope.teste === 0) {
                    $scope.myText = $scope.gerarTituloTabela();
                }

                angular.forEach(response.data, function(value, key) {
                    // inicia o teste se entrada ou saida  e FAZ A lista produtos
                    if (response.data[key].status === "SAIDA" || response.data[key].status === "ENTRADA") {
                        // se primeira iteracao armazeno id produto  
                        if ($scope.id_produto_anterior == 0) { // considerando primeira iteracao
                            $scope.id_produto_anterior = response.data[key].produto_id_produto // pego o id para teste
                            $scope.nome_produto_anterior.push($scope.id_produto_anterior);
                        }
                        // se id produto diferente do anterior
                        if ($scope.id_produto_anterior !== response.data[key].produto_id_produto) {
                            $scope.id_produto_anterior = response.data[key].produto_id_produto
                            $scope.nome_produto_anterior.push($scope.id_produto_anterior);
                        }
                    }
                });
                // console.log( $scope.nome_produto_anterior);
                // percorrer a lista de produtos  e testar cada elemento da lista de produtos na lista de pesagem
                angular.forEach($scope.nome_produto_anterior, function(value, key1) {
                    // console.log($scope.nome_produto_anterior[key1]);
                    angular.forEach(response.data, function(value, key) {
                        if (response.data[key].status === "ENTRADA" && response.data[key].produto_id_produto === $scope.nome_produto_anterior[key1]) {
                            $scope.resultado_peso_1 = $scope.resultado_peso_1 + parseInt(response.data[key].peso_1);
                            $scope.corpo_tabela_entrada = (value);
                        }
                        if (response.data[key].status === "SAIDA" && response.data[key].produto_id_produto === $scope.nome_produto_anterior[key1]) {
                            $scope.resultado_peso_2 = $scope.resultado_peso_2 + parseInt(response.data[key].peso_2);
                            $scope.corpo_tabela_entrada = (value);
                        }
                    });
                    $scope.resultado_liquido = $scope.resultado_peso_1 - $scope.resultado_peso_2;
                    $scope.myText = $scope.myText + $scope.gerarCorpoTabelamovimentacao($scope.corpo_tabela_entrada);
                });
            }
        }, function(response) {
            console.log("ERROR" + response);
        });
    }// fim relatorio incompletas
}
   angular
       .module('home')
       .controller('relatoriomovimentacaoController', relatoriomovimentacaoController);