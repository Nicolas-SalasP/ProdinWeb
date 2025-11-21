<?
	//count( DISTINCT ef.id_etiquetados_folios) AS cf
	$sql="SELECT d.destinos,p.id_pedidos, p.fech_ingreso_pedido, p.fecha_prioridad 
FROM 
pedido AS p,
pedido_tabla AS pt,
destinos AS d
WHERE p.id_pedidos = p.id_pedidos and
p.id_destinos = d.id_destinos and p.folio_piking != 0
group by p.fecha_prioridad  asc";
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
.style1 {
	color: #00FF00;
	font-size: 9px;
}
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="684" height="60" border="0" align="center">
  <tr>
    <td height="11" valign="top"><span class="titulo">Listado de Pedidos </span><a href="?modulo=pedido_historial.php"></a></td>
    </tr>
  <tr>
    <td height="40" valign="top">
	  <div align="center">

	    <table width="678" border="1" align="center" cellpadding="0" cellspacing="0">
	      <tr>
	        <td width="75" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;Folio Pedido </td>
            <td nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;Cliente</td>
            <td width="95" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;Fecha Ingreso </td>
            <td width="132" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">&nbsp;Fecha Despacho  </td>
          </tr>
	      <?
	
	
	while ($row=mysql_fetch_array($result))
    { 
	$fech_ingreso_pedido=format_fecha_sin_hora($row[fech_ingreso_pedido]);
	$id_pedidos=$row[id_pedidos];
	$id_tipo_prioridad=$row[id_tipo_prioridad];
	$fecha_prioridad=format_fecha2($row[fecha_prioridad]);
	
	
	
	?>
	      <tr>
	        <td bgcolor="<? echo $color?>" height="22" nowrap="NOWRAP" class="cajas"><div align="center"><? echo $row[id_pedidos];?></div></td>
            <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;
              <a href="?modulo=pedido_historial.php&id_ped=<?echo $row[id_pedidos]?>"><?echo $row[destinos]?></a></td>
            <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=pedido_modificar.php&id_ped=<?echo $row[id_pedidos]?>"><?echo $fech_ingreso_pedido?></a>
              <div align="center"><a href="?modulo=pedido_historial.php&id_ped=<?echo $row[id_pedidos]?>"></a></div></td>
            <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;
              <?   echo "$fecha_prioridad"; ?></td>
          </tr><? }?>
	      </table>	 </td>
  </tr>
</table>
</form>