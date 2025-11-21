<?

$sql_xx="SELECT * FROM paking where id_paking = id_paking order by folio_piking desc LIMIT 0,1";
$result_xx=mysql_query($sql_xx);
$ultimo=mysql_fetch_array($result_xx);
$idxx=$ultimo[id_paking] + 1;

//echo "id $idxx";

$sql_id="SELECT * FROM paking where id_paking = id_paking order by folio_piking desc LIMIT 0,1";
$result_id=mysql_query($sql_id);


if ($r=mysql_fetch_array($result_id))
{ 

$cuantosfo=$r[folio_piking]; 
$id=$cuantosfo + 1;

}

$folio_pinking2=$cuantosfo+1;

if ($grabar_x and $id_estado_folio_cambio != 0) {
 if ($id_etiquetados_folios)  
  foreach ($id_etiquetados_folios as $key)
 {
 
  $sqlsulta="SELECT * FROM paking WHERE id_etiquetados_folios = $key";
  $result_consulta=mysql_query($sqlsulta);
  $cuantos_consulta=mysql_num_rows($result_consulta);
 
     if(!$cuantos_consulta){
	 
   $fecha_ingreso_paking  =date("Y-m-d");
   
  // echo "folio_piking $folio_piking - id_paking_relacion $id_paking_relacion - id_etiquetados_folios $id_etiquetados_folios - fecha_ingreso_paking $fecha_ingreso_paking ";
	$sql="insert into paking (folio_piking,id_paking_relacion,id_etiquetados_folios,fecha_ingreso_paking) values ($folio_pinking2,$idxx,$key,'$fecha_ingreso_paking')";
	//echo "sql $sql<br>";
	$res=mysql_query($sql);
	
    $sq_up="update etiquetados_folios set id_estado_folio = '3' where id_estado_folio != 3 and id_etiquetados_folios=$key";
	$rest_up=mysql_query($sq_up);
	//echo "sql2 $sq_up<br>";
	
	}
 }
}


if($buscar){
$sql="SELECT * FROM etiquetados_folios AS etiq, producto AS pro, estado_folio AS esf,calibre AS c, unidad_medida AS um, medidas_productos AS mp where etiq.id_etiquetados_folios = etiq.id_etiquetados_folios and etiq.id_estado_folio = 2 and etiq.id_estado_folio = esf.id_estado_folio and etiq.id_producto = pro.id_producto and etiq.ano between '$entreano1' and '$entreano2' and  etiq.id_calibre = c.id_calibre and etiq.id_unidad_medida = um.id_unidad_medida and etiq.id_medidas_productos = mp.id_medidas_productos and etiq.id_pedidos = 0 and etiq.id_c_es_so = 0 order by etiq.id_etiquetados_folios desc";
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
.titulo_grande {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; }
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="798" height="206" border="0" align="center">
  <tr>
    <td width="774" height="14" valign="middle" bgcolor="#CCCCCC"><span class="titulo">N&ordm; de Picking</span><span class="titulo_grande"> <? echo $folio_pinking2=$cuantosfo+1?></span></td>
    <td width="32" valign="middle" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=ejemplo_etiquetas_folios.php"></a><a href="?modulo=capturas_folios.php">Volver</a></td>
  </tr>
  <tr>
    <td height="14" valign="middle"><? 
			        if(!$entreano1){
					$entreano1=$fhoy=date("Y");
					$entreano1=$entreano1-1;
					}
					if(!$entreano2){
					$entreano2=$fhoy=date("Y");
					}
					
				?>
      <span class="titulo">A&ntilde;o (Entre el 2009 - 2010)</span>      <span class="cajas">
      <input name="entreano1" type="text" class="cajas" id="entreano1" value="<? echo $entreano1 ?>" size="4" maxlength="4" />
      <input name="entreano2" type="text" class="cajas" id="entreano2" value="<? echo $entreano2 ?>" size="4" maxlength="4" />
      <input name="buscar" type="submit" class="cajas" value="Buscar" />
                  </span></td>
    <td width="32" valign="middle" class="cajas">&nbsp;</td>
  </tr>
  <tr>
    <td height="32" valign="top" class="titulo_grande">&nbsp;</td>
    <td width="32" valign="top" class="cajas">&nbsp;</td>
  </tr>
  <tr>
    <td height="7" valign="top"><span class="titulo"><? if($buscar){?><? echo " Cantidad Folios en Bodega $cuantos";?><? }?></span></td>
    <td valign="top" class="cajas"><? if($buscar){?>
	
	<div align="right"><span class="titulo"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></span></div><? }?></td>
  </tr>
  <tr>
    <td height="86" colspan="2" valign="top"><? if($buscar){?><table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
	
      <tr>
        <td width="51" height="14" nowrap bgcolor="#CCCCCC" class="titulo">N&ordm; Folio </td>
        <td width="171" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
        <td width="69" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Calibre</td>
        <td height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Unidad medida </td>
        <td height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Medida</td>
        <td width="83" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Elaboraci&oacute;n </td>
        <td width="74" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Est. Material </td>
        <td width="70" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Procedencia</td>
        <td width="122" bgcolor="#CCCCCC" class="titulo">
		  <div align="center">
		    <select name="id_estado_folio_cambio" class="cajas">
		      <option value="0">Seleccione Estado</option>
		      <option value="3">Picking</option>
		    </select>
          </div></td>
      </tr>
      <? 
	


	if($cuantos){
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$i++;
	?>
      <tr>
        <td bgcolor="<? echo $color?>" height="20" nowrap="nowrap" class="cajas">
		  <div align="center"><a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $row[id_etiquetados_folios]?>"><?echo $row[id_etiquetados_folios]?></a></div></td>
        <td bgcolor="<? echo $color?>" class="cajas"><a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $row[id_etiquetados_folios]?>">
		<?
		echo $row[producto];
		?>
		</a><? //echo $row[id_producto]?></td>
        <td bgcolor="<? echo $color?>" class="cajas"><? echo $row[calibre]?></td>
        <td bgcolor="<? echo $color?>" width="91" class="cajas"><? echo $row[unidad_medida]?></td>
        <td bgcolor="<? echo $color?>" width="59" class="cajas"><? echo $row[medidas_productos]?></td>
        <td bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $f_elaboracion ?></div></td>
        <td bgcolor="<? echo $color?>" class="cajas"><div align="center"><a href="?modulo=ejemplo_etiquetas_folios.php&amp;id_etf2=<?echo $row[id_etiquetados_folios]?>"><?
		echo $row[estado_folio];
		
		?>
        </a></div></td>
        <td bgcolor="<? echo $color?>" class="cajas"><div align="center">
          <? 
		  //echo $row[id_procedencia];
		  
		  if($row[id_procedencia] == 'I'){
          echo "Importado";
         }
		  if($row[id_procedencia] == 'N'){
         echo "Nacional";
		 }
		 ?>
        </div></td>
        <td bgcolor="<? echo $color?>" class="cajas">
		<div align="center">
		<? if(!$row[id_pedidos]) {?>
        <input name="id_etiquetados_folios[]" type="checkbox" class="cajas" id="id_etiquetados_folios[]" value="<?echo $row[id_etiquetados_folios];?>" /><? echo $id_etiquetados_folios?>
		<? }else{?>
		<? echo "<b> Pedido: </b> $row[id_pedidos]";?>
		<? }?>
        </div></td>
      </tr>
      <? }
	  
	  }//fin if
	  
	  ?>
    </table>
	<? if($cuantos){?>
	  <a href="javascript: document.form1.submit();">
   <label>
   <? if($permiso36 == 1){?>
   <div align="center">
     <input type="image" name="grabar" src="jpg/asignar_folio_picking.jpg" />
     </div>
	 <? }?>
   </label>
   </a></div>
	<? }?>	  <? }?></td>
  </tr>
</table>
</form>