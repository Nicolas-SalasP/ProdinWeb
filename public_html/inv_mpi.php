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

$sqlf="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, pro.id_producto AS id_producto, est.id_estado_material AS id_estado_material, mpi.cruce_tablas_id AS cruce_tablas_id FROM mat_prima_importada AS mpi, producto AS pro, estado_material AS est  WHERE mpi.id_estado_material = 1 AND mpi.id_estado_material = est.id_estado_material AND mpi.id_producto = pro.id_producto ";
$resultf=mysql_query($sqlf);
$cuantos=mysql_num_rows($resultf);
//echo "sqlf $sqlf $cuantos<br>";

while ($rowf=mysql_fetch_array($resultf))
    { 
	
	$id_pti=$rowf[id_mat_prima_importada];
	$id_produci=$rowf[id_producto];
	$cruce_tablas_id=$rowf[cruce_tablas_id];
	$id_estfolioi=$rowf[id_estado_material];
	//echo "id_pt $id_ptn - id_produc $id_producn - id_estfolio $id_estfolion<br>";
	
	$f_toma_inventarioi=date("Y-m-d"); 
	$sql_invpt="insert into historial_inventario_mpi (id_pti,id_codi,id_produci,id_estfolioi,f_toma_inventarioi) values ($id_pti,$id_produci,$cruce_tablas_id,$id_estfolioi,'$f_toma_inventarioi')";
    $result_invpt=mysql_query($sql_invpt,$link);
	
	
	}
?>