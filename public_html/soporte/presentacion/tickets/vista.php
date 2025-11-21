<?php

$id=$_GET['id'];
    // Recuperamos la foto de la tabla
    $sql = "SELECT imagenes FROM tickets_soporte WHERE id = $id";
            
    # Conexión a la base de datos
    $link = mysql_connect('190.107.176.73:3306', 'prodinwe_root', '123456') or die(mysql_error($link));
    mysql_select_db('prodinwe_soporte', $link) or die(mysql_error($link));
    
    $conn = mysql_query($sql, $link) or die(mysql_error($link));
    $datos = mysql_fetch_array($conn);
    
    // La imagen
    $imagen = $datos[0];
    
    // Gracias a esta cabecera, podemos ver la imagen 
    // que acabamos de recuperar del campo blob
    header("Content-Type: image/jpg");
    // Muestra la imagen
      echo $imagen; ?>
<div>
<img src="vista.php?id=$id" />      
</div>     