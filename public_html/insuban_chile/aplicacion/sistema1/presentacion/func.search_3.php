<?php
  session_start();
   
  // Controlo si el usuario ya está logueado en el sistema.
  if(isset($_SESSION['email'])){
    // Le doy la bienvenida al usuario.
#    echo 'BIENVENIDO <strong>' . $_SESSION['email'] . '</strong>, <a href="../cerrar-sesion.php">Cerrar Sesion</a>';
  }else{
    // Si no está logueado lo redireccion a la página de login.
    header("Location: ../acceso.html");
  }
?>
<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Proceso Tres</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="css/navbar.css" rel="stylesheet">



    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>

<!--

	<script>

	$(document).ready(function(){

	

		// generamos un evento cada vez que se pulse una tecla

		$("#id").keyup(function(){

		

			// enviamos una petición al servidor mediante AJAX enviando el id

			// introducido por el usuario mediante POST

			$.post("miarchivo.php", {"id":$("#id").val()}, function(data){

			

				// Si devuelve un nombre lo mostramos, si no, vaciamos la casilla

				if(data.nombre)

					$("#nombre").val(data.nombre);

				else

					$("#nombre").val("");

					

				// Si devuelve un apellido lo mostramos, si no, vaciamos la casilla

				if(data.apellidos)

					$("#apellidos").val(data.apellidos);

				else

					$("#apellidos").val("");



			},"json");

		});

	});

	</script>

-->

	<style type="text/css">

		th {

			background-color: yellow;

		}

		td {

			background-color: white;

		}

	</style>



</head>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Procesos</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="func.search_4_13.php">Proceso 2</a></li>
      <li class="active"><a href="#">Proceso 3</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <? echo $_SESSION['email'] ?></a></li>
      <li><a href="../cerrar-sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesion</a></li>
    </ul>
  </div>
</nav>

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

            <a class="navbar-brand" >Proceso Tres <b>Salado</b></a>

          </div>



        </div><!--/.container-fluid -->

      </nav>



   <!-- Main component for a primary marketing message or call to action -->

      <div class="jumbotron">

     

       <form action="../negocio/insert_3.php" method="post">		

		<table class="table">

		<tr>

		   <th>Codigo</th><td><input type="text" name="id" style="width: 200px; height: 24px" autofocus required></td><td><input type="submit" name="guarda" value="."></td>

	   </tr>

		</table>	 

		</form>

      </div>



<!-- code 1 -->

       <div class="jumbotron">

      	<?
					require("../datos/connection.php");
					mysql_select_db("$database", $con);

					$f_actual = date("Y-m-d");

					$query2=mysql_query("SELECT sal.idCodigo,enc.nombre,sal.fechaSalado,pro.n_bandeja,ope.onombre,ope.iniciales,cal.calibre,pro.cantidad 
					FROM salado as sal
					left outer join proceso_encargado as pro on pro.codigo=sal.idCodigo
					left outer join encargados as enc on pro.idEncargado=enc.idencargados
					left outer join operarias as ope on pro.idOperario=ope.idoperarias
					left outer join calibres as cal on pro.IdCalibre=cal.idcalibres
					where sal.fechaSalado='$f_actual' and pro.idEncargado=14 group by sal.idSalado order by sal.idSalado desc");

					if($query2 == true) {

					echo "<table class='table table-striped'> \n";

					echo "<tr>

					      <th>ID</th><th>ENCARGADO</th><th>FECHA</th><th>BANDEJA</th><th>OPERARIO</th><th>INICIALES</th><th>CALIBRE</th><th>CANTIDAD</th></tr> \n";

					 while ($row2=mysql_fetch_row($query2)) {

					   echo "<tr class='small'>

					      <td>$row2[0]</td><td>$row2[1]</td><td>$row2[2]</td><td>$row2[3]</td><td>$row2[4]</td><td>$row2[5]</td><td>$row2[6]</td><td>$row2[7]</td>

					   </tr> \n";

					}

					echo "</table> \n";

					}

					?>

      </div>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript

    ================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>

    <script src="js/bootstrap.min.js"></script>

  </body>

</html>