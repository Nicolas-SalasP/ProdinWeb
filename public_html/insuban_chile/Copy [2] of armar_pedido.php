<?
if($agregarp){
$fech_ingreso_pedido=format_fecha_sin_hora($fech_ingreso_pedido);
$fech_despacho_pedido=format_fecha_sin_hora($fech_despacho_pedido);

$sql_p="insert into pedido (id_destinos,fech_ingreso_pedido,fech_despacho_pedido) values ('$id_destinos','$fech_ingreso_pedido','$fech_despacho_pedido')";
 // $result_p=mysql_query($sql_p,$link);



}

//echo date("d-m-Y H:i:s");
//foreach( $HTTP_POST_VARS as $key => $value ) { $$key=$value;}
//foreach( $HTTP_GET_VARS as $key => $value ) {$$key=$value;}

if (isset($codigo)) {
$codigo_bd=$codigo;
$sqlb="SELECT  * from cruce_tablas AS ct, producto AS p where ct.id_cruce_tablas = $codigo_bd and ct.id_producto = p.id_producto";
$resulbt=mysql_query($sqlb);
$cuantosb=mysql_num_rows($resulbt);

if($cuantosb){

while ($rowb=mysql_fetch_array($resulbt))
{ 
$id_cruce_tablasb=$rowb[id_cruce_tablas];
$id_especieb=$rowb[id_especie];
$id_productob=$rowb[id_producto];
$productob=$rowb[producto];
$id_calibreb=$rowb[id_calibre];
}
}
}

?>
<html>
<head>
<script language="javascript" type="text/javascript">
function Verifica_datos(){
codigo=document.getElementById("codigo");
frm=document.getElementById("form1");
frm.action="?modulo=armar_pedido.php&codigo=" + codigo.value;
frm.submit();
return true;
}
</script>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
</head>
<body>
<form name="form1" id="form1" method="post" action="">
  <table width="619" border="1">
    <tr>
      <td colspan="2" nowrap>Ingresar Pedido </td>
      <td nowrap><div align="center">Folio Pedido</div></td>
    </tr>
    <tr>
      <td nowrap>&nbsp;</td>
      <td nowrap>&nbsp;</td>
      <td nowrap>&nbsp;<? echo $folio_pedido?></td>
    </tr>
    <tr>
      <td width="234" nowrap>Cliente</td>
      <td width="235" nowrap>Fecha de Inicio </td>
      <td width="128" nowrap>Fecha de Despacho </td>
    </tr>
    <tr>
      <td nowrap>&nbsp;
        <? 
		$destinos= crea_destinos($link,$row[id_destinos]);
		echo $destinos;
	  ?></td>
      <td nowrap><input name="fech_ingreso_pedido" type="text" class="cajas" value="<? echo $fech_ingreso_pedido?>" size="10" maxlength="10" />
        <a href="javascript:show_Calendario('form1.fech_ingreso_pedido');" >Ver</a></td>
      <td nowrap><input name="fech_despacho_pedido" type="text" class="cajas" value="<? echo $fech_despacho_pedido?>" size="10" maxlength="10" />
        <a href="javascript:show_Calendario('form1.fech_despacho_pedido');" >Ver</a></td>
    </tr>
    <tr>
      <td colspan="3" nowrap><div align="center">
        <input name="agregarp" type="submit" id="agregarp" value="Agregar Pedido">
      </div></td>
    </tr>
    <tr>
      <td colspan="3" nowrap><table width="469" border="1">
        <tr>
          <td width="71">Codigo Interno</td>
          <td width="241">Producto</td>
          <td width="44">Calibre</td>
          <td width="91">Metro</td>
          <td width="55">Cantidad</td>
        </tr>
        <tr>
          <td><input name="codigo" type="text" id="codigo" onBlur="Verifica_datos();" value="<? echo $codigo_bd;?>" size="10" maxlength="10" /></td>
          <td><input name="producto" type="text" id="producto" value="<? echo $productob?>" size="40" /></td>
          <td><input name="calibre" type="text" id="calibre" value="<? echo $id_calibreb?>" size="5" /></td>
          <td><input name="metro" type="text" id="metro" value="<? echo $metrob?>" size="5" /></td>
          <td><input name="cantidad" type="text" id="cantidad" value="<? echo $cantidadb?>" size="5" /></td>
        </tr>
      </table>      </td>
    </tr>
  </table>

</form>

</body>
</html>
