<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

  $sql="SELECT ef.id_etiquetados_folios AS id_etiquetados_folios,ef.contenido_unidades AS contenido_unidades, ef.total_ponderado AS total_ponderado, ef.id_cruce_tablas AS id_cruce_tablas, ef.factura_importada AS factura_importada,  p.producto AS producto, c.calibre AS calibre, um.unidad_medida AS unidad_medida, mpro.medidas_productos AS medidas_productos, carpro.caract_producto AS caract_producto, carenv.caract_envases AS caract_envases, orig.origen AS origen FROM etiquetados_folios AS ef, producto AS p, calibre AS c, unidad_medida AS um, medidas_productos AS mpro, caract_producto AS carpro, caract_envases AS carenv, origenes AS orig, historial_inventario_mpi AS himpi, cruce_tablas AS cru,  procedencia AS proce WHERE ef.id_etiquetados_folios = himpi.id_pti 
AND ef.id_producto = p.id_producto
AND ef.id_medidas_productos = mpro.id_medidas_productos
AND ef.id_calibre = c.id_calibre
AND ef.id_procedencia = proce.id_procedencia
AND ef.id_unidad_medida = um.id_unidad_medida
AND ef.id_caract_producto = carpro.id_caract_producto
AND ef.id_caract_envases = carenv.id_caract_envases
AND ef.id_origen = orig.id_origen
AND ef.id_cruce_tablas = cru.id_cruce_tablas
AND himpi.f_toma_inventarioi = '$f_toma_inventariof' and ef.id_caract_producto != 25 and ef.id_procedencia = 'I'";
$result=mysql_query($sql);



header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=folios_mpi.csv");



 echo "FOLIOS; ORIGEN;CODIGO;PRODUCTO;CALIBRE;U/MEDIDA;MEDIDA;C/P;C/E;F/IMPORTADA;CONTENIDO;COSTO\n";
   while ($row=mysql_fetch_array($result))
    { 
	$i++;
	$id_etiquetados_folios=$row[id_etiquetados_folios];
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
	$factura_importada=$row[factura_importada];
	$total_ponderado =$row[total_ponderado];

  
echo "$id_etiquetados_folios ;$origen;$id_cruce_tablas;$producto;$calibre;$unidad_medida;$medidas_productos;$caract_producto;$caract_envases;$factura_importada;$contenido_unidades;$total_ponderado;\n";

  }
?>