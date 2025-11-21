<? 
ini_set('memory_limit', '-1');
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

header("Content-Type: application/vnd.ms-excel");
//header("Expires: 0");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=inv_agro.xls");

/*
$sql="SELECT eta.id_cruce_tabla, eta.id_folio, eta.fecha_emision, etf.folio_m3, eta.bar_code 
FROM etiquetas_agrosuper eta
left outer join etiquetados_folios as etf on eta.id_folio = etf.id_etiquetados_folios";
*/

$sql="SELECT *
FROM etiquetas_agrosuper eta
left outer join etiquetados_folios as etf on eta.id_folio = etf.id_etiquetados_folios
left outer join calibre as clb on etf.id_calibre = clb.id_calibre
left outer join estado_folio as est on est.id_estado_folio = etf.id_estado_folio";


		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 	    
echo "Fecha_Emision;bar_code;Folio_M3;Folio_antiguo;Cod_Prod;Calibre;Cantidad;Estado;Sap_Code\n";

//echo "Cod_Prod;Folio_Prodin;F/Emision;id_M3;bar_code\n"; 	    
     	 
     	 if($cuantos){
		   while ($r=mysql_fetch_array($rest)){ 

            	$id_cruce_tabla =$r[id_cruce_tabla];			
            	$id_folio =$r[id_folio];
            	$fecha_emision =format_fecha_sin_hora($r[fecha_emision]);
              $folio_m3 =$r[folio_m3];                  
              $bar_code =$r[bar_code];
              $estado_folio =$r[estado_folio];
              $id_etiquetados_folios =$r[id_etiquetados_folios];              


//echo "$fecha;$destino;$codigo;$cantidad\n";

echo "$r[fhoy];$r[bar_code];$r[folio_m3];$r[id_etiquetados_folios];$r[id_cruce_tabla];$r[calibre];$r[contenido_unidades];$r[estado_folio];$r[sku_code]\n";

//echo "$id_cruce_tabla;$id_folio;$fecha_emision;$folio_m3;$bar_code\n";			 
  }
}
		
?>