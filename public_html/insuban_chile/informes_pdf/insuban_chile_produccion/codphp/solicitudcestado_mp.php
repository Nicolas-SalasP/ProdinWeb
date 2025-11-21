<?


	
if($asignar){
		 $dat1=split(" ",$fechaentreg);
	     $dat=split("-",$dat1[0]);
  		 $fechaentregok="$dat[2]-$dat[1]-$dat[0]";
		 $fechaces = date("Y-m-d");
		 
		 if(!$id_calibre){
			 $id_calibre=33;
		 }
		 
		 $sql_c_es_so="insert cambio_estado_solicitud (id_usuario,id_ce,id_procedencia,id_origen,id_producto,id_calibre,fechaces,fechaentrega) values ('$id_insuban','$id_ce','I','$id_origen','$id_producto','$id_calibre','$fechaces','$fechaentregok')";
    	 $result_c_es_so=mysql_query($sql_c_es_so,$link);
		 $id_ultimo=mysql_insert_id();
 		 //echo "Sql $sql_c_es_so<br>";
		 
		 $envio_solicitud_cambio_estado=1;
		// include "modulo_email/email1.php";
	
	
	foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
     
	if ($dat[0] == 'id_mpi')
   {
	$id=$dat[1];
   	$id_mpilistard=$_POST["id_mpi-$id"];  

	
		$id_procedencia = 'I'; 
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

	$sql_impk="insert cambio_estado_detalle(id_c_es_so,id_ce,foliosmpfsp,id_procedencia) values ('$id_ultimo','$id_ce','$id_mp','$id_procedencia')";
    $result_smpk=mysql_query($sql_impk,$link);
	
	}
	}
  
  $unidadessolicitadas+=$contenidoi;
  
   $sqlupdatecantidad="UPDATE cambio_estado_solicitud  set unidadessolicitadas = '$unidadessolicitadas' where id_c_es_so=$id_ultimo and id_ce  = $id_ce";
 	$resultupdatecantidad=mysql_query($sqlupdatecantidad);   
  
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=solicitudcpendientes.php&id_ce=$id_ce&tic=2\">";
exit;
}//if($asignar){

?>
<? if(!$dato){?>
<script language="JavaScript">
function isMailReady(form1) {
var passed = false;

if (document.form1.id_producto.value==0) {     
    alert('Debe seleccionar Producto');
    document.form1.id_producto.onfocus;
    return false;
}
if (document.form1.id_origen.value==0) {     
    alert('Debe seleccionar Origen');
    document.form1.id_origen.onfocus;
    return false;
}
if (document.form1.fechaentreg.value=="") {     
    alert('Debe ingresar fecha de entrega ');
    document.form1.fechaentreg.onfocus;
    return false;
}

else {
getInfo(form1);
passed = true;
}
return passed;
}
</SCRIPT>
<? } ?>
<script language="JavaScript">
<!--
var nav4 = window.Event ? true : false;
function numeros(evt){ 
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 
var key = nav4 ? evt.which : evt.keyCode; 
return (key <= 32 || (key >= 48 && key <= 59) || (key >= 45 && key <= 47 ));
}
//-->
</script>
<h1>STOCK DE MP SALADA</h1>
<table width="980" border="0">
 <tr>
   <td height="3" colspan="13"><table width="92%" border="0" align="center">
     <tr>
       <td height="20" colspan="2" valign="top" nowrap="nowrap">
	   <? 
	   $s='I';
	   $producto= crea_producto_ok_filtro_new($link,$s,$id_producto,1);
	   echo $producto;
	   ?></td>
       <td colspan="3" valign="top" nowrap="nowrap" bgcolor="#CCCCCC">&nbsp;BUSCAR POR RANGOS DE FECHA</td>
       <td width="27" valign="top" nowrap="nowrap">&nbsp;</td>
       <td colspan="2" valign="top" nowrap="nowrap" bgcolor="#CCCCCC">&nbsp;INGRESAR FOLIOS</td>
       </tr>
     <tr>
       <td colspan="2" valign="top" nowrap="nowrap">
       <?
        if($id_producto){
	   $s=$id_procedencia;
	   $origen= crea_origenes_ok_filtro_new($link,$id_origen,$id_producto,'I',1);
	   echo $origen;
		}
	   ?>
       </td>
       <td width="84" valign="top" nowrap="nowrap">F/INGRESO:</td>
       <td width="81" valign="top" nowrap="nowrap"><input name="fid" type="text" id="fid" value="<? echo $fid?>" size="8" maxlength="10" />
         <a href="javascript:show_Calendario('form1.fid');"> ver</a></td>
       <td width="153" valign="top" nowrap="nowrap"><input name="fih" type="text" id="fih" value="<? echo $fih?>" size="8" maxlength="10" />
         <a href="javascript:show_Calendario('form1.fih');"> ver</a></td>
       <td rowspan="3" valign="top" nowrap="nowrap">&nbsp;</td>
       <td colspan="2" rowspan="3" valign="top" nowrap="nowrap"><textarea name="dato" cols="30" rows="3" id="dato" onKeyPress="return numeros(event)"></textarea>
       </td>
     </tr>
     <tr>
       <td width="90" valign="top" nowrap="nowrap">&nbsp;A&Ntilde;O:</td>
       <td width="158" valign="top" nowrap="nowrap"><input name="year" type="text" id="year" value="<? echo $year?>" size="10" maxlength="10" /></td>
       <td width="84" valign="top" nowrap="nowrap">F/FAENA:</td>
       <td width="81" valign="top" nowrap="nowrap"><input name="fidfaenad" type="text" id="fidfaenad" value="<? echo $fidfaenad?>" size="8" maxlength="10" />
         <a href="javascript:show_Calendario('form1.fidfaenad');"> ver</a></td>
       <td width="153" valign="top" nowrap="nowrap"><input name="fidfaenadh" type="text" id="fidfaenadh" value="<? echo $fidfaenadh?>" size="8" maxlength="10" />
         <a href="javascript:show_Calendario('form1.fidfaenadh');"> ver</a></td>
       </tr>
     <tr>
       <td valign="top" nowrap="nowrap">&nbsp;FACTURA:</td>
       <td valign="top" nowrap="nowrap"><input name="factura" type="text" id="factura" value="<? echo $factura?>" size="10" maxlength="10" /></td>
       <td colspan="3" valign="top" nowrap="nowrap">&nbsp;</td>
       </tr>
     <tr>
       <td valign="top" nowrap="nowrap">&nbsp;GUIA:</td>
       <td valign="top" nowrap="nowrap"><input name="guia" type="text" id="guia" value="<? echo $guia?>" size="10" maxlength="10" /></td>
       <td colspan="3" valign="top" nowrap="nowrap">&nbsp;</td>
       <td valign="top" nowrap="nowrap">&nbsp;</td>
       <td colspan="2" valign="top" nowrap="nowrap" bgcolor="#CCCCCC">F/PLAZO DE ENTREGA</td>
       </tr>
     <tr>
       <td height="26" valign="top" nowrap="nowrap">&nbsp;N&ordm; BIDON:</td>
       <td valign="top" nowrap="nowrap"><input name="bidon_num" type="text" id="bidon_num" value="<? echo $bidon_num?>" size="10" maxlength="10" /></td>
       <td colspan="3" valign="top" nowrap="nowrap">&nbsp;</td>
       <td valign="top" nowrap="nowrap">&nbsp;</td>
       <td width="133" valign="top" nowrap="nowrap"><input name="fechaentreg" type="text" id="fechaentreg"  value="<?echo $fechaentreg?>" size="8" maxlength="10" />
         <a href="javascript:show_Calendario('form1.fechaentreg');">Ver</a></td>
       <td width="139" valign="top" nowrap="nowrap"><input type="submit" name="buscar" id="buscar" value="Buscar" /></td>
     </tr>
   </table></td>
  </tr>
 <tr>
   <td height="3" colspan="13"><BR>Nota: El siguiente informe muestra  Materia Prima Salada en estado de Bodega</td>
 </tr>
 <tr>
 <? if($buscar){?>
   <td width="21" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="12" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
 </tr>
  <tr>
    <td width="21" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="53" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="93" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="75" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="68" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="101" nowrap="nowrap" bgcolor="#FF9933"><strong><center>CONTENIDO</center></strong></td>
    <td width="79" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FACTURA</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="61" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="68" nowrap="nowrap" bgcolor="#FF9933"><strong><center>ESTADO</center></strong></td>
    <td width="79" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <td width="71" nowrap="nowrap" bgcolor="#FF9933"><center><a href="javascript:seleccionar_todo()"><img src="codphp/jpgnew/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="codphp/jpgnew/ninguno.jpg" width="13" height="13" border="0"/></a></center></td>
  </tr>
  <?
  
   if($buscar and !$dato){
	if($fid) { $fidok=format_fecha_sin_hora($fid); }
if($fih) { $fihok=format_fecha_sin_hora($fih); }
if($fidfaenad) { $fidfaenadok=format_fecha_sin_hora($fidfaenad); }
if($fidfaenah) { $fidfaenahok=format_fecha_sin_hora($fidfaenah); }

if($id_ce != 0 and $buscar){
	
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

$cuantostotales =$cuantosi;
  
  if($buscar and !$dato){
  if($cuantosi){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($rowi=mysql_fetch_array($resulti))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$id_mat_prima_importada2=$rowi[id_mat_prima_importada];
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
	$nacmpi=$nacmpi +$contenidoi;
  ?>
  <tr>
    <td height="8" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $ii=$i+$cuantos?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>">S<? 
	if($etiquetados_folios_id)
	 {
	  echo "$etiquetados_folios_id";
	 }else{
		 $largo=strlen($id_mat_prima_importada);
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
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $comprobante_num ?>      <center>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_vencimiento?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $rowi[estado_material]?> </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><? echo $rowi[bidon_num]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">
      <center>
        <? //echo $id_mat_prima_importada2?>
        <? if($rowi[id_solicitud_mp] == 0){?>
        <input type="checkbox" name="id_mpi-<? echo $id_mat_prima_importada2?>" id="id_mpi" value="<? echo $id_mat_prima_importada2?>" />
        <? }else{ echo "<center><strong>X</strong></center>"; } ?>
      </center>
    </td>
    <? } // if($cuantosi){
	 }// while ($rowi=mysql_fetch_array($resulti))
   }//if($buscar and !$folios){
   ?>
  </tr>
  <?

  if($buscar and $dato){
	 	$dat=split("\n",$dato);
		//echo "dat $dat<br>";
	    $c=count($dat);
	//echo "dat $dat c $c <br>";
	$j=0;
    $color = "#000000";
	 for ($g=0; $g<=$c;$g++)
	  { 
	   if ($dat[$g] != "")
	   {
	    $id_f=$dat[$g];
		$largog=strlen($id_f);
		if($largog != 1){
		  $id_f=substr($id_f, 0, $largog);
		  //echo "idf $id_f";
		}
		
			$id_fs="2$id_f";
			
						$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.etiquetados_folios_id AS etiquetados_folios_id, mpi.id_c_es_so AS id_c_es_so, mpi.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpi.contenido AS contenido, mpi.comprobante_num AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, mpi.fecha_ingreso AS fecha_ingreso, est.estado_material AS estado_material, c.calibre AS calibre FROM mat_prima_importada AS mpi, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpi.id_mat_prima_importada = $id_fs and mpi.id_producto = pro.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material and mpi.id_estado_material != 0  and mpi.id_estado_material = 1  and mpi.id_solicitud_mp = 0 and mpi.id_c_es_so = 0 and mpi.id_origen = '$id_origen' and mpi.id_producto = '$id_producto' order by mpi.id_mat_prima_importada asc";
												
		$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);
//echo "sqli $sqli<br>";

			
			
   if($cuantosi){
	
    while ($rowi=mysql_fetch_array($resulti))
    {
	$j++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$id_mat_prima_importada2=$rowi[id_mat_prima_importada];
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
    <td height="8" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $j?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&amp;id_origen=<? echo $id_origen?>&amp;id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>">S<? 
	if($etiquetados_folios_id)
	 {
	  echo "$etiquetados_folios_id";
	 }else{
		 $largo=strlen($id_mat_prima_importada);
		if($largo == 9){
	 	$id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 	}
	 	echo $id_mat_prima_importada;
	 }//if($etiquetados_folios_id)?>
    </a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
      <? if(!$id_calibre){ echo "Original"; }else{echo "$rowi[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $comprobante_num ?>
      <center>
      </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_vencimiento?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[estado_material]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><? echo $rowi[bidon_num]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? //echo $id_mat_prima_importada2?>
      <? if($rowi[id_solicitud_mp] == 0){?>
      <input type="checkbox" name="id_mpi-<? echo $id_mat_prima_importada2?>" id="id_mpi" value="<? echo $id_mat_prima_importada2?>" />
      <? }else{ echo "<center><strong>X</strong></center>"; } ?>
    </center></td>
    <? 
	//}
	 }//  if ($rowi=mysql_fetch_array($resulti))
	 } // if($cuantosi){
   } //if ($dat[$i] != "")
	 
	   }//for ($i=0; $i<=$c;$i++)
	  }//if($folios){
   ?>
  </tr>
  <tr>
    <td height="9" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;</td>
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
    <td colspan="3" align="right">
    <? if($fechaentreg){?>
    <input type="submit" name="asignar" id="asignar" value="Asignar" />
    <? }?>
    </td>
   <? }?>
  </tr>
  <tr>
    <td colspan="13" align="right">&nbsp;</td>
  </tr>

</table>
<? if(!$cuantosi and $buscar){?>
<center><h2>NO EXISTE MATERIA PRIMA PARA LA VENTA</h2></center>
<? } ?>
