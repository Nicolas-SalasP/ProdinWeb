<?
$sql="SELECT * FROM lineas_procesos where id_lineas_procesos != 0";
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
<table width="358" height="194" border="0" align="center">
  <tr>
    <td width="277" height="30" valign="top"><span class="titulo">Listar Lineas Procesos </span></td>
    <td width="119" valign="top" class="cajas"><a href="?modulo=lineas_procesos.php">Volver  Lineas Procesos </a></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><table width="400" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="27" height="14" bgcolor="#CCCCCC" class="titulo">N&ordm;</td>
        <td height="14" bgcolor="#CCCCCC" class="titulo">Nombre</td>
        <td height="14" bgcolor="#CCCCCC" class="titulo">Sector</td>
        </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_lineas_procesos=$row[id_lineas_procesos];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas"><? echo $i;?></td>
        <td width="193" nowrap="nowrap" class="cajas"><a href="?modulo=lineas_procesos.php&id_li=<?echo $row[id_lineas_procesos]?>"><?echo $row[nombre]?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas"><a href="?modulo=lineas_procesos.php&amp;id_li=<?echo $row[id_lineas_procesos]?>"><?echo $row[sector]?></a><a href="?modulo=lineas_procesos.php&amp;id_li=<?echo $row[id_lineas_procesos]?>"></a>&nbsp;</td>
        </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>