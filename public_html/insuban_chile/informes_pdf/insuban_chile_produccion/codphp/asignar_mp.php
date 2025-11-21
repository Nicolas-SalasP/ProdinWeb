<?
require "../sconre.php"; 

//echo "id_solicitud_mp $id_solicitud_mp -- id_ldp $id_ldp";

if(!$id_producto) { $id_calibre = 0;}
if(!$id_origen) { $id_origen = 0;}
if(!$unidadessolicitadas) { $unidadessolicitadas = 0;}



if($buscar and $id_procedencia == "N" and $id_producto and $tip == 3 or $tip == 4){
$sql="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, mpn.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto,pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpn.contenido AS contenido, mpn.comprobante_num AS comprobante_num, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, est.estado_material AS estado_material FROM mat_prima_nacional AS mpn, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpn.id_producto = pro.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material and mpn.id_estado_material != 0  ";
if($id_mat_prima_nacional){ $sql.= " and mpn.id_mat_prima_nacional = '$id_mat_prima_nacional' "; }
if($id_origen){ $sql.= " and mpn.id_origen = '$id_origen' "; }
if($id_producto){ $sql.= " and mpn.id_producto = '$id_producto' "; } 
//if($id_calibre){ $sql.= " and mpi.id_calibre = '$id_calibre' "; }
$sql.= "  and mpn.id_estado_material = 1 and mpn.id_solicitud_mp = 0 and mpn.id_c_es_so = 0 order by mpn.id_mat_prima_nacional desc";
$result=mysql_query($sql);
//echo "SQL -> $sql<br>";
$cuantos=mysql_num_rows($result);
}//if($buscar and $id_procedencia == "N" and $id_producto and $tip == 3){

if($buscar and $id_procedencia == "I" and $id_producto and $tip == 3 or $tip == 4 or $tic == 3){
$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada,mpi.etiquetados_folios_id AS etiquetados_folios_id, mpi.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpi.contenido AS contenido, mpi.comprobante_num AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, mpi.fecha_ingreso AS fecha_ingreso, est.estado_material AS estado_material, c.calibre AS calibre FROM mat_prima_importada AS mpi, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpi.id_producto = pro.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material and mpi.id_estado_material != 0 ";
if($id_mat_prima_nacional){ $sqli.= " and mpi.id_mat_prima_importada = '$id_mat_prima_nacional' "; }
if($id_origen){ $sqli.= " and mpi.id_origen = '$id_origen' "; }
if($id_producto){ $sqli.= " and mpi.id_producto = '$id_producto' "; }
if($id_calibre){ $sqli.= " and mpi.id_calibre = '$id_calibre' "; }
$sqli.= "  and mpi.id_estado_material = 1 and mpi.id_solicitud_mp = 0 and mpi.id_c_es_so = 0 order by mpi.id_mat_prima_importada desc";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);
//echo "cuantosi $cuantosi<br>";
//echo "sqli $sqli<br>";

}//if($buscar or $id_producto){
$cuantostotales=$cuantos+$cuantosi;
	
	
	
if($asignar and $unidadessolicitadas){
		    
		 
foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
   if ($dat[0] == 'id_mpi')
   {
	$id=$dat[1];
   	$id_mpilistard=$_POST["id_mpi-$id"];  
	
	if($id_procedencia =='N'){
	
	$sqlimpbusca="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mpilistard";
	$resultn=mysql_query($sqlimpbusca);
	$cuantosiiii=mysql_num_rows($resultn);
	if ($rown=mysql_fetch_array($resultn)) { 
    $id_mp=$rown[id_mat_prima_nacional];
	$id_producto=$rown[id_producto];
	if(!$id_calibre){ $id_calibre=33; }
	$id_origen=$rown[id_origen];
	$contenido=$rown[contenido];
	}//if ($rowimp=mysql_fetch_array($resulti)) { 
	if($tip == 3){
	$sqlupdate="UPDATE mat_prima_nacional  set id_solicitud_mp = '$id_solicitud_mp', fecha_asig_producc = '$fecha_asig_producc', id_ldp = '$id_ldp' where id_mat_prima_nacional  = $id_mp";
 	$resultupdate=mysql_query($sqlupdate);   
	}
	}//if($id_procedencia =='N'){
		
	if($id_procedencia =='I'){
	$id_mpilistardd=$id_mpilistard;
	$sqlimpbusca="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mpilistardd";
	$resulti=mysql_query($sqlimpbusca);
	$cuantosiiii=mysql_num_rows($resulti);
	if ($rowimp=mysql_fetch_array($resulti)) { 
    $id_mp=$rowimp[id_mat_prima_importada];
	$id_producto=$rowimp[id_producto];
	$id_calibre=$rowimp[id_calibre];
	$id_origen=$rowimp[id_origen];
	$contenido=$rowimp[contenido];
	}//if ($rowimp=mysql_fetch_array($resulti)) {
	if($tip == 3 or $tip == 4){
	$sqlupdate="UPDATE mat_prima_importada  set id_solicitud_mp = '$id_solicitud_mp', fecha_asig_producc = '$fecha_asig_producc', id_ldp = '$id_ldp' where id_mat_prima_importada  = $id_mp";
 	$resultupdate=mysql_query($sqlupdate);   
	}//if($tip == 3){
		
	}//if($id_procedencia =='I'){
		
	if($tip == 3){
	$sql_impk="insert solicitud_mp_detalle(id_solicitud_mp,id_ldp,id_mp) values ('$id_solicitud_mp','$id_ldp','$id_mp')";
    $result_smpk=mysql_query($sql_impk,$link);
	}
	
	if($tip == 4){
	
	$sql_impk4="insert solicitud_mp_detalle(id_solicitud_mp,id_ldp,id_mp,id_estdis) values ('$id_solicitud_mp','$id_ldp','$id_mp',1)";
    $result_smpk4=mysql_query($sql_impk4,$link);
	//echo "sql_impk $sql_impk4<br>";
	
	if($id_procedencia =='N'){
	//echo "nnnnnnnnnnnnnnnnnnnnnn";
	$sqlupdate="UPDATE mat_prima_nacional  set id_solicitud_mp = '$id_solicitud_mp', id_ldp = '$id_ldp' where id_mat_prima_nacional  = $id_mp";
 	$resultupdate=mysql_query($sqlupdate); 
	//echo "sqlupdate $sqlupdate<br>";
	}
	
	if($id_procedencia =='I'){
	$sqlupdate="UPDATE mat_prima_importada  set id_solicitud_mp = '$id_solicitud_mp', id_ldp = '$id_ldp' where id_mat_prima_importada  = $id_mp";
 	$resultupdate=mysql_query($sqlupdate); 
	//echo "sqlupdate $sqlupdate<br>";
	}
	
	}
	
	if($tic == 3){
	$sqlupdate="UPDATE mat_prima_importada  set id_c_es_so = '$id_c_es_so' where id_mat_prima_importada  = $id_mp";
 	$resultupdate=mysql_query($sqlupdate);
	
	$sql_impk="insert cambio_estado_detalle(id_c_es_so,id_ce,foliosmpfsp,id_procedencia) values ('$id_c_es_so','$id_ce','$id_mp','$id_procedencia')";
    $result_smpk=mysql_query($sql_impk,$link);
	}
	/*if($tip == 4){
		$sql_impk="insert solicitud_mp_detalle(id_solicitud_mp,id_ldp,id_mp,id_estdis) values ('$id_solicitud_mp','$id_ldp','$id_mp',1)";
    $result_smpk=mysql_query($sql_impk,$link);
	}*/
	//echo "sql_smpk $sql_impk<br>";
//	echo "$id_mat_prima_importadabusca - $id_producto - $id_calibre - $id_origen<br>";
	}
 }
 ?>
 
<script languaje="javascript">
<? if($tip == 3){ ?>
window.opener.document.location.replace('<? echo $url;?>sistema.php?modulo=pendientesmpdetalle.php&id_solicitud_mp=<? echo $id_solicitud_mp?>&id_ldp=<? echo $id_ldp?>&infomenu=<? echo $infomenu?>&tip=<? echo $tip?>');
<? } ?>
<? if($tic == 3){ ?> //redireccionamiento a cambio de estados rechazados
window.opener.document.location.replace('<? echo $url;?>sistema.php?modulo=solicitudcdetalle.php&id_c_es_so=<? echo $id_c_es_so?>&id_ce=<? echo $id_ce?>&tic=<? echo $tic?>');
<? } ?>
<? if($tip == 4){ ?> //redireccionamiento a cambio de estados rechazados
window.opener.document.location.replace('<? echo $url;?>sistema.php?modulo=pendientesmpdetalle.php&id_solicitud_mp=<? echo $id_solicitud_mp?>&id_ldp=<? echo $id_ldp?>&tip=<? echo $tip?>');
<? } ?>
</script>
<script language="javascript">
window.close();
</script>
 
 <?
}//if($asignar){


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel="stylesheet" href="../images/Underground.css" type="text/css" />			
<title>Insuban</title>
<script language="JavaScript"> 
function Abrir_ventana_nueva(pagina) { 
var opciones="toolbar=no,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=500, top=200, left=220"; 
window.open(pagina,"",opciones); 
} 
</script>

<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>

</head>
<body>

<div id="maincenter">
<form name="form1" method="post" action="">
<h1>SOLICITUD MP</h1>
<table width="98%" border="0">
  <tr>
    <td height="8" colspan="12"><table width="60%" border="0">
      <tr>
        <td width="15" nowrap="nowrap"><? 
		     if($id_procedencia == 'N'){
			    $s=$id_procedencia;
				echo "FRESCO";
			 }
		     if($id_procedencia == 'I'){
			    echo "SALADO";
			    $s=$id_procedencia;
			 }
				
	         //$procedencia= crea_procedencia($link,$id_procedencia,1);
			  //echo $procedencia;
		   ?></td>
        <td width="50" nowrap="nowrap">&nbsp;</td>
        <td width="22" nowrap="nowrap"><? 
		if($id_procedencia){
	   $s=$id_procedencia;
	   $producto= crea_producto_ok_filtro_new($link,$s,$id_producto,1);
	   echo $producto;
	   }
	   ?></td>
        <td width="69" nowrap="nowrap">&nbsp;</td>
        <td width="87" nowrap="nowrap"><? 
	   	if($id_producto and $id_origen){
		$s=$id_procedencia;
		$origen= crea_origenes_ok_filtro_new($link,$id_origen,$id_producto,$s,1);
	    echo $origen;
		}			
	    ?></td>
        <td width="97" nowrap="nowrap">CONTENIDO:</td>
        <td width="61" nowrap="nowrap"><input name="unidadessolicitadas" type="text" id="unidadessolicitadas" value="<? echo $unidadessolicitadas?>" size="10" maxlength="10" /></td>
        <td width="94" align="right" nowrap="nowrap"><input type="submit" name="buscar" id="buscar" value="Buscar" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <? if($cuantostotales){?>
    <td width="22" height="19" bgcolor="#FF9933"><center>
    </center></td>
    <td colspan="11" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
  </tr>
  <tr>
    <td width="22" height="19" nowrap="nowrap" bgcolor="#FF9933"><center>
      <strong>&nbsp;N&ordm;</strong>
    </center></td>
    <td width="76" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="189" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="114" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="86" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="129" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="111" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <td width="86" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="74" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="64" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="68" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    <td width="68" nowrap="nowrap" bgcolor="#FF9933">&nbsp;</td>
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
	$id_origen=$row[id_origen];
	$id_producto=$row[id_producto];
	$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);   
	$fecha_termino=format_fecha_sin_hora($row[fecha_termino]);
    $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$contenido=$row[contenido];
	$cuentabidones=$row[cuentabidones];
	$contenidototal+=$contenido;
	 if($contenidototal <= $unidadessolicitadas){
		$nacmp=$contenidototal;
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
      <!--<a href="?modulo=fmpfresca.php&id_mat_prima_nacional=<? echo $id_mat_prima_nacional?>&fresca=<? echo "N";?>">-->
      F<? echo $id_mat_prima_nacional?>
      <!--</a>--></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
      <? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_faena?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_termino?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[estado_material]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><? if($row[id_solicitud_mp] == 0){?>
      <input type="checkbox" name="id_mpi-<? echo $id_mat_prima_nacional?>" id="id_mpi" value="<? echo $id_mat_prima_nacional?>" />
      <? }else{ echo "X"; } ?></td>
    <? }
	}
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
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$id_mat_prima_importada2=$rowi[id_mat_prima_importada];
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$id_producto=$rowi[id_producto];
	$id_origen=$rowi[id_origen];
	$fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   
	$contenidoi=$rowi[contenido];
	$cuentabidonesi=$rowi[cuentabidones];
	$contenidototali+=$contenidoi;
	if($contenidototali <= $unidadessolicitadas){
	   $nacmpi=$contenidototali;
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $ii=$i+$cuantos?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
      <!--<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>">-->
      S<? 
$largo=strlen($id_mat_prima_importada);
	if($etiquetados_folios_id)
	 {
	  echo "$etiquetados_folios_id";
	 }else{
		
		if($largo == 9){
	 	$id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 	}
	 	echo $id_mat_prima_importada;
	 }//if($etiquetados_folios_id)?>
      <!--</a>--></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
      <? if(!$id_calibre){ echo "Original"; }else{echo "$rowi[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_vencimiento?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[estado_material]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><? if($rowi[id_solicitud_mp] == 0){?>
      <input type="checkbox" name="id_mpi-<? echo $id_mat_prima_importada2?>" id="id_mpi" value="<? echo $id_mat_prima_importada2?>" />
      <? }else{ echo "<center><strong>X</strong></center>"; } ?></td>
    <? }
	}
   }?>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">TOTAL</td>
    <td align="center" bgcolor="#CCCCCC"><strong><? echo $fstotal=$nacmp+$nacmpi;?></strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td colspan="2" align="right">&nbsp;</td>
    <? }?>
  </tr>
  <tr>
    <td colspan="12" align="right"><? if($buscar or $cuantostotales){?>
      <input type="submit" name="asignar" id="asignar" value="Asignar MP" />
      <? } ?></td>
  </tr>
  <tr>
    <td colspan="12" align="right">&nbsp;</td>
  </tr>
</table>
</form>
</div>

</body>
</html>
