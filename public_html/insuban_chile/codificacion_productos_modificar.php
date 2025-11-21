<?

if($modificar){
//echo "modificar";
$sql_modificar="UPDATE  cruce_tablas set id_especie=$id_especie,id_producto=$id_producto,id_calibre=$id_calibre,id_unidad_medida=$id_unidad_medida,id_medidas_productos=$id_medidas_productos,id_caract_producto=$id_caract_producto,id_caract_envases=$id_caract_envases where id_cruce_tablas=$id_cruce_tablas";
$rest=mysql_query($sql_modificar);
//echo "$sql_modificar ";
}

$sql="SELECT * FROM cruce_tablas AS ct, producto AS pro, especie AS esp, calibre AS c, unidad_medida AS um, medidas_productos AS mp, caract_producto AS carac_pro, caract_envases AS carac_env where ct.id_producto = pro.id_producto and ct.id_calibre = c.id_calibre and ct.id_unidad_medida = um.id_unidad_medida and ct.id_medidas_productos = mp.id_medidas_productos and ct.id_caract_producto = carac_pro.id_caract_producto and ct.id_caract_envases = carac_env.id_caract_envases and ct.id_especie = esp.id_especie and ct.id_cruce_tablas = $id_cruce_tablas ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

//echo "Cuantos $cuantos";


?>

<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
-->
</style>

<form id="form1" name="form1" method="post" action="">
<?
while ($row=mysql_fetch_array($result))
    { 

?>
<table width="716" border="0" align="center">
  <tr>
    <td width="710" height="30" class="titulo">Codificaci&oacute;n de Productos       </td>
  </tr>
  <tr>
    <td><table width="710" height="73" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="45" height="23" nowrap="nowrap"><span class="titulo">ID</span></td>
          <td width="45" height="23" nowrap="nowrap" class="titulo">Especie</td>
          <td width="109" nowrap="nowrap" class="titulo">Producto</td>
          <td width="110" nowrap="nowrap" class="titulo">Calibre</td>
          <td width="107" nowrap="nowrap" class="titulo">Unidad Medida </td>
          <td width="96" nowrap="nowrap" class="titulo">Medida</td>
          <td width="91" nowrap="nowrap" class="titulo">Caract. Producto </td>
          <td width="55" nowrap="nowrap" class="titulo">Caract. Envases </td>
          </tr>
		 <tr>
          <td width="45" height="21" nowrap="nowrap"><span class="cajas">
            <?  echo $id_cruce_tablas;?>
          </span></td>
          <td nowrap="nowrap">
		  <? 
		  $especie= crea_especie_codificacion($link,$id_especie,1,0);
		  echo $especie;
		  ?></td>
          <td width="109" nowrap="nowrap"><? 
		  //if($id_especie){
		  $producto_especie= crea_producto_especie_codificacion($link,$id_especie,$id_producto,1,0);
		  echo $producto_especie;
		  //}
		  ?></td>
          <td width="110" nowrap="nowrap">
		  <? 
		  //if($id_producto){
		  $producto_calibre= crea_producto_calibre_codificacion($link,$id_producto,$id_calibre,1,0);
		  echo $producto_calibre;
		 //}
		  ?>		  </td>
          <td width="107" nowrap="nowrap">
		  <?
		 // if($id_calibre){
		  $producto_unidad_medida= crea_producto_unidad_medida_codificacion($link,$id_producto,$id_unidad_medida,1,0);
		  echo $producto_unidad_medida;
		 // }
		  ?>		  </td>
          <td width="96" nowrap="nowrap">
		  <? 
		  //if($id_unidad_medida){
		  $producto_medida= crea_producto_medida_codificacion($link,$id_producto,$id_medidas_productos,1,0);
		  echo $producto_medida;
		  //}
		  ?>		  </td>
          <td width="91" nowrap="nowrap">
		  <? 
		 // if($id_medidas_productos){
		  $producto_caract_producto= crea_producto_caract_codificacion($link,$id_producto,$id_caract_producto,1,0);
		  echo $producto_caract_producto;
		  //}
		  ?>		  </td>
          <td width="55" nowrap="nowrap">
		  <? 
		  //if($id_caract_producto){
		  $producto_caract_producto= crea_producto_caract_envases($link,$id_producto,$id_caract_envases,1,0);
		  echo $producto_caract_producto;
		 // }
		  ?>		  </td>
          </tr>
      </table>	  </td>
  </tr>
  <tr>
    <td>
	<? if($permiso25 == 1){?>
	<div align="center">
      <input name="modificar" type="submit" id="modificar" value="Modificar" />
    </div>
	<? }?>
	
	</td>
  </tr>
</table>
<? }?>
</form>