

//session_start(); 
//iniciamos a sessão
// aqui foi outra tentativa
// JA TO PENSANDO EM MUDANÇA DE PORTA SERIAL E
// CONFIGURAÇÃO DE VELOCIDADE CONFIG PELO USUARIO 
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

/////////////////////////////////////////////////

/* funiona as vezes. acho que tem a ver com o que o
   Marlus falou de levar até o servidor e proccessar
   deve perder parte da informação.

    */
function read($comport2,$sek){

       $buffer = "";

       $fp2 = fopen ("$comport2", "r+");
         if (!$fp2){
       echo " A PORTA NAO PODE SER ABERTA";
       }else{
      sleep($sek);

      echo fgets($fp2);
         // $buffer .= fgets($fp2, 4096); 
     
 
            }
          return $buffer;
        
         

          fclose ($fp2);
}
   

////////////////////////////////////////
nesse modelo ele le o arquivo sem quebrar as linhas 
mas le independente do tamanho

$myfile = fopen("bloco1.txt", "r") or die("Unable to open file!"); // abri o arquivo com a função
                  // r que é somente leitura
echo fread($myfile,filesize("bloco1.txt")); // usa a função fread e le os dados do txt
fclose($myfile);
/////////////////////////////////////////////////////////
 nesse modelo ele le o arquivo e quebra as linhas
$myfile = fopen("bloco1.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>"; // pelo que eu entendi a função gets ler linha por linha
}
fclose($myfile);



// aqui funciona de boa

// IMPRIME STATUS NO NAVEGADOR
echo "STATUS";
echo "<br>";  // quebra linha
// Define porta onde arduino está conectado
$port = "COM2";
  
// Configura velocidade de comunicação com a porta serial
exec("MODE $port BAUD=9600 PARITY=n DATA=8 XON=on STOP=1");
  
// Inicia comunicação serial
$fp = fopen($port, 'rb+') or die ("Não deu pra abrir a porta!");

// Escreve na porta
fwrite($fp, "AC_AB"); 

sleep(1); // espera 1 segundo para executar
fwrite($fp, "STATUS");  // solicita o status da automação

// baixei uma biblioteca com exemplos  vou tentar.
sleep(1);

fwrite($fp, "FC_AB");
 
fclose($fp); 
sleep(3);
header("Location: C:\wamp64\www\supervisorio.com\index");

//////////////////////
// aqui foi outra tentativa
// JA TO PENSANDO EM MUDANÇA DE PORTA SERIAL E
// CONFIGURAÇÃO DE VELOCIDADE CONFIG PELO USUARIO 
function rs232init($com,$bautrate){
    `mode $com: BAUD=$bautrate PARITY=N data=8 stop=1 xon=off`;
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

/////////////////////////////////////////////////

// funiona as vezes acho que tem a ver com o que o
    // Marlus falou de levar até o servidor e proccessar
    // deve perder parte da informação.
function read($comport2,$sek)
    {

       $buffer = "";

       $fp2 = fopen ("$comport2", "r+");
         if (!$fp2)
         {
       echo " A PORTA NAO PODE SER ABERTA";
       }
    else
      {
      sleep($sek);

       echo " A PORTA FOI ABERTA";
       echo "<br>";
      echo "ARMAZENANDO NA VARIAVEL BUFFER";
      echo "<br>";
          //$buffer .= fgets($fp2, 1024); 
          // QUANDO ATIVO A LINHA ACIMA
      // FUNCIONA INTERMITENTE.
 
            }
          return $buffer;
        
         

          fclose ($fp2);
}
   


rs232init("COM2","9600"); // FUNÇÃO CONFIGURAÇÃO FUNCIONA BEM
send("COM2","FC_AB"); // FUNÇÃO SEND FUNCIONANDO BEM
$a = read("COM2","2"); 
echo $a; 

