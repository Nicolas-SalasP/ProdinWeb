<?
		$conexion=mysql_connect("190.107.176.73","prodinwe_root","123456") or die("Problemas en la conexion");
        mysql_select_db("prodinwe_insumos",$conexion) or die("Problemas en la selección de la base de datos");  
        mysql_query ("SET NAMES 'utf8'");
        
?>