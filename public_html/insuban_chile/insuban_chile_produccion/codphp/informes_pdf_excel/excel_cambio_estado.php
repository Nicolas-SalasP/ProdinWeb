<?
require "../../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../../lib/funciones.php";

$sql=" SELECT ef.freprocesado, ef.id_c_es_so , ef.id_etiquetados_folios , ef.id_cruce_tablas ,prd.producto,clb.calibre,unm.unidad_medida,mp.medidas_productos,
cp.caract_producto,ce.caract_envases, ef.contenido_unidades,CONCAT(ope.nombreop,' ',ope.apellido) as operador,est.estado_folio 
from etiquetados_folios as ef,
producto as prd,
calibre as clb,
unidad_medida as unm,
medidas_productos as mp,
caract_producto as cp,
caract_envases as ce,
operarios as ope,
estado_folio as est 
where ef.id_producto = prd.id_producto
and ef.id_calibre = clb.id_calibre
and ef.id_unidad_medida = unm.id_unidad_medida
and ef.id_medidas_productos = mp.id_medidas_productos
and ef.id_caract_producto = cp.id_caract_producto
and ef.id_caract_envases = ce.id_caract_envases
and ef.id_operarios = ope.id_operarios
and ef.id_estado_folio = est.id_estado_folio
and ef.id_estado_folio=6 ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Informe_c_estado.csv");

echo "FREPROCESO;SOLICITUD;FOLIO PT;COD;PRODUCTO;CALIBRE;U/MEDIDA;MEDIDAS;C/PRO;C/ENV;CONTENIDO;OPERADOR;ESTADO\n";

 while ($row=mysql_fetch_array($result))
  {
	$freproceso=$row[freprocesado];
	$id_c_es_so=$row[id_c_es_so];
	$folio =$row[id_etiquetados_folios];
	$cod=$row[id_cruce_tablas];
	$producto=$row[producto];
	$calibre=$row[calibre];
	$umedida=$row[unidad_medida];
	$mproductos=$row[medidas_productos];
	$cproducto=$row[caract_producto];
	$cenvases=$row[caract_envases];
	$contenido=$row[contenido_unidades];
	$operador=$row[operador];
	$efolio=$row[estado_folio];
	

	$codigo= $freproceso.$id_c_es_so.$folio.$cod.$producto.$calibre.$umedida.$mproductos.$cproducto.$cenvases.$contenido.$operador.$efolio;

    echo "$freproceso;$id_c_es_so;$folio;$cod;$producto;$calibre;$umedida;$mproductos;$cproducto;$cenvases;$contenido;$operador;$efolio\n"; 
  }

?>