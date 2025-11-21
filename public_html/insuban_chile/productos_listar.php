<?
$sql="SELECT * FROM producto AS p, estado AS e where p.id_producto != 0 and p.id_estado = e.id_estado and p.producto!='' order by e.id_estado asc";
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
        <td height="14" colspan="5" class="titulo"><div align="right"><a href="?modulo=productos.php&amp;nuevo=1" >Ingresar Nuevo</a></div></td>
        </tr>
      <tr>
        <td width="29" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;N&deg;</td>
        <td width="243" bgcolor="#CCCCCC" class="titulo">Productos</td>
        <td bgcolor="#CCCCCC" class="linknegro"><span class="titulo">&nbsp;Codigo Sop</span></td>
        <td bgcolor="#CCCCCC" class="linknegro"><span class="titulo">&nbsp;ID </span></td>
        <td bgcolor="#CCCCCC" class="titulo">&nbsp;Estado</td>
      </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_producto=$row[id_producto];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i;?></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=productos.php&id_pro=<?echo $row[id_producto]?>"><?echo $row[producto]?></a>&nbsp;<? //echo $row[id_producto]?></td>
        <td width="138" nowrap="nowrap" class="cajas">&nbsp;<?echo $row[codigosop]?>&nbsp;</td>
        <td width="111" nowrap="nowrap" class="cajas">&nbsp;<? echo $id_producto;?></td>
        <td width="67" nowrap="nowrap" class="cajas">&nbsp;<?echo $row[estado]?>&nbsp;</td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>