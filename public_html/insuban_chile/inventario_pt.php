<?
if($generar_inv_pt){
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
AND ef.id_procedencia ='N'";
$resultf=mysql_query($sqlf);

while ($rowf=mysql_fetch_array($resultf))
    { 
	
	$id_pt=$rowf[id_etiquetados_folios];
	$id_produc=$rowf[id_producto];
	$id_cod=$rowf[id_cruce_tablas];
	$id_estfolio=$rowf[id_estado_folio];
	//echo "id_pt $id_pt - id_produc $id_produc - id_cod $id_cod - id_estfolio $id_estfolio<br>";
	
	$f_toma_inventario=date("Y-m-d"); 
	$sql_invpt="insert into historial_inventario_pt (id_pt,id_produc,id_cod,id_estfolio,f_toma_inventario) values ($id_pt,$id_produc,$id_cod,$id_estfolio,'$f_toma_inventario')";
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
    <td bgcolor="#CCCCCC">FILTRO DE BUSQUEDA DE INVENTARIO DE PRODUCTO TERMINADO</td>
  </tr>
  <tr>
    <td><input name="fechainv" type="text" class="cajas"   id="fechainv"  value="<?echo $fechainv?>" size="7" maxlength="10" /><a href="javascript:show_Calendario('form1.fechainv');" ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" />
      <input type="submit" name="buscarin" id="buscarin" value="Buscar" />
    </a></td>
  </tr>
  <tr>
    <td>Nota: El inventario de PT incluye los estado de: Emitido, Bodega, Picking, Bodega de Traspaso</td>
  </tr>
</table>
<? if($fechainv and $buscarin){?>


<table width="762" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="10" bgcolor="#CCCCCC" class="titulo">INVENTARIO DE PT</td>
  </tr>
  <tr class="titulo">
    <td>&nbsp;</td>
    <td>CODIGO</td>
    <td>PRODUCTO</td>
    <td>CALIBRE</td>
    <td>U/MEDIDA</td>
    <td>MEDIDA</td>
    <td>C/P</td>
    <td>C/E</td>
    <td>BIDONES</td>
    <td>CONTENIDO</td>
  </tr>
  <?
  $sql="SELECT count(DISTINCT ef.id_etiquetados_folios) AS total_bidones, SUM(ef.contenido_unidades)AS contenido_unidades, p.producto AS producto, cru.id_cruce_tablas AS id_cruce_tablas, c.calibre AS calibre, um.unidad_medida AS unidad_medida, mpro.medidas_productos AS medidas_productos, carpro.caract_producto AS caract_producto, carenv.caract_envases AS caract_envases FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, estado_folio AS e, origenes AS orig, procedencia AS proce, cruce_tablas AS cru, historial_inventario_pt AS hipt
WHERE ef.id_etiquetados_folios = hipt.id_pt 
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
AND e.id_estado_folio != 7 and e.id_estado_folio != 5 and e.id_estado_folio != 6 and e.id_estado_folio != 10 and e.id_estado_folio != 9 and e.id_estado_folio != 4 and ef.id_caract_producto != 25  and ef.id_procedencia = 'N' and hipt.f_toma_inventario  = '$fechainvok'
group by ef.id_cruce_tablas order by p.producto asc";
$result=mysql_query($sql);
//echo "sql $sql<br>";
  
  $i=0;
  while ($row=mysql_fetch_array($result))
    { 
	$i++;
	$id_cruce_tablas=$row[id_cruce_tablas];
	$producto=$row[producto];
	$calibre=$row[calibre];
	$unidad_medida=$row[unidad_medida];
	$medidas_productos=$row[medidas_productos];
	$caract_producto=$row[caract_producto];
	$caract_envases=$row[caract_envases];
	$total_bidones=$row[total_bidones];
	$contenido_unidades=$row[contenido_unidades];
	
  
  ?>
  <tr class="cajas">
    <td>&nbsp;<? echo $i?></td>
    <td align="center">&nbsp;<? echo $id_cruce_tablas?></td>
    <td>&nbsp;<? echo $producto?></td>
    <td>&nbsp;<? echo $calibre?></td>
    <td>&nbsp;<? echo $unidad_medida?></td>
    <td>&nbsp;<? echo $medidas_productos?></td>
    <td>&nbsp;<? echo $caract_producto?></td>
    <td>&nbsp;<? echo $caract_envases?></td>
    <td>&nbsp;<? echo $total_bidones?></td>
    <td>&nbsp;<? echo $contenido_unidades?></td>
  </tr>
    <?
	$sumbidones= $sumbidones + $total_bidones;
	$sumcontenido= $sumcontenido + $contenido_unidades;
	}?>
  <tr class="cajas">
    <td colspan="8">TOTAL</td>
    <td>&nbsp;<? echo $sumbidones?></td>
    <td>&nbsp;<? echo $sumcontenido?></td>
  </tr>
 </table>
  <? } ?>
<? if($fechainv and $buscarin){?>
<table width="762" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="10" bgcolor="#CCCCCC" class="titulo">INVENTARIO DE CAJAS</td>
  </tr>
  <tr class="titulo">
    <td>&nbsp;</td>
    <td>CODIGO</td>
    <td>PRODUCTO</td>
    <td>CALIBRE</td>
    <td>U/MEDIDA</td>
    <td>MEDIDA</td>
    <td>C/P</td>
    <td>C/E</td>
    <td>CAJAS</td>
    <td>CONTENIDO</td>
  </tr>
  <?
  
  $sqlc="SELECT count(DISTINCT ef.id_etiquetados_folios) AS total_bidonesc, SUM(ef.contenido_unidades)AS contenido_unidadesc, p.producto AS productoc, ef.id_cruce_tablas AS id_cruce_tablasc, c.calibre AS calibrec, um.unidad_medida AS unidad_medidac, mpro.medidas_productos AS medidas_productosc, carpro.caract_producto AS caract_productoc, carenv.caract_envases AS caract_envasesc FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, estado_folio AS e, origenes AS orig, procedencia AS proce, historial_inventario_pt AS hipt
WHERE ef.id_etiquetados_folios = hipt.id_pt 
AND ef.id_producto = p.id_producto
AND ef.id_medidas_productos = mpro.id_medidas_productos
AND ef.id_calibre = c.id_calibre
AND ef.id_procedencia = proce.id_procedencia
AND ef.id_estado_folio = e.id_estado_folio
AND ef.id_unidad_medida = um.id_unidad_medida
AND ef.id_caract_producto = carpro.id_caract_producto
AND ef.id_caract_envases = carenv.id_caract_envases
AND ef.id_origen = orig.id_origen
AND e.id_estado_folio != 7 and e.id_estado_folio != 5 and e.id_estado_folio != 6 and e.id_estado_folio != 10 and e.id_estado_folio != 9 and e.id_estado_folio != 4 and ef.id_caract_producto = 25  and ef.id_procedencia = 'N' and hipt.f_toma_inventario  = '$fechainvok' group by ef.id_cruce_tablas order by p.producto asc";
$resultc=mysql_query($sqlc);
$cuantos=mysql_num_rows($resultc);

//echo "sqlc $sqlc<br>";
  
  $i=0;
 // echo "cuantos $cuantos<br>";
  while ($rowc=mysql_fetch_array($resultc))
    { 
	$i++;
	$id_cruce_tablasc=$rowc[id_cruce_tablasc];
	$productoc=$rowc[productoc];
	$calibrec=$rowc[calibrec];
	$unidad_medidac=$rowc[unidad_medidac];
	$medidas_productosc=$rowc[medidas_productosc];
	$caract_productoc=$rowc[caract_productoc];
	$caract_envasesc=$rowc[caract_envasesc];
	$total_bidonesc=$rowc[total_bidonesc];
	$contenido_unidadesc=$rowc[contenido_unidadesc];
	
  
  ?>
  <tr class="cajas">
    <td>&nbsp;<? echo $i?></td>
    <td align="center">&nbsp;<? echo $id_cruce_tablasc?></td>
    <td>&nbsp;<? echo $productoc?></td>
    <td>&nbsp;<? echo $calibrec?></td>
    <td>&nbsp;<? echo $unidad_medidac?></td>
    <td>&nbsp;<? echo $medidas_productosc?></td>
    <td>&nbsp;<? echo $caract_productoc?></td>
    <td>&nbsp;<? echo $caract_envasesc?></td>
    <td>&nbsp;<? echo $total_bidonesc?></td>
    <td>&nbsp;<? echo $contenido_unidadesc?></td>
  </tr>
  <?
	$sumbidonesc= $sumbidonesc + $total_bidonesc;
	$sumcontenidoc= $sumcontenidoc + $contenido_unidadesc;
	}?>
  <tr class="cajas">
    <td colspan="8">TOTAL</td>
    <td>&nbsp;<? echo $sumbidonesc?></td>
    <td>&nbsp;<? echo $sumcontenidoc?></td>
  </tr>
</table>
<? }?>

<? if($fechainv and $buscarin){?>
<table width="762" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td><!--<a href="excel_pt.php?f_toma_inventariof=<? //echo $fechainvok?>" target="_blank">EXPORTAR A EXCEL</a>--> / <a href="excel_folios_pt.php?f_toma_inventariof=<? echo $fechainvok?>" target="_blank">HISTORIAL DE FOLIOS AL <? echo $fechainvok?></a></td>
   
  </tr>
</table>
<? }?>
</form>
