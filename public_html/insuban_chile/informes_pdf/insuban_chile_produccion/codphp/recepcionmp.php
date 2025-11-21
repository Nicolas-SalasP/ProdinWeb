<?
$sql="SELECT smp.id_solicitud_mp AS id_solicitud_mp,smp.fechasmp AS fechasmp, smp.fechaentreg AS fechaentreg, smp.fecharecep AS fecharecep, smp.fechaanulacionsmp AS fechaanulacionsmp, smp.unidadessolicitadas AS unidadessolicitadas, org.origen AS origen, p.producto AS producto, c.calibre AS calibre, u.username AS username  
FROM solicitud_mp AS smp, origenes AS org, producto AS p, calibre AS c, usuarios AS u
WHERE smp.id_solicitud_mp = smp.id_solicitud_mp
AND smp.id_origen = org.id_origen
AND smp.id_calibre = c.id_calibre
AND smp.id_usuario = u.id_usuario
AND smp.id_producto = p.id_producto AND smp.id_ldp =$id_ldp AND smp.fecharecep != '0000-00-00' AND smp.fecha_asig_producc = '0000-00-00' order by smp.id_solicitud_mp desc Limit 55 ";
$result=mysql_query($sql);
$cuantossmp=mysql_num_rows($result);
//echo "sql $sql<br>"; 
//echo "cuantossmp $cuantossmp<br>";
?>
<style type="text/css">
<!--
.cajas {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>

<h1>SOLICITUD DE PRODUCCION ACEPTADAS</h1>
<table width="100%" border="0">
 <tr>
   <td height="8" colspan="10">&nbsp;</td>
  </tr>
 <tr>
 
   <td width="20" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="9" bgcolor="#CCCCCC">&nbsp;<strong>
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
    <td width="21" height="8" nowrap="nowrap" bgcolor="#FF9933"><center>
      <strong>N&deg; SOLICIT</strong>
    </center></td>
    <td width="100" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;</strong><strong>PRODUCTO</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="140" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="120" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO SOLICITUD</strong></td>
    <td width="125" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/PLAZO DE ENTREGA</strong></td>
    <td width="66" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/RECEPCION</strong></td>
    <td width="67" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/ANULACION</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ENCARGADO</strong><strong>&nbsp;</strong><strong>&nbsp;</strong></td>
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
	$fecharecep=format_fecha_sin_hora($row[fecharecep]);   
	$fechaentreg=format_fecha_sin_hora($row[fechaentreg]);   
	$fechaanulacionsmp=format_fecha_sin_hora($row[fechaanulacionsmp]);   
	$totaluni+=$unidadessolicitadas;
	
  ?>
  <tr>
    <td height="8" align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $id_solicitud_mp?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=pendientesmpdetalle.php&id_solicitud_mp=<? echo $id_solicitud_mp?>&id_ldp=<? echo $id_ldp?>&infomenu=<? echo $infomenu?>&tip=<? echo $tip?>"><? echo $row[producto]?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $unidadessolicitadas?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechasmp?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechaentreg?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecharecep?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechaanulacionsmp?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $username?></td>
    <? 
	}
	?>
  </tr>
    <tr>
    <td colspan="3" align="right">&nbsp;</td>
    <td align="right">TOTAL</td>
   <td align="center" bgcolor="#CCCCCC"><strong><? echo $totaluni?></strong></td>
    <td colspan="5" align="right">&nbsp;</td>
   </tr>
</table>