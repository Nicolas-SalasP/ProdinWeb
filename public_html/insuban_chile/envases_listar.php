<?
$sql="SELECT * FROM envases where id_envases != 0";
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
<table width="650" height="180" border="0" align="center">
  <tr>
    <td width="596" valign="top"><table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="14" colspan="5" class="titulo"><div align="right"><a href="?modulo=envases.php&amp;nuevo=1" >Ingresar Nuevo </a></div></td>
        </tr>
      <tr>
        <td width="29" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm;</td>
        <td height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Envases</td>
        <td height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Unidades</td>
        <td width="154" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Peso Tara </td>
        <td width="40" bgcolor="#CCCCCC" class="titulo">&nbsp;ID</td>
      </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_envases=$row[id_envases];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i;?></td>
        <td width="206" nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=envases.php&id_en=<?echo $row[id_envases]?>"><?echo $row[envases]?></a></td>
        <td width="159" nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=envases.php&amp;id_en=<?echo $row[id_envases]?>"><?echo $row[unidades]?></a></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=envases.php&amp;id_en=<?echo $row[id_envases]?>"><?echo $row[peso_tara]?></a><a href="?modulo=envases.php&amp;id_en=<?echo $row[id_envases]?>"></a></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $id_envases;?></td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>