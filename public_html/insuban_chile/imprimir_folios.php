<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
//include ('class.ezpdf.php');
//$pdf = new Cezpdf('FOLIO');
//$pdf->selectFont('/fonts/Helvetica.afm');

define('FPDF_FONTPATH','ejem_pdf/font/');
require('ejem_pdf/folio_code39.php');
$pdf=new PDF_Code39('P','mm',array(100,100));
$pdf->AddPage('P',array(100,100));


//define('FPDF_FONTPATH','fontscode39/');
//require('code39.php');
//$pdf=new PDF_Code39('P','mm',array(100,100));
//$pdf->AddPage('P',array(0,0));
$pdf->Rect(2,2,95,95); //rectangulo grande
$pdf->Code39(20,10,"66667788",1,12);
$pdf->Output();






?>