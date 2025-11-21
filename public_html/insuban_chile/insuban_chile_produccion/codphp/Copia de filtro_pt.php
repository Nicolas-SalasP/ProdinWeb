<table width="109%" border="0">
     <tr>
       <td width="17" nowrap="nowrap">
	   <? $procedencia= crea_procedencia($link,$id_procedencia,1);
		  echo $procedencia;
	   ?></td>
       <td width="1" nowrap="nowrap">&nbsp;</td>
       <td width="17" nowrap="nowrap">
	   <? 
	   
	   if($id_procedencia){
	   $s=$id_procedencia;
	   $producto= crea_producto_ok_filtro_new($link,$s,$id_producto,1);
	   echo $producto;
	   }
	   
	    /*if($id_procedencia){
		$s=$id_procedencia;
		$origen= crea_origenes_ok_filtro_new($link,$id_origen,$s,1);
	    echo $origen;
		}*/
		
		if($id_producto){
		$s=$id_procedencia;
		$origen= crea_origenes_ok_filtro_new($link,$id_origen,$id_producto,$s,1);
	    echo $origen;
		}
		
	   ?></td>
       <td width="1" nowrap="nowrap">&nbsp;</td>
       <td width="17" nowrap="nowrap">
	   <? 
	/*   if($id_procedencia and $id_origen){
			$producto= crea_producto_ok_filtro_new($link,$s,$id_origen);
			echo $producto;
	   }*/
			?></td>
       <td width="1" nowrap="nowrap">&nbsp;</td>
       <td width="303" align="right" nowrap="nowrap"><? if($s == 'I' and $id_producto and $id_origen){?>
FACTURA IMP:
 
  <? } if($s== 'N' and $id_producto and $id_origen){?>
FACTURA NAC:

<? } ?></td>
       <td width="86" nowrap="nowrap">
	   <? if($s == 'I' and $id_producto and $id_origen){?>
       <input name="comprobante_num" type="text" id="comprobante_num" value="<? echo $comprobante_num?>" size="8" maxlength="10" />
	   <? } ?>
       <? if($s== 'N' and $id_producto and $id_origen){?>
       <input name="factura_mp" type="text" id="factura_mp" value="<? echo $factura_mp?>" size="8" maxlength="10" />
	   <? } ?></td>
       <td width="223" align="right" nowrap="nowrap">
	     <? 
	    if($s== 'N' and $id_producto and $id_origen){?>
		GUIA NAC:
		<? }?>
		<? if($s == 'I' and $id_producto and $id_origen){?>
	    GUIA IMP:
		<? } ?>
</td>
       <td width="184" nowrap="nowrap">
	   <? if($s == 'I' and $id_producto and $id_origen){?>
       <input name="guia_imp" type="text" id="guia_imp" value="<? echo $guia_imp?>" size="8" maxlength="10" />
       <? }?>
       <? if($s== 'N' and $id_producto and $id_origen){?>
       <input name="comprobante_num" type="text" id="comprobante_num" value="<? echo $comprobante_num?>" size="8" maxlength="10" />
       <? } ?></td>
       <td width="207" nowrap="nowrap">
	   <? if($id_producto and $id_origen){?><input type="submit" name="buscar" id="buscar" value="Buscar" /><? } ?></td>
  </tr>
     <tr>
       <td nowrap="nowrap">&nbsp;</td>
       <td nowrap="nowrap">&nbsp;</td>
       <td nowrap="nowrap">&nbsp;</td>
       <td nowrap="nowrap">&nbsp;</td>
       <td nowrap="nowrap">&nbsp;</td>
       <td nowrap="nowrap">&nbsp;</td>
       <td align="right" nowrap="nowrap"><? if($id_producto and $id_origen){?>CONTENIDO:<? } ?></td>
       <td nowrap="nowrap"><? if($id_producto and $id_origen){?><input name="unidadessolicitadas" type="text" id="unidadessolicitadas" value="<? echo $unidadessolicitadas?>" size="8" maxlength="10" /><? } ?></td>
       <td align="right" nowrap="nowrap"><? if($id_producto and $id_origen){?>F/ENTREGA:<? } ?></td>
       <td nowrap="nowrap"><?  if($id_producto and $id_origen){?>
         <input name="fechaentreg" type="text" id="fechaentreg"  value="<?echo $fechaentreg?>" size="8" maxlength="10" />
         <a href="javascript:show_Calendario('form1.fechaentreg');">Ver</a>
       <? } ?></td>
       <td nowrap="nowrap">&nbsp;</td>
  </tr>
   </table>