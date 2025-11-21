<?
require "../../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../../lib/funciones.php";

$sql="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, pro.producto AS producto, mpn.comprobante_num AS comprobante_num, mpn.bidon_num AS bidon_num,org.origen AS origen, mpn.contenido AS contenido, mpn.valor_cmp AS valor_cmp FROM mat_prima_nacional AS mpn, producto AS pro, origenes AS org, historial_inventario_mpn AS himpn
WHERE mpn.id_mat_prima_nacional = himpn.id_ptn 
AND mpn.id_origen = org.id_origen
AND mpn.id_producto = pro.id_producto and himpn.f_toma_inventariom  = '$f_toma_inventariof' ";
$result=mysql_query($sql);




header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=inventario_producto_fresco.csv");



 echo "Folios MPN;PRODUCTO;N COMPROBANTE;N BIDON;ORIGEN;CONTENIDO;COSTO\n";
  while ($row=mysql_fetch_array($result))
    { 
	$i++;
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
	$producto=$row[producto];
	$comprobante_num=$row[comprobante_num];
	$bidon_num=$row[bidon_num];
	$origen=$row[origen];
	$contenido=$row[contenido];
	$valor_cmp=$row[valor_cmp];

  
echo "$id_mat_prima_nacional;$producto;$comprobante_num;$bidon_num;$origen;$contenido;$valor_cmp\n";

  }
?>