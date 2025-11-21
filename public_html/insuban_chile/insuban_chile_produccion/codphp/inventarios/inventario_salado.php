<?
	
if($fechainv){ $fechainvok=format_fecha_sin_hora($fechainv); }

if(!$fechainv){
$fechainv=date("Y-m-d"); 	
$fechainv=format_fecha_sin_hora($fechainv); 

}

$sql="SELECT org.origen AS origen, mpi.comprobante_num AS comprobante_num FROM mat_prima_importada AS mpi, origenes AS org, historial_inventario_mpi AS himpi WHERE mpi.id_mat_prima_importada = himpi.id_pti AND mpi.id_origen = org.id_origen AND himpi.f_toma_inventarioi  = '$fechainvok' group by mpi.comprobante_num order by mpi.id_origen";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

//echo "sql $sql<br>";
?>
<style type="text/css">
<!--
.cajas {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>

<h1>INVENTARIO PRODUCTO SALADO</h1>
<table width="1020" border="0">
  <tr>
    <td height="8" colspan="10"><input name="fechainv" type="text"    id="fechainv"  value="<?echo $fechainv?>" size="8" maxlength="10" />
      <a href="javascript:show_Calendario('form1.fechainv');" > Ver
      <input type="submit" name="buscarin" id="buscarin" value="Buscar" />
    </a>[Debe seleccionar una fecha seg&uacute;n inventario que desee obtener] </td>
  </tr>
  <tr>
   <? if($fechainv and $buscarin and $cuantos){?>
    <td height="19" colspan="9" bgcolor="#CCCCCC">&nbsp;</td>
    <td width="168" height="19" bgcolor="#CCCCCC"><center><a href="codphp/inventarios/excel_folios_salado.php?f_toma_inventariof=<? echo $fechainvok?>" target="_blank">EXPORTAR <img src="codphp/informes_pdf_excel/excel.png" width="18" height="18" border="0" /></a></center></td>
  </tr>
  
  <tr>
    <td width="20" height="19" nowrap="nowrap" bgcolor="#FF9933">&nbsp;</td>
    <td width="107" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td colspan="8" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;Nº FACTURA IMPORTADA</strong></td>
  </tr>
    <?
   $i=0;
  while ($row=mysql_fetch_array($result))
    { 
	$i++;
	$origen=$row[origen];
	$id_origen=$row[id_origen];
	$producto=$row[producto];
	$comprobante_num=$row[comprobante_num];
	$total_bidones=$row[total_bidones];
	$contenido_unidades=$row[contenido_unidades];
	  
	 
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="#CCCCCC"><center><? echo $i?></center></td>
    <td bgcolor="#CCCCCC" class="cajas"><strong>&nbsp;<? echo "$origen";?></strong></td>
    <td width="152" bgcolor="#CCCCCC" class="cajas"><strong>&nbsp;<? echo $comprobante_num?></strong></td>
    <td width="174" nowrap="nowrap" bgcolor="#CCCCCC"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="75" nowrap="nowrap" bgcolor="#CCCCCC"><strong>&nbsp;CALIBRE</strong></td>
    <td width="86" nowrap="nowrap" bgcolor="#CCCCCC"><strong>&nbsp;U/MEDIDA</strong></td>
    <td width="49" nowrap="nowrap" bgcolor="#CCCCCC"><strong>&nbsp;C/P</strong></td>
    <td width="61" nowrap="nowrap" bgcolor="#CCCCCC"><strong>&nbsp;C/E</strong></td>
    <td width="86" nowrap="nowrap" bgcolor="#CCCCCC"><strong>&nbsp;BIDONES</strong></td>
    <td nowrap="nowrap" bgcolor="#CCCCCC"><strong>&nbsp;CONTENIDO</strong></td>
  </tr> 
   <?
     $sqlnum_comprobante="SELECT count(DISTINCT mpi.id_mat_prima_importada) AS total_bidones, SUM(mpi.contenido) AS contenidompi, p.producto AS producto FROM historial_inventario_mpi AS himpi, mat_prima_importada AS mpi, producto AS p WHERE himpi.id_pti = mpi.id_mat_prima_importada and mpi.id_producto = p.id_producto and mpi.comprobante_num = '$comprobante_num' AND himpi.f_toma_inventarioi  = '$fechainvok' group by mpi.id_producto order by p.producto desc";
	 $resultnum_comprobante=mysql_query($sqlnum_comprobante);
	 $cuantos_numc=mysql_num_rows($resultnum_comprobante);
	 //echo "sqlnum_comprobante $sqlnum_comprobante";
	
	  
	?>
    <? 
	  while ($rownum_comprobante=mysql_fetch_array($resultnum_comprobante))
    { 

	$producto=$rownum_comprobante[producto];
	$total_bidones=$rownum_comprobante[total_bidones];
	$contenidompi=$rownum_comprobante[contenidompi];
	  ?>
  <tr>
    <td height="19" nowrap="nowrap">&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
   
      
    <td ><span class="cajas"><? echo "$producto";?></span></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td ><? echo $total_bidones?></td>
    <td ><? echo $contenidompi?></td>
    <? }
	$total_bidones_salados= $total_bidones_salados + $total_bidones;
	$total_contenido_salados= $total_contenido_salados + $contenidompi;
	?>
  </tr>
    <? } ?>
 
<? }// while ($row=mysql_fetch_array($result)) ?>
  <tr>
    <td height="19" colspan="7" align="right" nowrap="nowrap">&nbsp;</td>
    <td height="19" align="right" nowrap="nowrap" bgcolor="#CCCCCC"><strong>TOTAL</strong></td>
    <td bgcolor="#CCCCCC" >&nbsp;<strong><? echo $total_bidones_salados?></strong></td>
    <td bgcolor="#CCCCCC" >&nbsp;<strong><? echo $total_contenido_salados?></strong></td>
  </tr>

</table>
