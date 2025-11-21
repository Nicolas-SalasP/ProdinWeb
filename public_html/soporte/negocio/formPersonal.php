<?php
//recibo las variables enviadas por el formulario 
$nombre=$_POST[nombre];
$email=$_POST[email];
$dominio=$_POST[dominio];
$select1=$_POST[select1];
$select2=$_POST[select2];
$cargo=$_POST[cargo];
$anexo=$_POST[anexo];
//conecto 
include("../datos/connection.php");
$sql = "INSERT INTO regpersonal (nombrePersonal, correoPersonal, dominioPersonal, plantaPersonal, areaPersonal, cargoPersonal, anexoPersonal)
VALUES ('$nombre', '$email', '$dominio', '$select1', '$select2', '$cargo', '$anexo')";
mysql_query($sql);
if (mysql_affected_rows()>0) {
    $mensaje="Registro guardado con exito!";
	print "<script>alert('$mensaje')</script>";
 	print("<script>window.location.replace('../presentacion/admin/formPersonal.php');</script>");exit;
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
?>