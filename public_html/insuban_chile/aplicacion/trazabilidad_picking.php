<?
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Util_2017</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="#" class="logo">
									<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Utiles</span>
								</a>
						</div>
					</header>

<form id="form1" name="form1" method="post" action="">
  <table width="90%" border="0">
    <tr>
      <td>Ingrese N° Picking</td>
      <td><input name="picking" type="textarea" id="picking" size="10"  value="<? echo $picking ?>" /></td>
      <td><input name="buscar" type="submit" value="Buscar" /></td>
    </tr>
  </table>

<?

if($picking){

$sql="SELECT * FROM paking AS p, etiquetados_folios AS ef WHERE p.folio_piking =$picking AND p.id_etiquetados_folios = ef.id_etiquetados_folios group by ef.id_etiquetados_folios ";
$result=mysql_query($sql);	
$cuantos=mysql_num_rows($result);

if($cuantos){
while ($row=mysql_fetch_array($result)){
$id_etiquetados_folios=$row[id_etiquetados_folios];

    $sqltrazabilidad="SELECT * FROM folios_mat where id_etiquetados_folios = '$id_etiquetados_folios'" ;
	$resulttrazabilidad=mysql_query($sqltrazabilidad);	
	
	while ($rowtrazabilidad=mysql_fetch_array($resulttrazabilidad))
    { 
	$id_mat=$rowtrazabilidad[id_mat];
	
	$sqlti="SELECT * FROM mat_prima_importada where id_mat_prima_importada = '$id_mat'";
	$resulti=mysql_query($sqlti);
	$cuantosi=mysql_num_rows($resulti);
	
	if($cuantosi){
		
		echo "<table><tr><td>EL FOLIO PT N°</td><td><b>$id_etiquetados_folios</b></td><td>tiene trazabilidad importada.</td></tr></table>";
		
		
	}
	}//while ($rowtrazabilidad=mysql_fetch_array($resulttrazabilidad))
}//while ($row=mysql_fetch_array($result)){
}//if($cuantos){
}
?>
</form>

</body>
</html>
