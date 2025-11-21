<?
$sql="SELECT * FROM unidad_medida where id_unidad_medida  != 0 and unidad_medida != '' ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="600" height="180" border="0" align="center">
  <tr>
    <td width="596" valign="top"><table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="30" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;N&deg;</td>
        <td width="522" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Unidades de Medidas</td>
        <td width="40" bgcolor="#CCCCCC" class="titulo">&nbsp; ID </td>
      </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_unidad_medida=$row[id_unidad_medida];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i;?></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=unidades_medidas.php&id_uni=<?echo $row[id_unidad_medida]?>"><?echo $row[unidad_medida]?></a></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $id_unidad_medida;?></td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>