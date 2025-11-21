<?

if($fecha_terminod and $fecha_terminoh){
$fecha_ingresodesde=format_fecha_sin_hora($fecha_terminod);
$fecha_ingresohasta=format_fecha_sin_hora($fecha_terminoh);
}
if(!$piking){

$sql="SELECT carpro.caract_producto AS caract_producto , carenv.caract_envases AS caract_envases,ef.ano,ef.compro_nro, ef.id_etiquetados_folios, ef.factura, ef.contenido_unidades, ef.f_elaboracion, ef.f_inicio, ef.f_termino, p.nombre AS nombre_producto, mp.nombre AS nombre_medidas,c.calibre, c.color, o.nombre AS nombre_operarios,e.estado_folio, dest.nombre AS destinos_nombre, um.unidad_medida AS unidad_medida 
FROM 
etiquetados_folios AS ef, producto AS p, medidas_productos AS mp, calibre AS c,operarios AS o,estado_folio AS e, destinos AS dest, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv 
where
 ef.id_etiquetados_folios=ef.id_etiquetados_folios and
 ef.id_producto = p.id_producto and
 ef.id_medidas_productos = mp.id_medidas_productos and
 ef.id_calibre = c.id_calibre and
 ef.id_operarios=o.id_operarios and 
 ef.id_estado_folio = e.id_estado_folio and 
 ef.id_destinos = dest.id_destinos  and 
 ef.id_unidad_medida = um.id_unidad_medida and 
 ef.id_caract_producto = carpro.id_caract_producto and 
 ef.id_caract_envases = carenv.id_caract_envases
 ";

if($id_medidas_productos){
$sql.= " and mp.id_medidas_productos = '$id_medidas_productos' ";
}

if($id_caract_producto){
$sql.= " and carpro.id_caract_producto = '$id_caract_producto' ";
}
if($id_caract_envases){
$sql.= " and carenv.id_caract_envases = '$id_caract_envases' ";
}

if($id_unidad_medida){
$sql.= " and um.id_unidad_medida = '$id_unidad_medida' ";
}

if($id_estado_folio){
$sql.= " and e.id_estado_folio = '$id_estado_folio' ";
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

if($anobusca){
	$sql.= " and ef.ano = '$anobusca' ";
}
if($factura){
	$sql.= " and ef.factura = '$factura'";
}

if($desde and $hasta){
$sql.= " and ef.id_etiquetados_folios between '$desde' and '$hasta' and ef.id_etiquetados_folios=ef.id_etiquetados_folios ";
}

if($fecha_ingresodesde and $fecha_ingresohasta){
$sql.= " and ef.f_termino between '$fecha_ingresodesde' and '$fecha_ingresohasta'";}

$sql.= " order by ef.id_etiquetados_folios, c.condicion_cod_barra, c.calibre desc";
				
$result=mysql_query($sql);	
//echo "SQL $sql";
$cuantos=mysql_num_rows($result);

}
if($piking){

$pindato=$piking;
$sql="SELECT ef.ano,ef.compro_nro,ef.nombre_alt,ef.id_etiquetados_folios, ef.factura, ef.contenido_unidades, ef.f_elaboracion, ef.f_inicio, ef.f_termino, pro.nombre AS nombre_producto, medpro.nombre AS nombre_medidas,c.calibre, c.color, op.nombre AS nombre_operarios,estf.estado_folio, des.nombre AS destinos_nombre, um.unidad_medida AS unidad_medida
FROM paking AS pk, etiquetados_folios AS ef, producto AS pro, calibre AS c, operarios AS op, destinos AS des, estado_folio AS estf, medidas_productos AS medpro, unidad_medida AS um
WHERE pk.folio_piking = $pindato and ef.id_etiquetados_folios = pk.id_etiquetados_folios and ef.id_producto = pro.id_producto and ef.id_calibre = c.id_calibre and ef.id_operarios = op.id_operarios and ef.id_destinos = des.id_destinos and ef.id_estado_folio = estf.id_estado_folio and ef.id_medidas_productos = medpro.id_medidas_productos and ef.id_unidad_medida = um.id_unidad_medida";

if($id_estado_folio){
$sql.= " and estf.id_estado_folio = '$id_estado_folio' ";
}


$sql.= " order by nombre_alt, c.calibre, medpro.nombre, ef.id_etiquetados_folios des";
				
$result=mysql_query($sql);	
$cuantos=mysql_num_rows($result);
}



?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style2 {font-size: 14px}
.style3 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<form id="form1" name="form1" method="post" action="">
<table width="552" border="0" align="center">
  <tr>
    <td width="179" height="30" class="titulo">Informes de Folios </td>
    <td width="379" class="titulo">&nbsp;</td>
    <td width="143" class="titulo">
      <? if($buscar){?><a href="?modulo=informes_folios.php">
      Volver  </a><?}?></td>
  </tr>
  <tr>
    <td colspan="3"><table width="600" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td>
		<? if(!$buscar or !$id_producto or !$id_calibre){?>
		<table width="574" border="0" align="center">
            <tr>
              <td height="24"><div align="left"><span class="titulo">Estado Folio </span></div></td>
              <td colspan="2" class="titulo">Producto</td>
              <td width="131" class="titulo"><div align="right"><a href="?modulo=informes_diarios.php" class="style3">Resumen inventario</a></div></td>
            </tr>
            <tr>
              <td><? $estado_folio=crea_estado_folio($link,$id_estado_folio,1);
		echo $estado_folio;?></td>
              <td colspan="3"><? $producto= crea_producto_onchange($link,$id_producto);
		 echo $producto;?></td>
              </tr>
            <tr>
              <td class="titulo"><div align="left">Piking</div></td>
              <td><input name="piking" type="text" class="cajas" id="piking" size="10" value="<? echo $piking ?>" /></td>
              <td colspan="2" class="cajas">[* Fecha por defecto A&ntilde;o 2009]</td>
              </tr>
            <tr>
              <td width="167" class="titulo">Factura</td>
              <td><input name="factura" type="text" class="cajas" id="factura" size="10" value="<? echo $factura ?>" /></td>
              <td colspan="2">&nbsp;</td>
              </tr>
            <tr><? if(!$anobusca){
$anobusca=2009;
}?>
              <td width="167" bgcolor="#CCCCCC" class="titulo">A&ntilde;o</td>
              <td width="105"><input name="anobusca" type="text" class="cajas" id="anobusca" size="10" value="<? echo $anobusca ?>" /></td>
              <td colspan="2" bgcolor="#CCCCCC" class="titulo">Fecha de Termino </td>
            </tr>
            <tr>
              <td width="167" bgcolor="#CCCCCC" class="titulo">Desde Nro:</td>
              <td><input name="desde" type="text" class="cajas" id="desde" size="10" value="<? echo $desde ?>" /></td>
              <td width="153"><span class="titulo">Desde</span></td>
              <td><span class="titulo">Hasta</span></td>
              </tr>
            <tr>
              <td width="167" bgcolor="#CCCCCC" class="titulo">Hasta Nro: </td>
              <td><input name="hasta" type="text" class="cajas" id="hasta" size="10" value="<? echo $hasta ?>" /></td>
              <td><input name="fecha_terminod" type="text" class="cajas"   id="fecha_terminod"  value="<?echo $fecha_terminod?>" size="10" maxlength="10" /><a href="javascript:show_Calendario('form1.fecha_terminod');" class="cajas"  >Ver</a></td>
              <td>
			  <input name="fecha_terminoh" type="text" class="cajas"   id="fecha_terminoh"  value="<?echo $fecha_terminoh?>" size="10" maxlength="10" /><a href="javascript:show_Calendario('form1.fecha_terminoh');" class="cajas"  >Ver</a></td>
              </tr>
            <tr>
              <td width="167" class="titulo">&nbsp;</td>
              <td colspan="3"><input name="buscar" type="submit" class="cajas" value="Buscar" /></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
        </table>
		<? }?>
		<table width="734" border="0" align="center">
            <tr>
              <td width="728"><div align="center"><span class="titulo style2">R-LB-SOP01/14.</span></div></td></tr>
            <tr>
              <td valign="top">
                <? //if($buscar and !$folios or $id_producto or $id_calibre ){

				if($buscar){
				  
				  ?>
             
			  <a href="excel_etiquetas_folios.php?id_estado_folio=<? echo $id_estado_folio;?>&id_producto=<? echo $id_producto?>&desde=<? echo $desde?>&hasta=<? echo $hasta?>&fecha_ingresod=<? echo $fecha_ingresodesde?>&fecha_ingresoh=<? echo $fecha_ingresohasta?>&piking=<? echo $piking?>&anobusca=<? echo $anobusca?>" target="_blank"><img src="jpg/icono-excel.gif" width="33" height="33" border="0" /></a> &nbsp;&nbsp;&nbsp;<span class="titulo"><? echo "Cantidad $cuantos";?></span>
			  <table width="680" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="31" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="center">Folio</div></td>
                    <td width="52" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><? //$producto=crea_producto_filtro($link,$id_producto,1); echo $producto;?>
                      <? $producto= crea_producto_onChange($link,$id_producto);
		 echo $producto;?></td>
                    <td width="39" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><? 
	    //if($id_producto){
		//$calibre=crea_calibre_filtro($link,$id_calibre,$id_producto,1);
		//echo $calibre;}
		 if ($id_producto) {
		$calibre=crea_calibre_filtro($link,$id_calibre,$id_producto,1);
		echo $calibre;
		}
		if(!$id_producto)
		{
		echo "Calibre";
		}
		
		
		?></td>
                    <td width="37" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">
					<?
					 if ($id_producto) {
						$unidad_medida=crea_unidad_medida_filtro($link,$id_unidad_medida,$id_producto,1);
					echo $unidad_medida;
					}
					
					if(!$id_producto)
					{
					echo "Unidad Medida";
					}
					
					?></td>
                    <td nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><?
					 if ($id_producto) {
					$medidas_productos=crea_medidas_productos_filtro($link,$id_medidas_productos,$id_producto,1);
					echo $medidas_productos;
					}
					
					if(!$id_producto)
						{
						echo "Medidas";
						}
					
					?></td>
                    <td nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><?
					 if ($id_producto) {
					$caract_producto=crea_caract_producto_filtro($link,$id_caract_producto,$id_producto,1);
					echo $caract_producto;
					}
					
					if(!$id_producto)
						{
						echo "C/P";
						}
					
					?></td>
                    <td nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><?
					 if ($id_producto) {
					$caract_envases=crea_caract_envases_filtro($link,$id_caract_envases,$id_producto,1);
					echo $caract_envases;
					}
					
					if(!$id_producto)
					{
					echo "C/E";
					}
					
					?></td>
                    <td nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Contenido</td>
                    <td width="49" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">F.Faena </td>
                    <td width="46" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">F. Inicio</td>
                    <td width="63" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">F. Termino </td>
                    <td width="22" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Factura</td>
                    <td width="22" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Comprob. Nro </td>
                    <td width="74" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Est. Material </td>
                    <td width="54" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Operador</td>
                    <td width="76" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Destinos</td>
                  </tr>
                  <?
	

//if($id_estado_folio)
	//$sql.= " and ef.id_estado_folio = '$id_estado_folio'";

if($fecha_ingresod != '' and fecha_ingresoh != ''){
$fecha_ingresod=format_fecha_sin_hora($fecha_ingresod);
$fecha_ingresoh=format_fecha_sin_hora($fecha_ingresoh);
//echo "Fdesde $fecha_ingresod ---  Fhasta $fecha_ingresoh";
}





				
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
                    <td nowrap="NOWRAP" class="cajas"><div align="center"><? echo $id_etiquetados_folios;?></div></td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?
		if ($row[nombre_alt] != '') {
		  $i++;
		  $prod=$row[nombre_alt];
		  }
		else
		  $prod=$row[nombre_producto];
		echo $prod;
		?> </td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<? 
					if ($row[calibre_alt] != '') 
		  $calibre=$row[calibre_alt];
		else
		  $calibre=$row[calibre];
		echo $calibre;
					?></td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[unidad_medida]?></td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[nombre_medidas]?>&nbsp;</td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[caract_producto]?></td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[caract_envases]?></td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[contenido_unidades]?>&nbsp;</td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $f_elaboracion?></td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $f_inicio?></td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $f_termino?>&nbsp;</td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[factura]?></td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[compro_nro]?></td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[estado_folio]?></td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[nombre_operarios]?> <?echo $row[apellido]?></td>
                    <td nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[destinos_nombre]?></td>
                  </tr>
                  <? } //while ($row=mysql_fetch_array($result))
				
				?>
                </table>
                <? } //if($buscar and !$folios){?></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>