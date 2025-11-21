<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.estilo_cajon_buscar_contacto {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="600" height="65" border="0" align="center">
  <tr>
    <td width="518" height="14" valign="top"><span class="titulo">Listado de Calibres Asignados </span></td>
    <td width="78" valign="top"><a href="?modulo=planillas_produccion_diarias.php&amp;nuevo=1" class="cajas">Ingresar Nuevo</a></td>
  </tr>
    <tr>
    <td height="38" colspan="2" valign="top">
	
	
	<table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="30" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;</td>
        <td width="564" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Productos</td>
      </tr>
<?


$sql="SELECT * FROM  cruce_plant_calibre AS cpc, producto AS pro WHERE cpc.id_producto = pro.id_producto and pro.id_estado != 2 and pro.id_producto != 0 GROUP BY pro.id_producto order by pro.producto desc";
$result=mysql_query($sql);


	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_cruce_plant_calibre=$row[id_cruce_plant_calibre];
	$id_producto=$row[id_producto];
	$i++;
	//echo $id_fajapallet;
	?>
      <tr>
        <td class="cajas">&nbsp;<? echo "$i";?></td>
        <td class="cajas">&nbsp;<a href="?modulo=planillas_produccion_diarias.php&id_p=<?echo $row[id_producto]?>"><? echo "$row[producto]";?></a></td>
      </tr>
      <? }?>
    </table>	</td>
  </tr>
</table>
</form>