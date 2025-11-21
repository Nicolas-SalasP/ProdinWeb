<?
require "../../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../../lib/funciones.php";

//if(!$year){ $year=date("Y");}else{$year=$year;}

$year=date("Y");

$sql="SELECT mpn.comprobante_num, mpn.id_mat_prima_nacional, p.producto, cal.calibre, org.origen, mpn.contenido, mpn.bidon_num, mpn.fecha_ingreso, mpn.fecha_faena, mpn.fecha_termino, mpn.fecha_venci, est.estado_material, mpn.rcp, mpn.factura_mp FROM 
mat_prima_nacional AS mpn, 
producto AS p,
origenes AS org, 
estado_material AS est,
calibre AS cal
WHERE mpn.id_producto = p.id_producto
and mpn.id_calibre = cal.id_calibre 
and mpn.id_origen = org.id_origen 
and mpn.id_estado_material = est.id_estado_material
and mpn.ano between 2019 and $year
ORDER BY origen ASC";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=informe_mpn.csv");

echo "FACTURA;GUIA;FOLIO;PRODUCTO;CALIBRE;ORIGEN;CONTENIDO;N_BIDON;F/INGRESO;F/FAENA;F/TERMINO;F/VENC;ESTADO;RCP\n";

 while ($row=mysql_fetch_array($result))
  {
	$comprobante_num=$row[comprobante_num];
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
	$producto=$row[producto];
	if(!$id_calibre){$calibre = "Original";}else{$calibre = $row[calibre];}
	$rcp=$row[rcp];
	$origen=$row[origen];
	$contenido=$row[contenido];
	$bidon_num=$row[bidon_num];
	$fecha_ingreso=$row[fecha_ingreso];
	$fecha_faena=$row[fecha_faena];
	$fecha_termino=$row[fecha_termino];
	$fecha_venci=$row[fecha_venci];
	$estado_material=$row[estado_material];
	$factura=$row[factura_mp];	

	$codigo= $factura.$comprobante_num.$id_mat_prima_nacional.$producto.$calibre.$origen.$contenido.$bidon_num.$fecha_ingreso.$fecha_faena.$fecha_termino.$fecha_venci.$estado_material.$rcp;

    echo "$factura;$comprobante_num;$id_mat_prima_nacional;$producto;$calibre;$origen;$contenido;$bidon_num;$fecha_ingreso;$fecha_faena;$fecha_termino;$fecha_venci;$estado_material;$rcp\n"; 
  }

?>