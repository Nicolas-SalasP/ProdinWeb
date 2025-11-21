<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
define('FPDF_FONTPATH','clases/font/');
require('clases/code39_etiquetas_barras.php');

if($imprimir){
$fhoy=date("y");

$sql="select * from etiqueta_material where id_procedencia='$id_procedencia' order by fecha_emision desc ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

//echo "SQL $sql";
if ($cuantos)
$row=mysql_fetch_array($result);

 $hasta= $row[hasta] + 1;
 $valor= $row[hasta] + $cantidad;

  $fecha_emision=date("Y-m-d H:i:s");
  $sql_nuevo="insert into etiqueta_material  (id_procedencia,fhoy,desde,hasta,fecha_emision,id_operarios) values ('$id_procedencia','$fhoy',$hasta,$valor,'$fecha_emision',$id_operarios)";
  $result_nuevo=mysql_query($sql_nuevo,$link);



//$pdf=new PDF_Code39('P','mm',array(110,280));
//$pdf->AddPage('P',array(110,280));

$pdf=new PDF_Code39('P');
$pdf->AddPage('P');
$y=10;
for ($i=0 ; $i < $cantidad ; $i++)
   {
   $count++;
   $c2++;
   $num=$hasta + $i;
  

   
   $text="$id_procedencia".$fhoy.$num;
   $mod=$count % 1;
   $pdf->Code39(0,$y,"$text",1,10);
   $pdf->Code39(54,$y,"$text",1,10);
   $y = $y + 35;
   
   if ($count == 3) {
   //$pdf->AddPage('P',array(110,280));
   $pdf->AddPage('P');
   $count=0;
   $y=10;
   }
   }
$pdf->Output();
}   
?>
