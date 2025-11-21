<?
	require "lib/conexion.php";
	$link = mysql_connect("$localhost","$user","$pass");
	mysql_select_db("$db");
	require "lib/funciones.php";
	
	$nombre_bodega="B1";
	
	$sql="Select distinct(pd.id_cruce_tablas) As Codigo,";
	$sql.=" '$nombre_bodega' As Bodega,";
	$sql.=" Sum(pd.Contenido_Unidades) As Cantidad,";
	$sql.=" (pd.Costo_medio*pd.Contenido_unidades) as Costo";
	$sql.=" From Ctl_Produccion_Diaria_Det pd";
	$sql.=" Where pd.Id_Ctl_Produccion_Diaria = $out_idTabla ";
	$sql.=" Group by codigo";
	$result=mysql_query($sql);
	
	header("Content-Type: plain/text");
	header("Content-Disposition: Attachment; filename=IMP_$out_fecProduccion.txt");
	header("Pragma: no-cache");

    while ($row=mysql_fetch_array($result))
    { 
	  echo "$row[Codigo],$row[Bodega],$row[Cantidad],$row[Costo]\r\n";
    }
?>