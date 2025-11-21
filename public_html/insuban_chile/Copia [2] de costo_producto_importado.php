<?

if($ingresar_costossssss)
{
$fech_generada_inicio =date("Y-m-d H:i:s");
 //buscar id_etiquetados_folios iguales a la factura
foreach ($_POST as $key => $value)
{
	
 $dat=split("-",$key); 
 //echo "key $key , Value $value <br>"; 
  if ($dat[0] == 'valor_unitario')
	{
    $id=$dat[1];
   	$valor_unitario=$_POST["valor_unitario-$id"];
	$sq_up="update etiquetados_folios set valor_unitario = '$valor_unitario', fech_generada_inicio = 'fech_generada_inicio' where id_cruce_tablas = $id and factura_importada = $factura_importada";
	$result_cruce=mysql_query($sq_up);

//echo "valor_cmpi = '$valor_unitario' - cruce_tablas_id = $id and comprobante_num = $factura_importada<br>";
 $sq_up="update mat_prima_importada set valor_cmpi = '$valor_unitario' where cruce_tablas_id = $id and comprobante_num = $factura_importada";
	$result_cruce=mysql_query($sq_up);
//echo "$sq_up<br>";
	}
  
}

$sql="SELECT * FROM mat_prima_importada where id_mat_prima_importada='$id_mpi' ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

//echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=costo_producto_importado.php&factura_importada=$factura_importada&origen=$origen&id_origen=$id_origen\">";
//exit;
}//if($ingresar_costo)



// Muestra todos los folios menos en el estado Anulado


/*$sql="SELECT COUNT(ef.factura_importada) AS cont, SUM(ef.contenido_unidades) AS sum_group_contenido, ef.id_etiquetados_folios AS id_etiquetados_folios, ef.id_cruce_tablas AS id_cruce_tablas, ef.valor_unitario AS valor_unitario  FROM  etiquetados_folios AS ef, cruce_tablas AS ct WHERE  ef.id_etiquetados_folios= ef.id_etiquetados_folios and ef.id_cruce_tablas = ct.id_cruce_tablas and ef.id_estado_folio != 5 and  id_procedencia = 'I' and ef.factura_importada = $factura_importada group by ef.id_cruce_tablas";*/
$sql="SELECT COUNT(ef.factura_importada) AS cont, SUM(ef.contenido_unidades) AS sum_group_contenido, ef.id_etiquetados_folios AS id_etiquetados_folios, ef.id_cruce_tablas AS id_cruce_tablas, o.origen AS origen, ef.valor_unitario AS valor_unitario  FROM  etiquetados_folios AS ef, cruce_tablas AS ct, origenes AS o WHERE  ef.id_etiquetados_folios= ef.id_etiquetados_folios and ef.id_cruce_tablas = ct.id_cruce_tablas and ef.id_estado_folio != 5 and  id_procedencia = 'I' and ef.id_origen = o.id_origen and ef.factura_importada = $factura_importada group by ef.id_origen";
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
    <td width="850" height="14" align="right" valign="top"><a href="?modulo=listar_costo_producto_importado.php">Volver</a></td>
    </tr>
    <tr>
    <td height="38" valign="top">
	
	
	<table width="625" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="21" colspan="7" bgcolor="#CCCCCC" class="titulo">&nbsp;Factura Importada:<span class="cajas"> <? echo $factura_importada?></span></td>
        </tr>
      <tr>
        <td width="20" height="21" align="center" bgcolor="#CCCCCC" class="titulo">N</td>
        <td width="66" height="21" align="center" bgcolor="#CCCCCC" class="titulo">ID</td>
        <td width="66" align="center" bgcolor="#CCCCCC" class="titulo">Bidones</td>
        <td width="95" align="center" bgcolor="#CCCCCC" class="titulo">Origenes</td>
        <td width="96" align="center" bgcolor="#CCCCCC" class="titulo">Contenido</td>
        <td width="154" align="center" bgcolor="#CCCCCC" class="titulo">Costo  PL</td>
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
	$valor_unitario=$row[valor_unitario];
	
	$total_folios+= $cantidad_bidones;
	$total_contenido+=$cantidad_contenido;
	//echo $id_fajapallet;
	?>
    
      <tr>
        <td height="21" align="center" class="cajas"><? echo $i;?></td>
        <td align="center" class="cajas"><? 
		echo $id_cruce_tablasid;	
		
		?></td>
        <td align="center" class="cajas"><? 
		echo $cantidad_bidones;	
		
		?>
          <input type="hidden" name="cantidad_bidones" id="cantidad_bidones2" value="<? echo $cantidad_bidones?>" /></td>
        <td align="center" class="cajas"><? echo $row[origen]?>
          <input type="hidden" name="id_origen-<? echo $id_origen?>" id="id_origen" value="<? echo $id_origen?>" /></td>
        <td align="center" class="cajas">
        <?  echo $cantidad_contenido;  	?>
        
         <input type="hidden" name="cantidad_contenido-<? echo $id_cruce_tablasid?>" id="cantidad_contenido" value="<? echo $cantidad_contenido?>" />
        </td>
        <td align="center" class="cajas">
        $<input name="valor_unitario-<? echo $id_cruce_tablasid?>" type="text" class="estilo_cajon_buscar_contacto" id="valor_unitario" value="<? echo $row[valor_unitario]?>" size="10" maxlength="10" /></td>
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
         
        <input type="submit" name="ingresar_costo" id="ingresar_costo" value="Modificar Costos">
        </td>
    </tr>
</table>
</form>