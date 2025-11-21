<?

require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

$nombre_bodega="B1";


$sql="SELECT ef.id_cruce_tablas AS id_cruce_tablas, SUM(ef.contenido_unidades) AS total_contenido, ef.id_procedencia AS id_procedencia, ef.factura_importada AS factura_importada, ef.total_ponderado AS total_ponderado   FROM etiquetados_folios AS ef, cruce_tablas AS ct WHERE ef.id_cruce_tablas = ct.id_cruce_tablas and fech_generada_inicio != '0000-00-00 00:00:00' and fech_generada_fin = '$fech_generada_fin' group by ef.id_cruce_tablas";	
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);


header("Content-Type: plain/text");
header("Content-Disposition: Attachment; filename=IMP_$fech_generada_fin.txt");
header("Pragma: no-cache");




//echo "ID;Contenido;Costo\n";

while ($row=mysql_fetch_array($result))
    { 
	$id_cruce_tablas=$row[id_cruce_tablas];
	$total_contenido=$row[total_contenido];
	$id_procedencia=$row[id_procedencia];
	$factura_importada=$row[factura_importada];
	//echo "- id_cruce_tablas: $id_cruce_tablas - total_contenido: $total_contenido<br>"; 
	$sql3="SELECT ef.id_cruce_tablas AS id_cruce_tablas, ef.id_etiquetados_folios AS id_etiquetados_folios, ef.contenido_unidades AS contenido_unidades, ef.total_ponderado  AS total_ponderado  FROM etiquetados_folios AS ef, cruce_tablas AS ct WHERE ef.id_cruce_tablas = ct.id_cruce_tablas and fech_generada_inicio != '0000-00-00 00:00:00' and fech_generada_fin = '$fech_generada_fin' and ef.id_cruce_tablas = $id_cruce_tablas";
	$result3=mysql_query($sql3);
	$total_ponderado_total=0;
  
	  while ($row3=mysql_fetch_array($result3)) { 
         $contenido_unidades=$row3[contenido_unidades];
		 $id_etiquetados_folios=$row3[id_etiquetados_folios];
		 $total_ponderado=$row3[total_ponderado];
		 $aporte_por_material = $contenido_unidades / $total_contenido;
		 $ponderado =$total_ponderado *  $aporte_por_material;
		 $total_ponderado_total+=$ponderado;
	 }
	 
	  echo "$nombre_bodega,$id_cruce_tablas,$total_contenido,$total_ponderado_total\r\n";
}

?>