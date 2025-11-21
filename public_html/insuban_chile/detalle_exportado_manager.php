

<?

if($fech_generada_fin){

$sql2="SELECT ef.id_cruce_tablas AS id_cruce_tablas, SUM(ef.contenido_unidades) AS total_contenido, ef.id_procedencia AS id_procedencia, ef.factura_importada AS factura_importada, ef.total_ponderado AS total_ponderado   FROM etiquetados_folios AS ef, cruce_tablas AS ct WHERE ef.id_cruce_tablas = ct.id_cruce_tablas and fech_generada_inicio != '0000-00-00 00:00:00' and fech_generada_fin = '$fech_generada_fin' order by ef.id_cruce_tablas";	
$result2=mysql_query($sql2);
$cuantos2=mysql_num_rows($result2);

//echo "cuantos2 $cuantos2";
	
$sql="SELECT ef.id_cruce_tablas AS id_cruce_tablas, SUM(ef.contenido_unidades) AS total_contenido, ef.id_procedencia AS id_procedencia, ef.factura_importada AS factura_importada, ef.total_ponderado AS total_ponderado   FROM etiquetados_folios AS ef, cruce_tablas AS ct WHERE ef.id_cruce_tablas = ct.id_cruce_tablas and fech_generada_inicio != '0000-00-00 00:00:00' and fech_generada_fin = '$fech_generada_fin' group by ef.id_cruce_tablas";	
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);



?><style type="text/css">
<!--
.texto_informes {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #000;
}
-->
</style>



 

     <table width="731" border="0">
     
     <tr>
    <td colspan="4" align="right"><a href="?modulo=listado_exportado_manager.php">Volver</a></td>
    </tr>

  <tr>
    <td width="126" bgcolor="#999999">Bodega</td>
    <td width="218" bgcolor="#999999">Codigo Producto</td>
    <td width="210" bgcolor="#999999">Contenido</td>
    <td width="149" bgcolor="#999999">Costo</td>
  </tr>
  <?
  $color = "#000000";$i = 0;
while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_cruce_tablas=$row[id_cruce_tablas];
	$total_contenido=$row[total_contenido];
	$id_procedencia=$row[id_procedencia];
	$factura_importada=$row[factura_importada];
	$i++;
	//echo "- id_cruce_tablas: $id_cruce_tablas - total_contenido: $total_contenido<br>"; 
	$sql3="SELECT ef.id_cruce_tablas AS id_cruce_tablas, ef.id_etiquetados_folios AS id_etiquetados_folios, ef.contenido_unidades AS contenido_unidades, ef.total_ponderado  AS total_ponderado  FROM etiquetados_folios AS ef, cruce_tablas AS ct WHERE ef.id_cruce_tablas = ct.id_cruce_tablas and fech_generada_inicio != '0000-00-00 00:00:00' and fech_generada_fin = '$fech_generada_fin' and ef.id_cruce_tablas = $id_cruce_tablas";
	$result3=mysql_query($sql3);
	$cuantosdd=mysql_num_rows($result3);
	
	$total_ponderado_total=0;
	?>
          <?
   while ($row3=mysql_fetch_array($result3))
   { 
         $contenido_unidades = $row3[contenido_unidades];
		 $id_etiquetados_folios = $row3[id_etiquetados_folios];
		 $total_ponderado = $row3[total_ponderado];
		 $aporte_por_material = $contenido_unidades / $total_contenido;
		 $ponderado = $total_ponderado *  $aporte_por_material;
		 $total_ponderado_total+=$ponderado;
		  
	 }
	
	 
	?>
   <tr class="texto_informes">
    <td bgcolor="<? echo $color?>">&nbsp;<? $bodega= "Bodega Insuban"; echo $bodega; ?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo "$id_cruce_tablas";?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo "$total_contenido";?></td>
    <td bgcolor="<? echo $color?>">&nbsp;<? echo "$total_ponderado_total";?></td>
  </tr> <?	 
	$sum+=$total_ponderado_total;
	}



?>
   <tr class="texto_informes">
     <td bgcolor="<? echo $color?>">&nbsp;</td>
     <td align="right" bgcolor="#CCCCCC" class="texto_informes">Total</td>
     <td bgcolor="#CCCCCC">&nbsp;<? echo $sum?></td>
     <td bgcolor="<? echo $color?>">&nbsp;</td>
   </tr>
<?   
   }
?>


 

</table>
   