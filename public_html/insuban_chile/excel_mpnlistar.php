<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
   
$sql="SELECT mpn.id_mat_prima_nacional,mpn.ano,mpn.fecha_ingreso,mpn.comprobante_num,uni.nombre AS unidad_produccion, mpn.bidon_num,p.nombre AS nombre_producto,mpn.fecha_faena,mpn.fecha_termino,mpn.contenido,unidad.unidad_medida, mpn.temperatura1, mpn.temperatura2, mpn.rcp, mpn.observaciones, em.estado_material,mpn.alerta

FROM 
mat_prima_nacional As mpn, estado_material AS em, producto AS p, unidad_produccion AS uni, unidad_medida AS unidad
where 
mpn.id_mat_prima_nacional = mpn.id_mat_prima_nacional and
mpn.id_estado_material = em.id_estado_material and
mpn.id_mat_prima_nacional != 0 and
mpn.id_producto=p.id_producto and
mpn.id_unidad_produccion = uni.id_unidad_produccion and
mpn.id_unidad_medida = unidad.id_unidad_medida
order by mpn.id_mat_prima_nacional desc";
$result=mysql_query($sql);
//echo "<br>SQL $sql<br>";

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Materia_Prima_Nacional.csv");


 echo "Nº;Fecha Ingreso;Nº Comprobante;Unidad Producción;Nº Bidon;Producto;Fecha Faena;Fecha Termino;Contenido;Unidad Medida;Temperatura 1;Temperatura 2;RCP;Observaciones;Estado;Alerta\n";
 while ($row=mysql_fetch_array($result))
  {
 $id_mat_prima_nacional=$row[id_mat_prima_nacional];
 $id_m=substr($row[ano],2,4).$id_mat_prima_nacional;
 $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
 //$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
 $fecha_faena=format_fecha_sin_hora($row[fecha_faena]);
 $fecha_termino=format_fecha_sin_hora($row[fecha_termino]);

 $comprobante_num=$row[comprobante_num];
 $unidad_produccion=$row[unidad_produccion];
 //$unidad_produccion= crea_unidad_produccion($link,$row[id_unidad_produccion]);
 $bidon_num=$row[bidon_num];
 $nombre_producto=$row[nombre_producto];
 $contenido=$row[contenido];
 $unidad_medida=$row[unidad_medida];
 $temperatura1=$row[temperatura1];
 $temperatura2=$row[temperatura2];
 $rcp=$row[rcp];
 $observaciones=$row[observaciones];
 $estado_material=$row[estado_material];
 $alerta=$row[alerta];
echo "N$id_m;$fecha_ingreso;$comprobante_num;$unidad_produccion;$bidon_num;$nombre_producto;$fecha_faena;$fecha_termino;$contenido;$unidad_medida;$temperatura1;$temperatura2;$rcp;$observaciones;$estado_material;$alerta\n";
//echo "$i;$row[apellido];$row[apellido2];$row[nombre];$row[nombre2];$mgf;$celular;$fono1;$fono2;;\n";
  }
?>