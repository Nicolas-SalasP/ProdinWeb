<?

//echo "id_mat_prima_nacional $id_mat_prima_nacional<br>";

//if(!$year){ $year=$fhoy=date("Y");	}
if($buscar or $id_producto){
	
if($fecha_ingresod) { $fecha_ingresod=format_fecha_sin_hora($fecha_ingresod); }
if($fecha_ingresoh) { $fecha_ingresoh=format_fecha_sin_hora($fecha_ingresoh); }
if($fecha_despachod) { $fecha_despachod=format_fecha_sin_hora($fecha_despachod); }
if($fecha_despachoh) { $fecha_despachoh=format_fecha_sin_hora($fecha_despachoh); }


if($id_procedencia == "N"){
$sql="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, mpn.id_c_es_so AS id_c_es_so, mpn.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto,pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpn.contenido AS contenido, mpn.comprobante_num AS comprobante_num, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, est.estado_material AS estado_material FROM mat_prima_nacional AS mpn, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpn.id_producto = pro.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material and mpn.id_estado_material = $id_estado_material ";

if($id_mat_prima_nacional){ $sql.= " and mpn.id_mat_prima_nacional = '$id_mat_prima_nacional' "; }
if($id_origen){ $sql.= " and mpn.id_origen = '$id_origen' "; }
if($id_producto){ $sql.= " and mpn.id_producto = '$id_producto' "; } 
if($id_calibre){ $sql.= " and mpi.id_calibre = '$id_calibre' "; }
if($factura_mp){ $sql.= " and mpn.factura_mp = '$factura_mp' "; }
if($comprobante_num){ $sql.= " and mpn.comprobante_num = '$comprobante_num' "; }
if($bidon_num){ $sql.= " and mpn.bidon_num = '$bidon_num' "; }
if($year){ $sql.= " and mpn.ano = $year "; }
if($fecha_ingresod or $fecha_ingresoh){ $sql.= " and mpn.fecha_ingreso between '$fecha_ingresod' and '$fecha_ingresoh' ";}
if($fidfaenadok or $fidfaenahok){ $sql.= " and mpn.fecha_faena between '$fidfaenadok' and '$fidfaenahok' ";}
if(!$sibidones){ $sql.= " and mpn.id_solicitud_mp = 0 and mpn.id_c_es_so = 0"; }
$sql.= " order by mpn.id_mat_prima_nacional asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
//echo "SQLN -> $sql<br>";
}

if($id_procedencia == "I"){
	
	if($id_mat_prima_nacional){	$daton=$id_mat_prima_nacional;	
	 $largo=strlen($id_mat_prima_nacional);
  	 if($largo == 8){ $agr=2; $daton=$agr.$daton;	 }
	}
	if($id_mat_prima_nacional_antiguo){ $datoi=$id_mat_prima_nacional_antiguo;	
	 
	 }
	
$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.cruce_tablas_id as cruce_tablas_id, mpi.etiquetados_folios_id AS etiquetados_folios_id, mpi.id_c_es_so AS id_c_es_so,  mpi.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpi.contenido AS contenido, mpi.comprobante_num AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, mpi.fecha_ingreso AS fecha_ingreso, est.estado_material AS estado_material, c.calibre AS calibre FROM mat_prima_importada AS mpi, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpi.id_producto = pro.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material and mpi.id_estado_material != 0  and   mpi.id_estado_material = $id_estado_material ";
if($id_mat_prima_nacional){ $sqli.= " and mpi.id_mat_prima_importada = '$daton' "; }
if($id_mat_prima_nacional_antiguo){ $sqli.= " and mpi.etiquetados_folios_id = '$datoi' "; }
if($id_origen){ $sqli.= " and mpi.id_origen = '$id_origen' "; }
if($id_producto){ $sqli.= " and mpi.id_producto = '$id_producto' "; }
if($id_calibre){ $sqli.= " and mpi.id_calibre = '$id_calibre' "; }
if($comprobante_num){ $sqli.= " and mpi.comprobante_num = '$comprobante_num' "; }
if($guia_imp){ $sqli.= " and mpi.guia_imp = '$guia_imp' "; }
if($bidon_num){ $sqli.= " and mpi.bidon_num = '$bidon_num' "; }
if($fecha_ingresod or $fecha_ingresoh){ $sqli.= " and mpi.fecha_ingreso between '$fecha_ingresod' and '$fecha_ingresoh' ";}
if($year){ $y=$year-1;	$sqli.= " and mpi.ano between '$y' and '$year'"; }
if($year){ $sqli.= " and mpi.ano ='$year'"; }
if($fidok or $fihok){ $sqli.= " and mpi.fecha_ingreso between '$fidok' and '$fihok' ";}
if($fidfaenadok or $fidfaenahok){ $sql.= " and mpi.fecha_elaboracion between '$fidfaenadok' and '$fidfaenahok' ";}
if(!$sibidones){ $sqli.= " and mpi.id_solicitud_mp = 0 and mpi.id_c_es_so = 0"; }
$sqli.= " order by mpi.id_mat_prima_importada asc";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);
//echo "SQLI -> $sqli<br>";

}
}
$cuantostotales=$cuantos+$cuantosi;
?>
<h1>STOCK DE MATERIA PRIMA <? if($id_procedencia != "I"){ ?>FRESCO<?}ELSE{?>SALADO
  <?}?>
</h1> 
<table width="1010" border="0">
 <tr>
   <td height="8" colspan="12"><table width="100%" border="0" align="center">
     <tr>
       <td valign="top" nowrap="nowrap"><table width="967" border="0">
         <tr>
           <td width="21"><? $procedencia= crea_procedencia($link,$id_procedencia,1);
		  echo $procedencia;
		   ?></td>
           <td width="22"><? $estado_material= crea_estado_material($link,$id_estado_material);
			echo $estado_material;?></td>
           <td width="45"><? 
			if($id_procedencia){
	   		$s=$id_procedencia;
	   		$producto= crea_producto_ok_filtro_new($link,$s,$id_producto,1);
		    echo $producto;
	   		}
			?></td>
           <td width="119"><? 
			if($id_producto){
		$s=$id_procedencia;
		$origen= crea_origenes_ok_filtro_new($link,$id_origen,$id_producto,$s,1);
	    echo $origen;
		}?></td>
           <? if($id_procedencia == 'N'){?><td width="98">&nbsp;FOLIO MPF:</td>
           <td width="104"><input name="id_mat_prima_nacional" type="text" id="id_mat_prima_nacional2" value="<? echo $id_mat_prima_nacional?>" size="10" maxlength="10" /></td><? } ?>
           <? if($id_procedencia == 'I'){?>
           <td width="148">&nbsp;FOLIO MPS [Nuevo]:</td>
           <td width="63"><input name="id_mat_prima_nacional2" type="text" id="id_mat_prima_nacional" value="<? echo $id_mat_prima_nacional?>" size="10" maxlength="10" /></td>
           <td width="151">FOLIO MPS [Antiguo]:</td>
           <td width="156"><input name="id_mat_prima_nacional_antiguo" type="text" id="id_mat_prima_nacional_antiguo" value="<? echo $id_mat_prima_nacional_antiguo?>" size="10" maxlength="10" /></td>
           <? }?>
           </tr>
         <? if($id_procedencia == "I"){ ?>
         <? } ?>
       </table></td>
       </tr>
     <tr>
       <td nowrap="nowrap"><table width="967" border="0">
        
         
         <tr>
           <td width="43"> <? if($id_procedencia){ ?>&nbsp;A&Ntilde;O:<? } ?></td>
           <td width="62"><? if($id_procedencia){ ?>
           <? if(!$year){ $year=$fhoy=date("Y");} ?>           
           <input name="year" type="text" id="year" value="<? echo $year?>" size="5" maxlength="10" /><? } ?></td>
           <td width="80" align="right"><? if($id_procedencia == 'I'){?>
FACTURA IMP
  <? } if($id_procedencia== 'N'){?>
FACTURA NAC
<? } ?></td>
           <td width="34"><? if($id_procedencia == 'I'){?>
             <input name="comprobante_num" type="text" id="comprobante_num" value="<? echo $comprobante_num?>" size="5" maxlength="10" />
             <? } if($id_procedencia== 'N'){?>
             <input name="factura_mp" type="text" id="factura_mp" value="<? echo $factura_mp?>" size="5" maxlength="10" />
             <? } ?></td>
           <td width="59" align="right"><? if($id_procedencia == 'I'){ ?>
GUIA IMP
  <? } if($id_procedencia== 'N'){?>
GUIA NAC
<? } ?></td>
           <td width="72"><? if($id_procedencia == 'I'){ ?>
             <input name="guia_imp" type="text" id="guia_imp" value="<? echo $guia_imp?>" size="5" maxlength="10" />
             <? } if($id_procedencia== 'N'){?>
             <input name="comprobante_num" type="text" id="comprobante_num" value="<? echo $comprobante_num?>" size="5" maxlength="10" />
             <? } ?></td>
           <td width="81" align="right"><? if($id_procedencia == 'I'){ ?>
N&ordm; BIDON IMP
<? } if($id_procedencia== 'N'){?>
N&ordm; BIDON NAC
<? } ?></td>
           <td width="112"><? if($id_procedencia){ ?><input name="bidon_num" type="text" id="bidon_num" value="<? echo $bidon_num?>" size="5" maxlength="10" /><? } ?></td>
           <td width="206">&nbsp;F/INGRESO<br>
             <input name="fecha_ingresod" type="text" id="fecha_ingresod"  value="<?echo $fecha_ingresod?>" size="10" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fecha_ingresod');" >Ver</a><br>
             <input name="fecha_ingresoh" type="text" id="fecha_ingresoh"  value="<?echo $fecha_ingresoh?>" size="10" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fecha_ingresoh');" >Ver</a></td>
           <td width="176">&nbsp;F/DESPACHO<br>
             <input name="fecha_despachod" type="text" id="fecha_despachod"  value="<?echo $fecha_despachod?>" size="10" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fecha_despachod');" >Ver</a><br>
             <input name="fecha_despachoh" type="text" id="fecha_despachoh"  value="<?echo $fecha_despachoh?>" size="10" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fecha_despachoh');" >Ver</a></td>
           </tr>
         <tr>
           <td colspan="10">Incluir folios que est&aacute;n asignados a una solicitud de producci&oacute;n o a un cambio de estado 
              <? if($sibidones){ ?>
			  <input name="sibidones" type="checkbox" value="1" checked="checked"/>
			  <? }else{?>
			  <input name="sibidones" type="checkbox" value="1"/>
			  <? }?></td>
           </tr>
         </table></td>
       </tr>
     <tr>
       <td align="right" nowrap="nowrap"><? if($id_procedencia){ ?><input type="submit" name="buscar" id="buscar" value="Buscar" /><? } ?></td>
     </tr>
   </table></td>
  </tr>
 <tr>
<? if($id_procedencia and $buscar){ ?>
   <td height="9" colspan="12">&nbsp;</td>
 </tr>
 <tr>
 <? if($cuantostotales){?>
    <td width="22" height="19" bgcolor="#FF9933"><center></center></td>
    <td colspan="9" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><a href="codphp/informes_pdf_excel/excel_solicitudmp.php?id_procedencia=<? echo $id_procedencia?>&id_producto=<? echo $id_producto?>&id_origen=<? echo $id_origen?>&comprobante_num=<? echo $comprobante_num?>&bidon_num=<? echo $bidon_num?>&sibidones=<? echo $sibidones?>" target="_blank">Exportar <? echo $sibidones?><img src="codphp/informes_pdf_excel/excel.png" width="18" height="18" border="0" /></a></td>
  </tr>
  <tr>
    <td width="20" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CODIGO</strong></td>
    
    <td width="138" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="76" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;<? if($id_procedencia == "I"){ ?>FACTURA<? }?><? if($id_procedencia == "N"){ ?>GUIA<? }?></strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>F/INGRESO</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
  </tr>
     <?
	if($cuantos){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
	$id_origen=$row[id_origen];
	$id_solicitud_mp=$row[id_solicitud_mp];
	$id_c_es_so=$row[id_c_es_so];
	$id_calibre=$row[id_calibre];
	$id_producto=$row[id_producto];
	$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);   
	$fecha_termino=format_fecha_sin_hora($row[fecha_termino]);
    $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$contenido=$row[contenido];
	$comprobante_num=$row[comprobante_num];
	$cuentabidones=$row[cuentabidones];
	$contenidototal+=$contenido;
	if($id_solicitud_mp){
	$color = ($color == "#FFFF00") ? "#FFFF00" : "#FFFF00";
	}
	if($id_c_es_so){
	$color = ($color == "#FFCCCC") ? "#FFCCCC" : "#FFCCCC";
	}
	if(!$id_solicitud_mp and !$id_c_es_so){
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	}
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $i?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpfresca.php&id_mat_prima_nacional=<? echo $id_mat_prima_nacional?>&fresca=<? echo "N";?>" 
	<? if($id_solicitud_mp){?>title="<? echo "Nº $id_solicitud_mp Solicitud de Produccion ";?>"<? } ?>
    
	<? if($id_c_es_so){ ?>title="<? echo "Nº $id_c_es_so Solicitud de Cambio de Estado ";?>"<? }?>
    
    >F<? echo $id_mat_prima_nacional?></a></td>
    
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo "N/A" ?></td>
    
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if($id_procedencia == "N"){ echo "$comprobante_num"; }?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_faena?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_termino?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $row[estado_material]?>
    <? if($id_solicitud_mp or $id_c_es_so){?>
    <img src="codphp/jpgnew/canrojo.png" width="16" height="16" border="0" />
    <? }else{?>
    <img src="codphp/jpgnew/canverde.png" width="16" height="16" border="0" />
    <? }?>
    </center></td>
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
	
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	
	$codigo=$rowi[cruce_tablas_id];
	
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$id_producto=$rowi[id_producto];
	$id_origen=$rowi[id_origen];
	$id_solicitud_mp=$rowi[id_solicitud_mp];
	$id_c_es_so=$rowi[id_c_es_so];
	$id_calibre=$row[id_calibre];
	$fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   
	$contenidoi=$rowi[contenido];
	$comprobante_num=$rowi[comprobante_num];
	$cuentabidonesi=$rowi[cuentabidones];
	$contenidototali+=$contenidoi;
	if($id_solicitud_mp){
	$color = ($color == "#FFFF00") ? "#FFFF00" : "#FFFF00";
	}
	if($id_c_es_so){
	$color = ($color == "#FFCCCC") ? "#FFCCCC" : "#FFCCCC";
	}
	if(!$id_solicitud_mp and !$id_c_es_so){
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	}
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $ii=$i+$cuantos?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>" 
    
    <? if($id_solicitud_mp){?>title="<? echo "Nº $id_solicitud_mp Solicitud de Produccion ";?>"<? } ?>
    
	<? if($id_c_es_so){ ?>title="<? echo "Nº $id_c_es_so Solicitud de Cambio de Estado ";?>"<? }?>
    
    >S<? 
	 $largo=strlen($id_mat_prima_importada);
	 
	 
	 if($etiquetados_folios_id)
	 {
	  echo "$etiquetados_folios_id";
	 }else{
	 if($largo == 9){
	 $id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 }
	 echo $id_mat_prima_importada;
	 }//if($etiquetados_folios_id)
	 ?></a>     
     </td>
     
     <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[cruce_tablas_id]?></td>
     
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$rowi[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $comprobante_num ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_vencimiento?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $rowi[estado_material]?>
     <? if($id_solicitud_mp or $id_c_es_so){?>
    <img src="codphp/jpgnew/canrojo.png" width="16" height="16" border="0" />
    <? }else{?>
    <img src="codphp/jpgnew/canverde.png" width="16" height="16" border="0" />
    <? }?>
    </center></td>
    <? }
	
   }?>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">TOTAL</td>
   <td align="center" bgcolor="#CCCCCC"><strong><? echo $fstotal=$contenidototal+$contenidototali;?></strong></td>
   <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <? }?>
  </tr>
  <? if($sibidones == 1){?>
  <tr>
    <td align="right" bgcolor="#FFFF00">&nbsp;</td>
    <td colspan="12">Folios Asignados Producci&oacute;n</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FFCCCC">&nbsp;</td>
    <td colspan="12">Folios Asignados a Cambio de Estado</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
    <td colspan="12">Folios Disponibles 100%</td>
  </tr>
  <? }//if($sibidones){?>
  <? } ?>
</table>
