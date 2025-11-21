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
<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Proceso Tres</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="css/navbar.css" rel="stylesheet">



    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>

        <script>
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8 and tecla==1){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>


<script>

  $(document).ready(function () {
   $('#entradafilter').keyup(function () {
      var rex = new RegExp($(this).val(), 'i');
        $('.contenidobusqueda tr').hide();
        $('.contenidobusqueda tr').filter(function () {
            return rex.test($(this).text());
        }).show();

        })
    });

</script>

<script type="text/JavaScript">

function preguntar(id){
 
   if (confirm('¿Esta seguro que desea eliminar el registro ' + id + '?'))
   //Redireccionamos si das a aceptar
     window.location.href = "../negocio/delete_13_3.php?id=" + id; //página web a la que te redirecciona si confirmas la eliminación
//else
  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
 //   alert('No se ha podido eliminar el registro...')
}
</script>

	<style type="text/css">

		th {

			background-color: yellow;

		}

		td {

			background-color: white;

		}

	</style>



</head>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Procesos</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="func.search_4_13.php">Proceso 2</a></li>
      <li class="active"><a href="#">Proceso 3</a></li>
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

            <a class="navbar-brand" >Proceso Tres <b>Salado</b></a>
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

     

       <form action="../negocio/insert_3_13.php" method="post">		

		<table class="table">

		<tr>

		   <th>Codigo</th><td><input type="text" name="id" style="width: 200px; height: 24px" autofocus required onkeypress="return valida(event)"></td><td><input type="submit" name="guarda" value="."></td>

	   </tr>

		</table>	 

		</form>

      </div>
      <div class="input-group"> <span class="input-group-addon">Filtrar por: </span>
          <input id="entradafilter" type="text" class="form-control" style="width: 200px; height: 28px">
      </div>


<!-- code 1 -->

       <div class="jumbotron">

      	<?
					require("../datos/connection.php");
					mysql_select_db("$database", $con);

					$f_actual = date("Y-m-d");

					$query2=mysql_query("SELECT sal.idCodigo,enc.nombre,sal.fechaSalado,pro.n_bandeja,ope.onombre,ope.iniciales,cal.calibre,pro.cantidad,sal.idSalado 
					FROM salado as sal
					left outer join proceso_encargado as pro on pro.codigo=sal.idCodigo
					left outer join encargados as enc on pro.idEncargado=enc.idencargados
					left outer join operarias as ope on pro.idOperario=ope.idoperarias
					left outer join calibres as cal on pro.IdCalibre=cal.idcalibres
					where sal.fechaSalado='$f_actual' and pro.idEncargado=14 group by sal.idSalado order by sal.idSalado desc");

					if($query2 == true) {

					echo "<table class='table table-striped'> \n";

					echo "<tr>

					      <th>ID</th><th>ENCARGADO</th><th>FECHA</th><th>BANDEJA</th><th>OPERARIO</th><th>INICIALES</th><th>CALIBRE</th><th>CANTIDAD</th><th></th></tr> \n";

                echo " <tbody class='contenidobusqueda'>";


					 while ($row2=mysql_fetch_row($query2)) {

					   echo "<tr class='small'>

					      <td>$row2[0]</td><td>$row2[1]</td><td>$row2[2]</td><td>$row2[3]</td><td>$row2[4]</td><td>$row2[5]</td><td>$row2[6]</td><td>$row2[7]</td><td><a href='#' onclick='preguntar($row2[8] )'>Eliminar</a></td>

					   </tr> \n";

					}
          echo "</tbody>";
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