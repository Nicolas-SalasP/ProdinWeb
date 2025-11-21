<?php

$articulo=$_POST['articulo'];
$item=$_POST["item"];
$unidad=$_POST["unidad"];
$valor=$_POST['precio'];

require "../controlador/conexion.php";

$result = $con->query("INSERT INTO productos (codigo_producto, nombre_producto, unidad_medida_producto, precio_producto) VALUES ('$articulo', '$item', '$unidad', '$valor')");
$con->close();

header("Location: ../vista/registro_insumos.php");
exit;

?>