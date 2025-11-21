<?
$sql="SELECT p.id_paking_relacion, p.folio_piking , p.id_paking , ef.id_pedidos, p.fecha_ingreso_paking, p.fdespacho_piking, ef.factura, e.estado_folio, e.id_estado_folio, count( DISTINCT ef.id_etiquetados_folios) AS cf, d.destinos AS destinos from paking AS p, etiquetados_folios AS ef, estado_folio AS e, destinos AS d where  ef.id_estado_folio = e.id_estado_folio and p.id_etiquetados_folios = ef.id_etiquetados_folios and ef.id_destinos=d.id_destinos and ef.id_estado_folio = 3 group by p.id_paking_relacion order by p.folio_piking  desc";
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
<table width="794" border="0" align="center">
  <tr>
    <td width="788" height="21" class="titulo">Picking</td>
  </tr>
  <tr>
    <td height="14" class="titulo"><table width="784" border="0" align="center">
      <tr>
        <td width="661" align="center" class="titulo">&nbsp;</td>
        <td width="113" align="center" class="titulo"><a href="?modulo=picking_folios_despachados.php">Ver Despachos</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
	<? if($cuantos){?>
	<table width="788" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td width="782"><form action="" method="post" name="form1" id="form1">
            <table width="785" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="8%" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">N&ordm; Piking </td>
                <td width="9%" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Factura</td>
                <td width="11%" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Pedido</td>
                <td width="32%" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Destino</td>
                <td width="12%" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Cantidad Folios </td>
                <td width="6%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Estado</td>
                <td width="11%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Fecha Ingreso </td>
                <td width="11%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Fecha Despacho </td>
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
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ver_piking_folios.php&amp;id_paking_relacion=<?echo $r[id_paking_relacion]?>&cantifo=<? echo $r[cf]?>&modificar_all<? echo $modificar_all=1;?>"><?echo $r[folio_piking]?></a></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ver_piking_folios.php&amp;id_paking_relacion=<?echo $r[id_paking_relacion]?>&cantifo=<? echo $r[cf]?>&modificar_all<? echo $modificar_all=1;?>"><? echo $r[factura];?></a></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><a href="?modulo=ver_piking_folios.php&amp;id_paking_relacion=<?echo $r[id_paking_relacion]?>&amp;cantifo=<? echo $r[cf]?>&amp;modificar_all<? echo $modificar_all=1;?>"><? echo $r[id_pedidos];?></a></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ver_piking_folios.php&amp;id_paking_relacion=<?echo $r[id_paking_relacion]?>&cantifo=<? echo $r[cf]?>&modificar_all<? echo $modificar_all=1;?>"><? echo $r[destinos];?></a></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">
                  <div align="center"><? echo $r[cf];?></div></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $r[estado_folio];?></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $fecha_ingreso_paking;?></div></td>
                <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $fecha_despacho;?></div></td>
              </tr>
              <? } //while ($r=mysql_fetch_array($rest)) {  ?>
            </table>
            <? } //if ($cuantos) { ?>
        </form></td>
      </tr>
    </table><? }else{?>
    <table width="788" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td width="810" height="145" class="titulo"><div align="center">No se existen Picking</div></td>
      </tr>
    </table>
    <? }?></td>
  </tr>
</table>
