function homeController($scope) {

}
angular
    .module('home')
    .controller('homeController', homeController);

app.controller('TestCtrl', function($scope) {
  $scope.demo = "This is the div contents";
  console.log('test');
});

app.controller('homeController', function ($scope, $injector){
    $scope.mostrar=false;
    $scope.marlus = function(){
      alert('O Stenio é um cara super super super rico !');
    }

    $scope.newBtn = function () {
      //var $newDiv = $('<div ng-controller="TestCtrl">{{demo}}</div>');


var $newDiv = $(     "<div class='row'>" +
              "<div class='col s12 m6'>" +
              "<div class='card blue-grey darken-1'>" +
              "<div class='card-content white-text'>" +
              "<p> Nome: </p>" + 
                            "{{mostrar}}"+

              "<span class='card-title'> cliente </span>" +
              "<p> CPF </p>" +
              "<span class='card-title'> cliente.cpf </span>" +
              "<p> ... </p>" +
              "<div class='card-content' id='teste' ng-show='mostrar'>"+
              "<p>Stenio é o cara!</p>"+
              "</div>"+
              "<div class='card-action'>"+
              "<a class='btn  waves-effect waves-light red' ng-click='mostrar=true' ng-model='mostrar'>This is a link</a>"+
              "<a class='btn  waves-effect waves-light red' ng-click='marlus()'>This is a link</a>"+
              "<a href='' ng-click='mostrar=true'  ng-show='!mostrar'>Detalhes</a>"+
              "<a href='' ng-click='mostrar=false'  ng-show='mostrar'>Ocultar Detalhes</a>"+
              "</div>"+

              " </div>" +   
              " </div>" +        

              "</div>"+

              "</div>"  );




    
      $injector.invoke(function ($compile) {
          var div = $compile($newDiv);
          var content = div($scope);
          $(document.body).append(content);
      });
    };
});
