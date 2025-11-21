<?
require("datos/connection.php");
mysql_select_db("$database", $con);

$resul1 = mysql_query("SELECT * FROM proceso_encargado pe
left outer join operarias as ope on ope.idoperarias = pe.idOperario
left outer join calibres as cal on cal.idcalibres = pe.idCalibre
left outer join encargados as enc on enc.idencargados = pe.idEncargado
left outer join origenes as org on org.id_origen = pe.origen
order by idproceso desc limit 1");
while ($bar = mysql_fetch_array($resul1)) {
$E=$bar[nombre];
$O=$bar[onombre];
$C=$bar[calibre];
$C1=$bar[idcalibres];
$O1=$bar[idOperario];
$E1=$bar[idEncargado];

}?>

<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

<style type="text/css">
	th {
		background-color: yellow;
	}
</style>


 </head>

<div class="content-box-large box-with-header">
<!-- Code... bloque1 -->

<?
if(isset($_POST[ver])){ 

$date=date(c); // Obtener fecha de registro

$str1 = $_POST[encargado];
$str2 = '01';
$str3 = $_POST[operaria];
$str4 = $_POST[calibre];
$str5 = $_POST[cantidad];
//$str6 = $_POST[origen];



$str = array("$str1","$str2","$str3","$str4","$str5","$str6");


   include("datos/connection.php");
   mysql_select_db("$database", $con);
   

   mysql_query("INSERT INTO proceso_encargado SET idEncargado= '$str1', n_bandeja='$str2', n_bidon='0', cantidad='$str5', idCalibre='$str4', idOperario='$str3', iniciales='0', codigo='$str[0]$str[2]$str[3]$str[5]$str[4]', origen='0' " , $con);



}
?>
<form method="post" action="">
<table>
<th>ENCARGADO</th><th>OPERARIA</th><th>CALIBRE</th><th>CANTIDAD</th>
<tr>
	<td><select name="encargado" id="encargado" size="1" style="width: 200px; height: 24px;">
		   	<?
		   	require("datos/connection.php");
			mysql_select_db("$database", $con);

			$results3 = mysql_query("SELECT * FROM encargados ");
			echo "<option value=".$E1.">".$E."</option>\n";
				while ($opcion = mysql_fetch_array($results3)) {
				$valor1 = $opcion[idencargados];	
			 	$valor2 = $opcion[nombre];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";
			 }?>
			 </select></td>

<!-- 	<td><input type="text" name="bandeja" value="<? echo $sum_band; ?>"	style="width: 78px; height: 24px"></td> -->

	<td><select name="operaria" size="1" style="width: 200px; height: 24px; " >	
		   	<?
		   	require("datos/connection.php");
			mysql_select_db("$database", $con);

			$results3 = mysql_query("SELECT * FROM operarias order by onombre asc");
			echo "<option value=".$O1.">".$O."</option>\n";
				while ($opcion = mysql_fetch_array($results3)) {
				$valor1 = $opcion[idoperarias];	
			 	$valor2 = $opcion[onombre];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";
			 }?>
			 </select></td>
<!--
	<td><select name="origen" id="origen" size="1" style="width: 200px; height: 24px;">
		   	<?
		   	require("datos/connection.php");
			mysql_select_db("$database", $con);

			$results3 = mysql_query("SELECT * FROM remojo as rem 
			left outer join origenes as org on org.id_origen = rem.procedencia group by rem.procedencia ");
			echo "<option value='0'>".Seleccione."</option>\n";
				while ($opcion = mysql_fetch_array($results3)) {
				$valor1 = $opcion[procedencia];	
			 	$valor2 = $opcion[origen];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";
			 }?>
			 </select></td>
-->
	<td><select name="calibre" size="1" style="width: 200px; height: 24px" >	
		   	<?
		   	require("datos/connection.php");
			mysql_select_db("$database", $con);

			$results3 = mysql_query("SELECT * FROM calibres ");
			echo "<option value=".$C1.">".$C."</option>\n";
				while ($opcion = mysql_fetch_array($results3)) {
				$valor1 = $opcion[idcalibres];	
			 	$valor2 = $opcion[calibre];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";
			 }?>
			 </select></td>

	<td><input type="text" name="cantidad" value="50" style="width: 80px; height: 24px; background-color: pink" >
	</td>
	<td><input type="submit" name="ver" value="CREAR"></td>
	</tr>
<tr>
<td><? 
$resul1 = mysql_query("SELECT * FROM proceso_encargado pe
left outer join operarias as ope on ope.idoperarias = pe.idOperario
left outer join calibres as cal on cal.idcalibres = pe.idCalibre
left outer join encargados as enc on enc.idencargados = pe.idEncargado
left outer join origenes as org on org.id_origen = pe.origen
order by idproceso desc limit 1");
while ($bar = mysql_fetch_array($resul1)) {
$E=$bar[nombre];
$O=$bar[onombre];
$OR=$bar[origen];
$C=$bar[calibre];
$F=date("Ymd");
$INI=$bar[iniciales1];
$idope=$bar[idOperario];
$n_ban=$bar[n_bandeja];
$cant=1;


}?>
</td></tr>
</table>	
</form>

<!-- Code... bloque1 -->

					</div>
		  		</div>
		  	</div>

		  	<div class="content-box-large">
<!-- Code... bloque2 -->		  	
<form action="ejemplo.php" method="post" target="popup"
	onsubmit="window.open('', 'popup', 'width = 800, height = 600, top=0, left=0, scrollbars=yes')">
CODIGO OPERARIA:
    <input name="codigo" type="text" value="<? echo $str[0],$str[2],$str[3],$str[4] ?>" style="background-color:#CCF"/>
    <input type="hidden" name="operaria" value="<? echo $O ?>">
    <input type="hidden" name="calibre" value="<? echo $C ?>">
    <input type="submit" value="Generar"  />
</form>

		
		  	</div>
		  </div>
		</div>
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2017 <a href='#'>Consola Administración</a>
            </div>
            
         </div>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>

