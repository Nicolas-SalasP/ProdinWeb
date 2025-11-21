<? 
ini_set('memory_limit', '-1');
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=inv_mpn.csv");


$sql="SELECT 
mpn.id_mat_prima_nacional,
mpn.bidon_num,  
p.producto as DescProducto,
mpn.contenido,
est.estado_material As EstFolio, 
mpn.fecha_faena, 
mpn.fecha_termino, 
mpn.fecha_venci, 
org.origen As Origen
FROM mat_prima_nacional AS mpn, 
producto AS p, 
origenes AS org, 
estado_material AS est
WHERE mpn.id_producto = p.id_producto
and mpn.id_origen = org.id_origen 
and mpn.id_estado_material = est.id_estado_material
and mpn.id_mat_prima_nacional = mpn.id_mat_prima_nacional
and mpn.fecha_faena between '2022-01-01' and '2023-12-31'
";

		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 	    
// 	    echo "Fecha;Destino;Codigo;Cantidad\n";

echo "CodFol;N_Bidon;id_mat;Producto;Calibre;contenido;estado_material;fecha_faena;f_inicio;fecha_termino;fecha_vencimiento;Origen\n"; 	    
     	 
     	 if($cuantos){
		   while ($r=mysql_fetch_array($rest)){ 

			$CodFol =($r[id_mat_prima_nacional]);			
			$N_Bidon =($r[bidon_num]);
			$cruce_tablas_id =($r[cruce_tablas_id]);
			$id_mat_prima_importada =($r[id_mat]);
			$Producto =($r[DescProducto]);
			$Calibre =($r[DescCalibre]);
			$contenido =($r[contenido]);
			$EstFolio =($r[EstFolio]);
			$fecha_faena =format_fecha_sin_hora($r[fecha_faena]);	
            $f_termino =format_fecha_sin_hora($r[fecha_termino]);
            $f_vencimiento =format_fecha_sin_hora($r[fecha_venci]);
			$Origen =($r[Origen]);				
 
//			 echo "$fecha;$destino;$codigo;$cantidad\n";

echo "$CodFol;$N_Bidon;$id_mat_prima_importada;$Producto;$Calibre;$contenido;$EstFolio;$fecha_faena;$f_inicio;$f_termino;$f_vencimiento;$Origen\n";			 
		   }
		 }
?>