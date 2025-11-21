<?

$localhost="localhost";
$user="prodinwe_stgo391";
$pass="391stgo.*.";
$db="prodinwe_insubanchile";
$url="http://190.107.176.73/~prodinwe/insuban_chile

//require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
//require "lib/funciones.php";

$sqlf="SELECT ef.id_etiquetados_folios AS id_etiquetados_folios, p.id_producto AS id_producto, cru.id_cruce_tablas AS id_cruce_tablas, e.id_estado_folio AS id_estado_folio
FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, estado_folio AS e, origenes AS orig, procedencia AS proce, cruce_tablas AS cru
WHERE ef.id_etiquetados_folios = ef.id_etiquetados_folios
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
AND ef.id_estado_folio !=7
AND ef.id_estado_folio !=5
AND ef.id_estado_folio !=6
AND ef.id_estado_folio !=10
AND ef.id_estado_folio !=9
AND ef.id_estado_folio !=4
AND ef.id_procedencia ='I'";
$resultf=mysql_query($sqlf);

while ($rowf=mysql_fetch_array($resultf))
    { 
	
	$id_pti=$rowf[id_etiquetados_folios];
	$id_produci=$rowf[id_producto];
	$id_codi=$rowf[id_cruce_tablas];
	$id_estfolioi=$rowf[id_estado_folio];
	//echo "id_pt $id_pt - id_produc $id_produc - id_cod $id_cod - id_estfolio $id_estfolio<br>";
	
	$f_toma_inventarioi=date("Y-m-d"); 
	$sql_invpt="insert into historial_inventario_mpi (id_pti,id_produci,id_codi,id_estfolioi,f_toma_inventarioi) values ($id_pti,$id_produci,$id_codi,$id_estfolioi,'$f_toma_inventarioi')";
    $result_invpt=mysql_query($sql_invpt,$link);
	
	
	}
	
	
?>