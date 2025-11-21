<?

if($id_caract_envases)
{

$sql_cruce="SELECT * 
FROM cruce_tablas WHERE id_especie = $id_especie
AND id_producto = $id_producto
AND id_calibre = $id_calibre
AND id_unidad_medida = $id_unidad_medida
AND id_medidas_productos = $id_medidas_productos
AND id_caract_producto = $id_caract_producto
AND id_caract_envases = $id_caract_envases
";	  
	  
$result_cruce=mysql_query($sql_cruce);
$cuantos_cruce=mysql_num_rows($result_cruce);


//echo "cuantos $cuantos_cruce";


}
  if($grabar and $cuantos_cruce == 0)
{

//foreach ($_POST as $key => $value)
//{
 //$dat=split("-",$key); 
 //echo "key $key , Value $value <br>"; 
  //if ($dat[0 == 'id_medidas_productos')
	//{
   // $id=$dat[1;
   //	$id_medidas_productos=$_POST["id_medidas_productos-$id";
	$sql="insert cruce_tablas (id_especie,id_producto,id_calibre,id_unidad_medida,id_medidas_productos,id_caract_producto,id_caract_envases) values ($id_especie,$id_producto,$id_calibre,$id_unidad_medida,$id_medidas_productos,$id_caract_producto,$id_caract_envases)";
	$result=mysql_query($sql,$link);
	$id=mysql_insert_id();
	//echo "SQL AGREGAR $sql";
	//}
  
//}echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=producto_medidas_productos.php\">";
 //exit;
}
?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style3 {color: #FF0000}
.style4 {font-size: 14px}
-->
</style>

<form id="form1" name="form1" method="post" action="">
<table width="554" border="0" align="center">
  <tr>
    <td width="548" height="30" class="titulo">Codificaci&oacute;n de Productos       </td>
  </tr>
  <tr>
    <td><table width="548" height="75" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="43" height="23" nowrap="nowrap" class="titulo">Especie</td>
          <td width="90" nowrap="nowrap" class="titulo">Producto</td>
          <td width="45" nowrap="nowrap" class="titulo">Calibre</td>
          <td width="86" nowrap="nowrap" class="titulo">Unidad Medida </td>
          <td width="43" nowrap="nowrap" class="titulo">Medida</td>
          <td width="100" nowrap="nowrap" class="titulo">Caract. Producto </td>
          <td width="95" nowrap="nowrap" class="titulo">Caract. Envases </td>
          </tr>
        <tr>
          <td height="21" nowrap="nowrap">
		  <? 
		  $especie= crea_especie_codificacion($link,$id_especie,1,0);
		  echo $especie;
		  ?></td>
          <td width="90" nowrap="nowrap">
		  <? 
		  if($id_especie){
		  $producto_especie= crea_producto_especie_codificacion($link,$id_especie,$id_producto,1,0);
		  echo $producto_especie;
		  }
		  ?>		  </td>
          <td width="45" nowrap="nowrap">
		  <? 
		  if($id_producto){
		  $producto_calibre= crea_producto_calibre_codificacion($link,$id_producto,$id_calibre,1,0);
		  echo $producto_calibre;
		  }
		  ?>		  </td>
          <td width="86" nowrap="nowrap">
		  <?
		  if($id_calibre){
		  $producto_unidad_medida= crea_producto_unidad_medida_codificacion($link,$id_producto,$id_unidad_medida,1,0);
		  echo $producto_unidad_medida;
		  }
		  ?>		  </td>
          <td width="43" nowrap="nowrap">
		  <? 
		  if($id_unidad_medida){
		  $producto_medida= crea_producto_medida_codificacion($link,$id_producto,$id_medidas_productos,1,0);
		  echo $producto_medida;
		  }
		  ?>		  </td>
          <td width="100" nowrap="nowrap">
		  <? 
		  if($id_medidas_productos){
		  $producto_caract_producto= crea_producto_caract_codificacion($link,$id_producto,$id_caract_producto,1,0);
		  echo $producto_caract_producto;
		  }
		  ?>		  </td>
          <td width="95" nowrap="nowrap">
		  <? 
		  if($id_caract_producto){
		  $producto_caract_producto= crea_producto_caract_envases($link,$id_producto,$id_caract_envases,1,0);
		  echo $producto_caract_producto;
		  }
		  ?>		  </td>
          </tr>
        <tr>
          <td height="21" colspan="7" nowrap="nowrap" class="titulo style3">
		    <div align="center" class="style4">
		      <?
			  if($cuantos_cruce != 0){
		  		?>
		      El Producto ya Existe en la Base de Datos !!!
		      <? }else{?>		  
              
              Codigo creado: <? echo $id;?>
              
              <? }?>
	          </div></td>
          </tr>
      </table>	  </td>
  </tr>
  <tr>
    <td>
	<? if($permiso24 == 1){?>
	<?  if($cuantos_cruce == 0){?>
	<div align="center">
      <input name="grabar" type="submit" id="grabar" value="Guardar" />
    </div>
	<?
	}
	 }?>
	</td>
  </tr>
</table>
</form>