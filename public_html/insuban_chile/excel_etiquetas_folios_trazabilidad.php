<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";


if(!$picking){ 
$sql="SELECT * FROM etiquetados_folios AS ef, paking AS p, estado_folio AS est, producto AS pro, calibre AS c, unidad_medida AS um, medidas_productos AS medp where  ef.id_etiquetados_folios = p.id_etiquetados_folios and ef.id_estado_folio = est.id_estado_folio and ef.id_producto = pro.id_producto and ef.id_estado_folio = est.id_estado_folio and ef.id_calibre = c.id_calibre and ef.id_unidad_medida = um.id_unidad_medida and ef.id_medidas_productos = medp.id_medidas_productos and ef.id_calibre = c.id_calibre";

if($anotrab){
	$sql.= " and ef.ano between '$entreano1' and '$entreano2' ";
}

if($id_estado_folio){
	$sql.= " and ef.id_estado_folio = $id_estado_folio ";
}

if($id_producto){
	$sql.= " and ef.id_producto = $id_producto ";
}

if($factura){
	$sql.= " and ef.factura = $factura ";
}

if($newdatod and $newdatoh){
$sql.= " and ef.id_etiquetados_folios between '$newdatod' and '$newdatoh' and ef.id_etiquetados_folios=ef.id_etiquetados_folios ";
}

$sql.=" group by ef.id_etiquetados_folios ";
$result=mysql_query($sql);
}

if($picking and $entreano1){
   $sql="SELECT * FROM paking AS p, etiquetados_folios AS ef, producto AS pro WHERE p.folio_piking =$picking AND p.id_etiquetados_folios = ef.id_etiquetados_folios and ef.id_producto = pro.id_producto";
	
if($anotrab){
	$sql.= " and ef.ano between '$entreano1' and '$entreano2' ";
}

if($id_estado_folio){
	$sql.= " and ef.id_estado_folio = $id_estado_folio ";
}

if($id_producto){
	$sql.= " and ef.id_producto = $id_producto ";
}

if($factura){
	$sql.= " and ef.factura = $factura ";
}
if($id_unidad_medida){
	$sql.= " and ef.id_unidad_medida = $id_unidad_medida ";
}
if($id_medidas_productos){
	$sql.= " and ef.id_medidas_productos = $id_medidas_productos ";
}

$sql.=" group by ef.id_etiquetados_folios ";
$result=mysql_query($sql);	
$cuantos=mysql_num_rows($result);
}

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Etiquetas_Folios_Trazabilidad.csv");

 while ($row=mysql_fetch_array($result))
  {
	  echo "Picking;Nº Folio;Producto;Calibre;Unidad Medida;Medida;Contenido Unidad;Fecha Faena;Fecha Termino;Factura;Operador;Estado Material\n";
 $id_etiquetados_folios=$row[id_etiquetados_folios];
 //$id_m=substr($row[ano],2,4).$id_etiquetados_folios;
 $f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
 $f_inicio=format_fecha_sin_hora($row[f_inicio]);
 $f_termino=format_fecha_sin_hora($row[f_termino]);
 
 $producto=$row[producto]; $unidad_medida=$row[unidad_medida]; $calibre=$row[calibre]; $factura=$row[factura]; $contenido_unidades=$row[contenido_unidades]; $origen=$row[origen];
 $glosa=$row[glosa]; $glosa=$row[glosa]; $glosa=$row[glosa];
 
 $sql_ope="SELECT * FROM operarios WHERE id_operarios= $row[id_operarios]";
					$result_ope=mysql_query($sql_ope);
					if ($rowope=mysql_fetch_array($result_ope)){
					$nombre_completo="$rowope[nombreop] $rowope[apellido]";
					}

$sql_estfolio="SELECT * FROM estado_folio WHERE id_estado_folio= $row[id_estado_folio]";
					$result_estfolio=mysql_query($sql_estfolio);
					if ($rowresult_estfolio=mysql_fetch_array($result_estfolio)){
					$estado_folio=$rowresult_estfolio[estado_folio];
					}
$sql_cali="SELECT * FROM calibre WHERE id_calibre= $row[id_calibre]";
					$result_cali=mysql_query($sql_cali);
					if ($rowcali=mysql_fetch_array($result_cali)){
					 $calibre=$rowcali[calibre];
					}					
$sql_unidad="SELECT * FROM unidad_medida WHERE id_unidad_medida= $row[id_unidad_medida]";
					$result_unidad=mysql_query($sql_unidad);
					if ($rowunidad=mysql_fetch_array($result_unidad)){
					$unidad_medida=$rowunidad[unidad_medida];
   				    }	
$sql_unipro="SELECT * FROM medidas_productos WHERE id_medidas_productos= $row[id_medidas_productos]";
					$result_unipro=mysql_query($sql_unipro);
					if ($rowunipro=mysql_fetch_array($result_unipro)){
					$id_medidas_productos=$row[id_medidas_productos];
					$medidas_productos=$rowunipro[medidas_productos];
					}

 	if(!$valorpiking){
	$sql_pik="SELECT * FROM paking AS pik, etiquetados_folios AS ef WHERE pik.id_etiquetados_folios=ef.id_etiquetados_folios and pik.id_etiquetados_folios= $row[id_etiquetados_folios]";
    }else{
	$sql_pik=" SELECT * FROM paking AS pik, etiquetados_folios AS ef WHERE pik.id_etiquetados_folios = ef.id_etiquetados_folios and pik.folio_piking = $valorpiking";
	}
	$result_pik=mysql_query($sql_pik);
	$cuantos_pik=mysql_num_rows($result_pik);
	
	if($cuantos_pik){
					while ($rowpik=mysql_fetch_array($result_pik)){ 
					$pik=$rowpik[folio_piking]; 
					//$rowpik[folio_piking]; 
					$id_etiq_fo=$row[id_etiquetados_folios];
					}
					}	
 
 
 echo "$pik;$id_etiquetados_folios;$producto;$calibre;$unidad_medida;$medidas_productos;$contenido_unidades;$f_elaboracion;$f_termino;$factura;$nombre_completo;$estado_folio\n";

  $sql_buscar="SELECT * 
FROM folios_mat AS fm, mat_prima_nacional AS mpn, producto AS pro, origenes AS orig
WHERE fm.id_etiquetados_folios = $id_etiquetados_folios
AND fm.id_mat = mpn.id_mat_prima_nacional
AND mpn.id_origen = orig.id_origen
AND mpn.id_producto = pro.id_producto ";
$result_buscar=mysql_query($sql_buscar);
$cuantos_buscar=mysql_num_rows($result_buscar);

echo "Folio;Nº MPN;Producto;Fecha ingreso;Fecha Faena;Fecha Termino;Contenido;Origen;RCP;Comprob. N�;N� Bidon;Unidad\n";
  while ($r=mysql_fetch_array($result_buscar)) { 
        $fecha_ingreso=format_fecha_sin_hora($r[fecha_ingreso]);
		$fecha_faena=format_fecha_sin_hora($r[fecha_faena]);
		$fecha_termino=format_fecha_sin_hora($r[fecha_termino]);
		$ano=substr($r[ano], 2, 3);
		$id_mat_prima_nacional=$r[id_mat_prima_nacional];
        $fecha_ingreso=$r[fecha_ingreso];
		$producto=$r[producto];
		$origen=$r[origen];
		$rcp=$r[rcp];
		$contenido=$r[contenido];
		$bidon_num=$r[bidon_num];
		$comprobante_num=$r[comprobante_num];
		
		if($r[id_pro]){
		$id_producto=$r[id_pro];
		$unidad_medida= crea_unidad_medida_producto2($link,$id_producto);
					
		}
		
		
	
	
echo"$id_etiquetados_folios;$id_mat_prima_nacional;$producto;$fecha_ingreso;$fecha_faena;$fecha_termino;$contenido;$origen;$rcp;$comprobante_num;$bidon_num;$unidad_medida\n";

}


  }
?>