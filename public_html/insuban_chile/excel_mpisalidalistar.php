<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
   
$sql="SELECT *FROM mat_prima_importada As mpi, estado_material AS em, producto AS p, origenes  AS orig
where 
mpi.id_mat_prima_importada = mpi.id_mat_prima_importada and
mpi.id_estado_material = em.id_estado_material and
mpi.id_mat_prima_importada != 0 and
mpi.id_producto=p.id_producto and
mpi.id_origen = orig.id_origen";

if($id_estado_material)
	$sql.= " and mpi.id_estado_material = '$id_estado_material' ";
if($id_producto)
	$sql.= " and p.id_producto = '$id_producto' ";
if($id_origen)
	$sql.= " and orig.id_origen = '$id_origen' ";
if($anoingreso)
	$sql.= " and mpi.ano between '$entreano1' and '$entreano2' ";
if($fecha_ingresodesde2 and $fecha_ingresohasta2 and $entreano1 and $entreano2)
$sql.= " and mpi.fecha_salida between '$fecha_ingresodesde2' and '$fecha_ingresohasta2'";


$sql.= " order by mpi.id_mat_prima_importada asc";
$result=mysql_query($sql);



header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Salida_Materia_Prima_Importada.csv");


 echo "Nº;Producto;Fecha Ingreso;Fecha Salida;Nº Comprobante;Origen;Nº Bidon;Contenido;Glosa;Estado;Alerta\n";
 while ($row=mysql_fetch_array($result))
  {
 $id_mat_prima_importada=$row[id_mat_prima_importada];
 $id_m=substr($id_mat_prima_importada,1,8);
 $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
 $fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
 
 $comprobante_num=$row[comprobante_num];
 $origen=$row[origen];
 $bidon_num=$row[bidon_num];
 $producto=$row[producto];
 $contenido=$row[contenido];
 $glosa=$row[glosa];
 $estado_material=$row[estado_material];
 $alerta=$row[alerta];
  
echo"N$id_m;$producto;$fecha_ingreso;$fecha_salida;$comprobante_num;$origen;$bidon_num;$contenido;$glosa;$estado_material;$alerta\n";
//echo "$i;$row[apellido];$row[apellido2];$row[nombre];$row[nombre2];$mgf;$celular;$fono1;$fono2;;\n";
  }
?>