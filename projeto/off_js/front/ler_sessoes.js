function atualizarSessoes(){
$.ajax({

                    url: 'http://localhost/projeto/pega_sessao.php',
                    async: false
                    }).done(function(data) { 
                        console.log(data);      
                         if(data==="0"){
                         	ligaBotao('#botao_semafaro_externo_A');
                         }else if(data ==="1"){
                         	desligaBotao('#botao_semafaro_externo_A');
                         }
                  });

    }

