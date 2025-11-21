<?
if(!$entreano1){
  $entreano1=$fhoy=date("Y");
  $entreano1=$entreano1-1;
}
if(!$entreano2){
  $entreano2=$fhoy=date("Y");
}

if($id_estado_folio_cambio == 1){
	$femitido = date("Y-m-d"); 
}
if($id_estado_folio_cambio == 2){
	$fbodega  = date("Y-m-d"); 
}
if($id_estado_folio_cambio == 3){
	$fpicking   = date("Y-m-d"); 
}
if($id_estado_folio_cambio == 5){
	$fanulado    = date("Y-m-d"); 
}
if($id_estado_folio_cambio == 6){
	$freprocesado = date("Y-m-d"); 
}
if($id_estado_folio_cambio == 9){
	$frevision = date("Y-m-d"); 
}
if($id_estado_folio_cambio == 8){
	$fbodega_traspaso = date("Y-m-d"); 
}
if($id_estado_folio_cambio == 4){
	$fbodega_mpi = date("Y-m-d"); 
}




if ($modificar_x and $id_estado_folio_cambio != 0) {
 if ($id_etiquetados_folios)  
  foreach ($id_etiquetados_folios as $key)
 {
	 
	 
	 
  $sql="update etiquetados_folios set id_estado_folio=$id_estado_folio_cambio, fbodega='$fbodega', fpicking='$fpicking', fanulado='$fanulado', freprocesado='$freprocesado', frevision='$frevision', fbodega_traspaso='$fbodega_traspaso', fbodega_mpi='$fbodega_mpi'  where id_etiquetados_folios = $key";
// echo "SQL $sql<br>";
  $res=mysql_query($sql);

   if($id_estado_folio_cambio == 5 or $id_estado_folio_cambio == 6 or $id_estado_folio_cambio == 8 ){
    $sqlcorreo="select * from etiquetados_folios AS et, estado_folio AS es  where et.id_estado_folio = es.id_estado_folio and et.id_etiquetados_folios= '$key' ";
   $rescorreo=mysql_query($sqlcorreo);
   $cuantos_correo=mysql_num_rows($rescorreo);

if($cuantos_correo){
  if ($row_correo=mysql_fetch_array($rescorreo))
  { 
	  $id_etiquetados_folioscorre=$row_correo[id_etiquetados_folios];
	  $estado_foliocorreo=$row_correo[estado_folio];
   		
	  $email = "Administrador";	  
	  $nombresitio = "Informacion Sistema Prodin Web.cl";
	  $contacto = "pedro.velasquez@websystems.cl";
	  $administrador .= "Nº Folio: $id_etiquetados_folioscorre - $estado_foliocorreo \n ";
		
  }// while ($row_correo=mysql_fetch_array($rescorreo))
 
}//if($cuantos_correo){
  }//if($id_estado_folio_cambio != 0){
 } 
 mail("$contacto", "$nombresitio", $administrador, "From: $email");
}

		if(!$id_estado_folio or $buscar){
			
	if(!$id_estado_folio){	$id_estado_folio = 1;		}

		
		$sql="SELECT * FROM etiquetados_folios AS etiq, producto AS pro, estado_folio AS esf, operarios AS ope where etiq.id_operarios = ope.id_operarios and etiq.id_etiquetados_folios = etiq.id_etiquetados_folios and etiq.id_estado_folio = $id_estado_folio and etiq.id_estado_folio = esf.id_estado_folio and etiq.id_producto != 0 and etiq.id_producto = pro.id_producto and etiq.ano between '$entreano1' and '$entreano2' ";
		
if($id_estado_folio){ $sql.= " and etiq.id_estado_folio = '$id_estado_folio' ";}
if($id_producto){ $sql.= " and etiq.id_producto = '$id_producto'";}

$sql.= " order by etiq.id_etiquetados_folios, etiq.id_producto desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

//echo "sql $sql";

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
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="778" height="106" border="0" align="center">
  <tr>
    <td height="1" colspan="2" valign="top" bgcolor="#CCCCCC" class="titulo">&nbsp;Movimientos Folios</td>
    </tr>
  <tr>
    <td height="2" valign="top"><span class="cajas">
  <?      if(!$id_estado_folio){
		$estado_folio= crea_estado_folio_selectdos($link,1);
		echo $estado_folio;
		}else{
		$estado_folio= crea_estado_folio_selectdos($link,$id_estado_folio);
		echo $estado_folio;	
		}
		  
?>
  <?
if($id_estado_folio){
				  $producto = crea_producto_onChange_segunestado($link,$id_estado_folio,$id_producto);
				  echo $producto;
				  }
?>
      
      <input name="entreano1" type="text" class="cajas" id="entreano1" value="<? echo $entreano1 ?>" size="4" maxlength="4" />
      <input name="entreano2" type="text" class="cajas" id="entreano2" value="<? echo $entreano2 ?>" size="4" maxlength="4" />
      <input name="buscar" type="submit" class="cajas" value="Buscar" />
    </span></td>
    <td height="2" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="7" valign="top"><span class="numero"><? if($cuantos){?><? echo " Cantidad $cuantos";?><? }?></span></td>
    <td width="185" valign="top" class="cajas">
	<? if($cuantos ){?>
	<div align="right"><span class="titulo"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></span></div></td>
  </tr>
  <tr>
    <td height="86" colspan="2" valign="top">

	<table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
	
      <tr>
        <td width="57" height="14" nowrap bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm; Folio </td>
        <td width="20" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;ID</td>
        <td width="121" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto</td>
        <td width="60" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Contenido</td>
        <td width="86" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;F/Elaboraci&oacute;n </td>
        <td width="77" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Est/Material </td>
        <td width="73" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Procedencia</td>
        <td width="78" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;&nbsp;Responsable</td>
          <? if($permiso35 == 1 and $nivel_usua == 1){?><? }?>
        <td bgcolor="#CCCCCC" class="titulo">
         <? if($permiso35 == 1 and $nivel_usua == 1 and $id_estado_folio == 1){?>
          <select name="id_estado_folio_cambio" class="cajas">
		  <option value="2">Bodega</option>
          <option value="6">Reprocesado</option>
          <option value="5">Anulado</option>
          </select>
          <? }?>
          <? if($permiso35 == 1 and $nivel_usua == 1 and $id_estado_folio == 2){?>
          <select name="id_estado_folio_cambio" class="cajas">
		  <option value="8">Bodega Traspaso</option>
          <option value="1">Emitido</option>
          <option value="6">Reprocesado</option>
          <option value="5">Anulado</option>
          </select>
          <? }?>
           <? if($permiso35 == 1 and $nivel_usua == 1 and $id_estado_folio == 5){?>
          <select name="id_estado_folio_cambio" class="cajas">
		  <option value="2">Bodega</option>
          </select>
          <? }?>
           <? if($permiso35 == 1 and $nivel_usua == 1 and $id_estado_folio == 10){?>
          <select name="id_estado_folio_cambio" class="cajas">
		  <option value="2">Bodega</option>
          </select>
          <? }?>
            <? if($permiso35 == 1 and $nivel_usua == 1 and $id_estado_folio == 6){?>
          <select name="id_estado_folio_cambio" class="cajas">
		  <option value="2">Bodega</option>
          </select>
          <? }?>
          <? if($id_estado_folio == 1 and $nivel_usua == 2){?>
          <select name="id_estado_folio_cambio" class="cajas">
		  <option value="2">Bodega</option>
          </select>
          <? }?>
          <? if($id_estado_folio == 2 and $nivel_usua == 2){?>
          <select name="id_estado_folio_cambio" class="cajas">
		  <option value="8">Bodega Traspaso</option>
          <option value="1">Emitido</option>
          </select>
          <? }?>
        </td>
      </tr>
      
      <? 
	  
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$id_pedidos=$row[id_pedidos];
	$id_estado_folio=$row[id_estado_folio];
	$i++;
	?>
      <tr>
        <td bgcolor="<? echo $color?>" height="20" nowrap="NOWRAP" class="cajas">
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
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;
          <?
		$nom =strtoupper("$row[nombreop]"); # HOLA TíO
		$apel =strtoupper("echo $row[apellido]"); # HOLA TíO
		echo $nom?>
          <?echo $apel?></td>
        <? if($permiso35 == 1 and $nivel_usua == 1){?> <? }?>
        <td bgcolor="<? echo $color?>" class="cajas"><div align="center">&nbsp;<? if($id_pedidos and $id_estado_folio == 2){ echo "Ped: $id_pedidos";   }else{  echo $id_etiquetados_folios; ?><input name="id_etiquetados_folios[]" type="checkbox" class="cajas" id="id_etiquetados_folios[]" value="<?echo $row[id_etiquetados_folios];?>" /><? } //if($id_pedidos and $id_estado_folio == 2)S?></div></td>
      </tr><? }//fin if?>
    </table>
	<? if($cuantos){?>
	<a href="javascript: document.form1.submit();">
	    <label></label>
        </a>
		</center>
		<? if($permiso35 == 1 and $nivel_usua == 1 and ($id_estado_folio == 1 or $id_estado_folio == 2 or $id_estado_folio == 5 or $id_estado_folio == 6 or $id_estado_folio == 10)){ ?>
  <div align="center"><a href="javascript: document.form1.submit();"><input type="image" name="modificar" src="jpg/modificar.jpg" /></a></div>
		<? }?>
       
        <? if($permiso35 == 1 and $nivel_usua == 2 and ($id_estado_folio == 1 or $id_estado_folio == 2)){
	    ?>
  <div align="center"><a href="javascript: document.form1.submit();"><input type="image" name="modificar" src="jpg/modificar.jpg" /></a></div>
		<? }?>
       <? }?></td>
  </tr><? }?>
</table>
</form>