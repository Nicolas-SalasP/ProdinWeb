<?

if(!$anob){
  $anob=$fhoy=date("Y");
}


$sql="SELECT COUNT(ef.factura_importada) AS cont, SUM(ef.contenido_unidades) AS sum_group_contenido,  SUM(ef.valor_unitario) AS total_valor_unitario, ef.id_etiquetados_folios AS id_etiquetados_folios, ef.factura_importada AS factura_importada, orig.origen AS origen, orig.id_origen AS id_origen, ef.id_cruce_tablas AS id_cruce_tablas, ef.id_procedencia AS id_procedencia  FROM  etiquetados_folios AS ef, cruce_tablas AS ct, origenes AS orig WHERE ef.id_etiquetados_folios  = ef.id_etiquetados_folios and ef.ano = $anob and ef.id_cruce_tablas = ct.id_cruce_tablas and ef.id_origen = orig.id_origen and id_procedencia = 'I' and ef.id_estado_folio != 5 group by ef.factura_importada order by ef.factura_importada desc";
$result=mysql_query($sql);
//echo "Sql -> $sql";
/*$sql="SELECT ef.id_etiquetados_folios AS id_etiquetados_folios, ef.factura_importada AS factura_importada, ef.compro_nro AS compro_nro, ef.bidon_importado AS bidon_importado , ef.id_cruce_tablas AS id_cruce_tablas, COUNT(ef.id_cruce_tablas) AS cont, orig.origen AS origen FROM  etiquetados_folios AS ef,  origenes AS orig WHERE  ef.id_etiquetados_folios = ef.id_etiquetados_folios and ef.id_origen = orig.id_origen and ef.ano =2010 and ef.id_procedencia = 'I' group by factura_importada order by factura_importada desc";
$result=mysql_query($sql);*/

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
<table width="716" height="74" border="0" align="center">
  <tr>
    <td height="6" colspan="3" valign="top"><span class="titulo">Listado Costos Productos Importados</span></td>
    </tr>
  <tr>
    <td width="653" height="6" align="right" class="cajas">A&ntilde;o</td>
    <td width="25" valign="top"><input name="anob" type="text" class="cajas" id="anob" value="<? echo $anob?>" size="5" maxlength="5" /></td>
    <td width="51" valign="top"><input name="buscar" type="submit" class="cajas" id="buscar" value="Buscar" /></td>
  </tr>
    <tr>
    <td height="38" colspan="3" valign="top">
	
	
	<table width="737" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="21" height="21" bgcolor="#CCCCCC" class="titulo">&nbsp;</td>
        <td width="68" height="21" bgcolor="#CCCCCC" class="titulo">&nbsp;Factura</td>
        <td width="154" bgcolor="#CCCCCC" class="titulo">Origen</td>
        <td width="94" bgcolor="#CCCCCC" class="titulo">Cantidad Folios </td>
        <td width="137" bgcolor="#CCCCCC" class="titulo">Contenido</td>
        <td width="152" bgcolor="#CCCCCC" class="titulo">&nbsp;Total</td>
        <td width="95" bgcolor="#CCCCCC" class="titulo">Folios Asociados</td>
      </tr>
<?


	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$factura_importada=$row[factura_importada];
	$i++;
	//echo $id_fajapallet;
	?>
      <tr>
        <td height="21" class="cajas">&nbsp;<? echo $i;?></td>
        <td class="cajas">&nbsp;
          <? if($permiso53 == 1){?>
        <a href="?modulo=costo_producto_importado.php&factura_importada=<? echo $row[factura_importada] ?>&origen=<? echo $row[origen]?>&id_origen=<? echo $row[id_origen]?>"><? echo $row[factura_importada]?></a>
        <? }else{
         echo $row[factura_importada];
        }?>
        </td>
        <td class="cajas">&nbsp;<? echo $row[origen]?><? echo $row[id_origen] ?></td>
        <td class="cajas">&nbsp;
		<? 
		$sqlc="SELECT *  FROM  etiquetados_folios  WHERE  id_etiquetados_folios= id_etiquetados_folios and factura_importada = $factura_importada";
		$resultc=mysql_query($sqlc);
		$cuantosc=mysql_num_rows($resultc);
		echo $cuantosc;
		?>
        </td>
        <td class="cajas">&nbsp;
        <?
        $sqls="SELECT SUM(contenido_unidades) AS sum_group_contenido  FROM  etiquetados_folios  WHERE  id_etiquetados_folios= id_etiquetados_folios and factura_importada = $factura_importada";
		$results=mysql_query($sqls);
		$cuantoss=mysql_num_rows($results);
		
		if ($rows=mysql_fetch_array($results))
       { 
	   echo $sum_group_contenido=$rows[sum_group_contenido];
	   }
		
		?>
        </td>
        <td class="cajas">
        $<?
        $sqltotal="SELECT * FROM  etiquetados_folios WHERE factura_importada = $factura_importada ";
        $resulttotal=mysql_query($sqltotal);
        $cuantostotal=mysql_num_rows($resulttotal);
	if($cuantostotal){
		$resultmultiplicacion=0;
	while ($rowtotal=mysql_fetch_array($resulttotal))
    { 
	
	$valor_unitario=$rowtotal[valor_unitario];
	$contenido_unidades=$rowtotal[contenido_unidades];
	
$resultmultiplicacion+=$contenido_unidades * $valor_unitario;
	}
	}
	if($cuantostotal){
		echo $respuest=number_format($resultmultiplicacion,0,",",".");
	}else{
	    echo "0";	
	}
	
		?>
        </td>
        <td align="center" class="cajas"><a href="?modulo=facturas_folios.php&factura_importada=<? echo $row[factura_importada] ?>&origen=<? echo $row[origen]?>&id_origen=<? echo $row[id_origen]?>">Ver Folios</a></td>
      </tr>
      <? }?>
    </table>	</td>
  </tr>
</table>
</form>