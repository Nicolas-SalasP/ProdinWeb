<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
define('FPDF_FONTPATH','clases/font/');
require('clases/code39.php');


 $sql="SELECT * FROM etiquetados_folios AS ef, producto AS p, calibre AS c where ef.id_etiquetados_folios='$id_etiquetados_folios' and ef.id_producto = p.id_producto and ef.id_calibre=c.id_calibre";
 $result=mysql_query($sql);
 $cuantos=mysql_num_rows($result);
 
 $sql2="SELECT * FROM etiquetados_folios AS ef, operarios AS o where ef.id_etiquetados_folios='$id_etiquetados_folios' and ef.id_operarios = o.id_operarios";
 $result2=mysql_query($sql2);
 $cuantos2=mysql_num_rows($result2);
 
 $sql3="SELECT * FROM etiquetados_folios AS ef, medidas_productos AS mp where ef.id_etiquetados_folios='$id_etiquetados_folios' and ef.id_medidas_productos=mp.id_medidas_productos";
 $result3=mysql_query($sql3);
 $cuantos3=mysql_num_rows($result3);


$pdf=new PDF_Code39();
$pdf->AddPage();
$i=0;

	  if ($row=mysql_fetch_array($result))
      { 
	  $id_etiquetados_folios=$row[id_etiquetados_folios];
	  $f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	  $f_inicio=format_fecha_sin_hora($row[f_inicio]);
	  $f_termino =format_fecha_sin_hora($row[f_termino]);
	  $f_vencimiento=format_fecha_sin_hora($row[f_vencimiento]);
       
		if ($row3=mysql_fetch_array($result3))
        { 
		 $nom=$row[nombre];
		 $cal=$row[calibre];
		 $nom_medida=$row3[nombre];
		 $dato=$row3[id_etiquetados_folios];
		 $conte=$row[contenido_unidades];
		 
		if ($row2=mysql_fetch_array($result2))
        { 
	    $nomope=$row2[nombre];
	    $apellope=$row2[apellido];
	    }
		 
		  $pdf->SetFont('Arial','B',18);
		  $pdf->SetY(10);$pdf->SetX(10);$pdf->Cell(0,0,"$nom");
		  $pdf->Line(10,15,100,15);//horzontal 1
		  $pdf->Line(10,16,100,16);//horizontal 2
		  $pdf->Rect(10,17,40,6,$style='');
		  $pdf->SetY(20);$pdf->SetX(10);$pdf->SetFont('Arial','',11); $pdf->Cell(0,0,"CALIBRE: ");
		  $pdf->SetY(20);$pdf->SetX(30);$pdf->SetFont('Arial','b',11); $pdf->Cell(0,0,"$cal");
		  $pdf->Rect(60,17,40,6,$style='');
		  $pdf->SetY(20);$pdf->SetX(60);$pdf->SetFont('Arial','',11); $pdf->Cell(0,00,"MEDIDA:");
		  $pdf->SetY(20); $pdf->SetX(79);$pdf->SetFont('Arial','b',11); $pdf->Cell(0,00,"$nom_medida");
		  $pdf->SetY(30);$pdf->SetX(10);$pdf->SetFont('Arial','',11); $pdf->Cell(0,00,"Contenido:");
		  $pdf->SetY(30);$pdf->SetX(33);$pdf->SetFont('Arial','b',11); $pdf->Cell(0,00,"$conte");
		  $pdf->SetY(30);$pdf->SetX(45);$pdf->SetFont('Arial','',11); $pdf->Cell(0,00,"Unidades");
		  $pdf->SetY(35);$pdf->SetX(10);$pdf->SetFont('Arial','',11); $pdf->Cell(0,00,"Fecha de Elaboración:");
		  $pdf->SetY(35);$pdf->SetX(54);$pdf->SetFont('Arial','b',11); $pdf->Cell(0,00,"$f_elaboracion");
		  $pdf->SetY(40);$pdf->SetX(10);$pdf->SetFont('Arial','',11); $pdf->Cell(0,00,"Utilizar Preferentemente antes de:");
		  $pdf->SetY(40);$pdf->SetX(75);$pdf->SetFont('Arial','b',11); $pdf->Cell(0,00,"$f_vencimiento");
		  $pdf->SetY(45);$pdf->SetX(10);$pdf->SetFont('Arial','',11); $pdf->Cell(0,00,"Operador:");
		  $pdf->SetY(45);$pdf->SetX(30);$pdf->SetFont('Arial','b',11); $pdf->Cell(0,00,"$nomope $apellope");
		  $pdf->SetY(55);$pdf->SetX(20);$pdf->Code39(30,55,"$dato",1,10);
		  $pdf->SetY(85);$pdf->SetX(10);$pdf->SetFont('Arial','',11); $pdf->Cell(0,00,"PAIS DE ORIGEN: CHILE");
		  $pdf->SetY(90);$pdf->SetX(10);$pdf->SetFont('Arial','',11); $pdf->Cell(0,00,"Registro SAG: 13-62    Resolución SESMA: 9242/04");
		  $pdf->SetY(95);$pdf->SetX(10);$pdf->SetFont('Arial','',10); $pdf->Cell(0,00,"Mantener en lugar fresco y seco a temperatura ambiental.");
		  $pdf->Rect(5,5,100,100,$style='');
	}

$pdf->Output();

}?>
 