<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

 $sql="SELECT ef.contenido_unidades AS contenido_unidades, ef.total_ponderado AS total_ponderado, ef.id_etiquetados_folios AS id_etiquetados_folios, p.producto AS producto, cru.id_cruce_tablas AS id_cruce_tablas, c.calibre AS calibre, um.unidad_medida AS unidad_medida, mpro.medidas_productos AS medidas_productos, carpro.caract_producto AS caract_producto, carenv.caract_envases AS caract_envases FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, estado_folio AS e, origenes AS orig, procedencia AS proce, cruce_tablas AS cru, historial_inventario_pt AS hipt
WHERE ef.id_etiquetados_folios = hipt.id_pt 
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
AND e.id_estado_folio != 7 and e.id_estado_folio != 5 and e.id_estado_folio != 6 and e.id_estado_folio != 10 and e.id_estado_folio != 9 and e.id_estado_folio != 4 and ef.id_caract_producto != 25  and ef.id_procedencia = 'N' and hipt.f_toma_inventario  = '$f_toma_inventariof'";
$result=mysql_query($sql);


header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=folios_pt.csv");



 echo "FOLIOS;CODIGO;PRODUCTO;CALIBRE;U/MEDIDA;MEDIDA;C/P;C/E;CONTENIDO;COSTO\n";
  while ($row=mysql_fetch_array($result))
    { 
	$i++;
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$id_cruce_tablas=$row[id_cruce_tablas];
	$producto=$row[producto];
	$calibre=$row[calibre];
	$unidad_medida=$row[unidad_medida];
	$medidas_productos=$row[medidas_productos];
	$caract_producto=$row[caract_producto];
	$caract_envases=$row[caract_envases];
	$total_bidones=$row[total_bidones];
	$contenido_unidades=$row[contenido_unidades];
	$total_ponderado =$row[total_ponderado];
	
  echo "$id_etiquetados_folios;$id_cruce_tablas;$producto;$calibre;$unidad_medida;$medidas_productos;$caract_producto;$caract_envases;$contenido_unidades;$total_ponderado\n";
  }
  
  $sqlc="SELECT ef.id_etiquetados_folios AS id_etiquetados_foliosc, ef.total_ponderado AS total_ponderadoc, ef.contenido_unidades AS contenido_unidadesc ,p.producto AS productoc, ef.id_cruce_tablas AS id_cruce_tablasc, c.calibre AS calibrec, um.unidad_medida AS unidad_medidac, mpro.medidas_productos AS medidas_productosc, carpro.caract_producto AS caract_productoc, carenv.caract_envases AS caract_envasesc FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, estado_folio AS e, origenes AS orig, procedencia AS proce, historial_inventario_pt AS hipt
WHERE ef.id_etiquetados_folios = hipt.id_pt 
AND ef.id_producto = p.id_producto
AND ef.id_medidas_productos = mpro.id_medidas_productos
AND ef.id_calibre = c.id_calibre
AND ef.id_procedencia = proce.id_procedencia
AND ef.id_estado_folio = e.id_estado_folio
AND ef.id_unidad_medida = um.id_unidad_medida
AND ef.id_caract_producto = carpro.id_caract_producto
AND ef.id_caract_envases = carenv.id_caract_envases
AND ef.id_origen = orig.id_origen
AND e.id_estado_folio != 7 and e.id_estado_folio != 5 and e.id_estado_folio != 6 and e.id_estado_folio != 10 and e.id_estado_folio != 9 and e.id_estado_folio != 4 and ef.id_caract_producto = 25  and ef.id_procedencia = 'N' and hipt.f_toma_inventario  = '$f_toma_inventariof' ";
$resultc=mysql_query($sqlc);
$cuantos=mysql_num_rows($resultc);

 echo "FOLIO;CODIGO;PRODUCTO;CALIBRE;U/MEDIDA;MEDIDA;C/P;C/E;CONTENIDO;COSTO\n";
 while ($rowc=mysql_fetch_array($resultc))
    { 
	$i++;
	$id_etiquetados_foliosc=$rowc[id_etiquetados_foliosc];
	$id_cruce_tablasc=$rowc[id_cruce_tablasc];
	$productoc=$rowc[productoc];
	$calibrec=$rowc[calibrec];
	$unidad_medidac=$rowc[unidad_medidac];
	$medidas_productosc=$rowc[medidas_productosc];
	$caract_productoc=$rowc[caract_productoc];
	$caract_envasesc=$rowc[caract_envasesc];
	$total_bidonesc=$rowc[total_bidonesc];
	$contenido_unidadesc=$rowc[contenido_unidadesc];
	$total_ponderadoc =$rowc[total_ponderadoc];
	
	 echo "$id_etiquetados_foliosc;$id_cruce_tablasc;$productoc;$calibrec;$unidad_medidac;$medidas_productosc;$caract_productoc;$caract_envasesc;$contenido_unidadesc;$total_ponderadoc\n";
	}
?>