<strong></strong><?

			 
$fhoy=date("Y"); //año
if($guardax){
	
	echo "id_estado_materialotro $id_estado_materialotro<br>";
	
	
	 $sqlultnun="SELECT* FROM mat_prima_nacional WHERE id_origen = $id_origen ORDER BY id_mat_prima_nacional DESC LIMIT 0 , 1";
	 $resultnum=mysql_query($sqlultnun);
	 $sqlultnun=mysql_num_rows($resultnum);

	if ($rownum=mysql_fetch_array($resultnum))
	{
	$correl=$rownum[bidon_num];
	$bidon_num=$correl + 1;
	}

  $sqlultimafecha="SELECT * FROM mat_prima_nacional where id_mat_prima_nacional=id_mat_prima_nacional ORDER BY id_mat_prima_nacional desc LIMIT 1";
$resulultimafecha=mysql_query($sqlultimafecha);
$cuantosultimafecha=mysql_num_rows($resulultimafecha);

 if ($rowultimafecha=mysql_fetch_array($resulultimafecha))
 { 
 $id_mat_prima_nacional=$rowultimafecha[id_mat_prima_nacional];
 $ultimoanorescatado=$rowultimafecha[ano];
 }
 
if($ultimoanorescatado == $fhoy){
 $id_mat_prima_nacional=$rowultimafecha[id_mat_prima_nacional];
 $id_mat_prima_nacional_siguiente=$id_mat_prima_nacional+1;
}else{
 $id_mat_prima_nacional=$rowul[id_mat_prima_nacional];
 $id_mat_prima_nacional_siguiente=$id_mat_prima_nacional - $id_mat_prima_nacional;
 $id_mat_prima_nacional_siguiente++;

 $id_mat_prima_nacional_siguiente_contar=strlen($id_mat_prima_nacional_siguiente);
 
 if($id_mat_prima_nacional_siguiente_contar == 1) $id_mat_prima_nacional_siguiente="00000$id_mat_prima_nacional_siguiente";
 if($id_mat_prima_nacional_siguiente_contar == 2) $id_mat_prima_nacional_siguiente="0000$id_mat_prima_nacional_siguiente";
 if($id_mat_prima_nacional_siguiente_contar == 3) $id_mat_prima_nacional_siguiente="000$id_mat_prima_nacional_siguiente";
 if($id_mat_prima_nacional_siguiente_contar == 4) $id_mat_prima_nacional_siguiente="00$id_mat_prima_nacional_siguiente";
 if($id_mat_prima_nacional_siguiente_contar == 5) $id_mat_prima_nacional_siguiente="0$id_mat_prima_nacional_siguiente";
 if($id_mat_prima_nacional_siguiente_contar == 6) $id_mat_prima_nacional_siguiente="$id_mat_prima_nacional_siguiente";
 $anook=substr($fhoy,2,4);
 $id_mat_prima_nacional_siguiente=$anook.$id_mat_prima_nacional_siguiente;
}

if($fecha_ingreso_in){
    $dat4_in=split(" ",$fecha_ingreso_in);
    $dat6_in=split("-",$dat4_in[0]);
    $fecha_ingreso_in="$dat6_in[2]-$dat6_in[1]-$dat6_in[0]";
	}else{
    $fecha_ingreso_in=date("Y-m-d"); 
    }//if($fecha_ingreso_in){
		
	if($fecha_despacho_in){
		$dat4_dess=split(" ",$fecha_despacho_in);
		$dat6_dess=split("-",$dat4_dess[0]);
		$fecha_despacho_in="$dat6_dess[2]-$dat6_dess[1]-$dat6_dess[0]";
	}//if($fecha_despacho_in){
		
	if($id_origen == 7 or $id_origen == 4)
	{
		$id_estado_materialotro = 2;
	}else{
		$id_estado_materialotro = 1;
	}
	
	

  //echo "dddd $fecha_faena3<br>";
  $dat4=split(" ",$fecha_faena3);
  $dat6=split("-",$dat4[0]);
  $fecha_faena1="$dat6[2]-$dat6[1]-$dat6[0]";
  $fecha_faena1qq="$dat6[2]-$dat6[1]-$dat6[0]";
  
  $dat7=split(" ",$fecha_termino3);
  $dat8=split("-",$dat7[0]);
  $fecha_termino1="$dat8[2]-$dat8[1]-$dat8[0]";
  //$fecha_termino1qq="$dat6[2]-$dat6[1]-$dat6[0]";
  
  
  //echo "$fecha_faena1qq<br>";

if($id_origen == 21 or $id_origen == 1000019)  {
    $dias=9;
  }elseif($id_origen == 6) {
    $dias=6;
  }else{
    $dias=11;
  }

  $fecha_venci = date("Y-m-d", strtotime("$fecha_faena1 + $dias day"));
  
   if($temperatura1=='')
    $temperatura1=0;
 
  if($rcp=='')
    $rcp=0;
  if($observaciones=='')
    $observaciones="Sin Observaciones";
   
   $fech_generada_inicio =date("Y-m-d H:i:s");
   $sql_nuevo="insert into mat_prima_nacional (id_mat_prima_nacional,id_operarios,id_origen,ano,id_producto,id_estado_material,comprobante_num,bidon_num,factura_mp,contenido,rcp,temperatura1,observaciones,fecha_faena,fecha_termino,fecha_venci,fecha_ingreso,fecha_salida,id_unidad_medida,id_medidas_productos,id_calibre,fech_generada_inicio,lote_trazabilidad) values ('$id_mat_prima_nacional_siguiente','$id_operarios','$id_origen','$fhoy','$id_producto','$id_estado_materialotro','$comprobante_num','$bidon_num','$factura_mp','$contenido','$rcp','$temperatura1','$observaciones','$fecha_faena1qq','$fecha_termino1','$fecha_venci','$fecha_ingreso_in','$fecha_despacho_in','$id_unidad_medida','$id_medidas_productos','$id_calibre','$fech_generada_inicio','$lote_trazabilidad')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  $ultimoidinsertado=mysql_insert_id();
 echo "$sql_nuevo";
  //echo "ultimoidinsertado $ultimoidinsertado";
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=fmpfresca.php&botmenu=1&fresca=N&id_mat_prima_nacional=$ultimoidinsertado&mantsec=$mantsec\">";
 exit;
 
}// fin modificar_x

if($modificarx){
  
 //echo "estoy en modificar $id_mat_prima_nacional";
  

  $dat3=split(" ",$fecha_despacho_in);
  $dat1=split("-",$dat3[0]);
  $fecha_salida2="$dat1[2]-$dat1[1]-$dat1[0]";
  
  $dat3=split(" ",$fecha_ingreso_in);
  $dat1=split("-",$dat3[0]);
  $fecha_ingreso_in="$dat1[2]-$dat1[1]-$dat1[0]";
  
  
  $dat4=split(" ",$fecha_faena3);
  $dat6=split("-",$dat4[0]);
  $fecha_faenad="$dat6[2]-$dat6[1]-$dat6[0]";
  
   $dat7=split(" ",$fecha_termino3);
  $dat8=split("-",$dat7[0]);
  $fecha_terminod="$dat8[2]-$dat8[1]-$dat8[0]";
  
  if($id_origen == 21 or $id_origen == 1000019)  {
    $dias=9;
  }elseif($id_origen == 6) {
    $dias=6;
  }else{
    $dias=11;
  }

  $fecha_venci = date("Y-m-d", strtotime("$fecha_faenad + $dias day"));
  
  if($id_estado_material != 2){
    $fecha='0000-00-00';
	$borrar=0;
  }
  
   if($id_estado_material == 2){
   $fecha=date("Y-m-d");
 }
 
 if($id_lineas_procesos=='')
    $id_lineas_procesos=0;


  
$sql_modificar="UPDATE  mat_prima_nacional set id_operarios='$id_operarios',id_origen='$id_origen', id_producto='$id_producto', comprobante_num='$comprobante_num', factura_mp='$factura_mp', bidon_num='$bidon_num', contenido='$contenido', rcp='$rcp', temperatura1='$temperatura1', observaciones='$observaciones',fecha_ingreso = '$fecha_ingreso_in', fecha_faena='$fecha_faenad',fecha_venci='$fecha_venci',fecha_termino='$fecha_terminod', fecha_salida ='$fecha_salida2', borrar = '$borrar', lote_trazabilidad = '$lote_trazabilidad' where id_mat_prima_nacional=$id_mat_prima_nacional ";
$rest=mysql_query($sql_modificar);
//echo "sql_modificar $sql_modificar<br>";
 if($id_mat_prima_nacional){
 echo"<meta http-equiv=\"refresh\"content=\"0;URL=sistema.php?modulo=fmpfresca.php&botmenu=1&fresca=N&id_mat_prima_nacional=$id_mat_prima_nacional\">";
 exit;
}
}

$sql="SELECT * FROM mat_prima_nacional where id_mat_prima_nacional = $id_mat_prima_nacional ";
$result=mysql_query($sql);
//$cuantos=mysql_num_rows($result);

?>
<h1>INGRESO DE MATERIA PRIMA FRESCA</h1>
<? if(!$nuevo){ ?>
  <?
  	
      if ($row=mysql_fetch_array($result))
      { 
	  	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
		$id_producto=$row[id_producto];
		$id_origen=$row[id_origen];
		$id_solicitud_mp=$row[id_solicitud_mp];
		$id_c_es_so=$row[id_c_es_so];
		$id_ldp=$row[id_ldp];
		$temperatura1=$row[temperatura1];
		//$id_origen=$row[id_origen];
		$id_estado_material=$row[id_estado_material];
		$id_operarios=$row[id_operarios];
		$fecha_ingreso_in=format_fecha_sin_hora($row[fecha_ingreso]);
		$fecha_despacho_in=format_fecha_sin_hora($row[fecha_salida]);
		$fecha_faena3=format_fecha_sin_hora($row[fecha_faena]);
		//echo "fecha_faena3 $fecha_faena3";
		$fecha_termino3=format_fecha_sin_hora($row[fecha_termino]);
		$fecha_venci3=format_fecha_sin_hora($row[fecha_venci]);
		$fecha_asig_producc=$row[fecha_asig_producc];
		$id_estado_material=$row[id_estado_material];
		$bidon_num=$row[bidon_num];
		$contenido=$row[contenido];
		$lote_trazabilidad=$row[lote_trazabilidad];
	 ?> 
    
<table width="800" border="0">
  <tr>
    <td>FOLIO MP</td>
    <td>:</td>
    <td><h4>F<? echo $id_mat_prima_nacional?></h4></td>
    <td>CONTENIDO</td>
    <td width="3">:</td>
    <td><input name="contenido" type="text" value="<? echo $row[contenido]?>" /></td>
  </tr>
  <tr>
    <td width="139">F/INGRESO</td>
    <td width="4">:</td>
    <td width="159"><input name="fecha_ingreso_in" type="text" id="fecha_ingreso_in"  value="<?echo $fecha_ingreso_in?>" size="10" maxlength="10" />
    <a href="javascript:show_Calendario('form1.fecha_ingreso_in');">Ver</a></td>
    <td width="93">N&ordm; BIDON</td>
    <td width="3">:</td>
    <td width="230"><? if($nuevo or $mantsec) { 
	   $bidon_num=$row[bidon_num];
	   $bidon_num=$bidon_num+1;
	?>
      <input name="bidon_num" type="text" value="<? echo $bidon_num?>" />
      <? }else{?>
      <input name="bidon_num" type="text" value="<? echo $row[bidon_num]?>" />
    <? }?></td>
  </tr>
  <tr>
    <td>F/FAENA</td>
    <td>:</td>
    <td><input name="fecha_faena3" type="text" id="fecha_faena3"  value="<?echo $fecha_faena3?>" size="10" maxlength="10" />
    <a href="javascript:show_Calendario('form1.fecha_faena3');">Ver</a></td>
    <td rowspan="2">T&ordm;</td>
    <td rowspan="2">:</td>
    <td rowspan="2"><input name="temperatura1" type="text" value="<? echo $row[temperatura1]?>" /></td>
  </tr>
  <tr>
    <td>F/TERMINO</td>
    <td>:</td>
    <td><input name="fecha_termino3" type="text" class="cajas" value="<? echo $fecha_termino3?>"  size="10" maxlength="10" />
    <a href="javascript:show_Calendario('form1.fecha_termino3');" class="cajas"  >Ver</a></td>
  </tr>
  <tr>
    <td>F/VENCIMIENTO</td>
    <td>:</td>
    <td>&nbsp;<? echo $fecha_venci3?></td>
    <td>ESTADO </td>
    <td>:</td>
    <td><? 
	   $estado_material=crea_estado_material($link,$id_estado_material);
	   echo $estado_material;
	 ?></td>
  </tr>
  <tr>
    <td>ORIGEN</td>
    <td>:</td>
    <td>  
	<?
	$s=$fresca;
	$origen= crea_origenes_ok($link,$id_origen,$s,0);
	echo $origen;
	?> 
    </td>
    <td>F/DESPACHO</td>
    <td>:</td>
    <td>
    <input name="fecha_despacho_in" type="text" id="fecha_despacho_in"  value="<?echo $fecha_despacho_in?>" size="10" maxlength="10" />
    <a href="javascript:show_Calendario('form1.fecha_despacho_in');">Ver</a>
    </td>
  </tr>
  <tr>
    <td>PRODUCTO</td>
    <td>:</td>
    <td>	<? 
			$producto= crea_producto_onChange_ok($link,$row[id_producto],0);
			echo $producto;
			?>
    </td>

            <td>LOTE TRAZA.</td>
            <td>:</td>
            <td><input name="lote_trazabilidad" type="text" value="<?echo $lote_trazabilidad?>"/></td>
            <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>UNIDAD</td>
    <td>:</td>
    <td><?
			if($id_producto){
            $unidad_medida= crea_unidad_medida_producto_ok($link,$id_producto);
			echo $unidad_medida;
			}else{
			echo "Sin asignar"; 
			}
			?></td>
    <td colspan="3" bgcolor="#CCCCCC">&nbsp;FOLIO ASOCIADO A:</td>
  </tr>
  <tr>
    <td>OPERARIO</td>
    <td>:</td>
    <td><? $operarios=crea_operarios($link,$row[id_operarios]);
				echo $operarios;?></td>
    <td colspan="3">&nbsp;<strong>LINEA PRODUCION:</strong>
      <? if($id_solicitud_mp){?>
      <? include "lib/ldp.php";?>
      <? }else{?>
NO
<? } ?> / <strong>Fecha Producci&oacute;n:&nbsp;<a href="?modulo=pproduccdetalle.php&amp;id_ldp=<? echo $id_ldp?>&amp;fecha_asig_producc=<? echo $fecha_asig_producc?>&tip=$tip"><? if($fecha_asig_producc != '0000-00-00'){ echo $fecha_asig_producc; }else{?></a>0000-00-00<? }?></strong></td>
  </tr>
  <tr>
    <td>FACTURA</td>
    <td>:</td>
    <td><input name="factura_mp" type="text" value="<?echo $row[factura_mp]?>"/></td>
    <td colspan="3">&nbsp;<strong>SOLICITUD N&ordm;: </strong>
      <? if($id_solicitud_mp){?><a href="?modulo=pendientesmpdetalle.php&amp;id_solicitud_mp=<? echo $id_solicitud_mp?>&amp;id_ldp=<? echo $id_ldp?>&amp;infomenu=1&tip=$tip"><? echo $id_solicitud_mp ?></a>
      <? }else{ ?>
NO
<? } ?>
<hr></td>
  </tr>
  <tr>
    <td>GUIA</td>
    <td>:</td>
    <td><input name="comprobante_num" type="text" value="<?echo $row[comprobante_num]?>"/></td>
    <td colspan="3">&nbsp;<strong>SOLICITUD CAMBIO ESTADO N&ordm;:</strong>
        <? if($id_c_es_so){?>
        <? echo $id_c_es_so ?>
         / <a href="?modulo=solicitudcdetalle.php&id_c_es_so=<? echo $id_c_es_so?>">Ir a solicitud Cambio Estado</a>
        <? }else{?>
        NO
        <? }?>     
    </td>
  </tr>
  <tr>
    <td>RCP</td>
    <td>:</td>
    <td><input name="rcp" type="text" id="rcp" value="<?echo $row[rcp]?>"/></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>OBSERVACIONES</td>
    <td>:</td>
    <td>&nbsp;</td>
    <td colspan="3"><? if($mantsec or $nuevo){?>
      <input type="checkbox" name="mantsec" value="1" checked="checked"/>
MANTENER SECUENCIA
<? } ?></td>
  </tr>
  <tr>
    <td colspan="5" valign="top"><textarea name="observaciones" id="observaciones" cols="60" rows="5" onkeyup="this.value = this.value.slice(0, 100)"><? echo $row[observaciones]?></textarea></td>
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
<table width="942" border="0">
<tr>
            <td width="136">F/FAENA</td>
            <td width="4">:</td>
            <td width="190"><input name="fecha_faena3" type="text" id="fecha_faena3"  value="<?echo $fecha_faena3?>" size="10" maxlength="10" /><a href="javascript:show_Calendario('form1.fecha_faena3');"> Ver</a></td>
            <td width="93">FACTURA</td>
            <td width="3">:</td>
            <td width="231"><input name="factura_mp" type="text" value="<?echo $factura_mp?>"/></td>
            <td width="117"><? if($id_origen == 7 or $id_origen == 4){?>F/INGRESO<? } ?></td>
            <td width="3"><? if($id_origen == 7 or $id_origen == 4){?>:<? }?></td>
            <td width="127"><? if($id_origen == 7 or $id_origen == 4){?><input name="fecha_ingreso_in" type="text" id="fecha_ingreso_in"  value="<?echo $fecha_ingreso_in?>" size="10" maxlength="10" /><a href="javascript:show_Calendario('form1.fecha_ingreso_in');"> Ver</a><? } ?></td>
  </tr>
<tr>
  <td>F/TERMINO</td>
  <td width="4">:</td>
  <td width="190"><input name="fecha_termino3" type="text" class="cajas" value="<? echo $fecha_termino3?>"  size="10" maxlength="10" />
    <a href="javascript:show_Calendario('form1.fecha_termino3');" class="cajas"  >Ver</a></td>
  <td width="93">GUIA</td>
  <td width="3">:</td>
  <td width="231"><input name="comprobante_num" type="text" value="<?echo $comprobante_num?>"/></td>
  <td width="117"><? if($id_origen == 7 or $id_origen == 4){?>F/DESPACHO<? } ?></td>
  <td width="3"><? if($id_origen == 7 or $id_origen == 4){?>:<? } ?></td>
  <td><? if($id_origen == 7 or $id_origen == 4){?><input name="fecha_despacho_in" type="text" id="fecha_despacho_in"  value="<?echo $fecha_despacho_in?>" size="10" maxlength="10" /><a href="javascript:show_Calendario('form1.fecha_despacho_in');"> Ver</a><? } ?></td>
</tr>
          <tr>
            <td>ORIGEN</td>
            <td>:</td>
            <td><? 
			$s=$fresca;
			$origen= crea_origenes_ok($link,$id_origen,$s,1);
			echo $origen;
			?></td>
            <td>RCP</td>
            <td>:</td>
            <td><input name="rcp" type="text" id="rcp2" value="<?echo $rcp?>"/></td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td>PRODUCTO</td>
            <td>:</td>
            <td><? 
			$producto= crea_producto_onChange_ok($link,$id_producto,1);
			echo $producto;
			?></td>
            <td>CONTENIDO</td>
            <td>:</td>
            <td><input name="contenido" type="text" value="<? echo $contenido?>" /></td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td>UNIDAD</td>
            <td>&nbsp;</td>
            <td><?
			if($id_producto){
            $unidad_medida= crea_unidad_medida_producto_ok($link,$id_producto);
			echo $unidad_medida;
			}else{
			echo "Sin asignar"; 
			}
			?></td>
            <td>N&ordm; BIDON</td>
            <td>:</td>
            <td><?
				if($id_origen){
			
				$sqlorg="SELECT * FROM mat_prima_nacional WHERE id_origen ='$id_origen' ORDER BY bidon_num DESC LIMIT 0,1";
		    	$resultsql=mysql_query($sqlorg);
		    	$cuantosorg=mysql_num_rows($resultsql);
				//echo "sqlorg $sqlorg<br>";
		   	 	if($cuantosorg)
		    	{   $cuentab2=0;
		    		if ($roworg=mysql_fetch_array($resultsql))
      				{	 
      				$cuentab2=$roworg[bidon_num];
					$bidon_num2=$cuentab2+1;
					}
					
			?>
              <input name="bidon_num2" type="text" value="<?echo $bidon_num2?>"/>
              <? }else{ ?>
              <input name="bidon_num2" type="text" value="<?echo $bidon_num2?>"/>
            <? }
             
             }else{
              echo "Sin asignar"; 
             } ?></td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td>OPERARIO</td>
            <td>:</td>
            <td><? $operarios=crea_operarios($link,$id_operarios);
				echo $operarios;?></td>

            <td>LOTE TRAZA.</td>
            <td>:</td>
            <td><input name="lote_trazabilidad" type="text" id="lote_trazabilidad" value="<?echo $lote_trazabilidad?>"/></td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td>TEMPERATURA (T&ordm;) </td>
            <td>:</td>
            <td><input name="temperatura1" type="text" value="<? echo $temperatura1?>" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4"><? if(!$mantsec or $nuevo){?>
              <input type="checkbox" name="mantsec" value="1" />
              <? } ?>
MANTENER SECUENCIA</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="6" align="right"><!--<img src="images/trazabalidad.jpg" width="62" height="36" border="0" />--></td>
          </tr>
          <tr>
            <td>OBSERVACIONES</td>
            <td>:</td>
            <td>&nbsp;</td>
            <td colspan="6" align="right">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5"><textarea name="observaciones" id="observaciones" cols="60" rows="5" onkeyup="this.value = this.value.slice(0, 100)"><? echo $observaciones?></textarea></td>
            <td align="right"><input type="submit" name="guardax" id="guardax" value="Guardar"></td>
            <td colspan="3" align="right">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="9">M&aacute;ximo de caracteres permitidos [100]</td>
          </tr>
</table>
<? } ?>
