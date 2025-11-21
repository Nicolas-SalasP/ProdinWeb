<?
$bodegas=crea_select($link,$id_bodegas,"id_bodegas","bodegas","bodegas","Bodega(todas)");
$estado_pallet=crea_select($link,$id_estado_pallet,"id_estado_pallet","estado_pallet" ,"estado_pallet","Estado");
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
<table width="606" border="0" align="center">
  <tr>
    <td width="600" height="30" class="titulo">Bodegas Stok </td>
  </tr>
  <tr>
    <td height="61"><table width="600" height="100%" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td height="164" valign="top">
            <? if (!$consultar)
   { 
   
   if ($id_bodegas != "")
    $ext = "and fp.id_bodegas = $id_bodegas ";
	
   $sql="
  SELECT b.id_bodegas, b.bodegas, count( DISTINCT fp.id_fajapallet ) AS cfp, count( f.id_faja ) AS cf, SUM(f.neto) AS net
FROM bodegas AS b, fajapallet AS fp, fajas AS f
WHERE b.id_bodegas = fp.id_bodegas and fp.id_estado_pallet=1 
AND fp.id_fajapallet = f.id_fajapallet  $ext
GROUP BY b.id_bodegas

";
$rest=mysql_query($sql);
$cuantos=mysql_num_rows($rest);

 if ($cuantos) {
?>
            <table width="595" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="24%" bgcolor="#CCCCCC" class="titulo">Bodegas</td>
                <td width="32%" bgcolor="#CCCCCC" class="titulo">Total Pallet</td>
                <td width="27%" bgcolor="#CCCCCC" class="titulo">Total Fajas </td>
                <td width="17%" bgcolor="#CCCCCC" class="titulo">Total Kilos </td>
              </tr>
              <? while ($r=mysql_fetch_array($rest)) { ?>
              <tr>
                <td class="cajas"><a href="?modulo=bodegas_ver_pallet.php&amp;id_b=<?echo $r[id_bodegas]?>&amp;bo=<?echo $r[bodegas]?>"><?echo $r[bodegas]?></a></td>
                <td class="cajas"><?echo $r[cfp]?></td>
                <td class="cajas"><?echo $r[cf]?></td>
                <td class="cajas"><?echo $r[net]?></td>
              </tr>
              <?  } ?>
            </table>
          <? }

} ?>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
