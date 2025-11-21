<?php 
if($_POST[agrega]){ 

   $date=date(c); // Obtener fecha de registro

   include("../datos/conexion.php");
   mysql_select_db("$database", $con);

mysql_query("INSERT INTO proceso_encargado2 SET fecha='$_POST[fecha]', operaria='$_POST[operaria]', origenid='$_POST[origen]', idgrupo1='$_POST[grupo]', n_bidon='$_POST[bidon]', n_nudos_e='$_POST[nudos_e]', n_nudos_r='$_POST[nudos_r]', f_registro='$date' " , $con);   

       print("<script>window.location.replace('../vista/zona1.php');</script>");
 }?>


<!-- 

$con = mysql_connect('localhost', 'root', '123456');
mysql_select_db('sistema1', $con);

   
$que = "INSERT INTO proceso_encargado2 (fecha, operaria, origenid, idgrupo1, n_bidon, n_nudos_e, n_nudos_r, f_registro) ";
$que.= "VALUES ('$_POST[fecha]', '$_POST[operaria]', '$_POST[origen]','$_POST[grupo]', '$_POST[bidon]', '$_POST[nudos_e]', '$_POST[nudos_r]', '$date' ) ";
$res = mysql_query($que, $con) or die(mysql_error());
-->