<?php 
// Actualizamos en funcion del id que recibimos 

$id = $_GET['id']; 

   require("../datos/conexion.php");
   mysql_select_db("$database", $con);  

$query = "delete from salado where idSalado = '$id'";  
$result = mysql_query($query,$con);  

print("<script>window.location.replace('../vista/zona2.php');</script>");
?> 