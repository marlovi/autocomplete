    function atualizar(){

var ipx = window.location.hostname;
    
             var xhr =   $.ajax({
         
                             url: 'http://'+ ipx +'/autocomplete/projeto/php/comandos/LER_PESO.php',
                             async: true,
                             timeout: 10000,
                             success: function(data,status,xhr) {
                                    var teste = parseInt(data)
                                    //console.log(data);
                                    if(data ==="SEM RESPOSTA"){
                                        // TIRANDO OS ALERTAS
                                   // Materialize.toast('VERIFIQUE CONEXÃO CONVERSOR BALANCA ', 1000,  'rounded');
                                   // Materialize.toast();
                                    }

 
                                    
                                    if (isNaN(teste) ) {
                                     // Materialize.toast('VERIFIQUE CONEXÃO DE REDE COM O CONVERSOR ', 1000,  'rounded');
                                   // Materialize.toast();

                                    }else{
                                     // console.log(status);
                                    //  console.log(data);
                                      
                                    }
         
                                     
                                    },
                                    /*
                                    quando retorna status timeout significa que nao tem conexao
                                     quando retorna a variavel teste NaN significa que nao tem conexao
                                     entre o conversor e o idncador
                                     // quando retorna em branco significa que tem rede entre o
                                     conversor e o computador mas nao tem dados entre indicador e conversr


                                    */
                                    
                              error: function(xhr, status, error) {
                                    
                                    console.log(status);

                                //Materialize.toast('VERIFIQUE CONEXÃO CONVERSOR REDE ', 1000,  'rounded');
                                 
                                    //Materialize.toast();
                                    }
 
                             }).done(function(data) {
                              var str = data
                                    var res = str.substr(0, 6);
                                    if(res ==="<br />"){
                                   // Materialize.toast('VERIFIQUE CONEXÃO ', 1000,  'rounded');
                                    //Materialize.toast();

                                    }else{
                                      document.querySelector("[name='leiturapeso']").value = data;

                                    }

                                  
                                 
   
                           });   


 /*
 
        var xhr =   $.ajax({
         
                             url: 'http://'+ ipx +'/autocomplete/projeto/php/comandos/LER_PESO.php',
                             async: true,
                             timeout: 10000,
                             }).done(function(data) {
                                  document.querySelector("[name='leiturapeso']").value = data;
 
                           }); 

 */
             }
         
            
             setInterval("atualizar()",1000);
         
         
              $(function(){
                  atualizar();

         
              });