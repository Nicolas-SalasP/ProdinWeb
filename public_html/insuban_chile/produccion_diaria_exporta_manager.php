<?
	/* Selecciona todas las producciones pendintes de traspaso.
	--   Procedimiento que genera reg. en tabla: prodinwe_insubanchile.Ctl_ProduccionDiaria
	--   Programado en Cpanel "Cron trabajos" --> 23:45 todos los dias "wget -nv -O /dev/null http://190.107.176.73/~prodinwe/produccion_diaria_traspaso.php"
	*/

	$sql="select Id_ctl_Produccion_Diaria_Car,Fecha_produccion, Fecha_sistema, 'DISPONIBLE' as Estado from Ctl_Produccion_Diaria_Car Where Id_Ctl_Estados = 100 order by Fecha_produccion desc";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
?>

<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 15px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
	font-weight: bold;
}
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="609" height="102" border="0" align="center">
  <tr> <td width="603" height="1" valign="top" bgcolor="#CCCCCC" class="titulo">Produccion disponible para traspaso a MANAGER</td>  </tr>
  <tr> <td height="7" valign="top">&nbsp;</td> </tr>
  <tr>
    <td height="86" valign="top">
		<table width="606" border="1" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="205" height="14" nowrap bgcolor="#CCCCCC" class="titulo">Fecha produccion <div align="center"></div></td>
				<td width="205" height="14" nowrap bgcolor="#CCCCCC" class="titulo">Fecha generacion <div align="center"></div></td>		
				<td width="205" height="14" nowrap bgcolor="#CCCCCC" class="titulo">Estado traspaso <div align="center"></div></td>		
				<td nowrap bgcolor="#CCCCCC" class="titulo">Exportar a Txt</td>
        	</tr>
      		<? 
			while ($row=mysql_fetch_array($result))
			{ 
			?>
      		<tr>
        		<td height="20" nowrap="NOWRAP" bgcolor="<? echo $color ?>" class="cajas"><a href="?modulo=produccion_diaria_exporta_manager_detalle.php&amp;out_idTabla=<? echo $row[Id_ctl_Produccion_Diaria_Car] ?>&out_fecProd=<? echo $row[Fecha_produccion] ?>"> <? echo $row[Fecha_produccion] ?> </a>
				</td> 
				<!-- Fecha sistema -->
        		<td height="20" nowrap="NOWRAP" class="cajas"><? echo $row[Fecha_sistema] ?> </a>
				</td>
				<!-- Estado -->
        		<td height="20" nowrap="NOWRAP" class="cajas"><? echo $row[Estado] ?> </a>
				</td>
				
				<!-- Exportar a Txt -->	
				<td height="20" nowrap="NOWRAP" bgcolor="<? echo $color ?>" class="cajas">
					<a href="excel_produccion_diaria_exporta_manager.php?out_idTabla=<? echo $row[Id_ctl_Produccion_Diaria_Car]?>&out_fecProduccion=<? echo $row[Fecha_produccion]?>">TXT</a>				
                </td>
        	</tr>
			<? 			
			}//fin while
			?>
    	</table>
		<a href="javascript: document.form1.submit();">
			<label></label>
		</a>
		</center>
		<div align="center"></div>
	</td>
  </tr>
</table>
</form>