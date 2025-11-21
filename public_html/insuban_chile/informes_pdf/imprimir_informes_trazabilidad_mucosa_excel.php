<?
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

  $id_paking_relacion=$id_paking_relacion; 
$sql_buscar="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, origenes AS org where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_origen = org.id_origen
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc	";
$result=mysql_query($sql_buscar);


header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=trazabilidad_mucosa_origen.csv");


 echo "N;FOLIO;FECHA INICIO;FECHA TERMINO;FECHA VENCIMIENTO;ORIGEN\n";
  while ($r=mysql_fetch_array($result)) { 

	$i++;
			$f_elaboracion =format_fecha_sin_hora($r[f_elaboracion]);
			//$f_inicio =format_fecha_sin_hora($r[f_inicio]);
			$f_termino =format_fecha_sin_hora($r[f_termino]);
			$f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
	        $id_etiquetados_folios=$r[id_etiquetados_folios]; 
			 $origen=$r[origen]; 


  
echo "$i;$id_etiquetados_folios;$f_inicio;$f_termino;$f_vencimiento;$origen\n";






  }
?>