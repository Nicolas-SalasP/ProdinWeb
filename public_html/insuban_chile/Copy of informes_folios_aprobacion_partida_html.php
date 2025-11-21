<?
if($guardar and $apro_part_paking){
	$sql="SELECT * from apro_part_paking where id_paking_relacion = $id_paking_relacion and id_destinos = $id_destinos and apro_part_paking=$apro_part_paking";
	$rest=mysql_query($sql);
	$cuantos1=mysql_num_rows($rest);
	//echo "cuantos $cuantos1";

if($cuantos1 == 0){
  $fecha=date("Y-m-d");
   $sql="insert into apro_part_paking (apro_part_paking,id_usuario,id_paking_relacion,id_destinos,fecha_imprime_apro_part) values ('$apro_part_paking','$id_usuario','$id_paking_relacion','$id_destinos','$fecha')";
  $result_nuevo=mysql_query($sql);
  //echo "$sql";
}
}

if($modificar){
$sql="SELECT * from apro_part_paking where id_destinos= $id_destinos order by id_apro_part_paking ";
	$rest=mysql_query($sql);
	$cuantos=mysql_num_rows($rest);
	//echo "cuantos $cuantos";<strong></strong>
	
	while ($row=mysql_fetch_array($rest)){
	$id_apro_part_paking =$row[id_apro_part_paking]; 
   }
	
$fecha=date("Y-m-d");
//echo "Estoy dentro de modificar";
$sql_modificar="UPDATE  apro_part_paking  set apro_part_paking='$apro_part_paking', fecha_modificacion_apro_part='$fecha' where id_apro_part_paking =$id_apro_part_paking ";
//echo "$sql_modificar";
$rest=mysql_query($sql_modificar);
}
?>
<style type="text/css">
<!--
.texto_informe1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;

}
.texto_informe2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.cajas {font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}

-->
</style>
<table width="646" border="0" align="center">
  <tr>
    <td height="3" colspan="2"><div align="right"><span class="cajas"><a href="?modulo=ver_piking_folios.php&amp;id_paking_relacion=<?echo $id_paking_relacion?>">Volver</a></span></div></td>
  </tr>
  <tr>
    <td height="4" colspan="2">&nbsp;</td>
  </tr>
  <form id="form1" name="form1" method="post" action="">
  <tr>
    <td width="365" height="10">
	
	<div align="right"></div></td>
    <td width="271">
	  <div align="right">
	<?
	
	$sql="SELECT * from apro_part_paking where id_destinos= $id_destinos order by id_apro_part_paking ";
	$rest=mysql_query($sql);
	$cuantos=mysql_num_rows($rest);
	//echo "cuantos $cuantos";<strong></strong>
	
	if($cuantos){
	
	while ($row=mysql_fetch_array($rest)){
	$id_apro_part_paking =$row[id_apro_part_paking]; 
	//echo "id_apro_part_paking $id_apro_part_paking";
	?>
	<span class="texto_informe2">N&deg;</span>
    <input name="apro_part_paking" type="text" class="texto_informe2"  value="<? echo $row[apro_part_paking]?>" size="6" maxlength="6"/>	 
    <?
	}// fin del while
	
	}else{
	?>
    <span class="texto_informe2">N&deg;</span>
	<input name="apro_part_paking" type="text" class="texto_informe2" size="6" maxlength="6"/>
	
	<?
	}
	?>	
	<? if($cuantos){?>
	<a href="javascript: document.form1.submit();"><input type="hidden" name="modificar" value="modificar" /><img src="jpg/modificar.jpg" width="62" height="13" border="0" /></a>
	<? }else{?>
	<a href="javascript: document.form1.submit();"><input type="hidden" name="guardar" value="guardar" /><img src="jpg/guardar.jpg" width="62" height="13" border="0" /></a>
	<? } ?>
	
	<span class="cajas"></span></div></td>
  </tr>    </form>
  <tr>
    <td height="39" colspan="2"><div align="center" class="texto_informe2">INFORME DE APROBACION DE PARTIDA (IAP) </div></td>
  </tr>
  <tr>
    <td height="32" colspan="2" valign="top"><table width="640" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="344" rowspan="2" class="texto_informe2">FECHA DESPACHO: 12/03/2010 </td>
        <td width="331" class="texto_informe2">Identificac&oacute;n del Transporte: CONTENEDOR </td>
      </tr>
      <tr>
        <td class="texto_informe2">Patente n&deg;: </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="118" colspan="2" valign="top"><?
	$sql_demp="SELECT * from datos_empresa";
	$rest_demp=mysql_query($sql_demp);
	$cuantos_demp=mysql_num_rows($rest_demp);

	while ($row_demp=mysql_fetch_array($rest_demp)){ 
	?>
      <table width="640" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" class="texto_informe2">DATOS DEL ESTABLECIMIENTO ELABORADOR </td>
      </tr>
      <tr>
        <td width="344" class="texto_informe1">&nbsp;Nombre del establecimiento </td>
        <td width="329" class="texto_informe1"><div align="center"><span class="cajas"><?echo $row_demp[nombreemp]?></span>&nbsp;</div></td>
      </tr>
      <tr>
        <td class="texto_informe1">&nbsp;Direcci&oacute;n</td>
        <td class="texto_informe1"><div align="center"><span class="cajas"><?echo $row_demp[direccion]?></span>&nbsp;</div></td>
      </tr>
      <tr>
        <td class="texto_informe1">&nbsp;Ciudad</td>
        <td class="texto_informe1"><div align="center"><span class="cajas"><?echo $row_demp[ciudad]?></span>&nbsp;</div></td>
      </tr>
      <tr>
        <td class="texto_informe1">&nbsp;Actividad</td>
        <td class="texto_informe1"><div align="center"><span class="cajas"><?echo $row_demp[actividad_empresa]?></span>&nbsp;</div></td>
      </tr>
      <tr>
        <td height="16" class="texto_informe1">&nbsp;N&deg; registro SAG </td>
        <td class="texto_informe1"><div align="center">13 - 62 &nbsp;</div></td>
      </tr>
    </table>
	<? }?>	</td>
  </tr>
  <tr>
    <td height="63" colspan="2" valign="top"><table width="640" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" class="texto_informe2">&nbsp;PRODUCTOS A EXPORTAR </td>
      </tr>
      <tr>
        <td width="212" class="texto_informe1">&nbsp;Especie</td>
        <td width="496" class="texto_informe1">&nbsp;&nbsp;Producto (s) TRIPA SALADA </td>
      </tr>
      <tr>
        <td><span class="texto_informe1">
          &nbsp;<? 
	
		$sql="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, especie AS es where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		and ef.id_especie = es.id_especie
		group by ef.id_especie	";
		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 
     	 if($cuantos){
		    while ($r=mysql_fetch_array($rest)){ 
			//$cont++;
	   		$f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
			$fdespacho_piking =format_fecha_sin_hora($r[fdespacho_piking]);
			$id_producto=$r[id_producto];
	        $i=0;
		?>
          <?
		$sqlesp="SELECT * FROM cruce_plant_especie AS cpe, especie e where cpe.id_producto = $id_producto and cpe.id_especie = e.id_especie group by e.especie";
		$restesp=mysql_query($sqlesp);
		$cuantosesp=mysql_num_rows($restesp);
 		//echo "SQL $sqlesp<br>";
     	 if($cuantosesp){
		    if ($resp=mysql_fetch_array($restesp)){ 
			echo "$resp[especie] / ";
			}
			}
		?>
          <? }
		
		} ?>
        </span></td>
        <td class="texto_informe2">&nbsp;Subproductos</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="76" colspan="2" valign="top"><?
		
		$sql="SELECT count( DISTINCT ef.id_etiquetados_folios) AS cf, SUM(ef.contenido_unidades) AS cont, pro.producto, ef.f_elaboracion, ef.f_vencimiento, es.id_especie, es.especie FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, especie AS es where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and ef.id_medidas_productos = mp.id_medidas_productos
		and p.id_etiquetados_folios= ef.id_etiquetados_folios
        and ef.id_especie= es.id_especie
        group by es.id_especie";
		$rest=mysql_query($sql);
		?>
  <table width="640" border="1">
	 
        <tr>
          <td width="56" class="texto_informe2">&nbsp;Destinos</td>
          <td width="64" class="texto_informe2">&nbsp;N&deg; Pallet </td>
          <td width="67" class="texto_informe2">&nbsp;Bidones</td>
          <td width="155" class="texto_informe2">&nbsp;Producto</td>
          <td width="129" class="texto_informe2">&nbsp;Fecha Elaboracion </td>
          <td width="129" class="texto_informe2">&nbsp;Fecha Vencimiento</td>
        </tr>&nbsp;
		 <?
	   //$cuantos=mysql_num_rows($rest);
 		  while ($r=mysql_fetch_array($rest)){ 
	    ?>
        <tr>
          <td><span class="texto_informe1">
           &nbsp; <? if($id_etiqueta_idioma == 1)
	          echo "España";	
		   if($id_etiqueta_idioma == 2)
		      echo "EE.UU.";
		   if($id_etiqueta_idioma == 3)
		      echo "Brasil";
		?>
          </span></td>
          <td>&nbsp;</td>
          <td>
		  <div align="center" class="cajas">
		  <? echo $r[cf];
		     //echo "    --  $r[cont]"?>
		  <? z
		    
		  ?>
		  </div></td>
          <td><span class="texto_informe1">
          &nbsp;Tripa Salada de
          <? echo "$r[especie]"; ?></span></td>
          <td valign="top"><div align="left"><span class="texto_informe1">
        
            <? 
/*		 
		 	$ssql="SELECT *, DATE_FORMAT(postedon,'%M %Y') AS dateGroup FROM news ORDER by dateGroup"; 
$rs=mysql_query($ssql); 
while($row=mysql_fetch_array($rs)){ 
  echo "<li><a href=\"index.php?show=news&id=".$row['dateGroup']."\">".$row['dateGroup']."</a></li>"; 
}  
*/
			
			
		$sqlel="SELECT pro.producto, ef.f_elaboracion, ef.f_vencimiento, DATE_FORMAT( f_elaboracion, '%M %Y' ) AS dateGroup
FROM paking AS p, etiquetados_folios AS ef, calibre AS c, producto AS pro, medidas_productos AS mp
WHERE p.id_paking_relacion =$id_paking_relacion
AND ef.id_calibre = c.id_calibre
AND ef.id_producto = pro.id_producto
AND ef.id_medidas_productos = mp.id_medidas_productos
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
GROUP BY dateGroup order by f_elaboracion
 ";
		$restel=mysql_query($sqlel);
		 
	    while ($rel=mysql_fetch_array($restel)){ 
		 
		  $mess=split(" ",$rel[f_elaboracion]);
 		  $mess=split("-",$mess[0]);
          $mess[2]-$mes[1]-$mess[0];
		  $dat11=$mess[1];
  		  $dat22=$mess[0];
		  
		  
		  if($dat11 == 1)
		  echo "ENERO / $dat22<br>";
		  if($dat11 == 2)
		  echo "FEBRERO / $dat22<br>";
		  if($dat11 == 3)
		  echo "MARZO / $dat22<br>";
		  if($dat11 == 4)
		  echo "ABRIL / $dat22<br>";
		  if($dat11 == 5)
		  echo "MAYO / $dat22<br>";
		  if($dat11 == 6)
		  echo "JUNIO / $dat22<br>";
		  if($dat11 == 7)
		  echo "JULIO / $dat22<br>";
		  if($dat11 == 8)
		  echo "AGOSTO / $dat22<br>";
		  if($dat11 == 9)
		  echo "SEPTIEMBRE / $dat22<br>";
		  if($dat11 == 10)
		  echo "OCTUBRE / $dat22<br>";
		  if($dat11 == 11)
		  echo "NOVIEMBRE / $dat22<br>";
		  if($dat11 == 12)
		  echo "DICIEMBRE / $dat22<br>";
		  
          ?>
		  
            <? } // fin  while ($rel=mysql_fetch_array($restel)){ ?>
          </span></div></td>
          <td valign="top"><div align="left"><span class="texto_informe1">
              <? 
/*		 
		 	$ssql="SELECT *, DATE_FORMAT(postedon,'%M %Y') AS dateGroup FROM news ORDER by dateGroup"; 
$rs=mysql_query($ssql); 
while($row=mysql_fetch_array($rs)){ 
  echo "<li><a href=\"index.php?show=news&id=".$row['dateGroup']."\">".$row['dateGroup']."</a></li>"; 
}  
*/
			
			
		$sqle2="SELECT pro.producto, ef.f_elaboracion, ef.f_vencimiento, DATE_FORMAT( ef.f_vencimiento, '%M %Y' ) AS dateGroup
FROM paking AS p, etiquetados_folios AS ef, calibre AS c, producto AS pro, medidas_productos AS mp
WHERE p.id_paking_relacion =$id_paking_relacion
AND ef.id_calibre = c.id_calibre
AND ef.id_producto = pro.id_producto
AND ef.id_medidas_productos = mp.id_medidas_productos
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
GROUP BY dateGroup order by ef.f_vencimiento
 ";
		$reste2=mysql_query($sqlel);
		 
	    while ($re2=mysql_fetch_array($reste2)){ 
		 
		  $messs=split(" ",$re2[f_vencimiento]);
 		  $messs=split("-",$messs[0]);
          $messs[2]-$mes[1]-$messs[0];
		  $dat111=$messs[1];
  		  $dat222=$messs[0];
		  
		  if($dat111 == 1)
		  echo "ENERO / $dat222<br>";
		  if($dat111 == 2)
		  echo "FEBRERO / $dat222<br>";
		  if($dat111 == 3)
		  echo "MARZO / $dat222<br>";
		  if($dat111 == 4)
		  echo "ABRIL / $dat222<br>";
		  if($dat111 == 5)
		  echo "MAYO / $dat222<br>";
		  if($dat111 == 6)
		  echo "JUNIO / $dat222<br>";
		  if($dat111 == 7)
		  echo "JULIO / $dat222<br>";
		  if($dat111 == 8)
		  echo "AGOSTO / $dat222<br>";
		  if($dat111 == 9)
		  echo "SEPTIEMBRE / $dat222<br>";
		  if($dat111 == 10)
		  echo "OCTUBRE / $dat222<br>";
		  if($dat11 == 11)
		  echo "NOVIEMBRE / $dat222<br>";
		  if($dat111 == 12)
		  echo "DICIEMBRE / $dat222<br>";
		  
          ?>
              <? } // fin  while ($rel=mysql_fetch_array($restel)){ ?>
			  
	 <? 		} // while ($r=mysql_fetch_array($rest)){ 
		?>
          </span></div></td>
        </tr>
    </table></td></tr>
  <tr>
    <td height="60" colspan="2" valign="top"><table width="640" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="87" class="texto_informe2"><div align="center">RESUMEN</div></td>
        <td colspan="5" class="texto_informe2">&nbsp;</td>
        </tr>
      <tr>
        <td nowrap="nowrap" class="texto_informe2"><div align="center">N&deg; PALLET </div></td>
        <td width="78" nowrap="nowrap" class="texto_informe2"><div align="center">N&deg; BIDONES </div></td>
        <td width="68" nowrap="nowrap" class="texto_informe2"><div align="center">N&deg; LOTES </div></td>
        <td width="124" nowrap="nowrap" class="texto_informe2"><div align="center">CANTIDAD  KILOS </div></td>
        <td width="139" nowrap="nowrap" class="texto_informe2"><div align="center">FECHA ELABORACION </div></td>
        <td width="130" nowrap="nowrap" class="texto_informe2"><div align="center">FECHA DE EMPAQUE </div></td>
      </tr>        <tr>
	
        <td class="cajas">&nbsp;
		<? if($id_etiqueta_idioma == 1)
	          echo "España";	
		   if($id_etiqueta_idioma == 2)
		      echo "EE.UU.";
		   if($id_etiqueta_idioma == 3)
		      echo "Brasil";
		?></td>
        <td><div align="center"><span class="cajas"><? echo $sum?><br />
            </span></div></td>
        <td>&nbsp;</td>
        <td><div align="center"><span class="cajas"><? echo $total;?></span></div></td>
        <td valign="top"><span class="texto_informe1">
          <? 
/*		 
		 	$ssql="SELECT *, DATE_FORMAT(postedon,'%M %Y') AS dateGroup FROM news ORDER by dateGroup"; 
$rs=mysql_query($ssql); 
while($row=mysql_fetch_array($rs)){ 
  echo "<li><a href=\"index.php?show=news&id=".$row['dateGroup']."\">".$row['dateGroup']."</a></li>"; 
}  
*/
			
			
		$sql="SELECT pro.producto, ef.f_elaboracion, ef.f_vencimiento, DATE_FORMAT( f_elaboracion, '%M %Y' ) AS dateGroup, DATE_FORMAT( f_vencimiento, '%M %Y' ) AS dateGroupven
FROM paking AS p, etiquetados_folios AS ef, calibre AS c, producto AS pro, medidas_productos AS mp
WHERE p.id_paking_relacion =$id_paking_relacion
AND ef.id_calibre = c.id_calibre
AND ef.id_producto = pro.id_producto
AND ef.id_medidas_productos = mp.id_medidas_productos
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
GROUP BY dateGroup, dateGroupven
ORDER BY f_elaboracion

 ";
		$restel=mysql_query($sqlel);
		 
	    while ($rel=mysql_fetch_array($restel)){ 
		 
		  $mess=split(" ",$rel[f_elaboracion]);
 		  $mess=split("-",$mess[0]);
          $mess[2]-$mes[1]-$mess[0];
		  $dat11=$mess[1];
  		  $dat22=$mess[0];
		  
		  
		  if($dat11 == 1)
		  echo "ENERO / $dat22<br>";
		  if($dat11 == 2)
		  echo "FEBRERO / $dat22<br>";
		  if($dat11 == 3)
		  echo "MARZO / $dat22<br>";
		  if($dat11 == 4)
		  echo "ABRIL / $dat22<br>";
		  if($dat11 == 5)
		  echo "MAYO / $dat22<br>";
		  if($dat11 == 6)
		  echo "JUNIO / $dat22<br>";
		  if($dat11 == 7)
		  echo "JULIO / $dat22<br>";
		  if($dat11 == 8)
		  echo "AGOSTO / $dat22<br>";
		  if($dat11 == 9)
		  echo "SEPTIEMBRE / $dat22<br>";
		  if($dat11 == 10)
		  echo "OCTUBRE / $dat22<br>";
		  if($dat11 == 11)
		  echo "NOVIEMBRE / $dat22<br>";
		  if($dat11 == 12)
		  echo "DICIEMBRE / $dat22<br>";
		  
          ?>
          <? } // fin  while ($rel=mysql_fetch_array($restel)){ ?>
        </span></td>
        <td valign="top"><span class="texto_informe1">
          <? 
/*		 
		 	$ssql="SELECT *, DATE_FORMAT(postedon,'%M %Y') AS dateGroup FROM news ORDER by dateGroup"; 
$rs=mysql_query($ssql); 
while($row=mysql_fetch_array($rs)){ 
  echo "<li><a href=\"index.php?show=news&id=".$row['dateGroup']."\">".$row['dateGroup']."</a></li>"; 
}  
*/
			
			
		$sqleem="SELECT pro.producto, ef.f_inicio, ef.f_vencimiento, DATE_FORMAT( ef.f_inicio, '%M %Y' ) AS dateGroup
FROM paking AS p, etiquetados_folios AS ef, calibre AS c, producto AS pro, medidas_productos AS mp
WHERE p.id_paking_relacion =$id_paking_relacion
AND ef.id_calibre = c.id_calibre
AND ef.id_producto = pro.id_producto
AND ef.id_medidas_productos = mp.id_medidas_productos
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
GROUP BY dateGroup order by ef.f_inicio
 ";
		$restem=mysql_query($sqleem);
		 
	    while ($reem=mysql_fetch_array($restem)){ 
		 
		  $messss=split(" ",$reem[f_inicio]);
 		  $messss=split("-",$messss[0]);
          $messss[2]-$mes[1]-$messss[0];
		  $dat1111=$messss[1];
  		  $dat2222=$messss[0];
		  
		  if($dat1111 == 1)
		  echo "ENERO / $dat2222<br>";
		  if($dat111 == 2)
		  echo "FEBRERO / $dat2222<br>";
		  if($dat1111 == 3)
		  echo "MARZO / $dat2222<br>";
		  if($dat1111 == 4)
		  echo "ABRIL / $dat2222<br>";
		  if($dat1111 == 5)
		  echo "MAYO / $dat2222<br>";
		  if($dat1111 == 6)
		  echo "JUNIO / $dat2222<br>";
		  if($dat1111 == 7)
		  echo "JULIO / $dat2222<br>";
		  if($dat111 == 8)
		  echo "AGOSTO / $dat2222<br>";
		  if($dat1111 == 9)
		  echo "SEPTIEMBRE / $dat2222<br>";
		  if($dat1111 == 10)
		  echo "OCTUBRE / $dat2222<br>";
		  if($dat111 == 11)
		  echo "NOVIEMBRE / $dat2222<br>";
		  if($dat1111 == 12)
		  echo "DICIEMBRE / $dat2222<br>";
		  
          ?>
          <? } // fin  while ($rel=mysql_fetch_array($restel)){ ?>
        </span></td>
		
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="129" colspan="2" valign="top">
	<?
	$sqldes="SELECT * FROM destinos where id_destinos = $id_destinos"; 
		$restdes=mysql_query($sqldes);
		$cuantos=mysql_num_rows($restdes);
		//echo "cuantos destinos $cuantos";

	    while ($row_des=mysql_fetch_array($restdes)){ 	
	?>
	<table width="640" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" class="texto_informe2">&nbsp;DESTINOS DE LA CARGA </td>
        </tr>

      <tr>
        <td width="362" class="texto_informe2">&nbsp;Nombre del Establecimiento </td>
        <td width="350" class="texto_informe1">&nbsp;<span class="cajas"><?echo $row_des[destinos]?></span></td>
        </tr>
      <tr>
        <td class="texto_informe2">&nbsp;Direcci&oacute;n</td>
        <td class="texto_informe1">&nbsp;<span class="cajas"><?echo $row_des[domicilio]?></span></td>
      </tr>
      <tr>
        <td class="texto_informe2">&nbsp;Ciudad</td>
        <td class="texto_informe1">&nbsp;<span class="cajas"><?echo $row_des[ciudad]?></span></td>
      </tr>
      <tr>
        <td class="texto_informe2">&nbsp;Actividad</td>
        <td class="texto_informe1">&nbsp;<span class="cajas"><?echo $row_des[destino_actividad]?></span></td>
        </tr>
    </table>
	<? }?></td>
  </tr>
  <tr>
    <td height="25" colspan="2"><div align="center" class="texto_informe1">ORIGEN DE LA MATERIA PRIMA: &quot;ADJUNTO EN TRAZABILIDAD DEL PRODUCTO&quot;<br>
        Los productos y lotes cumplen con los requizitos zoosanitario del pa&iacute;s de destino<br>
        <span class="cajas">
       <? if($id_etiqueta_idioma == 1)
	          echo "España";	
		   if($id_etiqueta_idioma == 2)
		      echo "EE.UU.";
		   if($id_etiqueta_idioma == 3)
		      echo "Brasil";
		?>
        </span> y con los PPC del HACCP del establecimiento. </div></td>
  </tr>
  <tr>
    <td height="21" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="53" colspan="2"><div align="center" class="texto_informe2">Firma Autorizada que avala esta certificaci&oacute;n<br>
      <? $firma=crea_firma($link,$id_usuario);
														echo $firma;
														
																										?>
    </div></td>
  </tr>
</table> 