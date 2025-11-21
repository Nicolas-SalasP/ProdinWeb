<?
if($felabaracd) { $felabaracdok=format_fecha_sin_hora($felabaracd); }
if($felabarach) { $felabarachok=format_fecha_sin_hora($felabarach); }
if($finiciod) { $finiciodok=format_fecha_sin_hora($finiciod); }
if($finicioh) { $finiciohok=format_fecha_sin_hora($finicioh); }
if($fidterminod) { $fidterminodok=format_fecha_sin_hora($fidterminod); }
if($fidterminoh) { $fidterminohok=format_fecha_sin_hora($fidterminoh); }

$sql="SELECT * FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um,  caract_producto AS carpro, caract_envases AS carenv, operarios AS o, origenes AS orig, estado_folio AS e where  ef.id_etiquetados_folios=ef.id_etiquetados_folios and ef.id_producto = p.id_producto and ef.id_calibre = c.id_calibre  and ef.id_medidas_productos = mpro.id_medidas_productos  and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 and ef.id_origen = orig.id_origen and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio and ef.id_estado_folio = 2 and ef.id_procedencia = 'I' and ef.id_c_es_so = 0";

if($id_producto){ $sql.= " and p.id_producto = '$id_producto'";}
if($id_calibre){ $sql.= " and c.id_calibre = '$id_calibre'";}
if($id_unidad_medida){ $sql.= " and um.id_unidad_medida = '$id_unidad_medida' ";}
if($id_caract_envases){ $sql.= " and carenv.id_caract_envases = '$id_caract_envases' ";}
if($id_caract_producto){ $sql.= " and carpro.id_caract_producto = '$id_caract_producto' ";}
if($id_medidas_productos){ $sql.= " and mpro.id_medidas_productos = '$id_medidas_productos' ";}
if($factura_importada){ $sql.= " and ef.factura_importada = '$factura_importada' ";}


$sql.= " order by ef.id_etiquetados_folios, c.condicion_cod_barra, c.calibre asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);


$fhoy=date("Y");

/*if($id_estado_folio_cambio == 4){
	$fbodega = date("Y-m-d"); 
}*/

if ($asignar) {


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
	  $id_calibre=$row[id_calibre];
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
 
 //echo "ultimoanorescatado = $ultimoanorescatado";
 
 }

 
if($ultimoanorescatado == 2010 or $ultimoanorescatado == 2011 or $ultimoanorescatado == 2012 or $ultimoanorescatado == 2013){

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



 $sql_nuevo="insert into mat_prima_importada (id_mat_prima_importada,id_origen,ano,id_producto,id_calibre,comprobante_num,etiquetados_folios_id,fecha_antigua_pt,cruce_tablas_id ,bidon_num,contenido,fecha_ingreso,fecha_elaboracion,f_inicio,fecha_termino,fecha_vencimiento,id_unidad_medida,id_estado_material,id_procedencia,id_operarios) values ($id_mat_prima_importada_siguiente,$id_origen,$fhoy,$id_producto,$id_calibre,'$comprobante_num','$etiquetados_folios_id','$anoet','$cruce_tablas_id','$bidon_importado','$contenido','$fecha_ingreso','$fecha_elaboracion','$f_inicio','$f_termino','$f_vencimiento','$id_unidad_medida',1,'$id_procedencia','$id_operarios')";
 $result_nuevo=mysql_query($sql_nuevo,$link);
//echo "sql_nuevo $sql_nuevo<br>";

   //*******************************************************************************************************************************
   
   
  }//fin foreach ($id_etiquetados_folios as $key)
 


}

?>
<h1>STOCK DE PRODUCTO TERMINADO IMPORTADO</h1>
<table width="1016" border="0">
 <tr>
   <td height="8" colspan="16"><table width="1013" border="0">
     <tr>
       <td colspan="2" valign="top" nowrap="nowrap"><table width="288" border="0">
         <tr>
           <td>&nbsp;<? 
					  $producto= crea_producto_onChange_segunestado($link,2,$id_producto);
				  	  echo $producto;
					  ?></td>
           <td>&nbsp;<? if ($id_producto) {
		$calibre=crea_calibre_filtro($link,$id_calibre,$id_producto,1);
		echo $calibre;
		   
		   }
		   ?></td>
           <td>&nbsp;<? 
		   if ($id_producto) {
						$unidad_medida=crea_unidad_medida_filtro($link,$id_unidad_medida,$id_producto,1);
					echo $unidad_medida;
					}
		   ?></td>
           <td>&nbsp;<?  if ($id_producto) {
					$medidas_productos=crea_medidas_productos_filtro($link,$id_medidas_productos,$id_producto,1);
					echo $medidas_productos;
					}
					?></td>
           <td>&nbsp;<? 
		    if ($id_producto) {
					$caract_producto=crea_caract_producto_filtro($link,$id_caract_producto,$id_producto,1);
					echo $caract_producto;
					}
					
		   ?></td>
           <td>&nbsp;<? 
		    if ($id_producto) {
					$caract_envases=crea_caract_envases_filtro($link,$id_caract_envases,$id_producto,1);
					echo $caract_envases;
					}
		   ?></td>
           <td><strong>
             <input name="factura_importada" type="text" id="factura_importada" value="<? echo $factura_importada?>" size="10" maxlength="10" />
           </strong></td>
           </tr>
       </table></td>
       </tr>
     <tr>
       <td width="898" nowrap="nowrap">Nota: Listado de Bidones de <B>PRODUCTO TERMINADO IMPORTADO</B> en el estado de Bodega.</td>
       <td width="105" align="center" nowrap="nowrap"><input type="submit" name="buscar" id="buscar" value="Buscar" /></td>
     </tr>
   </table></td>
  </tr>
 <tr>
   <td height="9" colspan="16">&nbsp;</td>
 </tr>
 <? if($cuantos and $buscar){?>
 <tr>
    <td width="23" height="19" bgcolor="#FF9933"><center></center></td>
    <td colspan="15" bgcolor="#CCCCCC"><strong>&nbsp;Cantidad <? echo $cuantos?></strong></td>
  </tr>
  <tr>
    <td width="23" height="19" bgcolor="#FF9933">&nbsp;N&ordm;</td>
    <td width="56" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="41" bgcolor="#FF9933"><strong>&nbsp;COD</strong></td>
    <td width="96" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="78" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong>
    </td>
    <td width="90" bgcolor="#FF9933"><strong>&nbsp;UNID/MED</strong></td>
    <td width="83" bgcolor="#FF9933"><strong>&nbsp;MEDIDAS</strong></td>
    <td width="30" bgcolor="#FF9933"><strong>&nbsp;C/P</strong></td>
    <td width="31" bgcolor="#FF9933"><strong>&nbsp;C/E</strong></td>
    <td width="40" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="47" bgcolor="#FF9933"><strong>&nbsp;OPERADOR</strong></td>
    <td width="48" bgcolor="#FF9933"><strong>&nbsp;F/ELABOR.</strong></td>
    <td width="40" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    <td width="24" bgcolor="#FF9933"><strong>&nbsp;F/IMPORTADA</strong></td>
    <td width="24" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="45" bgcolor="#FF9933"><center><a href="javascript:seleccionar_todo()"><img src="codphp/jpgnew/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="codphp/jpgnew/ninguno.jpg" width="13" height="13" border="0"/></a></center></td>
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
	$factura_importada=$row[factura_importada];
	$f_elaboracion=$row[f_elaboracion];
	
  ?>
  <tr>
    <td height="19" align="center" nowrap="nowrap" bgcolor="<? echo $color?>"><strong><? echo $i?></strong></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;PT<? echo $id_etiquetados_folios?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $id_cruce_tablas?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $producto ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $calibre ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $unidad_medida ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $medidas_productos ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $caract_producto ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $caract_envases ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $contenido_unidades ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
	<? 
	$nom = strtoupper($row[nombreop]);
	$apell = strtoupper($row[apellido]);
	echo $nom?> <? echo $apell ?>
    </td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $f_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? $est = strtoupper($row[estado_folio]); echo $est ?>&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $factura_importada?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $origen?></td>
    <td width="45" nowrap="nowrap" bgcolor="<? echo $color?>"><center> <input name="id_etiquetados_folios222[]" type="checkbox" class="cajas" id="id_etiquetados_folios222[]" value="<?echo $id_etiquetados_folios222=$row[id_etiquetados_folios];?>" /></center></td>
  </tr>
  <?
	}
	}
  ?>
  <tr>
     </tr>
  <tr>
    <td height="19" colspan="16" align="right" nowrap="nowrap" bgcolor="<? echo $color?>"><? if($id_producto and $buscar){?>
      <input type="submit" name="asignar" id="asignar" value="Asignar" />
    <? } ?></td>
  </tr>
  
</table>