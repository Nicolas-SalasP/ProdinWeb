<?php
define('FPDF_FONTPATH','clases/font/');
require('clases/code39.php');

$pdf=new PDF_Code39();
$pdf->AddPage();
$pdf->Code39(0,0,'shualo rvs',1,10);


//$pdf=new PDF_Code39();
//$pdf->AddPage();
$pdf->Code39(100,0,'shualo rvs2',1,10);
$pdf->Output();
?>
