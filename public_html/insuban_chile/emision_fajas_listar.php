<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
-->
</style>

<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>

<form id="form1" name="form1" method="post" action="">
<table width="610" height="80" border="0" align="center">
  <tr>
    <td width="242" height="9" valign="top"><span class="titulo">Listar Emisi&oacute;n Fajas </span></td>
    <td width="358" valign="top" class="cajas"><div align="right"><a href="?modulo=emision_fajas.php">Volver a Emisi&oacute;n Fajas </a></div></td>
  </tr>
  <tr>
    <td height="3" colspan="2" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td height="20" colspan="2" valign="top"><input name="dato" type="text" size="15" maxlength="50"/>
      <input name="buscar" type="submit" value="Buscar" /></td>
    </tr>
  <tr>
    <td height="38" colspan="2" valign="top"><table width="628" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="61" height="14" bgcolor="#CCCCCC" class="titulo">N&ordm;</td>
        <td width="160" height="14" bgcolor="#CCCCCC" class="titulo">Producto</td>
        <td width="153" bgcolor="#CCCCCC" class="titulo">Unidad Produccion</td>
        <td width="111" bgcolor="#CCCCCC" class="linknegro"><span class="titulo">Fecha Emisi&oacute;n </span></td>
        <td width="131" bgcolor="#CCCCCC" class="linknegro"><span class="titulo">Fecha Vencimiento </span></td>
      </tr>
      <?
	  
	  $largo=strlen($dato);
	  $newano=substr($dato, 0, 2);
	  $newano="20".$newano;
	  $newdato=substr($dato, 2, $largo);
	
if($dato){
$sql="SELECT * FROM fajas AS f, unidad_produccion AS u, producto AS pro WHERE f.id_unidad_produccion = u.id_unidad_produccion and f.id_producto = pro.id_producto and f.id_faja ='$newdato' order by femision desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM fajas AS f, unidad_produccion AS u, origenes AS orig, producto AS pro WHERE f.id_unidad_produccion = u.id_unidad_produccion  and f.id_origen = orig.id_origen and f.id_producto = pro.id_producto and f.ano = 2009 order by f.id_faja desc ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
echo " cuantos $cuantos";
}
	 
	  
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_faja=$row[id_faja];
	$i++;
	 $femision=format_fecha_sin_hora($row[femision]);
	  $fvencimiento=format_fecha_sin_hora($row[fvencimiento]);
	  $ffaena=format_fecha_sin_hora($row[ffaena]);
	?>
      <tr>
        <td class="cajas"><?php echo substr($row[ano],2,4); ?><? echo $row[id_faja];?></td>
        <td class="cajas"><a href="?modulo=emision_fajas.php&amp;id_f=<?echo $row[id_faja]?>"><?echo $row[producto]?></a></td>
        <td class="cajas"><a href="?modulo=emision_fajas.php&id_f=<?echo $row[id_faja]?>"><?echo $row[nombreuni]?></a></td>
        <td class="cajas"><a href="?modulo=emision_fajas.php&id_f=<?echo $row[id_faja]?>"><?echo $femision?></a></td>
        <td class="cajas"><a href="?modulo=emision_fajas.php&id_f=<?echo $row[id_faja]?>"><?echo $fvencimiento?></a></td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>