/*  
Serviço que mostra aviso de confirmação de
alteração de cadastro.
*/

angular.factory('meuServico', meuServicoFunction);
function meuServicoFunction( $mdDialog) {
  var serviceInstance = {
     mostrar : mostrar
  };
  function mostrar(texto) {
     $mdDialog.show(
      $mdDialog.alert()
        .clickOutsideToClose(true)
        .title('Opening from the left')
        .textContent(texto)
        .ariaLabel('Left to right demo')
        .ok('Nice!')
        // You can specify either sting with query selector
        .openFrom('#left')
        // or an element
        .closeTo(angular.element(document.querySelector('#right')))
    );
   }
   return serviceInstance;
}