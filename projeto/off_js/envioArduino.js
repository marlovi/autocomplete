
// enviarComando vai enviar 2 vezes o dado para o arduino
// com intervado ajustado no seTimeout.1 segundo reenviado a mensagem

var enviarComando = function(comando){
            console.log("enviarComando ");
            console.log(comando);
        	$.ajax({
                url: "http://192.168.25.177:80",
                data: { 'acao': comando},
                dataType: 'jsonp',
                crossDomain: true,
                jsonp: false,
                jsonpCallback: 'dados',
                success: function(data,status,xhr) {
                // posso ler dados e retoranar na pagina para avisar se a luz ta ligada ou desligada.
                 //alterarStatus(data);
                // $('#botao_semafaro_externo_A').prop("disabled", false);
                }
              });
        // redudancia do comando apos 1 segundo
                setTimeout(function(){
                   //console.log("enviarComando ");
                   // console.log(comando);
                    $.ajax({
                        url: "http://192.168.25.177:80",
                        data: { 'acao': comando},
                        dataType: 'jsonp',
                        crossDomain: true,
                        jsonp: false,
                        jsonpCallback: 'dados',
                        success: function(data,status,xhr) {
                        // posso ler dados e retoranar na pagina para avisar se a luz ta ligada ou desligada.
                        alterarStatus(data);
                         $('#botao_semafaro_externo_A').prop("disabled", false);
                        }
                      });
                }, 1000);
         
}

 
