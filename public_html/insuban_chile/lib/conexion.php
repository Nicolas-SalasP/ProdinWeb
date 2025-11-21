<?
error_reporting(0);
ini_set('display_errors', 0);

$localhost="localhost";
$user="root";
$pass="";
$db="sistema_insuban";

$link = mysql_connect($localhost, $user, $pass);
if (!$link) {
    die('Error de Conexión Base de Datos.');
}
mysql_select_db($db, $link);

extract($_REQUEST);

if (isset($_SESSION)) {
    extract($_SESSION);
} else {
    @session_start();
    if (isset($_SESSION)) {
        extract($_SESSION);
    }
}
?>