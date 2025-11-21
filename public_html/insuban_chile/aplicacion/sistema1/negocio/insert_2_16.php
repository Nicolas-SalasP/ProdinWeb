<?php 
if($_POST[agrega]){ 

   $date=date(c); // Obtener fecha de registro
   
   include("../datos/connection.php");
   mysql_select_db("$database", $con);
   
   mysql_query("INSERT INTO proceso_encargado2 SET fecha='$_POST[fecha]', operaria='$_POST[operaria]', origenid='$_POST[origen]', idgrupo1='$_POST[grupo]', n_bidon='$_POST[bidon]', n_nudos_e='$_POST[nudos_e]', n_nudos_r='$_POST[nudos_r]', f_registro='$date' " , $con);
   
   // Actualizar la página de inserción de registros
   //   echo "<script language='javascript'>window.location.href='insert.php';</script>";
   //   $mensaje="Registro agregado con exito!";
   //   print "<script>alert('$mensaje')</script>";
        print("<script>window.location.replace('../presentacion/func.search_4_16.php');</script>");
 } 
?>