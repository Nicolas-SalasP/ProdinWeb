<?
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";
include ('class.ezpdf.php');
require('folio_code39.php');
// $pdf = new Cezpdf('LETTER');
$pdf =& new Cezpdf(array(0,0,300,280));
//$pdf->ezSetCmMargins(1,1,1,1);

$sqldes="SELECT * from destinos where id_destinos = $id_destinos";
$restdes=mysql_query($sqldes);
while ($rdes=mysql_fetch_array($restdes)){ 
$direccion=$rdes[domicilio];	
$ciudad=$rdes[ciudad];	
$destinos=$rdes[destinos];
$pais=$rdes[pais];
 //echo $pais;
}

$id_paking_relacion=$id_paking_relacion;

$cantifo=$cantifo;

$query1= "SELECT count(id_etiquetados_folios) as total from paking where id_paking_relacion= $id_paking_relacion";
$rquery1=mysql_query($query1);
$row=mysql_fetch_array($rquery1);
$count=$row[total];



				$sql="SELECT ef.nombre_alt, ef.calibre_alt , ef.folio_m3 , ef.contenido_unidades , ef.id_etiquetados_folios AS id_etiquetados_folios,(select min(mn.fecha_faena) from folios_mat as fm, mat_prima_nacional as mn where fm.id_etiquetados_folios = ef.id_etiquetados_folios and mn.id_mat_prima_nacional = fm.id_mat) as faena_fecha_inicio,(select max(mn.fecha_termino) from folios_mat as fm, mat_prima_nacional as mn where fm.id_etiquetados_folios = ef.id_etiquetados_folios and mn.id_mat_prima_nacional = fm.id_mat) as faena_fecha_termino,ef.f_inicio AS f_inicio,ef.f_termino AS f_termino,ef.f_vencimiento AS f_vencimiento FROM paking AS p,  etiquetados_folios As ef where p.id_paking_relacion= $id_paking_relacion and p.id_etiquetados_folios= ef.id_etiquetados_folios order by ef.nombre_alt, ef.calibre_alt, ef.id_etiquetados_folios asc";



				$rest=mysql_query($sql);
				$cuantos=mysql_num_rows($rest);
		 
				 if($cuantos){
				   while ($r=mysql_fetch_array($rest)){ 
					$i++;
					//$f_elaboracion =format_fecha_sin_hora($r[f_elaboracion]);
					$f_faena_ini =format_fecha_sin_hora($r[faena_fecha_inicio]);
					$f_faena_fin =format_fecha_sin_hora($r[faena_fecha_termino]);
					$f_inicio =format_fecha_sin_hora($r[f_inicio]);
					$f_termino =format_fecha_sin_hora($r[f_termino]);
					$f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
					$id_etiquetados_folios=$r[id_etiquetados_folios];
					$contenido=$r[contenido_unidades];
					$nalt=$r[nombre_alt]; 					 					 
					$calt=$r[calibre_alt];
					$folio_m3=$r[folio_m3];



$pdf->selectFont('/fonts/Helvetica.afm');

$pdf->ezImage("pamplona.png", 0, 60, 'none', 'left');
$pdf->ezText(utf8_decode("<b>Importador: 	AIN GLOBAL Importação e Exportação Ltda.</b>"),9);
$pdf->ezText(utf8_decode("			          Rua Dona Francisca, 8300 - Bloco 10 
													Modulo C Distrito Industrial
													CEP: 89.219-600, Joinville/SC 
													Brasil CNPJ: 10.291.570/0001-31"),10);

$pdf->ezText('', 10);

$pdf->ezText(utf8_decode("<b>Comprador: 	PAMPLONA ALIMENTOS S/A</b>"),9);
$pdf->ezText(utf8_decode("			          Rodovia BR-470, KM 150, N° 13891 
													CEP: 89.164-900, Rio do Sul/SC - Brasil 
													CNPJ: 85.782.878/0001-89"),10);

$pdf->ezText('', 10);																
$pdf->ezText("<b>Bombona:</b> $i / $cantifo",10);
$pdf->ezText(utf8_decode("<b>Quantidade: $contenido MAÇOS</b>"),10);
$pdf->ezText("<b>Calibre: $calt </b>  ",10);
}
}

$pdf->ezStream();
?>