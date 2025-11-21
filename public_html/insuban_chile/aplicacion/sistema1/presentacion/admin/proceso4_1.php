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
<?
require("../../datos/connection.php");
mysql_select_db("$database", $con);

                $query6=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre, pro.cantidad
                FROM salado as sal,
                proceso_encargado as pro, 
                encargados as enc 
                  where pro.idEncargado=enc.idencargados
                  and pro.codigo=sal.idCodigo
                  and pro.IdCalibre !=30
                  and sal.fechaSalado='$fecha'
                group by sal.idSalado order by sal.idSalado desc", $con);
                
                while ($row6=mysql_fetch_row($query6)) {
                 
                  $totplast += $row6[4];
                }

            $query6=mysql_query("SELECT sal.fechaSalado, sal.idCodigo, pro.idEncargado, pro.IdCalibre, pro.cantidad
            FROM salado as sal,
            proceso_encargado as pro, 
            encargados as enc 
                  where pro.idEncargado=enc.idencargados
                  and pro.codigo=sal.idCodigo
                  and sal.fechaSalado='$fecha'
                  and pro.IdCalibre != 30
                  and pro.idEncargado = 16
                group by sal.idSalado order by sal.idSalado desc ", $con);
                
                while ($row6=mysql_fetch_row($query6)) {
                 
                  $tot1 += $row6[4];
              }

                  $calc1 = $tot1 / $totplast;
                  $preporcent = $calc1 * 100;
                  $porcent1 = number_format($preporcent, 1,',', '');



                $query6=mysql_query("SELECT sal.fechaSalado, sal.idCodigo, pro.idEncargado, pro.IdCalibre, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                  encargados as enc 
                  where pro.idEncargado=enc.idencargados
                  and pro.codigo=sal.idCodigo
                  and sal.fechaSalado ='$fecha'
                  and pro.idEncargado =14
                  and pro.IdCalibre !=30
                  group by sal.idSalado order by sal.idSalado desc", $con);
                
                while ($row6=mysql_fetch_row($query6)) {
                 
                  $tot2 += $row6[4];
              }

                  $calc1 = $tot2 / $totplast;
                  $preporcent = $calc1 * 100;
                  $porcent2 = number_format($preporcent, 1,',', '');



                $query6=mysql_query("SELECT sal.fechaSalado, sal.idCodigo, pro.idEncargado, pro.IdCalibre, pro.cantidad
                FROM salado as sal,
                proceso_encargado as pro, 
                  encargados as enc 
                  where pro.idEncargado=enc.idencargados
                  and pro.codigo=sal.idCodigo
                  and sal.fechaSalado ='$fecha'
                  and pro.IdCalibre !=30
                  and pro.idEncargado =13
                  group by sal.idSalado order by sal.idSalado desc", $con);
                
                while ($row6=mysql_fetch_row($query6)) {
                 
                  $tot3 += $row6[4];
                }

                $calc1 = $tot3 / $totplast;
                $preporcent = $calc1 * 100;
                $porcent3 = number_format($preporcent, 1,',', ''); 


// bloque 2 


                $query7=mysql_query("SELECT rem.idGrupo2 , grp.grupo, org.origen, sum(rem.n_mallas)
                FROM remojo As rem, 
                origenes As org, 
                producto As pro, 
                grupo as grp 
                where org.id_origen = rem.procedencia 
                and grp.idgrupo = rem.idGrupo2 
                and pro.id_producto = rem.producto
                and rem.idGrupo2 = 11
                and rem.f_salida_produccion='$fecha'
                group by rem.procedencia;", $con );


              $query8=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc 
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and sal.fechaSalado='$fecha'
                      and pro.idEncargado=16
                      and pro.IdCalibre=30
                      group by sal.idSalado order by sal.idSalado desc", $con);
                
                while ($row6=mysql_fetch_row($query8)) {
                 
                  $totcal += $row6[4];
                }                


                $query9=mysql_query("SELECT rem.idGrupo2 , grp.grupo, org.origen, sum(rem.n_mallas)
                FROM remojo As rem, 
                origenes As org, 
                producto As pro, 
                grupo as grp 
                where org.id_origen = rem.procedencia 
                and grp.idgrupo = rem.idGrupo2 
                and pro.id_producto = rem.producto
                and rem.idGrupo2 = 13
                and rem.f_salida_produccion='$fecha'
                group by rem.procedencia;", $con );


                $query10=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                  encargados as enc 
                  where pro.idEncargado=enc.idencargados
                  and pro.codigo=sal.idCodigo
                  and sal.fechaSalado='$fecha'
                  and pro.IdCalibre =30 
                  and pro.idEncargado =14
                group by sal.idSalado order by sal.idSalado desc", $con);
                
                while ($row6=mysql_fetch_row($query10)) {
                 
                  $totcal2 += $row6[4];
                }


                $query12=mysql_query("SELECT rem.idGrupo2 , grp.grupo, org.origen, sum(rem.n_mallas)
                FROM remojo As rem, 
                origenes As org, 
                producto As pro, 
                grupo as grp 
                where org.id_origen = rem.procedencia 
                and grp.idgrupo = rem.idGrupo2 
                and pro.id_producto = rem.producto
                and rem.idGrupo2 = 12
                and rem.f_salida_produccion='$fecha'
                group by rem.procedencia;", $con );


                $query13=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                  encargados as enc 
                  where pro.idEncargado=enc.idencargados
                  and pro.codigo=sal.idCodigo
                  and sal.fechaSalado='$fecha'
                  and pro.IdCalibre =30 
                  and pro.idEncargado =13
                group by sal.idSalado order by sal.idSalado desc", $con);
                
                while ($row6=mysql_fetch_row($query13)) {
                 
                  $totcal3 += $row6[4];
                }

// bloque 3 

                $query14=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre,cal.calibre,cal.valor, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc,
                      calibres as cal
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and pro.IdCalibre=cal.idcalibres
                      and pro.IdCalibre=20
                      and sal.fechaSalado='$fecha'
                    group by sal.idSalado
                    order by sal.idSalado desc", $con);
                
                $query15=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre,cal.calibre,cal.valor, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc,
                      calibres as cal
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and pro.IdCalibre=cal.idcalibres
                      and pro.IdCalibre=21
                      and sal.fechaSalado='$fecha'
                    group by sal.idSalado
                    order by sal.idSalado desc", $con);

                $query16=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre,cal.calibre,cal.valor, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc,
                      calibres as cal
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and pro.IdCalibre=cal.idcalibres
                      and pro.IdCalibre=22
                      and sal.fechaSalado='$fecha'
                    group by sal.idSalado
                    order by sal.idSalado desc", $con);

                $query17=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre,cal.calibre,cal.valor, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc,
                      calibres as cal
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and pro.IdCalibre=cal.idcalibres
                      and pro.IdCalibre=23
                      and sal.fechaSalado='$fecha'
                    group by sal.idSalado
                    order by sal.idSalado desc", $con);

                $query18=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre,cal.calibre,cal.valor, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc,
                      calibres as cal
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and pro.IdCalibre=cal.idcalibres
                      and pro.IdCalibre=24
                      and sal.fechaSalado='$fecha'
                    group by sal.idSalado
                    order by sal.idSalado desc", $con);

                $query19=mysql_query("SELECT org.origen, sum(rem.n_mallas) as sum_mallas
                FROM remojo As rem, 
                origenes As org, 
                producto As pro, 
                grupo as grp 
                where org.id_origen = rem.procedencia 
                and grp.idgrupo = rem.idGrupo2 
                and pro.id_producto = rem.producto 
                and rem.f_salida_produccion='$fecha'
                group by rem.procedencia; ", $con);


                $con = mysql_connect('localhost', 'prodinwe_stgo391', '391stgo.*.');
                $db_selected = mysql_select_db('prodinwe_insubanchile', $con);

                $query20=mysql_query("SELECT org.id_origen, org.origen, sum(mpn.contenido)
                FROM planilla_registro_fecha_asig_produccion as prp,
                mat_prima_nacional as mpn,
                origenes as org
                where prp.id_folio_mpn_mpi=mpn.id_mat_prima_nacional
                and prp.id_origen=org.id_origen
                and prp.id_ldp=1
                and prp.fecha_asig_producc='$fecha'
                group by prp.id_origen ", $con);

                $query21=mysql_query("SELECT org.id_origen, org.origen, sum(mpi.contenido)
                FROM planilla_registro_fecha_asig_produccion as prp,
                mat_prima_importada as mpi,
                origenes as org
                where prp.id_folio_mpn_mpi=mpi.id_mat_prima_importada
                and prp.id_origen=org.id_origen
                and prp.id_ldp=1
                and prp.fecha_asig_producc='$fecha'
                group by prp.id_origen ", $con);

                
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
                    <li><a href="consola.php"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
                    <li ><a href="proceso1.php"><i class="glyphicon glyphicon-list"></i> Proceso Uno</a></li>
                    <li ><a href="proceso2.php"><i class="glyphicon glyphicon-stats"></i> Proceso Dos</a></li>
                    <li ><a href="proceso3.php"><i class="glyphicon glyphicon-list"></i> Proceso Tres</a></li>
                    <li ><a href="barras.php"><i class="glyphicon glyphicon-stats"></i> Generar Código Barra</a></li>
                    <li class="current"><a href="#"><i class="glyphicon glyphicon-stats"></i> Informe Productivo</a></li>
  <? if ($idEnc == 1) {?>             
                <li><a href="proceso5_1.php"><i class="glyphicon glyphicon-stats"></i> Informe Personal</a></li>    
               <?}?>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-12 panel-primary">
		  			<div class="content-box-header panel-heading">
	  					<div class="panel-title "><b>Informe Productivo</b></div>
		  			</div>

<!-- Code... bloque3 -->	
<div class="content-box-large">
	<tr>
	<form name="form4" method="POST" action="">
	<th>Fecha</th><td><input type="date" name="fecha" value="<?echo $fecha;?>"></td><td align="center">&nbsp;<input type="submit" name="busca" value="Buscar" class="btn btn-primary"></td></form>
	</tr>
</div> 

<?if ($busca) {?>

<div class="content-box-large">

<div class="row">

       <div class="col-lg-4 col-xs-6">
          <!-- small box -->            
          <table class="table table-condensed">
          <div class="small-box bg-blue">

            <div class="inner">
              <h3><? echo $tot1 ." - %". $porcent1 ?></h3>

              <p>Plasticos Grupo Azul</p>
            </div>            
            <div class="icon">
              <i class="ion ion-archive"></i>
            </div> 
          
          </div>
</table>
  </div>

   <div class="col-lg-4 col-xs-6">
          <!-- small box -->            
          <table class="table table-condensed">
          <div class="small-box bg-yellow">

            <div class="inner">
              <h3><? echo $tot2 ." - %". $porcent2 ?></h3>

              <p>Plasticos Grupo Amarillo</p>
            </div>
            <div class="icon">
              <i class="ion ion-archive"></i>
            </div>
          
          </div>
        </table>
    </div>


       <div class="col-lg-4 col-xs-6">
          <!-- small box -->            
          <table class="table table-condensed">
          <div class="small-box bg-red">

            <div class="inner">
              <h3><? echo $tot3 ." - %". $porcent3 ?></h3>

              <p>Plasticos Grupo Rojo</p>
            </div>
            <div class="icon">
              <i class="ion ion-archive"></i>
            </div>
          
          </div>
        </table>
    </div>
</div>
<!-- /.row -->
<div class="row">

 <div class="col-md-4">
          <div class="box">
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <th>Origen</th>
                  <th style="width: 40px">Cant.</th>
                </tr>
                <tr>

             <? while ($row6=mysql_fetch_row($query7)) {
                 
                $orgutil1 = $row6[2];
                $mputil1 = $row6[3];  

             echo "<tr class='small'><td>$orgutil1 </td><td><span class='badge bg-green'>$mputil1</span></td></tr> \n"; 
           }

            echo "<tr class='small'><td>CORTOS</td><td><span class='badge bg-green'>$totcal</span></td></tr>";
           ?> 
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
</div>





<div class="col-md-4">
          <div class="box">
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <th>Origen</th>
                  <th style="width: 40px">Cant.</th>
                </tr>
                <tr>

             <? while ($row6=mysql_fetch_row($query9)) {
                 
                $orgutil2 = $row6[2];
                $mputil2 = $row6[3];  

             echo "<tr class='small'><td>$orgutil2 </td><td><span class='badge bg-green'>$mputil2</span></td></tr> \n"; 
           }

            echo "<tr class='small'><td>CORTOS</td><td><span class='badge bg-green'>$totcal2</span></td></tr>";
           ?> 
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
</div>




<div class="col-md-4">
          <div class="box">
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <th>Origen</th>
                  <th style="width: 40px">Cant.</th>
                </tr>
                <tr>

             <? while ($row6=mysql_fetch_row($query12)) {
                 
                $orgutil3 = $row6[2];
                $mputil3 = $row6[3];  

             echo "<tr class='small'><td>$orgutil3 </td><td><span class='badge bg-green'>$mputil3</span></td></tr> \n"; 
           }

            echo "<tr class='small'><td>CORTOS</td><td><span class='badge bg-green'>$totcal3</span></td></tr>";
           ?> 
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      <!-- /.col -->
</div> 
<!-- /.row -->

<div class="row">

   <div class="col-md-4">
          <div class="box">
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr style="background-color: #5F9EA0">
                  <th>Calibres</th>
                  <th>Unidades</th>
                  <th style="width: 40px">%</th>
                </tr>

                <tr>

             <? while ($row6=mysql_fetch_row($query14)) {
                 
                  $cal = $row6[4];
                  $val = $row6[5];
                  $totcal1 += $row6[6];
              }                          

                 $calc1 = $totcal1 / $totplast;
                 $preporcent = $calc1 * 100;
                 $porcent = number_format($preporcent, 1,',', '');
      
                echo "<tr class='small'><td>$cal $val</td><td>$totcal1</td><td><span class='badge bg-green'>$porcent</span></td></tr> \n";
              

              ?> 
                </tr>
<tr>
              <?    while ($row6=mysql_fetch_row($query15)) {
                 
                  $cal = $row6[4];
                  $val = $row6[5];
                  $totcal5 += $row6[6];
                
                } 

                 $calc5 = $totcal5 / $totplast;
                 $preporcent = $calc5 * 100;
                 $porcent = number_format($preporcent, 1,',', '');

                echo "<tr class='small'><td>$cal $val</td><td>$totcal5</td><td><span class='badge bg-green'>$porcent</span></td></tr> \n"; 

               ?>  
              </tr>
<tr>
              <?    while ($row6=mysql_fetch_row($query16)) {
                 
                  $cal = $row6[4];
                  $val = $row6[5];
                  $totcal6 += $row6[6];
                
                } 

                 $calc6 = $totcal6 / $totplast;
                 $preporcent = $calc6 * 100;
                 $porcent = number_format($preporcent, 1,',', '');

                echo "<tr class='small'><td>$cal $val</td><td>$totcal6</td><td><span class='badge bg-green'>$porcent</span></td></tr> \n"; 

               ?>  
              </tr>
<tr>
              <?    while ($row6=mysql_fetch_row($query17)) {
                 
                  $cal = $row6[4];
                  $val = $row6[5];
                  $totcal7 += $row6[6];
                
                } 

                 $calc7 = $totcal7 / $totplast;
                 $preporcent = $calc7 * 100;
                 $porcent = number_format($preporcent, 1,',', '');

                echo "<tr class='small'><td>$cal $val</td><td>$totcal6</td><td><span class='badge bg-green'>$porcent</span></td></tr> \n"; 

               ?>  
              </tr>
<tr>
              <?    while ($row6=mysql_fetch_row($query18)) {
                 
                  $cal = $row6[4];
                  $val = $row6[5];
                  $totcal8 += $row6[6];
                
                } 

                 $calc8 = $totcal8 / $totplast;
                 $preporcent = $calc8 * 100;
                 $porcent = number_format($preporcent, 1,',', '');

                echo "<tr class='small'><td>$cal $val</td><td>$totcal6</td><td><span class='badge bg-green'>$porcent</span></td></tr> \n"; 

               ?>  
              </tr>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      <!-- /.col -->     


     <div class="col-md-4">
          <div class="box">
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr style="background-color: #5F9EA0">
                  <th>MPrima Utilizada</th>
                  <th style="width: 40px">Trip.</th>
                </tr>

<tr>  
<?
                while ($row6=mysql_fetch_row($query19)) {
                 
                  $org = $row6[0];
                  $mallas = $row6[1];
                  
                  echo "<tr class='small'><td>$org</td><td>$mallas</td></tr> \n";  
                }

?>
</tr>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      <!-- /.col --> 

     <div class="col-md-4">
          <div class="box">
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr style="background-color: #5F9EA0">
                  <th>MPrima Solicitada (Prodin)</th>
                  <th style="width: 40px">Trip.</th>
                </tr>

<tr>  
<?
                while ($row6=mysql_fetch_row($query20)) {
                 
                  $org = $row6[1];
                  $cont = $row6[2];
                  
                  echo "<tr class='small'><td><h5>$org</h5></td><td><h5>$cont</h5></td></tr> \n";  
                } 

                while ($row7=mysql_fetch_row($query21)) {
                 
                  $org1 = $row7[1];
                  $cont1 = $row7[2];
               
                  echo "<tr class='small'><td><h5>$org1</h5></td><td><h5>$cont1</h5></td></tr> \n";  
                }              

?>
</tr>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      <!-- /.col --> 





</div>
<!-- /.row -->




</div>
<!-- /.content-box-large -->

<!-- bloque3 -->
<div class="content-box-large">
 <div class="row">
 <div class="col-sm-4">
 <table class="table table-condensed">

<?if ($busca) {

              echo "<tr class='small'><td><h4>Total Plasticos:</h4></td><td style='background-color: lightblue; color: black;'><h4>$totplast</h4></td></tr> \n";  
                
             }?>

</table>
</div>


<!-- **********o********** -->


<div class="col-sm-4">
 <table class="table table-condensed">

<?if ($busca) {


                require("../../datos/connection.php");
                mysql_select_db("$database", $con);

                $query6=mysql_query("SELECT sum(rem.n_mallas) as sum_mallas
                FROM remojo As rem, 
                origenes As org, 
                producto As pro, 
                grupo as grp 
                where org.id_origen = rem.procedencia 
                and grp.idgrupo = rem.idGrupo2 
                and pro.id_producto = rem.producto 
                and rem.f_salida_produccion='$fecha'; ", $con);
                
                while ($row6=mysql_fetch_row($query6)) {
                 
                  $totmat = $row6[0];

                  echo "<tr class='small'><td><h4>Total MP Utilizada:</h4></td><td style='background-color: lightblue; color: black;'><h4>$totmat</h4></td></tr> \n";  
                }

                    }?>

</table>
</div>

<!-- **********o********-->

<div class="col-sm-4">
 <table class="table table-condensed">

<?if ($busca) {

                $con = mysql_connect('localhost', 'prodinwe_stgo391', '391stgo.*.');
                $db_selected = mysql_select_db('prodinwe_insubanchile', $con);

                $query6=mysql_query("SELECT org.id_origen, org.origen, sum(mpn.contenido)
                FROM planilla_registro_fecha_asig_produccion as prp,
                mat_prima_nacional as mpn,
                origenes as org
                where prp.id_folio_mpn_mpi=mpn.id_mat_prima_nacional
                and prp.id_origen=org.id_origen
                and prp.id_ldp=1
                and prp.fecha_asig_producc='$fecha' ", $con);         

                
                while ($row6=mysql_fetch_row($query6)) {
                 
                  $mpn = $row6[2];   
                            } 

                
                $query7=mysql_query("SELECT org.id_origen, org.origen, sum(mpi.contenido)
                FROM planilla_registro_fecha_asig_produccion as prp,
                mat_prima_importada as mpi,
                origenes as org
                where prp.id_folio_mpn_mpi=mpi.id_mat_prima_importada
                and prp.id_origen=org.id_origen
                and prp.id_ldp=1
                and prp.fecha_asig_producc='$fecha'  ", $con);         
                
                while ($row7=mysql_fetch_row($query7)) {
                 
                 $mpi = $row7[2];

                 $mptot = $mpi + $mpn;            

                echo "<tr class='small'><td><h4>Total MP Solicitada:</h4></td><td style='background-color: lightblue; color: black;'><h4>$mptot</h4></td></tr> \n";  
          }

          }?>

</table>
</div>
</div>
</div>


<!-- ******************** -->


<div class="content-box-large">
<div class="row">
 <div class="col-sm-4">
 <table class="table table-condensed">

<?if ($busca) {


                require("../../datos/connection.php");
                mysql_select_db("$database", $con);

                $query6=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc 
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and sal.fechaSalado='$fecha'
                      and pro.IdCalibre =30
                    group by sal.idSalado order by sal.idSalado desc", $con);
                               
                while ($row6=mysql_fetch_row($query6)) {
                 
                  $totcal4 += $row6[4];
                }
                 
                  echo "<tr class='small'><td><h4>Total Cortos</h4></td><td style='background-color: lightblue; color: black;'><h4>$totcal4</h4></td></tr> \n"; 
                
                }?>

</table>
</div>


<!-- **********o********** -->


<div class="col-sm-4">
 <table class="table table-condensed">

<?if ($busca) {

                  $res1 =   $totmat / $totplast ;
                  $indice = number_format($res1, 2,',', '');

                  echo "<tr class='small'><td><h4>Indice General:</h4></td><td style='background-color: lightblue; color: black;'><h4>$indice</h4></td></tr> \n";  

               }?>

</table>
</div>



<!-- ******************** -->

            </div>
          </div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?}?>

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
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/Chart.js/Chart.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>



