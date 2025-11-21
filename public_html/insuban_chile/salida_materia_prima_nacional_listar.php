<?



if ($modificar_x and $id_estado_material_cambio) {

 if($id_estado_material_cambio == 2){
  $fecha=date("Y-m-d");
  //echo "$fecha";
  }
 if($fecha_despacho){
  $dat=split(" ",$fecha_despacho);
  $dat=split("-",$dat[0]);
  $fecha="$dat[2]-$dat[1]-$dat[0]";
 } 

 if($id_estado_material_cambio != 2 and $fecha_despacho ==''){
  $fecha='00-00-0000';
  }


 if ($idmpn and $fecha_despacho and $id_estado_material_cambio == 2)  
  foreach ($idmpn as $key)
 {
  $sql="update mat_prima_nacional set id_estado_material=$id_estado_material_cambio,fecha_salida='$fecha' where id_mat_prima_nacional = $key";
  //echo "SQL $sql<br>";
  $res=mysql_query($sql);
 }

}

	
	if($id_estado_material){	
	$sql="SELECT * FROM mat_prima_nacional AS mpn, estado_material AS em, producto AS p, origenes AS orig where mpn.id_estado_material=$id_estado_material and mpn.id_estado_material = em.id_estado_material and mpn.id_producto = p.id_producto and mpn.id_mat_prima_nacional != 0 and mpn.id_origen = orig.id_origen 
";

	if($id_producto){
$sql.= " and p.id_producto = '$id_producto'";

}

$sql.= " order by mpn.id_mat_prima_nacional desc";

	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
	//echo "Cuantos1 $cuantos";
	}
	
		if($id_estado_material and $entreano1){	
	$sql="SELECT * FROM mat_prima_nacional AS mpn, estado_material AS em, producto AS p, origenes AS orig where mpn.id_estado_material=$id_estado_material and mpn.id_estado_material = em.id_estado_material and mpn.id_producto = p.id_producto and mpn.id_mat_prima_nacional != 0 and mpn.id_origen = orig.id_origen and mpn.ano between '$entreano1' and '$entreano2' ";
	
	if($id_producto){
$sql.= " and p.id_producto = '$id_producto'";

}

$sql.= " order by mpn.id_mat_prima_nacional desc";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
	//echo "Cuantos1 $cuantos";
	}
	
	if(!$id_estado_material){
$sql="SELECT * FROM mat_prima_nacional AS mpn, estado_material AS em, producto AS p, origenes AS orig where mpn.id_estado_material=1 and mpn.id_estado_material = em.id_estado_material and mpn.id_producto = p.id_producto and mpn.id_mat_prima_nacional != 0 and mpn.id_origen = orig.id_origen ";

	if($id_producto){
$sql.= " and p.id_producto = '$id_producto'";

}

$sql.= " order by mpn.id_mat_prima_nacional desc";

	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
	//echo "Cuantos2 $cuantos";
	}
	if($dato){
	
	$largo=strlen($dato);
	 $newano=substr($dato, 0, 2);
	 $newano="20".$newano;
	 $dato=substr($dato, 0, $largo);
	
	$sql="SELECT * FROM mat_prima_nacional AS mpn, estado_material As em,  producto AS p, origenes AS orig where mpn.id_estado_material = em.id_estado_material and mpn.id_producto = p.id_producto and mpn.id_mat_prima_nacional != 0 and mpn.id_origen = orig.id_origen and mpn.id_mat_prima_nacional = '$dato'";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
	//echo "Cuantos3 $cuantos";
	}
	
	




?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<script language="JavaScript"> 
function seleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=0 
} 
</script>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<form id="form1" name="form1" method="post" action="">
<table width="891" height="199" border="0" align="center">
  <tr>
    <td width="606" height="11" valign="top"><span class="titulo">Listar Salida Materia Prima Nacional </span></td>
    <td width="275" valign="middle" class="cajas"><div align="right"><a href="?modulo=salida_materia_prima_nacional.php&op=<? echo $op?>">Volver</a></div></td>
  </tr>
  <tr>
    <td height="13" valign="top">&nbsp;</td>
    <td valign="middle" class="cajas">&nbsp;</td>
  </tr>
  <tr> 
    <td height="1" colspan="2" valign="top"><table width="100%" border="0" align="center">
      <tr>
        <td width="149" bgcolor="#CCCCCC"><span class="cajas"><span class="titulo">A&Ntilde;O</span></span><span class="cajas">
		
     	 <?   if(!$entreano1){
					$entreano1=$fhoy=date("Y");
					$entreano1=$entreano1-1;
					}
					if(!$entreano2){
					$entreano2=$fhoy=date("Y");
					}
		  ?>
     	 <input name="entreano1" type="text" class="cajas" id="entreano1" value="<? echo $entreano1 ?>" size="4" maxlength="4" />
         <input name="entreano2" type="text" class="cajas" id="entreano2" value="<? echo $entreano2 ?>" size="4" maxlength="4" />
        </span></td>
        <td width="170" bgcolor="#CCCCCC"><span class="cajas"><span class="titulo">ESTADO</span></span><span class="cajas">
          <? 
	$estado_material= crea_estado_material_select($link,$id_estado_material);
	echo $estado_material;
	?>
        </span></td>
        <td width="122" bgcolor="#CCCCCC"><? $producto= crea_producto_onchange2($link,$id_producto);
		 echo $producto;?></td>
        <td width="220" bgcolor="#CCCCCC"><span class="cajas"><span class="titulo">FOLIO</span></span><span class="cajas">
          <input name="dato" type="text" class="cajas" size="8" maxlength="10"/>
          <input name="buscar" type="submit" class="cajas" value="Buscar" />
        </span></td>
        <td width="202" bgcolor="#CCCCCC">
      <span class="titulo">F. Despacho</span>
      <input name="fecha_despacho" type="text" class="cajas"   id="fecha_despacho"  value="<?echo $fecha_despacho?>" size="10" maxlength="10" />
      <a href="javascript:show_Calendario('form1.fecha_despacho');" class="cajas"  >Ver </a></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td height="0" colspan="2" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="-1" valign="top"><? if($buscar and $cuantos){?><span class="numero"><? echo " Cantidad $cuantos";?></span><? }?></td>
    <td height="-1" valign="top"><? if($buscar and $cuantos){?><div align="right"><span class="numero"><span class="titulo"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></span></span></div><? }?></td>
  </tr>
  <tr>
    <td height="62" colspan="2" valign="top">
	<? if($buscar and $cuantos){?>
	<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="76" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;Folio MPN</td>
        <td width="131" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto</td>
        <td width="55" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm; Bidon </td>
        <td width="121" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;Origen</td>
        <td width="82" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm; Comprob. </td>
        <td width="69" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;F. Ingreso </td>
        <td width="58" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;F. Faena </td>
        <td width="84" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;Est. Material </td>
        <td width="75" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;Contenido </td>
        <td width="85" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><select name="id_estado_material_cambio" class="cajas">
          <option value="0">Estado</option>
          <option value="1">Bodega</option>
          <option value="2">Despacho</option>
          <option value="3">Anulado</option>
        </select>        </td>
      </tr>
   <?
	
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
	$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);
	$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$contenido=$row[contenido];
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
	$i++;
	?>
      <tr>
        <td bgcolor="<? echo $color?>" height="22" nowrap="nowrap" class="cajas"><div align="center"><? //echo substr($row[ano],2,4);?><? echo $row[id_mat_prima_nacional];?></div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas">&nbsp;
		<a href="?modulo=salida_materia_prima_nacional.php&id_mat=<?echo $row[id_mat_prima_nacional]?>"><?echo $row[producto]?></a></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center">&nbsp;<a href="?modulo=salida_materia_prima_nacional.php&amp;id_mat=<?echo $row[id_mat_prima_nacional]?>"><?echo $row[bidon_num]?></a></div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=salida_materia_prima_nacional.php&amp;id_mat=<?echo $row[id_mat_prima_nacional]?>"><?echo $row[origen]?></a></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center">&nbsp;<a href="?modulo=salida_materia_prima_nacional.php&id_mat=<?echo $row[id_mat_prima_nacional]?>"><?echo $row[comprobante_num]?></a></div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center">&nbsp;<a href="?modulo=salida_materia_prima_nacional.php&amp;id_mat=<?echo $row[id_mat_prima_nacional]?>"><? echo $fecha_ingreso?></a></div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center">&nbsp;<a href="?modulo=salida_materia_prima_nacional.php&id_mat=<?echo $row[id_mat_prima_nacional]?>"><? echo $fecha_faena?></a></div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center"><a href="?modulo=salida_materia_prima_nacional.php&id_mat=<?echo $row[id_mat_prima_nacional]?>"><? echo $row[estado_material]?></a>&nbsp;</div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center">&nbsp;<? echo $contenido?></div></td>
        <td bgcolor="<? echo $color?>"nowrap="nowrap" class="cajas"><div align="center">
          <input name="idmpn[]" type="checkbox" class="cajas" id="idmpn[]" value="<?echo  $idmpn=$row[id_mat_prima_nacional];?>" />
     </div></td>
      </tr>
      <? }?>
    </table>
	<? }?></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
	<? if($buscar and $cuantos){?>
	<center>
	 <a href="javascript: document.form1.submit();">
		 <label>
		 <input type="image" name="modificar" src="jpg/modificar.jpg" />
		</label>
          </a>
		</center>
		<? }?>
		</td>
  </tr>
</table>
</form>