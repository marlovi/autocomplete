<?php
require_once ("configuracoes.class.php");


$cfgServer  = Configuracoes::$ipIndicador;//IP of your router
$cfgPort    = Configuracoes::$ipIndicadorPort;//port, 22 if SSH
$cfgTimeOut = 10;

$peso   = 0;
$usenet = fsockopen($cfgServer, $cfgPort, $errno, $errstr, $cfgTimeOut);

if (!$usenet) {
	echo "Sem conexão com indicador ".$cfgServer.":".$cfgPort."\n";
	
	exit();
} else {

	/*fputs($usenet, "root\r\n");
	fputs($usenet, "dbps\r\n");
	fputs($usenet, "telnet ".Configuracoes::$ipIndicador." 2001\r\n");
	fputs($usenet, "exit\r\n");*/

	$contador = 0;
	while (!feof($usenet)) {
		//fgets($usenet, 128);
		//echo fgets($usenet, 128)."SEM RESPOSTA\n";
		$var = fgets($usenet, 128);
		$tratamento_para_sem_conexao = fgets($usenet, 128)."SEM RESPOSTA\n";
		if($tratamento_para_sem_conexao =="SEM RESPOSTA\n"){
			echo "SEM RESPOSTA";

		}
		//$media =  (int) substr($var, -11, 6);

		if ($contador == 1) {
			//usando o marcador E da saturno para
			//certificar a estabilidade e imprimir o resultado
			$var = fgets($usenet, 128);
			//$peso = (int) substr($var, -11, 7);
			
			$marcador = substr($var, 8, 1);


			if ($marcador == "E") {
			$peso =  substr($var, 3, 5);

			echo $peso;
			break;
			} else {
			echo "Aguardando";
			break;
			}
			//echo $var;
			
			//echo $est;
			break;

		}
		
		//echo $var;
		$contador++;

	}

}

?>
