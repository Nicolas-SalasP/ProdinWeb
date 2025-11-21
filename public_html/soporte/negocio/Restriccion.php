<?php
// redirecciona a cada pagina diferente
if (!isset($_SESSION)) session_start();
//administrador
//$nivel_necessario = '1';
if (($_SESSION['UsuarioNivel'] == '1')) {
// instrucciones que hay que ejecutar si la condición es verdadera
	header("Location: ../presentacion/tickets/ver_tickets2.php"); 
}elseif (($_SESSION['UsuarioNivel'] == '2')) {
// Instrucciones que hay que ejecutar si la condición es falsa
	header("Location: http://10.10.1.136/Menu/menu2.php"); exit;
}else{
// Instrucciones que hay que ejecutar si la condición es falsa
	header("Location: http://10.10.1.136/Menu/otro.php"); exit;
}
?>
