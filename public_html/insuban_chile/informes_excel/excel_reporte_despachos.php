<? 
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

header("Content-Type: application/vnd.ms-excel");
//header("Expires: 0");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_despachos.csv");

$fecha_despacho_desde=$fecha_despacho_desde;
$fecha_despacho_hasta=$fecha_despacho_hasta;


$sql="SELECT etf.fdespacho_piking, etf.ano, dst.destinos, prd.producto, cal.calibre , etf.contenido_unidades, etf.factura
FROM pedido_tabla as pdt
left outer join etiquetados_folios as etf on etf.id_pedidos=pdt.id_pedidos
left outer join destinos as dst on etf.id_destinos=dst.id_destinos
left outer join producto as prd on prd.id_producto=etf.id_producto
left outer join calibre as cal on cal.id_calibre=etf.id_calibre
where etf.fdespacho_piking between '$fecha_despacho_desde' and '$fecha_despacho_hasta' order by etf.fdespacho_piking asc ";

		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 	    
// 	    echo "Fecha;Destino;Codigo;Cantidad\n";

echo "FECHA;ANO;CLIENTE;PRODUCTO;CALIBRE;CANTIDAD;FACTURA\n"; 	    
     	 
     	 if($cuantos){
		   while ($r=mysql_fetch_array($rest)){ 

            	$producto =$r[producto];
            	$calibre =$r[calibre];
            	$contenido_unidades =$r[contenido_unidades];
              $destinos =$r[destinos];
              $fdespacho_piking =format_fecha_sin_hora($r[fdespacho_piking]);
              $ano =$r[ano];
              $factura =$r[factura];

echo "$fdespacho_piking;$ano;$destinos;$producto;$calibre;$contenido_unidades;$factura\n";			 
		   }
		 }
		
?>