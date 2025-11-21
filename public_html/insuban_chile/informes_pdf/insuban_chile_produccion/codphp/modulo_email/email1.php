<?    
	/*  if($id_ultimo ){ $solicitudn= $id_ultimo; }
	  if($id_solicitud_mp){	$solicitudn= $id_solicitud_mp; }
	
      $email = "$email";	  
	  // cabeceras del modulo de produccion
	  if($envio_solicitud){
	  $asunto = "Solicitud creada Nº [$solicitudn] por Produccion";
	  $datos_cuerpo="Se a generado una nueva solicitud de produccion \n\n Se requiere revisar \n";
	  }
	  if($informar_solicitud){
	  $asunto = "Solicitud Terminada Nº [$solicitudn] por Bodega";
	  $datos_cuerpo="Bodega informa que se encuentra terminada la solicitud \n\n Se requiere revisar \n";
	  }
	  
	  if($recepcionar_solicitud){
	  $asunto = "Solicitud Recepcionada Nº [$solicitudn] por produccion";
	  $datos_cuerpo="Produccion acepta los bidones entregado por bodega \n\n Se requiere revisar \n";
	  }
	  // fin de cabeceras del modulo de produccion
	  // cabeceras del modulo de cambio estado
	  
	  if($envio_solicitud_cambio_estado){
	  $asunto = "Solicitud de cambio estado Nº [$solicitudn] creada por comercial";
	  $datos_cuerpo="Se a generado cambio de estado por parte de comercial \n\n Se requiere revisar \n";
	  }
	  if($anulacion_solicitud_cambio_estado){
	  $asunto = "Solicitud de cambio estado Nº [$id_c_es_so] anulada por comercial";
	  $datos_cuerpo="Se a generado la anulacion de la solicitud Nº [$id_c_es_so] por parte de comercial \n";
	  }
	  if($actualizar_solicitud_solicitud_cambio_estado){
	  $asunto = "Solicitud de cambio estado Nº [$id_c_es_so] aceptada por bodega";
	  $datos_cuerpo="Bodega informa disponivibilidad de la solicitud Nº [$id_c_es_so] por parte de comercial \n";
	  }
	  // fin cabeceras del modulo de cambio estado
	  
	  $destinatario = "pedrovelasquez@gmail.com";
	  //$administrador .= "Nº Folio: $id_etiquetados_folioscorre - $estado_foliocorreo \n ";
	  $cuerpo .= "$datos_cuerpo";
	  $cuerpo .= "\n\n No responder correo ya que fue generado automaticamente por el sistema ";
	  mail("$destinatario", "$asunto", $cuerpo, "From: $email");*/
?>