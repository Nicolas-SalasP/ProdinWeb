<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
   
$sql="select f.ano,f.id_faja,f.loten,p.nombre AS producto_nombre,d.nombre AS destino_nombre,b.bodegas,f.femision,f.fvencimiento,f.ffaena,f.tara,f.neto,f.fajas_emitidas,f.estado
from fajas as f, producto as p, destinos AS d, bodegas AS b
where 
f.id_producto = p.id_producto and
f.id_bodegas = b.id_bodegas and
f.id_destinos = d.id_destinos
order by f.femision desc
";
$result=mysql_query($sql);


header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Fajas_Etiquetas.csv");


 echo "N� Fajas;N� Lote;Producto;Origen;Fecha Emisi�n;Fecha Vencimiento;Fecha Faena;Neto;Tara;Estado;Bodega;Fajas Emitidas\n";
 while ($row=mysql_fetch_array($result))
  {
 $id_faja=$row[id_faja];
 $id_m=substr($row[ano],2,4).$id_faja;
 $femision=format_fecha_sin_hora($row[femision]);
 $fvencimiento=format_fecha_sin_hora($row[fvencimiento]);
 $ffaena=format_fecha_sin_hora($row[ffaena]);
 $loten=$row[loten];
 $producto_nombre=$row[producto_nombre];
 $destino_nombre=$row[destino_nombre];
 $bodegas=$row[bodegas];
 $tara=$row[tara];
 $neto=$row[neto];
 $fajas_emitidas=$row[fajas_emitidas];
 $estado=$row[estado];
  
echo "N$id_m;$loten;$producto_nombre;$destino_nombre;$femision;$fvencimiento;$ffaena;$neto;$tara;$estado;$bodegas;$fajas_emitidas\n";

  }
?>