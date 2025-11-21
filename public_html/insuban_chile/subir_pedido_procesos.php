<?php
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");

//obtenemos el archivo .csv
$tipo = $_FILES['archivo']['type'];
 
$tamanio = $_FILES['archivo']['size'];
 
$archivotmp = $_FILES['archivo']['tmp_name'];
 
//cargamos el archivo
$lineas = file($archivotmp);
 
//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
$i=0;
 
//Recorremos el bucle para leer línea por línea
foreach ($lineas as $linea_num => $linea)
{ 
   //abrimos bucle
   /*si es diferente a 0 significa que no se encuentra en la primera línea 
   (con los títulos de las columnas) y por lo tanto puede leerla*/
   if($i != 0) 
   { 
       //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
       /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
       leyendo hasta que encuentre un ; */
       $datos = explode(";",$linea);
 
       //Almacenamos los datos que vamos leyendo en una variable
       //usamos la función utf8_encode para leer correctamente los caracteres especiales
//       $calibre = utf8_encode($datos[1]);
//       $valor = utf8_encode($datos[2]);

       $id_pedidos = $datos[0];
       $id_usuario = $datos[1];
       $year = $datos[2];
       $fecha_prioridad = $datos[3];
       $id_destinos = $datos[4];
       $fech_ingreso_pedido = $datos[5];
       $folio_piking = $datos[6];
       $id_paking_relacion = $datos[7];      
       $fech_envio_picking = $datos[8];      
       $notificacion_email = $datos[9];                                                       

       //guardamos en base de datos la línea leida
       mysql_query("INSERT INTO pedido
(id_pedidos,id_usuario, year, fecha_prioridad, id_destinos, fech_ingreso_pedido, folio_piking, id_paking_relacion, fech_envio_picking, notificacion_email) 
VALUES ($id_pedidos,$id_usuario, $year, '$fecha_prioridad', $id_destinos, '$fech_ingreso_pedido', $folio_piking, $id_paking_relacion, '$fech_envio_picking', $notificacion_email);");
 
       //cerramos condición
   }
 
   /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
   entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
   $i++;
   //cerramos bucle
}

//echo $folioM3."<br>";
//echo $idProdin;
echo "Registros Actualizados<br>";

//print("<script>window.location.replace('ejemplo.php');</script>");
?>