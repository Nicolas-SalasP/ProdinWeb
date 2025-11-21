<?
include ('class_pdf/class.ezpdf.php');
$pdf = new Cezpdf();
$pdf->selectFont('class_pdf/fonts/Helvetica.afm');
$pdf->ezText('Mi primer pdf en PHP', 30);
$pdf->ezStream();
?>