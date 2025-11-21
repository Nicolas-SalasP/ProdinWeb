<?
/*
$hoy=date("Y-m-d");
$date01=split(" ",$hoy);
$dat=split("-",$date01[0]);
$f_ano="$dat[0]";
//echo "  $dat[1] - $dat[2] - $dat[0]";
*/
$ano=date("Y");


if($fecha_despacho_desde and $fecha_despacho_hasta)
{
$fecha_despacho_desde_ok=format_fecha_sin_hora($fecha_despacho_desde);
$fecha_despacho_hasta_ok=format_fecha_sin_hora($fecha_despacho_hasta);
}

$sql="SELECT p.id_paking_relacion, p.folio_piking , p.id_paking , ef.id_pedidos, p.fecha_ingreso_paking, p.fdespacho_piking, ef.factura, e.estado_folio, e.id_estado_folio, count( DISTINCT ef.id_etiquetados_folios) AS cf, d.destinos AS destinos from paking AS p, etiquetados_folios AS ef, estado_folio AS e, destinos AS d where  ef.id_estado_folio = e.id_estado_folio and p.id_etiquetados_folios = ef.id_etiquetados_folios and ef.id_destinos=d.id_destinos and ef.ano between 2016 and $ano and ef.id_estado_folio between 7 and 12 ";

if($id_destinos){
$sql.= " and ef.id_destinos = '$id_destinos' ";
}

if($fecha_despacho_desde_ok and $fecha_despacho_hasta_ok){
$sql.= " and ef.fdespacho_piking  between '$fecha_despacho_desde_ok' and '$fecha_despacho_hasta_ok' group by p.id_paking_relacion order by p.folio_piking  desc";
}else{
$sql.= "  group by p.id_paking_relacion order by e.id_estado_folio, p.fdespacho_piking DESC";	
}
	
$rest=mysql_query($sql);
$cuantos=mysql_num_rows($rest);
?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
.alerta {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px}
-->
</style>
<script language="JavaScript"> 
function seleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=0 
} 
</script>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<form action="" method="post" name="form1" id="form1">
<table width="798" border="0" align="center">
  <tr>
    <td width="792" height="21" class="titulo">Despachos</td>
  </tr>
  <tr>
    <td height="14" class="titulo"><table width="793" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="214" align="center" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><? 
			        $destinos= crea_destinos_confiltros_ocupados($link,$id_destinos);
					echo $destinos;
					
				   //$id_destinos=$row[id_destinos];
				?></td>
        <td width="99" align="center" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Fecha Despacho </td>
        <td width="91" align="center" valign="bottom" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><input name="fecha_despacho_desde" type="text" class="cajas"   id="fecha_despacho_desde"  value="<?echo $fecha_despacho_desde?>" size="7" maxlength="10" />
          <a href="javascript:show_Calendario('form1.fecha_despacho_desde');" class="cajas"  ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a></td>
        <td width="108" align="center" valign="bottom" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><input name="fecha_despacho_hasta" type="text" class="cajas"   id="fecha_despacho_hasta"  value="<?echo $fecha_despacho_hasta?>" size="7" maxlength="10" />
          <a href="javascript:show_Calendario('form1.fecha_despacho_hasta');" class="cajas"  ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" /></a></td>
        <td width="92" align="center" nowrap="nowrap" class="titulo"><input name="buscar" type="submit" class="cajas" value="Buscar" /></td>
        <td width="88" align="center" nowrap="nowrap" class="titulo">&nbsp;</td>
        <td width="101" align="center" nowrap="nowrap" class="titulo"><a href="?modulo=picking_folios.php">Ver Picking</a></td>

<?php if($fecha_despacho_desde_ok and $fecha_despacho_hasta_ok) {?>
		<td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="informes_excel/excel_reporte_despachos.php?fecha_despacho_desde=<?echo $fecha_despacho_desde_ok?>&fecha_despacho_hasta=<? echo $fecha_despacho_hasta_ok?>">Exportar Excel</a></td>        
<?}?>		
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
	<? if($cuantos){?>
	<table width="788" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td width="808">
            <table width="785" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="8%" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">N&ordm; Piking </td>
                <td width="9%" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Factura</td>
                <td width="11%" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Pedido</td>
                <td width="32%" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Destino</td>
                <td width="13%" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Cantidad Bidones</td>
                <td width="6%" align="center" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Estado</td>
                <td width="10%" align="center" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F/Ingreso </td>
                <td width="11%" align="center" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F/Despacho </td>
              </tr>
              <? if ($cuantos) {
			        $i=$cuantos + 1;
					$color = "#000000";$i = 0;
					
					
	   				while ($r=mysql_fetch_array($rest)) { 
					
					$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
					$i--;
					$fecha_ingreso_paking=format_fecha_sin_hora($r[fecha_ingreso_paking]);
					$fecha_despacho=format_fecha_sin_hora($r[fdespacho_piking]);
					
	          ?>
              <tr>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ver_piking_folios.php&amp;id_paking_relacion=<?echo $r[id_paking_relacion]?>&cantifo=<? echo $r[cf]?>&modificar_all<? echo $modificar_all=1;?>&id_destinos=<? echo $id_destinos?>"><?echo $r[folio_piking]?></a></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ver_piking_folios.php&amp;id_paking_relacion=<?echo $r[id_paking_relacion]?>&cantifo=<? echo $r[cf]?>&modificar_all<? echo $modificar_all=1;?>&id_destinos=<? echo $id_destinos?>"><? echo $r[factura];?></a></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><a href="?modulo=ver_piking_folios.php&amp;id_paking_relacion=<?echo $r[id_paking_relacion]?>&amp;cantifo=<? echo $r[cf]?>&amp;modificar_all<? echo $modificar_all=1;?>&id_destinos=<? echo $id_destinos?>"><? echo $r[id_pedidos];?></a></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ver_piking_folios.php&amp;id_paking_relacion=<?echo $r[id_paking_relacion]?>&cantifo=<? echo $r[cf]?>&modificar_all<? echo $modificar_all=1;?>&id_destinos=<? echo $id_destinos?>"><? echo $r[destinos];?></a></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">
                  <div align="center"><? echo $r[cf];?></div></td>
<!--            <?if( $r[estado_folio] == "Despacho" )?>    -->
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><? echo $r[estado_folio];?></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $fecha_ingreso_paking;?></div></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $fecha_despacho;?>
                  <?  $totalcf+=$r[cf];
				  }
				  //if ($cuantos) { ?>
                </div></td>
              </tr>
              <tr>
                <td colspan="4" align="right" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><strong>Total Bidones</strong></td>
                <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><strong><? echo $totalcf?></strong></td>
                <td colspan="3" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;</td>
                </tr>
              <? } //while ($r=mysql_fetch_array($rest)) {  ?>
            </table></td>
      </tr>
    </table><? }else{?>
    <table width="788" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td height="145" class="titulo"><div align="center">No se existen Despachos</div></td>
      </tr>
    </table>
    <? }?></td>
  </tr>
</table>
</form>