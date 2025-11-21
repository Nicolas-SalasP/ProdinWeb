<? 
if($buscar){

 $largo=strlen($dato);
	 $newano=substr($dato, 0, 2);
	 $newano="20".$newano;
	 $dato=substr($dato, 2, $largo);

$id_f=$dato;
}


if($id_f){
$sql="SELECT * FROM fajas where id_faja='$id_f'";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM fajas where id_faja=id_faja and id_faja != 0 order by id_faja desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

if(!$op) $op=0;
$sql="SELECT * FROM fajas WHERE id_faja=id_faja and id_faja != 0 order by id_faja desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}

$fhoy=date("Y");

  $sqlul="SELECT * FROM fajas where id_faja=id_faja ORDER BY id_faja desc LIMIT 1";
$resultul=mysql_query($sqlul);

 while ($rowul=mysql_fetch_array($resultul))
 { 
 $id_fajasguiente=$rowul[id_faja];
//echo "ultima $id_faja";
 }



  if($grabar_x){
  $dat2=split(" ",$femision);
  $dat=split("-",$dat2[0]);
  $femision1="$dat[2]-$dat[1]-$dat[0]";

  $dat3=split(" ",$fvencimiento);
  $dat1=split("-",$dat3[0]);
  $fvencimiento1="$dat1[2]-$dat1[1]-$dat1[0]";
  
  $dat4=split(" ",$ffaena);
  $dat6=split("-",$dat4[0]);
  $ffaena1="$dat6[2]-$dat6[1]-$dat6[0]";
  

  
  
  for($i=0;$i < $fajas_emitidas; $i++){
  $id_fajasguiente++;
   $sql_nuevo="insert into fajas  (id_faja,ano,id_origen,estado,femision,fvencimiento,loten,id_producto,id_unidad_produccion,ffaena,id_bodegas,neto,fajas_emitidas,tara,formato_fecha,marca) 
 values ('$id_fajasguiente','$fhoy','$id_origen','E','$femision1','$fvencimiento1','$cuenta','$id_producto','$id_unidad_produccion','$ffaena1','$id_bodegas','$neto','$fajas_emitidas','$tara','$formatofecha','1')";
//echo "--->$sql_nuevo<br>";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  }
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=emision_fajas.php\">";
exit;
 }
 
 

  if($modificar_x){
  
  $dat2=split(" ",$femision);
  $dat=split("-",$dat2[0]);
  $femision1="$dat[2]-$dat[1]-$dat[0]";

  $dat3=split(" ",$fvencimiento);
  $dat1=split("-",$dat3[0]);
  $fvencimiento1="$dat1[2]-$dat1[1]-$dat1[0]";
  
  $dat4=split(" ",$ffaena);
  $dat6=split("-",$dat4[0]);
  $ffaena1="$dat6[2]-$dat6[1]-$dat6[0]";
  
  $sql_modificar="UPDATE  fajas set femision ='$femision1',fvencimiento='$fvencimiento1',loten='$cuenta',id_producto='$id_producto',id_origen='$id_origen',id_unidad_produccion='$id_unidad_produccion', ffaena='$ffaena1', id_bodegas='$id_bodegas', id_unidad_produccion='$id_unidad_produccion',neto='$neto', fajas_emitidas='$fajas_emitidas', tara='$tara', formato_fecha='$formatofecha' where id_faja=$id_faja";
 //echo "$sql_modificar";
$rest=mysql_query($sql_modificar);


if($id_f){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=emision_fajas.php&id_f=$id_f\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=emision_fajas.php&op=$op\">";
 exit;
 }

}
  if($borrar){
  $sql_borrar="delete from fajas where id_faja = $borrar";
  $r=mysql_query($sql_borrar,$link);
  if($op == -1)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=emision_fajas.php&op=0\">";
   exit;
   }
  if($op == 0)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=emision_fajas.php&op=1\">";
   exit;
   }
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=emision_fajas.php&op=$op\">";
   exit;
  }//fin borrar

?>

<script language="JavaScript"> 
function Abrir_ventana (pagina) { 
var opciones="toolbar=no,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=1000, height=800, top=300, left=450"; 
window.open(pagina,"",opciones); 
} 
</script>

<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
-->
</style>
 <form id="form1" name="form1" method="post" action="">
  <table width="606" border="0" align="center">
    <tr>
      <td height="30" colspan="3" class="titulo">Emision de Fajas</td>
    </tr>
    <tr>
      <td width="115" height="14" class="titulo"><? if($cuantos){?>
        Buscar Fajas
      <? }?></td>
      <td width="227" class="titulo"><? if($cuantos){?>
        <input name="dato" type="text" class="cajas" size="15" maxlength="50"/>
        <? }?>
        <? if($cuantos){?>
        <input name="buscar" type="submit" class="cajas" value="Buscar" />
      <? }?></td>
      <td width="250" class="titulo">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">
	  <? if(!$nuevo){?>
      <?
	  $i=$op;
	  while ($row=mysql_fetch_array($result))
      { 
      $id_faja=$row[id_faja];	
	  $i++;
	  $femision=format_fecha_sin_hora($row[femision]);
	  $fvencimiento=format_fecha_sin_hora($row[fvencimiento]);
	  $ffaena=format_fecha_sin_hora($row[ffaena]);
      ?>
      <script type="text/javascript">
	  var cuenta = <? echo $row[loten]?>;
	  function sumar() {
 	  document.forms.form1.cuenta.value = ++cuenta;
	  }
	  </script>
        <input name="id_faja" type="hidden" value="<?echo $row[id_faja]?>" />
            <table width="600" border="1" align="center" bordercolor="#999999">
          <tr>
            <td width="600"><table width="484" border="0" align="center">
                <tr>
                  <td width="163" class="titulo">Emision Fajas </td>
                  <td colspan="3"><span class="numero">N<? echo substr($row[femision],2,2);?><? echo $row[id_faja];?></span></td>
                </tr>
                <tr>
                  <td class="titulo">Unidad de Producci&oacute;n </td>
                  <td colspan="3"><? $unidad_produccion=crea_unidad_produccion($link,$row[id_unidad_produccion]);
					 echo $unidad_produccion; ?></td>
                </tr>
                <tr>
                  <td class="titulo">Fecha de Emisi&oacute;n</td>
                  <td>
				  <input name="femision" type="text" class="cajas"   id="femision"  value="<?echo $femision?>" size="7" maxlength="10" />
<a href="javascript:show_Calendario('form1.fvencimiento');" class="cajas">Ver</a></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td class="titulo">Fecha Vencimiento</td>
                  <td><input name="fvencimiento" type="text" class="cajas"  id="fvencimiento"  value="<?echo $fvencimiento?>" size="7" maxlength="10" />
                    <a href="javascript:show_Calendario('form1.fvencimiento');" class="cajas"  >Ver</a></td>
                  <td width="86"><span class="titulo">Lote Numero </span></td>
                  <td width="85"><input name="cuenta" type="text" value="<?echo $row[loten]?>" size="10"/></td>
                </tr>
                <tr>
                  <td><span class="titulo">Fecha Faena </span></td>
                  <td><input name="ffaena" type="text" class="cajas"   id="ffaena"  value="<?echo $ffaena?>" size="7" maxlength="10" />
                    <a href="javascript:show_Calendario('form1.ffaena');" class="cajas"  >Ver</a></td>
                  <td>&nbsp;</td>
                  <td class="cajas"><div align="right"><button onclick="sumar()" >Lote +</button></div>                  </td>
                </tr>
                <tr>
                  <td class="titulo">Producto</td>
                  <td><? $producto= crea_producto($link,$row[id_producto]);
		 echo $producto;?></td>
                  <td>&nbsp;
				 
				  </td>
                  <td class="cajas">&nbsp;</td>
                </tr>
                <tr>
                  <td class="titulo">Origen</td>
                  <td colspan="3"><? $origenes=crea_origenes($link,$row[id_origen]);
		echo $origenes;?></td>
                </tr>
                <tr>
                  <td class="titulo">Bodega</td>
                  <td colspan="3"><? $bodegas=crea_bodegas($link,$row[id_bodegas],0);
		echo $bodegas;?></td>
                </tr>
                <tr>
                  <td colspan="4" class="titulo"><table width="481" border="0">
                    <tr>
                      <td colspan="2" class="titulo">Formato de Fecha </td>
                    </tr>
                    <tr>
                      <td width="113" height="23">
					  <? if($row[formato_fecha] == 1){?>
					  <input name="formatofecha" type="radio" value="1" checked="checked"/>
					  <? }else{ ?>
					  <input name="formatofecha" type="radio" value="1" />
					  <? }?>
                          <span class="cajas">AAAA/MM/DD</span></td>
                      <td>
					  <? if($row[formato_fecha] == 2){?>
					  <input name="formatofecha" type="radio" value="2" checked="checked"/>
					  <? }else{?>
					  <input name="formatofecha" type="radio" value="2" >
					  <? }?>
                          <span class="cajas">DD/MM/AAAA</span></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="titulo">Tara</td>
                  <td colspan="3"><input name="tara" type="text" class="cajas" id="tara" value="<?echo $row[tara]?>" /></td>
                </tr>
                <tr>
                  <td class="titulo">Peso Fijo </td>
                  <td width="134" class="titulo">&nbsp;</td>
                  <td colspan="2" rowspan="3" class="titulo">
				  <div align="center">
				  <a href="javascript:Abrir_ventana('emision_fajas_print.php?id_faja=<?echo $row[id_faja]?>&fajas_emitidas=<?echo $row[fajas_emitidas]?>')"><img src="jpg/impresora.jpg" width="35" height="39" border="0" /></a><br>
				  Imprimir Fajas</div>				  </td>
                </tr>
                <tr>
                  <td class="titulo">Neto</td>
                  <td><input name="neto" type="text" class="cajas" id="neto" value="<?echo $row[neto]?>" /></td>
                </tr>
                <tr>
                  <td class="titulo">Fajas a Emitidas </td>
                  <td><input name="fajas_emitidas" type="text" class="cajas" id="fajas_emitidas" value="<?echo $row[fajas_emitidas]?>" />
				  
				   <?
				  $compar=$row[loten];
				  $sql_loten="SELECT * FROM fajas where id_faja=id_faja and id_faja != 0 and loten=$compar";
				  $result_loten=mysql_query($sql_loten);
				  $cuantos_loten=mysql_num_rows($result_loten);
				  
				  echo "Cant: $cuantos_loten";
				  ?>
				  </td>
                </tr>
                <tr>
                  <td colspan="4"><? $id_bode=$row[id_faja];?></td>
                </tr>

            </table>            </td>
          </tr>
        </table>
            <? }}?>
            <? if($nuevo){?>
            <table width="600" border="1" align="center" bordercolor="#999999">
              <tr>
                <td width="600"><table width="487" border="0" align="center">
                    <tr>
                      <td width="141" class="titulo">Unidad de Producci&oacute;n </td>
                      <td colspan="3">
					  <? substr($fhoy,2,4); ?>
					  <? $unidad_produccion=crea_unidad_produccion($link,$row[id_unidad_produccion]);
		echo $unidad_produccion;?></td>
                    </tr>
                    <tr>
                      <td class="titulo">Fecha de Emisi&oacute;n </td>
                      <td width="150">
					  <? $fecha=date("Y-m-d"); 
			   			$fecha=format_fecha_sin_hora($fecha);
			   			$fecha_ven=$fecha;
			   		 ?>
					  <input name="femision" type="text" class="cajas"  size="7" maxlength="10" value="<? echo $fecha;?>"/>
                        <a href="javascript:show_Calendario('form1.femision');" class="cajas" >Ver</a></td>
                      <td width="88"><span class="titulo">Lote Numero</span></td>
                      <td width="90">
					  <?
					  if($cuantos)
					  {
					  while ($row=mysql_fetch_array($result))
      				  { 
      				  $id_faja=$row[id_faja];
					  ?>
					  <script type="text/javascript">
	  					var cuenta = <? echo $row[loten]?>;
	  					function sumar() {
 	  					document.forms.form1.cuenta.value = ++cuenta;
	  					}
	  				  </script>
					  
					  
					  <? 
					     $cuenta=$row[loten];
					     $cuenta1=$cuenta+1;
					  ?>
					  <input name="cuenta" type="text" value="<?echo $cuenta1?>" size="10"/>
					  <? }
					  }else{
					  ?>
					  
					  <script type="text/javascript">
	  					var cuenta = 0;
	  					function sumar() {
 	  					document.forms.form1.cuenta.value = ++cuenta;
	  					}
	  				  </script>
					  <input name="cuenta" type="text" value="<?echo $row[loten]?>" size="10"/>
								  
					  <? 
					  
					  }?>					  </td>
                    </tr>
                    <tr>
                      <td class="titulo">Fecha Vencimiento </td>
                      <td>
					  <? 
					   $dat1ven=split(" ",$fecha_ven);
 					   $datven=split("-",$dat1ven[0]);
					   $fech_an="$datven[2]";
					   $fech=$fech_an+2;
					   $dia=$datven[0];
					   $valor=$dia - 1;
					   if($valor <= 0)
					    $valor++;
  					   $fecha_ven="$valor-$datven[1]";
					   ?>
					  <input name="fvencimiento" type="text" class="cajas" size="7" maxlength="10" value="<? echo "$fecha_ven-$fech";?>" />
                        <a href="javascript:show_Calendario('form1.fvencimiento');" class="cajas" >Ver</a></td>
                      <td>&nbsp;</td>
                      <td><div align="right"><button onclick="sumar()" >Lote +</button></div></td>
                    </tr>
                    <tr>
                      <td class="titulo">Fecha Faena </td>
                      <td><input name="ffaena" type="text" class="cajas" size="7" maxlength="10" />
                        <a href="javascript:show_Calendario('form1.ffaena');" class="cajas" >Ver</a></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="titulo">Producto</td>
                      <td colspan="3"><? $producto= crea_producto($link,$row[id_producto]);
		 echo $producto;?></td>
                    </tr>
                    <tr>
                      <td class="titulo">Origen</td>
                      <td colspan="3"><? $origenes=crea_origenes($link,$row[id_origen]);
		echo $origenes;?></td>
                    </tr>
                    <tr>
                      <td class="titulo">Bodega</td>
                      <td colspan="3"><? $bodegas=crea_bodegas($link,$row[id_bodegas],0);
		echo $bodegas;?></td>
                    </tr>
                    <tr>
                      <td colspan="4" class="titulo"><table width="481" border="0">
                          <tr>
                            <td colspan="2" class="titulo">Formato de Fecha </td>
                          </tr>
                          <tr>
                            <td width="113" height="23"><input name="formatofecha" type="radio" value="1" />
                              <span class="cajas">AAAA/MM/DD</span></td>
                            <td><input name="formatofecha" type="radio" value="2" />
                            <span class="cajas">DD/MM/AAAA</span></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td class="titulo">Tara</td>
                      <td><input name="tara" type="text" class="cajas" /></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="titulo">Peso Fijo </td>
                      <td class="titulo">&nbsp;</td>
                      <td colspan="2" rowspan="3" class="titulo">&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="titulo">Neto</td>
                      <td><input name="neto" type="text" class="cajas" /></td>
                    </tr>
                    <tr>
                      <td class="titulo">Fajas Emitidas </td>
                      <td><input name="fajas_emitidas" type="text" class="cajas" /></td>
                    </tr>
                    <tr>
                      <td colspan="4">&nbsp;					   </td>
                    </tr>
                </table></td>
              </tr>
            </table>
            <? }?>
            <table width="564" border="0" align="center">
              <tr>
                <td width="54" class="style2">
				<? if (!$nuevo and $cuantos){ ?>
				<a href="?modulo=emision_fajas.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a> <? }?></td>
                <td width="54" class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
                  <a href="?modulo=emision_fajas.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
                  <? }else{?>
&nbsp;
<? }?></td>
                <td width="58"><span class="style2">
                  <? if($ante >= 0){ ?>
                  <a href="?modulo=emision_fajas.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
                  <? }else{?>
&nbsp;
<? }?>
                </span></td>
                <td width="47"><? if ($cuantos and !$nuevo){ ?>
                    <a href="?modulo=emision_fajas.php&amp;cancelar=1" ><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
                    <? }?>                </td>
                <td width="47"><a href="?modulo=emision_fajas.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a> </td>
                <td width="55"><a href="?modulo=emision_fajas.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
                <td width="62"><? if(!$nuevo){?>
                    <a href="javascript: document.form1.submit();">
                    <label>
                    <input type="image" name="modificar" src="jpg/modificar.jpg" />
                    </label>
                    </a>
                    <? }?>                </td>
                <td width="55"><? if(!$cuantos or $nuevo or $mantsec){?>
                    <a href="javascript: document.form1.submit();">
                    <label>
                    <input type="image" name="grabar" src="jpg/guardar.jpg" />
                    </label>
                    </a>
                    <? }?>                </td>
                <td width="45"><? if(!$nuevo and $cuantos){?>
                    <a href="?modulo=emision_fajas.php&amp;borrar=<?=$id_bode?>&amp;op=<? echo "$ante"?>" > <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
                    <? }?>                </td>
                <td width="45"><? if(!$nuevo and $cuantos){?>
                    <a href="?modulo=emision_fajas_listar.php" ><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
                    <? }?>                </td>
              </tr>
            </table></td>
    </tr>
  </table>
</form>
