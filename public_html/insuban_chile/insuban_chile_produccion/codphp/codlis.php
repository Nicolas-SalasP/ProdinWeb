<?
require "../sconre.php";

//echo "id_s $id_s - id_origen $id_origen - id_producto $id_producto - salada $salada";

if($asignarcod and $id_s){
		    		 
foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
 if ($dat[0] == 'id_cruce')
 {
  $id=$dat[1];
  $id_cruce=$_POST["id_cruce-$id"];  
  $sqlupdate="UPDATE mat_prima_importada set cruce_tablas_id = '$id_cruce' where id_mat_prima_importada  = $id_s";
  $resultupdate=mysql_query($sqlupdate);   
  }
}//foreach ($_POST as $key => $value)
?>

  <script languaje="javascript">
window.opener.document.location.replace('<? echo $url;?>sistema.php?modulo=fmpsalada.php&amp;id_mat_prima_importada=<? echo $id_s?>&id_origen=<? echo $id_origen?>&id_producto=<? echo $id_producto?>&amp;salada=<? echo "I";?>');
</script>



<script language="javascript">
window.close();
</script>
 

<?
}
if($asignarcod and $id_spt){
		    		 
foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
 if ($dat[0] == 'id_cruce')
 {
  $id=$dat[1];
  $id_cruce=$_POST["id_cruce-$id"];  
  
  	if($id_cruce)
				{
				//echo "toy dentro";
				$sqlb="SELECT  * from cruce_tablas where id_cruce_tablas = $id_cruce";
			    $resulbt=mysql_query($sqlb);
				$cuantosb=mysql_num_rows($resulbt);
				if($cuantosb){
					if ($rowb=mysql_fetch_array($resulbt))
					{ 
					$id_cruce_tablasb=$rowb[id_cruce_tablas];
					$id_especieb=$rowb[id_especie];
					$id_productob=$rowb[id_producto];
					$id_calibreb=$rowb[id_calibre];
					$id_unidad_medidab=$rowb[id_unidad_medida];
					$id_medidas_productosb=$rowb[id_medidas_productos];
					$id_caract_productob=$rowb[id_caract_producto];
					$id_caract_envasesb=$rowb[id_caract_envases];
					}
				}
				}
  
  
  
  $sqlupdate="UPDATE etiquetados_folios set id_cruce_tablas = '$id_cruce_tablasb', id_especie ='$id_especieb', id_producto ='$id_productob', id_calibre = '$id_calibreb' , id_unidad_medida = '$id_unidad_medidab', id_medidas_productos = '$id_medidas_productosb', id_caract_producto = '$id_caract_productob', id_caract_envases = '$id_caract_envasesb'  where id_etiquetados_folios  = $id_spt";
  $resultupdate=mysql_query($sqlupdate);   
  }
}//foreach ($_POST as $key => $value)
?>
  <script languaje="javascript">
window.opener.document.location.replace('<? echo $url;?>sistema.php?modulo=ingresarpt.php&amp;id_etiquetados_folios=<? echo $id_spt?>');
</script>



<script language="javascript">
window.close();
</script>
<? }

	


$sql="SELECT ct.id_cruce_tablas AS id_cruce_tablas, esp.especie AS especie, pro.producto AS producto, c.calibre AS calibre, um.unidad_medida AS unidad_medida, mp.medidas_productos AS medidas_productos, cp.caract_producto AS caract_producto, ce.caract_envases AS caract_envases   FROM cruce_tablas AS ct, especie AS esp, producto AS pro, calibre AS c, unidad_medida AS um, medidas_productos AS mp, caract_producto AS cp, caract_envases AS ce WHERE ct.id_especie = esp.id_especie AND ct.id_producto = pro.id_producto AND ct.id_calibre = c.id_calibre AND ct.id_unidad_medida = um.id_unidad_medida AND ct.id_medidas_productos  = mp.id_medidas_productos AND ct.id_caract_producto = cp.id_caract_producto AND ct.id_caract_envases = ce.id_caract_envases  ";	  
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);


?>
<link rel="stylesheet" href="../images/Underground.css" type="text/css" />	




<h1>LISTADO DE CODIGOS DE PRODUCTO TERMINADO</h1>
<form id="form1" name="form1" method="post" action="">
  <table width="70%" height="48" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#999999">
    <tr>
      <td width="91" height="21" bgcolor="#CCCCCC"><strong>Codigo</strong></td>
      <td width="112" bgcolor="#CCCCCC"><strong>&nbsp;Especie&nbsp;</strong></td>
      <td width="128" bgcolor="#CCCCCC"><strong>&nbsp;Producto&nbsp;</strong></td>
      <td bgcolor="#CCCCCC"><strong>&nbsp;Calibre&nbsp;</strong></td>
      <td width="100" bgcolor="#CCCCCC"><strong>&nbsp;Unid./Med.&nbsp;</strong></td>
      <td width="102" bgcolor="#CCCCCC"><strong>&nbsp;Medida&nbsp;</strong></td>
      <td width="216" bgcolor="#CCCCCC"><strong>&nbsp;Caract/Producto&nbsp;</strong></td>
      <td width="197" bgcolor="#CCCCCC"><strong>&nbsp;Caract/Envase&nbsp;</strong></td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <?
	while ($row=mysql_fetch_array($result))
    { 
	
	$id_cruce_tablas=$row[id_cruce_tablas];
	$id_especie=$row[id_especie];
    $id_producto=$row[id_producto];
	$id_calibre=$row[id_calibre];
	$id_unidad_medida=$row[id_unidad_medida];
	$id_medidas_productos=$row[id_medidas_productos];
    $id_caract_producto=$row[id_caract_producto];
	$id_caract_envases=$row[id_caract_envases];
	?>
    <tr>
      <td height="22" nowrap="nowrap">&nbsp;
        <?  echo $id_cruce_tablas; ?></td>
      <td nowrap="nowrap">&nbsp;<? echo $row[especie]?></td>
      <td nowrap="nowrap"><? echo $row[producto]?></td>
      <td width="103" nowrap="nowrap">&nbsp;<? echo $row[calibre] ?></td>
      <td nowrap="nowrap">&nbsp;<? echo $row[unidad_medida] ?></td>
      <td nowrap="nowrap">&nbsp;<? echo $row[medidas_productos] ?></td>
      <td nowrap="nowrap">&nbsp;<? echo $row[caract_producto] ?></td>
      <td nowrap="nowrap">&nbsp;<? echo $row[caract_envases]?></td>
      <td width="37" nowrap="nowrap"><input type="radio" name="id_cruce-<? echo $id_cruce_tablas?>" id="radio" value="<? echo $id_cruce_tablas?>"> 
   
        <? }?></td>
    </tr>
   
  </table>
  <center><input type="submit" name="asignarcod" id="asignarcod" value="Asignar Codigo"></center>
</form>

