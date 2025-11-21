<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";


 if(!$entreano1){
					$entreano1=$fhoy=date("Y");
					$entreano1=$entreano1-2;
					//echo "entreano1 $entreano1";
					}
					if(!$entreano2){
					$entreano2=$fhoy=date("Y");
					//echo "entreano2 $entreano2";
					}

$sql="SELECT ef.id_cruce_tablas,ef.id_pedidos,pro.producto,c.calibre,estf.estado_folio,es.especie,um.unidad_medida,mp.medidas_productos,caracp.caract_producto,caracenv.caract_envases FROM etiquetados_folios AS ef, producto AS pro, calibre AS c, estado_folio AS estf, cruce_tablas AS ct, especie AS es, unidad_medida AS um, medidas_productos AS mp, operarios AS opera, caract_producto AS caracp, caract_envases AS caracenv WHERE ef.id_producto = pro.id_producto AND ef.id_calibre = c.id_calibre AND ef.id_estado_folio = estf.id_estado_folio and ef.id_cruce_tablas = ct.id_cruce_tablas and ef.id_especie = es.id_especie and ef.id_unidad_medida = um.id_unidad_medida and ef.id_medidas_productos = mp.id_medidas_productos and ef.id_caract_producto = caracp.id_caract_producto and ef.id_caract_envases = caracenv.id_caract_envases and ct.id_cruce_tablas != 0 and ef.ano between '$entreano1' and '$entreano2' and ef.id_procedencia = 'N' group by ef.id_cruce_tablas order by es.especie, pro.producto,um.unidad_medida, mp.medidas_productos,c.calibre  asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=informe_diario.csv");

echo "ID;especie;Producto;Calibre;Unidad Medida;Medida;C/P;C/E;Bodega;Emitido;Total\n";

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

        $sqlb="SELECT * FROM etiquetados_folios AS ef WHERE ef.id_estado_folio = 2 and ef.id_cruce_tablas = $row[id_cruce_tablas] and ano between '$entreano1' and '$entreano2'";
 			$resulteb=mysql_query($sqlb);
			$cuantosb=mysql_num_rows($resulteb);
	
	  	$sqle="SELECT * FROM etiquetados_folios WHERE id_estado_folio = 1 and id_cruce_tablas = $row[id_cruce_tablas] and ano between '$entreano1' and '$entreano2'";
 			$resulte=mysql_query($sqle);
			$cuantose=mysql_num_rows($resulte);
			$resultado=$cuantosb+$cuantose;

   echo "$id_cruce_tablas2;$especie;$producto;$calibre;$unidad_medida;$medidas_productos;$caract_producto;$caract_envases;$cuantosb;$cuantose;$resultado\n"; 
  }

?>