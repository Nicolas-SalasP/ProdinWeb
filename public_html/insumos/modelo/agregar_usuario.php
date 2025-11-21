<?php

$nombre=$_POST['nombre'];
$email=$_POST["email"];
$clave=$_POST["clave"];
$perfil=$_POST['gridRadios'];
$area=$_POST['area'];

require "../controlador/conexion.php";

$result = $con->query("INSERT INTO ins_usuarios (us_nombre, us_email, us_clave, us_perfil, us_area) VALUES ('$nombre', '$email', '$clave', '$perfil', '$area')");
$con->close();

header("Location: ../vista/registro_usuarios.php");
exit;

?>