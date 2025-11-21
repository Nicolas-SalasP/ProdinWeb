<?php
  session_start();
   
  // Controlo si el usuario ya está logueado en el sistema.
  if(isset($_SESSION['email'])){
    // Le doy la bienvenida al usuario.
#    echo 'Bienvenido <strong>' . $_SESSION['email'] . '</strong>, <a href="../cerrar-sesion.php">cerrar sesion</a>';
  }else{
    // Si no está logueado lo redireccion a la página de login.
    header("Location: ../acceso.html");
  }
?>
<? require("../datos/connection.php");

		  mysql_select_db("$database", $con);

		  $results5 = mysql_query("SELECT idgrupo1,grp.grupo,fecha,n_nudos_e,origenid,org.origen 
			FROM proceso_encargado2 as pr2
			left outer join grupo as grp on pr2.idgrupo1=grp.idgrupo
			left outer join origenes as org on pr2.origenid=org.id_origen
			where pr2.idgrupo1=11
			order by idproceso_encargado2 desc limit 1");

		  while ($arr5 = mysql_fetch_array($results5)) {

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


    <title>Proceso Dos</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="css/navbar.css" rel="stylesheet">


    <style type="text/css">
  

   th {

      background: yellow;

   }


	</style>

  </head>

<script type="text/JavaScript">

function preguntar(id){
 
   if (confirm('¿Esta seguro que desea eliminar el registro ' + id + '?'))
   //Redireccionamos si das a aceptar
     window.location.href = "../negocio/delete_14.php?id=" + id; //página web a la que te redirecciona si confirmas la eliminación
//else
  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
 //   alert('No se ha podido eliminar el registro...')
}
</script>




  <body>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="js/bootstrap.min.js"></script>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Procesos</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Proceso 2</a></li>
      <li><a href="func.search_3_14.php">Proceso 3</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <? echo $_SESSION['email'] ?></a></li>
      <li><a href="../cerrar-sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesion</a></li>
    </ul>
  </div>
</nav>




<div class="container">

      <!-- Static navbar -->

      <nav class="navbar navbar-default">

        <div class="container-fluid">

          <div class="navbar-header">
            <a class="navbar-brand" >Proceso Dos <b>Encargado</b></a>
   <span id="liveclock" style="position:relative;left:80px;top:9px; color:blue;" ></span>
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
        myclock="<font size='5' face='Arial' ><b><font size='1'>Hora actual:</font>"+hours+":"+minutes+":"
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
          </div>

        </div><!--/.container-fluid -->

      </nav>

      <!-- Main component for a primary marketing message or call to action -->

      <div class="jumbotron">

<form action='../negocio/insert_2_14.php' method="POST">		

	<table border="1">

		<tr>

			<th>ORIGEN</th>

			<th>N&ordm; BIDON</th>			

		</tr>

		<tr>

<!--		<td><input type="text" name="origen" value="<? echo $arr5[3]; ?>" style="width: 200px; height: 24px" required></td> -->

				<td><select name="origen" size="1" style="width: 200px; height: 24px" required >	
		   	<?

        $results6 = mysql_query("SELECT rem.procedencia, org.origen FROM remojo As rem, origenes As org
        where org.id_origen = rem.procedencia group by origen ");
      echo "<option value='$idorg'>".$org."</option>\n";
        while ($opcion = mysql_fetch_array($results6)) {
        $valor1 = $opcion[procedencia];
        $valor2 = $opcion[origen];
        echo "<option value=".$valor1.">".$valor2."</option>\n";





/*
			$conn = mysql_connect("localhost", "prodinwe_stgo391", "391stgo.*.") or die ("Could not connect: " . mysql_error());
				mysql_select_db("prodinwe_insubanchile");

				$results6 = mysql_query("SELECT asp.id_origen, org.origen FROM planilla_registro_fecha_asig_produccion As asp, origenes As org
				where org.id_origen = asp.id_origen
				and asp.fecha_asig_producc between '2016-01-01' and '2017-12-30' group by origen ");
			echo "<option value='$idorg'>".$org."</option>\n";
				while ($opcion = mysql_fetch_array($results6)) {
			 	$valor1 = $opcion[id_origen];
			 	$valor2 = $opcion[origen];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";

			 	mysql_close($conn);
*/
			 }?>
			 </select></td>

		<? 
		require("../datos/connection.php");
		mysql_select_db("$database", $con);
		
		$results5 = mysql_query("SELECT * FROM proceso_encargado2 where idgrupo1 = 11 order by idproceso_encargado2 DESC limit 1 ");
		while ($arr5 = mysql_fetch_array($results5)) {?>
		
		<td><input type="text" name="bidon" value="<? echo $arr5[5]; ?>" style="width: 200px; height: 24px" required></td>

		<?}?>

		</tr>

	</table>



	<table border="1" >

	<tr>

		   <th>FECHA</th>

 		   <th>OPERARIA</th>  

		   <th>GRUPO</th>

	</tr>

		<tr>

		<td><input type="date" name="fecha" value="<? echo $fecha; ?>" required></td>

		<td><select name="operaria" size="1" style="width: 200px; height: 24px; " required>	

		   	<?

		   	require("../datos/connection.php");

			mysql_select_db("$database", $con);
			

			$results3 = mysql_query("SELECT * FROM operarias where idgrupo = 11 and activo=1 order by onombre asc");

			echo "<option value='0'>".Seleccione."</option>\n";

				while ($opcion = mysql_fetch_array($results3)) {

				$valor11 = $opcion[idoperarias];	

			 	$valor21 = $opcion[onombre];

			 	echo "<option value=".$valor11.">".$valor21."</option>\n";

			 }?>

			 </select></td>



			 <td><SELECT name="grupo" size="1" style="width: 100px; height: 24px" required> 

			      <OPTION value="11">AZUL</OPTION>  

		   </SELECT></td>
</table>

<table border="1">

<tr>
		   <th>NUDOS_ENTREGADOS</th>

		   <th>NUDOS_RETIRADOS</th>
</tr>

<tr>

		<td><input type="text" name="nudos_e" value="0" style="width: 160px; height: 24px" required></td>

		<td><input type="text" name="nudos_r" value="0" style="width: 150px; height: 24px" required></td>

</tr>

</table>

<br><br><br>
		<td><input type="submit" name="agrega" value="Agregar" class="btn btn-primary"></td>		

</form>

      </div> <!-- /Jumbotron end -->


    	<div class="jumbotron">

      	<?
			$hoy=date("Y-m-d");

			$query5 = mysql_query("SELECT pr2.idproceso_encargado2, pr2.fecha, ope.onombre,org.origen,grp.grupo,n_bidon,n_nudos_e, n_nudos_r,org.id_origen 
				FROM proceso_encargado2 as pr2
				left outer join operarias as ope on ope.idoperarias=pr2.operaria
				left outer join origenes as org on org.id_origen=pr2.origenid
				left outer join grupo as grp on grp.idgrupo=pr2.idgrupo1
				where pr2.f_registro='$hoy' and pr2.idgrupo1=11 order by pr2.idproceso_encargado2 DESC", $con);

			if($query5 == true) {

			echo "<table border = '1' width='100%' style='background-color: white' > \n";

			echo "<tr>

			      <th><center>ID</center></th><th>FECHA</th><th>OPERARIA</th><th>ORIGEN</th><th>GRUPO</th><th>N_BIDON</th><th>NUDOS_E</th><th>NUDOS_R</th><th>SUBTOTAL_NUDOS</th><th>ELIMINAR</th></tr> \n";

			 while ($row5=mysql_fetch_row($query5)) {

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

  }elseif ($x3 == 87) {
  $varx5+=$subtot_nudos * 23;  

  }elseif ($x3 == 555) {
  $varx6+=$subtot_nudos * 5;

 }elseif ($x3 == 1000062) {
  $varx8+=$subtot_nudos * 25;  

  }else{
  $varx7+=$subtot_nudos * 20;
  }

$sum6 = $varx1+$varx2+$varx3+$varx4+$varx5+$varx6+$varx7+$varx8;


//var_dump($varx1);
//var_dump($varx4);


			   echo "<tr>

			      <td>$row5[0]</td><td>$row5[1]</td><td>$row5[2]</td><td>$row5[3]</td><td>$row5[4]</td><td>$row5[5]</td><td>$row5[6]</td><td align='center'>$row5[7]</td><td align='center'>$subtot_nudos</td><td><a href='#' onclick='preguntar($row5[0] )'>Eliminar</a></td>

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

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript

    ================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>

    <script src="js/bootstrap.min.js"></script>

  </body>

</html>