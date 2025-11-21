<?php
//recibo las variables enviadas por el formulario 
$id=$_POST[id];
$cuenta=$_POST[cuenta];
$user=$_POST[user];
$clave=$_POST[clave];
//conecto 
include("../datos/connection.php");
$sql = "INSERT INTO detpersonal (iddetPersonal, detCuenta, detPassword, detUser)
VALUES ('$id', '$cuenta', '$user', '$clave')";
mysql_query($sql);
if (mysql_affected_rows()>0) {
    $mensaje="Registro guardado con exito!";
	print "<script>alert('$mensaje')</script>";
	print("<script>window.location.replace('../presentacion/admin/formPersonal2.php');</script>");exit;
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
?>