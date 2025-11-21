<?
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";
include ('class.ezpdf.php');
require('folio_code39.php');
// $pdf = new Cezpdf('LETTER');
$pdf = new Cezpdf('LETTER','landscape');


$sqldes="SELECT * from destinos where id_destinos = $id_destinos";
$restdes=mysql_query($sqldes);
while ($rdes=mysql_fetch_array($restdes)){ 
$direccion=$rdes[domicilio];	
$ciudad=$rdes[ciudad];	
$destinos=$rdes[destinos];
$pais=$rdes[pais];
 //echo $pais;
}
$query1= "select count(id_etiquetados_folios) as total from paking where id_paking_relacion= $id_paking_relacion";
$rquery1=mysql_query($query1);
$row=mysql_fetch_array($rquery1);
$count=$row[total];

$pdf->selectFont('/fonts/Helvetica.afm');
//$pdf->ezText("<b> PROCESADORA INSUBAN SPA</b>", 14);
$pdf->ezImage("logo.png", 0, 100, 'none', 'left');
$pdf->ezText('_______________________________________________________________________________________________________________________________________________________________________________________________', 5);
//$pdf->ezText('', 9);
$pdf->ezText("<b>EXPEDIDOR:</b> PROCESADORA INSUBAN SPA                               <b>DESTINATARIO:</b> $destinos ",9);
//muestra destino

$pdf->ezText("<b>DIRECCION:</b> ANTILLANCA NORTE 391 PUDAHUEL                      <b>DIRECCION:</b> $direccion $ciudad  ",9);
$pdf->ezText("<b>R.U.T.:</b> 78.730.890-2                                                                          <b>R.U.T.: </b>",9);
$pdf->ezText("<b>FONO:</b> (562) 739.23.77                                                                      <b>FONO: </b>",9);																		
$pdf->ezText('_______________________________________________________________________________________________________________________________________________________________________________________________', 5);
$pdf->ezText("<b>FACTURA:</b> $factura",9);
$pdf->ezText("<b>NOMBRE DEL TRANSPORTE:</b>                                                         <b>N0 BIDONES:</b> $count ",9);
$pdf->ezText("<b>PUERTO DE EMBARQUE:</b>                                                                <b>PESO NETO:</b> ",9);
$pdf->ezText("<b>PUERTO DESTINO:</b>                                                                           <b>PESO BRUTO:</b> ",9);
if ($id_destinos=210) {
	$pdf->ezText("<b>N0 CONTENEDOR:</b> ",9);
}else{
	$pdf->ezText("<b>PATENTES:</b> ",9);
}
//$pdf->ezText("<b>DESTINOS: $destinos</b>",8);
//muestra cantidad
//$pdf->ezText("<b>CANTIDAD: $cantifo</b>",8);



$pdf->ezText('', 20);

//if(strtoupper(trim($pais))=="australia"){  //unicio If

if(trim($pais)=="Australia"){  //unicio If

		$id_paking_relacion=$id_paking_relacion;
				$sql="SELECT ef.nombre_alt, ef.calibre_alt , ef.folio_m3 , ef.contenido_unidades , ef.id_etiquetados_folios AS id_etiquetados_folios,(select min(mn.fecha_faena) from folios_mat as fm, mat_prima_nacional as mn where fm.id_etiquetados_folios = ef.id_etiquetados_folios and mn.id_mat_prima_nacional = fm.id_mat) as faena_fecha_inicio,(select max(mn.fecha_termino) from folios_mat as fm, mat_prima_nacional as mn where fm.id_etiquetados_folios = ef.id_etiquetados_folios and mn.id_mat_prima_nacional = fm.id_mat) as faena_fecha_termino,ef.f_inicio AS f_inicio,ef.f_termino AS f_termino,ef.f_vencimiento AS f_vencimiento FROM paking AS p,  etiquetados_folios As ef where p.id_paking_relacion= $id_paking_relacion and p.id_etiquetados_folios= ef.id_etiquetados_folios order by ef.nombre_alt, ef.calibre_alt, ef.id_etiquetados_folios asc";
		
		/*
		$id_paking_relacion=$id_paking_relacion;
				$sql="SELECT ef.f_elaboracion AS f_elaboracion, ef.f_inicio AS f_inicio, ef.f_termino AS f_termino, ef.f_vencimiento AS f_vencimiento,  ef.id_etiquetados_folios AS id_etiquetados_folios FROM paking AS p, etiquetados_folios As ef where p.id_paking_relacion=$id_paking_relacion and p.id_etiquetados_folios= ef.id_etiquetados_folios order by ef.nombre_alt, ef.calibre_alt, ef.id_etiquetados_folios asc";
		*/
				$rest=mysql_query($sql);
				$cuantos=mysql_num_rows($rest);
		 
				 if($cuantos){
				   while ($r=mysql_fetch_array($rest)){ 
					$i++;
					//$f_elaboracion =format_fecha_sin_hora($r[f_elaboracion]);
					$f_faena_ini =format_fecha_sin_hora($r[faena_fecha_inicio]);
					$f_faena_fin =format_fecha_sin_hora($r[faena_fecha_termino]);
					$f_inicio =format_fecha_sin_hora($r[f_inicio]);
					$f_termino =format_fecha_sin_hora($r[f_termino]);
					$f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
					$id_etiquetados_folios=$r[id_etiquetados_folios];
					$contenido=$r[contenido_unidades];
					$nalt=$r[nombre_alt]; 					 					 
					$calt=$r[calibre_alt];
					$folio_m3=$r[folio_m3]; 					 					

				
					$data[] = array('id'=>$i, 'nf'=>$contenido, 'fs'=>$folio_m3,'fss'=>$nalt);
					
					$titles = array('id'=>'<b>N0</b>', 'nf'=>'<b>CANTIDAD</b>', 'fs'=>'<b>LOTE</b>','fss'=>'<b>DETALLE MERCADERIA</b>');
				
						
				   }//while ($r=mysql_fetch_array($rest)){ 
				
				   $pdf->ezTable($data,$titles,'',$options);
				 }// if($cuantos){
		
		//$pdf->ezText("\n\n\n",10);
		//$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
		//$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n",10);
		//$pdf = new ezNewPage('A4');
		
		if($cantifo == 47 or $cantifo == 48 or $cantifo == 49 or $cantifo == 50 or $cantifo == 51 or $cantifo == 52 or $cantifo == 53 or $cantifo == 54 or $cantifo == 55){
		$salt=130;
		}

		 } //Fin If
		 
if(trim($pais) != "Australia"){  //inicio If

$id_paking_relacion=$id_paking_relacion;
// Modificado: 30-04-2015   IET
// se agrega tabla producto en la Qry, solicitado por Lorena Anfruz

$sql="SELECT ef.nombre_alt, ef.calibre_alt , ef.folio_m3 , ef.contenido_unidades, ef.f_elaboracion AS f_elaboracion, ef.f_inicio AS f_inicio, ef.f_termino AS f_termino, ef.f_vencimiento AS f_vencimiento,
ef.id_etiquetados_folios AS id_etiquetados_folios, ef.id_producto, prd.Producto , mdp.medidas_productos, pdt.venta
FROM paking AS p
left outer join etiquetados_folios As ef on p.id_etiquetados_folios= ef.id_etiquetados_folios
left outer join producto As prd on ef.id_producto = prd.id_producto
left outer join medidas_productos as mdp on ef.id_medidas_productos = mdp.id_medidas_productos
left outer join pedido_tabla as pdt on ef.id_pedidos = pdt.id_pedidos 
where p.id_paking_relacion=$id_paking_relacion
group by p.id_etiquetados_folios 
order by ef.nombre_alt, ef.calibre_alt, ef.id_etiquetados_folios";

//     IET 28-07-2015   folio 230 y 231
//$sql="SELECT 
//(CASE ef.pallet WHEN 230 THEN str_to_date('15/07/15','%d/%m/%y') 
//                WHEN 231 THEN str_to_date('16/07/15','%d/%m/%y') ELSE ef.f_elaboracion END) as f_elaboracion,
//(CASE ef.pallet WHEN 230 THEN str_to_date('21/07/15','%d/%m/%y')
//                WHEN 231 THEN str_to_date('22/07/15','%d/%m/%y') ELSE ef.f_inicio END) as f_inicio,
//(CASE ef.pallet WHEN 230 THEN str_to_date('21/07/15','%d/%m/%y') 
//                WHEN 231 THEN str_to_date('22/07/15','%d/%m/%y') ELSE ef.f_termino END) as f_termino,                
//(CASE ef.pallet WHEN 230 THEN str_to_date('21/07/17','%d/%m/%y') 
//                WHEN 231 THEN str_to_date('22/07/17','%d/%m/%y') ELSE ef.f_vencimiento END) as f_vencimiento,
//  ef.id_etiquetados_folios AS id_etiquetados_folios, ef.id_producto, Prd.Producto 
//FROM paking AS p, etiquetados_folios As ef, producto As Prd 
//where p.id_paking_relacion=$id_paking_relacion
//and p.id_etiquetados_folios= ef.id_etiquetados_folios 
//and ef.id_producto = Prd.id_producto 
//order by ef.nombre_alt, ef.calibre_alt, ef.id_etiquetados_folios asc
//";


		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 
     	 if($cuantos){
		   while ($r=mysql_fetch_array($rest)){ 
			$i++;
			$f_elaboracion =format_fecha_sin_hora($r[f_elaboracion]);
			$f_inicio =format_fecha_sin_hora($r[f_inicio]);
			$f_termino =format_fecha_sin_hora($r[f_termino]);
			$f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
	        $id_etiquetados_folios=$r[id_etiquetados_folios];
			$contenido=$r[contenido_unidades];
			$nalt=$r[nombre_alt]; 					 					 
			$calt=$r[calibre_alt];
			$folio_m3=$r[folio_m3];			 		         
			// Se agrega linea el 30-04-2015  IET 
		    $DescProducto = $r[Producto];
			$mdp = $r[medidas_productos];
			$contenido2=$contenido2 + $contenido;
			$contenido2_f = number_format($contenido2, 0, ',', '.');
			$venta = $r[venta];
			$venta2 = number_format($venta, 2, ',', ',');
			$tot_vent= $venta * $contenido2;
			$tot_vent_f= number_format($tot_vent, 2, ',', '.'); 					    
		    //$data[] = array('id'=>$i, 'nf'=>$id_etiquetados_folios, 'fs'=>$f_elaboracion, 'fi'=>$f_inicio, 'ft'=>$f_termino, 'fv'=>$f_vencimiento);

			
					$data[] = array('id'=>$i, 'nf'=>$contenido, 'fs'=>$folio_m3,'fss'=>$nalt." ".$calt." ".$mdp);
					
					$titles = array('id'=>'<b>N0</b>', 'nf'=>'<b>CANTIDAD</b>', 'fs'=>'<b>LOTE</b>','fss'=>'<b>DETALLE MERCADERIA</b>');
		
				
		   }//while ($r=mysql_fetch_array($rest)){ 

$options = array('xOrientation' => 'left');
		
		   $pdf->ezTable($data,$titles,'',$options);
		 }// if($cuantos){

//$pdf->ezText("\n\n\n",10);
//$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
//$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n",10);
//$pdf = new ezNewPage('A4');

if($cantifo == 47 or $cantifo == 48 or $cantifo == 49 or $cantifo == 50 or $cantifo == 51 or $cantifo == 52 or $cantifo == 53 or $cantifo == 54 or $cantifo == 55){
$salt=130;
}

} //Fin If   


if($cantifo == 47 or $cantifo == 48 or $cantifo == 49 or $cantifo == 50 or $cantifo == 51 or $cantifo == 52 or $cantifo == 53 or $cantifo == 54 or $cantifo == 55){
$pdf->ezText('', $salt);
$pdf->ezText('PROCESADORA INSUBAN SPA', 11);
$pdf->ezText('_______________________________________________________________________________________________________________________________________________________________________________________________', 5);
$pdf->ezText('', 12);
}
$pdf->ezText('_______________________________________________________________________________________________________________________________________________________________________________________________', 5);
$pdf->ezText('_______________________________________________________________________________________________________________________________________________________________________________________________', 5);
$pdf->ezText('', 9);
$pdf->ezText("<b>RESUMEN DE ENVIO</b>",8);
$pdf->ezText('', 9);

if ($id_destinos=210) {
	
$sql1="SELECT count(etf.id_cruce_tablas) as BID, sum(etf.contenido_unidades) as CANTIDAD, etf.id_cruce_tablas as COD, etf.nombre_alt as NOMBRE, etf.calibre_alt as CALIBRE, mdp.medidas_productos as PRODUCTO
FROM paking as p
left outer join etiquetados_folios as etf on p.id_etiquetados_folios=etf.id_etiquetados_folios
left outer join medidas_productos as mdp on etf.id_medidas_productos = mdp.id_medidas_productos
where p.id_paking_relacion=$id_paking_relacion
group by etf.id_cruce_tablas order by CALIBRE";

	$rest1=mysql_query($sql1);

	while ($r1=mysql_fetch_array($rest1)){ 
	        $BID=$r1[BID];
	        $BID_S=$BID_S+$BID;
			$CANTIDAD=$r1[CANTIDAD];
			$CANTIDAD_S=$CANTIDAD_S+$CANTIDAD;
			$CANTIDAD_S_f=number_format($CANTIDAD_S, 0, ',', '.');
			$CANTIDAD_f=number_format($CANTIDAD, 0, ',', '.');
			$COD=$r1[COD]; 					 					 
			$NOMBRE=$r1[NOMBRE];
			$CALIBRE=$r1[CALIBRE];			 		         
		    $PRODUCTO = $r1[PRODUCTO];
		    $VENTA = $r1[VENTA];		    

/*
			$contenido2=$contenido2 + $contenido;
			$contenido2_f = number_format($contenido2, 0, ',', '.');
			$venta = $r1[venta];
			$venta2 = number_format($venta, 2, ',', ',');
			$tot_vent= $venta * $contenido2;
			$tot_vent_f= number_format($tot_vent, 2, ',', '.'); 					    
*/

			$titles1 = array('bid1'=>'<b>BID</b>', 'ct1'=>'<b>CANTIDAD</b>', 'co1'=>'<b>COD</b>', 'ds1'=>'<b>DESCRIPCION</b>','pr1'=>'<b>PRECIO</b>','to1'=>'<b>TOTAL</b>');			

			$data1[] = array('bid1'=>$BID, 'ct1'=>$CANTIDAD_f, 'co1'=>$COD,'ds1'=>$NOMBRE." ".$CALIBRE." ".$PRODUCTO);	
					
		   }//while 		
// separador
	   $data1[] = array('bid1'=>$VENTA);
	   $data1[] = array('bid1'=>$VENTA);
//separador
		  $data1[] = array('bid1'=>$BID_S,'ct1'=>$CANTIDAD_S_f);	
		  
		  $pdf->ezTable($data1,$titles1,'',$optionss);

}else{

	$titles2 = array('bid'=>'<b>BIDONES</b>', 'ct'=>'<b>CANTIDAD</b>', 'dm'=>'<b>DESCRIPCION DE LA MERCADERIA</b>','dl'=>'<b>DOLARES</b>','dl2'=>'<b>DOLARES</b>');
	$data2[] = array('bid'=>$count, 'ct'=>$contenido2_f, 'dm'=>$nalt." ".$calt." ".$mdp, 'dl'=>$venta2, 'dl2'=>$tot_vent_f);
	$pdf->ezTable($data2,$titles2,'',$options);
	$pdf->ezText('', 9);
	$pdf->ezText('', 9);
$pdf->ezText("<b>$count BIDONES                                                                                                                 TOTAL EN DOLARES:        $tot_vent_f </b>",8);
$pdf->ezText('', 9);
$pdf->ezText("<b>NOTA:            BIDONES SOMETIDOS A TRATAMIENTO DE DESCONTAMINACION N0 565/2006/CGPE/DIPOA, POR UNA CONCENTRACION DE</b>", 8);
$pdf->ezText("<b>                       80 ppm DE CLORO LIVRE COM TEMPO DE CONTATO DE, NO MINIMO, 2 HORAS</b>", 8);
}

//**********************************************************************MPN
$sql_buscar="SELECT  orig.origen AS origen 
FROM paking AS p, etiquetados_folios AS ef, folios_mat AS fm, mat_prima_nacional AS mpn, origenes AS orig
WHERE p.id_paking_relacion = $id_paking_relacion
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
AND ef.id_etiquetados_folios = fm.id_etiquetados_folios
AND fm.id_mat = mpn.id_mat_prima_nacional
AND mpn.id_origen = orig.id_origen 
group by orig.origen";
	$result_buscar=mysql_query($sql_buscar);
    $cuantos_orig=mysql_num_rows($result_buscar);
	
while ($rdes=mysql_fetch_array($result_buscar)){ 
       $origeness=$rdes[origen];
//	   $pdf->ezText("- $origeness",9);	
}
//**********************************************************************MPN
//**********************************************************************MPI
	$sql_buscar="SELECT orig.origen AS origen 
FROM paking AS p, etiquetados_folios AS ef, folios_mat AS fm, mat_prima_importada AS mpn, origenes AS orig
WHERE p.id_paking_relacion = $id_paking_relacion
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
AND ef.id_etiquetados_folios = fm.id_etiquetados_folios
AND fm.id_mat = mpn.id_mat_prima_importada
AND mpn.id_origen = orig.id_origen 
group by orig.origen";
	$result_buscar=mysql_query($sql_buscar);
    $cuantos_orig=mysql_num_rows($result_buscar);
if($cuantos_orig){
//  $pdf->ezText("- Importado",9);   // el sistema imprimia todos los origenes, con esto solo imprimira la gloasa 1 vez, independiente de la cantidad de origenes que este tenga   IET Solicita lanfrunz el 30-04-2015
}
  	
//while ($rdes=mysql_fetch_array($result_buscar)){ 
//       $origeness3=$rdes[origen];
//	   $pdf->ezText("- $origeness3 (Importado)",9);	
// }
// }
//**********************************************************************MPI

/*$sql_buscar2="SELECT orig.origen AS origen 
FROM paking AS p, etiquetados_folios AS ef, origenes AS orig, procedencia AS proc
WHERE p.id_paking_relacion = $id_paking_relacion
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
AND ef.id_origen = orig.id_origen 
AND proc.id_procedencia = 'I'
group by orig.origen desc";
	$result_buscar2=mysql_query($sql_buscar2);
    $cuantos_orig2=mysql_num_rows($result_buscar2);
	//echo "cuantos_orig2  $cuantos_orig2<br><br>";
if($cuantos_orig2){	
while ($rdes2=mysql_fetch_array($result_buscar2)){ 
       $origeness2=$rdes2[origen];
	   $pdf->ezText("- $origeness2 (Importado) $cuantos_orig2",9);
$pdf->ezText('', 1);
}
}//if($cuantos_orig2){	*/

$sql_firma="SELECT * FROM usuarios WHERE id_usuario = $id and firma = 1";
$result_firma=mysql_query($sql_firma);
$firma=mysql_num_rows($result_firma);
if($firma){
while ($rowfirma=mysql_fetch_array($result_firma)){ 
$unombre=$rowfirma[unombre]; 
$uapellido=$rowfirma[uapellido];
}
//$pdf->ezText('', 20);
//$pdf->ezText("                                                                                     <b>$unombre $uapellido</b>",10);	
//$pdf->ezText('                                                                                                                                 ____________________________________________________________________________', 5);              
//$pdf->ezText("                                                                  <b>Firma autorizada que avala esta certifícación</b>",10);	
}



$pdf->ezStream();

/*
define('FPDF_FONTPATH','fontscode39/');
require('code39.php');
$pdf=new PDF_Code39('P','mm',array(100,100));
$pdf->AddPage('P',array(0,0));
$pdf->Rect(2,2,95,95); //rectangulo grande
$pdf->Code39(20,10,"66667788",1,12);
$pdf->Output();
*/

?>