<?

require_once('class_pdf/class.ezpdf.php');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('class_pdf/fonts/courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5); 

/*require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
*/

$conexion = mysql_connect("localhost", "$user", "$pass");
mysql_select_db("sistema_insuban", $conexion);
$queEmp = "SELECT id_bodegas, bodegas FROM bodegas";
$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp); 




$ixx = 0;
while($datatmp = mysql_fetch_assoc($resEmp)) { 
    $ixx = $ixx+1;
    $data[] = array_merge($datatmp, array('num'=>$ixx));
}
$titles = array(
                'id_bodegas'=>'<b>Id_Codigo</b>',
                'bodegas'=>'<b>Bodegas</b>',
                );
$options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>500
            ); 
			
			
$txttit = "<b>Articulos Prod. Semanal</b>\n";
$txttit.= "Procesadora Insuban Ltda \n";
 
$pdf->ezText($txttit, 12);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream(); 


 ?>