<?php 
$userID=$_GET['id_op'];
$estado=$_GET['estado'];

include("../controladores/connection.php");
mysql_select_db("$database", $con);

mysql_query("UPDATE operarias SET activo='$estado' WHERE idoperarias=$userID ", $con);
mysql_close($con);
print("<script>window.location.replace('../vistas/list.php');</script>");
?> 
