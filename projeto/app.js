var app = angular.module('home', ['ui.router', 'ngMask', 'ngSanitize', 'ngCookies','ngMaterial', 'auto-complete']);
$(document).ready(function() {
    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: true, // Displays dropdown below the button
        alignment: 'left', // Displays dropdown with edge aligned to the left of button
        stopPropagation: false // Stops event propagation
    });
    //$('.dropdown-button').dropdown('open');
    $('.dropdown-button').dropdown('close');
});

/*  
Foi usado um serviço para criar as mensagens de confirmação de cadastro atualizado


*/
app.factory('meuServico', meuServicoFunction);
function meuServicoFunction( $mdDialog) {
  var serviceInstance = {
     mostrar : mostrar
  };
  function mostrar(titulo,texto) {
     $mdDialog.show(
      $mdDialog.alert()
        .clickOutsideToClose(true)
        .title(titulo)
        .textContent(texto)
        .ariaLabel('Left to right demo')
        .ok('OK!')
        // You can specify either sting with query selector
        .openFrom('#left')
        // or an element
        .closeTo(angular.element(document.querySelector('#right')))
    );
   }
   return serviceInstance;
}

