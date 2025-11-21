<?

require "../../lib/conexion.php";

$link = mysql_connect("$localhost","$user","$pass");

mysql_select_db("$db");

require "../../lib/funciones.php";



//if(!$year){ $year=date("Y");}else{$year=$year;}



$sql="SELECT mpi.comprobante_num, mpi.id_mat_prima_importada, p.producto, cal.calibre, org.origen, mpi.contenido, mpi.bidon_num, mpi.fecha_ingreso, mpi.fecha_asig_producc, mpi.fecha_termino, mpi.fecha_vencimiento, est.estado_material FROM mat_prima_importada AS mpi, 

producto AS p,

origenes AS org, 

estado_material AS est,

calibre AS cal

WHERE mpi.id_producto = p.id_producto

and mpi.id_calibre = cal.id_calibre 

and mpi.id_origen = org.id_origen 

and mpi.id_estado_material = est.id_estado_material

and mpi.ano between 2017 and 2018

ORDER BY origen ASC";

$result=mysql_query($sql);

$cuantos=mysql_num_rows($result);



header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=informe_mpi.csv");



echo "N_COMPROBANTE;FOLIO;PRODUCTO;CALIBRE;ORIGEN;CONTENIDO;N_BIDON;F/FAENA;F/VENC;ESTADO\n";



 while ($row=mysql_fetch_array($result))

  {

	$comprobante_num=$row[comprobante_num];

	$id_mat_prima_importada=$row[id_mat_prima_importada];

	$producto=$row[producto];

	if(!$id_calibre){$calibre = "Original";}else{$calibre = $row[calibre];}

//	$calibre=$row[calibre];

	$origen=$row[origen];

	$contenido=$row[contenido];

	$bidon_num=$row[bidon_num];

	$fecha_faena=$row[fecha_ingreso];

	$fecha_venci=$row[fecha_vencimiento];

	$estado_material=$row[estado_material];



	$codigo= $comprobante_num.$id_mat_prima_importada.$producto.$calibre.$origen.$contenido.$bidon_num.$fecha_faena.$fecha_vencimiento.$estado_material;



    echo "$comprobante_num;$id_mat_prima_importada;$producto;$calibre;$origen;$contenido;$bidon_num;$fecha_faena;$fecha_venci;$estado_material\n"; 

  }



?>