<?php
  session_start();
   
  // Controlo si el usuario ya está logueado en el sistema.
  if(isset($_SESSION['email'])){
    // Le doy la bienvenida al usuario.
#    echo 'BIENVENIDO <strong>' . $_SESSION['email'] . '</strong>, <a href="../cerrar-sesion.php">Cerrar Sesion</a>';
  }else{
    // Si no está logueado lo redireccion a la página de login.
    header("Location: ../acceso.html");
  }
?>
<?
require("../datos/connection.php");
mysql_select_db("$database", $con);

$resul1 = mysql_query("SELECT * FROM proceso_encargado pe
left outer join operarias as ope on ope.idoperarias = pe.idOperario
left outer join calibres as cal on cal.idcalibres = pe.idCalibre
left outer join encargados as enc on enc.idencargados = pe.idEncargado
left outer join origenes as org on org.id_origen = pe.origen
order by idproceso desc limit 1");
while ($bar = mysql_fetch_array($resul1)) {
$E=$bar[nombre];
$O=$bar[onombre];
$C=$bar[calibre];
$C1=$bar[idcalibres];
$O1=$bar[idOperario];
$E1=$bar[idEncargado];

}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proceso Cinco</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/navbar.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>

	<style type="text/css">
		th {
			background-color: yellow;
		}
		td {
			background-color: white;
		}
	</style>

</head>

<script type="text/JavaScript">

function preguntar(id){
 
   if (confirm('¿Esta seguro que desea eliminar el registro ' + id + '?'))
   //Redireccionamos si das a aceptar
     window.location.href = "../negocio/delete_15.php?id=" + id; //página web a la que te redirecciona si confirmas la eliminación
//else
  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
 //   alert('No se ha podido eliminar el registro...')
}
</script>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">PROCESOS</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Cierres Diarios</a></li>
      <li><a href="func.search_3_17.php">Ingreso Plasticos</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <? echo $_SESSION['email'] ?></a></li>
      <li><a href="../cerrar-sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesion</a></li>
    </ul>
  </div>
</nav>
<body>
<div class="container">
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" >Ingreso Manual<b> Datos</b></a>
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
<div class="jumbotron">
<!-- Code... bloque1 -->

<?
if(isset($_POST[ver])){ 

$date=date(c); // Obtener fecha de registro

$str1 = $_POST[encargado];
$str2 = '01';
$str3 = $_POST[operaria];
$str4 = $_POST[calibre];
$str5 = $_POST[cantidad];
//$str6 = $_POST[origen];



$str = array("$str1","$str2","$str3","$str4","$str5","$str6");
$str10= $str[0].$str[2].$str[3].$str[4];

   include("../datos/connection.php");
   mysql_select_db("$database", $con);
   

  $insert1= mysql_query("INSERT INTO proceso_encargado SET idEncargado= '$str1', n_bandeja='$str2', n_bidon='0', cantidad='$str5', idCalibre='$str4', idOperario='$str3', iniciales='0', codigo='$str[0]$str[2]$str[3]$str[5]$str[4]', origen='0' " , $con);
if ($insert1==true) 
{ 
  
  $insert2= mysql_query("INSERT INTO salado (idCodigo,fechaSalado) values ('$str10','$date')");
}
if ($insert2==true) {
   print("<script>window.location.replace('../presentacion/func.search_5.php');</script>");
  }   
}
?>
<form method="post" action="">
<table>
<th>ENCARGADO</th><th>OPERARIA</th><th>CALIBRE</th><th>CANTIDAD</th><th></th>
<tr>
	<td><select name="encargado" id="encargado" size="1" style="width: 200px; height: 24px;">
		   	<?
		   	require("../datos/connection.php");
			mysql_select_db("$database", $con);

			$results3 = mysql_query("SELECT * FROM encargados ");
			echo "<option value=".$E1.">".$E."</option>\n";
				while ($opcion = mysql_fetch_array($results3)) {
				$valor1 = $opcion[idencargados];	
			 	$valor2 = $opcion[nombre];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";
			 }?>
			 </select></td>


	<td><select name="operaria" size="1" style="width: 200px; height: 24px; " >	
		   	<?
		   	require("../datos/connection.php");
			mysql_select_db("$database", $con);

			$results3 = mysql_query("SELECT * FROM operarias order by onombre asc");
			echo "<option value=".$O1.">".$O."</option>\n";
				while ($opcion = mysql_fetch_array($results3)) {
				$valor1 = $opcion[idoperarias];	
			 	$valor2 = $opcion[onombre];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";
			 }?>
			 </select></td>

	<td><select name="calibre" size="1" style="width: 200px; height: 24px" >	
		   	<?
		   	require("../datos/connection.php");
			mysql_select_db("$database", $con);

			$results3 = mysql_query("SELECT * FROM calibres ");
			echo "<option value=".$C1.">".$C."</option>\n";
				while ($opcion = mysql_fetch_array($results3)) {
				$valor1 = $opcion[idcalibres];	
			 	$valor2 = $opcion[calibre];
			 	echo "<option value=".$valor1.">".$valor2."</option>\n";
			 }?>
			 </select></td>

	<td><input type="text" name="cantidad" style="width: 80px; height: 24px; background-color: pink" required>
	</td>
	<td><input type="submit" name="ver" value="REGISTRAR"></td>
	</tr>
<tr>
<td><? 
$resul1 = mysql_query("SELECT * FROM proceso_encargado pe
left outer join operarias as ope on ope.idoperarias = pe.idOperario
left outer join calibres as cal on cal.idcalibres = pe.idCalibre
left outer join encargados as enc on enc.idencargados = pe.idEncargado
left outer join origenes as org on org.id_origen = pe.origen
order by idproceso desc limit 1");
while ($bar = mysql_fetch_array($resul1)) {
$E=$bar[nombre];
$O=$bar[onombre];
$OR=$bar[origen];
$C=$bar[calibre];
$F=date("Ymd");
$INI=$bar[iniciales1];
$idope=$bar[idOperario];
$n_ban=$bar[n_bandeja];
$cant=1;

}?>
</td></tr>
</table>	
</form>

<!-- Code... bloque1 

</div>-->



   <!-- Main component for a primary marketing message or call to action
      <div class="jumbotron"> -->
<!--     
       <form action="../negocio/insert_5.php" method="post">		
		<table >
		<tr>
		   <td><input type="text" name="id" style="width: 200px; height: 24px"  value="<? echo $str[0],$str[2],$str[3],$str[4] ?>" required></td>
		   <td><input type="submit" name="guarda" value="REGISTRAR"></td>
	   </tr>
		</table>	 
		</form>
 </div>
-->
<!-- code 1 -->
       <div class="jumbotron">
      	<?
					require("../datos/connection.php");
					mysql_select_db("$database", $con);

					$f_actual = date("Y-m-d");

					$query2=mysql_query("SELECT sal.idCodigo,enc.nombre,sal.fechaSalado,pro.n_bandeja,ope.onombre,ope.iniciales,cal.calibre,pro.cantidad 
					FROM salado as sal
					left outer join proceso_encargado as pro on pro.codigo=sal.idCodigo
					left outer join encargados as enc on pro.idEncargado=enc.idencargados
					left outer join operarias as ope on pro.idOperario=ope.idoperarias
					left outer join calibres as cal on pro.IdCalibre=cal.idcalibres
					where sal.fechaSalado='$f_actual' group by sal.idSalado order by sal.idSalado desc"); 
					if($query2 == true) {

					echo "<table class='table table-striped'> \n";
					echo "<tr>
					      <th>ID</th><th>ENCARGADO</th><th>FECHA</th><th>BANDEJA</th><th>OPERARIO</th><th>INICIALES</th><th>CALIBRE</th><th>CANTIDAD</th><th>ELIMINAR</th></tr> \n";
					 while ($row2=mysql_fetch_row($query2)) {
					   echo "<tr class='small'>
					      <td>$row2[0]</td><td>$row2[1]</td><td>$row2[2]</td><td>$row2[3]</td><td>$row2[4]</td><td>$row2[5]</td><td>$row2[6]</td><td>$row2[7]</td><td><a href='#' onclick='preguntar($row2[0])'>Eliminar</a></td>
					   </tr> \n";
					}
					echo "</table> \n";
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