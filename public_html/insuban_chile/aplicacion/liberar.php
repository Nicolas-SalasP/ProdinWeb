<?
$folio_d= $_POST['folio_d'];
$pedido= $_POST['pedido'];
//$codigo= $_POST['cruce_tablas'];
//$cantb= $_POST['cantidad'];

require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

//Creamos la sentencia SQL y la ejecutamos
$sSQL="UPDATE  etiquetados_folios  set id_pedidos='0' and fpicking='0000-00-00'  where id_etiquetados_folios=$folio_d";
mysql_query($sSQL);
$sSQL2="DELETE from pedido_armado_automatico  where  id_pedidos = $pedido and id_etiquetados_folios = $folio_d ";
mysql_query($sSQL2);

?>
<HTML>
<BODY>

<h3><div align="center">Liberado!</div></h3>
<h3><div align="center"><a href="aplicacion2.php">Cerrar</a></h3></div>

</BODY>
</HTML>