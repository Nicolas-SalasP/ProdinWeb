<?php 
include("../controlador/conexion.php");

$sql = "DELETE FROM tmp WHERE id_tmp = '{$_POST["id"]}' ";
$result = $con->query($sql); 

header("Location: ../vista/reportes.php");
exit;
?> 