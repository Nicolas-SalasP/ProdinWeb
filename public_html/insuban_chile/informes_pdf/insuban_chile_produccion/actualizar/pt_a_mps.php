<?

//require "../sconre.php";
require "../lib/conexion.php";
require "../lib/funciones.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");

$fhoy=date("Y");

/*if($id_estado_folio_cambio == 4){
	$fbodega = date("Y-m-d"); 
}*/

if ($modificar) {


  $fbodega_mpi  = date("Y-m-d"); // identificara el dia del cambio
  foreach ($id_etiquetados_folios222 as $key)
  {
  $sql="update etiquetados_folios set id_estado_folio=4, fbodega_mpi='$fbodega_mpi' where id_etiquetados_folios = $key";
  $res=mysql_query($sql);
  $sql="SELECT * FROM etiquetados_folios where id_etiquetados_folios ='$key'";
  $result=mysql_query($sql);
  $cuantos=mysql_num_rows($result);
  
   if ($row=mysql_fetch_array($result))
   { 
	  $etiquetados_folios_id=$row[id_etiquetados_folios];
	  $cruce_tablas_id=$row[id_cruce_tablas];
	  $bidon_importado=$row[bidon_importado];
	 // echo "bidon_importado $bidon_importado<br>";
      $comprobante_num=$row[factura_importada];
	  $anoet=$row[ano];
	  $id_producto=$row[id_producto];
	  $id_estado_material=$row[id_estado_folio];
	  $id_unidad_medida=$row[id_unidad_medida];
	  $fecha_elaboracion=$row[f_elaboracion];
	  $f_inicio=$row[f_inicio];
	  $f_termino=$row[f_termino];
	  $f_vencimiento=$row[f_vencimiento];
	  $id_estado_folio=$row[id_estado_folio];
	  $id_procedencia=$row[id_procedencia];
	  $id_operarios=$row[id_operarios];
	  $id_origen=$row[id_origen];
	  $contenido=$row[contenido_unidades];
	  $fecha_ingreso=$row[fech_generada_inicio];

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
 
 echo "ultimoanorescatado = $ultimoanorescatado";
 
 }

 
if($ultimoanorescatado == 2010 or $ultimoanorescatado == 2011 or $ultimoanorescatado == 2012){

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



 $sql_nuevo="insert into mat_prima_importada (id_mat_prima_importada,id_origen,ano,id_producto,comprobante_num,etiquetados_folios_id,fecha_antigua_pt,cruce_tablas_id ,bidon_num,contenido,fecha_ingreso,fecha_elaboracion,f_inicio,fecha_termino,fecha_vencimiento,id_unidad_medida,id_estado_material,id_procedencia,id_operarios) values ($id_mat_prima_importada_siguiente,$id_origen,$fhoy,$id_producto,'$comprobante_num','$etiquetados_folios_id','$anoet','$cruce_tablas_id','$bidon_importado','$contenido','$fecha_ingreso','$fecha_elaboracion','$f_inicio','$f_termino','$f_vencimiento','$id_unidad_medida',1,'$id_procedencia','$id_operarios')";
 $result_nuevo=mysql_query($sql_nuevo,$link);
//echo "sql_nuevo $sql_nuevo<br>";

   //*******************************************************************************************************************************
   
   
  }//fin foreach ($id_etiquetados_folios as $key)
 
}

$sql="SELECT  * FROM etiquetados_folios AS ef, producto AS p, estado_folio AS es, origenes AS org, operarios AS op, procedencia AS pro WHERE  
ef.id_producto = p.id_producto and 
ef.id_estado_folio = 2 and
ef.factura_importada  =  110039  and
ef.id_estado_folio = es.id_estado_folio and 
ef.id_origen = org.id_origen and 
ef.id_operarios = op.id_operarios and
ef.id_procedencia = 'I' and 
ef.id_procedencia = pro.id_procedencia ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
echo "cuantos $cuantos";

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
<table width="778" height="102" border="0" align="center">
  <tr>
    <td height="1" colspan="2" valign="top" bgcolor="#CCCCCC" class="titulo">&nbsp;Bodega PT</td>
    </tr>
  <tr>
    <td width="691" height="7" valign="top"><span class="numero"><? if($cuantos){?><? echo " Cantidad $cuantos";?><? }?></span><? $bodegab=crea_bodeganews_muestra($link,$id_bodeganew);
		echo $bodegab;
	 ?></td>
    <td width="101" valign="top" class="cajas">
      <? if($cuantos){?>
      <div align="right"><span class="titulo"><a href="javascript:seleccionar_todo()"><img src="../jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="../jpg/ninguno.jpg" width="13" height="13" border="0"/></a></span></div><? }?></td>
  </tr>
  <tr>
    <td height="86" colspan="2" valign="top">
	<? if($cuantos){?>
	<table width="772" border="1" align="center" cellpadding="0" cellspacing="0">
	
      <tr>
        <td width="27" height="14" nowrap bgcolor="#CCCCCC" class="titulo">&nbsp;</td>
        <td width="27" nowrap bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm; Folio </td>
        <td width="93" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto</td>
        <td width="86" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;F/Elaboraci&oacute;n </td>
        <td width="77" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Est/Material </td>
        <td width="73" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Procedencia</td>
        <td width="80" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;&nbsp;Responsable</td>
        <td width="84" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;&nbsp;F/B.Traspaso</td>
        <td width="94" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">
		  <select name="id_estado_folio_cambio" class="cajas">
		      <option value="0">Estado</option>
		      <option value="1">MP</option>

		    </select></td>
        <td width="59" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; Bidon</td>
        <td width="25" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Origen</td>
        <td width="25" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Fac Importada</td>
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
	$id_estado_folio=$row[id_estado_folio];
	$i++;
	?>
      <tr>
        <td height="20" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $i?></td>
        <td height="20" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><?echo $row[id_etiquetados_folios]?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[producto];?><? //echo $row[valor_unitario]?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $f_elaboracion ?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><?
		echo $row[estado_folio];
		
		?>
        </div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">
          <? 
		  //echo $row[id_procedencia];
		  
		
		 echo  $row[id_procedencia];
       
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
          <?
		    echo $id_etiquetados_folios;
		   ?>
            <input name="id_etiquetados_folios222[]" type="checkbox" class="cajas" id="id_etiquetados_folios222[]" value="<?echo $id_etiquetados_folios222=$row[id_etiquetados_folios];?>" />
                   
          </div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[bidon_importado];?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[origen];?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[factura_importada];?></td>
      </tr>
      <? }
	  
	  }//fin if
	  
	  ?>
    </table>
	<? }?>
	<? if($cuantos){?>
	</center>
	
		<div align="center">
       <input type="submit" name="modificar" id="modificar" value="Modificar Estado" />
        </div>
	
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