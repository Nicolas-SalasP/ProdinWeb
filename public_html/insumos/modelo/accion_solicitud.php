<?php 
include("../controlador/conexion.php");

$id=$_POST["id"];
$aprobar=$_POST["aprobar"];
$borrar=$_POST["borrar"];
$entregado=$_POST["entregado"];

if ($aprobar) {
	$sql = "UPDATE tmp SET estado_solicitud = 'Aprobado' WHERE id_tmp = '{$_POST["id"]}' ";
	$result = $con->query($sql);

}elseif ($borrar) {
	$sql = "DELETE FROM tmp WHERE id_tmp = '{$_POST["id"]}' ";
	$result = $con->query($sql);

}elseif ($entregado) {
	$sql = "UPDATE tmp SET estado_solicitud = 'Entregado' WHERE id_tmp = '{$_POST["id"]}' ";
	$result = $con->query($sql);
}
	header("Location: ../vista/reportes.php");
	exit;
?>