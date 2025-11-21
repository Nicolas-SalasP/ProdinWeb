<?
if($buscar){

 $largo=strlen($dato);
	 $newano=substr($dato, 0, 2);
	 $newano="20".$newano;
	 $dato=substr($dato, 0, $largo);

$id_mat=$dato;
}

if($id_mat){
$sql="SELECT * FROM mat_prima_nacional AS mpn, estado_material AS em where mpn.id_mat_prima_nacional='$id_mat' and mpn.id_mat_prima_nacional != 0 and mpn.id_estado_material = em.id_estado_material order by mpn.id_mat_prima_nacional desc";
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

$fhoy=date("Y"); //año
//$fhoy=2010;



  if($grabar_x){
	  
 
   $sqlultnun="SELECT* 
FROM mat_prima_nacional
WHERE id_origen = $id_origen ORDER BY id_mat_prima_nacional DESC 
LIMIT 0 , 1";
	   
$resultnum=mysql_query($sqlultnun);
$sqlultnun=mysql_num_rows($resultnum);
//echo "sqlultnun $sqlultnun<br>";
if ($rownum=mysql_fetch_array($resultnum))
{
	$correl=$rownum[bidon_num];
	$bidon_num=$correl + 1;
}

  $sqlultimafecha="SELECT * FROM mat_prima_nacional where id_mat_prima_nacional=id_mat_prima_nacional ORDER BY id_mat_prima_nacional desc LIMIT 1";
$resulultimafecha=mysql_query($sqlultimafecha);
$cuantosultimafecha=mysql_num_rows($resulultimafecha);

 if ($rowultimafecha=mysql_fetch_array($resulultimafecha))
 { 
 $id_mat_prima_nacional=$rowultimafecha[id_mat_prima_nacional];
 $ultimoanorescatado=$rowultimafecha[ano];
 }
 
if($ultimoanorescatado == $fhoy){

 $id_mat_prima_nacional=$rowultimafecha[id_mat_prima_nacional];
 $id_mat_prima_nacional_siguiente=$id_mat_prima_nacional+1;

}else{

 $id_mat_prima_nacional=$rowul[id_mat_prima_nacional];
 $id_mat_prima_nacional_siguiente=$id_mat_prima_nacional - $id_mat_prima_nacional;
 $id_mat_prima_nacional_siguiente++;
 
 $id_mat_prima_nacional_siguiente_contar=strlen($id_mat_prima_nacional_siguiente);
 
 if($id_mat_prima_nacional_siguiente_contar == 1) $id_mat_prima_nacional_siguiente="00000$id_mat_prima_nacional_siguiente";
 if($id_mat_prima_nacional_siguiente_contar == 2) $id_mat_prima_nacional_siguiente="0000$id_mat_prima_nacional_siguiente";
 if($id_mat_prima_nacional_siguiente_contar == 3) $id_mat_prima_nacional_siguiente="000$id_mat_prima_nacional_siguiente";
 if($id_mat_prima_nacional_siguiente_contar == 4) $id_mat_prima_nacional_siguiente="00$id_mat_prima_nacional_siguiente";
 if($id_mat_prima_nacional_siguiente_contar == 5) $id_mat_prima_nacional_siguiente="0$id_mat_prima_nacional_siguiente";
 if($id_mat_prima_nacional_siguiente_contar == 6) $id_mat_prima_nacional_siguiente="$id_mat_prima_nacional_siguiente";
 $anook=substr($fhoy,2,4);
 $id_mat_prima_nacional_siguiente=$anook.$id_mat_prima_nacional_siguiente;
}
  
  $dat2=split(" ",$fecha_ingreso);
  $dat=split("-",$dat2[0]);
	  $fecha_ingreso1="$dat[2]-$dat[1]-$dat[0]";

  $dat4=split(" ",$fecha_faena);
  $dat6=split("-",$dat4[0]);
  $fecha_faena1="$dat6[2]-$dat6[1]-$dat6[0]";
  
  $dat5=split(" ",$fecha_termino);
  $dat7=split("-",$dat5[0]);
  $fecha_termino1="$dat7[2]-$dat7[1]-$dat7[0]";
   
  if($temperatura1=='')
    $temperatura1=0;
  if($temperatura2=='')
    $temperatura1=0;
  if($rcp=='')
    $rcp=0;
  if($observaciones=='')
    $observaciones="Sin Observaciones";
   
   $sqlbuscacosto="SELECT * FROM cruce_producto_empresa where id_producto = $id_producto and id_origen =$id_origen ";
   $resultbuscacosto=mysql_query($sqlbuscacosto);
   $cuantosbuscacosto=mysql_num_rows($resultbuscacosto);
   if($cuantosbuscacosto){
    if ($rowbuscacosto=mysql_fetch_array($resultbuscacosto))
      { 
	    //$id_cruce_producto_empresa =$rowbuscacosto[id_cruce_producto_empresa];
	   	$valor_cmp = $rowbuscacosto[valor_cmp];
	  }
   }
   $fech_generada_inicio =date("Y-m-d H:i:s");
   $sql_nuevo="insert into mat_prima_nacional (id_mat_prima_nacional,id_origen,ano,id_producto,id_calibre,id_estado_material,comprobante_num,bidon_num,contenido,rcp,temperatura1,temperatura2,observaciones,fecha_faena,fecha_termino,fecha_ingreso,id_unidad_medida,id_medidas_productos,id_calibre,valor_cmp,fech_generada_inicio) values ('$id_mat_prima_nacional_siguiente','$id_origen','$fhoy','$id_producto','$id_calibre','1','$comprobante_num','$bidon_num','$contenido','$rcp','$temperatura1','$temperatura2','$observaciones','$fecha_faena1','$fecha_termino1','$fecha_ingreso1','$id_unidad_medida','$id_medidas_productos','$id_calibre','$valor_cmp','$fech_generada_inicio')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  //echo "$sql_nuevo";
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=materia_prima_nacional.php&mantsec=$mantsec\">";
exit;
}// fin modificar_x
  
  
  if($borrar){
$sql_modificar="UPDATE  mat_prima_nacional set borrar=1, id_estado_material  = 3 where id_mat_prima_nacional=$borrar";
$rest=mysql_query($sql_modificar);
$id_mat=$borrar;
if($id_mat){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=materia_prima_nacional.php&id_mat=$id_mat\">";
 exit;
 }else{
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=materia_prima_nacional.php&op=$op\">";
 exit;
 }

}// fin borrar
  

  
  if($borrar_no){
  $sql_borrar="delete from mat_prima_nacional where id_mat_prima_nacional = $borrar";
  $r=mysql_query($sql_borrar,$link);
    echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=materia_prima_nacional.php\">";
   exit;
  }//fin borrar
  

 
  if($modificar){
  
 //echo "estoy en modificar $id_mat_prima_nacional";
  
  $dat2=split(" ",$fecha_ingreso);
  $dat=split("-",$dat2[0]);
  $fecha_ingreso2="$dat[2]-$dat[1]-$dat[0]";

  $dat3=split(" ",$fecha_salida);
  $dat1=split("-",$dat3[0]);
  $fecha_salida2="$dat1[2]-$dat1[1]-$dat1[0]";
  
  $dat4=split(" ",$fecha_faena);
  $dat6=split("-",$dat4[0]);
  $fecha_faena2="$dat6[2]-$dat6[1]-$dat6[0]";
  
  $dat5=split(" ",$fecha_termino);
  $dat7=split("-",$dat5[0]);
  $fecha_termino2="$dat7[2]-$dat7[1]-$dat7[0]";
  
  if($id_estado_material != 2){
    $fecha='0000-00-00';
	$borrar=0;
  }
  
   if($id_estado_material == 2){
   $fecha=date("Y-m-d");
 }
 
 if($id_lineas_procesos=='')
    $id_lineas_procesos=0;


  $sqlbuscacosto="SELECT * FROM cruce_producto_empresa where id_producto = $id_producto and id_origen =$id_origen ";
   $resultbuscacosto=mysql_query($sqlbuscacosto);
   $cuantosbuscacosto=mysql_num_rows($resultbuscacosto);
   if($cuantosbuscacosto){
    if ($rowbuscacosto=mysql_fetch_array($resultbuscacosto))
      { 
	    $id_cruce_producto_empresa =$rowbuscacosto[id_cruce_producto_empresa];
	   	$valor_cmp = $rowbuscacosto[valor_cmp];
	  }
   }

$sql_modificar="UPDATE  mat_prima_nacional set id_origen='$id_origen',id_producto='$id_producto', id_calibre='$id_calibre',id_estado_material='$id_estado_material', comprobante_num='$comprobante_num', bidon_num='$bidon_num', contenido='$contenido',rcp='$rcp',temperatura1='$temperatura1',temperatura2='$temperatura2', observaciones='$observaciones', fecha_faena='$fecha_faena2', fecha_termino='$fecha_termino2', fecha_ingreso='$fecha_ingreso2', fecha_salida='$fecha', id_unidad_medida='$id_unidad_medida', id_medidas_productos='$id_medidas_productos',id_calibre='$id_calibre',borrar = '$borrar', id_cruce_producto_empresa = '$id_cruce_producto_empresa', valor_cmp = '$valor_cmp'   where id_mat_prima_nacional=$id_mat_prima_nacional";
//echo "$sql_modificar";
$rest=mysql_query($sql_modificar);

 if($id_mat){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=materia_prima_nacional.php&id_mat=$id_mat\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=materia_prima_nacional.php&op=$op\">";
 exit;
 }
 
}
/*
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from mat_prima_importada where id_mat_prima_nacional = $value";
	 	$r=mysql_query($sql_elim);
	 	} 
}
*/


?>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>


<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
.alerta {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px}
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
body {
	margin-top: 0px;
}
-->
</style>
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
<script language="JavaScript" type="text/javascript"> 
<!-- 
function Confirmar(form1) { 

var borrar = confirm("Estás seguro/a de que desea eliminar el registro?"); 

return borrar; //true o false 

} 
//--> 
</script> 
<form id="form1" name="form1" method="post" action="">
<table width="599" border="0" align="center">
  
  <tr>
    <td height="14" class="titulo">Materia Prima Nacional</td>
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
    <td colspan="3"><? if(!$nuevo){?>
      <?
	 $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	    $id_mat_prima_nacional=$row[id_mat_prima_nacional];
	   	$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
		$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
		$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);
		$fecha_termino=format_fecha_sin_hora($row[fecha_termino]);
		$id_estado_material=$row[id_estado_material];
		$bidon_num=$row[bidon_num];
			//echo "fecha_salida $fecha_salida";
	 ?>
        <input name="id_mat_prima_nacional" type="hidden" value="<?echo $row[id_mat_prima_nacional]?>" />
      <table width="600" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td><table width="514" border="0" align="center">
            <tr>
              <td width="185" nowrap="nowrap" class="titulo">N&uacute;mero  </td>
              <td colspan="2"><? $anopaso=$row[ano]?>
			  <span class="numero">
			  N<? 
			   //if($row[ano] == 2007 or $row[ano] == 2008 or $row[ano] == 2009)
			  //$anook=substr($row[ano],0,3);
			  // echo $anook.$id_mat_prima_nacional;
			    //echo $anook=substr($id_mat_prima_nacional,2,9);?><? echo " $id_mat_prima_nacional";?>
			  <? if($row[borrar]){?>
              <span class="style3">Folio Anulado </span>
              <? }?>
			  </span></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="titulo"   >Fecha Ingreso</td>
              <td colspan="2"><input name="fecha_ingreso" type="text" class="cajas"   id="fecha_ingreso"  value="<?echo $fecha_ingreso?>" size="10" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fecha_ingreso');" class="cajas"  >Ver</a></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="titulo"    >N&deg; Comprobante</td>
              <td colspan="2"><input name="comprobante_num" type="text" class="cajas"  value="<?echo $row[comprobante_num]?>" size="20" maxlength="10" />
                <span class="cajas">               (Gu&iacute;a Despacho)</span></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="titulo"  >Origen</td>
              <td colspan="2"><? //echo "$row[id_origen]<br>";
				$origen= crea_origenes($link,$row[id_origen]);
			echo $origen;
			?></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="titulo"  >Bidon N&uacute;mero</td>
              <td width="137"><? if($nuevo or $mantsec) { 
				    $bidon_num=$row[bidon_num];
					$bidon_num=$bidon_num+1;
				?>		  
					  <input name="bidon_num" type="text" value="<? echo $bidon_num?>"  class="cajas" size="20" maxlength="10"/>
				<? }else{?>	
				 <input name="bidon_num" type="text" value="<? echo $row[bidon_num]?>"  class="cajas" size="20" maxlength="10"/>
				
				<? }?>	</td>
              <td width="178" class="cajas">(Correlativo Planta Origen)</td>
            </tr>
            <tr>
              <td colspan="3" class="titulo"  ><table width="446" height="32" border="0">
                  <tr>
                    <td width="191" class="titulo">Producto</td>
                    <td width="235">
			<? 
			 //echo "$row[id_producto]<br>";
			$producto= crea_producto($link,$row[id_producto]);
			        echo $producto;
					$veces=1;
		
			?></td>
                  </tr>
                  <tr>
                    <td class="titulo">Calibre</td>
                    <td><? 
					 if($row[id_producto]){
		  $producto_calibre= crea_producto_calibre_codificacion($link,$row[id_producto],$id_calibre,1,0);
		  echo $producto_calibre;
		  }
					?></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="3" nowrap="nowrap" ><table width="441" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="270"><table width="266" border="0" align="center">
                      <tr>
                        <td colspan="2" class="titulo" >Fecha de Faena </td>
                      </tr>
                      <tr>
                        <td width="141"><input name="fecha_faena" type="text" class="cajas"   id="fecha_faena"  value="<?echo $fecha_faena?>" size="10" maxlength="10" />
                          <a href="javascript:show_Calendario('form1.fecha_faena');" class="cajas"  >Ver                     </a></td>
                        <td width="115" valign="top"><a href="javascript:show_Calendario('form1.fecha_faena');" class="cajas"  >
                          <? 
					 $sacar_alarma=$row[id_estado_material];
					 
					 if($sacar_alarma == 1){
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
					 ?>
                        </a>
                          <div class="prem_hint alerta" id="prem_hint" style="position:relative; left:0; visibility:hidden"> <font color="#FF0000"><b> &lt;&lt; ALERTA</b></font></div>
                          <script language="JavaScript" type="text/javascript">Blink('prem_hint');</script>
                          <? 
					 $sql_alerta="UPDATE  mat_prima_nacional set alerta = '1' where id_mat_prima_nacional=$id_mat_prima_nacional";
					 $rest=mysql_query($sql_alerta);
					 }
					 }
					 ?></td>
                      </tr>
                      <tr>
                        <td class="titulo" >Fecha de Termino</td>
                        <td class="titulo" >Contenido</td>
                      </tr>
                      <tr>
                        <td class="titulo" ><input name="fecha_termino" type="text" class="cajas"   id="fecha_termino"  value="<?echo $fecha_termino?>" size="10" maxlength="10" />
                          <a href="javascript:show_Calendario('form1.fecha_termino');" class="cajas"  >Ver</a></td>
                        <td class="titulo" ><input name="contenido" type="text" class="cajas"  value="<?echo $row[contenido]?>" size="15" /></td>
                      </tr>
                      <tr>
                        <td class="titulo" >Temperatura 1 </td>
                        <td class="titulo" >Temperatura 2</td>
                      </tr>
                      <tr>
                        <td height="22"><input name="temperatura1" type="text" class="cajas"  value="<?echo $row[temperatura1]?>" size="10" maxlength="4" /></td>
                        <td><input name="temperatura2" type="text" class="cajas"  value="<?echo $row[temperatura2]?>" size="10" maxlength="4" /></td>
                      </tr>
                    </table></td>
                    <td width="161"><table width="161" border="0" align="left">
                      <tr>
                        <td height="39" colspan="2" valign="top" class="titulo" ><!--Valor asignado: $-->
						<?  
						//$valor_cmp=$row[valor_cmp];
										
						//echo "$valor_cmp";
						
						
						?><br>
                        </td>
                          </tr>
                      <tr>
                        <td class="titulo" >RCP</td>
                        <td class="titulo" ><? if($brasil != 0){?>
                          Medidas
                            <? }?></td>
                      </tr>
                      <tr>
                        <td width="91"><input name="rcp" type="text" class="cajas" id="rcp" value="<?echo $row[rcp]?>" size="10" maxlength="10" /></td>
                          <td width="60"><? 
						 
						 $brasil=0;
						  //echo " idp $row[id_producto] - unidad medida $row[id_medidas_productos]";
				  if($brasil != 0){
					if($row[id_producto]){
					$medidas_productos= crea_cruce_plant_medidas_productos($link,$row[id_producto],$row[id_medidas_productos]);
					echo $medidas_productos;
					}
					
				}
					?></td>
                        </tr>
                      <tr>
                        <td><span class="titulo">Unidad</span></td>
                          <td><span class="titulo"><? if($brasil != 0){?>Calibre<?  }?></span></td>
                        </tr>
                      <tr>
                        <td class="cajas"><? 
					if($row[id_producto]){
					$id_producto=$row[id_producto];
					
		 			$unidad_medida= crea_unidad_medida_producto($link,$id_producto);
					echo $unidad_medida;
				
					}
					?></td>
                        <td>
						  <?
						 //echo " idp $row[id_producto] - unidad medida $row[id_calibre]";
						 if($brasil != 0){
					if($row[id_producto]){
					$calibre= crea_cruce_plant_calibre($link,$row[id_producto],$row[id_calibre]);
					echo $calibre;
					}
					}
					?>						  </td>
                      </tr>
                    </table></td>
                  </tr>
                  
                            </table></td>
              </tr>
            <tr>
              <td colspan="3" nowrap="nowrap" class="titulo"  ><table width="440" border="0">
                  <tr>
                    <td width="129" class="titulo">Observaciones</td>
                    <td width="295"><input name="observaciones" type="text" class="cajas"  value="<?echo $row[observaciones]?>" size="65" maxlength="50" /></td>
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
					<? if(!$mantsec){?>
					<?
			  		$estado_material= crea_estado_material($link,$row[id_estado_material]);
					echo $estado_material;
					}
					?>								</td>
                  </tr>
                  <tr>
                    <td class="cajas"><? if($fecha_salida != '00-00-0000')echo $fecha_salida;?></td>
                  </tr>
              </table></td>
              <td colspan="2" nowrap="nowrap" ><table width="249" border="0">
                  <tr>
                    <td class="titulo" >
					<? if($nuevo or $mantsec) { ?>
					<input type="checkbox" name="mantsec" value="1" checked="checked"/> 
										
                    Mantener Secuencia <? }?></td>
                    </tr>
                  
              </table></td>
            </tr>
            <tr>
              <td colspan="3" nowrap="nowrap" ><? $id_bode=$row[id_mat_prima_nacional];?></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <? }} ?>
      <? if($nuevo){?>
	  
      <table width="600" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td><table width="440" border="0" align="center">
            <tr>
              <td width="185" nowrap="nowrap" class="titulo"   >Fecha Ingreso </td>
              <td width="245">
			   <? 
			   
			  $fecha=date("Y-m-d"); 
			  $fecha=format_fecha_sin_hora($fecha);
			  
			   //echo $fecha
			   ?>
                <input name="fecha_ingreso" type="text" class="cajas"  size="10" maxlength="10" value="<? echo $fecha;?>"/>
                <a href="javascript:show_Calendario('form1.fecha_ingreso');" class="cajas" >Ver</a></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="titulo"    >Comprobante Num </td>
              <td><input name="comprobante_num" type="text" class="cajas" value="<? echo $comprobante_num?>" size="44" maxlength="10" /></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="titulo"  >Origen</td>
              <td>
			<? 
			$origen= crea_origenes($link,$id_origen);
			echo $origen;
			?></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="titulo"  >Bidon N&uacute;mero</td>
              <td>  <?
					  if($cuantos)
					  {
					  while ($row=mysql_fetch_array($result))
      				  { 
      				  $id_mat_prima_nacional=$row[id_mat_prima_nacional];
					   
					     $cuenta=$row[bidon_num];
					     $bidon_num=$cuenta+1;
						
					  ?>
					  <input name="bidon_num" type="text" value="<?echo $bidon_num?>"  class="cajas" size="44" maxlength="10"/>
				  <? }
					  
					   }?>	</td>
            </tr>
            <tr>
              <td colspan="2" class="titulo"  ><table width="426" height="32" border="0">
                <tr>
                  <td width="85" class="titulo">Producto</td>
                  <td width="341"><? 
		 			$producto= crea_producto_onChange($link,$id_producto,0);
			        echo $producto;
			        ?>                      <? //echo "id producto $id_producto";?></td>
                  </tr>
                <tr>
                  <td class="titulo">Calibre</td>
                  <td><? 
					 if($id_producto){
		  $producto_calibre= crea_producto_calibre_codificacion($link,$id_producto,$id_calibre,1,0);
		  echo $producto_calibre;
		  }
					?></td>
                </tr>
                </table></td>
            </tr>
            <tr>
              <td nowrap="nowrap" ><table width="193" border="0" align="center">
                  <tr>
                    <td colspan="2" class="titulo" >Fecha de Faena </td>
                  </tr>
                  <tr>
                    <td colspan="2"><input name="fecha_faena" type="text" class="cajas" value="<? echo $fecha_faena?>" size="10" maxlength="10" />
                      <a href="javascript:show_Calendario('form1.fecha_faena');" class="cajas"  >Ver</a></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="titulo" >Contenido</td>
                  </tr>
                  <tr>
                    <td width="91"><input name="contenido" type="text" class="cajas" value="<? echo $contenido?>" size="15" /></td>
                    <td width="92">&nbsp;</td>
                  </tr>
                  <tr>
                    <td nowrap="nowrap" class="titulo" >Temperatura 1 </td>
                    <td nowrap="nowrap" class="titulo" >Temperatura 2</td>
                  </tr>
                  <tr>
                    <td><input name="temperatura1" type="text" class="cajas" value="<? echo $temperatura1?>" size="10" maxlength="4" /></td>
                    <td><input name="temperatura2" type="text" class="cajas" value="<? echo $temperatura2?>" size="10" maxlength="4" /></td>
                  </tr>
              </table></td>
              <td nowrap="nowrap" ><table width="210" border="0" align="right">
                  <tr>
                    <td colspan="2" class="titulo" >Fecha de Termino</td>
                  </tr>
                  <tr>
                    <td colspan="2"><input name="fecha_termino" type="text" class="cajas" value="<? echo $fecha_termino?>"  size="10" maxlength="10" />
                      <a href="javascript:show_Calendario('form1.fecha_termino');" class="cajas"  >Ver</a></td>
                  </tr>
                  <tr>
                    <td class="titulo" >RCP</td>
                    <td class="titulo" ><? if($brasil != 0){?>Medidas<? }?></td>
                  </tr>
                  <tr>
                    <td><input name="rcp" type="text" class="cajas" id="rcp" value="<? echo $rcp?>" size="10" maxlength="10" /></td>
                    <td><? 
					 if($brasil != 0){
					if($id_producto){
					$medidas_productos= crea_cruce_plant_medidas_productos($link,$id_producto,$id_medidas_productos);
					echo $medidas_productos;
					}
					}
					?></td>
                  </tr>
                  <tr>
                    <td class="titulo" >Unidad</td>
                    <td class="titulo" ><? if($brasil != 0){?>Calibre<? }?></td>
                  </tr>
                  <tr>
                    <td width="109"><span class="cajas">
                      <? 
					if($id_producto){
					$id_producto=$id_producto;
					
		 			$unidad_medida= crea_unidad_medida_producto($link,$id_producto);
					echo $unidad_medida;
				
					}
					?>
                    </span></td>
                    <td width="91"><? 
					 if($brasil != 0){
					if($id_producto){
					$calibre= crea_cruce_plant_calibre($link,$id_producto,$id_calibre);
					echo $calibre;
					}
					}
					?></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="2" nowrap="nowrap" class="titulo"  ><table width="440" border="0">
                  <tr>
                    <td width="129" class="titulo">Observaciones</td>
                    <td width="295"><input name="observaciones" type="text" class="cajas" value="<? echo $observaciones?>"  size="65" maxlength="50" /></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td nowrap="nowrap" ><table width="185" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="179" class="titulo" >Estado Material</td>
                  </tr>
                  <tr>
                    <td class="cajas">Bodega</td>
                  </tr>
              </table></td>
              <td nowrap="nowrap" ><table width="249" border="0">
                <tr>
                  <td class="titulo" ><? if ($mantsec or $nuevo){?><input type="checkbox" name="mantsec" value="1" />
                    Mantener Secuencia<? }?>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
               <tr>
              <td colspan="2" nowrap="nowrap" >&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=materia_prima_nacional.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=materia_prima_nacional.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=materia_prima_nacional.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=materia_prima_nacional.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"> <? if($permiso30 == 1){?><a href="?modulo=materia_prima_nacional.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
          <td width="55"><a href="?modulo=materia_prima_nacional.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62">
		     <? 
			
			// echo "id_estado_material $id_estado_material";
			 if($permiso30 == 1 and $nivel_usua == 2){?>
			 <? if(!$nuevo and $cuantos and !$mantsec){?>
              <a href="javascript: document.form1.submit();">
              <input type="hidden" name="modificar" value="modificar" />
              <img src="jpg/modificar.jpg" width="62" height="13" border="0" /> </a>
              <? }?> 
			  <? }
			  if($permiso30 == 1 and $nivel_usua == 1){
			  if(!$nuevo and $cuantos and !$mantsec){
			  ?>
			  <a href="javascript: document.form1.submit();">
              <input type="hidden" name="modificar" value="modificar" />
              <img src="jpg/modificar.jpg" width="62" height="13" border="0" /> </a>
			  <? 
			  }
			  } ?>
			  </td>
          <td width="55"><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?>          </td>
          <td width="45">
		   <? if($permiso30 == 1 and $nivel_usua == 2 and $id_estado_material != 2 and $id_estado_material != 4){?>
		  <? if(!$nuevo and $cuantos){?>
              <a href="?modulo=materia_prima_nacional.php&amp;borrar=<?=$id_bode?>" onclick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
              <? }?>
			  <? } 
			  if($permiso30 == 1 and $nivel_usua == 1){
			  if(!$nuevo and $cuantos){
			  ?>
			  <a href="?modulo=materia_prima_nacional.php&amp;borrar=<?=$id_bode?>" onclick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
			  <? }
			    }
				?>
			  </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=materia_prima_nacional_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>