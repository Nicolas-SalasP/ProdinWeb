<?

$fip=format_fecha_sin_hora($fech_ingreso_pedido);
$ftp=format_fecha_sin_hora($fech_termino_pedido);
$fdp=format_fecha_sin_hora($fech_despacho_pedido);
$year=date("Y"); //año

if($agregarp){


$sql_ultimo_pedido="SELECT * FROM pedido where id_pedidos=id_pedidos ORDER BY id_pedidos desc LIMIT 1";
$result_ultimo_pedido=mysql_query($sql_ultimo_pedido);
$cuanto_ultimo_pedido=mysql_num_rows($result_ultimo_pedido);
echo "cuanto_ultimo_pedido $cuanto_ultimo_pedido<br>";

 if ($row_ultimo_pedido=mysql_fetch_array($result_ultimo_pedido))
 { 
 $id_pedidos=$row_ultimo_pedido[id_pedidos];
 $ultimoanorescatado=$row_ultimo_pedido[year];
 }
 
 
 if($ultimoanorescatado == $year){

 $id_pedidos=$row_ultimo_pedido[id_pedidos];
 $id_pedidos_siguiente=$id_pedidos+1;

}else{

 $id_pedidos=$rowul[id_pedidos];
 $id_pedidos_siguiente=$id_pedidos - $id_pedidos;
 $id_pedidos_siguiente++;
 
 $id_pedidos_siguiente_contar=strlen($id_pedidos_siguiente);
 
 if($id_pedidos_siguiente_contar == 1) $id_pedidos_siguiente="00000$id_pedidos_siguiente";
 if($id_pedidos_siguiente_contar == 2) $id_pedidos_siguiente="0000$id_pedidos_siguiente";
 if($id_pedidos_siguiente_contar == 3) $id_pedidos_siguiente="000$id_pedidos_siguiente";
 if($id_pedidos_siguiente_contar == 4) $id_pedidos_siguiente="00$id_pedidos_siguiente";
 if($id_pedidos_siguiente_contar == 5) $id_pedidos_siguiente="0$id_pedidos_siguiente";
 if($id_pedidos_siguiente_contar == 6) $id_pedidos_siguiente="$id_pedidos_siguiente";
 $anook=substr($year,2,4);
 $id_pedidos_siguiente=$anook.$id_pedidos_siguiente;
}
 
$sql_p="insert into pedido (id_pedidos,year,id_destinos,fech_ingreso_pedido,fech_despacho_pedido) values ('$id_pedidos_siguiente','$year','$id_destinos','$fip','$fdp')";
$result_p=mysql_query($sql_p,$link);
}

if($modificarp){
$sql_m="UPDATE  pedido set id_destinos='$id_destinos',fech_ingreso_pedido='$fip',fech_termino_pedido='ftpa',fech_despacho_pedido='$fdp' where id_pedidos=$id_pedidos";
echo "$sql_m";
$rest=mysql_query($sql_m);

}

if($grabarfilas){
$sql_p="insert into pedido_tabla (id_pedidos,id_cruce_tablasb) values ('$id_pedidos','$codigo')";
$result_p=mysql_query($sql_p,$link);
echo "sql_p $sql_p";
}

$sql="SELECT * FROM pedido where id_pedidos=id_pedidos ORDER BY id_pedidos desc LIMIT 1";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

?>
<script language="JavaScript"> 
function cambiar(esto)
{
	vista=document.getElementById(esto).style.display;
	if (vista=='none')
		vista='block';
	else
		vista='none';

	document.getElementById(esto).style.display = vista;
}
</script>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<form name="form1" id="form1" method="post" action="">
<?
if(!$nuevo){
while ($row=mysql_fetch_array($result))
      { 
	    $id_pedidos=$row[id_pedidos];
		$fech_ingreso_pedido=format_fecha_sin_hora($row[fech_ingreso_pedido]);
		$fech_termino_pedido=format_fecha_sin_hora($row[fech_termino_pedido]);
		$fech_despacho_pedido=format_fecha_sin_hora($row[fech_despacho_pedido]);
		?>
  <table width="619" border="1">
    <tr>
      <td colspan="3" nowrap> Pedido 
      <input name="id_pedidos" type="hidden" value="<?echo $row[id_pedidos]?>" /></td>
      <td nowrap><div align="center">Folio Pedido</div></td>
    </tr>
    <tr>
      <td nowrap>&nbsp;</td>
      <td colspan="2" nowrap>&nbsp;</td>
      <td nowrap>&nbsp;<? echo $id_pedidos?></td>
    </tr>
    <tr>
      <td width="231" nowrap>Cliente</td>
      <td width="133" nowrap>Fecha de Inicio </td>
      <td width="97" nowrap>Fecha Termino </td>
      <td width="130" nowrap>Fecha de Despacho </td>
    </tr>
    <tr>
      <td nowrap>&nbsp;
        <? 
		$destinos= crea_destinos($link,$row[id_destinos]);
		echo $destinos;
	  ?></td>
      <td nowrap><input name="fech_ingreso_pedido" type="text" class="cajas" value="<? echo $fech_ingreso_pedido?>" size="10" maxlength="10" />
        <a href="javascript:show_Calendario('form1.fech_ingreso_pedido');" >Ver</a></td>
      <td nowrap><input name="fech_termino_pedido" type="text" class="cajas" value="<? echo $fech_termino_pedido?>"  size="10" maxlength="10" />
        <a href="javascript:show_Calendario('form1.fech_termino_pedido');" >Ver</a></td>
      <td nowrap><input name="fech_despacho_pedido" type="text" class="cajas" value="<? echo $fech_despacho_pedido?>" size="10" maxlength="10" />
        <a href="javascript:show_Calendario('form1.fech_despacho_pedido');" >Ver</a></td>
    </tr>
  </table>
  <table width="621" border="1">
    <tr>
      <td width="611">&nbsp;</td>
    </tr>
  </table>
  <p>
    <? }
  }else{
  
?>
</p>
  <table width="619" border="1">
    <tr>
      <td colspan="3" nowrap>Ingresar Pedido </td>
      <td nowrap><div align="center">Folio Pedido</div></td>
    </tr>
    <tr>
      <td nowrap>&nbsp;</td>
      <td colspan="2" nowrap>&nbsp;</td>
      <td nowrap>&nbsp;Folio Sin Asignar</td>
    </tr>
    <tr>
      <td width="234" nowrap>Cliente</td>
      <td width="116" nowrap>Fecha de Inicio </td>
      <td width="117" nowrap>&nbsp;</td>
      <td width="128" nowrap>Fecha de Despacho </td>
    </tr>
    <tr>
      <td nowrap>&nbsp;
          <? 
		$destinos= crea_destinos($link,$row[id_destinos]);
		echo $destinos;
	  ?></td>
      <td nowrap><input name="fech_ingreso_pedido" type="text" class="cajas"  size="10" maxlength="10" />
        <a href="javascript:show_Calendario('form1.fech_ingreso_pedido');" >Ver</a></td>
      <td nowrap>&nbsp;</td>
      <td nowrap><input name="fech_despacho_pedido" type="text" class="cajas"  size="10" maxlength="10" />
        <a href="javascript:show_Calendario('form1.fech_despacho_pedido');" >Ver</a></td>
    </tr>
    <tr>
      <td colspan="4" nowrap><div align="center">
          <input name="agregarp" type="submit" id="agregarp" value="Agregar Pedido">
          <input name="cant" type="text" id="cant" value="<? echo $cant?>" size="5" maxlength="5" />
          <input name="crear" type="submit" id="crear" value="Agregar Fila" />
      </div></td>
    </tr>
  </table>

  <? }?><?
if(!$nuevo and $cuantos){
?>
  <tr>
    <td colspan="3" nowrap>
        <input name="modificarp" type="submit" id="modificarp" value="Modificar Pedido">
        <input name="nuevo" type="submit" id="nuevo" value="Nuevo Pedido">
     <input name="cant" type="text" id="cant" value="<? echo $cant?>" size="5" maxlength="5" />
            <input name="crear" type="submit" id="crear" value="Agregar Fila" />
	  <div id="error" style="display: none;"></div>
      <table width="618" border="1">
        <tr>
          <td>
		  
			  <? 
				for($i=1;$i<=$cant;$i++){
							//$unidad_medida= despliega_unidad_medida($link,0,$i);
			  ?>
		  <table width="405" border="1">
    <tr>
      <td width="213">codigo
        <input name="codigo" type="text" id="codigo" /></td>
      <td width="176"><input name="cantidad" type="text" id="cantidad" /></td>
      </tr>
  </table>
		  <?
		  //echo "$i $unidad_medida<br>";
		  }
		  ?></td>
        </tr>
      </table>
	  <input name="grabarfilas" type="submit" id="grabarfilas" value="Grabar"></td>
  </tr>

<? } ?>


</form>


