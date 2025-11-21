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

if ($hasta == 1) {
	$cod_a="000";
}elseif ($hasta == 10) {
	$cod_a="00";
}elseif ($hasta > 99 && $hasta < 999){
	$cod_a="0";
}else{
	$cod_a="";
}
$code_a3a="$hasta";
$code_a3="$code_a3a" + $i;

$pdf->AddPage('P',array(300,280));

		  $pdf->SetY(17.0);$pdf->SetX(42.0);$pdf->SetFont('Arial','B',13);$pdf->Cell(0,0,"PROCESADORA INSUBAN SPA");

		  $pdf->SetY(55.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"NOMBRE DEL PRODUCTO:");//PROCEDENCIA
//		  $pdf->SetY(70.0);$pdf->SetX(150.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"$origen");//PROCEDENCIA		  
		  $pdf->Line(270,57,116,57);//horizontal 3


//		  $pdf->SetY(55.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"Cod. del Bidon:");//Cod. del Bidon
//		  $pdf->SetY(54.0);$pdf->SetX(111.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$cod / $feceti / $code_a0$barral1$feceti$cod_a$code_a3");
//		  $pdf->SetY(55.0);$pdf->SetX(200.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"$barral1$cod_a$code_a3");		


		  $pdf->SetY(72.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"CODIGO DEL PRODUCTO:");//PROCEDENCIA
//		  $pdf->SetY(70.0);$pdf->SetX(150.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"$origen");//PROCEDENCIA		  
		  $pdf->Line(270,74,116,74);//horizontal 3
	  	  
		  $pdf->SetY(90.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"LOTE BIDON:");//LOTE
		  $pdf->SetY(90.0);$pdf->SetX(100.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$code_a0$barral1$feceti$cod_a$code_a3");
//		  $pdf->Line(270,92,94,92);//horizontal 4

		  $pdf->SetY(108.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"PROCEDENCIA:");//PROCEDENCIA
		  $pdf->Line(270,110,94,110);//horizontal 5		  

		  $pdf->SetY(128.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"CANTIDAD:");//CANTIDAD
		  $pdf->Line(270,130,94,130);//horizontal 8

		  $pdf->SetY(148.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"FECHA DE ELABORACION:");//FECHA DE INICIO
		  $pdf->Line(270,150,114,150);//horizontal 7.1

		  $pdf->SetY(168.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"FECHA DE VENCIMIENTO:");//FECHA DE TERMINO
		  $pdf->Line(270,170,114,170);//horizontal 8.1

		  $pdf->Line(10,185,283,185);//horizontal 9

if ($radio == 1 and $id_origen == 5 ){ //com
		  $pdf->SetY(190.0);$pdf->SetX(57.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"PLANTA DE ORIGEN: COMAFRI S.A., SAG:06-01");
		 $pdf->SetY(200.0);$pdf->SetX(34.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,utf8_decode("Av. Libertador Bernardo O'Higgins N°1370, Rancagua, Chile."));
		$pdf->SetY(210.0);$pdf->SetX(50.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,utf8_decode("RES. SANITARIA SNS N°3021 DEL 09-11-1990"));}

if ($radio == 1 and $id_origen == 28 ){//coe
		  $pdf->SetY(190.0);$pdf->SetX(56.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"PLANTA DE ORIGEN: COEXCA S.A., SAG:07-03");
		 $pdf->SetY(200.0);$pdf->SetX(60.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,utf8_decode("Longitudinal Sur Km. 259, Talca, Maule, Chile."));
		$pdf->SetY(210.0);$pdf->SetX(55.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,utf8_decode("RES. SANITARIA SNS N°3027 DEL 31-12-2003"));}

if ($radio == 1 and $id_origen == 6 ){//cam
		  $pdf->SetY(190.0);$pdf->SetX(60.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"PLANTA DE ORIGEN: FRIGORIFICO CAMER LTDA.");
		 $pdf->SetY(200.0);$pdf->SetX(34.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,utf8_decode("Av. Ochagavía 12301, San Bernardo, Región Metropolitana, Chile."));
		$pdf->SetY(210.0);$pdf->SetX(50.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,utf8_decode("RES. SANITARIA SNS N°91367 DEL 30-11-2011"));}


if ($radio2 == 11){	 
		  $pdf->SetY(220.0);$pdf->SetX(60.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,utf8_decode("MANTENER A TEMPERATURA DE 3°C o menor."));}//MANTENER LA MERCADERIA A MENOS 3° C

if ($radio3 == 13 and $id_origen == 6){	  
		  $pdf->SetY(230.0);$pdf->SetX(61.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"INGREDIENTES: TRIPA, AGUA, HIELO");}else{
		  $pdf->SetY(230.0);$pdf->SetX(61.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"INGREDIENTES: TRIPA, AGUA, SAL, HIELO");	
		  }

		  $pdf->Code128(88,245,"$code_a1$code_a0$barral1$feceti$cod_a$code_a3",130,30);//barras_insuban	//130923 	  

}

$pdf->Output();	  		  	
?>