<? 
if($buscar){
//echo "bbbbbbbbbbbbbbbbbbbbbbbbbbbb";
	 $largo=strlen($dato);
			  
	 if($largo == 7){ 
	 $agr=2;
	 $dato=$agr.$dato;
	 }
  	 if($largo == 8){
		 $agr=2;
	 $dato=$agr.$dato;
	 }
	 

$id_mpi=$dato;
}
if($id_mpi){
$sql="SELECT * FROM mat_prima_importada AS mpi, estado_material AS em where mpi.id_mat_prima_importada='$id_mpi' and mpi.id_mat_prima_importada != 0 and mpi.id_estado_material = em.id_estado_material order by mpi.id_mat_prima_importada desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM mat_prima_importada AS mpi, estado_material AS em where mpi.id_mat_prima_importada != 0 and mpi.id_estado_material = em.id_estado_material order by mpi.id_mat_prima_importada desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM mat_prima_importada AS mpi, estado_material AS em WHERE mpi.id_mat_prima_importada=mpi.id_mat_prima_importada and mpi.id_mat_prima_importada != 0 and mpi.id_estado_material = em.id_estado_material order by mpi.id_mat_prima_importada desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}

$fhoy=date("Y");
//$fhoy=2010;


  if($grabar_x){
 //echo "gggggggggggggggggggggggg";
 $sqlultimafecha="SELECT * FROM mat_prima_importada where id_mat_prima_importada=id_mat_prima_importada ORDER BY id_mat_prima_importada desc LIMIT 1";
$resulultimafecha=mysql_query($sqlultimafecha);
$cuantosultimafecha=mysql_num_rows($resulultimafecha);

 if ($rowultimafecha=mysql_fetch_array($resulultimafecha))
 { 
 $id_mat_prima_importada=$rowultimafecha[id_mat_prima_importada];
 $ultimoanorescatado=$rowultimafecha[ano];
 }
 
 if($ultimoanorescatado == $fhoy){
	
   $largo=strlen($rowultimafecha[id_mat_prima_importada]);
  
  if($largo == 8){
      $folio_formateado=substr($id_mat_prima_importada,1,8);
   }
  
   if($largo == 9){
      $folio_formateado=substr($id_mat_prima_importada,1,9);
   }
 $id=2;
 $id_mat_prima_importada_siguiente=$id.$folio_formateado+1;
 //echo "foliosssss $id_mat_prima_importada_siguiente";
}else{

 $id_mat_prima_importada=$rowul[id_mat_prima_importada];
 $id_mat_prima_importada_siguiente=$id_mat_prima_importada - $id_mat_prima_importada;
 $id_mat_prima_importada_siguiente++;
 
 $id_mat_prima_importada_siguiente_contar=strlen($id_mat_prima_importada_siguiente);
 
 if($id_mat_prima_importada_siguiente_contar == 1) $id_mat_prima_importada_siguiente="00000$id_mat_prima_importada_siguiente";
 if($id_mat_prima_importada_siguiente_contar == 2) $id_mat_prima_importada_siguiente="0000$id_mat_prima_importada_siguiente";
 if($id_mat_prima_importada_siguiente_contar == 3) $id_mat_prima_importada_siguiente="000$id_mat_prima_importada_siguiente";
 if($id_mat_prima_importada_siguiente_contar == 4) $id_mat_prima_importada_siguiente="00$id_mat_prima_importada_siguiente";
 if($id_mat_prima_importada_siguiente_contar == 5) $id_mat_prima_importada_siguiente="0$id_mat_prima_importada_siguiente";
 if($id_mat_prima_importada_siguiente_contar == 6) $id_mat_prima_importada_siguiente="$id_mat_prima_importada_siguiente";
 $anook=substr($fhoy,2,4);
 $id=2;
 $id_mat_prima_importada_siguiente=$id.$anook.$id_mat_prima_importada_siguiente;
 //echo "id_mat_prima_importada_siguiente $id_mat_prima_importada_siguiente";
}

 
  $dat2=split(" ",$fecha_ingreso);
  $dat=split("-",$dat2[0]);
  $fecha_ingreso1="$dat[2]-$dat[1]-$dat[0]";

 $sql_nuevo="insert into mat_prima_importada (id_mat_prima_importada,id_origen,ano,id_producto,id_estado_material,comprobante_num,bidon_num,contenido,glosa,rcpi,fecha_ingreso,id_unidad_medida,id_medidas_productos,id_calibre) values ($id_mat_prima_importada_siguiente,$id_origen,$fhoy,$id_producto,1,'$comprobante_num','$bidon_num','$contenido','$glosa','$rcpi','$fecha_ingreso1','$id_unidad_medida','$id_medidas_productos','$id_calibre')";
  //echo "--->$sql_nuevo<br>";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=materia_prima_importada.php\">";
  exit;
  }
  
  
if($borrar){
$sql_modificar="UPDATE  mat_prima_importada set borrari=1, id_estado_material  = 3 where id_mat_prima_importada=$borrar";
$rest=mysql_query($sql_modificar);
$id_mat=$borrar;
if($id_mpi){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=materia_prima_importada.php&id_mpi=$v\">";
 exit;
 }else{
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=materia_prima_importada.php&op=$op\">";
 exit;
 }

}// fin borraz
  
  
  
/*if($importado){
	
	echo "etiquetados_folios_id $importado";
//$sql_modificar="UPDATE  mat_prima_importada set borrari=1, id_estado_material  = 3 where id_mat_prima_importada=$borrar";
//$rest=mysql_query($sql_modificar);
//$id_mat=$borrar;


}*/
  
  
 
/*   if($borrar){
   $sql_borrar="delete from mat_prima_importada where id_mat_prima_importada = $borrar";
   $r=mysql_query($sql_borrar,$link);
  if($op == -1)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=materia_prima_importada.php&op=0\">";
   exit;
   }
  if($op == 0)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=materia_prima_importada.php&op=1\">";
   exit;
   }
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=materia_prima_importada.php&op=$op\">";
   exit;
  }//fin borrar
  */
 
  
  
  if($modificar){
  //echo "mmmmmmmmmmmmmmmmmmmmmmmmmm";
  //echo "estoy en modificar $materia_prima_importada";
  
  if($id_estado_material != 2){
    $fecha='0000-00-00';
	$borrari=0;
  }
  
  
  $dat2=split(" ",$fecha_ingreso);
  $dat=split("-",$dat2[0]);
  $fecha_ingreso2="$dat[2]-$dat[1]-$dat[0]";

  $dat3=split(" ",$fecha_salida);
  $dat1=split("-",$dat3[0]);
  $fecha_salida2="$dat1[2]-$dat1[1]-$dat1[0]";
  
  $dat4=split(" ",$fecha_elaboracion);
  $dat2=split("-",$dat4[0]);
  $fecha_elaboracion2="$dat2[2]-$dat2[1]-$dat2[0]";
 
 $sql_modificar="UPDATE  mat_prima_importada set id_origen='$id_origen',ano='$fhoy',id_producto='$id_producto',id_estado_material='1', comprobante_num='$comprobante_num', bidon_num='$bidon_num', contenido='$contenido', glosa='$glosa', rcpi='$rcpi',fecha_ingreso='$fecha_ingreso2', fecha_salida='$fecha_salida2', fecha_elaboracion = '$fecha_elaboracion2', id_unidad_medida='$id_unidad_medida', id_medidas_productos='$id_medidas_productos',id_calibre='$id_calibre',borrari = '$borrari' where id_mat_prima_importada=$id_mat_prima_importada";
//echo "$sql_modificar";
$rest=mysql_query($sql_modificar);

if($id_mpi){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=materia_prima_importada.php&id_mpi=$id_mpi\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=materia_prima_importada.php&op=$op\">";
 exit;
 }

}
 


?>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<script language="javascript">
function solo_numeros(){
var key=window.event.keyCode;
if (key < 48 || key > 57){
window.event.keyCode=0;
}}
</script>
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
.numero {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
body {
	margin-top: 0px;
}
-->
</style>

<form id="form1" name="form1" method="post" action="">
<table width="508" border="0" align="center">
  
  <tr>
    <td width="363" height="14" class="titulo">Materia Prima Importada </td>
    <td width="233" colspan="2"><div align="right"><span class="cajas">Ej: 10001417</span><strong></strong>
      <? if($cuantos){?>
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
      { $id_mat_prima_importada=$row[id_mat_prima_importada];
	  	$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
		$fecha_elaboracion=format_fecha_sin_hora($row[fecha_elaboracion]);
		$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
		$id_estado_material=$row[id_estado_material];
	 ?>
      <span class="titulo">
      <input name="id_mat_prima_importada" type="hidden" value="<?echo $row[id_mat_prima_importada]?>" />
      </span>
      <table width="600" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td><table width="550" border="0" align="center">
            <tr>
              <td width="185" class="titulo" >N&uacute;mero</td>
              <td colspan="2"><span class="numero">I<? 
		      
			   $largo=strlen($row[id_mat_prima_importada]);
			  
			   if($largo == 8){ 
			   $id_mat_prima_importada=substr($id_mat_prima_importada,1,8);
			   }
  			   if($largo == 9){
			   $id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
			   }
			  ?>
			  <?
			   echo $id_mat_prima_importada;
			   ?>
                  <? if($row[borrari]){?>
                  <span class="style3">Folio Anulado </span>
                  <? }?>
</span></td>
            </tr>
            <tr>
              <td class="titulo" >Fecha Ingreso </td>
              <td><input name="fecha_ingreso" type="text" class="cajas"  value="<?echo $fecha_ingreso?>" size="8" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fecha_ingreso');" class="cajas">Ver</a></td>
              <td align="center" class="titulo"><? if ($row[etiquetados_folios_id]) {?>ID Etiquetados Folios: <? }?></td>
            </tr>
            <tr>
              <td class="titulo" >Fecha Elaboraci&oacute;n</td>
              <td><input name="fecha_elaboracion" type="text" class="cajas"  value="<?echo $fecha_elaboracion?>" size="8" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fecha_elaboracion');" class="cajas">Ver</a></td>
              <td align="center" valign="top">
              <span class="titulo">
                <? if ($row[etiquetados_folios_id]) {?>[
			 	<? echo $row[etiquetados_folios_id]; ?>]
                <? }?>
              </span></td>
            </tr>
            <tr>
              <td class="titulo"  >N&ordm; Factura Importada</td>
              <td colspan="2" class="cajas">
			  <? echo $row[comprobante_num]?>
               <input name="comprobante_num" type="hidden" value="<?echo $row[comprobante_num]?>" />
              </td>
            </tr>
            <tr>
              <td class="titulo">Origen</td>
              <td colspan="2"><? 
			$origen= crea_origenes($link,$row[id_origen]);
			echo $origen;
			?></td>
            </tr>
            <tr>
              <td class="titulo">N&ordm; Bidon Importado</td>
              <td colspan="2" class="cajas">
			  <? echo $row[bidon_num]?>
               <input name="bidon_num" type="hidden" value="<?echo $row[bidon_num]?>" />
              </td>
            </tr>
            <tr>
              <td class="titulo">Producto</td>
              <td colspan="2"><? 
			  //echo "$row[id_producto]<br>";
			$producto= crea_producto_onChange($link,$row[id_producto]);
		 echo $producto;
			?></td>
            </tr>
            <tr>
              <td class="titulo">Cod. Contenido (Unid./Kgs.) . </td>
              <td colspan="2"><input name="contenido" type="text" class="cajas" value="<?echo $row[contenido]?>" size="44" maxlength="10" /></td>
            </tr>
            <tr>
              <td class="titulo">Glosa</td>
              <td colspan="2"><input name="glosa" type="text" class="cajas" value="<?echo $row[glosa]?>" size="44" maxlength="40" /></td>
            </tr>
            <tr>
              <td class="titulo">Estado Material</td>
              <td colspan="2"><? if(!$mantsec){?>
                <?
			  		$estado_material= crea_estado_material($link,$row[id_estado_material]);
			  		if($row[id_estado_material] != 1){
			  		echo $estado_material;
					}else{
					?>
					<span class="cajas">Bodega</span>
				<? }} ?>
                            
                <span class="cajas"><? if($fecha_salida != '00-00-0000')echo $fecha_salida;?></span></td>
            </tr>
            <tr>
              <td class="titulo">RCP</td>
              <td width="221"><input name="rcpi" type="text" class="cajas" id="rcpi" value="<?echo $row[rcpi]?>" size="10" maxlength="10" /></td>
              <td width="130"><span class="titulo"><!--Valor asignado: $-->
                  <?  
						//$valor_cmpi=$row[valor_cmpi];
										
						//echo "$valor_cmpi";
						
						
						?>
              </span></td>
            </tr>
            <? if($brasil != 0){?>
            <tr>
             <td class="titulo">Medidas</td>
              <td colspan="2"><? 
						  //echo " idp $row[id_producto] - unidad medida $row[id_medidas_productos]";
					if($row[id_producto]){
					$medidas_productos= crea_cruce_plant_medidas_productos($link,$row[id_producto],$row[id_medidas_productos]);
					echo $medidas_productos;
					}
					?></td>
            </tr>
			<? }?>
            <tr>
              <td class="titulo">Unidad</td>
              <td colspan="2"><span class="cajas">
                <? 
					if($row[id_producto]){
					$id_producto=$row[id_producto];
					
		 			$unidad_medida= crea_unidad_medida_producto($link,$id_producto);
					echo $unidad_medida;
				
					}
					?>
              </span></td>
            </tr>
			<? if($brasil != 0){?>
            <tr>
              <td class="titulo">Calibre</td>
              <td colspan="2"><?
						 //echo " idp $row[id_producto] - unidad medida $row[id_calibre]";
					if($row[id_producto]){
					$calibre= crea_cruce_plant_calibre($link,$row[id_producto],$row[id_calibre]);
					echo $calibre;
					}
					?></td>
            </tr>
			<? }?>
            <tr>
              <td class="titulo">Mantener Secuencia </td>
              <td><span class="titulo">
                <input type="checkbox" name="mantsec" value="1" />
              </span></td>
              <!--<td class="cajas"><span class="titulo">Enviar  Producto Importado</span></td>-->
            </tr>
            <? if($destino){?>
            <? } ?>
            <tr>
              <td >&nbsp;</td>
              <td ><? $id_bode=$row[id_mat_prima_importada];
			   $etiquetados_folios_id2=$row[etiquetados_folios_id];
			  
			  ?></td>
              <td > <!--<input type="checkbox" name="volver_producto_terminado" value="1" />--></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <?}}?>
      <? if($nuevo){?>
      <table width="600" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td><table width="433" border="0" align="center">
              <tr>
                <td width="123" class="titulo" >Fecha Ingreso </td>
                <td>
				<? $fecha=date("Y-m-d"); 
			   $fecha=format_fecha_sin_hora($fecha);
			   //echo $fecha
			   ?>
				<input name="fecha_ingreso" type="text" class="cajas" size="8" maxlength="10" value="<? echo $fecha;?>" />
                  <a href="javascript:show_Calendario('form1.fecha_ingreso');" class="cajas">Ver</a></td>
              </tr>
              <tr>
                <td class="titulo"  >N&ordm; Factura Importada</td>
                <td><input name="comprobante_num" type="text" class="cajas"  size="44" maxlength="10" value="<? echo $comprobante_num?>" /></td>
              </tr>
              <tr>
                <td class="titulo">Origen</td>
                <td><? 
			$origen= crea_origenes($link,$id_origen);
			echo $origen;
			?></td>
              </tr>
              <tr>
                <td class="titulo">N&ordm; Bidon Importado</td>
                <td><input name="bidon_num" type="text" class="cajas" size="44" maxlength="10" value="<? echo $bidon_num?>"/></td>
              </tr>
              <tr>
                <td class="titulo">Producto</td>
                <td><? 
			$producto= crea_producto_onChange($link,$id_producto);
		 echo $producto;
			?></td>
              </tr>
              <tr>
                <td class="titulo">Cod. Contenido (Unid./Kgs.) . </td>
                <td><input name="contenido" type="text" class="cajas" size="44" maxlength="10" value="<? echo $contenido?>" /></td>
              </tr>
              <tr>
                <td class="titulo">Glosa</td>
                <td><input name="glosa" type="text" class="cajas" size="44" maxlength="40" value="<? echo $glosa?>"/></td>
              </tr>
              <tr>
                <td class="titulo">Estado Material</td>
                <td class="cajas">Bodega</td>
              </tr>
              <tr>
                <td class="titulo">RCP</td>
                <td class="cajas"><input name="rcpi" type="text" class="cajas" id="rcpi" size="10" maxlength="10" value="<? echo $rcpi?>"/></td>
              </tr>
			  <? if($brasil != 0){?>
              <tr>
                <td class="titulo">Medidas</td>
                <td class="cajas"><? 
					if($id_producto){
					$medidas_productos= crea_cruce_plant_medidas_productos($link,$id_producto,$id_medidas_productos);
					echo $medidas_productos;
					}
					?></td>
              </tr>
			  <? }?>
              <tr>
                <td class="titulo">Unidad</td>
                <td class="cajas"><? 
					if($id_producto){
					$id_producto=$id_producto;
					
		 			$unidad_medida= crea_unidad_medida_producto($link,$id_producto);
					echo $unidad_medida;
				
					}
					?></td>
              </tr>
			  <? if($brasil != 0){?>
              <tr>
                <td class="titulo">Calibre</td>
                <td class="cajas"><? 
					if($id_producto){
					$calibre= crea_cruce_plant_calibre($link,$id_producto,$id_calibre);
					echo $calibre;
					}
					?></td>
              </tr>
			  <? }?>
              <? if($destino){?>
              <? } ?>
              <tr>
                <td class="titulo" >Mantener Secuencia </td>
                <td ><span class="titulo">
                  <input type="checkbox" name="mantsec" value="1" />
                </span></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="528" border="0" align="center">
        <tr>
          <td width="54" class="style2"><a href="?modulo=materia_prima_importada.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td width="58" class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=materia_prima_importada.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td width="54"><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=materia_prima_importada.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td width="47"><? if ($cuantos){ ?>
              <a href="?modulo=materia_prima_importada.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="0"><? if($permiso32 == 1){?><a href="?modulo=materia_prima_importada.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
          <td width="55"><a href="?modulo=materia_prima_importada.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62">
		   <? if($permiso32 == 1 and $nivel_usua == 2 and $id_estado_material != 2){?>
		     <? if(!$nuevo and $cuantos and !$mantsec){?>
              <a href="javascript: document.form1.submit();">
              <input type="hidden" name="modificar" value="modificar" />
              <img src="jpg/modificar.jpg" width="62" height="13" border="0" /> </a>
              <? }?>
			<? }
			if($permiso32 == 1 and $nivel_usua == 1){
			if(!$nuevo and $cuantos and !$mantsec){
			?>  
			 <a href="javascript: document.form1.submit();">
              <input type="hidden" name="modificar" value="modificar" />
              <img src="jpg/modificar.jpg" width="62" height="13" border="0" /> </a>
			<? } 
			}
			?>
			  </td>
          <td width="32">
		  <? if($permiso32 == 1){?>
		  <? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?><? }?></td>
          <td width="45">
		     <? if($permiso32 == 1 and $nivel_usua == 2 and $id_estado_material != 2){?>
		     <? if(!$nuevo and $cuantos){?>
              <a href="?modulo=materia_prima_importada.php&amp;borrar=<?=$id_bode?>&etiquetados_folios_id3=<? echo $etiquetados_folios_id2?>" onClick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
              <? }?>
			  <? }
			  if($permiso32 == 1 and $nivel_usua == 1){
			  if(!$nuevo and $cuantos){
			  ?>
			  <a href="?modulo=materia_prima_importada.php&amp;borrar=<?=$id_bode?>&etiquetados_folios_id3=<? echo $etiquetados_folios_id2?>" onClick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
			  <? } 
			  }
			  ?>
			  </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=materia_prima_importada_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="30"></td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
