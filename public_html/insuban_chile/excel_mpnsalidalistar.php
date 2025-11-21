<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
   
   if($fecha_ingresod != '' and fecha_ingresoh != ''){
$fecha_ingresodesde=format_fecha_sin_hora($fecha_ingresod);
$fecha_ingresohasta=format_fecha_sin_hora($fecha_ingresoh);
}
   
$sql="SELECT * FROM mat_prima_nacional As mpn, estado_material AS em, producto AS p, origenes AS orig where 
mpn.id_mat_prima_nacional = mpn.id_mat_prima_nacional and
mpn.id_estado_material = em.id_estado_material and
mpn.id_mat_prima_nacional != 0 and
mpn.id_producto=p.id_producto and
mpn.id_origen= orig.id_origen ";
if($id_estado_material)
	$sql.= " and mpn.id_estado_material = '$id_estado_material' ";
if($id_producto)
	$sql.= " and p.id_producto = '$id_producto' ";
if($id_origen)
	$sql.= " and orig.id_origen = '$id_origen' ";
if($entreano1 and $entreano2)
	$sql.= " and mpn.ano between '$entreano1' and '$entreano2' ";
if($fecha_ingresodesde and $fecha_ingresohasta)
$sql.= " and mpn.fecha_ingreso between '$fecha_ingresodesde' and '$fecha_ingresohasta'";
if($fecha_ingresodesde2 and $fecha_ingresohasta2 and $entreano1 and $entreano2)
$sql.= " and mpn.fecha_salida between '$fecha_ingresodesde2' and '$fecha_ingresohasta2'";
$sql.= " order by mpn.id_mat_prima_nacional asc";
$result=mysql_query($sql);
//echo "<br>SQL $sql<br>";

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Salida_Materia_Prima_Nacional.csv");


 echo "Nº;Producto;Origen;Contenido;RCP;Nº Comprobante;Nº Bidon;Fecha Ingreso;Fecha Faena;Fecha Termino;Fecha Salida;Temperatura 1;Temperatura 2;Observaciones;Estado;Alerta;Costo\n";
 while ($row=mysql_fetch_array($result))
  {
 $id_mat_prima_nacional=$row[id_mat_prima_nacional];
 //$id_m=substr($row[ano],2,4).$id_mat_prima_nacional;
 $id_m=$id_mat_prima_nacional;
 $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
 $fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
 $fecha_faena=format_fecha_sin_hora($row[fecha_faena]);
 $fecha_termino=format_fecha_sin_hora($row[fecha_termino]);

 $comprobante_num=$row[comprobante_num];
 $unidad_produccion=$row[unidad_produccion];
 //$unidad_produccion= crea_unidad_produccion($link,$row[id_unidad_produccion]);
 $bidon_num=$row[bidon_num];
 $producto=$row[producto];
 $contenido=$row[contenido];
 $origen=$row[origen];
 $temperatura1=$row[temperatura1];
 $temperatura2=$row[temperatura2];
 $rcp=$row[rcp];
 $observaciones=$row[observaciones];
 $estado_material=$row[estado_material];
 $alerta=$row[alerta];
 $costo=$row[valor_cmp];
echo "$id_m;$producto;$origen;$contenido;$rcp;$comprobante_num;$bidon_num;$fecha_ingreso;$fecha_faena;$fecha_termino;$fecha_salida;$temperatura1;$temperatura2;$observaciones;$estado_material;$alerta;$costo\n";

  }
?>

