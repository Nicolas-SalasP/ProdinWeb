<?
ini_set('memory_limit', '-1');
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=folios_comercial.csv");


$sql="SELECT *
FROM pedido_tabla as pt 
left outer join pedido as pd on pt.id_pedidos = pd.id_pedidos 
left outer join destinos as ds on pd.id_destinos = ds.id_destinos
left outer join cruce_tablas as ct on pt.id_cruce_tablas = ct.id_cruce_tablas
left outer join producto as pr on ct.id_producto = pr.id_producto
left outer join calibre as cl on ct.id_calibre = cl.id_calibre
where pd.folio_piking = 0 and pd.fecha_prioridad != '0000-00-00' 
order by pd.fecha_prioridad desc, pt.id_cruce_tablas";

$rest=mysql_query($sql);
$cuantos=mysql_num_rows($rest);

    echo "Fecha;Destino;Codigo;Producto;Calibre;Requeridos;Listos\n";
     	 
     	 if($cuantos){
		   while ($r=mysql_fetch_array($rest)){ 
			$i++;
			$codigo =($r[id_cruce_tablas]);
			$destino =($r[destinos]);
			$fecha =format_fecha_sin_hora($r[fecha_prioridad]);
			$requeridos =($r[cantidadb]);
			$producto =($r[producto]);
			$calibre =($r[calibre]);
			$pedido =($r[id_pedidos]);

$sqlto="SELECT * FROM pedido_armado_automatico where id_pedidos=$pedido and id_cruce_tablas=$codigo";
$resulto=mysql_query($sqlto);
$listos=mysql_num_rows($resulto);


	 echo "$fecha;$destino;$codigo;$producto;$calibre;$requeridos;$listos\n";
		   }
		}
?>