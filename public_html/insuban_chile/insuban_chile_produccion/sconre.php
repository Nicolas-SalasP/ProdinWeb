<?
require "lib/conexion.php";
require( 'lib/session_admin.php');
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

?>