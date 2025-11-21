<?
	
if($fechainv){ $fechainvok=format_fecha_sin_hora($fechainv); }

if(!$fechainv){
$fechainv=date("Y-m-d"); 	
$fechainv=format_fecha_sin_hora($fechainv); 

}

$sql="SELECT * FROM mat_prima_nacional AS mpn, origenes AS org, historial_inventario_mpn AS himpn WHERE mpn.id_mat_prima_nacional = himpn.id_ptn AND mpn.id_origen = org.id_origen AND himpn.f_toma_inventariom  = '$fechainvok' group by mpn.comprobante_num order by mpn.id_origen";
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

<h1>INVENTARIO PRODUCTO FRESCO</h1>
<table width="1020" border="0">
  <tr>
    <td height="8" colspan="6"><input name="fechainv" type="text"    id="fechainv"  value="<?echo $fechainv?>" size="8" maxlength="10" />
      <a href="javascript:show_Calendario('form1.fechainv');" > Ver
      <input type="submit" name="buscarin" id="buscarin" value="Buscar" />
    </a>[Debe seleccionar una fecha seg&uacute;n inventario que desee obtener] </td>
  </tr>
  <tr>
   <? if($fechainv and $buscarin and $cuantos){?>
    <td height="19" colspan="5" bgcolor="#CCCCCC">&nbsp;</td>
    <td width="233" height="19" bgcolor="#CCCCCC"><center><a href="codphp/inventarios/excel_folios_fresco.php?f_toma_inventariof=<? echo $fechainvok?>" target="_blank">EXPORTAR <img src="codphp/informes_pdf_excel/excel.png" width="18" height="18" border="0" /></a></center></td>
  </tr>
  
  <tr>
    <td width="24" height="19" nowrap="nowrap" bgcolor="#FF9933">&nbsp;</td>
    <td width="149" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td colspan="4" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;Nº COMPROBANTE</strong></td>
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
    <td width="270" bgcolor="#CCCCCC" class="cajas"><strong>&nbsp;<? echo $comprobante_num?></strong></td>
    <td width="188" nowrap="nowrap" bgcolor="#CCCCCC"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="130" nowrap="nowrap" bgcolor="#CCCCCC"><strong>&nbsp;BIDONES</strong></td>
    <td nowrap="nowrap" bgcolor="#CCCCCC"><strong>&nbsp;CONTENIDO</strong></td>
  </tr> <?
     $sqlnum_comprobante="SELECT count(DISTINCT mpn.id_mat_prima_nacional) AS total_bidones, SUM(mpn.contenido) AS contenidompn, p.producto AS producto FROM historial_inventario_mpn AS himpn, mat_prima_nacional AS mpn, producto AS p WHERE himpn.id_ptn = mpn.id_mat_prima_nacional and mpn.id_producto = p.id_producto and mpn.comprobante_num = '$comprobante_num' AND himpn.f_toma_inventariom  = '$fechainvok' group by mpn.id_producto order by p.producto desc";
	 $resultnum_comprobante=mysql_query($sqlnum_comprobante);
	 //echo "<br>sqlnum_comprobante $sqlnum_comprobante";
  	 $cuantos_numc=mysql_num_rows($resultnum_comprobante);
	 //echo "cuantos_numc $cuantos_numc";
	
	  
	?>
    <? 
	  while ($rownum_comprobante=mysql_fetch_array($resultnum_comprobante))
    { 

	$producto=$rownum_comprobante[producto];
	$total_bidones=$rownum_comprobante[total_bidones];
	$contenidompn=$rownum_comprobante[contenidompn];
	  ?>
  <tr>
    <td height="19" nowrap="nowrap">&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
   
      
    <td ><span class="cajas"><? echo "$producto";?></span></td>
    <td >&nbsp;<? echo $total_bidones?></td>
    <td >&nbsp;<? echo $contenidompn?></td>
    <? 
	$total_bidones1=$total_bidones1 + $total_bidones;
	$contenidompn1= $contenidompn1 + $contenidompn;
	}
	
	
	
	?>
  </tr>
   <? }
    $total_bidones_fresco= $total_bidones_fresco + $total_bidones1;
	$total_contenido_fresco= $total_contenido_fresco + $contenidompn1;
  
   ?>
 
<? }// while ($row=mysql_fetch_array($result)) 

?>
  <tr>
    <td height="19" colspan="3" nowrap="nowrap">&nbsp;</td>
    <td align="right" bgcolor="#CCCCCC" ><strong>TOTAL</strong></td>
    <td bgcolor="#CCCCCC" >&nbsp;<strong><? echo $total_bidones_fresco?></strong></td>
    <td bgcolor="#CCCCCC" >&nbsp;<strong><? echo $total_contenido_fresco?></strong></td>
  </tr>
 
</table>
