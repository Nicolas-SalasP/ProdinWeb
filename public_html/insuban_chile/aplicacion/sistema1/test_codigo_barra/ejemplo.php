<?php
$cod = $_POST['codigo'];

define('FPDF_FONTPATH','clases/font/');
require('clases/code39.php');

$pdf=new PDF_Code39();
$pdf->AddPage();
$pdf->Code39(0,10,$cod,1,10);

//$pdf=new PDF_Code39();
//$pdf->AddPage();
//$pdf->Code39(100,10,'ROJO13032017AZUL',1,10);
$pdf->Output();
?>
