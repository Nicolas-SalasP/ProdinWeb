<?

//if($eliminar){
//$sql="delete from cruce_tablas where  id_cruce_tablas = $id_cruce_tablas";
//$res=mysql_query($sql);
//}

if($eliminar and $id_cruce_tablas) {
 foreach ($id_cruce_tablas as $key)
 {
$sql="delete from cruce_tablas where  id_cruce_tablas = $key";
 $res=mysql_query($sql);
  }
}//if($eliminar) {

if($modificar){
 foreach ($HTTP_POST_VARS as $key => $value)
               {
                $dat=split("-",$key);
                if ($dat[0] == 'valor_indice')
                  {
                   $id=$dat[1];
                   $valor_indice=$HTTP_POST_VARS["valor_indice-$id"];
				   $id_tipo_calculo=$HTTP_POST_VARS["id_tipo_calculo-$id"];
                   $sql="UPDATE cruce_tablas  SET  valor_indice ='$valor_indice', id_tipo_calculo ='$id_tipo_calculo' where id_cruce_tablas = $id";
                   $rest=mysql_query($sql);
    			  // echo "sql $sql<br>";
                  }
				  }
}//if($modificar){


//$sql="SELECT * FROM cruce_tablas AS ct, producto AS p, especie AS esp, calibre AS c, unidad_medida AS um, medidas_productos AS mp, caract_producto AS carac_pro, caract_envases AS carac_env where  ct.id_producto = p.id_producto and  ct.id_calibre = c.id_calibre and ct.id_unidad_medida = um.id_unidad_medida and ct.id_medidas_productos = mp.id_medidas_productos and  ct.id_caract_producto = carac_pro.id_caract_producto and ct.id_caract_envases = carac_env.id_caract_envases and ct.id_especie = esp.id_especie and ct.id_cruce_tablas != 0 order by esp.especie, p.producto,c.calibre, um.unidad_medida, mp.medidas_productos
	  //";
$sql="SELECT * 
FROM cruce_tablas AS ct, especie AS esp, producto AS p, calibre AS c, unidad_medida AS um, medidas_productos AS mps, caract_producto AS caractp, caract_envases AS caracte, cruce_plant_especie AS cpe
WHERE ct.id_especie = esp.id_especie
AND esp.id_especie = ct.id_especie
AND ct.id_producto = cpe.id_producto
AND p.id_producto = ct.id_producto
AND ct.id_calibre = c.id_calibre
AND c.id_calibre = ct.id_calibre
AND ct.id_unidad_medida = um.id_unidad_medida
AND um.id_unidad_medida = ct.id_unidad_medida
AND ct.id_medidas_productos = mps.id_medidas_productos
AND mps.id_medidas_productos = ct.id_medidas_productos
AND ct.id_caract_producto = caractp.id_caract_producto
AND caractp.id_caract_producto = ct.id_caract_producto
AND ct.id_caract_envases = caracte.id_caract_envases
AND caracte.id_caract_envases = ct.id_caract_envases and ct.id_cruce_tablas != 0 order by esp.especie, p.producto,um.unidad_medida, mps.medidas_productos,c.calibre asc ";	  
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);


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
<table width="1010" border="0" align="center">
  <tr>
    <td width="1004" height="30" class="titulo">Indice de Productos Terminados  [Cantidad: <? echo $cuantos?>]</td>
  </tr>
  <tr>
    <td>
	
	<table width="100%" height="65" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#999999">
	
        <tr>
          <td height="24" bgcolor="#CCCCCC" class="titulo">&nbsp;ID</td>
<!--          <td bgcolor="#CCCCCC" class="titulo">Valor Indice</td>
          <td bgcolor="#CCCCCC" class="titulo">&nbsp;</td> -->
          <td bgcolor="#CCCCCC" class="titulo">&nbsp;Especie&nbsp;</td>
          <td bgcolor="#CCCCCC" class="titulo">&nbsp;Producto&nbsp;</td>
          <td bgcolor="#CCCCCC" class="titulo">&nbsp;Calibre&nbsp;</td>
          <td bgcolor="#CCCCCC" class="titulo">&nbsp;Unid./Med.&nbsp;</td>
          <td bgcolor="#CCCCCC" class="titulo">&nbsp;Medida&nbsp;</td>
          <td bgcolor="#CCCCCC" class="titulo">&nbsp;Caract/Producto&nbsp;</td>
          <td bgcolor="#CCCCCC" class="titulo">&nbsp;Caract/Envase&nbsp;</td>
          <td bgcolor="#CCCCCC" class="titulo">MP</td>
          <td bgcolor="#CCCCCC" class="titulo">MO</td>
          <td bgcolor="#CCCCCC" class="titulo">INS</td>
          <td bgcolor="#CCCCCC" class="titulo">COSTO U</td>
          <td bgcolor="#CCCCCC" class="titulo">&nbsp;</td>

         
        </tr>
		<?
	while ($row=mysql_fetch_array($result))
    { 
	$id_tipo_calculo=$row[id_tipo_calculo]; //division o multiplicacion
	
	$id_cruce_tablas=$row[id_cruce_tablas];
	$id_cruce_tablas2=$row[id_cruce_tablas];
	$id_especie=$row[id_especie];
	$id_especie2=$row[id_especie];
	$id_especiecontar=strlen($id_especie);

	$id_producto=$row[id_producto];
	$id_producto2=$row[id_producto];
	$id_productocontar=strlen($id_producto);

	$id_calibre=$row[id_calibre];
	$id_calibre2=$row[id_calibre];
	$id_calibrecontar=strlen($id_calibre);

	$id_unidad_medida=$row[id_unidad_medida];
	$id_unidad_medida2=$row[id_unidad_medida];
	$id_unidad_medidacontar=strlen($id_unidad_medida);

	$id_medidas_productos=$row[id_medidas_productos];
	$id_medidas_productos2=$row[id_medidas_productos];
	$id_medidas_productoscontar=strlen($id_medidas_productos);

	$id_caract_producto=$row[id_caract_producto];
	$id_caract_producto2=$row[id_caract_producto];
	$id_caract_productocontar=strlen($id_caract_producto);

	$id_caract_envases=$row[id_caract_envases];
	$id_caract_envases2=$row[id_caract_envases];
	$id_caract_envasescontar=strlen($id_caract_envases);
	
	if($id_especiecontar == 1)
	   $id_especie="00$id_especie";
	if($id_especiecontar == 2)
	   $id_especie="0$id_especie";
	if($id_especiecontar == 3)
	   $id_especie="$id_especie";
	
	if($id_productocontar == 1)
	   $id_producto="00$id_producto";
	if($id_productocontar == 2)
	   $id_producto="0$id_producto";
	if($id_productocontar == 3)
	   $id_producto="$id_producto";
	   
	if($id_calibrecontar == 1)
	   $id_calibre="00$id_calibre";
	if($id_calibrecontar == 2)
	   $id_calibre="0$id_calibre";
	if($id_calibrecontar == 3)
	   $id_calibre="$id_calibre";
	   
	if($id_unidad_medidacontar == 1)
	   $id_unidad_medida="00$id_unidad_medida";
	if($id_unidad_medidacontar == 2)
	   $id_unidad_medida="0$id_unidad_medida";
	if($id_unidad_medidacontar == 3)
	   $id_unidad_medida="$id_unidad_medida";
	
	
	if($id_medidas_productoscontar == 1)
	   $id_medidas_productos="00$id_medidas_productos";
	if($id_medidas_productoscontar == 2)
	   $id_medidas_productos="0$id_medidas_productos";
	if($id_medidas_productoscontar == 3)
	   $id_medidas_productos="$id_medidas_productos";
	
	
	if($id_caract_productocontar == 1)
	   $id_caract_producto="00$id_caract_producto";
	if($id_caract_productocontar == 2)
	   $id_caract_producto="0$id_caract_producto";
	if($id_caract_productocontar == 3)
	   $id_caract_producto="$id_caract_producto";
	   
	 	if($id_caract_envasescontar == 1)
	   $id_caract_envases="00$id_caract_envases";
	if($id_caract_envasescontar == 2)
	   $id_caract_envases="0$id_caract_envases";
	if($id_caract_envasescontar == 3)
	   $id_caract_envases="$id_caract_envases";
	
	//echo "$id_especiecontar - $id_productocontar -  $id_calibrecontar - $id_calibrecontar - $id_unidad_medidacontar -  $id_medidas_productoscontar -  $id_caract_productocontar -  $id_caract_envasescontar";
	$codigo= $id_especie.$id_producto.$id_calibre.$id_unidad_medida.$id_medidas_productos.$id_caract_producto.$id_caract_envases;
	
	//$extractoid_especie = substr($codigo,0,3);
	//$extractoid_producto = substr($codigo,3,3);
	//$extractoid_calibre = substr($codigo,6,3);
	//$extractoid_unidad_medida = substr($codigo,9,3);
	
	//$extractoid_medidas_productos = substr($codigo,12,3);
	//$extractoid_caract_producto = substr($codigo,15,3);
	//$extractoid_caract_envases = substr($codigo,18,3);
	//echo "id_especie $extractoid_especie / id_producto $extractoid_producto / id_calibre $extractoid_calibre / id_unidad_medida $extractoid_unidad_medida / id_medidas_productos $extractoid_medidas_productos / id_caract_producto $extractoid_caract_producto / id_caract_envases $extractoid_caract_envases";




	?>
        <tr>
          <td width="24" height="22" nowrap="nowrap" class="cajas">&nbsp;<?  echo $id_cruce_tablas2; ?></td>
<!--          <td width="76" height="22" nowrap="nowrap" class="cajas">
         <input name="valor_indice-<?echo $id_cruce_tablas?>" type="text" class="cajas" id="valor_indice" value="<? echo $row[valor_indice]?>" size="10" maxlength="15" />
          </td>
          <td width="75" nowrap="nowrap" class="cajas">
            <?
          	$tipo_calculo= crea_tipo_calculo($link,$row[id_tipo_calculo],$id_cruce_tablas);
			echo "$tipo_calculo";
		  ?>
          </td> -->
          <td width="61" nowrap="nowrap" class="cajas">&nbsp;<? echo $row[especie]?></td>
          <td width="142" nowrap="nowrap" class="cajas"><? echo $row[producto]?></td>
          <td width="50" nowrap="nowrap" class="cajas">&nbsp;<? echo $row[calibre] ?></td>
          <td width="70" nowrap="nowrap" class="cajas">&nbsp;<? echo $row[unidad_medida] ?></td>
          <td width="58" nowrap="nowrap" class="cajas">&nbsp;<? echo $row[medidas_productos] ?></td>
          <td width="108" nowrap="nowrap" class="cajas">&nbsp;<? echo $row[caract_producto] ?></td>
          <td width="91" nowrap="nowrap" class="cajas">&nbsp;<? echo $row[caract_envases]?></td>
          <td width="34" nowrap="nowrap" class="cajas">&nbsp;<? echo $row[mat_prima]?></td>
          <td width="18" nowrap="nowrap" class="cajas">&nbsp;<? echo $row[mano_obra]?></td>
          <td width="21" nowrap="nowrap" class="cajas">&nbsp;<? echo $row[insumos]?></td>
          <td width="45" nowrap="nowrap" class="cajas">&nbsp;<? echo $row[costounidad]?></td>
          <td width="43" nowrap="nowrap" class="cajas">
            <a href="?modulo=costos_generales.php&id_cruce_tablas=<?echo $id_cruce_tablas?>">ingresar</a>
            <? }?></td>
         
        </tr>
		  <? 
	  //}
	  ?>
      </table>	  
<!--	<div align="center">
	  <input name="modificar" type="submit" id="modificar" value="Modificar" />
	  </div> --> </td>
  </tr>
</table>
</form>