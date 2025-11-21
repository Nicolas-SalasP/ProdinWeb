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
<?              require("../../datos/connection.php");
                mysql_select_db("$database", $con);

                $query6=mysql_query("SELECT pr2.idproceso_encargado2, ope.onombre, org.id_origen, org.origen, grp.grupo, pr2.n_nudos_e, pr2.n_nudos_r
                FROM proceso_encargado2 as pr2
                left outer join operarias as ope on ope.idoperarias=pr2.operaria
                left outer join origenes as org on org.id_origen=pr2.origenid
                left outer join grupo as grp on grp.idgrupo=pr2.idgrupo1
                where pr2.fecha between '$fech_ini' and '$fech_ter'
                and pr2.idgrupo1 = 11
                ORDER BY pr2.origenid, pr2.operaria asc", $con);  
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
                    <li ><a href="proceso4.php"><i class="glyphicon glyphicon-stats"></i> Proceso Cuatro</a></li>
                    <li ><a href="barras.php"><i class="glyphicon glyphicon-stats"></i> Generar Código Barra</a></li>
                    <li ><a href="proceso4_1.php"><i class="glyphicon glyphicon-stats"></i> Informe Productivo</a></li>
                    <li class="current"><a href="#"><i class="glyphicon glyphicon-stats"></i> Informe Personal</a></li> 
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-12 panel-success">
		  			<div class="content-box-header panel-heading">
	  					<div class="panel-title "><b>Informe Personal</b></div>
		  			</div>

<!-- Code... bloque1 -->	
<div class="content-box-large">
	<tr>
	<form name="form4" method="POST" action="">
	<th>Fecha inicio</th>&nbsp;<td><input type="date" name="fech_ini" value="<?echo $fech_ini;?>"></td>&nbsp;&nbsp;<th>Fecha termino</th>&nbsp;<td><input type="date" name="fech_ter" value="<?echo $fech_ter;?>"></td><td align="center">&nbsp;&nbsp;&nbsp;<input type="submit" name="busca" value="Buscar" class="btn btn-success"></td></form>
	</tr>
</div> <!-- Code... bloque1 --> 

 
<?if ($busca) {?>

  <div class="row">
   <div class="col-md-12">
    <div class="box box-default "> 
      <div class="box-header with-border" style="background-color: blue; color: white;" >
        <h3 class="box-title">Grupo Azul</h3>      
      </div>
    <!-- /.box-header -->
    <div class="box-body">
     
       <table class="table table-bordered">


<?             
               echo "<tr class='small'><td><b>Operaria</b></td><td><b>Tripas</b></td><td><b>Origen</b></td><td><b>Plasticos</b></td><td><b>indicador</b></td></tr> \n";                  
                

                while ($row6=mysql_fetch_row($query6)) {
                    
                    $openom = $row6[1];
                    $orgid = $row6[2];
                    $orgnom = $row6[3];
                    $nudose = $row6[5];
                    $nudosr = $row6[6];
          
                    $nudtot = ($nudose - $nudosr);

                    if ($orgid == 1000039 ) {
                      $trip = $nudtot * 22;
                    } else {
                      $trip = $nudtot * 20;
                    }                

                  echo "<tr class='small'><td>$openom</td><td>$trip</td><td>$orgnom</td><td>$totplast</td></tr> \n";                      
               }?>               
      
          </table>

           </div>
        <!-- /.box-body -->
      </div>
     <!-- / .box -->
    </div>
    <!-- / .col -->
  </div>
  <!-- / .row --> 
<?}?>

  
        </div>
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
    <!-- jQuery 3 -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>

