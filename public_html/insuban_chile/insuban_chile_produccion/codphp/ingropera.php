<?
$fecha_ingreso=date("Y-m-d"); 
		 
if($guardax){
	
			   $sqlldp="SELECT o.orden AS orden FROM operarios AS o, estado AS e, lineas_de_procesos AS lp WHERE o.id_operarios !=0 AND o.id_estado = e.id_estado AND o.id_ldp = lp.id_ldp AND lp.id_ldp =$id_ldp ORDER BY o.orden DESC LIMIT 0 , 1";
				$resultldp=mysql_query($sqlldp);
				echo "sqlldp $sqlldp<br>";
				$cuantosldp=mysql_num_rows($resultldp);
				echo "cuantosldp $cuantosldp";
				
				  if ($rowldp=mysql_fetch_array($resultldp))
     			 {
						$orden=$rowldp[orden];
						$ordenuno=$orden+1;
				 }
			

   $sql_nuevo="insert into operarios (apellido,nombreop,orden,iniciales,id_ldp,fecha_ingreso) values ('$apellidoop','$nombreop','$ordenuno','$inicialesop','$id_ldp','$fecha_ingreso')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  $ultimoidinsertado=mysql_insert_id();
	echo "sql_nuevo $sql_nuevo<br>";
// echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=fmpfresca.php&botmenu=1&fresca=N&id_mat_prima_nacional=$ultimoidinsertado&mantsec=$mantsec\">";
 //exit;
}// fin modificar_x

if($modificarx){
  
 
 		   $sqlldp="SELECT o.orden AS orden, lp.id_ldp AS id_ldp
 FROM operarios AS o, estado AS e, lineas_de_procesos AS lp WHERE o.id_operarios !=0 AND o.id_estado = e.id_estado AND o.id_ldp = lp.id_ldp AND lp.id_ldp =$id_ldp ORDER BY o.orden DESC LIMIT 0 , 1";
				$resultldp=mysql_query($sqlldp);
				$cuantosldp=mysql_num_rows($resultldp);
				
				
				  if ($rowldp=mysql_fetch_array($resultldp))
     			     {
					  $ordenresc=$rowldp[orden];
					  $ordenresc = $ordenresc +1;
					 }
				
				
					
					
 
$sql_modificar="UPDATE  operarios set apellido='$apellidoop',nombreop='$nombreop', iniciales='$inicialesop', id_ldp= '$id_ldp', id_estado ='$id_estado', orden='$ordenuno' where id_operarios=$id_operarios ";
$rest=mysql_query($sql_modificar);
echo "sql_modificar $sql_modificar<br>";
/* if($id_mat_prima_nacional){
 echo"<meta http-equiv=\"refresh\"content=\"0;URL=sistema.php?modulo=fmpfresca.php&botmenu=1&fresca=N&id_mat_prima_nacional=$id_mat_prima_nacional\">";
 exit;
}*/
}

$sql="SELECT o.id_operarios, o.apellido AS apellidoop, o.nombreop AS nombreop, o.iniciales AS iniciales, o.fecha_ingreso AS fecha_ingreso, lp.id_ldp AS id_ldp, o.id_estado AS id_estado, o.orden AS orden FROM operarios AS o, lineas_de_procesos AS lp where o.id_operarios != 0 and o.id_operarios = $id_operarios and o.id_ldp = lp.id_ldp";
$result=mysql_query($sql);
//$cuantos=mysql_num_rows($result);

?>
<h1>INGRESO DE OPERARIOS</h1>
<? if(!$nuevo){ ?>
  <?
  	
      if ($row=mysql_fetch_array($result))
      { 
	  	$id_operarios=$row[id_operarios];
		$apellidoop=$row[apellidoop];
		$nombreop=$row[nombreop];
		$inicialesop=$row[iniciales];
		$id_ldp=$row[id_ldp];
		$orden=$row[orden];
		$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
		
			
	 ?> 
    
<table width="622" border="0">
  <tr>
    <td width="166">F/INGRESO</td>
    <td width="4">:</td>
    <td width="189"><? echo $fecha_ingreso?></td>
    <td width="93">&nbsp;</td>
    <td width="3">&nbsp;</td>
    <td width="144">&nbsp;</td>
  </tr>
  <tr>
    <td>NOMBRE</td>
    <td>:</td>
    <td><input name="nombreop" type="text" id="nombreop" value="<? echo $nombreop?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>APELLIDO</td>
    <td>:</td>
    <td><input name="apellidoop" type="text" id="apellidoop" value="<? echo $apellidoop?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>INICIALES</td>
    <td>:</td>
    <td><input name="inicialesop" type="text" id="inicialesop" value="<? echo $inicialesop?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>LINEA PRODUCCI&Oacute;N</td>
    <td>:</td>
    <td><? list ($ldp,$id_ldp) = crea_linea_produccion($link,$ldp,$id_ldp,0);
			  	echo "$ldp ";
			  ?></td>
    <td colspan="3" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>ESTADO</td>
    <td>:</td>
    <td colspan="4"><? $estado= crea_estado($link,$row[id_estado]); echo $estado;	?></td>
  </tr>
  <tr>
    <td>OBSERVACIONES</td>
    <td>:</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" valign="top"><textarea name="observacionesop" id="observacionesop" cols="60" rows="5" onkeyup="this.value = this.value.slice(0, 100)"><? echo $row[observacionesop]?></textarea></td>
    <td align="right" ><input type="submit" name="modificarx" id="modificarx" value="Modificar" /></td>
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
<table width="622" border="0">
          <tr>
            <td width="165">NOMBRE</td>
            <td width="5">:</td>
            <td width="185"><input name="nombreop" type="text" id="nombreop" value="<? echo $nombreop?>" /></td>
            <td width="74">Orden</td>
            <td width="12">:</td>
            <td width="155">
            <? 
					
			
			if($id_ldp){
			   $sqlldp="SELECT o.orden AS orden FROM operarios AS o, estado AS e, lineas_de_procesos AS lp WHERE o.id_operarios !=0 AND o.id_estado = e.id_estado AND o.id_ldp = lp.id_ldp AND lp.id_ldp =$id_ldp ORDER BY o.orden DESC LIMIT 0 , 1";
				$resultldp=mysql_query($sqlldp);
				$cuantosldp=mysql_num_rows($resultldp);
				//echo "cuantosldp $cuantosldp";
				
				  if ($rowldp=mysql_fetch_array($resultldp))
     			 {
						$orden=$rowldp[orden];
						$ordenuno=$orden+1;
				 }
			}else{
			echo "Sin asignar";	
			}
			?>
            <? echo $ordenuno?></td>
          </tr>
          <tr>
            <td>APELLIDO</td>
            <td>:</td>
            <td><input name="apellidoop" type="text" id="apellidoop" value="<? echo $apellidoop?>" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>INICIALES</td>
            <td>:</td>
            <td><input name="inicialesop" type="text" id="inicialesop" value="<? echo $inicialesop?>" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>LINEA PRODUCCI&Oacute;N</td>
            <td>:</td>
            <td colspan="4">&nbsp;<? 
			  list ($ldp,$id_ldp) = crea_linea_produccion($link,$ldp,$id_ldp,2);
			  echo "$ldp ";
			  ?></td>
          </tr>
          <tr>
            <td>OBSERVACIONES</td>
            <td>:</td>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5"><textarea name="observacionesop" id="observacionesop" cols="60" rows="5" onkeyup="this.value = this.value.slice(0, 100)" ><? echo $observacionesop?></textarea></td>
            <td align="right"><input type="submit" name="guardax" id="guardax" value="Guardar"></td>
          </tr>
          <tr>
            <td colspan="6">M&aacute;ximo de caracteres permitidos [100]</td>
          </tr>
</table>
<? } ?>
