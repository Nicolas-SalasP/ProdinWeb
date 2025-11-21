<?
//**********************************************************************************************************
if($actualizar_datos){
	
foreach ($_POST as $key => $value)
{
	//echo "key $key value $value<br><br>";
 $dat=split("-",$key);
 //echo "dattttttt $dat<br>";
 if ($dat[0] == 'e1')
	{
	//echo " $dat[0];---------- ";	
    $id=$dat[1];
	//echo "$dat[1];---------- ";	
	
    $e1=$_POST["e1-$id"]; if(!$e1){ $e1=0; }
	$e2=$_POST["e2-$id"]; if(!$e2){ $e2=0; }
	$e3=$_POST["e3-$id"]; if(!$e3){ $e3=0; }
	$e4=$_POST["e4-$id"]; if(!$e4){ $e4=0; }
	$e5=$_POST["e5-$id"]; if(!$e5){ $e5=0; }
	$e6=$_POST["e6-$id"]; if(!$e6){ $e6=0; }
	$d1=$_POST["d1-$id"]; if(!$d1){ $d1=0; }
	$d2=$_POST["d2-$id"]; if(!$d2){ $d2=0; }
	$d3=$_POST["d3-$id"]; if(!$d3){ $d3=0; }
	
	$id_origenido=$_POST["ido-$id"];
	//echo "idddddddddddddd $id_origen2<br>";
	$etotal22=$e1+$e2+$e3+$e4+$e5+$e6;
	$dtotal22=$d1+$d2+$d3;
	
	$totall=$etotal22-$dtotal22;
	//echo "totalllllllllllllllllllllllllllllllllll $totall<br>";
    $sql="UPDATE planilla_produccion  SET id_origen='$id_origenido',e1='$e1',e2='$e2',e3='$e3',e4='$e4',e5='$e5',e6='$e6',etotal='$etotal2',d1='$d1',d2='$d2',d3='$d3',dtotal='$dtotal2',totaled='$totall' where id_pp=$id";
	$retsul=mysql_query($sql);
	//echo "sql $sql<br>";
	//dtotal (total de nudos )
	$sqlac="UPDATE maestro_produccion_tubing SET  total_nudos='$totall', id_origen='$id_origenido' where id_pp = $id";
	$retsulac=mysql_query($sqlac);
	//echo "$sqlac<br>";
}//if ($dat[0] == 'e1')
}//foreach ($_POST as $key => $value)
	
}
//**********************************************************************************************************
if($actualizar_datos2){
	
foreach ($_POST as $key => $value)
{
	//echo "key $key value $value<br><br>";
 $dat=split("-",$key);
 //echo "dattttttt $dat<br>";
 if ($dat[0] == 'procorto')
	{
	//echo " $dat[0];---------- ";	
    $id=$dat[1];
	//echo "$dat[1];---------- ";	
	
    $procorto=$_POST["procorto-$id"]; if(!$procorto){ $procorto=0; }
	$proverde=$_POST["proverde-$id"]; if(!$proverde){ $proverde=0; }
	$prorojo=$_POST["prorojo-$id"]; if(!$prorojo){ $prorojo=0; }
	$proazul=$_POST["proazul-$id"]; if(!$proazul){ $proazul=0; }
	$prowaste=$_POST["prowaste-$id"]; if(!$prowaste){ $prowaste=0; }
	
	//$id_origen=$_POST["id_origen-$id"];
	
	 $sqltubing="UPDATE maestro_produccion_tubing SET procorto='$procorto', proverde='$proverde', prorojo='$prorojo', proazul = '$proazul', prowaste='$prowaste' where id_mptubing = $id";
	$retsultubing=mysql_query($sqltubing);
	//echo "sql $sqltubing <br>";
	
}//if ($dat[0] == 'e1')
}//foreach ($_POST as $key => $value)
	
}
//**********************************************************************************************************

if($recepcion){
$fecharecep=date("Y-m-d"); 

   $sqlupdate="UPDATE solicitud_mp  set fecharecep = '$fecharecep', fecharechazomp = '0000-00-00' where id_solicitud_mp=$id_solicitud_mp and id_ldp=$id_ldp";
   $resultupdate=mysql_query($sqlupdate); 
    
	
	  $sqlimpbuscam="SELECT * FROM mat_prima_nacional WHERE id_solicitud_mp = $id_solicitud_mp";
	  $resultnm=mysql_query($sqlimpbuscam);
	  $cuantosn=mysql_num_rows($resultnm);
	  if($cuantosn){
	  while ($rowb=mysql_fetch_array($resultnm)) { 
      $id_mat_prima_nacionalb=$rowb[id_mat_prima_nacional];
	   $sqlupdatemb="UPDATE mat_prima_nacional  set id_estado_material = 7, id_ldp = $id_ldp  where id_solicitud_mp=$id_solicitud_mp and id_mat_prima_nacional=$id_mat_prima_nacionalb";
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
	   $sqlupdatemb="UPDATE mat_prima_importada set id_estado_material = 7, id_ldp = $id_ldp  where id_solicitud_mp=$id_solicitud_mp and id_mat_prima_importada=$id_mat_prima_importadabi";
   $resultupdatemb=mysql_query($sqlupdatemb);
   //echo "sqlupdatemb $sqlupdatemb";
	   }//while ($rowbi=mysql_fetch_array($resultni)) { 
	   }//if($cuantosi){
	
   
   
    echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=recepcionmp.php&id_ldp=$id_ldp\">";
 exit;
}

if($id_mpisolicitudmp and $eliminarsolicutudmp){
	
$fecharechazomp=date("Y-m-d"); 

$sqlupdate="UPDATE solicitud_mp  set fecharechazomp = '$fecharechazomp', fecharecep = '0000-00-00', fecha_asig_producc = '0000-00-00'  where id_solicitud_mp=$id_mpisolicitudmp and id_ldp=$id_ldp";
$resultupdate=mysql_query($sqlupdate);   
 //echo "sqlupdate $sqlupdate<br>";
   
     $sqlpp="delete from planilla_produccion where  id_solicitud_mp = $id_solicitud_mp and id_ldp = $id_ldp";
 	 $resultpp=mysql_query($sqlpp);
	 $sqlpp="delete from maestro_produccion_tubing where  id_solicitud_mp = $id_solicitud_mp and id_ldp = $id_ldp";
 	 $resultpp=mysql_query($sqlpp);
   
   
/* 	$sqlimpbuscam="SELECT * FROM mat_prima_nacional WHERE id_solicitud_mp = $id_solicitud_mp";
	  $resultnm=mysql_query($sqlimpbuscam);
	  $cuantosn=mysql_num_rows($resultnm);
	  if($cuantosn){
	  while ($rowb=mysql_fetch_array($resultnm)) { 
      $id_mat_prima_nacionalb=$rowb[id_mat_prima_nacional];
	   $sqlupdatemb="UPDATE mat_prima_nacional  set id_estado_material = 1 where id_solicitud_mp=$id_solicitud_mp and id_mat_prima_nacional=$id_mat_prima_nacionalb";
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
	  $sqlupdatembi="UPDATE mat_prima_importada  set id_estado_material = 1 where id_solicitud_mp = $id_solicitud_mp and id_mat_prima_importada = $id_mat_prima_importadabi";
      $resultupdatembi=mysql_query($sqlupdatembi);
      }
	  }//if($cuantosn){*/
	  
	  
   
     //echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pendientesmp.php&id_ldp=$id_ldp\">";
	 //exit;
}

if($guardarcomentarios){
   $sqlupdate="UPDATE solicitud_mp  set observacionessolic = '$observacionessolic'  where id_solicitud_mp=$id_solicitud_mp and id_ldp=$id_ldp";
   $resultupdate=mysql_query($sqlupdate);   
}

if($eliminaroperarios)
{
	foreach ($_POST as $key2 => $value)
	{
     $dat=split("-",$key2); 
     if ($dat[0] == 'id_pp')
     {
	 $id=$dat[1];
   	 $id_pp=$_POST["id_pp-$id"];
	 $sqlpp="UPDATE planilla_produccion  set sin_produccion = 1 where  id_pp = $id_pp";
 	 $resultpp=mysql_query($sqlpp);
	 $sqlpp="UPDATE maestro_produccion_tubing set sin_produccion = 1 where  id_pp = $id_pp";
 	 $resultpp=mysql_query($sqlpp);
	 //echo "sqlpp $sqlpp<br>";
     }
   }
	
}

if($eliminar)
{
foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
   if ($dat[0] == 'id_mpi')
   {
	$id=$dat[1];
   	$id_mpilistard=$_POST["id_mpi-$id"];  
	$largo=strlen($id_mpilistard);
	if($largo == 8){
	  $sqlimpbusca="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mpilistard";
	  $resultn=mysql_query($sqlimpbusca);
	  if ($rowimpn=mysql_fetch_array($resultn)) { 
      $idimpn=$rowimpn[id_mat_prima_nacional];
	  }
	  $sqlupdate="UPDATE mat_prima_nacional  set id_solicitud_mp = 0, id_ldp = 0, id_estado_material = 1 where id_mat_prima_nacional  = $idimpn";
 	  $resultupdate=mysql_query($sqlupdate);   
	  $sqlelim="delete from solicitud_mp_detalle where  id_mp = $idimpn";
 	  $resultelim=mysql_query($sqlelim);
	 }// if($largo == 8){
	 if($largo == 9){
	  $sqlimpbuscai="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mpilistard";
	  $resulti=mysql_query($sqlimpbuscai);
	  if ($rowimpi=mysql_fetch_array($resulti)) { 
   	  $idimpi=$rowimpi[id_mat_prima_importada];
	  }
	  $sqlupdate="UPDATE mat_prima_importada set id_solicitud_mp = 0, id_ldp = 0, id_estado_material = 1 where id_mat_prima_importada  = $idimpi";
 	  $resultupdate=mysql_query($sqlupdate);   
	  $sqlelim="delete from solicitud_mp_detalle where id_mp = $idimpi";
 	  $resultelim=mysql_query($sqlelim);
	 }//if($largo == 9){
	
   }
}

  //echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pendientesmp.php&id_solicitud_mp=$id_solicitud_mp&id_ldp=$id_ldp\">";
 //exit;

}//if($eliminar)

if($modificar){
	
  $dat3=split(" ",$fecha_asig_producc);
  $dat1=split("-",$dat3[0]);
  $fecha_asig_producc="$dat1[2]-$dat1[1]-$dat1[0]";
	
$sqlfc="UPDATE solicitud_mp set fecha_asig_producc = '$fecha_asig_producc' where id_solicitud_mp  = $id_solicitud_mp";
$resultfc=mysql_query($sqlfc); 
}


//$sql="SELECT smp.id_solicitud_mp AS id_solicitud_mp,smp.fechasmp AS fechasmp, smp.fechaentreg AS fechaentreg, smp.fecharecep AS fecharecep,  smp.fecha_asig_producc AS fecha_asig_producc, smp.unidadessolicitadas AS unidadessolicitadas, smp.id_procedencia AS id_procedencia, org.origen AS origen, org.id_origen AS id_origen, p.producto AS producto, p.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, u.username AS username, smp.id_ldp AS id_ldp, lidp.ldp AS ldp, smp.observacionessolic  AS observacionessolic  FROM solicitud_mp AS smp, lineas_de_procesos AS lidp, origenes AS org, producto AS p, calibre AS c, usuarios AS u WHERE smp.id_solicitud_mp = smp.id_solicitud_mp AND smp.id_ldp = lidp.id_ldp AND smp.id_origen = org.id_origen AND smp.id_calibre = c.id_calibre AND smp.id_usuario = u.id_usuario AND smp.id_producto = p.id_producto AND smp.id_solicitud_mp =$id_solicitud_mp ";

$sql="SELECT smp.id_solicitud_mp AS id_solicitud_mp,smp.fechasmp AS fechasmp, smp.fechaentreg AS fechaentreg, smp.fecharecep AS fecharecep,  smp.fecha_asig_producc AS fecha_asig_producc, smp.unidadessolicitadas AS unidadessolicitadas, smp.id_procedencia AS id_procedencia, org.origen AS origen, org.id_origen AS id_origen, p.producto AS producto, p.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, u.username AS username, smp.id_ldp AS id_ldp, lidp.ldp AS ldp, smp.observacionessolic  AS observacionessolic  FROM solicitud_mp AS smp, lineas_de_procesos AS lidp, origenes AS org, producto AS p, calibre AS c, usuarios AS u WHERE smp.id_solicitud_mp = smp.id_solicitud_mp AND smp.id_ldp = lidp.id_ldp AND smp.id_origen = org.id_origen AND smp.id_calibre = c.id_calibre AND smp.id_usuario = u.id_usuario AND smp.id_producto = p.id_producto AND smp.fecha_asig_producc ='$fecha_asig_producc' ";
$result=mysql_query($sql);
//echo "sql $sql<br>";
?>
<h1>DETALLE LINEA DE PRODUCCION</h1>
<table width="98%" border="0">
 <tr>
   <td height="8" colspan="11">&nbsp;</td>
  </tr>
 <tr>
    <td width="21" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="10" bgcolor="#CCCCCC">&nbsp;<strong><? include "lib/ldp.php";?></strong>
   </td>
  </tr>
    <?
	$i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_solicitud_mp=$row[id_solicitud_mp];
	$id_ldp =$row[id_ldp];
	$id_procedencia=$row[id_procedencia];
	$username=$row[username];
	$id_origen=$row[id_origen];
	$id_producto=$row[id_producto];
	$observacionessolic=$row[observacionessolic];
	$id_calibre=$row[id_calibre];
	$unidadessolicitadas=$row[unidadessolicitadas];
	$fechasmp=format_fecha_sin_hora($row[fechasmp]);   
	$fechaentreg=format_fecha_sin_hora($row[fechaentreg]);   
	$fecharecep=format_fecha_sin_hora($row[fecharecep]);   
	$fecha_asig_producc=format_fecha_sin_hora($row[fecha_asig_producc]);   
	$totaluni+=$unidadessolicitadas;
  ?>
  <tr>
    <td width="21" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="132" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;</strong><strong>PRODUCTO</strong></td>
    <td width="204" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="76" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="115" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="92" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="101" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/ENTREGA</strong></td>
    <td width="110" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/RECEPCION</strong></td>
    <td width="125" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/PRODUCCION</strong></td>
    <td width="56" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ENCARGADO</strong><strong>&nbsp;</strong><strong>&nbsp;</strong></td>
    <td width="57" nowrap="nowrap" bgcolor="#FF9933"><center><input name="eliminarsolicutudmp" type="submit" id="eliminarsolicutudmp" value="X" /></center></td>
  </tr>
    <tr>
    <td height="8" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $id_solicitud_mp?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $unidadessolicitadas?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechasmp?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechaentreg?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecharecep?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_asig_producc?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $username?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center><input type="checkbox" name="id_mpisolicitudmp" id="id_mpisolicitudmp" value="<? echo $id_solicitud_mp?>" /><input type="hidden" name="id_mpisolicitudmp" id="id_mpisolicitudmp" value="<? echo $id_solicitud_mp?>" /></center></td>
  
    <?
$sqln="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, p.id_producto AS id_producto, p.producto AS producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.id_origen AS id_origen, org.origen AS origen, mpn.contenido AS contenido, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, em.estado_material FROM solicitud_mp_detalle AS smpd, mat_prima_nacional AS mpn, producto AS p, calibre AS c, origenes AS org, estado_material AS em WHERE smpd.id_mp = mpn.id_mat_prima_nacional and mpn.id_producto = p.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = em.id_estado_material and smpd.id_ldp = $id_ldp and smpd.id_solicitud_mp =$id_solicitud_mp order by mpn.id_mat_prima_nacional desc";
$resultn=mysql_query($sqln);
$cuantosn=mysql_num_rows($resultn);
	
	
$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.etiquetados_folios_id AS etiquetados_folios_id, p.id_producto AS id_producto, p.producto AS producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.id_origen AS id_origen, org.origen AS origen, mpi.contenido AS contenido, mpi.bidon_num AS bidon_num, mpi.fecha_ingreso AS fecha_ingreso, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, em.estado_material FROM solicitud_mp_detalle AS smpd, mat_prima_importada AS mpi, producto AS p, calibre AS c, origenes AS org, estado_material AS em WHERE smpd.id_mp = mpi.id_mat_prima_importada and mpi.id_producto = p.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = em.id_estado_material and smpd.id_ldp = $id_ldp and smpd.id_solicitud_mp =$id_solicitud_mp order by mpi.id_mat_prima_importada desc";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);
$cuantostotales=$cuantosn + $cuantosi;
	?>
  </tr>
  <tr>
    
  </tr>
    <tr>
      <td colspan="11"><table width="100%" border="0" align="center">
      <tr>
    <td width="22" height="19" bgcolor="#FF9933"><center></center></td>
    <td colspan="8" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
    <td colspan="3" bgcolor="#CCCCCC"><center>
      <? //if($id_procedencia == "N"){?>
      <a href="javascript:Abrir_ventana_nueva('codphp/asignar_mp.php?id_procedencia=<? echo "N";?>&id_producto=<? echo $id_producto?>&id_calibre=<? echo $id_calibre?>&id_origen=<? echo $id_origen?>&unidadessolicitadas=<? echo $unidadessolicitadas?>&id_solicitud_mp=<? echo $id_solicitud_mp?>&id_ldp=<? echo $id_ldp?>&tip=<? echo $tip?>&fecha_asig_producc=<? echo $row[fecha_asig_producc]?>')"><strong>Asignar MPF</strong></a>
      <? //} ?> / 
      <? //if($id_procedencia == "I"){?>
      <a href="javascript:Abrir_ventana_nueva('codphp/asignar_mp.php?id_procedencia=<? echo "I";?>&id_producto=<? echo $id_producto?>&id_calibre=<? echo $id_calibre?>&id_origen=<? echo $id_origen?>&unidadessolicitadas=<? echo $unidadessolicitadas?>&id_solicitud_mp=<? echo $id_solicitud_mp?>&id_ldp=<? echo $id_ldp?>&tip=<? echo $tip?>&fecha_asig_producc=<? echo $row[fecha_asig_producc]?>')"><strong>Asignar MPS</strong></a>
      <? //} ?></center>    </td>
    </tr>
  <tr>
    <td width="22" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
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
    <td width="68" align="center" nowrap="nowrap" bgcolor="#FF9933"><input name="eliminar" type="submit" id="eliminar" value="X" /></td>
  </tr>
     <?
	if($cuantosn){
		
    $i=1;
    $color = "#000000";
    while ($rown=mysql_fetch_array($resultn))
    {
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_nacional=$rown[id_mat_prima_nacional];
	$id_mat_prima_nacionall=$rown[id_mat_prima_nacional];
	$id_producto=$rown[id_producto];
	$id_calibre=$rown[id_calibre];
	$id_origen=$rown[id_origen];
	$fecha_faena =format_fecha_sin_hora($rown[fecha_faena]);   
	$fecha_termino=format_fecha_sin_hora($rown[fecha_termino]);
	$fecha_ingreso=format_fecha_sin_hora($rown[fecha_ingreso]);   
	$contenidoi=$rown[contenido];
	$cuentabidonesi=$rown[cuentabidones];
	$contenidototali+=$contenidoi;
  ?>
     <tr>
       <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
       <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpfresca.php&amp;id_mat_prima_nacional=<? echo $id_mat_prima_nacional?>&amp;id_origen=<? echo $id_origen?>&amp;id_producto=<? echo $id_producto?>&amp;fresca=<? echo "N";?>">F<? echo $id_mat_prima_nacional?>
       </a></td>
       <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rown[producto]?></td>
       <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$rown[calibre]";}?></td>
       <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rown[origen]?></td>
       <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
         <? echo $rown[contenido]?>
       </center></td>
       <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
         <? echo $rown[bidon_num]?>
       </center></td>
       <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
       <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_faena ?></td>
       <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_termino?></td>
       <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rown[estado_material]?></td>
       <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>"><input type="checkbox" name="id_mpi-<? echo $id_mat_prima_nacional?>" id="id_mpi" value="<? echo $id_mat_prima_nacionall?>" /><input type="hidden" name="id_mpielim-<? echo $id_mat_prima_nacional?>" id="id_mpielim" value="<? echo $id_mat_prima_nacional?>" /></td>
     </tr>
      <? 	$i++; 	 
	  	  }
		$is=$is + $i;
	}

	?>
      <?
	if($cuantosi){
		if($is){ $i=$is;}else{ $i=1;}
		
    $color = "#000000";
    while ($rowi=mysql_fetch_array($resulti))
    {
	
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$id_mat_prima_importadaa=$rowi[id_mat_prima_importada];
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$id_producto=$rowi[id_producto];
	$id_calibre=$rowi[id_calibre];
	$id_origen=$rowi[id_origen];
	$fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   
	$contenidoi=$rowi[contenido];
	$cuentabidonesi=$rowi[cuentabidones];
	$contenidototali+=$contenidoi;
  ?>
     <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>">S<? 
	 $largo=strlen($id_mat_prima_importada);
	 
	  if($etiquetados_folios_id)
	 {
	  echo "$etiquetados_folios_id";
	 }else{
		
		if($largo == 9){
	 	$id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 	}
	 	echo $id_mat_prima_importada;
	 }//if($etiquetados_folios_id)?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$rowi[calibre]";}?></td>
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
    <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[estado_material]?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>"><input type="checkbox" name="id_mpi-<? echo $id_mat_prima_importadaa?>" id="id_mpi" value="<? echo $id_mat_prima_importadaa?>" /><input type="hidden" name="id_mpielim-<? echo $id_mat_prima_importadaa?>" id="id_mpielim" value="<? echo $id_mat_prima_importadaa?>" /></td>
   </tr>
   <? $i++;
     } 
     }
	 
	?>
  <tr>
    <td height="19" colspan="5" align="right" nowrap="nowrap" bgcolor="#FFFFFF">TOTAL</td>
    <td align="center" nowrap="nowrap" bgcolor="#CCCCCC">&nbsp;<strong><? echo $fstotal=$contenidototal+$contenidototali;?></strong></td>
    <td colspan="6" align="right" nowrap="nowrap" bgcolor="#FFFFFF"><!--<input type="button" value="Example" name="rechazarmp" id="rechazarmp" onclick="location.href ='?modulo=pproduccdetalle.php&fecha_asig_producc=<? //echo $fecha_asig_producc?>&id_ldp=<?// echo $id_ldp?>&infomenu=1&tip=<? //echo $tip?>&id_solicitud_mp=<?// echo $id_solicitud_mp?>';" />--></td>
    </tr>
      </table></td>
    </tr>
    <tr>
    
      <td colspan="11" align="right">
     
      </td>
  </tr>  <? 
	}
	?>
    <tr>
      <td colspan="11" align="right">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="11"><HR>
        <a href="#" onclick="cambiar('error'); return false;">INGRESAR OBSERVACIONES</a></td>
  </tr>
    <tr>
      <td colspan="11"><div id="error" style="display: none;"><center><textarea name="observacionessolic" id="observacionessolic" cols="80" rows="5"><? echo $observacionessolic?></textarea></center>&nbsp;&nbsp;&nbsp;<center><input type="submit" name="guardarcomentarios" id="guardarcomentarios" value="Guardar Observaciones" /></center></div><HR></td>
    </tr>
    <tr>
     <? 
	  $sqlexistep="SELECT * FROM planilla_produccion where id_solicitud_mp = $id_solicitud_mp";
	  $resultexistep=mysql_query($sqlexistep);
      $cuantosexistep=mysql_num_rows($resultexistep);
	  
	  if($cuantosexistep){?>
      <td colspan="11">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="11" bgcolor="#FF9933">&nbsp;<strong>REGISTRO DE ENTREGA Y DEVOLUCION DE MATERIA PRIMA</strong></td>
    </tr>
    <tr>
      <td colspan="11">
     
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="26" rowspan="2">&nbsp;N&ordm;</td>
          <td width="116" rowspan="2">&nbsp;NOMBRE</td>
          <td width="92" rowspan="2">&nbsp;INICIALES</td>
          <td width="135" rowspan="2">&nbsp;PRODECENCIA</td>
          <td colspan="14">&nbsp;MATERIA PRIMA</td>
        </tr>
        <tr>
          <td colspan="7">&nbsp;NUDOS ENTREGADOS</td>
          <td colspan="7">&nbsp;NUDOS DEVUELTO</td>
        </tr>
        <?
        if($id_ldp){
$sqllinea="SELECT o.nombreop AS nombreop, o.apellido AS apellidoop, o.orden AS orden, o.iniciales AS iniciales, pp.id_pp AS id_pp, pp.id_solicitud_mp AS id_solicitud_mp, pp.id_ldp AS id_ldp, pp.id_operarios AS id_operarios, pp.id_origen AS id_origenpp, pp.e1 AS e1, pp.e2 AS e2, pp.e3 AS e3, pp.e4 AS e4, pp.e5 AS e5, pp.e6 AS e6, pp.etotal AS etotal, pp.d1 AS d1, pp.d2 AS d2, pp.d3 AS d3, pp.dtotal AS dtotal, pp.totaled AS totaled, pp.fecha_asig_producc AS fecha_asig_producc FROM planilla_produccion AS pp, solicitud_mp AS smp, lineas_de_procesos AS ldp, operarios AS o where pp.id_solicitud_mp = smp.id_solicitud_mp and pp.id_ldp = ldp.id_ldp and pp.id_operarios = o.id_operarios and pp.id_solicitud_mp = $id_solicitud_mp and pp.id_ldp = $id_ldp order by o.orden asc ";
$resultlinea=mysql_query($sqllinea);
$cuantoslinea=mysql_num_rows($resultlinea);
//echo "sqllinea $sqllinea<br>cuantoslinea $cuantoslinea<br>";
}		?>

 

        <tr>
          <td>&nbsp;</td>
          <td nowrap="nowrap">&nbsp;</td>
          <td nowrap="nowrap">&nbsp;</td>
          <td nowrap="nowrap">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td bgcolor="#CCCCCC"><center><b>T/E</b></center></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td bgcolor="#CCCCCC"><center><b>T/D</b></center></td>
          <td bgcolor="#CCCCCC"><center><b>T/G</b></center></td>
          <td width="95" bgcolor="#CCCCCC"><center><b>UNIDADES</b></center></td>
          <td width="53"><!--<center><input name="eliminaroperarios" type="submit" id="eliminaroperarios" value="X" /></center>--></td>
        </tr>
        <?
	if($cuantoslinea){
    $ilinea=$oplinea;
    $colorlinea = "#000000";$ilinea = 0;
    while ($rowlinea=mysql_fetch_array($resultlinea))
    {
	$ilinea++;
	$colorlinea = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_operarios=$rowlinea[id_operarios];
	$nombreop=$rowlinea[nombreop];
	$apellidoop=$rowlinea[apellidoop];
	$inicialesop=$rowlinea[iniciales];
	$id_pp=$rowlinea[id_pp];
	$id_ldp=$rowlinea[id_ldp];
	$id_solicitud_mp=$rowlinea[id_solicitud_mp];
	$orden=$rowlinea[orden];
	$e1=$rowlinea[e1];
	$e2=$rowlinea[e2];
	$e3=$rowlinea[e3];
	$e4=$rowlinea[e4];
	$e5=$rowlinea[e5];
	$e6=$rowlinea[e6];
	$d1=$rowlinea[d1];
	$d2=$rowlinea[d2];
	$d3=$rowlinea[d3];
	$sin_produccion=$rowlinea[sin_produccion];
	$fecha_asig_producc=$rowlinea[fecha_asig_producc];
	$ido=$rowlinea[id_origenpp];
	//echo "ido $ido<br>";
  ?>
        <tr>
          <td>&nbsp;<? echo $orden?></td>
          <td nowrap="nowrap">&nbsp;<? echo $nombreop2=strtoupper($nombreop); echo " "; echo $apellidoop2=strtoupper($apellidoop);?></td>
          <td nowrap="nowrap"><center><? echo $inicialesop?></center></td>
          <td nowrap="nowrap"><?
		  //,$fecha_asig_producc 
		 // echo "ido $ido<br>";
          $origen= crea_origenes_planilla($link,$ido,$id_pp,$fecha_asig_producc);
		  echo $origen;
		  
		  ?></td>
          <td width="29">&nbsp;<input name="e1-<? echo $id_pp?>" type="text" class="tex2" id="e1" value="<?echo $e1?>" size="2" maxlength="2" /></td>
          <td width="28">&nbsp;<input name="e2-<? echo $id_pp?>" type="text" class="tex2" id="e2" value="<?echo $e2?>" size="2" maxlength="2" /></td>
          <td width="35">&nbsp;<input name="e3-<? echo $id_pp?>" type="text" class="tex2" id="e3" value="<?echo $e3?>" size="2" maxlength="2" /></td>
          <td width="31">&nbsp;<input name="e4-<? echo $id_pp?>" type="text" class="tex2" id="e4" value="<?echo $e4?>" size="2" maxlength="2" /></td>
          <td width="33">&nbsp;<input name="e5-<? echo $id_pp?>" type="text" class="tex2" id="e5" value="<?echo $e5?>" size="2" maxlength="2" /></td>
          <td width="51">&nbsp;<input name="e6-<? echo $id_pp?>" type="text" class="tex2" id="e6" value="<?echo $e6?>" size="2" maxlength="2" /></td>
          <td width="53" bgcolor="#CCCCCC"><center><? 	echo $etotal=$e1+$e2+$e3+$e4+$e5+$e6; ?></center></td>
          <td width="41">&nbsp;<input name="d1-<? echo $id_pp?>" type="text" class="tex2" id="d1" value="<?echo $d1?>" size="2" maxlength="2" /></td>
          <td width="51">&nbsp;<input name="d2-<? echo $id_pp?>" type="text" class="tex2" id="d2" value="<?echo $d2?>" size="2" maxlength="2" /></td>
          <td width="37">&nbsp;<input name="d3-<? echo $id_pp?>" type="text" class="tex2" id="d3" value="<?echo $d3?>" size="2" maxlength="2" /></td>
          <td width="72" bgcolor="#CCCCCC"><center><?	$dtotal=$d1+$d2+$d3; ?><?echo $dtotal?></center></td>
          <td width="76" bgcolor="#CCCCCC"><center><? echo $t=$etotal-$dtotal?></center></td>
          <td bgcolor="#CCCCCC"><center><? echo $uni=$t * 20?></center></td>
          <td>
      <!--    <center>
          <? //if($sin_produccion){?>
          <input name="id_pp-<? //echo $id_pp?>" type="checkbox" id="id_pp" value="1" checked="checked" />
          <input name="id_pp-<? //echo $id_pp?>" type="checkbox" id="id_pp" value="0" />
          <? //}else{ ?>
          <input name="id_pp-<? //echo $id_pp?>" type="checkbox" id="id_pp" value="1"  />
          <input name="id_pp-<? //echo $id_pp?>" type="checkbox" id="id_pp" value="0" checked="checked"/>
          <? //} ?>
          </center>-->
          </td>
        </tr>
        <?
	    $sumae1+=$e1;
  		$sumae2+=$e2;
  	 	$sumae3+=$e3;
  		$sumae4+=$e4;
  		$sumae5+=$e5;
  		$sumae6+=$e6;
  		$sumad1+=$d1;
  		$sumad2+=$d2;
  		$sumad3+=$d3;
  		$sumadtotal+=$dtotal;
  		$sumanetotal+=$etotal;
  		$tsumat+=$t;
  		$totalsumauni+=$uni;
			   
	}
	}
		?>
        <tr>
          <td colspan="4" align="right" bgcolor="#CCCCCC"><b>TOTAL GENERAL</b></td>
          <td bgcolor="#CCCCCC">&nbsp;<? echo $sumae1?></td>
          <td bgcolor="#CCCCCC">&nbsp;<? echo $sumae2?></td>
          <td bgcolor="#CCCCCC">&nbsp;<? echo $sumae3?></td>
          <td bgcolor="#CCCCCC">&nbsp;<? echo $sumae4?></td>
          <td bgcolor="#CCCCCC">&nbsp;<? echo $sumae5?></td>
          <td bgcolor="#CCCCCC">&nbsp;<? echo $sumae6?></td>
          <td bgcolor="#CCCCCC"><center><? echo $sumanetotal?></center></td>
          <td bgcolor="#CCCCCC">&nbsp;<? echo $sumad1?></td>
          <td bgcolor="#CCCCCC">&nbsp;<? echo $sumad2?></td>
          <td bgcolor="#CCCCCC">&nbsp;<? echo $sumad3?></td>
          <td bgcolor="#CCCCCC"><center><? echo $sumadtotal?></center></td>
          <td bgcolor="#CCCCCC"><center><? echo $tsumat?></center></td>
          <td bgcolor="#CCCCCC"><center>
            <? echo $totalsumauni?>
          </center></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="18" align="right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="18" align="right"><center><input type="submit" name="actualizar_datos" id="actualizar_datos" value="Actualizar Datos del registro de entrega y devolucion de materia prima" /></center></td>
        </tr>
        <tr>
          <td colspan="18" align="right">
          <?
          	//echo "unidades solicitadas $unidadessolicitadas -- total general $totalsumauni<br>";	

	if($actualizar_datos){			
	
$sqln2="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, p.id_producto AS id_producto, p.producto AS producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.id_origen AS id_origen, org.origen AS origen, mpn.contenido AS contenido, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, em.estado_material FROM solicitud_mp_detalle AS smpd, mat_prima_nacional AS mpn, producto AS p, calibre AS c, origenes AS org, estado_material AS em WHERE smpd.id_mp = mpn.id_mat_prima_nacional and mpn.id_producto = p.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = em.id_estado_material and smpd.id_ldp = $id_ldp and smpd.id_solicitud_mp =$id_solicitud_mp order by mpn.id_mat_prima_nacional desc";
$resultn2=mysql_query($sqln2);

$sqli2="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, p.id_producto AS id_producto, p.producto AS producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.id_origen AS id_origen, org.origen AS origen, mpi.contenido AS contenido, mpi.bidon_num AS bidon_num, mpi.fecha_ingreso AS fecha_ingreso, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, em.estado_material FROM solicitud_mp_detalle AS smpd, mat_prima_importada AS mpi, producto AS p, calibre AS c, origenes AS org, estado_material AS em WHERE smpd.id_mp = mpi.id_mat_prima_importada and mpi.id_producto = p.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = em.id_estado_material and smpd.id_ldp = $id_ldp and smpd.id_solicitud_mp =$id_solicitud_mp order by mpi.id_mat_prima_importada desc";
$resulti2=mysql_query($sqli2);

			
			 while ($rowno=mysql_fetch_array($resultn2))
    				{
					$id_mat_prima_nacional=$rown[id_mat_prima_nacional];
					$contenidon=$rown[contenido];
					//echo "$id_mat_prima_nacional - $contenidon<br>";
					$contenidotn+= $contenidon;
					if($totalsumauni > $contenidotn){
					//echo "siiii";
					}
					
					
					}
					
			while ($rowio=mysql_fetch_array($resulti2))
			       {
					$id_mat_prima_importada=$rowio[id_mat_prima_importada];
					$contenidoi=$rowio[contenido];
					//echo "$id_mat_prima_importada - BIDON $contenidoi - $totalsumauni<br>";
					
					$contenidot+= $contenidoi;
					
					//echo "contenidot $contenidot<br>";
					
					if($totalsumauni >= $contenidot){
					
					$fecharebajapt=date("Y-m-d"); 
					
					$sqlrebajapt="UPDATE mat_prima_importada SET  id_estado_material= 2, fecha_salida ='$fecharebajapt' where id_mat_prima_importada  = $id_mat_prima_importada";
					$retsulrebajapt=mysql_query($sqlrebajapt);
					
					//echo "sqlrebajapt $sqlrebajapt<br>";
										
					}else{				
							
				
					$sqlrebajapt="UPDATE mat_prima_importada SET  id_estado_material= 1, fecha_salida ='0000-00-00' where id_mat_prima_importada  = $id_mat_prima_importada";
					$retsulrebajapt=mysql_query($sqlrebajapt);
					//echo "sqlrebajapt $sqlrebajapt<br>";
									
					}
					
					
					

					
				   } //echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pproduccdetalle.php&id_solicitud_mp=$id_solicitud_mp&id_ldp=$id_ldp\">";
//exit;
					
				   

					
			}
			
		  ?>
          </td>
        </tr>
 
      </table>
     
     </td>
       <? }//id_solicitud_mp (Si viene definido significa que existe datos en la tabla planilla_produccion)?>
    </tr>
    <tr>
      <td colspan="11" bgcolor="#FF9933">&nbsp;<strong>REGISTRO DE ENTREGA DE PRODUCCION</strong></td>
    </tr>
    <tr>
      <td colspan="11"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="23" rowspan="3" nowrap="nowrap">N&ordm;</td>
          <td width="53" rowspan="3" nowrap="nowrap">INICIALES</td>
          <td colspan="12" nowrap="nowrap">PLANILLA TUBING</td>
        </tr>
        <tr>
          <td colspan="3" nowrap="nowrap" bgcolor="#CCCCCC"><center>MATERIA PRIMA</center></td>
          <td colspan="7" nowrap="nowrap" bgcolor="#CCCCCC">PRODUCCION</td>
          <td width="155" nowrap="nowrap" bgcolor="#CCCCCC" ><center>UNIDADES</center></td>
          <td width="179" nowrap="nowrap" bgcolor="#CCCCCC"><center>DIFERENCIA</center></td>
        </tr>
        <tr>
          <td width="47" nowrap="nowrap">NUDOS</td>
          <td width="58" nowrap="nowrap">UNIDADES</td>
          <td width="190" nowrap="nowrap">ORIGEN</td>
          <td width="46" nowrap="nowrap" bgcolor="#CC9900">Cortos</td>
          <td width="81" nowrap="nowrap" >1 Corto x 5 Tripas= Unidades</td>
          <td width="42" align="center" nowrap="nowrap" bgcolor="#339933">Verde</td>
          <td width="40" align="center" nowrap="nowrap" bgcolor="#FF0000">Rojos</td>
          <td width="34" align="center" nowrap="nowrap" bgcolor="#0033FF">Azul</td>
          <td width="43" align="center" nowrap="nowrap" bgcolor="#FFFF33">Waste</td>
          <td width="63" nowrap="nowrap" class="tex1">1 Waste x 10 Tripas=  Unidades</td>
          <td align="center" nowrap="nowrap" bgcolor="#FFCC33">(Verde + Rojo + Azul)</td>
          <td align="center" nowrap="nowrap"> (MP v/s PR)</td>
        </tr>
        <?
	  
		 $sqltubing="SELECT * from maestro_produccion_tubing AS mptubing, operarios AS op, origenes AS org where mptubing.id_operarios = op.id_operarios and mptubing.id_origen = org.id_origen and mptubing.id_solicitud_mp = $id_solicitud_mp and mptubing.id_ldp = $id_ldp  order by op.orden asc";
		 
		 
		 
$resultubing=mysql_query($sqltubing);
		$i=0;
        while ($rowtubing=mysql_fetch_array($resultubing)){
    	$id_operarios=$rowtubing[id_operarios];
		$nombreop=$rowtubing[nombreop];
	    $apellidoop=$rowtubing[apellidoop];
		$iniciales4=$rowtubing[iniciales];
		$total_nudos=$rowtubing[total_nudos];
		$id_origen2=$rowtubing[id_origen];
		$origen2=$rowtubing[origen];
		$procorto=$rowtubing[procorto];
		$proverde=$rowtubing[proverde];
		$prorojo=$rowtubing[prorojo];
		$proazul=$rowtubing[proazul];
		$prowaste=$rowtubing[prowaste];
		
		$id_mptubing=$rowtubing[id_mptubing];
		$i++;
       // echo "ddddddddddddddddddd id_mrdm $id_mrdm<br>";


		?>
        <tr>
          <td>&nbsp;<? echo $i?></td>
          <td align="center"><? echo $iniciales4?></td>
          <td align="center"><?echo $total_nudos ?></td>
          <td align="center">&nbsp;<? echo $unidad_mp=$total_nudos * 20?></td>
          <td>&nbsp;
            <?
		if(!$origen2){
		echo "Sin Asignar";	
		}else{
		echo $origen2;
		}
		?></td>
          <td bgcolor="#CC9900"><center><input name="procorto-<? echo $id_mptubing?>" type="text" id="procorto" value="<?echo $procorto?>" size="2" maxlength="3" /></center></td>
          <td align="center"><? 
		//1 corto x 5 tripas = unidades
		echo $unidadadesprocorto=$procorto*5;
		?></td>
          <td align="center" bgcolor="#339933"><input name="proverde-<? echo $id_mptubing?>" type="text" id="proverde" value="<?echo $proverde?>" size="2" maxlength="3" /></td>
          <td align="center" bgcolor="#FF0000"><input name="prorojo-<? echo $id_mptubing?>" type="text" id="prorojo" value="<?echo $prorojo?>" size="2" maxlength="3" /></td>
          <td align="center" bgcolor="#0033FF"><input name="proazul-<? echo $id_mptubing?>" type="text" id="proazul" value="<?echo $proazul?>" size="2" maxlength="3" /></td>
          <td align="center" bgcolor="#FFFF33"><input name="prowaste-<? echo $id_mptubing?>" type="text" id="prowaste" value="<?echo $prowaste?>" size="2" maxlength="3" /></td>
          <td align="center" class="tex2"><? 
		//1 weist x 10 tripas = 10 unidades
		echo $unidadadesprowaste=$prowaste*10;
		?></td>
          <td align="center" bgcolor="#FFCC33">&nbsp;
            <? 
		//echo "$proverde<br>$prorojo<br>$proazul<br>";
		echo $sumatoria_v_r_a=$proverde+$prorojo+$proazul
		
		?>
          </td>
          <td align="center">&nbsp;<? //echo "$unidad_mp";
		  //echo "rv= $unidadadesprocorto<br>";
		  $suma_entre_vra_corto=$sumatoria_v_r_a + $unidadadesprocorto;
		  $f=$suma_entre_vra_corto;
		  $g=$unidad_mp;
		  $ojala=$f-$g;
		  echo "$ojala";
		  ?></td>
          <?
		 $totasum+=$total_nudos;
		 $totalunisum+=$unidad_mp;
		 $sumaprocorto+=$procorto;
		 $sumaproverde+=$proverde;
		 $sumaprorojo+=$prorojo;
		 $sumaproazul+=$proazul;
		 $sumaprowaste+=$sumaprowaste;
		 $sumadiferencia+=$ojala;
		 $totalsumatoriara+=$sumatoria_v_r_a;
		 } ?>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#CCCCCC">TOTAL</td>
          <td align="center" bgcolor="#CCCCCC">&nbsp;<? echo $totasum?></td>
          <td align="center" bgcolor="#CCCCCC">&nbsp;<? echo $totalunisum?></td>
          <td bgcolor="#CCCCCC" class="tex2">&nbsp;</td>
          <td colspan="2" bgcolor="#CCCCCC" >&nbsp;<? echo $sumaprocorto?></td>
          <td bgcolor="#339933"><center><? echo $sumaproverde?></center></td>
          <td bgcolor="#FF0000"><center><? echo $sumaprorojo?></center></td>
          <td bgcolor="#0033FF"><center><? echo $sumaproazul?></center></td>
          <td bgcolor="#FFFF33"><center><? echo $sumaprowaste?></center></td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td align="center" bgcolor="#FFCC33">&nbsp;<? echo $totalsumatoriara?></td>
          <td align="center" bgcolor="#CCCCCC">&nbsp;<? echo $sumadiferencia?></td>
        </tr>
        <tr>
          <td colspan="14">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="14"><center><input type="submit" name="actualizar_datos2" id="actualizar_datos2" value="Actualizar Datos del registro de entrega de produccion" /></center></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="11">&nbsp;</td>
    </tr>
</table>
