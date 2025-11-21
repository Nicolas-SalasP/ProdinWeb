<?
require "../../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../../lib/funciones.php";
define('FPDF_FONTPATH','../../../clases/font/');
require('../../../clases/folio_code39.php');

 $sqlc="SELECT * FROM mat_prima_importada where etiquetados_folios_id = $idf";
 $resultc=mysql_query($sqlc);
 $cuantosc=mysql_num_rows($resultc);
 //echo "cuantosc $cuantosc";
 if($cuantosc){
 $sql="SELECT mpi.contenido AS contenido, mpi.etiquetados_folios_id AS etiquetados_folios_id, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, mpi.cruce_tablas_id AS cruce_tablas_id, p.producto AS producto, o.nombreop AS nombreop, o.apellido AS apellido FROM mat_prima_importada AS mpi, producto AS p, operarios AS o where mpi.etiquetados_folios_id = $idf and mpi.id_producto = p.id_producto and mpi.id_operarios = o.id_operarios";
 $result=mysql_query($sql);
 }else{

$a=2;
$b=$a.$idf;
$sql="SELECT mpi.contenido AS contenido, mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, mpi.cruce_tablas_id AS cruce_tablas_id, p.producto AS producto, o.nombreop AS nombreop, o.apellido AS apellido FROM mat_prima_importada AS mpi, producto AS p, operarios AS o where mpi.id_mat_prima_importada = $b and mpi.id_producto = p.id_producto and mpi.id_operarios = o.id_operarios";
 $result=mysql_query($sql);
 }


$pdf=new PDF_Code39('P','pt',array(300,280));

//$i=0;


	  if ($rowi=mysql_fetch_array($result))
      { 
	   
	  //$id_etiquetados_folios=$row[id_etiquetados_folios];
	  $producto=$rowi[producto];
	  
	  if($cuantosc)
	  {
	  $dato=$rowi[etiquetados_folios_id];  
	  }else{
	  $dato=$rowi[id_mat_prima_importada];  
	  }
	 
	 $largo=strlen($dato);
	 if($largo == 9){
	 $dato=substr($dato,1,9);
	 }
	
	  
	  $fecha_elaboracion=format_fecha_sin_hora($rowi[fecha_elaboracion]);
	  //$f_inicio=format_fecha_sin_hora($row[f_inicio]);
	  $fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
	  $cruce_tablas_id = $rowi[cruce_tablas_id];
      $nombreop=$rowi[nombreop];
	  $apellido=$rowi[apellido];
	  $contenido=$rowi[contenido];
		
		
		 $sqlcod="SELECT ct.id_cruce_tablas AS id_cruce_tablas, pro.producto AS producto, c.calibre AS calibre, um.unidad_medida AS unidad_medida, mp.medidas_productos AS medidas_productos FROM cruce_tablas AS ct, especie AS esp, producto AS pro, calibre AS c, unidad_medida AS um, medidas_productos AS mp, caract_producto AS cp, caract_envases AS ce WHERE ct.id_cruce_tablas = $cruce_tablas_id AND ct.id_especie = esp.id_especie AND ct.id_producto = pro.id_producto AND ct.id_calibre = c.id_calibre AND ct.id_unidad_medida = um.id_unidad_medida AND ct.id_medidas_productos  = mp.id_medidas_productos AND ct.id_caract_producto = cp.id_caract_producto AND ct.id_caract_envases = ce.id_caract_envases ";	  
$resultcod=mysql_query($sqlcod);
$cuantoscod=mysql_num_rows($resultcod);
//echo "sqlcod $sqlcod";

 if ($rowcod=mysql_fetch_array($resultcod))
      { 
	  $id_cruce_tablas=$rowcod[id_cruce_tablas];
	  $calibre=$rowcod[calibre];
	  $unidad_medida=$rowcod[unidad_medida];
	  $medidas_productos=$rowcod[medidas_productos];
	   }
		
	
for ($i=0 ; $i < 2 ; $i++){
$pdf->AddPage('P',array(300,280));

		  $pdf->SetY(15.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','B',15);$pdf->Cell(0,0,"$producto");
		  $pdf->Line(10,22,283,22);//horzontal 1
		  $pdf->Line(10,24,283,24);//horizontal 2

		  $pdf->Rect(10,33,130,14);
		  $pdf->SetY(40.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',13); $pdf->Cell(0,0,"CALIBRE: ");
		  $pdf->SetY(40.0);$pdf->SetX(75.0);$pdf->SetFont('Arial','b',13); $pdf->Cell(0,0,"$calibre");
		  $pdf->Rect(155,33,130,14);
		  $pdf->SetY(40.0);$pdf->SetX(155.0);$pdf->SetFont('Arial','',13); $pdf->Cell(0,00,"MEDIDA:");
		  $pdf->SetY(40.0); $pdf->SetX(215.0);$pdf->SetFont('Arial','b',13); $pdf->Cell(0,00,"$medidas_productos");
		  $pdf->SetY(55.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Contenido:");
		  $pdf->SetY(55.0);$pdf->SetX(65.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$contenido");
		  $pdf->SetY(55.0);$pdf->SetX(170);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Unidades");
		  $pdf->SetY(66.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Fecha de Recepción:");
		  //$pdf->SetY(66.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Fecha de Elaboración:");
		  $pdf->SetY(66.0);$pdf->SetX(125.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$fecha_elaboracion");
		  //$pdf->SetY(80.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Utilizar Preferentemente antes de:");
		  //$pdf->SetY(80.0);$pdf->SetX(185.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$fecha_vencimiento");
		  
		  //$pdf->SetY(93.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Operador:");
		  //$pdf->SetY(93.0);$pdf->SetX(65.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$nombreop $apellido");
		  //$pdf->SetY(106.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Condición:");
		  //$pdf->SetY(106.0);$pdf->SetX(65.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$unidad_medida");
		  
		  $pdf->SetY(80.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Operador:");
		  $pdf->SetY(80.0);$pdf->SetX(65.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$nombreop $apellido");
		  $pdf->SetY(93.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Condición:");
		  $pdf->SetY(93.0);$pdf->SetX(65.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$unidad_medida");
		  
		  if($id_caract_producto == 25){
		  $pdf->SetY(106.0);$pdf->SetX(150.0);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"C/E:");
		  $pdf->SetY(106.0);$pdf->SetX(170.0);$pdf->SetFont('Arial','b',10); $pdf->Cell(0,00,"$caract_envases");
		  }
		  $pdf->Code39(20,120,"$cruce_tablas_id$dato",3,48);
		  $pdf->SetY(176.0);$pdf->SetX(160.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"FOLIO: $dato");
		  //$pdf->SetY(190.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',7); $pdf->Cell(0,00,"Pais de Origen: CHILE");
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
 