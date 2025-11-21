<?
$sql="SELECT smp.id_solicitud_mp AS id_solicitud_mp,smp.fechasmp AS fechasmp, smp.fecharecep AS fecharecep, smp.fechaentreg AS fechaentreg, smp.fecha_asig_producc AS fecha_asig_producc, smp.unidadessolicitadas AS unidadessolicitadas, org.origen AS origen, p.producto AS producto, c.calibre AS calibre, u.username AS username  
FROM solicitud_mp AS smp, origenes AS org, producto AS p, calibre AS c, usuarios AS u
WHERE smp.id_solicitud_mp = smp.id_solicitud_mp
AND smp.id_origen = org.id_origen
AND smp.id_calibre = c.id_calibre
AND smp.id_usuario = u.id_usuario
AND smp.id_producto = p.id_producto AND smp.id_ldp =$id_ldp AND smp.fecha_asig_producc != '0000-00-00' group by smp.fecha_asig_producc order by smp.fecha_asig_producc desc";
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

<h1>LINEA DE PROCESO</h1>
<table width="100%" border="0">
 <tr>
   <td height="8" colspan="9">&nbsp;</td>
  </tr>
 <tr>
 
   <td width="21" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="8" bgcolor="#CCCCCC">&nbsp;<strong>
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
    <td width="21" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td colspan="2" nowrap="nowrap" bgcolor="#FF9933"><strong>PRODUCTO</strong></td>
    <td colspan="2" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="93" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="94" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/ENTREGA</strong></td>
    <td width="113" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/RECEPCION</strong></td>
    <td width="125" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/PRODUCCION</strong></td>
  </tr>
     <?
	
    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_procedencia=$row[id_producto];
	$id_producto=$row[id_producto];
	$fechasmp=format_fecha_sin_hora($row[fechasmp]);   
	$fecharecep=format_fecha_sin_hora($row[fecharecep]);  
	$fechaentreg=format_fecha_sin_hora($row[fechaentreg]);  
	$fecha_asig_producc =format_fecha_sin_hora($row[fecha_asig_producc]);  
	
  ?>
  <tr>
    <td height="19" align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td colspan="2" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=pproduccdetalle.php&fecha_asig_producc=<? echo $row[fecha_asig_producc]?>&id_ldp=<? echo $id_ldp?>&infomenu=1&tip=<? echo $tip?>"><? echo $row[producto]?></a>
  <!--    <a href="?modulo=pproduccdetalle.php&id_solicitud_mp=<? echo $id_solicitud_mp?>&id_ldp=<? echo $id_ldp?>&infomenu=1&tip=<? echo $tip?>"><? echo $row[producto]?></a>-->
    </td>
    <td colspan="2" bgcolor="<? echo $color?>">&nbsp;<? $sqlmuestraorgi="SELECT org.origen AS origen FROM solicitud_mp AS smp, origenes AS org, producto AS p, calibre AS c, usuarios AS u WHERE smp.id_solicitud_mp = smp.id_solicitud_mp AND smp.id_origen = org.id_origen AND smp.id_calibre = c.id_calibre AND smp.id_usuario = u.id_usuario AND smp.id_producto = p.id_producto AND smp.id_ldp =1 AND smp.fecha_asig_producc = '$row[fecha_asig_producc]' ";	
	$resultmuestraorgi=mysql_query($sqlmuestraorgi); $cuantosmuestraorgines=mysql_num_rows($resultmuestraorgi);	
	   while ($rowmuestraorigen=mysql_fetch_array($resultmuestraorgi))
    		{
			$origen=$rowmuestraorigen[origen];
			echo "$origen / ";
			}
	?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechasmp?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechaentreg?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecharecep?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_asig_producc ?></td>
    <? 
	}
	?>
  </tr>
</table>