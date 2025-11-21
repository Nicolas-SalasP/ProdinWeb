<?
require "../sconre.php"; 

$sql="SELECT * FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um,  caract_producto AS carpro, caract_envases AS carenv, operarios AS o, origenes AS orig, estado_folio AS e where  ef.id_etiquetados_folios=ef.id_etiquetados_folios and ef.id_producto = p.id_producto and ef.id_calibre = c.id_calibre  and ef.id_medidas_productos = mpro.id_medidas_productos  and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 and ef.id_origen = orig.id_origen and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio and ef.id_estado_folio = 2 and ef.id_procedencia = 'N' and ef.ocupado = 0 order by ef.id_etiquetados_folios, c.condicion_cod_barra, c.calibre asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

if($asignarpt){
	
	foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
     
	if ($dat[0] == 'id_etiquetados_folios')
   {
	$id=$dat[1];
   	$id_etiquetados_folioslis=$_POST["id_etiquetados_folios-$id"];  
	
	
	$sqlupdate="UPDATE etiquetados_folios  set id_c_es_so = '$id_c_es_so', ocupado = 1, id_usuario = '$id_insuban' where id_etiquetados_folios  = $id_etiquetados_folioslis";
 	$resultupdate=mysql_query($sqlupdate);   
		
	$sql_impk="insert cambio_estado_detalle(id_c_es_so,id_ce,foliosmpfsp,id_procedencia) values ('$id_c_es_so','$id_ce','$id_etiquetados_folioslis','N')";
    $result_smpk=mysql_query($sql_impk,$link);
	//echo "sql_impk $sql_impk<br>";
	
	
	}
}

?>
<script languaje="javascript">

window.opener.document.location.replace('<? echo $url?>sistema.php?modulo=solicitudcdetalle.php&id_c_es_so=<? echo $id_c_es_so?>&id_ce=<? echo $id_ce?>&tic=<? echo $tic?>');
</script>
<script language="javascript">
window.close();
</script>
<? } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel="stylesheet" href="../images/Underground.css" type="text/css" />			
<title>Insuban</title>
<script language="JavaScript"> 
function Abrir_ventana_nueva(pagina) { 
var opciones="toolbar=no,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=500, top=200, left=220"; 
window.open(pagina,"",opciones); 
} 
</script>
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


</head>
<body>

<div id="maincenter">
<form name="form1" method="post" action="">
<h1>stock de PRODUCTO TERMINADO</h1>
<table width="100%" border="0">
 <tr>
  <td width="20" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="12" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantos?></strong></td>
 </tr>
  <tr>
    <td width="20" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="20" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;COD</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;UNID/MED</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;MEDIDAS</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/P</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/E</strong></td>
    <td width="15" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;OPERADOR</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><center><a href="javascript:seleccionar_todo()"><img src="../codphp/jpgnew/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="../codphp/jpgnew/ninguno.jpg" width="13" height="13" border="0"/></a></center></td>
  </tr>
        <?

    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$id_cruce_tablas=$row[id_cruce_tablas];
	$producto=$row[producto];
	$calibre=$row[calibre];
	$unidad_medida=$row[unidad_medida];
	$medidas_productos=$row[medidas_productos];
	$caract_producto=$row[caract_producto];
	$caract_envases=$row[caract_envases];
	$contenido_unidades=$row[contenido_unidades];
	$origen=$row[origen];
	$estado_folio=$row[estado_folio];
	
  ?>
  <tr>
    <td height="19" align="center" bgcolor="<? echo $color?>"><strong><? echo $i?></strong></td>
    <td bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=pt_n.php&amp;id_etiquetados_folios=<? echo $id_etiquetados_folios?>&amp;pt=<? echo "N";?>">PT<? echo $id_etiquetados_folios?></a></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $id_cruce_tablas?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $producto ?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $calibre ?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $unidad_medida ?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $medidas_productos ?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $caract_producto ?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $caract_envases ?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $contenido_unidades ?></td>
    <td bgcolor="<? echo $color?>"><? 
	$nom = strtoupper($row[nombreop]);
	$apell = strtoupper($row[apellido]);
	echo $nom?> <? echo $apell ?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? $est = strtoupper($row[estado_folio]); echo $est ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <input type="checkbox" name="id_etiquetados_folios-<? echo $id_etiquetados_folios?>" id="id_etiquetados_folios" value="<? echo $id_etiquetados_folios?>" />
    </center></td>
    
  </tr>
  <? }?>
  <tr>
    <td colspan="13" align="right">
     
      <input type="submit" name="asignarpt" id="asignarpt" value="Asignar PT" />
     
      </td>
  </tr>
  <tr>
    <td colspan="13" align="right">&nbsp;</td>
  </tr>
</table><br>
</form>
</div>
</body>
</html>
