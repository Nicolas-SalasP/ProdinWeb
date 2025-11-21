<?php 
if($_POST[submit]){ 

include("../controladores/connection.php");
mysql_select_db("$database", $con);

   mysql_query("INSERT INTO operarias SET idencargado='$_POST[encargado]', idgrupo='$_POST[grupo]', onombre='$_POST[nombre]', iniciales='$_POST[iniciales]', activo='$_POST[estado]' " , $con);

   print("<script>window.location.replace('../vistas/add_op.php');</script>");

 }?>