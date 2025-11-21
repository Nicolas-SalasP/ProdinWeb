<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

    
  $sqlf="SELECT count(DISTINCT ef.id_etiquetados_folios) AS total_bidones, SUM(contenido_unidades) AS contenido_unidades,p.producto AS producto, ef.id_cruce_tablas AS id_cruce_tablas, c.calibre AS calibre, um.unidad_medida AS unidad_medida, mpro.medidas_productos AS medidas_productos, carpro.caract_producto AS caract_producto, carenv.caract_envases AS caract_envases FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, estado_folio AS e WHERE ef.id_etiquetados_folios = ef.id_etiquetados_folios
AND ef.id_producto = p.id_producto AND ef.id_medidas_productos = mpro.id_medidas_productos AND ef.id_calibre = c.id_calibre AND ef.id_estado_folio = e.id_estado_folio AND ef.id_unidad_medida = um.id_unidad_medida AND ef.id_caract_producto = carpro.id_caract_producto AND ef.id_caract_envases = carenv.id_caract_envases AND ef.id_estado_folio != 5 AND ef.id_estado_folio != 10 AND ef.id_estado_folio != 9 AND ef.id_estado_folio != 0 AND ef.id_estado_folio != 8 AND ef.id_estado_folio != 4 ";

if($fecha_ingresodesde and $fecha_ingresohasta){
$sqlf.= " and ef.f_termino between '$fecha_ingresodesde' and '$fecha_ingresohasta'";
}
$sqlf.= " group by ef.id_cruce_tablas order by p.producto asc";
//echo "sqlf $sqlf<br>";
//$sqlf.= " AND ef.id_procedencia ='N'  order by p.producto asc";
$resultf=mysql_query($sqlf);


header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=produccion_por_mes.csv");

 echo "CODIGO;PRODUCTO;CALIBRE;U/MEDIDA;MEDIDA;C/P;C/E;BIDONES;CONTENIDO\n";
  while ($row=mysql_fetch_array($resultf))
    { 
	
	$id_cruce_tablas=$row[id_cruce_tablas];
	$producto=$row[producto];
	$calibre=$row[calibre];
	$unidad_medida=$row[unidad_medida];
	$medidas_productos=$row[medidas_productos];
	$caract_producto=$row[caract_producto];
	$caract_envases=$row[caract_envases];
	$total_bidones=$row[total_bidones];
	$contenido_unidades5=$row[contenido_unidades];
	
		$sqlrep="SELECT count(DISTINCT ef.id_etiquetados_folios) AS total_bidonesrep, SUM(contenido_unidades) AS contenidototalrep, ef.id_cruce_tablas AS id_cruce_tablasrep FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, estado_folio AS e WHERE ef.id_etiquetados_folios = ef.id_etiquetados_folios AND ef.id_producto = p.id_producto AND ef.id_medidas_productos = mpro.id_medidas_productos AND ef.id_calibre = c.id_calibre AND ef.id_estado_folio = e.id_estado_folio AND ef.id_unidad_medida = um.id_unidad_medida AND ef.id_caract_producto = carpro.id_caract_producto AND ef.id_caract_envases = carenv.id_caract_envases AND ef.id_estado_folio = 6 and ef.id_cruce_tablas = '$id_cruce_tablas'";
	
if($fecha_ingresodesde and $fecha_ingresohasta){
$sqlrep.= " and ef.freprocesado between '$fecha_ingresodesde' and '$fecha_ingresohasta'";
}

$sqlrep.= " group by ef.id_cruce_tablas order by p.producto asc";
$resultrep=mysql_query($sqlrep);
$cuantos=mysql_num_rows($resultrep);
//echo "sqlrep $sqlrep<br>";
//echo "Cuantos reproce $cuantos";
if($cuantos){
	
	while ($rowrep=mysql_fetch_array($resultrep))
    	{ 
		$id_cruce_tablasrep = $rowrep[id_cruce_tablasrep];
		$contenido_unidadesrep = $rowrep[contenidototalrep];
		//echo "id_cruce_tablasrep $id_cruce_tablasrep / contenido_unidadesrep $contenido_unidadesrep";
		}	
		
		if($contenido_unidadesrep > $contenido_unidades5){
				$contenido_unidades5 = $contenido_unidadesrep - $contenido_unidades5;
				echo "$contenido_unidades5";
			}else{
				$contenido_unidades5 = $contenido_unidades5 - $contenido_unidadesrep;
				echo "$contenido_unidades5";
			}
				
		
	}else{
	
		$contenido_unidades;	
	}
	
	
  echo "$id_cruce_tablas;$producto;$calibre;$unidad_medida;$medidas_productos;$caract_producto;$caract_envases;$total_bidones;$contenido_unidades5\n";
 
  }
  
	
?>