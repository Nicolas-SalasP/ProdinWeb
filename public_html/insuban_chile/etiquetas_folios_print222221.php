<?php
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
define('FPDF_FONTPATH','clases/font/');
require('clases/folio_code39.php');
require('clases/PDF_Code128.php');

$hoy = date("dmY"); 

 $query1="SELECT * FROM etiquetas_agrosuper order by id_etiquetas_unidad Desc";
 $result1=mysql_query($query1);
 $cuantos1=mysql_num_rows($result1);


 $sql="SELECT * FROM etiquetados_folios AS ef, producto AS p, calibre AS c, unidad_medida AS um, caract_envases AS cenv, caract_producto AS cpro  where ef.id_etiquetados_folios='$id_etiquetados_folios' and ef.id_producto = p.id_producto and ef.id_calibre=c.id_calibre and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_envases = cenv.id_caract_envases and ef.id_caract_producto = cpro.id_caract_producto";
 $result=mysql_query($sql);
 $cuantos=mysql_num_rows($result);
 
 $sql2="SELECT * FROM etiquetados_folios AS ef, operarios AS o, caract_producto AS caracp, unidad_medida AS um, caract_envases AS cenv , caract_producto AS cpro where ef.id_etiquetados_folios='$id_etiquetados_folios' and ef.id_operarios = o.id_operarios and ef.id_caract_producto = caracp.id_caract_producto and ef.id_unidad_medida = um.id_unidad_medida and ef.id_caract_envases = cenv.id_caract_envases  and ef.id_caract_producto = cpro.id_caract_producto ";
 $result2=mysql_query($sql2);
 $cuantos2=mysql_num_rows($result2);
 
 $sql3="SELECT * FROM etiquetados_folios AS ef, medidas_productos AS mp, caract_envases AS cenv, caract_producto AS cpro where ef.id_etiquetados_folios='$id_etiquetados_folios' and ef.id_medidas_productos=mp.id_medidas_productos and ef.id_caract_envases = cenv.id_caract_envases  and ef.id_caract_producto = cpro.id_caract_producto";
 $result3=mysql_query($sql3);
 $cuantos3=mysql_num_rows($result3);


$pdf=new PDF_Code128('P','pt',array(300,282));


	  if ($row=mysql_fetch_array($result))
      { 
	   

	  $id_etiquetados_folios=$row[id_etiquetados_folios];
	  $f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	  $f_inicio=format_fecha_sin_hora($row[f_inicio]);
	  $f_termino =format_fecha_sin_hora($row[f_termino]);
	  $f_vencimiento=format_fecha_sin_hora($row[f_vencimiento]);
	  $id_cruce_tablas = $row[id_cruce_tablas];
 
if ($id_cruce_tablas == 534 or $id_cruce_tablas == 535 or $id_cruce_tablas == 536 or $id_cruce_tablas == 537 or $id_cruce_tablas == 538 ) {
  $dat4=split(" ",$f_elaboracion);
}else{
  $dat4=split(" ",$f_termino);
} 

  $dat6=split("-",$dat4[0]);
  $f_termino2="$dat6[2]-$dat6[1]-$dat6[0]";
  
 $dat1ven=split(" ",$f_termino2);
 $datven=split("-",$dat1ven[0]);

$fech_an="$datven[0]";
$fech=$fech_an+2;
// echo " ano $fech<br>";
$mes="$datven[1]";
// echo "mes $mes<br>";
 $dia="$datven[2]";
// echo "dia $dia<br>";
			   
$f_vencimiento2="$dia-$mes-$fech";

$dat4=split(" ",$f_elaboracion);
$dat6=split("-",$dat4[0]);
$f_elaboracion2="$dat6[0]$dat6[1]$dat6[2]";


		if ($row3=mysql_fetch_array($result3))
        { 
		 $id_producto=$row[id_producto];
		 $producto=$row[producto];
		 $cal=$row[calibre];
		 $medidas_productos=$row3[medidas_productos];
		 $dato=$row3[id_etiquetados_folios];
		 $conte=$row[contenido_unidades];
		 $unidad_medida=$row[unidad_medida];
		 $nombre_alt=$row[nombre_alt];
		 $calibre_alt=$row[calibre_alt];
		 $contenido_alt=$row[contenido_alt];
		 $id_caract_envases=$row[id_caract_envases];
		 $caract_envases=$row[caract_envases];
		 $id_caract_producto=$row[id_caract_producto];
	  	 $folio_m3 = $row[folio_m3];			 
		 
		if ($row2=mysql_fetch_array($result2))
        { 
	    $nomope=$row2[nombreop];
	    $apellope=$row2[apellido];
		$caract_producto=$row2[caract_producto];
	    }
	
	    if($nombre_alt){
		$producto=$nombre_alt;
		}else{
		$producto=$producto;
		}
		if($calibre_alt){
		$cal=$calibre_alt;
		}else{
		$cal=$cal;
		}
		
		if($contenido_alt){
		$conte=$contenido_alt;
		}else{
		$conte=$conte;
		}


 if ($row=mysql_fetch_array($result1))
      { 
	   
	  $id_etiquetas_unidad=$row[id_etiquetas_unidad];
	  $id_cruce_tabla=$row[id_cruce_tabla];
	  $cantidad=$row[cantidad];
	  $desde =$row[desde] + 1;	  
	  $hasta =$row[hasta];
	  $fecha_emision=$row[fecha_emision];
	  $fhoy = $row[fhoy];
	  $bar_code = $row[bar_code];
		$mercado = $row[mercado];
		$sku_code = $row[sku_code];


//$cantidad = 1;

	
for ($i=0 ; $i < 2 ; $i++){

	if ($id_cruce_tablas == 534 ) { // 30-32
		$code_a2a = 108;
		$code_a7a = 1022780;
	}if ($id_cruce_tablas == 535 or $id_cruce_tablas == 594) { // 32-35
		$code_a2a = 130;
	 if ($mercado == 1){$code_a7a = 1023292;}else{$code_a7a = 1022781;}	
	}if ($id_cruce_tablas == 536 or $id_cruce_tablas == 595) { // 35-38
		$code_a2a = 131;
		$code_a7a = 1022782;
	}if ($id_cruce_tablas == 537 or $id_cruce_tablas == 596) { // 38-40
		$code_a2a = 135;
		$code_a7a = 1022783;
	}if ($id_cruce_tablas == 538 or $id_cruce_tablas == 597) { // 40-42
		$code_a2a = 159;
		$code_a7a = 1022784;
	}if ($id_cruce_tablas == 539) {
		$code_a2a = 163;
		$code_a7a = 1022785;
	}if ($id_cruce_tablas == 610 or $id_cruce_tablas == 611) { //   -/35
		$code_a2a = 163;
		$code_a7a = 1023270;	
	}if ($id_cruce_tablas == 540 or $id_cruce_tablas == 609) { //35-39
		$code_a2a = 209;
		$code_a7a = 1022786;
	}if ($id_cruce_tablas == 541) {
		$code_a2a = 219;
		$code_a7a = 1022787; 		
	}if ($id_cruce_tablas == 542) {
		$code_a2a = 545;
		$code_a7a = 1022788;
	}

$code_a1="26020118";//cod base
$code_a2="$code_a2a";
if ($id_cruce_tablas == 535 or $id_cruce_tablas == 594) { // 35/39 sudamerica
$code_a3="2021040901300";
}elseif ($id_cruce_tablas == 610 or $id_cruce_tablas == 611) { // -/35 sudamerica
$code_a3="2081012901300";
}else{
$code_a3="2051040901300";
}
//$code_a4="$hoy";
$code_a4="$f_elaboracion2";
//$code_a4="27042020";
$code_a5="0000";//cod peso
$code_a3a="$desde";
$code_a6="$code_a3a";
//$code_a6="50001";
$code_a7="$code_a7a";


$pdf->AddPage('P',array(300,282));

		  $pdf->SetY(15.0);$pdf->SetX(11.0);$pdf->SetFont('Arial','B',15);$pdf->Cell(0,0,"C-INTESTINO DELGADO");
//		  $pdf->Line(10,22,283,22);//horizontal 1
		  $pdf->Line(10,24,283,24);//horizontal 2

		  $pdf->Rect(10,33,130,14);//rectangulo 1
		  $pdf->SetY(40.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',13); $pdf->Cell(0,0,"CALIBRE: ");
		  $pdf->SetY(40.0);$pdf->SetX(75.0);$pdf->SetFont('Arial','b',13); $pdf->Cell(0,0,"$cal");
		  $pdf->Rect(155,33,130,14);//rectangulo 2
		  $pdf->SetY(40.0);$pdf->SetX(155.0);$pdf->SetFont('Arial','',13); $pdf->Cell(0,00,"MEDIDA:");
		  $pdf->SetY(40.0);$pdf->SetX(215.0);$pdf->SetFont('Arial','b',13); $pdf->Cell(0,00,"$medidas_productos");
		  $pdf->SetY(55.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Contenido:");//contenido
		  $pdf->SetY(55.0);$pdf->SetX(65.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$conte");
		  $pdf->SetY(55.0);$pdf->SetX(170);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Unidades");//unidades
		  $pdf->SetY(66.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Fecha de Elaboracion:");//f_elaboracion
		  $pdf->SetY(66.0);$pdf->SetX(125.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$f_elaboracion");
		  $pdf->SetY(80.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Utilizar Preferentemente antes de:");//f_vencimiento
		  $pdf->SetY(80.0);$pdf->SetX(185.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$f_vencimiento2");
		  $pdf->SetY(93.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Operador:");//operador
		  $pdf->SetY(93.0);$pdf->SetX(65.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$nomope $apellope");
		  $pdf->SetY(106.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Condicion:");//Condicion
		  $pdf->SetY(106.0);$pdf->SetX(65.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$unidad_medida");
if($id_caract_producto == 25){
		  $pdf->SetY(106.0);$pdf->SetX(150.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"C/E:");//c_envase
		  $pdf->SetY(106.0);$pdf->SetX(170.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$caract_envases");
		  }
		  $pdf->Code128(20,118,"$id_cruce_tablas$dato",100,28);//barras_insuban
		  $pdf->SetY(153.0);$pdf->SetX(16.0);$pdf->SetFont('Arial','b',8); $pdf->Cell(0,00,"$id_cruce_tablas$dato");
//		  $pdf->SetY(153.0);$pdf->SetX(160.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"FOLIO: $dato");
		  $pdf->SetY(153.0);$pdf->SetX(160.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"FOLIO: $folio_m3");
		  $pdf->SetY(165.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"Pais de Origen: CHILE");
		  $pdf->SetY(175.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"Registro SAG: 13-62    Resolucion SESMA: 9242/04");
		  $pdf->SetY(185.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"Mantener en lugar fresco y seco a temperatura ambiental.");
		   $pdf->SetY(195.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','b',8); $pdf->Cell(0,00,"Procesadora Insuban, Spa. ");
		   $pdf->SetY(205.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','b',8); $pdf->Cell(0,00,"Antillanca Norte 391 / Pudahuel - Santiago");
//if($id_cruce_tablas == 33){		   
		   $pdf->SetLineWidth(2);
		   $pdf->SetY(217.0);$pdf->SetX(16.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"$bar_code");//cod
//		   $pdf->SetY(217.0);$pdf->SetX(16.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"$code_a1$code_a2$code_a3$code_a4$code_a5$code_a6");//cod
		  	$pdf->SetY(210.0);$pdf->SetX(240.0);$pdf->SetFont('Arial','b',7); $pdf->Cell(0,00,"$sku_code");		   		   
//		  	$pdf->SetY(210.0);$pdf->SetX(240.0);$pdf->SetFont('Arial','b',7); $pdf->Cell(0,00,"$code_a7");
//		   $pdf->Write(7,"$code_a1$code_a2$code_a3$code_a4$code_a5$code_a6");//cod  		   	
		   $pdf->Line(18,221,280,221);//horzontal 3		   
//  		   $pdf->Code128(20,222,"$code_a1$code_a2$code_a3$code_a4$code_a5$code_a6",260,28);//barras_agrosuper
  		   $pdf->Code128(20,222,"$bar_code",260,28);//barras_agrosuper
//		   $pdf->SetY(228.0);$pdf->SetX(16.0);$pdf->SetFont('Arial','b',8);$pdf->Cell(0,00,"$code_a1$hoy$code_a2$code_a3");
//	       $pdf->SetY(290.0);$pdf->SetX(268.0);
//			} 
		   $pdf->Rect(5,5,285,260); //rectangulo grande
	}
}
}
}
$pdf->Output();
?>
