<?

$sql="SELECT COUNT(ef.factura_importada) AS cont, SUM(ef.contenido_unidades) AS sum_group_contenido, ef.id_etiquetados_folios AS id_etiquetados_folios, ef.id_cruce_tablas AS id_cruce_tablas, o.origen AS origen, o.id_origen AS id_origen, ef.valor_unitario AS valor_unitario  FROM  etiquetados_folios AS ef, cruce_tablas AS ct, origenes AS o WHERE  ef.id_etiquetados_folios= ef.id_etiquetados_folios and ef.id_cruce_tablas = ct.id_cruce_tablas and ef.id_estado_folio != 5 and  ef.id_procedencia = 'I' and ef.id_origen = o.id_origen and ef.factura_importada = $factura_importada group by ef.id_origen";
$result=mysql_query($sql);
$cuantos2=mysql_num_rows($result);

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
<table width="856" height="58" border="0" align="center">
  <tr>
    <td width="850" height="14" align="right" valign="top"><a href="?modulo=listar_factura_importada.php&anob=<? echo $anob?>">Volver</a></td>
    </tr>
    <tr>
    <td height="38" valign="top">
	
	
	<table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="21" colspan="4" class="titulo">&nbsp;Factura Importada:<span class="cajas"> <? echo $factura_importada?></span></td>
        </tr>
      <tr>
        <td width="22" height="21" align="center" bgcolor="#CCCCCC" class="titulo">N</td>
        <td width="192" height="21" align="center" bgcolor="#CCCCCC" class="titulo">Bultos</td>
        <td width="209" align="center" bgcolor="#CCCCCC" class="titulo">Origen</td>
        <td width="229" align="center" bgcolor="#CCCCCC" class="titulo">Cantidad</td>
        </tr>
<?


	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$i++;
	$id_cruce_tablasid=$row[id_cruce_tablas];
	$id_etiquetados_foliossid=$row[id_etiquetados_folios];
	$id_origen=$row[id_origen];
	$cantidad_bidones=$row[cont];
	$cantidad_contenido=$row[sum_group_contenido];
	$valor_unitario=$row[valor_unitario];
	
	$total_folios+= $cantidad_bidones;
	$total_contenido+=$cantidad_contenido;
	//echo $id_fajapallet;
	?>
  
      <tr>
        <td height="21" align="center" class="cajas"><? echo $i;?></td>
        <td align="center" class="cajas"><? 
		echo $cantidad_bidones;	
		
		?></td>
        <td align="center" class="cajas">
         
        <a href="?modulo=costo_producto_importado.php&factura_importada=<? echo $factura_importada ?>&id_origen=<? echo $id_origen?>&anob=<? echo $anob?>"><? echo "$row[origen] - $row[id_origen]"?></a>
        
        </td>
        <td align="center" class="cajas">
          <?  echo $cantidad_contenido;  	?>          &nbsp;&nbsp;</td>
        </tr>
		<? }?>
      <tr>
        <td height="21" align="center" bgcolor="#CCCCCC" class="cajas">&nbsp;</td>
        <td height="21" align="center" bgcolor="#CCCCCC" class="titulo"><? echo $total_folios?></td>
        <td align="center" bgcolor="#CCCCCC" class="titulo">&nbsp;</td>
        <td align="center" bgcolor="#CCCCCC" class="titulo"><? 
		echo $total_contenido;
		?></td>
        </tr>
     
    </table>	</td>
  </tr>
</table>
</form>