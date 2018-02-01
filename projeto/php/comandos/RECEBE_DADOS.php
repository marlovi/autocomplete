// TESTE DE RECEPÇÃO DE DADOS
<?php
$ttyPath = '/dev/tty.usbmodem1a21';
$ttyHandler = fopen($ttyPath, 'r'); // Abrindo a conexão serial
while (true) { // Loop infinto, para testarmos a leitura como acontece no Serial Monitor
  $bytes = fread($ttyHandler, 1024); // Lendo uma linha da conexão, até 1024 bytes
  if (strlen($bytes) > 0) { // Se o Arduino enviou algo ...
    echo $bytes; // Imprimimos
  }
}
fclose($ttyHandler); // Fechando a conexão. De fato, o script nunca vai chegar aqui