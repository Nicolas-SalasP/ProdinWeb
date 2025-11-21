<?

//echo "id_mat_prima_nacional $id_mat_prima_nacional<br>";

if(!$year){ $year=$fhoy=date("Y");	}
if($buscar or $id_producto){

if($fid) { $fidok=format_fecha_sin_hora($fid); }
if($fih) { $fihok=format_fecha_sin_hora($fih); }
if($id_procedencia == "N"){
$sql="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, mpn.id_solicitud_mp AS id_solicitud_mp,pro.producto AS producto,pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpn.contenido AS contenido, mpn.comprobante_num AS comprobante_num, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, mpn.fecha_asig_producc AS fecha_asig_producc, est.estado_material AS estado_material FROM mat_prima_nacional AS mpn, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpn.id_producto = pro.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material and mpn.id_estado_material = 1 ";

if($id_mat_prima_nacional){ $sql.= " and mpn.id_mat_prima_nacional = '$id_mat_prima_nacional' "; }
if($id_origen){ $sql.= " and mpn.id_origen = '$id_origen' "; }
if($id_producto){ $sql.= " and mpn.id_producto = '$id_producto' "; } 
if($id_calibre){ $sql.= " and mpi.id_calibre = '$id_calibre' "; }
if($factura){ $sql.= " and mpn.factura_mp = '$factura' "; }
if($guia){ $sql.= " and mpn.comprobante_num = '$guia' "; }
if($bidon_num){ $sql.= " and mpn.bidon_num = '$bidon_num' "; }
//if($year){ $sql.= " and mpn.ano = $year "; }
//if($fidok or $fihok){ $sql.= " and mpn.fecha_ingreso between '$fidok' and '$fihok' ";}

$sql.= "and mpn.id_ldp = $id_ldp and mpn.fechastockprodfresco  != '0000-00-00' order by mpn.id_mat_prima_nacional desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

}

if($id_procedencia == "I"){
if(!$guia){
	
$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpi.contenido AS contenido, mpi.comprobante_num AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, mpi.fecha_ingreso AS fecha_ingreso, mpi.fecha_asig_producc AS fecha_asig_producc, est.estado_material AS estado_material, c.calibre AS calibre, mpi.etiquetados_folios_id AS etiquetados_folios_id FROM mat_prima_importada AS mpi, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpi.id_producto = pro.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material and mpi.id_estado_material = 1 ";
if($id_mat_prima_nacional){ $sqli.= " and mpi.id_mat_prima_importada = '$id_mat_prima_nacional' "; }
if($id_origen){ $sqli.= " and mpi.id_origen = '$id_origen' "; }
if($id_producto){ $sqli.= " and mpi.id_producto = '$id_producto' "; }
if($id_calibre){ $sqli.= " and mpi.id_calibre = '$id_calibre' "; }
if($factura){ $sqli.= " and mpi.comprobante_num = '$factura' "; }
if($bidon_num){ $sqli.= " and mpi.bidon_num = '$bidon_num' "; }
//if($fidok or $fihok){ $sql.= " and mpn.fecha_ingreso between '$fidok' and '$fihok' ";
//if($year){ $y=$year-1; $sqli.= " and mpi.ano between '$y' and '$year'"; }

$sqli.= " and mpi.id_ldp = $id_ldp and mpi.fechastockprodsalado != '0000-00-00' order by mpi.id_mat_prima_importada desc";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);
//echo "SQL -> $sqli<br>";

}
}
}

$cuantostotales=$cuantos+$cuantosi;

?>
<h1>STOCK DE PRODUCTO EN PROCESO</h1>
<table width="1007" border="0">
 <tr>
   <td height="8" colspan="13"><table width="95%" border="0" align="center">
     <tr>
       <td colspan="14" nowrap="nowrap"><table width="745" border="0">
         <tr>
           <td width="21" nowrap="nowrap">
		   <? $procedencia= crea_procedencia($link,$id_procedencia,1);
			  echo $procedencia;
		   ?>
           </td>
           <td nowrap="nowrap">&nbsp;</td>
           <td width="23" nowrap="nowrap"><? 
			$s=$id_procedencia;
			$origen= crea_origenes_ok($link,$id_origen,$s,0);
	echo $origen;?></td>
           <td width="15" nowrap="nowrap">&nbsp;</td>
           <td width="64" nowrap="nowrap">FOLIO MP:</td>
           <td width="73" nowrap="nowrap"><input name="id_mat_prima_nacional" type="text" id="id_mat_prima_nacional" value="<? echo $id_mat_prima_nacional?>" size="10" maxlength="10" /></td>
           <td width="15" nowrap="nowrap">&nbsp;</td>
           <td width="88" nowrap="nowrap">FACTURA:</td>
           <td width="43" nowrap="nowrap"><input name="factura" type="text" id="factura" value="<? echo $factura?>" size="5" maxlength="10" /></td>
           <td width="15" nowrap="nowrap">&nbsp;</td>
           <td width="54" nowrap="nowrap">GUIA:</td>
           <td width="43" nowrap="nowrap"><input name="guia" type="text" id="guia" value="<? echo $guia?>" size="5" maxlength="10" /></td>
           <td width="15" nowrap="nowrap">&nbsp;</td>
           <td width="63" nowrap="nowrap">N&ordm; BIDON</td>
           <td width="43" nowrap="nowrap"><input name="bidon_num" type="text" id="bidon_num" value="<? echo $bidon_num?>" size="5" maxlength="10" /></td>
           <td width="39" nowrap="nowrap">&nbsp;</td>
         </tr>
       </table></td>
       </tr>
     <tr>
       <td colspan="14" nowrap="nowrap"><!--<table width="681" border="0">
           <tr>
             <td width="47">A&Ntilde;O</td>
             <td width="42"><input name="y" type="text" id="year2" value="<? //echo $y?>" size="5" maxlength="10" /></td>
             <td width="41">entre</td>
             <td width="44"><input name="year" type="text" id="year" value="<? //echo $year?>" size="5" maxlength="10" /></td>
             <td width="22">&nbsp;</td>
             <td width="95">F/INGRESO</td>
             <td width="87"><input name="fid" type="text" id="fid" value="<? //echo $fid?>" size="8" maxlength="10" />
               <a href="javascript:show_Calendario('form1.fid');"> ver</a></td>
             <td width="79"><input name="fih" type="text" id="fih" value="<? //echo $fih?>" size="8" maxlength="10" />
               <a href="javascript:show_Calendario('form1.fih');"> ver</a></td>
             <td width="45">&nbsp;</td>
             <td width="45">&nbsp;</td>
             <td width="92">&nbsp;</td>
             </tr>
          </table>--></td>
     </tr>
     <tr>
       <td colspan="14" nowrap="nowrap">&nbsp;</td>
       </tr>
     <tr>
       <td width="141" nowrap="nowrap">&nbsp;</td>
       <td colspan="3" nowrap="nowrap">&nbsp;</td>
       <td colspan="2" nowrap="nowrap">&nbsp;</td>
       <td width="93" nowrap="nowrap">&nbsp;</td>
       <td width="50" nowrap="nowrap">&nbsp;</td>
       <td width="44" nowrap="nowrap">&nbsp;</td>
       <td width="50" nowrap="nowrap">&nbsp;</td>
       <td width="50" nowrap="nowrap">&nbsp;</td>
       <td width="129" nowrap="nowrap">&nbsp;</td>
       <td width="98" nowrap="nowrap">&nbsp;</td>
       <td width="54" nowrap="nowrap"><input type="submit" name="buscar" id="buscar" value="Buscar" /></td>
     </tr>
   </table></td>
  </tr>
 <tr>
   <td height="9" colspan="13">&nbsp;</td>
 </tr>
 <tr>
 <? if($cuantostotales){?>
    <td width="21" height="19" bgcolor="#FF9933"><center></center></td>
    <td colspan="12" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
  </tr>
  <tr>
    <td width="21" height="8" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="28" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="20" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; SOLICIT</strong></td>
    <td width="156" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO<? 
			//$producto= crea_producto_onChange_ok($link,$id_producto,1);
			//echo $producto;
			?></strong></td>
    <td width="100" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE
      <? 
			//if($id_producto){
			//$producto= crea_calibre_onChange_ok($link,$row[id_calibre],$id_producto,1);
			//echo $producto;
			//}else{
			//echo "Calibre"; 
			//}
			?>
    </strong></td>
    <td width="87" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;CONTENIDO</strong></center></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; GUIA</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&deg; BIDON</strong></center></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="68" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
  </tr>
     <?
	if($cuantos){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
	$id_solicitud_mp=$row[id_solicitud_mp];
	$id_origen=$row[id_origen];
	$id_calibre=$row[id_calibre];
	$id_producto=$row[id_producto];
	$comprobante_num=$row[comprobante_num];
	$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);   
	$fecha_termino=format_fecha_sin_hora($row[fecha_termino]);
    $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$fecha_asig_producc =format_fecha_sin_hora($row[fecha_asig_producc]);  
	$contenido=$row[contenido];
	$cuentabidones=$row[cuentabidones];
	$contenidototal+=$contenido;
	
	
	if($fecha_asig_producc !='00-00-0000'){
	$color = ($color == "#FFFF00") ? "#FFFF00" : "#FFFF00";
	}else{
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	}
	
  ?>
  <tr>
    <td height="8" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpfresca.php&id_mat_prima_nacional=<? echo $id_mat_prima_nacional?>&fresca=<? echo "N";?>" title="<? echo "Nº Solicitud $id_solicitud_mp";?>">F<? echo $id_mat_prima_nacional?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo "$id_solicitud_mp";?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[producto]?><? //echo $fecha_asig_producc?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $comprobante_num?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_faena?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_termino?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[estado_material]?></td>
    <? }
	}
	?>
  </tr>
   <?
   if($cuantosi){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($rowi=mysql_fetch_array($resulti))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$id_producto=$rowi[id_producto];
	$id_origen=$rowi[id_origen];
	$id_calibre=$rowi[id_calibre];
	$id_solicitud_mpi=$rowi[id_solicitud_mp];
	$comprobante_num=$rowi[comprobante_num];
	$fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   
	$contenidoi=$rowi[contenido];
	$cuentabidonesi=$rowi[cuentabidones];
	$contenidototali+=$contenidoi;
	
	$fecha_asig_producc =format_fecha_sin_hora($rowi[fecha_asig_producc]);  
if($fecha_asig_producc !='00-00-0000'){
	$color = ($color == "#FFFF00") ? "#FFFF00" : "#FFFF00";
	}else{
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	}
	
	
	
  ?>
  <tr>
    <td height="8" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $ii=$i+$cuantos?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>" title="<? echo "Nº Solicitud $id_solicitud_mpi";?>">S<? 
$largo=strlen($id_mat_prima_importada);
	if($etiquetados_folios_id)
	 {
	  echo "$etiquetados_folios_id";
	 }else{
		
		if($largo == 9){
	 	$id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 	}
	 	echo $id_mat_prima_importada;
	 }//if($etiquetados_folios_id)?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo "$id_solicitud_mpi";?></center></td>
   <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$rowi[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $comprobante_num?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_vencimiento?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[estado_material]?></td>
    <? }
	
   }?>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="2" align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">TOTAL</td>
   <td align="center" bgcolor="#CCCCCC"><strong><? echo $fstotal=$contenidototal+$contenidototali;?></strong></td>
   <td align="center">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <? }?>
  </tr>
</table>