<?
require "../lib/conexion2.php";
//require( 'lib/session_admin.php');
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../lib/funciones.php";

if($pickin){
$sql="SELECT * FROM etiquetados_folios AS e, paking AS pk where pk.id_etiquetados_folios = e.id_etiquetados_folios and pk.folio_piking = $pickin";
$result=mysql_query($sql);	
$cuantos=mysql_num_rows($result);
}
//echo "sql -> $sql<br>";
//echo "Cantidad $cuantos";
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
									<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Utiles</span>
								</a>
						</div>
					</header>

<form id="form1" name="form1" method="post" action="">
<table width="100%" border="1">
  <tr>
    <td width="600"><b>Ingresar Nº de Picking para revisar si algun folio PT tiene trazabilidad incorrecta, segun fecha de termino</b></td>
    <td width="144"><input name="pickin" type="textarea" id="pickin" value="<? echo $pickin?>"></td>
    <td width="70"><input type="submit" name="consultar" id="consultar" value="Consultar"></td>
  </tr>
</table>
<?
if($cuantos){
$i=0;
while ($row=mysql_fetch_array($result))
    { 
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$f_termino=format_fecha_sin_hora($row[f_termino]);

//echo "$f_termino";
	
	$sqltrazabilidad="SELECT * FROM folios_mat AS fm where fm.id_etiquetados_folios = '$id_etiquetados_folios' ";
	//$sqltrazabilidad="SELECT * FROM folios_mat AS fm, etiquetados_folios AS e where fm.id_etiquetados_folios = '$id_etiquetados_folios' fm.id_etiquetados_folios = e.id_etiquetados_folios";
	$resulttrazabilidad=mysql_query($sqltrazabilidad);	
	$cuantostrazabilidad=mysql_num_rows($resulttrazabilidad);
//	echo "sqltrazabilidad -> $sqltrazabilidad<br>";
//	echo "trazabilidad $trazabilidad";
	
	if ($rowtrazabilidad=mysql_fetch_array($resulttrazabilidad))
    { 
	$id_mat=$rowtrazabilidad[id_mat];
	//echo "id_mat $id_mat<br>";
	$largo=strlen($id_mat);
	if($largo != 9){
	$id_mat_prima_nacional=$id_mat;
	//echo "id_mat_prima_nacional $id_mat_prima_nacional ";
	
	$sqltn="SELECT * FROM mat_prima_nacional where id_mat_prima_nacional = '$id_mat_prima_nacional'";
	$resultn=mysql_query($sqltn);	
	$cuantosn=mysql_num_rows($resultn);
	//echo "cuantosn -> $cuantosn<br>";
	
	if ($rown=mysql_fetch_array($resultn))
    { 
	
	$fecha_salida=format_fecha_sin_hora($rown[fecha_salida]);
	//$fecha_faena=format_fecha_sin_hora($rown[fecha_faena]);
	
//	echo "F$fecha_salida<br>";
	
	if($fecha_salida < $f_elaboracion){
	$i++;
	echo "$i EL FOLIO PTN <b>$id_etiquetados_folios</b> TIENE PROBLEMAS CON LA TRAZABILIDAD<br>";	
	}
	
	}
	
	}else{
	$id_mat_prima_importada =$id_mat;
	//echo "id_mat_prima_importada $id_mat_prima_importada ";
	$sqlti="SELECT * FROM mat_prima_importada where id_mat_prima_importada = '$id_mat_prima_importada'";
	$resulti=mysql_query($sqlti);	
	$cuantosi=mysql_num_rows($resulti);
	//echo "cuantosi -> $cuantosi<br>";
	if ($rowi=mysql_fetch_array($resulti))
    { 
	//$fecha_salida=format_fecha_sin_hora($rowi[fecha_salida]);
	$fecha_salida=format_fecha_sin_hora($rowi[fecha_salida]);
	//echo "S$fecha_salida<br>";
	
	if($fecha_salida < $f_elaboracion){
	echo "EL FOLIO PTI <b>$id_etiquetados_folios</b> TIENE PROBLEMAS CON LA TRAZABILIDAD<br>";		
	}
	}
	
	}
	
	}
	}
}
?>

</form>