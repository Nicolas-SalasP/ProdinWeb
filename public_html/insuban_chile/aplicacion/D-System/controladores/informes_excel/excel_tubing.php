<? require("../connection.php");
mysql_select_db("$database", $con);

$sql="SELECT sal.idCodigo,enc.nombre,sal.fechaSalado,ope.onombre,cal.calibre,pro.cantidad 
					FROM salado as sal
					left outer join proceso_encargado as pro on pro.codigo=sal.idCodigo
					left outer join encargados as enc on pro.idEncargado=enc.idencargados
					left outer join operarias as ope on pro.idOperario=ope.idoperarias
					left outer join calibres as cal on pro.IdCalibre=cal.idcalibres
					group by sal.idSalado order by sal.idSalado desc";

$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Informe_Tubing.csv");

echo "ID;ENCARGADO;FECHA;OPERARIO;CALIBRE;CANTIDAD\n";

 while ($row=mysql_fetch_array($result))
  {
	$freproceso=$row[idCodigo];
	$id_c_es_so=$row[nombre];
	$folio =$row[fechaSalado];
	$cod=$row[onombre];
	$producto=$row[calibre];
	$calibre=$row[cantidad];

    echo "$freproceso;$id_c_es_so;$folio;$cod;$producto;$calibre\n"; 
  }

?>