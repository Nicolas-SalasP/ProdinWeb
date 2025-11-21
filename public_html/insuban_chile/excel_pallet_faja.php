<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

//echo "desde $desde2=$desdereci     hasta $hasta2=$hastareci<br><br>";

$sql="select fp.ano_fajapallet,f.femision,fp.id_fajapallet,fp.fpallet,f.id_faja,f.loten,p.nombre AS nombreproducto,f.ffaena,f.femision,f.fvencimiento,f.neto,b.bodegas,fp.fdespacho,ep.estado_pallet,orig.origen 
 from fajapallet AS fp,fajas AS f , producto AS p, bodegas AS b, estado_pallet AS ep, origenes AS orig
 where 
 fp.id_fajapallet = fp.id_fajapallet
 and fp.id_fajapallet=f.id_fajapallet 
 and f.id_producto=p.id_producto 
 and fp.id_bodegas=b.id_bodegas
 and orig.id_origen=f.id_origen
 and fp.id_estado_pallet = ep.id_estado_pallet ";

if($id_estado_pallet)
	$sql.= " and ep.id_estado_pallet = '$id_estado_pallet' ";
if($id_producto)
	$sql.= " and p.id_producto = '$id_producto'  ";
if($fecha_ingresodesde)
$sql.= " and  fp.fpallet >= '$fecha_ingresodesde'  ";
if($fecha_ingresohasta)
$sql.= " and  fp.fpallet <= '$fecha_ingresohasta' ";
if($id_destinos)
	$sql.= " and d.id_destinos = '$id_destinos' ";
if($desdereci and $hastareci)
$sql.= " and fp.id_fajapallet  between $desdereci  and $hastareci and fp.id_fajapallet =fp.id_fajapallet  ";

$sql.= " and fp.ano_fajapallet  = '2009' order by fp.id_fajapallet,f.id_faja ";
$result=mysql_query($sql);
//echo $sql;
$cuantos=mysql_num_rows($result);

//echo "<br>SQL $sql<br>";echo "Cantidad $cuantos";

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Pallet_Faja.csv");


echo "Nº ;Fecha Pallet;Faja;Lote;Producto;ORIGEN;Fecha Faena;Fecha Emisión;Fecha Vencimiento;Neto;Bodega;Fecha Despacho;Estado;Glosa\n";
 while ($row=mysql_fetch_array($result))
  {
 $id_fajapallet=$row[id_fajapallet];
 $id_m=substr($row[ano_fajapallet],2,2).$id_fajapallet;
 $fpallet=format_fecha($row[fpallet]);
 $femision=format_fecha($row[femision]);
 $ffaena=format_fecha($row[ffaena]);
 $fvencimiento=format_fecha($row[fvencimiento]);
 $fdespacho=format_fecha($row[fdespacho]);
 $id_f=substr($row[ano],2,2).$row[id_faja];
 $loten=$row[loten];
 $nombre_producto=$row[nombreproducto];
 $nombredestinos=$row[nombredestinos];
 $neto=$row[neto];
 $bodegas=$row[bodegas];
 $estado_pallet=$row[estado_pallet];
 $glosa=$row[glosa];
 $origen=$row[origen];
echo "$id_m;$fpallet;$id_f;$loten;$nombre_producto;$origen;$ffaena;$femision;$fvencimiento;$neto;$bodegas;$fdespacho;$estado_pallet;$glosa\n";

}
?>