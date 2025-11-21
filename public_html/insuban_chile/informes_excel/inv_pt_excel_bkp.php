<? 
ini_set('memory_limit', '-1');
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=inv_pt.csv");


$sql="SELECT CONCAT(pt.id_cruce_tablas,pt.id_etiquetados_folios) As CodFol,
pt.id_cruce_tablas,
pt.id_etiquetados_folios,
pt.ano, 
pr.producto as Producto,
cl.calibre as Calibre,
mp.medidas_productos as DescMedProd,
ce.caract_envases as DescCarEnv,
cp.caract_producto as DescCarProd,
um.unidad_medida as DescUndMedida,
pt.contenido_unidades,
edf.estado_folio As EstFolio,
pt.f_elaboracion, 
pt.f_inicio, 
pt.f_termino, 
pt.f_vencimiento, 
org.origen as Origen,
pt.factura_importada,
pt.bidon_importado, 
des.destinos as Destinos,
pt.fbodega,
pt.fdespacho_piking,
pt.ffacturacion_piking,
pt.guia, 
pt.factura, 
pt.id_pedidos, 
pt.fech_generada_inicio,
pt.folio_m3
  From etiquetados_folios pt
       LEFT OUTER JOIN cruce_tablas as ct on pt.id_cruce_tablas = ct.id_cruce_tablas
       LEFT OUTER JOIN especie as ep on ct.id_especie = ep.id_especie
       LEFT OUTER JOIN producto as pr on ct.id_producto = pr.id_producto
       LEFT OUTER JOIN calibre as cl on ct.id_calibre = cl.id_calibre
       LEFT OUTER JOIN unidad_medida as um on ct.id_unidad_medida = um.id_unidad_medida
       LEFT OUTER JOIN medidas_productos as mp on ct.id_medidas_productos = mp.id_medidas_productos
       LEFT OUTER JOIN caract_producto as cp on ct.id_caract_producto = cp.id_caract_producto
       LEFT OUTER JOIN caract_envases as ce on ct.id_caract_envases = ce.id_caract_envases             
       Left outer join origenes as org on pt.id_origen = org.id_origen
       left outer join destinos as des on pt.id_destinos = des.id_destinos
       left outer join estado_folio as edf on pt.id_estado_folio = edf.id_estado_folio    
       ";

		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 	    
// 	    echo "Fecha;Destino;Codigo;Cantidad\n";

echo "Cod_M3;CodFol;id_cruce_tablas;id_etiquetados_folios;ano;Producto;Calibre;DescMedProd;DescCarEnv;DescCarProd;DescUndMedida;Contenido;EstFolio;f_elaboracion;f_inicio;f_termino;f_vencimiento;Origen;F/import;bidon_importado;Destinos;fbodega;fdespacho_piking;ffacturacion_piking;guia;factura;pedidos;fech_generada_inicio\n"; 	    
     	 
     	 if($cuantos){
		   while ($r=mysql_fetch_array($rest)){ 

            	$CodFol =$r[CodFol];			
            	$id_cruce_tablas =$r[id_cruce_tablas];
            	$id_etiquetados_folios =$r[id_etiquetados_folios];
            	$Producto =$r[Producto];
            	$Calibre =$r[Calibre];
            	$contenido_unidades =$r[contenido_unidades];
            	$EstFolio =$r[EstFolio];
            	$f_elaboracion =format_fecha_sin_hora($r[f_elaboracion]);
                  $f_inicio =format_fecha_sin_hora($r[f_inicio]);
                  $f_termino =format_fecha_sin_hora($r[f_termino]);
                  $f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
                  $origen =$r[Origen];
                  $factura_importada =$r[factura_importada];                  
                  $bidon_importado =$r[bidon_importado];
                  $destinos =$r[Destinos];
                  $fbodega =format_fecha_sin_hora($r[fbodega]);
                  $fdespacho_piking =format_fecha_sin_hora($r[fdespacho_piking]);
                  $ffacturacion_piking =format_fecha_sin_hora($r[ffacturacion_piking]);
                  $guia =$r[guia];
                  $factura =$r[factura];
                  $id_pedidos =$r[id_pedidos];
                  $fech_generada_inicio =format_fecha_sin_hora($r[fech_generada_inicio]);
                  $folio_m3 =$r[folio_m3];                  
                  $ano =$r[ano];                  
                  $medidas_productos =$r[DescMedProd];
                                    $caract_envases =$r[DescCarEnv];
                                                      $caract_producto =$r[DescCarProd];
                                                                        $unidad_medida =$r[DescUndMedida];                                                                  
//			 echo "$fecha;$destino;$codigo;$cantidad\n";

echo "$folio_m3;$CodFol;$id_cruce_tablas;$id_etiquetados_folios;$ano;$Producto;$Calibre;$medidas_productos;$caract_envases;$caract_producto;$unidad_medida;$contenido_unidades;$EstFolio;$f_elaboracion;$f_inicio;$f_termino;$f_vencimiento;$origen;$factura_importada;$bidon_importado;$destinos;$fbodega;$fdespacho_piking;$ffacturacion_piking;$guia;$factura;$id_pedidos;$fech_generada_inicio\n";			 
		   }
		 }
		
?>