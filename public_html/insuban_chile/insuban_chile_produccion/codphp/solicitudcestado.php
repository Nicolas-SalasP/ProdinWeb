<h1>SOLICITUD CAMBIO ESTADO</h1>
<table width="912" border="0">
  <tr>
    <td width="906" nowrap="nowrap">&nbsp;<? 
			$cambio_estado= crea_cambio_estado_ok($link,$id_ce,1);
			echo $cambio_estado;
			?></td>
    <!--<td width="84" nowrap="nowrap">F/ENTREGA</td>
       <td width="91" nowrap="nowrap"><input name="fechaentreg" type="text" id="fechaentreg"  value="<?echo $fechaentreg?>" size="10" maxlength="10" /><a href="javascript:show_Calendario('form1.fechaentreg');">Ver</a></td>-->
  </tr>
  <tr>
    <td nowrap="nowrap">&nbsp;
	  <? 
	   if($id_ce == 1){
		include "solicitudcestado_mp.php";
	   }
	   if($id_ce == 3){
		  include "solicitudcestado_pt.php";
	   }
	  ?></td>
  </tr>
  <tr>
    <td nowrap="nowrap">&nbsp;</td>
  </tr>
</table>
