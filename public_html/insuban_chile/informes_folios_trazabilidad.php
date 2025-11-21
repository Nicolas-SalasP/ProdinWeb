<?
/*if($dato and $buscar){
$largod2=strlen($dato);
$newanod2=substr($dato, 0, 2);
$newanod2="20".$newanod2;
$newdatod2=substr($dato, 0, $largod2);
$and = " and mpn.id_mat_prima_nacional = $newdatod2 ";
}
//echo "newdatod2 $newdatod2";*/
    if($buscar){
	 $sql_buscar="SELECT * from folios_mat where id_mat= $dato group by id_mat";
     $result_buscar=mysql_query($sql_buscar);
	 $cuantos_buscar=mysql_num_rows($result_buscar);
	}

 		if(!$entreano1)
		{
		$entreano1=$fhoy=date("Y");
		$entreano1=$entreano1-1;
		}

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
<table width="774" border="0" align="center">
  <tr>
    <td height="6" class="titulo">Trazabilidad de Materia Prima Nacional </td>
    </tr>
  <tr>
    <td height="6" class="titulo">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="794" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td width="784"><table width="787" border="0" align="center">
          <tr>
              <td width="40" class="titulo">A&ntilde;o</td>
              <td width="56"><div align="left"><span class="titulo">
                <input name="entreano1" type="text" class="cajas" id="entreano1" value="<? echo $entreano1 ?>" size="4" maxlength="4" />
              </span></div></td>
              <td width="49"><span class="titulo">MPN</span></td>
              <td width="82"><input name="dato" type="text" class="cajas" id="dato" size="10" value="<? echo $dato ?>" /></td>
              <td width="538"><input name="buscar" type="submit" class="cajas" value="Buscar" /></td>
            </tr>
        </table>
          <table width="787" border="0" align="center">
            <tr>
              <td><? if($cuantos_buscar){?>
                <table width="93%" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="6%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; MPN </td>
                    <td width="23%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
                    <td width="9%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F/ Ingreso </td>
                    <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F/Faena </td>
                    <td width="9%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F/ Termino </td>
                    <td width="8%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Contenido</td>
                    <td width="5%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Origen</td>
                    <td width="4%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">RCP</td>
                    <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Comprob. N&ordm; </td>
                    <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"> N&ordm; Bidon </td>
                    <td width="12%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Unid/Med</td>
                  </tr>
		<? 
	
		 
	
		 if ($rddd=mysql_fetch_array($result_buscar)) { 
			  $id_mat_prima_nacional=$rddd[id_mat];
			  
			  $sql_mpn="SELECT * from mat_prima_nacional AS mpn, producto AS p, origenes AS o, unidad_medida AS un where mpn.id_mat_prima_nacional= $id_mat_prima_nacional and mpn.id_producto = p.id_producto and mpn.id_origen = o.id_origen and mpn.id_unidad_medida = un.id_unidad_medida";
			  $result_mpn=mysql_query($sql_mpn);
		       		if ($rowmpn=mysql_fetch_array($result_mpn)) { 
			  		 $id_mat_prima_nacionalrowmpn=$rowmpn[id_mat_prima_nacional];
		  ?>
                  <tr>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas"><? echo $id_mat_prima_nacionalrowmpn;?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;&nbsp;<?echo $rowmpn[producto]?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;<?echo format_fecha($rowmpn[fecha_ingreso]);?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas"><?echo format_fecha($rowmpn[fecha_faena]);?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas"><?echo format_fecha($rowmpn[fecha_termino]);?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas"><?echo $rowmpn[contenido]?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas"><?echo $rowmpn[origen]?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas"><?echo $rowmpn[rcp]?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas"><?echo $rowmpn[comprobante_num]?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;<?echo $rowmpn[bidon_num]?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;<?echo $rowmpn[unidad_medida]?>&nbsp;</td>
                  </tr>
                  <?
					}
				  }?>
                  <tr>
                    <td colspan="11" nowrap="nowrap" class="cajas"><table width="753" border="1" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="24" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;N/I</td>
                          <td width="30" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Folio</td>
                          <td width="109" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto</td>
                          <td width="46" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Calibre</td>
                          <td width="60" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Unid/Med</td>
                          <td width="25" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Medidas</td>
                          <td width="12" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;C/P</td>
                          <td width="13" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;C/E</td>
                          <td width="62" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Contenido</td>
                          <td width="55" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;F/Faena </td>
                          <td width="67" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;F/Termino </td>
                          <td width="47" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Factura</td>
                          <td width="98" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Operador</td>
                          <td width="79" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Est/Material </td>
                          <?
					  
/*					  
$largod=strlen($dato);
$newanod=substr($dato, 0, 2);
$newanod="20".$newanod;
$newdatod=substr($dato, 2, $largod);

$largod=strlen($desde);
if($fecha_ingresod != '' and fecha_ingresoh != ''){
$fecha_ingresodesde=format_fecha_sin_hora($fecha_ingresod);
$fecha_ingresohasta=format_fecha_sin_hora($fecha_ingresoh);
}
*/
$sql="SELECT * FROM folios_mat AS fm, etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mp, unidad_medida AS um, caract_producto AS cp, caract_envases AS ce, operarios AS o, estado_folio  AS estf WHERE fm.id_mat = '$dato' and ef.id_etiquetados_folios = fm.id_etiquetados_folios and ef.id_producto = p.id_producto and ef.id_calibre = c.id_calibre and ef.id_medidas_productos = mp.id_medidas_productos and ef.id_caract_producto = cp.id_caract_producto and ef.id_caract_envases = ce.id_caract_envases and ef.id_operarios = o.id_operarios and ef.id_estado_folio = estf.id_estado_folio and ef.id_unidad_medida = um.id_unidad_medida and ef.id_estado_folio = ef.id_estado_folio and ef.borrado != 1 ";

if($fecha_ingresodesde and $fecha_ingresohasta)
$sql.= " and ef.f_termino between '$fecha_ingresodesde' and '$fecha_ingresohasta' order by ef.f_termino desc ";


$result=mysql_query($sql);
					  
					  
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$f_inicio=format_fecha_sin_hora($row[f_inicio]);
	$f_termino=format_fecha_sin_hora($row[f_termino]);
	$i++;
	?>
                        </tr>
                        <tr>
                          <td nowrap="nowrap" class="cajas"><div align="center"><? echo $row[id_procedencia];?></div></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;<? echo $row[id_etiquetados_folios];?></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[producto]?></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[calibre]?></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;&nbsp;<?echo $row[unidad_medida]?></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;&nbsp;<?echo $row[medidas_productos]?></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[caract_producto]?></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[caract_envases]?></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[contenido_unidades]?></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;<?echo $f_elaboracion?></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;<?echo $f_termino?></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[factura]?></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[nombreop]?> <?echo $row[apellido]?></td>
                          <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[estado_folio]?></td>
                        </tr>
                        <? }?>
                    </table></td>
                  </tr>
                  <? } //while ($row=mysql_fetch_array($result))?>
                </table>
               </td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>