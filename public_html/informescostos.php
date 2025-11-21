<?
$localhost="190.107.176.73:3306";
$user="prodinwe_stgo391";
$pass="391stgo.*.";
$db="prodinwe_insubanchile";
$url="http://190.107.176.73/~prodinwe/insuban_chile";


//require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
//require "lib/funciones.php";

 $fech_generada_fin =date("Y-m-d H:i:s");
//if($cierre_costeo){
	
$sql="SELECT ef.id_cruce_tablas AS id_cruce_tablas, SUM(ef.contenido_unidades) AS total_contenido FROM etiquetados_folios AS ef, cruce_tablas AS ct WHERE ef.id_cruce_tablas = ct.id_cruce_tablas and fech_generada_inicio != '0000-00-00 00:00:00' and fech_generada_fin = '0000-00-00 00:00:00' and ef.id_estado_folio != 5 and ef.id_estado_folio != 6 and ef.id_estado_folio != 9 and ef.id_estado_folio != 0 and ef.id_estado_folio != 8 and ef.id_estado_folio != 4 and  ef.id_estado_folio != 10 and  ef.id_estado_folio != 7 group by ef.id_cruce_tablas";	
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

while ($row=mysql_fetch_array($result))
    { 
	$id_cruce_tablas=$row[id_cruce_tablas];
	$total_contenido=$row[total_contenido];
	//echo "- id_cruce_tablas: $id_cruce_tablas - total_contenido: $total_contenido<br>"; 
	//$sql3="SELECT ef.id_cruce_tablas AS id_cruce_tablas, ef.id_etiquetados_folios AS id_etiquetados_folios, ef.contenido_unidades AS contenido_unidades, ef.valor_unitario AS valor_unitario FROM etiquetados_folios AS ef, cruce_tablas AS ct WHERE ef.id_cruce_tablas = ct.id_cruce_tablas and fech_generada_inicio != '0000-00-00 00:00:00' and fech_generada_fin = '0000-00-00 00:00:00' and ef.id_estado_folio != 5 and ef.id_estado_folio != 6 and ef.id_estado_folio != 9 and ef.id_estado_folio != 0 and ef.id_estado_folio != 8 and ef.id_estado_folio != 4 and ef.id_procedencia = 'N' and ef.id_cruce_tablas = $id_cruce_tablas";
		$sql3="SELECT ef.id_cruce_tablas AS id_cruce_tablas, ef.id_etiquetados_folios AS id_etiquetados_folios, ef.contenido_unidades AS contenido_unidades, ef.valor_unitario AS valor_unitario, ef.total_ponderado AS total_ponderado  FROM etiquetados_folios AS ef, cruce_tablas AS ct WHERE ef.id_cruce_tablas = ct.id_cruce_tablas and fech_generada_inicio != '0000-00-00 00:00:00' and fech_generada_fin = '0000-00-00 00:00:00' and ef.id_estado_folio != 5 and ef.id_estado_folio != 6 and ef.id_estado_folio != 9 and ef.id_estado_folio != 0 and ef.id_estado_folio != 8 and ef.id_estado_folio != 4 and  ef.id_estado_folio != 10 and  ef.id_estado_folio != 7 and ef.id_cruce_tablas = $id_cruce_tablas";
	$result3=mysql_query($sql3);
	$total_ponderado_total=0;
	$cuantosssss=mysql_num_rows($result3);
   while ($row3=mysql_fetch_array($result3)) { 
         $contenido_unidades=$row3[contenido_unidades];
		 $id_etiquetados_folios=$row3[id_etiquetados_folios];
		 $total_ponderado=$row3[total_ponderado];
		 //echo "$id_etiquetados_folios contenido_unidades: $contenido_unidades - valor_unitario: $valor_unitario<br>";
		 $aporte_por_material = $contenido_unidades / $total_contenido;
		 $ponderado =$total_ponderado *  $aporte_por_material;
		 //echo "$aporte_por_material / $ponderado <br>";
		 //$contenido_unidades_total+=$contenido_unidades;
		$sqlupfec="UPDATE etiquetados_folios  set fech_generada_fin = '$fech_generada_fin' where id_etiquetados_folios  = $id_etiquetados_folios";
	    $resultfec=mysql_query($sqlupfec);   

		 $total_ponderado_total+=$ponderado;
	 }
	 
		 
	echo "ID Tablas $id_cruce_tablas [$cuantosssss] / contenido_unidades_total: $total_contenido / Total Ponderado: $total_ponderado_total<br>";
	}

echo "dddddddddddddddddddd";

//}



 

?>
<!--<form id="form1" name="form1" method="post" action="">
  <table width="634" border="1">
    <tr>
      <td width="624" height="28" align="center"><input type="submit" name="cierre_costeo" id="cierre_costeo" value="Generar Cierre  Costeo con Fecha <? //echo $fech_generada_fin?> "/>
     </td>
    </tr>
  </table>
</form>-->
