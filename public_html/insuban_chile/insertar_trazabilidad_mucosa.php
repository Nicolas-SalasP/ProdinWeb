<? 
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

//echo "id_procedencia $id_procedencia";

 $fhoy=date("Y"); 
 $fech_generada_inicio =date("Y-m-d H:i:s");
 if($grabar_x){
 
$sqlul="SELECT * FROM etiquetados_folios where id_etiquetados_folios=id_etiquetados_folios ORDER BY id_etiquetados_folios desc LIMIT 1";
$resultul=mysql_query($sqlul);

 while ($rowul=mysql_fetch_array($resultul))
 { 
 $id_etiquetados_folios=$rowul[id_etiquetados_folios];
 $id_etiquetados_folios_siguiente=$id_etiquetados_folios+1;
 //echo "$id_etiquetados_folios_siguiente <br>";
 }

  $dat2=split(" ",$f_elaboracion);
  $dat=split("-",$dat2[0]);
  $f_elaboracion1="$dat[2]-$dat[1]-$dat[0]";

  $dat3=split(" ",$f_inicio);
  $dat1=split("-",$dat3[0]);
  $f_inicio1="$dat1[2]-$dat1[1]-$dat1[0]";

  $dat4=split(" ",$f_termino);
  $dat6=split("-",$dat4[0]);
  $f_termino1="$dat6[2]-$dat6[1]-$dat6[0]";

  $dat5=split(" ",$fecha_ven);
  $dat7=split("-",$dat5[0]);
  $f_vencimiento1="$dat7[2]-$dat7[1]-$dat7[0]";
   
   if(!$factura_trazab){
	$factura_trazab=0;   
   }
   if(!$guia_despacho_trazab){
	   $guia_despacho_trazab=0;
   }

   $sql_nuevo="insert into etiquetados_folios  (id_etiquetados_folios,id_producto,ano,id_calibre,id_cruce_tablas,id_especie,id_unidad_medida,id_caract_producto,id_caract_envases,id_medidas_productos,id_envases,id_origen,f_elaboracion,f_inicio,f_termino,f_vencimiento,id_operarios,contenido_unidades,id_estado_folio,id_procedencia,factura_trazab,guia_despacho_trazab,fech_generada_inicio) values ($id_etiquetados_folios_siguiente,$id_producto2,'$fhoy',$id_calibre,$codigonuevo,$id_especie,$id_unidad_medida,$id_caract_producto,$id_caract_envases,$id_medidas_productos,$id_envases,$id_origen,'$f_elaboracion1','$f_inicio1','$f_termino1','$f_vencimiento1',$id_operarios,'$contenido_unidades',1,'N','$factura_trazab','$guia_despacho_trazab','$fech_generada_inicio')";
//echo "--->$sql_nuevo<br>";
  $result_nuevo=mysql_query($sql_nuevo,$link);

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//$sql="SELECT * FROM pedido WHERE id_pedidos = id_pedidos and  urgencia = 1";	
//$result=mysql_query($sql);
//$cuantos=mysql_num_rows($result);
//echo "cuantos $cuantos";
/*$sql="SELECT * FROM pedido WHERE id_pedidos = id_pedidos and fech_envio_picking = '0000-00-00' order by fecha_prioridad asc";	
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
while ($row=mysql_fetch_array($result))
{ 
 	 $id_pedidos2=$row[id_pedidos];
	 $id_destinos2=$row[id_destinos];
	 $fecha_prioridad2=$row[fecha_prioridad];
    
	 $dat4=split(" ",$fecha_prioridad2);
  	 $dat=split("-",$dat4[0]);
  	 $a=$dat[3];
  	 $b=$dat[2];
  	 $c=$dat[1];
  	 $d=$dat[0];

	$sql_destinos="SELECT * FROM destinos WHERE id_destinos = $id_destinos2";	
	$result_destinos=mysql_query($sql_destinos);

	if ($rowdestino_restric=mysql_fetch_array($result_destinos))
	{
	$sipp=$rowdestino_restric[restricfec];
    }
	
	//echo "si hay uno $f_elaboracionmes -  $c<br>";
	//echo "id_pedidos $id_pedidos2<br>";
	$sql_consul="SELECT * FROM pedido_tabla WHERE id_pedidos = $id_pedidos2";	
	$result_consul=mysql_query($sql_consul);
 	while ($rowp=mysql_fetch_array($result_consul))
    {
	 $id_pedido_tablas=$rowp[id_pedido_tablas];
	 $id_pedidos=$rowp[id_pedidos];
	 $id_cruce_tablas1=$rowp[id_cruce_tablas];
	 $cantidadb=$rowp[cantidadb];
	 
 	 $sql_consul2="SELECT * FROM pedido_armado_automatico  WHERE id_pedidos = $id_pedidos2 and id_cruce_tablas = $id_cruce_tablas1";
	 $result_consul2=mysql_query($sql_consul2);
	 $cant_resgistros=mysql_num_rows($result_consul2);
 
     //echo " <br>cantidadb $cantidadb - cant_resgistros $cant_resgistros<br>";
    // echo "id_cruce_tablas1 $id_cruce_tablas1  - codigonuevo $codigonuevo";
	
   if(!$sipp)
   {	 
      if($cantidadb != $cant_resgistros)
	  {
        if($id_cruce_tablas1 == $codigonuevo)
	 	{
		//echo "sipp $sipp //   f_elaboracionmes $f_elaboracionmes  fecha_prioridad2 $c<br>";
		
		$id_pedido_tablasw=$rowcant[id_pedido_tablas];
	 	$id_cruce_tablas2=$rowcant[id_cruce_tablas];
	    $sql_autom="insert into pedido_armado_automatico  (id_pedidos,id_pedido_tablas,id_cruce_tablas,id_etiquetados_folios) 
		values ('$id_pedidos','$id_pedido_tablas','$codigonuevo','$id_etiquetados_folios_siguiente')";
		$result_autom=mysql_query($sql_autom,$link);
 		$sql="UPDATE  etiquetados_folios set  id_pedidos='$id_pedidos2' where id_etiquetados_folios=$id_etiquetados_folios_siguiente";
	    $result=mysql_query($sql);

   	    }//if($id_cruce_tablas1 == $codigonuevo){
	  }//if($cant_resgistros != $cantidadb){
	  }
	  
	 }//while ($rowp=mysql_fetch_array($result_consul))
	// echo "<br>contador de vueltas $contador_vueltas<br>";
	}

*/
?>
<script languaje="javascript">
/*top.opener.document.location = top.opener.document.location;*/
window.opener.document.location.replace('<? echo $url;?>/sistema.php?modulo=ejemplo_etiquetas_folios.php');
</script>
<script language="javascript">
window.close();
</script>
<? }?>


	 
	 <style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.Estilo1 {font-size: 12px}
-->
</style>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="563" border="0" align="center">
    <tr>
      <td width="118" class="titulo">N&ordm; Factura</td>
      <td width="435"><input name="factura_trazab" type="text" class="cajas" id="factura_trazab" value="<? echo $factura_trazab?>" size="30" maxlength="30"></td>
    </tr>
    <tr>
      <td width="118" class="titulo">Guia Despacho</td>
      <td><input name="guia_despacho_trazab" type="text" class="cajas" id="guia_despacho_trazab" value="<? echo $guia_despacho_trazab?>" size="30" maxlength="30"></td>
    </tr>
  </table>
  <table width="88" border="0" align="center">
    <tr>
      <td width="82">
	  <input type="image" src="jpg/guardar.jpg" name="grabar" onClick="document.forms['form1'].submit">
	 </td>
    </tr>
  </table>
  <br>
</form>	
</body>