<?
	if($out_idTabla){
		$sql="select pd.id_cruce_tablas,p.producto, sum(pd.contenido_unidades) as Unidades, Count(pd.id_ctl_produccion_diaria) as Bidones";
		$sql.=" ,(pd.Costo_medio*pd.Contenido_unidades) as Total_Costo from Ctl_Produccion_Diaria_Det pd, cruce_tablas ct, producto p";
		$sql.=" where pd.id_cruce_tablas = ct.id_cruce_tablas";
		$sql.=" And ct.id_producto = p.id_producto";
		$sql.=" And pd.id_ctl_produccion_diaria= $out_idTabla";
		$sql.=" Group by p.producto";	
		$result=mysql_query($sql);
	}		
?>
<style type="text/css">
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
		    <td colspan="4" align="right"><a href="?modulo=produccion_diaria_exporta_manager.php">Volver</a></td>
    	</tr>
		<tr>
		   <td> Produccion de fecha: <? echo $out_fecProd ?></td>
		</tr>
  		<tr>
			<td bgcolor="#999999" align="left">Producto</td>
			<td bgcolor="#999999" align="right">Unidades</td>
			<td bgcolor="#999999" align="right">Bidones</td>
			<td bgcolor="#999999" align="right">Costo</td>
  		</tr>
        <?
	  	while ($row=mysql_fetch_array($result))
		   {	
		?>
			<tr>
				<td><? echo $row['producto'] ?></td>
				<td><? echo $row['Unidades'] ?></td>
				<td><? echo $row['Bidones'] ?></td>
				<td><? echo $row['Total_Costo'] ?></td>
			</tr>
		<? } ?>		
	</table>