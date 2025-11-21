<?
$sql="SELECT * FROM medidas_productos where id_medidas_productos  != 0 and medidas_productos != ''";
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
        <td height="14" colspan="4" class="titulo"><div align="right"><a href="?modulo=medidas_productos.php&amp;nuevo=1" >Ingresar Nuevo</a></div></td>
        </tr>
      <tr>
        <td width="29" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;N&deg;</td>
        <td width="164" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Medidas</td>
        <td width="357" bgcolor="#CCCCCC" class="titulo">&nbsp;P/C&oacute;d Barras</td>
        <td width="40" bgcolor="#CCCCCC" class="titulo">&nbsp;ID </td>
      </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_medidas_productos=$row[id_medidas_productos];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i;?></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=medidas_productos.php&id_med=<?echo $row[id_medidas_productos]?>"><?echo $row[medidas_productos]?></a></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[pcod_barras]?>&nbsp;</td>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $id_medidas_productos;?></td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>