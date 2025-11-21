<?php 
if($_POST[submit]){ 

include("../controladores/connection.php");
mysql_select_db("$database", $con);

   mysql_query("INSERT INTO origenes SET id_origen='$_POST[codigo]', origen='$_POST[nombre]' " , $con);

   print("<script>window.location.replace('../vistas/add_mp.php');</script>");

 }?>