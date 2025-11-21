<style type="text/css">
<!--
.cajas {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>

<h1>PLANILLAS DE PRODUCCION</h1>
<table width="100%" border="0">
 <tr>
   <td height="8" colspan="3">&nbsp;</td>
  </tr>
 <tr>
 
   <td width="21" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="2" bgcolor="#CCCCCC">&nbsp;<strong>
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
    <td width="21" height="8" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="469" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FECHA DE PRODUCCION</strong></td>
    <td width="536" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FECHA DE CIERRE DE PRODUCCION</strong></td>
  </tr>
  <?  
     $sql="SELECT * FROM planilla_registro_fecha_asig_produccion WHERE id_ldp = $id_ldp group by fecha_asig_producc desc";
     $result=mysql_query($sql);
     $cuantas_planillas=mysql_num_rows($result);
	  
     if($cuantas_planillas){
	 $i=$op;
     $color = "#000000";$i = 0;
     while ($row=mysql_fetch_array($result))
     {
	 $i++;
	 $color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	 $fecha_asig_producc=$row[fecha_asig_producc];
	 $fecha_cierre_producc=$row[fecha_cierre_producc];
  ?>
  <tr>
    <td height="8" align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=pproduccdetalle.php&id_ldp=<? echo $id_ldp?>&fecha_asig_producc=<? echo $fecha_asig_producc?>&fecha_cierre_producc=<? echo $fecha_cierre_producc?>&tip=<? echo $tip?>"><? echo $fecha_asig_producc ?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_cierre_producc ?></td>
   </tr> 
  <? }
	 }
  ?>

</table>