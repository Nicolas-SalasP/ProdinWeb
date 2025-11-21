<?
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

if($folio){
$sql="SELECT * FROM pedido_armado_automatico WHERE id_etiquetados_folios=$folio";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Util_2017</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Header -->
					<header id="header">
						<div class="inner">
							<!-- Logo -->
								<a href="#" class="logo">
									<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Liberar Folio</span>
								</a>
						</div>
					</header>

<form id="form1" name="form1" method="post" action="">
<table width="100%" border="1">
  <tr>
    <td width="180"><b>Ingresar Folio: </b></td>
    <td width="144"><input name="folio" type="textarea" id="folio" value="<? echo $folio?>"></td>
    <td width="70"><input type="submit" name="consultar" id="consultar" value="Consultar"></td>
  </tr>
</table>
<?
if($cuantos){
while ($row=mysql_fetch_array($result))
    { 
	$id_pedidos=$row[id_pedidos];
	$id_cruce_tablas=$row[id_cruce_tablas];
	$id_etiquetados_folios=$row[id_etiquetados_folios];


$sql2="SELECT cantidadb FROM pedido_tabla where id_pedidos=$id_pedidos and id_cruce_tablas=$id_cruce_tablas";
$result2=mysql_query($sql2);
$row2=mysql_fetch_array($result2);

$cantidadb=$row2[cantidadb];

	echo "<table>";
	echo "<tr>";
	echo "<td>PEDIDO</td><td>CODIGO</td><td>FOLIO</td><td>CANTIDAD</td>";
	echo "</tr>";
	echo "<tr>";	
	echo "<td>$id_pedidos</td><td>$id_cruce_tablas</td><td>$id_etiquetados_folios</td><td>$cantidadb</td>";
	echo "</tr>";		
	echo "</table>";
	 } 
}
?>
</form>
<form id="form2" name="form2" method="post" action="liberar.php">
<table width="100%" border="1">
  <tr>
    <td width="140"><b>¿Desea liberar este folio?</b></td>
    <td width="20"><input name="folio_d" type="textarea" value="<? echo $folio?>"></td>
    <td width="20"><input type="submit" value="SI"></td>
    <input name="pedido" type="hidden" value="<? echo $id_pedidos?>">
    <input name="cruce_tablas" type="hidden"  value="<? echo $id_cruce_tablas?>">
    <input name="cantidad" type="hidden"  value="<? echo $cantidadb?>">
  </tr>
</table>
