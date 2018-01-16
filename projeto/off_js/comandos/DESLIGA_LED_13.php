<?php
/*
 * Envia o comando  LIGA na porta 8080
 * No endereço do servidor do arduino
 *
 * Espera-se que o arduino retorne  com 
 * o resultado se fez ou nao a ação.
 */

// deve ser padronizar a resposta em DESLIGA000
							//  	 0123456789
echo "<script> window.location.href='http://192.168.25.177:8080/DESLIGA000/' </script>";



?>