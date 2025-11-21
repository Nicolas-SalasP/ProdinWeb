<?
$localhost="localhost";
$user="insubac_pinsuban";
$pass="inchile";
$db="insubac_insubanchile";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");



$fd = fopen ("carga2.dat", "r");

while (!feof($fd)) {

 $buffer = fgets($fd, 4096);
 $dat=split(",",$buffer);
 
$id_f =$dat[0];
$id_cb =$dat[1];
//echo "id_f $id_f -  $id_cb <br>";


$sqlcod="SELECT * FROM cruce_tablas where id_cruce_tablas='$id_cb'";
$resultcod=mysql_query($sqlcod);
$cuantos=mysql_num_rows($resultcod);
//echo "cuantos $cuantos    --    <br> ";

 if ($rowcod=mysql_fetch_array($resultcod))
      { 
	  $id_cruce_tablas=$rowcod[id_cruce_tablas];
	  $id_especie=$rowcod[id_especie];
	  $id_producto=$rowcod[id_producto];
	  $id_calibre=$rowcod[id_calibre];
	  $id_unidad_medida=$rowcod[id_unidad_medida];
	  $id_medidas_productos=$rowcod[id_medidas_productos];
	  $id_caract_producto=$rowcod[id_caract_producto];
	  $id_caract_envases=$rowcod[id_caract_envases];

//echo "id_cruce_tablas $id_cruce_tablas <br>",
  	
  $sql_encuentra ="update etiquetados_folios  set id_producto='$id_producto', id_calibre='$id_calibre', id_medidas_productos='$id_medidas_productos', id_caract_envases='$id_caract_envases', id_caract_producto='$id_caract_producto', id_especie='$id_especie', id_unidad_medida='$id_unidad_medida', id_cruce_tablas='$id_cruce_tablas' where id_etiquetados_folios=$id_f";
 	echo "$sql_encuentra <br>";
 $row_encuentra=mysql_query($sql_encuentra);

}

}
fclose($fd);
//echo "cuantos2 $cuantos";
?>