<?php
function crea_centros_producciondb2($link,$id_centros_produccion,$onchange)//funcion crea producto
{
if(!$onchange){
$centro_produccion="<select name=\"id_centros_produccion\" style=\"width:250px\" class=\"cajas\">\n";
}else{
$centro_produccion="<select name=\"id_centros_produccion\" class=\"cajas\" style=\"width:250px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}
$sql="select * from centros_produccion order by centro_produccion desc";
$result=mysql_query($sql,$link);
$centro_produccion.="<option value=\"0\">Seleccionar Plantas</option>\n";

while ($row=mysql_fetch_array($result))
{ 
if ($id_centros_produccion==$row[id_centros_produccion])
$centro_produccion.="<option value=\"$row[id_centros_produccion]\" selected>$row[centro_produccion]</option>\n";
else
$centro_produccion.="<option value=\"$row[id_centros_produccion]\">$row[centro_produccion]</option>\n";

} 
$centro_produccion.="</select>\n";
return $centro_produccion;
}

function crea_mes($link,$id_mes)
{
$mes="<select name=\"id_mes\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from mes";
$result=mysql_query($sql,$link);
$mes.="<option value=\"0\">Seleccione Mes</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_mes==$row[id_mes])
$mes.="<option value=\"$row[id_mes]\" selected>$row[mes]</option>\n";
else
$mes.="<option value=\"$row[id_mes]\">$row[mes]</option>\n";
} 
$mes.="</select>\n";
return $mes;
}

?>