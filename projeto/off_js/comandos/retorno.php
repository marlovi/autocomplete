<?php

session_start();

if (isset($_GET['op'])) {
	$op = $_GET['op'];

}
//      140       130      120        110       100       90        80         70       60        50         40       30
///SC_A10000/SS_A10000/CA_A00000/SVM_E_A00/SVD_E_A10/SVM_I_A10/SVD_I_A00/SC_B10000/SS_B10000/CA_B00000/SVM_E_B10/SVD_E_B00/
//     20       10
//  SVM_I_B10/SVD_I_B00
// FUNCIONA ASSIM $rest = substr("abcdef", -3, 1); // retorna "d"

// aqui atualizo status dos sensores de aproximação e de segurança
$S_APROX_A = substr($op, -140, 10);
// retorna /SC_A10000
$S_SEG_A = substr($op, -130, 10);
// retorna /SS_A10000
$S_APROX_B = substr($op, -70, 10);
// retorna /SC_B10000
$S_SEG_B = substr($op, -60, 10);
// retorna /SC_B10000
// ATUALIZAÇÃO ESTADO CANCELAS
$S_CA_A = substr($op, -120, 10);
// retonra CA_A10000
$S_CA_B = substr($op, -50, 10);
// retonra CA_B10000
// ATUALIZA SEMAFOROS EXTERNOS
$S_SEM_EXT_VM_A = substr($op, -110, 10);
// retorna SVM_E_A10
$S_SEM_EXT_VD_A = substr($op, -100, 10);
// retorna SVD_E_A00
$S_SEM_EXT_VM_B = substr($op, -40, 10);
// retorna SVM_E_B10
$S_SEM_EXT_VD_B = substr($op, -30, 10);
// retorna SVD_E_B00

echo "ATUALIZAÇÃO sensor sensor_segurança_A <br>";
echo ($S_SEG_A);// imprime estado sensor de segurança A
echo ("<br>");
echo "ATUALIZAÇÃO POSIÇÃO CANCELA_A <br>";
echo ($S_CA_A);
echo ("<br>");
echo "ATUALIZAÇÃO SEMAFORO EXTERNO A <br>";
echo ($S_SEM_EXT_VM_A);
echo ("<br>");
echo ($S_SEM_EXT_VD_A);
echo ("<br>");

echo "ATUALIZAÇÃO sensor sensor_segurança_B <br>";
echo ($S_SEG_B);
echo ("<br>");
echo "ATUALIZAÇÃO POSIÇÃO CANCELA_B <br>";
echo ($S_CA_B);
echo ("<br>");
echo "ATUALIZAÇÃO SEMAFORO EXTERNO B <br>";
echo ($S_SEM_EXT_VM_B);
echo ("<br>");
echo ($S_SEM_EXT_VD_B);
echo ("<br>");
echo ("<br>");

// EM TESTE DE LOGICA

if ($S_APROX_A == "/SC_A10000") {
	$_SESSION['sensor_aproximacao_A'] = 1;// SERÁ EXECUTADO EM DATA FUTURA
	//$_SESSION['sensor_seguranca_A']       = 0;	// SERÁ EXECUTADO EM DATA FUTURA

	//$_SESSION['estabilidade']             = 0;
	//$_SESSION['sensor_seguranca_B']       = 0;

	//$_SESSION['sensor_aproximacao_B']     = 0;
	//$_SESSION['leiturapeso']              = 10000;

} elseif ($S_APROX_A == "/SC_A00000") {
	$_SESSION['sensor_aproximacao_A'] = 0;// SERÁ EXECUTADO EM DATA FUTURA
}

if ($S_APROX_B == "/SC_B10000") {

	$_SESSION['sensor_aproximacao_B'] = 1;// SERÁ EXECUTADO EM DATA FUTURA
	//$_SESSION['sensor_seguranca_A']       = 0;	// SERÁ EXECUTADO EM DATA FUTURA

	//$_SESSION['estabilidade']             = 0;
	//$_SESSION['sensor_seguranca_B']       = 0;

	//$_SESSION['sensor_aproximacao_B']     = 0;
	//$_SESSION['leiturapeso']              = 10000;

} elseif ($S_APROX_B == "/SC_B00000") {
	$_SESSION['sensor_aproximacao_B'] = 0;// SERÁ EXECUTADO EM DATA FUTURA
}

if ($op == "/ENTRA_A00") {
	$_SESSION['botao_semafaro_externo_A'] = 1;// SEMAFORO EXTERNO A FICA VERDE
	//$_SESSION['botao_abrir_cancelas']     = 0;  // EXECUTADO
	//$_SESSION['botao_semafaro_interno_A'] = 0;  // falta IMPLEMENTAR LOGICA

	//$_SESSION['sensor_aproximacao_A']     = 0;  // SERÁ EXECUTADO EM DATA FUTURA
	//$_SESSION['sensor_seguranca_A']       = 0;	// SERÁ EXECUTADO EM DATA FUTURA

	//$_SESSION['estabilidade']             = 0;
	//$_SESSION['sensor_seguranca_B']       = 0;
	$_SESSION['botao_semafaro_externo_B'] = 2;
	//$_SESSION['botao_semafaro_interno_B'] = 0;
	//$_SESSION['sensor_aproximacao_B']     = 0;
	//$_SESSION['leiturapeso']              = 10000;

}
if ($op == "/ENTRA_B00") {
	$_SESSION['botao_semafaro_externo_A'] = 2;// SEMAFORO EXTERNO A FICA VERDE
	//$_SESSION['botao_abrir_cancelas']     = 0;  // EXECUTADO
	//$_SESSION['botao_semafaro_interno_A'] = 0;  // falta IMPLEMENTAR LOGICA

	//$_SESSION['sensor_aproximacao_A']     = 0;  // SERÁ EXECUTADO EM DATA FUTURA
	//$_SESSION['sensor_seguranca_A']       = 0;	// SERÁ EXECUTADO EM DATA FUTURA

	//$_SESSION['estabilidade']             = 0;
	//$_SESSION['sensor_seguranca_B']       = 0;
	$_SESSION['botao_semafaro_externo_B'] = 1;
	//$_SESSION['botao_semafaro_interno_B'] = 0;
	//$_SESSION['sensor_aproximacao_B']     = 0;
	//$_SESSION['leiturapeso']              = 10000;

}

if ($op == "/NOT_AB000") {
	$_SESSION['botao_semafaro_externo_A'] = 2;// SEMAFORO EXTERNO A FICA VERDE
	//$_SESSION['botao_abrir_cancelas']     = 0;  // EXECUTADO
	//$_SESSION['botao_semafaro_interno_A'] = 0;  // falta IMPLEMENTAR LOGICA

	//$_SESSION['sensor_aproximacao_A']     = 0;  // SERÁ EXECUTADO EM DATA FUTURA
	//$_SESSION['sensor_seguranca_A']       = 0;	// SERÁ EXECUTADO EM DATA FUTURA

	//$_SESSION['estabilidade']             = 0;
	//$_SESSION['sensor_seguranca_B']       = 0;
	$_SESSION['botao_semafaro_externo_B'] = 2;
	//$_SESSION['botao_semafaro_interno_B'] = 0;
	//$_SESSION['sensor_aproximacao_B']     = 0;
	//$_SESSION['leiturapeso']              = 10000;

}

if ($op == "/OFF_AB000") {
	$_SESSION['botao_semafaro_externo_A'] = 0;// SEMAFORO EXTERNO A FICA VERDE
	//$_SESSION['botao_abrir_cancelas']     = 0;  // EXECUTADO
	//$_SESSION['botao_semafaro_interno_A'] = 0;  // falta IMPLEMENTAR LOGICA

	//$_SESSION['sensor_aproximacao_A']     = 0;  // SERÁ EXECUTADO EM DATA FUTURA
	//$_SESSION['sensor_seguranca_A']       = 0;	// SERÁ EXECUTADO EM DATA FUTURA

	//$_SESSION['estabilidade']             = 0;
	//$_SESSION['sensor_seguranca_B']       = 0;
	$_SESSION['botao_semafaro_externo_B'] = 0;
	//$_SESSION['botao_semafaro_interno_B'] = 0;
	//$_SESSION['sensor_aproximacao_B']     = 0;
	//$_SESSION['leiturapeso']              = 10000;

}

if ($op == "/FC_AB0000") {
	//$_SESSION['botao_semafaro_externo_A'] = 0;  // SEMAFORO EXTERNO A FICA VERDE
	$_SESSION['botao_abrir_cancelas'] = 0;// EXECUTADO
	//$_SESSION['botao_semafaro_interno_A'] = 0;  // falta IMPLEMENTAR LOGICA

	//$_SESSION['sensor_aproximacao_A']     = 0;  // SERÁ EXECUTADO EM DATA FUTURA
	//$_SESSION['sensor_seguranca_A']       = 0;	// SERÁ EXECUTADO EM DATA FUTURA

	//$_SESSION['estabilidade']             = 0;
	//$_SESSION['sensor_seguranca_B']       = 0;
	//$_SESSION['botao_semafaro_externo_B'] = 0;
	//$_SESSION['botao_semafaro_interno_B'] = 0;
	//$_SESSION['sensor_aproximacao_B']     = 0;
	//$_SESSION['leiturapeso']              = 10000;

}

if ($op == "/AC_AB0000") {
	//$_SESSION['botao_semafaro_externo_A'] = 0;  // SEMAFORO EXTERNO A FICA VERDE
	$_SESSION['botao_abrir_cancelas'] = 1;// EXECUTADO
	//$_SESSION['botao_semafaro_interno_A'] = 0;  // falta IMPLEMENTAR LOGICA

	//$_SESSION['sensor_aproximacao_A']     = 0;  // SERÁ EXECUTADO EM DATA FUTURA
	//$_SESSION['sensor_seguranca_A']       = 0;	// SERÁ EXECUTADO EM DATA FUTURA

	//$_SESSION['estabilidade']             = 0;
	//$_SESSION['sensor_seguranca_B']       = 0;
	//$_SESSION['botao_semafaro_externo_B'] = 0;
	//$_SESSION['botao_semafaro_interno_B'] = 0;
	//$_SESSION['sensor_aproximacao_B']     = 0;
	//$_SESSION['leiturapeso']              = 10000;

}

?>
