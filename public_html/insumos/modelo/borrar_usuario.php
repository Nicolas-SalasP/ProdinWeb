<?php 
$id = $_POST['id']; 

require "../controlador/conexion.php";

$sql = "DELETE FROM ins_usuarios WHERE id_usuario = $id ";
$result = $con->query($sql); 

header("Location: ../vista/registro_usuarios.php");
exit;
?> 