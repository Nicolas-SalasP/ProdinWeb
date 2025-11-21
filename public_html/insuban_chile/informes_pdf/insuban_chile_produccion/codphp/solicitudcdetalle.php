<?
 
if($anular_cerep){
	 $sqlpt="SELECT * FROM etiquetados_folios  WHERE id_c_es_so = $id_c_es_so";
 	 $resultpt=mysql_query($sqlpt);  
	 $cuantospt=mysql_num_rows($resultpt);
	 //echo "sqlpt $sqlpt<br>";
	 //echo "cuantospt $cuantospt<br>";
	  
	  if($cuantospt){
 	   
	   while ($rowpte=mysql_fetch_array($resultpt))
       {
	   $id_etiquetados_foliospt = $rowpte[id_etiquetados_folios];
	  
       $sql ="UPDATE etiquetados_folios set freprocesado  = '0000-00-00', id_c_es_so = '0', id_estado_folio = '2' where id_etiquetados_folios = $id_etiquetados_foliospt";
       $result =mysql_query($sql);
	   
	   $sqlelim="delete from cambio_estado_detalle where id_c_es_so = $id_c_es_so and foliosmpfsp = $id_etiquetados_foliospt";
 	  $resultelim=mysql_query($sqlelim);	
	   
	  }//while ($rowpte=mysql_fetch_array($resultpt))
		  
	 }//if($cuantospt){
		 
      $sqlelim2="delete from cambio_estado_solicitud where id_c_es_so=$id_c_es_so";
 	  $resultelim2=mysql_query($sqlelim2);	

  	 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=solicitudchistorial.php&id_ce=$id_ce&tic=4\">";
 	 exit;
}//if($cambio_estado_rep){

if($cambio_estado_rep){
	 $sqlpt="SELECT * FROM etiquetados_folios WHERE id_c_es_so = $id_c_es_so";
 	 $resultpt=mysql_query($sqlpt);  
	 $cuantospt=mysql_num_rows($resultpt);
	 //echo "sqlpt $sqlpt<br>";
	 //echo "cuantospt $cuantospt<br>";
	  
	  if($cuantospt){
 	  $freprocesado  = date("Y-m-d");
	  
	   while ($rowpte=mysql_fetch_array($resultpt))
      {
		   $id_etiquetados_foliospt = $rowpte[id_etiquetados_folios];
	  
       $sqlreprocesado ="UPDATE etiquetados_folios set ocupado= 0, freprocesado  = '$freprocesado', id_estado_folio = 6 where id_etiquetados_folios = $id_etiquetados_foliospt";
       $resultreprocesado =mysql_query($sqlreprocesado);
	  }//while ($rowpte=mysql_fetch_array($resultpt))
		  
	 }//if($cuantospt){
		 
	 $fecha_mp_pt  = date("Y-m-d");
     $sqlacep="UPDATE cambio_estado_solicitud set fecha_mp_pt  = '$fecha_mp_pt', fecha_cierre_proceso = '$fecha_mp_pt'  where id_c_es_so=$id_c_es_so";
     $resultacep=mysql_query($sqlacep);

  	 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=solicitudchistorial.php&id_ce=$id_ce&tic=4\">";
 	 exit;
}//if($cambio_estado_rep){

if($cambio_estado_pt_rep){
	 $sqlpt="SELECT * FROM etiquetados_folios WHERE id_c_es_so = $id_c_es_so";
 	 $resultpt=mysql_query($sqlpt);  
	 $cuantospt=mysql_num_rows($resultpt);
	 //echo "sqlpt $sqlpt<br>";
	 //echo "cuantospt $cuantospt<br>";
	  
	  if($cuantospt){
		  
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
		   
		   $sqlpt_trazabilidad="SELECT * FROM folios_mat WHERE id_etiquetados_folios = $id_etiquetados_foliospt";
 	 	   $resultpt_trazabilidad=mysql_query($sqlpt_trazabilidad);  
	       $cuantospt_trazabilidad=mysql_num_rows($resultpt_trazabilidad);
		   //echo "sqlpt_trazabilidad $sqlpt_trazabilidad<br>";
		   //echo "cuantospt_trazabilidad $cuantospt_trazabilidad<br>";
		   
		
		   
		    $sqlcod="SELECT * FROM cruce_tablas WHERE id_cruce_tablas=$id_cruce_tablaspt";
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


		   
		   //******************************************************************************************
			  $fhoy=date("Y"); 
			  $f_elaboracionpt = date("Y-m-d");
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
$sql_nuevo="insert into etiquetados_folios  (id_etiquetados_folios,folioptnew_reproceso,id_producto,ano,id_calibre,id_cruce_tablas,id_especie,id_unidad_medida,id_caract_producto,id_caract_envases,id_medidas_productos,id_envases,f_elaboracion,f_inicio,f_termino,f_vencimiento,id_operarios,contenido_unidades,id_estado_folio,marca,id_procedencia,fech_generada_inicio) values ($id_etiquetados_folios_siguiente,$id_etiquetados_foliospt,$id_producto,'$fhoy',$id_calibre,$id_cruce_tablaspt,$id_especie,$id_unidad_medida,$id_caract_producto,$id_caract_envases,$id_medidas_productos,$id_envasespt,'$f_elaboracionpt','$f_iniciopt','$f_terminopt','$f_vencimientopt',$id_operariospt,'$contenido_unidadespt',2,1,'N','$fech_generada_inicio')";
$result_nuevo=mysql_query($sql_nuevo,$link);
//$id_etiquetas=mysql_insert_id();
//echo "sql_nuevo $sql_nuevo<br>";
 
    
			   //******************************************************************************************
		   
		   while ($rowpt_trazabilidad=mysql_fetch_array($resultpt_trazabilidad))
		   {
			   $id_mat=$rowpt_trazabilidad[id_mat];
			   $contenido=$rowpt_trazabilidad[contenido];
			   //echo "id_mat $id_mat contenido $contenido<br>";
			   
		  $sql_mod="insert folios_mat (id_etiquetados_folios,id_mat,contenido) values ($id_etiquetados_folios_siguiente,$id_mat,$contenido)";
		  $result_cruce=mysql_query($sql_mod,$link);
		  //echo "sql_mod $sql_mod<br>";
			   
		   }//while ($rowpte=mysql_fetch_array($resultpt))
		   
		    $freprocesado  = date("Y-m-d");
    	   $sqlreprocesado ="UPDATE etiquetados_folios set folioptnew_reproceso ='$id_etiquetados_folios_siguiente' ,freprocesado  = '$freprocesado', id_estado_folio = 6 where id_etiquetados_folios = $id_etiquetados_foliospt";
           $resultreprocesado =mysql_query($sqlreprocesado);
		   
		}// while ($rowpte=mysql_fetch_array($resultpt))
		
			
		 
		
		
	  }// if($cuatospt){
	
		 
	
	 $fecha_mp_pt  = date("Y-m-d");
     $sqlacep="UPDATE cambio_estado_solicitud set fecha_mp_pt  = '$fecha_mp_pt', fecha_cierre_proceso = '$fecha_mp_pt'  where id_c_es_so=$id_c_es_so";

     $resultacep=mysql_query($sqlacep);

  	 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=solicitudcpendientes.php&id_ce=$id_ce&tic=$tic\">";
 	 exit;

}//if($cambio_estado_pt_rep){

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

 $idmpimport=$rowidpi[id_mat_prima_importada];
		   $etiquetados_folios_id=$rowidpi[etiquetados_folios_id];
		   
		    $dat1ven=split(" ",$f_termino);
 					   $datven=split("-",$dat1ven[0]);
					  // echo "f_termino2 $f_termino2<br>";
					   $fech_an="$datven[0]";
					   $fech=$fech_an+2;
					  // echo " ano $fech<br>";
					   $mes="$datven[1]";
					  // echo "mes $mes<br>";
  					   $dia="$datven[2]";
					  // echo "dia $dia<br>";
					   
					   
					   
					   $f_vencimiento1="$fech-$mes-$dia";

$sql_nuevo="insert into etiquetados_folios  (id_etiquetados_folios,folio_pt_antiguo,id_c_es_so,ano,id_cruce_tablas,id_origen,bidon_importado,factura_importada,id_especie,id_producto,id_calibre,id_unidad_medida,id_medidas_productos,id_caract_producto,id_caract_envases,id_envases,f_elaboracion,f_inicio,f_termino,f_vencimiento,id_operarios,contenido_unidades,id_estado_folio,marca,id_procedencia,fech_generada_inicio) values ($id_etiquetados_folios_siguiente,$idmpimport,'$id_c_es_so','$fhoy',$id_cruce_tablasmp,$id_origend,$bidon_importado,$factura_importada,$id_especie,$id_producto,$id_calibre,$id_unidad_medida,$id_medidas_productos,$id_caract_producto,$id_caract_envases,5,'$fecha_elaboracion','$f_inicio','$f_termino','$f_vencimiento1',$id_operarios,'$contenido_unidades',1,1,'N','$fech_generada_inicio')";
$result_nuevo=mysql_query($sql_nuevo,$link);
//echo "$sql_nuevo $sql_nuevo<br>";
	 
	 $sql_trazabilidad="insert folios_mat (id_etiquetados_folios,id_mat) values ($id_etiquetados_folios_siguiente,$idmpimport)";
     $result_trazabilidad=mysql_query($sql_trazabilidad,$link);
	 //echo "sql_trazabilidad $sql_trazabilidad<br>";
	 
	 $fecha_salida_despachompi  = date("Y-m-d");
	 $sqldespachompi="update mat_prima_importada set id_estado_material = 2, fecha_salida = '$fecha_salida_despachompi', etiquetados_folios_id_new = $id_etiquetados_folios_siguiente  where id_mat_prima_importada = $idmpimport";
  	$resultdespachompi=mysql_query($sqldespachompi);
	//echo "sqldespachompi $sqldespachompi<br>";
//*****************************************************************************
			   
		}//while ($rowidpi=mysql_fetch_array($resultidpi))
	 }//if($cuantosidpi){
	}//if($id_procedencia == "I")
	
	
	 $fecha_mp_pt  = date("Y-m-d");
     $sqlacep="UPDATE cambio_estado_solicitud set fecha_mp_pt  = '$fecha_mp_pt', fecha_cierre_proceso = '$fecha_mp_pt'  where id_c_es_so=$id_c_es_so";
     $resultacep=mysql_query($sqlacep);
	 
	        echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=solicitudcdetalle.php&id_ce=1&tic=4&id_c_es_so=$id_c_es_so&id_procedencia= 'I'\">";
 exit;
	 
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
    $sql="UPDATE cambio_estado_detalle SET id_estdis='$id_estdis' where foliosmpfsp  = $id";
	$retsul=mysql_query($sql);
	//echo "sql $sql<br>";
	$sqlfechainformar="UPDATE cambio_estado_solicitud set fechainformar = '0000-00-00' where id_c_es_so  = $id_c_es_so";
    $resultfechainformar=mysql_query($sqlfechainformar); 
	//echo "sqlfechainformar $sqlfechainformar<br>";
   }
  
}
  //$actualizar_solicitud_solicitud_cambio_estado=1;
   //include "modulo_email/email1.php";
   

   
}

if($fecharechazo){
$fecharechazo=date("Y-m-d"); 

   $sqlupdate="UPDATE cambio_estado_solicitud  set fecharechazo = '$fecharechazo', fecharecep = '0000-00-00'  where id_c_es_so=$id_c_es_so and id_ce=$id_ce";
   $resultupdate=mysql_query($sqlupdate);   
   //echo "sqlupdate $sqlupdate<br>";
   
/*   	  $sqlimpbuscai="SELECT * FROM mat_prima_importada WHERE id_c_es_so = $id_c_es_so";
	  $resultni=mysql_query($sqlimpbuscai);
	  $cuantosi=mysql_num_rows($resultni);
	  if($cuantosi){
	  while ($rowbi=mysql_fetch_array($resultni)) { 
      $id_mat_prima_importadabi=$rowbi[id_mat_prima_importada];
	  $sqlupdatembi="UPDATE mat_prima_importada  set id_estado_material = 1, fechastockprodsalado = '0000-00-00' where id_c_es_so = $id_c_es_so and id_mat_prima_importada = $id_mat_prima_importadabi";
      $resultupdatembi=mysql_query($sqlupdatembi);
      }
	  }//if($cuantosn){*/
	  

     echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=solicitudcrechazadas.php&id_ce=$id_ce&tic=3\">";
 	 exit;

}

if($guardarcomentarios){
   $sqlupdate="UPDATE cambio_estado_solicitud set observacionesces = '$observacionesces'  where id_c_es_so=$id_c_es_so";
   $resultupdate=mysql_query($sqlupdate);   
}

if($anular_cemp){
   $fechaanulacion  = date("Y-m-d");
   $fecha_cierre_proceso  = date("Y-m-d");
  $sqlanula="UPDATE cambio_estado_solicitud set fechaanulacion  = '$fechaanulacion', fecha_cierre_proceso= '$fecha_cierre_proceso'  where id_c_es_so=$id_c_es_so";
  $resultanulacion=mysql_query($sqlanula); 
   
   //$sqlanula="delete from cambio_estado_solicitud  where  id_c_es_so = $id_c_es_so ";
   //$resultanulacion=mysql_query($sqlanula);   	
   
    //$sqlanula2="delete from cambio_estado_detalle  where  id_c_es_so = $id_c_es_so ";
    //$resultanulacion2=mysql_query($sqlanula2);   	
   //echo "sqlanula $sqlanula<br>";
   
   $anulacion_solicitud_cambio_estado=1;
   //include "modulo_email/email1.php";
   
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
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=solicitudcpendientes.php&id_ce=$id_ce&tic=$tic\">";
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
	  //echo "sqlupdate $sqlupdate<br>";
	  $sqlelim="delete from cambio_estado_detalle where foliosmpfsp = $idimpi and id_c_es_so=$id_c_es_so";
 	  $resultelim=mysql_query($sqlelim);		 
	 }
   }
}


}//if($eliminar)


if($eliminar2)
{
foreach ($_POST as $key => $value)
{ 
 $dat2=split("-",$key); 
   if ($dat2[0] == 'id_pt')
   {
	$id=$dat2[1];
   	$id_pt=$_POST["id_pt-$id"];
	$sqlelim="delete from cambio_estado_detalle where foliosmpfsp = $id_pt and id_c_es_so = $id_c_es_so and id_ce = $id_ce";
 	$resultelim=mysql_query($sqlelim);
	
	$sqlupdate="UPDATE etiquetados_folios  set id_c_es_so = '0', ocupado = 0, id_usuario = '$id_insuban' where id_etiquetados_folios  = '$id_pt' and id_c_es_so = '$id_c_es_so'";
 	$resultupdate=mysql_query($sqlupdate); 
	
   }
}
}//if($eliminar2)

if($esabodega){
    $sqlupdate="UPDATE cambio_estado_solicitud  set fecharecep = '0000-00-00', fechainformar = '0000-00-00', fecharechazo = '0000-00-00'  where id_c_es_so=$id_c_es_so and id_ce=$id_ce";
   $resultupdate=mysql_query($sqlupdate); 
    echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=solicitudcpendientes.php&id_ce=$id_ce&tic=2\">";
 exit;
}

if($enviar_scmp){
	//$fecharecep=date("Y-m-d"); 
	$fechainformar=date("Y-m-d"); 
    //$sqlupdate="UPDATE solicitud_mp  set fecharecep = '$fecharecep', fecharechazomp = '0000-00-00'  where id_solicitud_mp=$id_solicitud_mp and id_ldp=$id_ldp";
	$sqlupdate="UPDATE cambio_estado_solicitud  set fechainformar = '$fechainformar', fecharechazo = '0000-00-00'  where id_c_es_so=$id_c_es_so and id_ce=$id_ce";
   $resultupdate=mysql_query($sqlupdate); 
   //$informar_solicitud=1;
   //include "modulo_email/email1.php";
    echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=solicitudcpendientes.php&id_ce=$id_ce&tic=$tic\">";
 exit;
 //echo "sqlupdate $sqlupdate<br>";
}


$sql="select ces.id_c_es_so AS id_c_es_so, ces.unidadessolicitadas AS unidadessolicitadas, ce.cambio_estado AS cambio_estado, ce.id_ce AS id_ce, us.username AS username, proc.procedencia AS procedencia, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, ces.fechaces AS fechaces, ces.fechainformar AS fechainformar, ces.fechaentrega AS fechaentrega, ces.fecha_cierre_proceso AS fecha_cierre_proceso, ces.observacionesces AS observacionesces from  cambio_estado_solicitud AS ces, cambio_estado AS ce, procedencia AS proc, calibre AS c, usuarios AS us, origenes AS org, producto AS pro where ces.id_ce = ce.id_ce and ces.id_origen = org.id_origen and ces.id_procedencia = proc.id_procedencia and ces.id_usuario = us.id_usuario and ces.id_producto = pro.id_producto and ces.id_calibre = c.id_calibre and ces.id_c_es_so = $id_c_es_so ";
$result=mysql_query($sql);
//echo "sql $sql<br>";
?>

<? if($tic == 2){?><h1>CAMBIOS DE ESTADOS PENDIENTES <? if($id_ce == 1){?>MPS -> PT<? }else{?>PT -> REPROCESO<? }?></h1><? }?>
<? if($tic == 3){?><h1>CAMBIOS DE ESTADOS RECHAZADOS <? if($id_ce == 1){?>MPS -> PT<? }else{?>PT -> REPROCESO<? }?></h1><? }?>
<? if($tic == 4){?><h1>LISTAR CAMBIOS DE ESTADOS <? if($id_ce == 1){?>MPS -> PT<? }else{?>PT -> REPROCESO<? }?></h1><? }?>


<table width="995" border="0">
 <tr>
   <td height="8" colspan="8">&nbsp;</td>
  </tr>
 <tr>
    <td width="23" height="19" bgcolor="#FF9933"><center></center></td>
   <td colspan="7" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td width="40" height="19" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="155" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="100" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="103" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="50" bgcolor="#FF9933"><strong><center>&nbsp;CONTENIDO</center></strong></td>
    <td width="130" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO SOLICITUD</strong></td>
    <td width="130" bgcolor="#FF9933"><strong>&nbsp;F/PLAZO DE ENTREGA</strong></td>
    <td width="80" bgcolor="#FF9933"><strong>&nbsp;ENCARGADO</strong></td>
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
	$fechaentrega=format_fecha_sin_hora($row[fechaentrega]);   
	$fecha_cierre_proceso=format_fecha_sin_hora($row[fecha_cierre_proceso]);
	$fechainformar=format_fecha_sin_hora($row[fechainformar]);
	$unidadessolicitadas=$row[unidadessolicitadas];
	$totaluni+=$unidadessolicitadas;
  ?>
  <tr>
    <td height="8" bgcolor="<? echo $color?>"><center><? echo $id_c_es_so?></center></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $row[producto]?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? if(!$id_calibre){ echo "Original"; }else{echo "$row[calibre]";}?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $totaluni?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $fechaces?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $fechaentrega?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo $username?></td>
    <? 


	}
	?>
    <?

if($id_ce == 1){

$sqln="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, p.id_producto AS id_producto, p.producto AS producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.id_origen AS id_origen, org.origen AS origen, mpn.contenido AS contenido, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, em.estado_material, id_estdis AS id_estdis FROM cambio_estado_detalle AS camed, mat_prima_nacional AS mpn, producto AS p, calibre AS c, origenes AS org, estado_material AS em WHERE camed.foliosmpfsp = mpn.id_mat_prima_nacional and mpn.id_producto = p.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = em.id_estado_material and camed.id_c_es_so = $id_c_es_so order by mpn.id_mat_prima_nacional asc";
$resultn=mysql_query($sqln);
$cuantosn=mysql_num_rows($resultn);
//echo "cuantosn $cuantosn<br>";
	
$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.etiquetados_folios_id AS etiquetados_folios_id, mpi.etiquetados_folios_id_new AS etiquetados_folios_id_new, p.id_producto AS id_producto, p.producto AS producto, c.calibre AS calibre, org.id_origen AS id_origen, org.origen AS origen, mpi.contenido AS contenido, mpi.bidon_num AS bidon_num, mpi.comprobante_num AS comprobante_num, mpi.fecha_ingreso AS fecha_ingreso, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, em.estado_material, camed.id_estdis AS id_estdis FROM cambio_estado_detalle AS camed, mat_prima_importada AS mpi, producto AS p, calibre AS c, origenes AS org, estado_material AS em WHERE camed.foliosmpfsp  = mpi.id_mat_prima_importada and mpi.id_producto = p.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = em.id_estado_material  and camed.id_c_es_so = $id_c_es_so order by mpi.id_mat_prima_importada asc";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);
$cuantostotales= $cuantosn  + $cuantosi;
//echo "cuantosi $cuantosi<br>";
}else{
	
$sqlpt="SELECT ef.id_etiquetados_folios AS id_etiquetados_folios, p.producto AS producto, c.calibre AS calibre, um.unidad_medida AS unidad_medida, mpro.medidas_productos AS medidas_productos, carpro.caract_producto AS caract_producto, carenv.caract_envases AS caract_envases, ef.contenido_unidades AS contenido_unidades, o.nombreop AS nombreop, o.apellido AS apellido, e.estado_folio AS estado_folio, ef.id_cruce_tablas AS id_cruce_tablas, camed.id_estdis AS id_estdis FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mpro, unidad_medida AS um, caract_producto AS carpro, caract_envases AS carenv, operarios AS o, origenes AS orig, estado_folio AS e, cambio_estado_detalle AS camed where camed.foliosmpfsp  = ef.id_etiquetados_folios and ef.id_producto = p.id_producto and ef.id_calibre = c.id_calibre and ef.id_medidas_productos = mpro.id_medidas_productos and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_producto = carpro.id_caract_producto and ef.id_caract_envases = carenv.id_caract_envases and id_cruce_tablas != 0 and ef.id_origen = orig.id_origen and ef.id_operarios=o.id_operarios and ef.id_estado_folio = e.id_estado_folio   ";

if($tic == 2){
$sqlpt.= " and ef.id_estado_folio = 2";	
}

if($tic == 4){
$sqlpt.= " and ef.id_estado_folio = 6";	
}

$sqlpt.= " and camed.id_c_es_so = $id_c_es_so and camed.id_ce = $id_ce  order by ef.id_etiquetados_folios desc";

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
    <td width="10" height="19" bgcolor="#FF9933"><center></center></td>
    <td colspan="10" bgcolor="#CCCCCC"><strong>&nbsp;Bidones: <?echo $cuantostotales?></strong></td>
   
    <td align="center" bgcolor="#CCCCCC"> <? if($tic == 3){?><a href="javascript:Abrir_ventana_nueva('codphp/asignar_mp.php?id_procedencia=<? echo "I";?>&id_producto=<? echo $id_producto?>&id_calibre=<? echo $id_calibre?>&id_origen=<? echo $id_origen?>&unidadessolicitadas=<? echo $unidadessolicitadas?>&id_c_es_so=<? echo $id_c_es_so?>&id_ce=<? echo $id_ce?>&tic=<? echo $tic?>')"><strong>Asignar MPS</strong></a><? }?></td>
    <? if($tic == 2){?>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <? }?>
     <? if($tic == 3){?>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
	<? }?>
      </tr>
  <tr>
    <td width="29" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; FOLIO</strong></td>
    <td width="28" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
    <td width="50" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;N&deg; BIDON</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/IMP</strong></td>
    <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="25" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/FAENA</strong></td>
    <td width="25" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>
    <td width="25" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
    <? if($tic == 3){?>
    <td width="20" align="center" nowrap="nowrap" bgcolor="#FF9933"><input name="eliminar" type="submit" id="eliminar" value="X" /></td>
    <? } ?>
    <? if($tic == 2){?><td width="30" align="center" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;DISPONIBLE</strong></td><? } ?>
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
	$id_mat_prima_importadaa=$rowi[id_mat_prima_importada];
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$etiquetados_folios_id_new=$rowi[etiquetados_folios_id_new];
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
    <td height="8" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><center><? echo $i?></center></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<a href="?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_mat_prima_importada?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>&id_c_es_so=<? echo $id_c_es_so?>&tic=<? echo $tic?>&id_ce=<? echo $id_ce?>">S<? 
$largo=strlen($id_mat_prima_importada);
	if($etiquetados_folios_id != 0)
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
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $rowi[comprobante_num]?></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_elaboracion?></td>
    <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $fecha_vencimiento?></td>
    <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $rowi[estado_material]?></td>
     <? if($tic == 3){?>
    <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><input type="checkbox" name="id_mpi-<? echo $id_mat_prima_importadaa?>" id="id_mpi" value="<? echo $id_mat_prima_importadaa?>" /><input type="hidden" name="id_mpielim-<? echo $id_mat_prima_importadaa?>" id="id_mpielim" value="<? echo $id_mat_prima_importadaa?>" /></td>
    <? } ?>
     <? if($tic == 2){?>
    <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">
    <? 
      $estdis= crea_disponibilidad($link,$id_estdis,$id_mat_prima_importadaa);
      echo $estdis;

   
	   $cuantofoliossi=$cuantofoliossi + $id_estdis;
	   ?>
    
    </td>
    <? }?>
     </tr>
   <? 
     } 
     }
	 
	?>
    <? 
	
	 $totalreal=$totalreal + $cuantofoliossi;
		$totalhay=$totalhay + $cuantosi;
		//echo "totalreal $totalreal / totalhay $totalhay<br>";
	?>
  <tr>
    <td height="19" colspan="4" <? if($tic == 4){?>bgcolor="#FF9900"<? }?>><? if($tic == 4){?><strong>&nbsp;<a href="javascript:Abrir_ventana_nueva('codphp/listar_pt_c_estado.php?id_c_es_so=<? echo $id_c_es_so?>')">Listar  Folios PT Generados por el cambio de estado</a>&nbsp;<!--<a href="codphp/informes_pdf_excel/excel_solicitudmp.php?id_procedencia=<? echo $id_procedencia?>&amp;id_producto=<? echo $id_producto?>&amp;id_origen=<? echo $id_origen?>&amp;comprobante_num=<? echo $comprobante_num?>&amp;bidon_num=<? echo $bidon_num?>&amp;sibidones=<? echo $sibidones?>" target="_blank"><img src="codphp/informes_pdf_excel/excel.png" width="18" height="18" border="0" /></a>--></strong><? }?></td>
    <td height="19" align="right" nowrap="nowrap" bgcolor="#FFFFFF">TOTAL</td>
    <td align="center" nowrap="nowrap" bgcolor="#999999">&nbsp;<strong><? echo $fstotal=$contenidototal+$contenidototali;?></strong></td>
    <td align="center" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="center" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="center" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="center" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="center" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
  
     <td align="center" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>   
     <? if($tic == 2){?>
    <td align="center" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
    <? }?>
     <? if($tic == 3){?>
    <td align="center" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
    <? }?>
    </tr>
      </table>
      <? }else{ ?>
      <table width="100%" border="0">
        <tr>
          <td width="25" height="19" bgcolor="#FF9933"><center>
          </center></td>
          <td colspan="10" bgcolor="#CCCCCC"><strong>&nbsp;Bidones : <?echo $cuantospt?></strong></td>
          <td colspan="3" align="center" bgcolor="#CCCCCC"><? if($tic == 3){?><a href="javascript:Abrir_ventana_nueva('codphp/asignar_pt.php?id_procedencia=<? echo "N";?>&id_producto=<? echo $id_producto?>&id_calibre=<? echo $id_calibre?>&id_origen=<? echo $id_origen?>&unidadessolicitadas=<? echo $unidadessolicitadas?>&id_c_es_so=<? echo $id_c_es_so?>&id_ce=<? echo $id_ce?>&tic=<? echo $tic?>')"><strong>Asignar PT</strong></a><? }?></td>
        </tr>
        <tr>
          <td width="25" height="19" nowrap="nowrap" bgcolor="#FF9933"><center>
            <strong>&nbsp;N&ordm;</strong>
          </center></td>
          <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;FOLIO PT</strong></td>
          <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;COD</strong></td>
          <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PRODUCTO</strong></td>
          <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CALIBRE</strong></td>
          <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;&nbsp;U/MEDIDA</strong></td>
          <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;MEDIDAS</strong></td>
          <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/PRO</strong></td>
          <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;C/ENV</strong></td>
          <td width="25" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CONTENIDO</strong></td>
          <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;OPERARDOR</strong></td>
          <td width="30" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
           <? if($tic == 3){?>
          <td width="30" align="center" nowrap="nowrap" bgcolor="#FF9933"><input name="eliminar2" type="submit" id="eliminar2" value="X" /></td>
          <? } ?>
           <? if($tic != 4){?>
           <td width="30" align="center" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;DISPONIBLE</strong></td>
           <? }?>
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
          <td height="8" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $i?></td>
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
          <td width="25" align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo $contenido_unidadespt ?></td>
          <td nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;<? echo "$nom $apell"?></td>
          <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>">&nbsp;
            <? $est = strtoupper($estado_folio); echo $est ?>
          &nbsp;</td>
         <? if($tic == 3){?>
          <td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><input type="checkbox" name="id_pt-<? echo $id_etiquetados_foliospt?>" id="id_pt" value="<? echo $id_etiquetados_foliospt?>" /></td>
          <? } ?>
        
          <? if($tic != 4){?><td align="center" nowrap="nowrap" bgcolor="<? if($id_estdis == 1){ echo "#00CC33";}else{ echo "$color";}?>"><? 
	   //echo $id_estdis;
	   
	   $estdis= crea_disponibilidad($link,$id_estdis,$id_etiquetados_foliospt);
	   echo $estdis;
	    $cuantofoliospt=$cuantofoliospt + $id_estdis;
	 
	   ?></td>
       <? }?>
       
        </tr>
        <?
		 
		}//   while ($rowpt=mysql_fetch_array($resultpt))
	} //if($cuantospt){
		
	 $totalreal=$totalreal + $cuantofoliospt;
		$totalhay=$totalhay + $cuantospt;
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
          <td width="30" align="center" nowrap="nowrap" bgcolor="#999999">&nbsp;<? echo $contenidototalpt?></td>
          <td nowrap="nowrap">&nbsp;</td>
          <td nowrap="nowrap">&nbsp;</td>
           <? if($tic == 3){?><td nowrap="nowrap">&nbsp;</td><? }?>
           <? if($tic != 4){?> <td nowrap="nowrap">&nbsp;</td><? }?>
        </tr>
      </table>
      <? }?>
      </td>
    </tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
  
    <tr>
   <td colspan="8" align="right">
   <? if($tic == 2){?>
   Indicar la disponibilidad de folios solicitados (SI/NO)     <input type="submit" name="actualizar" id="actualizar" value="Actualizar disponibilidad" />
   <? } ?></td>
  </tr>
    <tr>
      <td colspan="8" align="right">
     <? 
	// echo "$totalreal - $totalhay";
	 if($totalreal == $totalhay and $tic == 2){	?>
      <?  if($fechainformar != '00-00-0000'){?>        
	Solicitud informada a Comercial con fecha <? echo $fechainformar?>
<? }else{?>
      Informar a Comercial que se encuentra lista la solicitud 
      <input type="checkbox" value="acepto" onclick="document.form1.enviar_scmp.disabled=!document.form1.enviar_scmp.disabled" />
<input type="submit" name="enviar_scmp" id="enviar_scmp" value="Informar" disabled /><? } ?>
<? } ?>
</td>
    </tr>
    <tr>
      <td colspan="8" align="right">
      <? 
	 	  if($tic == 2){
	  
	  
	  if($totalreal != $totalhay){?>Rechazar solicitud de Comercial
	  <input type="checkbox" value="fecharechazo" onclick="document.form1.fecharechazo.disabled=!document.form1.fecharechazo.disabled" />
      <input type="submit" name="fecharechazo" id="fecharechazo" value="Informar" disabled />
      <? }
	  
	  }?>
      
      </td>
    </tr>
    <tr>
      <td colspan="8" align="right">
      <? if($tic == 3){?>
      Reenviar solicitud a Bodega
      <input type="checkbox" value="esabodega" onclick="document.form1.esabodega.disabled=!document.form1.esabodega.disabled" />
<input type="submit" name="esabodega" id="esabodega" value="Enviar"  disabled />
	<? } ?>
</td>
    </tr>
    <tr>
      <td colspan="8" align="right">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8" align="right">
      <? 
	  //echo "totalreal $totalreal totalhay $totalhay";
	  if($totalreal == $totalhay and $fechainformar != '00-00-0000' and $tic == 2){
	  if($id_ce == 1){?>
      <input type="submit" name="cambio_estado_mp_pt" id="cambio_estado_mp_pt" value="Proceder con el cambio de estado MP -&gt; PT" />
      <? }else{?>
      <!--<input type="submit" name="cambio_estado_pt_rep" id="cambio_estado_pt_rep" value="Proceder con el cambio de estado Reprocesado - &gt; PT" />-->
      <input type="submit" name="cambio_estado_rep" id="cambio_estado_rep" value="Proceder con el cambio de estado Reprocesado" />
      <? }
	   }?>
      </td>
    </tr>
    <tr>
      <td colspan="8" align="right">
      <?
	  if($tic == 3){
	  if($id_ce == 1){?>
      <input type="submit" name="anular_cemp" id="anular_cemp" value="Anular solicitud de cambio de estado MP -&gt; PT" />
      <? } 
	  }
	    if($tic == 3 and $id_ce == 3){
	  ?>
	  
	   
      <input type="submit" name="anular_cerep" id="anular_cerep" value="Eliminar solicitud de cambio de estado Reprocesado" />
      <br>
      La opcion eliminar enviara todos los folios correspondientes a la Solicitud N&deg; <? echo $id_c_es_so?> a Bodega de Producto Terminado
      <? }// if($tic == 3){ ?>
      </td>
    </tr>
    <tr>
      <td colspan="8" align="right">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8" align="right">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8" align="right">&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="8"> 
       <? if(id_ce == 1){?><br>
     
       Nota: Para proceder con el cambio de estado el bodeguero debe informar la disponibilidad de la Materia Prima<? }else{ ?>
	   Nota: Para proceder con el cambio de estado el bodeguero debe informar la disponibilidad del Producto Terminado
	   <? } ?></td>
  </tr>
    <tr>
      <td colspan="8"><a href="#" onclick="cambiar('error'); return false;">INGRESAR OBSERVACIONES</a></td>
  </tr>
    <tr>
      <td colspan="8">
      <div id="error" style="display: none;"><center><textarea name="observacionesces" id="observacionesces" cols="80" rows="5"><? echo $observacionesces?></textarea></center>&nbsp;&nbsp;&nbsp;<center><input type="submit" name="guardarcomentarios" id="guardarcomentarios" value="Guardar Observaciones" /></center></div></td>
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