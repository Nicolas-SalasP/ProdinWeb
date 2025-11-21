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

if ($busca) {
  $fecha = $fecha_b;
} else {
  $fecha = date("Y-m-d");
}

$query1=mysql_query("SELECT grp.grupo,org.origen, ope.onombre, pr2.n_nudos_e, pr2.n_nudos_r,pr2.origenid 
FROM proceso_encargado2 as pr2,
grupo as grp,
operarias as ope,
origenes as org 
where grp.idgrupo=pr2.idgrupo1 and ope.idoperarias=pr2.operaria and org.id_origen=pr2.origenid
and pr2.fecha = '$fecha' order by ope.onombre ");

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
<script>
  $(document).ready(function () { $('#entradafilter').keyup(function () { var rex = new RegExp($(this).val(), 'i');
        $('.contenidobusqueda tr').hide();
        $('.contenidobusqueda tr').filter(function () { return rex.test($(this).text());
        }).show(); }) });
</script>
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		<div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						<li>
							<a href="index.php"><i class="fa fa-home nav_icon"></i>Home</a>
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
                    <a href="list.php">&nbsp; Listar</a>
                  </li>
                  <li>
                    <a href="add_op.php">&nbsp; Nuevo</a>
                  </li>                  
                 </ul> 
               </li>
              <li>
                <a href="#">Origenes<span class="fa arrow"></a>
                  <ul class="nav nav-second-level collapse">
                  <li>
                    <a href="list_org.php">&nbsp; Listar</a>
                  </li>
                  <li>
                    <a href="add_mp.php">&nbsp; Nuevo</a>
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
				<!--search-box -->
				<div class="search-box">
					<form class="input" method="POST" action="">
						<input class="sb-search-input input__field--madoka" type="date" id="input-31" name="fecha_b" value="<?echo $fecha;?>" />
						<label class="input__label" for="input-31">
							<svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
								<path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
							</svg>
						</label>                              
				</div>
        <!--//end-search-box-->
			</div>
			<div class="header-left">
				<div class="profile_details_left">
          <input type="submit" name="busca" value="Buscar" class="btn btn-danger">
					<div class="clearfix"> </div>
				</div>
			 </form>
   <span id="liveclock" style="position:absolute;left:50;top:0; color:blue;" ></span>
   <script language="JavaScript" type="text/javascript">
    function show5(){
        if (!document.layers&&!document.all&&!document.getElementById)
        return

         var Digital=new Date()
         var hours=Digital.getHours()
         var minutes=Digital.getMinutes()
         var seconds=Digital.getSeconds()

        var dn="PM"
        if (hours<12)
        dn="AM"
        if (hours>12)
        hours=hours-12
        if (hours==0)
        hours=12

         if (minutes<=9)
         minutes="0"+minutes
         if (seconds<=9)
         seconds="0"+seconds
        //change font size here to your desire
        myclock="<font size='5' face='Arial' ><b><font size='1'>Hora actual:</font></br>"+hours+":"+minutes+":"
         +seconds+" "+dn+"</b></font>"
        if (document.layers){
        document.layers.liveclock.document.write(myclock)
        document.layers.liveclock.document.close()
        }
        else if (document.all)
        liveclock.innerHTML=myclock
        else if (document.getElementById)
        document.getElementById("liveclock").innerHTML=myclock
        setTimeout("show5()",1000)
         }


        window.onload=show5
         //-->
     </script>				 	
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img src="images/ico.png" alt=""> </span> 
									<div class="user-name">
										<p>Hola, <? echo $_SESSION['nombre'] ?></p>
										<span><? echo $_SESSION['perfil'] ?></span>
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
				<div class="tables">
				<h3 class="title1">Trabajadores</h3>
					<div> <a href="../controladores/informes_excel/excel_tripales.php">Informe_Excel</a></div>
     <div class="input-group"> <span class="input-group-addon">Filtrar por: </span>
     <input id="entradafilter" type="text" class="form-control" style="width: 200px; height: 28px">
     </div>    
<?
	echo "<div class='table-responsive bs-example widget-shadow'>";
	echo "<h4>Tripales:</h4>";
	echo "<table class='table table-bordered'>";
	echo "<thead>";
	echo "<tr>
    <th>GRUPO</th><th>NOMBRE</th><th>MATERIAL</th><th>TRIPAS</th></tr> \n";
	echo "</thead>";
	echo "<tbody class='contenidobusqueda'>";

	while ($row2=mysql_fetch_row($query1)) {

	$n_e=$row2[3];
	$n_r=$row2[4];
	$mat=$row2[5];

	$nud=$n_e - $n_r;
	
	if ($mat==1000055 or $mat==1000043) {
	$varx1=$nud * 15;
	}elseif ($mat==1000039) {
	$varx1=$nud * 22;
	}elseif ($mat==107) {
	$varx1=$nud * 10;
	}elseif ($mat==1000058) {
    $varx1=$nud * 30;
	}elseif ($mat==555) {
    $varx1=$nud * 5;
    }else{
	$varx1=$nud * 20;
	}

	$varx11+=$varx1;
   	echo "<tr> <td>$row2[0]</td><td>$row2[2]</td><td>$row2[1]</td><td>$varx1</td> </tr> \n";
}
	echo "<tr> <td>TOTALES:</td><td> </td><td> </td><td>$varx11</td> </tr> \n";
	echo "</tbody>";
	echo "</table>";
	echo "</div>";
?>
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