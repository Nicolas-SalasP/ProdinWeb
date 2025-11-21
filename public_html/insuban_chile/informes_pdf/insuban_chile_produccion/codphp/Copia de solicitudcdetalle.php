<?

if($cambio_estado_pt_rep){
	 $sqlpt="SELECT * FROM etiquetados_folios WHERE id_c_es_so = $id_c_es_so";
 	 $resultpt=mysql_query($sqlpt);  
	 $cuantospt=mysql_num_rows($resultpt);
	 // echo "cuantospt $cuantospt<br>";
	  
	  if($cuatospt){
		  
		  while ($rowpte=mysql_fetch_array($resultpt))
    	{
		   $id_etiquetados_foliospt = $rowpte[id_etiquetados_folios];
		   $id_cruce_tablaspt = $rowpte[id_cruce_tablas];
		   $id_operariospt = $rowpte[id_operarios];
		   $id_envasespt = $rowpte[id_envases];
		   $f_elaboracionpt = $rowpte[f_elaboracion];
		   $f_iniciopt = $rowpte[f_inicio];
		   $f_terminopt = $rowpte[f_termino];
		   $f_vencimientopt = $rowpte[f_vencimiento];
		   $contenido_unidadespt = $rowpte[contenido_unidades];
		   
		}// while ($rowpte=mysql_fetch_array($resultpt))
	  }// if($cuatospt){
	
}//if($cuatospt){

if($cambio_estado_mp_pt){
if($id_procedencia == "I")
	{
	 $sqlidpi="SELECT * FROM mat_prima_importada WHERE id_c_es_so = $id_c_es_so";
 	 $resultidpi=mysql_query($sqlidpi);  
	 $cuantosidpi=mysql_num_rows($resultidpi);
	 //echo "cuantosidpi $cuantosidpi<br>";
       if($cuantosidpi){
		   //echo "Estoy dentro<br>";
	     while ($rowidpi=mysql_fetch_array($resultidpi))
    	{
		   $idmpimport=$rowidpi[id_mat_prima_importada];
		   $id_cruce_tablas = $rowidpi[cruce_tablas_id];
		   $id_operarios=$rowidpi[id_operarios];
		   $bidon_importado=$rowidpi[bidon_num];// bidon importado
		   $factura_importada =$rowidpi[comprobante_num];// factura importada
		   $id_origend=$rowidpi[id_origen];
		   $glosa=$rowidpi[glosa];
		   $contenido_unidades=$rowidpi[contenido];
		   $fecha_elaboracion=$rowidpi[fecha_elaboracion];
		   $f_inicio=$rowidpi[f_inicio];
		   $f_termino=$rowidpi[fecha_termino];
		   $f_vencimiento =$rowidpi[fecha_vencimiento];
		   $id_estado_folio = 1; //Estado de Folio Emitido
		   $id_envases = 5; // Tipo de envase Bidon
			   
			 $sqlcod="SELECT * FROM cruce_tablas WHERE id_cruce_tablas=$id_cruce_tablas";
			 $resultcod=mysql_query($sqlcod);  
			 
			 if($rowcod=mysql_fetch_array($resultcod))
    	        {
			    $id_cruce_tablasmp=$rowcod[id_cruce_tablas];
		        $id_especie=$rowcod[id_especie];
				$id_producto=$rowcod[id_producto];
				$id_calibre=$rowcod[id_calibre];
				$id_unidad_medida=$rowcod[id_unidad_medida];
				$id_medidas_productos=$rowcod[id_medidas_productos];
				$id_caract_producto=$rowcod[id_caract_producto];
				$id_caract_envases=$rowcod[id_caract_envases];
				}
			  // echo "$id_cruce_tablasmp,$id_especie,$id_producto,$id_calibre,$id_unidad_medida,$id_medidas_productos,$id_caract_producto,$id_caract_envases<br>";
$fhoy=date("Y"); 
			   
//*****************************************************************************
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
}
$fech_generada_inicio  = date("Y-m-d H:i:s");
$sql_nuevo="insert into etiquetados_folios  (id_etiquetados_folios,id_c_es_so,ano,id_cruce_tablas,id_origen,bidon_importado,factura_importada,id_especie,id_producto,id_calibre,id_unidad_medida,id_medidas_productos,id_caract_producto,id_caract_envases,id_envases,f_elaboracion,f_inicio,f_termino,f_vencimiento,id_operarios,contenido_unidades,id_estado_folio,marca,id_procedencia,fech_generada_inicio) values ($id_etiquetados_folios_siguiente,'$id_c_es_so','$fhoy',$id_cruce_tablasmp,$id_origend,$bidon_importado,$factura_importada,$id_especie,$id_producto,$id_calibre,$id_unidad_medida,$id_medidas_productos,$id_caract_producto,$id_caract_envases,5,'$fecha_elaboracion','$f_inicio','$f_termino','$f_vencimiento',$id_operarios,'$contenido_unidades',1,1,'N','$fech_generada_inicio')";
$result_nuevo=mysql_query($sql_nuevo,$link);
//echo "$sql_nuevo $sql_nuevo<br>";
	 
	 $sql_trazabilidad="insert folios_mat (id_etiquetados_folios,id_mat) values ($id_etiquetados_folios_siguiente,$idmpimport)";
     $result_trazabilidad=mysql_query($sql_trazabilidad,$link);
	 
	 $fecha_salida_despachompi  = date("Y-m-d");
	 $sqldespachompi="update mat_prima_importada set id_estado_material = 2, fecha_salida = '$fecha_salida_despachompi', etiquetados_folios_id_new = $id_etiquetados_folios_siguiente  where id_mat_prima_importada = $idmpimport";
  ;	$resultdespachompi=mysql_query($sqldespachompi);
//*****************************************************************************
			   
		}//while ($rowidpi=mysql_fetch_array($resultidpi))
	 }//if($cuantosidpi){
	}//if($id_procedencia == "I")
	
	
	 $fecha_mp_pt  = date("Y-m-d");
     $sqlacep="UPDATE cambio_estado_solicitud set fecha_mp_pt  = '$fecha_mp_pt', fecha_cierre_proceso = '$fecha_mp_pt'  where id_c_es_so=$id_c_es_so";
     $resultacep=mysql_query($sqlacep);
}//if($id_procedencia == "I")

$sqlsumnac="SELECT SUM( mpn.contenido )AS contenidotn FROM cambio_estado_detalle AS camed, mat_prima_nacional AS mpn, producto AS p, calibre AS c, origenes AS org, estado_material AS em WHERE camed.foliosmpfsp  = mpn.id_mat_prima_nacional AND mpn.id_producto = p.id_producto AND mpn.id_calibre = c.id_calibre AND mpn.id_origen = org.id_origen AND mpn.id_estado_material = em.id_estado_material AND camed.id_c_es_so =$id_c_es_so";
$retsulsumnac=mysql_query($sqlsumnac);

if ($rowretsulsumnac=mysql_fetch_array($retsulsumnac)) { $contenidotn=$rowretsulsumnac[contenidotn];}
$sqlsumimp="SELECT SUM( mpi.contenido )AS contenidoti FROM cambio_estado_detalle AS camed, mat_prima_importada AS mpi, producto AS p, calibre AS c, origenes AS org, estado_material AS em WHERE camed.foliosmpfsp = mpi.id_mat_prima_importada AND mpi.id_producto = p.id_producto AND mpi.id_calibre = c.id_calibre AND mpi.id_origen = org.id_origen AND mpi.id_estado_material =  em.id_estado_material AND camed.id_c_es_so = $id_c_es_so";
$retsulsumimp=mysql_query($sqlsumimp);

if ($rowretsulsumimp=mysql_fetch_array($retsulsumimp)) { $contenidoti=$rowretsulsumimp[contenidoti];}

$unidadessolicitadasactual=$contenidotn+$contenidoti;
	
   $sqlfcac="UPDATE solicitud_mp set unidadessolicitadas='$unidadessolicitadasactual' where id_solicitud_mp  = $id_solicitud_mp";
   $resultfcac=mysql_query($sqlfcac); 
  //echo "sqlfcac $sqlfcac";

if($actualizar){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'id_estdis')
	{
    $id=$dat[1];
	$id_estdis=$_POST["id_estdis-$id"];
    $sql="UPDATE cambio_estado_detalle   SET  id_estdis='$id_estdis' where foliosmpfsp  = $id";
	$retsul=mysql_query($sql);
	echo "sql $sql<br>";
   }
  
}
  $actualizar_solicitud_solicitud_cambio_estado=1;
   include "modulo_email/email1.php";
}



if($guardarcomentarios){
   $sqlupdate="UPDATE cambio_estado_solicitud set observacionesces = '$observacionesces'  where id_c_es_so=$id_c_es_so";
   $resultupdate=mysql_query($sqlupdate);   
}

if($anular_cemp){
   $fecha_anulacion  = date("Y-m-d");
   $fecha_cierre_proceso  = date("Y-m-d");
  /* $sqlanula="UPDATE cambio_estado_solicitud set fecha_anulacion  = '$fecha_anulacion', fecha_cierre_proceso= '$fecha_cierre_proceso'  where id_c_es_so=$id_c_es_so";*/
   $sqlanula="delete from cambio_estado_solicitud  where  id_c_es_so = $id_c_es_so ";
   $resultanulacion=mysql_query($sqlanula);   	
   
    $sqlanula2="delete from cambio_estado_detalle  where  id_c_es_so = $id_c_es_so ";
    $resultanulacion2=mysql_query($sqlanula2);   	
   //echo "sqlanula $sqlanula<br>";
   
   $anulacion_solicitud_cambio_estado=1;
   include "modulo_email/email1.php";
   
  	if($id_procedencia == "N")
	{
	 $sqlidpn="SELECT * FROM mat_prima_nacional WHERE id_c_es_so = $id_c_es_so";
 	 $resultidpn=mysql_query($sqlidpn); 
	 $cuantosidpn=mysql_num_rows($resultidpn);
	 
	 if($cuantosidpn){
	     while ($rowidpn=mysql_fetch_array($resultidpn))
    	{
			   $idmpnacional=$rowidpn[id_mat_prima_nacional];
			   $sqlanulampn="UPDATE mat_prima_nacional set id_c_es_so = 0  where id_mat_prima_nacional=$idmpnacional";
   			   $resultanulacionmpn=mysql_query($sqlanulampn);   
			   //echo "sqlanulampn $sqlanulampn<br>";
			   
		}//while ($rowidpi=mysql_fetch_array($resultidpi))
	  }//if($cuantosidpi){
	
    }//if($id_procedencia == "N")
	if($id_procedencia == "I")
	{
	 $sqlidpi="SELECT * FROM mat_prima_importada WHERE id_c_es_so = $id_c_es_so";
 	 $resultidpi=mysql_query($sqlidpi);  
	 $cuantosidpi=mysql_num_rows($resultidpi);
	 
	 if($cuantosidpi){
	     while ($rowidpi=mysql_fetch_array($resultidpi))
    	{
			   $idmpimport=$rowidpi[id_mat_prima_importada];
			   $sqlanulampi="UPDATE mat_prima_importada set id_c_es_so = 0  where id_mat_prima_importada = $idmpimport";
   			   $resultanulacionmpi=mysql_query($sqlanulampi);   
			   
		}//while ($rowidpi=mysql_fetch_array($resultidpi))
	 }//if($cuantosidpi){
	}//if($id_procedencia == "I")
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=solicitudcpendientes.php&tic=$tic\">";
exit;

}//if($anular_cemp){


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
	if($id_ce == 1){
	if($largo == 8){
	  $sqlimpbusca="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mpilistard and id_c_es_so $id_c_es_so";
	  $resultn=mysql_query($sqlimpbusca);
	  if ($rowimpn=mysql_fetch_array($resultn)) { 
      $idimpn=$rowimpn[id_mat_prima_nacional];
	  }
	  $sqlupdate="UPDATE mat_prima_nacional  set id_c_es_so = 0, id_estado_material = 1 where id_mat_prima_nacional  = $idimpn and id_c_es_so=$id_c_es_so";
 	  $resultupdate=mysql_query($sqlupdate);   
	  $sqlelim="delete from cambio_estado_detalle  where  foliosmpfsp  = $idimpn and id_c_es_so=$id_c_es_so";
 	  $resultelim=mysql_query($sqlelim);
	 }// if($largo == 8){
	 if($largo == 9){
	  $sqlimpbuscai="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mpilistard and id_c_es_so=$id_c_es_so";
	  $resulti=mysql_query($sqlimpbuscai);
	  if ($rowimpi=mysql_fetch_array($resulti)) { 
   	  $idimpi=$rowimpi[id_mat_prima_importada];
	  }
	  $sqlupdate="UPDATE mat_prima_importada set id_c_es_so = 0, id_estado_material = 1 where id_mat_prima_importada  = $idimpi and id_c_es_so=$id_c_es_so";
 	  $resultupdate=mysql_query($sqlupdate);   
	  $sqlelim="delete from cambio_estado_detalle where foliosmpfsp = $idimpi and id_c_es_so=$id_c_es_so";
 	  $resultelim=mysql_query($sqlelim);
	 }//if($largo == 9){
	 }else{
  	  $sqlupdate="UPDATE etiquetados_folios set id_c_es_so = 0 where id_etiquetados_folios = $idimpi and id_c_es_so=$id_c_es_so";
 	  $resultupdate=mysql_query($sqlupdate);   
	  echo "sqlupdate $sqlupdate<br>";
	  $sqlelim="delete from cambio_estado_detalle where foliosmpfsp = $idimpi and id_c_es_so=$id_c_es_so";
 	  $resultelim=mysql_query($sqlelim);		 
	 }
   }
}


}//if($eliminar)

$sql="select ces.id_c_es_so AS id_c_es_so, ce.cambio_estado AS cambio_estado, ce.id_ce AS id_ce, us.username AS username, proc.procedencia AS procedencia, pro.producto AS producto, org.origen AS origen, ces.fechaces AS fechaces, ces.fecha_mp_pt AS fecha_mp_pt, ces.fecha_cierre_proceso AS fecha_cierre_proceso, ces.fecha_anulacion AS fecha_anulacion, ces.observacionesces AS observacionesces from  cambio_estado_solicitud AS ces, cambio_estado AS ce, procedencia AS proc, usuarios AS us, origenes AS org, producto AS pro where ces.id_ce = ce.id_ce and ces.id_origen = org.id_origen and ces.id_procedencia = proc.id_procedencia and ces.id_usuario = us.id_usuario and ces.id_producto = pro.id_producto  and ces.id_c_es_so = $id_c_es_so ";
$result=mysql_query($sql);
//echo "sql $sql<br>";
?>
<? if($fecha_anulacion){?>
<h1>DETALLE DE CAMBIOS DE ESTADOS</h1>
<? }else{?>
<h1>CAMBIOS DE ESTADOS PENDIENTES</h1>
<? } ?>
<table width="1010" border="0">
 <tr>
   <td height="8" colspan="8">&nbsp;</td>
  </tr>
 <tr>
    <td width="33" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="7" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td width="33" height="19" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="265" bgcolor="#FF9933"><strong>PRODUCTO</strong></td>
    <td width="136" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="92" bgcolor="#FF9933"><strong>&nbsp;C/ESTADO</strong></td>
    <td width="115" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="136" bgcolor="#FF9933"><strong>&nbsp;<? if($id_ce == 1){?>F/MP -&gt; PT<? }else{?>REPROCESO -> PT<? }?></strong></td>
    <td width="117" bgcolor="#FF9933"><strong>&nbsp;F/ANULACION</strong></td>
    <td width="108" bgcolor="#FF9933"><strong>&nbsp;ENCARGADO</strong></td>
  </tr>
     <?
	$i=$op;
    $color = "#000000";$i = 0;
    if ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_c_es_so=$row[id_c_es_so];
	$id_ce=$row[id_ce];
	$cambio_estado=$row[cambio_estado];
	$id_procedencia=$row[id_procedencia];
	$username=$row[username];
	$id_origen=$row[id_origen];
	$id_producto=$row[id_producto];
	$observacionesces=$row[observacionesces];
	$id_calibre=$row[id_calibre];
	$fechaces=format_fecha_sin_hora($row[fechaces]);   
	$fecha_mp_pt=format_fecha_sin_hora($row[fecha_mp_pt]);   
	$fecha_anulacion=format_fecha_sin_hora($row[fecha_anulacion]);   
	$fecha_cierre_proceso=format_fecha_sin_hora($row[fecha_cierre_proceso]);
	$totaluni+=$unidadessolicitadas;
  ?>
  <tr>
    <td height="8" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $id_c_es_so?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[producto]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $cambio_estado; ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechaces?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_mp_pt?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_anulacion?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $username?></td>
    <? 
	}
	?>
    <?

if($id_ce == 1){

$sqln="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, p.id_producto AS id_producto, p.producto AS producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.id_origen AS id_origen, org.origen AS origen, mpn.contenido AS contenido, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, em.estado_material, id_estdis AS id_estdis FROM cambio_estado_detalle AS camed, mat_prima_nacional AS mpn, producto AS p, calibre AS c, origenes AS org, estado_material AS em WHERE camed.foliosmpfsp = mpn.id_mat_prima_nacional and mpn.id_producto = p.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = em.id_estado_material and camed.id_c_es_so = $id_c_es_so order by mpn.id_mat_prima_nacional desc";
$resultn=mysql_query($sqln);
$cuantosn=mysql_num_rows($resultn);
//echo "cuantosn $cuantosn<br>";
	
$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.etiquetados_folios_id AS etiquetados_folios_id, p.id_producto AS id_producto, p.producto AS producto, c.calibre AS calibre, org.id_origen AS id_origen, org.origen AS origen, mpi.contenido AS contenido, mpi.bidon_num AS bidon_num, mpi.fecha_ingreso AS fecha_ingreso, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, em.estado_material, camed.id_estdis AS id_estdis FROM cambio_estado_detalle AS camed, mat_prima_importada AS mpi, producto AS p, calibre AS c, origenes AS org, estado_material AS em WHERE camed.foliosmpfsp  = mpi.id_mat_prima_importada and mpi.id_producto = p.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = em.id_estado_material  and camed.id_c_es_so = $id_c_es_so order by mpi.id_mat_prima_importada desc";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);
$cuantostotales= $cuantosn  + $cuantosi;
//echo "cuantosi $cuantosi<br>";
}else{
	
	
	
$sqlpt="SELECT ef.id_etiquetados_folios AS id_etiquetados_folios, p.producto AS producto, c.calibre AS calibre, um.unidad_medida AS unidad_medida, mpro.medidas_productos AS medidas_productos, carpro.caract_producto AS caract_producto, carenv.caract_envases AS caract_envases, ef.contenido_unidades AS contenido_unidades, o.nombreop AS nombreop, o.apellido AS apellido, e.estado_folio AS estado_folio, ef.id_cruce_tablas AS id_cruce_tablas, camed.id_estdis AS id_estdis FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, operarios AS o, origenes AS orig, estado_folio AS e, cambio_estado_detalle AS camed where camed.foliosmpfsp  = ef.id_etiquetados_folios and ef.id_producto = p.id_producto and ef.id_calibre = c.id_calibre and ef.id_medidas_productos = mpro.id_medidas_productos and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 and ef.id_origen = orig.id_origen and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio and ef.id_estado_folio = 2 and ef.id_procedencia = 'N' and camed.id_c_es_so = $id_c_es_so order by ef.id_etiquetados_folios desc
";
$resultpt=mysql_query($sqlpt);
$cuantospt=mysql_num_rows($resultpt);
//echo "sqlpt $sqlpt<br>";
}

	?>
  </tr>
  <tr>
    <td height="9" colspan="8">&nbsp;</td>
  </tr>
    <tr>
      <td colspan="8">
      <? if($id_ce == 1){?>
      <table width="100%" border="0">
      <tr>
    <td width="21" height="19" bgcolor="#FF9933"><center></center></td>
    <td colspan="9" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
    <td colspan="3" align="center" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
  <tr>
    <td width="21" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="53" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
    <td width="156" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="75" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="68" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="101" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="79" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <td width="86" nowrap="nowrap" bgcolor="#FF9933"><strong>F/INGRESO</strong></td>
    <td width="70" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="61" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="68" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
     <? if(!$infomenu){?>
    <td width="37" align="center" nowrap="nowrap" bgcolor="#FF9933"><input name="eliminar" type="submit" id="eliminar" value="X" /></td>
    <? } ?>
    <td width="101" align="center" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;DISPONIBLE</strong></td>
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
       <td height="19" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $i?></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<a href="?modulo=fmpfresca.php&amp;id_mat_prima_nacional=<? echo $id_mat_prima_nacional?>&amp;id_origen=<? echo $id_origen?>&amp;id_producto=<? echo $id_producto?>&amp;fresca=<? echo "N";?>">F<? echo $id_mat_prima_nacional?>
       </a></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $rown[producto]?></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$rown[calibre]";}?></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $rown[origen]?></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center>
         <? echo $rown[contenido]?>
       </center></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center>
         <? echo $rown[bidon_num]?>
       </center></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_ingreso?></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_faena ?></td>
       <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_termino?></td>
       <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $rown[estado_material]?></td>
        <? if(!$infomenu){?>
       <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><input type="checkbox" name="id_mpi-<? echo $id_mat_prima_nacional?>" id="id_mpi" value="<? echo $id_mat_prima_nacionall?>" /><input type="hidden" name="id_mpielim-<? echo $id_mat_prima_nacional?>" id="id_mpielim" value="<? echo $id_mat_prima_nacional?>" /></td>
       <? } ?>
       <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">
	   <? 
	   //echo $id_estdis;
	   
	   $estdis= crea_disponibilidad($link,$id_estdis,$id_mat_prima_nacional);
	   
	   if(!$infomenu){
		   echo $estdis;
	   }else{
   		   echo "SI";
	   }
	   
	   $cuantofoliosna=$cuantofoliosna + $id_estdis;
	   
	   ?>
       </td>
     </tr>
      <? }
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
    <td height="19" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $i?></td>
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
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center>
      <? echo $rowi[bidon_num]?>
    </center></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_vencimiento?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $rowi[estado_material]?></td>
     <? if(!$infomenu){?>
    <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><input type="checkbox" name="id_mpi-<? echo $id_mat_prima_importadaa?>" id="id_mpi" value="<? echo $id_mat_prima_importadaa?>" /><input type="hidden" name="id_mpielim-<? echo $id_mat_prima_importadaa?>" id="id_mpielim" value="<? echo $id_mat_prima_importadaa?>" /></td>
    <? } ?>
    <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">
    <? 
      $estdis= crea_disponibilidad($link,$id_estdis,$id_mat_prima_importadaa);
      echo $estdis;

   
	   $cuantofoliossi=$cuantofoliossi + $id_estdis;
	   ?>
    
    </td>
     </tr>
   <? 
     } 
     }
	 
	?>
  <tr>
    <td height="19" colspan="5" align="right" nowrap="nowrap" bgcolor="#FFFFFF">TOTAL</td>
    <td align="center" nowrap="nowrap" bgcolor="#999999">&nbsp;<strong><? echo $fstotal=$contenidototal+$contenidototali;?></strong></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
      </table>
      <? }else{ ?>
      <table width="90%" border="0">
        <tr>
          <td width="25" height="19" bgcolor="#FF9933"><center>
          </center></td>
          <td colspan="10" bgcolor="#CCCCCC"><strong>&nbsp;Bidones : <?echo $cuantospt?></strong></td>
          <td colspan="3" align="center" bgcolor="#CCCCCC">&nbsp;</td>
        </tr>
        <tr>
          <td width="25" height="19" nowrap="nowrap" bgcolor="#FF9933"><center>
            <strong>&nbsp;N&ordm;</strong>
          </center></td>
          <td width="53" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO</strong></td>
          <td width="39" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;COD</strong></td>
          <td width="93" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
          <td width="75" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
          <td width="90" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;&nbsp;U/MEDIDA</strong></td>
          <td width="80" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;MEDIDAS</strong></td>
          <td width="52" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/PRO</strong></td>
          <td width="52" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/ENV</strong></td>
          <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
          <td width="106" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;OPERARDOR</strong></td>
          <td width="68" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
          <? if(!$infomenu){?>
          <td width="37" align="center" nowrap="nowrap" bgcolor="#FF9933"><input name="eliminar2" type="submit" id="eliminar2" value="X" /></td>
          <? } ?>
          <td width="101" align="center" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;DISPONIBLE</strong></td>
        </tr>
        <?
	if($cuantospt){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($rowpt=mysql_fetch_array($resultpt))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_etiquetados_folios=$rowpt[id_etiquetados_folios];
	$id_etiquetados_foliospt=$rowpt[id_etiquetados_folios];
	$estado_folio=$rowpt[estado_folio];
	$id_cruce_tablas=$rowpt[id_cruce_tablas];
	$id_estdis=$rowpt[id_estdis];
	$producto=$rowpt[producto];
	$calibre=$rowpt[calibre];
	$unidad_medida=$rowpt[unidad_medida];
	$medidas_productos=$rowpt[medidas_productos];
	$caract_producto=$rowpt[caract_producto];
	$caract_envases=$rowpt[caract_envases];
	$contenido_unidadespt=$rowpt[contenido_unidades];
	$contenidototalpt+=$contenido_unidadespt;
	$nom = strtoupper($rowpt[nombreop]);
	$apell = strtoupper($rowpt[apellido]);
	
	
  ?>
        <tr>
          <td height="19" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $i?></td>
          <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;
          <a href="?modulo=ingresarpt.php&id_etiquetados_folios=<? echo $id_etiquetados_folios?>">PT<? echo $id_etiquetados_folios?></a></td>
          <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $id_cruce_tablas?></td>
          <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $producto ?></td>
          <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $calibre ?></td>
          <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $unidad_medida ?></td>
          <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center>
            &nbsp;<? echo $medidas_productos ?>
          </center></td>
          <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center>
            &nbsp;<? echo $caract_producto ?>
          </center></td>
          <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $caract_envases ?></td>
          <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $contenido_unidadespt ?></td>
          <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo "$nom $apell"?></td>
          <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;
            <? $est = strtoupper($estado_folio); echo $est ?>
          &nbsp;</td>
          <? if(!$infomenu){?>
          <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><input type="checkbox" name="id_mpi-<? echo $id_etiquetados_foliospt?>" id="id_mpi" value="<? echo $id_etiquetados_foliospt?>" />
            <input type="hidden" name="id_mpielim" id="id_mpielim" value="<? echo $id_etiquetados_foliospt?>" /></td>
          <? } ?>
          <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><? 
	   //echo $id_estdis;
	   
	   $estdis= crea_disponibilidad($link,$id_estdis,$id_etiquetados_foliospt);
	   
	   if(!$infomenu){
		   echo $estdis;
	   }else{
   		   echo "SI";
	   }
	   
	   $cuantofoliosna=$cuantofoliosna + $id_estdis;
	   echo "cuantofoliosna $cuantofoliosna<br>id_estdis $id_estdis<br>";
	   ?></td>
        </tr>
        <? }//   while ($rowpt=mysql_fetch_array($resultpt))
	} //if($cuantospt){
	?>
   
        <tr>
          <td height="19" align="right" nowrap="nowrap">&nbsp;</td>
          <td height="19" align="right" nowrap="nowrap">&nbsp;</td>
          <td height="19" align="right" nowrap="nowrap">&nbsp;</td>
          <td height="19" align="right" nowrap="nowrap">&nbsp;</td>
          <td height="19" align="right" nowrap="nowrap">&nbsp;</td>
          <td height="19" align="right" nowrap="nowrap">&nbsp;</td>
          <td align="center" nowrap="nowrap">&nbsp;</td>
          <td nowrap="nowrap">&nbsp;</td>
          <td align="center" nowrap="nowrap">TOTAL</td>
          <td align="center" nowrap="nowrap" bgcolor="#999999">&nbsp;<? echo $contenidototalpt?></td>
          <td nowrap="nowrap">&nbsp;</td>
          <td nowrap="nowrap">&nbsp;</td>
          <td colspan="2" nowrap="nowrap">&nbsp;</td>
        </tr>
      </table>
      <? }?>
      </td>
    </tr>
    <?
	if($fecha_cierre_proceso == '00-00-0000'){?>
    <tr>
   <td colspan="8" align="right"><input type="submit" name="actualizar" id="actualizar" value="Actualizar Disponibilidad" /></td>
  </tr>
    <tr>
      <td colspan="8" align="right">
      <? if($id_ce == 1){?>
      <input type="submit" name="cambio_estado_mp_pt" id="cambio_estado_mp_pt" value="Proceder con el cambio de estado MP -&gt; PT" />
      <? }else{?>
      <input type="submit" name="cambio_estado_pt_rep" id="cambio_estado_pt_rep" value="Proceder con el cambio de estado Reprocesado - &gt; PT" />
      <? } ?>
      </td>
    </tr>
    <tr>
      <td colspan="8" align="right">
      <? if($id_ce == 1){?>
      <input type="submit" name="anular_cemp" id="anular_cemp" value="Anular solicitud de cambio de estado MP -&gt; PT" />
      <? }else{?>
      <input type="submit" name="anular_cemp" id="anular_cemp" value="Anular solicitud de cambio de estado Reprocesado -&gt; PT" />
      <? } ?>
      </td>
    </tr>
    <? }//if($fecha_anulacion != '0000-00-00'){?>
    <tr>
      <td colspan="8">
       <? //if($fecha_cierre_proceso == '00-00-0000'){?>Nota: Para proceder con el cambio de estado el bodeguero debe informar la disponivilidad de la Materia Prima<? //} ?></td>
  </tr>
    <tr>
      <td colspan="8"><a href="#" onclick="cambiar('error'); return false;">INGRESAR OBSERVACIONES</a></td>
  </tr>
    <tr>
      <td colspan="8"><div id="error" style="display: none;"><center><textarea name="observacionesces" id="observacionesces" cols="80" rows="5"><? echo $observacionesces?></textarea></center>&nbsp;&nbsp;&nbsp;<center><input type="submit" name="guardarcomentarios" id="guardarcomentarios" value="Guardar Observaciones" /></center></div></td>
    </tr>
</table>

<?
/*$totalreal=$cuantofoliossi + $cuantofoliosna;
$totalhay=$cuantosi +$cuantosn;
//echo "totalreal $totalreal / totalhay $totalhay<br>";
if($actualizar){

 if(($totalreal == $totalhay)){
	 
	 
	  $sqlimpbuscam="SELECT * FROM mat_prima_nacional WHERE id_c_es_so  = $id_c_es_so ";
	  $resultnm=mysql_query($sqlimpbuscam);
	  $cuantosn=mysql_num_rows($resultnm);
	  if($cuantosn){
	  while ($rowb=mysql_fetch_array($resultnm)) { 
      $id_mat_prima_nacionalb=$rowb[id_mat_prima_nacional];
	   $sqlupdatemb="UPDATE mat_prima_nacional  set id_estado_material = 1 where id_c_es_so =$id_c_es_so  and id_mat_prima_nacional=$id_mat_prima_nacionalb";
   $resultupdatemb=mysql_query($sqlupdatemb);
   echo "sqlupdatemb $sqlupdatemb";
	  }
	  }//if($cuantosn){
		  
	
	 $sqlimpbuscai="SELECT * FROM mat_prima_importada WHERE id_c_es_so  = $id_c_es_so ";
	  $resultni=mysql_query($sqlimpbuscai);
	  $cuantosi=mysql_num_rows($resultni);
	  if($cuantosi){
	  while ($rowbi=mysql_fetch_array($resultni)) { 
      $id_mat_prima_importadabi=$rowbi[id_mat_prima_importada];
	   $sqlupdatemb="UPDATE mat_prima_importada set id_estado_material = 1 where id_c_es_so =$id_c_es_so  and id_mat_prima_importada=$id_mat_prima_importadabi";
   $resultupdatemb=mysql_query($sqlupdatemb);
   echo "sqlupdatemb $sqlupdatemb";
	  }
	  }//if($cuantosi){
		  
		    
   //  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=recepcionmp.php&id_ldp=$id_ldp\">";
 //exit;
	  }
 }
*/?>