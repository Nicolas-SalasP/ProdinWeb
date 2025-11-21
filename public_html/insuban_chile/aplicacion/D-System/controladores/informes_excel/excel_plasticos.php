<? require("../connection.php");
mysql_select_db("$database", $con);

$sql="SELECT sl.fechaSalado,gp.grupo,op.onombre,pe.n_bandeja,pe.cantidad
from salado as sl, proceso_encargado as pe, grupo as gp, operarias as op
where sl.idCodigo=pe.codigo and pe.IdCalibre!=30 and pe.idEncargado=gp.idEncargado and pe.idOperario=op.idoperarias
group by sl.idSalado order by pe.idOperario asc";

$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Informe_Plasticos.csv");

echo "FECHA;GRUPO;NOMBRE;BANDEJAS;PLASTICOS\n";

 while ($row2=mysql_fetch_array($result))
  {
	
	$fecha=$row2[fechaSalado];
	$grupo=$row2[grupo];
	$onombre=$row2[onombre];
	$n_bandeja=$row2[n_bandeja];
	$cantidad=$row2[cantidad];
	
	echo "$fecha;$grupo;$onombre;$n_bandeja;$cantidad\n";   
}

?>