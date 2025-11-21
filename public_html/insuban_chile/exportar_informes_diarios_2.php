<?
 
			        if(!$entreano1){
					$entreano1=$fhoy=date("Y");
					$entreano1=$entreano1-2;
					//echo "entreano1 $entreano1";
					}
					if(!$entreano2){
					$entreano2=$fhoy=date("Y");
					//echo "entreano2 $entreano2";
					}
					
		 		$sql="SELECT 
ef.id_cruce_tablas           ,
ef.id_pedidos                ,
pro.producto                 ,
c.calibre                    ,
estf.estado_folio            ,
es.especie                   ,
um.unidad_medida             ,
mp.medidas_productos         ,
caracp.caract_producto       ,
caracenv.caract_envases FROM etiquetados_folios AS ef, producto AS pro, calibre AS c, estado_folio AS estf, cruce_tablas AS ct, especie AS es, unidad_medida AS um, medidas_productos AS mp, operarios AS opera, caract_producto AS caracp, caract_envases AS caracenv WHERE ef.id_producto = pro.id_producto AND ef.id_calibre = c.id_calibre AND ef.id_estado_folio = estf.id_estado_folio and ef.id_cruce_tablas = ct.id_cruce_tablas and ef.id_especie = es.id_especie and ef.id_unidad_medida = um.id_unidad_medida and ef.id_medidas_productos = mp.id_medidas_productos and ef.id_caract_producto = caracp.id_caract_producto and ef.id_caract_envases = caracenv.id_caract_envases and ct.id_cruce_tablas != 0 and ef.ano between '$entreano1' and '$entreano2' and ef.id_procedencia = 'N' group by ef.id_cruce_tablas order by es.especie, pro.producto,um.unidad_medida, mp.medidas_productos,c.calibre  asc";
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

<script>
window.onload = detectarCarga;
function detectarCarga(){
   document.getElementById("carga").style.display="none";
}</script>

<div id="carga">
  <img height="80" width="80" border="0" src="jpg/cargando.gif" />
</div>

<form id="form1" name="form1" method="post" action="">
  <table width="884" border="0" align="center">
    <tr>
      <td width="878" height="14" class="titulo">Informe Diarios </td>
       <td width="598" class="titulo">&nbsp;</td>
    <td width="152" class="cajas">
     <a href="?modulo=informes_folios.php">
      Volver  </a></td>
    </tr>
    <tr>
      <td height="14"><span class="cajas">&nbsp;[* Fecha por defecto A&ntilde;o <? echo $entreano1?> - <? echo $entreano2?>]</span></td>
    </tr>
    <tr>
      <td><table width="923" height="75" border="1" align="center" bordercolor="#999999">
          <tr>
            <td height="20" nowrap="nowrap" class="titulo">Codigo Interno </td>
            <td height="20" nowrap="nowrap" class="titulo">Especie</td>
            <td nowrap="nowrap" class="titulo">Producto</td>
            <td nowrap="nowrap" class="titulo">Calibre</td>
            <td nowrap="nowrap" class="titulo">Unidad medida </td>
            <td nowrap="nowrap" class="titulo">Medida</td>
            <td nowrap="nowrap" class="titulo">Caract. Producto </td>
            <td nowrap="nowrap" class="titulo">Caract. Envases </td>
            <td width="58" nowrap="nowrap" class="titulo">Bodega</td>
            <td width="58" nowrap="nowrap" class="titulo">Emitido</td>
            <td width="42" nowrap="nowrap" class="titulo">Total</td>
          </tr>
          <?
	while ($row=mysql_fetch_array($result))
    { 
	$id_cruce_tablas=$row[id_cruce_tablas];
	$id_especie=$row[id_especie];
	$id_especiecontar=strlen($id_especie);
	$id_producto=$row[id_producto];
	$id_productocontar=strlen($id_producto);
	$id_calibre=$row[id_calibre];
	$id_calibrecontar=strlen($id_calibre);
	$id_unidad_medida=$row[id_unidad_medida];
	$id_unidad_medidacontar=strlen($id_unidad_medida);
	$id_medidas_productos=$row[id_medidas_productos];
	$id_medidas_productoscontar=strlen($id_medidas_productos);
	$id_caract_producto=$row[id_caract_producto];
	$id_caract_productocontar=strlen($id_caract_producto);
	$id_caract_envases=$row[id_caract_envases];
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
	
	$codigo= $id_especie.$id_producto.$id_calibre.$id_unidad_medida.$id_medidas_productos.$id_caract_producto.$id_caract_envases;
	
	 $sqlb="SELECT * FROM etiquetados_folios AS ef WHERE ef.id_estado_folio = 2 and ef.id_cruce_tablas = $row[id_cruce_tablas] and ano between '$entreano1' and '$entreano2'";
 			$resulteb=mysql_query($sqlb);
			$cuantosb=mysql_num_rows($resulteb);
	
	
	  	$sqle="SELECT * FROM etiquetados_folios WHERE id_estado_folio = 1 and id_cruce_tablas = $row[id_cruce_tablas] and ano between '$entreano1' and '$entreano2'";
 			$resulte=mysql_query($sqle);
			$cuantose=mysql_num_rows($resulte);
	

	if($cuantosb or $cuantose){
	?>    <!---->
          <tr>
            <td width="92" height="21" nowrap="nowrap" class="cajas"><div align="center" class="titulo"><? echo $row[id_cruce_tablas]?></div></td>
            <td width="60" nowrap="nowrap" class="cajas"><? echo $row[especie]?></td>
            <td width="167" nowrap="nowrap" class="cajas"><? echo $row[producto]?> </td>
            <td width="50" nowrap="nowrap" class="cajas"><? echo $row[calibre]?></td>
            <td width="87" nowrap="nowrap" class="cajas"><? echo $row[unidad_medida]?></td>
            <td width="46" nowrap="nowrap" class="cajas"><? echo $row[medidas_productos]?></td>
            <td width="99" nowrap="nowrap" class="cajas"><? echo $row[caract_producto]?></td>
            <td width="94" nowrap="nowrap" class="cajas"><? echo $row[caract_envases]?></td>
            <td nowrap="nowrap" class="cajas"><div align="center" class="titulo">
			<? echo "$cuantosb"; ?></div></td>
            <td nowrap="nowrap" class="cajas"><div align="center" class="titulo">
			<? echo "$cuantose"; ?></div></td>
            <td nowrap="nowrap" class="cajas"><span class="titulo"><? echo $resultado=$cuantosb+$cuantose; ?></span></td>
          </tr>
		  <!---->
		    <? 
	  }
	  
	  }
	  ?>
          <tr>
            <td height="21" colspan="5" class="cajas">&nbsp;</td>
            <td class="titulo">&nbsp;</td>
            <td class="titulo">&nbsp;</td>
            <td class="titulo">TOTAL</td>
            <td class="style2"><div align="center"><? 
		   	  $sqlbt="SELECT * FROM etiquetados_folios WHERE id_estado_folio = 2 and ano between '$entreano1' and '$entreano2'";
 
$resultetb=mysql_query($sqlbt);
$total_bodega=mysql_num_rows($resultetb);

echo "$total_bodega";  ?></div></td>

            <td class="style2"><div align="center"><? 
			
		   	 $sqlbe="SELECT * FROM etiquetados_folios WHERE id_estado_folio = 1 and ano between '$entreano1' and '$entreano2'";
 			 $resultete=mysql_query($sqlbe);
			 $total_emi=mysql_num_rows($resultete);
			echo "$total_emi";
	 
		  ?></div></td>
            <td class="style2"><? echo $total=$total_bodega + $total_emi;?></td>
          </tr>
        
      </table></td>
	  <? //echo $sql ?>
    </tr>
    <tr>
      <td align="center"><div align="center">
          <a href="excel_producto_terminado_2.php"><img src="jpg/icono-excel.gif"></a>
      </div>(Puede tardar un momento)</td>
      <td></td>
    </tr>
  </table>
</form>
