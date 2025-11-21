<?
if($buscar){
if($id_procedencia == "N" and $buscar){
//if($id_procedencia == "N" and $buscar and $unidadessolicitadas){
$sql="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, mpn.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpn.contenido AS contenido, mpn.comprobante_num AS comprobante_num, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, est.estado_material AS estado_material FROM mat_prima_nacional AS mpn, producto AS pro, calibre AS c, origenes AS org, estado_material AS est WHERE mpn.id_producto = pro.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material and mpn.id_estado_material != 0 and mpn.id_estado_material = 1 ";
if($id_mat_prima_nacional){ $sql.= " and mpn.id_mat_prima_nacional = '$id_mat_prima_nacional' "; }
if($id_origen){ $sql.= " and mpn.id_origen = '$id_origen' "; }
if($id_producto){ $sql.= " and mpn.id_producto = '$id_producto' "; } 
if($comprobante_num){ $sql.= " and mpn.comprobante_num = '$comprobante_num' "; } 
if($factura_mp){ $sql.= " and mpn.factura_mp = '$factura_mp' "; } 
//if($id_calibre){ $sql.= " and mpi.id_calibre = '$id_calibre' "; }
$sql.= "  and mpn.id_solicitud_mp = 0 and mpn.fecha_asig_producc = '0000-00-00' order by mpn.id_mat_prima_nacional asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
//echo "sql -> $sql <br><br> $cuantos";
}//if($id_procedencia == "N" and $buscar){

if($id_procedencia == "I" and $buscar){
//if($id_procedencia == "I" and $buscar and $unidadessolicitadas){
$sqli="SELECT mpi.folio_m3_mpi as folio_m3_mpi, mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.etiquetados_folios_id AS etiquetados_folios_id, mpi.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpi.contenido AS contenido, mpi.comprobante_num AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, mpi.fecha_ingreso AS fecha_ingreso, est.estado_material AS estado_material, c.calibre AS calibre FROM mat_prima_importada AS mpi, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpi.id_producto = pro.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material and mpi.id_estado_material != 0  and mpi.id_estado_material = 1 and mpi.id_c_es_so = 0";
if($id_mat_prima_nacional){ $sqli.= " and mpi.id_mat_prima_importada = '$id_mat_prima_nacional' "; }
if($id_origen){ $sqli.= " and mpi.id_origen = '$id_origen' "; }
if($comprobante_num){ $sqli.= " and mpi.comprobante_num = '$comprobante_num' "; }
if($guia_imp){ $sqli.= " and mpi.guia_imp = '$guia_imp' "; }
if($id_producto){ $sqli.= " and mpi.id_producto = '$id_producto' "; }
if($id_calibre){ $sqli.= " and mpi.id_calibre = '$id_calibre' "; }
$sqli.= "  and mpi.id_solicitud_mp = 0 and mpi.fecha_asig_producc = '0000-00-00' order by mpi.id_mat_prima_importada asc";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);
//echo " cuantosi $cuantosi<br>";
//echo "sqli $sqli";
}//if($id_procedencia == "I" and $buscar){
}



$cuantostotales=$cuantos+$cuantosi;
	
	
	
//if($asignar and $unidadessolicitadas){
	if($asignar){
		 $dat1=split(" ",$fechaentreg);
	     $dat=split("-",$dat1[0]);
  		 $fechaentregok="$dat[2]-$dat[1]-$dat[0]";
	
 		 $fechasmp = date("Y-m-d");
		 $sql_smp="insert solicitud_mp(id_usuario,id_ldp,id_procedencia,id_origen,id_producto,id_calibre,fechasmp,fechaentreg) values ('$id_insuban','$id_ldp','$id_procedencia','$id_origen','$id_producto','$id_calibre','$fechasmp','$fechaentregok')";
    	 $result_smp=mysql_query($sql_smp,$link);
		 $id_ultimo=mysql_insert_id();
 		//echo "Sql $sql_smp<br>";
		$envio_solicitud=1;
		include "modulo_email/email1.php";
		 
foreach ($_POST as $key => $value)
{ 

 $dat=split("-",$key); 


   if ($dat[0] == 'id_mpi')
   {$id=$dat[1];
   	$id_mpilistard=$_POST["id_mpi-$id"];  
	
	if($id_procedencia =='N'){
	$id_mpilistardd="$id_mpilistard";
	$sqlimpbusca="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mpilistardd";
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
	$sqlupdate="UPDATE mat_prima_nacional  set id_solicitud_mp = '$id_ultimo', id_ldp='$id_ldp' where id_mat_prima_nacional  = $id_mp";
 	$resultupdate=mysql_query($sqlupdate);   
	}//if($id_procedencia =='N'){
		//echo "sqlupdate $sqlupdate<br>";
		
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
	$sqlupdate="UPDATE mat_prima_importada  set id_solicitud_mp = '$id_ultimo', id_ldp='$id_ldp'  where id_mat_prima_importada  = $id_mp";
 	$resultupdate=mysql_query($sqlupdate);   
	}//if($id_procedencia =='I'){
	
	$unidadessolicitadas=$contenido+$contenidoi;
	
	$sql_impk="insert solicitud_mp_detalle(id_solicitud_mp,id_ldp,id_mp) values ('$id_ultimo','$id_ldp','$id_mp')";
    $result_smpk=mysql_query($sql_impk,$link);
	
	
	
	
	
	//echo "sql_smpk $sql_impk<br>";
//	echo "$id_mat_prima_importadabusca - $id_producto - $id_calibre - $id_origen<br>";

	}
 }
 
 $sqlupdatecantidad="UPDATE solicitud_mp  set unidadessolicitadas = '$unidadessolicitadas' where id_solicitud_mp=$id_ultimo and id_ldp  = $id_ldp";
 	$resultupdatecantidad=mysql_query($sqlupdatecantidad);   
	
	//echo "sqlupdatecantidad $sqlupdatecantidad<br>";
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pendientesmp.php&id_ldp=$id_ldp&tip=2\">";
 exit;
}//if($asignar){


?>
<script language="JavaScript">
function isMailReady(form1) {
var passed = false;
if (document.form1.id_procedencia.value==0) {     
    alert('Debe seleccionar procedencia');
    document.form1.id_procedencia.onfocus;
    return false;
}
if (document.form1.id_producto.value==0) {     
    alert('Debe seleccionar producto');
    document.form1.id_producto.onfocus;
    return false;
}
if (document.form1.id_origen.value==0) {     
    alert('Debe seleccionar origen');
    document.form1.id_origen.onfocus; 
    return false;
}
if (document.form1.fechaentreg.value=="") {     
    alert('Debe ingresar fecha de entrega a produccion');
    document.form1.fechaentreg.onfocus;
    return false;
}

if (document.form1.fecha_asig_producc.value=="") {     
    alert('Debe ingresar fecha de entrega a produccion');
    document.form1.fecha_asig_producc.onfocus;
    return false;
}


else {
getInfo(form1);
passed = true;
}
return passed;
}
</SCRIPT>
<h1>SOLICITUD MP</h1>
<table width="1004" border="0">
 <tr>
   <td height="8" colspan="13">&nbsp;
    <? include "filtro_pt.php";?></td>
  </tr>
 <tr>
   <? if($cuantostotales){?>
   <td width="21" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="12" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
 </tr>
  <tr>
    <td width="21" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="35" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="60" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="85" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;
        <? if($id_procedencia == "I"){ ?>
        FACTURA
        <? }?>
        <? if($id_procedencia == "N"){ ?>
        GUIA
        <? }?>
    </strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><center><a href="javascript:seleccionar_todo()"><img src="codphp/jpgnew/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="codphp/jpgnew/ninguno.jpg" width="13" height="13" border="0"/></a></center></td>
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
	
	if(!$unidadessolicitadas){
	 $unidadessolicitadas=9999999999999999;
	}
	
    if($nacmp <= $unidadessolicitadas){
			$nacmp=$nacmp + $contenido;
	?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>"><center>&nbsp;<? echo $i?></center></td>
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
      &nbsp;<? echo $fecha_ingreso?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_faena?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_termino?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $row[estado_material]?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>&nbsp;<? echo $row[bidon_num]?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? if($row[id_solicitud_mp] == 0){?>
      <input type="checkbox" name="id_mpi-<? echo $id_mat_prima_nacional?>" id="id_mpi" value="<? echo $id_mat_prima_nacional?>" />
      <? }else{ echo "X"; } ?>
      </center>
    </td>
    <? }
	}
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
  $folio_m3_mpi=$rowi[folio_m3_mpi];  
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$id_mat_prima_importada2=$rowi[id_mat_prima_importada];
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$id_producto=$rowi[id_producto];
	$id_origen=$rowi[id_origen];
	$id_calibre=$rowi[id_calibre];
	$fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   
	$contenidoi=$rowi[contenido];
	$cuentabidonesi=$rowi[cuentabidones];
	$comprobante_num=$rowi[comprobante_num];
	
	if(!$unidadessolicitadas){
	 $unidadessolicitadas=9999999999999999;
	}
	
	   if($nacmpi <= $unidadessolicitadas){
		$nacmpi=$nacmpi +$contenidoi;
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>"><center>&nbsp;<? echo $ii=$i+$cuantos?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>"><!-- S --><? 
	 $largo=strlen($id_mat_prima_importada);
	 
	 if($etiquetados_folios_id)
	 {
	  echo "$etiquetados_folios_id";
	 }else{
		
		if($largo == 9){
	 	$id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 	}
//	 	echo $id_mat_prima_importada;
        echo $folio_m3_mpi;
	 }//if($etiquetados_folios_id)?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$rowi[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $comprobante_num ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      &nbsp;<? echo $fecha_ingreso?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_vencimiento?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $rowi[estado_material]?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[bidon_num]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">
      <? if($rowi[id_solicitud_mp] == 0){?>
      <input type="checkbox" name="id_mpi-<? echo $id_mat_prima_importada2?>" id="id_mpi" value="<? echo $id_mat_prima_importada2?>" />
      
      <? }else{ echo "<center><strong>X</strong></center>"; } ?>
      
    </td>
    <? }
	}
	
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
    <td colspan="3" align="right">&nbsp;</td>
    <? }?>
  </tr>
  <tr>
    <td colspan="13" align="right">
    <? 
	if($id_producto and $unidadessolicitadas and $buscar){?>
    <input type="submit" name="asignar" id="asignar" value="Asignar" />
    <? } ?>
    </td>
  </tr>

</table>
