<?
ini_set('memory_limit', '-1');

if(!$piking){

if($fecha_terminod and $fecha_terminoh)
{
$fecha_ingresodesde=format_fecha_sin_hora($fecha_terminod);
$fecha_ingresohasta=format_fecha_sin_hora($fecha_terminoh);
}

if($fbodega_mpidesde and $fbodega_mpihasta){
$fecha_ingreso_mpidesde=format_fecha_sin_hora($fbodega_mpidesde);
$fecha_ingreso_mpihasta=format_fecha_sin_hora($fbodega_mpihasta);
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

if($fecha_iniciodesderepro and $fecha_iniciodesderepro){
$fecha_inicio_desderep=format_fecha_sin_hora($fecha_iniciodesderepro);
$fecha_inicio_hastarep=format_fecha_sin_hora($fecha_iniciohastarepro);
}

$sql="SELECT * FROM etiquetados_folios AS ef, producto AS p, medidas_productos AS mpro, calibre AS c,operarios AS o,estado_folio AS e, destinos AS dest, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, origenes AS orig, procedencia AS proce where  ef.id_etiquetados_folios=ef.id_etiquetados_folios and ef.id_producto = p.id_producto and ef.id_medidas_productos = mpro.id_medidas_productos and ef.id_calibre = c.id_calibre and ef.id_procedencia = proce.id_procedencia and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio and ef.id_destinos = dest.id_destinos  and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 and ef.id_origen = orig.id_origen and ef.id_estado_folio != 11";

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

if($entreano1 and $entreano2 and !$fecha_inicio_desderep and !$fecha_inicio_hastarep){
	$sql.= " and ef.ano between '$entreano1' and '$entreano2' ";
}else{
    $sql.= " and ef.freprocesado  between '$fecha_inicio_desderep' and '$fecha_inicio_hastarep'";
}

if($factura){
	$sql.= " and ef.factura = '$factura'";
}

if($id_cruce_tablas){
	$sql.= " and ef.id_cruce_tablas = '$id_cruce_tablas'";
}

if($codigopt){
	$sql.= " and ef.id_cruce_tablas = '$codigopt'";
}

if($pallet){
	$sql.= " and ef.pallet = '$pallet'";
}

if($pallet_bidones and !$pallet_cajas)
{
$sql.= " and ef.id_caract_producto != 25  ";	
	
}

if($pallet_cajas and !$pallet_bidones){
$sql.= " and ef.id_caract_producto = 25  ";	
	
}


if($factura_importada){
	$sql.= " and ef.factura_importada = '$factura_importada'";
}

//

if($desde and $hasta){
$sql.= " and ef.folio_m3 between '$desde' and '$hasta' and ef.folio_m3=ef.folio_m3 ";
// $sql.= " and ef.id_etiquetados_folios between '$desde' and '$hasta' and ef.id_etiquetados_folios=ef.id_etiquetados_folios ";
}

if($desde and $hasta){
$sql.= " and ef.folio_m3 between '$desde' and '$hasta' ";
// $sql.= " and ef.id_etiquetados_folios between '$desde' and '$hasta'";

}

if($entreano1 and $entreano2 and $fecha_ingresodesde and $fecha_ingresohasta){
$sql.= " and ef.f_termino between '$fecha_ingresodesde' and '$fecha_ingresohasta'";
}

if($fbodega_mpidesde and $fbodega_mpihasta){
$sql.= " and ef.fbodega_mpi between '$fecha_ingreso_mpidesde' and '$fecha_ingreso_mpihasta'";
}

$sql.= " and ef.ocupado = 0 order by ef.id_etiquetados_folios, c.condicion_cod_barra, c.calibre desc";

$result=mysql_query($sql);	
$cuantos=mysql_num_rows($result);


}
if($piking){

//ef.ano,ef.compro_nro,ef.nombre_alt,ef.id_etiquetados_folios, ef.factura, ef.contenido_unidades, ef.f_elaboracion, ef.f_inicio, ef.f_termino, pro.nombre AS nombre_producto, medpro.nombre AS nombre_medidas,c.calibre, c.color, op.nombre AS nombre_operarios,estf.estado_folio, des.nombre AS destinos_nombre, um.unidad_medida AS unidad_medida

$pindato=$piking;
$sql="SELECT * FROM paking AS pk, etiquetados_folios AS ef, producto AS pro, calibre AS c, operarios AS op, destinos AS des, estado_folio AS estf, medidas_productos AS medpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv WHERE pk.folio_piking = $pindato and ef.id_etiquetados_folios = pk.id_etiquetados_folios and ef.id_producto = pro.id_producto and ef.id_calibre = c.id_calibre and ef.id_operarios = op.id_operarios and ef.id_destinos = des.id_destinos and ef.id_estado_folio = estf.id_estado_folio and ef.id_medidas_productos = medpro.id_medidas_productos and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 ";

if($id_estado_folio){
$sql.= " and estf.id_estado_folio = '$id_estado_folio' ";
}


$sql.= " and ef.id_procedencia = 'N'  order by nombre_alt, c.calibre, medpro.medidas_productos, ef.id_etiquetados_folios desc";
				
$result=mysql_query($sql);	
$cuantos=mysql_num_rows($result);
}



?>
<? 
			        if(!$entreano1){
					$entreano1=$fhoy=date("Y");
					$entreano1=$entreano1-2;
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

<script>
window.onload = detectarCarga;
function detectarCarga(){
   document.getElementById("carga").style.display="none";
}</script>

<div id="carga">
  <img height="80" width="80" border="0" src="jpg/cargando.gif" />
</div>

<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>

<form id="form1" name="form1" method="post" action="">
<table width="999" border="0" align="center">
  <tr>
    <td width="235" height="30" class="titulo">Informes de Folios PT Nacionales</td>
  </tr>
  <tr>
    <td colspan="3"><table width="1010" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td width="1000">
		<? if($buscar or !$id_producto or !$id_calibre){?>
		<table width="742" border="0" align="center">
            <tr>
              <td colspan="2"><table width="752" border="0">
                <tr>
                  <td width="141" bgcolor="#CCCCCC"><? 
				 $estado_folio=crea_estado_folio($link,$id_estado_folio,1);
				 
				 /*<!-- $estado_folio=crea_estado_folio($link,$id_estado_folio,1);-->*/
				 
				echo $estado_folio;

				?>
        
              </td>
                  <td width="338" bgcolor="#CCCCCC">
				  <? 
				  
				  if($id_estado_folio){
				  $producto = crea_producto_onChange_segunestado($link,$id_estado_folio,$id_producto);
				  echo $producto;
				  }
				  ?></td>
                  <td width="259" align="center" bgcolor="#FF9900"><a href="?modulo=exportar_informes_diarios_2.php" class="style3">Resumen Inventario</a></br><small>(Puede tardar un momento)</small></td>
                  </tr>
              </table></td>
              </tr>
            <tr>
              <td colspan="2" class="titulo"><table width="752" border="0">
                <tr>
                  <td width="140" height="22" bgcolor="#999999" class="titulo">&nbsp;Piking</td>
                  <td width="168" bgcolor="#FF9900">&nbsp;<input name="piking" type="text" class="cajas" id="piking" size="17" value="<? echo $piking ?>" />
                  </td>
                  <td width="166" bgcolor="#999999" class="titulo">&nbsp;Factura Venta N/I</td>
                  <td width="260" bgcolor="#FF9900">&nbsp;<input name="factura" type="text" class="cajas" id="factura" size="17" value="<? echo $factura ?>" />
                  </td>
                  </tr>
              </table></td>
              </tr>
            <tr>
              <td colspan="2" class="titulo"><table width="752" border="0">

                <tr>
                  <td width="140" bgcolor="#999999" class="titulo">&nbsp;A&ntilde;o ( <span class="cajas"><? echo $entreano1?></span> - <span class="cajas"><? echo $entreano2?></span>) </td>
                  <td width="60" bgcolor="#FF9900"><div align="center">
                    <input name="entreano1" type="text" class="cajas" id="entreano1" value="<? echo $entreano1 ?>" size="4" maxlength="4" />
                  </div></td>
                  <td width="103" bgcolor="#FF9900"><div align="center">
                    <input name="entreano2" type="text" class="cajas" id="entreano2" value="<? echo $entreano2 ?>" size="4" maxlength="4" />
                  </div></td>
                  <td bgcolor="#999999" class="titulo">&nbsp;
                     </td>
                  </tr>
              </table></td>
              </tr>
            
            <tr>
              <td colspan="2" class="titulo"><table width="752" border="0">
                <tr>
                  <td width="141" bgcolor="#999999" class="titulo">&nbsp;Desde N&deg; Folio:</td>
                  <td width="166" bgcolor="#FF9900">
                   &nbsp;<input name="desde" type="text" class="cajas" id="desde" size="17" value="<? echo $desde ?>" />
                  </td>
                  <td width="168" bgcolor="#999999" class="titulo">&nbsp;Hasta N&deg; Folio: </td>
                  <td width="259" bgcolor="#FF9900">
                    &nbsp;<input name="hasta" type="text" class="cajas" id="hasta" size="17" value="<? echo $hasta ?>" />
                  </td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td colspan="2" class="titulo"><table width="752" border="0">
                <tr>
                  <td width="142" bgcolor="#999999" class="titulo">&nbsp;Gu&iacute;a Despacho</td>
                  <td width="165" bgcolor="#FF9900">&nbsp;<input name="guia_despacho_trazab" type="text" class="cajas" id="guia_despacho_trazab" size="17" value="<? echo $guia_despacho_trazab?>" /></td>
                  <td width="169" bgcolor="#999999" class="titulo">&nbsp;N&ordm; Pallet</td>
                  <td width="258" bgcolor="#FF9900">&nbsp;<input name="pallet" type="text" class="cajas" id="pallet" size="17" value="<? echo $pallet ?>" /></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="2" class="titulo"><table width="752" height="29" border="0">
                <tr>
                  <td colspan="4" bgcolor="#999999" class="titulo">&nbsp;F.Faena (Elaboraci&oacute;n)</td>
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
                <tr>
                  <td colspan="4" bgcolor="#999999" class="titulo">&nbsp;F.Reproceso</td>
                  <td colspan="4" nowrap="nowrap" bgcolor="#999999" class="titulo">&nbsp;F.MPI Procesada</td>
                  <td colspan="4" nowrap="nowrap">&nbsp;</td>
                  </tr>
                <tr>
                  <td valign="bottom"><input name="fecha_iniciodesderepro" type="text" class="cajas"   id="fecha_iniciodesderepro"  value="<?echo $fecha_iniciodesderepro?>" size="7" maxlength="10" /></td>


                  <td><a href="javascript:show_Calendario('form1.fecha_iniciodesderepro');" ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a></td>
                  <td nowrap="nowrap"><input name="fecha_iniciohastarepro" type="text" class="cajas"   id="fecha_iniciohastarepro"  value="<?echo $fecha_iniciohastarepro?>" size="7" maxlength="10" /></td>
                  <td nowrap="nowrap"><a href="javascript:show_Calendario('form1.fecha_iniciohastarepro');" ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a></td>
                  <td nowrap="nowrap"><input name="fbodega_mpidesde" type="text" class="cajas"   id="fbodega_mpidesde"  value="<?echo $fbodega_mpidesde?>" size="7" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.fbodega_mpidesde');" ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a>
                  </td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap"><input name="fbodega_mpihasta" type="text" class="cajas"   id="fbodega_mpihasta"  value="<?echo $fbodega_mpihasta?>" size="7" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.fbodega_mpihasta');" ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a>
                  </td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="bottom">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                </tr>
                </table></td>
              </tr>
            <tr>
              <td width="555" class="titulo">&nbsp;
			  <? if($incluir_pedidos){ ?>
			  
			  <input name="incluir_pedidos" type="checkbox" value="1" checked="checked"/>
				  
			  <? }else{?>
			  
			  <input name="incluir_pedidos" type="checkbox" value="1"/>
			  <? 
			  
			  }?>
              No Incluir Folios Asignados a Pedidos </td>
              <td width="177"><div align="center">
                <input name="buscar" type="submit" class="cajas" value="Buscar" />
              </div></td>
              </tr>
            <tr>
              <td colspan="2"><span class="titulo">&nbsp;
                  <? if(!$pallet_bidones or $id_estado_folio){ ?>
                  <input name="pallet_bidones" type="checkbox" value="1" checked="checked"/>
                  <? }else{?>
                  <input name="pallet_bidones" type="checkbox" value="1"/>
                  <? }?> Incluir Bidones</span></td>
            </tr>
            <tr>
              <td colspan="2"><span class="titulo">&nbsp;
				  <? if(!$pallet_cajas or $id_estado_folio){?>
                  <input name="pallet_cajas" type="checkbox" value="1" checked="checked"/>
                  <? }else{?>
                  <input name="pallet_cajas" type="checkbox" value="1"/>
                  <? }?>
Incluir Cajas </span></td>
            </tr>
        </table>
		<? }?>
		<table width="1108" border="0" align="center">
            <tr>
              <td width="1102"><div align="center"></div></td></tr>
            <tr>
              <td valign="top">
                <? //if($buscar and !$folios or $id_producto or $id_calibre ){

				if($buscar or $id_producto  or $id_cruce_tablas){
				  //if($fbodega_mpidesde and $fbodega_mpihasta)
				  ?>
                 
                <a href="excel_etiquetas_folios.php?id_estado_folio=<? echo $id_estado_folio;?>&id_producto=<? echo $id_producto?>&desde=<? echo $desde?>&hasta=<? echo $hasta?>&fecha_ingresod=<? echo $fecha_ingresodesde?>&fecha_ingresoh=<? echo $fecha_ingresohasta?>&piking=<? echo $piking?>&entreano1=<? echo $entreano1?>&entreano2=<? echo $entreano2?>&id_caract_producto=<? echo $id_caract_producto?>&id_caract_envases=<? echo $id_caract_envases?>&piking=<? echo $piking?>&fecha_despachod=<? echo $fecha_despacho_desde_ok?>&fecha_despachoh=<? echo $fecha_despacho_hasta_ok?>&factura=<? echo $factura?>&compro_nro=<? echo $compro_nro?>&fecha_iniciodesde=<? echo $fecha_iniciodesde?>&fecha_iniciohasta=<? echo $fecha_iniciohasta?>&fecha_iniciodesderepro=<? echo $fecha_iniciodesderepro?>&fecha_iniciohastarepro=<? echo $fecha_iniciohastarepro?>&id_origen=<? echo $id_origen?>&factura_importada=<? echo $factura_importada?>&guia_despacho_trazab=<? echo $guia_despacho_trazab?>&id_cruce_tablas=<? echo $id_cruce_tablas?>&pallet=<? echo $pallet?>&pallet_bidones=<? echo $pallet_bidones?>&pallet_cajas=<? echo $pallet_cajas?>&fecha_ingreso_mpidesde=<? echo $fecha_ingreso_mpidesde?>&fecha_ingreso_mpihasta=<? echo $fecha_ingreso_mpihasta?>" target="_blank"><img src="jpg/icono-excel.gif" width="33" height="33" border="0" /></a>&nbsp;&nbsp;&nbsp;<span class="titulo"><? echo "Cantidad de Folios (Bidones) $cuantos";?></span>                    
			  <table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">
                      
                        <p>N&ordm;</p>
                     
                    </div></td>
                    <td width="11" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">N/I</td>
                    <td width="46" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">N&deg; Folio</div></td>
                    <td width="8" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;
                      <? 
				  if($id_producto){
				  $codgi= crea_id($link,$id_estado_folio,$id_producto,$id_cruce_tablas);
				  echo $codgi;
				  }
				  
				  ?></td>
                    <td width="9" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">N&ordm; Bidon</td>
                    <td width="19" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Pedido</div></td>
<!--                <td width="20" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Pallet</td> -->
                    <td width="37" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><? //$producto=crea_producto_filtro($link,$id_producto,1); echo $producto;?>
                      <? 
					  $producto= crea_producto_onChange_segunestado($link,$id_estado_folio,$id_producto);
				  	  echo $producto;
					  ?></td>
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
                    <td width="41" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Est/Material </div></td>
                    <td width="42" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">F/Reproceso</td>
                    <td width="81" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Operador</div></td>
                    <td nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Destinos</div></td>
                    <td width="25" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">F/Facturacion</td>
                    <td width="25" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Guia Despacho</td>
                    <td width="25" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">F/Origen</td>
                    <td width="25" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">ID_P</td>
                    <td width="25" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Cod_Barra</td>                                                         
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
	$pallet=$row[pallet];
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$f_inicio=format_fecha_sin_hora($row[f_inicio]);
	$fbodega_traspaso=format_fecha_sin_hora($row[fbodega_traspaso]);
	$freprocesado=format_fecha_sin_hora($row[freprocesado]);
	$folio_m3=$row[folio_m3]; 
	 
	$f_termino=format_fecha_sin_hora($row[f_termino]);
	$fdespacho_piking=format_fecha_sin_hora($row[fdespacho_piking]);
  $ffacturacion_piking=format_fecha_sin_hora($row[ffacturacion_piking]);
	$id_m=substr($row[ano],2,4).$id_etiquetados_folios;
	$id_cruce_tablas=$row[id_cruce_tablas];
	$i++;
	?>
                  <tr>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $i?></div></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas"><? echo $row[id_procedencia];?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas"><div align="center"><a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $folio_m3?>"><? echo $folio_m3;?></a></div></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $id_cruce_tablas;?></div></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[bidon_importado]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas"><? echo $id_pedidos;?></td>
<!--                <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $pallet;?></td> -->
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
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[estado_folio]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $freprocesado?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[nombreop]?> <?echo $row[apellido]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[destinos]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[ffacturacion_piking]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[guia_despacho_trazab]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[factura_origen]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[id_etiquetados_folios]?></td>
                    <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $row[bar_code]?></td>                                                         
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
