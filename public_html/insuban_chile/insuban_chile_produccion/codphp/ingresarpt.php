<?
if($modificarx){
	
  $dat4=split(" ",$fecha_termino);
  $dat6=split("-",$dat4[0]);
  $fecha_faena1="$dat6[2]-$dat6[1]-$dat6[0]";
  $ann=$dat6[2];
  $ank=$ann+1;
  $dias=1;
  $fecha_faena2ff="$ank-$dat6[1]-$dat6[0]";
  $fecha_vencimiento1 = date("Y-m-d", strtotime("$fecha_faena2ff + $dias day"));
  $dat2=split(" ",$fecha_elaboracion);  $dat=split("-",$dat2[0]);  $f_elaboracion1="$dat[2]-$dat[1]-$dat[0]";
  $dat3=split(" ",$fecha_inicio);  $dat1=split("-",$dat3[0]);  $f_inicio1="$dat1[2]-$dat1[1]-$dat1[0]";
  $dat4=split(" ",$fecha_termino);  $dat6=split("-",$dat4[0]);  $f_termino1="$dat6[2]-$dat6[1]-$dat6[0]";
	
	$sql_modificar="UPDATE etiquetados_folios set contenido_unidades='$contenido',f_elaboracion='$f_elaboracion1', f_inicio='$f_inicio1',f_termino='$f_termino1', f_vencimiento='$fecha_vencimiento1', id_operarios='$id_operarios', id_envases = '$id_envases',notas='$notas'  where id_etiquetados_folios=$id_etiquetados_folios";
$rest=mysql_query($sql_modificar);
//echo "sql_modificar $sql_modificar<br>";	
}

$sql="SELECT * FROM etiquetados_folios where id_etiquetados_folios ='$id_etiquetados_folios'";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
?>
<h1>INGRESO PRODUCTO TERMINADO</h1>
<? if(!$nuevo){
	
 if ($row=mysql_fetch_array($result))
      { 
    $id_etiquetados_folios=$row[id_etiquetados_folios];
	  $id_cruce_tablasok=$row[id_cruce_tablas];
	  $id_operarios=$row[id_operarios];
	  $id_envases=$row[id_envases];
	  $contenido=$row[contenido_unidades];
	  $id_c_es_so=$row[id_c_es_so];
	  $observaciones=$row[notas];
	  $fecha_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	  $fecha_inicio=format_fecha_sin_hora($row[f_inicio]);
	  $fecha_termino=format_fecha_sin_hora($row[f_termino]);
	  $f_vencimiento=format_fecha_sin_hora($row[f_vencimiento]);
	  
?>
<table width="738" border="0" cellpadding="0">
  <tr>
    <td width="154">A&Ntilde;O <? echo substr($row[ano],0,4); ?></td>
    <td width="4">&nbsp;</td>
    <td width="148">&nbsp;<?echo $row[folio_m3]?></td>
    <td>TIPO ENVASE</td>
    <td>:</td>
    <td width="104"><? $envases=crea_envases_uno($link,$id_envases);	echo $envases; ?></td>
    <td width="15">&nbsp;</td>
    <td width="161">&nbsp;</td>
  </tr>
  <tr>
    <td> CODIGO</td>
    <td>:</td>
   <td>&nbsp;<? echo $id_cruce_tablasok?><? if($id_c_es_so){?>    
   <img src="codphp/jpgnew/canrojo.png" width="16" height="16" border="0" />
        <? }else{?>
<a href="javascript:Abrir_ventana_nueva('codphp/codlis.php?id_spt=<? echo "$id_etiquetados_folios";?>')"> [Modificar]</a>
    <? }?></td><?
				$sqlb="SELECT  * from cruce_tablas where id_cruce_tablas = $id_cruce_tablasok";
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
				
               	?>
    <td>F/FAENA</td>
    <td>:</td>
    <td><input name="fecha_elaboracion" type="text" id="fecha_elaboracion"  value="<?echo $fecha_elaboracion?>" size="10" maxlength="10" /> <a href="javascript:show_Calendario('form1.fecha_elaboracion');">Ver</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <? if($cuantosb){?>
  <tr>
    <td>ESPECIE</td>
    <td>:</td>
    <td>&nbsp;<? $especie= crea_especie_codificacion($link,$id_especieb,1,1); echo $especie; ?></td>
    <td width="125">F/INICIO</td>
    <td width="12">:</td>
    <td><input name="fecha_inicio" type="text" id="fecha_inicio"  value="<?echo $fecha_inicio?>" size="10" maxlength="10" />
    <a href="javascript:show_Calendario('form1.fecha_inicio');">Ver</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>PRODUCTO</td>
    <td>:</td>
    <td>&nbsp;<? $producto_especie= crea_producto_especie_codificacion($link,$id_especieb,$id_productob,1,1); echo $producto_especie; ?></td>
    <td>F/TERMINO</td>
    <td>:</td>
    <td><input name="fecha_termino" type="text" id="fecha_termino"  value="<?echo $fecha_termino?>" size="10" maxlength="10" />
    <a href="javascript:show_Calendario('form1.fecha_termino');">Ver</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>CALIBRE</td>
    <td>:</td>
    <td>&nbsp;<?  $producto_calibre= crea_producto_calibre_codificacion($link,$id_productob,$id_calibreb,1,1); echo $producto_calibre;?></td>
    <td>F/VENCIMIENTO</td>
    <td>:</td>
    <td><input name="f_vencimiento" type="text" id="f_vencimiento"  value="<?echo $f_vencimiento?>" size="10" maxlength="10" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>UNIDAD MEDIDA</td>
    <td>:</td>
    <td>&nbsp;<?  $producto_unidad_medida= crea_producto_unidad_medida_codificacion($link,$id_productob,$id_unidad_medidab,1,1); echo $producto_unidad_medida;?></td>
    <td>CONTENIDO</td>
    <td>:</td>
    <td><input name="contenido" type="text" value="<? echo $contenido?>" size="10" maxlength="10" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MEDIDA</td>
    <td>:</td>
    <td>&nbsp;<?  $producto_medida= crea_producto_medida_codificacion($link,$id_productob,$id_medidas_productosb,1,1); echo $producto_medida;?></td>
    <td>OPERARIO</td>
    <td align="right">&nbsp;</td>
    <td><? $operarios=crea_operarios_etiplan($link,$id_operarios,1); echo $operarios;?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>CARACT/PRODUCTO</td>
    <td>:</td>
    <td>&nbsp;<?  $producto_caract_producto= crea_producto_caract_codificacion($link,$id_productob,$id_caract_productob,1,1);  echo $producto_caract_producto;?></td>
    <td colspan="4" bgcolor="#CCCCCC">&nbsp;FOLIO ASOCIADO A:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="22">CARACT/ENVASE</td>
    <td>:</td>
    <td>&nbsp;<?  $producto_caract_producto= crea_producto_caract_envases($link,$id_productob,$id_caract_envasesb,1,1); echo $producto_caract_producto;?></td>
    <td colspan="4" rowspan="2" valign="top">&nbsp;<strong>SOLICITUD CAMBIO ESTADO N&ordm;:
        <? if($id_c_es_so){?>
        <? echo $id_c_es_so ?> / <a href="?modulo=solicitudcdetalle.php&amp;id_c_es_so= <? echo $id_c_es_so?>">Ir a solicitud Cambio Estado</a>
        <? }else{?>
        NO
        <? }?>
    </strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>OBSERVACIONES</strong></td>
    <td>:</td>
    <td>&nbsp;</td>
    <td rowspan="2"><? if($id_c_es_so){?>
      <img src="codphp/jpgnew/canrojo.png" width="16" height="16" border="0" />
      <? }else{?>
      <input type="submit" name="modificarx" id="modificarx" value="Modificar" />
    <? }?></td>
  </tr>
  <tr>
    <td colspan="4"><textarea name="notas" id="notas" cols="60" rows="5" onkeyup="this.value = this.value.slice(0, 100)"><? echo $observaciones?></textarea></td>
    <td align="right">&nbsp;</td>
    <td align="right"><div align="center"><a href="javascript:Abrir_ventana_nueva('codphp/ver_trazabilidad_mp.php?id_etiquetados_folios=<? echo $id_etiquetados_folios?>&amp;fecha_elaboracion=<? echo $fecha_elaboracion?>&amp;fecha_termino=<? echo $fecha_termino;?>&amp;id_cruce_tablasb=<? echo $id_cruce_tablasb?>&amp;id_productob=<? echo $id_productob?>&amp;fecha_inicio=<?echo $fecha_inicio?>&amp;id_operarios=<? echo $id_operarios?>&amp;contenido=<? echo $contenido?>&amp;id_procedencia=<? echo "N"; ?>')" class="titulo"><img src="images/trazabalidad.jpg" border="0" /></a></div></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <? }?>
</table>
<? }

}?>
<? if($nuevo){?>
<table width="738" border="0">
  <tr>
    <td width="152">&nbsp;</td>
    <td width="3">&nbsp;</td>
    <td width="144">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="99">&nbsp;</td>
    <td width="182">&nbsp;</td>
  </tr>
  <tr>
    <td>INGRESAR CODIGO PT</td>
    <td>:</td>
    <td><input name="codigo" type="text" id="codigo" value="<?echo $codigo?>" size="10" maxlength="10"/></td>
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
    <td colspan="2"><input name="vercodnuevo" type="submit" id="vercodnuevo" value="ver Codigo" /></td>
    <td><? if($cuantosb == '0'){ echo "Codigo PT no esxiste";}?></td>
    <td>&nbsp;</td>
  </tr>
  <? if($cuantosb){?>
  <tr>
    <td>ESPECIE</td>
    <td>:</td>
    <td><? $especie= crea_especie_codificacion($link,$id_especieb,1,1); echo $especie; ?></td>
    <td width="125" align="right">TIPO ENVASE</td>
    <td width="3">:</td>
    <td><? $envases=crea_envases_uno($link,$id_envases);	echo $envases; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>PRODUCTO</td>
    <td>:</td>
    <td><? $producto_especie= crea_producto_especie_codificacion($link,$id_especieb,$id_productob,1,1); echo $producto_especie; ?></td>
    <td align="right">F/FAENA</td>
    <td>:</td>
    <td><input name="fecha_elaboracion" type="text" id="fecha_elaboracion"  value="<?echo $fecha_elaboracion?>" size="10" maxlength="10" />
      <a href="javascript:show_Calendario('form1.fecha_elaboracion');">Ver</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>CALIBRE</td>
    <td>:</td>
    <td><?  $producto_calibre= crea_producto_calibre_codificacion($link,$id_productob,$id_calibreb,1,1); echo $producto_calibre;?></td>
    <td align="right">F/INICIO</td>
    <td>:</td>
    <td><input name="fecha_inicio" type="text" id="fecha_inicio"  value="<?echo $fecha_inicio?>" size="10" maxlength="10" />
      <a href="javascript:show_Calendario('form1.fecha_inicio');">Ver</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>UNIDAD MEDIDA</td>
    <td>:</td>
    <td><?  $producto_unidad_medida= crea_producto_unidad_medida_codificacion($link,$id_productob,$id_unidad_medidab,1,1); echo $producto_unidad_medida;?></td>
    <td align="right">F/TERMINO</td>
    <td>:</td>
    <td><input name="fecha_termino" type="text" id="fecha_termino"  value="<?echo $fecha_termino?>" size="10" maxlength="10" />
      <a href="javascript:show_Calendario('form1.fecha_termino');">Ver</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MEDIDA</td>
    <td>:</td>
    <td><?  $producto_medida= crea_producto_medida_codificacion($link,$id_productob,$id_medidas_productosb,1,1); echo $producto_medida;?></td>
    <td align="right">CONTENIDO</td>
    <td align="right">:</td>
    <td><input name="contenido" type="text" value="<? echo $contenido?>" size="10" maxlength="10" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>CARACT/PRODUCTO</td>
    <td>:</td>
    <td><?  $producto_caract_producto= crea_producto_caract_codificacion($link,$id_productob,$id_caract_productob,1,1);  echo $producto_caract_producto;?></td>
    <td align="right">OPERARIO</td>
    <td align="right">:</td>
    <td><? $operarios=crea_operarios_etiplan($link,$id_operarios,1); echo $operarios;?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="22">CARACT/ENVASE</td>
    <td>:</td>
    <td><?  $producto_caract_producto= crea_producto_caract_envases($link,$id_productob,$id_caract_envasesb,1,1); echo $producto_caract_producto;?></td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">
   <? if($codigo and $contenido != 0 and $id_operarios != 0 and  $id_envases != 0){?>
                        <div align="center"><a href="javascript:Abrir_ventana_nueva('codphp/insertar_trazabilidad_mp.php?fecha_elaboracion=<? echo $fecha_elaboracion?>&amp;fecha_termino=<? echo $fecha_termino;?>&amp;id_cruce_tablasb=<? echo $id_cruce_tablasb?>&amp;id_especie=<? echo $id_especie?>&amp;id_unidad_medida=<? echo $id_unidad_medida?>&amp;id_caract_producto=<? echo $id_caract_producto?>&amp;id_caract_envases=<? echo $id_caract_envases?>&amp;id_productob=<? echo $id_productob?>&amp;id_calibre=<? echo $id_calibre?>&amp;id_medidas_productos=<? echo $id_medidas_productos?>&amp;id_envases=<? echo $id_envases?>&amp;fecha_inicio=<?echo $fecha_inicio?>&amp;id_operarios=<? echo $id_operarios?>&amp;contenido=<? echo $contenido?>&amp;id_procedencia=<? echo "N"; ?>')" class="titulo"><img src="images/trazabalidad.jpg" border="0" /></a></div>
                        
                        
                        <? } ?>
    </td>
    <td align="right">&nbsp;</td>
  </tr>
  <? }?>
</table>
<? } //if($nuevo){?>