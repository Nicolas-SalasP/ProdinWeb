<?
require "../sconre.php"; 

//echo "id_solicitud_mp $id_solicitud_mp -- id_ldp $id_ldp --- fecha_asig_producc $fecha_asig_producc -- id_procedencia $id_procedencia<br>";


$sqln="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, mpn.contenido AS contenido, mpn.comprobante_num  AS comprobante_num, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, pro.producto AS producto, c.calibre AS calibre, org. origen AS origen, est.estado_material AS estado_material ,smpd.id_solicitud_mp AS id_solicitud_mp FROM mat_prima_nacional AS mpn, solicitud_mp_detalle AS smpd, producto AS pro, calibre AS c, origenes AS org, estado_material AS est WHERE mpn.id_mat_prima_nacional = smpd.id_mp AND mpn.id_producto = pro.id_producto and mpn.id_calibre= c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material  and mpn.fecha_asig_producc = '0000-00-00' and mpn.fechastockprodfresco != '0000-00-00' and mpn.id_ldp = $id_ldp";
$resultn=mysql_query($sqln);
$cuantosn=mysql_num_rows($resultn);
//echo "sqln $sqln";
$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.etiquetados_folios_id AS etiquetados_folios_id, mpi.contenido AS contenido, mpi.comprobante_num  AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_ingreso AS fecha_ingreso, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_termino AS fecha_termino, mpi.fecha_vencimiento AS fecha_vencimiento, pro.producto AS producto, c.calibre AS calibre, org. origen AS origen, est.estado_material AS estado_material ,smpd.id_solicitud_mp AS id_solicitud_mp FROM mat_prima_importada AS mpi, solicitud_mp_detalle AS smpd, producto AS pro, calibre AS c, origenes AS org, estado_material AS est WHERE mpi.id_mat_prima_importada = smpd.id_mp AND mpi.id_producto = pro.id_producto and mpi.id_calibre= c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material and mpi.fecha_asig_producc = '0000-00-00' and mpi.fechastockprodsalado != '0000-00-00' and mpi.id_ldp = $id_ldp";
//echo "sqli $sqli";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);

$cuantostotales=$cuantosn+$cuantosi;
	
	
	
if($asignar){
		    
		 
foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
   if ($dat[0] == 'id_mpi')
   {
	$id=$dat[1];
   	$id_mpilistard=$_POST["id_mpi-$id"];  
	$largo=strlen($id_mpilistard);
	
	
	if($largo != 9){
	$fecha_salida=date("Y-m-d"); 
	$sqlupdaten="UPDATE mat_prima_nacional  set  fecha_asig_producc = '$fecha_asig_producc', id_estado_material = 2, fecha_salida  ='$fecha_salida ' where id_mat_prima_nacional  = $id_mpilistard";
 	$resultupdaten=mysql_query($sqlupdaten);   
	
		  $sqlmpno="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mpilistard";
	  $resulto=mysql_query($sqlmpno,$link);
      if ($rowo=mysql_fetch_array($resulto)) { 
      $id_mpn=$rowo[id_mat_prima_nacional];
	  $id_origen=$rowo[id_origen];
	  }
	
	$sql_nuevo="insert into planilla_registro_fecha_asig_produccion  (id_folio_mpn_mpi,id_origen,id_ldp,fecha_asig_producc) values ('$id_mpilistard','$id_origen','$id_ldp','$fecha_asig_producc')";
    $result_nuevo=mysql_query($sql_nuevo,$link);
	}//if($id_procedencia =='N'){
		
	if($largo == 9){
	$fecha_salida=date("Y-m-d"); 
	$sqlupdatei="UPDATE mat_prima_importada  set fecha_asig_producc = '$fecha_asig_producc', id_estado_material = 2, fecha_salida  ='$fecha_salida ' where id_mat_prima_importada  = $id_mpilistard";
 	$resultupdatei=mysql_query($sqlupdatei);   
	
		
	  $sqlmpno="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mpilistard";
	  $resulto=mysql_query($sqlmpno,$link);
	  if ($rowo=mysql_fetch_array($resulto)) { 
      $id_mpi=$rowo[id_mat_prima_importada];
	  $id_origen=$rowo[id_origen];
	  }
	
		$sql_nuevo="insert into planilla_registro_fecha_asig_produccion  (id_folio_mpn_mpi,id_origen,id_ldp,fecha_asig_producc) values ('$id_mpilistard','$id_origen','$id_ldp','$fecha_asig_producc')";
    $result_nuevo=mysql_query($sql_nuevo,$link);
	}//if($id_procedencia =='I'){
	
	}
 }
 ?>
<script languaje="javascript">
<? if($tip == 6){ ?>
window.opener.document.location.replace('<? echo $url?>sistema.php?modulo=pproduccdetalle.php&id_ldp=<? echo $id_ldp?>&fecha_asig_producc=<? echo $fecha_asig_producc?>&tip=<? echo $tip?>');
<? } ?>

</script>
<script language="javascript">
window.close();
</script>
 
 <? }//if($asignar){?>
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
<script language="JavaScript"> 
function seleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=0 
} 
</script>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>

</head>
<body>

<div id="maincenter">
<form name="form1" method="post" action="">
<h1>stock de produccion</h1>
<? if($cuantostotales){?>
<table width="1010" border="0">
 <tr>
   <? if($cuantostotales){?>
   <td width="20" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="12" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
 </tr>
  <tr>
    <td width="20" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="138" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="74" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="83" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="70" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&ordm; GUIA</strong></td>
    <td width="70" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="71" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="62" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="69" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><center><a href="javascript:seleccionar_todo()"><img src="../codphp/jpgnew/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="../codphp/jpgnew/ninguno.jpg" width="13" height="13" border="0"/></a></center></td>
  </tr>
     <?
	if($cuantosn){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($resultn))
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
	
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<!--<a href="?modulo=fmpfresca.php&id_mat_prima_nacional=<? echo $id_mat_prima_nacional?>&fresca=<? echo "N";?>">-->F<? echo $id_mat_prima_nacional?><!--</a>--></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $row[comprobante_num]?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_faena?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_termino?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $row[estado_material]?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><input type="checkbox" name="id_mpi-<? echo $id_mat_prima_nacional?>" id="id_mpi" value="<? echo $id_mat_prima_nacional?>" /></center></td>
    <? } //while ($row=mysql_fetch_array($resultn))
	$nacmp=$nacmp + $contenido;
	}//if($cuantosn){
	?>
  </tr>
   <?
   if($cuantosi){
	   if(!$i){
    $i=$op;
	   }
    $color = "#000000";
    while ($rowi=mysql_fetch_array($resulti))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$id_mat_prima_importadaidok=$rowi[id_mat_prima_importada];
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$id_producto=$rowi[id_producto];
	$id_origen=$rowi[id_origen];
	$fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   
	$contenidoi=$rowi[contenido];
	$cuentabidonesi=$rowi[cuentabidones];
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $ii=$i+$cuantos?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<!--<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>">-->S<? 

	if($etiquetados_folios_id)
	 {
	  echo "$etiquetados_folios_id";
	 }else{
		
		if($largo == 9){
	 	$id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 	}
	 	echo $id_mat_prima_importada;
	 }//if($etiquetados_folios_id)?><!--</a>--></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$rowi[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $rowi[comprobante_num]?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_vencimiento?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><? echo $rowi[estado_material]?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><input type="checkbox" name="id_mpi-<? echo $id_mat_prima_importadaidok?>" id="id_mpi" value="<? echo $id_mat_prima_importadaidok?>" /></center></td>
    <? 
	$nacmpi=$nacmpi + $contenidoi;
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
   <td align="center">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td colspan="2" align="right">&nbsp;</td>
    <? }?>
  </tr>
  <tr>
    <td colspan="13" align="right">
    <? if($cuantostotales){?>
    <input type="submit" name="asignar" id="asignar" value="Asignar MP" />
    <? } ?>
    </td>
  </tr>
  <tr>
    <td colspan="13" align="right">&nbsp;</td>
  </tr>

</table>
<? }else{?>
SIN STOCK DE MATERIAL
<? }?>
</form>
</div>

</body>
</html>
