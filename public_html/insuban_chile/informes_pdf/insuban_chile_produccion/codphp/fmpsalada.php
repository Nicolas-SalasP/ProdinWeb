<?
error_reporting(0);
$fecha_ingreso=date("Y-m-d"); 
$fhoy=date("Y"); //año
if($guardax){

$sqlultimafecha="SELECT * FROM mat_prima_importada where id_mat_prima_importada=id_mat_prima_importada ORDER BY id_mat_prima_importada desc LIMIT 1";
$resulultimafecha=mysql_query($sqlultimafecha);
$cuantosultimafecha=mysql_num_rows($resulultimafecha);

 if ($rowultimafecha=mysql_fetch_array($resulultimafecha))
 { 
 $id_mat_prima_importada=$rowultimafecha[id_mat_prima_importada];
 $ultimoanorescatado=$rowultimafecha[ano];
 }
 //echo "ultimoanorescatado $ultimoanorescatado <br> id_mat_prima_importada $id_mat_prima_importada<br>";
 
 if($ultimoanorescatado == $fhoy){
 $id_mat_prima_importada = $rowultimafecha[id_mat_prima_importada];
 $id_mat_prima_importada_siguiente = $id_mat_prima_importada+1;
 
//echo "iddddddddd $id_mat_prima_importada_siguiente $ultimoanorescatado $fhoy<br>";
 
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
 $id_mat_prima_importada_siguiente="2".$anook.$id_mat_prima_importada_siguiente; //el 2 es para inicio de año
 
 //echo "id_mat_prima_importada_siguiente $id_mat_prima_importada_siguiente<br>";
}
  
  $dat=split(" ",$fecha_elaboracion);
  $dat1=split("-",$dat[0]);
  $fecha_elaboracionf="$dat1[2]-$dat1[1]-$dat1[0]";
  
  $datt=split(" ",$f_inicio);
  $dat2=split("-",$datt[0]);
  $f_iniciof="$dat2[2]-$dat2[1]-$dat2[0]";
  
  $dattt=split(" ",$f_termino);
  $dat3=split("-",$dattt[0]);
  $f_terminof="$dat3[2]-$dat3[1]-$dat3[0]";
  
  $dat4=split(" ",$f_termino);
  $dat6=split("-",$dat4[0]);
  $f_termino22="$dat6[2]-$dat6[1]-$dat6[0]";
  $ann=$dat6[2];
  $ank=$ann+1;
  $dias=1;
  $f_termino22f="$ank-$dat6[1]-$dat6[0]";
  $fecha_vencimientof = date("Y-m-d", strtotime("$f_termino22f + $dias day"));
  
   if($temperatura1=='')
    $temperatura1=0;
 
  if($rcp=='')
    $rcp=0;
  if($observaciones=='')
    $observaciones="Sin Observaciones";
   
   $fech_generada_inicio =date("Y-m-d H:i:s");
   $sql_nuevo="insert into mat_prima_importada (id_mat_prima_importada,cruce_tablas_id,id_especie,id_producto,id_calibre,id_unidad_medida,id_medidas_productos,id_caract_producto,id_caract_envases,id_origen,id_operarios,ano,id_estado_material,id_procedencia,bidon_num,comprobante_num,guia_imp,contenido,glosa,fecha_ingreso,fecha_elaboracion,f_inicio,fecha_termino,fecha_vencimiento,fech_generada_inicio,cert_sanitario) values
   ('$id_mat_prima_importada_siguiente','$codigo','$id_especie','$id_producto','$id_calibre','$id_unidad_medida','$id_medidas_productos','$id_caract_producto','$id_caract_envases','$id_origen','$id_operarios','$fhoy','1','I','$bidon_num','$factura_mp','$guia_imp','$contenido','$observaciones','$fecha_ingreso','$fecha_elaboracionf','$f_iniciof','$f_terminof','$fecha_vencimientof','$fech_generada_inicio','$cert_zoo')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  $ultimoidinsertado=mysql_insert_id();
 echo "$sql_nuevo";

 
  echo "ultimoidinsertado $ultimoidinsertado";
// echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=fmpsalada.php&id_mat_prima_importada=$ultimoidinsertado&id_origen=$id_origen&salada=I&mantsec=$mantsec\">";
 //exit;
}// fin modificar_x

if($modificarx){
  
//echo "estoy en modificar $id_mat_prima_nacional";
  
  $dat=split(" ",$fecha_elaboracion);
  $dat1=split("-",$dat[0]);
  $fecha_elaboracion2="$dat1[2]-$dat1[1]-$dat1[0]";
  
  $datt=split(" ",$f_inicio);
  $dat2=split("-",$datt[0]);
  $f_inicio="$dat2[2]-$dat2[1]-$dat2[0]";
  
  $dattt=split(" ",$f_termino);
  $dat3=split("-",$dattt[0]);
  $f_termino="$dat3[2]-$dat3[1]-$dat3[0]";
 
 
  $dat4=split(" ",$f_termino);
  $dat6=split("-",$dat4[0]);
  $f_termino22="$dat6[0]-$dat6[1]-$dat6[2]";
    //echo "f_termino $f_termino22<br>";
  $ann=$dat6[0];
  
  $ank=$ann+1;
  //echo "ank $ank<br>";
  $dias=1;
  $f_termino22fd="$ank-$dat6[1]-$dat6[2]";
  $fecha_vencimientof = date("Y-m-d", strtotime("$f_termino22fd + $dias day"));;
  
  if($id_estado_material == 2){
	$fecha_salida=date("Y-m-d");    
  }
  if($id_estado_material == 3){
	$fecha_anula =date("Y-m-d");    
  }
 
  
$sql_modificar="UPDATE  mat_prima_importada set id_operarios='$id_operarios',id_origen='$id_origen', id_producto='$id_producto', comprobante_num='$factura_mp', guia_imp='$guia_imp', contenido='$contenido', bidon_num='$bidon_num', glosa='$observaciones', fecha_elaboracion='$fecha_elaboracion2', f_inicio = '$f_inicio', fecha_termino = '$f_termino', fecha_vencimiento = '$fecha_vencimientof',id_estado_material = '$id_estado_material', fecha_salida ='$fecha_salida', fecha_anula = '$fecha_anula',  cert_sanitario = '$cert_zoo' where id_mat_prima_importada=$id_mat_prima_importada";
$rest=mysql_query($sql_modificar);
//echo "sql_modificar $sql_modificar";
/* if($id_mat_prima_nacional){
 echo"<meta http-equiv=\"refresh\"content=\"0;URL=sistema.php?modulo=fmpfresca.php&botmenu=1&fresca=N&id_mat_prima_nacional=$id_mat_prima_nacional\">";
 exit;
}*/
}

$sql="SELECT * FROM mat_prima_importada where id_mat_prima_importada = $id_mat_prima_importada ";
$result=mysql_query($sql);
//$cuantos=mysql_num_rows($result);
//echo "sql -> $sql<br>";
?>
<h1>INGRESO DE MATERIA PRIMA SALADA</h1>
<? if(!$nuevo){ ?>
  <?
  	
      if ($row=mysql_fetch_array($result))
      { 
	  	$id_mat_prima_importada=$row[id_mat_prima_importada];
		$id_solicitud_mp=$row[id_solicitud_mp];
		$id_c_es_so=$row[id_c_es_so];
		$id_ldp=$row[id_ldp];
		$id_origen=$row[id_origen];
		$id_estado_material=$row[id_estado_material];
		$etiquetados_folios_id=$row[etiquetados_folios_id];
		$etiquetados_folios_id_new=$row[etiquetados_folios_id_new];
		$id_operarios=$row[id_operarios];
		$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
		$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
		$fecha_elaboracion=format_fecha_sin_hora($row[fecha_elaboracion]);
		$f_inicio=format_fecha_sin_hora($row[f_inicio]);
		$f_termino=format_fecha_sin_hora($row[fecha_termino]);
		$f_vencimiento =format_fecha_sin_hora($row[fecha_vencimiento]);
		$fecha_asig_producc=$row[fecha_asig_producc];
		$id_estado_material=$row[id_estado_material];
		$bidon_num=$row[bidon_num];
		$factura_mp=$row[comprobante_num];
		$observaciones=$row[glosa];
		$contenido=$row[contenido];
		$cruce_tablas_id=$row[cruce_tablas_id];
    $cert_zoo=$row[cert_sanitario];    
		
	 ?> 
    
<table width="800" border="0">
  <tr>
    <td width="154" bgcolor="#99CC66">&nbsp;FOLIO MP (Nuevo)</td>
    <td width="3" bgcolor="#99CC66">:</td>
    <td width="144" bgcolor="#99CC66"><h4>&nbsp;S<? 
	 $largo=strlen($id_mat_prima_importada);
	 if($largo == 9){
	 $id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 }
	echo $id_mat_prima_importada?>
    </h4></td>
    <td width="119">&nbsp;</td>
    <td width="3">&nbsp;</td>
    <td width="294" rowspan="2" valign="top">
    
    <?
	
	
    if($etiquetados_folios_id)
	 {
	  $idf=$etiquetados_folios_id;
	 }else{
	 if($largo == 9){
	 $idf=substr($id_mat_prima_importada,1,9);
	 }
	 $idf=$id_mat_prima_importada;
	 }//if($etiquetados_folios_id)
	?>
    <a href="javascript:Abrir_ventana('codphp/impresion_pdf/pdf_salada.php?idf=<?echo $idf?>')"><img src="codphp/jpgnew/impresora.jpg" width="29" height="32" border="0" /></a></td>
  </tr>
  <tr>
    <td <? if($etiquetados_folios_id){?>bgcolor="#FFCC33"<? }?>><? if($etiquetados_folios_id){?>&nbsp;FOLIO PT (Antiguo)<? }?></td>
    <td <? if($etiquetados_folios_id){?>bgcolor="#FFCC33" <? }?>><? if($etiquetados_folios_id){?>:<? } ?></td>
    <td <? if($etiquetados_folios_id){?>bgcolor="#FFCC33"<? }?>><? if($etiquetados_folios_id){?><h4>&nbsp;<? echo $etiquetados_folios_id?></h4><? } ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>F/INGRESO</td>
    <td>:</td>
    <td>&nbsp;<? echo $fecha_ingreso?></td>
    <td>ORIGEN</strong></td>
    <td>:</td>
    <td><? 
	$s=$salada;
	$origen= crea_origenes_ok($link,$id_origen,$s,0);
	echo $origen;
	?></td>
  </tr>
  <tr>
    <td>
      <?
    $sqlcod="SELECT ct.id_cruce_tablas AS id_cruce_tablas, esp.id_especie AS id_especie, pro.id_producto AS id_producto, c.id_calibre AS id_calibre, um.id_unidad_medida AS id_unidad_medida, mp.id_medidas_productos AS id_medidas_productos, cp.id_caract_producto AS id_caract_producto, ce.id_caract_envases AS id_caract_envases FROM cruce_tablas AS ct, especie AS esp, producto AS pro, calibre AS c, unidad_medida AS um, medidas_productos AS mp, caract_producto AS cp, caract_envases AS ce WHERE ct.id_cruce_tablas = $cruce_tablas_id AND ct.id_especie = esp.id_especie AND ct.id_producto = pro.id_producto AND ct.id_calibre = c.id_calibre AND ct.id_unidad_medida = um.id_unidad_medida AND ct.id_medidas_productos  = mp.id_medidas_productos AND ct.id_caract_producto = cp.id_caract_producto AND ct.id_caract_envases = ce.id_caract_envases ";	  
$resultcod=mysql_query($sqlcod);
$cuantoscod=mysql_num_rows($resultcod);
//echo "sqlcod $sqlcod";

 if ($rowcod=mysql_fetch_array($resultcod))
      { 
	  $id_cruce_tablas=$rowcod[id_cruce_tablas];
	  $id_especie=$rowcod[id_especie];
	  $id_producto=$rowcod[id_producto];
	  $id_calibre=$rowcod[id_calibre];
	  $id_unidad_medida=$rowcod[id_unidad_medida];
	  $id_medidas_productos=$rowcod[id_medidas_productos];
	  $id_caract_producto=$rowcod[id_caract_producto];
	  $id_caract_envases=$rowcod[id_caract_envases];
	?>
    CODIGO</strong></td>
    <td>:</td>
    <td>&nbsp;<?echo $cruce_tablas_id?> <? if($id_solicitud_mp or $id_c_es_so){?>
    <img src="codphp/jpgnew/canrojo.png" width="16" height="16" border="0" />
    <? }else{?><a href="javascript:Abrir_ventana_nueva('codphp/codlis.php?id_s=<? echo "2$id_mat_prima_importada";?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&salada=<? echo "I";?>')">[Modificar]</a>
    <? }?>
       </td>
    <td valign="top">OPERARIO</strong></td>
    <td valign="top">:</td>
    <td valign="top"><? 
	   $operarios=crea_operarios($link,$id_operarios);
	   echo $operarios;
	?></td>
  </tr>
  <tr>
    <td>ESPECIE</strong></td>
    <td>:</td>
    <td>&nbsp;<? $especie= crea_especie_codificacion($link,$id_especie,1,1); echo $especie;?></td>
    <td valign="top">FACTURA</strong></td>
    <td valign="top">:</td>
    <td valign="top"><input name="factura_mp" type="text" value="<?echo $factura_mp?>"/></td>
  </tr>
  <tr>
    <td>PRODUCTO</strong></td>
    <td>:</td>
    <td>&nbsp;<? $producto_especie= crea_producto_especie_codificacion($link,$id_especie,$id_producto,1,1); echo $producto_especie;?></td>
    <td valign="top">GUIA</td>
    <td valign="top">:</td>
    <td valign="top"><input name="guia_imp" type="text" value="<?echo $row[guia_imp]?>"/></td>
  </tr>
  <tr>
    <td>CALIBRE</strong></td>
    <td>:</td>
    <td>&nbsp;<?  $producto_calibre= crea_producto_calibre_codificacion($link,$id_producto,$id_calibre,1,1); echo $producto_calibre; ?></td>
    <td valign="top">CONTENIDO</td>
    <td valign="top">:</td>
    <td valign="top"><input name="contenido" type="text" value="<? echo $contenido?>" /></td>
  </tr>
  <tr>
    <td>UNIDAD MEDIDA</strong></td>
    <td>:</td>
    <td>&nbsp;<?  $producto_unidad_medida= crea_producto_unidad_medida_codificacion($link,$id_producto,$id_unidad_medida,1,1); echo $producto_unidad_medida; ?></td>


    <td valign="top">N&ordm; BIDON</td>
    <td valign="top">:</td>
    <td valign="top"><input name="bidon_num" type="text" value="<? echo $bidon_num?>" /></td>
  </tr>
  <tr>
    <td>MEDIDA</strong></td>
    <td>:</td>
    <td>&nbsp;<?  $producto_medida= crea_producto_medida_codificacion($link,$id_producto,$id_medidas_productos,1,1); echo $producto_medida;?></td>
    <td valign="top">ESTADO </td>
    <td valign="top">:</td>
    <td valign="top"><? 
	   $estado_material=crea_estado_material($link,$id_estado_material);
	   echo $estado_material;
	   
	   if($id_estado_material == 2)
	   {
		   echo "<strong>[$fecha_salida]</strong>";
	   }
	   
	?></td>
  </tr>
  <tr>
    <td>CARACT/PRODUCTO</strong></td>
    <td>:</td>
    <td>&nbsp;<?  $producto_caract_producto= crea_producto_caract_codificacion($link,$id_producto,$id_caract_producto,1,1);  echo $producto_caract_producto; ?></td>
  <td>N&ordm; SANITARIO</td>
  <td>:</td>
  <td><input name="cert_zoo" type="text" value="<? echo $cert_zoo?>" /></td>
  </tr>
  <tr>
    <td>CARACT/ENVASE</strong></td>
    <td>:</td>
    <td>&nbsp;<?  $producto_caract_producto= crea_producto_caract_envases($link,$id_producto,$id_caract_envases,1,1); echo $producto_caract_producto; ?><? } ?></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>F/FAENA</td>
    <td>:</td>
    <td><input name="fecha_elaboracion" type="text" id="fecha_elaboracion"  value="<?echo $fecha_elaboracion?>" size="10" maxlength="10" /><a href="javascript:show_Calendario('form1.fecha_elaboracion');"> Ver</a></td>
    <td colspan="3" bgcolor="#CCCCCC">&nbsp;FOLIO ASOCIADO A:</td>
  </tr>
  <tr>
    <td>F/INICIO</strong></td>
    <td>:</td>
    <td><input name="f_inicio" type="text" id="f_inicio"  value="<?echo $f_inicio?>" size="10" maxlength="10" />      <a href="javascript:show_Calendario('form1.f_inicio');"> Ver</a></td>
    <td colspan="3">&nbsp;<strong>LINEA PRODUCION:</strong>
      <? if($id_solicitud_mp){?>
      <? include "lib/ldp.php";?>
      <? }else{?>
      NO
  <? } ?>
      / <strong><? if($fecha_asig_producc != '0000-00-00'){?>Fecha Producci&oacute;n:&nbsp;<a href="?modulo=pproduccdetalle.php&amp;id_ldp=<? echo $id_ldp?>&amp;fecha_asig_producc=<? echo $fecha_asig_producc?>&amp;tip=$tip"><? echo $fecha_asig_producc?></a><? }else{ ?>Fecha Producci&oacute;n:&nbsp;: 0000-00-00<?}?></strong></td>
  </tr>
  <tr>
    <td>F/TERMINO</strong></td>
    <td>:</td>
    <td><input name="f_termino" type="text" id="f_termino"  value="<?echo $f_termino?>" size="10" maxlength="10" />      <a href="javascript:show_Calendario('form1.f_termino');"> Ver</a></td>
    <td colspan="3">&nbsp;<strong>SOLICITUD N&ordm;: </strong>
      <? if($id_solicitud_mp){?>
      <a href="?modulo=pendientesmpdetalle.php&amp;id_solicitud_mp=<? echo $id_solicitud_mp?>&amp;id_ldp=<? echo $id_ldp?>&amp;infomenu=1&amp;tip=$tip"><? echo $id_solicitud_mp ?></a>
      <? }else{ ?>
NO
<? } ?><hr>
    
    
    </td>
  </tr>
  <tr>
    <td valign="top">F/VENCIMIENTO</strong></td>
    <td valign="top">:</td>
    <td valign="top">&nbsp;<? echo $f_vencimiento?></td>
    <td colspan="3">&nbsp;<strong>SOLICITUD CAMBIO ESTADO N&ordm;: 
	<? if($id_c_es_so){?>
	<? echo $id_c_es_so ?>
	/ <a href="?modulo=solicitudcdetalle.php&id_c_es_so= <? echo $id_c_es_so?>&tic=<? echo $tic?>">Ir a solicitud Cambio Estado</a>
	<? }else{?>NO<? }?>
    </strong><br>
    &nbsp;<strong>MATERIA PRIMA ASOCIADA AL FOLIO PT: <? echo $etiquetados_folios_id_new?></strong></td>
  </tr>
  <tr>
    <td>OBSERVACIONES</strong></td>
    <td>:</td>
    <td>&nbsp;</td>
    <td colspan="3"><? //if($mantsec or $nuevo){?>
    <!--  <input type="checkbox" name="mantsec2" value="1" checked="checked"/>
MANTENER SECUENCIA-->
<? //} ?></td>
  </tr>
  <tr>
    <td colspan="5"><textarea name="observaciones" id="observaciones" cols="60" rows="5" onkeyup="this.value = this.value.slice(0, 100)"><? echo $observaciones?></textarea></td>
    <td align="right" >
	<? if(!$mantsec){?>
    <? if($id_solicitud_mp or $id_c_es_so){?>
    <img src="codphp/jpgnew/canrojo.png" width="16" height="16" border="0" />
    <? }else{?>
<input type="submit" name="modificarx" id="modificarx" value="Modificar" />
    <? }?>
    
	<? }else{ ?>
    <input type="submit" name="guardax" id="guardax" value="Guardar" />
	<? } ?>
    </td>
  </tr>
  <tr>
    <td colspan="6">M&aacute;ximo de caracteres permitidos [100]</td>
  </tr>
</table>

<? 
} //fin del if muestra informacion
} // fin del if nuevo
?>
<? if($nuevo){?>
<table width="800" border="0">
<tr>
  <td width="158">INGRESAR CODIGO</td>
  <td width="5">:</td>
  <td width="208">
  <input name="codigo" type="text" id="codigo" value="<?echo $codigo?>" size="10" maxlength="10"/>
   <?
				
				if($vercod or $codigo)
				{
				//echo "toy dentro";
				$sqlb="SELECT  * from cruce_tablas where id_cruce_tablas = $codigo";
			    $resulbt=mysql_query($sqlb);
				$cuantosb=mysql_num_rows($resulbt);
				if($cuantosb){
					if ($rowb=mysql_fetch_array($resulbt))
					{ 
					$id_cruce_tablasb=$rowb[id_cruce_tablas];
					$id_especieb=$rowb[id_especie];
					$id_productob=$rowb[id_producto];
					$id_calibreb=$rowb[id_calibre];
					$id_unidad_medidab=$rowb[id_unidad_medida];
					$id_medidas_productosb=$rowb[id_medidas_productos];
					$id_caract_productob=$rowb[id_caract_producto];
					$id_caract_envasesb=$rowb[id_caract_envases];
					}
				}
				}
               	?>
  <input name="vercodnuevo" type="submit" id="vercodnuevo" value="ver Codigo" /></td>
  <td>ORIGEN</td>
  <td>:</td>
  <td><?
			$s=$salada;
			$origen= crea_origenes_ok($link,$id_origen,$s,1);
			echo $origen;
			?></td>
</tr>
<tr>
  <td>ESPECIE</td>
  <td>:</td>
  <td><? $especie= crea_especie_codificacion($link,$id_especieb,1,1); echo $especie;?></td>
  <td>OPERARIO</td>
  <td>:</td>
  <td><? $operarios=crea_operarios($link,$id_operarios);
				echo $operarios;?></td>
</tr>
<tr>
  <td>PRODUCTO</td>
  <td>:</td>
  <td><? $producto_especie= crea_producto_especie_codificacion($link,$id_especieb,$id_productob,1,1); echo $producto_especie;?></td>
  <td>FACTURA</td>
  <td>:</td>
  <td><input name="factura_mp" type="text" value="<?echo $factura_mp?>"/></td>
</tr>
<tr>
  <td>CALIBRE</td>
  <td>:</td>
  <td><?  $producto_calibre= crea_producto_calibre_codificacion($link,$id_productob,$id_calibreb,1,1); echo $producto_calibre; ?></td>
  <td>GUIA</td>
  <td>:</td>
  <td><input name="guia_imp" type="text" value="<?echo $guia_imp?>"/></td>
</tr>
<tr>
  <td>UNIDAD DE MEDIDA</td>
  <td>:</td>
  <td><?  $producto_unidad_medida= crea_producto_unidad_medida_codificacion($link,$id_productob,$id_unidad_medidab,1,1); echo $producto_unidad_medida; ?></td>
  <td>CONTENIDO</td>
  <td>:</td>
  <td><input name="contenido" type="text" value="<? echo $contenido?>" /></td>
</tr>
<tr>
  <td>MEDIDA</td>
  <td>:</td>
  <td><?  $producto_medida= crea_producto_medida_codificacion($link,$id_productob,$id_medidas_productosb,1,1); echo $producto_medida;?></td>
  <td>N&ordm; BIDON</td>
  <td>:</td>
  <td><input name="bidon_num" type="text" value="<? echo $bidon_num?>" /></td>
</tr>
<tr>
  <td>CARACT/PRODUCTO</td>
  <td>:</td>
  <td><?  $producto_caract_producto= crea_producto_caract_codificacion($link,$id_productob,$id_caract_productob,1,1);  echo $producto_caract_producto; ?></td>
  <td>N&ordm; SANITARIO</td>
  <td>:</td>
  <td><input name="cert_zoo" type="text" value="<? echo $cert_zoo?>" /></td>
</tr>
<tr>
  <td>CARACT/ENVASE</td>
  <td>:</td>
  <td><?  $producto_caract_producto= crea_producto_caract_envases($link,$id_productob,$id_caract_envasesb,1,1); echo $producto_caract_producto; ?></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>F/FAENA</td>
  <td>:</td>
  <td><input name="fecha_elaboracion" type="text" id="fecha_elaboracion"  value="<?echo $fecha_elaboracion?>" size="10" maxlength="10" />
    <a href="javascript:show_Calendario('form1.fecha_elaboracion');"> Ver</a></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>F/INICIO</td>
  <td>:</td>
  <td><input name="f_inicio" type="text" id="f_inicio"  value="<?echo $f_inicio?>" size="10" maxlength="10" />
    <a href="javascript:show_Calendario('form1.f_inicio');"> Ver</a></td>
            <td width="93">&nbsp;</td>
            <td width="3">&nbsp;</td>
            <td width="307">&nbsp;</td>
  </tr>
          <tr>
            <td>F/TERMINO</td>
            <td>:</td>
            <td><input name="f_termino" type="text" id="f_termino"  value="<?echo $f_termino?>" size="10" maxlength="10" />
            <a href="javascript:show_Calendario('form1.f_termino');"> Ver</a></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>OBSERVACIONES</td>
            <td>:</td>
            <td>&nbsp;</td>
            <td colspan="3"><!--<img src="images/trazabalidad.jpg" width="62" height="36" border="0" />-->
              <? //if(!$mantsec or $nuevo){?>
              <!--<input type="checkbox" name="mantsec" value="1" />-->
              <? //} ?>
<!--MANTENER SECUENCIA--></td>
          </tr>
          <tr>
            <td colspan="5"><textarea name="observaciones" id="observaciones" cols="60" rows="5" onkeyup="this.value = this.value.slice(0, 100)"><? echo $observaciones2?></textarea></td>
            <td align="center"><input type="submit" name="guardax" id="guardax" value="Guardar"></td>
          </tr>
          <tr>
            <td colspan="6">M&aacute;ximo de caracteres permitidos [100]</td>
          </tr>
</table>
<? } ?>
