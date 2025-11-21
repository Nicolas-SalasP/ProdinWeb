<?php 

if($_POST[guarda]){ 



   $date=date(c); // Obtener fecha de registro

   

   include("../datos/connection.php");

   mysql_select_db("$database", $con);

   mysql_query("INSERT INTO remojo SET fecha='$_POST[fecha]', producto='$_POST[producto]', procedencia='$_POST[procedencia]', n_bidon='$_POST[query]', n_mallas='$_POST[mallas]', f_faena='$_POST[ffaena]', idGrupo2='$_POST[grupo]', f_salida_produccion='$_POST[fproduccion]', f_registro='$date' ,solicitud='$_POST[solicitud]', fact_guia='$_POST[factura]' " , $con);

   

   // Actualizar la página de inserción de registros

   //   echo "<script language='javascript'>window.location.href='insert.php';</script>";

   //   $mensaje="Registro agregado con exito!";

   //   print "<script>alert('$mensaje')</script>";

        print("<script>window.location.replace('../presentacion/func.search_2.php');</script>");

 } 

?>