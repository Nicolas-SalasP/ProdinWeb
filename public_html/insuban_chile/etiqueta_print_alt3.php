<?php
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
define('FPDF_FONTPATH','clases/font/');
require('clases/folio_code39.php');
require('clases/PDF_Code128.php');

$pdf=new PDF_Code128('P','pt',array(300,300));

$feceti=substr($fhoyindicada,2,3);
$fhoy=date("y");
$fecha_emision=date("Y-m-d H:i:s");


if($id_origen and $id_operarios and $cantidad)
{
$fhoy=date("y");

$sql="select * from etiquetas_unidad where id_origen ='$id_origen' order by fecha_emision desc ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

if ($cuantos){
$row=mysql_fetch_array($result);
//$hasta= $row[hasta] + 1;
$valor= $row[hasta] + $cantidad;

$sql_nuevo="UPDATE  etiquetas_unidad set id_origen='$id_origen', id_operarios='$id_operarios',hasta='$valor',fecha_emision='$fecha_emision', fhoy='$fhoy' where id_origen=$id_origen";
//$sql_nuevo="insert into etiquetas_unidad  (id_origen,id_operarios,desde,hasta,fecha_emision,fhoy) values ($id_origen,$id_operarios,$hasta,$valor,'$fecha_emision','$fhoy')";
$result_nuevo=mysql_query($sql_nuevo,$link);
}else{
$desde=1;

$valor= $hastanuevo + $cantidad;
$sql_nuevo2="insert into etiquetas_unidad  (id_origen,id_operarios,desde,hasta,fecha_emision,fhoy) values ('$id_origen','$id_operarios','$desde','$valor','$fecha_emision','$fhoy')";
$result_nuevo2=mysql_query($sql_nuevo2,$link);
	}
}

$sqlo1="SELECT * FROM origenes where id_origen='$id_origen'";
		$resulto1=mysql_query($sqlo1);
		if ($rowo1=mysql_fetch_array($resulto1))
        {
		
    	$origen=$rowo1[origen];
    	$cod=$rowo1[cod]; 
		$domicilio=$rowo1[domicilio];
		$ciudad =$rowo1[ciudad];
		$pais=$rowo1[pais];		     
    }

    if ($id_origen == 5 or $id_origen == 28 or $id_origen == 29) 
      $cod2 = 'Cerdo';
  
    if ($id_origen == 6 or $id_origen == 4 or $id_origen == 7) 
      $cod2 = 'Vacuno';

    if ($id_origen == 56 or $id_origen == 1000037 or $id_origen == 1000057) 
      $cod2 = 'Equino';

if ($id_origen == 21){
  $barral = 90;
}elseif ($id_origen == 1000028) {
    $barral = 92;
}elseif ($id_origen == 1000037) {
    $barral = 39;
}elseif ($id_origen == 56) {
    $barral = 38;  
}elseif ($id_origen == 1000057) {
    $barral = 37;
}elseif ($id_origen == 6) {
    $barral = 35;
}elseif ($id_origen == 28) {
    $barral = 32;
}elseif ($id_origen == 29) {
    $barral = 31;
}elseif ($id_origen == 5) {
    $barral = 30;
}else{
  $barral = 10;
}


for ($i=0 ; $i < "$cantidad" ; $i++){

$code_a0="I";
$code_a1="98";//cod barral_ID
$barral1="$barral";//cod barral number
$cod_a="0";
$code_a3a="$hasta";
$code_a3="$code_a3a" + $i;


$pdf->AddPage('P',array(300,280));

		  $pdf->SetY(17.0);$pdf->SetX(22.0);$pdf->SetFont('Arial','B',15);$pdf->Cell(0,0,"$cod2 Procesadora Insuban Spa");
		  $pdf->Line(10,25,283,25);//horizontal 1
		  $pdf->SetY(33.0);$pdf->SetX(80.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Antillanca Norte 391 - CHILE");
		  $pdf->Line(10,42,283,42);//horizontal 2
		  
		  $pdf->SetY(55.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"Cod. del Bidon:");//Cod. del Bidon
		  $pdf->SetY(54.0);$pdf->SetX(111.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$cod / $feceti / $code_a0$barral1$feceti$cod_a$code_a3");
	//    $pdf->SetY(55.0);$pdf->SetX(200.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"$barral1$cod_a$code_a3");			  

//		  $pdf->SetY(76.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"PROCEDENCIA:");//PROCEDENCIA
//		  $pdf->SetY(74.0);$pdf->SetX(150.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"$origen");//PROCEDENCIA		  
//		  $pdf->Line(270,78,94,78);//horizontal 3

		  $pdf->SetY(72.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"PROCEDENCIA:");//PROCEDENCIA
//		  $pdf->SetY(70.0);$pdf->SetX(150.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"$origen");//PROCEDENCIA		  
		  $pdf->Line(270,74,94,74);//horizontal 3
	  	  
		  $pdf->SetY(90.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"PREDIO:");//PREDIO
		  $pdf->Line(270,92,94,92);//horizontal 4

		  $pdf->SetY(108.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"LOTE:");//LOTE
		  $pdf->Line(270,110,94,110);//horizontal 5		  

		  $pdf->SetY(126.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"PRODUCTO:");//COD. DE PRODUCTO
		  $pdf->SetY(123.0);$pdf->SetX(150.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"GRASA");//GRASA		  
//		  $pdf->SetY(126.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"COD. DE PRODUCTO:");//COD. DE PRODUCTO		  
		  $pdf->Line(270,128,104,128);//horizontal 6

		  $pdf->SetY(144.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"CALIBRE:");//CALIBRE
		  $pdf->SetY(141.0);$pdf->SetX(150.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"ORIGINAL");//CALIBRE		  
		  $pdf->Line(270,146,94,146);//horizontal 7

//		  $pdf->SetY(162.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"KILOS:");//CANTIDAD
		  $pdf->SetY(162.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"CANTIDAD:");//CANTIDAD
		  $pdf->Line(270,164,94,164);//horizontal 8

		  $pdf->SetY(180.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"FECHA DE INICIO:");//FECHA DE INICIO
		  $pdf->Line(144,182,94,182);//horizontal 7.1
		  $pdf->Line(154,172,146,182);//diagonal 7.1.1		  		  
		  $pdf->Line(198,182,150,182);//horizontal 7.2
		  $pdf->Line(208,172,200,182);//diagonal 7.2.2		  
		  $pdf->Line(268,182,208,182);//horizontal 7.3

		  $pdf->SetY(198.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"FECHA DE TERMINO:");//FECHA DE TERMINO
		  $pdf->Line(148,200,98,200);//horizontal 8.1
		  $pdf->Line(158,190,150,200);//diagonal 8.1.1
		  $pdf->Line(202,200,154,200);//horizontal 8.2
		  $pdf->Line(212,190,204,200);//diagonal 8.2.2
		  $pdf->Line(269,200,212,200);//horizontal 8.3

		  $pdf->Line(10,210,283,210);//horizontal 9
if ($radio == 1){
		  $pdf->SetY(215.0);$pdf->SetX(84.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"PLANTA DE ORIGEN: SAG 06-01");}//PLANTA DE ORIGEN: SAG 06-17
//		  $pdf->SetY(223.0);$pdf->SetX(96.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"PLANTA DE ORIGEN: SAG ");//PLANTA DE ORIGEN: SAG
if ($radio2 == 11){	 
		  $pdf->SetY(223.0);$pdf->SetX(64.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"MANTENER LA MERCADERIA IGUAL o MENOS 3 C");}//MANTENER LA MERCADERIA A MENOS 3° C
if ($radio3 == 13){	  
		  $pdf->SetY(232.0);$pdf->SetX(61.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"MANTENER LA MERCADERIA A T. AMBIENTE");}//FECHA DE TERMINO
		  $pdf->Code128(88,245,"$code_a0$barral1$feceti$code_a3",130,30);//barras_insuban
//		  $pdf->Code128(88,245,"$code_a1$code_a0$barral1$cod_a$code_a3",130,30);//barras_insuban		  
//	      $pdf->SetY(242.0);$pdf->SetX(92.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"$code_a1$barral1$cod_a$code_a3");		  
//		  $pdf->SetY(290.0);$pdf->SetX(268.0); $pdf->Rect(5,5,285,260); //rectangulo grande
}

$pdf->Output();	  		  	
?>