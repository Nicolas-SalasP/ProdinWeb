<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
define('FPDF_FONTPATH','clases/font/');
require('clases/code39_faja.php');

$pdf=new FPDF('P','cm','Letter');
$pdf->AddPage('P','Letter'); 

		$id_paking_relacion=$id_paking_relacion;
		$sql="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc	";
		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
		
		


 $pdf->Rect(1,1,20,26);
 $pdf->SetY(2.0);$pdf->SetX(2.0);$pdf->SetFont('Arial','',12);$pdf->Cell(0,0,"PROCESADORA INSUBAN LTDA");
 $pdf->SetY(2.8);$pdf->SetX(2.0);$pdf->SetFont('Arial','',12);$pdf->Cell(0,0,'DEPTO. ASEG. CALIDAD');
 $pdf->SetY(3.7);$pdf->SetX(2.0);$pdf->SetFont('Arial','',12);$pdf->Cell(0,0,"DESTINOS: ");
 $pdf->SetY(4.5);$pdf->SetX(2.0);$pdf->SetFont('Arial','',12);$pdf->Cell(0,0,"CANTIDAD: $cuantos");
 $pdf->SetY(5.3);$pdf->SetX(2.0);$pdf->SetFont('Arial','',12);$pdf->Cell(0,0,"CANTIDAD: $factura");

 $pdf->SetY(6.8);$pdf->SetX(3.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"N° FOLIO");
 $pdf->SetY(6.8);$pdf->SetX(6.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"FECHA SALADO");
 $pdf->SetY(6.8);$pdf->SetX(9.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"FECHA INICIO");
 $pdf->SetY(6.8);$pdf->SetX(12.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"FECHA TERMINO");
 $pdf->SetY(6.8);$pdf->SetX(15.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"FECHA VENCIMIENTO");

			
	
			$y=7;$nu=1;
			while ($r=mysql_fetch_array($rest)){ 
			$y++;
			$f_elaboracion =format_fecha_sin_hora($r[f_elaboracion]);
			$f_inicio =format_fecha_sin_hora($r[f_inicio]);
			$f_termino =format_fecha_sin_hora($r[f_termino]);
			$f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
	        $id_etiquetados_folios=$r[id_etiquetados_folios];
			$pdf->SetY($y);$pdf->SetX(3.0);$pdf->SetFont('Arial','',11);$pdf->Cell(0,0,"$id_etiquetados_folios - [$nu]");
			$pdf->SetY($y);$pdf->SetX(6.0);$pdf->SetFont('Arial','',11);$pdf->Cell(0,0,"$f_elaboracion - [$nu]");
			$pdf->SetY($y);$pdf->SetX(9.0);$pdf->SetFont('Arial','',11);$pdf->Cell(0,0,"$f_inicio - [$nu]"); 
			$pdf->SetY($y);$pdf->SetX(12.0);$pdf->SetFont('Arial','',11);$pdf->Cell(0,0,"$f_termino - [$nu]"); 
			$pdf->SetY($y);$pdf->SetX(15.0);$pdf->SetFont('Arial','',11);$pdf->Cell(0,0,"$f_vencimiento - [$nu]");
			$nu++;
			if($nu == 18){
			
			 
			 $y= 2; $nu=1;
			$pdf->AddPage('P','Letter');
			$pdf->Rect(1,1,20,26); 
			 $pdf->SetY(1.8);$pdf->SetX(3.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"N° FOLIO");
			 $pdf->SetY(1.8);$pdf->SetX(6.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"FECHA SALADO");
			 $pdf->SetY(1.8);$pdf->SetX(9.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"FECHA INICIO");
			 $pdf->SetY(1.8);$pdf->SetX(12.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"FECHA TERMINO");
			 $pdf->SetY(1.8);$pdf->SetX(15.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"FECHA VENCIMIENTO");
			}
			
			}
			
 			
	
$pdf->Output();

?>
 