    function pesquisaPesagemController($scope, $http, $compile, $injector, $cookieStore) {

       $scope.pesquisarpesagem = function() {
        console.log($scope.pesquisa);
          console.log("pesquisaPesagemController :pesquisarpesagem");
           var request = $http({
               method: "post",
               url: "php/pesagem/pesquisarpesagem.php",
               data: $scope.pesquisa,
               headers: {
                   'Content-Type': 'application/x-www-form-urlencoded'
               }
           });
           /* Successful HTTP post request or not */
           request.then(function(response) {
               console.log(response.data);
               $scope.Cliente = response.data;
               angular.forEach(response.data, function(value, key) {
                   //   $scope.myText = $scope.myText + $scope.gerarcartao(value);
                   console.log($scope.myText);
               });
           }, function(response) {
               console.log("ERROR" + response);
           });
       }


}
   angular
       .module('home')
       .controller('pesquisaPesagemController', pesquisaPesagemController);