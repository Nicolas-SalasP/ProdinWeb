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
<table width="838" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="834" bgcolor="#CCCCCC">OBTENER PRODUCCION POR MES</td>
  </tr>
  <tr>
    <td><input name="fecha_terminod" type="text" class="cajas"   id="fecha_terminod"  value="<?echo $fecha_terminod?>" size="7" maxlength="10" /><a href="javascript:show_Calendario('form1.fecha_terminod');" class="cajas"  ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a>&nbsp;&nbsp;&nbsp;
      <input name="fecha_terminoh" type="text" class="cajas"   id="fecha_terminoh"  value="<?echo $fecha_terminoh?>" size="7" maxlength="10" /><a href="javascript:show_Calendario('form1.fecha_terminoh');" ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a>&nbsp;&nbsp;&nbsp;
      <input type="submit" name="buscarin" id="buscarin" value="Buscar" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Nota:<br> - El informe entregado incluye PT en los siguientes estados: Emitido, Bodega, Picking, Bodega de Traspaso, Despachos, Reprocesados. <br> 
    -  Los folios reprocesados entre las fechas  <? echo $fecha_terminod?> y <? echo $fecha_terminoh?> son descontados automaticamente por sistema.</td>
  </tr>
</table>
<? if($buscarin){?>


<table width="838" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="9" bgcolor="#CCCCCC" class="titulo">INVENTARIO DE PT</td>
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
    <td>CONTENIDO</td>
    </tr>
  <?
  
  if($fecha_terminod and $fecha_terminoh)
    {
    $fecha_ingresodesde=format_fecha_sin_hora($fecha_terminod);
    $fecha_ingresohasta=format_fecha_sin_hora($fecha_terminoh);
    }
	
$sqlf="SELECT count(DISTINCT ef.id_etiquetados_folios) AS total_bidones, SUM(contenido_unidades) AS contenido_unidades, ef.id_etiquetados_folios AS id_etiquetados_folios, p.producto AS producto, ef.id_cruce_tablas AS id_cruce_tablas, c.calibre AS calibre, um.unidad_medida AS unidad_medida, mpro.medidas_productos AS medidas_productos, carpro.caract_producto AS caract_producto, carenv.caract_envases AS caract_envases FROM producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, etiquetados_folios AS ef WHERE ef.id_etiquetados_folios = ef.id_etiquetados_folios AND ef.id_producto = p.id_producto AND ef.id_medidas_productos = mpro.id_medidas_productos AND ef.id_calibre = c.id_calibre AND ef.id_unidad_medida = um.id_unidad_medida AND ef.id_caract_producto = carpro.id_caract_producto AND ef.id_caract_envases = carenv.id_caract_envases and ef.id_estado_folio != 5 and ef.id_estado_folio != 10 and ef.id_estado_folio != 9 and ef.id_estado_folio != 0 and ef.id_estado_folio != 8 and ef.id_estado_folio != 4 and ef.id_procedencia = 'N' and ef.f_termino between '$fecha_ingresodesde' and '$fecha_ingresohasta' group by ef.id_cruce_tablas order by p.producto asc";
$resultf=mysql_query($sqlf);
$cuantoshay=mysql_num_rows($resultf);
  
  $i=0;
  while ($row=mysql_fetch_array($resultf))
    { 
	$i++;
	$id_cruce_tablas=$row[id_cruce_tablas];
	$producto=$row[producto];
	$calibre=$row[calibre];
	$unidad_medida=$row[unidad_medida];
	$medidas_productos=$row[medidas_productos];
	$caract_producto=$row[caract_producto];
	$caract_envases=$row[caract_envases];
	$contenido_unidades5=$row[contenido_unidades];
	
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
    <td>&nbsp;&nbsp;<? 
	
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
		
		if($id_cruce_tablas == $id_cruce_tablasrep)
		{
				$contenido_unidades5 = $contenido_unidades5 - $contenido_unidadesrep;
				echo $contenido_unidades5;

				
		}//if($id_cruce_tablas == $id_cruce_tablasrep)
		}else{
	
        echo "$contenido_unidades5";	
}
//echo "$contenido_unidades5";
	?></td>
    </tr>
    <?
	//$sumconte = $sumconte + $contenidototal;
	//$sumbidones= $sumbidones + $total_bidones;
	
	}
	
	?>
  <tr class="cajas">
    <td colspan="8">TOTAL</td>
    <td>&nbsp;</td>
    </tr>
 </table>
  <? } ?>
<?  
if($fecha_ingresodesde != 0)
    { ?>
 
<table width="838" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <a href="excel_produccion_por_mes.php?fecha_ingresodesde=<? echo $fecha_ingresodesde?>&fecha_ingresohasta=<?echo $fecha_ingresohasta;?>" target="_blank"><img src="jpg/exportarExcelBtn.png" width="100" height="30" border="0" align="right" /></a></td>
  </tr>
</table>
  <?}?>
</form>
