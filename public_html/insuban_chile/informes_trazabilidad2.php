<?

if($fecha_terminod and $fecha_terminoh){
$fecha_ingresodesde=format_fecha_sin_hora($fecha_terminod);
$fecha_ingresohasta=format_fecha_sin_hora($fecha_terminoh);
}


      if(!$entreano1){
					$entreano1=$fhoy=date("Y");
					$entreano1=$entreano1-1;
					}
					if(!$entreano2){
					$entreano2=$fhoy=date("Y");
					}

if(!$picking and $buscar ){ 

$sql="SELECT * FROM etiquetados_folios AS ef, paking AS p, estado_folio AS est, producto AS pro, unidad_medida AS u WHERE ef.id_etiquetados_folios = p.id_etiquetados_folios AND ef.id_estado_folio = est.id_estado_folio and ef.id_unidad_medida = u.id_unidad_medida";

if($id_producto){
   $sql.= " and ef.id_producto = $id_producto ";
}

if($id_estado_folio){
   $sql.= " and ef.id_estado_folio = $id_estado_folio ";
}

if($entreano1){
  $sql.= " and ef.ano between '$entreano1' and '$entreano2' ";
}

if($factura){
   $sql.= " and ef.factura = $factura ";
}

if($foliobus){
   $sql.= " and ef.id_etiquetados_folios = $foliobus ";
}

if($desde and $hasta){
$sql.= " and ef.id_etiquetados_folios between '$desde' and '$hasta'";
}


if($fecha_ingresodesde and $fecha_ingresohasta){
$sql.= " and ef.f_elaboracion between '$fecha_ingresodesde' and '$fecha_ingresohasta'";}

$sql.=" group by ef.id_etiquetados_folios ";
$result=mysql_query($sql);	
$cuantos=mysql_num_rows($result);
//echo "SQL --> $sql<br>";
}

if($picking and $buscar){

$sql="SELECT * FROM paking AS p, etiquetados_folios AS ef, producto AS pro WHERE p.folio_piking =$picking AND p.id_etiquetados_folios = ef.id_etiquetados_folios and ef.id_producto = pro.id_producto";


if($id_estado_folio){
	$sql.= " and ef.id_estado_folio = $id_estado_folio ";
}

if($id_producto){
	$sql.= " and ef.id_producto = $id_producto ";
}
if($entreano1){
	$sql.= " and ef.ano between '$entreano1' and '$entreano2' ";
}
if($factura){
	$sql.= " and ef.factura = $factura ";
}

if($fecha_ingresodesde and $fecha_ingresohasta){
$sql.= " and ef.f_termino between '$fecha_ingresodesde' and '$fecha_ingresohasta'";}

$sql.=" group by ef.id_etiquetados_folios ";
$result=mysql_query($sql);	
$cuantos=mysql_num_rows($result);
}

if($id_estado_folio == 2 or $id_estado_folio == 1 or $id_estado_folio == 6 or $id_estado_folio == 9 or $id_estado_folio == 5 ){ 
   $sql="SELECT * FROM etiquetados_folios AS ef, folios_mat AS fm, producto AS pro,  estado_folio AS est WHERE ef.id_etiquetados_folios = fm.id_etiquetados_folios and ef.id_producto = pro.id_producto and ef.id_estado_folio = est.id_estado_folio ";
	


if($id_estado_folio){
	$sql.= " and ef.id_estado_folio = $id_estado_folio ";
}

if($id_producto){
	$sql.= " and ef.id_producto = $id_producto ";
}
if($entreano1){
	$sql.= " and ef.ano between '$entreano1' and '$entreano2' ";
}
if($factura){
	$sql.= " and ef.factura = $factura ";
}

$sql.=" group by ef.id_etiquetados_folios ";
$result=mysql_query($sql);	
$cuantos=mysql_num_rows($result);

$consultasbodegas=2;
}




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
.style1 {color: #CCCCCC}
-->
</style>

<form id="form1" name="form1" method="post" action="">
<table width="649" border="0" align="center">
            <tr>
              <td width="619" height="16"><span class="titulo">Informe Trazabilidad de Folios</span></td>
              <td width="49"> <a href="?modulo=informes_trazabilidad.php" class="cajas">Volver</a></td>
            </tr>
            <tr>
              <td colspan="2"><table width="672" border="1" align="center" bordercolor="#CCCCCC">
                <tr>
                  <td width="662" height="154"><table width="663" border="0" align="center">
                    <tr>
                      <td width="157" class="titulo">Estado Folio </td>
                      <td width="212" class="titulo">Producto</td>
                      <td><span class="titulo">Picking</span></td>
                      <td><span class="titulo">Factura</span></td>
                    </tr>
                    <tr>
                      <td><? $estado_folio=crea_estado_folio($link,$id_estado_folio,0);
		echo $estado_folio;?></td>
                      <td><? $producto= crea_producto_onchange2($link,$id_producto);
		 echo $producto;?></td>
                      <td><input name="picking" type="text" class="cajas" id="picking" size="10" value="<? echo $picking ?>" /></td>
                      <td><span class="titulo">
                        <input name="factura" type="text" class="cajas" id="factura" size="10" value="<? echo $factura ?>" />
                      </span></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="19" colspan="2"><span class="cajas">[* Fecha por defecto A&ntilde;o <? echo $entreano1?> - <? echo $entreano2?>]</span></td>
                      <td colspan="2" class="titulo">&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#CCCCCC" class="titulo">A&ntilde;o (Entre el <? echo $entreano1?> - <? echo $entreano2?>) </td>
                       
                      <td><input name="entreano1" type="text" class="cajas" id="entreano1" value="<? echo $entreano1 ?>" size="3" maxlength="4" />
                        <input name="entreano2" type="text" class="cajas" id="entreano2" value="<? echo $entreano2 ?>" size="3" maxlength="4" /></td>
                      <td colspan="2" bgcolor="#CCCCCC"><span class="titulo">Fecha Elaboraci&oacute;n</span></td>
                    </tr>
                    <tr>
                      <td bgcolor="#CCCCCC" class="titulo">N&ordm; Folio</td>
                      <td><span class="titulo">
                        <input name="foliobus" type="text" class="cajas" id="foliobus" size="13" value="<? echo $foliobus ?>" />
                      </span></td>
                      <td width="138" class="titulo">Desde</td>
                      <td width="138" class="titulo">Hasta</td>
                    </tr>
                    <tr>
                      <td bgcolor="#CCCCCC" class="titulo">Desde  Folio N&ordm;</td>
                      <td><input name="desde" type="text" class="cajas" id="desde" size="13" value="<? echo $desde ?>" /></td>
                      <td width="138" class="titulo"><input name="fecha_terminod" type="text" class="cajas"   id="fecha_terminod"  value="<?echo $fecha_terminod?>" size="10" maxlength="10" />
                      <a href="javascript:show_Calendario('form1.fecha_terminod');" class="cajas"  > Ver</a></td>
                      <td width="138" class="titulo"><input name="fecha_terminoh" type="text" class="cajas"   id="fecha_terminoh"  value="<?echo $fecha_terminoh?>" size="10" maxlength="10" />
                      <a href="javascript:show_Calendario('form1.fecha_terminoh');" class="cajas"  > Ver</a></td>
                    </tr>
                    <tr>
                      <td bgcolor="#CCCCCC" class="titulo">Hasta Folio N&ordm;</td>
                      <td><input name="hasta" type="text" class="cajas" id="hasta" size="13" value="<? echo $hasta ?>" /></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="titulo">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="titulo">&nbsp;</td>
                      <td align="center"><span class="titulo">
                        <input name="buscar" type="submit" class="cajas" value="Buscar" />
                      </span></td>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
  </table> 
<? if($buscar and $cuantos){ ?>
<a href="excel_etiquetas_folios_trazabilidad.php?id_estado_folio=<? echo $id_estado_folio;?>&id_producto=<? echo $id_producto?>&picking=<? echo $picking?>&anotrab=<? echo $anotrab?>&desde=<? echo $desde?>&hasta=<? echo $hasta?>&factura=<? echo $factura?>&entreano1=<? echo $entreano1?>&entreano2=<? echo $entreano2?>" target="_blank"><img src="jpg/icono-excel.gif" width="33" height="33" border="0" /></a>
<table width="798" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="41" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="center">Picking</div></td>
                    <td width="27" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Folio</td>
                    <td width="23" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">A&ntilde;o</td>
                    <td width="126" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Producto</td>
                    <td width="39" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Calibre</td>
                    <td width="85" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Unid/Med</td>
                    <td width="40" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Medida</td>
                    <td width="61" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Contenido</td>
                    <td width="52" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">F/Faena </td>
                    <td width="60" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">F/Termino </td>
                    <td width="45" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Factura</td>
                    <td width="97" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Operador</td>
                    <td width="74" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Est. Material </td>
                  </tr>
                    <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$f_elaboracionok=format_fecha_sin_hora($row[f_elaboracion]);
	$f_terminook=format_fecha_sin_hora($row[f_termino]);
	$i++;
	
	if(!$valorpiking){
	$sql_pik="SELECT * FROM paking AS pik, etiquetados_folios AS ef WHERE pik.id_etiquetados_folios=ef.id_etiquetados_folios and pik.id_etiquetados_folios= $row[id_etiquetados_folios]";
    }else{
	$sql_pik=" SELECT * FROM paking AS pik, etiquetados_folios AS ef WHERE pik.id_etiquetados_folios = ef.id_etiquetados_folios and pik.folio_piking = $valorpiking";
	}
	$result_pik=mysql_query($sql_pik);
	$cuantos_pik=mysql_num_rows($result_pik);
	

	?>

                  <tr>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;
					<? 
					if($cuantos_pik){
					while ($rowpik=mysql_fetch_array($result_pik)){ 
					$pik=$rowpik[folio_piking]; echo $rowpik[folio_piking]; 
					$id_etiq_fo=$row[id_etiquetados_folios];
					}
					}					
					?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;<? echo $row[id_etiquetados_folios];?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;<? echo $row[ano] ?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;
					<? 
					$sql_pro="SELECT * FROM producto WHERE id_producto= $row[id_producto]";
					$result_pro=mysql_query($sql_pro);
					if ($rowpro=mysql_fetch_array($result_pro)){
					echo "$rowpro[producto] $rowpro[id_producto]";
					}
					?>
					</td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">
					<? 
					$sql_cali="SELECT * FROM calibre WHERE id_calibre= $row[id_calibre]";
					$result_cali=mysql_query($sql_cali);
					if ($rowcali=mysql_fetch_array($result_cali)){
					echo $rowcali[calibre];
					}
					?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">
					<? 
					$sql_unidad="SELECT * FROM unidad_medida WHERE id_unidad_medida= $row[id_unidad_medida]";
					$result_unidad=mysql_query($sql_unidad);
					if ($rowunidad=mysql_fetch_array($result_unidad)){
					echo $rowunidad[unidad_medida];
					$id_unidad_medida=$rowunidad[id_unidad_medida];
					}
					?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;
					<? 
					$sql_unipro="SELECT * FROM medidas_productos WHERE id_medidas_productos= $row[id_medidas_productos]";
					$result_unipro=mysql_query($sql_unipro);
					if ($rowunipro=mysql_fetch_array($result_unipro)){
					$id_medidas_productos=$row[id_medidas_productos];
					echo $rowunipro[medidas_productos];
					}
					?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;<? echo $row[contenido_unidades] ?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;<? echo $f_elaboracionok ?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;<? echo $f_terminook ?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;<? echo $row[factura] ?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">
					<? 
					$sql_ope="SELECT * FROM operarios WHERE id_operarios= $row[id_operarios]";
					$result_ope=mysql_query($sql_ope);
					if ($rowope=mysql_fetch_array($result_ope)){
					echo "$rowope[nombreop] $rowope[apellido]";
					}
					?></td>
                    <td nowrap="nowrap" bgcolor="#FFCC99" class="cajas">&nbsp;
					<? 
					$sql_estfolio="SELECT * FROM estado_folio WHERE id_estado_folio= $row[id_estado_folio]";
					$result_estfolio=mysql_query($sql_estfolio);
					if ($rowresult_estfolio=mysql_fetch_array($result_estfolio)){
					echo "$rowresult_estfolio[estado_folio]";
					}
					?>
					</td>
                  </tr>
                  <tr>
                    <td colspan="13" nowrap="nowrap" class="cajas"><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="4%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Folio</td>
                        <td width="6%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; MPN </td>
                        <td width="8%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto </td>
                        <td width="8%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F/ Ingreso </td>
                        <td width="8%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F/Faena </td>
                        <td width="4%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F/ Termino </td>
                        <td width="5%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F/ Salida </td>
                        <td width="9%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Contenido</td>
                        <td width="9%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Origen</td>
                        <td width="3%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">RCP</td>
                        <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"> N&ordm; Comprob.</td>
                        <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"> N&ordm; Bidon </td>
                        <td nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Unid/Med</td>
             </tr> 
             
           
<? 
		  $sql_buscar="SELECT * 
FROM folios_mat AS fm, mat_prima_nacional AS mpn, producto AS pro, origenes AS orig
WHERE fm.id_etiquetados_folios = $id_etiquetados_folios
AND fm.id_mat = fm.folioptnew_reproceso
AND mpn.id_origen = orig.id_origen
AND mpn.id_producto = pro.id_producto and fm.id_procedencia != ''";
$result_buscar=mysql_query($sql_buscar);
$cuantos_buscar=mysql_num_rows($result_buscar);
echo "sql_buscar $sql_buscar<br>";
 		if($cuantos_buscar){

		 while ($r=mysql_fetch_array($result_buscar)) { 
		 $ano=substr($r[ano], 2, 3);
		 //$base="N".$ano.$r[id_mat_prima_nacional];
		 $fecha_faena=format_fecha_sin_hora($r[fecha_faena]);
	     $fecha_termino=format_fecha_sin_hora($r[fecha_termino]);
		 $fecha_ingreso=format_fecha_sin_hora($r[fecha_ingreso]);
		 $fecha_salida=format_fecha_sin_hora($r[fecha_salida]);
		 $id_producto_material=$r[id_producto];
?>
                      <tr>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? if(!$consultasbodegas) { echo $id_etiq_fo; }else{ echo $r[id_etiquetados_folios];}?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $r[id_mat_prima_nacional];?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $r[producto];?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $fecha_ingreso;?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $fecha_faena ?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $fecha_termino;?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $fecha_salida;?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $r[contenido];?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo" $r[origen]";?>11</td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $r[rcp];?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $r[comprobante_num];?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $r[bidon_num];?></td>
                        <td width="4%" nowrap="nowrap" class="cajas">&nbsp;
						<? 
						//$sqlmuestrauni="select * from unidad_medida where id_unidad_medida = $r[id_unidad_medida]";
						//$resultmuestrauni=mysql_query($sqlmuestrauni,$link);
						//if ($rowmuestrauni=mysql_fetch_array($resultmuestrauni)){
						//echo $rowmuestrauni[unidad_medida];
						//}
						?>
						<? //echo "$id_producto_material";
						
						if($id_producto_material){
						$unidad_medida= crea_unidad_medida_producto2($link,$id_producto_material);
					    echo $unidad_medida;
						}
						
							
						
						
					?></td>
                      </tr>
                      
                          <? } // while
					   } //fin if($cuantos_buscar){
					  ?>
                      
                      <? 
		  $sql_buscarim="SELECT * 
FROM folios_mat AS fm, mat_prima_importada AS mpi, producto AS pro, origenes AS orig
WHERE fm.id_etiquetados_folios = $id_etiquetados_folios
AND fm.id_mat = mpi.id_mat_prima_importada
AND mpi.id_origen = orig.id_origen
AND mpi.id_producto = pro.id_producto ";
$result_buscarim=mysql_query($sql_buscarim);
$cuantos_buscarim=mysql_num_rows($result_buscarim);

 		if($cuantos_buscarim){

		 while ($ri=mysql_fetch_array($result_buscarim)) { 
		 $ano=substr($ri[ano], 2, 3);
		 //$base="N".$ano.$r[id_mat_prima_nacional];
		 $fecha_elaboracion=format_fecha_sin_hora($ri[fecha_elaboracion]);
	     //$fecha_termino=format_fecha_sin_hora($ri[fecha_termino]);
		 $fecha_ingreso=format_fecha_sin_hora($ri[fecha_ingreso]);
		 $fecha_salida=format_fecha_sin_hora($ri[fecha_salida]);
		 $id_producto_material=$ri[id_producto];
?>

                      <tr>
                        <td nowrap="nowrap" class="cajas">&nbsp;
                        <? if(!$consultasbodegas) { echo $id_etiq_fo; }else{ echo $row[id_etiquetados_folios];;}?>
                         <?
           $largo=strlen($ri[id_mat_prima_importada]);
		   if($largo == 8){ 
		   $id_mat_prima_importada=substr($ri[id_mat_prima_importada],1,7);
		   }
  		   if($largo == 9){
		   $id_mat_prima_importada=substr($ri[id_mat_prima_importada],1,8);
		   }
		  
	  	 ?>
                        
                        </td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $id_mat_prima_importada;?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $ri[producto];?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $fecha_ingreso;?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $fecha_elaboracion ?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? //echo $fecha_termino;?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $fecha_salida;?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $ri[contenido];?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo" $ri[origen]";?>22</td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $ri[rcp];?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $ri[comprobante_num];?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $ri[bidon_num];?></td>
                        <td nowrap="nowrap" class="cajas">&nbsp;
                          <? 
						//$sqlmuestrauni="select * from unidad_medida where id_unidad_medida = $r[id_unidad_medida]";
						//$resultmuestrauni=mysql_query($sqlmuestrauni,$link);
						//if ($rowmuestrauni=mysql_fetch_array($resultmuestrauni)){
						//echo $rowmuestrauni[unidad_medida];
						//}
						?>
                        <? //echo "$id_producto_material";
						
						if($id_producto_material){
						$unidad_medida= crea_unidad_medida_producto2($link,$id_producto_material);
					    echo $unidad_medida;
						}
						
							
						
						
					?></td>
                      </tr>
                       <? } // while importado
					   } //fin if($cuantos_buscarim){
					  ?>
                    
                  
                    
                    </table>
                    <? }?></td>
                  </tr>
</table>
 
<? } ?>
</form>