<?
$sql="SELECT * FROM  producto AS pro, especie AS es, cruce_producto_empresa AS cpe WHERE pro.id_producto = cpe.id_producto  and pro.id_estado != 2 and pro.id_producto != 0 and pro.id_especie = es.id_especie group by cpe.id_producto order by es.id_especie ASC";
$result=mysql_query($sql);

?>
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
    <td height="14" valign="top"><span class="titulo">Listado Costos </span></td>
    </tr>
    <tr>
    <td height="38" valign="top">
	
	
	<table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="29" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;</td>
        <td width="493" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Productos</td>
        <td width="70" bgcolor="#CCCCCC" class="titulo">&nbsp;Especie</td>
      </tr>
<?




	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_cruce_plant_caract_envases=$row[id_cruce_plant_caract_envases];
	$id_producto=$row[id_producto];
	$i++;
	//echo $id_fajapallet;
	?>
      <tr>
        <td class="cajas">&nbsp;<? echo "$i";?></td>
        <td class="cajas">&nbsp;<a href="?modulo=costo_materia_prima.php&id_p=<?echo $row[id_producto]?>&id_esp=<? echo $row[id_especie]?>"><? echo "$row[producto]";?></a></td>
        <td class="cajas">&nbsp;<? $especie =strtoupper("$row[especie]");
								echo "$especie";?></td>
      </tr>
      <? }?>
    </table>	</td>
  </tr>
</table>
</form>