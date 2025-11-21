<?
$sql="SELECT * FROM datos_empresa where id_datos_empresa != 0";
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
    <td valign="top"><table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="7" colspan="5" class="titulo"><div align="right"><a href="?modulo=datos_empresa.php&amp;nuevo=1" >Ingresar Nuevo </a></div></td>
        </tr>
      <tr>
        <td width="26" height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm;</td>
        <td height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;Datos Empresas </td>
        <td height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;Direcci&oacute;n</td>
        <td width="160" height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;Comuna </td>
        <td width="40" bgcolor="#CCCCCC" class="titulo">&nbsp;ID</td>
      </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_datos_empresa=$row[id_datos_empresa];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i;?></td>
        <td width="192" nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=datos_empresa.php&id_da=<?echo $row[id_datos_empresa]?>"><?echo $row[nombreemp]?></a></td>
        <td width="170" nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=datos_empresa.php&amp;id_da=<?echo $row[id_datos_empresa]?>"><?echo $row[direccion]?></a></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=datos_empresa.php&amp;id_da=<?echo $row[id_datos_empresa]?>"><?echo $row[comuna]?></a></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $id_datos_empresa;?></td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>