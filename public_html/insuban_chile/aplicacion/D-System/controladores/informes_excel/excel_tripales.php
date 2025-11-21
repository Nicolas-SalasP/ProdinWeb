<? require("../connection.php");
mysql_select_db("$database", $con);

$sql="SELECT pr2.fecha,grp.grupo,org.origen, ope.onombre, pr2.n_nudos_e, pr2.n_nudos_r,pr2.origenid 
FROM proceso_encargado2 as pr2,
grupo as grp,
operarias as ope,
origenes as org 
where grp.idgrupo=pr2.idgrupo1 and ope.idoperarias=pr2.operaria and org.id_origen=pr2.origenid
order by ope.onombre";

$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Informe_Tripales.csv");

echo "FECHA;GRUPO;NOMBRE;MATERIAL;TRIPA\n";

 while ($row2=mysql_fetch_array($result))
  {
	
	$fch=$row2[fecha];
	$grp=$row2[grupo];
	$nom=$row2[onombre];
	$n_e=$row2[n_nudos_e];
	$n_r=$row2[n_nudos_r];
	$mat=$row2[origenid];
	$org=$row2[origen];

	$nud=$n_e - $n_r;
	
	if ($mat==1000055 or $mat==1000043) {
	$varx1=$nud * 15;
	}elseif ($mat==1000039) {
	$varx1=$nud * 22;
	}elseif ($mat==107) {
	$varx1=$nud * 10;
	}else{
	$varx1=$nud * 20;
	}
	
    echo "$fch;$grp;$nom;$org;$varx1\n"; 
  }

?>