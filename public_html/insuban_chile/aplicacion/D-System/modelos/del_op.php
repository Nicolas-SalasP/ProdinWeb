<?php 
$id = $_GET['id']; 

include("../controladores/connection.php");
mysql_select_db("$database", $con);  

mysql_query("DELETE FROM operarias where idoperarias = '$id'", $con);   

print("<script>window.location.replace('../vistas/list.php');</script>");
?> 

