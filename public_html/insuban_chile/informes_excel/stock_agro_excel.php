<? 
ini_set('memory_limit', '-1');
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

header("Content-Type: application/vnd.ms-excel");
header("content-disposition: attachment;filename=stock_agro.xls");


$sql="SELECT *
FROM etiquetados_folios as etf
left outer join calibre as cal on etf.id_calibre = cal.id_calibre
left outer join etiquetas_agrosuper as eas on etf.id_etiquetados_folios = eas.id_folio
left outer join medidas_productos as mpr on mpr.id_medidas_productos = etf.id_medidas_productos
left outer join caract_envases as cen on cen.id_caract_envases = etf.id_caract_envases
WHERE (id_estado_folio = 1 or id_estado_folio = 2) and id_caract_producto = 86";


		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 	    
echo "N0;Folio_M3;Folio_antiguo;Calibre;Medida;Envase;Contenido;Cod.Barras;Cod.Sap\n";
     	 
     	 if($cuantos){
		   while ($r=mysql_fetch_array($rest)){ 

      $i++; 

echo "$i;$r[folio_m3];$r[id_etiquetados_folios];$r[calibre];$r[medidas_productos];$r[caract_envases];$r[contenido_unidades];$r[bar_code];$r[sap_code]\n";
		 
  }
}
		
?>