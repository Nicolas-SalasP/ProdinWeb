<?
require "../../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../../lib/funciones.php";

$sql="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, pro.producto AS producto, mpi.comprobante_num AS comprobante_num, mpi.bidon_num AS bidon_num,org.origen AS origen, mpi.contenido AS contenido, mpi.valor_cmpi AS valor_cmpi, mpi.etiquetados_folios_id AS etiquetados_folios_id, mpi.cruce_tablas_id AS cruce_tablas_id FROM mat_prima_importada AS mpi, producto AS pro, origenes AS org, historial_inventario_mpi AS hinpi
WHERE mpi.id_mat_prima_importada = hinpi.id_pti 
AND mpi.id_origen = org.id_origen
AND mpi.id_producto = pro.id_producto and hinpi.f_toma_inventarioi  = '$f_toma_inventariof' ";
$result=mysql_query($sql);




header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=inventario_producto_salado.csv");



 echo "Folios mpni;Folio Antiguo;CODIGO;PRODUCTO;CALIBRE;U/MEDIDA;MEDIDA;C/PRODUCTO;C/ENVASE;N COMPROBANTE;N BIDON;ORIGEN;CONTENIDO;COSTO\n";
  while ($rowi=mysql_fetch_array($result))
    { 
	$i++;
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$codigo=$rowi[cruce_tablas_id];
	$producto=$rowi[producto];
	$comprobante_num=$rowi[comprobante_num];
	$bidon_num=$rowi[bidon_num];
	$origen=$rowi[origen];
	$contenido=$rowi[contenido];
	$valor_cmpi=$rowi[valor_cmpi];
    $largo=strlen($id_mat_prima_importada);
		 
	if($largo == 9){
	$id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	}
	$id=$id_mat_prima_importada;
	 
  	
	$sqlb="SELECT  * from cruce_tablas AS ct, calibre AS c, unidad_medida AS um, medidas_productos AS mpro, caract_producto AS carpro, caract_envases AS carenv where ct.id_calibre = c.id_calibre and ct.id_unidad_medida = um.id_unidad_medida and ct.id_medidas_productos = mpro.id_medidas_productos and ct.id_caract_producto = carpro.id_caract_producto and ct.id_caract_envases = carenv.id_caract_envases and  id_cruce_tablas = $codigo";
    $resulbt=mysql_query($sqlb);
	//$cuantosb=mysql_num_rows($resulbt);
	
	if ($rowb=mysql_fetch_array($resulbt))
	{
	$calibre=$rowb[calibre];
	$unidad_medida=$rowb[unidad_medida];
	$medidas_productos=$rowb[medidas_productos];
	$caract_producto=$rowb[caract_producto];
	$caract_envases=$rowb[caract_envases];
	}
  
  
  
echo "$id;$etiquetados_folios_id;$codigo;$producto;$calibre;$unidad_medida;$medidas_productos;$caract_producto;$caract_envases;$comprobante_num;$bidon_num;$origen;$contenido;$valor_cmpi\n";

  }
?>