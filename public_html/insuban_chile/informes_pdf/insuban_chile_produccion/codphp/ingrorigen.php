<?
$fecha_ingreso=date("Y-m-d"); 
		 
if($guardax){

$sql_nuevo="insert into origenes (origen,telefono,domicilio,comuna,ciudad,pais,observacionesop,id_procedencia,id_estado) values ('$origen','$telefono','$domicilio','$comuna','$ciudad','$pais','$observacionesop','$id_procedencia','$id_estado')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  $ultimoidinsertado=mysql_insert_id();
	//echo "sql_nuevo $sql_nuevo<br>";
// echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=fmpfresca.php&botmenu=1&fresca=N&id_mat_prima_nacional=$ultimoidinsertado&mantsec=$mantsec\">";
 //exit;
}// fin modificar_x

if($modificarx){

$sql_modificar="UPDATE  origenes set origen='$origen',telefono='$telefono', domicilio='$domicilio', ciudad='$ciudad', comuna= '$comuna', pais='$pais', observacionesop='$observacionesop', web='$web', id_estado = '$id_estado', id_procedencia = '$id_procedencia' where id_origen= $id_origen ";
$rest=mysql_query($sql_modificar);
//echo "sql_modificar $sql_modificar<br>";
}

$sql="SELECT * FROM origenes AS org, estado AS es, procedencia AS proc where org.id_origen = $id_origen and org.id_estado = es.id_estado and org.id_procedencia = proc.id_procedencia order by origen asc";
$result=mysql_query($sql);
//$cuantos=mysql_num_rows($result);

?>
<h1>INGRESO DE ORIGEN</h1>
<? if(!$nuevo){ ?>
  <?
  	
      if ($row=mysql_fetch_array($result))
      { 
	  	$id_origen=$row[id_origen];
		$origen=$row[origen];
		$telefono=$row[telefono];
		$domicilio=$row[domicilio];
		$comuna=$row[comuna];
		$ciudad=$row[ciudad];
		$pais=$row[pais];
		$id_estado=$row[id_estado];
		$id_procedencia=$row[id_procedencia];
		$observacionesop=$row[observacionesop];
					
	 ?> 
    
<table width="622" border="0">
  <tr>
    <td width="131">ORIGEN</td>
    <td width="3">:</td>
    <td width="221"><input name="origen" type="text" id="origen" value="<? echo $origen?>" /></td>
    <td width="92">TELEFONO</td>
    <td width="3">:</td>
    <td width="146"><input name="telefono" type="text" id="telefono" value="<? echo $telefono?>" /></td>
  </tr>
  <tr>
    <td>DIRECCION</td>
    <td>:</td>
    <td><input name="domicilio" type="text" id="domicilio" value="<? echo $domicilio?>" /></td>
    <td>WEB</td>
    <td>:</td>
    <td><input name="web" type="text" id="web" value="<? echo $web?>" /></td>
  </tr>
  <tr>
    <td>COMUNA</td>
    <td>:</td>
    <td><input name="comuna" type="text" id="comuna" value="<? echo $comuna?>" /></td>
    <td>ESTADO</td>
    <td>:</td>
    <td><? 
		 	
			$estado= crea_estado($link,$row[id_estado]);
			echo $estado;
						?></td>
  </tr>
  <tr>
    <td>CIUDAD</td>
    <td>:</td>
    <td><input name="ciudad" type="text" id="ciudad" value="<? echo $ciudad?>" /></td>
    <td>PROCEDENCIA</td>
    <td>:</td>
    <td><? 
					
									
		 					$procedencia= crea_procedencia($link,$id_procedencia,0);


							echo $procedencia;
							
						?></td>
  </tr>
  <tr>
    <td>PAIS</td>
    <td>:</td>
    <td><input name="pais" type="text" id="pais" value="<? echo $pais?>" /></td>
    <td colspan="3">&nbsp;</td>
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
            <td width="163">ORIGEN</td>
            <td width="4">:</td>
            <td width="183"><input name="origen" type="text" id="origen" value="<? echo $origen?>" /></td>
            <td width="89">TELEFONO</td>
            <td width="3">:</td>
            <td width="154"><input name="telefono" type="text" id="telefono" value="<? echo $telefono?>" /></td>
          </tr>
          <tr>
            <td>DIRECCION</td>
            <td>:</td>
            <td><input name="domicilio" type="text" id="domicilio" value="<? echo $domicilio?>" /></td>
            <td>WEB</td>
            <td>:</td>
            <td><input name="web" type="text" id="web" value="<? echo $web?>" /></td>
          </tr>
          <tr>
            <td>COMUNA</td>
            <td>:</td>
            <td><input name="comuna" type="text" id="comuna" value="<? echo $comuna?>" /></td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td>CIUDAD</td>
            <td>:</td>
            <td><input name="ciudad" type="text" id="ciudad" value="<? echo $ciudad?>" /></td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td>PAIS</td>
            <td>:</td>
            <td><input name="pais" type="text" id="pais" value="<? echo $pais?>" /></td>
            <td colspan="3">&nbsp;</td>
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
