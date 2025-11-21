<?
if($actualizar_planilla){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'e1')
	{
    $id=$dat[1];
   	//$id_origen=$_POST["id_origen-$id"]; if(!$id_origen){ $id_origen=0; }
	$id_origen=$_POST["ido-$id"];
	
	$id_operarios=$_POST["id_operarios-$id"]; if(!$id_operarios){ $id_operarios=0; }
	$e1=$_POST["e1-$id"]; if(!$e1){ $e1=0; }
	$d1=$_POST["d1-$id"]; if(!$d1){ $d1=0; }
	$unidad_tripas=$_POST["unidad_tripas-$id"]; if(!$unidad_tripas){ $unidad_tripas=0; }
	$procorto=$_POST["procorto-$id"]; if(!$procorto){ $procorto=0; }
	$prorojo=$_POST["prorojo-$id"]; if(!$prorojo){ $prorojo=0; }
	$prorojomts=$_POST["prorojomts-$id"]; if(!$prorojomts){ $prorojomts=0.0; }
	$proazul=$_POST["proazul-$id"]; if(!$proazul){ $proazul=0; }
	$proazulmts=$_POST["proazulmts-$id"]; if(!$proazulmts){ $proazulmts=0.0; }
	$proverde=$_POST["proverde-$id"]; if(!$proverde){ $proverde=0; }
	$proverdemts=$_POST["proverdemts-$id"]; if(!$proverdemts){ $proverdemts=0.0; }
	$prowaste=$_POST["prowaste-$id"]; if(!$prowaste){ $prowaste=0; }
	$total_tubing=$_POST["total_tubing-$id"]; if(!$total_tubing){ $total_tubing=0.0; }
	$total_metros=$_POST["total_metros-$id"]; if(!$total_metros){ $total_metros=0; }
	$rendimiento_pro=$_POST["rendimiento_pro-$id"]; if(!$rendimiento_pro){ $rendimiento_pro=.00; }

	$unidad_tripas=$e1-$d1;
	$total_tripas=$unidad_tripas * 20;
	$totalprocorto=$procorto * 5;
	$total_plastico = $prorojo + $proazul + $proverde + $totalprocorto;
	$total_metros=($prorojo * $prorojomts) + ($proazul * $proazulmts) + ($proverde * $proverdemts);
	$total_tubing=$total_metros / 90 ;
	
	
/*	if(!$total_tripas)
	{
	$total_tripas = 1;
	$rendimiento_pro = $total_metros / $total_tripas;
	}else{
	$rendimiento_pro = $total_metros / $total_tripas;	
	}*/
	if($total_tripas)
	{
	$rendimiento_pro = $total_metros / $total_tripas;	
	}
	
	
    $sql="UPDATE planilla_produccion  SET id_origen = '$id_origen',e1='$e1',d1='$d1',total_plastico='$total_plastico',total_tripas='$total_tripas',unidad_tripas='$unidad_tripas',procorto='$procorto',totalprocorto='$totalprocorto',prorojo='$prorojo',prorojomts='$prorojomts',proazul='$proazul',proazulmts='$proazulmts',proverde='$proverde',proverdemts='$proverdemts',prowaste='$prowaste',total_tubing='$total_tubing', total_metros='$total_metros', rendimiento_pro='$rendimiento_pro' where id_pp =$id";
	$retsul=mysql_query($sql);
	//echo "$sqlac<br>";
}//if ($dat[0] == 'e1')
}//foreach ($_POST as $key => $value)
}//if($actualizar_planilla){
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
   
   
 	$sqlimpbuscam="SELECT * FROM mat_prima_nacional WHERE id_solicitud_mp = $id_solicitud_mp";
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
	 $sqlelim="delete from planilla_produccion where id_pp = $id_pp";
 	 $resultelim=mysql_query($sqlelim);
	 //echo "sqlelim $sqlelim<br>";
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
	  $sqlupdate="UPDATE mat_prima_nacional  set fecha_asig_producc = '0000-00-00', fecha_salida = '0000-00-00', id_estado_material = 1 where id_mat_prima_nacional  = $idimpn";
 	  $resultupdate=mysql_query($sqlupdate);   
	  //echo "sqlupdate $sqlupdate<br>";
	  $sqlelim="delete from planilla_registro_fecha_asig_produccion  where  id_folio_mpn_mpi = $idimpn ";
 	  $resultelim=mysql_query($sqlelim);
	 // echo "SQL $sqlelim<br>";
	 }// if($largo == 8){
	 if($largo == 9){
	  $sqlimpbuscai="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mpilistard";
	  $resulti=mysql_query($sqlimpbuscai);
	  if ($rowimpi=mysql_fetch_array($resulti)) { 
   	  $idimpi=$rowimpi[id_mat_prima_importada];
	  }
	  $sqlupdate="UPDATE mat_prima_importada set  fecha_asig_producc = '0000-00-00', fecha_salida = '0000-00-00', id_estado_material = 1 where id_mat_prima_importada  = $idimpi";
 	  $resultupdate=mysql_query($sqlupdate);   
  $sqlelimi="delete from planilla_registro_fecha_asig_produccion  where id_folio_mpn_mpi = $idimpi";
 	  $resultelimii=mysql_query($sqlelimi);
	 // echo "SQL $sqlelimi<br>";
	 }//if($largo == 9){
	
   }
}

  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pproducc.php&id_ldp=$id_ldp&infomenu=1&tip=$tip\">";
 exit;

}//if($eliminar)

if($modificar){
	
  $dat3=split(" ",$fecha_asig_producc);
  $dat1=split("-",$dat3[0]);
  $fecha_asig_producc="$dat1[2]-$dat1[1]-$dat1[0]";
	
$sqlfc="UPDATE solicitud_mp set fecha_asig_producc = '$fecha_asig_producc' where id_solicitud_mp  = $id_solicitud_mp";
$resultfc=mysql_query($sqlfc);

}

if($cierre_produccion){
$fecha_cierre_producc=date("Y-m-d"); 
$sqlfecha_cierre_producc="UPDATE planilla_registro_fecha_asig_produccion set fecha_cierre_producc = '$fecha_cierre_producc' where fecha_asig_producc  = '$fecha_asig_producc'";
$resultfecha_cierre_producc=mysql_query($sqlfecha_cierre_producc);
//echo "sqlfecha_cierre_producc $sqlfecha_cierre_producc<br>";

$sqlfecha_cierre_producc2="UPDATE planilla_produccion set fecha_cierre_producc = '$fecha_cierre_producc' where fecha_asig_producc  = '$fecha_asig_producc'";
$resultfecha_cierre_producc2=mysql_query($sqlfecha_cierre_producc2);
//echo "sqlfecha_cierre_producc2 $sqlfecha_cierre_producc2<br>";
}
if($abrir_produccion){
$fecha_cierre_producc='0000-00-00'; 
$sqlfecha_cierre_producc="UPDATE planilla_registro_fecha_asig_produccion set fecha_cierre_producc = '$fecha_cierre_producc' where fecha_asig_producc  = '$fecha_asig_producc'";
$resultfecha_cierre_producc=mysql_query($sqlfecha_cierre_producc);
//echo "sqlfecha_cierre_producc $sqlfecha_cierre_producc<br>";

$sqlfecha_cierre_producc2="UPDATE planilla_produccion set fecha_cierre_producc = '$fecha_cierre_producc' where fecha_asig_producc  = '$fecha_asig_producc'";
$resultfecha_cierre_producc2=mysql_query($sqlfecha_cierre_producc2);
//echo "sqlfecha_cierre_producc2 $sqlfecha_cierre_producc2<br>";
}


$sqln="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, mpn.contenido AS contenido, mpn.comprobante_num  AS comprobante_num, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, pro.producto AS producto, c.calibre AS calibre, org. origen AS origen, est.estado_material AS estado_material ,smpd.id_solicitud_mp AS id_solicitud_mp FROM mat_prima_nacional AS mpn, solicitud_mp_detalle AS smpd, producto AS pro, calibre AS c, origenes AS org, estado_material AS est WHERE mpn.id_mat_prima_nacional = smpd.id_mp AND mpn.id_producto = pro.id_producto and mpn.id_calibre= c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material  and mpn.fecha_asig_producc='$fecha_asig_producc' and mpn.id_ldp = $id_ldp";
$resultn=mysql_query($sqln);
$cuantosn=mysql_num_rows($resultn);

$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.contenido AS contenido, mpi.comprobante_num  AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_ingreso AS fecha_ingreso, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_termino AS fecha_termino,mpi.fecha_vencimiento AS fecha_vencimiento, pro.producto AS producto, c.calibre AS calibre, org. origen AS origen, est.estado_material AS estado_material ,smpd.id_solicitud_mp AS id_solicitud_mp, mpi.etiquetados_folios_id AS etiquetados_folios_id FROM mat_prima_importada AS mpi, solicitud_mp_detalle AS smpd, producto AS pro, calibre AS c, origenes AS org, estado_material AS est WHERE mpi.id_mat_prima_importada = smpd.id_mp AND mpi.id_producto = pro.id_producto and mpi.id_calibre= c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material  and mpi.fecha_asig_producc='$fecha_asig_producc' and mpi.id_ldp = $id_ldp";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);

$cuantostotales =$cuantosn + $cuantosi


?>

<h1>DETALLE LINEA DE PRODUCCION <? echo $fecha_asig_producc?></h1>
<table width="100%" border="0">
<tr>
  <td><table width="100%" border="0" align="center">
    <tr>
      <td nowrap="nowrap" bgcolor="<? echo $color?>"><table width="100%" border="0">
        <tr>
          <td><table width="1010" border="0" align="center">
            <tr>
              <td width="25" height="19" bgcolor="#FF9933"><center>
              </center></td>
              <td colspan="7" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
              <td colspan="4" bgcolor="#FF9900"><center>
                <? //if($id_procedencia == "N"){?>
                
                <? if($fecha_cierre_producc == '0000-00-00'){?>
                <a href="javascript:Abrir_ventana_nueva('codphp/asignar_mp_stockpr.php?id_procedencia=<? echo "N";?>&amp;id_producto=<? echo $id_producto?>&amp;id_calibre=<? echo $id_calibre?>&amp;id_origen=<? echo $id_origen?>&amp;unidadessolicitadas=<? echo $unidadessolicitadas?>&amp;id_solicitud_mp=<? echo $id_solicitud_mp?>&amp;id_ldp=<? echo $id_ldp?>&amp;tip=<? echo $tip?>&amp;fecha_asig_producc=<? echo $fecha_asig_producc?>')"><strong>Asignar MP a planilla de Producci&oacute;n </strong></a><? }else{?><strong>Asignar MP a planilla de Producci&oacute;n </strong><? } ?>
                <? //} ?>
              </center></td>
            </tr>
            <tr>
              <td width="25" height="8" nowrap="nowrap" bgcolor="#FF9933"><center>
                <strong>&nbsp;N&ordm;</strong>
              </center></td>
              <td width="53" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
              <td width="150" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
              <td width="60" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
              <td width="100" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
              <td width="60" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
              <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
              <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
              <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
              <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
              <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
              <? if($fecha_cierre_producc == '0000-00-00'){?><td width="20" align="center" nowrap="nowrap" bgcolor="#FF9933"> <input name="eliminar" type="submit" id="eliminar" value="X" /></td><? }?>
            </tr>
            <?
	if($cuantosn){
		
    $i=1;
    $color = "#000000";
    while ($rown=mysql_fetch_array($resultn))
    {
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_mat_prima_nacional=$rown[id_mat_prima_nacional];
	$id_producto=$rown[id_producto];
	$id_calibre=$rown[id_calibre];
	$id_origen=$rown[id_origen];
	$id_solicitud_mp=$rown[id_solicitud_mp];
	$comprobante_num=$rown[comprobante_num];
	$bidon_num=$rown[bidon_num];
	$fecha_faena =format_fecha_sin_hora($rown[fecha_faena]);   
	$fecha_termino=format_fecha_sin_hora($rown[fecha_termino]);
	$fecha_ingreso=format_fecha_sin_hora($rown[fecha_ingreso]);   
	$contenidoi=$rown[contenido];
	$cuentabidonesi=$rown[cuentabidones];
	$contenidototali+=$contenidoi;
  ?>
            <tr>
              <td height="8" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
              <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpfresca.php&amp;id_mat_prima_nacional=<? echo $id_mat_prima_nacional?>&amp;id_origen=<? echo $id_origen?>&amp;id_producto=<? echo $id_producto?>&amp;fresca=<? echo "N";?>" title="<? echo "Nº Solicitud $id_solicitud_mp";?>">F<? echo $id_mat_prima_nacional?></a></td>
              <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rown[producto]?></td>
              <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;
                <? if(!$id_calibre){ echo "Original"; }else{echo "$rown[calibre]";}?></td>
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
              <? if($fecha_cierre_producc == '0000-00-00'){?><td align="center" nowrap="nowrap" bgcolor="<? echo $color?>"><input type="checkbox" name="id_mpi-<? echo $id_mat_prima_nacional?>" id="id_mpi" value="<? echo $id_mat_prima_nacional?>" /></td><? }?>
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
	$id_solicitud_mp=$rowi[id_solicitud_mp];
	$fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   
	$contenidoi=$rowi[contenido];
	$cuentabidonesi=$rowi[cuentabidones];
	$contenidototali+=$contenidoi;
  ?>
            <tr>
              <td height="8" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
              <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&amp;id_origen=<? echo $id_origen?>&amp;id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>" title="<? echo "Nº Solicitud $id_solicitud_mp";?>">S<? 

	if($etiquetados_folios_id)
	 {
	  echo "$etiquetados_folios_id";
	 }else{
		
		if($largo == 9){
	 	$id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 	}
	 	echo $id_mat_prima_importada;
	 }//if($etiquetados_folios_id)?>
              </a></td>
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
              <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $rowi[estado_material]?></td>
              <? if($fecha_cierre_producc == '0000-00-00'){?><td align="center" nowrap="nowrap" bgcolor="<? echo $color?>"><input type="checkbox" name="id_mpi-<? echo $id_mat_prima_importadaa?>" id="id_mpi" value="<? echo $id_mat_prima_importadaa?>" /></td><? }?>
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
          <td><hr />
            <a href="#" onclick="cambiar('error'); return false;">INGRESAR OBSERVACIONES</a></td>
        </tr>
        <tr>
          <td><div id="error" style="display: none;">
            <center>
              <textarea name="observacionessolic" id="observacionessolic" cols="80" rows="5"><? echo $observacionessolic?></textarea>
            </center>
            &nbsp;&nbsp;&nbsp;
            <center>
              <input type="submit" name="guardarcomentarios" id="guardarcomentarios" value="Guardar Observaciones" />
            </center>
          </div></td>
        </tr>
        <tr>
          <td><hr /></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>
            <table width="1010" border="0" align="center">
              <tr>
                <td width="746">&nbsp;</td>
                <td width="254" bgcolor="#CCCC00"><center>
                  <strong><? if($fecha_cierre_producc == '0000-00-00'){?><a href="javascript:Abrir_ventana_nueva('codphp/asignar_operarios.php?id_ldp=<? echo $id_ldp?>&amp;tip=<? echo $tip?>&amp;fecha_asig_producc=<? echo $fecha_asig_producc?>')"><strong>Asignar Operario</strong></a><? }else{ ?>Asignar Operario<? } ?></strong>
                </center></td>
              </tr>
              <tr>
                <td colspan="2" nowrap="nowrap" bgcolor="#CCCC00">&nbsp;<strong>PLANILLA DE PRODUCCION <? echo $fecha_asig_producc?></strong></td>
              </tr>
              <tr>
                <td colspan="2"><?
        if($id_ldp){
$sqllinea="SELECT o.nombreop AS nombreop, o.apellido AS apellidoop, o.id_grupo AS id_grupo, o.iniciales AS iniciales, pp.id_pp  AS id_pp , pp.id_ldp AS id_ldp, pp.id_solicitud_mp AS id_solicitud_mp, pp.id_origen AS id_origen, pp.id_operarios AS id_operarios, pp.e1 AS e1, pp.d1 AS d1, pp.total_plastico AS total_plastico, pp.total_tripas AS total_tripas, pp.unidad_tripas AS unidad_tripas, pp.procorto AS procorto,pp.totalprocorto AS totalprocorto, pp.prorojo AS prorojo, pp.prorojomts AS prorojomts,pp.proazul AS proazul,pp.proazulmts AS proazulmts, pp.proverde AS proverde, pp.proverdemts AS proverdemts, pp.prowaste AS prowaste, pp.total_tubing AS total_tubing, pp.total_metros AS total_metros, pp.rendimiento_pro AS rendimiento_pro, pp.fecha_asig_producc AS fecha_asig_producc, pp.fecha_cierre_producc AS fecha_cierre_producc  FROM planilla_produccion  AS pp, lineas_de_procesos AS ldp, operarios AS o where pp.id_ldp = ldp.id_ldp and pp.id_operarios = o.id_operarios and pp.id_ldp = $id_ldp and pp.fecha_asig_producc = '$fecha_asig_producc' order by o.id_grupo asc";
$resultlinea=mysql_query($sqllinea);
$cuantoslinea=mysql_num_rows($resultlinea);
//echo $sqllinea;

}		?>
                  <table width="100%" border="0" cellpadding="1" cellspacing="1">
                    <? if($cuantoslinea){ ?>
                    <tr>
                      <td width="28" height="8" bgcolor="#CCCCCC">N&ordm;</td>
                      <td width="29" bgcolor="#CCCCCC"><center>G</center></td>
                      <td width="73" align="center" nowrap="nowrap" bgcolor="#CCCCCC"><strong>NOMBRE</strong></td>
                      <td width="81" align="center" nowrap="nowrap" bgcolor="#CCCCCC"><strong>INICIALES</strong></td>
                      <td width="64" align="center" nowrap="nowrap" bgcolor="#CCCCCC"><strong>ORIGEN</strong></td>
                      <td align="center" bgcolor="#CCCCCC"><strong><a href="#" title="Nudos Entregados">N/E</a></strong></td>
                      <td align="center" bgcolor="#CCCCCC"><strong><a href="#" title="Nudos Devueltos">N/D</a></strong></td>
                      <td align="center" bgcolor="#CCCCCC"><strong><a href="#" title="Total de Nudos">N/T</a></strong></td>
                      <td align="center" bgcolor="#CCCCCC"><strong><a href="#" title="Total Tripas">T/TRI</a></strong></td>
                      <td align="center" bgcolor="#CCCCCC"><strong>CORTO</strong></td>
                      <td align="center" bgcolor="#CCCCCC"><strong><a href="#" title="Total Corto">T/C</a></strong></td>
                      <td align="center" bgcolor="#FF3300"><strong>ROJO</strong></td>
                      <td align="center" bgcolor="#FF3300"><strong><a href="#" title="Promedio">X</a></strong></td>
                      <td align="center" bgcolor="#0099FF"><strong>AZUL</strong></td>
                      <td align="center" bgcolor="#0099FF"><a href="#" title="Promedio"><strong>X</strong></a></td>
                      <td width="55" align="center" bgcolor="#66CC00"><strong>VERDE</strong></td>
                      <td width="16" align="center" bgcolor="#66CC00"><strong><a href="#" title="Promedio">X</a></strong></td>
                      <td align="center" bgcolor="#CCCCCC"><strong>WASTE</strong></td>
                      <td align="center" bgcolor="#CCCCCC"><strong><a href="#" title="Total Plasticos">T/P</a></strong></td>
                      <td align="center" bgcolor="#CCCCCC"><strong>T/T</strong></td>
                      <td align="center" bgcolor="#CCCCCC"><strong>T/METROS</strong></td>
                      <td width="54" align="center" bgcolor="#CCCCCC"><strong>REND.
                        </strong>                        <center>
                        </center></td>
                      <? if($fecha_cierre_producc == '0000-00-00'){?><td width="29"><center><input name="eliminaroperarios" type="submit" id="eliminaroperarios" value="X" /></center></td><? }?>
                    </tr>
                    <?

    $ilinea=$oplinea;
	$i=0;
    $colorlinea = "#000000";$ilinea = 0;
    while ($rowlinea=mysql_fetch_array($resultlinea))
    {
	$ilinea++;
	$i++;
	$colorlinea = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$nombreop=$rowlinea[nombreop];
	$apellidoop=$rowlinea[apellidoop];
	$inicialesop=$rowlinea[iniciales];
	$id_grupo=$rowlinea[id_grupo];
	$id_pp=$rowlinea[id_pp];
	$id_ldp=$rowlinea[id_ldp];
	$id_solicitud_mp=$rowlinea[id_solicitud_mp];
	$id_origen=$rowlinea[id_origen];
	$id_operarios=$rowlinea[id_operarios];
	$e1=$rowlinea[e1];
	$d1=$rowlinea[d1];
	$unidad_tripas=$rowlinea[unidad_tripas];
	$total_plastico=$rowlinea[total_plastico];
	$total_tripas=$rowlinea[total_tripas];
	$procorto=$rowlinea[procorto];
	$totalprocorto=$rowlinea[totalprocorto];
	$prorojo=$rowlinea[prorojo];
	$prorojomts=$rowlinea[prorojomts];
	$proazul=$rowlinea[proazul];
	$proazulmts=$rowlinea[proazulmts];
	$proverde=$rowlinea[proverde];
	$proverdemts=$rowlinea[proverdemts];
	$prowaste=$rowlinea[prowaste];
	$total_tubing=$rowlinea[total_tubing];
	$total_metros=$rowlinea[total_metros];
	$rendimiento_pro=$rowlinea[rendimiento_pro];
	$fecha_cierre_producc=$rowlinea[fecha_cierre_producc];
	$nombreop = substr($rowlinea[nombreop],0,10); 
	$apellidoop = substr($rowlinea[apellidoop],0,10); 
	$fecha_cierre_producc = $rowlinea[fecha_cierre_producc];
	

  ?>
                    <tr>
                      <td height="8">&nbsp;<? echo $i?></td>
                      <td>
                      <center>
                      <?
                      $sqlg="select * from grupo where id_grupo = $id_grupo";
					  $resultg=mysql_query($sqlg,$link);
	
					  if ($rowg=mysql_fetch_array($resultg))
					  {
						  echo $grupo=$rowg[grupo];
					  }
					  ?>
                      </center></td>
                      <td width="73">&nbsp;<? echo $nombreop=strtoupper($nombreop); echo " "; echo $apellidoop=strtoupper($apellidoop);?></td>
                      <td width="81" nowrap="nowrap"><center>
                        <? echo $inicialesop?>
                      </center></td>
                      <td width="64" nowrap="nowrap">
                      <?
                       $origen= crea_origenes_planilla($link,$id_origen,$id_pp,$fecha_asig_producc);
		  			   echo $origen;
					  ?>
                      </td>
                      <td width="31" align="center"><input name="e1-<? echo $id_pp?>" type="text" class="tex2" id="e1" value="<?echo $e1?>" size="1" maxlength="2" onKeypress="solonum()"/></td>
                      <td width="32" align="center">&nbsp;
                        <input name="d1-<? echo $id_pp?>" type="text" class="tex2" id="d1" value="<?echo $d1?>" size="1" maxlength="2"  onkeypress="solonum()"/></td>
                      <td width="26" align="center"><center><? echo $unidad_tripas?></center></td>
                      <td width="37" align="center">&nbsp;<? echo $total_tripas?></td>
                      <td width="57" align="center"><input name="procorto-<? echo $id_pp?>" type="text" id="procorto" value="<?echo $procorto?>" size="1" maxlength="3" onkeypress="solonum()"/></td>
                      <td width="25" align="center"><center><? echo $totalprocorto?></center></td>
                      <td width="44" align="center" bgcolor="#FF3300"><input name="prorojo-<? echo $id_pp?>" type="text" id="prorojo" value="<?echo $prorojo?>" size="1" maxlength="3" onkeypress="solonum()"/></td>
                      <td width="13" align="center" bgcolor="#FF3300"><input name="prorojomts-<? echo $id_pp?>" type="text" id="prorojomts" value="<?echo $prorojomts?>" size="1" maxlength="4" /></td>
                      <td width="41" align="center" bgcolor="#0099FF"><input name="proazul-<? echo $id_pp?>" type="text" id="proazul" value="<?echo $proazul?>" size="1" maxlength="3" onkeypress="solonum()"/></td>
                      <td width="13" align="center" bgcolor="#0099FF"><input name="proazulmts-<? echo $id_pp?>" type="text" id="proazulmts" value="<?echo $proazulmts?>" size="1" maxlength="4" /></td>
                      <td width="55" align="center" bgcolor="#66CC00"><input name="proverde-<? echo $id_pp?>" type="text" id="proverde" value="<?echo $proverde?>" size="1" maxlength="3" onkeypress="solonum()"/></td>
                      <td width="16" align="center" bgcolor="#66CC00"><input name="proverdemts-<? echo $id_pp?>" type="text" id="proverdemts" value="<?echo $proverdemts?>" size="1" maxlength="4" /></td>
                      <td width="55" align="center"><input name="prowaste-<? echo $id_pp?>" type="text" id="prowaste" value="<?echo $prowaste?>" size="1" maxlength="3" onkeypress="solonum()"/></td>
                      <td width="23" align="center"><center>
                        <? echo $total_plastico?>
                      </center></td>
                      <td width="24" align="center"><? echo $total_tubing?></td>
                      <td width="83" align="center"><center><? echo $total_metros ?></center></td>
                      <td align="center"><center><? echo $rendimiento_pro ?></center></td>
                      <? if($fecha_cierre_producc == '0000-00-00'){?><td width="29"><center><input type="checkbox" name="id_pp-<? echo $id_pp?>" id="id_pp" value="<? echo $id_pp?>" /></center></td><? }?>
                    </tr>
                    <?	
					$sume1=$sume1 + $e1;
					$sumd1=$sumd1 + $d1;
					$sumunidad_tripas = $sumunidad_tripas + $unidad_tripas;
					$sumtotal_tripas = $sumtotal_tripas + $total_tripas;
					$sumprocorto= $sumprocorto + $procorto;
					$sumprorojo= $sumprorojo + $prorojo;
					$sumproazul = $sumproazul + $proazul;
					$sumproverde = $sumproverde + $proverde;
					$sumplatitcos = $sumplatitcos + $total_plastico;
					$sumtotal_tubing = $sumtotal_tubing + $total_tubing;
					$sumtotal_metros = $sumtotal_metros + $total_metros;
					$sumrendimiento_pro = $sumrendimiento_pro + $rendimiento_pro;
					$sumprowaste = $sumprowaste + $prowaste;
					}
					
					?>
                    <tr>
                      <td colspan="5" align="right" bgcolor="#CCCCCC"><b>TOTAL GENERAL</b>&nbsp;</td>
                      <td align="center" bgcolor="#CCCCCC">&nbsp;<? echo $sume1;?></td>
                      <td align="center" bgcolor="#CCCCCC">&nbsp;<? echo $sumd1?></td>
                      <td align="center" bgcolor="#CCCCCC">&nbsp;<? echo $sumunidad_tripas?></td>
                      <td align="center" bgcolor="#CCCCCC">&nbsp;<? echo $sumtotal_tripas?></td>
                      <td align="center" bgcolor="#CCCCCC">&nbsp;<? echo $sumprocorto?></td>
                      <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
                      <td align="center" bgcolor="#FF3300">&nbsp;<? echo $sumprorojo?></td>
                      <td align="center" bgcolor="#FF3300">&nbsp;</td>
                      <td align="center" bgcolor="#0099FF"><? echo $sumproazul?></td>
                      <td align="center" bgcolor="#0099FF">&nbsp;</td>
                      <td align="center" bgcolor="#66CC00"><? echo $sumproverde?></td>
                      <td align="center" bgcolor="#66CC00">&nbsp;</td>
                      <td align="center" bgcolor="#CCCCCC"><? echo $sumprowaste?></td>
                      <td align="center" bgcolor="#CCCCCC"><? echo $sumplatitcos?></td>
                      <td align="center" bgcolor="#CCCCCC"><? echo $sumtotal_tubing?></td>
                      <td align="center" bgcolor="#CCCCCC"><? echo $sumtotal_metros?></td>
                      <td align="center" bgcolor="#CCCCCC"><? echo $sumrendimiento_pro?></td>
                      <? if($fecha_cierre_producc == '0000-00-00'){?><td>&nbsp;</td><? }?>
                    </tr>
                    <? } ?>
                  </table></td>
              </tr>
             
            </table>
     </td>
        </tr>
        <tr>
          <td>
          <? if($fecha_cierre_producc == '0000-00-00'){?>
            <CENTER><input type="submit" name="actualizar_planilla" id="actualizar_planilla" value="ACTUALIZAR" /></CENTER>
          <? } ?>  
          </td>
        </tr>
        <tr>
          <td><br><br><hr><table width="959" border="0" align="center">
            <tr>
              <td align="center" bgcolor="#FFFF00"><strong>Nota Importante:</strong> <? if($fecha_cierre_producc == '0000-00-00'){?> <br>- Una vez completada la planilla de producci&oacute;n, el encargado debe realizar el de cierre.<br>                
                - De lo contrario se cerrara automaticamente al dia siguiente a las 10:00 A.M.&nbsp;&nbsp;&nbsp;
                <input type="submit" name="cierre_produccion" id="button" value="Cerrar Producci&oacute;n" />
                <? }else{ ?>Para poder corregir la planilla de producción debe solicitarlo al administrador del sistema&nbsp;&nbsp;
                <input type="submit" name="abrir_produccion" id="button" value="Abrir Producción" /> <? }?></td>
            </tr>
          </table><hr></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table></td>
</tr>
</table>