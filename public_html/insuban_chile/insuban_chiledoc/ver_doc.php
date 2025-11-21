<?
    $sql = "SELECT * FROM doc WHERE id_doc='".$_GET['id_doc']."'"; 

    $consulta = mysql_query($sql); 

    $datos = mysql_result($consulta,0,"archivo_binario"); 
    $tipo = mysql_result($consulta,0,"archivo_tipo"); 
    $name=  mysql_result($consulta,0,"archivo_nombre");
    $name="$name.pdf";

    header("Content-type: $tipo");
    header('Content-Disposition: attachment; filename="'.$name.'"'); 
    echo $datos; 



?>