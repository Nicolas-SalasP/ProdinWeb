<?

if($ingresar_costos)
{
$fech_generada_inicio =date("Y-m-d H:i:s");



 foreach ($_POST as $key => $value)
{

 $dat=split("-",$key); 
 //echo "key $key , Value $value <br>"; 
  if ($dat[0] == 'valor_unitario')
	{
    $id=$dat[1];
   	$valor_unitario2=$_POST["valor_unitario-$id"];
	$valor_indice2=$_POST["valor_indicein-$id"];
	$id_tipo_calculo2=$_POST["id_tipo_calculoin-$id"];
	$id_cruce_tablas2=$_POST["id_cruce_tablasin-$id"];
	$id_origen2=$_POST["id_origen-$id"];
	
	//echo "$id_cruce_tablas2 - $id_origen2 - $id_tipo_calculo2 - $valor_indice2 - $valor_unitario2<br>";
	
		
	
	$sql_folios="SELECT * FROM etiquetados_folios where id_origen='$id_origen2' and factura_importada='$factura_importada' and id_cruce_tablas = '$id_cruce_tablas2'";
	$result_folios=mysql_query($sql_folios);
    $cuantos=mysql_num_rows($result_folios); 
	echo "cuantos $cuantos<br>";
	while ($row_folios=mysql_fetch_array($result_folios))
    { 
	$id_etiquetados_folios2222=$row_folios[id_etiquetados_folios];
	$contenido_unidadessss=$row_folios[contenido_unidades];
	$id_cruce_tablasetiq=$row_folios[id_cruce_tablas];
	$id_procedenciaimportado=$row_folios[id_procedencia];
	//$total_result=$contenido_unidadessss * $valor_unitario2;
	
	if($id_procedenciaimportado == 'I'){
	//if($id_tipo_calculo2 == 3){
	$resul_valor_unitario2 = $valor_unitario2 * 1;
	}
    
	//if($id_tipo_calculo2 == 4){
	//$resul_valor_unitario2 = $total_result * 1;
    //}
	
	 // echo "$id_etiquetados_folios2222 - $contenido_unidadessss -  $valor_unitario2 -  $resul_valor_unitario2 - $valor_indice2  - $id_tipo_calculo2 - $fech_generada_inicio - $id_origen2 $factura_importada - $id_cruce_tablas2<br>";
	
	$sq_up="update etiquetados_folios set total_ponderado = '$resul_valor_unitario2', valor_indice = '$valor_indice2', id_tipo_calculo = 3, fech_generada_inicio = '$fech_generada_inicio' where id_etiquetados_folios = '$id_etiquetados_folios2222'";
	$result_cruce=mysql_query($sq_up);
	//echo "sq_up $sq_up<br>";
	// valorizar materia prima importada
	
	$sql_folios_mpi="SELECT * FROM mat_prima_importada where comprobante_num = '$factura_importada' and etiquetados_folios_id = '$id_etiquetados_folios2222' and cruce_tablas_id = '$id_cruce_tablasetiq'";
	$result_folios_mpi=mysql_query($sql_folios_mpi);
    $cuantos_folios_mpi=mysql_num_rows($result_folios_mpi); 
	//echo "-> $sql_folios_mpi<br><br><br><br><br>";
	while ($row_folios_mpi=mysql_fetch_array($result_folios_mpi))
    { 
	$sq_up_import="update mat_prima_importada set valor_cmpi  = '$resul_valor_unitario2' where comprobante_num = '$factura_importada' and etiquetados_folios_id = '$id_etiquetados_folios2222' and cruce_tablas_id = '$id_cruce_tablas2'";
	$result_sq_up_import=mysql_query($sq_up_import);
	//echo "-> $sq_up_import<br>";
	}
	
	}//while ($row=mysql_fetch_array($result))
	
	
 
	

//echo "valor_cmpi = '$valor_unitario' - cruce_tablas_id = $id and comprobante_num = $factura_importada<br>";
    //$sq_up="update mat_prima_importada set valor_cmpi = '$valor_unitario' where cruce_tablas_id = $id and comprobante_num = $factura_importada";
	//$result_cruce=mysql_query($sq_up);
//echo "$sq_up<br>";
	}
  
}

//$sql="SELECT * FROM mat_prima_importada where id_mat_prima_importada='$id_mpi' ";
//$result=mysql_query($sql);
//$cuantos=mysql_num_rows($result);

//echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=costo_producto_importado.php&factura_importada=$factura_importada&origen=$origen&id_origen=$id_origen\">";
//exit;
}//if($ingresar_costo)


$sql="SELECT COUNT(ef.id_etiquetados_folios) AS cont, SUM(ef.contenido_unidades) AS sum_group_contenido, ef.id_cruce_tablas AS id_cruce_tablas, o.id_origen AS id_origen, o.origen AS origen, ef.total_ponderado  AS valor_unitario from etiquetados_folios AS ef, origenes AS o where ef.id_etiquetados_folios= ef.id_etiquetados_folios and ef.id_origen = o.id_origen and ef.id_estado_folio != 5 and ef.id_procedencia = 'I' and ef.factura_importada = $factura_importada and ef.id_origen = $id_origen group by ef.id_cruce_tablas ";
$result=mysql_query($sql);
$cuantos2=mysql_num_rows($result);

?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.estilo_cajon_buscar_contacto {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="856" height="219" border="0" align="center">
  <tr>
    <td width="850" height="14" align="right" valign="top"><a href="?modulo=muestra_origen_factura.php&factura_importada=<? echo $factura_importada?>&anob=<? echo $anob?>">Volver</a></td>
    </tr>
    <tr>
    <td height="38" valign="top">
	
	
	<table width="625" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="21" colspan="7" bgcolor="#CCCCCC" class="titulo">&nbsp;Facturassss Importada:<span class="cajas"> <? echo $factura_importada?></span></td>
        </tr>
      <tr>
        <td width="20" height="21" align="center" bgcolor="#CCCCCC" class="titulo">N</td>
        <td width="66" height="21" align="center" bgcolor="#CCCCCC" class="titulo">ID</td>
        <td width="66" align="center" bgcolor="#CCCCCC" class="titulo">Bidones</td>
        <td width="95" align="center" bgcolor="#CCCCCC" class="titulo">Origenes</td>
        <td width="96" align="center" bgcolor="#CCCCCC" class="titulo">Contenido</td>
        <td width="154" align="center" bgcolor="#CCCCCC" class="titulo">Costo  CPL</td>
        <td width="114" align="center" bgcolor="#CCCCCC" class="titulo">Total</td>
        </tr>
<?


	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$i++;
	$id_cruce_tablasid=$row[id_cruce_tablas];
	$id_etiquetados_foliossid=$row[id_etiquetados_folios];
	$id_origen=$row[id_origen];
	$cantidad_bidones=$row[cont];
	$cantidad_contenido=$row[sum_group_contenido];
	//$valor_unitario=$row[valor_unitario];
	
	$total_folios+= $cantidad_bidones;
	$total_contenido+=$cantidad_contenido;
	//echo $id_fajapallet;
	?>
    
      <tr>
        <td height="21" align="center" class="cajas"><? echo $i;?></td>
        <td align="center" class="cajas">
		<? 
		echo $id_cruce_tablasid;	
		
		$sql_indice="SELECT * FROM cruce_tablas where id_cruce_tablas = $id_cruce_tablasid ";
		$result_indice=mysql_query($sql_indice);
		if ($row_in=mysql_fetch_array($result_indice))
   		{ 
		$id_cruce_tablasin=$row_in[id_cruce_tablas];
		$valor_indicein=$row_in[valor_indice];
		$id_tipo_calculoin=$row_in[id_tipo_calculo];
		}
		?>
      <input type="hidden" name="valor_indicein-<? echo $id_cruce_tablasid?>" id="valor_indicein" value="<? echo $valor_indicein?>" />
      <input type="hidden" name="id_tipo_calculoin-<? echo $id_cruce_tablasid?>" id="id_tipo_calculoin" value="<? echo $id_tipo_calculoin?>" />
       <input type="hidden" name="id_cruce_tablasin-<? echo $id_cruce_tablasid?>" id="id_cruce_tablasin" value="<? echo $id_cruce_tablasin?>" />
          
        </td>
        <td align="center" class="cajas"><? 
		echo $cantidad_bidones;	
		
		?>
          <input type="hidden" name="cantidad_bidones" id="cantidad_bidones2" value="<? echo $cantidad_bidones?>" /></td>
        <td align="center" class="cajas"><? echo $row[origen]?>
          <input type="hidden" name="id_origen-<? echo $id_cruce_tablasid?>" id="id_origen" value="<? echo $id_origen?>" /></td>
        <td align="center" class="cajas">
        <?  echo $cantidad_contenido;  	?>
        
         <input type="hidden" name="cantidad_contenido-<? echo $id_cruce_tablasid?>" id="cantidad_contenido" value="<? echo $cantidad_contenido?>" />
        </td>
        <td align="center" class="cajas">
        <? if($permiso53 == 1){?>
        $<input name="valor_unitario-<? echo $id_cruce_tablasid?>" type="text" class="estilo_cajon_buscar_contacto" id="valor_unitario" value="<? echo $row[valor_unitario]?>" size="10" maxlength="10" />
        <?}else{?>
        Sin Valores
        <? }?>
        </td>
        <td align="right" class="cajas">
		$ <? //multiplicacion del contenido
		
		$resultmultiplicacion=$cantidad_contenido * $valor_unitario;
		//echo $respuest=number_format($resultmultiplicacion,0,",",".");
		echo $resultmultiplicacion;
			
		//$miReal = $resultmultiplicacion; 
		//$miEnteronuevo = (int) $miReal;
		//echo "otro $miEnteronuevo";
		
		//$numero = 1234.5678;
		//$numero_format = number_format($numero, 2, ','); //2 es la cantidad de decimales
		// 1234.57
		$resultmultiplicaciontotal+=$resultmultiplicacion;
		
		?>&nbsp;&nbsp;</td>
        </tr>
		<? }?>
      <tr>
        <td height="21" align="center" bgcolor="#CCCCCC" class="cajas">&nbsp;</td>
        <td height="21" colspan="2" align="center" bgcolor="#CCCCCC" class="titulo">Totales</td>
        <td align="center" bgcolor="#CCCCCC" class="titulo"><? echo $total_folios?></td>
        <td align="center" bgcolor="#CCCCCC" class="titulo"><? 
		echo $total_contenido;
		?></td>
        <td bgcolor="#CCCCCC" class="cajas">&nbsp;</td>
        <td align="right" bgcolor="#CCCCCC" class="cajas"><span class="titulo">$&nbsp;<? echo $resultsuma=number_format($resultmultiplicaciontotal,0,",",".");?></span>&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td height="21" colspan="7" align="left" class="cajas"><span class="titulo">Nota:</span> Para dejar costos sin valor debe ingresar N&deg;: 0.</td>
        </tr>
     
    </table>	</td>
  </tr>
    <tr>
      <td height="102" align="center">
         <? if($permiso53 == 1){?>
        <input type="submit" name="ingresar_costos" id="ingresar_costos" value="Modificar Costos">
         <? } ?>
        </td>
    </tr>
</table>
</form>