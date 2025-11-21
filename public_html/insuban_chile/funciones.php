<?

function generar_funcion_operarios($link,$id_funcion_operarios)
    {

    $sql="select * from funcion_operarios ";
    $ret = mysql_query($sql,$link);
    
    while ($row=mysql_fetch_array($ret))
         {
          if ($row[id_funcion_operarios] == $id_funcion_operarios)
          $funcion_operarios.="<option value=\"$row[id_funcion_operarios]\" selected>$row[funcion_operarios]</option>\n";
          else
		  $funcion_operarios.="<option value=\"$row[id_funcion_operarios]\">$row[funcion_operarios]</option>\n";
         }
    return $funcion_operarios;
    }

function generar_especie($link,$id_especie)
    {

    $sql="select * from especie ";
    $ret = mysql_query($sql,$link);
    
    while ($row=mysql_fetch_array($ret))
         {
          if ($row[id_especie] == $id_especie)
          $especie.="<option value=\"$row[id_especie]\" selected>$row[especie]</option>\n";
          else
		  $especie.="<option value=\"$row[id_especie]\">$row[especie]</option>\n";
         }
    return $especie;
    }


function generar_sector($link,$id_sector)
    {

    $sql="select * from sector ";
    $ret = mysql_query($sql,$link);
    
    while ($row=mysql_fetch_array($ret))
         {
          if ($row[id_sector] == $id_sector)
          $sector.="<option value=\"$row[id_sector]\" selected>$row[sector]</option>\n";
          else
		  $sector.="<option value=\"$row[id_sector]\">$row[sector]</option>\n";
         }
    return $sector;
    }

function generar_unidad_medida_producto($link,$id_unidad_medida_producto)
    {

    $sql="select * from unidad_medida_producto ";
    $ret = mysql_query($sql,$link);
    
    while ($row=mysql_fetch_array($ret))
         {
          if ($row[id_unidad_medida_producto] == $id_unidad_medida_producto)
          $unidad_medida_producto.="<option value=\"$row[id_unidad_medida_producto]\" selected>$row[unidad_medida_producto]</option>\n";
          else
		  $unidad_medida_producto.="<option value=\"$row[id_unidad_medida_producto]\">$row[unidad_medida_producto]</option>\n";
         }
    return $unidad_medida_producto;
    }
	
function crea_funcion_operarios($link,$id_funcion_operarios,$id)
{

$id_funcion_operarios="";

if($id)
$funcion_operarios="<select name=\"id_funcion_operarios\" onChange=\"JavaScript:document.main.submit();\">\n";

else
$funcion_operarios="<select name=\"id_funcion_operarios\">\n";


$sql="select * from funcion_operarios";
$result=mysql_query($sql,$link);
$funcion_operarios.="<option value=\"0\">Seleccione funciones</option>\n";

while ($row=mysql_fetch_array($result))
{ 
if ($id_funcion_operarios==$row[id_funcion_operarios])
$funcion_operarios.="<option value=\"$row[id_funcion_operarios]\" selected>$row[funcion_operarios]</option>\n";
else
$funcion_operarios.="<option value=\"$row[id_funcion_operarios]\">$row[funcion_operarios]</option>\n";
} 
$funcion_operarios.="</select>\n";
return $funcion_operarios;
}	
	
?>