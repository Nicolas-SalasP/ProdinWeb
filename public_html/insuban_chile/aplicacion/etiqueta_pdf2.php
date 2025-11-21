<? define('FPDF_FONTPATH','clases/font/');
require('clases/folio_code39.php');

// configuracion etiqueta calidad 
$pdf=new PDF_Code39('P','pt',array(250,150));
$pdf->AddPage('P',array(250,150));

switch ($opt) {

case 1:
// Etiqueta calidad
//	$pdf->Cell(0,0, $pdf->Image('images/logo.png', $pdf->GetX(), $pdf->GetY(),11),1);
 	$pdf->Image('images/logo.jpg',14,30,40);
	$pdf->SetY(46.0);$pdf->SetX(50.0);$pdf->SetFont('Arial','b',30); $pdf->Cell(0,00,'REVISADO');
	$pdf->SetY(63.0);$pdf->SetX(50.0);$pdf->SetFont('Arial','b',14); $pdf->Cell(0,00,'CONTROL DE CALIDAD');	  
	$pdf->Rect(14,26,200,50); //rectangulo grande
	$pdf->Rect(12,24,202,54); //rectangulo grande
break;

case 2:
// Etiqueta calidad 
	$pdf->SetY(49.0);$pdf->SetX(31.0);$pdf->SetFont('Arial','b',24); $pdf->Cell(0,00,utf8_decode('DEVOLUCIÓN'));
	$pdf->Rect(14,26,200,50); //rectangulo grande
	$pdf->Rect(12,24,202,54); //rectangulo grande
break;

case 3:
// Etiqueta Bodega 
	$pdf->SetY(42.0);$pdf->SetX(31.0);$pdf->SetFont('Arial','b',14); $pdf->Cell(0,00,'Lote 	________');
	$pdf->SetY(59.0);$pdf->SetX(31.0);$pdf->SetFont('Arial','b',14); $pdf->Cell(0,00,'Factura ________');	  
	$pdf->Rect(14,26,200,50); //rectangulo grande
	$pdf->Rect(12,24,202,54); //rectangulo grande
break;

case 4:
// Etiqueta calidad
	$pdf->SetY(39.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,'CONT: __________  FECH:___________'); 
	$pdf->SetY(53.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,'PH: _______');
	$pdf->SetY(68.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,'Materia Seca: _______');	  
	$pdf->Rect(14,30,198,50); //rectangulo adentro
	$pdf->Rect(12,28,202,54); //rectangulo afuera
break;


case 5:
// Etiqueta calidad
	$pdf->SetY(50.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,'FECHA: _____________');
	$pdf->SetY(68.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,'Test de Alcohol: ________________');	  
	$pdf->Rect(14,30,198,50); //rectangulo adentro
	$pdf->Rect(12,28,202,54); //rectangulo afuera
break;

case 6:
// Etiqueta calidad
	$pdf->SetY(39.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,utf8_decode('Resolución')); 
	$pdf->SetY(53.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,'SESMA 9242 del 1.04.04');
	$pdf->SetY(68.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,utf8_decode('Región Metropolitana'));	  
	$pdf->Rect(14,30,198,50); //rectangulo adentro
	$pdf->Rect(12,28,202,54); //rectangulo afuera
break;

case 7:
// Etiqueta calidad 
	$pdf->SetY(49.0);$pdf->SetX(31.0);$pdf->SetFont('Arial','b',24); $pdf->Cell(0,00,utf8_decode('EN TRÁNSITO'));
	$pdf->Rect(14,26,200,50); //rectangulo grande
	$pdf->Rect(12,24,202,54); //rectangulo grande
break;


case 8:
// Etiqueta calidad TEST DE ALCOHOL
	$pdf->SetY(50.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,'FECHA: _____________');
	$pdf->SetY(68.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,utf8_decode('DIGESTIÓN: _________________'));	
	$pdf->SetY(86.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,'TARA PLATO: ________________');	  
	$pdf->Rect(14,30,215,70); //rectangulo adentro
	$pdf->Rect(12,28,220,74); //rectangulo afuera
break;

case 9:
// Etiqueta calidad MATERIA PRIMA/ DIGESTION
	$pdf->SetY(30.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',8); $pdf->Cell(0,00,'TIPO: _______________ ORIGEN: ______________');
	$pdf->SetY(44.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',8); $pdf->Cell(0,00,'F.RECEP/DIGESTION: _____________ PH: __________');	  
	$pdf->SetY(57.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',8); $pdf->Cell(0,00,'MATERIA SECA: ___________________');
	$pdf->SetY(70.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',8); $pdf->Cell(0,00,'CONDUCTIVIDAD: __________________');	
	$pdf->SetY(82.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',8); $pdf->Cell(0,00,'PESO: _______________ LOTE: ________________');	
	$pdf->Rect(14,20,220,70); //rectangulo adentro
	$pdf->Rect(12,18,224,73); //rectangulo afuera
break;

case 10:
// Etiqueta calidad 
	$pdf->SetY(49.0);$pdf->SetX(31.0);$pdf->SetFont('Arial','b',18); $pdf->Cell(0,00,utf8_decode('SUBIR A PLANTA 1'));
	$pdf->Rect(14,26,200,50); //rectangulo grande
	$pdf->Rect(12,24,202,54); //rectangulo grande
break;

case 11:
// Etiqueta Henil 
	$pdf->SetY(39.0);$pdf->SetX(38.0);$pdf->SetFont('Arial','b',9); $pdf->Cell(0,00,utf8_decode('Mantener en Lugar Fresco y Seco'));
	$pdf->SetY(49.0);$pdf->SetX(48.0);$pdf->SetFont('Arial','b',9); $pdf->Cell(0,00,utf8_decode('a Temperatura Ambiente'));	
	$pdf->SetY(62.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',9); $pdf->Cell(0,00,'Reg. Monografia MGAP/DGSG/DIA/M 1795');
	$pdf->SetY(72.0);$pdf->SetX(18.0);$pdf->SetFont('Arial','b',9); $pdf->Cell(0,00,utf8_decode('Reg. Rotulo MGAP/DGSG/DIA/M 1795'));	  
	$pdf->Rect(14,30,198,50); //rectangulo interior
	$pdf->Rect(12,28,202,54); //rectangulo exterior
break;



}

$pdf->Output(); 
?>  