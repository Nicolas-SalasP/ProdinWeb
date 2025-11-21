<? 
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

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
   
   if(!$n_bandeja){
	$n_bandeja=0;   
   }
   if(!$guia_despacho){
	   $guia_despacho=0;
   }

   $sql_nuevo="insert into etiquetados_folios  (id_etiquetados_folios,id_producto,ano,id_calibre,id_cruce_tablas,id_especie,id_unidad_medida,id_caract_producto,id_caract_envases,id_medidas_productos,id_envases,id_origen,f_elaboracion,id_operarios,contenido_unidades,id_estado_folio,id_procedencia,n_bandeja,guia_despacho,fech_generada_inicio) values ($id_etiquetados_folios_siguiente,$id_producto2,'$fhoy',$id_calibre,$codigonuevo,$id_especie,$id_unidad_medida,$id_caract_producto,$id_caract_envases,$id_medidas_productos,$id_envases,$id_origen,'$f_elaboracion1',$id_operarios,'$contenido_unidades',1,'N','$n_bandeja','$guia_despacho','$fech_generada_inicio')";
//echo "--->$sql_nuevo<br>";
  $result_nuevo=mysql_query($sql_nuevo,$link);

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
      <td width="118" class="titulo">N&deg; Guia Despacho</td>
      <td width="435"><input name="guia_despacho" type="text" class="cajas" id="guia_despacho" value="<? echo $guia_despacho?>" size="30" maxlength="30"></td>
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