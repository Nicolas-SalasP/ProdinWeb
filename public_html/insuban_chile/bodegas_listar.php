<?
$sql="SELECT * FROM bodegas where id_bodegas != 0";
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
<form id="form1" name="form1" method="post" action="" onsubmit = "return isMailReady(this);">
<table width="600" height="159" border="0" align="center">
  <tr>
    <td width="596" valign="top"><table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="7" colspan="3" class="titulo"><div align="right"><a href="?modulo=bodegas.php&amp;nuevo=1" >Ingresar Nuevo </a></div></td>
        </tr>
      <tr>
        <td width="28" height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm;</td>
        <td width="524" height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;Bodegas</td>
        <td width="40" bgcolor="#CCCCCC" class="titulo">&nbsp;ID</td>
      </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_bodegas=$row[id_bodegas];
	$i++;
	?>
      <tr>
        <td class="cajas">&nbsp;<? echo $i;?></td>
        <td class="cajas">&nbsp;<a href="?modulo=bodegas.php&id_bo=<?echo $row[id_bodegas]?>"><?echo $row[bodegas]?></a></td>
        <td class="cajas">&nbsp;<? echo $id_bodegas;?></td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>