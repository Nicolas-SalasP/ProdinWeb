<?



if($buscar){
 $largo=strlen($dato);
	 $newano=substr($dato, 0, 2);
	 $newano="20".$newano;
	 $dato=substr($dato, 0, $largo);
$id_mat=$dato;
}

if($id_mat){
$sql="SELECT * FROM mat_prima_nacional where id_mat_prima_nacional='$id_mat' ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM mat_prima_nacional where id_mat_prima_nacional != 0 order by id_mat_prima_nacional desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional=id_mat_prima_nacional and id_mat_prima_nacional != 0 order by id_mat_prima_nacional desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}

 $fhoy=date("Y"); 
  
  if($despachar_x){
//echo "id estado material $id_estado_material";
 if($id_estado_material == 2 or $id_estado_material == 3 or $id_estado_material == 4){
  $fecha=date("Y-m-d");
 // echo "fecha despacho $fecha";
  }else{
  $fecha='00-00-0000';
  }

$sql_modificar="UPDATE  mat_prima_nacional set id_estado_material='$id_estado_material', fecha_salida='$fecha' where id_mat_prima_nacional=$id_mat_prima_nacional";
 //echo "$sql_modificar";
$rest=mysql_query($sql_modificar);
//exit;

if($id_mat){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=salida_materia_prima_nacional.php&id_mat=$id_mat\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=salida_materia_prima_nacional.php&op=$op\">";
 exit;
 }


}

?> 
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
window.onerror = null;
var bName = navigator.appName;
var bVer = parseInt(navigator.appVersion);
var NS4 = (bName == "Netscape" && bVer >= 4);
var IE4 = (bName == "Microsoft Internet Explorer"
&& bVer >= 4);
var NS3 = (bName == "Netscape" && bVer < 4);
var IE3 = (bName == "Microsoft Internet Explorer"
&& bVer < 4);
var blink_speed=100;
var i=0;
if (NS4 || IE4) {
if (navigator.appName == "Netscape") {
layerStyleRef="layer.";
layerRef="document.layers";
styleSwitch="";
}else{
layerStyleRef="layer.style.";
layerRef="document.all";
styleSwitch=".style";
}
}
//BLINKING
function Blink(layerName){
if (NS4 || IE4) {
if(i%2==0)
{
eval(layerRef+'["'+layerName+'"]'+
styleSwitch+'.visibility="visible"');
}
else
{
eval(layerRef+'["'+layerName+'"]'+
styleSwitch+'.visibility="hidden"');
}
}
if(i<1)
{
i++;
}
else
{
i--
}
setTimeout("Blink('"+layerName+"')",blink_speed);
}
//  End -->
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
.alerta {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
-->
</style>

<form id="form1" name="form1" method="post" action="">
<table width="599" border="0" align="center">
  <tr>
    <td height="30" colspan="2" class="titulo">&nbsp;</td>
    <td width="263" class="cajas">
      <div align="right">
        <?if($id_mat){?>
        <a href="?modulo=salida_materia_prima_nacional_listar.php">Volver</a>
        <?}?>
        </div></td></tr>
  <tr>
    <td width="275" height="14" class="titulo">Salida Materia Prima Nacional </td>
    <td colspan="2"><? if($cuantos){?>
      <div align="right"><span class="cajas">Ej: 9021050</span>
        <input name="dato" type="text" class="cajas" size="15" maxlength="50"/>
        <? }?>
        <? if($cuantos){?>
        <input name="buscar" type="submit" class="cajas" value="Buscar" />
        <? }?>
      </div></td>
    </tr>
  <tr>
    <td colspan="3">
	<?
	 $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	    $id_mat_prima_nacional=$row[id_mat_prima_nacional];
	   	$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
		$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
		$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);
		$fecha_termino=format_fecha_sin_hora($row[fecha_termino]);
	 ?>
     
      <input name="id_mat_prima_nacional" type="hidden" value="<?echo $row[id_mat_prima_nacional]?>" />
      <table width="600" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td><table width="440" border="0" align="center">
            <tr>
              <td width="185" nowrap="nowrap" class="titulo"   >N&uacute;mero</td>
              <td width="245"><span class="numero">N<? //echo substr($row[ano],2,4);?><? echo $row[id_mat_prima_nacional];?>
                <? if($row[borrar]){?>
                <span class="style3">Folio Anulado </span>
                <? }?>
</span></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="titulo"   >Fecha Ingreso </td>
              <td width="245"><input name="fecha_ingreso" type="text" class="cajas"   id="fecha_ingreso"  value="<?echo $fecha_ingreso?>" size="10" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fecha_ingreso');" class="cajas"  >Ver</a></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="titulo"    >Comprobante Num </td>
              <td><input name="comprobante_num" type="text" class="cajas"  value="<?echo $row[comprobante_num]?>" size="44" /></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="titulo"  >Origen</td>
              <td><? 
				$origen= crea_origenes($link,$row[id_origen]);
			echo $origen;
			?></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="titulo"  >Bidon N&uacute;mero</td>
              <td><input name="bidon_num" type="text" class="cajas"  value="<?echo $row[bidon_num]?>" size="44" /></td>
            </tr>
            <tr>
              <td colspan="2" class="titulo"  ><table width="426" height="32" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="85" class="titulo">Producto</td>
                    <td width="341"><? 
		 	
			$producto= crea_producto_onChange($link,$row[id_producto]);
			echo $producto;
			?></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="2" nowrap="nowrap" ><table width="441" border="0">
                <tr>
                  <td width="270"><table width="266" border="0" align="center">
                      <tr>
                        <td colspan="2" class="titulo" >Fecha de Faena </td>
                      </tr>
                      <tr>
                        <td width="132">
						<input name="fecha_faena" type="text" class="cajas"   id="fecha_faena"  value="<?echo $fecha_faena?>" size="10" maxlength="10" />                        <a href="javascript:show_Calendario('form1.fecha_faena');" class="cajas">Ver</a></td>
                        <td width="124" valign="top"><a href="javascript:show_Calendario('form1.fecha_faena');" class="cajas"><? 
					 $fecha=date("Y-m-d");
					 //$fecha=date("2009-03-18");
				     $fecha=format_fecha_sin_hora($fecha);
					 //echo $fecha;
					 $datdestr=split(" ",$fecha_faena);
  					 $datdestripar=split("-",$datdestr[0]);
  					 $fecha_faena_destripar="$datdestripar[2]-$datdestripar[1]-$datdestripar[0]";
					 $fd=$datdestripar[0]+5;
					 if($fd >= $fecha){
					 echo "";
					 }else{
					 ?></a><!--<div class="prem_hint alerta" id="prem_hint" style="position:relative; left:0; visibility:hidden"><font color="#FF0000"><b>&lt;&lt;ALERTA<script language="JavaScript" type="text/javascript">Blink('prem_hint');</script></b></font></div>--><?}?></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="titulo" >Fecha de Termino</td>
                      </tr>
                      <tr>
                        <td colspan="2" class="titulo" ><input name="fecha_termino" type="text" class="cajas"   id="fecha_termino"  value="<?echo $fecha_termino?>" size="10" maxlength="10" />
                          <a href="javascript:show_Calendario('form1.fecha_termino');" class="cajas"  >Ver</a></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="titulo" >Contenido</td>
                      </tr>
                      <tr>
                        <td colspan="2"><input name="contenido" type="text" class="cajas"  value="<?echo $row[contenido]?>" size="15" /></td>
                      </tr>
                      <tr>
                        <td class="titulo" >Temperatura 1 </td>
                        <td class="titulo" >Temperatura 2</td>
                        </tr>
                      <tr>
                        <td><input name="temperatura1" type="text" class="cajas"  value="<?echo $row[temperatura1]?>" size="10" maxlength="4" /></td>
                        <td><input name="temperatura2" type="text" class="cajas"  value="<?echo $row[temperatura2]?>" size="10" maxlength="4" /></td>
                        </tr>
                  </table></td>
                  <td width="161"><table width="161" border="0" align="left">
                      <tr>
                        <td class="titulo" >RCP</td>
                        <td class="titulo" ><? if($brasil != 0){?>Medidas<? }?></td>
                      </tr>
                      <tr>
                        <td width="91"><input name="rcp2" type="text" class="cajas" id="rcp" value="<?echo $row[rcp]?>" size="10" maxlength="10" /></td>
                        <td width="60"><? 
						 if($brasil != 0){
						  //echo " idp $row[id_producto] - unidad medida $row[id_medidas_productos]";
					if($row[id_producto]){
					$medidas_productos= crea_cruce_plant_medidas_productos($link,$row[id_producto],$row[id_medidas_productos]);
					echo $medidas_productos;
					}
					}
					
					?></td>
                      </tr>
                      <tr>
                        <td><span class="titulo">Unidad</span></td>
                        <td><? if($brasil != 0){?><span class="titulo">Calibre</span><? }?></td>
                      </tr>
                      <tr>
                        <td><span class="cajas">
                          <? 
					if($row[id_producto]){
					$id_producto=$row[id_producto];
					
		 			$unidad_medida= crea_unidad_medida_producto($link,$id_producto);
					echo $unidad_medida;
				
					}
					?>
                        </span></td>
                        <td><?
					if($brasil != 0){
						 //echo " idp $row[id_producto] - unidad medida $row[id_calibre]";
					if($row[id_producto]){
					$calibre= crea_cruce_plant_calibre($link,$row[id_producto],$row[id_calibre]);
					echo $calibre;
					}
					}
					?>                        </td>
                      </tr>
                                    </table></td>
                </tr>
                
              </table></td>
              </tr>
            <tr>
              <td colspan="2" nowrap="nowrap" class="titulo"  ><table width="440" border="0">
                  <tr>
                    <td width="129" class="titulo">Observaciones</td>
                    <td width="295"><input name="observaciones" type="text" class="cajas"  value="<?echo $row[observaciones]?>" size="65" /></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td nowrap="nowrap" ><table width="185" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="179" class="titulo" >Estado Material</td>
                  </tr>
                  <tr>
                    <td>
			 <? 
			 $id_estado_material=$row[id_estado_material];
			 if($row[id_estado_material] == 2){ ?>
			 <span class="cajas">Despachado</span>
			 <?
			  }
			
			  if($row[id_estado_material] == 3){
			  ?>
			  <span class="cajas">Anulado</span>			  <?
			  }
			  if($row[id_estado_material] != 2 and $row[id_estado_material] != 3 ){
			  $estado_material= crea_estado_material($link,$row[id_estado_material]);
			  echo $estado_material;
			  }
			?>					</td>
                  </tr>
              </table></td>
              <td nowrap="nowrap" ><table width="242" border="0">
                  <tr>
				    
                    <td width="236" class="titulo" >Fecha Salida</td>
                  </tr>
                  <tr>
                    <td>
		
	
        <input name="fecha_salida" type="text" class="cajas"   id="fecha_salida"  value="<?echo $fecha_salida?>" size="10" maxlength="10" />				</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="2" nowrap="nowrap" >&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" nowrap="nowrap" ><? $id_bode=$row[id_mat_prima_nacional];?></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <?}?>
      <table width="564" border="0" align="center">
        <tr>
          <td width="54" class="style2"><a href="?modulo=salida_materia_prima_nacional.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td width="54" class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
            <a href="?modulo=salida_materia_prima_nacional.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
            <? }else{?>
&nbsp;
<? }?></td>
          <td width="58"><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=salida_materia_prima_nacional.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
&nbsp;
<? }?>
          </span></td>
          <td width="47"><? if ($cuantos){ ?>
              <a href="?modulo=salida_materia_prima_nacional.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47">&nbsp;</td>
          <td width="55">&nbsp;</td>
          <td width="62">
		  <? if($permiso33 == 1){?>
		  <?  if($id_estado_material != 2  and $id_estado_material != 3  and $id_estado_material != 4){?>
		 <a href="javascript: document.form1.submit();">
		 <label>
		 <input type="image" name="despachar" src="jpg/despacho.jpg" />
		</label>
		<? }?>
		<? } ?>
           </a>		   </td>
          <td width="55">&nbsp;</td>
          <td width="45">&nbsp;</td>
          <td width="45">
		  <? if(!$id_mat) {?>
		  <a href="?modulo=salida_materia_prima_nacional_listar.php&op=<? echo $next?>" ><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
		  <? }?>		  </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>