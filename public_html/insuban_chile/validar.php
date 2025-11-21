<?php 
require "lib/conexion.php";

$username = isset($_POST["username"]) ? $_POST["username"] : '';
$password = isset($_POST["password"]) ? $_POST["password"] : '';

$link = mysqli_connect($localhost, $user, $pass, $db);

if (!$link) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($username && $password) {
    $sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
 
    $result = mysqli_query($link, $sql);

    $cuantos = mysqli_num_rows($result);
} else {
    $cuantos = 0;
}

if (!$cuantos) {   
    $error_page = "index.php";
    $error_url = $error_page;
    $message = 'Usuario+No+autorizado';
    $error_url .= "?error=$message";
    header("Location: $error_url");
    exit;
} else {
    $row = mysqli_fetch_array($result);
    
    $id_insuban = $row['id_usuario'];
    $unombre = $row['unombre'];
    $uapellido = $row['uapellido'];
    $nivel_us = $row['id_u_n'];
    
    $op = array();
    for($i=1; $i<=57; $i++){
        $op[$i] = $row['op'.$i];
    }

    session_start();
    $_SESSION['id_insuban'] = $id_insuban;
    $_SESSION['nombre_usuario'] = $unombre;
    $_SESSION['apellido_usuario'] = $uapellido;
    
    for($i=1; $i<=57; $i++){
        $_SESSION['permiso'.$i] = $op[$i];
    }
    
    $_SESSION['nivel_usua'] = $nivel_us;
    
    $page = "sistema.php"; 
    header("Location: $page");
    exit;
}
?>