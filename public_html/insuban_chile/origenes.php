<?

if($id_orig){
$sql="SELECT * FROM origenes where id_origen='$id_orig' order by id_origen desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM origenes where id_origen = id_origen and id_origen != 0 order by id_origen desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM origenes WHERE id_origen=id_origen and id_origen != 0 order by id_origen desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
  if($grabar_x and $origen){
   $sqlus=" select * from origenes where origen='$origen' ";
   $restus=mysql_query($sqlus);
   $cuantos_hay=mysql_num_rows($restus);
   if(!$cuantos_hay){ 
  $sql_nuevo="insert into origenes (origen,cod,telefono,domicilio,comuna,ciudad,pais,encargado,etapa) values ('$origen','$cod','$telefono','$domicilio','$comuna','$ciudad','$pais','$encargado','$etapa')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
   //echo "sql $sql_nuevo";
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=origenes.php\">";
  exit;
  }else{
  $mensaje="El Origen ya existe en nuestra bases de datos<br>";
  }
  
  }
  
  if($borrar){
   $sql_borrar="delete from origenes where id_origen = $borrar";
   $r=mysql_query($sql_borrar,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=origenes.php\">";
   exit;
  }//fin borrar
  
  
 if($modificar_x){
 $sql_modificar="UPDATE  origenes set origen='$origen', cod='$cod', telefono='$telefono', domicilio='$domicilio', comuna='$comuna', ciudad='$ciudad', pais='$pais', id_estado='$id_estado', id_procedencia = '$id_procedencia' where id_origen=$id_origen";
 $rest=mysql_query($sql_modificar);
//echo "id_procedencia $sql_modificar";
 
  if($id_orig){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=origenes.php&id_orig=$id_orig\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=origenes.php&op=$op\">";
 exit;
 }
 
}

if($modificarlistar || $eliminar){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'nombre')
	{
    $id=$dat[1];
    $nombre=$_POST["nombre-$id"];
	$domicilio=$_POST["domicilio-$id"];
	$ciudad=$_POST["ciudad-$id"];
	$pais=$_POST["pais-$id"];
	$telefono=$_POST["telefono-$id"];
	$fax=$_POST["fax-$id"];
	$mail=$_POST["mail-$id"];
	$web=$_POST["web-$id"];
	$contacto=$_POST["contacto-$id"];
	
    $sql_mod="UPDATE destinos SET  nombre='$nombre', domicilio='$direccion', ciudad='$ciudad', pais='$pais', telefono='$telefono', fax='$fax', mail='$mail', web='$web', contacto='$contacto' where id_destinos = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from origenes where id_origen = $value";
	 	$r=mysql_query($sql_elim);
	 	} 
}
} 
  
?>
<script language="JavaScript" type="text/javascript"> 
<!-- 
function Confirmar(form1) { 

var borrar = confirm("Estás seguro/a de que desea eliminar el registro?"); 

return borrar; //true o false 

} 
//--> 
</script>

<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
.style6 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #666666; }
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #666666; }
-->
</style>
<form id="form1" name="form1" method="post" action="" onsubmit = "return isMailReady(this);">
<table width="658" border="0" align="center">
  <tr>
    <td width="611" height="14" bgcolor="#CCCCCC"><span class="titulo">Origen</span></td>
    <td width="37" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=origenes_listar.php">Volver </a></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	  $id_origen=$row[id_origen];
	  $id_procedencia=$row[id_procedencia];
      $i++;
      ?>
      <span class="titulo1">
      <input name="id_origen" type="hidden" value="<?echo $row[id_origen]?>" />
      </span>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="250"><table width="321" border="0" align="center">
              <tr>
                <td width="57" class="titulo"  ><div align="right">Origen:</div></td>
                <td width="140"><input name="origen" type="text" class="cajas" id="origen" value="<?echo $row[origen]?>" size="28" maxlength="30" /></td>
                <td width="53"><span class="titulo">Codigo:</span></td>
                <td width="78"><input name="cod" type="text" class="cajas" id="cod" value="<?echo $row[cod]?>" size="5" maxlength="5"/></td>
                <td width="10">&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo"  ><div align="right">Direcci&oacute;n:</div></td>
                <td colspan="3"><input name="domicilio" type="text" class="cajas" id="domicilio" value="<?echo $row[domicilio]?>" size="50" maxlength="30" /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo"  ><div align="right">Comuna:</div></td>
                <td colspan="3" ><input name="comuna" type="text" class="cajas" id="comuna" value="<?echo $row[comuna]?>" size="50" maxlength="30" /></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo"  ><div align="right">Ciudad:</div></td>
                <td colspan="3" ><input name="ciudad" type="text" class="cajas" id="ciudad" value="<?echo $row[ciudad]?>" size="50" maxlength="30" /></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo"  ><div align="right">Pa&iacute;s:</div></td>
                <td colspan="3" ><input name="pais" type="text" class="cajas" id="pais" value="<?echo $row[pais]?>" size="50" maxlength="30" /></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo"  ><div align="right">Tel&eacute;fono:</div></td>
                <td colspan="3" ><input name="telefono" type="text" class="cajas" id="telefono" value="<?echo $row[telefono]?>" size="50" maxlength="20" /></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td rowspan="3" class="titulo"  >&nbsp;</td>
                <td colspan="3" ><? 
		 	
			$estado= crea_estado($link,$row[id_estado]);
			echo $estado;
						?></td>
                <td rowspan="3" >&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" ><? 
					
									
		 					$procedencia= crea_procedencia222222($link,$id_procedencia,0);


							echo $procedencia;
							
						?></td>
              </tr>
              <tr>
                <td colspan="3" >&nbsp;</td>
              </tr>
              <tr>
                <td >&nbsp;</td>
                <td colspan="3" ><? $id_bode=$row[id_origen];?>
                  <span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></td>
                <td >&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }}?>
      <? if($nuevo){?>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="250"><table width="330" border="0" align="center">
            <tr>
              <td width="56" class="titulo"  ><div align="right"> Origen:</div></td>
              <td width="124"><input name="origen" type="text" class="cajas" id="origen" value="<? echo $origen?>" size="28" maxlength="30" /></td>
              <td width="61"><span class="titulo">Codigo:</span></td>
              <td width="61"><input name="textfield2" type="text" class="cajas" id="textfield2" value="<?echo $row[cod]?>" size="5" maxlength="5"/></td>
              <td width="10"><span class="style8">(*)</span></td>
              </tr>
            <tr>
              <td class="titulo"  ><div align="right">Domicilio:</div></td>
              <td colspan="3"><input name="domicilio" type="text" class="cajas" id="domicilio" value="<? echo $domicilio?>"  size="50" maxlength="30" /></td>
              <td><span class="style8">(*)</span></td>
              </tr>
            <tr>
              <td class="titulo"  ><div align="right">Ciudad:</div></td>
              <td colspan="3" ><input name="ciudad" type="text" class="cajas" id="ciudad" value="<? echo $ciudad?>"  size="50" maxlength="30" /></td>
              <td ><span class="style8">(*)</span></td>
              </tr>
            <tr>
              <td class="titulo"  ><div align="right">Comuna:</div></td>
              <td colspan="3" ><input name="comuna" type="text" class="cajas" id="comuna" value="<? echo $comuna?>"  size="50" maxlength="30" /></td>
              <td ><span class="style8">(*)</span></td>
              </tr>
            <tr>
              <td class="titulo"  ><div align="right">Pa&iacute;s:</div></td>
              <td colspan="3" ><input name="pais" type="text" class="cajas" id="pais" value="<? echo $pais?>"  size="50" maxlength="30" /></td>
              <td ><span class="style8">(*)</span></td>
              </tr>
            <tr>
              <td class="titulo"  ><div align="right">Tel&eacute;fono:</div></td>
              <td colspan="3" ><input name="telefono" type="text" class="cajas" id="telefono" value="<? echo $telefono?>" size="50" maxlength="20" /></td>
              <td >&nbsp;</td>
              </tr>
            <tr>
              <td >&nbsp;</td>
              <td colspan="3" ><span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></td>
              <td >&nbsp;</td>
              </tr>
            <tr>
              <td >&nbsp;</td>
              <td colspan="4" ><span class="style4">
                <? if($mensaje) echo $mensaje?>
              </span></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=origenes.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=origenes.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=origenes.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=origenes.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><? if($permiso13 == 1){?><a href="?modulo=origenes.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
          <td width="55"><a href="?modulo=origenes.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if($permiso13 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
              <? }?><? }?></td>
          <td width="55"><? if($permiso13 == 1){?><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?><? }?></td>
          <td width="45">
		  <? if($permiso13 == 1){?>
		  <? if(!$nuevo and $cuantos){?>
          <? 
		  $sqlsi="SELECT * from etiquetados_folios where id_origen  = $id_origen ";
		  $resultsi=mysql_query($sqlsi);
          $siexiste=mysql_num_rows($resultsi);
		  
		  $sqlsi2="SELECT * from mat_prima_nacional where id_origen  = $id_origen ";
		  $resultsi2=mysql_query($sqlsi2);
          $siexiste2=mysql_num_rows($resultsi2);
		  
		  $sqlsi3="SELECT * from mat_prima_importada where id_origen  = $id_origen ";
		  $resultsi3=mysql_query($sqlsi3);
          $siexiste3=mysql_num_rows($resultsi3);
			 
		  if(!$siexiste or !$siexiste2 or !$siexiste3){ ?>
          <a href="?modulo=origenes.php&amp;borrar=<?=$id_bode?>" onclick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /></a>
          <? }?>
          <? }?>
		  <? }?></td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=origenes_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>