<?php 
// Actualizamos en funcion del id que recibimos 

$id = $_GET['id']; 

require("../datos/conexion.php");
mysql_select_db("$database", $con);   

$query = "delete from proceso_encargado2 where idproceso_encargado2 = '$id'";  
$result = mysql_query($query,$con);  

print("<script>window.location.replace('../vista/zona1.php');</script>");
?> 