<?php
//recibo las variables enviadas por el formulario 
$insumo=$_POST[insumo];
$color=$_POST[color];

//conecto 
include("../datos/config2.php");
$sql = "INSERT INTO inventarioinsumos (insumo, color)
VALUES ('$insumo', '$color')";
mysql_query($sql);
if (mysql_affected_rows()>0) {
    $mensaje="Registro guardado con exito!";
	print "<script>alert('$mensaje')</script>";
 	print("<script>window.location.replace('../presentacion/admin/dashboard_table1.php');</script>");exit;
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
?>