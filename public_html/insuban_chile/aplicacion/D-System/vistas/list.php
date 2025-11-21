<?php
  session_start();

  if(isset($_SESSION['email'])){
  }else{
  header("Location: ../vistas/login.html");
  }
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
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet"> 
<!--//Metis Menu -->
</head>
<script type="text/JavaScript">

function preguntar(id){
 
   if (confirm('¿Esta seguro que desea eliminar el registro ' + id + '?'))
     window.location.href = "../modelos/del_op.php?id=" + id; //página web a la que te redirecciona si confirmas la eliminación
}
</script> 
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
                    <a href="#" class="active">&nbsp; Listar</a>
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
					<a href="index.php">
						<h1>INSUBAN</h1>
						<span>AdminPanel</span>
					</a>
				</div>
				<!--//logo-->
			</div>
			<div class="header-left">
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
										<p>Hola, <? echo $nombre; ?></p>
										<span><? echo $perfil; ?></span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
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
				<h3 class="title1">Trabajadores</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
					<?
	echo "<a href='add_op.php'><img src='images/button_agregar-nuevo.png' width='10%' align='right' /></a>";
	echo "<div><table border='1' width='100%'><tr><th style='width: 165px; height: 28px;'>ID</th><th style='width: 165px; height: 28px;'>NOMBRE</th><th style='width: 165px; height: 28px;'>INICIALES</th><th style='width: 100px; height: 28px;'>ESTADO</th><th>ACCION</th></tr></table></div>";
	echo "<div class='table-responsive bs-example widget-shadow'>";
	echo "<table border='1' width='100%'>";
	echo"<tr>";
		require("../controladores/connection.php");
		mysql_select_db("$database", $con);

				$query=mysql_query("SELECT * FROM operarias order by onombre asc");
				while ($row=mysql_fetch_array($query)) {
							
					$id_op=$row[idoperarias];
					$nombrep=$row[onombre];
					$iniciales=$row[iniciales];
					$estado=$row[activo];

						if ($estado == 1) {
							$est = "Activado";
						}else{
							$est = "Desactivado";
						}

				echo "<form action='../modelos/upd_op.php' method='get'>";
				echo "<input type='text' value='$id_op'  disabled>";
				echo "<input type='hidden' name='id_op' value='$id_op'>";				
				echo "<input type='text' name='nombrep' value='$nombrep'  disabled>";
				echo "<input type='text' name='ini' value='$iniciales'  disabled>";
				echo "<select name='estado'>
						  <option value=''>$est</option>
						  <option value='1'>Activado</option>
						  <option value='2'>Desactivado</option>
						</select>";				
				echo "<input type='submit' name='btnUpdate' value='Actualizar'/>";
				echo "<input type='button' onclick='preguntar($id_op)' value='Eliminar'/><br/>";
				echo "</form>";     
				}
	echo "</tr>";					
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