<?
if($_POST[ver]){ 

$date=date(c); // Obtener fecha de registro

$str1 = $_POST[encargado];
$str2 = $_POST[bandeja];
$str3 = $_POST[operaria];
$str4 = $_POST[grupo];
$str5 = $_POST[cantidad];

$str = array("$str1","$str2","$str3","$str4","$str5");


   include("../datos/connection.php");
   mysql_select_db("$database", $con);
   
   mysql_query("INSERT IGNORE INTO proceso_encargado SET idEncargado= '$str1', fecha='$date', n_bandeja='$str2', n_bidon='1', cantidad='$str5', idGrupo='$str4', idOperario='$str3', iniciales='1', codigo='0$str[0]$str[1]$str[2]$str[3]$str[4]', origen='1' " , $con);
}
?>
<form method="post" action="">
<table>
<th>ENCARGADO</th><th>BANDEJA</th><th>OPERARIA</th><th>GRUPO</th><th>CANTIDAD</th>
<tr>
	<td><select name="encargado" id="encargado" size="1" style="width: 200px; height: 24px; background-color: pink" >	
		   	<?
		   	require("../datos/connection.php");
			mysql_select_db("$database", $con);

			$results3 = mysql_query("SELECT * FROM encargados ");
			echo "<option value='0'>".Seleccione."</option>\n";
				while ($opcion = mysql_fetch_array($results3)) {
				$valor1 = $opcion[idencargados];	
			 	$valor2 = $opcion[nombre];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";
			 }?>
			 </select></td>

	<td><input type="text" name="bandeja" style="width: 50px; height: 24px"></td>

	<td><select name="operaria" size="1" style="width: 200px; height: 24px; background-color: pink" >	
		   	<?
		   	require("../datos/connection.php");
			mysql_select_db("$database", $con);

			$results3 = mysql_query("SELECT * FROM operarias ");
			echo "<option value='0'>".Seleccione."</option>\n";
				while ($opcion = mysql_fetch_array($results3)) {
				$valor1 = $opcion[idoperarias];	
			 	$valor2 = $opcion[nombre];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";
			 }?>
			 </select></td>

	<td><select name="grupo" size="1" style="width: 200px; height: 24px" >	
		   	<?
		   	require("../datos/connection.php");
			mysql_select_db("$database", $con);

			$results3 = mysql_query("SELECT * FROM grupo ");
			echo "<option value='0'>".Seleccione."</option>\n";
				while ($opcion = mysql_fetch_array($results3)) {
				$valor1 = $opcion[idgrupo];	
			 	$valor2 = $opcion[grupo];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";
			 }?>
			 </select></td>

	<td><input type="text" name="cantidad" value="50" style="width: 50px; height: 24px; background-color: pink" ></td>
	<td><input type="submit" name="ver" value="CREAR"></td>
	</tr>
</table>	
</form>
<br>
<form action="ejemplo.php" method="post" target="blank">
CODIGO DE BARRAS:
    <input name="codigo" type="text" value="<? echo $str[0],$str[1],$str[2],$str[3],$str[4] ?>" style="background-color:#CCF"/>
    <input type="submit" value="Generar"  />
</form>