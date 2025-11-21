<?
$sql="SELECT * FROM ids";
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
<table width="486" height="194" border="0" align="center">
  <tr>
    <td width="449" height="20" valign="top"><span class="titulo">Listar Ids </span></td>
    <td width="147" valign="top" class="cajas"><a href="?modulo=articulos_prod_sem.php">Volver a Ids </a></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="27" height="14" bgcolor="#CCCCCC" class="titulo">N&ordm;</td>
        <td height="14" bgcolor="#CCCCCC" class="titulo">Nombre</td>
        <td height="14" bgcolor="#CCCCCC" class="titulo">Descripc&oacute;n</td>
        </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_ids=$row[id_ids];
	$i++;
	?>
      <tr>
        <td class="cajas"><? echo $i;?></td>
        <td width="193" class="cajas"><a href="?modulo=ids.php&id_id=<?echo $row[id_ids]?>"><?echo $row[tabla]?></a>&nbsp;</td>
        <td class="cajas"><a href="?modulo=ids.php&amp;id_id=<?echo $row[id_ids]?>"><?echo $row[descripcion]?></a>&nbsp;</td>
        </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>