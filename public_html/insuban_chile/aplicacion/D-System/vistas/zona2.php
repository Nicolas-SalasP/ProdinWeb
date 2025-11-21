<?php
  session_start();
   
  // Controlo si el usuario ya está logueado en el sistema.
  if(isset($_SESSION['email'])){
  }else{
    // Si no está logueado lo redireccion a la página de login.
    header("Location: ../acceso.html");
  }
?>
<?
require("../datos/conexion.php");
mysql_select_db("$database", $con);

      $results5 ="SELECT idgrupo1,grp.grupo,fecha,n_nudos_e,origenid,org.origen 
      FROM proceso_encargado2 as pr2
      left outer join grupo as grp on pr2.idgrupo1=grp.idgrupo
      left outer join origenes as org on pr2.origenid=org.id_origen";

     if($idEnc == 13){
      $results5.= " where idgrupo1=12 order by idproceso_encargado2 desc limit 1 ";
      }

      if($idEnc == 14){
      $results5.= " where idgrupo1=13 order by idproceso_encargado2 desc limit 1 ";
      }

      if($idEnc == 16){
      $results5.= " where idgrupo1=11 order by idproceso_encargado2 desc limit 1 ";
      }

      if($idEnc == 1){
      $results5.= " order by idproceso_encargado2 desc limit 1 ";
      }

      $result5=mysql_query($results5);

      while ($arr5 = mysql_fetch_array($result5)) {

        $fecha=$arr5[2];
        $nudo=$arr5[3];
        $idorg=$arr5[4];
        $org=$arr5[5];

}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="../img/ico.png">

    <title>Prod-System</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min1.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/jumbotron-narrow.css" rel="stylesheet">

  </head>
<script type="text/JavaScript">
function preguntar(id){

    if (confirm('¿Esta seguro que desea eliminar este registro?'))
     window.location.href = "../negocio/delete_zona2.php?id=" + id; //página web a la que te redirecciona si confirmas la eliminación
}</script>
  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="../vista/zona1.php">Tripales</a></li>
            <li role="presentation" class="active"><a href="#">Tubing</a></li>
            <li role="presentation"><a href="../datos/cerrar-sesion.php">Salir</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Insuban SpA</h3><? echo $_SESSION['email'] ?>
      </div>

      <div class="jumbotron">

<form class="form-horizontal" action="../negocio/insert_zona2.php" method="post">

            <label class="col-lg-4 control-label">Codigo de barras</label>
            <div class="col-xs-5">
                 <input type="text" name="id" autofocus required onkeypress="return valida(event)">
                 <input type="submit" name="guarda" value=".">
            </div>
            <div class="clearfix"></div>
</form>
</br>
      <label class="col-lg-4 control-label">Filtrar por:</label>
      <div class="col-xs-4"> 
          <input id="entradafilter" type="text" class="form-control">
      </div>
</div>

<div>

        <?
          require("../datos/conexion.php");
          mysql_select_db("$database", $con);

          $f_actual = date("Y-m-d");

          $query2=mysql_query("SELECT sal.idCodigo,enc.nombre,sal.fechaSalado,pro.n_bandeja,ope.onombre,ope.iniciales,cal.calibre,pro.cantidad,sal.idSalado 
          FROM salado as sal
          left outer join proceso_encargado as pro on pro.codigo=sal.idCodigo
          left outer join encargados as enc on pro.idEncargado=enc.idencargados
          left outer join operarias as ope on pro.idOperario=ope.idoperarias
          left outer join calibres as cal on pro.IdCalibre=cal.idcalibres
          where sal.fechaSalado='$f_actual' and  pro.idEncargado='$idEnc' group by sal.idSalado order by sal.idSalado desc");

          if($query2 == true) {

          echo "<table class='table table-striped'> \n";

          echo "<tr>

                <th>ID</th><th>ENCARGADO</th><th>FECHA</th><th>BANDEJA</th><th>OPERARIO</th><th>INICIALES</th><th>CALIBRE</th><th>CANTIDAD</th><th>X</th></tr> \n";

                echo " <tbody class='contenidobusqueda'>";

           while ($row2=mysql_fetch_row($query2)) {

             echo "<tr class='small'>

                <td>$row2[0]</td><td>$row2[1]</td><td>$row2[2]</td><td>$row2[3]</td><td>$row2[4]</td><td>$row2[5]</td><td>$row2[6]</td><td>$row2[7]</td><td><a href='#' onclick='preguntar($row2[8] )'>Eliminar</a></td>

             </tr> \n";

          }
          echo "</tbody>";
          echo "</table> \n";

          }?>

      </div>

      <footer class="footer">
        <p>&copy; 2018 Insuban SpA. v2.0</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
