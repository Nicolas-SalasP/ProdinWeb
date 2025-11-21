<!--<?php
  session_start();
  // Controlo si el usuario ya está logueado en el sistema.
  if(isset($_SESSION['email'])){
   }else{
    // Si no está logueado lo redireccion a la página de login.
    header("Location: ../acceso.html");
  }
?> -->
<?
      require("../datos/connection.php");
      mysql_select_db("$database", $con);

      $results5="SELECT idgrupo1,grp.grupo,fecha,n_nudos_e,origenid,org.origen 
      FROM proceso_encargado2 as pr2
      left outer join grupo as grp on pr2.idgrupo1=grp.idgrupo
      left outer join origenes as org on pr2.origenid=org.id_origen ";

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
     window.location.href = "../negocio/delete_zona1.php?id=" + id; //página web a la que te redirecciona si confirmas la eliminación
}</script>
  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="#">Tripales</a></li>
            <li role="presentation"><a href="../vista/zona2.php">Tubing</a></li>
            <li role="presentation"><a href="../datos/cerrar-sesion.php">Salir</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Insuban SpA</h3><? echo $_SESSION['email'] ?>
      </div>

      <div class="jumbotron">

          <form class="form-horizontal" action='../negocio/insert_zona1.php' method="POST">

            <label class="col-lg-3 control-label">Fecha</label>
            <div class="col-xs-3">
                  <input type="text" class="form-control" value="<?php echo date("d-m-Y")?>" disabled>
                  <input type="hidden" class="form-control" name="fecha" value="<?php echo date("Y-m-d")?>">
            </div>
            <div class="clearfix"></div>

            <label class="col-lg-3 control-label">Materia Prima</label>
            <div class="col-xs-6">
                <select class="form-control" name="origen">
    <?
      $conn = mysql_connect("localhost", "prodinwe_stgo391", "391stgo.*.") or die ("Could not connect: " . mysql_error());
        mysql_select_db("prodinwe_insubanchile");

        $results6 = mysql_query("SELECT asp.id_origen, org.origen FROM planilla_registro_fecha_asig_produccion As asp, origenes As org
        where org.id_origen = asp.id_origen
        and asp.fecha_asig_producc between '2016-01-01' and '2018-12-30' group by origen ");
      echo "<option value='$idorg'>".$org."</option>\n";
        while ($opcion = mysql_fetch_array($results6)) {
        $valor1 = $opcion[id_origen];
        $valor2 = $opcion[origen];
        echo "<option value=".$valor1.">".$valor2."</option>\n";

        mysql_close($conn);

       }?>
                </select>
            </div>
            <div class="clearfix"></div>


            <label class="col-lg-3 control-label">Bidon Nº</label>
            <div class="col-xs-7">
<?
      require("../datos/connection.php");
      mysql_select_db("$database", $con);

    $res5 ="SELECT * FROM proceso_encargado2 ";

      if($idEnc == 13){
      $res5.= " where idgrupo1 = 12 order by idproceso_encargado2 DESC limit 1 ";
      }

      if($idEnc == 14){
      $res5.= " where idgrupo1 = 13 order by idproceso_encargado2 DESC limit 1 ";
      }

      if($idEnc == 16){
      $res5.= " where idgrupo1 = 11 order by idproceso_encargado2 DESC limit 1 ";
      }

      if($idEnc == 1){
      $res5.= " order by idproceso_encargado2 DESC limit 1 ";
      }
    $arr5=mysql_query($res5); 

while ($arr55 = mysql_fetch_array($arr5)) {?>

          <input type="text" class="form-control" name="bidon" value="<? echo $arr55[5]; ?>" required>
<?}?>    

            </div> 
            <div class="clearfix"></div>


            <label class="col-lg-3 control-label">Grupo</label>
            <div class="col-xs-3">
            <? if ($idEnc ==  13) {
              $grp="VERDE";
              $idgrp=12;
            }elseif ($idEnc == 14) {
              $grp="AMARILLO";
              $idgrp=13;
            }elseif ($idEnc == 16) {
              $grp="AZUL";
              $idgrp=11;
            }else{
              $grp="";
            }?>
                  <input type="text" class="form-control" value="<? echo $grp; ?>" disabled>
                  <input type="hidden" class="form-control" name="grupo" value="<? echo $idgrp; ?>">
            </div>
            <div class="clearfix"></div>


            <label class="col-lg-3 control-label">Trabajador</label>
            <div class="col-xs-6">
                <select class="form-control" name="operaria" required>
<?
      require("../datos/connection.php");
      mysql_select_db("$database", $con);

      $results3 = "SELECT * FROM operarias ";

      if($idEnc == 13){
      $results3.= " where idgrupo = 12 and activo=1 order by onombre asc ";
      }

      if($idEnc == 14){
      $results3.= " where idgrupo = 13 and activo=1 order by onombre asc ";
      }

      if($idEnc == 16){
      $results3.= " where idgrupo = 11 and activo=1 order by onombre asc ";
      }

      if($idEnc == 1){
      $results3.= " order by onombre asc ";
      }

      $resul3=mysql_query($results3);

      echo "<option value='0'>"."</option>\n";
        while ($opcion = mysql_fetch_array($resul3)) {
        $valor11 = $opcion[idoperarias];  
        $valor21 = $opcion[onombre];
        echo "<option value=".$valor11.">".$valor21."</option>\n";
       }?>
                </select>
            </div>
            <div class="clearfix"></div>

            <label class="col-lg-3 control-label">Entrega Material</label>
            <div class="col-xs-2">
                  <select class="form-control" name="nudos_e" required>
                  <option>0</option>                    
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>                  
                </select>
            </div>
            
            <label class="col-lg-3 control-label">Retiro Material</label>
            <div class="col-xs-2">
                 <select class="form-control" name="nudos_r" required>
                  <option>0</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>   
                </select>
            </div>
            <div class="clearfix"></div>

</br></br>

            <div>
                  <input type="submit" name="agrega" value="Agregar" />
            </div>

</form>
      </div>


      <div>
   <?
      
      require("../datos/connection.php");
      mysql_select_db("$database", $con);

      $hoy=date("Y-m-d");

      $query5="SELECT pr2.idproceso_encargado2, pr2.fecha, ope.onombre,org.origen,grp.grupo,n_bidon,n_nudos_e, n_nudos_r,org.id_origen
        FROM proceso_encargado2 as pr2
        left outer join operarias as ope on ope.idoperarias=pr2.operaria
        left outer join origenes as org on org.id_origen=pr2.origenid
        left outer join grupo as grp on grp.idgrupo=pr2.idgrupo1 ";

      if($idEnc == 13){
      $query5.= " where pr2.fecha='$hoy' and pr2.idgrupo1=12 order by pr2.idproceso_encargado2 DESC ";
      }

      if($idEnc == 14){
      $query5.= " where pr2.fecha='$hoy' and pr2.idgrupo1=13 order by idproceso_encargado2 desc ";
      }

      if($idEnc == 16){
      $query5.= " where pr2.fecha='$hoy' and pr2.idgrupo1=11 order by idproceso_encargado2 desc ";
      }

      if($idEnc == 1){
      $query5.= " pr2.fecha='$hoy' order by idproceso_encargado2 desc ";
      }

      $querys5=mysql_query($query5);

      if($querys5 == true) {

      echo "<table class='table table-striped' > \n";

      echo "<tr>

            <th>FECHA&nbsp;</th><th>&nbsp;TRABAJADOR&nbsp;</th><th>&nbsp;PROVEEDOR&nbsp;</th><th>&nbsp;GRUPO&nbsp;</th><th>&nbsp;BIDON&nbsp;</th><th>&nbsp;ENTREGA&nbsp;</th><th>&nbsp;RETIRO&nbsp;</th><th>&nbsp;SUBTOTAL&nbsp;</th><th>&nbsp;X</th></tr> \n";

       while ($row5=mysql_fetch_row($querys5)) {

$x1 = $row5[6];
$x2 = $row5[7];
$x3 = $row5[8];
$subtot_nudos = $x1 - $x2;
$sum5+=$subtot_nudos;

  if ($x3 == 1000055 or $x3 == 1000043) {
  $varx1+=$subtot_nudos * 15;
  }elseif ($x3 == 1000039) {
  $varx2+=$subtot_nudos * 22;
  }elseif ($x3 == 107) {
  $varx3+=$subtot_nudos * 10;
  }elseif ($x3 == 1000058) {
  $varx4+=$subtot_nudos * 30;
  }else{
  $varx5+=$subtot_nudos * 20;
  }

$sum6 = $varx1+$varx2+$varx3+$varx4+$varx5;

         echo "<tr>

            <td>$row5[1]</td><td>$row5[2]</td><td>$row5[3]</td><td>$row5[4]</td><td>$row5[5]</td><td align='center'>$row5[6]</td><td align='center'>$row5[7]</td><td align='center'>$subtot_nudos</td><td><a href='#' onclick='preguntar($row5[0] )'>&nbsp;Eliminar</a></td>

         </tr> \n";

      }

      echo "</table> \n";



      echo "<br>";



      echo "<table border ='0' width='100%'>";

          echo "<tr>

            <td width='100' nowrap='nowrap'>&nbsp;</td><td width='50' nowrap='nowrap'></td><td width='31' nowrap='nowrap' align='right'><strong>TOTAL_NUDOS:</strong>&nbsp;&nbsp;<b>$sum5</b></td><td width='100' nowrap='nowrap' align='center'><strong>TRIPALES:</strong>&nbsp;&nbsp;<b>$sum6</b></td>

          </tr>";

          echo "</table>";

      } 

      ?>

      </div>

      <footer class="footer">
        <p>&copy; 2018 Insuban SpA. v2.0</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
