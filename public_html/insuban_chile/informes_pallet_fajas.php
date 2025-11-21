
<?



$largod=strlen($desde);
$newanod=substr($desde, 0, 1);
$newanod="20".$newanod;
$newdatod=substr($desde, 1, $largod); 
//echo "$newdatod<br>";
$largoh=strlen($hasta);
$newanoh=substr($hasta, 0, 1);
$newanoh="20".$newanoh;
$newdatoh=substr($hasta, 1, $largoh); 
//echo "$newdatoh<br>";
if($fecha_ingresod != '' )
$fecha_ingresodesde=format_fecha_sin_hora($fecha_ingresod);

if ($fecha_ingresoh != '')
$fecha_ingresohasta=format_fecha_sin_hora($fecha_ingresoh);




?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.Estilo3 {font-size: 12px}
.Estilo5 {font-size: 12px; font-weight: bold; }
-->
</style>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<form id="form1" name="form1" method="post" action="">
<table width="1026" border="0" align="center">
  <tr>
    <td width="757" height="30" class="titulo">Informe Pallet con Fajas </td>
    <td width="265" class="titulo">
      <? if($buscar){?><a href="?modulo=informes_pallet_fajas.php">
Volver Informe Pallet con Fajas </a>
      <?}?></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$buscar){?>
      <table width="1023" border="1" bordercolor="#CCCCCC">
        <tr>
          <td width="1013">
		  
		  <table width="1016" border="0">
          <tr>
            <td width="300" class="titulo">Estado Pallet </td>
            <td width="303" class="cajas"><? 
		 	$estado_pallet= crea_estado_pallets_informe($link,$id_estado_pallet);
			echo $estado_pallet;
			?></td>
            <td width="399" class="cajas">&nbsp;</td>
          </tr>
          <tr>
            <td><span class="titulo">Desde Pallet </span></td>
            <td colspan="2"><input name="desde" type="text" class="cajas" id="desde" size="10" value="<? echo $desde ?>" /></td>
          </tr>
          <tr>
            <td><span class="titulo">Hasta Pallet </span></td>
            <td colspan="2"><input name="hasta" type="text" class="cajas" id="hasta" size="10" value="<? echo $hasta ?>" /></td>
          </tr>
          <tr>
            <td class="titulo">Desde Fecha Pallet              </td>
            <td colspan="2"><input name="fecha_ingresod" type="text" class="cajas"   id="fecha_ingresod"  value="<?echo $fecha_ingresod?>" size="10" maxlength="10" />
              <a href="javascript:show_Calendario('form1.fecha_ingresod');" class="cajas"  >Ver</a></td>
          </tr>
          <tr>
            <td class="titulo">Hasta fecha Pallet </td>
            <td colspan="2"><input name="fecha_ingresoh" type="text" class="cajas"   id="fecha_ingresoh"  value="<?echo $fecha_ingresoh?>" size="10" maxlength="10" />
              <a href="javascript:show_Calendario('form1.fecha_ingresoh');" class="cajas"  >Ver</a></td>
          </tr>
          <tr>
            <td class="titulo">Producto</td>
            <td colspan="2"><? 
		 	
			$producto= crea_producto($link,$id_producto);
			echo $producto;
			?></td>
          </tr>
          <tr>
            <td colspan="3" class="titulo">Busqueda de Pallet con Fajas Personalizados </td>
          </tr>
          <tr>
            <td colspan="3"><textarea name="folios" cols="30" rows="3" id="folios"></textarea></td>
          </tr>
          <tr>
            <td colspan="3"><input name="buscar" type="submit" value="Buscar" /></td>
          </tr>
        </table>
		<? }?>
		<table width="1014" border="0" align="center">
            <tr>
                <td><? if($buscar and $folios){?>
                  <table width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="6%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm;Pallet </td>
                      <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F Pallet </td>
                      <td width="5%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Faja</td>
                      <td width="6%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Lote</td>
                      <td width="8%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
                      <td nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Origen</td>
                      <td width="9%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Faena </td>
                      <td width="8%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Emisi&oacute;n </td>
                      <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Venc.</td>
                      <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="center">Neto</div></td>
                      <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Bodega</td>
                      <td width="8%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Despacho </td>
                      <td width="2%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Estado</td>
                      <td width="3%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Destino</td>
                    </tr>
                    <?  
		
      $dat=split("\n",$folios);
	  $c=count($dat);
 	  
	for ($i=0; $i<=$c;$i++)
	  { 
	   if ($dat[$i] != "")
	   {
	     $id_f=$dat[$i];


$sql="select f.ano,fp.id_fajapallet,fp.fpallet,f.id_faja,f.loten,p.nombre AS nombreproducto,f.ffaena,f.femision,f.fvencimiento,f.neto,b.bodegas,fp.fdespacho,ep.estado_pallet, d.nombre AS nombredestinos 
 from fajapallet AS fp,fajas AS f , producto AS p, bodegas AS b, estado_pallet AS ep, destinos AS d
 where fp.id_fajapallet = $id_f	
 and fp.id_fajapallet=f.id_fajapallet and f.id_producto=p.id_producto 
 and fp.id_bodegas=b.id_bodegas and fp.id_estado_pallet = ep.id_estado_pallet 
 and fp.id_destinos = d.id_destinos
 ";

if($id_estado_pallet)
	$sql.= " and ep.id_estado_pallet = '$id_estado_pallet' ";
if($id_producto)
	$sql.= " and p.id_producto = '$id_producto'  ";
if($fecha_ingresodesde)
$sql.= " and  fp.fpallet >= '$fecha_ingresodesde'  ";
if($fecha_ingresohasta)
$sql.= " and  fp.fpallet <= '$fecha_ingresohasta' ";
if($id_destinos)
	$sql.= " and d.id_destinos = '$id_destinos' ";
if($newdatod and $newdatoh)
$sql.= " and fp.id_fajapallet  between '$newdatod' and '$newdatoh' and fp.id_fajapallet =fp.id_fajapallet  ";

$sql.= " order by fp.id_fajapallet,f.id_faja ";
$result=mysql_query($sql);
	  
	          while ($row=mysql_fetch_array($result)) 
		       {
			   $fpallet=format_fecha($row[fpallet]);
			   $femision=format_fecha($row[femision]);
			   $fvencimiento=format_fecha($row[fvencimiento]);
			   $fdespacho=format_fecha($row[fdespacho]);
			    $ffaena=format_fecha($row[ffaena]);
	?>
                    <tr>
                      <td nowrap="nowrap" class="cajas"><?php echo substr($row[ano],2,4); ?><?echo $row[id_fajapallet]?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $fpallet?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<? echo substr($row[ano],2,4);?><?echo $row[id_faja]?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[loten]?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[nombreproducto]?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[origen]?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><?echo $ffaena?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $femision?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $fvencimiento?></td>
                      <td nowrap="nowrap" class="cajas"><div align="center">&nbsp;<?echo $row[neto]?></div></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[bodegas]?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $fdespacho?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[estado_pallet]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[nombredestinos]?></td>
                    </tr>
                    <? } // while r
			  } //for ($i=0; $i<=$c;$i++)
			  } //if ($dat[$i] != "")
	          ?>
                  </table>
                  <? } //fin Buscar
			if($buscar and !$folios){
			?>
                  <table width="48" border="0">
                    <tr>
                      <td width="42"><a href="excel_pallet_faja.php?id_estado_pallet=<?echo $id_estado_pallet?>&id_producto=<?echo $id_producto?>&desdereci=<?echo $newdatod?>&hastareci=<?echo $newdatoh?>&fecha_ingresod=<?echo fecha_ingresod?>&fecha_ingresoh=<?echo fecha_ingresoh?>" target="_blank"><img src="jpg/icono-excel.gif" width="33" height="33" border="0" /></a></td>
                      </tr>
                  </table>
                  <table width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="6%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm;Pallet </td>
                      <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F Pallet </td>
                      <td width="5%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Faja</td>
                      <td width="6%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Lote</td>
                      <td width="8%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
                      <td nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Origen</td>
                      <td nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Faena </td>
                      <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Emisi&oacute;n </td>
                      <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Venc.</td>
                      <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="center">Neto</div></td>
                      <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Bodega</td>
                      <td width="8%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Despacho </td>
                      <td width="2%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Estado</td>
                      <td width="3%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Destino</td>
                    </tr>
                    <?  
$sql="select fp.ano_fajapallet,f.femision,fp.id_fajapallet,fp.fpallet,f.id_faja,f.loten,p.nombre AS nombreproducto,f.ffaena,f.femision,f.fvencimiento,f.neto,b.bodegas,fp.fdespacho,ep.estado_pallet,orig.origen 
 from fajapallet AS fp,fajas AS f , producto AS p, bodegas AS b, estado_pallet AS ep, origenes AS orig
 where 
 fp.id_fajapallet = fp.id_fajapallet
 and fp.id_fajapallet=f.id_fajapallet 
 and f.id_producto=p.id_producto 
 and fp.id_bodegas=b.id_bodegas
 and orig.id_origen=f.id_origen
 and fp.id_estado_pallet = ep.id_estado_pallet  ";

if($id_estado_pallet)
	$sql.= " and ep.id_estado_pallet = '$id_estado_pallet' ";
if($id_producto)
	$sql.= " and p.id_producto = '$id_producto'  ";
if($fecha_ingresodesde)
$sql.= " and  fp.fpallet >= '$fecha_ingresodesde'  ";
if($fecha_ingresohasta)
$sql.= " and  fp.fpallet <= '$fecha_ingresohasta' ";
if($id_destinos)
	$sql.= " and d.id_destinos = '$id_destinos' ";
if($newdatod and $newdatoh)
$sql.= " and fp.id_fajapallet  between '$newdatod' and '$newdatoh' and fp.id_fajapallet =fp.id_fajapallet  ";

$sql.= " and fp.ano_fajapallet  = '2009' order by fp.id_fajapallet,f.id_faja ";
$result=mysql_query($sql);
//echo $sql;
$cuantos=mysql_num_rows($result);

			  while ($row=mysql_fetch_array($result)) 
		       {
			   $fpallet=format_fecha($row[fpallet]);
			   $femision=format_fecha($row[femision]);
			   $fvencimiento=format_fecha($row[fvencimiento]);
			   $fdespacho=format_fecha($row[fdespacho]);
			   $ffaena=format_fecha($row[ffaena]);
	?>
                    <tr>
                      <td nowrap="nowrap" class="cajas"><?php echo substr($row[ano_fajapallet],2,2); ?><?echo $row[id_fajapallet]?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><?echo $fpallet?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><? echo substr($row[femision],2,2);?><?echo $row[id_faja]?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[loten]?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[nombreproducto]?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[origen]?>&nbsp;</td>
                      <td width="8%" nowrap="nowrap" class="cajas"><?echo $ffaena?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><?echo $femision?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><?echo $fvencimiento?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><div align="center">&nbsp;<?echo $row[neto]?>&nbsp;</div></td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[bodegas]?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><?echo $fdespacho?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[estado_pallet]?>&nbsp;</td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[nombredestinos]?></td>
                    </tr>
                    <? } // while r
			 
	          ?>
                  </table>
                  <? }?></td>
            </tr>
            </table></td>
      </tr>
      </table></td></tr>
</table>
</form>