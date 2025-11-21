<?


if(!$piking){

if($fecha_terminod and $fecha_terminoh)
{
$fecha_ingresodesde=format_fecha_sin_hora($fecha_terminod);
$fecha_ingresohasta=format_fecha_sin_hora($fecha_terminoh);
}


if($fecha_despacho_desde and $fecha_despacho_hasta)
{
$fecha_despacho_desde_ok=format_fecha_sin_hora($fecha_despacho_desde);
$fecha_despacho_hasta_ok=format_fecha_sin_hora($fecha_despacho_hasta);
}

if($fecha_iniciodesde and $fecha_iniciohasta){
$fecha_inicio_desde=format_fecha_sin_hora($fecha_iniciodesde);
$fecha_inicio_hasta=format_fecha_sin_hora($fecha_iniciohasta);
}

$sql="SELECT * FROM etiquetados_folios AS ef, producto AS p, medidas_productos AS mpro, calibre AS c,operarios AS o,estado_folio AS e, destinos AS dest, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, origenes AS orig where  ef.id_etiquetados_folios=ef.id_etiquetados_folios and ef.id_producto = p.id_producto and ef.id_medidas_productos = mpro.id_medidas_productos and ef.id_calibre = c.id_calibre and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio and ef.id_destinos = dest.id_destinos  and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 and ef.id_origen = orig.id_origen ";

if($id_medidas_productos){
$sql.= " and mpro.id_medidas_productos = '$id_medidas_productos' ";
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

if($guia_despacho_trazab)
{
$sql.= " and ef.guia_despacho_trazab = '$guia_despacho_trazab'";
}

if($bidon_importado){
$sql.= " and ef.bidon_importado = '$bidon_importado'";

}


if($id_destinos){
$sql.= " and dest.id_destinos = '$id_destinos'";
}

if($incluir_pedidos){
//echo "id_pedidos $incluir_pedidos";
$sql.= " and ef.id_pedidos = 0  ";
}

//if($entreano1 and $entreano2 and $fecha_ingresodesde = '' and $fecha_ingresohasta = '' and $fechainiciodesde = '' and $fechainiciohasta = '' and $fecha_despacho_desde_ok = '' and $fecha_despacho_hasta_ok = '' and $fecha_inicio_desde = '' and $fecha_inicio_hasta = '' ){
//$sql.= " and ef.ano between '$entreano1' and '$entreano2' ";
//}

if($entreano1 and $entreano2 and !$fecha_inicio_desde and !$fecha_inicio_hasta){
$sql.= " and ef.ano between '$entreano1' and '$entreano2' ";
}else{
$sql.= " and ef.f_elaboracion between '$fecha_inicio_desde' and '$fecha_inicio_hasta'";
}
if($fecha_despacho_desde_ok and $fecha_despacho_hasta_ok){
$sql.= " and ef.fdespacho_piking between '$fecha_despacho_desde_ok' and '$fecha_despacho_hasta_ok'";
}

if($factura){
	$sql.= " and ef.factura = '$factura'";
}

if($factura_importada){
	$sql.= " and ef.factura_importada = '$factura_importada'";
}


if($desde and $hasta){
$sql.= " and ef.id_etiquetados_folios between '$desde' and '$hasta' and ef.id_etiquetados_folios=ef.id_etiquetados_folios ";
}

if($desde and $hasta){
$sql.= " and ef.id_etiquetados_folios between '$desde' and '$hasta'";}

if($entreano1 and $entreano2 and $fecha_ingresodesde and $fecha_ingresohasta){
$sql.= " and ef.f_termino between '$fecha_ingresodesde' and '$fecha_ingresohasta'";
}




$sql.= " order by ef.id_etiquetados_folios, c.condicion_cod_barra, c.calibre desc";
				
$result=mysql_query($sql);	
//echo "SQL $sql";
$cuantos=mysql_num_rows($result);


}
if($piking){

//ef.ano,ef.compro_nro,ef.nombre_alt,ef.id_etiquetados_folios, ef.factura, ef.contenido_unidades, ef.f_elaboracion, ef.f_inicio, ef.f_termino, pro.nombre AS nombre_producto, medpro.nombre AS nombre_medidas,c.calibre, c.color, op.nombre AS nombre_operarios,estf.estado_folio, des.nombre AS destinos_nombre, um.unidad_medida AS unidad_medida

$pindato=$piking;
$sql="SELECT * FROM paking AS pk, etiquetados_folios AS ef, producto AS pro, calibre AS c, operarios AS op, destinos AS des, estado_folio AS estf, medidas_productos AS medpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv WHERE pk.folio_piking = $pindato and ef.id_etiquetados_folios = pk.id_etiquetados_folios and ef.id_producto = pro.id_producto and ef.id_calibre = c.id_calibre and ef.id_operarios = op.id_operarios and ef.id_destinos = des.id_destinos and ef.id_estado_folio = estf.id_estado_folio and ef.id_medidas_productos = medpro.id_medidas_productos and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 ";

if($id_estado_folio){
$sql.= " and estf.id_estado_folio = '$id_estado_folio' ";
}


$sql.= " order by nombre_alt, c.calibre, medpro.medidas_productos, ef.id_etiquetados_folios desc";
				
$result=mysql_query($sql);	
$cuantos=mysql_num_rows($result);
}



?>
<? 
			        if(!$entreano1){
					$entreano1=$fhoy=date("Y");
					$entreano1=$entreano1-1;
					}
					if(!$entreano2){
					$entreano2=$fhoy=date("Y");
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
<table width="999" border="0" align="center">
  <tr>
    <td width="235" height="30" class="titulo">Informes de Folios </td>
    <td width="598" class="titulo">&nbsp;</td>
    <td width="152" class="cajas">
      <? if($buscar){?><a href="?modulo=informes_folios.php">
      Volver  </a><?}?></td>
  </tr>
  <tr>
    <td colspan="3"><table width="1010" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td width="1000">
		<? if(!$buscar or !$id_producto or !$id_calibre){?>
		<table width="881" border="0" align="center">
            <tr>
              <td colspan="2"><table width="622" border="0">
                <tr>
                  <td width="141" bgcolor="#CCCCCC"><? $estado_folio=crea_estado_folio($link,$id_estado_folio,1);
		echo $estado_folio;?></td>
                  <td width="128" bgcolor="#CCCCCC"><? $producto= crea_producto_onchange2($link,$id_producto);
		 echo $producto;?></td>
                  <td bgcolor="#FF9900"><div align="center"><a href="?modulo=informes_diarios.php" class="style3">Resumen Inventario</a></div></td>
                  </tr>
              </table></td>
              </tr>
            <tr>
              <td colspan="2" class="titulo"><table width="868" border="0">
                <tr>
                  <td width="141" height="22" bgcolor="#999999" class="titulo">&nbsp;Piking</td>
                  <td width="128" bgcolor="#FF9900"><div align="center">
                    <input name="piking" type="text" class="cajas" id="piking" size="17" value="<? echo $piking ?>" />
                  </div></td>
                  <td width="147" bgcolor="#999999" class="titulo">&nbsp;Factura Venta N/I</td>
                  <td width="197" bgcolor="#FF9900">
                    &nbsp;<input name="factura" type="text" class="cajas" id="factura" size="24" value="<? echo $factura ?>" />
                  </td>
                  <td width="87" bgcolor="#999999" class="titulo">Gu&iacute;a Despacho</td>
                  <td width="142" bgcolor="#FF9900"><input name="guia_despacho_trazab" type="text" class="cajas" id="guia_despacho_trazab" size="24" value="<? echo $guia_despacho_trazab?>" /></td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td colspan="2" class="titulo"><table width="622" border="0">

                <tr>
                  <td width="141" bgcolor="#999999" class="titulo">&nbsp;A&ntilde;o ( <span class="cajas"><? echo $entreano1?></span> -<span class="cajas"><? echo $entreano2?></span>) </td>
                  <td width="57" bgcolor="#FF9900"><div align="center">
                    <input name="entreano1" type="text" class="cajas" id="entreano1" value="<? echo $entreano1 ?>" size="4" maxlength="4" />
                  </div></td>
                  <td width="67" bgcolor="#FF9900"><div align="center">
                    <input name="entreano2" type="text" class="cajas" id="entreano2" value="<? echo $entreano2 ?>" size="4" maxlength="4" />
                  </div></td>
                  <td width="148" bgcolor="#999999" class="titulo">&nbsp;Factura Importada:</td>
                  <td bgcolor="#FF9900">
                    &nbsp;<input name="factura_importada" type="text" class="cajas" id="factura_importada" size="24" value="<? echo $factura_importada ?>" />
                  </td>
                </tr>
              </table></td>
              </tr>
            
            <tr>
              <td colspan="2" class="titulo"><table width="622" border="0">
                <tr>
                  <td width="140" bgcolor="#999999" class="titulo">&nbsp;Desde N&deg; Folio:</td>
                  <td width="128" bgcolor="#FF9900"><div align="center">
                    <input name="desde" type="text" class="cajas" id="desde" size="17" value="<? echo $desde ?>" />
                  </div></td>
                  <td width="148" bgcolor="#999999" class="titulo">&nbsp;Hasta N&deg; Folio: </td>
                  <td bgcolor="#FF9900">
                    &nbsp;<input name="hasta" type="text" class="cajas" id="hasta" size="24" value="<? echo $hasta ?>" />
                  </td>
                </tr>
                <tr>
                  <td width="140" bgcolor="#999999" class="titulo">&nbsp;N&ordm; Bidon Importado</td>
                  <td width="128" align="center" bgcolor="#FF9900"><input name="bidon_importado" type="text" class="cajas" id="bidon_importado" size="17" value="<? echo $bidon_importado ?>" /></td>
                  <td bgcolor="#999999" class="titulo">&nbsp;Origen Importado:</td>
                  <td width="188" bgcolor="#FF9900">
                  &nbsp;<?
                  $origen=crea_origenes222($link,$id_origen);
		echo $origen;
				  ?>
                  </td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td colspan="2" class="titulo"><table width="622" height="29" border="0">
                <tr>
                  <td colspan="4" bgcolor="#999999" class="titulo">&nbsp;F.Faena</td>
                  <td colspan="4" bgcolor="#999999" class="titulo">&nbsp;Fecha Termino </td>
                  <td colspan="4" bgcolor="#999999" class="titulo">&nbsp;Fecha Despacho </td>
                </tr>
                <tr>
                  <td colspan="2" bgcolor="#FF9900" class="cajas">&nbsp;Desde</td>
                  <td colspan="2" bgcolor="#FF9900" class="cajas">&nbsp;Hasta</td>
                  <td colspan="2" bgcolor="#FF9900" class="cajas">&nbsp;Desde</td>
                  <td colspan="2" bgcolor="#FF9900" class="cajas">&nbsp;Hasta</td>
                  <td colspan="2" bgcolor="#FF9900" class="cajas">&nbsp;Desde</td>
                  <td colspan="2" bgcolor="#FF9900" class="cajas">&nbsp;Hasta</td>
                </tr>
                <tr>
                  <td width="45" valign="bottom"><input name="fecha_iniciodesde" type="text" class="cajas"   id="fecha_iniciodesde"  value="<?echo $fecha_iniciodesde?>" size="7" maxlength="10" />                    </td>
                  <td width="27"><a href="javascript:show_Calendario('form1.fecha_iniciodesde');" ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a></td>
                  <td width="59" nowrap="nowrap"><input name="fecha_iniciohasta" type="text" class="cajas"   id="fecha_iniciohasta"  value="<?echo $fecha_iniciohasta?>" size="7" maxlength="10" />                   </td>
                  <td width="24" nowrap="nowrap"> <a href="javascript:show_Calendario('form1.fecha_iniciohasta');" ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a></td>
                  <td width="59" nowrap="nowrap"><input name="fecha_terminod" type="text" class="cajas"   id="fecha_terminod"  value="<?echo $fecha_terminod?>" size="7" maxlength="10" />                    </td>
                  <td width="22" nowrap="nowrap"><a href="javascript:show_Calendario('form1.fecha_terminod');" class="cajas"  ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a></td>
                  <td width="58" nowrap="nowrap"><input name="fecha_terminoh" type="text" class="cajas"   id="fecha_terminoh"  value="<?echo $fecha_terminoh?>" size="7" maxlength="10" />                    </td>
                  <td width="22" nowrap="nowrap"><a href="javascript:show_Calendario('form1.fecha_terminoh');" class="cajas"  ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a></td>
                  <td width="70" nowrap="nowrap"><input name="fecha_despacho_desde" type="text" class="cajas"   id="fecha_despacho_desde"  value="<?echo $fecha_despacho_desde?>" size="7" maxlength="10" />                    </td>
                  <td width="27" nowrap="nowrap"><a href="javascript:show_Calendario('form1.fecha_despacho_desde');" class="cajas"  ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a></td>
                  <td width="74" nowrap="nowrap"><input name="fecha_despacho_hasta" type="text" class="cajas"   id="fecha_despacho_hasta"  value="<?echo $fecha_despacho_hasta?>" size="7" maxlength="10" />                    </td>
                  <td width="24" nowrap="nowrap"><a href="javascript:show_Calendario('form1.fecha_despacho_hasta');" class="cajas"  ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a></td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td width="353" class="titulo">&nbsp;
			  <? if($incluir_pedidos){
			  ?>
			  
			  <input name="incluir_pedidos" type="checkbox" value="1" checked="checked"/>
				  
			  <? }else{?>
			  
			  <input name="incluir_pedidos" type="checkbox" value="1"/>
			  <? 
			  
			  }?>
              No Incluir Folios Asignados a Pedidos </td>
              <td width="518"><div align="center">
                <input name="buscar" type="submit" class="cajas" value="Buscar" />
              </div></td>
              </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
        </table>
		<? }?>
		<table width="1006" border="0" align="center">
            <tr>
              <td width="1000"><div align="center"></div></td></tr>
            <tr>
              <td valign="top">
                <? //if($buscar and !$folios or $id_producto or $id_calibre ){

				if($buscar and $cuantos or $id_producto){
				  
				  ?>
                <a href="excel_etiquetas_folios.php?id_estado_folio=<? echo $id_estado_folio;?>&id_producto=<? echo $id_producto?>&desde=<? echo $desde?>&hasta=<? echo $hasta?>&fecha_ingresod=<? echo $fecha_ingresodesde?>&fecha_ingresoh=<? echo $fecha_ingresohasta?>&piking=<? echo $piking?>&entreano1=<? echo $entreano1?>&entreano2=<? echo $entreano2?>&id_caract_producto=<? echo $id_caract_producto?>&id_caract_envases=<? echo $id_caract_envases?>&piking=<? echo $piking?>&fecha_despachod=<? echo $fecha_despacho_desde_ok?>&fecha_despachoh=<? echo $fecha_despacho_hasta_ok?>&factura=<? echo $factura?>&compro_nro=<? echo $compro_nro?>&fecha_iniciodesde=<? echo $fecha_iniciodesde?>&fecha_iniciohasta=<? echo $fecha_iniciohasta?>&id_origen=<? echo $id_origen?>&factura_importada=<? echo $factura_importada?>&guia_despacho_trazab=<? echo $guia_despacho_trazab?>" target="_blank"><img src="jpg/icono-excel.gif" width="33" height="33" border="0" /></a>&nbsp;&nbsp;&nbsp;<span class="titulo"><? echo "Cantidad de Folios (Bidones) $cuantos";?></span>
			  <table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="21" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">N/I</div></td>
                    <td width="46" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">N&deg; Folio</div></td>
                    <td width="8" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">ID</div></td>
                    <td width="9" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">N&ordm; Bidon</td>
                    <td width="39" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Pedido</div></td>
                    <td width="37" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><? //$producto=crea_producto_filtro($link,$id_producto,1); echo $producto;?>
                      <? $producto= crea_producto_onChange2($link,$id_producto);
		 echo $producto;?></td>
                    <td width="20" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><? 
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
                    <td width="20" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">
					<?
					 if ($id_producto) {
						$unidad_medida=crea_unidad_medida_filtro($link,$id_unidad_medida,$id_producto,1);
					echo $unidad_medida;
					}
					
					if(!$id_producto)
					{
					echo "Unid/Med";
					}
					
					?></td>
                    <td width="23" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><?
					 if ($id_producto) {
					$medidas_productos=crea_medidas_productos_filtro($link,$id_medidas_productos,$id_producto,1);
					echo $medidas_productos;
					}
					
					if(!$id_producto)
						{
						echo "Medidas";
						}
					
					?></td>
                    <td width="20" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><?
					 if ($id_producto) {
					$caract_producto=crea_caract_producto_filtro($link,$id_caract_producto,$id_producto,1);
					echo $caract_producto;
					}
					
					if(!$id_producto)
						{
						echo "C/P";
						}
					
					?></td>
                    <td width="20" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><?
					 if ($id_producto) {
					$caract_envases=crea_caract_envases_filtro($link,$id_caract_envases,$id_producto,1);
					echo $caract_envases;
					}
					
					if(!$id_producto)
					{
					echo "C/E";
					}
					
					?></td>
                    <td width="57" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Contenido</div></td>
                    <td width="61" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">F.Faena</div></td>
                    <td width="59" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">F/Inicio</div></td>
                    <td nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">F/Termino </div></td>
                    <td width="73" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">F/Despacho </div></td>
                    <td nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="left">Fact. Imp.</div>                      <div align="left"></div></td>
                    <td nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Fact. Venta</td>
                    <td nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Origen</td>
                    <td width="83" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Est/Material </div></td>
                    <td width="81" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Operador</div></td>
                    <td nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Destinos</div></td>
                    <td width="25" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Pondera</td>
                    <td width="25" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Guia Despacho</td>
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
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$id_pedidos=$row[id_pedidos];
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$f_inicio=format_fecha_sin_hora($row[f_inicio]);
	$fbodega_traspaso=format_fecha_sin_hora($row[fbodega_traspaso]);
	
	 
	$f_termino=format_fecha_sin_hora($row[f_termino]);
	$fdespacho_piking=format_fecha_sin_hora($row[fdespacho_piking]);
	$id_m=substr($row[ano],2,4).$id_etiquetados_folios;
	$id_cruce_tablas=$row[id_cruce_tablas];
	$i++;
	?>
                  <tr>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas"><div align="center"><? echo $row[id_procedencia];?></div></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas"><div align="center"><a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $id_etiquetados_folios?>"><? echo $id_etiquetados_folios;?></a></div></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $id_cruce_tablas;?></div></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[bidon_importado]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas"><? echo $id_pedidos;?></td>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas">&nbsp;<?
	/*	if ($row[nombre_alt] != '') {
		  $i++;
		  $prod=$row[nombre_alt];
		  }
		else
		  $prod=$row[producto];
		echo $prod;*/
		
		  $prod=$row[producto];
		echo $prod;
		
		?> </td>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas">&nbsp;<? 
		$calibre=$row[calibre];
		echo $calibre;
					?></td>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[unidad_medida]?></td>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[medidas_productos]?>&nbsp;</td>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[caract_producto]?></td>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[caract_envases]?></td>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[contenido_unidades]?>&nbsp;</td>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas">&nbsp;<?echo $f_elaboracion?></td>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas">&nbsp;<?echo $f_inicio?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $f_termino?>&nbsp;&nbsp;&nbsp;</td>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas"><?echo $fdespacho_piking ?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[factura_importada]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[factura]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[origen]?></td>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[estado_folio]?></td>
                    <td bgcolor="<? echo $color?>" nowrap="NOWRAP" class="cajas">&nbsp;<?echo $row[nombreop]?> <?echo $row[apellido]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[destinos]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[total_ponderado]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[guia_despacho_trazab]?></td>
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