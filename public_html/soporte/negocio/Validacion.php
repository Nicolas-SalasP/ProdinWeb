<?php ob_start();?>
<?php
// Verifica POST usuario o Password
if (!empty($_POST) AND (empty($_POST['inputEmail']) OR empty($_POST['inputPassword']))) {
	header("Location: ../acceso.php"); exit;
}
include("../datos/connection.php");
$usuario = mysql_real_escape_string($_POST['inputEmail']);
$password = mysql_real_escape_string($_POST['inputPassword']);
// valida usuário/Password digitados
$sql = "SELECT full_name, email, password, idnivel FROM usertbl 
WHERE (email = '". $usuario ."') AND (password = '". $password ."') LIMIT 1";
$query = mysql_query($sql);
if (mysql_num_rows($query) != 1) {
	// mensaje de error
	$mensaje="Login incorrecto!";
	print "<script>alert('$mensaje')</script>";
	print("<script>window.history.back();</script>"); exit;
   } else {
	// graba los datos en la variable $resultado
	$resultado = mysql_fetch_assoc($query);
	// si no existe la sesion se inicia
	if (!isset($_SESSION)) session_start();
	// Salva los datos
	$_SESSION['Usuarionombre'] = $resultado['full_name'];
	$_SESSION['UsuarioNivel'] = $resultado['idnivel'];
	// Redirecciona 
	header("Location: Restriccion.php"); exit;
}?>
<?php ob_end_flush();?>