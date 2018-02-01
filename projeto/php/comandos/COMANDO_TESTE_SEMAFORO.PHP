<?php 
/*
 * Envia o comando   na porta 8080
 * No endereço do servidor do arduino
 *
 * Espera-se que o arduino retorne  com 
 * o resultado se fez ou nao a ação.
 */
// deve ser padronizar a resposta em LIGA000000
              //     0123456789 
              //     /TESTE_SEM  
              //  ISSO QUER DIZER PADRAO DE ENVIO 10 BITS
echo "<script> window.location.href='http://192.168.25.177:8080/TESTE_SEM/' </script>";
 

?>