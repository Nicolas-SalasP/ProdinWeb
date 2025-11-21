<?php 

if(isset($_POST[guarda])){ 

$date=date(c); // Obtener fecha de registro
$str = $_POST[id];
$arr2 = str_split($str, 13);
$arr4= $arr2[0];
$arr5= $arr2[1];

$arr6 = str_split($arr5, 2);
$arr7= $arr6[0];

$arr8 = str_split($str, 15);
$arr9= $arr8[0];
$arr10= $arr8[1];


//print_r($str);
//print_r($arr2);

   include("../datos/connection.php");
   mysql_select_db("$database", $con);


mysql_query("INSERT INTO etq_agrosuper (id_agrosuper,id_agro_pda,id_agro_cantidad,id_agro_fecha,id_insuban_fecha)
	values ('$str','$arr4','$arr7','$arr10','$date')");

}   
 print("<script>window.location.replace('../presentacion/func.search_100.php');</script>");



?>

