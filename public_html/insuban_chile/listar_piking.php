<?


$sql="SELECT p.folio_piking ,ef.id_destinos, p.id_paking_relacion , fecha_ingreso_paking, ef.factura,ef.guia,ef.glosa, e.estado_folio, count( DISTINCT ef.id_etiquetados_folios) AS cf from paking AS p, etiquetados_folios AS ef, estado_folio AS e, destinos AS dest where  ef.id_estado_folio = e.id_estado_folio and e.id_estado_folio = 3 and p.id_etiquetados_folios = ef.id_etiquetados_folios and ef.id_destinos = dest.id_destinos group by p.id_paking_relacion order by p.id_paking  desc";
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

<table width="493" border="0" align="center">
  <tr>
    <td width="483" height="30" class="titulo"> Listar Picking</td>
  </tr>
  <tr>
    <td>
	<? if($cuantos){?>
	<table width="600" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td width="575">
            <table width="595" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; Piking </td>
                <td width="32%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Estado</td>
                <td width="43%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Cantidad Folios </td>
                <td width="15%" bgcolor="#CCCCCC" class="titulo">Fecha Ingreso </td>
              </tr>
              <? if ($cuantos) {
			        $i=$cuantos + 1;
	   				while ($r=mysql_fetch_array($rest)) { 
					$i--;
					$fecha_ingreso_paking=format_fecha_sin_hora($r[fecha_ingreso_paking]);
					
	          ?>
              <tr>
                <td class="cajas"><a href="?modulo=modificar_piking.php&amp;id_paking_relacion=<?echo $r[id_paking_relacion]?>&folio_piking=<? echo $r[folio_piking]?>&id_destinos=<? echo $r[id_destinos];?>"><?echo $r[folio_piking]?></a></td>
                <td class="cajas"><a href="?modulo=modificar_piking.php&amp;id_paking_relacion=<?echo $r[id_paking_relacion]?>&folio_piking=<? echo $r[folio_piking]?>&id_destinos=<? echo $r[id_destinos];?>&guia=<? echo "$r[guia]";?>&factura=<? echo "$r[factura]";?>&glosa=<? echo "$r[glosa]";?>"><? echo $r[estado_folio];?></a></td>
                <td class="cajas"><? echo $r[cf]?></td>
                <td class="cajas"><a href="?modulo=modificar_piking.php&amp;id_paking_relacion=<?echo $r[id_paking_relacion]?>&folio_piking=<? echo $r[folio_piking]?>&id_destinos=<? echo $r[id_destinos];?>"><? echo $fecha_ingreso_paking;?></a></td>
              </tr>
              <? } //while ($r=mysql_fetch_array($rest)) {  ?>
            </table>
            <? } //if ($cuantos) { ?>
        </td>
      </tr>
    </table>
	<? }?></td>
  </tr>
</table>
