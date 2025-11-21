<? 
ini_set('memory_limit', '-1');
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=inv_mpi.csv");


$sql="SELECT CONCAT(cruce_tablas_id,RIGHT(mpi.id_mat_prima_importada, 8)) as CodFol,
mpi.cruce_tablas_id,
RIGHT(mpi.id_mat_prima_importada, 8) as id_mat,
pr.producto as DescProducto,
cl.calibre as DescCalibre,
mpi.contenido, 
est.estado_material,
mpi.bidon_num,
mpi.fecha_elaboracion, 
mpi.f_inicio, 
mpi.fecha_termino, 
mpi.fecha_vencimiento, 
mpi.folio_m3_mpi
FROM mat_prima_importada mpi
       LEFT OUTER JOIN cruce_tablas as ct on mpi.id_cruce_tablas = ct.id_cruce_tablas
       LEFT OUTER JOIN producto as pr on mpi.id_producto = pr.id_producto
       LEFT OUTER JOIN calibre as cl on mpi.id_calibre = cl.id_calibre
       LEFT OUTER JOIN estado_material as est on mpi.id_estado_material = est.id_estado_material
       ";

		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 	    
// 	    echo "Fecha;Destino;Codigo;Cantidad\n";

echo "CodFol;cruce_tablas_id;id_mat;Producto;Calibre;Contenido;Estado_material;Bidon;fecha_elaboracion;f_inicio;fecha_termino;fecha_vencimiento;Cod_M3\n"; 	    
     	 
     	 if($cuantos){
		   while ($r=mysql_fetch_array($rest)){ 

			$CodFol =($r[CodFol1]);			
			$cruce_tablas_id =($r[cruce_tablas_id]);
			$id_mat_prima_importada =($r[id_mat]);
			$Producto =($r[DescProducto]);
			$Calibre =($r[DescCalibre]);
			$contenido =($r[contenido]);
			$EstFolio =($r[estado_material]);
			$bidon =($r[bidon_num]);
			$f_elaboracion =format_fecha_sin_hora($r[fecha_elaboracion]);	
            $f_inicio =format_fecha_sin_hora($r[f_inicio]);
            $f_termino =format_fecha_sin_hora($r[fecha_termino]);
            $f_vencimiento =format_fecha_sin_hora($r[fecha_vencimiento]);
			$folio_m3_mpi =($r[folio_m3_mpi]);            
 
//			 echo "$fecha;$destino;$codigo;$cantidad\n";

echo "$CodFol;$cruce_tablas_id;$id_mat_prima_importada;$Producto;$Calibre;$contenido;$EstFolio;$bidon;$f_elaboracion;$f_inicio;$f_termino;$f_vencimiento;$folio_m3_mpi\n";			 
		   }
		 }
		

?>