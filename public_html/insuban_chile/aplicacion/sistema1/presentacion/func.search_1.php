<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Proceso Cuatro</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="css/navbar.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>



	<style type="text/css">

		th {

			background-color: lightgreen;



		}

		td {

			background-color: white;

		}

	</style>



</head>

<body>

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

            <a class="navbar-brand" >Proceso Cuatro <b>Enmallado</b></a>

          </div>



        </div><!--/.container-fluid -->

      </nav>



<div class="jumbotron">

	<tr>

	<form name="form4" method="POST" action="">

	<th>Fecha</th><td><input type="date" name="fecha" value="<?echo $fecha; ?>"></td><td align="center">&nbsp;<input type="submit" name="busca" value="Buscar" class="btn btn-primary"></td></form>

	</tr>

</div>



<!-- code 1 -->

<div class="jumbotron">



  <div class="row">



    <div class="col-sm-4" ">

 <table class='table table-striped'>

<tr>

	<th style="background-color: blue; color: white;">Grupo Azul</th>

</tr>

<?php if ($busca) {





                require("../datos/connection.php");

                mysql_select_db("$database", $con);



                $query6=mysql_query("SELECT enc.idencargados,cal.idcalibres,cal.calibre,sum(pro.cantidad) as suma
                FROM salado as sal
                left outer join proceso_encargado as pro on pro.codigo=sal.idCodigo
                left outer join encargados as enc on pro.idEncargado=enc.idencargados
                left outer join operarias as ope on pro.idOperario=ope.idoperarias
                left outer join calibres as cal on pro.IdCalibre=cal.idcalibres
                where sal.fechaSalado = '$fecha' 
                and enc.idencargados=16
                group by pro.IdCalibre
                order by cal.calibre asc", $con);

                if($query6 == true) {

                echo "<table class='table table-striped' > \n";

                echo "<tr>

                      <th>Calibres</th><th>Cantidad</th><th>Sobrantes</th><th>Total</th></tr> \n";

                 while ($row6=mysql_fetch_row($query6)) {

                 

                  $grp = $row6[0];

                  $idcal = $row6[1];

                  $cal = $row6[2];

                  $tot = $row6[3];





                     if ($idcal = 20) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";  
                  }elseif ($idcal = 21) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";
                  }elseif ($idcal = 22) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";
                  }elseif ($idcal = 23) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";
                  }elseif ($idcal = 24) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";
                  }          





                }

                echo "</table> \n";

                }

                }?>



</table>

    </div>



 <div class="col-sm-4" >

 <table class='table table-striped'>

<tr>

	<th style="background-color: yellow;">Grupo Amarillo</th>

</tr>

<?php if ($busca) {

                require("../datos/connection.php");

                mysql_select_db("$database", $con);



                $query6=mysql_query("SELECT enc.idencargados,cal.idcalibres,cal.calibre,sum(pro.cantidad) as suma
                FROM salado as sal
                left outer join proceso_encargado as pro on pro.codigo=sal.idCodigo
                left outer join encargados as enc on pro.idEncargado=enc.idencargados
                left outer join operarias as ope on pro.idOperario=ope.idoperarias
                left outer join calibres as cal on pro.IdCalibre=cal.idcalibres
                where sal.fechaSalado = '$fecha' 
                and enc.idencargados=14
                group by pro.IdCalibre
                order by cal.calibre asc", $con);

                if($query6 == true) {

                echo "<table class='table table-striped' > \n";

                echo "<tr>

                      <th>Calibres</th><th>Cantidad</th><th>Sobrantes</th><th>Total</th></tr> \n";

                 while ($row6=mysql_fetch_row($query6)) {

                 

                  $grp = $row6[0];

                  $idcal = $row6[1];

                  $cal = $row6[2];

                  $tot = $row6[3];





                   if ($idcal = 20) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";  
                  }elseif ($idcal = 21) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";
                  }elseif ($idcal = 22) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";
                  }elseif ($idcal = 23) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";
                  }elseif ($idcal = 24) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";
                  }        





                }

                echo "</table> \n";

                }}?>

 </table>

    </div>



    <div class="col-sm-4" >

 <table class='table table-striped'>

<tr>

	<th style="background-color: red; color: white;">Grupo Rojo</th>

</tr>



<?php if ($busca) {

                require("../datos/connection.php");

                mysql_select_db("$database", $con);



                $query6=mysql_query("SELECT enc.idencargados,cal.idcalibres,cal.calibre,sum(pro.cantidad) as suma
                FROM salado as sal
                left outer join proceso_encargado as pro on pro.codigo=sal.idCodigo
                left outer join encargados as enc on pro.idEncargado=enc.idencargados
                left outer join operarias as ope on pro.idOperario=ope.idoperarias
                left outer join calibres as cal on pro.IdCalibre=cal.idcalibres
                where sal.fechaSalado = '$fecha' 
                and enc.idencargados=13
                group by pro.IdCalibre
                order by cal.calibre asc", $con);

                if($query6 == true) {

                echo "<table class='table table-striped' > \n";

                echo "<tr>

                      <th>Calibres</th><th>Cantidad</th><th>Sobrantes</th><th>Total</th></tr> \n";

                 while ($row6=mysql_fetch_row($query6)) {

                 

                  $grp = $row6[0];

                  $idcal = $row6[1];

                  $cal = $row6[2];

                  $tot = $row6[3];





                   if ($idcal = 20) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";  
                  }elseif ($idcal = 21) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";
                  }elseif ($idcal = 22) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";
                  }elseif ($idcal = 23) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";
                  }elseif ($idcal = 24) {
                  echo "<tr class='small'><td>$cal</td><td>$tot</td><td></td><td></td></tr> \n";
                  }           





                }

                echo "</table> \n";

                }}?>

 </table> 

    </div>

  </div>

</div> 

<? if ($busca) {?>

        <div class="content-box-large">
<!-- Code... bloque2 -->
   <form action="" method="post">   
    <table class="table">
    <label>REPROCESO</label>
    <tr><td>Calibre | Cantidad</td></tr>
    <tr>
       <td><select>
  <option value="">Seleccione</option>
  <option value="15">Celeste</option>
  <option value="12">Rojo</option>
  <option value="14">Verde</option>
  <option value="11">Azul</option>
  <option value="13">Amarillo</option>
</select>
<input type="text" name="cant" style="width: 100px; height: 24px"><input type="submit" name="traspaso" value="Reprocesar" >
</td>
    </table>   
    </form> 
<!-- Code... bloque2  -->   
        </div>
<?}?>
</div> <!-- /container -->





    <!-- Bootstrap core JavaScript

    ================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>

    <script src="js/bootstrap.min.js"></script>

  </body>

</html>