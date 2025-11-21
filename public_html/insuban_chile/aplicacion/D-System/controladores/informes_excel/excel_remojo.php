<? require("../connection.php");
mysql_select_db("$database", $con);

$sql="SELECT rem.id, rem.fecha, pro.producto, org.origen, rem.n_bidon, rem.n_mallas, rem.f_faena, grp.grupo, rem.f_salida_produccion FROM remojo As rem, origenes As org, producto As pro, grupo as grp where org.id_origen = rem.procedencia and grp.idgrupo = rem.idGrupo2 and pro.id_producto = rem.producto ORDER BY id DESC ";

$result=mysql_query($sql);

header("Content-Type: application/vnd.ms-excel");
header("Pragma: no-cache");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Informe_Remojo.csv");

echo "ID;FECHA;PRODUCTO;ORIGEN;N_BIDON;UNIDADES;F/FAENA;GRUPO;F/PRODUCCION\n";

 while ($row=mysql_fetch_array($result))
  {
	$freproceso=$row[id];
	$id_c_es_so=$row[fecha];
	$folio =$row[producto];
	$cod=$row[origen];
	$producto=$row[n_bidon];
	$calibre=$row[n_mallas];
	$umedida=$row[f_faena];
	$mproductos=$row[grupo];
	$cproducto=$row[f_salida_produccion];
	

    echo "$freproceso;$id_c_es_so;$folio;$cod;$producto;$calibre;$umedida;$mproductos;$cproducto\n"; 
  }

?>