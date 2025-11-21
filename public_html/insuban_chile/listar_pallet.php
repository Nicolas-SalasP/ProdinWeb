<?
$sql="SELECT p.pallet AS pallet, count( DISTINCT ef.id_etiquetados_folios) AS cf, p.fecha_ingreso_pallet AS fecha_ingreso_pallet,  p.fecha_cierre_pallet  AS fecha_cierre_pallet, ef.id_cruce_tablas AS id_cruce_tablas, prod.producto AS producto, c.calibre AS calibre, mp.medidas_productos AS medidas_productos, un.unidad_medida AS unidad_medida, carac.caract_producto AS caract_producto  from pallet AS p, etiquetados_folios AS ef, producto AS prod, calibre AS c, medidas_productos AS mp, unidad_medida  AS un, caract_producto AS carac  where  p.id_etiquetados_folios = ef.id_etiquetados_folios and ef.id_producto = prod.id_producto and ef.id_calibre=c.id_calibre and ef.id_medidas_productos = mp.id_medidas_productos and ef.id_unidad_medida = un.id_unidad_medida and ef.id_caract_producto = carac.id_caract_producto group by p.pallet order by p.pallet desc";
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

<table width="816" border="0" align="center">
  <tr>
    <td width="550" height="30" class="titulo"> Listar Pallet</td>
    <td width="256" align="center" bgcolor="#CCCCCC" class="titulo">
    <? if($permiso56 == 1){?>
    <a href="?modulo=capturas_folios_pallet.php">INGRESAR NUEVO PALLET</a>
    <? }else{ ?>
    INGRESAR NUEVO PALLET
    <? }?>
    </td>
  </tr>
  <tr>
    <td colspan="2">
	<? if($cuantos){?>
	<table width="830" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td width="820">
            <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="9%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; Pallet </td>
                <td width="2%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Disponibles </td>
                <td width="4%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Cajas</td>
                <td width="18%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
                <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="left">Calibre</div></td>
                <td width="13%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="left">Unid/Med</div></td>
                <td width="14%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="left">Medida</div></td>
                <td width="15%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">C/P</td>
                <td width="13%" bgcolor="#CCCCCC" class="titulo">Fecha  </td>
              </tr>
              <? if ($cuantos) {
			        $i=$cuantos + 1;
					$color = "#000000";$i = 0;
	   				while ($r=mysql_fetch_array($rest)) { 
					$i--;
					$fecha_ingreso_pallet=format_fecha_sin_hora($r[fecha_ingreso_pallet]);
					$fecha_cierre_pallet2 = format_fecha_sin_hora($r[fecha_cierre_pallet]);
					
					$pallet=$r[pallet];
					$producto=$r[producto];
					$calibre=$r[calibre];
					$medidas_productos=$r[medidas_productos];
					$id_cruce_tablasok=$r[id_cruce_tablas];
					$unidad_medida=$r[unidad_medida];
					$caract_producto =$r[caract_producto];
					$pallet=$pallet;    
					$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#FFFF00";
				/*	$id_cruce_tablas_contar=strlen($id_cruce_tablasok);		   
					if($id_cruce_tablas_contar == 1) $idcod="00000$pallet";
					if($id_cruce_tablas_contar == 2) $idcod="0000$pallet";
					if($id_cruce_tablas_contar == 3) $idcod="000$pallet";
					if($id_cruce_tablas_contar == 4) $idcod="00$pallet";
					if($id_cruce_tablas_contar == 5) $idcod="0$pallet";
					if($id_cruce_tablas_contar == 6) $idcod="$pallet";
					$union=$id_cruce_tablasok.$idcod;*/
					
	          ?>
              <tr>
               <?
                 $sqlss="SELECT *  from etiquetados_folios AS ef, pallet AS pal where ef.id_etiquetados_folios = pal.id_etiquetados_folios and ef.id_estado_folio != 3 and ef.id_estado_folio != 4 and ef.id_estado_folio != 5 and ef.id_estado_folio != 6 and ef.id_estado_folio != 7 and ef.id_estado_folio != 8 and ef.id_estado_folio != 9 and ef.id_estado_folio != 10 and ef.pallet = $r[pallet] ";
$restss=mysql_query($sqlss);
$cuantosss=mysql_num_rows($restss);
				?>
                <td align="center" <? if($fecha_cierre_pallet2 == "00-00-0000"){?> bgcolor="FFFF00" <? } ?> class="cajas"><a href="?modulo=modificar_pallet.php&amp;pallet=<?echo $r[pallet]?>&id_cruce_tablasok=<? echo $id_cruce_tablasok?>"><?
          
 
  echo "$pallet";
 		
				?></a></td>
               
                <td align="center"  class="cajas" <? if($fecha_cierre_pallet2 == "00-00-0000"){?> bgcolor="FFFF00" <? } ?>>
                  
                  <?  if($cuantosss){	echo "SI"; }else{ echo "NO";}?>
                <?
                $sqlss="SELECT *  from etiquetados_folios AS ef, pallet AS pal where ef.id_etiquetados_folios = pal.id_etiquetados_folios and ef.id_estado_folio != 3 and ef.id_estado_folio != 4 and ef.id_estado_folio != 5 and ef.id_estado_folio != 6 and ef.id_estado_folio != 7 and ef.id_estado_folio != 8 and ef.id_estado_folio != 9 and ef.id_estado_folio != 10 and ef.pallet = $r[pallet] ";
$restss=mysql_query($sqlss);
$cuantosss=mysql_num_rows($restss);
				echo "  [$cuantosss]";
				?></td>
                <? 
				  $cf=$r[cf];
				 
					  
					  
					  ?>
                <td <? if($fecha_cierre_pallet2 == "00-00-0000"){?> bgcolor="FFFF00" <? } ?> class="cajas" >&nbsp;<a href="?modulo=modificar_pallet.php&amp;pallet=<?echo $r[pallet]?>&id_cruce_tablasok=<? echo $id_cruce_tablasok?>"><? echo $r[cf]?></a></td>
                <td class="cajas" <? if($fecha_cierre_pallet2 == "00-00-0000"){?> bgcolor="FFFF00" <? } ?>>&nbsp;<? echo $producto?></td>
                <td class="cajas" <? if($fecha_cierre_pallet2 == "00-00-0000"){?> bgcolor="FFFF00" <? } ?>>&nbsp;<? echo $calibre?></td>
                <td class="cajas" <? if($fecha_cierre_pallet2 == "00-00-0000"){?> bgcolor="FFFF00" <? } ?>>&nbsp;<? echo $medidas_productos?></td>
                <td class="cajas" <? if($fecha_cierre_pallet2 == "00-00-0000"){?> bgcolor="FFFF00" <? } ?>>&nbsp;<? echo $unidad_medida?></td>
                <td class="cajas" <? if($fecha_cierre_pallet2 == "00-00-0000"){?> bgcolor="FFFF00" <? } ?>>&nbsp;<? echo $caract_producto ?></td>
                <td class="cajas" <? if($fecha_cierre_pallet2 == "00-00-0000"){?> bgcolor="FFFF00" <? } ?>>&nbsp;<? echo $fecha_ingreso_pallet;?></td>
              </tr>
              <? } //while ($r=mysql_fetch_array($rest)) {  ?>
            </table>
            <? } //if ($cuantos) { ?>
            <table width="200" border="0">
              <tr>
                <td width="22" bgcolor="#FFFF00">&nbsp;</td>
                <td width="168">Pallet sin terminar</td>
              </tr>
          </table></td>
      </tr>
    </table>
	<? }?></td>
  </tr>
</table>
