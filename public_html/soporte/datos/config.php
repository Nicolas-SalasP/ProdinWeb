<?
$servidor = "190.107.176.73:3306";
$usuario = "prodinwe_root"; 
$clave = "123456";
$dbnombre = "prodinwe_soporte";
$conecta = mysql_connect($servidor, $usuario, $clave) or die("No se ha podido conectar con el servidor MySQL. Inténtalo mas tarde.");
mysql_select_db($dbnombre, $conecta);
?>