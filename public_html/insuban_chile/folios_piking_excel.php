<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=piking_folios_excel.csv");


$id_paking_relacion=$id_paking_relacion;

$sql="SELECT p.id_paking_relacion,
ef.id_cruce_tablas, 
ef.id_etiquetados_folios, 
ef.folio_pt_antiguo, 
ef.f_elaboracion,
ef.f_termino,
ef.folio_m3, 
e.especie as especie, 
ef.id_producto, ef.nombre_alt as producto,
ef.id_calibre, ca.calibre as calibre,
ef.id_medidas_productos, mpr.medidas_productos as med_prod,
cpr.caract_producto as caract_producto,
ef.contenido_unidades, 
pra.id_procedencia as procedencia
from paking AS p, etiquetados_folios As ef, especie As e, producto As pr, calibre As ca, medidas_productos As mpr, caract_producto As cpr, procedencia As pra 
where p.id_etiquetados_folios = ef.id_etiquetados_folios
and e.id_especie = ef.id_especie
and pr.id_producto = ef.id_producto
and ca.id_calibre = ef.id_calibre
and mpr.id_medidas_productos = ef.id_medidas_productos
and cpr.id_caract_producto = ef.id_caract_producto
and p.id_paking_relacion=$id_paking_relacion
and pra.id_procedencia=ef.id_procedencia
group by p.id_etiquetados_folios order by ef.folio_m3 ";

		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);

 	    echo "Contador;Cod;Folio PT;Folio_antiguo;f/Elaboracion;f/Termino;Especie;Producto;Calibre;Medida;Caract/Prod;Cant;des.\n";
     	 
     	 if($cuantos){
		   while ($r=mysql_fetch_array($rest)){ 

			$i++;
			$id_cruce_tablas =$r[id_cruce_tablas];
			$folio_m3 =$r[folio_m3];
			$id_etiquetados_folios =$r[id_etiquetados_folios];
			$f_elaboracion =format_fecha_sin_hora($r[f_elaboracion]);
			$f_termino =format_fecha_sin_hora($r[f_termino]);			
			$especie =$r[especie];
	        $producto=$r[producto]; 
			$calibre=$r[calibre];
			$medidas_productos=$r[med_prod];
			$caract_producto=$r[caract_producto];
			$contenido_unidades=$r[contenido_unidades]; 
			$procedencia=$r[procedencia]; 

			$prodCal = $producto." ".$calibre;

			if($procedencia == 'N'){
				$procedencia = 'Nacional';
			}

			 echo "$i;$id_cruce_tablas;$folio_m3;$id_etiquetados_folios;$f_elaboracion;$f_termino;$especie;$producto;$calibre;$medidas_productos;$caract_producto;$contenido_unidades;$prodCal\n";
			
		   
		   }
		 }
		 
		

?>