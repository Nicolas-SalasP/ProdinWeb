<?
$sql="SELECT * FROM etiquetados_folios AS etiq, producto AS pro, estado_folio AS esf, operarios AS ope, origenes AS o where etiq.id_operarios = ope.id_operarios and etiq.id_etiquetados_folios = etiq.id_etiquetados_folios and etiq.id_estado_folio = esf.id_estado_folio and etiq.id_producto != 0 and etiq.id_producto = pro.id_producto and etiq.id_origen = o.id_origen  and etiq.factura_importada = $factura_importada order by etiq.id_etiquetados_folios, etiq.id_producto desc";
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
.numero {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="857" height="49" border="0" align="center">
  <tr>
    <td width="851" height="1" valign="top" bgcolor="#CCCCCC" class="titulo">&nbsp;Folios asociados a Factura N&ordm; <? echo $factura_importada?></td>
    </tr>
  <tr>
    <td height="2" align="right"><a href="?modulo=listar_factura_importada.php&anob=<? echo $anob?>" class="cajas">Volver</a></td>
    </tr>
  <tr>
    <td height="38" valign="top">
      
      <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
        
        <tr>
          <td width="17" height="14" nowrap bgcolor="#CCCCCC" class="titulo">&nbsp;</td>
          <td width="47" nowrap bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm; Folio</td>
          <td width="20" nowrap bgcolor="#CCCCCC" class="titulo">&nbsp;ID</td>
          <td width="55" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto</td>
          <td width="94" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; Bidon IMP</td>
          <td width="60" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Contenido</td>
          <td width="86" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;F/Elaboraci&oacute;n </td>
          <td width="77" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Est/Material </td>
          <td width="74" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Valor Indice</td>
          <td width="90" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Valor Unitario</td>
          <td width="76" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Procedencia</td>
          <td width="46" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;&nbsp;Origen</td>
          <td width="81" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;&nbsp;Responsable</td>
          <? if($permiso34 == 1 and $nivel_usua == 1){?><? }?>
          </tr>
        <? 
	

	
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$id_cruce_tablas=$row[id_cruce_tablas];
	$id_pedidos=$row[id_pedidos];
	$id_estado_folio=$row[id_estado_folio];
	$i++;
	?>
        <tr>
          <td height="20" nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">
            <div align="center"><? echo $i;?></div></td>
          <td height="20" nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $row[id_etiquetados_folios]?>"><?echo $row[id_etiquetados_folios]?></a></td>
          <td height="20" nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $id_cruce_tablas?></td>
          <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $row[id_etiquetados_folios]?>"><? echo $row[producto];?></a><? //echo $row[id_cruce_tablas]?></td>
          <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><?echo $row[bidon_importado]?></td>
          <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[contenido_unidades]?></td>
          <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $f_elaboracion ?></div></td>
          <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><a href="?modulo=ejemplo_etiquetas_folios.php&amp;id_etf2=<?echo $row[id_etiquetados_folios]?>"><?
		echo $row[estado_folio];
		
		?>
            </a></div></td>
          <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><? echo $row[valor_indice]?></td>
          <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><? echo $row[total_ponderado]?></td>
          <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">
            <? 
		  if($row[id_procedencia] == 'I')
		  {
          echo "Importado";
          }
		  if($row[id_procedencia] == 'N')
		  {
          echo "Nacional";
		  }
		 ?>
          </div></td>
          <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo "$row[origen]";?></td>
          <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;
            <?
		$nom =strtoupper("$row[nombreop]"); # HOLA TíO
		$apel =strtoupper("$row[apellido]"); # HOLA TíO
		echo $nom?>
            <?echo $apel?></td>
          <? }?>
          </tr>
      </table></td>
  </tr>
</table>
</form>