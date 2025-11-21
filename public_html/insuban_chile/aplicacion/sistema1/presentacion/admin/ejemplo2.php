<?php
$cod = $_POST['codigo'];
$ope = $_POST['operaria'];
$cal = $_POST['calibre'];

define('FPDF_FONTPATH','clases/font/');
require('../../datos/code39_etiquetas_barras.php');

$pdf=new PDF_Code39();
$pdf->AddPage();
$pdf->Code39(2,10,$cod,1,10);
$pdf->Ln(17);
$pdf->Cell(1,4,"$ope",0,2);
$pdf->Cell(1,4,"$cal",0,2);
$pdf->Output();
?>