
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style1 {font-size: 12px}
.style2 {font-size: 14px}
-->
</style>

<form id="form1" name="form1" method="post" action="">
<table width="552" border="0" align="center">
  <tr>
    <td width="179" height="30" class="titulo">Informes de Folios </td>
    <td width="379" class="titulo">&nbsp;</td>
    <td width="143" class="titulo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><table width="600" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td><table width="520" border="0" align="center">
            <tr>
              <td width="456"><div align="center"><span class="titulo style2">R-LB-SOP01/14.</span></div></td></tr>
            <tr>
              <td>
                <table width="661" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="31" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">
					<div align="center">
                     <? $estado_folio=crea_estado_folio_filtro($link,$id_estado_folio,1); echo $estado_folio;?>
                    </div>
					</td>
                    <td width="52" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">
					<div align="center">
                     <? $producto=crea_producto_filtro($link,$id_producto,1); echo $producto;?>
                    </div></td>
                    <td width="39" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><? 
	    if($id_producto){
		$calibre=crea_calibre_filtro($link,$row[id_calibre],$id_producto,1);
		echo $calibre;}?></td>
                    <td width="37" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Condic</td>
                    <td width="29" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Color</td>
                    <td width="40" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Medida</td>
                    <td width="29" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Unid.</td>
                    <td width="49" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F.Faena </td>
                    <td width="46" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Inicio</td>
                    <td width="63" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Termino </td>
                    <td width="44" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Factura</td>
                    <td width="74" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Est. Material </td>
                    <td width="54" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Operador</td>
                    <td width="76" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Destinos</td>
                  </tr>
                  <?
	

//if($id_estado_folio)
	//$sql.= " and ef.id_estado_folio = '$id_estado_folio'";

if($fecha_ingresod != '' and fecha_ingresoh != ''){
$fecha_ingresod=format_fecha_sin_hora($fecha_ingresod);
$fecha_ingresoh=format_fecha_sin_hora($fecha_ingresoh);
//echo "Fdesde $fecha_ingresod ---  Fhasta $fecha_ingresoh";
}

$sql="SELECT ef.ano, ef.id_etiquetados_folios, ef.factura, ef.contenido_unidades, ef.f_elaboracion, ef.f_inicio, ef.f_termino, p.nombre AS nombre_producto, mp.nombre AS nombre_medidas,c.calibre, c.color, c.condicion_cod_barra, o.nombre AS nombre_operarios,e.estado_folio, dest.nombre AS destinos_nombre FROM etiquetados_folios AS ef, producto AS p, medidas_productos AS mp, calibre AS c,operarios AS o,estado_folio AS e, destinos AS dest where ef.id_etiquetados_folios=ef.id_etiquetados_folios and ef.id_producto = p.id_producto and ef.id_medidas_productos = mp.id_medidas_productos and ef.id_calibre = c.id_calibre and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio and ef.id_destinos = dest.id_destinos and ef.ano = 2009 ";

if($id_estado_folio){
$sql.= " and ef.id_estado_folio = '$id_estado_folio'";
}
if($id_producto){
$sql.= " and p.id_producto = '$id_producto'";

}
if($id_origen){
$sql.= " and orig.id_origen = '$id_origen'";

}
if($id_calibre){
$sql.= " and c.id_calibre = '$id_calibre'";

}
if($id_destinos){
$sql.= " and dest.id_destinos = '$id_destinos'";

}
if($factura){
$sql.= " and ef.factura = '$factura'";

}
if($desde and $hasta){
$sql.= " and ef.id_etiquetados_folios between '$desde' and '$hasta' and ef.id_etiquetados_folios=ef.id_etiquetados_folios ";}
if($fecha_ingresod and $fecha_ingresoh){
$sql.= " and ef.f_termino between '$fecha_ingresod' and '$fecha_ingresoh'";}

$sql.= " order by ef.id_etiquetados_folios desc";
				
$result=mysql_query($sql);	
$cuantos=mysql_num_rows($result);			
echo "Cantidad de Folios: $cuantos";

				
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$f_inicio=format_fecha_sin_hora($row[f_inicio]);
	$f_termino=format_fecha_sin_hora($row[f_termino]);
	$id_m=substr($row[ano],2,4).$id_etiquetados_folios;
	$i++;
	?>
                  <tr>
                    <td nowrap="nowrap" class="cajas"><div align="center"><? echo $id_etiquetados_folios;?></div></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[nombre_producto]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[calibre]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[condicion_cod_barra]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[color]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[nombre_medidas]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[contenido_unidades]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $f_elaboracion?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $f_inicio?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $f_termino?>&nbsp;</td>
                    <td nowrap="nowrap" class="cajas"><?echo $row[factura]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[estado_folio]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[nombre_operarios]?> <?echo $row[apellido]?></td>
                    <td nowrap="nowrap" class="cajas"><?echo $row[destinos_nombre]?>&nbsp;</td>
                  </tr>
                  <? } //while ($row=mysql_fetch_array($result))
				
				?>
                </table>
                </td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>