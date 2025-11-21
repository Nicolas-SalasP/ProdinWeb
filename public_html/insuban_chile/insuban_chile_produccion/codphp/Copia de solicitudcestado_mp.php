<?
if($buscar){
if($fid) { $fidok=format_fecha_sin_hora($fid); }
if($fih) { $fihok=format_fecha_sin_hora($fih); }
if($fidfaenad) { $fidfaenadok=format_fecha_sin_hora($fidfaenad); }
if($fidfaenah) { $fidfaenahok=format_fecha_sin_hora($fidfaenah); }


if($id_procedencia == "N" and $buscar){
$sql="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, mpn.id_c_es_so AS id_c_es_so, mpn.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpn.contenido AS contenido, mpn.comprobante_num AS comprobante_num, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, est.estado_material AS estado_material FROM mat_prima_nacional AS mpn, producto AS pro, calibre AS c, origenes AS org, estado_material AS est WHERE mpn.id_producto = pro.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material and mpn.id_estado_material != 0 and mpn.id_estado_material = 1 ";
if($id_mat_prima_nacional){ $sql.= " and mpn.id_mat_prima_nacional = '$id_mat_prima_nacional' "; }
if($id_origen){ $sql.= " and mpn.id_origen = '$id_origen' "; }
if($id_producto){ $sql.= " and mpn.id_producto = '$id_producto' "; } 
if($id_calibre){ $sql.= " and mpi.id_calibre = '$id_calibre' "; }
if($factura){ $sql.= " and mpn.factura_mp = '$factura' "; }
if($guia){ $sql.= " and mpn.comprobante_num = '$guia' "; }
if($bidon_num){ $sql.= " and mpn.bidon_num = '$bidon_num' "; }
if($year){ $sql.= " and mpn.ano = $year "; }
if($fidok or $fihok){ $sql.= " and mpn.fecha_ingreso between '$fidok' and '$fihok' ";}
if($fidfaenadok or $fidfaenahok){ $sql.= " and mpn.fecha_faena between '$fidfaenadok' and '$fidfaenahok' ";}
$sql.= "  and mpn.id_solicitud_mp = 0 and mpn.id_c_es_so = 0 order by mpn.id_mat_prima_nacional asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
//echo "sql -> $sql";
}//if($id_procedencia == "N" and $buscar){

if($id_procedencia == "I" and $buscar){
	
	if($id_mat_prima_nacional){	$daton=$id_mat_prima_nacional;	
	 $largo=strlen($daton);
  	 if($largo == 8){ $agr=2; $daton=$agr.$daton;	 }
	}
	if($id_mat_prima_nacional_antiguo){ $datoi=$id_mat_prima_nacional_antiguo;	
	}
	
$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.etiquetados_folios_id AS etiquetados_folios_id, mpi.id_c_es_so AS id_c_es_so, mpi.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpi.contenido AS contenido, mpi.comprobante_num AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, mpi.fecha_ingreso AS fecha_ingreso, est.estado_material AS estado_material, c.calibre AS calibre FROM mat_prima_importada AS mpi, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpi.id_producto = pro.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material and mpi.id_estado_material != 0  and mpi.id_estado_material = 1 ";
if($id_mat_prima_nacional){ $sqli.= " and mpi.id_mat_prima_importada = '$daton' "; }
if($id_mat_prima_nacional_antiguo){ $sqli.= " and mpi.etiquetados_folios_id = '$datoi' "; }
if($id_origen){ $sqli.= " and mpi.id_origen = '$id_origen' "; }
if($id_producto){ $sqli.= " and mpi.id_producto = '$id_producto' "; }
if($id_calibre){ $sqli.= " and mpi.id_calibre = '$id_calibre' "; }
if($factura){ $sqli.= " and mpi.comprobante_num = '$factura' "; }
if($bidon_num){ $sqli.= " and mpi.bidon_num = '$bidon_num' "; }
if($year){ $sqli.= " and mpi.ano ='$year'"; }
if($fidok or $fihok){ $sqli.= " and mpi.fecha_ingreso between '$fidok' and '$fihok' ";}
if($fidfaenadok or $fidfaenahok){ $sql.= " and mpn.fecha_elaboracion between '$fidfaenadok' and '$fidfaenahok' ";}
$sqli.= "  and mpi.id_solicitud_mp = 0 and mpi.id_c_es_so = 0 order by mpi.id_mat_prima_importada asc";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);
//echo " cuantosi $cuantosi<br>";
//echo "sqli $sqli";
}//if($id_procedencia == "I" and $buscar){
}

$cuantostotales=$cuantos+$cuantosi;
	
if($asignar){
		 $dat1=split(" ",$fechaentrega);
	     $dat=split("-",$dat1[0]);
  		 $fechaentregok="$dat[2]-$dat[1]-$dat[0]";
		 $fechaces = date("Y-m-d");
		 
		 if(!$id_calibre){
			 $id_calibre=33;
		 }
		 
		 $sql_c_es_so="insert cambio_estado_solicitud (id_usuario,id_ce,id_procedencia,id_origen,id_producto,id_calibre,fechaces,fechaentrega) values ('$id_insuban','$id_ce','$id_procedencia','$id_origen','$id_producto','$id_calibre','$fechaces','$fechaentregok')";
    	 $result_c_es_so=mysql_query($sql_c_es_so,$link);
		 $id_ultimo=mysql_insert_id();
 		//echo "Sql $sql_c_es_so<br>";
		 
		 $envio_solicitud_cambio_estado=1;
		 include "modulo_email/email1.php";
		 
		 
foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
     
	if ($dat[0] == 'id_mpi')
   {
	$id=$dat[1];
   	$id_mpilistard=$_POST["id_mpi-$id"];  
	
	if($id_procedencia =='N'){
	$id_mpilistardd="$id_mpilistard";
	$sqlimpbusca="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mpilistard";
	$resulti=mysql_query($sqlimpbusca);
	$cuantosiiii=mysql_num_rows($resulti);
	if ($rowimp=mysql_fetch_array($resulti)) { 
    $id_mp=$rowimp[id_mat_prima_nacional];
	$id_producto=$rowimp[id_producto];
	if(!$id_calibre){
		$id_calibre=33;
	}
	$id_origen=$rowimp[id_origen];
	$contenido+=$rowimp[contenido];
	}//if ($rowimp=mysql_fetch_array($resulti)) { 
	$sqlupdate="UPDATE mat_prima_nacional  set id_c_es_so = '$id_ultimo' where id_mat_prima_nacional  = $id_mpilistard";
 	$resultupdate=mysql_query($sqlupdate); 
	//echo "sqlupdate $sqlupdate<br>";
	}//if($id_procedencia =='N'){
		
	if($id_procedencia =='I'){
	$id_mpilistardd="$id_mpilistard";
	$sqlimpbusca="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mpilistardd";
	$resulti=mysql_query($sqlimpbusca);
	$cuantosiiii=mysql_num_rows($resulti);

	
	if ($rowimp=mysql_fetch_array($resulti)) { 
    $id_mp=$rowimp[id_mat_prima_importada];
	$id_producto=$rowimp[id_producto];
	$id_calibre=$rowimp[id_calibre];
	$id_origen=$rowimp[id_origen];
	$contenidoi+=$rowimp[contenido];
	}//if ($rowimp=mysql_fetch_array($resulti)) {
	$sqlupdate="UPDATE mat_prima_importada  set id_c_es_so = '$id_ultimo' where id_mat_prima_importada  = $id_mpilistardd";
 	$resultupdate=mysql_query($sqlupdate);   
	//echo "sqlupdate $sqlupdate<br>";
	}//if($id_procedencia =='I'){
	
	
	
	$sql_impk="insert cambio_estado_detalle(id_c_es_so,foliosmpfsp,id_procedencia) values ('$id_ultimo','$id_mp','$id_procedencia')";
    $result_smpk=mysql_query($sql_impk,$link);
	
	//echo "sql_impk $sql_impk<br>";
	//echo "sql_smpk $sql_impk<br>";
//	echo "$id_mat_prima_importadabusca - $id_producto - $id_calibre - $id_origen<br>";

	

	}
 }
  
  $unidadessolicitadas=$contenido+$contenidoi;
  
   $sqlupdatecantidad="UPDATE cambio_estado_solicitud  set unidadessolicitadas = '$unidadessolicitadas' where id_c_es_so=$id_ultimo and id_ce  = $id_ce";
 	$resultupdatecantidad=mysql_query($sqlupdatecantidad);   
  
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=solicitudcpendientes.php&id_ce=$id_ce&tic=2\">";
exit;
}//if($asignar){

?>
<h1>STOCK DE MP</h1>
<table width="1009" border="0">
 <tr>
   <td height="3" colspan="13"><table width="91%" border="0" align="center">
     <tr>
       <td width="321" valign="top" nowrap="nowrap"><table width="270" border="0">
         <tr>
           <td colspan="2">
             <? $procedencia= crea_procedencia($link,$id_procedencia,1);
		  echo $procedencia;
	   ?></td>
           </tr>
         <tr>
           <td colspan="2">
             <? 
	   
	   if($id_procedencia){
	   $s=$id_procedencia;
	   $producto= crea_producto_ok_filtro_new($link,$s,$id_producto,1);
	   echo $producto;
	   }
	   
	    /*if($id_procedencia){
		$s=$id_procedencia;
		$origen= crea_origenes_ok_filtro_new($link,$id_origen,$s,1);
	    echo $origen;
		}*/
		
		if($id_producto){
		$s=$id_procedencia;
		$origen= crea_origenes_ok_filtro_new($link,$id_origen,$id_producto,$s,1);
	    echo $origen;
		}
		
	   ?></td>
           </tr>
         <tr>
           <? if($id_procedencia == "N"){ ?>
           <td width="164" bgcolor="#99CC66">&nbsp;FOLIO MPF:</td>
           <td width="96" bgcolor="#99CC66"><input name="id_mat_prima_nacional" type="text" id="id_mat_prima_nacional" value="<? echo $id_mat_prima_nacional?>" size="10" maxlength="10" /></td>
           <? } ?>
           </tr>
             <? if($id_procedencia == "I"){ ?>
         <tr>
           <td bgcolor="#99CC66">&nbsp;FOLIO MPS [Nuevo]:</td>
           <td bgcolor="#99CC66"><input name="id_mat_prima_nacional" type="text" id="id_mat_prima_nacional" value="<? echo $id_mat_prima_nacional?>" size="10" maxlength="10" /></td>
           </tr>
         <tr>
           <td bgcolor="#FFCC33">&nbsp;FOLIO MPS [Antiguo]:</td>
           <td bgcolor="#FFCC33"><input name="id_mat_prima_nacional_antiguo" type="text" id="id_mat_prima_nacional_antiguo" value="<? echo $id_mat_prima_nacional_antiguo?>" size="10" maxlength="10" /></td>
           </tr>
           <? } ?>
       </table></td>
       <td width="287" valign="top" nowrap="nowrap"><table width="233" border="0">
         <? if($id_procedencia == "I"){ ?>
         <? } ?>
         <tr>
           <td width="129">&nbsp;A&Ntilde;O:</td>
           <td width="131"><input name="year" type="text" id="year" value="<? echo $year?>" size="10" maxlength="10" /></td>
         </tr>
         <tr>
           <td>&nbsp;FACTURA:</td>
           <td><input name="factura" type="text" id="factura" value="<? echo $factura?>" size="10" maxlength="10" /></td>
         </tr>
         <tr>
           <td>&nbsp;GUIA:</td>
           <td><input name="guia" type="text" id="guia" value="<? echo $guia?>" size="10" maxlength="10" /></td>
         </tr>
         <tr>
           <td>&nbsp;N&ordm; BIDON:</td>
           <td><input name="bidon_num" type="text" id="bidon_num" value="<? echo $bidon_num?>" size="10" maxlength="10" /></td>
         </tr>
       </table></td>
       <td width="295" valign="top" nowrap="nowrap"><table width="298" border="0">
         <tr>
           <td colspan="3" bgcolor="#CCCCCC">&nbsp;Buscar por Fechas</td>
         </tr>
         <tr>
           <td width="81">F/INGRESO:</td>
           <td width="108"><input name="fid" type="text" id="fid" value="<? echo $fid?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fid');"> ver</a></td>
           <td width="87"><input name="fih" type="text" id="fih" value="<? echo $fih?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fih');"> ver</a></td>
         </tr>
         <tr>
           <td>F/FAENA:</td>
           <td><input name="fidfaenad" type="text" id="fidfaenad" value="<? echo $fidfaenad?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fidfaenad');"> ver</a></td>
           <td><input name="fidfaenadh" type="text" id="fidfaenadh" value="<? echo $fidfaenadh?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fidfaenadh');"> ver</a></td>
         </tr>
         <tr>
           <td colspan="3">&nbsp;</td>
         </tr>
       </table></td>
       </tr>
     <tr>
       <td nowrap="nowrap">&nbsp;</td>
       <td align="right" nowrap="nowrap">&nbsp;<input name="fechaentrega" type="text" id="fechaentrega"  value="<?echo $fechaentrega?>" size="8" maxlength="10" />
         <a href="javascript:show_Calendario('form1.fechaentrega');">Ver</a><input type="submit" name="buscar" id="buscar" value="Buscar" /></td>
     </tr>
   </table></td>
  </tr>
 <tr>
   <td height="3" colspan="13">&nbsp;</td>
 </tr>
 <tr>
   <? if($cuantostotales){?>
   <td width="21" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="12" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
 </tr>
  <tr>
    <td width="21" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="53" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="93" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="75" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="68" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="60" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;
        <? if($id_procedencia == "I"){ ?>
        FACTURA
        <? }?>
        <? if($id_procedencia == "N"){ ?>
        GUIA
        <? }?>
    </strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="70" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="61" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="68" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    <td width="20" nowrap="nowrap" bgcolor="#FF9933">&nbsp;</td>
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
	$id_c_es_so=$row[id_c_es_so];
	$id_origen=$row[id_origen];
	$id_producto=$row[id_producto];
	$id_calibre=$row[id_calibre];
	$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);   
	$fecha_termino=format_fecha_sin_hora($row[fecha_termino]);
    $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$contenido=$row[contenido];
	$comprobante_num=$row[comprobante_num];
	//echo "i $i / contenido $contenido<br>";
	$cuentabidones=$row[cuentabidones];
	
	//$contenidototal+=$contenido;
	
	
 //   if($nacmp <= $unidadessolicitadas){
			$nacmp=$nacmp + $contenido;
	?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpfresca.php&id_mat_prima_nacional=<? echo $id_mat_prima_nacional?>&fresca=<? echo "N";?>">F<? echo $id_mat_prima_nacional?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
    <? if($id_procedencia == "N"){ echo "$comprobante_num"; }?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_faena?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_termino?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $row[estado_material]?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">
    <center>
    
    <? if($row[id_solicitud_mp] == 0){?>
    <input type="checkbox" name="id_mpi-<? echo $id_mat_prima_nacional?>" id="id_mpi" value="<? echo $id_mat_prima_nacional?>" />
    <? }else{ echo "X"; } ?>
    </center>
    </td>
    <? }
	//}
	$contenidototal+=$contenidototal;
	}
	?>
  </tr>
   <?
   if($cuantosi){
	   //echo "cuantosiiiiiiiiiiii $cuantosi<br>";
    $i=$op;
    $color = "#000000";$i = 0;
    while ($rowi=mysql_fetch_array($resulti))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$id_solicitud_mp=$rowi[id_solicitud_mp];
	$id_c_es_so=$rowi[id_c_es_so];
	$id_producto=$rowi[id_producto];
	$id_origen=$rowi[id_origen];
	$id_calibre=$rowi[id_calibre];
	$fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   
	$contenidoi=$rowi[contenido];
	$cuentabidonesi=$rowi[cuentabidones];
	$comprobante_num=$rowi[comprobante_num];
	//$contenidototali+=$contenidoi;
	
	
	  // if($nacmpi <= $unidadessolicitadas){
		$nacmpi=$nacmpi +$contenidoi;
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $ii=$i+$cuantos?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>">S<? 
	if($etiquetados_folios_id)
	 {
	  echo "$etiquetados_folios_id";
	 }else{
		
		if($largo == 9){
	 	$id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 	}
	 	echo $id_mat_prima_importada;
	 }//if($etiquetados_folios_id)?></a></td>
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
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $rowi[estado_material]?> </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">
    <center>
    <? //echo $id_mat_prima_importada?>
     <? if($rowi[id_solicitud_mp] == 0){?>
  <input type="checkbox" name="id_mpi-<? echo $id_mat_prima_importada?>" id="id_mpi" value="<? echo $id_mat_prima_importada?>" />
    <? }else{ echo "<center><strong>X</strong></center>"; } ?>
    </center>
     </td>
    <? }
	//}
	
   }?>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">TOTAL</td>
   <td align="center" bgcolor="#CCCCCC"><strong><? echo $fstotal=$nacmp+$nacmpi;?></strong></td>
   <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td colspan="2" align="right"><input type="submit" name="asignar" id="asignar" value="Asignar" /></td>
    <? }?>
  </tr>
  <tr>
    <td colspan="13" align="right">
    <? //if($id_producto and $buscar and $cuantostotales){?>
    <? //} ?>
    </td>
  </tr>

</table>
<? if(!$cuantostotales and $buscar){?>
<center><h2>NO EXISTE MATERIA PRIMA PARA LA VENTA</h2></center>
<? } ?>
