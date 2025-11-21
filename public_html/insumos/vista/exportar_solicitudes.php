<?php 
require "../controlador/conexion.php"; 

//$i=0;
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=Solicitudes.csv');


$sql="SELECT * FROM tmp as tmp 
left outer join productos as prd on tmp.id_producto = prd.id_producto";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);
 	    
echo "Fecha;Solicitante;Cod.Producto;Nombre.Item;Cantidad\n"; 	    
     	 
     	 if($count){

		   while ($r=mysqli_fetch_array($result)){ 
              
//              $i++;
              $fecha_solicitud =$r[5];			
              $solicitante =$r[4];
              $cod_producto =$r[10];                
              $nombre_producto =utf8_decode($r[11]);
              $cantidad =$r[2];                                                                 

echo "$fecha_solicitud;$solicitante;'$cod_producto';$nombre_producto;$cantidad\n";			 
		   }
     }?>