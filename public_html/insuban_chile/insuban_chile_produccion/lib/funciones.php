<?
function despliega_origenes($link,$id_origen,$id,$id_especie)// funcion crea etapa
{
$origen="";
if($id)
$origen="<select name=\"id_origen-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$origen="<select name=\"id_origen\">\n";
$sql="select * from  origen_especie AS oe, origenes AS o  where oe.id_origen = o.id_origen and oe.id_especie = $id_especie";
$result=mysql_query($sql,$link);
$origen.="<option value=\"0\">Origen</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_origen==$row[id_origen])
$origen.="<option value=\"$row[id_origen]\" selected>$row[origen] - $row[id_origen]</option>\n";
else
$origen.="<option value=\"$row[id_origen]\">$row[origen] - $row[id_origen]</option>\n";
} 
$origen.="</select>\n";
return $origen;
}

function crea_origenes2($link,$id_producto)
{
$origen="";
$origen="<select name=\"id_origen\" class=\"cajas\" style=\"width:180px\">\n";
$sql="SELECT o.origen AS origen, o.id_origen AS id_origen
FROM cruce_producto_empresa AS cpe, producto AS p, origenes AS o
WHERE cpe.id_producto =$id_producto
AND cpe.id_producto = p.id_producto
AND cpe.id_origen = o.id_origen
";
$result=mysql_query($sql,$link);
$origen.="<option value=\"0\">Origen</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_origen==$row[id_origen])
$origen.="<option value=\"$row[id_origen]\" selected>$row[id_origen],$row[origen]</option>\n";
else
$origen.="<option value=\"$row[id_origen]\">$row[id_origen],$row[origen]</option>\n";
} 
$origen.="</select>\n";
return $origen;
}

function crea_origenes_planilla($link,$ido,$id_pp,$fecha_asig_producc)
{
//echo "id_origenf $ido<br>";
$origen="";
$origen="<select name=\"ido-$id_pp\" class=\"cajas\">\n";
$sqlorf="SELECT o.id_origen AS id_origen, o.origen AS origen FROM planilla_registro_fecha_asig_produccion AS prfap, origenes AS o WHERE prfap.id_origen = o.id_origen and prfap.fecha_asig_producc = '$fecha_asig_producc' group by prfap.id_origen desc";
$resultorf=mysql_query($sqlorf,$link);

$origen.="<option value=\"0\">Origen</option>\n";
while ($roworf=mysql_fetch_array($resultorf))
{ 
if ($ido == $roworf[id_origen])
$origen.="<option value=\"$roworf[id_origen]\" selected>$roworf[origen]</option>\n";
else
$origen.="<option value=\"$roworf[id_origen]\">$roworf[origen]</option>\n";
} 
$origen.="</select>\n";
return $origen;
}

function crea_origenes3($link,$id_producto,$id_origen)
{
$origen="";
$origen="<select name=\"id_origen\" class=\"cajas\" style=\"width:180px\">\n";
$sql="SELECT o.origen AS origen, o.id_origen AS id_origen
FROM cruce_producto_empresa AS cpe, producto AS p, origenes AS o
WHERE cpe.id_producto =$id_producto
AND cpe.id_producto = p.id_producto
AND cpe.id_origen = o.id_origen
";

$origen.="<option value=\"0\">Origen</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_origen==$row[id_origen])
$origen.="<option value=\"$row[id_origen]\" selected>$row[origen]</option>\n";
else
$origen.="<option value=\"$row[id_origen]\">$row[origen]</option>\n";
} 
$origen.="</select>\n";
return $origen;
}

function crea_origen_ok($link,$id_origen,$id,$id_especie)
{

$origen="";
if($id)
$origen="<select name=\"id_origen-$id\" style=\"width:180px\" class=\"cajas\">\n";
else
$origen="<select name=\"id_origen\">\n";
$sql="select * from origenes where  id_origen != 0 ";
$result=mysql_query($sql,$link);

$origen.="<option value=\"0\">Origen</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_origen==$row[id_origen])
$origen.="<option value=\"$row[id_origen]\" selected>$row[origen] - $row[id_origen]</option>\n";
else
$origen.="<option value=\"$row[id_origen]\">$row[origen] - $row[id_origen]</option>\n";
} 
$origen.="</select>\n";
return $origen;
}


function crea_producto_nombre_solo($link,$id_producto)//funcion crea estado de material
{

$sql="select * from producto where id_producto = $id_producto LIMIT 1";
$result=mysql_query($sql,$link);

if ($row=mysql_fetch_array($result))
	$producto=$row[producto];
	$id_especie=$row[id_especie];
 
//return $producto;
return array ($id_producto, $producto, $id_especie);
}


function check_id_mat ( $link,$id_etiq,$id_mat)
{
$sql="select * from folios_mat where id_etiquetados_folios=$id_etiq and id_mat=$id_mat";
//echo "SQL $sql";
$rest=mysql_query($sql);

$valor=mysql_num_rows($rest);

return $valor;
}

function crea_select($link,$id,$id_nombre,$nombre,$tabla,$nselect)
{
// Funcion que crea un select en base a los datos ingresados
$select="<select name=\"$id_nombre\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from $tabla";

$result=mysql_query($sql,$link);

$select.="<option value=\"\">Seleccione $nselect</option>\n";


//if (!$id) $id=0;
//echo "valor id $id<br>";
while ($row=mysql_fetch_array($result))
     { 
$val=$row[$id_nombre];
$nom=$row[$nombre];
if ($id==$val)
$select.="<option value=\"$val\" selected> $nom </option>\n";
else
$select.="<option value=\"$val\"> $nom </option>\n";
     } 

$select.="</select>\n";
return $select;
}


function crea_etapa($link,$id_etapa)// funcion crea etapa
{
$etapa="<select name=\"id_etapa\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from etapa";
$result=mysql_query($sql,$link);
$etapa.="<option value=\"0\">Seleccione Etapa</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_etapa==$row[id_etapa])
$etapa.="<option value=\"$row[id_etapa]\" selected>$row[etapa]</option>\n";
else
$etapa.="<option value=\"$row[id_etapa]\">$row[etapa]</option>\n";
} 
$etapa.="</select>\n";
return $etapa;
}


function crea_prioridad($link,$id_prioridades)// funcion crea estado
{
$prioridad="<select name=\"id_prioridades\" class=\"cajas\" style=\"width:70px\">\n";
$sql="select * from prioridad";
$result=mysql_query($sql,$link);
//$estado.="<option value=\"0\">Seleccione Estado</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_prioridades==$row[id_prioridades])
$prioridad.="<option value=\"$row[id_prioridades]\" selected>$row[prioridades]</option>\n";
else
$prioridad.="<option value=\"$row[id_prioridades]\">$row[prioridades]</option>\n";
} 
$prioridad.="</select>\n";
return $prioridad;
}





function crea_etiquetas($link,$id_etiquetas,$num)// funcion crea unidad
{

$etiquetas="<select name=\"id_etiquetas$num\" style=\"width:150px\" class=\"cajas\">\n";
$sql="select * from etiquetas where id_etiquetas=id_etiquetas order by etiquetas";
$result=mysql_query($sql,$link);
$etiquetas.="<option value=\"0\">Seleccione Etiquetas</option>\n";

while ($row=mysql_fetch_array($result))
{ 
if ($id_etiquetas==$row[id_etiquetas])
$etiquetas.="<option value=\"$row[id_etiquetas]\" selected>$row[etiquetas]</option>\n";
else
$etiquetas.="<option value=\"$row[id_etiquetas]\">$row[etiquetas]</option>\n";
} 
$etiquetas.="</select>\n";
return $etiquetas;
}

function crea_envases($link,$id_envases)// funcion crea unidad
{
$envases="<select name=\"id_envases\" style=\"width:250px\" class=\"cajas\">\n";
$sql="select * from envases where id_envases=id_envases order by envases";
$result=mysql_query($sql,$link);
$envases.="<option value=\"0\">Seleccione Envases</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_envases==$row[id_envases])
$envases.="<option value=\"$row[id_envases]\" selected>$row[envases]   |   $row[unidades]</option>\n";
else
$envases.="<option value=\"$row[id_envases]\">$row[envases]   |   $row[unidades]</option>\n";
} 
$envases.="</select>\n";
return $envases;
}

function crea_envases_uno($link,$id_envases)// funcion crea unidad
{
$envases="<select name=\"id_envases\" style=\"width:140px\" class=\"cajas\">\n";
$sql="select * from envases where id_envases=id_envases order by envases";
$result=mysql_query($sql,$link);
$id_envases=5;
$envases.="<option value=\"$id_envases\">Seleccione Envases</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_envases==$row[id_envases])
$envases.="<option value=\"$row[id_envases]\" selected>$row[envases]   |   $row[unidades]</option>\n";
else
$envases.="<option value=\"$row[id_envases]\">$row[envases]   |   $row[unidades]</option>\n";
} 
$envases.="</select>\n";
return $envases;
}

function crea_origen($link,$id_origen)// funcion crea unidad
{
$origen="<select name=\"id_origen\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from origen";
$result=mysql_query($sql,$link);
$origen.="<option value=\"0\">Seleccione Origen</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_origen==$row[id_origen])
$origen.="<option value=\"$row[id_origen]\" selected>$row[origen]</option>\n";
else
$origen.="<option value=\"$row[id_origen]\">$row[origen]</option>\n";
} 
$origen.="</select>\n";
return $origen;
}

function crea_rubro($link,$id_rubro)// funcion crea rubro
{
$rubro="<select name=\"id_rubro\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from rubro";
$result=mysql_query($sql,$link);
$rubro.="<option value=\"0\">Seleccione Rubro</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_rubro==$row[id_rubro])
$rubro.="<option value=\"$row[id_rubro]\" selected>$row[rubro]</option>\n";
else
$rubro.="<option value=\"$row[id_rubro]\">$row[rubro]</option>\n";
} 
$rubro.="</select>\n";
return $rubro;
}



function crea_usuarios_nivel($link,$id_u_n)// crear funciones de operarios
{
$nivel="<select name=\"id_u_n\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from usuarios_nivel";
$result=mysql_query($sql,$link);
$nivel.="<option value=\"0\">Seleccione nivel</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_u_n==$row[id_u_n])
$nivel.="<option value=\"$row[id_u_n]\" selected>$row[u_n]</option>\n";
else
$nivel.="<option value=\"$row[id_u_n]\">$row[u_n]</option>\n";
} 
$nivel.="</select>\n";
return $nivel;
}

function crea_usuarios_tipo($link,$id_u_t)// crear funciones de operarios
{
$tipo="<select name=\"id_u_t\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from usuarios_tipos";
$result=mysql_query($sql,$link);
$tipo.="<option value=\"0\">Seleccione Tipo</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_u_t==$row[id_u_t])
$tipo.="<option value=\"$row[id_u_t]\" selected>$row[u_t]</option>\n";
else
$tipo.="<option value=\"$row[id_u_t]\">$row[u_t]</option>\n";
} 
$tipo.="</select>\n";
return $tipo;
}


function get_producto($link,$id_producto)//funcion crea estado de material
{
$sql="select * from producto where id_producto = $id_producto";
$result=mysql_query($sql,$link);
while ($row=mysql_fetch_array($result))
     { 
      $producto="$row[nombre]";
     } 
return $producto;
}

function get_calibre($link,$id_calibre,$id_producto)//funcion crea estado de material
{
$sql2="SELECT * FROM cruce_plant_calibre AS cpc, producto AS pro, calibre AS c WHERE cpc.id_producto =pro.id_producto and cpc.id_producto=$id_producto and cpc.id_calibre = c.id_calibre and c.id_calibre !=0 ";
	   
$result=mysql_query($sql2,$link);

while ($row=mysql_fetch_array($result))
     { 
      $calibre="$row[calibre]|$row[color]";
     } 
return $calibre;
}
function crea_producto($link,$id_producto)//funcion crea estado de material
{
$producto="<select name=\"id_producto\" style=\"width:200px\" class=\"cajas\">\n";
$sql="select * from producto where id_producto != 0 and id_estado = 1 and producto !='' order by producto desc";
$result=mysql_query($sql,$link);
$producto.="<option value=\"0\">Producto</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_producto==$row[id_producto])
$producto.="<option value=\"$row[id_producto]\" selected>$row[producto] - $row[id_producto]</option>\n";
else
$producto.="<option value=\"$row[id_producto]\">$row[producto]- $row[id_producto]</option>\n";
} 
$producto.="</select>\n";
return $producto;
}

function crea_nivel_usuario($link,$id_u_n)// crear funciones de operarios
{
$u_n="<select name=\"id_u_n\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from usuarios_nivel";
$result=mysql_query($sql,$link);
$u_n.="<option value=\"0\">Nivel de Usuario</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_u_n==$row[id_u_n])
$u_n.="<option value=\"$row[id_u_n]\" selected>$row[u_n]</option>\n";
else
$u_n.="<option value=\"$row[id_u_n]\">$row[u_n]</option>\n";
} 
$u_n.="</select>\n";
return $u_n;
}


function crea_producto2($link,$id_producto)//funcion crea estado de material
{
$producto="<select name=\"id_producto\" style=\"width:250px\" class=\"cajas\">\n";
//$sql="select * from producto AS pro, cruce_plant_calibre AS cpc where pro.id_producto != cpc.id_producto GROUP BY pro.id_producto";

$sql="select * from producto where id_producto != 0";
$result=mysql_query($sql,$link);
$producto.="<option value=\"0\">Seleccione Producto</option>\n";
while ($row=mysql_fetch_array($result))
{ 
$sql2="select * from cruce_plant_calibre where id_producto=$row[id_producto]";
//echo "SQL2 $sql2<br>";
$rest2=mysql_query($sql2);
$cuantos2=mysql_num_rows($rest2);
if (!$cuantos2)
  {
if ($id_producto==$row[id_producto])
$producto.="<option value=\"$row[id_producto]\" selected>$row[nombre] - $row[id_producto]</option>\n";
else
$producto.="<option value=\"$row[id_producto]\">$row[nombre] - $row[id_producto]</option>\n";
} 
   }
$producto.="</select>\n";
return $producto;
}

function crea_estado_material_select($link,$id_estado_material)//funcion crea estado de material
{
$estado_material="";

$estado_material=
"<select name=\"id_estado_material\" onchange=\"JavaScript:document.form1.submit();\" style=\"width:100px\" class=\"cajas\">\n";

$sql="select * from estado_material where id_estado_material != 0";
$result=mysql_query($sql,$link);
//$estado_material.="<option value=\"0\">Estado Material</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_material==$row[id_estado_material])
$estado_material.="<option value=\"$row[id_estado_material]\" selected>$row[estado_material]</option>\n";
else
$estado_material.="<option value=\"$row[id_estado_material]\">$row[estado_material]</option>\n";
} 
$estado_material.="</select>\n";
return $estado_material;
}

function crea_estado_estado_select($link,$id_estado_folio)//funcion crea estado de material
{
$estado_folio="";

$estado_folio=
"<select name=\"id_estado_folio\" onchange=\"JavaScript:document.form1.submit();\">\n";

$sql="select * from estado_folio where id_estado_folio = 2";
$result=mysql_query($sql,$link);
$estado_folio.="<option value=\"0\">Seleccione Estado Folio</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_folio==$row[id_estado_folio])
$estado_folio.="<option value=\"$row[id_estado_folio]\" selected>$row[estado_folio]</option>\n";
else
$estado_folio.="<option value=\"$row[id_estado_folio]\">$row[estado_folio]</option>\n";
} 
$estado_folio.="</select>\n";
return $estado_folio;
}

function crea_producto_onChange($link,$id_producto)//funcion crea producto
{
$producto="";
$producto="<select name=\"id_producto\" style=\"width:150px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\" >\n";
//$sql="select * from producto";
$sql="select * from producto AS pro, cruce_plant_calibre AS cpc where pro.id_producto = cpc.id_producto and pro.id_producto != 0 and pro.id_producto != 88 and pro.id_estado != 2 GROUP BY pro.id_producto";
$result=mysql_query($sql,$link);
$producto.="<option value=\"0\">Seleccione Producto</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_producto==$row[id_producto])
$producto.="<option value=\"$row[id_producto]\" selected>$row[producto]</option>\n";
else
$producto.="<option value=\"$row[id_producto]\">$row[producto]</option>\n";

} 
$producto.="</select>\n";
return $producto;
}
function crea_producto_onChange_segunestado($link,$id_estado_folio,$id_producto)//funcion crea producto
{
$producto="";
$producto="<select name=\"id_producto\" style=\"width:150px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\" >\n";
//$sql="select * from producto";
$sql="select * from etiquetados_folios AS ef, producto AS p where ef.id_estado_folio = $id_estado_folio and ef.id_producto = p.id_producto and p.id_producto != 0 group by ef.id_producto ";
$result=mysql_query($sql,$link);
$producto.="<option value=\"0\">Seleccione Producto</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_producto==$row[id_producto])
$producto.="<option value=\"$row[id_producto]\" selected>$row[producto]</option>\n";
else
$producto.="<option value=\"$row[id_producto]\">$row[producto]</option>\n";

} 
$producto.="</select>\n";
return $producto;
}

function crea_id($link,$id_estado_folio,$id_producto,$id_cruce_tablas)//funcion crea producto
{
$codgi="";
$codgi="<select name=\"id_cruce_tablas\" style=\"width:80px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\" >\n";
//$sql="select * from producto";

$sql="select * from etiquetados_folios AS ef, producto AS p where ef.id_estado_folio = $id_estado_folio and ef.id_producto = $id_producto and ef.id_producto = p.id_producto and p.id_producto != 0 group by ef.id_cruce_tablas";
$result=mysql_query($sql,$link);
$codgi.="<option value=\"0\">Codigo</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_cruce_tablas==$row[id_cruce_tablas])
$codgi.="<option value=\"$row[id_cruce_tablas]\" selected>COD: $row[id_cruce_tablas]</option>\n";
else
$codgi.="<option value=\"$row[id_cruce_tablas]\">COD: $row[id_cruce_tablas]</option>\n";

} 
$codgi.="</select>\n";
return $codgi;
}

function crea_producto_onChange2($link,$id_producto)//funcion crea producto
{
$producto="";
$producto="<select name=\"id_producto\" style=\"width:160px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\" >\n";
//$sql="select * from producto";
$sql="select * from producto AS pro, cruce_plant_calibre AS cpc where pro.id_producto = cpc.id_producto and pro.id_producto != 0 and pro.id_estado != 2 GROUP BY pro.id_producto";
$result=mysql_query($sql,$link);
$producto.="<option value=\"0\">Seleccione Producto</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_producto==$row[id_producto])
$producto.="<option value=\"$row[id_producto]\" selected>$row[producto]</option>\n";
else
$producto.="<option value=\"$row[id_producto]\">$row[producto]</option>\n";

} 
$producto.="</select>\n";
return $producto;
}


function crea_estado_folio_selectdos($link,$id_estado_folio)//funcion crea estado de material
{
$estado_folio="";
$estado_folio="<select name=\"id_estado_folio\" class=\"cajas\" onchange=\"JavaScript:document.form1.submit();\">\n";

$sql="select * from estado_folio where id_estado_folio != 9 and id_estado_folio != 7 and id_estado_folio != 0";
$result=mysql_query($sql,$link);
$estado_folio.="<option value=\"0\">Estado Folio</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_folio==$row[id_estado_folio])
$estado_folio.="<option value=\"$row[id_estado_folio]\" selected>$row[estado_folio]</option>\n";
else
$estado_folio.="<option value=\"$row[id_estado_folio]\">$row[estado_folio]</option>\n";
} 
$estado_folio.="</select>\n";
return $estado_folio;
}

function crea_producto_onChange_solo($link,$id_producto,$id)//funcion crea producto
{
//style=\"width:160px\" 
if($id == "c"){
$producto="";
$producto="<select name=\"id_producto\" style=\"width:250px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\">\n";
//$sql="select * from producto";
$sql="select * from producto AS pro, cruce_plant_calibre AS cpc where pro.id_producto = cpc.id_producto and pro.id_producto = $id_producto group by pro.id_producto order by pro.producto desc";
$result=mysql_query($sql,$link);
}
if($id == "m"){
$producto="";
$producto="<select name=\"id_producto\" style=\"width:250px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\">\n";
//$sql="select * from producto";
$sql="select * from producto AS pro, cruce_plant_medidas_productos  AS cpmp where pro.id_producto = cpmp.id_producto and pro.id_producto = $id_producto group by pro.id_producto order by pro.producto desc";
$result=mysql_query($sql,$link);
}
if($id == "um"){
$producto="";
$producto="<select name=\"id_producto\" style=\"width:250px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\">\n";
//$sql="select * from producto";
$sql="select * from producto AS pro, cruce_plant_unidad_medida  AS cpum where pro.id_producto = cpum.id_producto and pro.id_producto = $id_producto group by pro.id_producto order by pro.producto desc";
$result=mysql_query($sql,$link);
}

if($id == "carac"){
$producto="";
$producto="<select name=\"id_producto\" style=\"width:250px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\">\n";
//$sql="select * from producto";
$sql="select * from producto AS pro, cruce_plant_caract_producto  AS cpcp where pro.id_producto = cpcp.id_producto and pro.id_producto = $id_producto group by pro.id_producto order by pro.producto desc";
$result=mysql_query($sql,$link);
}

if($id == "envas"){
$producto="";
$producto="<select name=\"id_producto\" style=\"width:250px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\">\n";
//$sql="select * from producto";
$sql="select * from producto AS pro, cruce_plant_caract_envases  AS cpce where pro.id_producto = cpce.id_producto and pro.id_producto = $id_producto group by pro.id_producto order by pro.producto desc";
$result=mysql_query($sql,$link);
}

if($id == "espec"){
$producto="";
$producto="<select name=\"id_producto\" style=\"width:250px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\">\n";
//$sql="select * from producto";
$sql="select * from producto AS pro, cruce_plant_especie  AS cpe where pro.id_producto = cpe.id_producto and pro.id_producto = $id_producto group by pro.id_producto order by pro.producto desc";
$result=mysql_query($sql,$link);
}

$producto.="<option value=\"0\">Seleccione producto</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_producto==$row[id_producto])
$producto.="<option value=\"$row[id_producto]\" selected>$row[producto] - $row[id_producto]</option>\n";
else
$producto.="<option value=\"$row[id_producto]\">$row[producto] - $row[id_producto]</option>\n";

} 
$producto.="</select>\n";
return $producto;
}


function crea_etiquetas_predefinidas($link,$id_etiquetas)//funcion crea producto
{
//style=\"width:160px\" 
$etiquetas="";
$etiquetas="<select name=\"id_etiquetas\" style=\"width:250px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\" >\n";
//$sql="select * from producto";
$sql="select * from etiquetas where id_etiquetas != 1 and id_etiquetas !=2 and id_etiquetas != 3 and id_etiquetas != 4 and id_etiquetas != 5 and id_etiquetas != 6 and id_etiquetas != 8 and id_etiquetas != 9 and id_etiquetas != 10 and id_etiquetas != 11 and id_etiquetas != 13 and id_etiquetas != 14 and id_etiquetas != 16";
//$sql="select * from etiquetas where descripcion = 'Etiqueta definida'";
$result=mysql_query($sql,$link);
$etiquetas.="<option value=\"0\">Seleccione Etiqueta</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_etiquetas==$row[id_etiquetas])
$etiquetas.="<option value=\"$row[id_etiquetas]\" selected>$row[etiquetas]</option>\n";
else
$etiquetas.="<option value=\"$row[id_etiquetas]\">$row[etiquetas]</option>\n";

} 
$etiquetas.="</select>\n";
return $etiquetas;
}


function crea_sector($link,$id_sector)//funcion crea sector
{
$sector="<select name=\"id_sector\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from sector";
$result=mysql_query($sql,$link);
$sector.="<option value=\"0\">Seleccione Sector</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_sector==$row[id_sector])
$sector.="<option value=\"$row[id_sector]\" selected>$row[sector]</option>\n";
else
$sector.="<option value=\"$row[id_sector]\">$row[sector]</option>\n";
} 
$sector.="</select>\n";
return $sector;
}

function crea_tipo_calculo($link,$id_tipo_calculo,$id)
{

$tipo_calculo="";
if($id)
$tipo_calculo="<select name=\"id_tipo_calculo-$id\" style=\"width:80px\" class=\"cajas\">\n";
else
$tipo_calculo="<select name=\"id_tipo_calculo\">\n";
$sql="select * from tipo_calculo where  id_tipo_calculo != 0";
$result=mysql_query($sql,$link);

while ($row=mysql_fetch_array($result))
{ 
if ($id_tipo_calculo==$row[id_tipo_calculo])
$tipo_calculo.="<option value=\"$row[id_tipo_calculo]\" selected>$row[tipo_calculo]</option>\n";
else
$tipo_calculo.="<option value=\"$row[id_tipo_calculo]\">$row[tipo_calculo]</option>\n";
} 
$tipo_calculo.="</select>\n";
return $tipo_calculo;
}


function crea_tipo($link,$id_tipo)//funcion crea tipo
{
$tipo="<select name=\"id_tipo\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from tipo";
$result=mysql_query($sql,$link);
$tipo.="<option value=\"0\">Seleccione Tipo</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_tipo==$row[id_tipo])
$tipo.="<option value=\"$row[id_tipo]\" selected>$row[tipo]</option>\n";
else
$tipo.="<option value=\"$row[id_tipo]\">$row[tipo]</option>\n";
} 
$tipo.="</select>\n";
return $tipo;
}


function crea_calibre_ok($link,$id_calibre,$id)
{

$calibre="";
if($id)
$calibre="<select name=\"id_calibre-$id\"class=\"cajas\" style=\"width:180px\">\n";
else
$calibre="<select name=\"id_calibre\">\n";
$sql="select * from calibre ";
$result=mysql_query($sql,$link);

$calibre.="<option value=\"0\">Calibre</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_calibre==$row[id_calibre])
$calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre] -  $row[onoff] -  $row[id_calibre]</option>\n";
else
$calibre.="<option value=\"$row[id_calibre]\">$row[calibre] -  $row[onoff] -  -  $row[id_calibre]</option>\n";
} 
$calibre.="</select>\n";
return $calibre;
}




function crea_especie($link,$id_especie)//funcion crea especie
{
$estado_material="";
$especie="<select name=\"id_especie\"class=\"cajas\" style=\"width:80px\">\n";
$sql="select * from especie where id_especie != 0";
$result=mysql_query($sql,$link);
$especie.="<option value=\"0\">Especie</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_especie==$row[id_especie])
$especie.="<option value=\"$row[id_especie]\" selected>$row[especie] - $row[id_especie]</option>\n";
else
$especie.="<option value=\"$row[id_especie]\">$row[especie] - $row[id_especie]</option>\n";
} 
$especie.="</select>\n";
return $especie;
}

function crea_calibre_codificacion($link,$id_calibre)
{

$calibre="<select name=\"id_calibre-$id_cruce_tablas\"class=\"cajas\" style=\"width:80px\">\n";
$sql="select * from calibre ";
$result=mysql_query($sql,$link);
$calibre.="<option value=\"0\">Calibre</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_calibre==$row[id_calibre])
$calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre] - $row[id_calibre]</option>\n";
else
$calibre.="<option value=\"$row[id_calibre]\">$row[calibre] - $row[id_calibre]</option>\n";
} 
$calibre.="</select>\n";
return $calibre;
}




//en una de esas este se ocupa verificar si hay errores despues cuando se cambia el nombre de la funcion
function crea_medidas_productos2($link,$id_medidas_productos)// funcion crea estado
{
$medidas_productos="<select name=\"id_medidas_productos\" style=\"width:250px\" class=\"cajas\">\n";
$sql="select * from medidas_productos where id_medidas_productos != 0";
$result=mysql_query($sql,$link);
$medidas_productos.="<option value=\"0\">Seleccione Medidas</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_medidas_productos==$row[id_medidas_productos])
$medidas_productos.="<option value=\"$row[id_medidas_productos]\" selected>$row[nombre] - $row[id_medidas_productos]</option>\n";
else
$medidas_productos.="<option value=\"$row[id_medidas_productos]\">$row[nombre] - $row[id_medidas_productos]</option>\n";
} 
$medidas_productos.="</select>\n";
return $medidas_productos;
}

function crea_medidas_productos ($link,$id_medidas_productos)//funcion crea especie
{
$medida="<select name=\"id_medidas_productos\"class=\"cajas\" style=\"width:100px\">\n";
$sql="select es.id_medidas_productos , es.nombre AS medida  from medidas_productos AS es where es.id_medidas_productos = id_medidas_productos";
$result=mysql_query($sql,$link);
$medida.="<option value=\"0\">Medidas</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_medidas_productos==$row[id_medidas_productos])
$medida.="<option value=\"$row[id_medidas_productos]\" selected>$row[medida] - $row[id_medidas_productos]</option>\n";
else
$medida.="<option value=\"$row[id_medidas_productos]\">$row[medida] - $row[id_medidas_productos]</option>\n";
} 
$medida.="</select>\n";
return $medida;
}

function crea_medidas_productos_codificacion ($link,$id_medidas_productos)//funcion crea especie
{
$medida="<select name=\"id_medidas_productos-$id_cruce_tablas\"class=\"cajas\" style=\"width:100px\">\n";
$sql="select es.id_medidas_productos , es.nombre AS medida  from medidas_productos AS es where es.id_medidas_productos = id_medidas_productos";
$result=mysql_query($sql,$link);
$medida.="<option value=\"0\">Medidas</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_medidas_productos==$row[id_medidas_productos])
$medida.="<option value=\"$row[id_medidas_productos]\" selected>$row[medida] - $row[id_medidas_productos]</option>\n";
else
$medida.="<option value=\"$row[id_medidas_productos]\">$row[medida] - $row[id_medidas_productos]</option>\n";
} 
$medida.="</select>\n";
return $medida;
}

function crea_formato($link,$id_formato)//funcion crea especie
{
$formato="<select name=\"id_formato\"class=\"cajas\" style=\"width:100px\">\n";
$sql="select * from formatos";
$result=mysql_query($sql,$link);
$formato.="<option value=\"0\">Formato</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_formato==$row[id_formato])
$formato.="<option value=\"$row[id_formato]\" selected>$row[formato] - $row[id_formato]</option>\n";
else
$formato.="<option value=\"$row[id_formato]\">$row[formato] - $row[id_formato]</option>\n";
} 
$formato.="</select>\n";
return $formato;
}

function crea_formato_codificacion($link,$id_formato,$id_cruce_tablas)//funcion crea especie
{
$formato="<select name=\"id_formato-$id_cruce_tablas\"class=\"cajas\" style=\"width:100px\">\n";
$sql="select * from formatos";
$result=mysql_query($sql,$link);
$formato.="<option value=\"0\">Formato</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_formato==$row[id_formato])
$formato.="<option value=\"$row[id_formato]\" selected>$row[formato] - $row[id_formato]</option>\n";
else
$formato.="<option value=\"$row[id_formato]\">$row[formato] - $row[id_formato]</option>\n";
} 
$formato.="</select>\n";
return $formato;
}

function crea_destinos2222($link,$id_destinos,$restricfec)
{
$destinos="<select name=\"id_destinos\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from destinos where id_destinos != 0 order by destinos";
$result=mysql_query($sql,$link);
$destinos.="<option value=\"0\">Destinos</option>\n";
while ($row2=mysql_fetch_array($result))
{ 


if ($id_destinos==$row2[id_destinos])
{
$destinos.="<option value=\"$row2[id_destinos]\" selected>$row2[destinos]</option>\n";
$restricfec2=$row2[restricfec];
$id_destinos2=$row2[id_destinos];
}else{
$destinos.="<option value=\"$row2[id_destinos]\">$row2[destinos]</option>\n";
$id_destinos2=$row2[id_destinos];
}


} 
$destinos.="</select>\n";
//return $destinos;

return array ($id_destinos2, $destinos, $restricfec2);
}

function crea_destinos($link,$id_destinos)
{
$destinos="<select name=\"id_destinos\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from destinos where id_destinos != 0 order by destinos";
$result=mysql_query($sql,$link);
$destinos.="<option value=\"0\">Destinos</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_destinos==$row[id_destinos])
$destinos.="<option value=\"$row[id_destinos]\" selected>$row[destinos]</option>\n";
else
$destinos.="<option value=\"$row[id_destinos]\">$row[destinos]</option>\n";
} 
$destinos.="</select>\n";
return $destinos;
}

function crea_destinos_confiltros_ocupados($link,$id_destinos)
{
$destinos="<select name=\"id_destinos\" class=\"cajas\" style=\"width:200px\">\n";
//$sql="select * from destinos where id_destinos != 0 order by destinos";

$sql="SELECT d.destinos AS destinos, d.id_destinos
FROM paking AS p, etiquetados_folios AS ef, estado_folio AS e, destinos AS d
WHERE ef.id_estado_folio = e.id_estado_folio
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
AND ef.id_destinos = d.id_destinos
AND ef.id_estado_folio =7
AND ef.id_destinos != 0
GROUP BY d.id_destinos
ORDER BY d.destinos ASC";


$result=mysql_query($sql,$link);
$destinos.="<option value=\"0\">Destinos</option>\n";
while ($row=mysql_fetch_array($result))
{ 

$destino = $row[destinos]; 															
$r= strtoupper($destino);
if ($id_destinos==$row[id_destinos])
$destinos.="<option value=\"$row[id_destinos]\" selected> $r</option>\n";
else
$destinos.="<option value=\"$row[id_destinos]\"> $r</option>\n";
} 
$destinos.="</select>\n";
return $destinos;
}


function crea_origenes($link,$id_origen)
{
$origen="";
$origen="<select name=\"id_origen\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from origenes where id_origen != 0 order by origen desc";
$result=mysql_query($sql,$link);
$origen.="<option value=\"0\">Origen</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_origen==$row[id_origen])
$origen.="<option value=\"$row[id_origen]\" selected>$row[origen] - $row[id_origen]</option>\n";
else
$origen.="<option value=\"$row[id_origen]\">$row[origen] - $row[id_origen]</option>\n";
} 
$origen.="</select>\n";
return $origen;
}

function crea_origenes_etiplan($link,$id_origen,$onchange)
{
if(!$onchange){
$origen="<select name=\"id_origen\" class=\"cajas\" style=\"width:150px\">\n";
}else{
$origen="<select name=\"id_origen\" class=\"cajas\" style=\"width:150px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}
$sql="select * from origenes where id_origen != 0 order by origen desc";
$result=mysql_query($sql,$link);
$origen.="<option value=\"0\">Origen</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_origen==$row[id_origen])
$origen.="<option value=\"$row[id_origen]\" selected>$row[origen] - $row[id_origen]</option>\n";
else
$origen.="<option value=\"$row[id_origen]\">$row[origen] - $row[id_origen]</option>\n";
} 
$origen.="</select>\n";
return $origen;
}

function crea_operarios_etiplan($link,$id_operarios,$onchange)//funcion crea producto
{

if(!$onchange){
$operarios="<select name=\"id_operarios\" class=\"cajas\" style=\"width:143px\">\n";
}else{
$operarios="<select name=\"id_operarios\" class=\"cajas\" style=\"width:143px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}
$sql="select * from operarios where id_estado = 1  order by nombreop desc";
$result=mysql_query($sql,$link);
$operarios.="<option value=\"0\">Seleccione Operario</option>\n";

while ($row=mysql_fetch_array($result))
{ 
if ($id_operarios==$row[id_operarios])
$operarios.="<option value=\"$row[id_operarios]\" selected>$row[nombreop] | $row[apellido]</option>\n";
else
$operarios.="<option value=\"$row[id_operarios]\">$row[nombreop] | $row[apellido]</option>\n";

} 
$operarios.="</select>\n";
return $operarios;
}

function crea_operarios($link,$id_operarios)//funcion crea producto
{

$operarios="<select name=\"id_operarios\" style=\"width:200px\" class=\"cajas\">\n";
$sql="select * from operarios where id_estado = 1  order by nombreop desc";
$result=mysql_query($sql,$link);
$operarios.="<option value=\"0\">Seleccione Operario</option>\n";

while ($row=mysql_fetch_array($result))
{ 
if ($id_operarios==$row[id_operarios])
$operarios.="<option value=\"$row[id_operarios]\" selected>$row[nombreop] | $row[apellido]</option>\n";
else
$operarios.="<option value=\"$row[id_operarios]\">$row[nombreop] | $row[apellido]</option>\n";

} 
$operarios.="</select>\n";
return $operarios;
}

/*function crea_etiqueta_idioma($link,$id_etiqueta_idioma,$onchange)// crear funciones de operarios
{

if(!$onchange){
$etiqueta_idioma="<select name=\"id_etiqueta_idioma\" class=\"cajas\" style=\"width:150px\">\n";
}else{
$etiqueta_idioma="<select name=\"id_etiqueta_idioma\" class=\"cajas\" style=\"width:150px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}
//$etiqueta_idioma="<select name=\"id_etiqueta_idioma\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from etiquetas_idiomas";
$result=mysql_query($sql,$link);
$etiqueta_idioma.="<option value=\"0\">Etiqueta Idioma</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_etiqueta_idioma==$row[id_etiqueta_idioma])
$etiqueta_idioma.="<option value=\"$row[id_etiqueta_idioma]\" selected>$row[etiqueta_idioma]</option>\n";
else
$etiqueta_idioma.="<option value=\"$row[id_etiqueta_idioma]\">$row[etiqueta_idioma]</option>\n";
} 
$etiqueta_idioma.="</select>\n";
return $etiqueta_idioma;
}
*/

function crea_origenes222($link,$id_origen)
{
$origen="";
$origen="<select name=\"id_origen\" class=\"cajas\" style=\"width:115px\">\n";
$sql="select * from origenes where id_origen != 0 order by origen desc";
$result=mysql_query($sql,$link);
$origen.="<option value=\"0\">Origen</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_origen==$row[id_origen])
$origen.="<option value=\"$row[id_origen]\" selected>$row[origen]</option>\n";
else
$origen.="<option value=\"$row[id_origen]\">$row[origen]</option>\n";
} 
$origen.="</select>\n";
return $origen;
}
function crea_destinos_onchange($link,$id_destinos)
{
$destinos="<select name=\"id_destinos\" class=\"cajas\" style=\"width:180px\" onChange=\"JavaScript:document.form1.submit();\">\n";
$sql="select * from destinos where id_destinos != 0";
$result=mysql_query($sql,$link);
$destinos.="<option value=\"0\">Seleccione Destino</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_destinos==$row[id_destinos])
$destinos.="<option value=\"$row[id_destinos]\" selected>$row[nombre]</option>\n";
else
$destinos.="<option value=\"$row[id_destinos]\">$row[nombre]</option>\n";
} 
$destinos.="</select>\n";
return $destinos;
}

function crea_destinos_onchange2($link,$id_destinos,$id_producto)
{
$destinos="<select name=\"id_destinos\" class=\"cajas\" style=\"width:180px\" onChange=\"JavaScript:document.form1.submit();\">\n";
$sql="
select * from destinos as d, producto_alt as pa 
where 
d.id_destinos=pa.id_destinos and pa.id_producto=$id_producto
";

//echo "SQL $sql";
$result=mysql_query($sql,$link);
$destinos.="<option value=\"0\">Seleccione Destino</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_destinos==$row[id_destinos])
$destinos.="<option value=\"$row[id_destinos]\" selected>$row[nombre]</option>\n";
else
$destinos.="<option value=\"$row[id_destinos]\">$row[nombre]</option>\n";
} 
$destinos.="</select>\n";
return $destinos;
}

function crea_calibre_nuevo_informe($link,$id_calibre)
{
$calibre="<select name=\"id_calibre\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from calibre where id_calibre != 0";
$result=mysql_query($sql,$link);
$calibre.="<option value=\"0\">Seleccione Calibre</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_calibre==$row[id_calibre])
$calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre]</option>\n";
else
$calibre.="<option value=\"$row[id_calibre]\">$row[calibre]</option>\n";
} 
$calibre.="</select>\n";
return $calibre;
}


function crea_estado_folio($link,$id_estado_folio,$onchange)//funcion crea especie
{
if(!$onchange){
$estado_folio="<select name=\"id_estado_folio\" class=\"cajas\" style=\"width:140px\">\n";
}else{
$estado_folio="<select name=\"id_estado_folio\" class=\"cajas\" style=\"width:140px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="select * from estado_folio where id_estado_folio != 0";
$result=mysql_query($sql,$link);
$estado_folio.="<option value=\"0\">Estado de Folio</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_folio==$row[id_estado_folio])
$estado_folio.="<option value=\"$row[id_estado_folio]\" selected>$row[estado_folio]</option>\n";
else
$estado_folio.="<option value=\"$row[id_estado_folio]\">$row[estado_folio]</option>\n";
} 
$estado_folio.="</select>\n";
return $estado_folio;
}

function crea_unidad_medida_prod($link,$id_unidad_medida)// funcion crea unidad
{
$unidad_medida="<select name=\"id_unidad_medida\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from unidad_medida where id_unidad_medida = $id_unidad_medida";
$result=mysql_query($sql,$link);
$unidad_medida.="<option value=\"0\">Seleccione Unidad Medida</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_unidad_medida==$row[id_unidad_medida])
$unidad_medida.="<option value=\"$row[id_unidad_medida]\" selected>$row[unidad_medida]</option>\n";
else
$unidad_medida.="<option value=\"$row[id_unidad_medida]\">$row[unidad_medida]</option>\n";
} 
$unidad_medida.="</select>\n";
return $unidad_medida;
}


function crea_unidad_medida($link,$id_unidad_medida)// funcion crea unidad
{
$unidad_medida="<select name=\"id_unidad_medida\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from unidad_medida where id_unidad_medida = id_unidad_medida and id_unidad_medida != 0";
$result=mysql_query($sql,$link);
$unidad_medida.="<option value=\"0\">Seleccione Unidad Medida</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_unidad_medida==$row[id_unidad_medida])
$unidad_medida.="<option value=\"$row[id_unidad_medida]\" selected>$row[unidad_medida]</option>\n";
else
$unidad_medida.="<option value=\"$row[id_unidad_medida]\">$row[unidad_medida]</option>\n";
} 
$unidad_medida.="</select>\n";
return $unidad_medida;
}


function crea_unidad_medida_producto($link,$id_producto)// funcion crea unidad
{

if($id_producto){
$unidad_medida="<select name=\"id_unidad_medida\" class=\"cajas\" style=\"width:180px\">\n";
$sql="SELECT * FROM unidad_medida AS um, producto AS p WHERE um.id_unidad_medida = p.id_unidad_medida
AND p.id_producto = $id_producto";
$result=mysql_query($sql,$link);
$cuantas_unidades=mysql_num_rows($result);
}


while ($row=mysql_fetch_array($result))
{ 
if ($id_unidad_medida==$row[id_unidad_medida])
$unidad_medida.="<option value=\"$row[id_unidad_medida]\" selected>$row[unidad_medida]</option>\n";
else
$unidad_medida.="<option value=\"$row[id_unidad_medida]\">$row[unidad_medida]</option>\n";
} 
$unidad_medida.="</select>\n";
return $unidad_medida;
}


function crea_unidad_medida_producto2($link,$id_producto_material)// funcion crea unidad
{

if($id_producto_material){
$sql="SELECT * FROM unidad_medida AS um, producto AS p WHERE um.id_unidad_medida = p.id_unidad_medida
AND p.id_producto = $id_producto_material";
$result=mysql_query($sql,$link);
$cuantas_unidades=mysql_num_rows($result);
}


while ($row=mysql_fetch_array($result))
{ 
if($row[id_unidad_medida]!=''){
$unidad_medida.="$row[unidad_medida]";
}else{
$unidad_medida.="Sin Asignar";
} }
return $unidad_medida;
}

function crea_estado_faja($link,$id_estado_faja)//funcion crea especie
{
$estado_faja="<select name=\"id_estado_faja\" style=\"width:150px\" class=\"cajas\">\n";
$sql="select * from estado_faja";
$result=mysql_query($sql,$link);
$estado_faja.="<option value=\"0\">Estado</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_faja==$row[id_estado_faja])
$estado_faja.="<option value=\"$row[id_estado_faja]\" selected>$row[estado_faja]</option>\n";
else
$estado_faja.="<option value=\"$row[id_estado_faja]\">$row[estado_faja]</option>\n";
} 
$estado_faja.="</select>\n";
return $estado_faja;
}


function crea_unidad_produccion($link,$id_unidad_produccion)//funcion crea unidad de produccion
{

if(!$id_unidad_produccion)
$id_unidad_produccion=30;
$unidad_produccion="<select name=\"id_unidad_produccion\" style=\"width:250px\" class=\"cajas\">\n";
$sql="select * from unidad_produccion where id_unidad_produccion != 0";
$result=mysql_query($sql,$link);
$unidad_produccion.="<option value=\"0\">Unidad de Produccion</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_unidad_produccion==$row[id_unidad_produccion])
$unidad_produccion.="<option value=\"$row[id_unidad_produccion]\" selected>$row[nombreuni]   |   $row[id_etapa]</option>\n";
else
$unidad_produccion.="<option value=\"$row[id_unidad_produccion]\">$row[nombreuni]   |   $row[id_etapa]</option>\n";
} 
$unidad_produccion.="</select>\n";
return $unidad_produccion;
}

function crea_estado_material($link,$id_estado_material)//funcion crea estado de material
{

$estado_material="<select name=\"id_estado_material\" style=\"width:100px\" class=\"cajas\">\n";
$sql="select * from estado_material where id_estado_material != 0";
$result=mysql_query($sql,$link);
$estado_material.="<option value=\"0\">Estado Material</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_material==$row[id_estado_material])
$estado_material.="<option value=\"$row[id_estado_material]\" selected>$row[estado_material]</option>\n";
else
$estado_material.="<option value=\"$row[id_estado_material]\">$row[estado_material]</option>\n";
} 
$estado_material.="</select>\n";
return $estado_material;
}

function crea_bodegas($link,$id_bodegas,$onchange)//funcion crea especie
{
if(!$onchange){
if(!$id_bodegas)
$id_bodegas=1;
$bodegas="<select name=\"id_bodegas\" class=\"cajas\" style=\"width:180px\">\n";
}else{
$bodegas="<select name=\"id_bodegas\" class=\"cajas\" style=\"width:180px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}
$sql="select * from bodegas";
$result=mysql_query($sql,$link);
$bodegas.="<option value=\"0\">Seleccione Bodega</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_bodegas==$row[id_bodegas])
$bodegas.="<option value=\"$row[id_bodegas]\" selected>$row[bodegas]</option>\n";
else
$bodegas.="<option value=\"$row[id_bodegas]\">$row[bodegas]</option>\n";
} 
$bodegas.="</select>\n";
return $bodegas;
}

function crea_estado_pallets($link,$id_estado_pallet,$onchange)//funcion crea estado de material
{
if(!$onchange){
if(!$id_estado_pallet)
$id_estado_pallet=1;
$estado_pallet="<select name=\"id_estado_pallet\" class=\"cajas\" style=\"width:180px\">\n";
}else{
$estado_pallet="<select name=\"id_estado_pallet\" class=\"cajas\" style=\"width:180px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="select * from estado_pallet";
$result=mysql_query($sql,$link);
$estado_pallet.="<option value=\"0\">Seleccione Estado Pallets</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_pallet==$row[id_estado_pallet])
$estado_pallet.="<option value=\"$row[id_estado_pallet]\" selected>$row[estado_pallet]</option>\n";
else
$estado_pallet.="<option value=\"$row[id_estado_pallet]\">$row[estado_pallet]</option>\n";
} 
$estado_pallet.="</select>\n";
return $estado_pallet;
}

function crea_estado_pallets_otro($link,$id_estado_pallet)//funcion crea estado de material
{
$estado_pallet="<select name=\"id_estado_pallet\" style=\"width:180px\" class=\"cajas\">\n";
$sql="select * from estado_pallet where id_estado_pallet = 6";
$result=mysql_query($sql,$link);
$estado_pallet.="<option value=\"1\">Bodega</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_pallet==$row[id_estado_pallet])
$estado_pallet.="<option value=\"$row[id_estado_pallet]\" selected>$row[estado_pallet]</option>\n";
else
$estado_pallet.="<option value=\"$row[id_estado_pallet]\">$row[estado_pallet]</option>\n";
} 
$estado_pallet.="</select>\n";
return $estado_pallet;
}




function crea_lineas_procesos($link,$id_lineas_procesos)//funcion crea lineas de procesos
{

$lineas_procesos="<select name=\"id_lineas_procesos\" style=\"width:150px\" class=\"cajas\" >\n";

$sql="select * from lineas_procesos order by id_lineas_procesos asc";
$result=mysql_query($sql,$link);
$lineas_procesos.="<option value=\"0\">Seleccione Lineas Procesos</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_lineas_procesos==$row[id_lineas_procesos])
$lineas_procesos.="<option value=\"$row[id_lineas_procesos]\" selected>$row[nombre] $row[sector]</option>\n";
else
$lineas_procesos.="<option value=\"$row[id_lineas_procesos]\">$row[nombre] $row[sector]</option>\n";
} 
$lineas_procesos.="</select>\n";
return $lineas_procesos;
}



function crea_firma($link,$id_usuario)//funcion crea producto
{

$unombreape="<select name=\"id_usuario\" style=\"width:150px\" class=\"cajas\">\n";
$sql="select * from usuarios where firma != 0";
$result=mysql_query($sql,$link);
$unombreape.="<option value=\"0\">Firma Autotizada</option>\n";

while ($row=mysql_fetch_array($result))
{ 
if ($id_usuario==$row[id_usuario])
$unombreape.="<option value=\"$row[id_usuario]\" selected>$row[unombre] $row[uapellido]</option>\n";
else
$unombreape.="<option value=\"$row[id_usuario]\">$row[unombre]  $row[uapellido]</option>\n";

} 
$unombreape.="</select>\n";
return $unombreape;
}


function get_plantillas_formatos($link,$id_plantillas_formatos)
{
$operarios="";

$funcion_operarios=
"<select name=\"id_plantillas_formatos\" onchange=\"JavaScript:document.Form1.submit();\">\n";

$sql="select * from plantillas_formatos";
$result=mysql_query($sql,$link);

$funcion_operarios.="<option value=\"0\">Seleccione Formato</option>\n";
while ($row=mysql_fetch_array($result))
     { 
if ($id_plantillas_formatos==$row[id_plantillas_formatos])
$funcion_operarios.="<option value=\"$row[id_plantillas_formatos]\" selected>$row[formato]</option>\n";
else
$funcion_operarios.="<option value=\"$row[id_plantillas_formatos]\">$row[formato]</option>\n";
} 
$funcion_operarios.="</select>\n";
return $funcion_operarios;
}


function get_operarios($link,$id_operarios,$name)
{
$operarios="";

$funcion_operarios="<select name=\"$name\">\n";

$sql="select * from operarios where id_estado=1";
$result=mysql_query($sql,$link);

$funcion_operarios.="<option value=\"0\">Seleccione un Operario</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_operarios==$row[id_operarios])
$funcion_operarios.="<option value=\"$row[id_operarios]\" selected>$row[apellido] $row[nombre]</option>\n";
else
$funcion_operarios.="<option value=\"$row[id_operarios]\">$row[apellido] $row[nombre]</option>\n";
} 
$funcion_operarios.="</select>\n";
return $funcion_operarios;
}



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


	
function crea_calibre($link,$id_calibre,$id)
{

$sql2="select * from etiquetados_folios as ef,calibre as c 
       where ef.id_calibre=c.id_calibre and c.id_calibre=$id_calibre";
//echo "SQL2 $sql2<br>";



$rest2=mysql_query($sql2);
$cuantos=mysql_num_rows($rest2);
$calibre="";
if($id)
$calibre="<select name=\"id_calibre-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$calibre="<select name=\"id_calibre\">\n";
$sql="select * from calibre where id_calibre != 0";
$result=mysql_query($sql,$link);

$calibre.="<option value=\"0\">Seleccione Calibre</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_calibre==$row[id_calibre])
$calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre]|$row[color]--$row[id_calibre]</option>\n";
else
$calibre.="<option value=\"$row[id_calibre]\">$row[calibre]|$row[color]--$row[id_calibre]</option>\n";
} 
$calibre.="</select>\n";
return $calibre;
}




function crea_medidas_productos_ok($link,$id_medidas_productos,$id)
{

$medidas_productos="";
if($id)
$medidas_productos="<select name=\"id_medidas_productos-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$medidas_productos="<select name=\"id_medidas_productos\">\n";
$sql="select * from medidas_productos where id_medidas_productos != 0";
$result=mysql_query($sql,$link);

$medidas_productos.="<option value=\"0\">Medida Producto</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_medidas_productos==$row[id_medidas_productos])
$medidas_productos.="<option value=\"$row[id_medidas_productos]\" selected>$row[medidas_productos] - $row[id_medidas_productos]</option>\n";
else
$medidas_productos.="<option value=\"$row[id_medidas_productos]\">$row[medidas_productos] - $row[id_medidas_productos]</option>\n";
} 
$medidas_productos.="</select>\n";
return $medidas_productos;
}

function crea_caracteristicas_producto_ok($link,$id_caract_producto,$id)
{

$caract_producto="";
if($id)
$caract_producto="<select name=\"id_caract_producto-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$caract_producto="<select name=\"id_caract_producto\">\n";
$sql="select * from caract_producto where  id_caract_producto != 0";
$result=mysql_query($sql,$link);

$caract_producto.="<option value=\"0\">Caracteristica</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_caract_producto==$row[id_caract_producto])
$caract_producto.="<option value=\"$row[id_caract_producto]\" selected>$row[caract_producto]</option>\n";
else
$caract_producto.="<option value=\"$row[id_caract_producto]\">$row[caract_producto]</option>\n";
} 
$caract_producto.="</select>\n";
return $caract_producto;
}


function crea_caracteristicas_envase_ok($link,$id_caract_envases,$id)
{

$caract_envases="";
if($id)
$caract_envases="<select name=\"id_caract_envases-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$caract_envases="<select name=\"id_caract_envases\">\n";
$sql="select * from caract_envases where id_caract_envases != 0 ";
$result=mysql_query($sql,$link);

$caract_envases.="<option value=\"0\">Caracteristica Envases</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_caract_envases ==$row[id_caract_envases])
$caract_envases.="<option value=\"$row[id_caract_envases]\" selected>$row[caract_envases]</option>\n";
else
$caract_envases.="<option value=\"$row[id_caract_envases]\">$row[caract_envases]</option>\n";
} 
$caract_envases.="</select>\n";
return $caract_envases;
}

function crea_especie_ok($link,$id_especie,$id)
{

$especie="";
if($id)
$especie="<select name=\"id_especie-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$especie="<select name=\"id_especie\">\n";
$sql="select * from especie where id_especie != 0";
$result=mysql_query($sql,$link);

$especie.="<option value=\"0\">Especie</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_especie ==$row[id_especie])
$especie.="<option value=\"$row[id_especie]\" selected>$row[especie]</option>\n";
else
$especie.="<option value=\"$row[id_especie]\">$row[especie]</option>\n";
} 
$especie.="</select>\n";
return $especie;
}

function crea_unidad_medida_ok($link,$id_unidad_medida,$id)
{

$unidad_medida="";
if($id)
$unidad_medida="<select name=\"id_unidad_medida-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$unidad_medida="<select name=\"id_unidad_medida\">\n";
$sql="select * from unidad_medida ";
$result=mysql_query($sql,$link);

$unidad_medida.="<option value=\"0\">Seleccione Unidad Medida</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_unidad_medida==$row[id_unidad_medida])
$unidad_medida.="<option value=\"$row[id_unidad_medida]\" selected>$row[unidad_medida]</option>\n";
else
$unidad_medida.="<option value=\"$row[id_unidad_medida]\">$row[unidad_medida]</option>\n";
} 
$unidad_medida.="</select>\n";
return $unidad_medida;
}


function despliega_unidad_medida($link,$id_unidad_medida,$id)// funcion crea etapa
{
$unidad_medida="";
if($id)
$unidad_medida="<select name=\"id_unidad_medida-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$unidad_medida="<select name=\"id_unidad_medida\">\n";
$sql="select * from unidad_medida where id_unidad_medida != 0 ";
$result=mysql_query($sql,$link);
$unidad_medida.="<option value=\"0\">Seleccione unidad medida</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_unidad_medida==$row[id_unidad_medida])
$unidad_medida.="<option value=\"$row[id_unidad_medida]\" selected>$row[unidad_medida] </option>\n";
else
$unidad_medida.="<option value=\"$row[id_unidad_medida]\">$row[unidad_medida]</option>\n";
} 
$unidad_medida.="</select>\n";
return $unidad_medida;
}

function despliega_medidas_productos($link,$id_medidas_productos,$id)// funcion crea etapa
{
$medidas_productos="";
if($id)
$medidas_productos="<select name=\"id_medidas_productos-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$medidas_productos="<select name=\"id_medidas_productos\">\n";
$sql="select * from  medidas_productos where id_medidas_productos != 0 ";
$result=mysql_query($sql,$link);
$medidas_productos.="<option value=\"0\">Unidad medida</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_medidas_productos==$row[id_medidas_productos])
$medidas_productos.="<option value=\"$row[id_medidas_productos]\" selected>$row[medidas_productos] -- $row[id_medidas_productos]</option>\n";
else
$medidas_productos.="<option value=\"$row[id_medidas_productos]\">$row[medidas_productos] -- $row[id_medidas_productos]</option>\n";
} 
$medidas_productos.="</select>\n";
return $medidas_productos;
}

function despliega_caracteristicas($link,$id_caract_producto,$id)// funcion crea etapa
{
$caract_producto="";
if($id)
$caract_producto="<select name=\"id_caract_producto-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$caract_producto="<select name=\"id_caract_producto\">\n";
$sql="select * from  caract_producto where id_caract_producto != 0 and id_caract_producto != 0";
$result=mysql_query($sql,$link);
$caract_producto.="<option value=\"0\">Caracteristica</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_caract_producto==$row[id_caract_producto])
$caract_producto.="<option value=\"$row[id_caract_producto]\" selected>$row[caract_producto]</option>\n";
else
$caract_producto.="<option value=\"$row[id_caract_producto]\">$row[caract_producto]</option>\n";
} 
$caract_producto.="</select>\n";
return $caract_producto;
}

function despliega_caracteristicas_envase($link,$id_caract_envases,$id)// funcion crea etapa
{
$caract_envases="";
if($id)
$caract_envases="<select name=\"id_caract_envases-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$caract_envases="<select name=\"id_caract_envases\">\n";
$sql="select * from  caract_envases where id_caract_envases != 0 ";
$result=mysql_query($sql,$link);
$caract_envases.="<option value=\"0\">Caracteristica Envase</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_caract_envases==$row[id_caract_envases])
$caract_envases.="<option value=\"$row[id_caract_envases]\" selected>$row[caract_envases]</option>\n";
else
$caract_envases.="<option value=\"$row[id_caract_envases]\">$row[caract_envases]</option>\n";
} 
$caract_envases.="</select>\n";
return $caract_envases;
}

function despliega_especie($link,$id_especie,$id)// funcion crea etapa
{
$especie="";
if($id)
$especie="<select name=\"id_especie-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$especie="<select name=\"id_especie\">\n";
$sql="select * from  especie where id_especie != 0 ";
$result=mysql_query($sql,$link);
$especie.="<option value=\"0\">Especie</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_especie==$row[id_especie])
$especie.="<option value=\"$row[id_especie]\" selected>$row[especie]</option>\n";
else
$especie.="<option value=\"$row[id_especie]\">$row[especie]</option>\n";
} 
$especie.="</select>\n";
return $especie;
}

function despliega_calibre($link,$id_calibre,$id)// funcion crea etapa
{
$calibre="";
if($id)
$calibre="<select name=\"id_calibre-$id\" style=\"width:150px\" class=\"cajas\">\n";
else
$calibre="<select name=\"id_calibre\">\n";
$sql="select * from calibre where id_calibre != 0 ";
$result=mysql_query($sql,$link);
$calibre.="<option value=\"0\">Seleccione calibre</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_calibre==$row[id_calibre])
$calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre] - $row[id_calibre] - $row[onoff]</option>\n";
else
$calibre.="<option value=\"$row[id_calibre]\">$row[calibre] - $row[id_calibre] - $row[onoff]</option>\n";
} 
$calibre.="</select>\n";
return $calibre;
}




function crea_calibre_carga($link,$id_calibre,$id)
{
$sql2="select * from etiquetados_folios as ef,calibre as c 
       where ef.id_calibre=c.id_calibre and c.id_calibre=$id_calibre";
$rest2=mysql_query($sql2);
$cuantos=mysql_num_rows($rest2);
$calibre="";
if($id)
$calibre="<select name=\"id_calibre-$id\" onchange=\"JavaScript:document.form1.submit();\">\n";
else
$calibre="<select name=\"id_calibre\">\n";
$sql="select * from calibre where id_calibre != 0";
$result=mysql_query($sql,$link);

$calibre.="<option value=\"0\">Seleccione Calibre</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_calibre==$row[id_calibre])
$calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre]|$row[color]--$row[id_calibre]</option>\n";
else
$calibre.="<option value=\"$row[id_calibre]\">$row[calibre]|$row[color]--$row[id_calibre]</option>\n";
} 
$calibre.="</select>\n";
return $calibre;
}





function crea_calibre2($link,$id_calibre,$id_producto)
{
$calibre="";
$calibre="<select name=\"id_calibre\" style=\"width:250px\" class=\"cajas\">\n";

$sql="SELECT * FROM cruce_plant_calibre AS cpc, producto AS pro, calibre AS c WHERE cpc.id_producto =pro.id_producto and cpc.id_producto=$id_producto and cpc.id_calibre = c.id_calibre and c.id_calibre !=0";

$result=mysql_query($sql,$link);
$calibre.="<option value=\"0\">Seleccione Calibre</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_calibre==$row[id_calibre])
$calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre] - $row[condicion_cod_barra] - $row[color] - $row[id_calibre]</option>\n";
else
$calibre.="<option value=\"$row[id_calibre]\">$row[calibre] -  $row[condicion_cod_barra] - $row[color] - $row[id_calibre]</option>\n";
} 
$calibre.="</select>\n";
return $calibre;
}

function crea_calibre_condicion($link,$id_calibre,$id_producto)
{
$condicion="";

$sql="SELECT * FROM cruce_plant_calibre AS cpc, producto AS pro, calibre AS c WHERE cpc.id_producto =pro.id_producto and cpc.id_producto=$id_producto and cpc.id_calibre = c.id_calibre and c.id_calibre !=0";

$result=mysql_query($sql,$link);
if ($row=mysql_fetch_array($result))
{
$condicion.="<option value=\"$row[id_calibre]\" selected>$row[condicion_cod_barra]</option>\n";
}
return $condicion;
}

function crea_calibre_onchange($link,$id_calibre,$id_producto)
{
$calibre="";
$calibre="<select name=\"id_calibre\" style=\"width:250px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\">\n";

$sql="SELECT * FROM cruce_plant_calibre AS cpc, producto AS pro, calibre AS c WHERE cpc.id_producto =pro.id_producto and cpc.id_producto=$id_producto and cpc.id_calibre = c.id_calibre and c.id_calibre !=0";

$result=mysql_query($sql,$link);
$calibre.="<option value=\"0\">Seleccione Calibre</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_calibre==$row[id_calibre])
$calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre]|$row[color]</option>\n";
else
$calibre.="<option value=\"$row[id_calibre]\">$row[calibre]|$row[color]</option>\n";
} 
$calibre.="</select>\n";
return $calibre;
}
function generar_calibre($link,$id_calibre)
    {

    $sql="select * from calibre ";
    $ret = mysql_query($sql,$link);
    
    while ($row=mysql_fetch_array($ret))
         {
          if ($row[id_calibre] == $id_calibre)
          $calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre] | $row[color]</option>\n";
          else
		  $calibre.="<option value=\"$row[id_calibre]\">$row[calibre] | $row[color]</option>\n";
         }
    return $calibre;
    }





function format_fecha($fecha)
      {
      
          $dat=split("-",$fecha);
          $fecha="$dat[2]-$dat[1]-$dat[0]";
       
      return $fecha;
      }     

function format_fecha1 ($fecha)
      {
      
          $dat=split("/",$fecha);
          $fecha="$dat[2]-$dat[1]-$dat[0]";
       
      return $fecha;
      }

function format_fecha2 ($fecha)
      {
      
          $dat2=split(" ",$fecha);
 		  $dat=split("-",$dat2[0]);
          $fecha="$dat[2]-$dat[1]-$dat[0] $dat2[1]";
       
      return $fecha;
      }

function format_fecha_sin_hora ($fecha)
      {
      
          $dat2=split(" ",$fecha);
 		  $dat=split("-",$dat2[0]);
          $fecha="$dat[2]-$dat[1]-$dat[0]";
       
      return $fecha;
      }
	  
function crea_estado_material_informe($link,$id_estado_material)//funcion crea estado de material
{
$estado_material="<select name=\"id_estado_material\" style=\"width:180px\" class=\"cajas\">\n";
$sql="select * from estado_material";
$result=mysql_query($sql,$link);
$estado_material.="<option value=\"0\">Seleccione Estado Material</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_material==$row[id_estado_material])
$estado_material.="<option value=\"$row[id_estado_material]\" selected>$row[estado_material]</option>\n";
else
$estado_material.="<option value=\"$row[id_estado_material]\">$row[estado_material]</option>\n";
} 
$estado_material.="</select>\n";
return $estado_material;
}	  

function crea_unidad_produccion_informe($link,$id_unidad_produccion)//funcion crea unidad de produccion
{
$unidad_produccion="<select name=\"id_unidad_produccion\" style=\"width:250px\" class=\"cajas\">\n";
$sql="select * from unidad_produccion where id_unidad_produccion != 0";
$result=mysql_query($sql,$link);
$unidad_produccion.="<option value=\"0\">Seleccione Origen</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_unidad_produccion==$row[id_unidad_produccion])
$unidad_produccion.="<option value=\"$row[id_unidad_produccion]\" selected>$row[nombre]   |   $row[id_etapa]</option>\n";
else
$unidad_produccion.="<option value=\"$row[id_unidad_produccion]\">$row[nombre]   |   $row[id_etapa]</option>\n";
} 
$unidad_produccion.="</select>\n";
return $unidad_produccion;
}


$calibre="";
$calibre="<select name=\"id_calibre\" style=\"width:250px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\">\n";

function crea_estado_pallets_informe($link,$id_estado_pallet)//funcion crea estado de material
{
$estado_pallet="<select name=\"id_estado_pallet\" style=\"width:250px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\">\n";
$sql="select * from estado_pallet";
$result=mysql_query($sql,$link);
$estado_pallet.="<option value=\"0\">Seleccione Estado Pallet</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_pallet==$row[id_estado_pallet])
$estado_pallet.="<option value=\"$row[id_estado_pallet]\" selected>$row[estado_pallet]</option>\n";
else
$estado_pallet.="<option value=\"$row[id_estado_pallet]\">$row[estado_pallet]</option>\n";
} 
$estado_pallet.="</select>\n";
return $estado_pallet;
}

function crea_destinos_informe($link,$id_destinos)//funcion crea especie
{
$destinos="<select name=\"id_destinos\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from destinos where id_destinos != 0";
$result=mysql_query($sql,$link);
$destinos.="<option value=\"0\">Seleccione Destino</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_destinos==$row[id_destinos])
$destinos.="<option value=\"$row[id_destinos]\" selected>$row[nombre]</option>\n";
else
$destinos.="<option value=\"$row[id_destinos]\">$row[nombre]</option>\n";
} 
$destinos.="</select>\n";
return $destinos;
}



function crea_especiecheckbox($link,$id_especie,$id_unidad_produccion)//funcion crea especie
{

$sql="select * from especie";
$result=mysql_query($sql,$link);

while ($row=mysql_fetch_array($result))
{ 
if($id_unidad_produccion){
$sql2="select * from cruce_unidad_produc_especie  
where id_unidad_produccion=$id_unidad_produccion and id_especie=$row[id_especie]";


$res2=mysql_query($sql2);
$c2=mysql_num_rows($res2);
}
if ($c2)
 $val="checked";
else
 $val="";

$especie.="<input type=\"checkbox\" name=\"id_especie[]\" value=\"$row[id_especie]\" $val/> $row[especie] <br>";

} 

//$especie.="</select>\n";
return $especie;
}

function crea_estado_folio_otro($link,$id_estado_folio,$id)//funcion crea especie
{
$estado_folio="<select name=\"id_estado_folio\" class=\"cajas\" style=\"width:150px\">\n";
$sql="select * from estado_folio where id_estado_folio = $id ";
$result=mysql_query($sql,$link);
$estado_folio.="<option value=\"0\">Seleccione Estado del Folio</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_folio==$row[id_estado_folio])
$estado_folio.="<option value=\"$row[id_estado_folio]\" selected>$row[estado_folio]</option>\n";
else
$estado_folio.="<option value=\"$row[id_estado_folio]\">$row[estado_folio]</option>\n";
} 
$estado_folio.="</select>\n";
return $estado_folio;
}	

function crea_efolio($link,$id_estado_folio,$id)// funcion crea etapa
{

//$calibre="";
//$calibre="<select name=\"id_calibre\" style=\"width:250px\" class=\"cajas\" onChange=\"JavaScript:document.form1.submit();\">\n";


if(!$id)
{
$estado_folio="<select name=\"id_estado_folio\" class=\"cajas\" style=\"width:150px\">\n";
$sql="SELECT * FROM estado_folio WHERE id_estado_folio != 1 and id_estado_folio !=2 and id_estado_folio != 5 and id_estado_folio != 6 and id_estado_folio != 9 and id_estado_folio != 0";
}
if($id == 1){
$estado_folio="<select name=\"id_estado_folio\" class=\"cajas\" style=\"width:150px\" onChange=\"JavaScript:document.form1.submit();\">\n";
$sql="SELECT * FROM estado_folio WHERE id_estado_folio != 1 and id_estado_folio !=2 and id_estado_folio != 5 and id_estado_folio != 6 and id_estado_folio != 9 and id_estado_folio != 0";
}

$result=mysql_query($sql,$link);
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_folio==$row[id_estado_folio])
$estado_folio.="<option value=\"$row[id_estado_folio]\" selected>$row[estado_folio]</option>\n";
else
$estado_folio.="<option value=\"$row[id_estado_folio]\">$row[estado_folio]</option>\n";
} 
$estado_folio.="</select>\n";
return $estado_folio;
}

function crea_estado_folio_insuban($link,$id_estado_folio,$onchange)// funcion crea Procedencia
{
if(!$onchange){
$estado_folio="<select name=\"id_estado_folio\" class=\"cajas\" style=\"width:90px\">\n";
}else{
$estado_folio="<select name=\"id_estado_folio\" class=\"cajas\" style=\"width:90px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}
$sql="SELECT * FROM estado_folio WHERE id_estado_folio != 1 and id_estado_folio !=2 and id_estado_folio != 5 and id_estado_folio != 6 and id_estado_folio != 9 and id_estado_folio != 0  and id_estado_folio != 6  and id_estado_folio != 10  and id_estado_folio != 8  and id_estado_folio != 4";
$result=mysql_query($sql,$link);
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_folio==$row[id_estado_folio])
$estado_folio.="<option value=\"$row[id_estado_folio]\" selected>$row[estado_folio]</option>\n";
else
$estado_folio.="<option value=\"$row[id_estado_folio]\">$row[estado_folio]</option>\n";
} 
$estado_folio.="</select>\n";
return $estado_folio;
}




function crea_estado_folio_filtro($link,$id_estado_folio,$onchange)//funcion crea especie
{
if(!$onchange){
$estado_folio="<select name=\"id_estado_folio\" class=\"cajas\" style=\"width:150px\">\n";
}else{
$estado_folio="<select name=\"id_estado_folio\" class=\"cajas\" style=\"width:150px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="select * from estado_folio where id_estado_folio != 0";
$result=mysql_query($sql,$link);
$estado_folio.="<option value=\"0\">Seleccione Estado del Folio</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado_folio==$row[id_estado_folio])
$estado_folio.="<option value=\"$row[id_estado_folio]\" selected>$row[estado_folio]</option>\n";
else
$estado_folio.="<option value=\"$row[id_estado_folio]\">$row[estado_folio]</option>\n";
} 
$estado_folio.="</select>\n";
return $estado_folio;
}

function crea_producto_filtro($link,$id_producto,$onchange)//funcion crea especie
{

if(!$onchange){
$producto="<select name=\"id_producto\" class=\"cajas\" style=\"width:140px\">\n";
}else{
$producto="<select name=\"id_producto\" class=\"cajas\" style=\"width:140px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="select * from producto AS pro, cruce_plant_calibre AS cpc where pro.id_producto = cpc.id_producto and pro.id_producto != 0 and pro.id_estado != 2 GROUP BY pro.id_producto";
$result=mysql_query($sql,$link);
$producto.="<option value=\"0\">Producto</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_producto==$row[id_producto])
$producto.="<option value=\"$row[id_producto]\" selected>$row[nombre] - $row[id_producto]</option>\n";
else
$producto.="<option value=\"$row[id_producto]\">$row[nombre] - $row[id_producto]</option>\n";
} 
$producto.="</select>\n";
return $producto;
}




function crea_especie_codificacion($link,$id_especie,$onchange,$only)//funcion crea especie
{
$especie="";
if(!$onchange){
$especie="<select name=\"id_especie-$id_cruce_tablas\" class=\"cajas\" style=\"width:140px\">\n";
}else{
$especie="<select name=\"id_especie\" class=\"cajas\" style=\"width:140px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="select * from especie where id_especie != 0";
$result=mysql_query($sql,$link);
if(!$only){
$especie.="<option value=\"0\">Especie</option>\n";
}

while ($row=mysql_fetch_array($result))
{ 

if(!$only){
if ($id_especie==$row[id_especie])
$especie.="<option value=\"$row[id_especie]\" selected>$row[especie]</option>\n";
else
$especie.="<option value=\"$row[id_especie]\">$row[especie]</option>\n";
}else{
if ($id_especie==$row[id_especie])
$especie.="<option value=\"$row[id_especie]\" selected>$row[especie]</option>\n";
}
} 
$especie.="</select>\n";
return $especie;
}


function crea_producto_especie_codificacion($link,$id_especie,$id_producto,$onchange,$only)//funcion crea especie
{
$producto_especie="";
if(!$onchange){
$producto_especie="<select name=\"id_producto-$id_cruce_tablas\" class=\"cajas\" style=\"width:140px\">\n";
}else{
$producto_especie="<select name=\"id_producto\" class=\"cajas\" style=\"width:140px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="select * from producto AS pro, cruce_plant_especie  AS cpe where pro.id_producto = cpe.id_producto and cpe.id_especie = $id_especie  and pro.id_producto != 0 and pro.id_estado != 2 GROUP BY pro.id_producto";
$result=mysql_query($sql,$link);

if(!$only){
$producto_especie.="<option value=\"0\">Producto</option>\n";
}

while ($row=mysql_fetch_array($result))
{ 

if(!$only){
if ($id_producto==$row[id_producto])
$producto_especie.="<option value=\"$row[id_producto]\" selected>$row[producto]</option>\n";
else
$producto_especie.="<option value=\"$row[id_producto]\">$row[producto]</option>\n";
}else{
if ($id_producto==$row[id_producto])
$producto_especie.="<option value=\"$row[id_producto]\" selected>$row[producto]</option>\n";
}
} 
$producto_especie.="</select>\n";
return $producto_especie;
}


function crea_producto_calibre_codificacion($link,$id_producto,$id_calibre,$onchange,$only)//funcion crea especie
{
$producto_calibre="";
if(!$onchange){
$producto_calibre="<select name=\"id_calibre-$id_cruce_tablas\" class=\"cajas\" style=\"width:140px\">\n";
}else{
$producto_calibre="<select name=\"id_calibre\" class=\"cajas\" style=\"width:140px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="SELECT * 
FROM cruce_plant_calibre AS cpc, calibre AS c, producto AS p
WHERE cpc.id_cruce_plant_calibre != 0 and cpc.id_calibre = c.id_calibre and cpc.id_producto = $id_producto and cpc.id_producto = p.id_producto and c.id_calibre != 0 and onoff != 1
";
$result=mysql_query($sql,$link);
if(!$only){
$producto_calibre.="<option value=\"0\">Calibre</option>\n";
}

while ($row=mysql_fetch_array($result))
{ 
if(!$only){
if ($id_calibre==$row[id_calibre])
$producto_calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre]</option>\n";
else
$producto_calibre.="<option value=\"$row[id_calibre]\">$row[calibre]</option>\n";
}else{
if ($id_calibre==$row[id_calibre])
$producto_calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre]</option>\n";
}
} 
$producto_calibre.="</select>\n";
return $producto_calibre;
}


function crea_producto_medida_codificacion($link,$id_producto,$id_medidas_productos,$onchange,$only)
{
$producto_medida="";
if(!$onchange){
$producto_medida="<select name=\"id_medidas_productos-$id_cruce_tablas\" class=\"cajas\" style=\"width:140px\">\n";
}else{
$producto_medida="<select name=\"id_medidas_productos\" class=\"cajas\" style=\"width:140px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="SELECT * 
FROM cruce_plant_medidas_productos AS cpmp, medidas_productos  AS mp
WHERE cpmp.id_medidas_productos = mp.id_medidas_productos and cpmp.id_producto = $id_producto ";
$result=mysql_query($sql,$link);
if(!$only){
$producto_medida.="<option value=\"0\">Medida</option>\n";
}
while ($row=mysql_fetch_array($result))
{ 

if(!$only){
if ($id_medidas_productos==$row[id_medidas_productos])
$producto_medida.="<option value=\"$row[id_medidas_productos]\" selected>$row[medidas_productos]</option>\n";
else
$producto_medida.="<option value=\"$row[id_medidas_productos]\">$row[medidas_productos]</option>\n";
}else{
if ($id_medidas_productos==$row[id_medidas_productos])
$producto_medida.="<option value=\"$row[id_medidas_productos]\" selected>$row[medidas_productos]</option>\n";
}
} 
$producto_medida.="</select>\n";
return $producto_medida;
}


function crea_producto_caract_codificacion($link,$id_producto,$id_caract_producto,$onchange,$only)
{
$producto_caract_producto="";
if(!$onchange){
$producto_caract_producto="<select name=\"id_caract_producto-$id_cruce_tablas\" class=\"cajas\" style=\"width:140px\">\n";
}else{
$producto_caract_producto="<select name=\"id_caract_producto\" class=\"cajas\" style=\"width:140px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="SELECT * 
FROM cruce_plant_caract_producto AS cpcp, caract_producto AS cp
WHERE cpcp.id_caract_producto = cp.id_caract_producto and cpcp.id_producto = $id_producto ";
$result=mysql_query($sql,$link);
if(!$only){
$producto_caract_producto.="<option value=\"0\">Caract. Producto</option>\n";
}
while ($row=mysql_fetch_array($result))
{ 
if(!$only){
if ($id_caract_producto==$row[id_caract_producto])
$producto_caract_producto.="<option value=\"$row[id_caract_producto]\" selected>$row[caract_producto]</option>\n";
else
$producto_caract_producto.="<option value=\"$row[id_caract_producto]\">$row[caract_producto]</option>\n";
}else{
if ($id_caract_producto==$row[id_caract_producto])
$producto_caract_producto.="<option value=\"$row[id_caract_producto]\" selected>$row[caract_producto]</option>\n";
}

} 
$producto_caract_producto.="</select>\n";
return $producto_caract_producto;
}


function crea_producto_caract_envases($link,$id_producto,$id_caract_envases,$onchange,$only)
{
$producto_caract_envases="";
if(!$onchange){
$producto_caract_envases="<select name=\"id_caract_envases-$id_cruce_tablas\" class=\"cajas\" style=\"width:140px\">\n";
}else{
$producto_caract_envases="<select name=\"id_caract_envases\" class=\"cajas\" style=\"width:140px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="SELECT * 
FROM cruce_plant_caract_envases  AS cpce, caract_envases AS ce
WHERE cpce.id_caract_envases = ce.id_caract_envases and cpce.id_producto = $id_producto ";
$result=mysql_query($sql,$link);
if(!$only){
$producto_caract_envases.="<option value=\"0\">Caract. Envase</option>\n";
}
while ($row=mysql_fetch_array($result))
{ 
if(!$only){
if ($id_caract_envases==$row[id_caract_envases])
$producto_caract_envases.="<option value=\"$row[id_caract_envases]\" selected>$row[caract_envases]</option>\n";
else
$producto_caract_envases.="<option value=\"$row[id_caract_envases]\">$row[caract_envases]</option>\n";
}else{
if ($id_caract_envases==$row[id_caract_envases])
$producto_caract_envases.="<option value=\"$row[id_caract_envases]\" selected>$row[caract_envases]</option>\n";

}
} 
$producto_caract_envases.="</select>\n";
return $producto_caract_envases;
}



function crea_producto_unidad_medida_codificacion($link,$id_producto,$id_unidad_medida,$onchange,$only)
{
$producto_unidad_medida="";
if(!$onchange){
$producto_unidad_medida="<select name=\"id_unidad_medida-$id_cruce_tablas\" class=\"cajas\" style=\"width:140px\">\n";
}else{
$producto_unidad_medida="<select name=\"id_unidad_medida\" class=\"cajas\" style=\"width:140px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="SELECT * 
FROM cruce_plant_unidad_medida  AS cpum, unidad_medida AS um
WHERE cpum.id_unidad_medida = um.id_unidad_medida and cpum.id_producto = $id_producto ";
$result=mysql_query($sql,$link);
if(!$only){
$producto_unidad_medida.="<option value=\"0\">Unidad Medida</option>\n";
}
while ($row=mysql_fetch_array($result))
{ 
if(!$only){
if ($id_unidad_medida==$row[id_unidad_medida])
$producto_unidad_medida.="<option value=\"$row[id_unidad_medida]\" selected>$row[unidad_medida]</option>\n";
else
$producto_unidad_medida.="<option value=\"$row[id_unidad_medida]\">$row[unidad_medida]</option>\n";
}else{
if ($id_unidad_medida==$row[id_unidad_medida])
$producto_unidad_medida.="<option value=\"$row[id_unidad_medida]\" selected>$row[unidad_medida]</option>\n";
}
} 
$producto_unidad_medida.="</select>\n";
return $producto_unidad_medida;
}





function crea_calibre_filtro($link,$id_calibre,$id_producto,$onchange)
{

if(!$onchange){
$calibre="<select name=\"id_calibre\" class=\"cajas\" style=\"width:150px\">\n";
}else{
$calibre="<select name=\"id_calibre\" class=\"cajas\" style=\"width:150px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="SELECT * FROM cruce_plant_calibre AS cpc, producto AS pro, calibre AS c WHERE cpc.id_producto =pro.id_producto and cpc.id_producto=$id_producto and cpc.id_calibre = c.id_calibre and c.id_calibre !=0 and c.onoff != 1";

$result=mysql_query($sql,$link);
$calibre.="<option value=\"0\">Seleccione Calibre</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_calibre==$row[id_calibre])
$calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre]</option>\n";
else
$calibre.="<option value=\"$row[id_calibre]\">$row[calibre]</option>\n";
} 
$calibre.="</select>\n";
return $calibre;
}

function crea_unidad_medida_filtro($link,$id_unidad_medida,$id_producto,$onchange)
{

if(!$onchange){
$unidad_medida="<select name=\"id_unidad_medida\" class=\"cajas\" style=\"width:150px\">\n";
}else{
$unidad_medida="<select name=\"id_unidad_medida\" class=\"cajas\" style=\"width:150px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="SELECT * FROM cruce_plant_unidad_medida AS cpum, producto AS pro, unidad_medida AS um WHERE cpum.id_producto =pro.id_producto and cpum.id_producto=$id_producto and cpum.id_unidad_medida = um.id_unidad_medida and um.id_unidad_medida !=0";

$result=mysql_query($sql,$link);
$unidad_medida.="<option value=\"0\">Unidad Medida</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_unidad_medida==$row[id_unidad_medida])
$unidad_medida.="<option value=\"$row[id_unidad_medida]\" selected>$row[unidad_medida]</option>\n";
else
$unidad_medida.="<option value=\"$row[id_unidad_medida]\">$row[unidad_medida]</option>\n";
} 
$unidad_medida.="</select>\n";
return $unidad_medida;
}

function crea_medidas_productos_filtro($link,$id_medidas_productos,$id_producto,$onchange)
{

if(!$onchange){
$medidas_productos="<select name=\"id_medidas_productos\" class=\"cajas\" style=\"width:150px\">\n";
}else{
$medidas_productos="<select name=\"id_medidas_productos\" class=\"cajas\" style=\"width:150px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="SELECT * FROM cruce_plant_medidas_productos AS cpmp, producto AS pro, medidas_productos AS mp WHERE cpmp.id_producto =pro.id_producto and cpmp.id_producto=$id_producto and cpmp.id_medidas_productos = mp.id_medidas_productos and mp.id_medidas_productos  !=0";

$result=mysql_query($sql,$link);
$medidas_productos.="<option value=\"0\">Medidas</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_medidas_productos==$row[id_medidas_productos])
$medidas_productos.="<option value=\"$row[id_medidas_productos]\" selected>$row[medidas_productos]</option>\n";
else
$medidas_productos.="<option value=\"$row[id_medidas_productos]\">$row[medidas_productos]</option>\n";
} 
$medidas_productos.="</select>\n";
return $medidas_productos;
}

function crea_caract_producto_filtro($link,$id_caract_producto,$id_producto,$onchange)
{

if(!$onchange){
$caract_producto="<select name=\"id_caract_producto\" class=\"cajas\" style=\"width:150px\">\n";
}else{
$caract_producto="<select name=\"id_caract_producto\" class=\"cajas\" style=\"width:150px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="SELECT * FROM cruce_plant_caract_producto  AS cpcp, producto AS pro, caract_producto AS cp WHERE cpcp.id_producto =pro.id_producto and cpcp.id_producto=$id_producto and cpcp.id_caract_producto = cp.id_caract_producto and cp.id_caract_producto  !=0";

$result=mysql_query($sql,$link);
$caract_producto.="<option value=\"0\">C/P</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_caract_producto==$row[id_caract_producto])
$caract_producto.="<option value=\"$row[id_caract_producto]\" selected>$row[caract_producto]</option>\n";
else
$caract_producto.="<option value=\"$row[id_caract_producto]\">$row[caract_producto]</option>\n";
} 
$caract_producto.="</select>\n";
return $caract_producto;
}

function crea_caract_envases_filtro($link,$id_caract_envases,$id_producto,$onchange)
{

if(!$onchange){
$caract_envases="<select name=\"id_caract_envases\" class=\"cajas\" style=\"width:150px\">\n";
}else{
$caract_envases="<select name=\"id_caract_envases\" class=\"cajas\" style=\"width:150px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="SELECT * FROM cruce_plant_caract_envases   AS cpce, producto AS pro, caract_envases AS ce WHERE cpce.id_producto =pro.id_producto and cpce.id_producto=$id_producto and cpce.id_caract_envases = ce.id_caract_envases and ce.id_caract_envases  !=0";

$result=mysql_query($sql,$link);
$caract_envases.="<option value=\"0\">C/E</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_caract_envases==$row[id_caract_envases])
$caract_envases.="<option value=\"$row[id_caract_envases]\" selected>$row[caract_envases]</option>\n";
else
$caract_envases.="<option value=\"$row[id_caract_envases]\">$row[caract_envases]</option>\n";
} 
$caract_envases.="</select>\n";
return $caract_envases;
}

function crea_cruce_plant_calibre($link,$id_producto,$id_calibre)
{


$calibre="<select name=\"id_calibre\" class=\"cajas\" style=\"width:150px\">\n";


$sql="SELECT * FROM cruce_plant_calibre AS cpc, producto AS p, calibre AS c WHERE cpc.id_producto=$id_producto and p.id_producto = cpc.id_producto and c.id_calibre = cpc.id_calibre";

$result=mysql_query($sql,$link);
$calibre.="<option value=\"0\">Seleccione Calibre</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_calibre==$row[id_calibre])
$calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre]</option>\n";
else
$calibre.="<option value=\"$row[id_calibre]\">$row[calibre]</option>\n";
} 
$calibre.="</select>\n";
return $calibre;
}



function crea_cruce_plant_medidas_productos ($link,$id_producto,$id_medidas_productos)
{
$medidas_productos="<select name=\"id_medidas_productos\" class=\"cajas\" style=\"width:150px\">\n";


$sql="SELECT * FROM cruce_plant_medidas_productos   AS cpmp, producto AS p, medidas_productos AS mp WHERE cpmp.id_producto=$id_producto and p.id_producto = cpmp.id_producto and mp.id_medidas_productos = cpmp.id_medidas_productos";

$result=mysql_query($sql,$link);
$medidas_productos.="<option value=\"0\">Seleccione Medida</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_medidas_productos==$row[id_medidas_productos])
$medidas_productos.="<option value=\"$row[id_medidas_productos]\" selected>$row[nombre]</option>\n";
else
$medidas_productos.="<option value=\"$row[id_medidas_productos]\">$row[nombre]</option>\n";
} 
$medidas_productos.="</select>\n";
return $medidas_productos;
}

function crea_cruce_plant_unidad_medida ($link,$id_producto,$id_unidad_medida)
{
$unidad_medida="<select name=\"id_unidad_medida\" class=\"cajas\" style=\"width:150px\">\n";


$sql="SELECT * FROM cruce_plant_unidad_medida  AS cpum, producto AS p, unidad_medida AS um WHERE cpum.id_producto=$id_producto and p.id_producto = cpum.id_producto and um.id_unidad_medida = cpum.id_unidad_medida";

$result=mysql_query($sql,$link);
$unidad_medida.="<option value=\"0\">Seleccione Unidad Medida</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_unidad_medida==$row[id_unidad_medida])
$unidad_medida.="<option value=\"$row[id_unidad_medida]\" selected>$row[unidad_medida]</option>\n";
else
$unidad_medida.="<option value=\"$row[id_unidad_medida]\">$row[unidad_medida]</option>\n";
} 
$unidad_medida.="</select>\n";
return $unidad_medida;
}




function crea_etiqueta_idioma($link,$id_etiqueta_idioma,$onchange)// crear funciones de operarios
{

if(!$onchange){
$etiqueta_idioma="<select name=\"id_etiqueta_idioma\" class=\"cajas\" style=\"width:150px\">\n";
}else{
$etiqueta_idioma="<select name=\"id_etiqueta_idioma\" class=\"cajas\" style=\"width:150px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}
//$etiqueta_idioma="<select name=\"id_etiqueta_idioma\" class=\"cajas\" style=\"width:180px\">\n";
$sql="select * from etiquetas_idiomas";
$result=mysql_query($sql,$link);
$etiqueta_idioma.="<option value=\"0\">Etiqueta Idioma</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_etiqueta_idioma==$row[id_etiqueta_idioma])
$etiqueta_idioma.="<option value=\"$row[id_etiqueta_idioma]\" selected>$row[etiqueta_idioma]</option>\n";
else
$etiqueta_idioma.="<option value=\"$row[id_etiqueta_idioma]\">$row[etiqueta_idioma]</option>\n";
} 
$etiqueta_idioma.="</select>\n";
return $etiqueta_idioma;
}

function crea_clienteer($link,$id_cliente,$onchange)// crear funciones de operarios
{

if(!$onchange){
$etiqueta_cliente2="<select name=\"id_cliente\" class=\"cajas\" style=\"width:150px\">\n";
}else{
$etiqueta_cliente2="<select name=\"id_cliente\" class=\"cajas\" style=\"width:150px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}
//$etiqueta_idioma="<select name=\"id_etiqueta_idioma\" class=\"cajas\" style=\"width:180px\">\n";
$sql="SELECT * FROM destinos where id_etiqueta_idioma = $id_cliente ";
$result=mysql_query($sql,$link);
$etiqueta_cliente2.="<option value=\"0\">Seleccione Cliente</option>\n";
while ($row2=mysql_fetch_array($result))
{ 
if ($id_cliente==$row2[id_cliente])
$etiqueta_cliente2.="<option value=\"$row2[id_cliente]\" selected>$row2[destinos]</option>\n";
else
$etiqueta_cliente2.="<option value=\"$row2[id_cliente]\">$row2[destinos]</option>\n";
} 
$etiqueta_cliente2.="</select>\n";
return $etiqueta_cliente2;
}



function crea_cliente($link,$id_destinos,$id_etiqueta_idioma)// funcion crea etapa
{
$destinos="<select name=\"id_destinosotro\" class=\"cajas\" style=\"width:150px\" onChange=\"JavaScript:document.form1.submit();\">\n";
$sql="SELECT * FROM destinos where id_etiqueta_idioma = $id_etiqueta_idioma";
$result=mysql_query($sql,$link);
$destinos.="<option value=\"0\">Seleccione destinos</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_destinos==$row[id_destinos])
$destinos.="<option value=\"$row[id_destinos]\" selected>$row[destinos]</option>\n";
else
$destinos.="<option value=\"$row[id_destinos]\">$row[destinos]</option>\n";
} 
$destinos.="</select>\n";
return $destinos;
}
//******************************************************

function crea_origenes_ok_filtro_new($link,$id_origen,$id_producto,$s,$onchange)
{
$origen="";
if(!$onchange){
$origen="<select name=\"id_origen\" class=\"left-box\" style=\"width:144px\">\n";
}else{
$origen="<select name=\"id_origen\" class=\"left-box\" style=\"width:144px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}
if($s == 'I'){
$sql="select * from origenes AS org, mat_prima_importada AS mpi where org.id_origen = mpi.id_origen and org.id_origen != 0 and mpi.id_producto= '$id_producto' and mpi.id_estado_material != 2 and mpi.id_estado_material != 3 and mpi.id_estado_material != 0 and mpi.id_estado_material != 4 and mpi.id_c_es_so = 0 and mpi.id_solicitud_mp = 0  group by mpi.id_origen order by origen desc";
$result=mysql_query($sql,$link);
$hayorigen=mysql_num_rows($result);
//echo "sql $sql<br>";
}
if($s == 'N'){
$sql="select * from origenes AS org, mat_prima_nacional AS mpn where org.id_origen = mpn.id_origen and org.id_origen != 0 and mpn.id_producto = '$id_producto' and mpn.id_estado_material != 2 and mpn.id_estado_material != 3 and mpn.id_estado_material != 0 and mpn.id_estado_material != 4 and mpn.id_c_es_so = 0 and mpn.id_solicitud_mp = 0 group by mpn.id_origen order by origen desc";

/*$sql="select * from origenes AS org, mat_prima_nacional AS mpn where org.id_origen = mpn.id_origen and org.id_origen != 0 and org.id_procedencia= '$s' and mpn.id_estado_material != 2 and mpn.id_estado_material != 3 and mpn.id_estado_material != 0 and mpn.id_estado_material != 4 and mpn.id_c_es_so = 0 and mpn.id_solicitud_mp = 0 group by mpn.id_origen order by origen desc";*/

$result=mysql_query($sql,$link);
$hayorigen=mysql_num_rows($result);
//echo "sql $sql<br>";
}

$origen.="<option value=\"0\">Origen</option>\n";
//echo "sql $sql<br>";
while ($row=mysql_fetch_array($result))
{ 
if ($id_origen==$row[id_origen])
$origen.="<option value=\"$row[id_origen]\" selected>$row[origen]</option>\n";
else
$origen.="<option value=\"$row[id_origen]\">$row[origen]</option>\n";
} 
$origen.="</select>\n";
return $origen;
}

function crea_producto_ok_filtro_new($link,$s,$id_producto,$onchange)//funcion crea especie
{
if(!$onchange){
$producto="<select name=\"id_producto\" class=\"left-box\" style=\"width:180px\">\n";
}else{
$producto="<select name=\"id_producto\" class=\"left-box\" style=\"width:180px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

if($s == 'I'){
$sql="SELECT * FROM mat_prima_importada AS mpi, producto AS pro WHERE mpi.id_producto = pro.id_producto AND mpi.id_estado_material = 1 group by mpi.id_producto order by pro.producto desc";

//$sql="SELECT * FROM mat_prima_importada AS mpi, producto AS pro WHERE mpi.id_producto = pro.id_producto AND mpi.id_estado_material = 1 and mpi.id_c_es_so = 0 and mpi.id_solicitud_mp = 0 group by mpi.id_producto order by pro.producto desc";

$result=mysql_query($sql,$link);
/*$sql="SELECT * FROM mat_prima_importada AS mpi, producto AS pro WHERE mpi.id_producto = pro.id_producto and mpi.id_origen = $id_origen AND mpi.id_estado_material = 1 and mpi.id_c_es_so = 0 and mpi.id_solicitud_mp = 0 group by mpi.id_producto order by pro.producto desc";
$result=mysql_query($sql,$link);
//echo "sql $sql<br>";*/
}
if($s == 'N'){
/*$sql="SELECT * FROM mat_prima_nacional AS mpn, producto AS pro WHERE mpn.id_producto = pro.id_producto and mpn.id_origen = $id_origen AND mpn.id_estado_material = 1 and mpn.id_c_es_so = 0 and mpn.id_solicitud_mp = 0 group by mpn.id_producto order by pro.producto desc";
$result=mysql_query($sql,$link);
*/
$sql="SELECT * FROM mat_prima_nacional AS mpn, producto AS pro WHERE mpn.id_producto = pro.id_producto AND mpn.id_estado_material = 1  group by mpn.id_producto order by pro.producto desc";
//$sql="SELECT * FROM mat_prima_nacional AS mpn, producto AS pro WHERE mpn.id_producto = pro.id_producto AND mpn.id_estado_material = 1 and mpn.id_c_es_so = 0 and mpn.id_solicitud_mp = 0 group by mpn.id_producto order by pro.producto desc";
$result=mysql_query($sql,$link);

}
$producto.="<option value=\"0\">Productos</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_producto==$row[id_producto])
$producto.="<option value=\"$row[id_producto]\" selected>$row[producto]</option>\n";
else
$producto.="<option value=\"$row[id_producto]\">$row[producto]</option>\n";
} 
$producto.="</select>\n";
return $producto;
}

function crea_origenes_ok($link,$id_origen,$s,$onchange)
{
$origen="";
if(!$onchange){
$origen="<select name=\"id_origen\" class=\"left-box\" style=\"width:200px\">\n";
}else{
$origen="<select name=\"id_origen\" class=\"left-box\" style=\"width:200px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="select * from origenes where id_origen != 0 and id_procedencia= '$s' order by origen desc";
$result=mysql_query($sql,$link);
$origen.="<option value=\"0\">Origen</option>\n";

while ($row=mysql_fetch_array($result))
{ 
if ($id_origen==$row[id_origen])
$origen.="<option value=\"$row[id_origen]\" selected>$row[origen]</option>\n";
else
$origen.="<option value=\"$row[id_origen]\">$row[origen]</option>\n";
} 
$origen.="</select>\n";
return $origen;
}

function crea_bodeganews_muestra($link,$id_bodeganew)//funcion crea producto
{

$bodeganew="<select name=\"id_bodeganew\" style=\"width:100px\" class=\"tex2\">\n";
$sql="select * from bodeganews where id_bodeganew != 0";
$result=mysql_query($sql,$link);
$bodeganew.="<option value=\"0\">Todas Bodegas</option>\n";

while ($row=mysql_fetch_array($result))
{ 
if ($id_bodeganew==$row[id_bodeganew])
$bodeganew.="<option value=\"$row[id_bodeganew]\" selected>$row[bodeganew]</option>\n";
else
$bodeganew.="<option value=\"$row[id_bodeganew]\">$row[bodeganew]</option>\n";
} 
$bodeganew.="</select>\n";
return $bodeganew;
}

/*function crea_producto_especie_codificacion($link,$id_especie,$id_producto,$onchange,$only)//funcion crea especie
{
$producto_especie="";
if(!$onchange){
$producto_especie="<select name=\"id_producto-$id_cruce_tablas\" class=\"cajas\" style=\"width:200px\">\n";
}else{
$producto_especie="<select name=\"id_producto\" class=\"cajas\" style=\"width:160px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="select * from producto AS pro, cruce_plant_especie  AS cpe where pro.id_producto = cpe.id_producto and cpe.id_especie = $id_especie  and pro.id_producto != 0 and pro.id_estado != 2 GROUP BY pro.id_producto";
$result=mysql_query($sql,$link);

if(!$only){
$producto_especie.="<option value=\"0\">Producto</option>\n";
}

while ($row=mysql_fetch_array($result))
{ 

if(!$only){
if ($id_producto==$row[id_producto])
$producto_especie.="<option value=\"$row[id_producto]\" selected>$row[producto]</option>\n";
else
$producto_especie.="<option value=\"$row[id_producto]\">$row[producto]</option>\n";
}else{
if ($id_producto==$row[id_producto])
$producto_especie.="<option value=\"$row[id_producto]\" selected>$row[producto]</option>\n";
}
} 
$producto_especie.="</select>\n";
return $producto_especie;
}*/




function crea_producto_onChange_ok($link,$id_producto,$onchange)//funcion crea especie
{
if(!$onchange){
$producto="<select name=\"id_producto\" class=\"left-box\" style=\"width:200px\">\n";
}else{
$producto="<select name=\"id_producto\" class=\"left-box\" style=\"width:200px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="select * from producto where id_producto != 0 and id_estado = 1 order by producto desc";
$result=mysql_query($sql,$link);
$producto.="<option value=\"0\">Productos</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_producto==$row[id_producto])
$producto.="<option value=\"$row[id_producto]\" selected>$row[producto]</option>\n";
else
$producto.="<option value=\"$row[id_producto]\">$row[producto]</option>\n";
} 
$producto.="</select>\n";
return $producto;
}

function crea_calibre_onChange_ok($link,$id_calibre,$id_producto,$onchange)//funcion crea especie
{
if(!$onchange){
$calibre="<select name=\"id_calibre\" class=\"left-box\" style=\"width:143px\">\n";
}else{
$calibre="<select name=\"id_calibre\" class=\"left-box\" style=\"width:143px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="select * from cruce_plant_calibre AS cpc, calibre c where cpc.id_calibre = c.id_calibre and cpc.id_producto = $id_producto  ";
$result=mysql_query($sql,$link);
$calibre.="<option value=\"0\">Calibre</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_calibre==$row[id_calibre])
$calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre] -$row[id_calibre] </option>\n";
else
$calibre.="<option value=\"$row[id_calibre]\">$row[calibre] -$row[id_calibre]</option>\n";
} 
$calibre.="</select>\n";
return $calibre;
}


function crea_unidad_medida_producto_ok($link,$id_producto)// funcion crea unidad
{

if($id_producto){
//$unidad_medida="<select name=\"id_unidad_medida\" class=\"left-box\" style=\"width:143px\">\n";
$sql="SELECT * FROM unidad_medida AS um, producto AS p WHERE um.id_unidad_medida = p.id_unidad_medida AND p.id_producto = $id_producto";
$result=mysql_query($sql,$link);
$cuantas_unidades=mysql_num_rows($result);
}else{
//$unidad_medida="<select name=\"id_unidad_medida\" class=\"left-box\" style=\"width:143px\">\n";
$sql="SELECT * FROM unidad_medida AS um, producto AS p WHERE um.id_unidad_medida = p.id_unidad_medida AND p.id_producto = $id_producto";
$result=mysql_query($sql,$link);
$cuantas_unidades=mysql_num_rows($result);
	
}


while ($row=mysql_fetch_array($result))
{ 
if ($id_unidad_medida==$row[id_unidad_medida])
$unidad_medida.="<option value=\"$row[id_unidad_medida]\" selected>$row[unidad_medida]</option>\n";
else
$unidad_medida.="<option value=\"$row[id_unidad_medida]\">$row[unidad_medida]</option>\n";
} 
$unidad_medida.="</select>\n";
return $unidad_medida;
}
function crea_producto_calibre_ok($link,$id_producto,$onchange)//funcion crea especie
{
$producto_especie="";
if(!$onchange){
$producto_especie="<select name=\"id_producto-$id_cruce_tablas\" class=\"left-box\" style=\"width:200px\">\n";
}else{
$producto_especie="<select name=\"id_producto\" class=\"left-box\" style=\"width:200px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="select * from producto AS pro, cruce_plant_especie  AS cpe where pro.id_producto = cpe.id_producto  and pro.id_producto != 0 and pro.id_estado != 2 GROUP BY pro.id_producto";
$result=mysql_query($sql,$link);

if(!$only){
$producto_especie.="<option value=\"0\">Producto</option>\n";
}

while ($row=mysql_fetch_array($result))
{ 

if(!$only){
if ($id_producto==$row[id_producto])
$producto_especie.="<option value=\"$row[id_producto]\" selected>$row[producto]</option>\n";
else
$producto_especie.="<option value=\"$row[id_producto]\">$row[producto]</option>\n";
}else{
if ($id_producto==$row[id_producto])
$producto_especie.="<option value=\"$row[id_producto]\" selected>$row[producto]</option>\n";
}
} 
$producto_especie.="</select>\n";
return $producto_especie;
}

function crea_producto_calibre_codificacion_ok($link,$id_producto,$id_calibre,$onchange,$only)//funcion crea especie
{
$producto_calibre="";
if(!$onchange){
$producto_calibre="<select name=\"id_calibre-$id_cruce_tablas\" class=\"cajas\" style=\"width:143px\">\n";
}else{
$producto_calibre="<select name=\"id_calibre\" class=\"cajas\" style=\"width:143px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="SELECT * 
FROM cruce_plant_calibre AS cpc, calibre AS c, producto AS p
WHERE cpc.id_cruce_plant_calibre != 0 and cpc.id_calibre = c.id_calibre and cpc.id_producto = $id_producto and cpc.id_producto = p.id_producto and c.id_calibre != 0 and onoff != 1
";
$result=mysql_query($sql,$link);
if(!$only){
$producto_calibre.="<option value=\"0\">Calibre</option>\n";
}

while ($row=mysql_fetch_array($result))
{ 
if(!$only){
if ($id_calibre==$row[id_calibre])
$producto_calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre]</option>\n";
else
$producto_calibre.="<option value=\"$row[id_calibre]\">$row[calibre]</option>\n";
}else{
if ($id_calibre==$row[id_calibre])
$producto_calibre.="<option value=\"$row[id_calibre]\" selected>$row[calibre]</option>\n";
}
} 
$producto_calibre.="</select>\n";
return $producto_calibre;
}

function crea_producto_onChangeok($link,$id_producto,$onChange)//funcion crea producto
{
$producto="";
if(!$onchange){
$producto="<select name=\"id_producto\" class=\"cajas\" style=\"width:143px\">\n";
}else{
$producto="<select name=\"id_producto\" class=\"cajas\" style=\"width:143px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}
$sql="select * from producto AS pro, cruce_plant_calibre AS cpc where pro.id_producto = cpc.id_producto and pro.id_producto != 0 and pro.id_producto != 88 and pro.id_estado != 2 GROUP BY pro.id_producto";
$result=mysql_query($sql,$link);
$producto.="<option value=\"0\">Seleccione Producto</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_producto==$row[id_producto])
$producto.="<option value=\"$row[id_producto]\" selected>$row[producto]</option>\n";
else
$producto.="<option value=\"$row[id_producto]\">$row[producto]</option>\n";

} 
$producto.="</select>\n";
return $producto;
}

function crea_origenesok($link,$id_origen)
{
$origen="";
$origen="<select name=\"id_origen\" class=\"cajas\" style=\"width:140px\">\n";
$sql="select * from origenes where id_origen != 0 and id_estado != 2 order by origen desc";
$result=mysql_query($sql,$link);
$origen.="<option value=\"0\">Origen</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_origen==$row[id_origen])
$origen.="<option value=\"$row[id_origen]\" selected>$row[origen] - $row[id_origen]</option>\n";
else
$origen.="<option value=\"$row[id_origen]\">$row[origen] - $row[id_origen]</option>\n";
} 
$origen.="</select>\n";
return $origen;
}

function crea_procedencia($link,$id_procedencia,$onchange)// funcion crea Procedencia
{
if(!$onchange){
$procedencia="<select name=\"id_procedencia\" class=\"left-box\" style=\"width:80px\">\n";
}else{
$procedencia="<select name=\"id_procedencia\" class=\"left-box\" style=\"width:80px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}
$sql="select * from procedencia";
$result=mysql_query($sql,$link);
$procedencia.="<option value=\"0\">Procedencia</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_procedencia==$row[id_procedencia])
$procedencia.="<option value=\"$row[id_procedencia]\" selected>$row[procedencia]</option>\n";
else
$procedencia.="<option value=\"$row[id_procedencia]\">$row[procedencia]</option>\n";
} 
$procedencia.="</select>\n";
return $procedencia;
}

function crea_linea_produccion($link,$ldp,$id_ldp,$onchange)// funcion crea Procedencia
{
if(!$onchange){
$ldp="<select name=\"id_ldp\" class=\"cajas\" style=\"width:140px\">\n";
}if($onchange == 1){
$ldp="<select name=\"id_ldp\" onChange=\"JavaScript:document.linea_proceso.submit();\">\n";
}
if($onchange == 2){
$ldp="<select name=\"id_ldp\" onChange=\"JavaScript:document.form1.submit();\">\n";
}
$sql="select * from lineas_de_procesos where id_ldp != 0";
$result=mysql_query($sql,$link);
$ldp.="<option value=\"0\">Selecionar</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_ldp == $row[id_ldp])
$ldp.="<option value=\"$row[id_ldp]\" selected>$row[ldp]</option>\n";
else
$ldp.="<option value=\"$row[id_ldp]\">$row[ldp]</option>\n";
} 
$ldp.="</select>\n";
//return $ldp;
return array ($ldp,$id_ldp);

}
function crea_funcion_operarios($link,$id_funcion_operarios)// crear funciones de operarios
{
$funcion_operarios="<select name=\"id_funcion_operarios\" class=\"cajas\" style=\"width:140px\">\n";
$sql="select * from funcion_operarios";
$result=mysql_query($sql,$link);
$funcion_operarios.="<option value=\"0\">Seleccione Función</option>\n";
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
function crea_estado($link,$id_estado)// funcion crea estado
{
$estado="<select name=\"id_estado\" class=\"cajas\" style=\"width:144px\">\n";
$sql="select * from estado";
$result=mysql_query($sql,$link);
//$estado.="<option value=\"0\">Seleccione Estado</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_estado==$row[id_estado])
$estado.="<option value=\"$row[id_estado]\" selected>$row[estado]</option>\n";
else
$estado.="<option value=\"$row[id_estado]\">$row[estado]</option>\n";
} 
$estado.="</select>\n";
return $estado;
}

function crea_cambio_estado_ok($link,$id_ce,$onchange)//funcion crea especie
{
if(!$onchange){
$cambio_estado ="<select name=\"id_ce\" class=\"left-box\" style=\"width:143px\">\n";
}else{
$cambio_estado ="<select name=\"id_ce\" class=\"left-box\" style=\"width:143px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}

$sql="select * from cambio_estado";
$result=mysql_query($sql,$link);
$cambio_estado.="<option value=\"0\">Cambio Estado</option>\n";
while ($row=mysql_fetch_array($result))
{ 
if ($id_ce==$row[id_ce])
$cambio_estado.="<option value=\"$row[id_ce]\" selected>$row[cambio_estado]</option>\n";
else
$cambio_estado.="<option value=\"$row[id_ce]\">$row[cambio_estado]</option>\n";
} 
$cambio_estado.="</select>\n";
return $cambio_estado;
}

function crea_disponibilidad($link,$id_estdis,$id)// funcion crea Procedencia
{
/*if(!$onchange){
$estdis="<select name=\"id_estdis\" style=\"width:60px\">\n";
}else{
$estdis="<select name=\"id_estdis\" style=\"width:60px\" onChange=\"JavaScript:document.form1.submit();\">\n";
}*/

$estdis="<select name=\"id_estdis-$id\" style=\"width:60px\">\n";
$sql="select * from est_disponib order by id_estdis asc";
$result=mysql_query($sql,$link);
while ($row=mysql_fetch_array($result))
{ 
if ($id_estdis==$row[id_estdis])
$estdis.="<option value=\"$row[id_estdis]\"selected>$row[estdis]</option>\n";
else
$estdis.="<option value=\"$row[id_estdis]\">$row[estdis]</option>\n";
} 
$estdis.="</select>\n";
return $estdis;
}



?>