<?

if($asignarproduccion and $fecha_asig_producc){
$fecha_asig_producc=format_fecha_sin_hora($fecha_asig_producc);

foreach ($_POST as $key => $value)
{ 

 $dat=split("-",$key); 
   if ($dat[0] == 'id_mpi')
   {
	$id=$dat[1];
   	$foliosbidones=$_POST["id_mpi-$id"];  
	
	if($id_procedencia =='N'){
	$dat1=split(" ",$fecha_asig_producc);
	$dat=split("-",$dat1[0]);
  	$fecha_asig_produccok="$dat[0]-$dat[1]-$dat[2]";
	$fecha_salida=date("Y-m-d");  
	$sqlupdate="UPDATE mat_prima_nacional  set fecha_asig_producc ='$fecha_asig_produccok', id_estado_material = 2, fecha_salida  ='$fecha_salida ' where id_mat_prima_nacional  = $foliosbidones";
	$resultupdate=mysql_query($sqlupdate);
	//echo "sqlupdate $sqlupdate<br>";
	  $sqlmpno="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $foliosbidones";
	  $resulto=mysql_query($sqlmpno,$link);
      if ($rowo=mysql_fetch_array($resulto)) { 
      $id_mpn=$rowo[id_mat_prima_nacional];
	  $id_origen=$rowo[id_origen];
	  }//if ($rowo=mysql_fetch_array($resulto)) { 
	
	$sql_nuevo="insert into planilla_registro_fecha_asig_produccion  (id_folio_mpn_mpi,id_origen,id_ldp,fecha_asig_producc) values ('$id_mpn','$id_origen','$id_ldp','$fecha_asig_producc')";
    $result_nuevo=mysql_query($sql_nuevo,$link);
	//echo "sql_nuevo $sql_nuevo<br>";
	}//if($id_procedencia =='N'){
		
	if($id_procedencia =='I'){
	$dat1=split(" ",$fecha_asig_producc);
	$dat=split("-",$dat1[0]);
  	$fecha_asig_produccok="$dat[0]-$dat[1]-$dat[2]";
	$fecha_salida=date("Y-m-d");  
	$sqlupdate="UPDATE mat_prima_importada  set fecha_asig_producc ='$fecha_asig_produccok', id_estado_material = 2, fecha_salida  ='$fecha_salida ' where id_mat_prima_importada  = $foliosbidones";
 	$resultupdate=mysql_query($sqlupdate);   
	
	  $sqlmpno="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $foliosbidones";
	  $resulto=mysql_query($sqlmpno,$link);
	  if ($rowo=mysql_fetch_array($resulto)) { 
      $id_mpi=$rowo[id_mat_prima_importada];
	  $id_origen=$rowo[id_origen];
	  }//if ($rowo=mysql_fetch_array($resulto)) { 
	
	$sql_nuevo="insert into planilla_registro_fecha_asig_produccion  (id_folio_mpn_mpi,id_origen,id_ldp,fecha_asig_producc) values ('$id_mpi','$id_origen','$id_ldp','$fecha_asig_producc')";
    $result_nuevo=mysql_query($sql_nuevo,$link);
	}//if($id_procedencia =='N'){
		
   }//if ($dat[0] == 'id_mpi')
   
}//foreach ($_POST as $key => $value)


}
/*
if($id_ldp){
$sqllinea="SELECT o.id_operarios, o.apellido AS apellidoop, o.nombreop AS nombreop, o.iniciales AS iniciales, e.estado AS estado, o.fecha_ingreso AS fecha_ingreso, lp.ldp AS ldp, o.orden AS orden FROM operarios AS o, estado AS e, lineas_de_procesos AS lp where o.id_operarios != 0 and o.id_estado=e.id_estado and o.id_ldp = lp.id_ldp and lp.id_ldp = $id_ldp order by o.orden asc";
$resultlinea=mysql_query($sqllinea);
$cuantoslinea=mysql_num_rows($resultlinea);

while ($rowlinea=mysql_fetch_array($resultlinea))
    {
	$id_operarios=$rowlinea[id_operarios];
	$sql_nuevo="insert into planilla_produccion  (id_solicitud_mp,id_ldp,id_operarios,fecha_asig_producc) values ('$id_solicitud_mp','$id_ldp','$id_operarios','$fecha_asig_producc')";
    $result_nuevo=mysql_query($sql_nuevo,$link);
	//echo "sql_nuevo $sql_nuevo<br>";
	$id_ppid=mysql_insert_id();
	
	$sql_mpt="insert into maestro_produccion_tubing (id_pp,id_solicitud_mp,id_ldp,id_operarios,fecha_asig_producc) values ('$id_ppid','$id_solicitud_mp','$id_ldp','$id_operarios','$fecha_asig_producc')";
    $result_mpt=mysql_query($sql_mpt,$link);
	//echo "sql_mpt $sql_mpt<br>";
	
  	}//while ($rowlinea=mysql_fetch_array($resultlinea))
}*/
/*      $sqlimpbuscam="SELECT * FROM mat_prima_nacional WHERE id_solicitud_mp = $id_solicitud_mp";
	  $resultnm=mysql_query($sqlimpbuscam);
	  $cuantosn=mysql_num_rows($resultnm);
	  if($cuantosn){
	  while ($rowb=mysql_fetch_array($resultnm)) { 
      $id_mat_prima_nacionalb=$rowb[id_mat_prima_nacional];
	   $sqlupdatemb="UPDATE mat_prima_nacional  set id_estado_material = 7 where id_solicitud_mp=$id_solicitud_mp and id_mat_prima_nacional=$id_mat_prima_nacionalb";
   $resultupdatemb=mysql_query($sqlupdatemb);
   //echo "sqlupdatemb $sqlupdatemb";
	  }
	  }//if($cuantosn){
	  
	  $sqlimpbuscai="SELECT * FROM mat_prima_importada WHERE id_solicitud_mp = $id_solicitud_mp";
	  $resultni=mysql_query($sqlimpbuscai);
	  $cuantosi=mysql_num_rows($resultni);
	  if($cuantosi){
	  while ($rowbi=mysql_fetch_array($resultni)) { 
      $id_mat_prima_importadabi=$rowbi[id_mat_prima_importada];
	  $sqlupdatembi="UPDATE mat_prima_importada  set id_estado_material = 7 where id_solicitud_mp = $id_solicitud_mp and id_mat_prima_importada = $id_mat_prima_importadabi";
      $resultupdatembi=mysql_query($sqlupdatembi);
      }
	  }//if($cuantosn){*/
	
  //echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pproducc.php&id_ldp=$id_ldp&infomenu=$infomenu&tip=$tip\">";
 //exit;



//echo "id_mat_prima_nacional $id_mat_prima_nacional<br>";

if(!$year){ $year=$fhoy=date("Y");	}
if($buscar or $id_producto){

if($fid) { $fidok=format_fecha_sin_hora($fid); }
if($fih) { $fihok=format_fecha_sin_hora($fih); }
if($id_procedencia == "N"){
$sql="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, mpn.id_solicitud_mp AS id_solicitud_mp,pro.producto AS producto,pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpn.contenido AS contenido, mpn.comprobante_num AS comprobante_num, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, est.estado_material AS estado_material FROM mat_prima_nacional AS mpn, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpn.id_producto = pro.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material and mpn.id_estado_material = 1 ";

if($id_mat_prima_nacional){ $sql.= " and mpn.id_mat_prima_nacional = '$id_mat_prima_nacional' "; }
if($id_origen){ $sql.= " and mpn.id_origen = '$id_origen' "; }
if($id_producto){ $sql.= " and mpn.id_producto = '$id_producto' "; } 
if($id_calibre){ $sql.= " and mpi.id_calibre = '$id_calibre' "; }
if($factura){ $sql.= " and mpn.factura_mp = '$factura' "; }
if($guia){ $sql.= " and mpn.comprobante_num = '$guia' "; }
if($bidon_num){ $sql.= " and mpn.bidon_num = '$bidon_num' "; }
//if($year){ $sql.= " and mpn.ano = $year "; }
//if($fidok or $fihok){ $sql.= " and mpn.fecha_ingreso between '$fidok' and '$fihok' ";}

$sql.= "and mpn.id_ldp = $id_ldp and mpn.fechastockprodfresco != '0000-00-00' and mpn.fecha_asig_producc = '0000-00-00' order by mpn.id_mat_prima_nacional desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}

if($id_procedencia == "I"){
if(!$guia){
	
$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpi.contenido AS contenido, mpi.comprobante_num AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, mpi.fecha_ingreso AS fecha_ingreso, est.estado_material AS estado_material, c.calibre AS calibre, mpi.etiquetados_folios_id AS etiquetados_folios_id FROM mat_prima_importada AS mpi, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpi.id_producto = pro.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material and mpi.id_estado_material = 1 ";
if($id_mat_prima_nacional){ $sqli.= " and mpi.id_mat_prima_importada = '$id_mat_prima_nacional' "; }
if($id_origen){ $sqli.= " and mpi.id_origen = '$id_origen' "; }
if($id_producto){ $sqli.= " and mpi.id_producto = '$id_producto' "; }
if($id_calibre){ $sqli.= " and mpi.id_calibre = '$id_calibre' "; }
if($factura){ $sqli.= " and mpi.comprobante_num = '$factura' "; }
if($bidon_num){ $sqli.= " and mpi.bidon_num = '$bidon_num' "; }
//if($fidok or $fihok){ $sql.= " and mpn.fecha_ingreso between '$fidok' and '$fihok' ";
//if($year){ $y=$year-1; $sqli.= " and mpi.ano between '$y' and '$year'"; }

$sqli.= "and mpi.id_ldp = $id_ldp and mpi.fechastockprodsalado != '0000-00-00' and mpi.fecha_asig_producc = '0000-00-00' order by mpi.id_mat_prima_importada desc";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);
//echo "SQL -> $sqli<br>";

}
}
}

$cuantostotales=$cuantos+$cuantosi;

?>
<h1>CREAR PLANILLA DE PRODCCION</h1>
<table width="996" border="0">
 <tr>
   <td height="3" colspan="14">Para crear la planilla de producci&oacute;n debe seleccionar los folios de los bidones trabajados ese dia de producci&oacute;n y asignar una fecha.</td>
  </tr>
 <tr>
   <td height="3" colspan="14">&nbsp;</td>
 </tr>
 <tr>
   <td height="8" colspan="14"><table width="769" border="0">
     <tr>
       <td width="35" nowrap="nowrap"><? $procedencia= crea_procedencia($link,$id_procedencia,1);
			  echo $procedencia;
		   ?></td>
       <td width="39" nowrap="nowrap"><? 
			$s=$id_procedencia;
			$origen= crea_origenes_ok($link,$id_origen,$s,0);
	echo $origen;?></td>
       <td width="77" nowrap="nowrap">FOLIO MP:</td>
       <td width="128" nowrap="nowrap"><input name="id_mat_prima_nacional" type="text" id="id_mat_prima_nacional" value="<? echo $id_mat_prima_nacional?>" size="10" maxlength="10" /></td>
       <td width="80" nowrap="nowrap">FACTURA:</td>
       <td width="84" nowrap="nowrap"><input name="factura" type="text" id="factura" value="<? echo $factura?>" size="5" maxlength="10" /></td>
       <td width="41" nowrap="nowrap">GUIA:</td>
       <td nowrap="nowrap"><input name="guia" type="text" id="guia" value="<? echo $guia?>" size="5" maxlength="10" /></td>
       <td width="71" nowrap="nowrap">N&ordm; BIDON</td>
       <td width="43" nowrap="nowrap"><input name="bidon_num" type="text" id="bidon_num" value="<? echo $bidon_num?>" size="5" maxlength="10" /></td>
       <td width="63" nowrap="nowrap"><input type="submit" name="buscar" id="buscar" value="Buscar" /></td>
     </tr>
   </table></td>
 </tr>
 <tr>
   <td height="9" colspan="14">&nbsp;</td>
 </tr>
 <tr>
 <? if($cuantostotales){?>
    <td width="23" height="19" bgcolor="#FF9933"><center></center></td>
    <td colspan="13" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
  </tr>
  <tr>
    <td width="23" height="19" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="53" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="60" bgcolor="#FF9933"><strong>&nbsp;N&ordm; SOLICITUD</strong></td>
    <td width="105" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO<? 
			//$producto= crea_producto_onChange_ok($link,$id_producto,1);
			//echo $producto;
			?></strong></td>
    <td width="65" bgcolor="#FF9933"><strong>&nbsp;CALIBRE
      <? 
			//if($id_producto){
			//$producto= crea_calibre_onChange_ok($link,$row[id_calibre],$id_producto,1);
			//echo $producto;
			//}else{
			//echo "Calibre"; 
			//}
			?>
    </strong></td>
    <td width="80" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="50" bgcolor="#FF9933"><center><strong>&nbsp;CONTENIDO</strong></center></td>
    <td width="45" bgcolor="#FF9933"><strong>&nbsp;N&deg; GUIA</strong>      <center>
      </center></td>
    <td width="40" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="40" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="40" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="68" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    <td width="53" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <td width="49" bgcolor="#FF9933"><center><a href="javascript:seleccionar_todo()"><img src="codphp/jpgnew/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="codphp/jpgnew/ninguno.jpg" width="13" height="13" border="0"/></a></center></td>
  </tr>
     <?
	if($cuantos){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
	$id_solicitud_mp=$row[id_solicitud_mp];
	$id_origen=$row[id_origen];
	$id_calibre=$row[id_calibre];
	$id_producto=$row[id_producto];
	$comprobante_num=$row[comprobante_num];
	$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);   
	$fecha_termino=format_fecha_sin_hora($row[fecha_termino]);
    $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$contenido=$row[contenido];
	$cuentabidones=$row[cuentabidones];
	$contenidototal+=$contenido;
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>"><center>&nbsp;<? echo $i?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpfresca.php&id_mat_prima_nacional=<? echo $id_mat_prima_nacional?>&fresca=<? echo "N";?>" title="<? echo "Nº Solicitud $id_solicitud_mp";?>">F<? echo $id_mat_prima_nacional?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo "$id_solicitud_mp";?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?><? //echo $row[id_origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $comprobante_num?>      <center>
      </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?>&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_faena?>&nbsp;</td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_termino?>&nbsp;</td>
    <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[estado_material]?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>"><? echo $row[bidon_num]?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>"><input type="checkbox" name="id_mpi-<? echo $id_mat_prima_nacional?>" id="id_mpi" value="<? echo $id_mat_prima_nacional?>" /></td>
    <? }
	}
	?>
  </tr>
   <?
   if($cuantosi){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($rowi=mysql_fetch_array($resulti))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_importadaa=$rowi[id_mat_prima_importada];
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$id_producto=$rowi[id_producto];
	$id_origen=$rowi[id_origen];
	$id_calibre=$rowi[id_calibre];
	$id_solicitud_mpi=$rowi[id_solicitud_mp];
	$comprobante_num=$rowi[comprobante_num];
	$fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   
	$contenidoi=$rowi[contenido];
	$cuentabidonesi=$rowi[cuentabidones];
	$contenidototali+=$contenidoi;
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>"><center>&nbsp;<? echo $ii=$i+$cuantos?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>" title="<? echo "Nº Solicitud $id_solicitud_mpi";?>">S<? 
	if(!$etiquetados_folios_id){
	 $largo=strlen($id_mat_prima_importada);
	 if($largo == 9){
	 $id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 }
	}else{
		$id_mat_prima_importada = $etiquetados_folios_id;
	}
	 echo $id_mat_prima_importada?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $id_solicitud_mpi?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$rowi[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[origen]?><? //echo $rowi[id_origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $comprobante_num?>      <center>
      </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_vencimiento?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[estado_material]?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>"><? echo $rowi[bidon_num]?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<input type="checkbox" name="id_mpi-<? echo $id_mat_prima_importadaa?>" id="id_mpi" value="<? echo $id_mat_prima_importadaa?>" /></td>
    <? }
	
   }?>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="2" align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">TOTAL</td>
   <td align="center" bgcolor="#CCCCCC"><strong><? echo $fstotal=$contenidototal+$contenidototali;?></strong></td>
   <td align="center">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td colspan="3" align="right">&nbsp;</td>
    <? }?>
  </tr>
  <tr>
    <td colspan="14" align="right">
     <? 
	
	 if($cuantostotales){
	  if($tip == 5 and $infomenu){?> Asignar fecha
        <input name="fecha_asig_producc" type="text" id="fecha_asig_producc"  value="<?echo $fecha_asig_producc?>" size="10" maxlength="10" />
       <a href="javascript:show_Calendario('form1.fecha_asig_producc');"> Fecha</a>&nbsp;&nbsp;
       <input type="submit" name="asignarproduccion" id="asignarproduccion" value="Asignar" />
     <? } //if(!$cuantostotales){
	 }//if($tip == 5 and $infomenu){
	 ?>
     
     <span class="alertas">
     <?
     
	 if($mensaje_cuantos_existefechaproduccion){
		echo "La fecha de producción $fecha_asig_producc, existe en la base de datos."; 
	 }
	 
	 ?></span></td>
  </tr>
</table>
