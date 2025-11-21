<style type="text/css">
<!--
.cajas {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>

<h1>CAMBIOS DE ESTADOS RECHAZADOS </h1>
<table width="1010" border="0">
 <tr>
   <td height="8" colspan="9"><? 
			$cambio_estado= crea_cambio_estado_ok($link,$id_ce,1);
			echo $cambio_estado;
			?></td>
  </tr>
  <?  
  //echo "id_ce $id_ce<br>";
  if($id_ce){
	  
	  $sql="select ces.id_c_es_so AS id_c_es_so, ces.unidadessolicitadas AS unidadessolicitadas, ce.cambio_estado AS cambio_estado, ce.id_ce AS id_ce, us.username AS username, proc.procedencia AS procedencia, pro.producto AS producto, org.origen AS origen, ces.fechaces AS fechaces, ces.fechainformar AS fechainformar, ces.fechaentrega AS fechaentrega, ces.fecharechazo AS fecharechazo, ces.fecha_cierre_proceso AS fecha_cierre_proceso, ces.observacionesces AS observacionesces from  cambio_estado_solicitud AS ces, cambio_estado AS ce, procedencia AS proc, usuarios AS us, origenes AS org, producto AS pro where ces.id_ce = ce.id_ce and ces.id_ce = $id_ce and ces.id_origen = org.id_origen and ces.id_procedencia = proc.id_procedencia and ces.id_usuario = us.id_usuario and ces.id_producto = pro.id_producto and ces.fecharechazo != '0000-00-00' and ces.fecha_cierre_proceso = '0000-00-00'";
$result=mysql_query($sql);

 $cuantos=mysql_num_rows($result);
//echo "sql $sql<br>"; 
//echo "cuantossmp $cuantos<br>";
if($cuantos){
	  ?>
 <tr>
 
   <td width="21" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="8" bgcolor="#CCCCCC">&nbsp;</td>
 </tr>
  <tr>
    <td width="21" height="8" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="100" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;</strong><strong>PRODUCTO</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="100" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="120" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO SOLICITUD</strong></td>
    <td width="120" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/PLAZO DE ENTREGA</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/RECHAZADO</strong></td>
    <td width="60" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ENCARGADO</strong><strong>&nbsp;</strong><strong>&nbsp;</strong></td>
  </tr>
     <?
	
	
	
    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_c_es_so=$row[id_c_es_so];
	$id_ce =$row[id_ce];
	$id_procedencia=$row[id_producto];
	$username=$row[username];
	$id_origen=$row[id_origen];
	$id_producto=$row[id_producto];
	$id_calibre=$row[id_calibre];
	$unidadessolicitadas=$row[unidadessolicitadas];
	$fechaces=format_fecha_sin_hora($row[fechaces]);   
	$fechaentrega=format_fecha_sin_hora($row[fechaentrega]);   
	$fecharechazo=format_fecha_sin_hora($row[fecharechazo]);   
	$totaluni+=$unidadessolicitadas;
  ?>
  <tr>
    <td height="8" align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $id_c_es_so?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=solicitudcdetalle.php&id_c_es_so=<? echo $id_c_es_so?>&id_ce=<? echo $id_ce?>&tic=<? echo $tic?>"><? echo $row[producto]?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $unidadessolicitadas?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechaces?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechaentrega?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecharechazo?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $username?></td>
    <? 
	}
	?>
  </tr>
    <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">TOTAL</td>
   <td align="center" bgcolor="#CCCCCC"><strong><? echo $totaluni?></strong></td>
    <td align="right">&nbsp;</td>
    <td colspan="2" align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
   </tr>
   <? } 
  }?>
</table>