<?
require "lib/conex_bd_doc.php";
$link2 = mysql_connect("$localhost2","$user2","$pass2");
mysql_select_db("$db2");

    $sql = "SELECT * FROM doc WHERE id_doc='".$_GET['id_doc']."'"; 

    $consulta = mysql_query($sql); 

    $datos = mysql_result($consulta,0,"archivo_binario"); 
    $tipo = mysql_result($consulta,0,"archivo_tipo"); 
    $name=  mysql_result($consulta,0,"archivo_nombre");
    $name="$name.xls";

    header("Content-type: $tipo");
    header('Content-Disposition: attachment; filename="'.$name.'"'); 
    echo $datos; 



?>