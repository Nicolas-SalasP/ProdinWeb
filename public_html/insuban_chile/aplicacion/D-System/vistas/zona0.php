<?php
require("../datos/conexion.php");
mysql_select_db("$database", $con);

	$query2=mysql_query("SELECT rem.id, rem.fecha, pro.producto, org.origen, rem.n_bidon, rem.n_mallas, rem.f_faena, rem.idgrupo2, rem.f_salida_produccion FROM remojo As rem, origenes As org, producto As pro
		where org.id_origen = rem.procedencia
		and pro.id_producto = rem.producto ORDER BY id ASC ", $con);

		while ($row2=mysql_fetch_array($query2)) {

				$fecha=$row2[1];
				$prod=$row2[2];
				$org=$row2[3];
				$ffa=$row2[6];
				$grp=$row2[7];
				$fecha_prod=$row2[8];
}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="../img/ico.png">

    <title>Prod-System</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min1.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/jumbotron-narrow.css" rel="stylesheet">

  </head>
<script type="text/JavaScript">
function preguntar(id){

    if (confirm('¿Esta seguro que desea eliminar este registro?'))
     window.location.href = "../negocio/delete_rem.php?id=" + id; //página web a la que te redirecciona si confirmas la eliminación
}</script>

<body>
	<div class="container">
		<div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="">ENTREGA MP</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Insuban SpA</h3>
      </div>

      <div class="jumbotron">

      	    <form class="form-horizontal" action='../negocio/insert.php' method="POST">

            <label class="col-lg-3 control-label">Fecha</label>
            <div class="col-xs-4">
                  <input type="date" class="form-control" name="fecha" value="<?echo $fecha ?>" >
            </div>
            <div class="clearfix"></div>

            <label class="col-lg-3 control-label">Producto</label>
            <div class="col-xs-6">
                <select class="form-control" name="producto">
    <?
      $conn = mysql_connect("localhost", "root", "123456") or die ("Could not connect: " . mysql_error());
        mysql_select_db("prodin-test");

        $results6 = mysql_query("SELECT etf.id_producto, pro.producto
				FROM etiquetados_folios As etf,
				producto As pro
				where pro.id_producto = etf.id_producto 
				and etf.ano between 2017 and 2018 group by PRODUCTO");
			echo "<option value='0'>".Seleccione."</option>\n";
				while ($opcion = mysql_fetch_array($results6)) {
			 	$valor1 = $opcion[id_producto];
			 	$valor2 = $opcion[producto];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";

        mysql_close($conn);
      }?>
                </select>
            </div>
            <div class="clearfix"></div>

            <label class="col-lg-3 control-label">Origen</label>
            <div class="col-xs-6">
                <select class="form-control" name="origen">
    <?
      $conn = mysql_connect("localhost", "root", "123456") or die ("Could not connect: " . mysql_error());
        mysql_select_db("prodin-test");

        $results6 = mysql_query("SELECT asp.id_origen, org.origen 
        		FROM planilla_registro_fecha_asig_produccion As asp, origenes As org
				where org.id_origen = asp.id_origen
				and asp.fecha_asig_producc between '2017-01-01' and '2018-12-30' group by origen ");
			echo "<option value='0'>".Seleccione."</option>\n";
				while ($opcion = mysql_fetch_array($results6)) {
			 	$valor1 = $opcion[id_origen];
			 	$valor2 = $opcion[origen];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";

        mysql_close($conn);
      }?>
                </select>
            </div>
            <div class="clearfix"></div>


            <label class="col-lg-3 control-label">F/Faena</label>
            <div class="col-xs-4">
                  <input type="date" class="form-control" name="ffaena" value="<?echo $ffa ?>" >
            </div>
            <div class="clearfix"></div>

            <label class="col-lg-3 control-label">Grupo</label>
            <div class="col-xs-4">
            <SELECT class="form-control" name="grupo"> 
			      <OPTION value="">Seleccione</OPTION>
			      <OPTION value="12">ROJO</OPTION> 
			      <OPTION value="14">VERDE</OPTION> 
			      <OPTION value="11">AZUL</OPTION> 
			      <OPTION value="13">AMARILLO</OPTION> 
		   </SELECT>
           </div>
           <div class="clearfix"></div>

            <label class="col-lg-3 control-label">F/Produccion</label>
            <div class="col-xs-4">
                  <input type="date" class="form-control" name="fproduccion" value="<?echo $fecha_prod ?>" >
            </div>
            <div class="clearfix"></div>

           <label class="col-lg-3 control-label">Bidon Nº</label>
            <div class="col-xs-3">
                  <input type="text" class="form-control" name="bidon" required>
            </div>
            <div class="clearfix"></div>

            <label class="col-lg-3 control-label">Cantidad</label>
            <div class="col-xs-3">
                  <input type="text" class="form-control" name="cantidad" required>
            </div>
            <div class="clearfix"></div>
<br><br>
             <div>
                  <input type="submit" name="guarda" value="Registrar" />
            </div>


		</form><!-- form -->
      </div><!-- jumbotron -->

   	<div>
      	<?
require("../datos/conexion.php");
mysql_select_db("$database", $con);

			$query2=mysql_query("SELECT rem.id, rem.fecha, pro.producto, org.origen, rem.n_bidon, rem.n_mallas, rem.f_faena, grp.grupo, rem.f_salida_produccion FROM remojo As rem, origenes As org, producto As pro, grupo as grp where org.id_origen = rem.procedencia and grp.idgrupo = rem.idGrupo2 and pro.id_producto = rem.producto ORDER BY id DESC ", $con);
			if($query2 == true) {

			echo "<table class='table table-striped' > \n";
			echo "<tr>
			      <th>FECHA</th><th>PRODUCTO</th><th>ORIGEN</th><th>N_BIDON</th><th>UNIDADES</th><th>F/FAENA</th><th>GRUPO</th><th>F/PRODUCCION</th><th></th></tr> \n";
			 while ($row2=mysql_fetch_array($query2)) {
			   echo "<tr>
			      <td>$row2[1]</td><td>$row2[2]</td><td>$row2[3]</td><td>$row2[4]</td><td>$row2[5]</td><td>$row2[6]</td><td>$row2[7]</td><td>$row2[8]</td><td><a href='#' onclick='preguntar($row2[0] )'>Eliminar</a></td>
			   </tr> \n";
			}
			echo "</table> \n";
			}
			mysql_close($con);
			?>

      </div>




	</div><!-- container -->
</body>
