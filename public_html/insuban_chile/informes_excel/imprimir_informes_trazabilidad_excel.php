<?
ini_set('memory_limit', '-1');
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=trazabilidad_folios_excel.csv");




		$id_paking_relacion=$id_paking_relacion;
		$id_destinos=$id_destinos;
/*
		$sql="SELECT ef.f_elaboracion AS f_elaboracion, ef.f_inicio AS f_inicio, ef.f_termino AS f_termino, ef.f_vencimiento AS f_vencimiento,ef.folio_m3 as folio_m3,  ef.id_etiquetados_folios AS id_etiquetados_folios  FROM paking AS p, etiquetados_folios As ef where p.id_paking_relacion=$id_paking_relacion and p.id_etiquetados_folios= ef.id_etiquetados_folios order by ef.folio_m3 asc";
*/
$sql="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, caract_producto cpro where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	ef.id_caract_producto = cpro.id_caract_producto
/*		and	ef.id_caract_producto not in (25,30)  **MODIFICACION PALLET ** */
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios  
/*  order by ef.nombre_alt, ef.calibre_alt, ef.id_cruce_tablas, ef.id_etiquetados_folios asc	*/
order by ef.nombre_alt, ef.calibre_alt, ef.id_etiquetados_folios asc   ";




		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 	    
 	    echo "ID;N FOLIO;Folio_Anterior;FECHA SALADO;FECHA INICIO;FECHA TERMINO;FECHA VENCIMIENTO\n";
     	
     	 if($cuantos){
		  
		   while ($r=mysql_fetch_array($rest)){ 
			$i++;
			$f_elaboracion =format_fecha_sin_hora($r[f_elaboracion]);
			$f_inicio =format_fecha_sin_hora($r[f_inicio]);
			$f_termino =format_fecha_sin_hora($r[f_termino]);
			$f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
	        $id_etiquetados_folios=$r[id_etiquetados_folios];
	        $folio_m3=$r[folio_m3]; 


	  if ($id_destinos ==351 or $id_destinos ==358 ) {

		$mess=split(" ",$r[f_elaboracion]);
 		  $mess=split("-",$mess[0]);
          $mess[2]-$mess[1]-$mess[0];
  		  $dat10=$mess[2];          
  		  $dat11=$mess[1];
  		  $dat22=$mess[0] + 2;
  		  
  		  $dat33="$dat10" . "-" . "$dat11" . "-" . "$dat22";
}else {

	$dat33=$f_vencimiento;
}
			
			 echo "$i;$folio_m3;$id_etiquetados_folios;$f_elaboracion;$f_inicio;$f_termino;$dat33\n";
		   }
		 }
		 
		

?>