<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
   
$sql="SELECT * FROM mat_prima_importada As mpi, estado_material AS em, producto AS p, unidad_produccion AS uni
where 
mpi.id_mat_prima_importada = mpi.id_mat_prima_importada and
mpi.id_estado_material = em.id_estado_material and
mpi.id_mat_prima_importada != 0 and
mpi.id_producto=p.id_producto and
mpi.id_unidad_produccion = uni.id_unidad_produccion 
order by mpi.id_mat_prima_importada desc";
$result=mysql_query($sql);
//echo "<br>SQL $sql<br>";

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Materia_Prima_Importada.csv");


 echo "Nº;Producto;Fecha Ingreso;Nº Comprobante;Origen;Nº Bidon;Contenido;Glosa;Estado;Alerta\n";
 while ($row=mysql_fetch_array($result))
  {
 $id_mat_prima_importada=$row[id_mat_prima_importada];
 $id_m=substr($row[ano],2,4).$id_mat_prima_importada;
 $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
 //$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
 
 $comprobante_num=$row[comprobante_num];
 $unidad_produccion=$row[unidad_produccion];
 $bidon_num=$row[bidon_num];
 $producto=$row[producto];
 $contenido=$row[contenido];
 $glosa=$row[glosa];
 $estado_material=$row[estado_material];
 $alerta=$row[alerta];
  
echo "N$id_m;$producto;$fecha_ingreso;$comprobante_num;$unidad_produccion;$bidon_num;$contenido;$glosa;$estado_material;$alerta\n";
//echo "$i;$row[apellido];$row[apellido2];$row[nombre];$row[nombre2];$mgf;$celular;$fono1;$fono2;;\n";
  }
?>