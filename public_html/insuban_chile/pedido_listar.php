<?
	//count( DISTINCT ef.id_etiquetados_folios) AS cf
$sql="SELECT d.destinos,p.id_pedidos, p.fech_ingreso_pedido, p.fecha_prioridad 
FROM pedido AS p
JOIN destinos AS d ON p.id_destinos = d.id_destinos
WHERE p.fech_ingreso_pedido != '0000-00-00' 
and p.folio_piking = 0 
and p.fech_envio_picking = '0000-00-00'
group by p.id_pedidos asc";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
	
	//echo "sql $sql<br>";
	
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
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; font-weight: bold; }
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="684" height="99" border="0" align="center">
  <tr>
    <td width="535" height="11" valign="top"><span class="titulo">Listado de Pedidos</span></td>
    <td width="139" valign="top">&nbsp;
	<? if($permiso47 == 1 and $nivel_usua == 1){?>
<!--	<a href="?modulo=pedido_listar_h.php" class="titulo">Pedidos Anteriores</a> -->
	<a href="?modulo=pedido_ingresar.php" class="titulo">Ingresar Nuevo Pedido</a>
	<? } ?>
	</td>
  </tr>
  <tr>
    <td height="19" colspan="2" valign="top">
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
	        <td bgcolor="<? echo $color?>" height="22" nowrap="NOWRAP" class="cajas"><div align="center"><? echo $row[id_pedidos];?></div></td>		<? 
			$sqc="SELECT * FROM pedido_tabla WHERE id_pedidos = $id_pedidos";	
			$resultc=mysql_query($sqc);
			$cuantoc=mysql_num_rows($resultc);
			
			$sqe="SELECT * FROM etiquetados_folios WHERE id_pedidos = $id_pedidos";	
			$resulte=mysql_query($sqe);
			$cuantoe=mysql_num_rows($resulte);
			
			?>
            <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;
              <a href="?modulo=pedido_modificar.php&id_ped=<?echo $row[id_pedidos]?>"><?echo $row[destinos]?></a>&nbsp;&nbsp;<span class="style3"><? if(!$cuantoc) { echo "(*)"; }?></span></td>
            <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=pedido_modificar.php&id_ped=<?echo $row[id_pedidos]?>"><?echo $fech_ingreso_pedido?></a>
              <div align="center"><a href="?modulo=pedido_modificar.php&id_ped=<?echo $row[id_pedidos]?>"></a></div></td>
            <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;
              <?   echo "$fecha_prioridad"; ?></td>
          </tr><? }?>
	      </table>	 </td>
  </tr>
  <tr>
    <td height="19" colspan="2" valign="top" class="cajas"><span class="style3">(*)</span> Pedidos Ingresados sin Codigos de Productos Asignados </td>
  </tr>
</table>
</form>