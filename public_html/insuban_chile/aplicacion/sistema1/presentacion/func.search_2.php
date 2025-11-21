<?php
		require("../datos/connection.php");
		mysql_select_db("$database", $con);

			$query2=mysql_query("SELECT rem.id, rem.fecha, pro.producto, org.origen, rem.n_bidon, rem.n_mallas, rem.f_faena, rem.idgrupo2, rem.f_salida_produccion,org.id_origen, pro.id_producto FROM remojo As rem, origenes As org, producto As pro
				where org.id_origen = rem.procedencia
				and pro.id_producto = rem.producto ORDER BY id ASC ", $con);

			while ($row2=mysql_fetch_array($query2)) {

				$fecha=$row2[1];
				$prod=$row2[2];
				$org=$row2[3];
				$ffa=$row2[6];
				$grp=$row2[7];
				$fecha_prod=$row2[8];
				$id_org=$row2[9];
				$id_prod=$row2[10];
			}?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Proceso Uno</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/navbar.css" rel="stylesheet">

    <style type="text/css">
   
   th {
      background: yellow;
   }

	</style>

<script type="text/JavaScript">

function preguntar(id){
 
   if (confirm('¿Esta seguro que desea eliminar el registro ' + id + '?'))
   //Redireccionamos si das a aceptar
     window.location.href = "../negocio/delete_rem.php?id=" + id; //página web a la que te redirecciona si confirmas la eliminación
//else
  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
 //   alert('No se ha podido eliminar el registro...')
}
</script>
  </head>
  <body>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>



<div class="container">
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" >Proceso Uno Remojo</a>
          </div>

        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">

<form action='../negocio/insert.php' method="POST">		
	<table border="1" >
	<tr>
		   <th>Fecha</th>
		   <th>Producto</th>
		   <th>Origen</th>
		   <th>N&ordm; Bidon</th>
		   <th>Unidades</th>
		   <th>Factura/Guia</th>		   
	</tr>

		<tr>
		<td><input type="date" name="fecha" value="<?echo $fecha ?>" ></td>

		<td><select name="producto" size="1" style="width: 190px; height: 24px" >	
		   	<?

			$con = mysql_connect("localhost", "prodinwe_stgo391", "391stgo.*.") or die ("Could not connect: " . mysql_error());
			mysql_select_db("prodinwe_insubanchile");

			$results3 = mysql_query("SELECT etf.id_producto, pro.producto
				FROM etiquetados_folios As etf,
				producto As pro
				where pro.id_producto = etf.id_producto 
				and etf.ano = '2017' group by PRODUCTO");
			echo "<option value=".$id_prod.">".$prod."</option>\n";
				while ($opcion = mysql_fetch_array($results3)) {
			 	$valor1 = $opcion[id_producto];
			 	$valor2 = $opcion[producto];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";
			 }?>
			 </select></td>

		<td><select name="procedencia" size="1" style="width: 100px; height: 24px"  >	
		   	<?
				$results3 = mysql_query("SELECT asp.id_origen, org.origen FROM planilla_registro_fecha_asig_produccion As asp, origenes As org
				where org.id_origen = asp.id_origen
				and asp.fecha_asig_producc between '2017-01-01' and '2019-12-30' group by origen ");
			echo "<option value=".$id_org.">".$org."</option>\n";
				while ($opcion = mysql_fetch_array($results3)) {
			 	$valor1 = $opcion[id_origen];
			 	$valor2 = $opcion[origen];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";
			 }?>
			 </select></td>
		<td><input type="text" name="query" style="width: 100px; height: 24px"  required></td>
		<td><input type="text" name="mallas" style="width: 100px; height: 24px"  required></td>
		<td><input type="text" name="factura" style="width: 100px; height: 24px"  required></td></table>

	<table border="1">	
	<tr>	   
		   <th>F/Faena</th>			  
		   <th>Grupo</th>
		   <th>F/Produccion</th> 
	</tr>	
		<td><input type="date" name="ffaena" value="<?echo $ffa; ?>" ></td>
		
		<td><SELECT name="grupo" size="1" style="width: 100px; height: 24px"  > 
			      <OPTION value="">Seleccione</OPTION>
			      <OPTION value="12">VERDE</OPTION> 
			      <OPTION value="11">AZUL</OPTION> 
			      <OPTION value="13">AMARILLO</OPTION>
			      <OPTION value="14">VERDE_BLANCO</OPTION> 			       
		   </SELECT></td>
		<td><input type="date" name="fproduccion" value="<?echo $fecha_prod; ?>" ></td></tr></table>
		<br>
<table >		
		<tr>
		<td><input type="submit" name="guarda" value="Registrar" class="btn btn-primary"></td>
		</tr>
</table>
</form>

      </div> <!-- /Jumbotron end -->


<?
require("../datos/connection.php");
mysql_select_db("$database", $con);

			$query2=mysql_query("SELECT rem.id, rem.fecha, pro.producto, org.origen, rem.n_bidon, rem.n_mallas, rem.f_faena, grp.grupo, rem.f_salida_produccion, rem.fact_guia FROM remojo As rem, origenes As org, producto As pro, grupo as grp where org.id_origen = rem.procedencia and grp.idgrupo = rem.idGrupo2 and pro.id_producto = rem.producto ORDER BY id DESC limit 300 ", $con);
			if($query2 == true) {

			echo "<div class='container'>";
			echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
			echo "<thead>";
			echo "<tr>
			      <th>F/PRODUCCION</th><th>PRODUCTO</th><th>ORIGEN</th><th>N_BIDON</th><th>Guia/factura</th><th>UNIDADES</th><th>F/FAENA</th><th>GRUPO</th><th>FECHA</th><th>ELIMINAR</th></tr>";
			echo "</thead>";      
			 while ($row2=mysql_fetch_array($query2)) {
			echo "<tbody>";
			   echo "<tr>
			      <td>$row2[8]</td><td>$row2[2]</td><td>$row2[3]</td><td>$row2[4]</td><td>$row2[9]</td><td>$row2[5]</td><td>$row2[6]</td><td>$row2[7]</td><td>$row2[1]</td><td><a href='#' onclick='preguntar($row2[0] )'>Eliminar</a></td>
			   </tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			}
			mysql_close($con);
			?>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>