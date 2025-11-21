<?

if ($modificar_x and $id_estado_folio) {
 if ($id_etiquetados_folios)  
  foreach ($id_etiquetados_folios as $key)
 {
  $sql="update etiquetados_folios set id_estado_folio=$id_estado_folio where id_etiquetados_folios = $key";
  $res=mysql_query($sql);
 }
}

$sql="SELECT * FROM etiquetados_folios AS etiq, producto AS pro, estado_folio AS esf where etiq.id_etiquetados_folios = etiq.id_etiquetados_folios and etiq.id_estado_folio = 1 and etiq.id_producto = pro.id_producto and etiq.id_estado_folio = esf.id_estado_folio";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

?>
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
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="700" height="165" border="0" align="center">
  <tr>
    <td width="626" height="27" valign="top"><span class="titulo">Etiquetas Folios Listar </span></td>
    <td width="32" valign="middle" class="cajas"><a href="?modulo=ejemplo_etiquetas_folios.php">Volver</a></td>
  </tr>
  <tr>
    <td height="5" valign="top">&nbsp;</td>
    <td width="32" valign="top" class="cajas">&nbsp;</td>
  </tr>
  <tr>
    <td height="7" valign="top"><span class="titulo"><? echo " Cantidad de Folios Emitidos $cuantos";?></span></td>
    <td valign="top" class="cajas"><div align="right"><span class="titulo"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></span></div></td>
  </tr>
  <tr>
    <td height="86" colspan="2" valign="top"><table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="28" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;</td>
        <td width="76" bgcolor="#CCCCCC" class="titulo">N&ordm; Folio</td>
        <td width="232" height="14" bgcolor="#CCCCCC" class="titulo">Producto</td>
        <td width="90" bgcolor="#CCCCCC" class="titulo">F. Elaboraci&oacute;n </td>
        <td width="75" bgcolor="#CCCCCC" class="titulo">Est. Material </td>
        <td width="84" bgcolor="#CCCCCC" class="titulo">Procedencia</td>
        <td width="99" bgcolor="#CCCCCC" class="titulo">
		<select name="id_estado_folio" class="cajas">
          <option value="0">Estado</option>
          <option value="2">Bodega</option>
          </select> </td>
      </tr>
      <?
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$i++;
	?>
      <tr>
        <td height="20" nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas"><? echo $i?></td>
        <td height="20" nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas"><a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $row[id_etiquetados_folios]?>"><?echo $row[id_etiquetados_folios]?></a></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $row[id_etiquetados_folios]?>"><? echo "$row[producto]";?></a></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $f_elaboracion ?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><a href="?modulo=ejemplo_etiquetas_folios.php&amp;id_etf2=<?echo $row[id_etiquetados_folios]?>">
          <?
		echo $row[estado_folio];
		
		?>
        </a></div></td>
        <td bgcolor="<? echo $color?>" class="cajas"><div align="center">
          <? 
		  if($row[id_procedencia] == 'I')
		  {
          echo "Importado";
          }
		  if($row[id_procedencia] == 'N')
		  {
          echo "Nacional";
		  }
		 ?>
        </div></td>
        <td bgcolor="<? echo $color?>" class="cajas">
          <div align="left"><input name="id_etiquetados_folios[]" type="checkbox" class="cajas" id="id_etiquetados_folios[]" value="<?echo $row[id_etiquetados_folios];?>" /><? echo $id_etiquetados_folios?>
            </div></td>
      </tr>
      <? }?>
    </table> 
    <a href="javascript: document.form1.submit();">
	    <label></label>
        </a>
		</center>
		<div align="center"><a href="javascript: document.form1.submit();">
		  <input type="image" name="modificar" src="jpg/modificar.jpg" />
		</a></div></td>
  </tr>
</table>
</form>