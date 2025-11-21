<?php
$cod = $_POST['codigo'];
$ope = $_POST['operaria'];
$cal = $_POST['calibre'];


define('FPDF_FONTPATH','clases/font/');
require('../../datos/code39_etiquetas_barras.php');

$pdf=new PDF_Code39('P','mm',array(80,55));
$pdf->AddPage('P',array(80,55));

	$pdf->Code39(10,8,$cod,1,10);
//	$pdf->Ln(14);
//	$pdf->Cell(1,4,"$ope",0,2);$pdf->Cell(1,4,"$cal",24,24);
	$pdf->SetY(26.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,0,"$ope ");
	$pdf->SetY(26.0);$pdf->SetX(40.0);$pdf->SetFont('Arial','b',8); $pdf->Cell(0,0,"Calibre:");	
	$pdf->SetY(26.0);$pdf->SetX(52.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,0,"$cal");

$pdf->Output();
?>
