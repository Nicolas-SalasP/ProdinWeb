<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

  $sql="SELECT count(DISTINCT mpn.id_mat_prima_nacional) AS total_bidones, SUM(mpn.contenido) AS contenido_unidades, org.origen AS origen, mpn.comprobante_num AS comprobante_num, pro.producto AS producto
FROM mat_prima_nacional AS mpn, producto AS pro, estado_material AS est, origenes AS org, historial_inventario_mpn AS himpn
WHERE mpn.id_mat_prima_nacional = himpn.id_ptn 
AND mpn.id_estado_material = est.id_estado_material
AND mpn.id_origen = org.id_origen
AND mpn.id_producto = pro.id_producto and himpn.f_toma_inventariom  = '$f_toma_inventariof'
group by mpn.comprobante_num order by mpn.id_origen";
$result=mysql_query($sql);




header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Etiquetas_Folios.csv");



 echo "ORIGEN;N° COMPROBANTE;PRODUCTO;BIDONES;CONTENIDO\n";
  while ($row=mysql_fetch_array($result))
    { 
	$i++;
	$origen=$row[origen];
	$producto=$row[producto];
	$comprobante_num=$row[comprobante_num];
	$total_bidones=$row[total_bidones];
	$contenido_unidades=$row[contenido_unidades];

  
echo "$origen;$comprobante_num;$producto;$total_bidones;$contenido_unidades\n";

  }
?>