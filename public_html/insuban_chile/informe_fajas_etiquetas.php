<?
ini_set('memory_limit', '-1');
$largod=strlen($desde);
$newanod=substr($desde, 0, 2);
$newanod="20".$newanod;
$newdatod=substr($desde, 2, $largod); 

$largoh=strlen($hasta);
$newanoh=substr($hasta, 0, 2);
$newanoh="20".$newanoh;
$newdatoh=substr($hasta, 2, $largoh); 


if($fecha_ingresod != '' and fecha_ingresoh != ''){
$fecha_ingresodesde=format_fecha_sin_hora($fecha_ingresod);
$fecha_ingresohasta=format_fecha_sin_hora($fecha_ingresoh);
}


$sql="select * from fajas as f, producto as p, origenes AS orig, bodegas AS b
where f.id_producto = p.id_producto and f.id_bodegas = b.id_bodegas and f.id_origen = orig.id_origen";
if($newdatod and $newdatoh)
$sql.= " and f.id_faja between '$newdatod' and '$newdatoh' and f.id_faja=f.id_faja ";
if($fecha_ingresodesde and $fecha_ingresohasta)
	$sql.= " and f.femision between '$fecha_ingresodesde' and '$fecha_ingresohasta' order by f.femision desc ";
if($id_producto)
	$sql.= " and p.id_producto = '$id_producto' ";
if($id_origen)
	$sql.= " and orig.id_origen = '$id_origen' ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
echo "cuantos $cuantos";
?>

<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="552" border="0" align="center">
  <tr>
    <td width="496" height="30" class="titulo">Fajas con Etiquetas </td>
    <td width="209" class="titulo"><? if($buscar){?>
      <a href="?modulo=informe_fajas_etiquetas.php"> Volver Fajas con Etiquetas </a>
      <?}?></td>
  </tr>
  <tr>
    <td colspan="2"><table width="600" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td><? if(!$buscar){?>
          <table width="520" border="0" align="center">
            <tr>
              <td><div align="left"><span class="titulo">Estado Folio </span></div></td>
              <td width="252"><div align="left">
                <? $estado_folio=crea_estado_folio($link,$id_estado_folio,0);
		echo $estado_folio;?>
              </div></td>
              <td width="290"><table width="234" border="0">
                <tr>
                  <td width="37"><a href="excel_fajasetiquetas.php" target="_blank"><img src="jpg/icono-excel.gif" width="33" height="33" border="0" /></a></td>
                  <td width="187"><a href="excel_fajasetiquetas.php" target="_blank"><span class="cajas">Exportar a Excel</span></a></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td class="titulo"><div align="left">Desde Folio </div></td>
              <td colspan="2"><div align="left">
                <input name="desde" type="text" class="cajas" id="desde" size="10" value="<? echo $desde ?>">
              </div></td>
            </tr>
            <tr>
              <td class="titulo"><div align="left">Hasta Folio </div></td>
              <td colspan="2"><div align="left">
                <input name="hasta" type="text" class="cajas" id="hasta" size="10" value="<? echo $hasta ?>">
              </div></td>
            </tr>
            <tr>
              <td class="titulo"><div align="left">Desde Fecha de Termino </div></td>
              <td colspan="2"><div align="left">
                <input name="fecha_ingresod" type="text" class="cajas"   id="fecha_ingresod"  value="<?echo $fecha_ingresod?>" size="10" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fecha_ingresod');" class="cajas"  >Ver</a></div></td>
            </tr>
            <tr>
              <td class="titulo"><div align="left">Hasta Fecha de Termino </div></td>
              <td colspan="2"><div align="left">
                <input name="fecha_ingresoh" type="text" class="cajas"   id="fecha_ingresoh"  value="<?echo $fecha_ingresoh?>" size="10" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fecha_ingresoh');" class="cajas"  >Ver</a><a href="javascript:show_Calendario('form1.hasta_fecha');" class="cajas"  ></a></div></td>
            </tr>
            <tr>
              <td class="titulo"><div align="left">Producto                </div></td>
              <td colspan="2"><div align="left">
                <? $producto= crea_producto($link,$id_producto);
		 echo $producto;?>
              </div></td>
            </tr>
            <tr>
              <td width="143" class="titulo"><div align="left">Origen                </div></td>
              <td colspan="2"><div align="left">
                <? 	$origen= crea_origenes($link,$row[id_origen]);
			echo $origen;?>
              </div></td>
            </tr>
            <tr>
              <td colspan="3"><div align="left">
                <input name="buscar" type="submit" value="Buscar" />
              </div></td>
            </tr>
        </table><? }?>
          <table width="497" height="78" border="0" align="center">
            <tr>
              <td height="74"><? if($buscar){?>
                <table width="693" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="61" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="center">N&ordm; Fajas</div></td>
                    <td width="26" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; Lote</td>
                    <td width="187" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
                    <td width="38" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Origen</td>
                    <td width="55" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F.Emisi&oacute;n</td>
                    <td width="43" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F.Venc.</td>
                    <td width="46" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F.Faena</td>
                    <td width="27" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Neto</td>
                    <td width="25" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Tara</td>
                    <td width="22" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Est.</td>
                    <td width="70" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Bodega</td>
                    <td width="67" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Fajas Emit. </td>
                  </tr>
                  <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_fajas=$row[id_fajas];
	$femision=format_fecha_sin_hora($row[femision]);
	$fvencimiento=format_fecha_sin_hora($row[fvencimiento]);
	$ffaena=format_fecha_sin_hora($row[ffaena]);
	$i++;
	?>
                  <tr>
                    <td nowrap="nowrap" class="cajas"><div align="center"><?php echo substr($row[ano],2,4); ?><? echo $row[id_faja];?></div></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[loten]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[producto]?></td>
                    <td nowrap="nowrap" class="cajas"><?echo $row[origen]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $femision?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $fvencimiento?></td>
                    <td nowrap="nowrap" class="cajas"><?echo $ffaena?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[neto]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[tara]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[estado]?></td>
                    <td nowrap="nowrap" class="cajas"><?echo $row[bodegas]?></td>
                    <td nowrap="nowrap" class="cajas"><?echo $row[fajas_emitidas]?></td>
                  </tr>
                  <? }?>
                </table>
                <? }?></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>