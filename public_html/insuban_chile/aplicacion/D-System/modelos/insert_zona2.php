<?php 

if(isset($_POST[guarda])){ 

$date=date(c); // Obtener fecha de registro
$str = $_POST[id];


   include("../datos/conexion.php");
   mysql_select_db("$database", $con);


mysql_query("INSERT INTO salado (idCodigo,fechaSalado) values ('$str','$date')");   

		print("<script>window.location.replace('../vista/zona2.php');</script>");

}?>

