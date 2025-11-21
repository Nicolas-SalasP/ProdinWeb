<?


if($asignar){
	$dat1=split(" ",$fechaentrega);
	$dat=split("-",$dat1[0]);
  	$fechaentregok="$dat[2]-$dat[1]-$dat[0]";
	$fechaces = date("Y-m-d");
	
 		 $fechaces = date("Y-m-d");
		 $sql_c_es_so="insert cambio_estado_solicitud (id_usuario,id_ce,id_procedencia,id_origen,id_producto,fechaces,fechaentrega) values ('$id_insuban','$id_ce','N',27,'$id_producto','$fechaces','$fechaentregok')";
    	 $result_c_es_so=mysql_query($sql_c_es_so,$link);
		 $id_ultimo=mysql_insert_id();
 		//echo "Sql $sql_c_es_so<br>";
		
	foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
     
	if ($dat[0] == 'id_etiquetados_folios')
   {
	$id=$dat[1];
   	$id_etiquetados_folioslis=$_POST["id_etiquetados_folios-$id"];  
	
	if($pt !='N'){
	//echo "estoy dentro";
	$id_etiquetados_folioslisd="$id_etiquetados_folioslis";
	$sqlpt="SELECT * FROM etiquetados_folios WHERE id_etiquetados_folios = $id_etiquetados_folioslisd";
	$resultpt=mysql_query($sqlpt);
	//echo "sqlpt $sqlpt<br>";
	$cuantosiiii=mysql_num_rows($resultpt);
	if ($rowpt=mysql_fetch_array($resultpt)) { 
    $id_pt=$rowpt[id_etiquetados_folios];
	$contenidopt+=$rowpt[contenido_unidades];
	}//if ($rowimp=mysql_fetch_array($resulti)) { 
	//echo " id_pt $id_pt<br>";
	$sqlupdate="UPDATE etiquetados_folios  set id_c_es_so = '$id_ultimo', ocupado = 1 where id_etiquetados_folios  = $id_pt";
 	$resultupdate=mysql_query($sqlupdate);   
	//echo "sqlupdate $sqlupdate<br>";
	}//if($id_procedencia =='N'){
		
	$sql_impk="insert cambio_estado_detalle(id_c_es_so,id_ce,foliosmpfsp,id_procedencia) values ('$id_ultimo','$id_ce','$id_pt','N')";
    $result_smpk=mysql_query($sql_impk,$link);
	//echo "sql_impk $sql_impk<br>";
	
	}
	}
	 $unidadessolicitadas+=$contenidopt;
	 
	$sqlupdatecantidad="UPDATE cambio_estado_solicitud  set unidadessolicitadas = '$contenidopt' where id_c_es_so=$id_ultimo and id_ce  = $id_ce";
 	$resultupdatecantidad=mysql_query($sqlupdatecantidad);   
  
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=solicitudcpendientes.php&id_ce=$id_ce&tic=2\">";
exit;
}

?>
<script language="JavaScript">
function isMailReady(form1) {
var passed = false;

if (document.form1.id_producto.value==0) {     
    alert('Debe seleccionar producto');
    document.form1.id_producto.onfocus;
    return false;
}
if (document.form1.fechaentrega.value=="") {     
    alert('Debe ingresar fecha de entrega ');
    document.form1.fechaentrega.onfocus;
    return false;
}

else {
getInfo(form1);
passed = true;
}
return passed;
}
</SCRIPT>
<h1>STOCK DE PRODUCTO TERMINADO</h1>
<table width="1010" height="326" border="0">
 <tr>
   <td height="8" colspan="13"><table width="966" border="0">
     <tr>
       <td width="292" valign="top" nowrap="nowrap"><table width="288" border="0">
         <tr>
           <td>&nbsp;<? 
					  $producto= crea_producto_onChange_segunestado($link,2,$id_producto);
				  	  echo $producto;
					  ?></td>
         </tr>
         <tr>
           <td>&nbsp;<? if ($id_producto) {
		$calibre=crea_calibre_filtro($link,$id_calibre,$id_producto,1);
		echo $calibre;
		   
		   }
		   ?>
           </td>
         </tr>
         <tr>
           <td>&nbsp;<? 
		   if ($id_producto) {
						$unidad_medida=crea_unidad_medida_filtro($link,$id_unidad_medida,$id_producto,1);
					echo $unidad_medida;
					}
		   ?></td>
         </tr>
         <tr>
           <td>&nbsp;<?  if ($id_producto) {
					$medidas_productos=crea_medidas_productos_filtro($link,$id_medidas_productos,$id_producto,1);
					echo $medidas_productos;
					}
					?></td>
         </tr>
         <tr>
           <td>&nbsp;<? 
		    if ($id_producto) {
					$caract_producto=crea_caract_producto_filtro($link,$id_caract_producto,$id_producto,1);
					echo $caract_producto;
					}
					
		   ?></td>
         </tr>
         <tr>
           <td>&nbsp;<? 
		    if ($id_producto) {
					$caract_envases=crea_caract_envases_filtro($link,$id_caract_envases,$id_producto,1);
					echo $caract_envases;
					}
		   ?></td>
         </tr>
         <tr>
           <td>&nbsp;</td>
         </tr>
       </table></td>
       <td width="336" valign="top" nowrap="nowrap"><table width="298" border="0">
         <tr>
           <td colspan="3" bgcolor="#CCCCCC">&nbsp;Buscar por Fechas</td>
         </tr>
         <tr>
           <td width="81">F/FAENA:</td>
           <td width="108"><input name="felabaracd" type="text" id="felabaracd" value="<? echo $felabaracd?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.felabaracd');"> ver</a></td>
           <td width="87"><input name="felabarach" type="text" id="felabarach" value="<? echo $felabarach?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('felabarach.fih');"> ver</a></td>
         </tr>
         <tr>
           <td>F/INICIO:</td>
           <td><input name="finiciod" type="text" id="finiciod" value="<? echo $finiciod?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.finiciod');"> ver</a></td>
           <td><input name="finicioh" type="text" id="finicioh" value="<? echo $finicioh?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.finicioh');"> ver</a></td>
         </tr>
         <tr>
           <td>F/TERMINO:</td>
           <td><input name="fidterminod" type="text" id="fidterminod" value="<? echo $fidterminod?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fidterminod');"> ver</a></td>
           <td><input name="fidterminoh" type="text" id="fidterminoh" value="<? echo $fidterminoh?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fidterminoh');"> ver</a></td>
         </tr>
         <tr>
           <td>F/VENCIMIENTO:</td>
           <td><input name="fidvencid" type="text" id="fidvencid" value="<? echo $fidvencid?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fidvencid');"> ver</a></td>
           <td><input name="fidvencih" type="text" id="fidvencih" value="<? echo $fidvencih?>" size="8" maxlength="10" />
             <a href="javascript:show_Calendario('form1.fidvencih');"> ver</a></td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
       </table></td>
       <td width="280" valign="top" nowrap="nowrap"><table width="289" border="0">
         <tr>
           <td width="283" bgcolor="#CCCCCC">INGRESAR FOLIOS</td>
         </tr>
         <tr>
           <td><textarea name="dato" cols="30" rows="3" id="dato" onkeypress="return numeros(event)"></textarea></td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td align="right" nowrap="nowrap">&nbsp;</td>
       <td colspan="2" align="center" nowrap="nowrap">F/PLAZO DE ENTREGA&nbsp;<input name="fechaentrega" type="text" id="fechaentrega"  value="<?echo $fechaentrega?>" size="8" maxlength="10" />
         <a href="javascript:show_Calendario('form1.fechaentrega');">Ver
           <input type="submit" name="buscar" id="buscar" value="Buscar" />
         </a></td>
       </tr>
   </table></td>
  </tr>
 <tr>
   <td height="9" colspan="13"><BR>Nota: El siguiente informe muestra los Producto Terminado en estado de Bodega. <strong>Productos asociados a pedidos no se puede reprocesar.</strong></td>
 </tr>
 <? if($buscar){?>
 <tr>
    <td width="25" height="19" bgcolor="#FF9933"><center></center></td>
    <td colspan="12" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td width="25" height="19" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&ordm;</strong></td>
    <td width="64" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;COD</strong></td>
    <td width="160" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="79" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong>
    </td>
    <td width="87" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;UNID/MED</strong></td>
    <td width="80" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;MEDIDAS</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/P</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/E</strong></td>
    <td width="101" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="126" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;OPERADOR</strong></td>
    <td width="68" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    <td width="68" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PEDIDO</strong></td>
    <td width="23" nowrap="nowrap" bgcolor="#FF9933">&nbsp;</td>
  </tr>
  <? if($buscar and !$dato){?>
       <?
	if($felabaracd) { $felabaracdok=format_fecha_sin_hora($felabaracd); }
if($felabarach) { $felabarachok=format_fecha_sin_hora($felabarach); }
if($finiciod) { $finiciodok=format_fecha_sin_hora($finiciod); }
if($finicioh) { $finiciohok=format_fecha_sin_hora($finicioh); }
if($fidterminod) { $fidterminodok=format_fecha_sin_hora($fidterminod); }
if($fidterminoh) { $fidterminohok=format_fecha_sin_hora($fidterminoh); }

/* $sql="SELECT * FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um,  caract_producto AS carpro, caract_envases AS carenv, operarios AS o, origenes AS orig, estado_folio AS e where  ef.id_etiquetados_folios=ef.id_etiquetados_folios and ef.id_producto = p.id_producto and ef.id_calibre = c.id_calibre  and ef.id_medidas_productos = mpro.id_medidas_productos  and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 and ef.id_origen = orig.id_origen and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio and ef.id_estado_folio = 2 and ef.ocupado = 0 and ef.id_procedencia = 'N'"; */

$sql="SELECT * FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um,  caract_producto AS carpro, caract_envases AS carenv, operarios AS o, origenes AS orig, estado_folio AS e where  ef.id_etiquetados_folios=ef.id_etiquetados_folios and ef.id_producto = p.id_producto and ef.id_calibre = c.id_calibre  and ef.id_medidas_productos = mpro.id_medidas_productos  and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 and ef.id_origen = orig.id_origen and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio and ef.id_estado_folio = 2 and ef.ocupado = 0 ";

if($id_producto){ $sql.= " and p.id_producto = '$id_producto'";}
if($id_calibre){ $sql.= " and c.id_calibre = '$id_calibre'";}
if($id_unidad_medida){ $sql.= " and um.id_unidad_medida = '$id_unidad_medida' ";}
if($id_caract_envases){ $sql.= " and carenv.id_caract_envases = '$id_caract_envases' ";}
if($id_caract_producto){ $sql.= " and carpro.id_caract_producto = '$id_caract_producto' ";}
if($id_medidas_productos){ $sql.= " and mpro.id_medidas_productos = '$id_medidas_productos' ";}
if($felabaracdok or $felabarachok){ $sql.= " and ef.f_elaboracion between '$felabaracdok' and '$felabarachok' ";}
if($finiciodok or $finiciohok){ $sql.= " and ef.f_inicio between '$finiciodok' and '$finiciohok' ";}
if($fidterminodok or $fidterminohok){ $sql.= " and ef.f_termino between '$fidterminodok' and '$fidterminohok' ";}
$sql.= " order by ef.id_etiquetados_folios, c.condicion_cod_barra, c.calibre asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$id_cruce_tablas=$row[id_cruce_tablas];
	$producto=$row[producto];
	$calibre=$row[calibre];
	$unidad_medida=$row[unidad_medida];
	$medidas_productos=$row[medidas_productos];
	$caract_producto=$row[caract_producto];
	$caract_envases=$row[caract_envases];
	$contenido_unidades=$row[contenido_unidades];
	$origen=$row[origen];
	$estado_folio=$row[estado_folio];
  $pedido=$row[id_pedidos];

	
  ?>
  <tr>
    <td height="8" align="center" nowrap="nowrap" bgcolor="<? echo $color?>"><strong><? echo $i?></strong></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=ingresarpt.php&id_etiquetados_folios=<? echo $id_etiquetados_folios?>&pt=<? echo "N";?>">PT<? echo $id_etiquetados_folios?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $id_cruce_tablas?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $producto ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $calibre ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $unidad_medida ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $medidas_productos ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $caract_producto ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $caract_envases ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $contenido_unidades ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
	<? 
	$nom = strtoupper($row[nombreop]);
	$apell = strtoupper($row[apellido]);
	echo $nom?> <? echo $apell ?>
    </td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? $est = strtoupper($row[estado_folio]); echo $est ?>&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $pedido ?>&nbsp;</td>
    <td width="23" nowrap="nowrap" bgcolor="<? echo $color?>"><center><input type="checkbox" name="id_etiquetados_folios-<? echo $id_etiquetados_folios?>" id="id_etiquetados_folios" value="<? echo $id_etiquetados_folios?>" /></center></td>
  </tr>
  <?
	}
	}
  ?>
     <?
  if($buscar and $dato){
	$dat=split("\n",$dato);
	$c=count($dat);
	$j=0;
    $color = "#000000";
	 for ($g=0; $g<=$c;$g++)
	  { 
	   if ($dat[$g] != "")
	   {
	    $id_f=$dat[$g];
		$largog=strlen($id_f);
		if($largog != 1){
		  $id_f=substr($id_f, 0, $largog);
		}
		
			$id_fs=$id_f;

/*$sql2="SELECT * FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um,  caract_producto AS carpro, caract_envases AS carenv, operarios AS o, origenes AS orig, estado_folio AS e where  ef.id_etiquetados_folios=$id_fs and ef.id_producto = p.id_producto and ef.id_calibre = c.id_calibre  and ef.id_medidas_productos = mpro.id_medidas_productos  and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 and ef.id_origen = orig.id_origen and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio and ef.id_estado_folio = 2 and ef.ocupado = 0 and ef.id_procedencia = 'N'  order by ef.id_etiquetados_folios, c.condicion_cod_barra, c.calibre asc"; */

$sql2="SELECT * FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um,  caract_producto AS carpro, caract_envases AS carenv, operarios AS o, origenes AS orig, estado_folio AS e where  ef.id_etiquetados_folios=$id_fs and ef.id_producto = p.id_producto and ef.id_calibre = c.id_calibre  and ef.id_medidas_productos = mpro.id_medidas_productos  and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 and ef.id_origen = orig.id_origen and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio and ef.id_estado_folio = 2 and ef.ocupado = 0 order by ef.id_etiquetados_folios, c.condicion_cod_barra, c.calibre asc";

$result2=mysql_query($sql2);
$cuantos=mysql_num_rows($result2);

    
    while ($row=mysql_fetch_array($result2))
    {
	$jj++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$id_cruce_tablas=$row[id_cruce_tablas];
	$producto=$row[producto];
	$calibre=$row[calibre];
	$unidad_medida=$row[unidad_medida];
	$medidas_productos=$row[medidas_productos];
	$caract_producto=$row[caract_producto];
	$caract_envases=$row[caract_envases];
	$contenido_unidades=$row[contenido_unidades];
	$origen=$row[origen];
	$estado_folio=$row[estado_folio];
  $pedido=$row[id_pedidos];
	
  ?>
  <tr>
    <td height="8" align="center" nowrap="nowrap" bgcolor="<? echo $color?>"><strong><? echo $jj?></strong></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=ingresarpt.php&amp;id_etiquetados_folios=<? echo $id_etiquetados_folios?>&amp;pt=<? echo "N";?>">PT<? echo $id_etiquetados_folios?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $id_cruce_tablas?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $producto ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $calibre ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $unidad_medida ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $medidas_productos ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $caract_producto ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $caract_envases ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $contenido_unidades ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
      <? 
	$nom = strtoupper($row[nombreop]);
	$apell = strtoupper($row[apellido]);
	echo $nom?>
      <? echo $apell ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
      <? $est = strtoupper($row[estado_folio]); echo $est ?>
      &nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $pedido ?>&nbsp;</td>    
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
     <input type="checkbox" name="id_etiquetados_folios-<? echo $id_etiquetados_folios?>" id="id_etiquetados_folios" value="<? echo $id_etiquetados_folios?>" />
    </center></td>
  </tr>
  <? } // while ($row=mysql_fetch_array($result))
	   }
	  }
  }
  
  ?>
  <tr>
     </tr>
  <tr>
    <td height="19" colspan="13" align="right" nowrap="nowrap" bgcolor="<? echo $color?>">
      <input type="submit" name="asignar" id="asignar" value="Asignar" /></td>
  </tr>
  <? }?>
</table>