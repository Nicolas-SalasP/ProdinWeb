<?
$localhost="190.107.176.73:3306";
$user="prodinwe_stgo391";
$pass="391stgo.*.";
$db="prodinwe_insubanchile";
$url="http://190.107.176.73/~prodinwe/insuban_chile";

//require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
//require "lib/funciones.php";

$sqlf="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, pro.id_producto AS id_producto, est.id_estado_material AS id_estado_material FROM mat_prima_nacional AS mpn, producto AS pro, estado_material AS est  WHERE mpn.id_estado_material = 1 AND mpn.id_estado_material = est.id_estado_material AND mpn.id_producto = pro.id_producto ";
$resultf=mysql_query($sqlf);

while ($rowf=mysql_fetch_array($resultf))
    { 
	
	$id_ptn=$rowf[id_mat_prima_nacional];
	$id_producn=$rowf[id_producto];
	$id_estfolion=$rowf[id_estado_material];
	//echo "id_pt $id_ptn - id_produc $id_producn - id_estfolio $id_estfolion<br>";
	
	$f_toma_inventariom=date("Y-m-d"); 
	$sql_invpt="insert into historial_inventario_mpn (id_ptn,id_producn,id_estfolion,f_toma_inventariom) values ($id_ptn,$id_producn,$id_estfolion,'$f_toma_inventariom')";
    $result_invpt=mysql_query($sql_invpt,$link);
	
	
	}
	
?>