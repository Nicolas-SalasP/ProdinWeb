<?
$servidor = "localhost";
$usuario = "root"; 
$clave = "123456";
$dbnombre = "inventarios";
$conecta = mysql_connect($servidor, $usuario, $clave) or die("No se ha podido conectar con el servidor MySQL. Inténtalo mas tarde.");
mysql_select_db($dbnombre, $conecta);
?>