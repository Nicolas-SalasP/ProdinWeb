<?
ini_set('memory_limit', '-1');
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";
include ('class.ezpdf.php');
require('folio_code39.php');
$pdf = new Cezpdf('A4');


$pdf->selectFont('/fonts/Helvetica.afm');
$pdf->ezText('PROCESADORA INSUBAN SPA', 11);
$pdf->ezText('_______________________________________________________________________________________________________________________________________________________________________________________________', 5);
$pdf->ezText('', 12);
$pdf->ezText("<b>DEPTO. ASEG. CALIDAD</b>",8);
//muestra destino
$sqldes="SELECT * from destinos where id_destinos = $id_destinos";
$restdes=mysql_query($sqldes);
while ($rdes=mysql_fetch_array($restdes)){ 
 $destinos=$rdes[destinos];
 $pais=$rdes[pais];
 //echo $pais;
}
$pdf->ezText("<b>DESTINOS: $destinos</b>",8);
//muestra cantidad
$pdf->ezText("<b>CANTIDAD: $cantifo</b>",8);
//$pdf->ezText("<b>CANTIDAD: 80</b>",8);
$pdf->ezText("<b>FACTURA: $factura</b>",8);


$pdf->ezText('', 20);

//if(strtoupper(trim($pais))=="australia"){  //unicio If

if(trim($pais)=="Australia"){  //unicio If

		$id_paking_relacion=$id_paking_relacion;
				$sql="SELECT ef.folio_m3 as folio_m3, ef.id_etiquetados_folios AS id_etiquetados_folios,(select min(mn.fecha_faena) from folios_mat as fm, mat_prima_nacional as mn where fm.id_etiquetados_folios = ef.id_etiquetados_folios and mn.id_mat_prima_nacional = fm.id_mat) as faena_fecha_inicio,(select max(mn.fecha_termino) from folios_mat as fm, mat_prima_nacional as mn where fm.id_etiquetados_folios = ef.id_etiquetados_folios and mn.id_mat_prima_nacional = fm.id_mat) as faena_fecha_termino,ef.f_inicio AS f_inicio,ef.f_termino AS f_termino,ef.f_vencimiento AS f_vencimiento FROM paking AS p,  etiquetados_folios As ef where p.id_paking_relacion= $id_paking_relacion and p.id_etiquetados_folios= ef.id_etiquetados_folios order by ef.nombre_alt, ef.calibre_alt, ef.id_etiquetados_folios asc";
		
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
					$folio_m3=$r[folio_m3]; 
					
				
					$data[] = array('id'=>$i, 'nf'=>$folio_m3, 'fs'=>$f_faena_ini,'fss'=>$f_faena_fin, 'fi'=>$f_inicio, 'ft'=>$f_termino, 'fv'=>$f_vencimiento);
					
					$titles = array('id'=>'<b>ID</b>', 'nf'=>'<b>N° FOLIO</b>', 'fs'=>'<b>FECHA FAENA INICIAL</b>','fss'=>'<b>FECHA FAENA FINAL</b>', 'fi'=>'<b>FECHA INICIO</b>','ft'=>'<b>FECHA TERMINO</b>','fv'=>'<b>FECHA VENCIMIENTO</b>');
				
						
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
		 
if(trim($pais) != "Australia"){  //unicio If

$id_paking_relacion=$id_paking_relacion;
// Modificado: 30-04-2015   IET
// se agrega tabla producto en la Qry, solicitado por Lorena Anfruz
/*
				$sql="SELECT ef.f_elaboracion AS f_elaboracion, ef.f_inicio AS f_inicio, ef.f_termino AS f_termino, ef.f_vencimiento AS f_vencimiento,
				ef.folio_m3 as folio_m3 ,ef.id_etiquetados_folios AS id_etiquetados_folios, ef.id_producto, Prd.Producto FROM paking AS p, etiquetados_folios As ef, producto As Prd 
				where p.id_paking_relacion in (157070,157047)
				 and p.id_etiquetados_folios= ef.id_etiquetados_folios and ef.id_producto = Prd.id_producto 
				 order by p.folio_piking desc, ef.nombre_alt, ef.calibre_alt, ef.id_etiquetados_folios asc";
*/
/* query anterior
				$sql="SELECT ef.f_elaboracion AS f_elaboracion, ef.f_inicio AS f_inicio, ef.f_termino AS f_termino, ef.f_vencimiento AS f_vencimiento,
				ef.folio_m3 as folio_m3 ,ef.id_etiquetados_folios AS id_etiquetados_folios, ef.id_producto, Prd.Producto 
                FROM paking AS p, etiquetados_folios As ef, producto As Prd 
                where p.id_paking_relacion = $id_paking_relacion
                and p.id_etiquetados_folios= ef.id_etiquetados_folios 
                and ef.id_producto = Prd.id_producto 
                order by ef.id_etiquetados_folios asc";
*/

/* se agrega esta query */

		$sql="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, caract_producto cpro where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	ef.id_caract_producto = cpro.id_caract_producto
/*		and	ef.id_caract_producto not in (25,30)  **MODIFICACION PALLET ** */
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios  
/*  order by ef.nombre_alt, ef.calibre_alt, ef.id_cruce_tablas, ef.id_etiquetados_folios asc	*/
order by ef.nombre_alt, ef.calibre_alt, ef.id_etiquetados_folios asc";



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
	        $folio_m3=$r[folio_m3]; 


//se agrega esta condicion 30/07/2019 se reduce a un año brc, frimesa ,zafe y pamplona

 if ($id_destinos == 14 or $id_destinos == 312 ) {

 		$mess=split(" ",$r[f_vencimiento]);
 		  $mess=split("-",$mess[0]);
          $mess[2]-$mess[1]-$mess[0];
  		  $dat10=$mess[2];          
  		  $dat11=$mess[1];
  		  $dat22=$mess[0];
  		  
  		  $dat33="$dat10" . "-" . "$dat11" . "-" . "$dat22";

} elseif (($id_destinos == 331 or $id_destinos == 324 or $id_destinos == 352 or $id_destinos == 351 or $id_destinos == 358 or $id_destinos == 253 or $id_destinos == 361 or $id_destinos == 372 or $id_destinos == 341 or $id_destinos == 178 )) {

	$mess=split(" ",$r[f_elaboracion]);
 		  $mess=split("-",$mess[0]);
          $mess[2]-$mess[1]-$mess[0];
  		  $dat10=$mess[2];          
  		  $dat11=$mess[1];
  		  $dat22=$mess[0] + 2;
  		  
  		  $dat33="$dat10" . "-" . "$dat11" . "-" . "$dat22";
}else {

	$dat33=$f_vencimiento;
}


			// Se agrega linea el 30-04-2015  IET 
		    $DescProducto = $r[producto];
		    //$data[] = array('id'=>$i, 'nf'=>$id_etiquetados_folios, 'fs'=>$f_elaboracion, 'fi'=>$f_inicio, 'ft'=>$f_termino, 'fv'=>$f_vencimiento);
			$data[] = array('id'=>$i, 'nf'=>$folio_m3, 'dp'=>$DescProducto,'fs'=>$f_elaboracion, 'fi'=>$f_inicio, 'ft'=>$f_termino, 'fv'=>$dat33);
			
			$titles = array('id'=>'<b>ID</b>', 'nf'=>'<b>N° FOLIO</b>', 'dp'=>'<b>PRODUCTO</b>','fs'=>'<b>FECHA PRODUCCIÓN </b>', 'fi'=>'<b>FECHA INICIO</b>','ft'=>'<b>FECHA TERMINO</b>','fv'=>'<b>FECHA VENCIMIENTO</b>');
		
				
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



if($cantifo == 47 or $cantifo == 48 or $cantifo == 49 or $cantifo == 50 or $cantifo == 51 or $cantifo == 52 or $cantifo == 53 or $cantifo == 54 or $cantifo == 55){
$pdf->ezText('', $salt);
$pdf->ezText('PROCESADORA INSUBAN SPA', 11);
$pdf->ezText('_______________________________________________________________________________________________________________________________________________________________________________________________', 5);
$pdf->ezText('', 12);
}
$pdf->ezText('', 10);
$pdf->ezText("<b>Material provenientes de las plantas: </b>",10);
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
	   $pdf->ezText("- $origeness",9);	
}
//**********************************************************************MPN


//**********************************************************************MPI
	$sql_buscar="SELECT orig.origen AS origen 
FROM paking AS p, etiquetados_folios AS ef, folios_mat AS fm, mat_prima_importada AS mpi, origenes AS orig
WHERE p.id_paking_relacion = $id_paking_relacion
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
AND ef.id_etiquetados_folios = fm.id_etiquetados_folios
AND fm.id_mat = mpi.id_mat_prima_importada
AND mpi.id_origen = orig.id_origen 
group by orig.origen";
	$result_buscar=mysql_query($sql_buscar);
    $cuantos_orig=mysql_num_rows($result_buscar);
if($cuantos_orig){
  $pdf->ezText("- Importado",9);   // el sistema imprimia todos los origenes, con esto solo imprimira la glosa 1 vez, independiente de la cantidad de origenes que este tenga  IET Solicita lanfrunz el 30-04-2015
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
$pdf->ezText('', 20);
$pdf->ezText("                                                                             <b>$unombre $uapellido</b>",10);	
$pdf->ezText('                                                                                                                                 ____________________________________________________________________________', 5);              
$pdf->ezText("                                                                  <b>Firma autorizada que avala esta certifícación</b>",10);	
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