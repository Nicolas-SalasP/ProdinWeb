<?
$sql="SELECT smp.id_solicitud_mp AS id_solicitud_mp,smp.fechasmp AS fechasmp, smp.fechaentreg AS fechaentreg , smp.fechainformar AS fechainformar,smp.unidadessolicitadas AS unidadessolicitadas, org.origen AS origen, p.producto AS producto, c.calibre AS calibre, u.username AS username  
FROM solicitud_mp AS smp, origenes AS org, producto AS p, calibre AS c, usuarios AS u
WHERE smp.id_solicitud_mp = smp.id_solicitud_mp
AND smp.id_origen = org.id_origen
AND smp.id_calibre = c.id_calibre
AND smp.id_usuario = u.id_usuario
AND smp.id_producto = p.id_producto AND smp.id_ldp = $id_ldp and smp.fecharecep  = '0000-00-00' and smp.fecharechazomp = '0000-00-00'";
$result=mysql_query($sql);
$cuantossmp=mysql_num_rows($result);
//echo "sql $sql<br>"; 

?>
<style type="text/css">
<!--
.cajas {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>

<h1>SOLICITUD DE PRODUCCION PENDIENTES</h1>
<table width="1010" border="0">
 <tr>
   <td height="8" colspan="8">&nbsp;</td>
  </tr>
 <tr>
 
   <td width="20" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="7" bgcolor="#CCCCCC">&nbsp;<strong>
   <?
   if($id_ldp == 1){
   echo "ENTUBADO";
   }
   if($id_ldp == 2){
   echo "CALIBRADO";
   }
   ?>
   </strong>
   </td>
 </tr>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>N&deg; SOLICIT</strong>
    </center></td>
    <td width="106" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;</strong><strong>PRODUCTO</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="60" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong><strong>&nbsp;</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="80" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO SOLICITUD</strong></td>
    <td width="80" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/PLAZO DE ENTREGA</strong></td>
    <td width="60" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ENCARGADO</strong><strong>&nbsp;</strong><strong>&nbsp;</strong></td>
  </tr>
     <?
	
    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_solicitud_mp=$row[id_solicitud_mp];
	//$id_ldp =$row[id_origen];
	$id_procedencia=$row[id_producto];
	$username=$row[username];
	$id_origen=$row[id_origen];
	$id_producto=$row[id_producto];
	$id_calibre=$row[id_calibre];
	$unidadessolicitadas=$row[unidadessolicitadas];
	$fechasmp=format_fecha_sin_hora($row[fechasmp]);   
	$fechaentreg=format_fecha_sin_hora($row[fechaentreg]);   
	$fechainformar=format_fecha_sin_hora($row[fechainformar]);   
	$totaluni+=$unidadessolicitadas;
	
	 if($fechainformar != '00-00-0000'){
	$color = ($color == "#FFFF00") ? "#FFFF00" : "#FFFF00";
	}else{
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	}

  ?>
  <tr>
    <td height="8" align="center" bgcolor="<? echo $color?>">&nbsp;<? echo $id_solicitud_mp?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=pendientesmpdetalle.php&id_solicitud_mp=<? echo $id_solicitud_mp?>&id_ldp=<? echo $id_ldp?>&tip=<? echo $tip?>"><? echo $row[producto]?></a></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?>&nbsp;</td>
    <td nowrap="nowrap" align="center" bgcolor="<? echo $color?>">&nbsp;<? echo $unidadessolicitadas?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $fechasmp?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $fechaentreg?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $username?></td>
    <? 
	}
	?>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>TOTAL</td>
      <td align="center" bgcolor="#CCCCCC"><strong><? echo $totaluni?></strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8"><br>
        Nota: Las solicitudes de produccion en color amarillo  estan completadas por el bodeguero. El encargado de produccion debera proceder con la recepci&oacute;n.</td>
    </tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
</table>
