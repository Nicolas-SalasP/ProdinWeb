<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

  $sql="SELECT count(DISTINCT ef.id_etiquetados_folios) AS total_bidones, SUM(ef.contenido_unidades)AS contenido_unidades, p.producto AS producto, ef.id_cruce_tablas AS id_cruce_tablas, c.calibre AS calibre, um.unidad_medida AS unidad_medida, mpro.medidas_productos AS medidas_productos, carpro.caract_producto AS caract_producto, carenv.caract_envases AS caract_envases, orig.origen AS origen, ef.factura_importada AS factura_importada FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, estado_folio AS e, origenes AS orig, procedencia AS proce, cruce_tablas AS cru, historial_inventario_mpi AS himpi
WHERE ef.id_etiquetados_folios = himpi.id_pti 
AND ef.id_producto = p.id_producto
AND ef.id_medidas_productos = mpro.id_medidas_productos
AND ef.id_calibre = c.id_calibre
AND ef.id_procedencia = proce.id_procedencia
AND ef.id_estado_folio = e.id_estado_folio
AND ef.id_unidad_medida = um.id_unidad_medida
AND ef.id_caract_producto = carpro.id_caract_producto
AND ef.id_caract_envases = carenv.id_caract_envases
AND ef.id_origen = orig.id_origen
AND ef.id_cruce_tablas = cru.id_cruce_tablas
AND himpi.f_toma_inventarioi  = '$f_toma_inventariof' group by ef.factura_importada order by p.producto asc";
$result=mysql_query($sql);



header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Etiquetas_Folios.csv");



 echo "ORIGEN;CODIGO;PRODUCTO;CALIBRE;U/MEDIDA;MEDIDA;C/P;C/E;F/IMPORTADA;BIDONES;CONTENIDO\n";
   while ($row=mysql_fetch_array($result))
    { 
	$i++;
	$id_cruce_tablas=$row[id_cruce_tablas];
	$producto=$row[producto];
	$factura_importada=$row[factura_importada];
	$origen=$row[origen];
	$calibre=$row[calibre];
	$unidad_medida=$row[unidad_medida];
	$medidas_productos=$row[medidas_productos];
	$caract_producto=$row[caract_producto];
	$caract_envases=$row[caract_envases];
	$total_bidones=$row[total_bidones];
	$contenido_unidades=$row[contenido_unidades];
	

  
echo "$origen;$id_cruce_tablas;$producto;$calibre;$unidad_medida;$medidas_productos;$caract_producto;$caract_envases;$factura_importada;$total_bidones;$contenido_unidades;\n";

  }
?>