    function atualizar(){

var ipx = window.location.hostname;
    
             var xhr =   $.ajax({
         
                             url: 'http://'+ ipx +'/projeto/SUPERVISORIO/comandos/LER_PESO.php',
                             async: true,
                             timeout: 10000,
                             }).done(function(data) {
                                  document.querySelector("[name='leiturapeso']").value = data;
                                 
  

    
                           });   


 
             }
         
            
             setInterval("atualizar()",1000);
         
         
              $(function(){
                  atualizar();

         
              });