<?



$sql="SELECT ef.fech_generada_fin AS fech_generada_fin, ef.id_cruce_tablas AS id_cruce_tablas FROM etiquetados_folios AS ef, producto AS pro, estado_folio AS est, operarios AS ope
where ef.id_operarios = ope.id_operarios and ef.id_producto = pro.id_producto and ef.id_estado_folio = est.id_estado_folio and ef.id_producto != 0 and ef.fech_generada_fin != '0000-00-00 00:00:00'  group by ef.fech_generada_fin";
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
.numero {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="609" height="102" border="0" align="center">
  <tr>
    <td width="603" height="1" valign="top" bgcolor="#CCCCCC" class="titulo">Listado Historial Exportado a txt delimitados por ;</td>
    </tr>
  <tr>
    <td height="7" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td height="86" valign="top">

	<table width="606" border="1" align="center" cellpadding="0" cellspacing="0">
	
      <tr>
        <td width="205" height="14" nowrap bgcolor="#CCCCCC" class="titulo">Fecha de exportacion
Manager          
  <div align="center"></div></td>
        <td nowrap bgcolor="#CCCCCC" class="titulo">Exportar a Txt</td>
        </tr>
      <? 
	
	
/*	// Example 1
$pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
$pieces = explode(" ", $pizza);
echo $pieces[0]; // piece1
echo $pieces[1]; // piece2*/


	while ($row=mysql_fetch_array($result))
    { 
	$fech_generada_fin=$row[fech_generada_fin];
	?>
      <tr>
        <td height="20" nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas"><a href="?modulo=detalle_exportado_manager.php&amp;fech_generada_fin=<?echo $row[fech_generada_fin]?>"><?
		echo $row[fech_generada_fin]
		
		?>
        </a></td>
        <td height="20" nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">
              <a href="excel_detalle_exportado_manager.php?fech_generada_fin=<? echo $fech_generada_fin ?>" target="_blank">TXT</a>
         <? echo $fech_generada_fin2?>
        </td>
        </tr>
<? 			
  		}//fin if
?>
    </table>

	
	<a href="javascript: document.form1.submit();">
	    <label></label>
        </a>
		</center>
	  <div align="center"></div></td>
  </tr>
</table>
</form>