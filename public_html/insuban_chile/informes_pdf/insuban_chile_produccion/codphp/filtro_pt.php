<table width="100%" border="0">
     <tr>
       <td width="73" nowrap="nowrap">
	   <? $procedencia= crea_procedencia($link,$id_procedencia,1);
		  echo $procedencia;
	   ?></td>
       <td width="96">
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
	   ?></td>
       <td width="96">
	   <? 
	   if($id_producto){
		$s=$id_procedencia;
		$origen= crea_origenes_ok_filtro_new($link,$id_origen,$id_producto,$s,1);
	    echo $origen;
		}
	/*   if($id_procedencia and $id_origen){
			$producto= crea_producto_ok_filtro_new($link,$s,$id_origen);
			echo $producto;
	   }*/
			?></td>
       <td width="124" align="right"><? if($s == 'I'){?>FACTURA IMP:<? } if($s== 'N'){?>FACTURA NAC:<? } ?></td>
       <td width="86">
	   <? if($s == 'I'){?>
       <input name="comprobante_num" type="text" id="comprobante_num" value="<? echo $comprobante_num?>" size="8" maxlength="10" />
	   <? } ?>
       <? if($s== 'N'){?>
       <input name="factura_mp" type="text" id="factura_mp" value="<? echo $factura_mp?>" size="8" maxlength="10" />
	   <? } ?></td>
       <td width="78" align="right"><? if($s== 'N'){?>GUIA NAC:<? }?><? if($s == 'I'){?>GUIA IMP:<? } ?>
</td>
       <td width="83">
	   <? if($s == 'I'){?>
       <input name="guia_imp" type="text" id="guia_imp" value="<? echo $guia_imp?>" size="8" maxlength="10" />
       <? }?>
       <? if($s== 'N'){?>
       <input name="comprobante_num" type="text" id="comprobante_num" value="<? echo $comprobante_num?>" size="8" maxlength="10" />
       <? } ?></td>
       <td width="94"><? if($s){?>
         F/ENTREGA:
       <? } ?></td>
       <td width="126"><?  if($s){?>
         <input name="fechaentreg" type="text" id="fechaentreg"  value="<?echo $fechaentreg?>" size="8" maxlength="10" />
         <a href="javascript:show_Calendario('form1.fechaentreg');">Ver</a>
       <? } ?></td>
       <td width="54"><? if($s){?>
         <input type="submit" name="buscar" id="buscar" value="Buscar" />
       <? } ?></td>
  </tr>
   </table>