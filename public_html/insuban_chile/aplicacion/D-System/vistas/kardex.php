<?php
  session_start();
   
  // Controlo si el usuario ya está logueado en el sistema.
  if(isset($_SESSION['email'])){
    // Le doy la bienvenida al usuario.
#    echo 'BIENVENIDO <strong>' . $_SESSION['email'] . '</strong>, <a href="../cerrar-sesion.php">Cerrar Sesion</a>';
  }else{
    // Si no está logueado lo redireccion a la página de login.
    header("Location: ../vistas/login.html");
  }
?>
<?
require("../controladores/connection.php");
mysql_select_db("$database", $con);

$mes = date(F);

if ($ejecutar4) {
 
	$sql1=mysql_query("INSERT INTO tbl_inv_final ( IdCalibre, cantidad, codigo) SELECT tbl_pro.IdCalibre, tbl_pro.cantidad, tbl_pro.codigo FROM tbl_salado_inv_final as tbl_sal, tbl_proceso_encargado_inv_final as tbl_pro 
		where tbl_sal.idCodigo=tbl_pro.codigo group by tbl_sal.idSalado", $con);
} 


if ($ejecutar5) {
 
	$sql5=mysql_query("INSERT INTO tbl_temp_produccion_mensual( idSalado,idCodigo,fechaSalado,IdCalibre,calibre,valor,cantidad )
		SELECT sal.idSalado, sal.idCodigo, sal.fechaSalado, pro.IdCalibre, cal.calibre, cal.valor, pro.cantidad
		FROM salado as sal
		left outer join proceso_encargado as pro on pro.codigo = sal.idCodigo
		left outer join calibres as cal on pro.IdCalibre = cal.idcalibres
		group by sal.idSalado", $con);
		} 

// ventas

		$sql2=mysql_query("SELECT CALIBRE, MEDIDA_CALIBRE, sum(PLASTICOS)
		FROM tbl_ventas_092017 group by CALIBRE", $con);

// inventario inicial

		$sql3=mysql_query("SELECT calibre, valor, sum(cantidad) 
		FROM tbl_temp_inv_inicial_072017
		group by IdCalibre order by IdCalibre", $con);

// Produccion mes
		
		$sql4=mysql_query("SELECT calibre, valor, sum(cantidad) 
		FROM tbl_temp_produccion_mensual
		where fechaSalado between '$fech_ini' and '$fech_ter'
		and IdCalibre != 0
		group by IdCalibre order by IdCalibre", $con);


?>
<!DOCTYPE HTML>
<html>
<head>
<title>D-System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->  
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		<div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						<li>
							<a href="index.php" ><i class="fa fa-home nav_icon"></i>Home</a>
						</li>
            <? if ($idEnc == 1 or $idEnc == 2 or $idEnc == 3) {?>                
						<li>
							<a href="#"><i class="fa fa-table nav_icon"></i>Produccion <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="mp_utilizada.php">MP Utilizada</a>
								</li>
								<li>
									<a href="mp_calidad.php">Calidad MP</a>
								</li>
				        <li>
				          <a href="tubing.php">Tubing</a>
				        </li>
							</ul>
						</li>          
            <li>
              <a href="#"><i class="fa fa-file-text-o nav_icon"></i>Trabajadores <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="tripales.php">Tripales</a>
            </li>
            <li>
              <a href="plasticos.php">Plasticos</a>
            </li>
          </ul>
            </li>
            <?}?>
            <? if ($idEnc == 1) {?>              
            <li>
              <a href="kardex.php"><i class="fa fa-file-text-o nav_icon"></i>Conciliación Inventario</a>
            </li>
           <li>
            <a href="#"><i class="fa fa-cogs nav_icon"></i>Ajustes<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
      <li>
        <a href="#">Trabajador<span class="fa arrow"></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <li><a href="add_op.php">&nbsp; Agregar</a></li>
            </li>
            <li>
              <li><a href="add_op.php">&nbsp; Modificar</a></li>
            </li>
            <li>
              <li><a href="add_op.php">&nbsp; Eliminar</a></li>
            </li>
      <li>
        <a href="list.php">Listar</a>
      </li>
         </ul> 
       </li>
      </ul>
      <!-- //nav-second-level -->
            </li>
            <?}?>
    			</ul>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<!--logo -->
				<div class="logo">
					<a href="index.html">
						<h1>INSUBAN</h1>
						<span>AdminPanel</span>
					</a>
				</div>
				<!--//logo-->
			</div>
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img src="images/ico.png" alt=""> </span> 
									<div class="user-name">
										<p>Hola, <? echo $nombre; ?></p>
										<span><? echo $perfil; ?></span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
<!--								<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
								<li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> -->
								<li> <a href="../modelos/cerrar-sesion.php"><i class="fa fa-sign-out"></i> Salir</a> </li>
							</ul>
						</li>
					</ul>
				</div>			
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<h3 class="title1">Conciliación Inventario</h3>
				<? if ($idEnc == 1) {?>	
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
					<p> Cargar toma inventario </p>
					<form action='' method='post'>
					   <input type='submit' name='ejecutar4' value='Ejecutar'>
					  </form>
					<br>
					<p> Cargar Produccion Mes </p>
					<form action='' method='post'>
					   <input type='submit' name='ejecutar5' value='Ejecutar'>
					  </form>
					<br>										
					<p> Cargar ventas manager </p>
					<form action='control.php' method='post' enctype="multipart/form-data">
					   Importar Archivo : <input type='file' name='sel_file' size='20'>
					   <input type='submit' name='submit' value='Cargar'>
					  </form>
				</div>
				<? } ?>
			<div class="tables">	
				<div class="bs-example widget-shadow" data-example-id="bordered-table"> 
							<h4>Inventario inicial: <?echo $mes?></h4>
							<table class="table table-bordered"> 
								<thead> 
									<tr style="background-color: #ffcc00"> 
									<th>Calibre</th> <th>Valor</th> <th>Cantidad</th> </tr> 
								</thead> 
								<tbody> 
							<?	echo "<tr>";	
								while($row = mysql_fetch_row($sql3)) {

								$calibre = $row[0];
								$valor = $row[1];
								$cantidad = $row[2];
								
								$sum_cant += $cantidad;

								echo "<td>$calibre</td> <td>$valor</td> <td>$cantidad</td> \n";		
								echo "</tr>";
							}?>
							<tr style="background-color: #ccff99">
								<td><b>TOTAL:</b></td><td></td><td><b><? echo $sum_cant?></b></td></tr>
							</tbody> 
							</table>
					</div>
							<div class="bs-example widget-shadow" data-example-id="bordered-table"> 
							<h4>Produccion Mes</h4>
							<form action="" method="post">
							<input type="date" name="fech_ini" value="<? echo $fech_ini;?>">
							<input type="date" name="fech_ter" value="<? echo $fech_ter;?>">
							<input type="submit" name="prod_mes" value="Buscar">
							</form>
							<br>
							<table class="table table-bordered"> 
								<thead> 
									<tr style="background-color: #ffcc00"> 
									<th>Calibre</th> <th>Valor</th> <th>Cantidad</th> </tr> 
								</thead> 
								<tbody> 
							<? if ($prod_mes) {
						
							echo "<tr>";	
								while($row = mysql_fetch_row($sql4)) {

								$calibre = $row[0];
								$valor = $row[1];
								$cantidad = $row[2];

								$sum_cant1 += $cantidad;

								echo "<td>$calibre</td> <td>$valor</td> <td>$cantidad</td> \n";		
								echo "</tr>";	 
						}}?>
						<tr style="background-color: #ccff99">
								<td><b>TOTAL:</b></td><td></td><td><b><? echo $sum_cant1?></b></td></tr>		
							</tbody> 
							</table>
					</div>
									<div class="bs-example widget-shadow" data-example-id="bordered-table"> 
							<h4>Ventas: <?echo $mes?></h4>
							<table class="table table-bordered"> 
								<thead> 
									<tr style="background-color: #ffcc00"> 
									<th>Calibre</th> <th>Valor</th> <th>Cantidad</th> </tr> 
								</thead> 
								<tbody> 
							<?	echo "<tr>";	
								while($row = mysql_fetch_row($sql2)) {


								$calibre = $row[0];
								$valor = $row[1];
								$cantidad = $row[2];

								$sum_cant2 += $cantidad;

								echo "<td>$calibre</td> <td>$valor</td> <td>$cantidad</td> \n";		
								echo "</tr>";	 
						}?>	
						<tr style="background-color: #ccff99">
								<td><b>TOTAL:</b></td><td></td><td><b><? echo $sum_cant2?></b></td></tr>	
							</tbody> 
							</table>
					</div>
				</div>		
			</div>
		</div>
	</div>
		<!--footer-->
		<div class="footer">
		   <p>&copy; 2017 Insuban Admin Panel. Derechos Reservados </p>
		</div>
        <!--//footer-->
	</div>
	<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
</body>
</html>