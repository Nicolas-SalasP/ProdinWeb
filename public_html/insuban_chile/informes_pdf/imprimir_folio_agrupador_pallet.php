<?
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";
define('FPDF_FONTPATH','../clases/font/');
require('../clases/folio_code39.php');


$pdf=new PDF_Code39('P','pt',array(300,280));


		   $sql2="SELECT * FROM  etiquetados_folios AS ef, producto AS p, caract_envases AS cenv  where ef.pallet ='$pallet' and ef.id_producto = p.id_producto and ef.id_caract_envases = cenv.id_caract_envases";
 		   $result2=mysql_query($sql2);
           $cuantos2=mysql_num_rows($result2);

 if ($row2=mysql_fetch_array($result2)){
			   $id_cruce_tablas = $row2[id_cruce_tablas];
			   $producto = $row2[producto];
			     $id_caract_envases=$row2[id_caract_envases];
		  $caract_envases=$row2[caract_envases];
			   
			   $pallet = $row2[pallet];
	   
		
	
	for ($i=0 ; $i < 2 ; $i++){
	
			$pdf->AddPage('P',array(300,280));

		   $pdf->SetY(15.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','B',15);$pdf->Cell(0,0,"$producto");
		   $pdf->SetY(15.0);$pdf->SetX(200.0);$pdf->SetFont('Arial','B',12);$pdf->Cell(0,0,"C/E: $caract_envases");
		   $pdf->Line(10,22,283,22);//horzontal 1
		   $pdf->Line(10,24,283,24);//horizontal 2
		   $pdf->SetY(90.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','B',50);$pdf->Cell(0,0,"COD: $id_cruce_tablas");
		   $pdf->SetY(170.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','B',80);$pdf->Cell(0,0,"P:$pallet");
		   $pdf->Rect(5,5,290,270);
	       		   
		   $pdf->SetY(35.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','B',15);$pdf->Cell(0,0,"CAJAS: $fin");
	
		   
		   
		   // $pdf->Code39(145,58,"$union",1,12);
			    //$pdf->SetY(75.8);$pdf->SetX(170.0);$pdf->SetFont('Arial','',12);$pdf->Cell(0,0,"$id_cruce_tablas$idcod");
			   
		      //$pdf->SetY(45.1);$pdf->SetX(30.0);$pdf->SetFont('Arial','',90);$pdf->Cell(0,0,"$id_cruce_tablas$idcod");
		 	   //$pdf->SetY(75.1);$pdf->SetX(10.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"COD $id_cruce_tablas");
			   //$pdf->SetY(75.1);$pdf->SetX(40.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"$producto");
			   //$pdf->SetY(75.1);$pdf->SetX(100.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"CAJAS $fin");
	  
			   }

 }

//}
$pdf->Output();





?>
 