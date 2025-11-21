<?php 
if($_POST[limpiar]){ 

$f_actual = date("Y-m-d");

//print_r($f_actual);

   include("../datos/connection.php");
   mysql_select_db("$database", $con);
   
  	mysql_query("DELETE FROM registro_operarios Where fecha='$f_actual' ", $con);
 }   
   // Actualizar la página de inserción de registros
   //   echo "<script language='javascript'>window.location.href='insert_3.php';</script>";
      $mensaje="Registros eliminados!";
      print "<script>alert('$mensaje')</script>";
  	print("<script>window.location.replace('../presentacion/admin/proceso3.php');</script>");

?>
