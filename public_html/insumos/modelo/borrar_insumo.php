<?php 
$id=$_POST["id"];

require "../controlador/conexion.php";

$sql = "DELETE FROM productos WHERE id_producto = $id ";
$result = $con->query($sql);

	header("Location: ../vista/registro_insumos.php");
	exit;
?> 