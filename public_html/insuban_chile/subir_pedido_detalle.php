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
       $id_cruce_tablas = $datos[1];
       $cantidadb = $datos[2];
       $fecha_ingreso_producto_pedido = $datos[3];
       $costo = $datos[4];
       $venta = $datos[5];
       $dolar = $datos[6];      
       $euro = $datos[7];      
       $nota = $datos[8];                                                       
       $tot_cost = $datos[9]; 
       $tot_vent = $datos[10]; 
       $tot_margen = $datos[11]; 
       $id_Users = $datos[12]; 

 //guardamos en base de datos la línea leida
       mysql_query("INSERT INTO pedido_tabla
(id_pedidos, id_cruce_tablas, cantidadb, fecha_ingreso_producto_pedido, costo, venta, dolar, euro, nota, tot_cost, tot_vent, tot_margen, id_Users) 
VALUES ($id_pedidos, $id_cruce_tablas, $cantidadb, '$fecha_ingreso_producto_pedido', '$costo', '$venta', '$dolar', '$euro', '$nota', $tot_cost, $tot_vent, $tot_margen, '$id_Users');");
 
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