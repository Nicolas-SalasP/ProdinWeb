<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

$sql="SELECT * 
FROM cruce_tablas AS ct, especie AS esp, producto AS p, calibre AS c, unidad_medida AS um, medidas_productos AS mps, caract_producto AS caractp, caract_envases AS caracte, cruce_plant_especie AS cpe
WHERE ct.id_especie = esp.id_especie
AND esp.id_especie = ct.id_especie
AND ct.id_producto = cpe.id_producto
AND p.id_producto = ct.id_producto
AND ct.id_calibre = c.id_calibre
AND c.id_calibre = ct.id_calibre
AND ct.id_unidad_medida = um.id_unidad_medida
AND um.id_unidad_medida = ct.id_unidad_medida
AND ct.id_medidas_productos = mps.id_medidas_productos
AND mps.id_medidas_productos = ct.id_medidas_productos
AND ct.id_caract_producto = caractp.id_caract_producto
AND caractp.id_caract_producto = ct.id_caract_producto
AND ct.id_caract_envases = caracte.id_caract_envases
AND caracte.id_caract_envases = ct.id_caract_envases and ct.id_cruce_tablas != 0 order by p.producto, c.calibre, um.unidad_medida asc";	  
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);




header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Etiquetas_Folios.csv");

echo "ID;especie;Producto;Calibre;Unidad Medida;Medida;C/P;C/E;Codificacion\n";



 while ($row=mysql_fetch_array($result))
  {
$id_cruce_tablas=$row[id_cruce_tablas];
	$id_cruce_tablas2=$row[id_cruce_tablas];
	
	
	$id_especie=$row[id_especie];
	$id_especie2=$row[id_especie];
	$id_especiecontar=strlen($id_especie);
	$especie=$row[especie];
	
	$id_producto=$row[id_producto];
	$id_producto2=$row[id_producto];
	$id_productocontar=strlen($id_producto);
	$producto=$row[producto];

	$id_calibre=$row[id_calibre];
	$id_calibre2=$row[id_calibre];
	$id_calibrecontar=strlen($id_calibre);
	$calibre=$row[calibre];

	$id_unidad_medida=$row[id_unidad_medida];
	$id_unidad_medida2=$row[id_unidad_medida];
	$id_unidad_medidacontar=strlen($id_unidad_medida);
	$unidad_medida=$row[unidad_medida];
	

	$id_medidas_productos=$row[id_medidas_productos];
	$id_medidas_productos2=$row[id_medidas_productos];
	$id_medidas_productoscontar=strlen($id_medidas_productos);
	$medidas_productos=$row[medidas_productos];

	$id_caract_producto=$row[id_caract_producto];
	$id_caract_producto2=$row[id_caract_producto];
	$id_caract_productocontar=strlen($id_caract_producto);
	$caract_producto=$row[caract_producto];

	$id_caract_envases=$row[id_caract_envases];
	$id_caract_envases2=$row[id_caract_envases];
	$id_caract_envasescontar=strlen($id_caract_envases);
	$caract_envases=$row[caract_envases];
	
	if($id_especiecontar == 1)
	   $id_especie="00$id_especie";
	if($id_especiecontar == 2)
	   $id_especie="0$id_especie";
	if($id_especiecontar == 3)
	   $id_especie="$id_especie";
	
	if($id_productocontar == 1)
	   $id_producto="00$id_producto";
	if($id_productocontar == 2)
	   $id_producto="0$id_producto";
	if($id_productocontar == 3)
	   $id_producto="$id_producto";
	   
	if($id_calibrecontar == 1)
	   $id_calibre="00$id_calibre";
	if($id_calibrecontar == 2)
	   $id_calibre="0$id_calibre";
	if($id_calibrecontar == 3)
	   $id_calibre="$id_calibre";
	   
	if($id_unidad_medidacontar == 1)
	   $id_unidad_medida="00$id_unidad_medida";
	if($id_unidad_medidacontar == 2)
	   $id_unidad_medida="0$id_unidad_medida";
	if($id_unidad_medidacontar == 3)
	   $id_unidad_medida="$id_unidad_medida";
	
	
	if($id_medidas_productoscontar == 1)
	   $id_medidas_productos="00$id_medidas_productos";
	if($id_medidas_productoscontar == 2)
	   $id_medidas_productos="0$id_medidas_productos";
	if($id_medidas_productoscontar == 3)
	   $id_medidas_productos="$id_medidas_productos";
	
	
	if($id_caract_productocontar == 1)
	   $id_caract_producto="00$id_caract_producto";
	if($id_caract_productocontar == 2)
	   $id_caract_producto="0$id_caract_producto";
	if($id_caract_productocontar == 3)
	   $id_caract_producto="$id_caract_producto";
	   
	 	if($id_caract_envasescontar == 1)
	   $id_caract_envases="00$id_caract_envases";
	if($id_caract_envasescontar == 2)
	   $id_caract_envases="0$id_caract_envases";
	if($id_caract_envasescontar == 3)
	   $id_caract_envases="$id_caract_envases";
	
	$codigo= $id_especie.$id_producto.$id_calibre.$id_unidad_medida.$id_medidas_productos.$id_caract_producto.$id_caract_envases;

echo "$id_cruce_tablas2;$especie;$producto;$calibre;$unidad_medida;$medidas_productos;$caract_producto;$caract_envases;$codigo\n";

  }
?>