var alterarStatus = function(objeto){
        console.log(objeto);


 
        // LOGICA SEMAFORO EXTERNO A
        // SE VERDE EXTERNO ESTIVER LIGADO BOTAO FICA VERDE
        // 
        if (objeto.VD_EXT_A === 1){
          
            $('#botao_semafaro_externo_A').removeClass('red accent-4');
            $('#botao_semafaro_externo_A').removeClass('black');
            $('#botao_semafaro_externo_A').addClass('teal darken-1 '); 

            $('#botao_semafaro_interno_B').removeClass('red accent-4');
            $('#botao_semafaro_interno_B').removeClass('black');
            $('#botao_semafaro_interno_B').addClass('teal darken-1 '); 
           // enviarComando('NOT_A0000');

        } else if(objeto.VM_EXT_A === 1){
        
            // SE VERMELHO EXTERNO LIGADO BOTAO FICA VERMELHO
            $('#botao_semafaro_externo_A').removeClass('black');
            $('#botao_semafaro_externo_A').removeClass('teal darken-1');
            $('#botao_semafaro_externo_A').addClass('red accent-4 ');
           // enviarComando('OFF_A0000');
            $('#botao_semafaro_interno_B').removeClass('black');
            $('#botao_semafaro_interno_B').removeClass('teal darken-1');
            $('#botao_semafaro_interno_B').addClass('red accent-4 ');
     


        } else if(objeto.VD_EXT_A === 0){
            if(objeto.VM_EXT_A === 0){
            
            $('#botao_semafaro_externo_A').removeClass('red accent-4');
            $('#botao_semafaro_externo_A').removeClass('teal darken-1');
            $('#botao_semafaro_externo_A').addClass('black '); 
          //  enviarComando('ENTRA_A00');
            $('#botao_semafaro_interno_B').removeClass('red accent-4');
            $('#botao_semafaro_interno_B').removeClass('teal darken-1');
            $('#botao_semafaro_interno_B').addClass('black '); 
 
       }    
            }

 if (objeto.VD_EXT_B === 1){
           // $('#botao_semafaro_externo_A').prop("disabled", false);
            $('#botao_semafaro_externo_B').removeClass('red accent-4');
            $('#botao_semafaro_externo_B').removeClass('black');
            $('#botao_semafaro_externo_B').addClass('teal darken-1 '); 

            $('#botao_semafaro_interno_A').removeClass('red accent-4');
            $('#botao_semafaro_interno_A').removeClass('black');
            $('#botao_semafaro_interno_A').addClass('teal darken-1 '); 
           // enviarComando('NOT_A0000');

        } else if(objeto.VM_EXT_B === 1){
            // SE VERMELHO EXTERNO LIGADO BOTAO FICA VERMELHO
            $('#botao_semafaro_externo_B').removeClass('black');
            $('#botao_semafaro_externo_B').removeClass('teal darken-1');
            $('#botao_semafaro_externo_B').addClass('red accent-4 ');
           // enviarComando('OFF_A0000');
            $('#botao_semafaro_interno_A').removeClass('black');
            $('#botao_semafaro_interno_A').removeClass('teal darken-1');
            $('#botao_semafaro_interno_A').addClass('red accent-4 ');
     


        } else if(objeto.VD_EXT_B === 0){
            if(objeto.VM_EXT_B === 0){
            $('#botao_semafaro_externo_B').removeClass('red accent-4');
            $('#botao_semafaro_externo_B').removeClass('teal darken-1');
            $('#botao_semafaro_externo_B').addClass('black '); 
          //  enviarComando('ENTRA_A00');
            $('#botao_semafaro_interno_A').removeClass('red accent-4');
            $('#botao_semafaro_interno_A').removeClass('teal darken-1');
            $('#botao_semafaro_interno_A').addClass('black '); 
 
       }    
            }

             // FIM LOGICA SEMAFORO EXTERNO A
// LOGICA ATUALIZAÇÃO SENSORES APROXIMAÇAO E SEGURANCA

if (objeto.S_C_A === 0){

document.getElementById("sensor_aproximacao_A").value ="BLOQUEADO";
  $('#sensor_aproximacao_A').removeClass('black-text');
  $('#sensor_aproximacao_A').addClass('red-text ');
} else if (objeto.S_C_A === 1) {

document.getElementById("sensor_aproximacao_A").value ="LIVRE";
  $('#sensor_aproximacao_A').removeClass('red-text');
  $('#sensor_aproximacao_A').addClass('black-text ');
}

if (objeto.S_S_A === 0){
document.getElementById("sensor_seguranca_A").value ="BLOQUEADO";
 $('#sensor_seguranca_A').removeClass('black-text');
  $('#sensor_seguranca_A').addClass('red-text ');
} else if (objeto.S_S_A === 1) {
document.getElementById("sensor_seguranca_A").value ="LIVRE";
  $('#sensor_seguranca_A').removeClass('red-text');
  $('#sensor_seguranca_A').addClass('black-text ');
}

if (objeto.S_C_B === 0){
document.getElementById("sensor_aproximacao_B").value ="BLOQUEADO";
 $('#sensor_aproximacao_B').removeClass('black-text');
  $('#sensor_aproximacao_B').addClass('red-text ');
} else if (objeto.S_C_B === 1) {
document.getElementById("sensor_aproximacao_B").value ="LIVRE";
  $('#sensor_aproximacao_B').removeClass('red-text');
  $('#sensor_aproximacao_B').addClass('black-text ');
}

if (objeto.S_S_B === 0){
document.getElementById("sensor_seguranca_B").value ="BLOQUEADO";
 $('#sensor_seguranca_B').removeClass('black-text');
  $('#sensor_seguranca_B').addClass('red-text ');

} else if (objeto.S_S_B === 1) {
document.getElementById("sensor_seguranca_B").value ="LIVRE";
 $('#sensor_seguranca_B').removeClass('red-text');
  $('#sensor_seguranca_B').addClass('black-text ');
}
// fim LOGICA ATUALIZAÇÃO SENSORES APROXIMAÇAO E SEGURANCA

// incio logica controle cancelas

if (objeto.CA_A === 0){

  $('#botao_controle_cancelas_abrir').removeClass(' teal darken-4');
  $('#botao_controle_cancelas_abrir').addClass('red accent-4 ');
  

} 
if (objeto.CA_A === 1){

 $('#botao_controle_cancelas_abrir').removeClass(' red accent-4');
  $('#botao_controle_cancelas_abrir').addClass('teal darken-4 ');
  

} 

if (objeto.S_S_A === 1 && objeto.S_S_B === 1) {
  
document.getElementById("estabilidade").value ="LIVRE";
  $('#estabilidade').removeClass('red-text');
  $('#estabilidade').addClass('black-text '); 

} else {

  document.getElementById("estabilidade").value ="Pesagem Parcial";
  $('#estabilidade').removeClass('black-text');
  $('#estabilidade').addClass('red-text '); 
}

$('#botao_semafaro_externo_A').prop("disabled", false);
$('#botao_semafaro_externo_B').prop("disabled", false);
$('#botao_controle_cancelas_abrir').prop("disabled", false);
      
            
       

        }

   



       
      
      