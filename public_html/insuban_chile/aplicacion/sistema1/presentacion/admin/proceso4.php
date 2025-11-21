<?php
  session_start();
   
  // Controlo si el usuario ya está logueado en el sistema.
  if(isset($_SESSION['email'])){
    // Le doy la bienvenida al usuario.
    echo 'BIENVENIDO <strong>' . $_SESSION['email'] . '</strong>, <a href="../../cerrar-sesion.php">Cerrar Sesion</a>';
  }else{
    // Si no está logueado lo redireccion a la página de login.
    header("Location: ../acceso.html");
  }
?>
<head>
    <title>Consola Administración</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style type="text/css">
	th {
		background-color: yellow;
	}
</style>


 </head>

  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-4">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="#">Consola Administración</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="consola.php"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
                    <li ><a href="proceso1.php"><i class="glyphicon glyphicon-list"></i> Proceso Uno</a></li>
                    <li ><a href="proceso2.php"><i class="glyphicon glyphicon-stats"></i> Proceso Dos</a></li>
                    <li ><a href="proceso3.php"><i class="glyphicon glyphicon-list"></i> Proceso Tres</a></li>
                    <li class="current"><a href="#"><i class="glyphicon glyphicon-stats"></i> Proceso Cuatro</a></li>
                    <li><a href="barras.php"><i class="glyphicon glyphicon-stats"></i> Generar Código Barra</a></li>
                    <li><a href="proceso4_1.php"><i class="glyphicon glyphicon-stats"></i> Informe Productivo</a></li>
                    <li><a href="proceso5_1.php"><i class="glyphicon glyphicon-stats"></i> Informe Personal</a></li> 
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-12 panel-primary">
		  			<div class="content-box-header panel-heading">
	  					<div class="panel-title ">Proceso Cuatro <b>ENMALLADO</b></div>
		  			</div>

<!-- Code... bloque3 -->	
		  	<div class="content-box-large">

	<tr>
	<form name="form4" method="POST" action="">
	<th>Fecha</th><td><input type="date" name="fecha" value="<?echo $fecha;?>"></td><td align="center">&nbsp;<input type="submit" name="busca" value="Buscar" class="btn btn-primary"></td></form>
	</tr>
			</div> 
<!-- bloque3 -->


		  			<div class="content-box-large box-with-header">
<!-- Code... bloque1 -->
 <div class="row">

    <div class="col-sm-4" ">
 <table class='table table-striped'>
<tr>
	<th style="background-color: blue; color: white;">Grupo Azul</th>
</tr>
<?php if ($busca) {


                require("../../datos/connection.php");
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
                      <th>Calibres</th><th>Plasticos</th><th>Sobrantes</th><th>Total</th></tr> \n";
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


                require("../../datos/connection.php");
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
                      <th>Calibres</th><th>Plasticos</th><th>Sobrantes</th><th>Total</th></tr> \n";
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
	<th style="background-color: red; color: white;">Grupo Rojo</th>
</tr>

<?php if ($busca) {

                require("../../datos/connection.php");
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
                      <th>Calibres</th><th>Plasticos</th><th>Sobrantes</th><th>Total</th></tr> \n";
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
  </div>

<!-- Code... bloque1 -->

					</div>
		  		</div>
		  	</div>
<!-- Code... bloque2 
		  	<div class="content-box-large">

   <form action="../../negocio/insert_3.php" method="post">		
		<table class="table">
		<tr>
		   <th>Codigo</th><td><input type="text" name="id" id="id" style="width: 200px; height: 24px" autofocus></td><td><input type="submit" name="guarda" value=""></td>
	   </tr>
		</table>	 
		</form> 
 Code... bloque2 	-->		
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

