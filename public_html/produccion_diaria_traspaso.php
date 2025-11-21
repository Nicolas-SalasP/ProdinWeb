<?

$localhost="190.107.176.73:3306";
$user="prodinwe_stgo391";
$pass="391stgo.*.";
$db="prodinwe_insubanchile";
$url="http://190.107.176.73/~prodinwe/insuban_chile";

//require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
//require "lib/funciones.php";

$sqlf="CALL Ctl_ProduccionDiaria(CURDATE()) ";
$resultf=mysql_query($sqlf);


?>