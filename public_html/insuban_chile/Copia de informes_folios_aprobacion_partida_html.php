<?

 if($guardar and $apro_part_paking){
 
  $dat5=split(" ",$fecha_imprime_apro_part);
  $dat7=split("-",$dat5[0]);
  $fecha_imprime_apro_part="$dat7[2]-$dat7[1]-$dat7[0]";

 
	//$sql="SELECT * from apro_part_paking where id_paking_relacion = $id_paking_relacion and id_destinos = $id_destinos and id_usuario = $id_usuario  and apro_part_paking=$apro_part_paking and fecha_imprime_apro_part = $fecha_imprime_apro_part and kilos = $kilos";
	//$rest=mysql_query($sql);
	//$cuantos1=mysql_num_rows($rest);
	//echo "cuantos $cuantos1";

//if($cuantos1){
     $sql="insert into apro_part_paking (apro_part_paking,id_usuario,id_paking_relacion,id_destinos,fecha_imprime_apro_part,kilos) values ('$apro_part_paking','$id_usuario','$id_paking_relacion','$id_destinos','$fecha_imprime_apro_part','$total')";
  $result_nuevo=mysql_query($sql);
  //echo "$sql";
//}
}

if($modificar){

 $dat5=split(" ",$fecha_imprime_apro_part);
  $dat7=split("-",$dat5[0]);
  $fecha_imprime_apro_part="$dat7[2]-$dat7[1]-$dat7[0]";


   //$sql="SELECT * from apro_part_paking where id_destinos= $id_destinos order by id_apro_part_paking ";
	//$rest=mysql_query($sql);
	//$cuantos=mysql_num_rows($rest);
	//echo "cuantos $cuantos";
	
	//while ($row=mysql_fetch_array($rest)){
	//$id_apro_part_paking =$row[id_apro_part_paking]; 
   //}
	//$fecha=date("Y-m-d");
//echo "Estoy dentro de modificar";
$sql_modificar="UPDATE  apro_part_paking  set apro_part_paking='$apro_part_paking', id_usuario ='$id_usuario', fecha_imprime_apro_part='$fecha_imprime_apro_part', kilos='$kilos' where id_paking_relacion =$id_paking_relacion ";
//echo "$sql_modificar";
$rest=mysql_query($sql_modificar);
}


$sqldes="SELECT * FROM destinos where id_destinos = $id_destinos"; 
		$restdes=mysql_query($sqldes);
		$cuantos=mysql_num_rows($restdes);
		//echo "cuantos destinos $cuantos";

	    while ($row_des=mysql_fetch_array($restdes)){ 	
		$destino_actividad = $row_des[destino_actividad];
		$ciudad = $row_des[ciudad];
		$domicilio = $row_des[domicilio];
		$destinos = $row_des[destinos];
		$pais = $row_des[pais];
		
		}
		

?>

<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>

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


<form id="form1" name="form1" method="post" action="">
  <table width="656" border="0">
    <tr>
      <td colspan="2"><div align="center"><span class="texto_informe2">INFORME DE APROBACION DE PARTIDA (IAP) </span></div></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;<div align="center"><a href="?modulo=ver_piking_folios.php&id_etiqueta_idioma=<?echo $id_etiqueta_idioma?>&cuantos1=<? echo $cantifo?>&id_destinosotro=<? echo $id_destinos?>&amp;id_paking_relacion=<?echo $id_paking_relacion?>&fdespacho_piking=<?echo $fdespacho_piking?>&cantidad_kilos=<? echo $cantidad_kilos?>&folio_piking=<? echo $folio_piking?>&muestra=1" class="cajas">Volver</a></div></td>
    </tr>
    <tr>
      <td width="412">&nbsp;</td>
      <td width="234"><div align="right">
        <?
	
	$sql="SELECT * from apro_part_paking where id_paking_relacion = $id_paking_relacion  order by id_apro_part_paking ";
	$rest=mysql_query($sql);
	$cuantos=mysql_num_rows($rest);
	
	
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
    </tr>
    <tr>
      <td colspan="2"><table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="322" rowspan="2" class="texto_informe2">
		  <?
		$sql="SELECT * from apro_part_paking where id_paking_relacion = $id_paking_relacion  order by id_apro_part_paking ";
		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
		//echo "cuantos $cuantos";
	
		if($cuantos){
		while ($row=mysql_fetch_array($rest)){
		$id_apro_part_paking =$row[id_apro_part_paking]; 
		$fecha_imprime_apro_part=format_fecha_sin_hora($row[fecha_imprime_apro_part]);
		?>
        FECHA DESPACHO:
        <input name="fecha_imprime_apro_part" type="text" class="cajas"   id="fecha_imprime_apro_part"  value="<?echo $fecha_imprime_apro_part?>" size="10" maxlength="10" />      
        <a href="javascript:show_Calendario('form1.fecha_imprime_apro_part');" class="cajas"  >Ver</a>
	 <? }
         }else{	 
		 $fecha_imprime_apro_part = $fdespacho_piking;
		?>
		 <input name="fecha_imprime_apro_part" type="text" class="cajas"   id="fecha_imprime_apro_part"  value="<?echo $fecha_imprime_apro_part?>" size="10" maxlength="10" />      
        <a href="javascript:show_Calendario('form1.fecha_imprime_apro_part');" class="cajas"  >Ver</a>
		
		<? }?>
		
		</td>
          <td width="315" class="texto_informe2">Identificac&oacute;n del Transporte: CONTENEDOR </td>
        </tr>
        <tr>
          <td class="texto_informe2">Patente n&deg;: </td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="2"><?
	$sql_demp="SELECT * from datos_empresa";
	$rest_demp=mysql_query($sql_demp);
	$cuantos_demp=mysql_num_rows($rest_demp);

	while ($row_demp=mysql_fetch_array($rest_demp)){ 
	?>
        <table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
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
      <? }?></td>
    </tr>
    <tr>
      <td colspan="2"><table width="650" border="1" align="center">
        <tr>
          <td colspan="2" class="texto_informe2">PRODUCTOS A EXPORTAR </td>
        </tr>
        <tr>
          <td width="320" class="texto_informe2">ESPECIE</td>
          <td width="314" class="texto_informe2">PRODUCTO (S)<? if($id_producto222 == 88){?> MUCOSA FRESCA <?}ELSE{?>TRIPA SALADA <? }?></td>
        </tr>
        <tr>
          <td class="texto_informe1"><?

$sql_esp="SELECT count( DISTINCT ef.id_etiquetados_folios) AS cf, SUM(ef.contenido_unidades) AS cont, p.id_paking_relacion, ef.id_etiquetados_folios, esp.id_especie, esp.especie, ef.f_vencimiento
FROM paking AS p, etiquetados_folios AS ef, especie AS esp
WHERE
p.id_paking_relacion = $id_paking_relacion
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
AND ef.id_especie = esp.id_especie
GROUP BY ef.id_especie";	

$result_esp=mysql_query($sql_esp);
$cuanto_esp=mysql_num_rows($result_esp);
		
	
	while ($row_esp=mysql_fetch_array($result_esp)){
		$sum+=$row_esp[cf];
		$total+=$row_esp[cont];
		
	
		
		
		$id_especie=$row_esp[id_especie];

		$sql_fec="SELECT p.id_paking_relacion, ef.id_etiquetados_folios, esp.id_especie, esp.especie, ef.f_vencimiento,  DATE_FORMAT( ef.f_elaboracion, '%M %Y' ) AS dateGroup
        FROM paking AS p, etiquetados_folios AS ef, especie AS esp 
        WHERE 
        p.id_paking_relacion = $id_paking_relacion
        AND p.id_etiquetados_folios = ef.id_etiquetados_folios
        AND ef.id_especie = esp.id_especie
        AND esp.id_especie = $id_especie
        GROUP BY dateGroup order by ef.f_elaboracion
        ";
        $result_fec=mysql_query($sql_fec);
        $cuanto_fec=mysql_num_rows($result_fec);
		
		echo "  $row_esp[especie] / ";

	    while ($row_fec=mysql_fetch_array($result_fec)){ 
		
		//echo "  FECHA $row_fec[f_vencimiento] <br>";

       
	   } //fin while ($row_esp=mysql_fetch_array($result_esp)){
		   
		//echo " SUM $sum - Total $total";	
		
	} //fin  while ($row_esp=mysql_fetch_array($result_esp)){
		
		
		?></td>
          <td class="cajas">Subproductos</td>
        </tr>
      </table>
	   <? $sum+=$r[cf];
		     $total+=$r[cont];
	?>	  </td>
    </tr>
    <tr>
      <td colspan="2"><table width="650" border="1" align="center">
        <tr>
          <td width="71" class="texto_informe2">DESTINOS</td>
          <td width="77" class="texto_informe2">N&deg; PALLET </td>
          <td width="65" class="texto_informe2"> BIDONES </td>
          <td width="122" class="texto_informe2">PRODUCTO</td>
          <td width="141" class="texto_informe2">FECHA PRODUCCION</td>
          <td width="134" class="texto_informe2">FECHA VENCIMIENTO </td>
        </tr>
		<?

	$sql_esp="SELECT count( DISTINCT ef.id_etiquetados_folios) AS cf, SUM(ef.contenido_unidades) AS cont, p.id_paking_relacion, ef.id_etiquetados_folios, esp.id_especie, esp.especie, ef.f_vencimiento
FROM paking AS p, etiquetados_folios AS ef, especie AS esp
WHERE
p.id_paking_relacion = $id_paking_relacion
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
AND ef.id_especie = esp.id_especie
GROUP BY ef.id_especie";	

$result_esp=mysql_query($sql_esp);
$cuanto_esp=mysql_num_rows($result_esp);
		
	
		
	while ($row_esp=mysql_fetch_array($result_esp)){
			$id_especie=$row_esp[id_especie];

		$sql_fec="SELECT p.id_paking_relacion, ef.id_etiquetados_folios, esp.id_especie, esp.especie, ef.f_elaboracion,  DATE_FORMAT( ef.f_elaboracion, '%M %Y' ) AS dateGroup
        FROM paking AS p, etiquetados_folios AS ef, especie AS esp 
        WHERE 
        p.id_paking_relacion = $id_paking_relacion
        AND p.id_etiquetados_folios = ef.id_etiquetados_folios
        AND ef.id_especie = esp.id_especie
        AND esp.id_especie = $id_especie
        GROUP BY dateGroup order by ef.f_elaboracion
        ";
        $result_fec=mysql_query($sql_fec);
        $cuanto_fec=mysql_num_rows($result_fec);
		
	?>
        <tr>
          <td valign="middle" class="texto_informe1"><div align="center">
            <? echo $pais;
		?>
          </div></td>
          <td valign="middle" class="texto_informe1"><div align="center">&nbsp;</div></td>
          <td valign="middle" class="texto_informe1"><div align="center"><? //echo " $row_esp[cf]";	?>
            <input name="cf" type="text" class="cajas" id="cf" value="<? echo $row_esp[cf]?>" size="5" maxlength="5" />
          </div></td>
          <td valign="middle" class="texto_informe1"><div align="center"><? if($id_producto222 == 88){?>Mucosa Fresca <? }else{ ?> Tripa Salada de <? } ?> <? echo "$row_esp[especie] ";?></div></td>
          <td valign="top" class="texto_informe1">
		    
		      <div align="left">
		        <? 
		  
		$sql_fec_elab="SELECT p.id_paking_relacion, ef.id_etiquetados_folios, esp.id_especie, esp.especie, ef.f_termino,  DATE_FORMAT( ef.f_termino, '%M %Y' ) AS dateGroup
        FROM paking AS p, etiquetados_folios AS ef, especie AS esp 
        WHERE 
        p.id_paking_relacion = $id_paking_relacion
        AND p.id_etiquetados_folios = ef.id_etiquetados_folios
        AND ef.id_especie = esp.id_especie
        AND esp.id_especie = $id_especie
        GROUP BY dateGroup order by ef.f_termino
        ";
        $result_fec_elab=mysql_query($sql_fec_elab);
        $cuanto_fec_elb=mysql_num_rows($result_fec);  
		  
	    while ($row_fec_elab=mysql_fetch_array($result_fec_elab)){ 
		
		
	     $mess=split(" ",$row_fec_elab[f_termino]);
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
       
	   } //fin while ($row_esp=mysql_fetch_array($result_esp)){
		   
		//echo " SUM $sum - Total $total";	
		
		  ?>		  
              </div></td>
          <td valign="top" class="texto_informe1">
            <div align="left"><br />
              <? 
		  
		$sql_fec_ven="SELECT p.id_paking_relacion, ef.id_etiquetados_folios, esp.id_especie, esp.especie, ef.f_vencimiento,  DATE_FORMAT( ef.f_vencimiento, '%M %Y' ) AS dateGroup
        FROM paking AS p, etiquetados_folios AS ef, especie AS esp 
        WHERE 
        p.id_paking_relacion = $id_paking_relacion
        AND p.id_etiquetados_folios = ef.id_etiquetados_folios
        AND ef.id_especie = esp.id_especie
        AND esp.id_especie = $id_especie
        GROUP BY dateGroup order by ef.f_vencimiento
        ";
        $result_fec_ven=mysql_query($sql_fec_ven);
        $cuanto_fec_ven=mysql_num_rows($result_fec_ven);  
		  
	    while ($row_fec_ven=mysql_fetch_array($result_fec_ven)){ 
				
	      $messs=split(" ",$row_fec_ven[f_vencimiento]);
		 
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
		  if($dat111 == 11)
		  echo "NOVIEMBRE / $dat222<br>";
		  if($dat111 == 12)
		  echo "DICIEMBRE / $dat222<br>";
       
	   } //fin while ($row_esp=mysql_fetch_array($result_esp)){
		   
		//echo " SUM $sum - Total $total";	
		
		  ?>
            </div></td>
        </tr>
<? 	} //fin  while ($row_esp=mysql_fetch_array($result_esp)){?>
      </table></td>
    </tr>
    <tr>
      <td colspan="2"><table width="650" border="1" align="center">
        <tr>
          <td width="69" class="texto_informe2">RESUMEN</td>
          <td colspan="5" class="texto_informe2">&nbsp;</td>
          </tr>
        <tr>
          <td class="texto_informe2"><div align="center">N&deg; PALLET </div></td>
          <td class="texto_informe2"><div align="center">N&deg; BIDONES </div></td>
          <td class="texto_informe2"><div align="center">N&deg; LOTES </div></td>
          <td class="texto_informe2"><div align="center">CANTIDAD DE KILOS </div></td>
          <td class="texto_informe2"><div align="center">FECHA PRODUCCION </div></td>
          <td class="texto_informe2"><div align="center">FECHA DE EMPAQUE </div></td>
        </tr>
      
        <tr>
          <td valign="middle" class="texto_informe1">&nbsp;</td>
          <td width="86" valign="middle" class="texto_informe1"><div align="center"><? //echo $cantifo?>
            <input name="cantifo" type="text" class="cajas" id="cantifo" value="<? echo $cantifo?>" size="5" maxlength="5" />
          </div></td>
          <td width="87" valign="middle" class="texto_informe1">&nbsp;</td>
          <td width="130" valign="middle" class="texto_informe1">
		  <div align="center">
        <?
		
		$sql="SELECT * from apro_part_paking where id_paking_relacion = $id_paking_relacion ";
		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
		
		if($cuantos){
		while ($row=mysql_fetch_array($rest)){
		$kilos =$row[kilos]; 
		
		if($kilos){
		?>    
		 <input name="kilos" type="text" class="cajas"   id="kilos"  value="<?echo $kilos?>" size="10" maxlength="10" />
		<? 
		}else{ 
		
		$kilos=$total;
		?>
		 <input name="kilos" type="text" class="cajas"   id="kilos"  value="<?echo $kilos?>" size="10" maxlength="10" />
        <? } 
		}
		}else{
		?>
		<input name="total" type="text" class="cajas"   id="total"  value="<?echo $total?>" size="10" maxlength="10" />
		<?
		}
		?>
		   
		 </div>
		  
	
		  </td>
          <td width="120" valign="top" class="texto_informe1">
		  <div align="left">
		<?
		$sql_fec_resm="SELECT p.id_paking_relacion, ef.id_etiquetados_folios, esp.id_especie, esp.especie, ef.f_termino,  DATE_FORMAT( ef.f_termino, '%M %Y' ) AS dateGroup
        FROM paking AS p, etiquetados_folios AS ef, especie AS esp 
        WHERE 
        p.id_paking_relacion = $id_paking_relacion
        AND p.id_etiquetados_folios = ef.id_etiquetados_folios
        AND ef.id_especie = esp.id_especie
        AND esp.id_especie = ef.id_especie
        GROUP BY dateGroup order by ef.f_termino
        ";
        $result_fec_resm=mysql_query($sql_fec_resm);
        $cuanto_fec_resm=mysql_num_rows($result_fec_resm);
		
		//echo "  $row_esp[especie] / ";

	    while ($row_fec_resm=mysql_fetch_array($result_fec_resm)){ 
		
		//echo "  FECHA $row_fec_resm[f_elaboracion] <br>";
          $mes_resm=split(" ",$row_fec_resm[f_termino]);
 		  $mes_resm=split("-",$mes_resm[0]);
          $mes_resm[2]-$mes[1]-$mes_resm[0];
		  $dat1_resm=$mes_resm[1];
  		  $dat2_resm=$mes_resm[0];
		  
		  if($dat1_resm == 1)
		  echo "ENERO / $dat2_resm<br>";
		  if($dat1_resm == 2)
		  echo "FEBRERO / $dat2_resm<br>";
		  if($dat1_resm == 3)
		  echo "MARZO / $dat2_resm<br>";
		  if($dat1_resm == 4)
		  echo "ABRIL / $dat2_resm<br>";
		  if($dat1_resm == 5)
		  echo "MAYO / $dat2_resm<br>";
		  if($dat1_resm == 6)
		  echo "JUNIO / $dat2_resm<br>";
		  if($dat1_resm == 7)
		  echo "JULIO / $dat2_resm<br>";
		  if($dat1_resm == 8)
		  echo "AGOSTO / $dat2_resm<br>";
		  if($dat1_resm == 9)
		  echo "SEPTIEMBRE / $dat2_resm<br>";
		  if($dat1_resm == 10)
		  echo "OCTUBRE / $dat2_resm<br>";
		  if($dat1_resm == 11)
		  echo "NOVIEMBRE / $dat2_resm<br>";
		  if($dat1_resm == 12)
		  echo "DICIEMBRE / $dat2_resm<br>";
       
	    //fin while ($row_esp=mysql_fetch_array($result_esp)){
		   
		//echo " SUM $sum - Total $total";	
		
	} //fin  while ($row_esp=mysql_fetch_array($result_esp)){
		
		
		?></div></td>
          <td width="118" valign="top" class="texto_informe1"><div align="left">
            <?


		$sql_fec_empaque="SELECT p.id_paking_relacion, ef.id_etiquetados_folios, esp.id_especie, esp.especie, ef.f_inicio,  DATE_FORMAT( ef.f_inicio, '%M %Y' ) AS dateGroup
        FROM paking AS p, etiquetados_folios AS ef, especie AS esp 
        WHERE 
        p.id_paking_relacion = $id_paking_relacion
        AND p.id_etiquetados_folios = ef.id_etiquetados_folios
        AND ef.id_especie = esp.id_especie
        AND esp.id_especie = ef.id_especie
        GROUP BY dateGroup order by ef.f_inicio
        ";
        $result_fec_empaque=mysql_query($sql_fec_empaque);
        $cuanto_fec_empaque=mysql_num_rows($result_fec_empaque);
		
		//echo "  $cuanto_fec_empaque / ";

	    while ($row_fec_empaque=mysql_fetch_array($result_fec_empaque)){ 
		
		//echo "  FECHA $row_fec_resm[f_elaboracion] <br>";
          $mes_empaque=split(" ",$row_fec_empaque[f_inicio]);
 		  $mes_empaque=split("-",$mes_empaque[0]);
          $mes_empaque[2]-$mes[1]-$mes_empaque[0];
		  $dat1_empaque=$mes_empaque[1];
  		  $dat2_empaque=$mes_empaque[0];
		  
		  if($dat1_empaque == 1)
		  echo "ENERO / $dat2_empaque<br>";
		  if($dat1_empaque == 2)
		  echo "FEBRERO / $dat2_empaque<br>";
		  if($dat1_empaque == 3)
		  echo "MARZO / $dat2_empaque<br>";
		  if($dat1_empaque == 4)
		  echo "ABRIL / $dat2_empaque<br>";
		  if($dat1_empaque == 5)
		  echo "MAYO / $dat2_empaque<br>";
		  if($dat1_empaque == 6)
		  echo "JUNIO / $dat2_empaque<br>";
		  if($dat1_empaque == 7)
		  echo "JULIO / $dat2_empaque<br>";
		  if($dat1_empaque == 8)
		  echo "AGOSTO / $dat2_empaque<br>";
		  if($dat1_empaque == 9)
		  echo "SEPTIEMBRE / $dat2_empaque<br>";
		  if($dat1_empaque == 10)
		  echo "OCTUBRE / $dat2_empaque<br>";
		  if($dat1_empaque == 11)
		  echo "NOVIEMBRE / $dat2_empaque<br>";
		  if($dat1_empaque == 12)
		  echo "DICIEMBRE / $dat2_empaque<br>";
       
	    //fin while ($row_esp=mysql_fetch_array($result_esp)){
		   
		//echo " SUM $sum - Total $total";	
		
	} //fin  while ($row_esp=mysql_fetch_array($result_esp)){
		
		
		?>
          </div></td>
        </tr>
        <? //fin  while ($row_esp=mysql_fetch_array($result_esp)){?>
      </table></td>
    </tr>
    <tr>
      <td colspan="2"><?
	
	?>
        <table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="2" class="texto_informe2">&nbsp;DESTINOS DE LA CARGA </td>
          </tr>
          <tr>
            <td width="326" class="texto_informe2">&nbsp;Nombre del Establecimiento </td>
            <td width="507" class="texto_informe1">&nbsp;<span class="cajas"><?echo $destinos?></span></td>
          </tr>
          <tr>
            <td class="texto_informe2">&nbsp;Direcci&oacute;n</td>
            <td class="texto_informe1">&nbsp;<span class="cajas"><?echo $domicilio?></span></td>
          </tr>
          <tr>
            <td class="texto_informe2">&nbsp;Ciudad</td>
            <td class="texto_informe1">&nbsp;<span class="cajas"><?echo $ciudad?></span></td>
          </tr>
          <tr>
            <td class="texto_informe2">&nbsp;Actividad</td>
            <td class="texto_informe1">&nbsp;<span class="cajas"><?echo $destino_actividad?></span></td>
          </tr>
        </table>
      <? ?></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><span class="texto_informe1">ORIGEN DE LA MATERIA PRIMA: &quot;ADJUNTO EN TRAZABILIDAD DEL PRODUCTO&quot;<br />
        Los productos y lotes cumplen con los requizitos zoosanitario del pa&iacute;s de destino<br />
              <span class="cajas">
              <? echo $pais;
		?>
            </span> y con los PPC del HACCP del establecimiento. </span></div><br></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center" class="texto_informe2">Firma Autorizada que avala esta certificaci&oacute;n<br />
           
		    <? 
		
		
		
		$sql="SELECT * from apro_part_paking where id_paking_relacion = $id_paking_relacion ";
		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
		if($cuantos){
		while ($row=mysql_fetch_array($rest)){
		$id_usuario =$row[id_usuario]; 
		$firma=crea_firma($link,$id_usuario);
		echo $firma;
		}
		}else{
		$firma=crea_firma($link,$id_usuario);
		echo $firma;
		}
			?>
      </div></td>
    </tr>
  </table>
</form>
  
  <tr>
    <td width="636" height="76" valign="top">
	
 