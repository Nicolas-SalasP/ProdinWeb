<?

if($asignarproduccion and $fecha_asig_producc){
$fecha_asig_producc=format_fecha_sin_hora($fecha_asig_producc);

/*$sqlexistefechaproduccion="SELECT * FROM solicitud_mp where fecha_asig_producc = '$fecha_asig_producc'";
$resultexistefechaproduccion=mysql_query($sqlexistefechaproduccion);
$cuantos_existefechaproduccion=mysql_num_rows($resultexistefechaproduccion);
*/


$sqlasigpro="UPDATE solicitud_mp set fecha_asig_producc = '$fecha_asig_producc' where id_solicitud_mp  = $id_solicitud_mp";
$resultasigpro=mysql_query($sqlasigpro); 

/*if($id_ldp){
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

/*	 $sqlimpbuscam="SELECT * FROM mat_prima_nacional WHERE id_solicitud_mp = $id_solicitud_mp";
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
	  }//if($cuantosn){
	  */

  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=recepcionmp.php&id_ldp=$id_ldp\">";
 exit;
}

$sqlsumnac="SELECT SUM( mpn.contenido )AS contenidotn
FROM solicitud_mp_detalle AS smpd, mat_prima_nacional AS mpn, producto AS p, calibre AS c, origenes AS org, estado_material AS em
WHERE smpd.id_mp = mpn.id_mat_prima_nacional
AND mpn.id_producto = p.id_producto
AND mpn.id_calibre = c.id_calibre
AND mpn.id_origen = org.id_origen
AND mpn.id_estado_material = em.id_estado_material
AND smpd.id_ldp = $id_ldp
AND smpd.id_solicitud_mp =$id_solicitud_mp";
$retsulsumnac=mysql_query($sqlsumnac);

 if ($rowretsulsumnac=mysql_fetch_array($retsulsumnac))
    {
	$contenidotn=$rowretsulsumnac[contenidotn];
	}



$sqlsumimp="SELECT SUM( mpi.contenido )AS contenidoti
FROM solicitud_mp_detalle AS smpd, mat_prima_importada AS mpi, producto AS p, calibre AS c, origenes AS org, estado_material AS em
WHERE smpd.id_mp = mpi.id_mat_prima_importada
AND mpi.id_producto = p.id_producto
AND mpi.id_calibre = c.id_calibre
AND mpi.id_origen = org.id_origen
AND mpi.id_estado_material = em.id_estado_material
AND smpd.id_ldp = $id_ldp 
AND smpd.id_solicitud_mp =$id_solicitud_mp";
$retsulsumimp=mysql_query($sqlsumimp);

 if ($rowretsulsumimp=mysql_fetch_array($retsulsumimp))
    {
	$contenidoti=$rowretsulsumimp[contenidoti];
	}



$unidadessolicitadasactual=$contenidotn+$contenidoti;

//echo "unidadessolicitadasactual $unidadessolicitadasactual";
   $sqlfcac="UPDATE solicitud_mp set unidadessolicitadas='$unidadessolicitadasactual' where id_solicitud_mp  = $id_solicitud_mp";
   $resultfcac=mysql_query($sqlfcac); 
  //echo "sqlfcac $sqlfcac";

if($actualiza_disponibilidad){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'id_estdis')
	{
    $id=$dat[1];
	$id_estdis=$_POST["id_estdis-$id"];
    $sql="UPDATE solicitud_mp_detalle  SET id_estdis='$id_estdis' where id_mp = $id";
	$retsul=mysql_query($sql);
	//echo "sql $sql<br>";
	
	$sqlfechainformar="UPDATE solicitud_mp set fechainformar = '0000-00-00' where id_solicitud_mp  = $id_solicitud_mp";
    $resultfechainformar=mysql_query($sqlfechainformar); 

   }
   
}
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pendientesmpdetalle.php&id_solicitud_mp=$id_solicitud_mp&id_ldp=$id_ldp&tip=$tip\">";
 exit;

}

if($enviar_spmp){
	//$fecharecep=date("Y-m-d"); 
	$fechainformar=date("Y-m-d"); 
    //$sqlupdate="UPDATE solicitud_mp  set fecharecep = '$fecharecep', fecharechazomp = '0000-00-00'  where id_solicitud_mp=$id_solicitud_mp and id_ldp=$id_ldp";
	$sqlupdate="UPDATE solicitud_mp  set fechainformar = '$fechainformar', fecharechazomp = '0000-00-00'  where id_solicitud_mp=$id_solicitud_mp and id_ldp=$id_ldp";
   $resultupdate=mysql_query($sqlupdate); 
   $informar_solicitud=1;
   include "modulo_email/email1.php";
    echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pendientesmp.php&id_ldp=$id_ldp&tip=$tip\">";
 exit;
}

if($reenviar_solicitud){
	$fecharecep=date("Y-m-d"); 
	$sqlupdate="UPDATE solicitud_mp  set fecharecep = '$fecharecep', fecharechazomp = '0000-00-00'  where id_solicitud_mp=$id_solicitud_mp and id_ldp=$id_ldp";
   $resultupdate=mysql_query($sqlupdate); 
   
   
      $sqlimpbuscam="SELECT * FROM mat_prima_nacional WHERE id_solicitud_mp = $id_solicitud_mp";
	  $resultnm=mysql_query($sqlimpbuscam);
	  $cuantosn=mysql_num_rows($resultnm);
	  $fechastockprodfresco=date("Y-m-d"); 
	  if($cuantosn){
	  while ($rowb=mysql_fetch_array($resultnm)) { 
      $id_mat_prima_nacionalb=$rowb[id_mat_prima_nacional];
	   $sqlupdatemb="UPDATE mat_prima_nacional  set id_estado_material = 1, fechastockprodfresco = '$fechastockprodfresco' where id_solicitud_mp=$id_solicitud_mp and id_mat_prima_nacional=$id_mat_prima_nacionalb";
   $resultupdatemb=mysql_query($sqlupdatemb);
  // echo "sqlupdatemb $sqlupdatemb";
	  }
	  }//if($cuantosn){
	  
	  $sqlimpbuscai="SELECT * FROM mat_prima_importada WHERE id_solicitud_mp = $id_solicitud_mp";
	  $resultni=mysql_query($sqlimpbuscai);
	  $cuantosi=mysql_num_rows($resultni);
	  $fechastockprodsalado=date("Y-m-d"); 
	  if($cuantosi){
	  while ($rowbi=mysql_fetch_array($resultni)) { 
      $id_mat_prima_importadabi=$rowbi[id_mat_prima_importada];
	  $sqlupdatembi="UPDATE mat_prima_importada  set id_estado_material = 1, fechastockprodsalado = '$fechastockprodsalado' where id_solicitud_mp = $id_solicitud_mp and id_mat_prima_importada = $id_mat_prima_importadabi";
      $resultupdatembi=mysql_query($sqlupdatembi);
      }
	  }//if($cuantosn){
   
    echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pendientesmpdetalle.php&id_solicitud_mp=$id_solicitud_mp&id_ldp=$id_ldp&infomenu=$infomenu&tip=$tip\">";
 exit;
	
}	

if($fecharecep){
	//$fecharecep=date("Y-m-d"); 
	$fecharecep=date("Y-m-d"); 
    //$sqlupdate="UPDATE solicitud_mp  set fecharecep = '$fecharecep', fecharechazomp = '0000-00-00'  where id_solicitud_mp=$id_solicitud_mp and id_ldp=$id_ldp";
	$sqlupdate="UPDATE solicitud_mp  set fecharecep = '$fecharecep', fecharechazomp = '0000-00-00'  where id_solicitud_mp=$id_solicitud_mp and id_ldp=$id_ldp";
   $resultupdate=mysql_query($sqlupdate); 
   
    $recepcionar_solicitud=1;
   include "modulo_email/email1.php";
   
      $sqlimpbuscam="SELECT * FROM mat_prima_nacional WHERE id_solicitud_mp = $id_solicitud_mp";
	  $resultnm=mysql_query($sqlimpbuscam);
	  $cuantosn=mysql_num_rows($resultnm);
	  $fechastockprodfresco=date("Y-m-d"); 
	  if($cuantosn){
	  while ($rowb=mysql_fetch_array($resultnm)) { 
      $id_mat_prima_nacionalb=$rowb[id_mat_prima_nacional];
	   $sqlupdatemb="UPDATE mat_prima_nacional  set id_estado_material = 1, fechastockprodfresco = '$fechastockprodfresco' where id_solicitud_mp=$id_solicitud_mp and id_mat_prima_nacional=$id_mat_prima_nacionalb";
   $resultupdatemb=mysql_query($sqlupdatemb);
  // echo "sqlupdatemb $sqlupdatemb";
	  }
	  }//if($cuantosn){
	  
	  $sqlimpbuscai="SELECT * FROM mat_prima_importada WHERE id_solicitud_mp = $id_solicitud_mp";
	  $resultni=mysql_query($sqlimpbuscai);
	  $cuantosi=mysql_num_rows($resultni);
	  $fechastockprodsalado=date("Y-m-d"); 
	  if($cuantosi){
	  while ($rowbi=mysql_fetch_array($resultni)) { 
      $id_mat_prima_importadabi=$rowbi[id_mat_prima_importada];
	  $sqlupdatembi="UPDATE mat_prima_importada  set id_estado_material = 1, fechastockprodsalado = '$fechastockprodsalado' where id_solicitud_mp = $id_solicitud_mp and id_mat_prima_importada = $id_mat_prima_importadabi";
      $resultupdatembi=mysql_query($sqlupdatembi);
      }
	  }//if($cuantosn){
   
    echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=recepcionmp.php&id_ldp=$id_ldp&infomenu=$infomenu&tip=4\">";
 exit;
}

if($esabodega){
    $sqlupdate="UPDATE solicitud_mp  set fecharecep = '0000-00-00', fechainformar = '0000-00-00', fecharechazomp = '0000-00-00'  where id_solicitud_mp=$id_solicitud_mp and id_ldp=$id_ldp";
   $resultupdate=mysql_query($sqlupdate); 
    echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pendientesmp.php&id_ldp=$id_ldp&infomenu=1&tip=2\">";
 exit;
}

if($rechazarmp or $corregir){
$fecharechazomp=date("Y-m-d"); 

   $sqlupdate="UPDATE solicitud_mp  set fecharechazomp = '$fecharechazomp', fecharecep = '0000-00-00'  where id_solicitud_mp=$id_solicitud_mp and id_ldp=$id_ldp";
   $resultupdate=mysql_query($sqlupdate);   
   //echo "sqlupdate $sqlupdate<br>";
   
   	 $sqlimpbuscam="SELECT * FROM mat_prima_nacional WHERE id_solicitud_mp = $id_solicitud_mp";
	  $resultnm=mysql_query($sqlimpbuscam);
	  $cuantosn=mysql_num_rows($resultnm);
	  if($cuantosn){
	  while ($rowb=mysql_fetch_array($resultnm)) { 
      $id_mat_prima_nacionalb=$rowb[id_mat_prima_nacional];
	   $sqlupdatemb="UPDATE mat_prima_nacional  set id_estado_material = 1, fechastockprodfresco = '0000-00-00'  where id_solicitud_mp=$id_solicitud_mp and id_mat_prima_nacional=$id_mat_prima_nacionalb";
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
	  $sqlupdatembi="UPDATE mat_prima_importada  set id_estado_material = 1, fechastockprodsalado = '0000-00-00' where id_solicitud_mp = $id_solicitud_mp and id_mat_prima_importada = $id_mat_prima_importadabi";
      $resultupdatembi=mysql_query($sqlupdatembi);
      }
	  }//if($cuantosn){
	  

     echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=rechazadassmp.php&id_ldp=$id_ldp&infomenu=1&tip=3\">";
 	 exit;

}

if($guardarcomentarios){
   $sqlupdate="UPDATE solicitud_mp  set observacionessolic = '$observacionessolic'  where id_solicitud_mp=$id_solicitud_mp and id_ldp=$id_ldp";
   $resultupdate=mysql_query($sqlupdate);   
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
	  $sqlupdate="UPDATE mat_prima_nacional  set id_solicitud_mp = 0, fecha_asig_producc = '0000-00-00',id_ldp = 0, id_estado_material = 1 where id_mat_prima_nacional  = $idimpn";
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
	  $sqlupdate="UPDATE mat_prima_importada set id_solicitud_mp = 0, fecha_asig_producc = '0000-00-00', id_ldp = 0, id_estado_material = 1 where id_mat_prima_importada  = $idimpi";
 	  $resultupdate=mysql_query($sqlupdate);   
	  $sqlelim="delete from solicitud_mp_detalle where id_mp = $idimpi";
 	  $resultelim=mysql_query($sqlelim);
	 }//if($largo == 9){
	
   }
}


}//if($eliminar)

/*if($modificar){
	
  $dat3=split(" ",$fechaentreg);
  $dat1=split("-",$dat3[0]);
  $fechaentreg2="$dat1[2]-$dat1[1]-$dat1[0]";
  if($unidadessolicitadasactual){
	$unidadessolicitadas=$unidadessolicitadasactual;  
  }
	
$sqlfc="UPDATE solicitud_mp set fechaentreg = '$fechaentreg2' where id_solicitud_mp  = $id_solicitud_mp";
$resultfc=mysql_query($sqlfc); 
//echo "$sqlfc";
}*/


$sql="SELECT smp.id_solicitud_mp AS id_solicitud_mp,smp.fechasmp AS fechasmp, smp.fechaentreg AS fechaentreg, smp.fecharechazomp AS fecharechazomp, smp.fecharecep AS fecharecep, smp.fechainformar AS fechainformar ,smp.unidadessolicitadas AS unidadessolicitadas, smp.id_procedencia AS id_procedencia, org.origen AS origen, org.id_origen AS id_origen, p.producto AS producto, p.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, u.username AS username, smp.id_ldp AS id_ldp, smp.observacionessolic  AS observacionessolic  FROM solicitud_mp AS smp, origenes AS org, producto AS p, calibre AS c, usuarios AS u WHERE smp.id_solicitud_mp = smp.id_solicitud_mp AND smp.id_origen = org.id_origen AND smp.id_calibre = c.id_calibre AND smp.id_usuario = u.id_usuario AND smp.id_producto = p.id_producto AND smp.id_solicitud_mp =$id_solicitud_mp ";
$result=mysql_query($sql);
//echo "sql $sql<br>";
?>
<style type="text/css">
<!--
.cajas {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>

<? if($tip == 2){?><h1>SOLICITUD DE PRODUCCION PENDIENTES</h1><? }?>
<? if($tip == 3){?><h1>SOLICITUD DE PRODUCCION RECHAZADAS</h1><? }?>
<? if($tip == 4){?><h1>SOLICITUD DE PRODUCCION ACEPTADAS</h1><? }?>
<table width="100%" border="0">
 <tr>
   <td height="8" colspan="9">&nbsp;</td>
  </tr>
 <tr>
    <td width="28" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="8" bgcolor="#CCCCCC">&nbsp;<strong>
     <?
   if($id_ldp == 1){
   echo "ENTUBADO";
   }
    if($id_ldp == 2){
   echo "CALIBRADO";
   }
   ?>
     </strong>
   </td>
  </tr>
  <tr>
    <td width="28" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="100" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;</strong><strong>PRODUCTO</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="70" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="120" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO SOLICITUD</strong></td>
    <td width="120" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/PLAZO DE ENTREGA</strong></td>
    <td width="120" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;<? if($tip != 3){?>F/RECEPCION SOLICITUD<? }else{ ?>F/RECHAZADO<? }?></strong><br /></td>
    <td width="60" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ENCARGADO</strong><strong>&nbsp;</strong><strong>&nbsp;</strong></td>
  </tr>
     <?
	$i=$op;
    $color = "#000000";$i = 0;
    if ($row=mysql_fetch_array($result))
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
	$fecharecep =format_fecha_sin_hora($row[fecharecep]);   
	$fecharechazomp=format_fecha_sin_hora($row[fecharechazomp]);   
	$fechainformar=format_fecha_sin_hora($row[fechainformar]);   
	$totaluni+=$unidadessolicitadas;
  ?>
  <tr>
    <td height="8" nowrap="nowrap" bgcolor="<? echo $color?>"><center>&nbsp;<? echo $id_solicitud_mp?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
    <? //if(!$infomenu){?>
  <!--  <input name="unidadessolicitadas" type="text" value="<? //echo $unidadessolicitadas?>" size="10" maxlength="10" />-->
    <? //}else{?>
    <? echo $unidadessolicitadas?>
    <? //} ?>
    </td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechasmp?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
    <? //if(!$infomenu){?>
   <!-- <input name="fechaentreg" type="text" id="fechaentreg"  value="<?echo $fechaentreg?>" size="10" maxlength="10" /><a href="javascript:show_Calendario('form1.fechaentreg');"> Ver</a>-->
    <? //}else{ ?>
    <? echo $fechaentreg ?>
    <? //}?>
    </td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? if($tip != 3){?><? echo $fecharecep?><? }else{ ?><? echo $fecharechazomp?><? }?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $username?></td>
    <? 
	}
	?>
    <?
$sqln="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, p.id_producto AS id_producto, p.producto AS producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.id_origen AS id_origen, org.origen AS origen, mpn.contenido AS contenido, mpn.comprobante_num AS comprobante_num ,mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, em.estado_material, smpd.id_estdis AS id_estdis FROM solicitud_mp_detalle AS smpd, mat_prima_nacional AS mpn, producto AS p, calibre AS c, origenes AS org, estado_material AS em WHERE smpd.id_mp = mpn.id_mat_prima_nacional and mpn.id_producto = p.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = em.id_estado_material and smpd.id_ldp = $id_ldp and smpd.id_solicitud_mp =$id_solicitud_mp order by mpn.id_mat_prima_nacional desc";
$resultn=mysql_query($sqln);
$cuantosn=mysql_num_rows($resultn);
	
$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.etiquetados_folios_id AS etiquetados_folios_id, p.id_producto AS id_producto, p.producto AS producto, c.calibre AS calibre, org.id_origen AS id_origen, org.origen AS origen, mpi.contenido AS contenido, mpi.comprobante_num AS comprobante_num,mpi.bidon_num AS bidon_num, mpi.fecha_ingreso AS fecha_ingreso, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, em.estado_material,smpd.id_estdis AS id_estdis FROM solicitud_mp_detalle AS smpd, mat_prima_importada AS mpi, producto AS p, calibre AS c, origenes AS org, estado_material AS em WHERE smpd.id_mp = mpi.id_mat_prima_importada and mpi.id_producto = p.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = em.id_estado_material and smpd.id_ldp = $id_ldp and smpd.id_solicitud_mp =$id_solicitud_mp order by mpi.id_mat_prima_importada desc";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);
$cuantostotales= $cuantosn  + $cuantosi;
	?>
  </tr>
  <tr>
    <td height="9" nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td colspan="2" nowrap="nowrap">&nbsp;</td>
    <td align="right" nowrap="nowrap">
      <? if($tip == 4){?>
      <input type="submit" name="modificar" id="modificar" value="Modificar" />
      <? } ?>
    </td>
  </tr>
  <tr>
    <td height="9" nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td colspan="2" nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
  </tr>
    <tr>
      <td colspan="9"><table width="100%" border="0" align="center">
      <tr>
    <td width="21" height="19" bgcolor="#FF9933"><center></center></td>
    <td colspan="9" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
    <td colspan="4" align="center" bgcolor="#CCCCCC">
     <? if($tip == 3 or $tip == 4){ ?>
     <? if($id_procedencia == "N"){?>
    <a href="javascript:Abrir_ventana_nueva('codphp/asignar_mp.php?id_procedencia=<? echo "N";?>&id_producto=<? echo $id_producto?>&id_calibre=<? echo $id_calibre?>&id_origen=<? echo $id_origen?>&unidadessolicitadas=<? echo $unidadessolicitadas?>&id_solicitud_mp=<? echo $id_solicitud_mp?>&id_ldp=<? echo $id_ldp?>&infomenu=<? echo $infomenu?>&tip=<? echo $tip?>')"><strong>Asignar MPF</strong></a>
     <? } ?>
    / <? if($id_procedencia == "I"){?>
    <a href="javascript:Abrir_ventana_nueva('codphp/asignar_mp.php?id_procedencia=<? echo "I";?>&id_producto=<? echo $id_producto?>&id_calibre=<? echo $id_calibre?>&id_origen=<? echo $id_origen?>&unidadessolicitadas=<? echo $unidadessolicitadas?>&id_solicitud_mp=<? echo $id_solicitud_mp?>&id_ldp=<? echo $id_ldp?>&infomenu=<? echo $infomenu?>&tip=<? echo $tip?>')"><strong>Asignar MPS</strong></a>
    <? }?>
    <? } ?>
    </td>
    </tr>
  <tr>
    <td width="21" height="8" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="35" height="8" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="60" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="70" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&ordm; GUIA</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="40" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    <td width="19" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <? if($tip == 3 or $tip == 4){?>
    <td width="30" align="center" nowrap="nowrap" bgcolor="#FF9933">
    <input name="eliminar" type="submit" id="eliminar" value="X" />
    </td>
    <? } ?>
    <? if($tip == 2){?>
    <td width="40" align="center" nowrap="nowrap" bgcolor="#FF9933">
    <strong>&nbsp;DISPONIBLE</strong>
    </td>
    <? } ?>
    </tr>
    <?
	if($cuantosn){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($rown=mysql_fetch_array($resultn))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_nacional=$rown[id_mat_prima_nacional];
	$id_mat_prima_nacionall=$rown[id_mat_prima_nacional];
	$comprobante_num=$rown[comprobante_num];
	$id_producto=$rown[id_producto];
	$id_calibre=$rown[id_calibre];
	$id_origen=$rown[id_origen];
	$id_estdis=$rown[id_estdis];
	$fecha_faena =format_fecha_sin_hora($rown[fecha_faena]);   
	$fecha_termino=format_fecha_sin_hora($rown[fecha_termino]);
	$fecha_ingreso=format_fecha_sin_hora($rown[fecha_ingreso]);   
	$contenidoi=$rown[contenido];
	$cuentabidonesi=$rown[cuentabidones];
	$contenidototali+=$contenidoi;
  ?>
  
     <tr>
       <td height="8" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center>&nbsp;<? echo $i?></center></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<a href="?modulo=fmpfresca.php&amp;id_mat_prima_nacional=<? echo $id_mat_prima_nacional?>&amp;id_origen=<? echo $id_origen?>&amp;id_producto=<? echo $id_producto?>&amp;fresca=<? echo "N";?>">F<? echo $id_mat_prima_nacional?>
       </a></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $rown[producto]?></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$rown[calibre]";}?></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $rown[origen]?></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center>
         <? echo $rown[contenido]?>
       </center></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center><? echo $rown[comprobante_num]?></center></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center>
         &nbsp;<? echo $fecha_ingreso?></center></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_faena ?></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_termino?></td>
       <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $rown[estado_material]?></td>
       <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><? echo $rown[bidon_num]?></td>
         <? if($tip == 3 or $tip == 4){?>
       <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><input type="checkbox" name="id_mpi-<? echo $id_mat_prima_nacional?>" id="id_mpi" value="<? echo $id_mat_prima_nacionall?>" /><input type="hidden" name="id_mpielim-<? echo $id_mat_prima_nacional?>" id="id_mpielim" value="<? echo $id_mat_prima_nacional?>" /></td>
       <? } ?>
        <? if($tip == 2){?>
       <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">
	   <? 
	   
	   
	   $estdis= crea_disponibilidad($link,$id_estdis,$id_mat_prima_nacional);
	   echo $estdis;
	   
	    //echo "id_estdis $id_estdis";
	  ?>
       </td>
       <? } ?>
     </tr>
      <? 
	  $cuantofoliosna=$cuantofoliosna + $id_estdis;
	  }
	}
	?>
      <?
	if($cuantosi){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($rowi=mysql_fetch_array($resulti))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$id_mat_prima_importadaa=$rowi[id_mat_prima_importada];
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$comprobante_num=$rowi[comprobante_num];
	$id_producto=$rowi[id_producto];
	$id_calibre=$rowi[id_calibre];
	$id_origen=$rowi[id_origen];
	$id_estdis=$rowi[id_estdis];
	$fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   
	$contenidoi=$rowi[contenido];
	$cuentabidonesi=$rowi[cuentabidones];
	$contenidototali+=$contenidoi;
    ?>
     <tr>
    <td height="8" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center>&nbsp;<? echo $i?></center></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>">S<? 

	if($etiquetados_folios_id)
	 {
	  echo "$etiquetados_folios_id";
	 }else{
		
		if($largo == 9){
	 	$id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 	}
	 	echo $id_mat_prima_importada;
	 }//if($etiquetados_folios_id)?></a></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $rowi[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$rown[calibre]";}?></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $rowi[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center>
      <? echo $rowi[contenido]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center><? echo $rowi[comprobante_num]?></center></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center>
      &nbsp;<? echo $fecha_ingreso?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_vencimiento?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $rowi[estado_material]?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><? echo $rowi[bidon_num]?></td>
     <? if($tip == 3 or $tip == 4){?>
    <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><input type="checkbox" name="id_mpi-<? echo $id_mat_prima_importadaa?>" id="id_mpi" value="<? echo $id_mat_prima_importadaa?>" /><input type="hidden" name="id_mpielim-<? echo $id_mat_prima_importadaa?>" id="id_mpielim" value="<? echo $id_mat_prima_importadaa?>" /></td>
    <? } ?>
     <? if($tip == 2){?>
    <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">
    <? 
      $estdis= crea_disponibilidad($link,$id_estdis,$id_mat_prima_importadaa);
	  echo $estdis;
	  $cuantofoliossi=$cuantofoliossi + $id_estdis;
	?>
    
    </td>
    <? } ?>
    
     </tr>
   <? 
     } 
     }
	 
	?>
    <? 
	
	 $totalreal=$cuantofoliossi + $cuantofoliosna;
		$totalhay=$cuantosi +$cuantosn;
		//echo "totalreal $totalreal / totalhay $totalhay<br>";
	?>
  <tr>
    <td height="8" colspan="5" align="right" nowrap="nowrap">TOTAL</td>
    <td align="center" nowrap="nowrap" bgcolor="#999999">&nbsp;<strong><? echo $fstotal=$contenidototal+$contenidototali;?></strong></td>
    <td align="center" nowrap="nowrap">&nbsp;</td>
    <td colspan="7" align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="9" align="right">
	  <? if(!$infomenu){
    		if($tip == 2){ ?>
        Indicar la disponibilidad de folios solicitados (SI/NO)
        <input type="submit" name="actualiza_disponibilidad" id="actualiza_disponibilidad" value="Actualizar disponibilidad" />
        <br />
        <? if($totalreal == $totalhay){	
		
		?>
        <br />
<?  if($fechainformar != '00-00-0000'){?>        
	Solicitud informada a producción con fecha <? echo $fechainformar?>
<? }else{?>
Informar a Producción que se encuentra lista la solicitud y se procedera a su entrega
<input type="checkbox" value="acepto" onclick="document.form1.enviar_spmp.disabled=!document.form1.enviar_spmp.disabled" />
<input type="submit" name="enviar_spmp" id="enviar_spmp" value="Informar" disabled />
<? }?>


<?	
		}
		
		
		?>
        <br><br>
       <? if($totalreal == $totalhay){?>
        <? if($fechainformar != '00-00-0000'){?>
        Debe proceder con la recepcion de la solicitud, si esta deacuerdo.
        <input type="checkbox" value="acepto" onclick="document.form1.fecharecep.disabled=!document.form1.fecharecep.disabled" />
<input type="submit" name="fecharecep" id="fecharecep" value="Recepcionar" disabled />
        <? }?>
        <? }?>
        <? if($totalreal != $totalhay){	?>
        Rechazar solicitud de Producci&oacute;n
        <input type="checkbox" value="rechazarmp" onclick="document.form1.rechazarmp.disabled=!document.form1.rechazarmp.disabled" />
<input type="submit" name="rechazarmp" id="rechazarmp" value="Informar" disabled />
        <? }?>
        <?
		
		}
	  } //if(!$infomenu){
	  	  
		 		
if($tip == 3 and $infomenu){
			  
?>
<br /><br>

<?
//echo "$totalreal - $totalhay";
if($totalreal != $totalhay){ ?>
Reenviar solicitud a bodega
<input type="checkbox" value="esabodega" onclick="document.form1.esabodega.disabled=!document.form1.esabodega.disabled" />
<input type="submit" name="esabodega" id="esabodega" value="Enviar"  disabled />
<? } ?>
<? //}else{?>
<!--Re-enviar a Solicitudes Aceptadas
<input type="checkbox" value="acepto" onclick="document.form1.reenviar_solicitud.disabled=!document.form1.reenviar_solicitud.disabled" />
<input type="submit" name="reenviar_solicitud" id="reenviar_solicitud" value="Enviar" disabled />-->
<? //}?>
<? } ?></td>
    </tr>
    <tr>
      <td colspan="9" align="right">&nbsp;
      <? //if($infomenu and $tip == 4){?> <!--Rechazar solicitud por correcci&oacute;n de folios
      <input type="submit" name="rechazarmp" id="rechazarmp" value="Enviar" onClick='return Confirmar(this.form1)' />--> <? //} ?><br><br>
      <?
	   //if($tip == 4 and $infomenu){?>
       <!--Debe asignar fecha para poder ingresar la solicitud a producci&oacute;n
       <input name="fecha_asig_producc" type="text" id="fecha_asig_producc"  value="<?echo $fecha_asig_producc?>" size="10" maxlength="10" />
       <a href="javascript:show_Calendario('form1.fecha_asig_producc');"> Fecha</a>&nbsp;&nbsp;
       <input type="submit" name="asignarproduccion" id="asignarproduccion" value="Enviar" />-->
	   <? //} ?>
      <!--  <input type="submit" name="recepcion" id="asignar" value="Recepcionar MP" />-->
      <?
/*      if($cuentasino == $cuantosn){
		echo "100%";  
	  }
	  if($cuentasino < $cuantosn){
		echo "Incompleta";  
	  }
	  
	  */
	  
	  ?>
      
      </td>
  </tr>
    <? if(!$tip == 4){?>
    <tr>
      <td colspan="9">Nota: Para completar la solicitud debe indicar la disponibilidad de la materia prima</td>
  </tr>
  <? } ?>
    <tr>
      <td colspan="9"><HR>
      
      <? if(!$observacionessolic){?><a href="#" onclick="cambiar('error'); return false;">INGRESAR OBSERVACIONES</a><? }else{?>OBSERVACIONES<? } ?></td>
  </tr>
    <tr>
      <td colspan="9"><? if(!$observacionessolic){?><div id="error" style="display: none;"><? }?><center><textarea name="observacionessolic" id="observacionessolic" cols="80" rows="5"><? echo $observacionessolic?></textarea></center>&nbsp;&nbsp;&nbsp;<center><? if(!$observacionessolic){?><input type="submit" name="guardarcomentarios" id="guardarcomentarios" value="Guardar Observaciones" /><? }else{?><input type="submit" name="guardarcomentarios" id="guardarcomentarios" value="Modificar Observaciones" /><? }?></center><? if(!$observacionessolic){?></div><? }?><HR></td>
    </tr>
</table>

<?
/*
$totalreal=$cuantofoliossi + $cuantofoliosna;
$totalhay=$cuantosi +$cuantosn;
echo "totalreal $totalreal / totalhay $totalhay<br>";

if($actualizar){

 if(($totalreal == $totalhay)){
	 
	 
	$fecharecep=date("Y-m-d"); 
    $sqlupdate="UPDATE solicitud_mp  set fecharecep = '$fecharecep', fecharechazomp = '0000-00-00'  where id_solicitud_mp=$id_solicitud_mp and id_ldp=$id_ldp";
   $resultupdate=mysql_query($sqlupdate); 
    
	
	  $sqlimpbuscam="SELECT * FROM mat_prima_nacional WHERE id_solicitud_mp = $id_solicitud_mp";
	  $resultnm=mysql_query($sqlimpbuscam);
	  $cuantosn=mysql_num_rows($resultnm);
	  if($cuantosn){
	  while ($rowb=mysql_fetch_array($resultnm)) { 
      $id_mat_prima_nacionalb=$rowb[id_mat_prima_nacional];
	   $sqlupdatemb="UPDATE mat_prima_nacional  set id_estado_material = 2, id_ldp = $id_ldp  where id_solicitud_mp=$id_solicitud_mp and id_mat_prima_nacional=$id_mat_prima_nacionalb";
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
	   $sqlupdatemb="UPDATE mat_prima_importada set id_estado_material = 2, id_ldp = $id_ldp  where id_solicitud_mp=$id_solicitud_mp and id_mat_prima_importada=$id_mat_prima_importadabi";
   $resultupdatemb=mysql_query($sqlupdatemb);
   //echo "sqlupdatemb $sqlupdatemb";
	  }
	  }//if($cuantosi){
		  
		    
     echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=recepcionmp.php&id_ldp=$id_ldp\">";
 exit;
	  }
 }*/
?>