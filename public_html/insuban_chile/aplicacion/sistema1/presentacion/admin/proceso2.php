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
                    <li class="current"><a href="#"><i class="glyphicon glyphicon-stats"></i> Proceso Dos</a></li>
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
	  					<div class="panel-title ">Proceso Dos <b>ENCARGADO</b></div>
		  			</div>

<!--Code... bloque3 -->	
		  	<div class="content-box-large">
			<form action="" method="POST">
			<table>
				<th>
					<label>Fecha Produccion: </label>
					<input type="date" name="fech" value="<?echo $fech;?>">				
					<input type="submit" name="search">
				</th>
			</table>
			</form>
		  	</div> 
<!-- bloque3 end -->


<div class="content-box-large box-with-header">
<!-- Code... bloque1  beginnig-->

	<?if ($search) {?>
  <tr>
    <div>
          <a href="../../informes_excel/excel_encargados.php">Informe_Excel</a>
          <!-- <strong><h2>Solicita informe completo excel al administrador del sistema.</h2></strong> -->
      </div>
  </tr><?}?>



      	<?
   		 include("../../datos/connection.php");
		  mysql_select_db("$database", $con);


$fech=$_POST[fech];
//$hoy=date("Y-m-d");

			$query5 = mysql_query("SELECT pr2.idproceso_encargado2, pr2.fecha, ope.onombre,org.origen,grp.grupo,pr2.n_bidon,pr2.n_nudos_e,pr2.n_nudos_r,org.id_origen FROM proceso_encargado2 as pr2
				left outer join operarias as ope on ope.idoperarias=pr2.operaria
				left outer join origenes as org on org.id_origen=pr2.origenid
				left outer join grupo as grp on grp.idgrupo=pr2.idgrupo1
				where pr2.fecha = '$fech' ORDER BY pr2.idproceso_encargado2 DESC", $con);
			if($query5 == true) {
			echo "<table class='table table-striped' > \n";
			echo "<tr class='small'>
			      <th>COD</th><th>FECHA</th><th>OPERARIA</th><th>ORIGEN</th><th>GRUPO</th><th>N_BIDON</th><th>NUDOS_E</th><th>NUDOS_R</th><th>SUBTOTAL_NUDOS</th></tr> \n";
			 while ($row5=mysql_fetch_row($query5)) {

                $x1=$row5[6];
                $x2=$row5[7];
                $x3=$row5[8];
                $subtot_nudos=$x1-$x2;
                $sum5+=$subtot_nudos;

                if ($x3 == 1000055 or $x3 == 1000043) {
                $varx1+=$subtot_nudos * 15;
                }elseif ($x3 == 1000039) {
                $varx2+=$subtot_nudos * 22;
                }elseif ($x3 == 107) {
                $varx3+=$subtot_nudos * 10;
                }else{
                $varx4+=$subtot_nudos * 20;
                }

            $sum6 = $varx1+$varx2+$varx3+$varx4;

			   echo "<tr>
			      <td>$row5[0]</td><td>$row5[1]</td><td>$row5[2]</td><td>$row5[3]</td><td>$row5[4]</td><td>$row5[5]</td><td>$row5[6]</td><td align='center'>$row5[7]</td><td align='center'>$subtot_nudos</td>
			   </tr> \n";
			}
			echo "</table> \n";

			echo "<br>";

			echo "<table border ='0' width='100%'>";
         	echo "<tr>
            <td width='100' nowrap='nowrap'>&nbsp;</td><td width='50' nowrap='nowrap'></td><td width='31' nowrap='nowrap' align='right'><strong>TOTAL_NUDOS:</strong>&nbsp;&nbsp;<b>$sum5</b></td><td width='100' nowrap='nowrap' align='center'><strong>TRIPALES:</strong>&nbsp;&nbsp;<b>$sum6</b></td>
         	</tr>";
         	echo "</table>";
			}?>					
 <!-- search -->

<!-- Code... bloque1 end -->

					</div>
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

