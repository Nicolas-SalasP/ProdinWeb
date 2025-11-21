<?
require("../datos/connection.php");
mysql_select_db("$database", $con);
//require "../../lib/funciones.php";

$sql="SELECT pr2.idproceso_encargado2, pr2.fecha, ope.onombre,org.origen,grp.grupo,pr2.n_bidon,pr2.n_nudos_e, pr2.n_nudos_r,org.id_origen 
FROM proceso_encargado2 as pr2
				left outer join operarias as ope on ope.idoperarias=pr2.operaria
				left outer join origenes as org on org.id_origen=pr2.origenid
				left outer join grupo as grp on grp.idgrupo=pr2.idgrupo1
				ORDER BY pr2.idproceso_encargado2 DESC";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Informe_Encargados.csv");

echo "ID;FECHA;OPERARIA;ORIGEN;GRUPO;N_BIDON;NUDOS_E;NUDOS_R;SUBTOTAL_NUDOS\n";

 while ($row=mysql_fetch_array($result))
  {
	$freproceso=$row[idproceso_encargado2];
	$id_c_es_so=$row[fecha];
	$folio =$row[onombre];
	$cod=$row[origen];
	$producto=$row[grupo];
	$calibre=$row[n_bidon];
	$umedida=$row[n_nudos_e];
	$mproductos=$row[n_nudos_r];

	$subtot_nudos = $umedida - $mproductos;
	

	$codigo= $freproceso.$id_c_es_so.$folio.$cod.$producto.$calibre.$umedida.$mproductos.$subtot_nudos;

    echo "$freproceso;$id_c_es_so;$folio;$cod;$producto;$calibre;$umedida;$mproductos;$subtot_nudos\n"; 
  }

?>