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
<?php
//$url1=$_SERVER['REQUEST_URI'];
//header("Refresh: 3; URL=$url1");
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
		background-color: white;
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
                    <li class="current"><a href="#"><i class="glyphicon glyphicon-list"></i> Proceso Tres</a></li>
                    <li><a href="barras.php"><i class="glyphicon glyphicon-stats"></i> Generar Código Barra</a></li>
                    <li><a href="proceso4_1.php"><i class="glyphicon glyphicon-stats"></i> Informe Productivo</a></li>
  <? if ($idEnc ==1) {?>             
                <li><a href="proceso5_1.php"><i class="glyphicon glyphicon-stats"></i> Informe Personal</a></li>    
               <?}?>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-12 panel-primary">
		  			<div class="content-box-header panel-heading">
	  					<div class="panel-title ">Proceso Tres <b>SALADO</b></div>
		  			</div>
<!-- Code... bloque -->
<div class="content-box-large">
			
			<form action="" method="POST">
			<table>
				<th>
					<label>Fecha: </label>
					<input type="date" name="fech" value="<?echo $fech;?>">
					<input type="submit" name="search">
				</th>
			</table>
			</form>

</div>

<div class="content-box-large box-with-header">
<!-- Code... bloque1 -->

	<?if ($search) {?>
  <tr>
    <div>
          <a href="../../informes_excel/excel_tubing.php">Informe_Excel</a>
          <!-- <strong><h2>Solicita informe completo excel al administrador del sistema.</h2></strong> -->
      </div>
  </tr><?}?>


					<?
					require("../../datos/connection.php");
					mysql_select_db("$database", $con);

//$f_actual = date("Y-m-d");

					$query2=mysql_query("SELECT sal.idCodigo,enc.nombre,sal.fechaSalado,pro.n_bandeja,ope.onombre,ope.iniciales,cal.calibre,pro.cantidad 
					FROM salado as sal
					left outer join proceso_encargado as pro on pro.codigo=sal.idCodigo
					left outer join encargados as enc on pro.idEncargado=enc.idencargados
					left outer join operarias as ope on pro.idOperario=ope.idoperarias
					left outer join calibres as cal on pro.IdCalibre=cal.idcalibres
					where sal.fechaSalado='$fech' group by sal.idSalado order by sal.idSalado desc");
					if($query2 == true) {

					echo "<table class='table table-striped'> \n";
					echo "<tr>
					      <th>ID</th><th>ENCARGADO</th><th>FECHA</th><th>OPERARIO</th><th>CALIBRE</th><th>CANTIDAD</th></tr> \n";
					 while ($row2=mysql_fetch_row($query2)) {


					   echo "<tr class='small'>
					      <td>$row2[0]</td><td>$row2[1]</td><td>$row2[2]</td><td>$row2[4]</td><td>$row2[6]</td><td>$row2[7]</td>
					   </tr> \n";
					}
					echo "</table> \n";
					}
					?>

					</div>
		  		</div>
		  	</div>

<!--		  	<div class="content-box-large">
 			  	</div>-->

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

