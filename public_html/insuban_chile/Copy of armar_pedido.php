<?

//foreach( $HTTP_POST_VARS as $key => $value ) { $$key=$value;}
//foreach( $HTTP_GET_VARS as $key => $value ) {$$key=$value;}

if (isset($codigo)) {
$codigo_bd=$codigo;
$sqlb="SELECT  * from cruce_tablas AS ct, producto AS p where ct.id_cruce_tablas = $codigo_bd and ct.id_producto = p.id_producto";
$resulbt=mysql_query($sqlb);
$cuantosb=mysql_num_rows($resulbt);

while ($rowb=mysql_fetch_array($resulbt))
{ 
$id_cruce_tablasb=$rowb[id_cruce_tablas];
$id_especieb=$rowb[id_especie];
$id_productob=$rowb[id_producto];
$productob=$rowb[producto];
$id_calibreb=$rowb[id_calibre];
}
}


if (isset($codigo2)) {
$codigo_bd2=$codigo2;
$sqlb="SELECT  * from cruce_tablas AS ct, producto AS p where ct.id_cruce_tablas = $codigo_bd2 and ct.id_producto = p.id_producto";
$resulbt=mysql_query($sqlb);
$cuantosb=mysql_num_rows($resulbt);

while ($rowb=mysql_fetch_array($resulbt))
{ 
$id_cruce_tablasb2=$rowb[id_cruce_tablas];
$id_especieb2=$rowb[id_especie];
$id_productob2=$rowb[id_producto];
$productob2=$rowb[producto];
$id_calibreb2=$rowb[id_calibre];
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

function Verifica_datos2(){
codigo2=document.getElementById("codigo2");
frm=document.getElementById("form1");
frm.action="?modulo=armar_pedido.php&codigo2=" + codigo2.value;
frm.submit();
return true;
}

</script>
</head>
<body>
<form name="form1" id="form1" method="post" action="">
  <table width="893" border="1">
    <tr>
      <td width="213">codigo
        <input name="codigo" type="text" id="codigo" value="<? echo $codigo_bd;?>" onblur="Verifica_datos();" /></td>
      <td width="329">Producto
      <input name="producto" type="text" id="producto" value="<? echo $productob?>" size="40" /></td>
      <td width="329">calibre
      <input name="calibre" type="text" id="calibre" value="<? echo $id_calibreb?>" /></td>
    </tr>
    <tr>    </tr>
    <tr>
      <td>codigo
      <input name="codigo2" type="text" id="codigo2" value="<? echo $codigo_bd2;?>" onblur="Verifica_datos2();" /></td>
      <td>Producto
      <input name="producto2" type="text" id="producto2" value="<? echo $productob2?>" size="40" /></td>
      <td>calibre
      <input name="calibre2" type="text" id="calibre2" value="<? echo $id_calibreb2?>" /></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>

</form>

</body>
</html>
