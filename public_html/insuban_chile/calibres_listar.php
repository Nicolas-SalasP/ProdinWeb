<?
$sql="SELECT * FROM calibre where id_calibre != 0 and calibre !='' and onoff != 1 group by calibre order by id_calibre asc";
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
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="650" height="180" border="0" align="center">
  <tr>
    <td width="596" valign="top"><table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="7" colspan="3" class="titulo"><div align="right"><a href="?modulo=calibres.php&amp;nuevo=1" >Ingresar Nuevo</a></div></td>
        </tr>
      <tr>
        <td width="30" height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;N&deg;</td>
        <td width="522" height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;Calibres</td>
        <td width="40" height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;ID </td>
      </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_calibre=$row[id_calibre];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i;?></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=calibres.php&id_cali=<?echo $row[id_calibre]?>"><?echo $row[calibre]?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas"><span class="style1">&nbsp;<? echo $id_calibre?></span></td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>