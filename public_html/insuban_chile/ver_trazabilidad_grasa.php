<? 
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

if($borrar_x){
$sql_modificar="UPDATE  etiquetados_folios set factura_importada ='' where id_etiquetados_folios=$id_etiquetados_folios";
$rest=mysql_query($sql_modificar);
$mensaje_modificacion = "Trazavilidad eliminada con Exito";


?>


<script languaje="javascript">
/*top.opener.document.location = top.opener.document.location;*/
window.opener.document.location.replace('<? echo $url;?>/sistema.php?modulo=ejemplo_etiquetas_folios.php&id_etf2=<? echo  $id_etiquetados_folios;?>');
</script>
<script language="javascript">
window.close();
</script><?
}
if($modificar_x){
$sql_modificar="UPDATE  etiquetados_folios set guia_despacho = '$guia_despacho' where id_etiquetados_folios=$id_etiquetados_folios";
$rest=mysql_query($sql_modificar);
$mensaje_modificacion = "Trazavilidad Modificado con Exito";
?>

<script languaje="javascript">
/*top.opener.document.location = top.opener.document.location;*/
window.opener.document.location.replace('http://200.63.96.220/~insubac/<? echo $url;?>/sistema.php?modulo=ejemplo_etiquetas_folios.php&id_etf2=<? echo  $id_etiquetados_folios;?>');
</script>
<script language="javascript">
window.close();
</script>

<?
}


$sql="SELECT * FROM etiquetados_folios AS ef, destinos AS d WHERE ef.id_etiquetados_folios='$id_etiquetados_folios' and ef.id_etiquetados_folios != 0 and ef.id_destinos = d.id_destinos";
$result=mysql_query($sql);

?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
-->
</style>



<form id="form1" name="form1" method="post" action="">
<?
while ($row=mysql_fetch_array($result))
    { 
?>
  <table width="563" border="0" align="center">
    <tr>
      <td class="titulo">N&ordm; Guia Despacho</td>
      <td width="435"><input name="guia_despacho" type="text" class="cajas" id="guia_despacho" value="<? echo $row[guia_despacho]?>" size="60" maxlength="60" /></td>
    </tr>
    <tr>
      <td width="118" rowspan="2" class="titulo">&nbsp;</td>
      <td>&nbsp;<? if($mensaje_modificacion)echo $mensaje_modificacion;?></td>
    </tr>
    <tr>
      <td><input type="image" src="jpg/borrar.jpg" name="borrar" onclick="document.forms['form1'].submit" />
/
  <input type="image" src="jpg/modificar.jpg" name="modificar" onclick="document.forms['form1'].submit" /></td>
    </tr>
  </table>
<? }?>
</form>	

