<?
if ($modificar) {
 if ($id_fajapallet)  
  foreach ($id_fajapallet as $key)
         {
		  $sql="update fajapallet set id_bodegas=$id_bodegas, id_estado_pallet=$id_estado_pallet where id_fajapallet = $key";
		//  echo "SQL $sql<br>";
		  $res=mysql_query($sql);
		 
         }
   }
$sql="
SELECT fp.id_fajapallet,fp.id_bodegas, fp.fpallet, fp.glosa, count( f.id_faja ) AS cfajas, fp.id_estado_pallet
FROM fajapallet AS fp, fajas AS f
WHERE fp.id_fajapallet = f.id_fajapallet
AND fp.id_bodegas = $id_b
AND fp.id_estado_pallet =1
GROUP BY fp.id_fajapallet
";
$rest=mysql_query($sql);
//echo "SQL $sql";
$cuantos=mysql_num_rows($rest);

	   $estado_pallet=crea_select($link,1,"id_estado_pallet","estado_pallet","estado_pallet","Estado Pallet");
	   $bodega=crea_select($link,$id_b,"id_bodegas","bodegas","bodegas","Bodega");
?>
<form name="form1" method="post" action="">
  <table width="100%" border="0">
    <tr>
      <td width="7%">&nbsp;</td>
      <td width="11%" nowrap>N&ordm; Pallet </td>
      <td width="31%">Fecha Pallet </td>
      <td width="39%">Glosa</td>
      <td width="12%">Cant Fajas </td>
    </tr>
	<? if ($cuantos) {
	   while ($r=mysql_fetch_array($rest)) { 
	   $fpallet=format_fecha($r[fpallet]);

	?>
    <tr>
      <td><label>
        <input name="id_fajapallet[]" type="checkbox" id="id_fajapallet[]" value="<?echo $r[id_fajapallet];?>">
      </label></td>
      <td><?echo $r[id_fajapallet]?></td>
      <td><?echo $fpallet?></td>
      <td><?echo $r[glosa]?></td>
      <td><?echo $r[cfajas]?></td>
    </tr>
		<?
	 }
		?>
    <tr>
      <td>&nbsp;</td>
      <td><input name="id_b" type="hidden" id="id_bodegas" value="<?echo $id_b?>">
      <input name="bo" type="hidden" id="bodegas" value="<?echo $bo?>"></td>
      <td colspan="2">Estado : <?echo $estado_pallet;?><br>Bodega : <?echo $bodega?></td>
      <td><label>
        <input name="modificar" type="submit" id="modificar" value="Modificar Seleccionados">
      </label></td>
    </tr>
  </table>
  <? } ?>
</form>
