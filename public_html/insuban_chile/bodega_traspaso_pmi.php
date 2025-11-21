<?

$fhoy=date("Y");

/*if($id_estado_folio_cambio == 4){
	$fbodega = date("Y-m-d"); 
}*/

if ($modificar and $id_estado_folio_cambio and $id_etiquetados_folios) {
 	//echo "1111111111111111111111111";
 if ($id_estado_folio_cambio != 4)
 {
 $fbodega = date("Y-m-d"); 
  foreach ($id_etiquetados_folios as $key)
  {
  $sql="update etiquetados_folios set id_estado_folio=$id_estado_folio_cambio, fbodega='$fbodega'  where id_etiquetados_folios = $key";
 //echo "SQL $sql<br>";
  $res=mysql_query($sql);
  }
 }else{
	// echo "2222222222222222222222222222222";
  $fbodega_mpi  = date("Y-m-d"); 
  foreach ($id_etiquetados_folios as $key)
  {
  $sql="update etiquetados_folios set id_estado_folio=$id_estado_folio_cambio, fbodega_mpi='$fbodega_mpi' where id_etiquetados_folios = $key";
  $res=mysql_query($sql);
  $sql="SELECT * FROM etiquetados_folios where id_etiquetados_folios ='$key'";
  $result=mysql_query($sql);
  $cuantos=mysql_num_rows($result);
  
   if ($row=mysql_fetch_array($result))
   { 
	  $etiquetados_folios_id=$row[id_etiquetados_folios];
	  $cruce_tablas_id=$row[id_cruce_tablas];
	  $bidon_importado=$row[bidon_importado];
      $comprobante_num=$row[factura_importada];
	  
	  $id_producto=$row[id_producto];
	  $id_estado_material=$row[id_estado_folio];
	  $id_unidad_medida=$row[id_unidad_medida];
	  $fecha_elaboracion=$row[f_elaboracion];
	  $valor_unitario=$row[total_ponderado];
	
	  $id_origen=$row[id_origen];
	  $contenido=$row[contenido_unidades];
	  $id_procedencia=$row[id_procedencia];
	
   }// Fin while ($row=mysql_fetch_array($result))
   
  // echo " bidon_num $bidon_num, id_producto $id_producto, id_estado_material $id_estado_material, id_unidad_medida $id_unidad_medida, fecha_ingreso1 $fecha_ingreso1, comprobante_num $comprobante_num, id_origen $id_origen, contenido $contenido, id_procedencia $id_procedencia<br>";
   //*******************************************************************************************************************************
$fecha_ingreso1=date("Y-m-d");

    $sqlultimafecha="SELECT * FROM mat_prima_importada where id_mat_prima_importada=id_mat_prima_importada ORDER BY id_mat_prima_importada desc LIMIT 1";
$resulultimafecha=mysql_query($sqlultimafecha);
$cuantosultimafecha=mysql_num_rows($resulultimafecha);

 if ($rowultimafecha=mysql_fetch_array($resulultimafecha))
 { 
 $id_mat_prima_importada=$rowultimafecha[id_mat_prima_importada];
 $ultimoanorescatado=$rowultimafecha[ano];
 }
 
if($ultimoanorescatado == $fhoy){

   $largo=strlen($rowultimafecha[id_mat_prima_importada]);
  
  if($largo == 8){
      $folio_formateado=substr($id_mat_prima_importada,1,8);
   }
  
   if($largo == 9){
      $folio_formateado=substr($id_mat_prima_importada,1,9);
   }
 $id=2;
 $id_mat_prima_importada_siguiente=$id.$folio_formateado+1;

}else{

 $id_mat_prima_importada=$rowul[id_mat_prima_importada];
 $id_mat_prima_importada_siguiente=$id_mat_prima_importada - $id_mat_prima_importada;
 $id_mat_prima_importada_siguiente++;
 
 $id_mat_prima_importada_siguiente_contar=strlen($id_mat_prima_importada_siguiente);
 
 if($id_mat_prima_importada_siguiente_contar == 1) $id_mat_prima_importada_siguiente="00000$id_mat_prima_importada_siguiente";
 if($id_mat_prima_importada_siguiente_contar == 2) $id_mat_prima_importada_siguiente="0000$id_mat_prima_importada_siguiente";
 if($id_mat_prima_importada_siguiente_contar == 3) $id_mat_prima_importada_siguiente="000$id_mat_prima_importada_siguiente";
 if($id_mat_prima_importada_siguiente_contar == 4) $id_mat_prima_importada_siguiente="00$id_mat_prima_importada_siguiente";
 if($id_mat_prima_importada_siguiente_contar == 5) $id_mat_prima_importada_siguiente="0$id_mat_prima_importada_siguiente";
 if($id_mat_prima_importada_siguiente_contar == 6) $id_mat_prima_importada_siguiente="$id_mat_prima_importada_siguiente";
 $anook=substr($fhoy,2,4);
 $id=2;
 $id_mat_prima_importada_siguiente=$id.$anook.$id_mat_prima_importada_siguiente;
} //if($ultimoanorescatado == $fhoy){

$fech_generada_inicio =date("Y-m-d H:i:s");

 $sql_nuevo="insert into mat_prima_importada (id_mat_prima_importada,id_origen,ano,id_producto,id_estado_material,comprobante_num,etiquetados_folios_id,cruce_tablas_id,bidon_num,contenido,fecha_ingreso,fecha_elaboracion,fecha_salida,id_unidad_medida,fech_generada_inicio) values ($id_mat_prima_importada_siguiente,$id_origen,$fhoy,$id_producto,2,'$comprobante_num','$etiquetados_folios_id','$cruce_tablas_id','$bidon_importado','$contenido','$fecha_ingreso1','$fecha_elaboracion','$fecha_ingreso1','$id_unidad_medida','$fech_generada_inicio')";
 $result_nuevo=mysql_query($sql_nuevo,$link);
//echo "sql_nuevo $sql_nuevo<br>";

   //*******************************************************************************************************************************
   
   
  }//fin foreach ($id_etiquetados_folios as $key)
 }
}

$sql="SELECT * FROM etiquetados_folios AS etiq, producto AS pro, estado_folio AS esf, operarios AS ope, origenes AS ori
, procedencia AS proc where etiq.id_operarios = ope.id_operarios and
etiq.id_etiquetados_folios = etiq.id_etiquetados_folios and etiq.id_estado_folio = 8 and etiq.id_producto = pro.id_producto and etiq.id_estado_folio = esf.id_estado_folio and etiq.id_origen = ori.id_origen and etiq.id_procedencia = proc.id_procedencia order by etiq.id_etiquetados_folios, etiq.id_producto desc";
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
<table width="778" height="105" border="0" align="center">
  <tr>
    <td height="0" colspan="2" valign="top" bgcolor="#FF0000" class="titulo">NOTA IMPORTANTE: Se&ntilde;or usuario para poder rebajar los folios debe dirigirse con el encargado de producci&oacute;n</td>
    </tr>
  <tr>
    <td height="-1" colspan="2" valign="top" bgcolor="#CCCCCC" class="titulo">&nbsp;Bodega Traspaso a Materia Prima Importada</td>
  </tr>
  <tr>
    <td width="691" height="7" valign="top"><span class="numero"><? if($cuantos){?><? echo " Cantidad $cuantos";?><? }?></span></td>
    <td width="101" valign="top" class="cajas">
      <? if($cuantos){?>
      <div align="right"><span class="titulo"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></span></div><? }?></td>
  </tr>
  <tr>
    <td height="86" colspan="2" valign="top">
	<? if($cuantos){?>
	<table width="772" border="1" align="center" cellpadding="0" cellspacing="0">
	
      <tr>
        <td width="54" height="14" nowrap bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm; Folio </td>
        <td width="93" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto</td>
        <td width="86" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;F/Elaboraci&oacute;n </td>
        <td width="77" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Est/Material </td>
        <td width="73" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Procedencia</td>
        <td width="80" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;&nbsp;Responsable</td>
        <td width="84" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;&nbsp;F/B.Traspaso</td>
        <td width="94" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">
		  <div align="center">
		    <select name="id_estado_folio_cambio" class="cajas">
		      <option value="0">Estado</option>
		      <option value="2">Bodega PT</option>
		      <option value="4">Bodega MPI</option>
		    </select>
          </div></td>
        <td width="59" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; Bidon</td>
        <td width="50" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Origen</td>
      </tr>
      <? 
	


	if($cuantos){
	
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$fbodega_traspaso=format_fecha_sin_hora($row[fbodega_traspaso]);
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$id_pedidos=$row[id_pedidos];
	$id_cruce_tablas=$row[id_cruce_tablas];
	$procedencia=$row[procedencia];
	$id_estado_folio=$row[id_estado_folio];
	$i++;
	?>
      <tr>
        <td bgcolor="<? echo $color?>" height="20" nowrap="nowrap" class="cajas">
		  <div align="center"><a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $row[id_etiquetados_folios]?>"><?echo $row[id_etiquetados_folios]?></a></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $row[id_etiquetados_folios]?>"><? echo $row[producto];?></a><? //echo $row[valor_unitario]?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $f_elaboracion ?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><a href="?modulo=ejemplo_etiquetas_folios.php&amp;id_etf2=<?echo $row[id_etiquetados_folios]?>"><?
		echo $row[estado_folio];
		
		?>
        </a></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">
          <? 
		echo $procedencia;
		 ?>
        </div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;
          <?
		$nom =strtoupper("$row[nombreop]"); # HOLA TíO
		$apel =strtoupper("echo $row[apellido]"); # HOLA TíO
		echo $nom?>
          <?echo $apel?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $fbodega_traspaso ?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">
          <div align="center">&nbsp;
            <? if($id_pedidos and $id_estado_folio == 2){?>
            
            <?  echo "Ped: $id_pedidos";?>
            
            <? }else{
		    echo $id_etiquetados_folios;
		   ?>
            <input name="id_etiquetados_folios[]" type="checkbox" class="cajas" id="id_etiquetados_folios[]" value="<?echo $row[id_etiquetados_folios];?>" />
            <?
		   	  
		     }
		   ?>
          </div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[bidon_importado];?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[origen];?></td>
      </tr>
      <? }
	  
	  }//fin if
	  
	  ?>
    </table>
	<? }?>
	<? if($cuantos){?>
	<a href="javascript: document.form1.submit();">
	    
        </a>
		</center>
		<? if($permiso48 == 1){?>
		<div align="center">
       <input type="submit" name="modificar" id="modificar" value="Modificar Estado"/>
        </div>
		<? }?>
	<? }else{?>	  <table width="771" border="0">
	  <tr>
	    <td width="765">&nbsp;</td>
	    </tr>
	  <tr>
	    <td class="titulo">&nbsp;</td>
	    </tr>
	  <tr>
	    <td class="titulo"><center>No existen folios en la bodega de traspaso</center></td>
	    </tr>
	  <tr>
	    <td class="titulo">&nbsp;</td>
	    </tr>
	  </table>
      <? }?>
      </td>
  </tr>
</table>
</form>