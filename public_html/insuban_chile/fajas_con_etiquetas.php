<?
ini_set('memory_limit', '-1');

$productos=crea_producto_Sin_onChange($link,$id_producto);
$destinos = crea_destinos($link,$id_destinos);

if ($buscar)
  {
  if ($lote1)
   $ext.=" and f.loten >= $lote1 ";
  if ($lote2)
   $ext.=" and f.loten <= $lote2 ";
  
  if ($faja1)
   $ext.=" and f.id_faja >= $faja1 ";
  if ($faja2)
   $ext.=" and f.id_faja <= $faja2 ";
   
  
  if ($emision1)
   $ext.=" and f.femision >= '$emision1' ";
  
    if ($emision2)
   $ext.=" and f.femision <= '$emision2' ";
   
    if ($id_producto)
   $ext.=" and f.id_producto >= '$id_producto' ";
   
    if ($id_destinos)
   $ext.=" and f.id_destino >= '$id_destinos' ";
   
$sql="select * from fajas as f, producto as p 
      where f.id_producto = p.id_producto and f.estado='$estado' $ext";


$r=mysql_query($sql);
$cuantos=mysql_num_rows($r);
//echo "SQL $cuantos -> $sql<p>";
  }
  
?>
<blockquote>
  <form action="?modulo=fajas_con_etiquetas.php" method="post">
    <table width="642" border="0">
      <tr>
        <td colspan="7">Estado 
          <label>
          <select name="estado" id="estado">
            <option value="E" selected="selected">Emitidas</option>
            <option value="A">Anulada</option>
            <option value="D">Despachada</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td width="76">Lote desde 
          <label></label></td>
        <td width="87"><input name="lote1" type="text" id="lote1" value="1" size="5" /></td>
        <td width="75">Faja desde </td>
        <td width="80"><input name="faja1" type="text" id="faja1" value="1" size="5" /></td>
        <td width="87">Emisi&oacute;n desde </td>
        <td width="89"><input name="emision1" type="text" id="emision1" value="2000-01-01" size="10" maxlength="10" /></td>
        <td width="118"><label></label></td>
      </tr>
      <tr>
        <td>Lote hasta          </td>
        <td><input name="lote2" type="text" id="lote2" value="999999" size="5" /></td>
        <td>Faja hasta </td>
        <td><input name="faja2" type="text" id="faja2" value="99999" size="5" /></td>
        <td>Emisi&oacute;n hasta </td>
        <td><input name="emision2" type="text" id="emision2" value="2050-12-31" size="10" maxlength="10" /></td>
        <td><div align="center">
          <input name="buscar" type="submit" id="buscar" value="Buscar" />
        </div></td>
      </tr>
      <tr>
        <td colspan="4">Producto : <?echo $productos?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">Destino : <?echo $destinos?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
  <? if ($buscar and $cuantos) { ?>
  <table width="509" border="0">
    <tr>
      <td width="19">&nbsp;</td>
      <td width="27">Faja</td>
      <td width="38">Lote</td>
      <td width="104">Producto</td>
      <td width="76">E.Emisi&oacute;n</td>
      <td width="97">F.Vencimiento</td>
      <td width="42">Neto</td>
      <td width="38">Tara</td>
      <td width="30">Est</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <? while ($ro=mysql_fetch_array($r))  { ?>
    <tr>
      <td nowrap="nowrap"><label></label></td>
      <td nowrap="nowrap"><?echo $ro[id_faja]?></td>
      <td nowrap="nowrap"><?echo $ro[loten]?></td>
      <td nowrap="nowrap"><?echo $ro[nombre]?></td>
      <td nowrap="nowrap"><?echo $ro[femision]?></td>
      <td nowrap="nowrap"><?echo $ro[fvencimiento]?></td>
      <td nowrap="nowrap"><?echo $ro[neto]?></td>
      <td nowrap="nowrap"><?echo $ro[tara]?></td>
      <td nowrap="nowrap"><?echo $ro[estado]?></td>
    </tr>
    <?  } ?>
  </table>
<? } ?>
</blockquote>
