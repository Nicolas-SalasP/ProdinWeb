<?
$sql="SELECT d.destinos,ped.id_pedidos, ped.fech_ingreso_pedido, ped.fecha_prioridad from
etiquetados_folios as etf,
pedido as ped,
destinos as d
where etf.id_pedidos = ped.id_pedidos and etf.id_destinos = d.id_destinos and etf.ano = 2018 and etf.id_estado_folio = 7 GROUP BY ped.fecha_prioridad ORDER BY ped.fecha_prioridad desc";
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



<script>
window.onload = detectarCarga;
function detectarCarga(){
   document.getElementById("carga").style.display="none";
}</script>

<div id="carga">
  <img height="80" width="80" border="0" src="jpg/cargando.gif" />
</div>

<script src="http://code.jquery.com/jquery-latest.min.js"></script> 
<style>
.resaltar{background-color:#FF0;}
</style> 
  <script type='text/javascript' >
    $.expr[':'].icontains = function(obj, index, meta, stack){
    return (obj.textContent || obj.innerText || jQuery(obj).text() || '').toLowerCase().indexOf(meta[3].toLowerCase()) >= 0;
    };
    $(document).ready(function(){   
        $('#buscador').keyup(function(){
                     buscar = $(this).val();
                     $('#lista tr').removeClass('resaltar');
                            if(jQuery.trim(buscar) != ''){
                               $("#lista tr:icontains('" + buscar + "')").addClass('resaltar');
                            }
            });
    });   
 </script> 

<p>Buscar :<input name="buscador" id="buscador" type="text" /></p>


<form id="form1" name="form1" method="post" action="">
<table width="684" height="99" border="0" align="center">
  <tr>
    <td width="535" height="11" valign="top"><span class="titulo">Listado de Pedidos Anteriores</span></td>
    <td width="139" valign="top">&nbsp;
	<? if($permiso47 == 1 and $nivel_usua == 1){?>
	<a href="?modulo=pedido_listar.php" class="titulo">Volver</a>
	<? } ?>
	</td>
  </tr>
  <tr>
    <td height="19" colspan="2" valign="top">
	  <div align="center">

	    <table  id="lista" width="678" border="1" align="center" cellpadding="0" cellspacing="0">
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
              <a href="?modulo=pedido_modificar_h.php&id_ped=<?echo $row[id_pedidos]?>"><?echo $row[destinos]?></a>&nbsp;&nbsp;<span class="style3"><? if(!$cuantoc) { echo "(*)"; }?></span></td>
            <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=pedido_modificar_h.php&id_ped=<?echo $row[id_pedidos]?>"><?echo $fech_ingreso_pedido?></a>
              <div align="center"><a href="?modulo=pedido_modificar_h.php&id_ped=<?echo $row[id_pedidos]?>"></a></div></td>
            <td nowrap="NOWRAP" bgcolor="<? echo $color?>" class="cajas">&nbsp;
              <?   echo "$fecha_prioridad"; ?></td>
          </tr><? }?>
	      </table>	 </td>
  </tr>

</table>
</form>