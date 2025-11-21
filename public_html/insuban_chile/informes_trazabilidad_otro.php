<?

$largod=strlen($desde);
$newanod=substr($desde, 0, 2);
$newanod="20".$newanod;
$newdatod=substr($desde, 2, $largod); 

$largoh=strlen($hasta);
$newanoh=substr($hasta, 0, 2);
$newanoh="20".$newanoh;
$newdatoh=substr($hasta, 2, $largoh); 


if($fecha_ingresod != '' and fecha_ingresoh != ''){
$fecha_ingresodesde=format_fecha_sin_hora($fecha_ingresod);
$fecha_ingresohasta=format_fecha_sin_hora($fecha_ingresoh);
}

if($id_estado_folio)
	$sql.= " and ef.id_estado_folio = $id_estado_folio ";
if($id_producto)
	$sql.= " and p.id_producto = $id_producto ";
if($id_origen)
	$sql.= " and orig.id_origen = $id_origen ";
if($id_destinos)
	$sql.= " and d.id_destinos = $id_destinos ";
if($newdatod and $newdatoh)
$sql.= " and ef.id_etiquetados_folios between '$newdatod' and '$newdatoh' and ef.id_etiquetados_folios=ef.id_etiquetados_folios ";
if($fecha_ingresodesde and $fecha_ingresohasta)
	$sql.= " and ef.f_termino between '$fecha_ingresodesde' and '$fecha_ingresohasta' order by ef.f_termino desc ";

$sql="SELECT ef.ano, ef.id_etiquetados_folios, ef.contenido_unidades, ef.f_elaboracion, ef.f_inicio, ef.f_termino, p.nombre AS nombre_producto, mp.nombre AS nombre_medidas, c.calibre, c.color, ef.glosa, e.estado_folio, o.nombre AS nombre_operarios, o.apellido, ef.factura

FROM etiquetados_folios AS ef, producto AS p, medidas_productos AS mp, calibre AS c, estado_folio AS e, operarios AS o, origenes AS orig, destinos AS d

where ef.id_etiquetados_folios= ef.id_etiquetados_folios and id_etiquetados_folios != 0 and ef.id_producto = p.id_producto and ef.id_medidas_productos=mp.id_medidas_productos and ef.id_calibre = c.id_calibre and ef.id_estado_folio = e.id_estado_folio and ef.id_operarios=o.id_operarios and ef.id_origen  = orig.origen and ef.id_destinos = d.id_destinos and ef.borrado != 1  and ef.ano = 2009 $sql group by ef.id_etiquetados_folios";

$result=mysql_query($sql);	
?>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
-->
</style>
<? if (!$buscar) { ?>
<form id="form1" name="form1" method="post" action="">
<table width="725" border="0" align="center">
            <tr>
              <td colspan="3"><span class="titulo">Informe Trazabilidad de Folios</span></td>
            </tr>
            <tr>
              <td><div align="left"><span class="titulo">Estado Folio </span></div></td>
              <td width="212"><div align="left">
                <? $estado_folio=crea_estado_folio($link,$id_estado_folio,1);
		echo $estado_folio;?>
              </div></td>
              <td width="360"><table width="152" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="42" height="35"><a href="excel_etiquetas_folios_trazabilidad.php?id_estado_folio=<? echo $id_estado_folio;?>&id_producto=<? echo $id_producto?>" target="_blank"><img src="jpg/icono-excel.gif" width="33" height="33" border="0" /></a></td>
                  <td width="100"><a href="excel_etiquetas_folios_trazabilidad.php" target="_blank"><span class="cajas">Exportar a Excel</span></a></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td class="titulo"><div align="left">Buscar Picking </div></td>
              <td width="212">&nbsp;</td>
              <td width="360">&nbsp;</td>
            </tr>
            <tr>
              <td class="titulo"><div align="left">Desde Folio </div></td>
              <td colspan="2"><div align="left">
                <input name="desde" type="text" class="cajas" id="desde" size="10" value="<? echo $desde ?>">
              </div></td>
            </tr>
            <tr>
              <td class="titulo"><div align="left">Hasta Folio </div></td>
              <td colspan="2"><div align="left">
                <input name="hasta" type="text" class="cajas" id="hasta" size="10" value="<? echo $hasta ?>">
              </div></td>
            </tr>
            <tr>
              <td class="titulo"><div align="left">Desde Fecha de Termino </div></td>
              <td colspan="2"><div align="left">
                <input name="fecha_ingresod" type="text" class="cajas"   id="fecha_ingresod"  value="<?echo $fecha_ingresod?>" size="10" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fecha_ingresod');" class="cajas"  >Ver</a></div></td>
            </tr>
            <tr>
              <td class="titulo"><div align="left">Hasta Fecha de Termino </div></td>
              <td colspan="2"><div align="left">
                <input name="fecha_ingresoh" type="text" class="cajas"   id="fecha_ingresoh"  value="<?echo $fecha_ingresoh?>" size="10" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fecha_ingresoh');" class="cajas"  >Ver</a><a href="javascript:show_Calendario('form1.hasta_fecha');" class="cajas"  ></a></div></td>
            </tr>
            <tr>
              <td class="titulo">RCP</td>
              <td colspan="2"><input name="rcp" type="text" class="cajas" id="rcp" value="<? echo $rcp?>" size="10" maxlength="10" /></td>
            </tr>
            <tr>
              <td class="titulo"><div align="left">Producto                </div></td>
              <td colspan="2"><div align="left">
                 <? $producto= crea_producto_onchange($link,$id_producto);
		 echo $producto;?>
              </div></td>
            </tr>
            <tr>
              <td class="titulo"><div align="left">Origen</div></td>
              <td colspan="2"><div align="left">
                <? 
				$unidad_produccion= crea_unidad_produccion_informe($link,$id_unidad_produccion);
			echo $unidad_produccion;
			?>
              </div></td>
            </tr>
            <tr>
              <td width="139" class="titulo"><div align="left">Destinos                </div></td>
              <td colspan="2"><div align="left">
                <? $destinos=crea_destinos($link,$id_destinos);
		echo $destinos;?>
              </div></td>
            </tr>
            <tr>
              <td colspan="3"><div align="left">
                <input name="buscar" type="submit" class="cajas" value="Buscar" />
              </div></td>
            </tr>
  </table>
</form>
		<? } // FIN del FORMULARIO?>
          
		  
<? if($buscar){ ?>

      <a href="?modulo=informes_trazabilidad.php"> Volver Informe Trazabilidad de Folios </a>
	  
	  <table width="750" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="41" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="center">Picking</div></td>
                    <td width="27" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Folio</td>
                    <td width="52" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
                    <td width="48" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Calibre</td>
                    <td width="87" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Color</td>
                    <td width="86" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Medida</td>
                    <td width="37" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Unid.</td>
                    <td width="52" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Faena </td>
                    <td width="60" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F.Termino </td>
                    <td width="44" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Factura</td>
                    <td width="54" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Operador</td>
                    <td width="118" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Est. Material </td>
                  </tr>
                    <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$f_inicio=format_fecha_sin_hora($row[f_inicio]);
	$f_termino=format_fecha_sin_hora($row[f_termino]);
	$i++;
	
	if(!$valorpiking){
	$sql_pik="SELECT * FROM paking AS pik, etiquetados_folios AS ef WHERE pik.id_etiquetados_folios=ef.id_etiquetados_folios and pik.id_etiquetados_folios= $id_etiquetados_folios";
    }else{
	$sql_pik=" SELECT * FROM paking AS pik, etiquetados_folios AS ef WHERE pik.id_etiquetados_folios = ef.id_etiquetados_folios and pik.folio_piking = $valorpiking";
	}
	
	
	$result_pik=mysql_query($sql_pik);
	?>

                  <tr>
                    <td nowrap="nowrap" class="cajas">
					<div align="center"><? while ($rowpik=mysql_fetch_array($result_pik)){ $pik=$rowpik[folio_piking]; echo $rowpik[folio_piking]; }?>					</div>				    </td>
                    <td nowrap="nowrap" class="cajas"><div align="center"><? echo $row[id_etiquetados_folios];?> </div></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<? echo $row[nombre_producto] ?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<? echo $row[calibre] ?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<? echo $row[color] ?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<? echo $row[nombre_medidas] ?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<? echo $row[contenido_unidades] ?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<? echo $f_elaboracion ?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<? echo $f_termino ?></td>
                    <td nowrap="nowrap" class="cajas"><? echo $row[factura] ?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;
					<? echo $row[nombre_operarios] ?> <? echo $row[apellido] ?>					</td>
                    <td nowrap="nowrap" class="cajas"><?echo $row[estado_folio]?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="12" nowrap="nowrap" class="cajas">
					
		<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
           <tr>
            <td width="2%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Picking </td>
            <td width="2%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Folio</td>
            <td width="6%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; MPN </td>
            <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto </td>
            <td width="9%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Ingreso </td>
            <td width="8%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Faena </td>
            <td width="9%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Termino </td>
            <td width="9%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Contenido</td>
            <td width="19%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Origen</td>
            <td width="4%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">RCP</td>
            <td width="11%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Comprob. N&ordm;</td>
            <td width="8%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"> N&ordm; Bidon </td>
            <td nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Unid.</td>
            <td nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Faena </td>
            <td nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F.Termino </td>
          </tr>
                        <? 
		  $sql_buscar="SELECT   fm.id_mat, mpn.id_mat_prima_nacional, p.nombre AS nombre_producto, mpn.fecha_ingreso, mpn.fecha_termino, mpn.ano, mpn.fecha_faena, mpn.rcp, mpn.comprobante_num, mpn.contenido, mpn.bidon_num,orig.origen AS nombre_origen, p.id_producto AS id_pro
		  from folios_mat AS fm, mat_prima_nacional AS mpn, producto AS p, etiquetados_folios AS etiq, origenes as orig
		  where fm.id_etiquetados_folios=$id_etiquetados_folios and  fm.id_mat = mpn.id_mat_prima_nacional and mpn.id_producto=p.id_producto and fm.id_etiquetados_folios = etiq.id_etiquetados_folios and mpn.id_origen=orig.id_origen";
$result_buscar=mysql_query($sql_buscar);
$cuantos_buscar=mysql_num_rows($result_buscar);

		  while ($r=mysql_fetch_array($result_buscar)) { 
		$ano=substr($r[ano], 2, 3);
		 //$base="N".$ano.$r[id_mat_prima_nacional];
		  ?>
         <tr>
          <td nowrap="nowrap" class="cajas"><div align="center"><? echo $pik;?></div></td>
          <td nowrap="nowrap" class="cajas"><? echo $row[id_etiquetados_folios];?></td>
          <td nowrap="nowrap" class="cajas"><? echo $r[id_mat_prima_nacional];?></td>
          <td nowrap="nowrap" class="cajas">&nbsp;<? echo $r[nombre_producto]?>&nbsp;</td>
          <td nowrap="nowrap" class="cajas">&nbsp;<? echo format_fecha($r[fecha_ingreso]);?></td>
          <td nowrap="nowrap" class="cajas">&nbsp;<? echo format_fecha($r[fecha_faena]);?></td>
          <td nowrap="nowrap" class="cajas">&nbsp;<? echo format_fecha($r[fecha_termino]);?></td>
          <td nowrap="nowrap" class="cajas"><? echo $r[contenido]?></td>
          <td nowrap="nowrap" class="cajas">&nbsp;<? echo $r[nombre_origen]?></td>
          <td nowrap="nowrap" class="cajas">&nbsp;<? echo $r[rcp]?></td>
          <td nowrap="nowrap" class="cajas">&nbsp;<? echo $r[comprobante_num]?></td>
          <td nowrap="nowrap" class="cajas">&nbsp;<? echo $r[bidon_num]?></td>
          <td width="1%" nowrap="nowrap" class="cajas">&nbsp;<? 
					if($r[id_pro]){
					$id_producto=$r[id_pro];
		 			$unidad_medida= crea_unidad_medida_producto2($link,$id_producto);
					echo $unidad_medida;
					}
					?></td>
          <td width="1%" nowrap="nowrap" class="cajas"><? echo $f_elaboracion ?></td>
          <td width="1%" nowrap="nowrap" class="cajas"><? echo $f_termino ?></td>
         </tr>
                      <? 
					      } // while
					?>
			</table>	  
				               
                  <? }?>				  </td>
                  </tr>
</table>
<? } // IF ($buscar) ?>