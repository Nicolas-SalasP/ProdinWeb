<?
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=trazabilidad_folios_excel.csv");


		$id_paking_relacion=$id_paking_relacion;
		$sql="SELECT ef.f_elaboracion AS f_elaboracion, ef.f_inicio AS f_inicio, ef.f_termino AS f_termino, ef.f_vencimiento AS f_vencimiento,  ef.id_etiquetados_folios AS id_etiquetados_folios  FROM paking AS p, etiquetados_folios As ef where p.id_paking_relacion=$id_paking_relacion and p.id_etiquetados_folios= ef.id_etiquetados_folios order by ef.nombre_alt, ef.calibre_alt, ef.id_etiquetados_folios asc";
		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 	    echo "ID;N FOLIO;FECHA SALADO;FECHA INICIO;FECHA TERMINO;FECHA VENCIMIENTO\n";
     	 if($cuantos){
		   while ($r=mysql_fetch_array($rest)){ 
			$i++;
			$f_elaboracion =format_fecha_sin_hora($r[f_elaboracion]);
			$f_inicio =format_fecha_sin_hora($r[f_inicio]);
			$f_termino =format_fecha_sin_hora($r[f_termino]);
			$f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
	        $id_etiquetados_folios=$r[id_etiquetados_folios]; 
			
			 echo "$i;$id_etiquetados_folios;$f_elaboracion;$f_inicio;$f_termino;$f_vencimiento\n";
		   }
		 }
		 
		

?>