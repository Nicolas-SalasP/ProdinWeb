<?
$sql="SELECT * FROM unidad_produccion where id_unidad_produccion != 0 order by nombreuni asc";
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
<table width="650" height="159" border="0" align="center">
  <tr>
    <td width="596" valign="top"><table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="14" colspan="6" class="titulo"><div align="right"><a href="?modulo=unidades_produccion.php&amp;nuevo=1" >Ingresar Nuevo </a></div></td>
        </tr>
      <tr>
        <td width="25" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm;</td>
        <td height="14" bgcolor="#CCCCCC" class="titulo">Unidades de Producci&oacute;n</td>
        <td height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Direcci&oacute;n</td>
        <td height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Comuna</td>
        <td height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Ciudad</td>
        <td bgcolor="#CCCCCC" class="titulo">&nbsp;ID</td>
      </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_unidad_produccion=$row[id_unidad_produccion];
	$i++;
	?>
      <tr>
        <td class="cajas">&nbsp;<? echo $i;?></td>
        <td width="188" class="cajas">&nbsp;<a href="?modulo=unidades_produccion.php&id_un=<?echo $row[id_unidad_produccion]?>"><?echo $row[nombreuni]?></a>&nbsp;</td>
        <td width="156" class="cajas">&nbsp;<a href="?modulo=unidades_produccion.php&amp;id_un=<?echo $row[id_unidad_produccion]?>"><?echo $row[direccion]?></a>&nbsp;</td>
        <td width="85" class="cajas">&nbsp;<a href="?modulo=unidades_produccion.php&amp;id_un=<?echo $row[id_unidad_produccion]?>"><?echo $row[comuna]?></a>&nbsp;</td>
        <td width="92" class="cajas">&nbsp;<a href="?modulo=unidades_produccion.php&amp;id_un=<?echo $row[id_unidad_produccion]?>"><?echo $row[ciudad]?></a></td>
        <td width="40" class="cajas">&nbsp;<? echo $id_unidad_produccion;?></td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>