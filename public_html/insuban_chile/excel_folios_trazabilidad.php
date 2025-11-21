<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
   
$sql_buscar="SELECT up.nombre AS unidad_prod, p.nombre AS producto_nombre, mpn.bidon_num, mpn.contenido, mpn.fecha_ingreso, mpn.ano, mpn.fecha_faena, mpn.id_mat_prima_nacional, fm.id_mat, p.id_producto,mpn.fecha_termino,mpn.rcp,mpn.comprobante_num,um.unidad_medida
from
folios_mat AS fm, mat_prima_nacional AS mpn, unidad_produccion as up, producto AS p, unidad_medida AS um, etiquetados_folios AS ef
where fm.id_etiquetados_folios=ef.id_etiquetados_folios and fm.id_mat = mpn.id_mat_prima_nacional  and ef.borrado != 1 and mpn.id_unidad_produccion=up.id_unidad_produccion and mpn.id_producto = p.id_producto and mpn.id_unidad_medida = um.id_unidad_medida 
$and 
group by mpn.id_mat_prima_nacional";
$result=mysql_query($sql_buscar);


header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Etiquetas_Folios_Trazabilidad.csv");



 while ($r=mysql_fetch_array($result))
  {
  $newdatod=$r[id_mat_prima_nacional];
echo "Nº MPN;Producto;Fecha ingreso;Fecha Faena;Fecha Termino;Contenido;Origen;RCP;Comprob. Nº;Nº Bidon;Unidad\n";
        $fecha_ingreso=format_fecha_sin_hora($r[fecha_ingreso]);
		$fecha_faena=format_fecha_sin_hora($r[fecha_faena]);
		$fecha_termino=format_fecha_sin_hora($r[fecha_termino]);
		$ano=substr($r[ano], 2, 3);
		$base="N".$ano.$r[id_mat_prima_nacional];
        $fecha_ingreso=$r[fecha_ingreso];
		$producto_nombre=$r[producto_nombre];
		$unidad_prod=$r[unidad_prod];
		$rcp=$r[rcp];
		$contenido=$r[contenido];
		$bidon_num=$r[bidon_num];
		$fecha_faena=$r[fecha_faena];
		$unidad_medida=$r[unidad_medida];
		$comprobante_num=$r[comprobante_num];
		
	echo "$base;$producto_nombre;$fecha_ingreso;$fecha_faena;$fecha_termino;$contenido;$unidad_prod;$rcp;$comprobante_num;$bidon_num;$unidad_medida\n";

 $sql="SELECT ef.ano,ef.id_etiquetados_folios, p.nombre AS nombre_productof, c.calibre, c.color, mp.nombre AS nombre_medidas, ef.contenido_unidades, ef.f_elaboracion, ef.f_termino, o.nombre AS nombre_operarios, o.apellido, estf.estado_folio, ef.factura
FROM
 folios_mat AS fm, etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mp, operarios AS o, estado_folio  AS estf
WHERE 
fm.id_mat = '$newdatod' and ef.id_etiquetados_folios = fm.id_etiquetados_folios and ef.id_producto = p.id_producto
and ef.id_calibre = c.id_calibre and ef.id_medidas_productos = mp.id_medidas_productos 
and ef.id_operarios = o.id_operarios and ef.id_estado_folio = estf.id_estado_folio and ef.id_estado_folio = ef.id_estado_folio and ef.borrado != 1";
$result_buscar=mysql_query($sql);
$cuantos_buscar=mysql_num_rows($result_buscar);

  echo "Nº;Producto;Calibre;Color;Medida;Unidad;Fecha Faena;Fecha Termino;Estado;Operador;Factura;Destino;Glosa\n";
  while ($row=mysql_fetch_array($result_buscar)) { 

 $id_etiquetados_folios=$row[id_etiquetados_folios];
 $id_m=substr($row[ano],2,4).$id_etiquetados_folios;
 $f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
 $f_inicio=format_fecha_sin_hora($row[f_inicio]);
 $f_termino=format_fecha_sin_hora($row[f_termino]);
 
 $nombre_producto=$row[nombre_productof];
 $nombre_medidas=$row[nombre_medidas];
 $calibre=$row[calibre];
 $color=$row[color];
 $estado_folio=$row[estado_folio];
 $nombre_operarios=$row[nombre_operarios];
 $apellido=$row[apellido];
 $factura=$row[factura];
 $contenido_unidades=$row[contenido_unidades];
 $destinos_nombre=$row[destinos_nombre];
 $glosa=$row[glosa];
 


  
echo "N$id_m;$nombre_producto;$calibre;$color;$nombre_medidas;$contenido_unidades;$f_elaboracion;$f_termino;$estado_folio;$nombre_operarios $apellido;$factura;$destinos_nombre;$glosa\n";




}


  }
?>