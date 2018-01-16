
var enviarComando = function(comando){
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
        
        alterarStatus(data);
         $('#botao_semafaro_externo_A').prop("disabled", false);

        }
      });
      
}