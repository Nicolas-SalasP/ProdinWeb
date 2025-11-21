<?php 

if(isset($_POST[guarda])){ 

$date=date(c); // Obtener fecha de registro
$str = $_POST[id];
//$arr2 = str_split($str, 2);

//print_r($str);
//print_r($arr2);

   include("../datos/connection.php");
   mysql_select_db("$database", $con);


mysql_query("INSERT INTO salado (idCodigo,fechaSalado) values ('$str','$date')");   


/*
mysql_query("INSERT INTO registro_operarios
(idEncargado,
fecha,
n_bandeja,
n_bidon,
cantidad,
idCalibre,
IdOperario,
iniciales,
codigo,
origen)
SELECT pe.idEncargado,$date,pe.n_bandeja,pe.n_bidon,pe.cantidad,cal.idcalibres,ope.idoperarias,ope.iniciales,pe.codigo,pe.origen
FROM proceso_encargado pe
left outer join operarias as ope on ope.idoperarias = pe.idOperario
left outer join calibres as cal on cal.idcalibres = pe.IdCalibre
left outer join encargados as enc on enc.idencargados = pe.idEncargado
left outer join origenes as org on org.id_origen = pe.origen
where pe.codigo='$str' order by idproceso desc limit 1  " , $con);


*/

}   

   // Actualizar la página de inserción de registros

   //   echo "<script language='javascript'>window.location.href='insert_3.php';</script>";

   //   $mensaje="Registro agregado con exito!";

   //   print "<script>alert('$mensaje')</script>";

 print("<script>window.location.replace('../presentacion/func.search_3_14.php');</script>");



?>

