<?
if($felabaracd) { $felabaracdok=format_fecha_sin_hora($felabaracd); }
if($felabarach) { $felabarachok=format_fecha_sin_hora($felabarach); }
if($finiciod) { $finiciodok=format_fecha_sin_hora($finiciod); }
if($finicioh) { $finiciohok=format_fecha_sin_hora($finicioh); }
if($fidterminod) { $fidterminodok=format_fecha_sin_hora($fidterminod); }
if($fidterminoh) { $fidterminohok=format_fecha_sin_hora($fidterminoh); }

$sql="SELECT * FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um,  caract_producto AS carpro, caract_envases AS carenv, operarios AS o, origenes AS orig, estado_folio AS e where  ef.id_etiquetados_folios=ef.id_etiquetados_folios and ef.id_producto = p.id_producto and ef.id_calibre = c.id_calibre  and ef.id_medidas_productos = mpro.id_medidas_productos  and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 and ef.id_origen = orig.id_origen and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio and ef.id_estado_folio != 7 and ef.id_estado_folio != 5 and ef.id_estado_folio != 6 and ef.id_estado_folio != 10 and ef.id_estado_folio != 9 and ef.id_estado_folio != 8 and ef.id_estado_folio != 4 and ef.id_estado_folio != 3 and ef.id_estado_folio != 2 and ef.id_estado_folio != 11
and ef.id_procedencia = 'N' ";

if($id_producto){ $sql.= " and p.id_producto = '$id_producto'";}
if($id_calibre){ $sql.= " and c.id_calibre = '$id_calibre'";}
if($id_unidad_medida){ $sql.= " and um.id_unidad_medida = '$id_unidad_medida' ";}
if($id_caract_envases){ $sql.= " and carenv.id_caract_envases = '$id_caract_envases' ";}
if($id_caract_producto){ $sql.= " and carpro.id_caract_producto = '$id_caract_producto' ";}
if($id_medidas_productos){ $sql.= " and mpro.id_medidas_productos = '$id_medidas_productos' ";}
if($felabaracdok or $felabarachok){ $sql.= " and ef.f_elaboracion between '$felabaracdok' and '$felabarachok' ";}
if($finiciodok or $finiciohok){ $sql.= " and ef.f_inicio between '$finiciodok' and '$finiciohok' ";}
if($fidterminodok or $fidterminohok){ $sql.= " and ef.f_termino between '$fidterminodok' and '$fidterminohok' ";}
$sql.= " order by ef.id_etiquetados_folios, c.condicion_cod_barra, c.calibre desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
echo "sql $sql<br>";
?>
<h1>STOCK DE PRODUCTO TERMINADO</h1>
<table width="99%" border="0">
 <tr>
   <td height="8" colspan="12"><table width="98%" border="0" align="center">
     <tr>
       <td valign="top" nowrap="nowrap"><table width="219" border="0">
         <tr>
           <td width="213">&nbsp;<? 
					  $producto= crea_producto_onChange_segunestado($link,2,$id_producto);
				  	  echo $producto;
					  ?></td>
         </tr>
         <tr>
           <td>&nbsp;<? if ($id_producto) {
		$calibre=crea_calibre_filtro($link,$id_calibre,$id_producto,1);
		echo $calibre;
		   
		   }
		   ?>
           </td>
         </tr>
         <tr>
           <td>&nbsp;<? 
		   if ($id_producto) {
						$unidad_medida=crea_unidad_medida_filtro($link,$id_unidad_medida,$id_producto,1);
					echo $unidad_medida;
					}
		   ?></td>
         </tr>
         <tr>
           <td>&nbsp;<?  if ($id_producto) {
					$medidas_productos=crea_medidas_productos_filtro($link,$id_medidas_productos,$id_producto,1);
					echo $medidas_productos;
					}
					?></td>
         </tr>
         <tr>
           <td>&nbsp;<? 
		    if ($id_producto) {
					$caract_producto=crea_caract_producto_filtro($link,$id_caract_producto,$id_producto,1);
					echo $caract_producto;
					}
					
		   ?></td>
         </tr>
         <tr>
           <td>&nbsp;<? 
		    if ($id_producto) {
					$caract_envases=crea_caract_envases_filtro($link,$id_caract_envases,$id_producto,1);
					echo $caract_envases;
					}
		   ?></td>
         </tr>
         <tr>
           <td>&nbsp;</td>
         </tr>
       </table></td>
       <td valign="top" nowrap="nowrap"><table width="298" border="0">
         <tr>
           <td colspan="3" bgcolor="#CCCCCC">&nbsp;Buscar por Fechas</td>
         </tr>
         <tr>
           <td width="81">F/FAENA:</td>
           <td width="108"><input name="felabaracd" type="text" id="felabaracd" value="<? echo $felabaracd?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.felabaracd');"> ver</a></td>
           <td width="87"><input name="felabarach" type="text" id="felabarach" value="<? echo $felabarach?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('felabarach.fih');"> ver</a></td>
         </tr>
         <tr>
           <td>F/INICIO:</td>
           <td><input name="finiciod" type="text" id="finiciod" value="<? echo $finiciod?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.finiciod');"> ver</a></td>
           <td><input name="finicioh" type="text" id="finicioh" value="<? echo $finicioh?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.finicioh');"> ver</a></td>
         </tr>
         <tr>
           <td>F/TERMINO:</td>
           <td><input name="fidterminod" type="text" id="fidterminod" value="<? echo $fidterminod?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fidterminod');"> ver</a></td>
           <td><input name="fidterminoh" type="text" id="fidterminoh" value="<? echo $fidterminoh?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fidterminoh');"> ver</a></td>
         </tr>
         <tr>
           <td>F/VENCIMIENTO:</td>
           <td><input name="fidvencid" type="text" id="fidvencid" value="<? echo $fidvencid?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fidvencid');"> ver</a></td>
           <td><input name="fidvencih" type="text" id="fidvencih" value="<? echo $fidvencih?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fidvencih');"> ver</a></td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
       </table></td>
       <td valign="top" nowrap="nowrap"><table width="348" border="0">
         <tr>
           <td colspan="2" bgcolor="#CCCCCC">&nbsp;Filtros de Venta</td>
         </tr>
         <tr>
           <td width="106">&nbsp;Factura Venta</td>
           <td><input name="felabaracd2" type="text" id="felabaracd2" value="<? echo $factura_venta?>" size="15" maxlength="10" /></td>
           </tr>
         <tr>
           <td>&nbsp;Gu&iacute;a Despacho</td>
           <td><input name="felabaracd3" type="text" id="felabaracd3" value="<? echo $guia_despacho?>" size="15" maxlength="10" /></td>
           </tr>
         <tr>
           <td colspan="2">&nbsp;</td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td nowrap="nowrap">&nbsp;</td>
       <td nowrap="nowrap">&nbsp;</td>
       <td align="center" nowrap="nowrap"><input type="submit" name="buscar" id="buscar" value="Buscar" /></td>
     </tr>
   </table></td>
  </tr>
 <tr>
   <td height="9" colspan="12">Nota: Folios de producto terminado en los siguientes estados: Bodega, Emitido.</td>
 </tr>
 <? if($cuantos and $buscar){?>
 <tr>
    <td width="21" height="19" bgcolor="#FF9933"><center></center></td>
    <td colspan="11" bgcolor="#CCCCCC"><strong>&nbsp;Cantidad <? echo $cuantos?></strong></td>
  </tr>
  <tr>
    <td width="21" height="19" nowrap="nowrap" bgcolor="#FF9933">&nbsp;N&ordm;</td>
    <td width="53" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="39" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;COD</strong></td>
    <td width="133" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="79" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong>
    </td>
    <td width="87" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;UNID/MED</strong></td>
    <td width="90" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;MEDIDAS</strong></td>
    <td width="97" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CARAC/PRO</strong></td>
    <td width="97" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CARAC/ENV</strong></td>
    <td width="101" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="94" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;OPERADOR</strong></td>
    <td width="128" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
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
	$id_c_es_so=$row[id_c_es_so];
	$producto=$row[producto];
	$calibre=$row[calibre];
	$unidad_medida=$row[unidad_medida];
	$medidas_productos=$row[medidas_productos];
	$caract_producto=$row[caract_producto];
	$caract_envases=$row[caract_envases];
	$contenido_unidades=$row[contenido_unidades];
	$origen=$row[origen];
	$estado_folio=$row[estado_folio];
	
  ?>
  <tr>
    <td height="19" align="center" nowrap="nowrap" bgcolor="<? echo $color?>"><strong><? echo $i?></strong></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=ingresarpt.php&id_etiquetados_folios=<? echo $id_etiquetados_folios?>">P<? echo $id_etiquetados_folios?></a></td>
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
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? $est = strtoupper($row[estado_folio]); echo $est ?>
     <? if($id_solicitud_mp or $id_c_es_so){?>
    <img src="codphp/jpgnew/canrojo.png" width="16" height="16" border="0" />
    <? }else{?>
    <img src="codphp/jpgnew/canverde.png" width="16" height="16" border="0" />
    <? }?>
    </td>
  </tr>
  <?
	}
	}
  ?>
</table>