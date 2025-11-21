<?
ini_set('memory_limit', '-1');

$sql="SELECT * FROM etiquetas where id_etiquetas != 0";
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
        <td width="29" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm;</td>
        <td height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Etiquetas</td>
        <td width="314" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Descripci&oacute;n</td>
        <td width="40" bgcolor="#CCCCCC" class="titulo">&nbsp;ID</td>
      </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_etiquetas=$row[id_etiquetas];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i;?></td>
        <td width="207" nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=etiquetas.php&id_et=<?echo $row[id_etiquetas]?>"><?echo $row[etiquetas]?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=etiquetas.php&amp;id_et=<?echo $row[id_etiquetas]?>"><?echo $row[descripcion]?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $id_etiquetas;?></td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>