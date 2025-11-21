<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
define('FPDF_FONTPATH','clases/font/');
require('clases/code39_faja.php');

$fajas_emitidas=$fajas_emitidas;

	 $sql="SELECT * FROM fajas where id_faja='$id_faja'";
 $result=mysql_query($sql);
 $cuantos=mysql_num_rows($result);
 
 
//$pdf=new FPDF('P','pt',array(112,1008));
//$pdf->AddPage('P',array(112,1008));
 
//$pdf=new FPDF('P','cm','Letter');
//$pdf->AddPage('P','Letter'); 


//$pdf=new PDF_Code39();
//$pdf->AddPage();

$pdf=new PDF_Code39('P','mm',array(100,205));


 $sql2="SELECT * FROM fajas where id_faja='$id_faja'";
 $result2=mysql_query($sql2);

if ($row2=mysql_fetch_array($result2)){
    $fajas_emitidas=$row2[fajas_emitidas];
	//$pdf->SetY(5.0);$pdf->SetX(15.0);$pdf->SetFont('Arial','',11);$pdf->Cell(0,0,"$row2[fajas_emitidas]");
}

for ($i=0 ; $i < $fajas_emitidas ; $i++){ 
$id_faja=$id_faja;
$id_faja_ok=$id_faja++;
for ($j=0 ; $j < 2 ; $j++){
$pdf->AddPage('P',array(95,200));
	  if ($row=mysql_fetch_array($result))
	  {
      $id_faja=$row[id_faja];
      $loten=$row[loten];
	  $neto=$row[neto];
	  $fvencimiento=$row[fvencimiento];
	  $femision=$row[femision];
	  }
	      
		 
		 // $pdf->SetY(5.0);$pdf->SetX(5.0);$pdf->SetFont('Arial','',12);$pdf->Cell(0,0,"dato $fajas_emitidas");
	      $pdf->Rect(2,2,90,199); //rectangulo grande
		  $pdf->SetY(10.0);$pdf->SetX(17.0);$pdf->SetFont('Arial','',11);$pdf->Cell(0,0,'MINISTERIO DE AGRICULTURA');
		  $pdf->SetY(15.0);$pdf->SetX(27.0);$pdf->SetFont('Arial','',11);$pdf->Cell(0,0,'SERVICIO AGRICOLA');
		  $pdf->SetY(20.0);$pdf->SetX(36.0);$pdf->SetFont('Arial','',11);$pdf->Cell(0,0,'Y GANADERO');
		  $pdf->SetY(25.0);$pdf->SetX(44.0);$pdf->SetFont('Arial','',11);$pdf->Cell(0,0,'CHILE');
		  
     	
		  $pdf->Image('jpg/Sello13-62.JPG',27,28,45,60);
		
		  $pdf->SetY(93);$pdf->SetX(30.0);$pdf->SetFont('Arial','',12);$pdf->Cell(0,0,"N. $id_faja");
		  $pdf->Code39(5,110," $id_faja",1,12);
		  $pdf->SetY(126.0);$pdf->SetX(5.0);$pdf->SetFont('Arial','',12);$pdf->Cell(0,0,"N. $id_faja");
		 		  
  		   
		   $id_producto2=$row[id_producto];
		   $sql2="SELECT * FROM  producto where id_producto='$id_producto2' and id_producto != 0";
 		   $result2=mysql_query($sql2);
           $cuantos2=mysql_num_rows($result2);
		   while ($row2=mysql_fetch_array($result2)){
		       $nombre_pro=$row2[producto];
			}
		  $pdf->SetY(130.1);$pdf->SetX(10.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"$nombre_pro");
		  $pdf->Line(5,133,89,133);//horzontal 1
		  
		  $pdf->SetY(136.1);$pdf->SetX(10.0);$pdf->SetFont('Arial','',7);$pdf->Cell(0,0,'Origin of Product');
		  $pdf->SetY(139.1);$pdf->SetX(10.0);$pdf->SetFont('Arial','',7);$pdf->Cell(0,0,'Origen de Producto');
		  $pdf->SetY(137.1);$pdf->SetX(40.0);$pdf->SetFont('Arial','',7);$pdf->Cell(0,0,'Procesadora Insuban Ltda. SAG 13-62');
		  
		  $pdf->SetY(148.1);$pdf->SetX(10.0);$pdf->SetFont('Arial','',11);$pdf->Cell(0,0,'Net Weight / Peso Neto');
		  $pdf->SetY(148.1);$pdf->SetX(60.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"$neto");
		  $pdf->SetY(148.1);$pdf->SetX(70.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,'Kg.');
		  
		   $pdf->SetY(154.1);$pdf->SetX(10.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,'Production Date / Elaboración');
		   $pdf->SetY(154.1);$pdf->SetX(60.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"$femision");
		   $pdf->SetY(159.1);$pdf->SetX(10.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,'Expiry Date / Vencimiento');
   		   $pdf->SetY(159.1);$pdf->SetX(60.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"$fvencimiento");
		  		  
		   $pdf->SetY(165.1);$pdf->SetX(10.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,'Lote');
		   $pdf->SetY(169.1);$pdf->SetX(10.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,"$loten");
		   
		   $pdf->SetY(165.1);$pdf->SetX(25.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,'PRODUCT');
		   $pdf->SetY(169.1);$pdf->SetX(25.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,'OF CHILE');
		   
		   $pdf->SetY(165.1);$pdf->SetX(45.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,'KEEP FROZEN');
		   $pdf->SetY(169.1);$pdf->SetX(45.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,'Mantener Congelado a - 18 C');
		   
		   $pdf->Line(5,172,89,172);//horzontal 1
		   $pdf->SetY(176.1);$pdf->SetX(10.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,'Produce by:');
		   $pdf->SetY(176.1);$pdf->SetX(45.0);$pdf->SetFont('Arial','',9);$pdf->Cell(0,0,'Procesadora Insuban Ltda.');
		   $pdf->SetY(180.0);$pdf->SetX(10.0);$pdf->SetFont('Arial','',9); $pdf->Cell(0,0,'Registro SAG: 13-62');
		   $pdf->SetY(179.0);$pdf->SetX(45.0);$pdf->SetFont('Arial','',5); $pdf->Cell(0,0,'Antillanca Norte 391. Pudahuel, Santiago -  Chile');
		   $pdf->SetY(181.0);$pdf->SetX(45.0);$pdf->SetFont('Arial','',5); $pdf->Cell(0,0,'Phone (562) 7392377 -  Fax: (562) 7392378');
		   $pdf->SetY(183.0);$pdf->SetX(45.0);$pdf->SetFont('Arial','',5); $pdf->Cell(0,0,'E-mail: insuban@insuban.cl');
		   }

} 
	
$pdf->Output();

?>
 