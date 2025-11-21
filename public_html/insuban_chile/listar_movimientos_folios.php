<?
if(!$entreano1){
  $entreano1=$fhoy=date("Y");
  $entreano1=$entreano1-1;
}
if(!$entreano2){
  $entreano2=$fhoy=date("Y");
}



		if(!$buscar){
			

		
		$sql="SELECT * FROM etiquetados_folios AS etiq, producto AS pro, estado_folio AS esf, operarios AS ope where etiq.id_operarios = ope.id_operarios and etiq.id_etiquetados_folios = etiq.id_etiquetados_folios and etiq.id_estado_folio = $id_estado_folio and etiq.id_estado_folio = esf.id_estado_folio and etiq.id_producto != 0 and etiq.id_producto = pro.id_producto and etiq.ano between '$entreano1' and '$entreano2' order by etiq.id_etiquetados_folios, etiq.id_producto desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}



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
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
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
<table width="943" height="106" border="0" align="center">
  <tr>
    <td height="1" colspan="3" valign="top" bgcolor="#CCCCCC" class="titulo">&nbsp;Movimientos Folios</td>
    </tr>
  <tr>
    <td width="272" height="2" valign="top">&nbsp;</td>
    <td width="422" valign="top"><span class="cajas">
<?      if(!$id_estado_folio){
		$estado_folio= crea_estado_folio_selectdos($link,1);
		echo $estado_folio;
		}else{
		$estado_folio= crea_estado_folio_selectdos($link,$id_estado_folio);
		echo $estado_folio;	
		}
	
?>

      <input name="entreano1" type="text" class="cajas" id="entreano1" value="<? echo $entreano1 ?>" size="4" maxlength="4" />
      <input name="entreano2" type="text" class="cajas" id="entreano2" value="<? echo $entreano2 ?>" size="4" maxlength="4" />
      <input name="buscar" type="submit" class="cajas" value="Buscar" />
    </span></td>
    <td height="2" valign="top"><span class="titulo">inicio</span>
      <input name="inicio" type="text" class="cajas"   id="inicio"  value="<?echo $inicio?>" size="10" maxlength="10" />
      <a href="javascript:show_Calendario('form1.inicio');" class="cajas"  >Ver </a></td>
  </tr>
  <tr>
    <td height="7" colspan="2" valign="top"><span class="numero"><? if($cuantos){?><? echo " Cantidad $cuantos";?><? }?></span></td>
    <td width="235" valign="top" class="cajas">
	<? if($cuantos){?>
	<div align="right"><span class="titulo"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></span></div><? }?></td>
  </tr>
  <tr>
    <td height="86" colspan="3" valign="top">

	<table width="859" border="1" align="center" cellpadding="0" cellspacing="0">
	
      <tr>
        <td width="54" height="14" nowrap bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm; Folio </td>
        <td width="20" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;ID</td>
        <td width="97" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto</td>
        <td width="60" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Contenido</td>
        <td width="86" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;F/Elaboraci&oacute;n </td>
        <td width="77" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Est/Material </td>
        <td width="73" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Procedencia</td>
        <td width="86" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;&nbsp;Ponderado</td>
          <? if($permiso34 == 1 and $nivel_usua == 1){?>
          <td width="84" bgcolor="#CCCCCC" class="titulo">Inicio</td>
          <td width="79" bgcolor="#CCCCCC" class="titulo">Fin</td>
          <? }?>
        <td width="119" bgcolor="#CCCCCC" class="titulo">
		  <div align="center">
	 <? if($id_estado_folio == 2){?>
		    <select name="id_estado_folio_cambio" class="cajas">
		      <option value="0">Estado</option>
		      <option value="1">Emitido</option>
		       <option value="2">Bodega</option>
		       <option value="5">Anulado</option>
			    <option value="6">Reprocesado</option>
                <option value="8">Bodega Traspaso</option>
		      </select>
           <? }else{?>
           	    <select name="id_estado_folio_cambio" class="cajas">
		      <option value="0">Estado</option>
		      <option value="1">Emitido</option>
		       <option value="2">Bodega</option>
		       <option value="5">Anulado</option>
			    <option value="6">Reprocesado</option>
             </select>
           
           <? }?>
          </div></td>
      </tr>
      <? 
	

	
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
		$inicio=format_fecha2($row[fech_generada_inicio]);
			$fin=format_fecha2($row[fech_generada_fin]);
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$id_pedidos=$row[id_pedidos];
	$id_estado_folio=$row[id_estado_folio];
	$i++;
	?>
      <tr>
        <td bgcolor="<? echo $color?>" height="20" nowrap="nowrap" class="cajas">
		  <div align="center"><a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $row[id_etiquetados_folios]?>"><?echo $row[id_etiquetados_folios]?></a></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[id_cruce_tablas];?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $row[id_etiquetados_folios]?>"><? echo $row[producto];?></a>
          <? //echo $row[id_cruce_tablas]?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[contenido_unidades]?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $f_elaboracion ?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><a href="?modulo=ejemplo_etiquetas_folios.php&amp;id_etf2=<?echo $row[id_etiquetados_folios]?>"><?
		echo $row[estado_folio];
		
		?>
        </a></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">
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
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[total_ponderado ];?></td>
        <? if($permiso34 == 1 and $nivel_usua == 1){?> 
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $inicio ?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $fin ?></div></td>
        <? }?>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">
		  <div align="center">&nbsp;
<? 			  if($id_pedidos and $id_estado_folio == 2)
		      {
              echo "Ped: $id_pedidos";
		      }else{
		      echo $id_etiquetados_folios;
?>
		   <input name="id_etiquetados_folios[]" type="checkbox" class="cajas" id="id_etiquetados_folios[]" value="<?echo $row[id_etiquetados_folios];?>" />
<?           } //if($id_pedidos and $id_estado_folio == 2)
?>
		  </div></td>
      </tr>
<? 			
  		}//fin if
?>
    </table>

	<? if($cuantos){?>
	<a href="javascript: document.form1.submit();">
	    <label></label>
        </a>
		</center><? if($permiso35 == 1){?>
		<div align="center"><a href="javascript: document.form1.submit();">
		  <input type="image" name="modificar" src="jpg/modificar.jpg" />
		</a></div><? }?>
	<? }?>	  </td>
  </tr>
</table>
</form>