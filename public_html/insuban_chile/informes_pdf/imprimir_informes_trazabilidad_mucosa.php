<?
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";
include ('class.ezpdf.php');
require('folio_code39.php');
$pdf = new Cezpdf('A4');


$pdf->selectFont('/fonts/Helvetica.afm');
$pdf->ezText('PROCESADORA INSUBAN LTDA', 11);
$pdf->ezText('_______________________________________________________________________________________________________________________________________________________________________________________________', 5);
$pdf->ezText('', 12);
$pdf->ezText("<b>DEPTO. ASEG. CALIDAD</b>",8);
//muestra destino
$sqldes="SELECT * from destinos where id_destinos = $id_destinos";
$restdes=mysql_query($sqldes);
while ($rdes=mysql_fetch_array($restdes)){ 
 $destinos=$rdes[destinos];
}
$pdf->ezText("<b>DESTINOS: $destinos</b>",8);
//muestra cantidad
$pdf->ezText("<b>CANTIDAD: $cantifo</b>",8);
$pdf->ezText("<b>FACTURA: $factura</b>",8);


$pdf->ezText('', 20);

		$id_paking_relacion=$id_paking_relacion;
		$sql="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, origenes AS org where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_origen = org.id_origen
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc	";
		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 
     	 if($cuantos){
		   while ($r=mysql_fetch_array($rest)){ 
			$i++;
			//$f_elaboracion =format_fecha_sin_hora($r[f_elaboracion]);
			$f_inicio =format_fecha_sin_hora($r[f_inicio]);
			$f_termino =format_fecha_sin_hora($r[f_termino]);
			$f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
	        $id_etiquetados_folios=$r[id_etiquetados_folios]; 
			 $origen=$r[origen]; 
			
			
		$data[] = array('id'=>$i, 'nf'=>$id_etiquetados_folios, 'fi'=>$f_inicio, 'ft'=>$f_termino, 'fv'=>$f_vencimiento, 'org'=>$origen);
			
			$titles = array('id'=>'<b>ID</b>', 'nf'=>'<b>N° FOLIO</b>', 'fi'=>'<b>FECHA INICIO</b>','ft'=>'<b>FECHA TERMINO</b>','fv'=>'<b>FECHA VENCIMIENTO</b>','org'=>'<b>ORIGEN</b>');
		
				
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

if($cantifo == 47 or $cantifo == 48 or $cantifo == 49 or $cantifo == 50 or $cantifo == 51 or $cantifo == 52 or $cantifo == 53 or $cantifo == 54 or $cantifo == 55){
$pdf->ezText('', $salt);
$pdf->ezText('PROCESADORA INSUBAN LTDA', 11);
$pdf->ezText('_______________________________________________________________________________________________________________________________________________________________________________________________', 5);
$pdf->ezText('', 12);
}
/*$pdf->ezText('', 10);
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
}*/
//**********************************************************************MPN
//**********************************************************************MPI
/*	$sql_buscar="SELECT orig.origen AS origen 
FROM paking AS p, etiquetados_folios AS ef, folios_mat AS fm, mat_prima_importada AS mpn, origenes AS orig
WHERE p.id_paking_relacion = $id_paking_relacion
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
AND ef.id_etiquetados_folios = fm.id_etiquetados_folios
AND fm.id_mat = mpn.id_mat_prima_importada
AND mpn.id_origen = orig.id_origen 
group by orig.origen";
	$result_buscar=mysql_query($sql_buscar);
    $cuantos_orig=mysql_num_rows($result_buscar);
	
while ($rdes=mysql_fetch_array($result_buscar)){ 
       $origeness3=$rdes[origen];
	   $pdf->ezText("- $origeness3 (Importado)",9);	
}*/
//**********************************************************************MPI

/*$sql_buscar2="SELECT  orig.origen AS origen 
FROM paking AS p, etiquetados_folios AS ef, origenes AS orig
WHERE p.id_paking_relacion = $id_paking_relacion
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
AND ef.id_origen = orig.id_origen 
AND id_procedencia = 'I'
group by orig.origen";
	$result_buscar2=mysql_query($sql_buscar2);
    $cuantos_orig2=mysql_num_rows($result_buscar2);
	
while ($rdes2=mysql_fetch_array($result_buscar2)){ 
       $origeness2=$rdes2[origen];
	   $pdf->ezText("- $origeness2 (Importado)",9);
$pdf->ezText('', 1);
}
*/
/*$sql_firma="SELECT * FROM usuarios WHERE id_usuario = $id and firma = 1";
$result_firma=mysql_query($sql_firma);
$firma=mysql_num_rows($result_firma);
if($firma){
while ($rowfirma=mysql_fetch_array($result_firma)){ 
$unombre=$rowfirma[unombre]; 
$uapellido=$rowfirma[uapellido];
}
$pdf->ezText('', 20);
$pdf->ezText("                                                                                        <b>$unombre $uapellido</b>",10);	
$pdf->ezText('                                                                                                                                 ____________________________________________________________________________', 5);              
$pdf->ezText("                                                                  <b>Firma autorizada que avala esta certifícación</b>",10);	
}
*/


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