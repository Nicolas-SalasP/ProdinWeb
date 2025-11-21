<?php 
if($_POST[guarda]){ 

$date=date(c); // Obtener fecha de registro
$str = $_POST[id];
//$arr2 = str_split($str, 2);

//print_r($str);


   include("../datos/connection.php");
   mysql_select_db("$database", $con);

   mysql_query("INSERT INTO salado (idCodigo,fechaSalado) values ('$str','$date')");
 
 }   
   // Actualizar la página de inserción de registros
   //   echo "<script language='javascript'>window.location.href='insert_3.php';</script>";
   //   $mensaje="Registro agregado con exito!";
   //   print "<script>alert('$mensaje')</script>";
 print("<script>window.location.replace('../presentacion/func.search_5.php');</script>");

?>
