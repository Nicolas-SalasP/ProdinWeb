<h1> MATERIA PRIMA <? if($fresca =='N'){ ?>FRESCA<? } if($salada == 'I'){?>SALADA<? } ?></h1>
<? if($fresca == 'N'){ 
/*
$sql="SELECT * FROM mat_prima_nacional AS mpn, producto AS p,origenes AS org, estado_material AS est  WHERE mpn.id_producto = p.id_producto and mpn.comprobante_num = $comprobante_num and mpn.id_origen = org.id_origen and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material ";
$sql="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre ,org.origen AS origen, org.id_origen AS id_origen, mpn.contenido AS contenido, mpn.comprobante_num AS comprobante_num, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, est.estado_material AS estado_material FROM mat_prima_nacional AS mpn, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpn.id_producto = pro.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material and mpn.id_estado_material != 0 ";*/

$sql="SELECT * FROM mat_prima_nacional AS mpn, producto AS p,origenes AS org, estado_material AS est  
WHERE mpn.id_producto = p.id_producto 
and mpn.id_origen = org.id_origen 
and mpn.id_estado_material = est.id_estado_material";

if($comprobante_num){$sql.= " and mpn.comprobante_num = '$comprobante_num' ";}
if($id_origen){$sql.= " and mpn.id_origen = '$id_origen' ";}
if($factura_mp){$sql.= " and mpn.factura_mp = '$factura_mp' ";}
$sql.= " order by mpn.id_mat_prima_nacional desc ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
//echo "cuantos $cuantos <br>";
//echo "SQL $sql";
?>
<table width="100%" border="0">
<tr>
    <td width="21" height="19" bgcolor="#FF9933">&nbsp;</td>
<?if ($id_origen == 21) {?> <td colspan="12" bgcolor="#CCCCCC">&nbsp;<strong>N&deg; Comprobante: <?echo $comprobante_num?> Bidones: <?echo $cuentabidones?> Unidades: <? echo $contenido?></strong></td> 
<?}else{?>
<td colspan="11" bgcolor="#CCCCCC">&nbsp;<strong>N&deg; Comprobante: <?echo $comprobante_num?> Bidones: <?echo $cuentabidones?> Unidades: <? echo $contenido?></strong></td><?}?>
  </tr>
  <tr>
    <td width="21" height="19" bgcolor="#FF9933"><center><strong>N&ordm;</strong></center></td>
    <td width="68" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="179" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="96" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="144" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="107" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="98" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
<?if ($id_origen == 21 or $id_origen == 1000019) {?> <td width="100" bgcolor="#FF9933"><strong>&nbsp;LOTE_TRAZAB.</strong></td>   <?}?>
    <td width="20" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="19" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="39" bgcolor="#FF9933"><strong>&nbsp;F/TERMINO</strong></td>
    <td width="72" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="74" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
  </tr>
   <?
   $i=$op;
   $color = "#000000";$i = 0;
   while ($row=mysql_fetch_array($result))
   {
   $i++;
    $color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
    $id_origen=$row[id_origen];
	$id_producto=$row[id_producto];
	$id_calibren=$row[id_calibre];
	$id_solicitud_mp=$row[id_solicitud_mp];
    $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);
    $fecha_termino=format_fecha_sin_hora($row[fecha_termino]);
    $fecha_venci=format_fecha_sin_hora($row[fecha_venci]);
    
	$contenido=$row[contenido];
	
    if($id_solicitud_mp){
	$color = ($color == "#FFFF00") ? "#FFFF00" : "#FFFF00";
	}else{
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	}
	
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpfresca.php&id_mat_prima_nacional=<? echo $id_mat_prima_nacional?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&fresca=<? echo N?>">F<? echo $row[id_mat_prima_nacional]?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibren){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $row[contenido]?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $row[bidon_num]?></center></td>
<?if ($id_origen == 21 or $id_origen == 1000019) {?> <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[lote_trazabilidad]?></td>  <?}?>  
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_faena?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_termino?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_venci?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[estado_material]?></td>
	<? 
	 $contenidototal =$contenidototal + $contenido;
	} ?>
  </tr>
  <tr> 
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">TOTAL</td>
    <td align="center" bgcolor="#CCCCCC"><strong><? echo $contenidototal?></strong></td>
    <td align="right">&nbsp;</td>
    <td colspan="3" align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
 </table>
<? } ?>
<? if($salada == 'I'){ 

$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.etiquetados_folios_id AS etiquetados_folios_id, pro.producto AS producto,pro.id_producto AS id_producto,c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpi.contenido AS contenido, mpi.comprobante_num AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_ingreso AS fecha_ingreso, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, est.estado_material AS estado_material, mpi.folio_m3_mpi as folio_m3_mpi FROM mat_prima_importada AS mpi, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpi.id_producto = pro.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material and mpi.id_estado_material != 0 ";

if($comprobante_num){$sqli.= " and mpi.comprobante_num = '$comprobante_num'";}
if($factura_mp){$sqli.= " and mpi.guia_imp = '$factura_mp'";}
$sqli.= " order by mpi.id_mat_prima_importada desc";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);

//echo "sql2 $sqli";
?>
<table width="100%" border="0">
  <tr>
    <td width="21" height="19" bgcolor="#FF9933">&nbsp;</td>
    <td colspan="9" bgcolor="#CCCCCC">&nbsp;<strong>N&deg; Comprobante: <?echo $comprobante_num?> Bidones: <?echo $cuentabidones?> Unidades: <? echo $contenido?></strong></td>
  </tr>
  <tr>
    <td width="21" height="19" bgcolor="#FF9933"><center>
      <strong>N&ordm;</strong>
    </center></td>
    <td width="68" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="179" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="96" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="144" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="107" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="98" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <td width="80" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="72" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="74" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
  </tr>
  <?
   $i=$op;
   $color = "#000000";$i = 0;
   while ($rowi=mysql_fetch_array($resulti))
   {
  $i++;
  $color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
  $folio_m3_mpi=$rowi[folio_m3_mpi];
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$id_origen=$rowi[id_origen];
	$id_producto=$rowi[id_producto];
	$id_calibrei=$rowi[id_calibre];
  $fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);
  $fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
  $fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);
	$contenidoi=$rowi[contenido];
	
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo I?>"><!-- S --><? 
	 //if($etiquetados_folios_id)
	 //{
	  //echo "$etiquetados_folios_id";
	// }else{
		 $largo=strlen($id_mat_prima_importada);
	 
	 
	 if($etiquetados_folios_id)
	 {
	  $id=$etiquetados_folios_id;
	 }else{
	 if($largo == 9){
	 $id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 }
   $id=$folio_m3_mpi;
//	 $id=$id_mat_prima_importada;
	 }//if($etiquetados_folios_id)
	 	echo $id;
	 //}//if($etiquetados_folios_id)?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibrei){ echo "Original"; }else{echo "$rowi[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_vencimiento?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[estado_material]?></td>
    <? 
	 $contenidototali+=$contenidoi;
	} ?>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">TOTAL</td>
    <td align="center" bgcolor="#CCCCCC"><strong><? echo $contenidototali?></strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<? } ?>
