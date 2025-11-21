<?
$sql="SELECT * FROM caract_envases where id_caract_envases != 0 and caract_envases != '' ";
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
        <td height="14" colspan="3" class="titulo"><div align="right"><a href="?modulo=caracteristica_envase.php&amp;nuevo=1" >Ingresar Nuevo</a></div></td>
        </tr>
      <tr>
        <td width="29" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm;</td>
        <td width="523" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Caracteristica Envase </td>
        <td width="40" bgcolor="#CCCCCC" class="titulo">&nbsp;ID </td>
      </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_caract_envases=$row[id_caract_envases];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i;?></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=caracteristica_envase.php&id_caracenv=<?echo $row[id_caract_envases]?>"><?echo $row[caract_envases]?></a></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $id_caract_envases;?></td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>