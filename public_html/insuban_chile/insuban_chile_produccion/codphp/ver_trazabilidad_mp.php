<?
require "../sconre.php";

$desde=format_fecha_sin_hora($fecha_elaboracion);
$hasta=format_fecha_sin_hora($fecha_termino);


if($id_etiquetados_folios){
	
$sqlmpnver="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, pro.producto AS producto,pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpn.contenido AS contenido, mpn.comprobante_num AS comprobante_num, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_salida AS fecha_salida, est.estado_material AS estado_material FROM mat_prima_nacional AS mpn, producto AS pro,calibre AS c, origenes AS org, estado_material AS est, folios_mat AS fm WHERE mpn.id_mat_prima_nacional = fm.id_mat and fm.id_etiquetados_folios = $id_etiquetados_folios and mpn.id_producto = pro.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material and mpn.id_estado_material != 0  and mpn.id_estado_material = 2 and mpn.id_producto = $id_productob order by mpn.id_mat_prima_nacional desc";
$resultmpnver=mysql_query($sqlmpnver);
$cuantosmpnevr=mysql_num_rows($resultmpnver);

$sqlmpiver="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpi.contenido AS contenido, mpi.comprobante_num AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, mpi.fecha_ingreso AS fecha_ingreso, mpi.fecha_salida AS fecha_salida, est.estado_material AS estado_material, mpi.cruce_tablas_id AS cruce_tablas_id FROM mat_prima_importada AS mpi, producto AS pro,calibre AS c, origenes AS org, estado_material AS est, folios_mat AS fm WHERE mpi.id_mat_prima_importada = fm.id_mat and fm.id_etiquetados_folios = $id_etiquetados_folios and mpi.id_producto = pro.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material and mpi.id_estado_material != 0 and mpi.id_estado_material = 2 and mpi.id_producto = $id_productob order by mpi.id_mat_prima_importada desc ";
$resultmpiver=mysql_query($sqlmpiver);
//echo "sqlmpi $sqlmpi<br>";
$cuantosmpiver=mysql_num_rows($resultmpiver);
//echo "sqlmpiver $sqlmpiver<br>cuantosmpiver $cuantosmpiver<br>";
$cuantostotalesasig= $cuantosmpnevr + $cuantosmpiver;
}
$cuantostotales=$cuantosmpn+$cuantosmpi;

if($fecha_inicio and $fecha_termino and $buscar){

$sqlmpn="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, pro.producto AS producto,pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpn.contenido AS contenido, mpn.comprobante_num AS comprobante_num, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_salida AS fecha_salida, est.estado_material AS estado_material FROM mat_prima_nacional AS mpn, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpn.id_producto = pro.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material and mpn.id_estado_material != 0  and mpn.id_estado_material = 2 and mpn.fecha_salida BETWEEN '$desde' AND '$hasta' and mpn.id_producto = $id_productob order by mpn.id_mat_prima_nacional desc ";
$resultmpn=mysql_query($sqlmpn);
$cuantosmpn=mysql_num_rows($resultmpn);
echo "sqlmpn $sqlmpn<br>cuantosmpn $cuantosmpn<br>";

$sqlmpi="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpi.contenido AS contenido, mpi.comprobante_num AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, mpi.fecha_ingreso AS fecha_ingreso, mpi.fecha_salida AS fecha_salida, est.estado_material AS estado_material, mpi.cruce_tablas_id AS cruce_tablas_id FROM mat_prima_importada AS mpi, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpi.id_producto = pro.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material and mpi.id_estado_material != 0  and mpi.id_estado_material = 2 and mpi.fecha_salida BETWEEN '$desde' AND '$hasta' and mpi.id_producto = $id_productob order by mpi.id_mat_prima_importada desc ";
$resultmpi=mysql_query($sqlmpi);
$cuantosmpi=mysql_num_rows($resultmpi);
echo "sqlmpi $sqlmpi<br>cuantosmpi $cuantosmpi<br>";
}//if($fecha_inicio and $fecha_termino and $buscar){

if($asignar_trazabilidad){
	
  $dat4=split(" ",$fecha_termino);
  $dat6=split("-",$dat4[0]);
  $fecha_faena1="$dat6[2]-$dat6[1]-$dat6[0]";
  $ann=$dat6[2];
  $ank=$ann+1;
  $dias=1;
  $fecha_faena2ff="$ank-$dat6[1]-$dat6[0]";
  $fecha_vencimiento1 = date("Y-m-d", strtotime("$fecha_faena2ff + $dias day"));
  $dat2=split(" ",$fecha_elaboracion);  $dat=split("-",$dat2[0]);  $f_elaboracion1="$dat[2]-$dat[1]-$dat[0]";
  $dat3=split(" ",$fecha_inicio);  $dat1=split("-",$dat3[0]);  $f_inicio1="$dat1[2]-$dat1[1]-$dat1[0]";
  $dat4=split(" ",$fecha_termino);  $dat6=split("-",$dat4[0]);  $f_termino1="$dat6[2]-$dat6[1]-$dat6[0]";

  
$fhoy=date("Y"); 
$femitido = date("Y-m-d");	  
	  
  $sqlultimafecha="SELECT * FROM etiquetados_folios where id_etiquetados_folios=id_etiquetados_folios ORDER BY id_etiquetados_folios desc LIMIT 1";
  $resulultimafecha=mysql_query($sqlultimafecha);
  $cuantosultimafecha=mysql_num_rows($resulultimafecha);
if ($rowultimafecha=mysql_fetch_array($resulultimafecha)){ 
    $id_etiquetados_folios=$rowultimafecha[id_etiquetados_folios];
    $ultimoanorescatado=$rowultimafecha[ano];
}//if ($rowultimafecha=mysql_fetch_array($resulultimafecha)){ 
if($ultimoanorescatado == $fhoy){
   $id_etiquetados_folios=$rowultimafecha[id_etiquetados_folios];
   $id_etiquetados_folios_siguiente=$id_etiquetados_folios+1;
}else{
   $id_etiquetados_folios=$rowul[id_etiquetados_folios];
   $id_etiquetados_folios_siguiente=$id_etiquetados_folios - $id_etiquetados_folios;
   $id_etiquetados_folios_siguiente++;
   $id_etiquetados_folios_siguiente_contar=strlen($id_etiquetados_folios_siguiente);
   if($id_etiquetados_folios_siguiente_contar == 1) $id_etiquetados_folios_siguiente="00000$id_etiquetados_folios_siguiente";
   if($id_etiquetados_folios_siguiente_contar == 2) $id_etiquetados_folios_siguiente="0000$id_etiquetados_folios_siguiente";
   if($id_etiquetados_folios_siguiente_contar == 3) $id_etiquetados_folios_siguiente="000$id_etiquetados_folios_siguiente";
   if($id_etiquetados_folios_siguiente_contar == 4) $id_etiquetados_folios_siguiente="00$id_etiquetados_folios_siguiente";
   if($id_etiquetados_folios_siguiente_contar == 5) $id_etiquetados_folios_siguiente="0$id_etiquetados_folios_siguiente";
   if($id_etiquetados_folios_siguiente_contar == 6) $id_etiquetados_folios_siguiente="$id_etiquetados_folios_siguiente";
   $anook=substr($fhoy,2,4);
   $id_etiquetados_folios_siguiente=$anook.$id_etiquetados_folios_siguiente;
}//if($ultimoanorescatado == $fhoy){
	
	$sql_nuevo="insert into etiquetados_folios  (id_etiquetados_folios,id_producto,ano,id_calibre,id_cruce_tablas,id_especie,id_unidad_medida,id_caract_producto,id_caract_envases,id_medidas_productos,id_envases,f_elaboracion,f_inicio,f_termino,f_vencimiento,id_operarios,contenido_unidades,id_estado_folio,marca,id_procedencia) values ($id_etiquetados_folios_siguiente,$id_productob,'$fhoy',$id_calibre,$id_cruce_tablasb,$id_especie,$id_unidad_medida,$id_caract_producto,$id_caract_envases,$id_medidas_productos,$id_envases,'$f_elaboracion1','$f_inicio1','$f_termino1','$fecha_vencimiento1',$id_operarios,'$contenido',1,1,'N')";
$result_nuevo=mysql_query($sql_nuevo,$link);
//echo "sql_nuevo $sql_nuevo<br>";
$id_etiquetas=mysql_insert_id();
	
//*************************************************inserta la trazabilidad del mpn	
foreach ($_POST as $key => $value)
{ 

 $dat=split("-",$key); 
   if ($dat[0] == 'id_mat')
   {
	$id=$dat[1];
   	$id_mat=$_POST["id_mat-$id"];    
	$sql3="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mat";
	$result3=mysql_query($sql3);
	while ($row3=mysql_fetch_array($result3)) { 
          $contenido=$row3[contenido];
		  $sql_modn="insert folios_mat (id_etiquetados_folios,id_mat,contenido) values ($id_etiquetas,$id_mat,$contenido)";
		  $result_cruce=mysql_query($sql_modn,$link);
		   echo "sql_modn $sql_modn<br>";
    	}//while ($row3=mysql_fetch_array($result3)) { 
   }//if ($dat[0] == 'id_mat')
}//foreach ($_POST as $key => $value)
//*************************************************inserta la trazabilidad del mpn	
//*************************************************inserta la trazabilidad del mpi
foreach ($_POST as $key3 => $value3)
{ 
 $dati=split("-",$key3); 
    if ($dati[0] == 'id_mat3')
    {
	$idi=$dati[1];
   	$id_mat3=$_POST["id_mat3-$idi"];    
	$sqli="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mat3";
	$resulti=mysql_query($sqli);
	while ($rowi=mysql_fetch_array($resulti)) { 
          $contenidoi=$rowi[contenido];
	      $sql_modi="insert folios_mat (id_etiquetados_folios,id_mat,contenido) values ($id_etiquetas,$id_mat3,$contenidoi)";
    	  $result_cruce=mysql_query($sql_modi,$link);
		  echo "sql_modi $sql_modi<br>";
  	     }//while ($row3=mysql_fetch_array($result3)) { 
   }//if ($dat[0] == 'id_mat')
}//foreach ($_POST as $key => $value)
//*************************************************inserta la trazabilidad del mpi	

?>
<script languaje="javascript">
window.opener.document.location.replace('http://200.63.96.220/~insubac/<? echo $url;?>/sistema.php?modulo=ingresarpt.php');
</script>
<script language="javascript">
window.close();
</script>

<? }//if guardar ?>
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
<script language="JavaScript" type="text/javascript" src="../lib/cal.js">
</script>
<script language="JavaScript"> 
function cambiar(esto)
{
	vista=document.getElementById(esto).style.display;
	if (vista=='none')
		vista='block';
	else
		vista='none';

	document.getElementById(esto).style.display = vista;
}
</script>
<link rel="stylesheet" href="../images/Underground.css" type="text/css" />	
<body>

<div id="main_traza">
<form name="form1" method="post" action="">
<h1> TRAZABILIDAD ASIGNADA </h1>
<table width="98%" border="0">
 <tr>
   <td width="22" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="10" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotalesasig?></strong></td>
 </tr>
  <tr>
    <td width="22" height="19" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="76" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="189" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="114" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="86" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="129" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="111" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <td width="86" bgcolor="#FF9933"><strong>F/INGRESO</strong></td>
    <td width="74" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="64" bgcolor="#FF9933"><strong>&nbsp;F/DESP</strong></td>
    <td bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    </tr>
     <?
	 
	 
	 
	if($cuantosmpnevr){
	$j=0;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($resultmpnver))
    {
	$j++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
	$id_origen=$row[id_origen];
	$id_calibre=$row[id_calibre];
	$id_producto=$row[id_producto];
	$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);   
	$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
    $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$contenido=$row[contenido];
	$cuentabidones=$row[cuentabidones];
	$contenidototal+=$contenido;
	
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<b><? echo $j?></b></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;F<? echo $id_mat_prima_nacional?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $row[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_faena?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_salida?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[estado_material]?>&nbsp; </td>
    <? }
	}
	$sum+=$j;
	?>
  </tr>
   <?
   if($cuantosmpiver){
	   $im=0;
    $color = "#000000";$i = 0;
    while ($rowi=mysql_fetch_array($resultmpiver))
    {
	$im++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$id_mat_prima_importada3=$rowi[id_mat_prima_importada];
	$id_producto=$rowi[id_producto];
	$fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_salida=format_fecha_sin_hora($rowi[fecha_salida]);
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   
	$contenidoi=$rowi[contenido];
	$cuentabidonesi=$rowi[cuentabidones];
	$contenidototali+=$contenidoi;
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<b><? echo $si = $sum + $im?></b></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;S<? 
	 $largo=strlen($id_mat_prima_importada);
	 if($largo == 9){
	 $id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 }
	 echo $id_mat_prima_importada?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><? $sqlc="SELECT c.calibre AS calibre FROM cruce_tablas AS ct,  calibre AS c WHERE ct. id_cruce_tablas= $rowi[cruce_tablas_id] and ct.id_calibre = c.id_calibre";
	$resultc=mysql_query($sqlc);
	if ($rowc=mysql_fetch_array($resultc)) { $calibrec=$rowc[calibre];} ?>
	&nbsp;<? echo $calibrec?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_salida?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[estado_material]?>&nbsp;</td>
    <? }
	
   }?>
  </tr>
  <tr>
    <td colspan="4" align="right">&nbsp;</td>
    <td align="right">TOTAL</td>
   <td align="center" bgcolor="#CCCCCC"><strong><? echo $fstotal=$contenidototal+$contenidototali;?></strong></td>
    <td colspan="5" align="right"> <a href="#" onclick="cambiar('error'); return false;">Asignar Nueva Trazabilidad</a></td>
    </tr>
</table>

<table width="98%" border="0">
  <tr>
    <td height="19" colspan="12"><table width="717" border="0">
      <tr>
        <td>Fecha elaboraci&oacute;n</td>
        <td>&nbsp;</td>
        <td>Fecha Termino</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="352"><input name="fecha_elaboracion" type="text" id="fecha_elaboracion"  value="<?echo $fecha_elaboracion?>" size="10" maxlength="10" />
          <a href="javascript:show_Calendario('form1.fecha_elaboracion');">Ver</a></td>
        <td width="353">&nbsp;</td>
        <td width="707"><input name="fecha_termino" type="text" class="cajas" value="<?echo $fecha_termino?>" size="10" maxlength="10" />
          <a href="javascript:show_Calendario('form1.fecha_termino');" class="cajas" >Ver</a></td>
        <td width="707"><input type="submit" name="buscar" id="buscar" value="Buscar" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="22" height="19" bgcolor="#FF9933"><center>
    </center></td>
    <td colspan="11" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
  </tr>
  <tr>
    <td width="22" height="19" bgcolor="#FF9933"><center>
      <strong>&nbsp;N&ordm;</strong>
    </center></td>
    <td width="76" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="189" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="114" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="86" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="129" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="111" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <td width="86" bgcolor="#FF9933"><strong>F/INGRESO</strong></td>
    <td width="74" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="64" bgcolor="#FF9933"><strong>&nbsp;F/DESP</strong></td>
    <td width="68" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    <td width="68" align="center" bgcolor="#FF9933"><a href="javascript:seleccionar_todo()"><img src="../images/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="../images/ninguno.jpg" width="13" height="13" border="0"/></a></td>
  </tr>
  <?
	if($cuantosmpn){
    $j=0;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($resultmpn))
    {
	$j++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
	$id_origen=$row[id_origen];
	$id_calibre=$row[id_calibre];
	$id_producto=$row[id_producto];
	$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);   
	$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
    $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$contenido=$row[contenido];
	$cuentabidones=$row[cuentabidones];
	$contenidototal+=$contenido;
	
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<b><? echo $j?></b></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;F<? echo $id_mat_prima_nacional?></td>
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
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_salida?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[estado_material]?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
      <input type="checkbox" name="id_mat-<? echo $id_mat_prima_nacional?>" id="id_mat" value="<? echo $id_mat_prima_nacional?>" /></td>
    <? }
	}
	$sum+=$j;
	?>
  </tr>
  <?
   if($cuantosmpi){
	   $im=0;
    $color = "#000000";$i = 0;
    while ($rowi=mysql_fetch_array($resultmpi))
    {
	$im++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$id_mat_prima_importada3=$rowi[id_mat_prima_importada];
	$id_producto=$rowi[id_producto];
	$fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_salida=format_fecha_sin_hora($rowi[fecha_salida]);
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   
	$contenidoi=$rowi[contenido];
	$cuentabidonesi=$rowi[cuentabidones];
	$contenidototali+=$contenidoi;
  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<b><? echo $si = $sum + $im?></b></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;S
      <? 
	 $largo=strlen($id_mat_prima_importada);
	 if($largo == 9){
	 $id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 }
	 echo $id_mat_prima_importada?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><? $sqlc="SELECT c.calibre AS calibre FROM cruce_tablas AS ct,  calibre AS c WHERE ct. id_cruce_tablas= $rowi[cruce_tablas_id] and ct.id_calibre = c.id_calibre";
	$resultc=mysql_query($sqlc);
	if ($rowc=mysql_fetch_array($resultc)) { $calibrec=$rowc[calibre];} ?>
      &nbsp;<? echo $calibrec?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <? echo $rowi[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_salida?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[estado_material]?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
      <input type="checkbox" name="id_mat3-<? echo $id_mat_prima_importada3?>" id="id_mat3" value="<? echo $id_mat_prima_importada3?>" /></td>
    <? }
	
   }?>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">TOTAL</td>
    <td align="center" bgcolor="#CCCCCC"><strong><? echo $fstotal=$contenidototal+$contenidototali;?></strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td colspan="2" align="right"><input type="submit" name="asignar_trazabilidad" id="asignar_trazabilidad" value="Asignar Trazabilidad" /></td>
  </tr>
</table>
</div>
</form>

</body>