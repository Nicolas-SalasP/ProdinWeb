<?
session_start();
session_unset();
session_destroy();
Header( "Location: index.php");
exit;
?>

<? 
/*//conecto con la base de datos 
$conn = mysql_connect("servidor","usuario","password"); 
//selecciono la BBDD 
mysql_select_db("nombre_bbdd",$conn); 

//Sentencia SQL para buscar un usuario con esos datos 
$ssql = "SELECT * FROM usuario WHERE nombre_usuario='$usuario' and clave_usuario='$contrasena'";
 
//Ejecuto la sentencia 
$rs = mysql_query($ssql,$conn); 

//vemos si el usuario y contraseña es váildo 
//si la ejecución de la sentencia SQL nos da algún resultado 
//es que si que existe esa conbinación usuario/contraseña 
if (mysql_num_rows($rs)!=0){ 
    //usuario y contraseña válidos 
    //defino una sesion y guardo datos 
    session_start(); 
    session_register("autentificado"); 
    $autentificado = "SI"; 
    header ("Location: aplicacion.php"); 
}else { 
    //si no existe le mando otra vez a la portada 
    header("Location: index.php?errorusuario=si"); 
} 
mysql_free_result($rs); 
mysql_close($conn); */
?> 
