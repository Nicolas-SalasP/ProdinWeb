<?
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=folios_comercial.csv");


$sql="SELECT pd.fecha_prioridad,ds.destinos,ef.id_cruce_tablas,pr.producto,cl.calibre,pt.cantidadb
FROM pedido_tabla as pt, pedido as pd, destinos as ds, etiquetados_folios as ef, producto as pr, calibre as cl
where pt.id_pedidos = pd.id_pedidos and pd.id_destinos = ds.id_destinos
and pt.id_cruce_tablas = ef.id_cruce_tablas and pd.folio_piking = 0 
and ef.id_producto = pr.id_producto and ef.id_calibre = cl.id_calibre
and pd.fecha_prioridad != '0000-00-00' group by pt.id_cruce_tablas
order by pt.id_cruce_tablas, pd.fecha_prioridad desc";

		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 	    
 	    echo "Fecha;Destino;Codigo;Producto;Calibre;Cantidad\n";
     	 
     	 if($cuantos){
		   while ($r=mysql_fetch_array($rest)){ 
			$i++;
			$codigo =($r[id_cruce_tablas]);
			$destino =($r[destinos]);
			$fecha =format_fecha_sin_hora($r[fecha_prioridad]);
			$cantidad =($r[cantidadb]);
			$producto =($r[producto]);
			$calibre =($r[calibre]);
	        
			 echo "$fecha;$destino;$codigo;$producto;$calibre;$cantidad\n";
		   }
		 }
		

?>