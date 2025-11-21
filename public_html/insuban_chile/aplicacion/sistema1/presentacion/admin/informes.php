<!--  <?php
//$url1=$_SERVER['REQUEST_URI'];
//header("Refresh: 3; URL=$url1");
?> -->
 <head>
    <title>Consola Administración</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

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
                   <li ><a href="consola.php"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
                    <li><a href="proceso1.php"><i class="glyphicon glyphicon-list"></i> Proceso Uno</a></li>
                    <li><a href="proceso2.php"><i class="glyphicon glyphicon-stats"></i> Proceso Dos</a></li>
                    <li><a href="proceso3.php"><i class="glyphicon glyphicon-list"></i> Proceso Tres</a></li>
                    <li><a href="proceso4.php"><i class="glyphicon glyphicon-stats"></i> Proceso Cuatro</a></li>
                    <li><a href="barras.php"><i class="glyphicon glyphicon-stats"></i> Generar Código Barra</a></li>
                    <li class="current"><a href="#"><i class="glyphicon glyphicon-stats"></i> Informes</a></li>  
                </ul>
             </div>
      </div>
      <div class="col-md-10">
        <div class="row">
          <div class="col-md-12 panel-primary">
            <div class="content-box-header panel-heading">
              <div class="panel-title "><b>INFORMES</b></div>
            </div>
<!-- Code... bloque -->
<div class="content-box-large">
      
      <form action="" method="POST">
      <table>
        <th>
          <label>Fecha: </label>
          <input type="date" name="fech" />
          <input type="submit" name="search">
        </th>
      </table>
      </form>

</div>

        <div class="content-box-large">

          <?
          require("../../datos/connection.php");
          mysql_select_db("$database", $con);

          $fech=$_POST[fech];
          
//          $f_actual = date("Y-m-d");

          $query2=mysql_query("SELECT ope.onombre,ope.iniciales,sum(pr2.n_nudos_e),pro.IdCalibre,pro.cantidad
          FROM salado as sal
          left outer join proceso_encargado as pro on pro.codigo=sal.idCodigo
          left outer join proceso_encargado2 as pr2 on pro.idOperario = pr2.operaria
          left outer join encargados as enc on pro.idEncargado=enc.idencargados
          left outer join operarias as ope on pro.idOperario=ope.idoperarias
          left outer join calibres as cal on pro.IdCalibre=cal.idcalibres
          where sal.fechaSalado = '$fech' 
          and enc.idencargados=16
          group by sal.idCodigo limit 1");
          
          if($query2 == true) {

          echo "<table class='table table-striped'> \n";
          echo "<h3>GRUPO AZUL</h3>";
          echo "<tr><th>OPERARIO</th><th>INICIALES</th><th>TRIPAS</th><th>CORTOS</th><th>AZUL</th><th>CELESTE</th><th>VERDE</th><th>ROJO</th><th>BLANCO</th><th>PLASTICOS</th></tr> \n";
           while ($row2=mysql_fetch_row($query2)) {
           
            $ope = $row2[0];
            $inic = $row2[1];
            $trip = $row2[2];
            $idcal = $row2[3];
            $cant = $row2[4];

            
echo $idcal;


            if ($idcal = '30') {
              $cant1 = $cant; 
            } elseif ($idcal = '21' ) {
              $cant2 = $cant;
            } elseif ($idcal = 20) {
              $cant3 = $cant;
            }

          
          //  $var1 += $var1;     
          //  print_r($var1);

             echo "<tr class='small'>
                <td>$ope</td><td>$inic</td><td>$trip</td><td>$cant2</td><td>$cant3</td>
             </tr> \n";
          }
          echo "</table> \n";
          }
          ?>

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

