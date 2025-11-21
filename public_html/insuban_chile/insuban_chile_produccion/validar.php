<?php 
// 1. LIMPIEZA DE ERRORES
error_reporting(0);
ini_set('display_errors', 0);

// 2. CAPTURAR DATOS DEL FORMULARIO (¡ESTO FALTABA!)
$username = isset($_POST["username"]) ? $_POST["username"] : null;
$password = isset($_POST["password"]) ? $_POST["password"] : null;

ini_set('memory_limit', '-1');
require "lib/conexion.php";

// Conexión (Aseguramos que use las variables de conexion.php)
$link = mysql_connect($localhost, $user, $pass);
if (!$link) { die('Error de conexión: ' . mysql_error()); }
mysql_select_db($db, $link);

// 3. LÓGICA DE VALIDACIÓN
$cuantos = 0; // Inicializamos en 0 por seguridad

if ($username && $password) {
    // Protegemos contra inyección SQL básica
    $user_safe = mysql_real_escape_string($username);
    $pass_safe = mysql_real_escape_string($password);
    
    $sql = "SELECT * FROM usuarios WHERE username='$user_safe' AND password='$pass_safe'";
    $result = mysql_query($sql);
    if ($result) {
        $cuantos = mysql_num_rows($result);
    }
}

if ($cuantos == 0) {     
    // --- USUARIO NO ENCONTRADO ---
    $error_page = "index.php";
    $message = 'Usuario+No+autorizado';
    // Redirección segura
    header("Location: $error_page?error=$message");
    exit;
} else {
    // --- USUARIO ENCONTRADO ---
    $row = mysql_fetch_array($result);
    
    $id_insuban = $row['id_usuario'];
    $unombre    = $row['unombre'];
    $uapellido  = $row['uapellido'];
    $email      = $row['email'];
    $nivel_us   = $row['id_u_n'];
    
    // Iniciamos sesión
    session_start();
    
    $_SESSION['id_insuban'] = $id_insuban;
    $_SESSION['nombre_usuario'] = $unombre;
    $_SESSION['apellido_usuario'] = $uapellido;
    $_SESSION['email'] = $email;
    $_SESSION['nivel_usua'] = $nivel_us;
    
    // Carga de permisos (Bucle para no escribir 56 líneas)
    for($i=1; $i<=56; $i++){
        $_SESSION['permiso'.$i] = $row['op'.$i];
    }
    
    // Redirección al sistema
    $page = "sistema.php"; 
    header("Location: $page");
    exit;
}
?>