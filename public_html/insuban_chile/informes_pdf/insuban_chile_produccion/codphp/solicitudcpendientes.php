<h1>CAMBIOS DE ESTADOS PENDIENTES</h1>
<table width="1010" border="0">
 <tr>
   <td height="8" colspan="10"><? 
			$cambio_estado= crea_cambio_estado_ok($link,$id_ce,1);
			echo $cambio_estado;
			?></td>
  </tr>
  <?  
  //echo "id_ce $id_ce<br>";
  if($id_ce){


$sql="SELECT ces.id_c_es_so AS id_c_es_so,ces.id_ce AS id_ce, ces.unidadessolicitadas AS unidadessolicitadas, pro.producto AS producto, org.origen AS origen, proc.id_procedencia AS id_procedencia, ces.fechaces AS fechaces, ces.fechaentrega AS fechaentrega, ces.fechainformar AS fechainformar, us.username AS username, cambio_estado As cambio_estado from usuarios AS us, cambio_estado_solicitud AS ces, procedencia AS proc, producto AS pro, origenes AS org, cambio_estado AS cestado where ces.id_usuario = us.id_usuario and ces.id_procedencia = proc.id_procedencia and ces.id_origen = org.id_origen and ces.id_producto = pro.id_producto and ces.id_ce  = cestado.id_ce  and ces.id_ce = $id_ce and ces.fecharecep  = '0000-00-00' and ces.fecha_cierre_proceso = '0000-00-00' and ces.fechaanulacion = '0000-00-00' and ces.fecharechazo = '0000-00-00'";
$result=mysql_query($sql);
$cuantossmp=mysql_num_rows($result);
 
//echo "sql $sql<br>"; 
if($cuantossmp){
	  ?>
 <tr>
 
   <td width="28" height="19" bgcolor="#FF9933">&nbsp;</td>
   <td colspan="8" bgcolor="#CCCCCC">&nbsp;</td>
 </tr>
  <tr>
    <td width="28" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="176" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;</strong><strong>PRODUCTO</strong></td>
    <td width="75" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;</strong><strong>CALIBRE</strong></td>
    <td width="133" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="101" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="181" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO SOLICITUD</strong></td>
    <td width="175" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/PLAZO DE ENTREGA</strong></td>
    <td width="107" colspan="3" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ENCARGADO</strong></td>
  </tr>

     <?
	
    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_c_es_so=$row[id_c_es_so];
	//$id_ldp =$row[id_origen];
	$id_procedencia=$row[id_producto];
	$username=$row[username];
	$id_ce=$row[id_ce];
	$id_origen=$row[id_origen];
	$id_procedencia=$row[id_procedencia];
	$id_producto=$row[id_producto];
	$cambio_estado=$row[cambio_estado];
	$unidadessolicitadas=$row[unidadessolicitadas];
	$fechaces=format_fecha_sin_hora($row[fechaces]);   
	$fechaentrega=format_fecha_sin_hora($row[fechaentrega]);   
	$fechainformar=format_fecha_sin_hora($row[fechainformar]);   
	$totaluni+=$unidadessolicitadas;
	
	 if($fechainformar != '00-00-0000'){
	$color = ($color == "#FFFF00") ? "#FFFF00" : "#FFFF00";
	}else{
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	}
  ?>
  <tr>
    <td height="8" align="center"  bgcolor="<? echo $color?>">&nbsp;<? echo $id_c_es_so?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=solicitudcdetalle.php&id_c_es_so=<? echo $id_c_es_so?>&id_procedencia=<? echo $id_procedencia?>&id_ce=<? echo $id_ce ?>&tic=<? echo $tic?>"><? echo $row[producto]?></a></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td  bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td  bgcolor="<? echo $color?>">&nbsp;<? echo $unidadessolicitadas?></td>
    <td  bgcolor="<? echo $color?>">&nbsp;<? echo $fechaces ?></td>
    <td  bgcolor="<? echo $color?>">&nbsp;<? ECHO $fechaentrega?></td>
    <td  bgcolor="<? echo $color?>">&nbsp;<? echo $username?></td>
    <? } // while ($row=mysql_fetch_array($result)) ?>
  
  </tr>
  <tr>
    <td height="-1">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">TOTAL</td>
    <td  bgcolor="#CCCCCC">&nbsp;<strong><? echo $totaluni;?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="2" colspan="8"><br />
Nota: Las solicitudes de comercial en color amarillo  estan completadas por el bodeguero. El encargado de comercial debera proceder con la recepci&oacute;n.</td>
  </tr>
  <? }
}
	?>

</table>
