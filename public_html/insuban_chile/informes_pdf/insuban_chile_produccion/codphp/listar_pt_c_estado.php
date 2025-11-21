<?
require "../sconre.php"; 


$sqlpt="SELECT ef.id_etiquetados_folios AS id_etiquetados_folios, p.producto AS producto, c.calibre AS calibre, um.unidad_medida AS unidad_medida, mpro.medidas_productos AS medidas_productos, carpro.caract_producto AS caract_producto, carenv.caract_envases AS caract_envases, ef.contenido_unidades AS contenido_unidades, o.nombreop AS nombreop, o.apellido AS apellido, e.estado_folio AS estado_folio, ef.id_cruce_tablas AS id_cruce_tablas FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, operarios AS o, origenes AS orig, estado_folio AS e where ef.id_producto = p.id_producto and ef.id_calibre = c.id_calibre and ef.id_medidas_productos = mpro.id_medidas_productos and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 and ef.id_origen = orig.id_origen and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio   ";

//if($id_producto){ $sqlpt.= " and p.id_producto = '$id_producto' "; }

$sqlpt.= "  and ef.id_procedencia = 'N' and ef.id_c_es_so = $id_c_es_so order by ef.id_etiquetados_folios asc ";

$resultpt=mysql_query($sqlpt);
$cuantospt=mysql_num_rows($resultpt);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel="stylesheet" href="../images/Underground.css" type="text/css" />			
<title>Insuban</title>
</head>
<body>

<div id="maincenter">
<form name="form1" method="post" action="">
<h1>Folios de PT generados por el cambio de estado de MPS</h1>
<table width="100%" border="0">
  <tr>
    <? if($cuantospt){?>
    <td width="25" height="9" bgcolor="#FF9933"><center>
      </center></td>
    <td colspan="11" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantospt?></strong></td>
  </tr>
  <tr>
    <td width="25" height="9" nowrap="nowrap" bgcolor="#FF9933"><center>
      <strong>&nbsp;N&ordm;</strong>
    </center></td>
    <td width="76" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO PT</strong></td>
    <td width="39" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;COD</strong></td>
    <td width="157" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="101" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="80" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;U/MEDIDA</strong></td>
    <td width="80" nowrap="nowrap" bgcolor="#FF9933"><strong>MEDIDAS</strong></td>
    <td width="80" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/PRO</strong></td>
    <td width="80" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/ENV</strong></td>
    <td width="80" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="98" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;OPERADOR</strong></td>
    <td width="68" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    </tr>
 <?
	if($cuantospt){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($rowpt=mysql_fetch_array($resultpt))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_etiquetados_folios=$rowpt[id_etiquetados_folios];
	$estado_folio=$rowpt[estado_folio];
	$id_cruce_tablas=$rowpt[id_cruce_tablas];
	$id_estdis=$rowpt[id_estdis];
	$producto=$rowpt[producto];
	$calibre=$rowpt[calibre];
	$unidad_medida=$rowpt[unidad_medida];
	$medidas_productos=$rowpt[medidas_productos];
	$caract_producto=$rowpt[caract_producto];
	$caract_envases=$rowpt[caract_envases];
	$contenido_unidadespt=$rowpt[contenido_unidades];
	$contenidototalpt+=$contenido_unidadespt;
	$nom = strtoupper($rowpt[nombreop]);
	$apell = strtoupper($rowpt[apellido]);
	
	
  ?>
  <tr>
    <td height="9" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;PT<? echo $id_etiquetados_folios?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $id_cruce_tablas?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $producto?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $calibre?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $unidad_medida?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $medidas_productos?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $caract_producto?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $caract_envases?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $contenido_unidadespt?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo "$nom $apell";?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $estado_folio?></td>
    <? 	}
	}
	?>
  </tr>
  
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="2" align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
   <? }?>
  </tr>
</table>
</form>
</div>
</body>
</html>
