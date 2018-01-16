<?php 
echo "FUNÇÃO ABRIR CANCELA A e B CONCLUIDO";
// Define porta onde arduino está conectado
$port = "COM6";
  
// Configura velocidade de comunicação com a porta serial
exec("MODE $port BAUD=9600 PARITY=n DATA=8 XON=on STOP=1");
  
// Inicia comunicação serial
$fp = fopen($port, 'c+');
  
// Escreve na porta
fwrite($fp, "AC_AB");
  
// Fecha a comunicação serial
fclose($fp);
header("Location: C:\wamp64\www\supervisorio.com\index");

?>