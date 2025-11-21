<?
	
if($fechainv){ $fechainvok=format_fecha_sin_hora($fechainv); }

if(!$fechainv){
$fechainv=date("Y-m-d"); 	
$fechainv=format_fecha_sin_hora($fechainv); 
}

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
AND ef.id_estado_folio = e.id_estado_folio
and ef.id_caract_producto not in (25,30) and ef.id_procedencia = 'N' and hipt.f_toma_inventario  = '$fechainvok'
group by ef.id_cruce_tablas order by p.producto asc";

//AND e.id_estado_folio != 7 and e.id_estado_folio != 5 and e.id_estado_folio != 6 and e.id_estado_folio != 10 and e.id_estado_folio != 9 and e.id_estado_folio != 4
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
//echo "sql $sql<br>";
?>
<h1>INVENTARIO PRODUCTO TERMINADO</h1>
<table width="1020" border="0">
  <tr>
    <td height="8" colspan="10"><input name="fechainv" type="text"    id="fechainv"  value="<?echo $fechainv?>" size="8" maxlength="10" />
      <a href="javascript:show_Calendario('form1.fechainv');" > Ver
        <input type="submit" name="buscarin" id="buscarin" value="Buscar" />
      </a>[Debe seleccionar una fecha seg&uacute;n inventario que desee obtener]</td>
  </tr> <? if($fechainv and $buscarin and $cuantos){?>
  <tr>
   
    <td height="19" colspan="9" bgcolor="#CCCCCC">&nbsp;</td>
    <td height="19" bgcolor="#CCCCCC"><center><a href="codphp/inventarios/excel_folios_pt.php?f_toma_inventariof=<? echo $fechainvok?>" target="_blank">EXPORTAR <img src="codphp/informes_pdf_excel/excel.png" width="18" height="18" border="0" /></a></center></td>
  </tr>
  
  <tr>
    <td width="23" height="19" nowrap="nowrap" bgcolor="#FF9933">&nbsp;</td>
    <td width="75" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CODIGO</strong></td>
    <td width="221" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="113" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="103" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;U/MEDIDA</strong></td>
    <td width="108" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;MEDIDA</strong></td>
    <td width="82" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/P</strong></td>
    <td width="74" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/E</strong></td>
    <td width="76" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;BIDONES</strong></td>
    <td width="101" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
  </tr>
  <?
 
  $i=0;
  $color = "#000000";$i = 0;
  while ($row=mysql_fetch_array($result))
    { 
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
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
  <tr>
    <td height="19" align="center" nowrap="nowrap" bgcolor="<? echo $color?>"><? echo $i?></td>
    <td align="center" bgcolor="<? echo $color?>">&nbsp;<? echo $id_cruce_tablas?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $producto?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $calibre?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $unidad_medida?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $medidas_productos?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $caract_producto?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $caract_envases?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $total_bidones?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $contenido_unidades?></td>
  </tr>
  <?
	$sumbidones= $sumbidones + $total_bidones;
	$sumcontenido= $sumcontenido + $contenido_unidades;
	}?>
  <tr>
    <td height="19" colspan="8" align="right" nowrap="nowrap" >TOTAL</td>
    <td >&nbsp;<? echo $sumbidones?></td>
    <td >&nbsp;<? echo $sumcontenido?></td>
  </tr>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="#FF9933">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CODIGO</strong></td>
    <td nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;U/MEDIDA</strong></td>
    <td nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;MEDIDA</strong></td>
    <td nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/P</strong></td>
    <td nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/E</strong></td>
    <td nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CAJAS</strong></td>
    <td nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
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
AND ef.id_estado_folio = e.id_estado_folio
and ef.id_caract_producto in (25,30)  and ef.id_procedencia = 'N' and hipt.f_toma_inventario  = '$fechainvok' group by ef.id_cruce_tablas order by p.producto asc";
//AND e.id_estado_folio != 7 and e.id_estado_folio != 5 and e.id_estado_folio != 6 and e.id_estado_folio != 10 and e.id_estado_folio != 9 and e.id_estado_folio != 4
$resultc=mysql_query($sqlc);
$cuantos=mysql_num_rows($resultc);

//echo "sqlc $sqlc<br>";
  
  $i=0;
  $color = "#000000";$i = 0;
  while ($rowc=mysql_fetch_array($resultc))
    { 
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
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
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td align="center" bgcolor="<? echo $color?>">&nbsp;<? echo $id_cruce_tablasc?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $productoc?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $calibrec?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $unidad_medidac?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $medidas_productosc?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $caract_productoc?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $caract_envasesc?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $total_bidonesc?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $contenido_unidadesc?></td>
  </tr>
  <?
	$sumbidonesc= $sumbidonesc + $total_bidonesc;
	$sumcontenidoc= $sumcontenidoc + $contenido_unidadesc;
	}?>
  <tr>
    <td height="19" colspan="8" align="right" nowrap="nowrap" >TOTAL</td>
    <td class="cajas">&nbsp;<? echo $sumbidonesc?></td>
    <td class="cajas">&nbsp;<? echo $sumcontenidoc?></td>
  </tr>
  <? }//if($fechainv and $buscarin){?>
</table>
