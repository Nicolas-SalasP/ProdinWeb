<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";


if($fecha_iniciodesde){
$fecha_inicio_desde=format_fecha_sin_hora($fecha_iniciodesde);
}
if($fecha_iniciohasta){
$fecha_inicio_hasta=format_fecha_sin_hora($fecha_iniciohasta);
}

if($fecha_iniciodesderepro and $fecha_iniciohastarepro){
$fecha_inicio_desderep=format_fecha_sin_hora($fecha_iniciodesderepro);
$fecha_inicio_hastarep=format_fecha_sin_hora($fecha_iniciohastarepro);
}

if(!$piking){

	$sql="SELECT * FROM etiquetados_folios AS ef
left outer join producto AS p on ef.id_producto = p.id_producto
left outer join medidas_productos AS mp on ef.id_medidas_productos = mp.id_medidas_productos
left outer join calibre AS c on ef.id_calibre = c.id_calibre
left outer join operarios AS o on ef.id_operarios=o.id_operarios
left outer join estado_folio AS e on ef.id_estado_folio = e.id_estado_folio
left outer join destinos AS dest on ef.id_destinos = dest.id_destinos
left outer join unidad_medida AS um on ef.id_unidad_medida = um.id_unidad_medida
left outer join caract_producto AS carpro on ef.id_caract_producto = carpro.id_caract_producto
left outer join caract_envases AS carenv on ef.id_caract_envases = carenv.id_caract_envases
left outer join origenes AS orig on ef.id_origen = orig.id_origen
left outer join procedencia AS proce on ef.id_procedencia = proce.id_procedencia
where id_cruce_tablas != 0 and ef.ocupado = 0 ";

if($id_medidas_productos){
$sql.= " and mp.id_medidas_productos = '$id_medidas_productos' ";
}

if($id_caract_producto){
$sql.= " and carpro.id_caract_producto = '$id_caract_producto' ";
}
if($id_caract_envases){
$sql.= " and carenv.id_caract_envases = '$id_caract_envases' ";
}

if($id_unidad_medida){
$sql.= " and um.id_unidad_medida = '$id_unidad_medida' ";
}

if($entreano1 and $entreano2 and !$fecha_inicio_desderep and !$fecha_inicio_hastarep){
	$sql.= " and ef.ano between '$entreano1' and '$entreano2' ";
}else{
$sql.= " and ef.freprocesado  between '$fecha_inicio_desderep' and '$fecha_inicio_hastarep'";
}

if($id_estado_folio){
$sql.= " and e.id_estado_folio = '$id_estado_folio' ";
}
if($id_producto){
$sql.= " and p.id_producto = '$id_producto'";

}
if($id_origen){
$sql.= " and orig.id_origen = '$id_origen'";

}
if($compro_nro){
$sql.= " and ef.compro_nro = '$compro_nro'";
}
if($id_calibre){
$sql.= " and c.id_calibre = '$id_calibre'";

}
if($id_destinos){
$sql.= " and dest.id_destinos = '$id_destinos'";
}

if($id_cruce_tablas){
	$sql.= " and ef.id_cruce_tablas = '$id_cruce_tablas'";
}

if($codigopt){
	$sql.= " and ef.id_cruce_tablas = '$codigopt'";
}

if($pallet){
	$sql.= " and ef.pallet = '$pallet'";
}

if($pallet_bidones and !$pallet_cajas)
{
$sql.= " and ef.id_caract_producto != 25  ";	
	
}

if($pallet_cajas and !$pallet_bidones){
$sql.= " and ef.id_caract_producto = 25  ";	
	
}


if($factura){
	$sql.= " and ef.factura = '$factura'";
}

if($desde and $hasta){
$sql.= " and ef.folio_m3 between '$desde' and '$hasta' and ef.folio_m3=ef.folio_m3 ";
}

if($desde and $hasta == ''){
$sql.= " and ef.folio_m3 = '$desde'";
}

if($guia_despacho_trazab)
{
$sql.= " and ef.guia_despacho_trazab = '$guia_despacho_trazab'";
}

if($hasta and $desde == ''){
$sql.= " and ef.folio_m3 = '$hasta'";
}

if($fecha_ingresod and $fecha_ingresoh){
$sql.= " and ef.f_termino between '$fecha_ingresod' and '$fecha_ingresoh'";}

if($fecha_despachod and $fecha_despachoh){
$sql.= " and ef.fdespacho_piking between '$fecha_despachod' and '$fecha_despachoh'";
}

if($fecha_ingreso_mpidesde and $fecha_ingreso_mpihasta){
$sql.= " and ef.fbodega_mpi between '$fecha_ingreso_mpidesde' and '$fecha_ingreso_mpihasta'";
}


if($entreano1 and $entreano2 and !$fecha_inicio_desde and !$fecha_inicio_hasta){
$sql.= " and ef.ano between '$entreano1' and '$entreano2' order by ef.id_etiquetados_folios, c.condicion_cod_barra, c.calibre desc";
}else{
$sql.= " and ef.f_elaboracion between '$fecha_inicio_desde' and '$fecha_inicio_hasta' order by ef.id_etiquetados_folios, c.condicion_cod_barra, c.calibre desc";
}


			
$result=mysql_query($sql);	
//echo "SQL $sql";
$cuantos=mysql_num_rows($result);
//echo "cuantos $cuantos";
}


if($piking){
//echo "si piking $piking";
$sql="SELECT * FROM paking AS pk, procedencia AS proce, etiquetados_folios AS ef, producto AS pro, calibre AS c, operarios AS op, destinos AS des, estado_folio AS estf, medidas_productos AS medpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv WHERE pk.folio_piking = $piking and ef.id_etiquetados_folios = pk.id_etiquetados_folios and ef.id_producto = pro.id_producto and ef.id_calibre = c.id_calibre and ef.id_operarios = op.id_operarios and ef.id_destinos = des.id_destinos and ef.id_estado_folio = estf.id_estado_folio and ef.id_medidas_productos = medpro.id_medidas_productos and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and ef.id_procedencia = proce.id_procedencia and id_cruce_tablas != 0 and ef.ocupado = 0";

if($id_estado_folio)
$sql.= " and estf.id_estado_folio = '$id_estado_folio' ";



$sql.= " and ef.ano between '$entreano1' and '$entreano2' order by nombre_alt, c.calibre, medpro.id_medidas_productos, ef.id_etiquetados_folios desc ";
				
$result=mysql_query($sql);	
$cuantos=mysql_num_rows($result);

//echo "CUANTOS $cuantos";
}


header("Content-Type: application/vnd.ms-excel");
//header("Expires: 0");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=etiquetas_folios.csv");

 
 
   $fpicking=format_fecha_sin_hora($row[fpicking]);
   $fanulado=format_fecha_sin_hora($row[fanulado]);
    $fbodega_mpi=format_fecha_sin_hora($row[fbodega_mpi]);

 echo "ID;Procedencia;Pedido;Pallet;Folio;Producto;Calibre;Unidad Medida;Medida;C/P;C/E;Contenido;F/Elabora;Fecha Inicio;Fecha Termino;Fecha Bodega de Traspaso;Fecha Reproceso;Fecha Despacho;Fecha Picking;Fecha Anulado;Fecha MTP;Factura Importada;N0 Bidon Importado;Factura Venta;Origen;Estado Material;Operador;Destinos;Ponderado;Guia Despacho;Cod M3\n";


 while ($row=mysql_fetch_array($result))
  {
 $id_etiquetados_folios=$row[id_etiquetados_folios];
 $id_m=$id_etiquetados_folios;
 $f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
 $f_inicio=format_fecha_sin_hora($row[f_inicio]);
 $f_termino=format_fecha_sin_hora($row[f_termino]);
 $fdespacho_piking=format_fecha_sin_hora($row[fdespacho_piking]);
 $freprocesado=format_fecha_sin_hora($row[freprocesado]);
 $fbodega_traspaso=format_fecha_sin_hora($row[fbodega_traspaso]);
 $fpicking=format_fecha_sin_hora($row[fpicking]);
 $fanulado=format_fecha_sin_hora($row[fanulado]);
 $fbodega_mpi=format_fecha_sin_hora($row[fbodega_mpi]);

 
 $producto=$row[producto];
 $facturav=$row[factura];
 $unidad_medida=$row[unidad_medida];
 $calibre=$row[calibre];
 $medidas_productos=$row[medidas_productos];
 $estado_folio=$row[estado_folio];
 $nombreop=$row[nombreop];
 $apellido=$row[apellido];
 $factura_importada=$row[factura_importada];
 $caract_producto=$row[caract_producto];
 $contenido_unidades=$row[contenido_unidades];
 $caract_envases=$row[caract_envases];
 $compro_nro=$row[compro_nro];
 $id_procedencia=$row[id_procedencia];
 $origenn=$row[origen];
 $total_ponderadoo=$row[total_ponderado];
 $id_cruce_tablass=$row[id_cruce_tablas];
 $destinos=$row[destinos];
 $guia_despacho_trazab=$row[guia_despacho_trazab];
 $bidon_importado=$row[bidon_importado];
 $id_pedidos=$row[id_pedidos];
 $pallett=$row[pallet];
 $folio_m3=$row[folio_m3];


  
echo "$id_cruce_tablass;$id_procedencia;$id_pedidos;$pallett;$id_m;$producto;$calibre;$unidad_medida;$medidas_productos ;$caract_producto;$caract_envases;$contenido_unidades;$f_elaboracion;$f_inicio;$f_termino;$fbodega_traspaso;$freprocesado;$fdespacho_piking;$fpicking;$fanulado;$fbodega_mpi;$factura_importada;$bidon_importado;$facturav;$origenn;$estado_folio;$nombreop;$destinos;$total_ponderadoo;$guia_despacho_trazab;$folio_m3\n";


  }
?>