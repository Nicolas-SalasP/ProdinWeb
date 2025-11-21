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
                    <li class="current"><a href="#"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
                    <li><a href="proceso1.php"><i class="glyphicon glyphicon-list"></i> Proceso Uno</a></li>
                    <li><a href="proceso2.php"><i class="glyphicon glyphicon-stats"></i> Proceso Dos</a></li>
                    <li><a href="proceso3.php"><i class="glyphicon glyphicon-list"></i> Proceso Tres</a></li>
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
	  					<div class="panel-title ">Bienvenido a la Consola de administración</div>
		  			</div>
		  			
		  			<div class="content-box-large box-with-header" >
			  			Consola de control de procesos productivos <B>REMOJO - ENCARGADO - SALADO - ENMALLADO</B>
			  		<BR><BR>	

			  		TABLA DE CONVERSIONES:<BR><BR>
			  		<TABLE>
			  		<TR>	<TD>PLASTICO:</TD><TD> 18 A 20 MT TRIPA FINA</TD></TR>
			  		<TR>	<TD>MADEJA:</TD><TD> 4.5 PLASTICOS => 90MT</TD></TR>
			  		<TR>	<TD>MALLA:</TD><TD>	22 PLASTICOS => 5 MADEJAS => 450MT</TD></TR>
			  		<TR>	<TD>BIDON:</TD><TD>	60 MALLAS => 300 MADEJAS => 30 NUDOS</TD></TR>
			  		<TR>	<TD>NUDO:</TD><TD> 20 TRIPAS (GORDO) 10 TRIPAS (HEMBRA)</TD></TR>
					</TABLE>

						<br /><br />
					</div>
		  		</div>
		  	</div>
<!--
		  	<div class="content-box-large">
				Aqui podra visualizar las tareas que se realizan en los procesos productivos.
				<br /><br />
		  	</div> -->
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

