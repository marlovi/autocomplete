<?php
echo "Rodando";
echo "<br>";

// tentando fazer com um temporizador limitando o 
// tempo de coleta.

function rs232init($com,$bautrate){
    `mode $com: BAUD=$bautrate PARITY=N data=8 stop=1 xon=on`;
    }

function send($comport,$char){

         $fp = fopen ("$comport", "w+");
         if (!$fp) {
             echo "not open for read";
          } else {
                fputs ($fp, $char);
                 fclose ($fp);
                }
    }

 
function read($comport2,$sek){

  $i = 0;
  $b = 0;
  $tempo_intervalo =4; 

  if($i<1){

  $tempo_inicio = round(microtime(true) *10000);

  $i = 2;

  }

       $buffer = "";

       $fp2 = fopen ("$comport2", "r+");

         if (!$fp2){
       echo " A PORTA NAO PODE SER ABERTA";
       }
          else{
      sleep($sek);
/*
qual é a jogada nesse while
marco o tempo de inicio de execução da função
enquanto o tempo for melhor de 4 micro segundos
ele fica dentro do laço
e coleta uma vez os dados da porta.
isso garente que o sistema nao fica travado na gravação do dado
bem pelo menos essa é a ideia 
se funfou assim heheehehbaaaa


*/
      while(((microtime(true) * 10000) - $tempo_inicio) < $tempo_intervalo){

 
  if($b<1){
    $buffer .= fgets($fp2, 16); 
    fclose ($fp2);
    $b = 2;
  
        }

            }

          return $buffer;
        
         

}

}

    

rs232init("COM2","9600"); // FUNÇÃO CONFIGURAÇÃO FUNCIONA BEM
send("COM2","n"); // FUNÇÃO SEND FUNCIONANDO BEM

// o plano é o seguinte: no arduino ele espera 1 segundo 
// para responder. depois de receber o comando
// quando chamar a função send(função que envia o comando para o arduino) 
// gasta o tempo de execução da instrução para ir para a função
// read. esse intervalo de tempo é muitas vezes menor que 1 segundo
// garantindo que quando o arduino responder o sistema ja está esperando.
// por isso o tempo de espera é 0 na funçao read.

$a = read("COM2","0"); // Misteriosamente está funcionando.
                        // acredito que tem a ver com a rotina no arduino 
                        // foi mudado a forma de transmitir dados
echo $a; 


?>
 



