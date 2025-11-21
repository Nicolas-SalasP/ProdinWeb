<?
if($generar_inv_imp){
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
	
	}//

if($buscarin){
	
	
if($fechainv){ $fechainvok=format_fecha_sin_hora($fechainv); }
	

}


?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style2 {font-size: 14px}
.style3 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<form id="form1" name="form1" method="post" action="">
<?

if(!$fechainv){
$fechainv=date("Y-m-d"); 	
$fechainv=format_fecha_sin_hora($fechainv); 
}
?>
<table width="763" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC">FILTRO DE BUSQUEDA DE INVENTARIO DE MATERIA PRIMA IMPORTADA</td>
  </tr>
  <tr>
    <td><input name="fechainv" type="text" class="cajas"   id="fechainv"  value="<?echo $fechainv?>" size="7" maxlength="10" />
      <a href="javascript:show_Calendario('form1.fechainv');" ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" />
        <input type="submit" name="buscarin" id="buscarin" value="Buscar" />
      </a></td>
  </tr>
  <tr>
    <td>Nota: El inventario de MPI incluye los estado de: Emitido, Bodega, Picking, Bodega de Traspaso</td>
  </tr>
</table>
<? if($fechainv and $buscarin){?>
<table width="762" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="11"><span class="titulo">INVENTARIO DE MPI</span></td>
  </tr>
  <tr class="titulo">
    <td>ORIGEN</td>
    <td>CODIGO</td>
    <td>PRODUCTO</td>
    <td>CALIBRE</td>
    <td>U/MEDIDA</td>
    <td>MEDIDA</td>
    <td>C/P</td>
    <td>C/E</td>
    <td>F/Importada</td>
    <td>BIDONES</td>
    <td>CONTENIDO</td>
  </tr>
  <?
  $sql="SELECT count(DISTINCT ef.id_etiquetados_folios) AS total_bidones, SUM(ef.contenido_unidades)AS contenido_unidades, p.producto AS producto, ef.id_cruce_tablas AS id_cruce_tablas, c.calibre AS calibre, um.unidad_medida AS unidad_medida, mpro.medidas_productos AS medidas_productos, carpro.caract_producto AS caract_producto, carenv.caract_envases AS caract_envases, orig.origen AS origen, ef.factura_importada AS factura_importada FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, estado_folio AS e, origenes AS orig, procedencia AS proce,  cruce_tablas AS cru, historial_inventario_mpi AS himpi
WHERE ef.id_etiquetados_folios = himpi.id_pti 
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
AND ef.id_procedencia = 'I' and himpi.f_toma_inventarioi  = '$fechainvok' group by ef.factura_importada  order by p.producto asc";
$result=mysql_query($sql);
//echo "sql $sql<br>";
  
  $i=0;
  while ($row=mysql_fetch_array($result))
    { 
	$i++;
	$id_cruce_tablas=$row[id_cruce_tablas];
	$producto=$row[producto];
	$factura_importada=$row[factura_importada];
	$origen=$row[origen];
	$calibre=$row[calibre];
	$unidad_medida=$row[unidad_medida];
	$medidas_productos=$row[medidas_productos];
	$caract_producto=$row[caract_producto];
	$caract_envases=$row[caract_envases];
	$total_bidones=$row[total_bidones];
	$contenido_unidades=$row[contenido_unidades];
	
  
  ?>
  <tr class="cajas">
    <td>&nbsp;<? echo $origen?></td>
    <td align="center">&nbsp;<? echo $id_cruce_tablas?></td>
    <td>&nbsp;<? echo $producto?></td>
    <td>&nbsp;<? echo $calibre?></td>
    <td>&nbsp;<? echo $unidad_medida?></td>
    <td>&nbsp;<? echo $medidas_productos?></td>
    <td>&nbsp;<? echo $caract_producto?></td>
    <td>&nbsp;<? echo $caract_envases?></td>
    <td>&nbsp;<? echo $factura_importada?></td>
    <td>&nbsp;<? echo $total_bidones?></td>
    <td>&nbsp;<? echo $contenido_unidades?></td>
  </tr>
    <?
	$sumbidones= $sumbidones + $total_bidones;
	$sumcontenido= $sumcontenido + $contenido_unidades;
	}?>
  <tr class="cajas">
    <td colspan="9">TOTAL</td>
    <td>&nbsp;<? echo $sumbidones?></td>
    <td>&nbsp;<? echo $sumcontenido?></td>
  </tr>

</table>
<? }?>
<? if($fechainv and $buscarin){?>
<table width="762" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td><!--<a href="excel_mpi.php?f_toma_inventariof=<? //echo $fechainvok?>" target="_blank">EXPORTAR A EXCEL</a>--> / <a href="excel_folios_mpi.php?f_toma_inventariof=<? echo $fechainvok?>" target="_blank">HISTORIAL DE FOLIOS AL <? echo $fechainvok?></a></td>
  </tr>
</table>
<? }?>
</form>