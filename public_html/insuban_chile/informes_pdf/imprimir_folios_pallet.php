<?
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";
define('FPDF_FONTPATH','../clases/font/');
require('../clases/folio_code39.php');


 $sql="SELECT * FROM etiquetados_folios AS ef, producto AS p, calibre AS c, unidad_medida AS um, operarios AS o, caract_producto AS caracp, caract_envases AS cenv, medidas_productos AS mpr where  ef.id_producto = p.id_producto and ef.id_calibre=c.id_calibre and ef.id_unidad_medida = um.id_unidad_medida  and ef.id_caract_producto = caracp.id_caract_producto and ef.id_caract_envases = cenv.id_caract_envases and ef.id_operarios = o.id_operarios and ef.id_medidas_productos = mpr.id_medidas_productos  and ef.pallet='$pallet' order by ef.id_etiquetados_folios asc";
 $result=mysql_query($sql);
 $cuantos=mysql_num_rows($result);

$pdf=new PDF_Code39('P','pt',array(300,280));

//$i=0;


	  while ($row=mysql_fetch_array($result))
      { 
	   
	  $id_etiquetados_folios=$row[id_etiquetados_folios];
	  $f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	  $f_inicio=format_fecha_sin_hora($row[f_inicio]);
	  $f_termino =format_fecha_sin_hora($row[f_termino]);
	  $f_vencimiento=format_fecha_sin_hora($row[f_vencimiento]);
	  $id_cruce_tablas = $row[id_cruce_tablas];
     
		 $id_producto=$row[id_producto];
		 $producto=$row[producto];
		 $cal=$row[calibre];
		 $medidas_productos=$row[medidas_productos];
		 $dato=$row[id_etiquetados_folios];
		 $conte=$row[contenido_unidades];
		 $unidad_medida=$row[unidad_medida];
		 $nombre_alt=$row[nombre_alt];
		 $calibre_alt=$row[calibre_alt];
		 $contenido_alt=$row[contenido_alt];
	 
		$nomope=$row[nombreop];
	    $apellope=$row[apellido];
		$caract_producto=$row[caract_producto];
	     $caract_envases=$row[caract_envases];
		  $id_caract_envases=$row[id_caract_envases];
		  $id_caract_producto=$row[id_caract_producto];
	
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

for ($i=0 ; $i < 1 ; $i++){
	
$pdf->AddPage('P',array(300,280));

		  $pdf->SetY(15.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','B',15);$pdf->Cell(0,0,"$producto");
		  $pdf->Line(10,22,283,22);//horzontal 1
		  $pdf->Line(10,24,283,24);//horizontal 2

		  $pdf->Rect(10,33,130,14);
		  $pdf->SetY(40.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',13); $pdf->Cell(0,0,"CALIBRE: ");
		  $pdf->SetY(40.0);$pdf->SetX(75.0);$pdf->SetFont('Arial','b',13); $pdf->Cell(0,0,"$cal");
		  $pdf->Rect(155,33,130,14);
		  $pdf->SetY(40.0);$pdf->SetX(155.0);$pdf->SetFont('Arial','',13); $pdf->Cell(0,00,"MEDIDA:");
		  $pdf->SetY(40.0); $pdf->SetX(215.0);$pdf->SetFont('Arial','b',13); $pdf->Cell(0,00,"$medidas_productos");
		  $pdf->SetY(55.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Contenido:");
		  $pdf->SetY(55.0);$pdf->SetX(65.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$conte");
		  $pdf->SetY(55.0);$pdf->SetX(170);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Unidades");
		  $pdf->SetY(66.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Fecha de Elaboración:");
		  $pdf->SetY(66.0);$pdf->SetX(125.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$f_elaboracion");
		  $pdf->SetY(80.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Utilizar Preferentemente antes de:");
		  $pdf->SetY(80.0);$pdf->SetX(185.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$f_vencimiento");
		  $pdf->SetY(93.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Operador:");
		  $pdf->SetY(93.0);$pdf->SetX(65.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$nomope $apellope");
		  $pdf->SetY(106.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Condición:");
		  $pdf->SetY(106.0);$pdf->SetX(65.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$unidad_medida");
		  
		    if($id_caract_producto == 25){
		  $pdf->SetY(106.0);$pdf->SetX(150.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"C/E:");
		  $pdf->SetY(106.0);$pdf->SetX(170.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$caract_envases");
		  }
		  
		  $pdf->Code39(20,120,"$id_cruce_tablas$dato",3,48);
		  $pdf->SetY(176.0);$pdf->SetX(160.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"FOLIO: $dato");
		  
		  $pdf->SetY(190.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"Pais de Origen: CHILE");
		  $pdf->SetY(200.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"Registro SAG: 13-62    Resolución SESMA: 9242/04");
		  $pdf->SetY(208.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"Mantener en lugar fresco y seco a temperatura ambiental.");
		   $pdf->SetY(216.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','b',8); $pdf->Cell(0,00,"Procesadora Insuban, Ltda. ");
		   $pdf->SetY(223.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','b',8); $pdf->Cell(0,00,"Antillanca Norte 391 / Pudahuel -  Santiago");
		    //$pdf->SetY(223.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"Fono: (56-2) 739 23 77 / Fax: (56-2) 739 23 78 / www.insuban.cl / insuban@insuban.cl");
		  
		    //$pdf->SetY(230.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',8); $pdf->Cell(0,00,"Procesadora Insuban, Lta.");
		$pdf->SetY(290.0);$pdf->SetX(268.0); $pdf->Rect(5,1,285,268); //rectangulo grande
		 
	}

}
$pdf->Output();





?>
 