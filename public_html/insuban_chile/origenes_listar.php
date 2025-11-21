<?
$sql="SELECT * FROM origenes AS org, estado AS es where org.id_origen != 0 and org.id_estado = es.id_estado order by org.origen , es.estado asc";
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
<table width="827" height="115" border="0" align="center">
  <tr>
    <td width="821" valign="top"><table width="688" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="7" colspan="7" class="titulo"><div align="right"><a href="?modulo=origenes.php&amp;nuevo=1" >Ingresar Nuevo </a></div></td>
        </tr>
      <tr>
        <td width="29" height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm;</td>
        <td width="150" height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;Origenes</td>
        <td width="41" bgcolor="#CCCCCC" class="titulo">&nbsp;Codigo</td>
        <td width="154" bgcolor="#CCCCCC" class="linknegro"><span class="titulo">&nbsp;Domicilio</span></td>
        <td width="145" bgcolor="#CCCCCC" class="linknegro"><span class="titulo">&nbsp;Ciudad</span></td>
        <td width="51" align="center" bgcolor="#CCCCCC" class="linknegro"><span class="titulo">&nbsp;Estado</span><span class="titulo">&nbsp;</span></td>
        <td width="102" align="center" bgcolor="#CCCCCC" class="linknegro"><span class="titulo">Procedencia</span></td>
        </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_origen=$row[id_origen];
	$id_procedencia=$row[id_procedencia];
	$estado=$row[estado];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i;?></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=origenes.php&id_orig=<?echo $row[id_origen]?>"><?echo $row[origen]?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=origenes.php&amp;id_orig=<?echo $row[id_origen]?>"><?echo $row[cod]?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=origenes.php&id_orig=<?echo $row[id_origen]?>"><?echo $row[domicilio]?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=origenes.php&id_orig=<?echo $row[id_origen]?>"><?echo $row[ciudad]?></a>&nbsp;</td>
        <td align="center" nowrap="nowrap" class="cajas">&nbsp;<? echo $estado;?></td>
        <td align="center" nowrap="nowrap" class="cajas">&nbsp;<? echo $id_procedencia?></td>
        </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>